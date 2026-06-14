# スペルチェック辞書登録リスト

JetBrains SpellCheckingInspection で誤検知される正当な用語の一覧。

---

## 開発者・人名・機関名

| 単語 | 説明 |
|------|------|
| `Suzunone` | 開発者のユーザー名 |
| `Meeus` / `meeus` / `MEEUS` | Jean Meeus（天文学者）- 天文計算アルゴリズムの著者 |
| `MeeusMoon` | Meeus による月齢計算クラス名 |
| `MeeusMoonAge` | Meeus による月齢クラス名 |
| `Espenak` | Fred Espenak（NASA の天文学者）- ΔT 計算式の提唱者 |
| `Horner` | ホーナー法（Horner's method）- 多項式の効率的な評価アルゴリズム |
| `USNO` / `Usno` | United States Naval Observatory（米国海軍天文台）|
| `JPL` / `Jpl` / `jpl` | Jet Propulsion Laboratory（NASA ジェット推進研究所）- `jplHorizonsApparentSolarLongitudeProvider` などの識別子に使用 |
| `naoj` / `Naoj` / `NAOJ` | National Astronomical Observatory of Japan（国立天文台）- フィクスチャ生成スクリプト内の変数・関数名に使用 |

---

## 天文・計算用語

| 単語 | 説明 |
|------|------|
| `VSOP` / `vsop` / `Vsop` | VSOP87（惑星軌道計算理論：Variations Séculaires des Orbites Planétaires）|
| `geocenter` | 地心（geocenter）- 地球の重心。天文観測の基準点として使用（JPL Horizons の `geocenter` 設定）|
| `Sexagenary` | 六十干支（60進法による干支の循環）|
| `Coeff` | Coefficient（係数）の略語 |
| `synmonth` | 朔望月（synodic month）- 新月から次の新月までの周期 |
| `lprime` | l'（月の近点角の補正値・天文変数）|
| `mprime` | m'（月の昇交点離角の補正値・天文変数）|
| `sigmaR` | σR（天文計算における距離補正の総和変数）|
| `fplp` | ELP2000 理論における内部変数 f'l'（月の軌道計算係数）|
| `pwqw` | ELP2000 理論における内部変数（惑星摂動計算用）|
| `chuki` | 中気（二十四節気のうち、各月中央にある気）|
| `sekki` | 節気（二十四節気の総称）|
| `Reki` | 暦（カレンダー・暦法の総称）|

---

## 二十四節気（日本の旧暦・節気）

各用語はパスカルケース・キャメルケース・スネークケース・大文字定数・before/next プレフィックス付きも同様に登録。

| 単語 | 日本語 | 説明 |
|------|--------|------|
| `rissyun` / `Rissyun` / `RISSYUN` | 立春 | 二十四節気の第1節気（春の始まり）|
| `usui` / `Usui` / `USUI` | 雨水 | 二十四節気の第2節気 |
| `keichitsu` / `Keichitsu` / `KEICHITSU` | 啓蟄 | 二十四節気の第3節気 |
| `syunbun` / `Syunbun` / `SYUNBUN` | 春分 | 二十四節気の第4節気（春分の日）|
| `seimei` / `Seimei` / `SEIMEI` | 清明 | 二十四節気の第5節気 |
| `kokuu` / `Kokuu` / `KOKUU` | 穀雨 | 二十四節気の第6節気 |
| `rikka` / `Rikka` / `RIKKA` | 立夏 | 二十四節気の第7節気（夏の始まり）|
| `syouman` / `Syouman` / `SYOUMAN` | 小満 | 二十四節気の第8節気 |
| `bousyu` / `Bousyu` / `BOUSYU` | 芒種 | 二十四節気の第9節気 |
| `geshi` | 夏至 | 二十四節気の第10節気（夏至の日）|
| `syousyo` / `Syousyo` / `SYOUSYO` | 小暑 | 二十四節気の第11節気 |
| `syosyo` / `Syosyo` / `SYOSYO` | 小暑 | 小暑の別表記（コード内の異表記）|
| `taisyo` / `Taisyo` / `TAISYO` | 大暑 | 二十四節気の第12節気 |
| `rissyuu` / `Rissyuu` / `RISSYUU` | 立秋 | 二十四節気の第13節気（秋の始まり）|
| `syuubun` / `Syuubun` / `SYUUBUN` | 秋分 | 二十四節気の第16節気（秋分の日）|
| `hakuro` / `Hakuro` / `HAKURO` | 白露 | 二十四節気の第15節気 |
| `syosyo` / `Syosyo` / `SYOSYO` | 処暑 | 二十四節気の第14節気 |
| `kanro` / `Kanro` / `KANRO` | 寒露 | 二十四節気の第17節気 |
| `soukou` / `Soukou` / `SOUKOU` | 霜降 | 二十四節気の第18節気 |
| `rittou` / `Rittou` / `RITTOU` | 立冬 | 二十四節気の第19節気（冬の始まり）|
| `syousetsu` / `Syousetsu` / `SYOUSETSU` | 小雪 | 二十四節気の第20節気 |
| `taisetsu` / `Taisetsu` / `TAISETSU` | 大雪 | 二十四節気の第21節気 |
| `touji` / `Touji` / `TOUJI` | 冬至 | 二十四節気の第22節気（冬至の日）|
| `syoukan` / `Syoukan` / `SYOUKAN` | 小寒 | 二十四節気の第23節気 |
| `daikan` / `Daikan` / `DAIKAN` | 大寒 | 二十四節気の第24節気 |

