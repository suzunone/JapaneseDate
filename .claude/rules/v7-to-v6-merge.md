## v7系ブランチから v6系ブランチへのマージ手順

v7系（PHP8.x / PHPUnit 10+）で開発した変更を v6系（PHP7.x / PHPUnit 9.x）へマージしたあとに発生しやすい問題と対処法を記載する。

---

### 1. phpunit.xml のスキーマバージョン

v7系では PHPUnit 10+ 向けの設定を使用している。v6系では **PHPUnit 9.6** を使用するため、マージ後に以下を確認・修正する。

| 項目 | v7系 (PHPUnit 10+) | v6系 (PHPUnit 9.6) |
|------|-------------------|-------------------|
| スキーマ | `schema.phpunit.de/11.0/phpunit.xsd` | `schema.phpunit.de/9.6/phpunit.xsd` |
| カバレッジ要素 | `<source><include>...</include></source>` | `<coverage><include>...</include></coverage>` |
| `cacheDirectory` 属性 | あり | **削除する** |
| `backupStaticProperties` 属性 | あり | **削除する** |
| `requireCoverageMetadata` 属性 | あり | **削除する** |

**修正後の phpunit.xml 最小構成例:**

```xml
<phpunit xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
         backupGlobals="false"
         bootstrap="tests/bootstrap.php"
         colors="true"
         processIsolation="false"
         stopOnError="false"
         stopOnFailure="false"
         xsi:noNamespaceSchemaLocation="https://schema.phpunit.de/9.6/phpunit.xsd"
>
  <testsuites>...</testsuites>

  <coverage>
    <include>
      <directory suffix=".php">src</directory>
    </include>
  </coverage>
  ...
</phpunit>
```

確認コマンド:

```bash
vendor/bin/phpunit --version   # PHPUnit 9.6.x であること
vendor/bin/phpunit --list-suites 2>&1 | head -5   # 設定警告が出ないこと
```

---

### 2. rector による型ヒント削除後の厳密等価比較の破損

v7系のコードは PHP8.x 向けに `int $year` などの型ヒントを持つ。
v6系へのマージ時に rector を実行すると型ヒントが削除され、テストから文字列 `'1989'` 等を渡した際に `===` 比較が失敗する。

**原因:**

```php
// rector 実行前（PHP8.x）
protected function getFebruaryHoliday(int $year, DateTimeZone $timezone): array
// → 呼び出し時に '1989'（string）が 1989（int）に自動強制される

// rector 実行後（PHP7.x）
protected function getFebruaryHoliday($year, $timezone): array
// → '1989'（string）のまま渡るため '1989' === 1989 が false になる
```

**影響を受けるパターン:** メソッド内で `$year === <整数リテラル>` または `$year === <定数>` を使う箇所。

**対処法:** 型ヒント削除後のメソッド先頭で明示的にキャストする。

```php
protected function getFebruaryHoliday($year, $timezone): array
{
    $year = (int) $year;   // ← 追加
    if ($year <= DateTime::HOLIDAY_START_YEAR) {
        return [];
    }
    ...
}
```

**確認すべきメソッド一覧（`===` で特定年を比較しているもの）:**

- `getFebruaryHoliday` — `$year === 1989`
- `getAprilHoliday` — `$year === 1959`, `$year === 2019`
- `getMayHoliday` — `$year === 2019`
- `getJuneHoliday` — `$year === 1993`
- `getJulyHoliday` — `$year === SECOND_TIME_TOKYO_OLYMPIC_YEAR` / `RESCHEDULE_YEAR`
- `getAugustHoliday` — 同上
- `getOctoberHoliday` — `$year === 2019`, 同上
- `getNovemberHoliday` — `$year === 1990`

新たに特定年 `===` 比較を追加した場合も同様の対処が必要。

---

### 3. ソースコードをパースするテストの正規表現破損

rector が型ヒントを削除すると、**ソースコードを正規表現でパースするデータプロバイダー**も壊れる。

**発生パターン:**

```php
// v7系: int $year 型ヒントあり
public function syunbun(int $year): SolarTermDate { ...

// v6系 (rector 実行後): 型ヒントなし
public function syunbun($year): SolarTermDate { ...
```

データプロバイダーが旧シグネチャを前提とした正規表現を持つ場合、マッチが0件になりデータプロバイダーが空配列を返す。
PHPUnit は空配列のデータプロバイダーをテストスキップとして扱うため、テストが実行されずスキップ扱いになる。

**エラーメッセージの例:**
```
Skipped Test Case (PHPUnit\Framework\SkippedTestCase)
Test for Xxx::test_foo skipped by data provider
```

**対処法:** データプロバイダー内の正規表現から型ヒント部分を削除する。

```php
// 修正前（v7系シグネチャを想定）
'/public function ([a-z]+)\(int \$year\): SolarTermDate\s*\{/m'

// 修正後（rector 適用後のシグネチャに合わせる）
'/public function ([a-z]+)\(\$year\): SolarTermDate\s*\{/m'
```

**確認すべき箇所:** テストファイル内で `file_get_contents` + `preg_match_all` を組み合わせてソースコードをパースしているデータプロバイダー。

---

### 4. マージ後の確認手順

```bash
# 1. PHPUnit 設定警告がないことを確認
vendor/bin/phpunit --list-suites 2>&1 | grep -i warning

# 2. コンポーネントテストを単体実行（スキップが出ていないことを確認）
vendor/bin/phpunit tests/Tests/JapaneseDate/Components/JapaneseDateTest.php
vendor/bin/phpunit tests/Tests/JapaneseDate/Components/SimpleSolarTermTest.php

# 3. 全体テストを実行
vendor/bin/phpunit
```

全体実行が時間・環境の都合でできない場合は、その理由と未確認範囲を作業結果に明記する（testing.md 参照）。
