# ELP2000-82B 移植仕上げプロンプト

あなたは JapaneseDate リポジトリの PHP 実装を担当するエンジニアです。
`elp2000-82b.js` を `src/Components/ELP2000.php` へ移植し、月計算を従来の簡易計算と ELP2000-82B 高精度計算で切り替えられる状態まで仕上げてください。

## 前提

- 作業ディレクトリ: `/Users/fumikazu/workspace/JapaneseDate`
- 移植元: `elp2000-82b.js`
- 移植先: `src/Components/ELP2000.php`
- 関連クラス:
  - `src/Components/Astronomy.php`
  - `src/Components/Moon.php`
  - `src/Components/LunarCalendar.php`
- テスト:
  - `tests/Tests/JapaneseDate/Components/ELP2000Test.php`
  - `tests/Tests/JapaneseDate/Components/AstronomyTest.php`
  - `tests/Tests/JapaneseDate/Components/MoonTest.php`

## ゴール

1. `src/Components/ELP2000.php` のスケルトンを実装する。
2. BCMath を使い、内部計算では可能な限り `numeric-string` を維持する。
3. `getPosition()` と `getPrecisePosition()` を実装し、移植元 JS コメントの参照値を満たす。
4. `preciseLongitude()`, `preciseLatitude()`, `preciseDistance()` を実装する。
5. `Astronomy` / `Moon` 側で、従来計算と ELP2000 計算を切り替えられるエンジン設計にする。
6. 既存挙動を壊さず、デフォルトは従来計算のまま維持する。
7. `ELP2000Test` の Incomplete を実装完了後に Pass へ変える。

## 実装方針

- まず `elp2000-82b.js` の `ELP2000_82b.getPosition(jd)` と、その下位メソッドを PHP に移植する。
- 移植元 JS の主な対応は以下。
  - `getPosition(jd)` → `ELP2000::getPrecisePosition()` / `ELP2000::getPosition()`
  - `convertToInertialEclipticOfJ2000(r, t)` → `convertToInertialEclipticOfJ2000()`
  - `mainproblem_lon/lat/r` → `mainProblemLon()`, `mainProblemLat()`, `mainProblemR()`
  - `tides_lon*`, `tides_lat*`, `tides_r*` → `tidesLon()`, `tidesLat()`, `tidesR()`
  - `planetary_lon*`, `planetary_lat*`, `planetary_r*` → `planetaryLon()`, `planetaryLat()`, `planetaryR()`
- 係数が多いため、機械的移植でよい。ただし巨大メソッドのままにするか、級数データ配列へ分離するかは、保守性と性能を見て判断する。
- 三角関数は BCMath に存在しないため、`ELP2000::sin()` / `ELP2000::cos()` に閉じ込める。
- 多項式評価は `polynomial()` を使い、`a + (b + (c + d * t) * t) * t` のような JS 式を Horner 法で表現する。
- `float` 返却 API は互換用とし、内部では precise API を呼び出して最後だけ float 化する。
- 高精度入力が必要なユリウス日は `string` で受ける。`float` 入力は PHP 側で既に丸め済みであることを PHPDoc に残す。

## エンジン切り替え設計

`Astronomy` のアルゴリズム切り替えは、太陽計算と月計算を別々に指定する。

```php
Astronomy::useSolarAlgorithm(Astronomy::SOLAR_LEGACY);
Astronomy::useSolarAlgorithm(Astronomy::SOLAR_VSOP87);

Astronomy::useMoonAlgorithm(Astronomy::MOON_LEGACY);
Astronomy::useMoonAlgorithm(Astronomy::MOON_ELP2000);
```

デフォルトは `solar=legacy, moon=legacy` とする。
`factory()` は太陽アルゴリズムに応じて `Astronomy` または `Vsop87Astronomy` を返し、
`longitudeMoon()` は月アルゴリズムに応じて legacy または ELP2000 に委譲する。
キャッシュキーは `solar:moon` の組み合わせを含める。

## 検証データ

`tests/Tests/JapaneseDate/Components/ELP2000Test.php` に、以下の実データテストが入っている。

- 移植元 JS コメントの基準値:
  - `ELP82b.getPosition(2451555.5)`
  - 期待値: `[382979.7604730463, -68204.20174530084, -25987.71602589964]`
- USNO Astronomical Applications Department "Dates of Primary Phases of the Moon"
  - https://aa.usno.navy.mil/data/MoonPhases
  - 2023-2026 の朔データ
  - JST/UTC の日付変更付近に朔があるケースを含む

現状、`ELP2000.php` がスケルトンのため、未実装メソッドは `BadMethodCallException` を投げ、テスト側では Incomplete 扱いにしている。
実装後は Incomplete が消え、実データ検証として Pass する状態にする。

## 実装時の注意

- `apply_patch` で編集する。
- 既存のユーザー変更を戻さない。
- `composer.json` に `ext-bcmath` を要求として追加するかは、実装方針に応じて判断する。BCMath が必須なら追加し、テスト環境の拡張有無も確認する。
- 大量の係数移植では、単純な手作業ミスが起きやすい。可能なら JS から PHP 配列または PHP メソッドへ機械変換し、移植元コメントやテストで差分を追えるようにする。
- `sin()` / `cos()` の精度不足は朔境界テストで露出しやすい。引数還元を丁寧に行う。
- UTC / TT / TDB / Delta T の扱いは、最初に明確化する。テストの USNO 朔時刻は UT で与えられるため、ELP2000 の入力 TDB へ変換する場合は変換処理を専用メソッドに切り出す。

## 完了条件

以下を実行し、結果を確認する。

```bash
php -l src/Components/ELP2000.php
php -l tests/Tests/JapaneseDate/Components/ELP2000Test.php
vendor/bin/phpunit tests/Tests/JapaneseDate/Components/ELP2000Test.php
vendor/bin/phpunit tests/Tests/JapaneseDate/Components/AstronomyTest.php
vendor/bin/phpunit tests/Tests/JapaneseDate/Components/MoonTest.php
```

可能なら最後に全体テストも実行する。

```bash
vendor/bin/phpunit
```

完了時は、以下を簡潔に報告する。

- 実装した ELP2000 API
- Astronomy/Moon 側の切り替え方法
- USNO 朔データテストの結果
- 残した精度上の制約や TODO