### before/next プレフィックス付き（メソッド・変数名）

`beforeRissyun`, `nextRissyun`, `beforeUsui`, `nextUsui`, `beforeKeichitsu`, `nextKeichitsu`,
`beforeSyunbun`, `nextSyunbun`, `beforeSeimei`, `nextSeimei`, `beforeKokuu`, `nextKokuu`,
`beforeRikka`, `nextRikka`, `beforeSyouman`, `nextSyouman`, `beforeBousyu`, `nextBousyu`,
`beforeSyousyo`, `nextSyousyo`, `beforeSyosyo`, `nextSyosyo`, `beforeTaisyo`, `nextTaisyo`,
`beforeRissyuu`, `nextRissyuu`, `beforeSyuubun`, `nextSyuubun`, `beforeHakuro`, `nextHakuro`,
`beforeKanro`, `nextKanro`, `beforeSoukou`, `nextSoukou`, `beforeRittou`, `nextRittou`,
`beforeSyousetsu`, `nextSyousetsu`, `beforeTaisetsu`, `nextTaisetsu`, `beforeTouji`, `nextTouji`,
`beforeSyoukan`, `nextSyoukan`, `beforeDaikan`, `nextDaikan`

---

## 雑節・特別な暦日

| 単語 | 日本語 | 説明 |
|------|--------|------|
| `higan` / `Higan` / `HIGAN` | 彼岸 | 春分・秋分を中日とした前後3日間 |
| `shanichi` / `Shanichi` / `SHANICHI` | 社日 | 春分・秋分に最も近い戊の日 |
| `hachijuhachiya` / `Hachijuhachiya` / `HACHIJUHACHIYA` | 八十八夜 | 立春から88日目 |
| `nyubai` / `Nyubai` / `NYUBAI` | 入梅 | 梅雨入りの日（芒種後の壬の日）|
| `hangesho` / `Hangesho` / `HANGESHO` | 半夏生 | 夏至から11日目（七十二候の一つ）|
| `doyo` / `Doyo` / `DOYO` | 土用 | 四季各18日間の土用期間 |
| `nihyakutoka` / `Nihyakutoka` / `NIHYAKUTOKA` | 二百十日 | 立春から210日目 |
| `nihyakunijuunichi` / `Nihyakunijuunichi` / `NIHYAKUNIJUUNICHI` | 二百二十日 | 立春から220日目 |
| `gotobi` / `Gotobi` / `GOTOBI` | ゴトビ（五十日）| 5と10の付く日（決済日）|

### 関連変数名
`higanDays`, `doyoDays`, `gotobiDates`, `onlyGotobi`

---

## 七十二候（三候）

| 単語 | 日本語 | 説明 |
|------|--------|------|
| `shokou` / `Shokou` / `SHOKOU` | 初候 | 各節気の第1候（最初の5日間）|
| `jikou` / `Jikou` / `JIKOU` | 次候 | 各節気の第2候（次の5日間）|
| `makkou` / `Makkou` / `MAKKOU` | 末候 | 各節気の第3候（最後の5日間）|

---

## 六曜

| 単語 | 日本語 | 説明 |
|------|--------|------|
| `taian` / `TAIAN` | 大安 | 六曜の一つ（最も吉の日）|
| `TOMOBIKI` | 友引 | 六曜の一つ |
| `SENSYOU` | 先勝 | 六曜の一つ |
| `SENBU` | 先負 | 六曜の一つ |
| `BUTSUMETSU` | 仏滅 | 六曜の一つ |
| `SYAKKOU` | 赤口 | 六曜の一つ |

