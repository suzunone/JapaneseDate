## スペルチェック辞書

### 独自単語を使用する場合

プロジェクト固有の用語、人名、暦・天文用語、識別子など、一般的な英単語ではない正当な単語を使用し、JetBrains の `SpellCheckingInspection` でタイポとして指摘された場合は、単語を別の表記に修正せず `dictionary.md` に登録する。

単なるスペルミスや、既存の一般的な英単語で適切に表現できるものは辞書へ登録せず、タイポを修正すること。

### 辞書への追加手順

1. `dictionary.md` の内容を確認し、追加する単語に適したカテゴリを選ぶ
2. 選んだカテゴリの説明テーブルに、バッククォートで囲んだ単語と、その単語が正当である理由が分かる説明を追加する
3. 大文字・小文字、パスカルケース、キャメルケースなど複数の表記をコード内で使用する場合は、実際に使用する表記を漏れなくテーブルへ記載する
4. `dictionary.md` 下部の XML にある `<words>` 内へ、テーブルに追加した各表記を `<w>単語</w>` の形式で追加する
5. テーブルと XML で単語の表記およびバリエーションが一致していることを確認する

```markdown
| `exampleWord` / `ExampleWord` / `EXAMPLE_WORD` | プロジェクト固有の用語の説明 |
```

```xml
<w>exampleWord</w>
<w>ExampleWord</w>
<w>EXAMPLE_WORD</w>
```

既存カテゴリに該当しない場合は、内容が分かる見出しとテーブルを XML より前に追加する。XML だけを更新したり、説明テーブルだけを更新したりせず、必ず両方を同じ変更で更新すること。

---

### 月黄経縮約クラス・メソッド識別子

ELP2000 黄経縮約化（朔探索高速化）で導入したクラス・トレイト・メソッド・識別子。

| 識別子 | 説明 |
|--------|------|
| `ELP2000Reduced` | ELP2000 を継承し縮約 LON 系メソッドで上書きするサブクラス名 |
| `ELP2000LonReduced` | 縮約 LON 系 12 メソッドを定義するトレイト名 |
| `elp2000_reduced` | `moonAlgorithmName()` の返り値および oneTimeCache キー識別子 |
| `longitudeMoonFast` | 朔探索ループ専用の高速月黄経メソッド名 |
| `reducedMoonImpl` | `Astronomy` クラスが保持する縮約実装プロパティ名 |

```xml
<component name="ProjectDictionaryState">
  <dictionary name="project">
    <words>
      <w>ELP2000Reduced</w>
      <w>ELP2000LonReduced</w>
      <w>elp2000_reduced</w>
      <w>longitudeMoonFast</w>
      <w>reducedMoonImpl</w>
    </words>
  </dictionary>
</component>
```