---

## 月の満ち欠け・月齢

| 単語 | 日本語 | 説明 |
|------|--------|------|
| `SHINGETSU` | 新月 | 月齢0 |
| `MIKAZUKI` | 三日月 | 月齢約3の細い月 |
| `JOUGEN` | 上弦 | 月齢約7（半月・右半分が光る）|
| `MANGETSU` | 満月 | 月齢約15 |
| `IZAYOI` | 十六夜 | 月齢約16 |
| `JUUSANYA` | 十三夜 | 月齢約13（豆名月）|
| `KAGEN` | 下弦 | 月齢約22（半月・左半分が光る）|
| `ARIAKE` | 有明月 | 夜明けに見える月 |
| `JINJITSU` | 人日 | 五節句の一つ（1月7日）|
| `CHOYO` | 重陽 | 五節句の一つ（9月9日・菊の節句）|

---

## 干支

### 十干（天干）

| 単語 | 日本語 | 説明 |
|------|--------|------|
| `KINOE` | 甲（きのえ）| 十干の第1 |
| `KINOTO` | 乙（きのと）| 十干の第2 |
| `HINOE` | 丙（ひのえ）| 十干の第3 |
| `HINOTO` | 丁（ひのと）| 十干の第4 |
| `Tsuchinoe` / `TSUCHINOE` | 戊（つちのえ）| 十干の第5 |
| `TSUCHINOTO` | 己（つちのと）| 十干の第6 |
| `KANOE` | 庚（かのえ）| 十干の第7 |
| `KANOTO` | 辛（かのと）| 十干の第8 |
| `MIZUNOE` | 壬（みずのえ）| 十干の第9 |
| `MIZUNOTO` | 癸（みずのと）| 十干の第10 |

### 十二支（地支）の一部

| 単語 | 日本語 | 説明 |
|------|--------|------|
| `USHI` | 丑（うし）| 十二支の第2 |
| `TATSU` | 辰（たつ）| 十二支の第5 |
| `HITSUJI` | 未（ひつじ）| 十二支の第8 |
| `SARU` | 申（さる）| 十二支の第9 |

---

## 元号

| 単語 | 日本語 | 説明 |
|------|--------|------|
| `REIWA` | 令和 | 第248代天皇（令和元年〜）|
| `NARUHITO` | 徳仁 | 現天皇（なるひと）|
| `TAISHO` / `TAISYO` | 大正 | 大正天皇・元号 |

---

## その他の変数・識別子

| 単語 | 説明 |
|------|------|
| `gregoriantojd` | PHP 組み込み関数 `gregoriantojd()` のスネークケース表記。グレゴリオ暦からユリウス日への変換関数名。テストメソッド名の一部として使用 |
| `roundtrip` | ラウンドトリップ（往復変換）テスト。値を変換して元に戻すと一致することを確認するパターン。テストメソッド名に使用 |
| `adate` | 和暦日付オブジェクトを表す変数名（a = aDate の略）|
| `atimestamp` | 和暦タイムスタンプを表す変数名 |
| `shiristu` | 四立（しりつ）の非標準ローマ字表記。立春・立夏・立秋・立冬の総称。変数名として使用 |
| `zasetu` | 雑節（ざせつ）のローマ字表記。国立天文台のHTML分類タイプ値として使用 |
| `phpdbg` | PHP Debug Guard（PHPの組み込みデバッガ）。`PHP_SAPI === 'phpdbg'` 判定で使用 |
| `paratest` | PHPUnit のパラレル実行ツール（vendor/bin/paratest）。テスト実行コマンドのコメント内で使用 |
| `normalizeDayTs` | タイムスタンプを日単位に正規化するメソッド名（`Ts` は timestamp の略）|
| `intval` | PHP 組み込み型変換関数。`array_map('intval', ...)` の文字列参照として使用 |
| `Yoko` / `nao` / `Nao` | `naoRekiYoko` データプロバイダ名の構成要素（横 = 暦要項横書き形式、nao = naoj の略語）|

# dictionary.xml
全て半角小文字で記載。
```xml
<component name="ProjectDictionaryState">
    <dictionary name="project">
        <words>
            <w>adate</w>
            <w>ariake</w>
            <w>atimestamp</w>
            <w>beforedaikan</w>
            <w>beforehakuro</w>
            <w>beforekanro</w>
            <w>beforekeichitsu</w>
            <w>beforekokuu</w>
            <w>beforenextrissyun</w>
            <w>beforerikka</w>
            <w>beforerissyuu</w>
            <w>beforerittou</w>
            <w>beforeseimei</w>
            <w>beforesoukou</w>
            <w>beforesyoukan</w>
            <w>beforesyouman</w>
            <w>beforesyousetsu</w>
            <w>beforesyousyo</w>
            <w>beforesyosyo</w>
            <w>beforesyunbun</w>
            <w>beforesyuubun</w>
            <w>beforetaisetsu</w>
            <w>beforetaisyo</w>
            <w>beforetouji</w>
            <w>beforeusui</w>
            <w>bousyu</w>
            <w>butsumetsu</w>
            <w>chuki</w>
            <w>choyo</w>
            <w>coeff</w>
            <w>daikan</w>
            <w>doyo</w>
            <w>doyodays</w>
            <w>espenak</w>
            <w>fplp</w>
            <w>geocenter</w>
            <w>geshi</w>
            <w>gotobi</w>
            <w>gotobidates</w>
            <w>gregoriantojd</w>
            <w>hachijuhachiya</w>
            <w>hakuro</w>
            <w>hangesho</w>
            <w>higan</w>
            <w>higandays</w>
            <w>hinoe</w>
            <w>hinoto</w>
            <w>hitsuji</w>
            <w>horner</w>
            <w>intval</w>
            <w>izayoi</w>
            <w>jikou</w>
            <w>jinjitsu</w>
            <w>jougen</w>
            <w>jpl</w>
            <w>juusanya</w>
            <w>kagen</w>
            <w>kanoe</w>
            <w>kanro</w>
            <w>kanoto</w>
            <w>keichitsu</w>
            <w>kinoe</w>
            <w>kinoto</w>
            <w>kokuu</w>
            <w>lprime</w>
            <w>makkou</w>
            <w>mangetsu</w>
            <w>meeus</w>
            <w>meeusmoon</w>
            <w>meeusmoonage</w>
            <w>mikazuki</w>
            <w>mizunoe</w>
            <w>mizunoto</w>
            <w>mprime</w>
            <w>nao</w>
            <w>naoj</w>
            <w>naruhito</w>
            <w>nextdaikan</w>
            <w>nexthakuro</w>
            <w>nextkanro</w>
            <w>nextkeichitsu</w>
            <w>nextkokuu</w>
            <w>nextrissyun</w>
            <w>nextrikka</w>
            <w>nextrissyuu</w>
            <w>nextrittou</w>
            <w>nextseimei</w>
            <w>nextsoukou</w>
            <w>nextsyoukan</w>
            <w>nextsyouman</w>
            <w>nextsyousetsu</w>
            <w>nextsyousyo</w>
            <w>nextsyosyo</w>
            <w>nextsyunbun</w>
            <w>nextsyuubun</w>
            <w>nexttaisetsu</w>
            <w>nexttaisyo</w>
            <w>nexttouji</w>
            <w>nextusui</w>
            <w>nihyakunijuunichi</w>
            <w>nihyakutoka</w>
            <w>normalizedayts</w>
            <w>nyubai</w>
            <w>onlygotobi</w>
            <w>paratest</w>
            <w>phpdbg</w>
            <w>pwqw</w>
            <w>reiwa</w>
            <w>reki</w>
            <w>rikka</w>
            <w>rissyun</w>
            <w>rissyuu</w>
            <w>rittou</w>
            <w>roundtrip</w>
            <w>saru</w>
            <w>seimei</w>
            <w>sekki</w>
            <w>senbu</w>
            <w>sensyou</w>
            <w>sexagenary</w>
            <w>shanichi</w>
            <w>shingetsu</w>
            <w>shiristu</w>
            <w>shokou</w>
            <w>sigmar</w>
            <w>soukou</w>
            <w>suzunone</w>
            <w>syakkou</w>
            <w>synmonth</w>
            <w>syoukan</w>
            <w>syouman</w>
            <w>syousetsu</w>
            <w>syousyo</w>
            <w>syosyo</w>
            <w>syunbun</w>
            <w>syuubun</w>
            <w>taian</w>
            <w>taisho</w>
            <w>taisetsu</w>
            <w>taisyo</w>
            <w>tatsu</w>
            <w>tomobiki</w>
            <w>touji</w>
            <w>tsuchinoe</w>
            <w>tsuchinoto</w>
            <w>ushi</w>
            <w>usno</w>
            <w>usui</w>
            <w>vsop</w>
            <w>yoko</w>
            <w>zasetu</w>
        </words>
    </dictionary>
</component>
```
