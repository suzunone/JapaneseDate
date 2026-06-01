# DateTime

**Namespace:** `JapaneseDate`

class **DateTime** extends [Carbon](../Carbon/Carbon.md) implements [DateTimeInterface](../JapaneseDate/DateTimeInterface.md)

日本の暦（国民の祝日・元号・六曜・二十四節気・旧暦）に完全対応した可変（ミュータブル）日時クラス。

日時操作ライブラリ [\Carbon\Carbon](../Carbon/Carbon.html) を継承しており、Carbon および PHP 標準
[DateTime](https://www.php.net/DateTime) が持つすべてのメソッド・プロパティをそのまま利用できます。
加えて、日本のビジネス実務や伝統的な暦の計算に必要な機能を透過的に追加しています。

**主な拡張機能:**

1. **国民の祝日・休日判定**
   - 昭和23年（1948年）の祝日法施行以降の全祝日に対応。
   - 振替休日・国民の休日・特殊な一回限りの祝日（皇室の儀式・オリンピック等）を自動計算。
   - `$date->holiday` → 祝日定数（int）、`$date->holidayText` → 祝日名（string）
   - `$date->is_holiday` → 祝日であれば true

2. **元号（和暦）変換**
   - 明治（1868〜）・大正・昭和・平成・令和（2019〜）に対応。
   - `$date->eraName` → 元号定数（int）、`$date->eraNameText` → 「令和」など（string）
   - `$date->eraYear` → 元号年（例: 令和8年なら 8）

3. **六曜の算出**
   - 旧暦（太陰太陽暦）に基づく大安・仏滅・先勝・友引・先負・赤口の判定。
   - `$date->sixWeekday` → 六曜定数（int）、`$date->sixWeekdayText` → 「大安」など

4. **二十四節気**
   - 天文学的計算（太陽黄経15度ごと）に基づく立春・夏至・秋分・冬至など全24節気の判定。
   - `$date->solarTerm` → 節気定数または false、`$date->solarTermText` → 節気名
   - 各節気の日付取得: `$date->nextSyunbun`（次の春分）など

5. **旧暦・月相**
   - `$date->lunarMonth` → 旧暦月（int）、`$date->lunarDay` → 旧暦日（int）
   - `$date->moonPhase` → 月相定数（int）、`$date->moonPhaseText` → 「新月」など

6. **干支（かんし）**
   - 十二支: `$date->orientalZodiac` → 定数、`$date->orientalZodiacText` → 「午」など
   - 十干: `$date->heavenlyStem` → 定数、`$date->heavenlyStemText` → 「丙」など

**イミュータブル版が必要な場合は {\JapaneseDate\DateTimeImmutable} を使用してください。**

**使用例:**
```php
use JapaneseDate\DateTime;

$date = DateTime::parse('2026-05-03');
echo $date->holidayText;      // 憲法記念日
echo $date->eraNameText;      // 令和
echo $date->eraYear;          // 8
echo $date->sixWeekdayText;   // 大安・先勝 etc.
echo $date->solarTermText;    // 節気名（節気の日以外は空文字列）

// 次の祝日に移動する
$nextHoliday = DateTime::now()->nextHoliday();
echo $nextHoliday->format('Y-m-d') . ' ' . $nextHoliday->holidayText;
```

## Traits

- Date

## Constants

| Modifier | Name | Description |
|---|---|---|
| public | `NO_HOLIDAY` | 祝日定数: 非祝日（祝日でない通常の日）。 |
| public | `NEW_YEAR_S_DAY` | 祝日定数:元旦 |
| public | `COMING_OF_AGE_DAY` | 祝日定数:成人の日 |
| public | `NATIONAL_FOUNDATION_DAY` | 祝日定数:建国記念の日 |
| public | `THE_SHOWA_EMPEROR_DIED` | 祝日定数:昭和天皇の大喪の礼 |
| public | `VERNAL_EQUINOX_DAY` | 祝日定数:春分の日 |
| public | `DAY_OF_SHOWA` | 祝日定数:昭和の日 |
| public | `GREENERY_DAY` | 祝日定数:みどりの日 |
| public | `THE_EMPEROR_S_BIRTHDAY` | 祝日定数:天皇誕生日 |
| public | `CROWN_PRINCE_HIROHITO_WEDDING` | 祝日定数:皇太子明仁親王の結婚の儀 |
| public | `CONSTITUTION_DAY` | 祝日定数:憲法記念日 |
| public | `NATIONAL_HOLIDAY` | 祝日定数:国民の休日 |
| public | `CHILDREN_S_DAY` | 祝日定数:こどもの日 |
| public | `COMPENSATING_HOLIDAY` | 祝日定数:振替休日 |
| public | `CROWN_PRINCE_NARUHITO_WEDDING` | 祝日定数:皇太子徳仁親王の結婚の儀 |
| public | `MARINE_DAY` | 祝日定数:海の日 |
| public | `AUTUMNAL_EQUINOX_DAY` | 祝日定数:秋分の日 |
| public | `RESPECT_FOR_SENIOR_CITIZENS_DAY` | 祝日定数:敬老の日 |
| public | `LEGACY_SPORTS_DAY` | 祝日定数:体育の日 |
| public | `CULTURE_DAY` | 祝日定数:文化の日 |
| public | `LABOR_THANKSGIVING_DAY` | 祝日定数:勤労感謝の日 |
| public | `REGNAL_DAY` | 祝日定数:即位礼正殿の儀 |
| public | `MOUNTAIN_DAY` | 祝日定数:山の日 |
| public | `EMPERORS_THRONE_DAY` | 祝日定数:天皇の即位の日 |
| public | `SPORTS_DAY` | 祝日定数:スポーツの日 |
| public | `HOLIDAY_START_YEAR` | 祝日法制定年 |
| public | `SECOND_TIME_TOKYO_OLYMPIC_YEAR` | 二回目の東京オリンピックの年 |
| public | `SECOND_TIME_TOKYO_OLYMPIC_RESCHEDULE_YEAR` | 二回目の東京オリンピックの年(リスケ) |
| public | `VERNAL_EQUINOX_DAY_MONTH` | 特定月定数:春分の日 |
| public | `AUTUMNAL_EQUINOX_DAY_MONTH` | 特定月定数:秋分の日 |
| public | `SUNDAY` | 曜日定数:日 |
| public | `MONDAY` | 曜日定数:月 |
| public | `TUESDAY` | 曜日定数:火 |
| public | `WEDNESDAY` | 曜日定数:水 |
| public | `THURSDAY` | 曜日定数:木 |
| public | `FRIDAY` | 曜日定数:金 |
| public | `SATURDAY` | 曜日定数:土 |
| public | `SIX_WEEKDAY_TAIAN` | 六曜定数:大安 |
| public | `SIX_WEEKDAY_SYAKKOU` | 六曜定数:赤口 |
| public | `SIX_WEEKDAY_SENSYOU` | 六曜定数:先勝 |
| public | `SIX_WEEKDAY_TOMOBIKI` | 六曜定数:友引 |
| public | `SIX_WEEKDAY_SENBU` | 六曜定数:先負 |
| public | `SIX_WEEKDAY_BUTSUMETSU` | 六曜定数:仏滅 |
| public | `MOON_PHASE_SHINGETSU` | 月相定数:新月 |
| public | `MOON_PHASE_MIKAZUKI` | 月相定数:三日月 |
| public | `MOON_PHASE_JOUGEN` | 月相定数:上弦 |
| public | `MOON_PHASE_JUUSANYA` | 月相定数:十三夜 |
| public | `MOON_PHASE_MANGETSU` | 月相定数:満月 |
| public | `MOON_PHASE_IZAYOI` | 月相定数:十六夜 |
| public | `MOON_PHASE_KAGEN` | 月相定数:下弦 |
| public | `MOON_PHASE_ARIAKE` | 月相定数:有明 |
| public | `ERA_MEIJI` | 元号定数: 明治（1868年1月25日〜1912年7月29日）。 |
| public | `ERA_TAISHO` | 元号定数: 大正（1912年7月30日〜1926年12月24日）。 |
| public | `ERA_SHOWA` | 元号定数: 昭和（1926年12月25日〜1989年1月7日）。 |
| public | `ERA_HEISEI` | 元号定数: 平成（1989年1月8日〜2019年4月30日）。 |
| public _(deprecated)_ | `ERA_HEISEI_NEXT` | 元号定数: 令和（旧称 ERA_REIWA）の非推奨エイリアス。 |
| public | `ERA_REIWA` | 元号定数: 令和（2019年5月1日〜）。 |
| public | `SOLAR_TERM_SYUNBUN` | 24節気定数:春分 |
| public | `SOLAR_TERM_SEIMEI` | 24節気定数:清明 |
| public | `SOLAR_TERM_KOKUU` | 24節気定数:穀雨 |
| public | `SOLAR_TERM_RIKKA` | 24節気定数:立夏 |
| public | `SOLAR_TERM_SYOUMAN` | 24節気定数:小満 |
| public | `SOLAR_TERM_BOUSYU` | 24節気定数:芒種 |
| public | `SOLAR_TERM_GESHI` | 24節気定数:夏至 |
| public | `SOLAR_TERM_SYOUSYO` | 24節気定数:小暑 |
| public | `SOLAR_TERM_TAISYO` | 24節気定数:大暑 |
| public | `SOLAR_TERM_RISSYUU` | 24節気定数:立秋 |
| public | `SOLAR_TERM_SYOSYO` | 24節気定数:処暑 |
| public | `SOLAR_TERM_HAKURO` | 24節気定数:白露 |
| public | `SOLAR_TERM_SYUUBUN` | 24節気定数:秋分 |
| public | `SOLAR_TERM_KANRO` | 24節気定数:寒露 |
| public | `SOLAR_TERM_SOUKOU` | 24節気定数:霜降 |
| public | `SOLAR_TERM_RITTOU` | 24節気定数:立冬 |
| public | `SOLAR_TERM_SYOUSETSU` | 24節気定数:小雪 |
| public | `SOLAR_TERM_TAISETSU` | 24節気定数:大雪 |
| public | `SOLAR_TERM_TOUJI` | 24節気定数:冬至 |
| public | `SOLAR_TERM_SYOUKAN` | 24節気定数:小寒 |
| public | `SOLAR_TERM_DAIKAN` | 24節気定数:大寒 |
| public | `SOLAR_TERM_RISSYUN` | 24節気定数:立春 |
| public | `SOLAR_TERM_USUI` | 24節気定数:雨水 |
| public | `SOLAR_TERM_KEICHITSU` | 24節気定数:啓蟄 |
| public | `ORIENTAL_ZODIAC_I` | 十二支定数:亥 |
| public | `ORIENTAL_ZODIAC_NE` | 十二支定数:子 |
| public | `ORIENTAL_ZODIAC_USHI` | 十二支定数:丑 |
| public | `ORIENTAL_ZODIAC_TORA` | 十二支定数:寅 |
| public | `ORIENTAL_ZODIAC_U` | 十二支定数:卯 |
| public | `ORIENTAL_ZODIAC_TATSU` | 十二支定数:辰 |
| public | `ORIENTAL_ZODIAC_MI` | 十二支定数:巳 |
| public | `ORIENTAL_ZODIAC_UMA` | 十二支定数:午 |
| public | `ORIENTAL_ZODIAC_HITSUJI` | 十二支定数:未 |
| public | `ORIENTAL_ZODIAC_SARU` | 十二支定数:申 |
| public | `ORIENTAL_ZODIAC_TORI` | 十二支定数:酉 |
| public | `ORIENTAL_ZODIAC_INU` | 十二支定数:戌 |
| public | `HEAVENLY_STEM_KINOE` | 十干定数:甲 (きのえ) |
| public | `HEAVENLY_STEM_KINOTO` | 十干定数:乙 (きのと) |
| public | `HEAVENLY_STEM_HINOE` | 十干定数:丙 (ひのえ) |
| public | `HEAVENLY_STEM_HINOTO` | 十干定数:丁 (ひのと) |
| public | `HEAVENLY_STEM_TSUCHINOE` | 十干定数:戊 (つちのえ) |
| public | `HEAVENLY_STEM_TSUCHINOTO` | 十干定数:己 (つちのと) |
| public | `HEAVENLY_STEM_KANOE` | 十干定数:庚 (かのえ) |
| public | `HEAVENLY_STEM_KANOTO` | 十干定数:辛 (かのと) |
| public | `HEAVENLY_STEM_MIZUNOE` | 十干定数:壬 (みずのえ) |
| public | `HEAVENLY_STEM_MIZUNOTO` | 十干定数:癸 (みずのと) |
| public | `MISC_SEASONAL_NODE_NONE` | 雑節定数: 雑節に該当しない通常の日。 |
| public | `MISC_SEASONAL_NODE_SETSUBUN` | 雑節定数: 節分（立春の前日）。 |
| public | `MISC_SEASONAL_NODE_HIGAN` | 雑節定数: 彼岸（春分・秋分を中日とした前後3日間、計7日）。 |
| public | `MISC_SEASONAL_NODE_SHANICHI` | 雑節定数: 社日（春分・秋分に最も近い戊〈つちのえ〉の日）。 |
| public | `MISC_SEASONAL_NODE_HACHIJUHACHIYA` | 雑節定数: 八十八夜（立春から数えて88日目）。 |
| public | `MISC_SEASONAL_NODE_NYUBAI` | 雑節定数: 入梅（太陽黄経80°）。 |
| public | `MISC_SEASONAL_NODE_HANGESHO` | 雑節定数: 半夏生（太陽黄経100°）。 |
| public | `MISC_SEASONAL_NODE_DOYO` | 雑節定数: 土用（立春・立夏・立秋・立冬の各18日前から節気前日まで）。 |
| public | `MISC_SEASONAL_NODE_NIHYAKUTOKA` | 雑節定数: 二百十日（立春から数えて210日目）。 |
| public | `MISC_SEASONAL_NODE_NIHYAKUNIJUUNICHI` | 雑節定数: 二百二十日（立春から数えて220日目）。 |
| public | `SEASONAL_FESTIVAL_NONE` | 五節句定数: 五節句に該当しない通常の日。 |
| public | `SEASONAL_FESTIVAL_JINJITSU` | 五節句定数: 人日の節句（1月7日 / 旧暦1月7日）。 |
| public | `SEASONAL_FESTIVAL_JOSHI` | 五節句定数: 上巳の節句（3月3日 / 旧暦3月3日）。 |
| public | `SEASONAL_FESTIVAL_TANGO` | 五節句定数: 端午の節句（5月5日 / 旧暦5月5日）。 |
| public | `SEASONAL_FESTIVAL_TANABATA` | 五節句定数: 七夕の節句（7月7日 / 旧暦7月7日）。 |
| public | `SEASONAL_FESTIVAL_CHOYO` | 五節句定数: 重陽の節句（9月9日 / 旧暦9月9日）。 |
| public | `SEVENTY_TWO_KOU_RISSHUN_SHOKOU` | 七十二候定数: 立春・初候（1候）
名称: 東風凍を解く / 読み: はるかぜ こおりをとく |
| public | `SEVENTY_TWO_KOU_RISSHUN_JIKOU` | 七十二候定数: 立春・次候（2候）
名称: うぐいす鳴く / 読み: うぐいす なく |
| public | `SEVENTY_TWO_KOU_RISSHUN_MAKKOU` | 七十二候定数: 立春・末候（3候）
名称: 魚氷を上る / 読み: うお こおりをいずる |
| public | `SEVENTY_TWO_KOU_USUI_SHOKOU` | 七十二候定数: 雨水・初候（4候）
名称: 土脉潤い起こる / 読み: つちのしょう うるおいおこる |
| public | `SEVENTY_TWO_KOU_USUI_JIKOU` | 七十二候定数: 雨水・次候（5候）
名称: 霞始めてたなびく / 読み: かすみはじめてたなびく |
| public | `SEVENTY_TWO_KOU_USUI_MAKKOU` | 七十二候定数: 雨水・末候（6候）
名称: 草木萌え動る / 読み: そうもく めばえいずる |
| public | `SEVENTY_TWO_KOU_KEICHITSU_SHOKOU` | 七十二候定数: 啓蟄・初候（7候）
名称: すごもりの虫戸を開く / 読み: すごもりむし とをひらく |
| public | `SEVENTY_TWO_KOU_KEICHITSU_JIKOU` | 七十二候定数: 啓蟄・次候（8候）
名称: 桃始めてさく / 読み: もも はじめてさく |
| public | `SEVENTY_TWO_KOU_KEICHITSU_MAKKOU` | 七十二候定数: 啓蟄・末候（9候）
名称: 菜虫蝶となる / 読み: なむし ちょうとなる |
| public | `SEVENTY_TWO_KOU_SYUNBUN_SHOKOU` | 七十二候定数: 春分・初候（10候）
名称: 雀始めて巣くう / 読み: すずめ はじめてすくう |
| public | `SEVENTY_TWO_KOU_SYUNBUN_JIKOU` | 七十二候定数: 春分・次候（11候）
名称: 桜始めて開く / 読み: さくら はじめてひらく |
| public | `SEVENTY_TWO_KOU_SYUNBUN_MAKKOU` | 七十二候定数: 春分・末候（12候）
名称: 雷乃ち声を発す / 読み: かみなりすなわち こえをはっす |
| public | `SEVENTY_TWO_KOU_SEIMEI_SHOKOU` | 七十二候定数: 清明・初候（13候）
名称: 玄鳥至る / 読み: つばめ いたる |
| public | `SEVENTY_TWO_KOU_SEIMEI_JIKOU` | 七十二候定数: 清明・次候（14候）
名称: 鴻雁かえる / 読み: こうがん かえる |
| public | `SEVENTY_TWO_KOU_SEIMEI_MAKKOU` | 七十二候定数: 清明・末候（15候）
名称: 虹始めてあらわる / 読み: にじ はじめてあらわる |
| public | `SEVENTY_TWO_KOU_KOKUU_SHOKOU` | 七十二候定数: 穀雨・初候（16候）
名称: 葭始めて生ず / 読み: あし はじめてしょうず |
| public | `SEVENTY_TWO_KOU_KOKUU_JIKOU` | 七十二候定数: 穀雨・次候（17候）
名称: 霜止で苗出ずる / 読み: しもやんで なえいずる |
| public | `SEVENTY_TWO_KOU_KOKUU_MAKKOU` | 七十二候定数: 穀雨・末候（18候）
名称: 牡丹はなさく / 読み: ぼたん はなさく |
| public | `SEVENTY_TWO_KOU_RIKKA_SHOKOU` | 七十二候定数: 立夏・初候（19候）
名称: 蛙始めて鳴く / 読み: かわず はじめてなく |
| public | `SEVENTY_TWO_KOU_RIKKA_JIKOU` | 七十二候定数: 立夏・次候（20候）
名称: みみず出ずる / 読み: みみず いずる |
| public | `SEVENTY_TWO_KOU_RIKKA_MAKKOU` | 七十二候定数: 立夏・末候（21候）
名称: 竹のこ生ず / 読み: たけのこ しょうず |
| public | `SEVENTY_TWO_KOU_SYOUMAN_SHOKOU` | 七十二候定数: 小満・初候（22候）
名称: 蚕起きて桑を食む / 読み: かいこおきて くわをはむ |
| public | `SEVENTY_TWO_KOU_SYOUMAN_JIKOU` | 七十二候定数: 小満・次候（23候）
名称: 紅花栄う / 読み: べにばな さかう |
| public | `SEVENTY_TWO_KOU_SYOUMAN_MAKKOU` | 七十二候定数: 小満・末候（24候）
名称: 麦秋至る / 読み: むぎのとき いたる |
| public | `SEVENTY_TWO_KOU_BOUSYU_SHOKOU` | 七十二候定数: 芒種・初候（25候）
名称: 蟷螂生ず / 読み: かまきり しょうず |
| public | `SEVENTY_TWO_KOU_BOUSYU_JIKOU` | 七十二候定数: 芒種・次候（26候）
名称: 腐れたる草蛍となる / 読み: くされたるくさ ほたるとなる |
| public | `SEVENTY_TWO_KOU_BOUSYU_MAKKOU` | 七十二候定数: 芒種・末候（27候）
名称: 梅のみ黄ばむ / 読み: うめのみ きばむ |
| public | `SEVENTY_TWO_KOU_GESHI_SHOKOU` | 七十二候定数: 夏至・初候（28候）
名称: 乃東枯る / 読み: なつかれくさ かるる |
| public | `SEVENTY_TWO_KOU_GESHI_JIKOU` | 七十二候定数: 夏至・次候（29候）
名称: 菖蒲はなさく / 読み: あやめ はなさく |
| public | `SEVENTY_TWO_KOU_GESHI_MAKKOU` | 七十二候定数: 夏至・末候（30候）
名称: 半夏生ず / 読み: はんげ しょうず |
| public | `SEVENTY_TWO_KOU_SYOUSYO_SHOKOU` | 七十二候定数: 小暑・初候（31候）
名称: 温風至る / 読み: あつかぜ いたる |
| public | `SEVENTY_TWO_KOU_SYOUSYO_JIKOU` | 七十二候定数: 小暑・次候（32候）
名称: 蓮始めて開く / 読み: はす はじめてひらく |
| public | `SEVENTY_TWO_KOU_SYOUSYO_MAKKOU` | 七十二候定数: 小暑・末候（33候）
名称: 鷹乃ちわざをならう / 読み: たかすなわち わざをならう |
| public | `SEVENTY_TWO_KOU_TAISYO_SHOKOU` | 七十二候定数: 大暑・初候（34候）
名称: 桐始めて花を結ぶ / 読み: きりはじめて はなをむすぶ |
| public | `SEVENTY_TWO_KOU_TAISYO_JIKOU` | 七十二候定数: 大暑・次候（35候）
名称: 土潤いてむし暑し / 読み: つちうるおいて むしあつし |
| public | `SEVENTY_TWO_KOU_TAISYO_MAKKOU` | 七十二候定数: 大暑・末候（36候）
名称: 大雨時々に降る / 読み: たいう ときどきにふる |
| public | `SEVENTY_TWO_KOU_RISSYUU_SHOKOU` | 七十二候定数: 立秋・初候（37候）
名称: 涼風至る / 読み: すずかぜ いたる |
| public | `SEVENTY_TWO_KOU_RISSYUU_JIKOU` | 七十二候定数: 立秋・次候（38候）
名称: 寒蝉鳴く / 読み: ひぐらし なく |
| public | `SEVENTY_TWO_KOU_RISSYUU_MAKKOU` | 七十二候定数: 立秋・末候（39候）
名称: 深き霧まとう / 読み: ふかききり まとう |
| public | `SEVENTY_TWO_KOU_SYOSYO_SHOKOU` | 七十二候定数: 処暑・初候（40候）
名称: 綿のはなしべ開く / 読み: わたの はなしべひらく |
| public | `SEVENTY_TWO_KOU_SYOSYO_JIKOU` | 七十二候定数: 処暑・次候（41候）
名称: 天地始めてさむし / 読み: てんち はじめてさむし |
| public | `SEVENTY_TWO_KOU_SYOSYO_MAKKOU` | 七十二候定数: 処暑・末候（42候）
名称: 禾乃ちみのる / 読み: こくもの すなわちみのる |
| public | `SEVENTY_TWO_KOU_HAKURO_SHOKOU` | 七十二候定数: 白露・初候（43候）
名称: 草露白し / 読み: くさつゆ しろし |
| public | `SEVENTY_TWO_KOU_HAKURO_JIKOU` | 七十二候定数: 白露・次候（44候）
名称: 鶺鴒鳴く / 読み: せきれい なく |
| public | `SEVENTY_TWO_KOU_HAKURO_MAKKOU` | 七十二候定数: 白露・末候（45候）
名称: 玄鳥去る / 読み: つばめ さる |
| public | `SEVENTY_TWO_KOU_SYUUBUN_SHOKOU` | 七十二候定数: 秋分・初候（46候）
名称: 雷乃ち声を収む / 読み: かみなりすなわち こえをおさむ |
| public | `SEVENTY_TWO_KOU_SYUUBUN_JIKOU` | 七十二候定数: 秋分・次候（47候）
名称: 虫かくれて戸をふさぐ / 読み: むしかくれて とをふさぐ |
| public | `SEVENTY_TWO_KOU_SYUUBUN_MAKKOU` | 七十二候定数: 秋分・末候（48候）
名称: 水始めて涸る / 読み: みず はじめてかるる |
| public | `SEVENTY_TWO_KOU_KANRO_SHOKOU` | 七十二候定数: 寒露・初候（49候）
名称: 鴻雁来る / 読み: こうがん きたる |
| public | `SEVENTY_TWO_KOU_KANRO_JIKOU` | 七十二候定数: 寒露・次候（50候）
名称: 菊花開く / 読み: きくのはな ひらく |
| public | `SEVENTY_TWO_KOU_KANRO_MAKKOU` | 七十二候定数: 寒露・末候（51候）
名称: 蟋蟀戸にあり / 読み: きりぎりす とにあり |
| public | `SEVENTY_TWO_KOU_SOUKOU_SHOKOU` | 七十二候定数: 霜降・初候（52候）
名称: 霜始めて降る / 読み: しも はじめてふる |
| public | `SEVENTY_TWO_KOU_SOUKOU_JIKOU` | 七十二候定数: 霜降・次候（53候）
名称: 小雨ときどきふる / 読み: こさめ ときどきふる |
| public | `SEVENTY_TWO_KOU_SOUKOU_MAKKOU` | 七十二候定数: 霜降・末候（54候）
名称: 楓蔦黄ばむ / 読み: もみじつた きばむ |
| public | `SEVENTY_TWO_KOU_RITTOU_SHOKOU` | 七十二候定数: 立冬・初候（55候）
名称: 山茶始めて開く / 読み: つばき はじめてひらく |
| public | `SEVENTY_TWO_KOU_RITTOU_JIKOU` | 七十二候定数: 立冬・次候（56候）
名称: 地始めて凍る / 読み: ち はじめてこおる |
| public | `SEVENTY_TWO_KOU_RITTOU_MAKKOU` | 七十二候定数: 立冬・末候（57候）
名称: 金盞香 / 読み: きんせんか さく |
| public | `SEVENTY_TWO_KOU_SYOUSETSU_SHOKOU` | 七十二候定数: 小雪・初候（58候）
名称: 虹かくれて見えず / 読み: にじ かくれてみえず |
| public | `SEVENTY_TWO_KOU_SYOUSETSU_JIKOU` | 七十二候定数: 小雪・次候（59候）
名称: 朔風葉を払う / 読み: きたかぜ このはをはらう |
| public | `SEVENTY_TWO_KOU_SYOUSETSU_MAKKOU` | 七十二候定数: 小雪・末候（60候）
名称: 橘始めて黄ばむ / 読み: たちばな はじめてきばむ |
| public | `SEVENTY_TWO_KOU_TAISETSU_SHOKOU` | 七十二候定数: 大雪・初候（61候）
名称: 閉塞冬となる / 読み: そらさむく ふゆとなる |
| public | `SEVENTY_TWO_KOU_TAISETSU_JIKOU` | 七十二候定数: 大雪・次候（62候）
名称: 熊穴にこもる / 読み: くま あなにこもる |
| public | `SEVENTY_TWO_KOU_TAISETSU_MAKKOU` | 七十二候定数: 大雪・末候（63候）
名称: さけの魚群がる / 読み: さけのうお むらがる |
| public | `SEVENTY_TWO_KOU_TOUJI_SHOKOU` | 七十二候定数: 冬至・初候（64候）
名称: 乃東生ず / 読み: なつかれくさ しょうず |
| public | `SEVENTY_TWO_KOU_TOUJI_JIKOU` | 七十二候定数: 冬至・次候（65候）
名称: さわしかの角おつる / 読み: さわしかのつの おつる |
| public | `SEVENTY_TWO_KOU_TOUJI_MAKKOU` | 七十二候定数: 冬至・末候（66候）
名称: 雪下りて麦のびる / 読み: ゆきくだりて むぎのびる |
| public | `SEVENTY_TWO_KOU_SYOUKAN_SHOKOU` | 七十二候定数: 小寒・初候（67候）
名称: 芹乃ち栄う / 読み: せりすなわち さかう |
| public | `SEVENTY_TWO_KOU_SYOUKAN_JIKOU` | 七十二候定数: 小寒・次候（68候）
名称: 泉水温をふくむ / 読み: しみず あたたかをふくむ |
| public | `SEVENTY_TWO_KOU_SYOUKAN_MAKKOU` | 七十二候定数: 小寒・末候（69候）
名称: 雉始めてなく / 読み: きじ はじめてなく |
| public | `SEVENTY_TWO_KOU_DAIKAN_SHOKOU` | 七十二候定数: 大寒・初候（70候）
名称: 款冬華く / 読み: ふきの はなさく |
| public | `SEVENTY_TWO_KOU_DAIKAN_JIKOU` | 七十二候定数: 大寒・次候（71候）
名称: 水沢氷つめる / 読み: さわみず こおりつめる |
| public | `SEVENTY_TWO_KOU_DAIKAN_MAKKOU` | 七十二候定数: 大寒・末候（72候）
名称: 鶏始めてとやにつく / 読み: にわとり はじめてとやにつく |
| public | `COURT_NORTH` | 南北朝時代： 北朝 |
| public | `COURT_SOUTH` | 南北朝時代： 南朝 |
| public | `COURT_MAIN` | 南北朝時代以外及び南北朝時代の両朝を指す場合 |

## Properties

| Modifier | Type | Name | Description |
|---|---|---|---|
| public | string | `$localeDayOfWeek` _(from [Carbon](../Carbon/Carbon.md))_ | the day of week in current locale |
| public | string | `$shortLocaleDayOfWeek` _(from [Carbon](../Carbon/Carbon.md))_ | the abbreviated day of week in current locale |
| public | string | `$localeMonth` _(from [Carbon](../Carbon/Carbon.md))_ | the month in current locale |
| public | string | `$shortLocaleMonth` _(from [Carbon](../Carbon/Carbon.md))_ | the abbreviated month in current locale |
| public | int | `$year` _(from [Carbon](../Carbon/Carbon.md))_ |  |
| public | int | `$yearIso` _(from [Carbon](../Carbon/Carbon.md))_ |  |
| public | int | `$month` _(from [Carbon](../Carbon/Carbon.md))_ |  |
| public | int | `$day` _(from [Carbon](../Carbon/Carbon.md))_ |  |
| public | int | `$hour` _(from [Carbon](../Carbon/Carbon.md))_ |  |
| public | int | `$minute` _(from [Carbon](../Carbon/Carbon.md))_ |  |
| public | int | `$second` _(from [Carbon](../Carbon/Carbon.md))_ |  |
| public | int | `$micro` _(from [Carbon](../Carbon/Carbon.md))_ |  |
| public | int | `$microsecond` _(from [Carbon](../Carbon/Carbon.md))_ |  |
| public | int | `$dayOfWeekIso` _(from [Carbon](../Carbon/Carbon.md))_ | 1 (for Monday) through 7 (for Sunday) |
| public | int\|float\|string | `$timestamp` _(from [Carbon](../Carbon/Carbon.md))_ | seconds since the Unix Epoch |
| public | string | `$englishDayOfWeek` _(from [Carbon](../Carbon/Carbon.md))_ | the day of week in English |
| public | string | `$shortEnglishDayOfWeek` _(from [Carbon](../Carbon/Carbon.md))_ | the abbreviated day of week in English |
| public | string | `$englishMonth` _(from [Carbon](../Carbon/Carbon.md))_ | the month in English |
| public | string | `$shortEnglishMonth` _(from [Carbon](../Carbon/Carbon.md))_ | the abbreviated month in English |
| public | int | `$milliseconds` _(from [Carbon](../Carbon/Carbon.md))_ |  |
| public | int | `$millisecond` _(from [Carbon](../Carbon/Carbon.md))_ |  |
| public | int | `$milli` _(from [Carbon](../Carbon/Carbon.md))_ |  |
| public | int | `$week` _(from [Carbon](../Carbon/Carbon.md))_ | 1 through 53 |
| public | int | `$isoWeek` _(from [Carbon](../Carbon/Carbon.md))_ | 1 through 53 |
| public | int | `$weekYear` _(from [Carbon](../Carbon/Carbon.md))_ | year according to week format |
| public | int | `$isoWeekYear` _(from [Carbon](../Carbon/Carbon.md))_ | year according to ISO week format |
| public | int | `$age` _(from [Carbon](../Carbon/Carbon.md))_ | does a diffInYears() with default parameters |
| public | int | `$offset` _(from [Carbon](../Carbon/Carbon.md))_ | the timezone offset in seconds from UTC |
| public | int | `$offsetMinutes` _(from [Carbon](../Carbon/Carbon.md))_ | the timezone offset in minutes from UTC |
| public | int | `$offsetHours` _(from [Carbon](../Carbon/Carbon.md))_ | the timezone offset in hours from UTC |
| public | CarbonTimeZone | `$timezone` _(from [Carbon](../Carbon/Carbon.md))_ | the current timezone |
| public | CarbonTimeZone | `$tz` _(from [Carbon](../Carbon/Carbon.md))_ | alias of $timezone |
| public | int | `$centuryOfMillennium` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the century starting from the beginning of the current millennium |
| public | int | `$dayOfCentury` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the day starting from the beginning of the current century |
| public | int | `$dayOfDecade` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the day starting from the beginning of the current decade |
| public | int | `$dayOfMillennium` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the day starting from the beginning of the current millennium |
| public | int | `$dayOfMonth` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the day starting from the beginning of the current month |
| public | int | `$dayOfQuarter` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the day starting from the beginning of the current quarter |
| public | int | `$dayOfWeek` _(from [Carbon](../Carbon/Carbon.md))_ | 0 (for Sunday) through 6 (for Saturday) |
| public | int | `$dayOfYear` _(from [Carbon](../Carbon/Carbon.md))_ | 1 through 366 |
| public | int | `$decadeOfCentury` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the decade starting from the beginning of the current century |
| public | int | `$decadeOfMillennium` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the decade starting from the beginning of the current millennium |
| public | int | `$hourOfCentury` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the hour starting from the beginning of the current century |
| public | int | `$hourOfDay` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the hour starting from the beginning of the current day |
| public | int | `$hourOfDecade` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the hour starting from the beginning of the current decade |
| public | int | `$hourOfMillennium` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the hour starting from the beginning of the current millennium |
| public | int | `$hourOfMonth` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the hour starting from the beginning of the current month |
| public | int | `$hourOfQuarter` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the hour starting from the beginning of the current quarter |
| public | int | `$hourOfWeek` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the hour starting from the beginning of the current week |
| public | int | `$hourOfYear` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the hour starting from the beginning of the current year |
| public | int | `$microsecondOfCentury` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the microsecond starting from the beginning of the current century |
| public | int | `$microsecondOfDay` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the microsecond starting from the beginning of the current day |
| public | int | `$microsecondOfDecade` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the microsecond starting from the beginning of the current decade |
| public | int | `$microsecondOfHour` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the microsecond starting from the beginning of the current hour |
| public | int | `$microsecondOfMillennium` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the microsecond starting from the beginning of the current millennium |
| public | int | `$microsecondOfMillisecond` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the microsecond starting from the beginning of the current millisecond |
| public | int | `$microsecondOfMinute` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the microsecond starting from the beginning of the current minute |
| public | int | `$microsecondOfMonth` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the microsecond starting from the beginning of the current month |
| public | int | `$microsecondOfQuarter` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the microsecond starting from the beginning of the current quarter |
| public | int | `$microsecondOfSecond` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the microsecond starting from the beginning of the current second |
| public | int | `$microsecondOfWeek` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the microsecond starting from the beginning of the current week |
| public | int | `$microsecondOfYear` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the microsecond starting from the beginning of the current year |
| public | int | `$millisecondOfCentury` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the millisecond starting from the beginning of the current century |
| public | int | `$millisecondOfDay` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the millisecond starting from the beginning of the current day |
| public | int | `$millisecondOfDecade` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the millisecond starting from the beginning of the current decade |
| public | int | `$millisecondOfHour` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the millisecond starting from the beginning of the current hour |
| public | int | `$millisecondOfMillennium` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the millisecond starting from the beginning of the current millennium |
| public | int | `$millisecondOfMinute` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the millisecond starting from the beginning of the current minute |
| public | int | `$millisecondOfMonth` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the millisecond starting from the beginning of the current month |
| public | int | `$millisecondOfQuarter` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the millisecond starting from the beginning of the current quarter |
| public | int | `$millisecondOfSecond` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the millisecond starting from the beginning of the current second |
| public | int | `$millisecondOfWeek` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the millisecond starting from the beginning of the current week |
| public | int | `$millisecondOfYear` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the millisecond starting from the beginning of the current year |
| public | int | `$minuteOfCentury` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the minute starting from the beginning of the current century |
| public | int | `$minuteOfDay` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the minute starting from the beginning of the current day |
| public | int | `$minuteOfDecade` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the minute starting from the beginning of the current decade |
| public | int | `$minuteOfHour` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the minute starting from the beginning of the current hour |
| public | int | `$minuteOfMillennium` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the minute starting from the beginning of the current millennium |
| public | int | `$minuteOfMonth` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the minute starting from the beginning of the current month |
| public | int | `$minuteOfQuarter` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the minute starting from the beginning of the current quarter |
| public | int | `$minuteOfWeek` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the minute starting from the beginning of the current week |
| public | int | `$minuteOfYear` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the minute starting from the beginning of the current year |
| public | int | `$monthOfCentury` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the month starting from the beginning of the current century |
| public | int | `$monthOfDecade` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the month starting from the beginning of the current decade |
| public | int | `$monthOfMillennium` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the month starting from the beginning of the current millennium |
| public | int | `$monthOfQuarter` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the month starting from the beginning of the current quarter |
| public | int | `$monthOfYear` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the month starting from the beginning of the current year |
| public | int | `$quarterOfCentury` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the quarter starting from the beginning of the current century |
| public | int | `$quarterOfDecade` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the quarter starting from the beginning of the current decade |
| public | int | `$quarterOfMillennium` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the quarter starting from the beginning of the current millennium |
| public | int | `$quarterOfYear` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the quarter starting from the beginning of the current year |
| public | int | `$secondOfCentury` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the second starting from the beginning of the current century |
| public | int | `$secondOfDay` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the second starting from the beginning of the current day |
| public | int | `$secondOfDecade` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the second starting from the beginning of the current decade |
| public | int | `$secondOfHour` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the second starting from the beginning of the current hour |
| public | int | `$secondOfMillennium` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the second starting from the beginning of the current millennium |
| public | int | `$secondOfMinute` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the second starting from the beginning of the current minute |
| public | int | `$secondOfMonth` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the second starting from the beginning of the current month |
| public | int | `$secondOfQuarter` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the second starting from the beginning of the current quarter |
| public | int | `$secondOfWeek` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the second starting from the beginning of the current week |
| public | int | `$secondOfYear` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the second starting from the beginning of the current year |
| public | int | `$weekOfCentury` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the week starting from the beginning of the current century |
| public | int | `$weekOfDecade` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the week starting from the beginning of the current decade |
| public | int | `$weekOfMillennium` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the week starting from the beginning of the current millennium |
| public | int | `$weekOfMonth` _(from [Carbon](../Carbon/Carbon.md))_ | 1 through 5 |
| public | int | `$weekOfQuarter` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the week starting from the beginning of the current quarter |
| public | int | `$weekOfYear` _(from [Carbon](../Carbon/Carbon.md))_ | ISO-8601 week number of year, weeks starting on Monday |
| public | int | `$yearOfCentury` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the year starting from the beginning of the current century |
| public | int | `$yearOfDecade` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the year starting from the beginning of the current decade |
| public | int | `$yearOfMillennium` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the year starting from the beginning of the current millennium |
| public _(read-only)_ | string | `$latinMeridiem` _(from [Carbon](../Carbon/Carbon.md))_ | "am"/"pm" (Ante meridiem or Post meridiem latin lowercase mark) |
| public _(read-only)_ | string | `$latinUpperMeridiem` _(from [Carbon](../Carbon/Carbon.md))_ | "AM"/"PM" (Ante meridiem or Post meridiem latin uppercase mark) |
| public _(read-only)_ | string | `$timezoneAbbreviatedName` _(from [Carbon](../Carbon/Carbon.md))_ | the current timezone abbreviated name |
| public _(read-only)_ | string | `$tzAbbrName` _(from [Carbon](../Carbon/Carbon.md))_ | alias of $timezoneAbbreviatedName |
| public _(read-only)_ | string | `$dayName` _(from [Carbon](../Carbon/Carbon.md))_ | long name of weekday translated according to Carbon locale, in english if no translation available for current language |
| public _(read-only)_ | string | `$shortDayName` _(from [Carbon](../Carbon/Carbon.md))_ | short name of weekday translated according to Carbon locale, in english if no translation available for current language |
| public _(read-only)_ | string | `$minDayName` _(from [Carbon](../Carbon/Carbon.md))_ | very short name of weekday translated according to Carbon locale, in english if no translation available for current language |
| public _(read-only)_ | string | `$monthName` _(from [Carbon](../Carbon/Carbon.md))_ | long name of month translated according to Carbon locale, in english if no translation available for current language |
| public _(read-only)_ | string | `$shortMonthName` _(from [Carbon](../Carbon/Carbon.md))_ | short name of month translated according to Carbon locale, in english if no translation available for current language |
| public _(read-only)_ | string | `$meridiem` _(from [Carbon](../Carbon/Carbon.md))_ | lowercase meridiem mark translated according to Carbon locale, in latin if no translation available for current language |
| public _(read-only)_ | string | `$upperMeridiem` _(from [Carbon](../Carbon/Carbon.md))_ | uppercase meridiem mark translated according to Carbon locale, in latin if no translation available for current language |
| public _(read-only)_ | int | `$noZeroHour` _(from [Carbon](../Carbon/Carbon.md))_ | current hour from 1 to 24 |
| public _(read-only)_ | int | `$isoWeeksInYear` _(from [Carbon](../Carbon/Carbon.md))_ | 51 through 53 |
| public _(read-only)_ | int | `$weekNumberInMonth` _(from [Carbon](../Carbon/Carbon.md))_ | 1 through 5 |
| public _(read-only)_ | int | `$firstWeekDay` _(from [Carbon](../Carbon/Carbon.md))_ | 0 through 6 |
| public _(read-only)_ | int | `$lastWeekDay` _(from [Carbon](../Carbon/Carbon.md))_ | 0 through 6 |
| public _(read-only)_ | int | `$quarter` _(from [Carbon](../Carbon/Carbon.md))_ | the quarter of this instance, 1 - 4 |
| public _(read-only)_ | int | `$decade` _(from [Carbon](../Carbon/Carbon.md))_ | the decade of this instance |
| public _(read-only)_ | int | `$century` _(from [Carbon](../Carbon/Carbon.md))_ | the century of this instance |
| public _(read-only)_ | int | `$millennium` _(from [Carbon](../Carbon/Carbon.md))_ | the millennium of this instance |
| public _(read-only)_ | bool | `$dst` _(from [Carbon](../Carbon/Carbon.md))_ | daylight savings time indicator, true if DST, false otherwise |
| public _(read-only)_ | bool | `$local` _(from [Carbon](../Carbon/Carbon.md))_ | checks if the timezone is local, true if local, false otherwise |
| public _(read-only)_ | bool | `$utc` _(from [Carbon](../Carbon/Carbon.md))_ | checks if the timezone is UTC, true if UTC, false otherwise |
| public _(read-only)_ | string | `$timezoneName` _(from [Carbon](../Carbon/Carbon.md))_ | the current timezone name |
| public _(read-only)_ | string | `$tzName` _(from [Carbon](../Carbon/Carbon.md))_ | alias of $timezoneName |
| public _(read-only)_ | string | `$locale` _(from [Carbon](../Carbon/Carbon.md))_ | locale of the current instance |
| public _(read-only)_ | int | `$centuriesInMillennium` _(from [Carbon](../Carbon/Carbon.md))_ | The number of centuries contained in the current millennium |
| public _(read-only)_ | int | `$daysInCentury` _(from [Carbon](../Carbon/Carbon.md))_ | The number of days contained in the current century |
| public _(read-only)_ | int | `$daysInDecade` _(from [Carbon](../Carbon/Carbon.md))_ | The number of days contained in the current decade |
| public _(read-only)_ | int | `$daysInMillennium` _(from [Carbon](../Carbon/Carbon.md))_ | The number of days contained in the current millennium |
| public _(read-only)_ | int | `$daysInMonth` _(from [Carbon](../Carbon/Carbon.md))_ | number of days in the given month |
| public _(read-only)_ | int | `$daysInQuarter` _(from [Carbon](../Carbon/Carbon.md))_ | The number of days contained in the current quarter |
| public _(read-only)_ | int | `$daysInWeek` _(from [Carbon](../Carbon/Carbon.md))_ | The number of days contained in the current week |
| public _(read-only)_ | int | `$daysInYear` _(from [Carbon](../Carbon/Carbon.md))_ | 365 or 366 |
| public _(read-only)_ | int | `$decadesInCentury` _(from [Carbon](../Carbon/Carbon.md))_ | The number of decades contained in the current century |
| public _(read-only)_ | int | `$decadesInMillennium` _(from [Carbon](../Carbon/Carbon.md))_ | The number of decades contained in the current millennium |
| public _(read-only)_ | int | `$hoursInCentury` _(from [Carbon](../Carbon/Carbon.md))_ | The number of hours contained in the current century |
| public _(read-only)_ | int | `$hoursInDay` _(from [Carbon](../Carbon/Carbon.md))_ | The number of hours contained in the current day |
| public _(read-only)_ | int | `$hoursInDecade` _(from [Carbon](../Carbon/Carbon.md))_ | The number of hours contained in the current decade |
| public _(read-only)_ | int | `$hoursInMillennium` _(from [Carbon](../Carbon/Carbon.md))_ | The number of hours contained in the current millennium |
| public _(read-only)_ | int | `$hoursInMonth` _(from [Carbon](../Carbon/Carbon.md))_ | The number of hours contained in the current month |
| public _(read-only)_ | int | `$hoursInQuarter` _(from [Carbon](../Carbon/Carbon.md))_ | The number of hours contained in the current quarter |
| public _(read-only)_ | int | `$hoursInWeek` _(from [Carbon](../Carbon/Carbon.md))_ | The number of hours contained in the current week |
| public _(read-only)_ | int | `$hoursInYear` _(from [Carbon](../Carbon/Carbon.md))_ | The number of hours contained in the current year |
| public _(read-only)_ | int | `$microsecondsInCentury` _(from [Carbon](../Carbon/Carbon.md))_ | The number of microseconds contained in the current century |
| public _(read-only)_ | int | `$microsecondsInDay` _(from [Carbon](../Carbon/Carbon.md))_ | The number of microseconds contained in the current day |
| public _(read-only)_ | int | `$microsecondsInDecade` _(from [Carbon](../Carbon/Carbon.md))_ | The number of microseconds contained in the current decade |
| public _(read-only)_ | int | `$microsecondsInHour` _(from [Carbon](../Carbon/Carbon.md))_ | The number of microseconds contained in the current hour |
| public _(read-only)_ | int | `$microsecondsInMillennium` _(from [Carbon](../Carbon/Carbon.md))_ | The number of microseconds contained in the current millennium |
| public _(read-only)_ | int | `$microsecondsInMillisecond` _(from [Carbon](../Carbon/Carbon.md))_ | The number of microseconds contained in the current millisecond |
| public _(read-only)_ | int | `$microsecondsInMinute` _(from [Carbon](../Carbon/Carbon.md))_ | The number of microseconds contained in the current minute |
| public _(read-only)_ | int | `$microsecondsInMonth` _(from [Carbon](../Carbon/Carbon.md))_ | The number of microseconds contained in the current month |
| public _(read-only)_ | int | `$microsecondsInQuarter` _(from [Carbon](../Carbon/Carbon.md))_ | The number of microseconds contained in the current quarter |
| public _(read-only)_ | int | `$microsecondsInSecond` _(from [Carbon](../Carbon/Carbon.md))_ | The number of microseconds contained in the current second |
| public _(read-only)_ | int | `$microsecondsInWeek` _(from [Carbon](../Carbon/Carbon.md))_ | The number of microseconds contained in the current week |
| public _(read-only)_ | int | `$microsecondsInYear` _(from [Carbon](../Carbon/Carbon.md))_ | The number of microseconds contained in the current year |
| public _(read-only)_ | int | `$millisecondsInCentury` _(from [Carbon](../Carbon/Carbon.md))_ | The number of milliseconds contained in the current century |
| public _(read-only)_ | int | `$millisecondsInDay` _(from [Carbon](../Carbon/Carbon.md))_ | The number of milliseconds contained in the current day |
| public _(read-only)_ | int | `$millisecondsInDecade` _(from [Carbon](../Carbon/Carbon.md))_ | The number of milliseconds contained in the current decade |
| public _(read-only)_ | int | `$millisecondsInHour` _(from [Carbon](../Carbon/Carbon.md))_ | The number of milliseconds contained in the current hour |
| public _(read-only)_ | int | `$millisecondsInMillennium` _(from [Carbon](../Carbon/Carbon.md))_ | The number of milliseconds contained in the current millennium |
| public _(read-only)_ | int | `$millisecondsInMinute` _(from [Carbon](../Carbon/Carbon.md))_ | The number of milliseconds contained in the current minute |
| public _(read-only)_ | int | `$millisecondsInMonth` _(from [Carbon](../Carbon/Carbon.md))_ | The number of milliseconds contained in the current month |
| public _(read-only)_ | int | `$millisecondsInQuarter` _(from [Carbon](../Carbon/Carbon.md))_ | The number of milliseconds contained in the current quarter |
| public _(read-only)_ | int | `$millisecondsInSecond` _(from [Carbon](../Carbon/Carbon.md))_ | The number of milliseconds contained in the current second |
| public _(read-only)_ | int | `$millisecondsInWeek` _(from [Carbon](../Carbon/Carbon.md))_ | The number of milliseconds contained in the current week |
| public _(read-only)_ | int | `$millisecondsInYear` _(from [Carbon](../Carbon/Carbon.md))_ | The number of milliseconds contained in the current year |
| public _(read-only)_ | int | `$minutesInCentury` _(from [Carbon](../Carbon/Carbon.md))_ | The number of minutes contained in the current century |
| public _(read-only)_ | int | `$minutesInDay` _(from [Carbon](../Carbon/Carbon.md))_ | The number of minutes contained in the current day |
| public _(read-only)_ | int | `$minutesInDecade` _(from [Carbon](../Carbon/Carbon.md))_ | The number of minutes contained in the current decade |
| public _(read-only)_ | int | `$minutesInHour` _(from [Carbon](../Carbon/Carbon.md))_ | The number of minutes contained in the current hour |
| public _(read-only)_ | int | `$minutesInMillennium` _(from [Carbon](../Carbon/Carbon.md))_ | The number of minutes contained in the current millennium |
| public _(read-only)_ | int | `$minutesInMonth` _(from [Carbon](../Carbon/Carbon.md))_ | The number of minutes contained in the current month |
| public _(read-only)_ | int | `$minutesInQuarter` _(from [Carbon](../Carbon/Carbon.md))_ | The number of minutes contained in the current quarter |
| public _(read-only)_ | int | `$minutesInWeek` _(from [Carbon](../Carbon/Carbon.md))_ | The number of minutes contained in the current week |
| public _(read-only)_ | int | `$minutesInYear` _(from [Carbon](../Carbon/Carbon.md))_ | The number of minutes contained in the current year |
| public _(read-only)_ | int | `$monthsInCentury` _(from [Carbon](../Carbon/Carbon.md))_ | The number of months contained in the current century |
| public _(read-only)_ | int | `$monthsInDecade` _(from [Carbon](../Carbon/Carbon.md))_ | The number of months contained in the current decade |
| public _(read-only)_ | int | `$monthsInMillennium` _(from [Carbon](../Carbon/Carbon.md))_ | The number of months contained in the current millennium |
| public _(read-only)_ | int | `$monthsInQuarter` _(from [Carbon](../Carbon/Carbon.md))_ | The number of months contained in the current quarter |
| public _(read-only)_ | int | `$monthsInYear` _(from [Carbon](../Carbon/Carbon.md))_ | The number of months contained in the current year |
| public _(read-only)_ | int | `$quartersInCentury` _(from [Carbon](../Carbon/Carbon.md))_ | The number of quarters contained in the current century |
| public _(read-only)_ | int | `$quartersInDecade` _(from [Carbon](../Carbon/Carbon.md))_ | The number of quarters contained in the current decade |
| public _(read-only)_ | int | `$quartersInMillennium` _(from [Carbon](../Carbon/Carbon.md))_ | The number of quarters contained in the current millennium |
| public _(read-only)_ | int | `$quartersInYear` _(from [Carbon](../Carbon/Carbon.md))_ | The number of quarters contained in the current year |
| public _(read-only)_ | int | `$secondsInCentury` _(from [Carbon](../Carbon/Carbon.md))_ | The number of seconds contained in the current century |
| public _(read-only)_ | int | `$secondsInDay` _(from [Carbon](../Carbon/Carbon.md))_ | The number of seconds contained in the current day |
| public _(read-only)_ | int | `$secondsInDecade` _(from [Carbon](../Carbon/Carbon.md))_ | The number of seconds contained in the current decade |
| public _(read-only)_ | int | `$secondsInHour` _(from [Carbon](../Carbon/Carbon.md))_ | The number of seconds contained in the current hour |
| public _(read-only)_ | int | `$secondsInMillennium` _(from [Carbon](../Carbon/Carbon.md))_ | The number of seconds contained in the current millennium |
| public _(read-only)_ | int | `$secondsInMinute` _(from [Carbon](../Carbon/Carbon.md))_ | The number of seconds contained in the current minute |
| public _(read-only)_ | int | `$secondsInMonth` _(from [Carbon](../Carbon/Carbon.md))_ | The number of seconds contained in the current month |
| public _(read-only)_ | int | `$secondsInQuarter` _(from [Carbon](../Carbon/Carbon.md))_ | The number of seconds contained in the current quarter |
| public _(read-only)_ | int | `$secondsInWeek` _(from [Carbon](../Carbon/Carbon.md))_ | The number of seconds contained in the current week |
| public _(read-only)_ | int | `$secondsInYear` _(from [Carbon](../Carbon/Carbon.md))_ | The number of seconds contained in the current year |
| public _(read-only)_ | int | `$weeksInCentury` _(from [Carbon](../Carbon/Carbon.md))_ | The number of weeks contained in the current century |
| public _(read-only)_ | int | `$weeksInDecade` _(from [Carbon](../Carbon/Carbon.md))_ | The number of weeks contained in the current decade |
| public _(read-only)_ | int | `$weeksInMillennium` _(from [Carbon](../Carbon/Carbon.md))_ | The number of weeks contained in the current millennium |
| public _(read-only)_ | int | `$weeksInMonth` _(from [Carbon](../Carbon/Carbon.md))_ | The number of weeks contained in the current month |
| public _(read-only)_ | int | `$weeksInQuarter` _(from [Carbon](../Carbon/Carbon.md))_ | The number of weeks contained in the current quarter |
| public _(read-only)_ | int | `$weeksInYear` _(from [Carbon](../Carbon/Carbon.md))_ | 51 through 53 |
| public _(read-only)_ | int | `$yearsInCentury` _(from [Carbon](../Carbon/Carbon.md))_ | The number of years contained in the current century |
| public _(read-only)_ | int | `$yearsInDecade` _(from [Carbon](../Carbon/Carbon.md))_ | The number of years contained in the current decade |
| public _(read-only)_ | int | `$yearsInMillennium` _(from [Carbon](../Carbon/Carbon.md))_ | The number of years contained in the current millennium |

## Methods

| Return | Method | Description |
|---|---|---|
| Factory | [factory()](#factory) | 多様な型の引数から {\JapaneseDate\DateTime} / {\JapaneseDate\DateTimeImmutable} インスタンスを生成するユニバーサルファクトリメソッドです。 |
| void | [setCacheMode()](#setcachemode) | 旧暦・祝日計算に使用するキャッシュモードを設定します。 |
| void | [setCacheFilePath()](#setcachefilepath) | ファイルキャッシュの保存先ディレクトリを設定します。 |
| void | [setCacheClosure()](#setcacheclosure) | 独自キャッシュロジックを実装したクロージャを登録します。 |
| Modifier | [nextHoliday()](#nextholiday) | 次の祝日にする |
| Modifier | [nextSixWeek()](#nextsixweek) | 指定された次の六曜にする |
| SeventyTwoKou | [nextSeventyTwoKou()](#nextseventytwokou) | 次の七十二候が始まる日へ移動したインスタンスを返します。 |
| SeventyTwoKou | [previousSeventyTwoKou()](#previousseventytwokou) | 前の七十二候が始まる日へ移動したインスタンスを返します。 |
| array | [getCalendar()](#getcalendar) | サポートされるカレンダーに変換する |
| DateBusinessCommon | [setBusinessConfig()](#setbusinessconfig) | インスタンスに個別の営業日設定を適用します。 |
| DateBusiness\|null | [getBusinessConfig()](#getbusinessconfig) | インスタンスが保持している個別の営業日設定を取得します。 |
| DateBusinessCommon | [setClosingDay()](#setclosingday) | 特定の日付を休業日として指定します。 |
| DateBusinessCommon | [setOpenDay()](#setopenday) | 特定の日付を営業日として指定します。 |
| DateBusinessCommon | [setClosingWeekdays()](#setclosingweekdays) | 休業曜日を一括設定します。 |
| DateBusinessCommon | [setBypassHoliday()](#setbypassholiday) | 祝日を休業日として扱うかどうかを設定します。 |
| DateBusinessCommon | [setOpenNthWeekday()](#setopennthweekday) | 第XX曜日を営業日として指定します。 |
| DateBusinessCommon | [setClosingNthWeekday()](#setclosingnthweekday) | 第XX曜日を休業日として指定します。 |
| DateBusinessCommon | [addOpenFilter()](#addopenfilter) | 営業指定フィルタを追加します。 |
| DateBusinessCommon | [addClosingFilter()](#addclosingfilter) | 休業指定フィルタを追加します。 |
| DateBusinessCommon | [setBusinessMacro()](#setbusinessmacro) | 判定ロジックを完全に上書きするマクロを設定します。 |
| bool | [checkIsBusinessDay()](#checkisbusinessday) | 指定した日付（または自身が保持する日付）が営業日かどうかを判定します。 |
| string\|null | [checkGetBusinessDayLabel()](#checkgetbusinessdaylabel) | 指定した日付（または自身が保持する日付）の休業ラベルを取得します。 |
| bool | [isBusinessDay()](#isbusinessday) | このインスタンスの日付が営業日かどうかを判定します。 |
| string\|null | [getBusinessDayLabel()](#getbusinessdaylabel) | このインスタンスの日付が休業日の場合、そのラベルを返します。 |
| Business | [nextBusinessDay()](#nextbusinessday) | 次の営業日を取得します。 |
| Business | [previousBusinessDay()](#previousbusinessday) | 前の営業日を取得します。 |
| Business | [shiftToClosestBusinessDayAfter()](#shifttoclosestbusinessdayafter) | この日が休業日の場合、翌営業日にシフトしたインスタンスを返します。 |
| Business | [shiftToClosestBusinessDayBefore()](#shifttoclosestbusinessdaybefore) | この日が休業日の場合、前営業日にシフトしたインスタンスを返します。 |
| Business | [addBusinessDays()](#addbusinessdays) | 指定した営業日数後の日付を返します。 |
| Business | [subBusinessDays()](#subbusinessdays) | 指定した営業日数前の日付を返します。 |
| array | [historicalEras()](#historicaleras) | 自身の日付に対応する歴史的元号を返す。 |
| bool | [Carbon::isMutable](../Carbon/Carbon.md#ismutable) _(from [Carbon](../Carbon/Carbon.md))_ | Returns true if the current class/instance is mutable. |
| bool | [Carbon::isUtc](../Carbon/Carbon.md#isutc) _(from [Carbon](../Carbon/Carbon.md))_ |  |
| bool | [Carbon::isLocal](../Carbon/Carbon.md#islocal) _(from [Carbon](../Carbon/Carbon.md))_ | Check if the current instance has non-UTC timezone. |
| bool | [Carbon::isValid](../Carbon/Carbon.md#isvalid) _(from [Carbon](../Carbon/Carbon.md))_ | Check if the current instance is a valid date. |
| bool | [Carbon::isDST](../Carbon/Carbon.md#isdst) _(from [Carbon](../Carbon/Carbon.md))_ | Check if the current instance is in a daylight saving time. |
| bool | [Carbon::isSunday](../Carbon/Carbon.md#issunday) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance day is sunday. |
| bool | [Carbon::isMonday](../Carbon/Carbon.md#ismonday) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance day is monday. |
| bool | [Carbon::isTuesday](../Carbon/Carbon.md#istuesday) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance day is tuesday. |
| bool | [Carbon::isWednesday](../Carbon/Carbon.md#iswednesday) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance day is wednesday. |
| bool | [Carbon::isThursday](../Carbon/Carbon.md#isthursday) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance day is thursday. |
| bool | [Carbon::isFriday](../Carbon/Carbon.md#isfriday) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance day is friday. |
| bool | [Carbon::isSaturday](../Carbon/Carbon.md#issaturday) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance day is saturday. |
| bool | [Carbon::isSameYear](../Carbon/Carbon.md#issameyear) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| bool | [Carbon::isCurrentYear](../Carbon/Carbon.md#iscurrentyear) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance is in the same year as the current moment. |
| bool | [Carbon::isNextYear](../Carbon/Carbon.md#isnextyear) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance is in the same year as the current moment next year. |
| bool | [Carbon::isLastYear](../Carbon/Carbon.md#islastyear) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance is in the same year as the current moment last year. |
| bool | [Carbon::isCurrentMonth](../Carbon/Carbon.md#iscurrentmonth) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance is in the same month as the current moment. |
| bool | [Carbon::isNextMonth](../Carbon/Carbon.md#isnextmonth) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance is in the same month as the current moment next month. |
| bool | [Carbon::isLastMonth](../Carbon/Carbon.md#islastmonth) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance is in the same month as the current moment last month. |
| bool | [Carbon::isSameWeek](../Carbon/Carbon.md#issameweek) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| bool | [Carbon::isCurrentWeek](../Carbon/Carbon.md#iscurrentweek) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance is in the same week as the current moment. |
| bool | [Carbon::isNextWeek](../Carbon/Carbon.md#isnextweek) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance is in the same week as the current moment next week. |
| bool | [Carbon::isLastWeek](../Carbon/Carbon.md#islastweek) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance is in the same week as the current moment last week. |
| bool | [Carbon::isSameDay](../Carbon/Carbon.md#issameday) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| bool | [Carbon::isCurrentDay](../Carbon/Carbon.md#iscurrentday) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance is in the same day as the current moment. |
| bool | [Carbon::isNextDay](../Carbon/Carbon.md#isnextday) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance is in the same day as the current moment next day. |
| bool | [Carbon::isLastDay](../Carbon/Carbon.md#islastday) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance is in the same day as the current moment last day. |
| bool | [Carbon::isSameHour](../Carbon/Carbon.md#issamehour) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| bool | [Carbon::isCurrentHour](../Carbon/Carbon.md#iscurrenthour) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance is in the same hour as the current moment. |
| bool | [Carbon::isNextHour](../Carbon/Carbon.md#isnexthour) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance is in the same hour as the current moment next hour. |
| bool | [Carbon::isLastHour](../Carbon/Carbon.md#islasthour) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance is in the same hour as the current moment last hour. |
| bool | [Carbon::isSameMinute](../Carbon/Carbon.md#issameminute) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| bool | [Carbon::isCurrentMinute](../Carbon/Carbon.md#iscurrentminute) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance is in the same minute as the current moment. |
| bool | [Carbon::isNextMinute](../Carbon/Carbon.md#isnextminute) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance is in the same minute as the current moment next minute. |
| bool | [Carbon::isLastMinute](../Carbon/Carbon.md#islastminute) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance is in the same minute as the current moment last minute. |
| bool | [Carbon::isSameSecond](../Carbon/Carbon.md#issamesecond) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| bool | [Carbon::isCurrentSecond](../Carbon/Carbon.md#iscurrentsecond) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance is in the same second as the current moment. |
| bool | [Carbon::isNextSecond](../Carbon/Carbon.md#isnextsecond) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance is in the same second as the current moment next second. |
| bool | [Carbon::isLastSecond](../Carbon/Carbon.md#islastsecond) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance is in the same second as the current moment last second. |
| bool | [Carbon::isSameMilli](../Carbon/Carbon.md#issamemilli) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| bool | [Carbon::isCurrentMilli](../Carbon/Carbon.md#iscurrentmilli) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance is in the same millisecond as the current moment. |
| bool | [Carbon::isNextMilli](../Carbon/Carbon.md#isnextmilli) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance is in the same millisecond as the current moment next millisecond. |
| bool | [Carbon::isLastMilli](../Carbon/Carbon.md#islastmilli) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance is in the same millisecond as the current moment last millisecond. |
| bool | [Carbon::isSameMillisecond](../Carbon/Carbon.md#issamemillisecond) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| bool | [Carbon::isCurrentMillisecond](../Carbon/Carbon.md#iscurrentmillisecond) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance is in the same millisecond as the current moment. |
| bool | [Carbon::isNextMillisecond](../Carbon/Carbon.md#isnextmillisecond) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance is in the same millisecond as the current moment next millisecond. |
| bool | [Carbon::isLastMillisecond](../Carbon/Carbon.md#islastmillisecond) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance is in the same millisecond as the current moment last millisecond. |
| bool | [Carbon::isSameMicro](../Carbon/Carbon.md#issamemicro) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| bool | [Carbon::isCurrentMicro](../Carbon/Carbon.md#iscurrentmicro) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance is in the same microsecond as the current moment. |
| bool | [Carbon::isNextMicro](../Carbon/Carbon.md#isnextmicro) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance is in the same microsecond as the current moment next microsecond. |
| bool | [Carbon::isLastMicro](../Carbon/Carbon.md#islastmicro) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance is in the same microsecond as the current moment last microsecond. |
| bool | [Carbon::isSameMicrosecond](../Carbon/Carbon.md#issamemicrosecond) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| bool | [Carbon::isCurrentMicrosecond](../Carbon/Carbon.md#iscurrentmicrosecond) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance is in the same microsecond as the current moment. |
| bool | [Carbon::isNextMicrosecond](../Carbon/Carbon.md#isnextmicrosecond) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance is in the same microsecond as the current moment next microsecond. |
| bool | [Carbon::isLastMicrosecond](../Carbon/Carbon.md#islastmicrosecond) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance is in the same microsecond as the current moment last microsecond. |
| bool | [Carbon::isSameDecade](../Carbon/Carbon.md#issamedecade) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| bool | [Carbon::isCurrentDecade](../Carbon/Carbon.md#iscurrentdecade) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance is in the same decade as the current moment. |
| bool | [Carbon::isNextDecade](../Carbon/Carbon.md#isnextdecade) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance is in the same decade as the current moment next decade. |
| bool | [Carbon::isLastDecade](../Carbon/Carbon.md#islastdecade) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance is in the same decade as the current moment last decade. |
| bool | [Carbon::isSameCentury](../Carbon/Carbon.md#issamecentury) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| bool | [Carbon::isCurrentCentury](../Carbon/Carbon.md#iscurrentcentury) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance is in the same century as the current moment. |
| bool | [Carbon::isNextCentury](../Carbon/Carbon.md#isnextcentury) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance is in the same century as the current moment next century. |
| bool | [Carbon::isLastCentury](../Carbon/Carbon.md#islastcentury) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance is in the same century as the current moment last century. |
| bool | [Carbon::isSameMillennium](../Carbon/Carbon.md#issamemillennium) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| bool | [Carbon::isCurrentMillennium](../Carbon/Carbon.md#iscurrentmillennium) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance is in the same millennium as the current moment. |
| bool | [Carbon::isNextMillennium](../Carbon/Carbon.md#isnextmillennium) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance is in the same millennium as the current moment next millennium. |
| bool | [Carbon::isLastMillennium](../Carbon/Carbon.md#islastmillennium) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance is in the same millennium as the current moment last millennium. |
| bool | [Carbon::isCurrentQuarter](../Carbon/Carbon.md#iscurrentquarter) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance is in the same quarter as the current moment. |
| bool | [Carbon::isNextQuarter](../Carbon/Carbon.md#isnextquarter) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance is in the same quarter as the current moment next quarter. |
| bool | [Carbon::isLastQuarter](../Carbon/Carbon.md#islastquarter) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance is in the same quarter as the current moment last quarter. |
| $this | [Carbon::years](../Carbon/Carbon.md#years) _(from [Carbon](../Carbon/Carbon.md))_ | Set current instance year to the given value. |
| $this | [Carbon::year](../Carbon/Carbon.md#year) _(from [Carbon](../Carbon/Carbon.md))_ | Set current instance year to the given value. |
| $this | [Carbon::setYears](../Carbon/Carbon.md#setyears) _(from [Carbon](../Carbon/Carbon.md))_ | Set current instance year to the given value. |
| $this | [Carbon::setYear](../Carbon/Carbon.md#setyear) _(from [Carbon](../Carbon/Carbon.md))_ | Set current instance year to the given value. |
| $this | [Carbon::months](../Carbon/Carbon.md#months) _(from [Carbon](../Carbon/Carbon.md))_ | Set current instance month to the given value. |
| $this | [Carbon::month](../Carbon/Carbon.md#month) _(from [Carbon](../Carbon/Carbon.md))_ | Set current instance month to the given value. |
| $this | [Carbon::setMonths](../Carbon/Carbon.md#setmonths) _(from [Carbon](../Carbon/Carbon.md))_ | Set current instance month to the given value. |
| $this | [Carbon::setMonth](../Carbon/Carbon.md#setmonth) _(from [Carbon](../Carbon/Carbon.md))_ | Set current instance month to the given value. |
| $this | [Carbon::days](../Carbon/Carbon.md#days) _(from [Carbon](../Carbon/Carbon.md))_ | Set current instance day to the given value. |
| $this | [Carbon::day](../Carbon/Carbon.md#day) _(from [Carbon](../Carbon/Carbon.md))_ | Set current instance day to the given value. |
| $this | [Carbon::setDays](../Carbon/Carbon.md#setdays) _(from [Carbon](../Carbon/Carbon.md))_ | Set current instance day to the given value. |
| $this | [Carbon::setDay](../Carbon/Carbon.md#setday) _(from [Carbon](../Carbon/Carbon.md))_ | Set current instance day to the given value. |
| $this | [Carbon::hours](../Carbon/Carbon.md#hours) _(from [Carbon](../Carbon/Carbon.md))_ | Set current instance hour to the given value. |
| $this | [Carbon::hour](../Carbon/Carbon.md#hour) _(from [Carbon](../Carbon/Carbon.md))_ | Set current instance hour to the given value. |
| $this | [Carbon::setHours](../Carbon/Carbon.md#sethours) _(from [Carbon](../Carbon/Carbon.md))_ | Set current instance hour to the given value. |
| $this | [Carbon::setHour](../Carbon/Carbon.md#sethour) _(from [Carbon](../Carbon/Carbon.md))_ | Set current instance hour to the given value. |
| $this | [Carbon::minutes](../Carbon/Carbon.md#minutes) _(from [Carbon](../Carbon/Carbon.md))_ | Set current instance minute to the given value. |
| $this | [Carbon::minute](../Carbon/Carbon.md#minute) _(from [Carbon](../Carbon/Carbon.md))_ | Set current instance minute to the given value. |
| $this | [Carbon::setMinutes](../Carbon/Carbon.md#setminutes) _(from [Carbon](../Carbon/Carbon.md))_ | Set current instance minute to the given value. |
| $this | [Carbon::setMinute](../Carbon/Carbon.md#setminute) _(from [Carbon](../Carbon/Carbon.md))_ | Set current instance minute to the given value. |
| $this | [Carbon::seconds](../Carbon/Carbon.md#seconds) _(from [Carbon](../Carbon/Carbon.md))_ | Set current instance second to the given value. |
| $this | [Carbon::second](../Carbon/Carbon.md#second) _(from [Carbon](../Carbon/Carbon.md))_ | Set current instance second to the given value. |
| $this | [Carbon::setSeconds](../Carbon/Carbon.md#setseconds) _(from [Carbon](../Carbon/Carbon.md))_ | Set current instance second to the given value. |
| $this | [Carbon::setSecond](../Carbon/Carbon.md#setsecond) _(from [Carbon](../Carbon/Carbon.md))_ | Set current instance second to the given value. |
| $this | [Carbon::millis](../Carbon/Carbon.md#millis) _(from [Carbon](../Carbon/Carbon.md))_ | Set current instance millisecond to the given value. |
| $this | [Carbon::milli](../Carbon/Carbon.md#milli) _(from [Carbon](../Carbon/Carbon.md))_ | Set current instance millisecond to the given value. |
| $this | [Carbon::setMillis](../Carbon/Carbon.md#setmillis) _(from [Carbon](../Carbon/Carbon.md))_ | Set current instance millisecond to the given value. |
| $this | [Carbon::setMilli](../Carbon/Carbon.md#setmilli) _(from [Carbon](../Carbon/Carbon.md))_ | Set current instance millisecond to the given value. |
| $this | [Carbon::milliseconds](../Carbon/Carbon.md#milliseconds) _(from [Carbon](../Carbon/Carbon.md))_ | Set current instance millisecond to the given value. |
| $this | [Carbon::millisecond](../Carbon/Carbon.md#millisecond) _(from [Carbon](../Carbon/Carbon.md))_ | Set current instance millisecond to the given value. |
| $this | [Carbon::setMilliseconds](../Carbon/Carbon.md#setmilliseconds) _(from [Carbon](../Carbon/Carbon.md))_ | Set current instance millisecond to the given value. |
| $this | [Carbon::setMillisecond](../Carbon/Carbon.md#setmillisecond) _(from [Carbon](../Carbon/Carbon.md))_ | Set current instance millisecond to the given value. |
| $this | [Carbon::micros](../Carbon/Carbon.md#micros) _(from [Carbon](../Carbon/Carbon.md))_ | Set current instance microsecond to the given value. |
| $this | [Carbon::micro](../Carbon/Carbon.md#micro) _(from [Carbon](../Carbon/Carbon.md))_ | Set current instance microsecond to the given value. |
| $this | [Carbon::setMicros](../Carbon/Carbon.md#setmicros) _(from [Carbon](../Carbon/Carbon.md))_ | Set current instance microsecond to the given value. |
| $this | [Carbon::setMicro](../Carbon/Carbon.md#setmicro) _(from [Carbon](../Carbon/Carbon.md))_ | Set current instance microsecond to the given value. |
| $this | [Carbon::microseconds](../Carbon/Carbon.md#microseconds) _(from [Carbon](../Carbon/Carbon.md))_ | Set current instance microsecond to the given value. |
| $this | [Carbon::microsecond](../Carbon/Carbon.md#microsecond) _(from [Carbon](../Carbon/Carbon.md))_ | Set current instance microsecond to the given value. |
| $this | [Carbon::setMicroseconds](../Carbon/Carbon.md#setmicroseconds) _(from [Carbon](../Carbon/Carbon.md))_ | Set current instance microsecond to the given value. |
| self | [Carbon::setMicrosecond](../Carbon/Carbon.md#setmicrosecond) _(from [Carbon](../Carbon/Carbon.md))_ | Set current instance microsecond to the given value. |
| $this | [Carbon::addYears](../Carbon/Carbon.md#addyears) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::addYear](../Carbon/Carbon.md#addyear) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::subYears](../Carbon/Carbon.md#subyears) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::subYear](../Carbon/Carbon.md#subyear) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::addYearsWithOverflow](../Carbon/Carbon.md#addyearswithoverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly allowed. |
| $this | [Carbon::addYearWithOverflow](../Carbon/Carbon.md#addyearwithoverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly allowed. |
| $this | [Carbon::subYearsWithOverflow](../Carbon/Carbon.md#subyearswithoverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly allowed. |
| $this | [Carbon::subYearWithOverflow](../Carbon/Carbon.md#subyearwithoverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly allowed. |
| $this | [Carbon::addYearsWithoutOverflow](../Carbon/Carbon.md#addyearswithoutoverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [Carbon::addYearWithoutOverflow](../Carbon/Carbon.md#addyearwithoutoverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [Carbon::subYearsWithoutOverflow](../Carbon/Carbon.md#subyearswithoutoverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [Carbon::subYearWithoutOverflow](../Carbon/Carbon.md#subyearwithoutoverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [Carbon::addYearsWithNoOverflow](../Carbon/Carbon.md#addyearswithnooverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [Carbon::addYearWithNoOverflow](../Carbon/Carbon.md#addyearwithnooverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [Carbon::subYearsWithNoOverflow](../Carbon/Carbon.md#subyearswithnooverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [Carbon::subYearWithNoOverflow](../Carbon/Carbon.md#subyearwithnooverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [Carbon::addYearsNoOverflow](../Carbon/Carbon.md#addyearsnooverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [Carbon::addYearNoOverflow](../Carbon/Carbon.md#addyearnooverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [Carbon::subYearsNoOverflow](../Carbon/Carbon.md#subyearsnooverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [Carbon::subYearNoOverflow](../Carbon/Carbon.md#subyearnooverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [Carbon::addMonths](../Carbon/Carbon.md#addmonths) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::addMonth](../Carbon/Carbon.md#addmonth) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::subMonths](../Carbon/Carbon.md#submonths) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::subMonth](../Carbon/Carbon.md#submonth) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::addMonthsWithOverflow](../Carbon/Carbon.md#addmonthswithoverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly allowed. |
| $this | [Carbon::addMonthWithOverflow](../Carbon/Carbon.md#addmonthwithoverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly allowed. |
| $this | [Carbon::subMonthsWithOverflow](../Carbon/Carbon.md#submonthswithoverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly allowed. |
| $this | [Carbon::subMonthWithOverflow](../Carbon/Carbon.md#submonthwithoverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly allowed. |
| $this | [Carbon::addMonthsWithoutOverflow](../Carbon/Carbon.md#addmonthswithoutoverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [Carbon::addMonthWithoutOverflow](../Carbon/Carbon.md#addmonthwithoutoverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [Carbon::subMonthsWithoutOverflow](../Carbon/Carbon.md#submonthswithoutoverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [Carbon::subMonthWithoutOverflow](../Carbon/Carbon.md#submonthwithoutoverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [Carbon::addMonthsWithNoOverflow](../Carbon/Carbon.md#addmonthswithnooverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [Carbon::addMonthWithNoOverflow](../Carbon/Carbon.md#addmonthwithnooverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [Carbon::subMonthsWithNoOverflow](../Carbon/Carbon.md#submonthswithnooverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [Carbon::subMonthWithNoOverflow](../Carbon/Carbon.md#submonthwithnooverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [Carbon::addMonthsNoOverflow](../Carbon/Carbon.md#addmonthsnooverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [Carbon::addMonthNoOverflow](../Carbon/Carbon.md#addmonthnooverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [Carbon::subMonthsNoOverflow](../Carbon/Carbon.md#submonthsnooverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [Carbon::subMonthNoOverflow](../Carbon/Carbon.md#submonthnooverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [Carbon::addDays](../Carbon/Carbon.md#adddays) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::addDay](../Carbon/Carbon.md#addday) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::subDays](../Carbon/Carbon.md#subdays) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::subDay](../Carbon/Carbon.md#subday) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::addHours](../Carbon/Carbon.md#addhours) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::addHour](../Carbon/Carbon.md#addhour) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::subHours](../Carbon/Carbon.md#subhours) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::subHour](../Carbon/Carbon.md#subhour) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::addMinutes](../Carbon/Carbon.md#addminutes) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::addMinute](../Carbon/Carbon.md#addminute) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::subMinutes](../Carbon/Carbon.md#subminutes) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::subMinute](../Carbon/Carbon.md#subminute) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::addSeconds](../Carbon/Carbon.md#addseconds) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::addSecond](../Carbon/Carbon.md#addsecond) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::subSeconds](../Carbon/Carbon.md#subseconds) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::subSecond](../Carbon/Carbon.md#subsecond) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::addMillis](../Carbon/Carbon.md#addmillis) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::addMilli](../Carbon/Carbon.md#addmilli) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::subMillis](../Carbon/Carbon.md#submillis) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::subMilli](../Carbon/Carbon.md#submilli) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::addMilliseconds](../Carbon/Carbon.md#addmilliseconds) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::addMillisecond](../Carbon/Carbon.md#addmillisecond) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::subMilliseconds](../Carbon/Carbon.md#submilliseconds) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::subMillisecond](../Carbon/Carbon.md#submillisecond) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::addMicros](../Carbon/Carbon.md#addmicros) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::addMicro](../Carbon/Carbon.md#addmicro) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::subMicros](../Carbon/Carbon.md#submicros) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::subMicro](../Carbon/Carbon.md#submicro) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::addMicroseconds](../Carbon/Carbon.md#addmicroseconds) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::addMicrosecond](../Carbon/Carbon.md#addmicrosecond) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::subMicroseconds](../Carbon/Carbon.md#submicroseconds) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::subMicrosecond](../Carbon/Carbon.md#submicrosecond) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::addMillennia](../Carbon/Carbon.md#addmillennia) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::addMillennium](../Carbon/Carbon.md#addmillennium) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::subMillennia](../Carbon/Carbon.md#submillennia) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::subMillennium](../Carbon/Carbon.md#submillennium) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::addMillenniaWithOverflow](../Carbon/Carbon.md#addmillenniawithoverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly allowed. |
| $this | [Carbon::addMillenniumWithOverflow](../Carbon/Carbon.md#addmillenniumwithoverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly allowed. |
| $this | [Carbon::subMillenniaWithOverflow](../Carbon/Carbon.md#submillenniawithoverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly allowed. |
| $this | [Carbon::subMillenniumWithOverflow](../Carbon/Carbon.md#submillenniumwithoverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly allowed. |
| $this | [Carbon::addMillenniaWithoutOverflow](../Carbon/Carbon.md#addmillenniawithoutoverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [Carbon::addMillenniumWithoutOverflow](../Carbon/Carbon.md#addmillenniumwithoutoverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [Carbon::subMillenniaWithoutOverflow](../Carbon/Carbon.md#submillenniawithoutoverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [Carbon::subMillenniumWithoutOverflow](../Carbon/Carbon.md#submillenniumwithoutoverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [Carbon::addMillenniaWithNoOverflow](../Carbon/Carbon.md#addmillenniawithnooverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [Carbon::addMillenniumWithNoOverflow](../Carbon/Carbon.md#addmillenniumwithnooverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [Carbon::subMillenniaWithNoOverflow](../Carbon/Carbon.md#submillenniawithnooverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [Carbon::subMillenniumWithNoOverflow](../Carbon/Carbon.md#submillenniumwithnooverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [Carbon::addMillenniaNoOverflow](../Carbon/Carbon.md#addmillennianooverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [Carbon::addMillenniumNoOverflow](../Carbon/Carbon.md#addmillenniumnooverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [Carbon::subMillenniaNoOverflow](../Carbon/Carbon.md#submillennianooverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [Carbon::subMillenniumNoOverflow](../Carbon/Carbon.md#submillenniumnooverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [Carbon::addCenturies](../Carbon/Carbon.md#addcenturies) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::addCentury](../Carbon/Carbon.md#addcentury) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::subCenturies](../Carbon/Carbon.md#subcenturies) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::subCentury](../Carbon/Carbon.md#subcentury) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::addCenturiesWithOverflow](../Carbon/Carbon.md#addcenturieswithoverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly allowed. |
| $this | [Carbon::addCenturyWithOverflow](../Carbon/Carbon.md#addcenturywithoverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly allowed. |
| $this | [Carbon::subCenturiesWithOverflow](../Carbon/Carbon.md#subcenturieswithoverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly allowed. |
| $this | [Carbon::subCenturyWithOverflow](../Carbon/Carbon.md#subcenturywithoverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly allowed. |
| $this | [Carbon::addCenturiesWithoutOverflow](../Carbon/Carbon.md#addcenturieswithoutoverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [Carbon::addCenturyWithoutOverflow](../Carbon/Carbon.md#addcenturywithoutoverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [Carbon::subCenturiesWithoutOverflow](../Carbon/Carbon.md#subcenturieswithoutoverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [Carbon::subCenturyWithoutOverflow](../Carbon/Carbon.md#subcenturywithoutoverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [Carbon::addCenturiesWithNoOverflow](../Carbon/Carbon.md#addcenturieswithnooverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [Carbon::addCenturyWithNoOverflow](../Carbon/Carbon.md#addcenturywithnooverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [Carbon::subCenturiesWithNoOverflow](../Carbon/Carbon.md#subcenturieswithnooverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [Carbon::subCenturyWithNoOverflow](../Carbon/Carbon.md#subcenturywithnooverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [Carbon::addCenturiesNoOverflow](../Carbon/Carbon.md#addcenturiesnooverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [Carbon::addCenturyNoOverflow](../Carbon/Carbon.md#addcenturynooverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [Carbon::subCenturiesNoOverflow](../Carbon/Carbon.md#subcenturiesnooverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [Carbon::subCenturyNoOverflow](../Carbon/Carbon.md#subcenturynooverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [Carbon::addDecades](../Carbon/Carbon.md#adddecades) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::addDecade](../Carbon/Carbon.md#adddecade) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::subDecades](../Carbon/Carbon.md#subdecades) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::subDecade](../Carbon/Carbon.md#subdecade) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::addDecadesWithOverflow](../Carbon/Carbon.md#adddecadeswithoverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly allowed. |
| $this | [Carbon::addDecadeWithOverflow](../Carbon/Carbon.md#adddecadewithoverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly allowed. |
| $this | [Carbon::subDecadesWithOverflow](../Carbon/Carbon.md#subdecadeswithoverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly allowed. |
| $this | [Carbon::subDecadeWithOverflow](../Carbon/Carbon.md#subdecadewithoverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly allowed. |
| $this | [Carbon::addDecadesWithoutOverflow](../Carbon/Carbon.md#adddecadeswithoutoverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [Carbon::addDecadeWithoutOverflow](../Carbon/Carbon.md#adddecadewithoutoverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [Carbon::subDecadesWithoutOverflow](../Carbon/Carbon.md#subdecadeswithoutoverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [Carbon::subDecadeWithoutOverflow](../Carbon/Carbon.md#subdecadewithoutoverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [Carbon::addDecadesWithNoOverflow](../Carbon/Carbon.md#adddecadeswithnooverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [Carbon::addDecadeWithNoOverflow](../Carbon/Carbon.md#adddecadewithnooverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [Carbon::subDecadesWithNoOverflow](../Carbon/Carbon.md#subdecadeswithnooverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [Carbon::subDecadeWithNoOverflow](../Carbon/Carbon.md#subdecadewithnooverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [Carbon::addDecadesNoOverflow](../Carbon/Carbon.md#adddecadesnooverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [Carbon::addDecadeNoOverflow](../Carbon/Carbon.md#adddecadenooverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [Carbon::subDecadesNoOverflow](../Carbon/Carbon.md#subdecadesnooverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [Carbon::subDecadeNoOverflow](../Carbon/Carbon.md#subdecadenooverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [Carbon::addQuarters](../Carbon/Carbon.md#addquarters) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::addQuarter](../Carbon/Carbon.md#addquarter) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::subQuarters](../Carbon/Carbon.md#subquarters) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::subQuarter](../Carbon/Carbon.md#subquarter) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::addQuartersWithOverflow](../Carbon/Carbon.md#addquarterswithoverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly allowed. |
| $this | [Carbon::addQuarterWithOverflow](../Carbon/Carbon.md#addquarterwithoverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly allowed. |
| $this | [Carbon::subQuartersWithOverflow](../Carbon/Carbon.md#subquarterswithoverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly allowed. |
| $this | [Carbon::subQuarterWithOverflow](../Carbon/Carbon.md#subquarterwithoverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly allowed. |
| $this | [Carbon::addQuartersWithoutOverflow](../Carbon/Carbon.md#addquarterswithoutoverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [Carbon::addQuarterWithoutOverflow](../Carbon/Carbon.md#addquarterwithoutoverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [Carbon::subQuartersWithoutOverflow](../Carbon/Carbon.md#subquarterswithoutoverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [Carbon::subQuarterWithoutOverflow](../Carbon/Carbon.md#subquarterwithoutoverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [Carbon::addQuartersWithNoOverflow](../Carbon/Carbon.md#addquarterswithnooverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [Carbon::addQuarterWithNoOverflow](../Carbon/Carbon.md#addquarterwithnooverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [Carbon::subQuartersWithNoOverflow](../Carbon/Carbon.md#subquarterswithnooverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [Carbon::subQuarterWithNoOverflow](../Carbon/Carbon.md#subquarterwithnooverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [Carbon::addQuartersNoOverflow](../Carbon/Carbon.md#addquartersnooverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [Carbon::addQuarterNoOverflow](../Carbon/Carbon.md#addquarternooverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [Carbon::subQuartersNoOverflow](../Carbon/Carbon.md#subquartersnooverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [Carbon::subQuarterNoOverflow](../Carbon/Carbon.md#subquarternooverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [Carbon::addWeeks](../Carbon/Carbon.md#addweeks) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::addWeek](../Carbon/Carbon.md#addweek) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::subWeeks](../Carbon/Carbon.md#subweeks) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::subWeek](../Carbon/Carbon.md#subweek) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::addWeekdays](../Carbon/Carbon.md#addweekdays) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::addWeekday](../Carbon/Carbon.md#addweekday) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::subWeekdays](../Carbon/Carbon.md#subweekdays) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::subWeekday](../Carbon/Carbon.md#subweekday) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::addUTCMicros](../Carbon/Carbon.md#addutcmicros) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::addUTCMicro](../Carbon/Carbon.md#addutcmicro) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::subUTCMicros](../Carbon/Carbon.md#subutcmicros) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::subUTCMicro](../Carbon/Carbon.md#subutcmicro) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| CarbonPeriod | [Carbon::microsUntil](../Carbon/Carbon.md#microsuntil) _(from [Carbon](../Carbon/Carbon.md))_ | for each microsecond or every X microseconds if a factor is given. |
| float | [Carbon::diffInUTCMicros](../Carbon/Carbon.md#diffinutcmicros) _(from [Carbon](../Carbon/Carbon.md))_ | Convert current and given date in UTC timezone and return a floating number of microseconds. |
| $this | [Carbon::addUTCMicroseconds](../Carbon/Carbon.md#addutcmicroseconds) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::addUTCMicrosecond](../Carbon/Carbon.md#addutcmicrosecond) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::subUTCMicroseconds](../Carbon/Carbon.md#subutcmicroseconds) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::subUTCMicrosecond](../Carbon/Carbon.md#subutcmicrosecond) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| CarbonPeriod | [Carbon::microsecondsUntil](../Carbon/Carbon.md#microsecondsuntil) _(from [Carbon](../Carbon/Carbon.md))_ | for each microsecond or every X microseconds if a factor is given. |
| float | [Carbon::diffInUTCMicroseconds](../Carbon/Carbon.md#diffinutcmicroseconds) _(from [Carbon](../Carbon/Carbon.md))_ | Convert current and given date in UTC timezone and return a floating number of microseconds. |
| $this | [Carbon::addUTCMillis](../Carbon/Carbon.md#addutcmillis) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::addUTCMilli](../Carbon/Carbon.md#addutcmilli) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::subUTCMillis](../Carbon/Carbon.md#subutcmillis) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::subUTCMilli](../Carbon/Carbon.md#subutcmilli) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| CarbonPeriod | [Carbon::millisUntil](../Carbon/Carbon.md#millisuntil) _(from [Carbon](../Carbon/Carbon.md))_ | for each millisecond or every X milliseconds if a factor is given. |
| float | [Carbon::diffInUTCMillis](../Carbon/Carbon.md#diffinutcmillis) _(from [Carbon](../Carbon/Carbon.md))_ | Convert current and given date in UTC timezone and return a floating number of milliseconds. |
| $this | [Carbon::addUTCMilliseconds](../Carbon/Carbon.md#addutcmilliseconds) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::addUTCMillisecond](../Carbon/Carbon.md#addutcmillisecond) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::subUTCMilliseconds](../Carbon/Carbon.md#subutcmilliseconds) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::subUTCMillisecond](../Carbon/Carbon.md#subutcmillisecond) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| CarbonPeriod | [Carbon::millisecondsUntil](../Carbon/Carbon.md#millisecondsuntil) _(from [Carbon](../Carbon/Carbon.md))_ | for each millisecond or every X milliseconds if a factor is given. |
| float | [Carbon::diffInUTCMilliseconds](../Carbon/Carbon.md#diffinutcmilliseconds) _(from [Carbon](../Carbon/Carbon.md))_ | Convert current and given date in UTC timezone and return a floating number of milliseconds. |
| $this | [Carbon::addUTCSeconds](../Carbon/Carbon.md#addutcseconds) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::addUTCSecond](../Carbon/Carbon.md#addutcsecond) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::subUTCSeconds](../Carbon/Carbon.md#subutcseconds) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::subUTCSecond](../Carbon/Carbon.md#subutcsecond) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| CarbonPeriod | [Carbon::secondsUntil](../Carbon/Carbon.md#secondsuntil) _(from [Carbon](../Carbon/Carbon.md))_ | for each second or every X seconds if a factor is given. |
| float | [Carbon::diffInUTCSeconds](../Carbon/Carbon.md#diffinutcseconds) _(from [Carbon](../Carbon/Carbon.md))_ | Convert current and given date in UTC timezone and return a floating number of seconds. |
| $this | [Carbon::addUTCMinutes](../Carbon/Carbon.md#addutcminutes) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::addUTCMinute](../Carbon/Carbon.md#addutcminute) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::subUTCMinutes](../Carbon/Carbon.md#subutcminutes) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::subUTCMinute](../Carbon/Carbon.md#subutcminute) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| CarbonPeriod | [Carbon::minutesUntil](../Carbon/Carbon.md#minutesuntil) _(from [Carbon](../Carbon/Carbon.md))_ | for each minute or every X minutes if a factor is given. |
| float | [Carbon::diffInUTCMinutes](../Carbon/Carbon.md#diffinutcminutes) _(from [Carbon](../Carbon/Carbon.md))_ | Convert current and given date in UTC timezone and return a floating number of minutes. |
| $this | [Carbon::addUTCHours](../Carbon/Carbon.md#addutchours) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::addUTCHour](../Carbon/Carbon.md#addutchour) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::subUTCHours](../Carbon/Carbon.md#subutchours) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::subUTCHour](../Carbon/Carbon.md#subutchour) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| CarbonPeriod | [Carbon::hoursUntil](../Carbon/Carbon.md#hoursuntil) _(from [Carbon](../Carbon/Carbon.md))_ | for each hour or every X hours if a factor is given. |
| float | [Carbon::diffInUTCHours](../Carbon/Carbon.md#diffinutchours) _(from [Carbon](../Carbon/Carbon.md))_ | Convert current and given date in UTC timezone and return a floating number of hours. |
| $this | [Carbon::addUTCDays](../Carbon/Carbon.md#addutcdays) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::addUTCDay](../Carbon/Carbon.md#addutcday) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::subUTCDays](../Carbon/Carbon.md#subutcdays) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::subUTCDay](../Carbon/Carbon.md#subutcday) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| CarbonPeriod | [Carbon::daysUntil](../Carbon/Carbon.md#daysuntil) _(from [Carbon](../Carbon/Carbon.md))_ | for each day or every X days if a factor is given. |
| float | [Carbon::diffInUTCDays](../Carbon/Carbon.md#diffinutcdays) _(from [Carbon](../Carbon/Carbon.md))_ | Convert current and given date in UTC timezone and return a floating number of days. |
| $this | [Carbon::addUTCWeeks](../Carbon/Carbon.md#addutcweeks) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::addUTCWeek](../Carbon/Carbon.md#addutcweek) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::subUTCWeeks](../Carbon/Carbon.md#subutcweeks) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::subUTCWeek](../Carbon/Carbon.md#subutcweek) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| CarbonPeriod | [Carbon::weeksUntil](../Carbon/Carbon.md#weeksuntil) _(from [Carbon](../Carbon/Carbon.md))_ | for each week or every X weeks if a factor is given. |
| float | [Carbon::diffInUTCWeeks](../Carbon/Carbon.md#diffinutcweeks) _(from [Carbon](../Carbon/Carbon.md))_ | Convert current and given date in UTC timezone and return a floating number of weeks. |
| $this | [Carbon::addUTCMonths](../Carbon/Carbon.md#addutcmonths) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::addUTCMonth](../Carbon/Carbon.md#addutcmonth) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::subUTCMonths](../Carbon/Carbon.md#subutcmonths) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::subUTCMonth](../Carbon/Carbon.md#subutcmonth) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| CarbonPeriod | [Carbon::monthsUntil](../Carbon/Carbon.md#monthsuntil) _(from [Carbon](../Carbon/Carbon.md))_ | for each month or every X months if a factor is given. |
| float | [Carbon::diffInUTCMonths](../Carbon/Carbon.md#diffinutcmonths) _(from [Carbon](../Carbon/Carbon.md))_ | Convert current and given date in UTC timezone and return a floating number of months. |
| $this | [Carbon::addUTCQuarters](../Carbon/Carbon.md#addutcquarters) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::addUTCQuarter](../Carbon/Carbon.md#addutcquarter) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::subUTCQuarters](../Carbon/Carbon.md#subutcquarters) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::subUTCQuarter](../Carbon/Carbon.md#subutcquarter) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| CarbonPeriod | [Carbon::quartersUntil](../Carbon/Carbon.md#quartersuntil) _(from [Carbon](../Carbon/Carbon.md))_ | for each quarter or every X quarters if a factor is given. |
| float | [Carbon::diffInUTCQuarters](../Carbon/Carbon.md#diffinutcquarters) _(from [Carbon](../Carbon/Carbon.md))_ | Convert current and given date in UTC timezone and return a floating number of quarters. |
| $this | [Carbon::addUTCYears](../Carbon/Carbon.md#addutcyears) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::addUTCYear](../Carbon/Carbon.md#addutcyear) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::subUTCYears](../Carbon/Carbon.md#subutcyears) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::subUTCYear](../Carbon/Carbon.md#subutcyear) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| CarbonPeriod | [Carbon::yearsUntil](../Carbon/Carbon.md#yearsuntil) _(from [Carbon](../Carbon/Carbon.md))_ | for each year or every X years if a factor is given. |
| float | [Carbon::diffInUTCYears](../Carbon/Carbon.md#diffinutcyears) _(from [Carbon](../Carbon/Carbon.md))_ | Convert current and given date in UTC timezone and return a floating number of years. |
| $this | [Carbon::addUTCDecades](../Carbon/Carbon.md#addutcdecades) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::addUTCDecade](../Carbon/Carbon.md#addutcdecade) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::subUTCDecades](../Carbon/Carbon.md#subutcdecades) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::subUTCDecade](../Carbon/Carbon.md#subutcdecade) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| CarbonPeriod | [Carbon::decadesUntil](../Carbon/Carbon.md#decadesuntil) _(from [Carbon](../Carbon/Carbon.md))_ | for each decade or every X decades if a factor is given. |
| float | [Carbon::diffInUTCDecades](../Carbon/Carbon.md#diffinutcdecades) _(from [Carbon](../Carbon/Carbon.md))_ | Convert current and given date in UTC timezone and return a floating number of decades. |
| $this | [Carbon::addUTCCenturies](../Carbon/Carbon.md#addutccenturies) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::addUTCCentury](../Carbon/Carbon.md#addutccentury) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::subUTCCenturies](../Carbon/Carbon.md#subutccenturies) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::subUTCCentury](../Carbon/Carbon.md#subutccentury) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| CarbonPeriod | [Carbon::centuriesUntil](../Carbon/Carbon.md#centuriesuntil) _(from [Carbon](../Carbon/Carbon.md))_ | for each century or every X centuries if a factor is given. |
| float | [Carbon::diffInUTCCenturies](../Carbon/Carbon.md#diffinutccenturies) _(from [Carbon](../Carbon/Carbon.md))_ | Convert current and given date in UTC timezone and return a floating number of centuries. |
| $this | [Carbon::addUTCMillennia](../Carbon/Carbon.md#addutcmillennia) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::addUTCMillennium](../Carbon/Carbon.md#addutcmillennium) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::subUTCMillennia](../Carbon/Carbon.md#subutcmillennia) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::subUTCMillennium](../Carbon/Carbon.md#subutcmillennium) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| CarbonPeriod | [Carbon::millenniaUntil](../Carbon/Carbon.md#millenniauntil) _(from [Carbon](../Carbon/Carbon.md))_ | for each millennium or every X millennia if a factor is given. |
| float | [Carbon::diffInUTCMillennia](../Carbon/Carbon.md#diffinutcmillennia) _(from [Carbon](../Carbon/Carbon.md))_ | Convert current and given date in UTC timezone and return a floating number of millennia. |
| $this | [Carbon::roundYear](../Carbon/Carbon.md#roundyear) _(from [Carbon](../Carbon/Carbon.md))_ | Round the current instance year with given precision using the given function. |
| $this | [Carbon::roundYears](../Carbon/Carbon.md#roundyears) _(from [Carbon](../Carbon/Carbon.md))_ | Round the current instance year with given precision using the given function. |
| $this | [Carbon::floorYear](../Carbon/Carbon.md#flooryear) _(from [Carbon](../Carbon/Carbon.md))_ | Truncate the current instance year with given precision. |
| $this | [Carbon::floorYears](../Carbon/Carbon.md#flooryears) _(from [Carbon](../Carbon/Carbon.md))_ | Truncate the current instance year with given precision. |
| $this | [Carbon::ceilYear](../Carbon/Carbon.md#ceilyear) _(from [Carbon](../Carbon/Carbon.md))_ | Ceil the current instance year with given precision. |
| $this | [Carbon::ceilYears](../Carbon/Carbon.md#ceilyears) _(from [Carbon](../Carbon/Carbon.md))_ | Ceil the current instance year with given precision. |
| $this | [Carbon::roundMonth](../Carbon/Carbon.md#roundmonth) _(from [Carbon](../Carbon/Carbon.md))_ | Round the current instance month with given precision using the given function. |
| $this | [Carbon::roundMonths](../Carbon/Carbon.md#roundmonths) _(from [Carbon](../Carbon/Carbon.md))_ | Round the current instance month with given precision using the given function. |
| $this | [Carbon::floorMonth](../Carbon/Carbon.md#floormonth) _(from [Carbon](../Carbon/Carbon.md))_ | Truncate the current instance month with given precision. |
| $this | [Carbon::floorMonths](../Carbon/Carbon.md#floormonths) _(from [Carbon](../Carbon/Carbon.md))_ | Truncate the current instance month with given precision. |
| $this | [Carbon::ceilMonth](../Carbon/Carbon.md#ceilmonth) _(from [Carbon](../Carbon/Carbon.md))_ | Ceil the current instance month with given precision. |
| $this | [Carbon::ceilMonths](../Carbon/Carbon.md#ceilmonths) _(from [Carbon](../Carbon/Carbon.md))_ | Ceil the current instance month with given precision. |
| $this | [Carbon::roundDay](../Carbon/Carbon.md#roundday) _(from [Carbon](../Carbon/Carbon.md))_ | Round the current instance day with given precision using the given function. |
| $this | [Carbon::roundDays](../Carbon/Carbon.md#rounddays) _(from [Carbon](../Carbon/Carbon.md))_ | Round the current instance day with given precision using the given function. |
| $this | [Carbon::floorDay](../Carbon/Carbon.md#floorday) _(from [Carbon](../Carbon/Carbon.md))_ | Truncate the current instance day with given precision. |
| $this | [Carbon::floorDays](../Carbon/Carbon.md#floordays) _(from [Carbon](../Carbon/Carbon.md))_ | Truncate the current instance day with given precision. |
| $this | [Carbon::ceilDay](../Carbon/Carbon.md#ceilday) _(from [Carbon](../Carbon/Carbon.md))_ | Ceil the current instance day with given precision. |
| $this | [Carbon::ceilDays](../Carbon/Carbon.md#ceildays) _(from [Carbon](../Carbon/Carbon.md))_ | Ceil the current instance day with given precision. |
| $this | [Carbon::roundHour](../Carbon/Carbon.md#roundhour) _(from [Carbon](../Carbon/Carbon.md))_ | Round the current instance hour with given precision using the given function. |
| $this | [Carbon::roundHours](../Carbon/Carbon.md#roundhours) _(from [Carbon](../Carbon/Carbon.md))_ | Round the current instance hour with given precision using the given function. |
| $this | [Carbon::floorHour](../Carbon/Carbon.md#floorhour) _(from [Carbon](../Carbon/Carbon.md))_ | Truncate the current instance hour with given precision. |
| $this | [Carbon::floorHours](../Carbon/Carbon.md#floorhours) _(from [Carbon](../Carbon/Carbon.md))_ | Truncate the current instance hour with given precision. |
| $this | [Carbon::ceilHour](../Carbon/Carbon.md#ceilhour) _(from [Carbon](../Carbon/Carbon.md))_ | Ceil the current instance hour with given precision. |
| $this | [Carbon::ceilHours](../Carbon/Carbon.md#ceilhours) _(from [Carbon](../Carbon/Carbon.md))_ | Ceil the current instance hour with given precision. |
| $this | [Carbon::roundMinute](../Carbon/Carbon.md#roundminute) _(from [Carbon](../Carbon/Carbon.md))_ | Round the current instance minute with given precision using the given function. |
| $this | [Carbon::roundMinutes](../Carbon/Carbon.md#roundminutes) _(from [Carbon](../Carbon/Carbon.md))_ | Round the current instance minute with given precision using the given function. |
| $this | [Carbon::floorMinute](../Carbon/Carbon.md#floorminute) _(from [Carbon](../Carbon/Carbon.md))_ | Truncate the current instance minute with given precision. |
| $this | [Carbon::floorMinutes](../Carbon/Carbon.md#floorminutes) _(from [Carbon](../Carbon/Carbon.md))_ | Truncate the current instance minute with given precision. |
| $this | [Carbon::ceilMinute](../Carbon/Carbon.md#ceilminute) _(from [Carbon](../Carbon/Carbon.md))_ | Ceil the current instance minute with given precision. |
| $this | [Carbon::ceilMinutes](../Carbon/Carbon.md#ceilminutes) _(from [Carbon](../Carbon/Carbon.md))_ | Ceil the current instance minute with given precision. |
| $this | [Carbon::roundSecond](../Carbon/Carbon.md#roundsecond) _(from [Carbon](../Carbon/Carbon.md))_ | Round the current instance second with given precision using the given function. |
| $this | [Carbon::roundSeconds](../Carbon/Carbon.md#roundseconds) _(from [Carbon](../Carbon/Carbon.md))_ | Round the current instance second with given precision using the given function. |
| $this | [Carbon::floorSecond](../Carbon/Carbon.md#floorsecond) _(from [Carbon](../Carbon/Carbon.md))_ | Truncate the current instance second with given precision. |
| $this | [Carbon::floorSeconds](../Carbon/Carbon.md#floorseconds) _(from [Carbon](../Carbon/Carbon.md))_ | Truncate the current instance second with given precision. |
| $this | [Carbon::ceilSecond](../Carbon/Carbon.md#ceilsecond) _(from [Carbon](../Carbon/Carbon.md))_ | Ceil the current instance second with given precision. |
| $this | [Carbon::ceilSeconds](../Carbon/Carbon.md#ceilseconds) _(from [Carbon](../Carbon/Carbon.md))_ | Ceil the current instance second with given precision. |
| $this | [Carbon::roundMillennium](../Carbon/Carbon.md#roundmillennium) _(from [Carbon](../Carbon/Carbon.md))_ | Round the current instance millennium with given precision using the given function. |
| $this | [Carbon::roundMillennia](../Carbon/Carbon.md#roundmillennia) _(from [Carbon](../Carbon/Carbon.md))_ | Round the current instance millennium with given precision using the given function. |
| $this | [Carbon::floorMillennium](../Carbon/Carbon.md#floormillennium) _(from [Carbon](../Carbon/Carbon.md))_ | Truncate the current instance millennium with given precision. |
| $this | [Carbon::floorMillennia](../Carbon/Carbon.md#floormillennia) _(from [Carbon](../Carbon/Carbon.md))_ | Truncate the current instance millennium with given precision. |
| $this | [Carbon::ceilMillennium](../Carbon/Carbon.md#ceilmillennium) _(from [Carbon](../Carbon/Carbon.md))_ | Ceil the current instance millennium with given precision. |
| $this | [Carbon::ceilMillennia](../Carbon/Carbon.md#ceilmillennia) _(from [Carbon](../Carbon/Carbon.md))_ | Ceil the current instance millennium with given precision. |
| $this | [Carbon::roundCentury](../Carbon/Carbon.md#roundcentury) _(from [Carbon](../Carbon/Carbon.md))_ | Round the current instance century with given precision using the given function. |
| $this | [Carbon::roundCenturies](../Carbon/Carbon.md#roundcenturies) _(from [Carbon](../Carbon/Carbon.md))_ | Round the current instance century with given precision using the given function. |
| $this | [Carbon::floorCentury](../Carbon/Carbon.md#floorcentury) _(from [Carbon](../Carbon/Carbon.md))_ | Truncate the current instance century with given precision. |
| $this | [Carbon::floorCenturies](../Carbon/Carbon.md#floorcenturies) _(from [Carbon](../Carbon/Carbon.md))_ | Truncate the current instance century with given precision. |
| $this | [Carbon::ceilCentury](../Carbon/Carbon.md#ceilcentury) _(from [Carbon](../Carbon/Carbon.md))_ | Ceil the current instance century with given precision. |
| $this | [Carbon::ceilCenturies](../Carbon/Carbon.md#ceilcenturies) _(from [Carbon](../Carbon/Carbon.md))_ | Ceil the current instance century with given precision. |
| $this | [Carbon::roundDecade](../Carbon/Carbon.md#rounddecade) _(from [Carbon](../Carbon/Carbon.md))_ | Round the current instance decade with given precision using the given function. |
| $this | [Carbon::roundDecades](../Carbon/Carbon.md#rounddecades) _(from [Carbon](../Carbon/Carbon.md))_ | Round the current instance decade with given precision using the given function. |
| $this | [Carbon::floorDecade](../Carbon/Carbon.md#floordecade) _(from [Carbon](../Carbon/Carbon.md))_ | Truncate the current instance decade with given precision. |
| $this | [Carbon::floorDecades](../Carbon/Carbon.md#floordecades) _(from [Carbon](../Carbon/Carbon.md))_ | Truncate the current instance decade with given precision. |
| $this | [Carbon::ceilDecade](../Carbon/Carbon.md#ceildecade) _(from [Carbon](../Carbon/Carbon.md))_ | Ceil the current instance decade with given precision. |
| $this | [Carbon::ceilDecades](../Carbon/Carbon.md#ceildecades) _(from [Carbon](../Carbon/Carbon.md))_ | Ceil the current instance decade with given precision. |
| $this | [Carbon::roundQuarter](../Carbon/Carbon.md#roundquarter) _(from [Carbon](../Carbon/Carbon.md))_ | Round the current instance quarter with given precision using the given function. |
| $this | [Carbon::roundQuarters](../Carbon/Carbon.md#roundquarters) _(from [Carbon](../Carbon/Carbon.md))_ | Round the current instance quarter with given precision using the given function. |
| $this | [Carbon::floorQuarter](../Carbon/Carbon.md#floorquarter) _(from [Carbon](../Carbon/Carbon.md))_ | Truncate the current instance quarter with given precision. |
| $this | [Carbon::floorQuarters](../Carbon/Carbon.md#floorquarters) _(from [Carbon](../Carbon/Carbon.md))_ | Truncate the current instance quarter with given precision. |
| $this | [Carbon::ceilQuarter](../Carbon/Carbon.md#ceilquarter) _(from [Carbon](../Carbon/Carbon.md))_ | Ceil the current instance quarter with given precision. |
| $this | [Carbon::ceilQuarters](../Carbon/Carbon.md#ceilquarters) _(from [Carbon](../Carbon/Carbon.md))_ | Ceil the current instance quarter with given precision. |
| $this | [Carbon::roundMillisecond](../Carbon/Carbon.md#roundmillisecond) _(from [Carbon](../Carbon/Carbon.md))_ | Round the current instance millisecond with given precision using the given function. |
| $this | [Carbon::roundMilliseconds](../Carbon/Carbon.md#roundmilliseconds) _(from [Carbon](../Carbon/Carbon.md))_ | Round the current instance millisecond with given precision using the given function. |
| $this | [Carbon::floorMillisecond](../Carbon/Carbon.md#floormillisecond) _(from [Carbon](../Carbon/Carbon.md))_ | Truncate the current instance millisecond with given precision. |
| $this | [Carbon::floorMilliseconds](../Carbon/Carbon.md#floormilliseconds) _(from [Carbon](../Carbon/Carbon.md))_ | Truncate the current instance millisecond with given precision. |
| $this | [Carbon::ceilMillisecond](../Carbon/Carbon.md#ceilmillisecond) _(from [Carbon](../Carbon/Carbon.md))_ | Ceil the current instance millisecond with given precision. |
| $this | [Carbon::ceilMilliseconds](../Carbon/Carbon.md#ceilmilliseconds) _(from [Carbon](../Carbon/Carbon.md))_ | Ceil the current instance millisecond with given precision. |
| $this | [Carbon::roundMicrosecond](../Carbon/Carbon.md#roundmicrosecond) _(from [Carbon](../Carbon/Carbon.md))_ | Round the current instance microsecond with given precision using the given function. |
| $this | [Carbon::roundMicroseconds](../Carbon/Carbon.md#roundmicroseconds) _(from [Carbon](../Carbon/Carbon.md))_ | Round the current instance microsecond with given precision using the given function. |
| $this | [Carbon::floorMicrosecond](../Carbon/Carbon.md#floormicrosecond) _(from [Carbon](../Carbon/Carbon.md))_ | Truncate the current instance microsecond with given precision. |
| $this | [Carbon::floorMicroseconds](../Carbon/Carbon.md#floormicroseconds) _(from [Carbon](../Carbon/Carbon.md))_ | Truncate the current instance microsecond with given precision. |
| $this | [Carbon::ceilMicrosecond](../Carbon/Carbon.md#ceilmicrosecond) _(from [Carbon](../Carbon/Carbon.md))_ | Ceil the current instance microsecond with given precision. |
| $this | [Carbon::ceilMicroseconds](../Carbon/Carbon.md#ceilmicroseconds) _(from [Carbon](../Carbon/Carbon.md))_ | Ceil the current instance microsecond with given precision. |
| string | [Carbon::shortAbsoluteDiffForHumans](../Carbon/Carbon.md#shortabsolutediffforhumans) _(from [Carbon](../Carbon/Carbon.md))_ |  |
| string | [Carbon::longAbsoluteDiffForHumans](../Carbon/Carbon.md#longabsolutediffforhumans) _(from [Carbon](../Carbon/Carbon.md))_ |  |
| string | [Carbon::shortRelativeDiffForHumans](../Carbon/Carbon.md#shortrelativediffforhumans) _(from [Carbon](../Carbon/Carbon.md))_ |  |
| string | [Carbon::longRelativeDiffForHumans](../Carbon/Carbon.md#longrelativediffforhumans) _(from [Carbon](../Carbon/Carbon.md))_ |  |
| string | [Carbon::shortRelativeToNowDiffForHumans](../Carbon/Carbon.md#shortrelativetonowdiffforhumans) _(from [Carbon](../Carbon/Carbon.md))_ |  |
| string | [Carbon::longRelativeToNowDiffForHumans](../Carbon/Carbon.md#longrelativetonowdiffforhumans) _(from [Carbon](../Carbon/Carbon.md))_ |  |
| string | [Carbon::shortRelativeToOtherDiffForHumans](../Carbon/Carbon.md#shortrelativetootherdiffforhumans) _(from [Carbon](../Carbon/Carbon.md))_ |  |
| string | [Carbon::longRelativeToOtherDiffForHumans](../Carbon/Carbon.md#longrelativetootherdiffforhumans) _(from [Carbon](../Carbon/Carbon.md))_ |  |
| int | [Carbon::centuriesInMillennium](../Carbon/Carbon.md#centuriesinmillennium) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of centuries contained in the current millennium |
| int|static | [Carbon::centuryOfMillennium](../Carbon/Carbon.md#centuryofmillennium) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the century starting from the beginning of the current millennium when called with no parameters, change the current century when called with an integer value |
| int|static | [Carbon::dayOfCentury](../Carbon/Carbon.md#dayofcentury) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the day starting from the beginning of the current century when called with no parameters, change the current day when called with an integer value |
| int|static | [Carbon::dayOfDecade](../Carbon/Carbon.md#dayofdecade) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the day starting from the beginning of the current decade when called with no parameters, change the current day when called with an integer value |
| int|static | [Carbon::dayOfMillennium](../Carbon/Carbon.md#dayofmillennium) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the day starting from the beginning of the current millennium when called with no parameters, change the current day when called with an integer value |
| int|static | [Carbon::dayOfMonth](../Carbon/Carbon.md#dayofmonth) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the day starting from the beginning of the current month when called with no parameters, change the current day when called with an integer value |
| int|static | [Carbon::dayOfQuarter](../Carbon/Carbon.md#dayofquarter) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the day starting from the beginning of the current quarter when called with no parameters, change the current day when called with an integer value |
| int|static | [Carbon::dayOfWeek](../Carbon/Carbon.md#dayofweek) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the day starting from the beginning of the current week when called with no parameters, change the current day when called with an integer value |
| int | [Carbon::daysInCentury](../Carbon/Carbon.md#daysincentury) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of days contained in the current century |
| int | [Carbon::daysInDecade](../Carbon/Carbon.md#daysindecade) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of days contained in the current decade |
| int | [Carbon::daysInMillennium](../Carbon/Carbon.md#daysinmillennium) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of days contained in the current millennium |
| int | [Carbon::daysInMonth](../Carbon/Carbon.md#daysinmonth) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of days contained in the current month |
| int | [Carbon::daysInQuarter](../Carbon/Carbon.md#daysinquarter) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of days contained in the current quarter |
| int | [Carbon::daysInWeek](../Carbon/Carbon.md#daysinweek) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of days contained in the current week |
| int | [Carbon::daysInYear](../Carbon/Carbon.md#daysinyear) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of days contained in the current year |
| int|static | [Carbon::decadeOfCentury](../Carbon/Carbon.md#decadeofcentury) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the decade starting from the beginning of the current century when called with no parameters, change the current decade when called with an integer value |
| int|static | [Carbon::decadeOfMillennium](../Carbon/Carbon.md#decadeofmillennium) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the decade starting from the beginning of the current millennium when called with no parameters, change the current decade when called with an integer value |
| int | [Carbon::decadesInCentury](../Carbon/Carbon.md#decadesincentury) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of decades contained in the current century |
| int | [Carbon::decadesInMillennium](../Carbon/Carbon.md#decadesinmillennium) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of decades contained in the current millennium |
| int|static | [Carbon::hourOfCentury](../Carbon/Carbon.md#hourofcentury) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the hour starting from the beginning of the current century when called with no parameters, change the current hour when called with an integer value |
| int|static | [Carbon::hourOfDay](../Carbon/Carbon.md#hourofday) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the hour starting from the beginning of the current day when called with no parameters, change the current hour when called with an integer value |
| int|static | [Carbon::hourOfDecade](../Carbon/Carbon.md#hourofdecade) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the hour starting from the beginning of the current decade when called with no parameters, change the current hour when called with an integer value |
| int|static | [Carbon::hourOfMillennium](../Carbon/Carbon.md#hourofmillennium) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the hour starting from the beginning of the current millennium when called with no parameters, change the current hour when called with an integer value |
| int|static | [Carbon::hourOfMonth](../Carbon/Carbon.md#hourofmonth) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the hour starting from the beginning of the current month when called with no parameters, change the current hour when called with an integer value |
| int|static | [Carbon::hourOfQuarter](../Carbon/Carbon.md#hourofquarter) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the hour starting from the beginning of the current quarter when called with no parameters, change the current hour when called with an integer value |
| int|static | [Carbon::hourOfWeek](../Carbon/Carbon.md#hourofweek) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the hour starting from the beginning of the current week when called with no parameters, change the current hour when called with an integer value |
| int|static | [Carbon::hourOfYear](../Carbon/Carbon.md#hourofyear) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the hour starting from the beginning of the current year when called with no parameters, change the current hour when called with an integer value |
| int | [Carbon::hoursInCentury](../Carbon/Carbon.md#hoursincentury) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of hours contained in the current century |
| int | [Carbon::hoursInDay](../Carbon/Carbon.md#hoursinday) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of hours contained in the current day |
| int | [Carbon::hoursInDecade](../Carbon/Carbon.md#hoursindecade) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of hours contained in the current decade |
| int | [Carbon::hoursInMillennium](../Carbon/Carbon.md#hoursinmillennium) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of hours contained in the current millennium |
| int | [Carbon::hoursInMonth](../Carbon/Carbon.md#hoursinmonth) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of hours contained in the current month |
| int | [Carbon::hoursInQuarter](../Carbon/Carbon.md#hoursinquarter) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of hours contained in the current quarter |
| int | [Carbon::hoursInWeek](../Carbon/Carbon.md#hoursinweek) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of hours contained in the current week |
| int | [Carbon::hoursInYear](../Carbon/Carbon.md#hoursinyear) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of hours contained in the current year |
| int|static | [Carbon::microsecondOfCentury](../Carbon/Carbon.md#microsecondofcentury) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the microsecond starting from the beginning of the current century when called with no parameters, change the current microsecond when called with an integer value |
| int|static | [Carbon::microsecondOfDay](../Carbon/Carbon.md#microsecondofday) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the microsecond starting from the beginning of the current day when called with no parameters, change the current microsecond when called with an integer value |
| int|static | [Carbon::microsecondOfDecade](../Carbon/Carbon.md#microsecondofdecade) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the microsecond starting from the beginning of the current decade when called with no parameters, change the current microsecond when called with an integer value |
| int|static | [Carbon::microsecondOfHour](../Carbon/Carbon.md#microsecondofhour) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the microsecond starting from the beginning of the current hour when called with no parameters, change the current microsecond when called with an integer value |
| int|static | [Carbon::microsecondOfMillennium](../Carbon/Carbon.md#microsecondofmillennium) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the microsecond starting from the beginning of the current millennium when called with no parameters, change the current microsecond when called with an integer value |
| int|static | [Carbon::microsecondOfMillisecond](../Carbon/Carbon.md#microsecondofmillisecond) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the microsecond starting from the beginning of the current millisecond when called with no parameters, change the current microsecond when called with an integer value |
| int|static | [Carbon::microsecondOfMinute](../Carbon/Carbon.md#microsecondofminute) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the microsecond starting from the beginning of the current minute when called with no parameters, change the current microsecond when called with an integer value |
| int|static | [Carbon::microsecondOfMonth](../Carbon/Carbon.md#microsecondofmonth) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the microsecond starting from the beginning of the current month when called with no parameters, change the current microsecond when called with an integer value |
| int|static | [Carbon::microsecondOfQuarter](../Carbon/Carbon.md#microsecondofquarter) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the microsecond starting from the beginning of the current quarter when called with no parameters, change the current microsecond when called with an integer value |
| int|static | [Carbon::microsecondOfSecond](../Carbon/Carbon.md#microsecondofsecond) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the microsecond starting from the beginning of the current second when called with no parameters, change the current microsecond when called with an integer value |
| int|static | [Carbon::microsecondOfWeek](../Carbon/Carbon.md#microsecondofweek) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the microsecond starting from the beginning of the current week when called with no parameters, change the current microsecond when called with an integer value |
| int|static | [Carbon::microsecondOfYear](../Carbon/Carbon.md#microsecondofyear) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the microsecond starting from the beginning of the current year when called with no parameters, change the current microsecond when called with an integer value |
| int | [Carbon::microsecondsInCentury](../Carbon/Carbon.md#microsecondsincentury) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of microseconds contained in the current century |
| int | [Carbon::microsecondsInDay](../Carbon/Carbon.md#microsecondsinday) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of microseconds contained in the current day |
| int | [Carbon::microsecondsInDecade](../Carbon/Carbon.md#microsecondsindecade) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of microseconds contained in the current decade |
| int | [Carbon::microsecondsInHour](../Carbon/Carbon.md#microsecondsinhour) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of microseconds contained in the current hour |
| int | [Carbon::microsecondsInMillennium](../Carbon/Carbon.md#microsecondsinmillennium) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of microseconds contained in the current millennium |
| int | [Carbon::microsecondsInMillisecond](../Carbon/Carbon.md#microsecondsinmillisecond) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of microseconds contained in the current millisecond |
| int | [Carbon::microsecondsInMinute](../Carbon/Carbon.md#microsecondsinminute) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of microseconds contained in the current minute |
| int | [Carbon::microsecondsInMonth](../Carbon/Carbon.md#microsecondsinmonth) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of microseconds contained in the current month |
| int | [Carbon::microsecondsInQuarter](../Carbon/Carbon.md#microsecondsinquarter) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of microseconds contained in the current quarter |
| int | [Carbon::microsecondsInSecond](../Carbon/Carbon.md#microsecondsinsecond) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of microseconds contained in the current second |
| int | [Carbon::microsecondsInWeek](../Carbon/Carbon.md#microsecondsinweek) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of microseconds contained in the current week |
| int | [Carbon::microsecondsInYear](../Carbon/Carbon.md#microsecondsinyear) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of microseconds contained in the current year |
| int|static | [Carbon::millisecondOfCentury](../Carbon/Carbon.md#millisecondofcentury) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the millisecond starting from the beginning of the current century when called with no parameters, change the current millisecond when called with an integer value |
| int|static | [Carbon::millisecondOfDay](../Carbon/Carbon.md#millisecondofday) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the millisecond starting from the beginning of the current day when called with no parameters, change the current millisecond when called with an integer value |
| int|static | [Carbon::millisecondOfDecade](../Carbon/Carbon.md#millisecondofdecade) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the millisecond starting from the beginning of the current decade when called with no parameters, change the current millisecond when called with an integer value |
| int|static | [Carbon::millisecondOfHour](../Carbon/Carbon.md#millisecondofhour) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the millisecond starting from the beginning of the current hour when called with no parameters, change the current millisecond when called with an integer value |
| int|static | [Carbon::millisecondOfMillennium](../Carbon/Carbon.md#millisecondofmillennium) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the millisecond starting from the beginning of the current millennium when called with no parameters, change the current millisecond when called with an integer value |
| int|static | [Carbon::millisecondOfMinute](../Carbon/Carbon.md#millisecondofminute) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the millisecond starting from the beginning of the current minute when called with no parameters, change the current millisecond when called with an integer value |
| int|static | [Carbon::millisecondOfMonth](../Carbon/Carbon.md#millisecondofmonth) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the millisecond starting from the beginning of the current month when called with no parameters, change the current millisecond when called with an integer value |
| int|static | [Carbon::millisecondOfQuarter](../Carbon/Carbon.md#millisecondofquarter) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the millisecond starting from the beginning of the current quarter when called with no parameters, change the current millisecond when called with an integer value |
| int|static | [Carbon::millisecondOfSecond](../Carbon/Carbon.md#millisecondofsecond) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the millisecond starting from the beginning of the current second when called with no parameters, change the current millisecond when called with an integer value |
| int|static | [Carbon::millisecondOfWeek](../Carbon/Carbon.md#millisecondofweek) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the millisecond starting from the beginning of the current week when called with no parameters, change the current millisecond when called with an integer value |
| int|static | [Carbon::millisecondOfYear](../Carbon/Carbon.md#millisecondofyear) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the millisecond starting from the beginning of the current year when called with no parameters, change the current millisecond when called with an integer value |
| int | [Carbon::millisecondsInCentury](../Carbon/Carbon.md#millisecondsincentury) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of milliseconds contained in the current century |
| int | [Carbon::millisecondsInDay](../Carbon/Carbon.md#millisecondsinday) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of milliseconds contained in the current day |
| int | [Carbon::millisecondsInDecade](../Carbon/Carbon.md#millisecondsindecade) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of milliseconds contained in the current decade |
| int | [Carbon::millisecondsInHour](../Carbon/Carbon.md#millisecondsinhour) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of milliseconds contained in the current hour |
| int | [Carbon::millisecondsInMillennium](../Carbon/Carbon.md#millisecondsinmillennium) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of milliseconds contained in the current millennium |
| int | [Carbon::millisecondsInMinute](../Carbon/Carbon.md#millisecondsinminute) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of milliseconds contained in the current minute |
| int | [Carbon::millisecondsInMonth](../Carbon/Carbon.md#millisecondsinmonth) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of milliseconds contained in the current month |
| int | [Carbon::millisecondsInQuarter](../Carbon/Carbon.md#millisecondsinquarter) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of milliseconds contained in the current quarter |
| int | [Carbon::millisecondsInSecond](../Carbon/Carbon.md#millisecondsinsecond) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of milliseconds contained in the current second |
| int | [Carbon::millisecondsInWeek](../Carbon/Carbon.md#millisecondsinweek) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of milliseconds contained in the current week |
| int | [Carbon::millisecondsInYear](../Carbon/Carbon.md#millisecondsinyear) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of milliseconds contained in the current year |
| int|static | [Carbon::minuteOfCentury](../Carbon/Carbon.md#minuteofcentury) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the minute starting from the beginning of the current century when called with no parameters, change the current minute when called with an integer value |
| int|static | [Carbon::minuteOfDay](../Carbon/Carbon.md#minuteofday) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the minute starting from the beginning of the current day when called with no parameters, change the current minute when called with an integer value |
| int|static | [Carbon::minuteOfDecade](../Carbon/Carbon.md#minuteofdecade) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the minute starting from the beginning of the current decade when called with no parameters, change the current minute when called with an integer value |
| int|static | [Carbon::minuteOfHour](../Carbon/Carbon.md#minuteofhour) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the minute starting from the beginning of the current hour when called with no parameters, change the current minute when called with an integer value |
| int|static | [Carbon::minuteOfMillennium](../Carbon/Carbon.md#minuteofmillennium) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the minute starting from the beginning of the current millennium when called with no parameters, change the current minute when called with an integer value |
| int|static | [Carbon::minuteOfMonth](../Carbon/Carbon.md#minuteofmonth) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the minute starting from the beginning of the current month when called with no parameters, change the current minute when called with an integer value |
| int|static | [Carbon::minuteOfQuarter](../Carbon/Carbon.md#minuteofquarter) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the minute starting from the beginning of the current quarter when called with no parameters, change the current minute when called with an integer value |
| int|static | [Carbon::minuteOfWeek](../Carbon/Carbon.md#minuteofweek) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the minute starting from the beginning of the current week when called with no parameters, change the current minute when called with an integer value |
| int|static | [Carbon::minuteOfYear](../Carbon/Carbon.md#minuteofyear) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the minute starting from the beginning of the current year when called with no parameters, change the current minute when called with an integer value |
| int | [Carbon::minutesInCentury](../Carbon/Carbon.md#minutesincentury) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of minutes contained in the current century |
| int | [Carbon::minutesInDay](../Carbon/Carbon.md#minutesinday) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of minutes contained in the current day |
| int | [Carbon::minutesInDecade](../Carbon/Carbon.md#minutesindecade) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of minutes contained in the current decade |
| int | [Carbon::minutesInHour](../Carbon/Carbon.md#minutesinhour) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of minutes contained in the current hour |
| int | [Carbon::minutesInMillennium](../Carbon/Carbon.md#minutesinmillennium) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of minutes contained in the current millennium |
| int | [Carbon::minutesInMonth](../Carbon/Carbon.md#minutesinmonth) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of minutes contained in the current month |
| int | [Carbon::minutesInQuarter](../Carbon/Carbon.md#minutesinquarter) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of minutes contained in the current quarter |
| int | [Carbon::minutesInWeek](../Carbon/Carbon.md#minutesinweek) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of minutes contained in the current week |
| int | [Carbon::minutesInYear](../Carbon/Carbon.md#minutesinyear) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of minutes contained in the current year |
| int|static | [Carbon::monthOfCentury](../Carbon/Carbon.md#monthofcentury) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the month starting from the beginning of the current century when called with no parameters, change the current month when called with an integer value |
| int|static | [Carbon::monthOfDecade](../Carbon/Carbon.md#monthofdecade) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the month starting from the beginning of the current decade when called with no parameters, change the current month when called with an integer value |
| int|static | [Carbon::monthOfMillennium](../Carbon/Carbon.md#monthofmillennium) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the month starting from the beginning of the current millennium when called with no parameters, change the current month when called with an integer value |
| int|static | [Carbon::monthOfQuarter](../Carbon/Carbon.md#monthofquarter) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the month starting from the beginning of the current quarter when called with no parameters, change the current month when called with an integer value |
| int|static | [Carbon::monthOfYear](../Carbon/Carbon.md#monthofyear) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the month starting from the beginning of the current year when called with no parameters, change the current month when called with an integer value |
| int | [Carbon::monthsInCentury](../Carbon/Carbon.md#monthsincentury) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of months contained in the current century |
| int | [Carbon::monthsInDecade](../Carbon/Carbon.md#monthsindecade) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of months contained in the current decade |
| int | [Carbon::monthsInMillennium](../Carbon/Carbon.md#monthsinmillennium) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of months contained in the current millennium |
| int | [Carbon::monthsInQuarter](../Carbon/Carbon.md#monthsinquarter) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of months contained in the current quarter |
| int | [Carbon::monthsInYear](../Carbon/Carbon.md#monthsinyear) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of months contained in the current year |
| int|static | [Carbon::quarterOfCentury](../Carbon/Carbon.md#quarterofcentury) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the quarter starting from the beginning of the current century when called with no parameters, change the current quarter when called with an integer value |
| int|static | [Carbon::quarterOfDecade](../Carbon/Carbon.md#quarterofdecade) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the quarter starting from the beginning of the current decade when called with no parameters, change the current quarter when called with an integer value |
| int|static | [Carbon::quarterOfMillennium](../Carbon/Carbon.md#quarterofmillennium) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the quarter starting from the beginning of the current millennium when called with no parameters, change the current quarter when called with an integer value |
| int|static | [Carbon::quarterOfYear](../Carbon/Carbon.md#quarterofyear) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the quarter starting from the beginning of the current year when called with no parameters, change the current quarter when called with an integer value |
| int | [Carbon::quartersInCentury](../Carbon/Carbon.md#quartersincentury) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of quarters contained in the current century |
| int | [Carbon::quartersInDecade](../Carbon/Carbon.md#quartersindecade) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of quarters contained in the current decade |
| int | [Carbon::quartersInMillennium](../Carbon/Carbon.md#quartersinmillennium) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of quarters contained in the current millennium |
| int | [Carbon::quartersInYear](../Carbon/Carbon.md#quartersinyear) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of quarters contained in the current year |
| int|static | [Carbon::secondOfCentury](../Carbon/Carbon.md#secondofcentury) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the second starting from the beginning of the current century when called with no parameters, change the current second when called with an integer value |
| int|static | [Carbon::secondOfDay](../Carbon/Carbon.md#secondofday) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the second starting from the beginning of the current day when called with no parameters, change the current second when called with an integer value |
| int|static | [Carbon::secondOfDecade](../Carbon/Carbon.md#secondofdecade) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the second starting from the beginning of the current decade when called with no parameters, change the current second when called with an integer value |
| int|static | [Carbon::secondOfHour](../Carbon/Carbon.md#secondofhour) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the second starting from the beginning of the current hour when called with no parameters, change the current second when called with an integer value |
| int|static | [Carbon::secondOfMillennium](../Carbon/Carbon.md#secondofmillennium) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the second starting from the beginning of the current millennium when called with no parameters, change the current second when called with an integer value |
| int|static | [Carbon::secondOfMinute](../Carbon/Carbon.md#secondofminute) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the second starting from the beginning of the current minute when called with no parameters, change the current second when called with an integer value |
| int|static | [Carbon::secondOfMonth](../Carbon/Carbon.md#secondofmonth) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the second starting from the beginning of the current month when called with no parameters, change the current second when called with an integer value |
| int|static | [Carbon::secondOfQuarter](../Carbon/Carbon.md#secondofquarter) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the second starting from the beginning of the current quarter when called with no parameters, change the current second when called with an integer value |
| int|static | [Carbon::secondOfWeek](../Carbon/Carbon.md#secondofweek) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the second starting from the beginning of the current week when called with no parameters, change the current second when called with an integer value |
| int|static | [Carbon::secondOfYear](../Carbon/Carbon.md#secondofyear) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the second starting from the beginning of the current year when called with no parameters, change the current second when called with an integer value |
| int | [Carbon::secondsInCentury](../Carbon/Carbon.md#secondsincentury) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of seconds contained in the current century |
| int | [Carbon::secondsInDay](../Carbon/Carbon.md#secondsinday) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of seconds contained in the current day |
| int | [Carbon::secondsInDecade](../Carbon/Carbon.md#secondsindecade) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of seconds contained in the current decade |
| int | [Carbon::secondsInHour](../Carbon/Carbon.md#secondsinhour) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of seconds contained in the current hour |
| int | [Carbon::secondsInMillennium](../Carbon/Carbon.md#secondsinmillennium) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of seconds contained in the current millennium |
| int | [Carbon::secondsInMinute](../Carbon/Carbon.md#secondsinminute) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of seconds contained in the current minute |
| int | [Carbon::secondsInMonth](../Carbon/Carbon.md#secondsinmonth) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of seconds contained in the current month |
| int | [Carbon::secondsInQuarter](../Carbon/Carbon.md#secondsinquarter) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of seconds contained in the current quarter |
| int | [Carbon::secondsInWeek](../Carbon/Carbon.md#secondsinweek) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of seconds contained in the current week |
| int | [Carbon::secondsInYear](../Carbon/Carbon.md#secondsinyear) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of seconds contained in the current year |
| int|static | [Carbon::weekOfCentury](../Carbon/Carbon.md#weekofcentury) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the week starting from the beginning of the current century when called with no parameters, change the current week when called with an integer value |
| int|static | [Carbon::weekOfDecade](../Carbon/Carbon.md#weekofdecade) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the week starting from the beginning of the current decade when called with no parameters, change the current week when called with an integer value |
| int|static | [Carbon::weekOfMillennium](../Carbon/Carbon.md#weekofmillennium) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the week starting from the beginning of the current millennium when called with no parameters, change the current week when called with an integer value |
| int|static | [Carbon::weekOfMonth](../Carbon/Carbon.md#weekofmonth) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the week starting from the beginning of the current month when called with no parameters, change the current week when called with an integer value |
| int|static | [Carbon::weekOfQuarter](../Carbon/Carbon.md#weekofquarter) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the week starting from the beginning of the current quarter when called with no parameters, change the current week when called with an integer value |
| int|static | [Carbon::weekOfYear](../Carbon/Carbon.md#weekofyear) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the week starting from the beginning of the current year when called with no parameters, change the current week when called with an integer value |
| int | [Carbon::weeksInCentury](../Carbon/Carbon.md#weeksincentury) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of weeks contained in the current century |
| int | [Carbon::weeksInDecade](../Carbon/Carbon.md#weeksindecade) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of weeks contained in the current decade |
| int | [Carbon::weeksInMillennium](../Carbon/Carbon.md#weeksinmillennium) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of weeks contained in the current millennium |
| int | [Carbon::weeksInMonth](../Carbon/Carbon.md#weeksinmonth) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of weeks contained in the current month |
| int | [Carbon::weeksInQuarter](../Carbon/Carbon.md#weeksinquarter) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of weeks contained in the current quarter |
| int|static | [Carbon::yearOfCentury](../Carbon/Carbon.md#yearofcentury) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the year starting from the beginning of the current century when called with no parameters, change the current year when called with an integer value |
| int|static | [Carbon::yearOfDecade](../Carbon/Carbon.md#yearofdecade) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the year starting from the beginning of the current decade when called with no parameters, change the current year when called with an integer value |
| int|static | [Carbon::yearOfMillennium](../Carbon/Carbon.md#yearofmillennium) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the year starting from the beginning of the current millennium when called with no parameters, change the current year when called with an integer value |
| int | [Carbon::yearsInCentury](../Carbon/Carbon.md#yearsincentury) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of years contained in the current century |
| int | [Carbon::yearsInDecade](../Carbon/Carbon.md#yearsindecade) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of years contained in the current decade |
| int | [Carbon::yearsInMillennium](../Carbon/Carbon.md#yearsinmillennium) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of years contained in the current millennium |

---

## Method Details

### factory

```php
static public Factory factory($date_time = null, $time_zone = null)
```

多様な型の引数から {\JapaneseDate\DateTime} / {\JapaneseDate\DateTimeImmutable}
インスタンスを生成するユニバーサルファクトリメソッドです。

Carbon の `parse()` や `new DateTime()` は第一引数に文字列しか受け付けませんが、
このメソッドは以下のすべての型を安全に受け付けます。

**引数の型別動作:**

| 型                               | 動作                                                                                    |
|----------------------------------|-----------------------------------------------------------------------------------------|
| `int`                            | Unix タイムスタンプとして `@timestamp` 形式でインスタンス化。`$time_zone` 指定時はその後変換する |
| `float`                          | マイクロ秒付き Unix タイムスタンプとして処理。`$time_zone` 指定時はその後変換する              |
| 小数点付き数字文字列             | `float` と同様に処理（例: `'1710936896.75'`）                                             |
| `DateTimeInterface`              | `Y-m-d H:i:s.u` 形式でコピーを生成（マイクロ秒保持）。`$time_zone` 省略時は元 TZ を引き継ぐ  |
| 8桁の数字文字列（`YYYYMMDD`）    | `strtotime()` でパースし日付文字列に変換してインスタンス化                                   |
| その他の数字のみの文字列         | `(int)` キャストして Unix タイムスタンプとして日付文字列に変換しインスタンス化                  |
| 和暦・JIS元号形式の文字列        | `JisEra::parseJisDate()` で変換。`$time_zone` 省略時は Asia/Tokyo を使用                   |
| 西暦標準形式の文字列（`YYYY-MM-DD` 等） | `JisEra::parseJisDate()` で変換。`$time_zone` 省略時は Asia/Tokyo を使用            |
| その他の文字列                   | Carbon のコンストラクタに委譲（相対・絶対表現に対応）                                        |
| `null`                           | 現在日時を使用                                                                            |

**使用例:**

```php
// Unix タイムスタンプ（int）から生成する
$dt = DateTime::factory(1609459200);

// Unix タイムスタンプ（float、マイクロ秒付き）から生成する
$dt = DateTime::factory(1710936896.750123);

// 既存の DateTimeInterface オブジェクトから生成する
$dt = DateTime::factory(new \DateTime('2026-05-01'));

// 西暦標準形式（ハイフン・スラッシュ区切り、時刻省略可）
$dt = DateTime::factory('2026-05-01 12:34:56');
$dt = DateTime::factory('2026/05/01 12:34');   // 秒省略
$dt = DateTime::factory('2026-05-01');          // 時刻省略

// 西暦日本語表記（時刻省略可）
$dt = DateTime::factory('2026年5月1日');
$dt = DateTime::factory('2026年5月1日 12時34分');
$dt = DateTime::factory('2026年5月1日 12時34分56秒');

// 元号漢字表記（明治・大正・昭和・平成・令和、時刻省略可）
$dt = DateTime::factory('令和7年5月1日');
$dt = DateTime::factory('昭和64年1月7日 12時34分56秒');

// JIS元号アルファベット表記（M/T/S/H/R、ハイフン・スラッシュ区切り）
$dt = DateTime::factory('R7-05-01');   // 令和
$dt = DateTime::factory('H1/01/08');   // 平成
$dt = DateTime::factory('S64-01-07');  // 昭和

// マイクロ秒付き（すべての文字列形式で末尾に `.NNNNNN` を付加可能）
$dt = DateTime::factory('2026-05-01 12:34:56.123456');
$dt = DateTime::factory('令和7年5月1日 12時34分56秒.500000');

// タイムゾーンを指定して生成する
$dt = DateTime::factory('2026-05-01 12:34:56', new \DateTimeZone('Asia/Tokyo'));
```

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int\|float\|string\|[DateTimeInterface](https://www.php.net/class.datetimeinterface)\|null | `$date_time` | `null` | 
生成元となる日時値。Unix タイムスタンプ（int/float）、
{\DateTimeInterface} の実装オブジェクト、
日時文字列（西暦・和暦・相対表現に対応）、または null（現在日時）を渡せます。 |
| [DateTimeZone](https://www.php.net/class.datetimezone)\|null | `$time_zone` | `null` | 
使用するタイムゾーン。省略した場合の挙動は引数の型によって異なります（型別動作の表を参照）。 |

**Returns:** Factory — 指定した日時を表す新しいインスタンス
**Throws:**

- [NativeDateTimeException](../JapaneseDate/Exceptions/NativeDateTimeException.md)
---

### setCacheMode

```php
static public void setCacheMode($mode)
```

旧暦・祝日計算に使用するキャッシュモードを設定します。

キャッシュモードを切り替えることで、計算結果の保存方式を変更できます。
設定は静的に保持されるため、同一プロセス内では次に `setCacheMode()` が
呼ばれるまで有効です。

**使用例:**
```php
use JapaneseDate\CacheMode;
use JapaneseDate\DateTime;

// キャッシュを無効化する
DateTime::setCacheMode(CacheMode::MODE_NONE);

// APC を使用する
DateTime::setCacheMode(CacheMode::MODE_APC);
```

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$mode` | —  | キャッシュモードを表す定数 |

**Returns:** void
**See also:**

- CacheMode::MODE_AUTO — 自動（デフォルト）: APC が利用可能なら APC、そうでなければ静的キャッシュ
- CacheMode::MODE_APC — APCu を使用したプロセス間共有キャッシュ
- CacheMode::MODE_FILE — ファイルシステムを使用したキャッシュ
- CacheMode::MODE_ORIGINAL — 独自キャッシュロジック（{@see setCacheClosure()} と組み合わせて使用）
- CacheMode::MODE_NONE — キャッシュ無効
---

### setCacheFilePath

```php
static public void setCacheFilePath($cache_file_path)
```

ファイルキャッシュの保存先ディレクトリを設定します。

{[\JapaneseDate\CacheMode::MODE_FILE}](../JapaneseDate/CacheMode.html) を使用する場合に、
キャッシュファイルの保存先となるディレクトリパスを指定します。
このメソッドを呼ぶ前に `setCacheMode(CacheMode::MODE_FILE)` を
呼び出してキャッシュモードをファイルに切り替えてください。

**使用例:**
```php
use JapaneseDate\CacheMode;
use JapaneseDate\DateTime;

DateTime::setCacheMode(CacheMode::MODE_FILE);
DateTime::setCacheFilePath('/var/cache/japanesedate');
```

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| string | `$cache_file_path` | —  | キャッシュファイルを保存するディレクトリの絶対パス |

**Returns:** void
**See also:**

- CacheMode::MODE_FILE — ファイルキャッシュモード
---

### setCacheClosure

```php
static public void setCacheClosure($function)
```

独自キャッシュロジックを実装したクロージャを登録します。

{[\JapaneseDate\CacheMode::MODE_ORIGINAL}](../JapaneseDate/CacheMode.html) と組み合わせて使用します。
Redis・Memcached・フレームワーク固有のキャッシュ機構など、
任意のキャッシュバックエンドを利用できます。

**クロージャのシグネチャ:**

```php
function (string $key, \Closure $function): mixed
```

| パラメータ | 型 | 説明 |
|---|---|---|
| `$key` | `string` | キャッシュエントリを一意に識別するキー文字列 |
| `$function` | `\Closure` | キャッシュミス時に呼び出す計算ロジック。実行するとキャッシュすべきデータが返る |

クロージャの実装では、`$key` に対応するキャッシュが存在すればそれを返し、
なければ `$function()` を実行してその結果をキャッシュしてから返してください。

**使用例（Laravel の Cache ファサードを利用する場合）:**
```php
use JapaneseDate\CacheMode;
use JapaneseDate\DateTime;
use Illuminate\Support\Facades\Cache;

DateTime::setCacheMode(CacheMode::MODE_ORIGINAL);
DateTime::setCacheClosure(function (string $key, \Closure $fn) {
    return Cache::remember($key, 3600, $fn);
});
```

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| [Closure](https://www.php.net/class.closure) | `$function` | —  | 
`function(string $key, \Closure $function): mixed` シグネチャを持つクロージャ。
キャッシュヒット時はキャッシュ済みデータを、ミス時は計算実行結果を返す必要があります。 |

**Returns:** void
**See also:**

- CacheMode::MODE_ORIGINAL — 独自キャッシュモード
---

### nextHoliday

```php
public Modifier nextHoliday()
```

次の祝日にする

**Returns:** Modifier
---

### nextSixWeek

```php
public Modifier nextSixWeek($week_day)
```

指定された次の六曜にする

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$week_day` | —  |  |

**Returns:** Modifier
---

### nextSeventyTwoKou

```php
public SeventyTwoKou nextSeventyTwoKou()
```

次の七十二候が始まる日へ移動したインスタンスを返します。

現在の候の次候（または次節気の初候）の開始日を基準とした新しいインスタンスを返します。
時刻はそのままに日付だけが変わります。

**Returns:** SeventyTwoKou — 次の七十二候の開始日へ移動した新しいインスタンス
**Throws:**

- [Exception](../JapaneseDate/Exceptions/Exception.md)
- [SolarTermException](../JapaneseDate/Exceptions/SolarTermException.md)
---

### previousSeventyTwoKou

```php
public SeventyTwoKou previousSeventyTwoKou()
```

前の七十二候が始まる日へ移動したインスタンスを返します。

現在の候の直前の候の開始日を基準とした新しいインスタンスを返します。
時刻はそのままに日付だけが変わります。

**Returns:** SeventyTwoKou — 前の七十二候の開始日へ移動した新しいインスタンス
**Throws:**

- [Exception](../JapaneseDate/Exceptions/Exception.md)
- [SolarTermException](../JapaneseDate/Exceptions/SolarTermException.md)
---

### getCalendar

```php
public array getCalendar($calendar = CAL_GREGORIAN)
```

サポートされるカレンダーに変換する

サポートされる $calendar の値は、 CAL_GREGORIAN、 CAL_JULIAN、 CAL_JEWISH および CAL_FRENCH です。

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$calendar` | `CAL_GREGORIAN` | サポートされるカレンダー |

**Returns:** array — カレンダーの情報を含む配列を返します。この配列には、 年、月、日、週、曜日名、月名、"月/日/年" 形式の文字列 などが含まれます。
---

### setBusinessConfig

```php
public DateBusinessCommon setBusinessConfig($config)
```

インスタンスに個別の営業日設定を適用します。

設定後、このインスタンスのすべての営業日判定にこの設定が使用されます。
`null` を渡すとインスタンス個別設定を解除し、グローバル/デフォルト設定に戻ります。

**使用例:**
```php
$dt->setBusinessConfig(
    (new DateBusiness())->setClosingWeekdays([0, 6])->setBypassHoliday(true)
);
```

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| [DateBusiness](../JapaneseDate/DateBusiness.md)\|null | `$config` | —  | インスタンスに適用する設定オブジェクト、または null（解除） |

**Returns:** DateBusinessCommon — メソッドチェーン用に自身を返します
---

### getBusinessConfig

```php
public DateBusiness\|null getBusinessConfig()
```

インスタンスが保持している個別の営業日設定を取得します。

個別設定を持っていない場合は `null` を返します。
判定に実際に使用される設定（グローバル/デフォルト含む解決済み設定）は
BusinessCalendar::resolveConfig() で取得できます。

**Returns:** [DateBusiness](../JapaneseDate/DateBusiness.md)\|null — インスタンス個別設定、または null
---

### setClosingDay

```php
public DateBusinessCommon setClosingDay($date, $label = null)
```

特定の日付を休業日として指定します。

インスタンスに個別設定がない場合は自動的に現在の有効設定を複製して設定します。

**使用例:**
```php
$dt->setClosingDay('2026-08-15', '夏期休暇');
```

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| string\|[DateTimeInterface](https://www.php.net/class.datetimeinterface) | `$date` | —  | 休業日として指定する日付 |
| string\|null | `$label` | `null` | 休業理由のラベル（例: '夏期休暇'） |

**Returns:** DateBusinessCommon — メソッドチェーン用に自身を返します
**Throws:**

- [Exception](https://www.php.net/class.exception)
---

### setOpenDay

```php
public DateBusinessCommon setOpenDay($date)
```

特定の日付を営業日として指定します。

インスタンスに個別設定がない場合は自動的に現在の有効設定を複製して設定します。

**使用例:**
```php
$dt->setOpenDay('2026-12-30'); // 特別営業日
```

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| string\|[DateTimeInterface](https://www.php.net/class.datetimeinterface) | `$date` | —  | 営業日として指定する日付 |

**Returns:** DateBusinessCommon — メソッドチェーン用に自身を返します
**Throws:**

- [Exception](https://www.php.net/class.exception)
---

### setClosingWeekdays

```php
public DateBusinessCommon setClosingWeekdays($weekdays)
```

休業曜日を一括設定します。

インスタンスに個別設定がない場合は自動的に現在の有効設定を複製して設定します。

**使用例:**
```php
$dt->setClosingWeekdays([0, 6]); // 日・土を休業に
```

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| array | `$weekdays` | —  | 休業曜日の配列（例: [0, 6] で日・土） |

**Returns:** DateBusinessCommon — メソッドチェーン用に自身を返します
---

### setBypassHoliday

```php
public DateBusinessCommon setBypassHoliday($bypass)
```

祝日を休業日として扱うかどうかを設定します。

インスタンスに個別設定がない場合は自動的に現在の有効設定を複製して設定します。

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| bool | `$bypass` | —  | true の場合、祝日を休業日とする |

**Returns:** DateBusinessCommon — メソッドチェーン用に自身を返します
---

### setOpenNthWeekday

```php
public DateBusinessCommon setOpenNthWeekday($weekday, $nth)
```

第XX曜日を営業日として指定します。

インスタンスに個別設定がない場合は自動的に現在の有効設定を複製して設定します。

**使用例:**
```php
$dt->setOpenNthWeekday(6, 2); // 第2土曜日は営業
```

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$weekday` | —  | 曜日（0=日曜〜6=土曜） |
| int | `$nth` | —  | 第何曜日か（1〜5） |

**Returns:** DateBusinessCommon — メソッドチェーン用に自身を返します
---

### setClosingNthWeekday

```php
public DateBusinessCommon setClosingNthWeekday($weekday, $nth, $label = null)
```

第XX曜日を休業日として指定します。

インスタンスに個別設定がない場合は自動的に現在の有効設定を複製して設定します。

**使用例:**
```php
$dt->setClosingNthWeekday(3, 3, '定休日'); // 第3水曜日は休業
```

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$weekday` | —  | 曜日（0=日曜〜6=土曜） |
| int | `$nth` | —  | 第何曜日か（1〜5） |
| string\|null | `$label` | `null` | 休業ラベル |

**Returns:** DateBusinessCommon — メソッドチェーン用に自身を返します
---

### addOpenFilter

```php
public DateBusinessCommon addOpenFilter($filter)
```

営業指定フィルタを追加します。

フィルタが `true` を返した場合にその日を営業日として扱います。
インスタンスに個別設定がない場合は自動的に現在の有効設定を複製して設定します。

**使用例:**
```php
$dt->addOpenFilter(fn(\DateTimeInterface $d) => $d->format('d') === '10');
```

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| callable | `$filter` | —  | `fn(\DateTimeInterface $date): bool` 形式のコールバック |

**Returns:** DateBusinessCommon — メソッドチェーン用に自身を返します
---

### addClosingFilter

```php
public DateBusinessCommon addClosingFilter($filter, $label = null)
```

休業指定フィルタを追加します。

フィルタが `true` を返した場合にその日を休業日として扱います。
インスタンスに個別設定がない場合は自動的に現在の有効設定を複製して設定します。

**使用例:**
```php
$dt->addClosingFilter(
    fn(\DateTimeInterface $d) => $d->format('md') === '1231',
    '大晦日休業'
);
```

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| callable | `$filter` | —  | `fn(\DateTimeInterface $date): bool` 形式のコールバック |
| string\|null | `$label` | `null` | 休業理由のラベル |

**Returns:** DateBusinessCommon — メソッドチェーン用に自身を返します
---

### setBusinessMacro

```php
public DateBusinessCommon setBusinessMacro($macro)
```

判定ロジックを完全に上書きするマクロを設定します。

マクロは他のすべての設定より優先されます。
`null` を渡すとマクロを解除します。
インスタンスに個別設定がない場合は自動的に現在の有効設定を複製して設定します。

**使用例:**
```php
$dt->setBusinessMacro(fn(\DateTimeInterface $d) => in_array((int)$d->format('N'), [1,2,3,4]));
```

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| callable\|null | `$macro` | —  | `fn(\DateTimeInterface $date): bool` 形式のコールバック、または null |

**Returns:** DateBusinessCommon — メソッドチェーン用に自身を返します
---

### checkIsBusinessDay

```php
public bool checkIsBusinessDay($date = null)
```

指定した日付（または自身が保持する日付）が営業日かどうかを判定します。

このメソッドはTraitを適用したクラスが `DateTimeInterface` を実装している場合に
自身の日付を使って判定します。`$date` を省略した場合は自身を対象とします。

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| [DateTimeInterface](https://www.php.net/class.datetimeinterface)\|null | `$date` | `null` | 判定する日付（省略時は自身） |

**Returns:** bool — 営業日であれば true
---

### checkGetBusinessDayLabel

```php
public string\|null checkGetBusinessDayLabel($date = null)
```

指定した日付（または自身が保持する日付）の休業ラベルを取得します。

営業日の場合は `null` を返します。

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| [DateTimeInterface](https://www.php.net/class.datetimeinterface)\|null | `$date` | `null` | 判定する日付（省略時は自身） |

**Returns:** string\|null — 休業ラベル、または null
---

### isBusinessDay

```php
public bool isBusinessDay()
```

このインスタンスの日付が営業日かどうかを判定します。

適用されているカレンダー設定（インスタンス個別 > グローバル > デフォルト）に基づいて判定します。

**Returns:** bool — 営業日であれば true、休業日であれば false
---

### getBusinessDayLabel

```php
public string\|null getBusinessDayLabel()
```

このインスタンスの日付が休業日の場合、そのラベルを返します。

営業日の場合は null を返します。

**Returns:** string\|null — 休業ラベル、または null
---

### nextBusinessDay

```php
public Business nextBusinessDay()
```

次の営業日を取得します。

翌日から順に走査し、最初に見つかった営業日を返します。

**Returns:** Business — 次の営業日を表すインスタンス
---

### previousBusinessDay

```php
public Business previousBusinessDay()
```

前の営業日を取得します。

前日から順に走査し、最初に見つかった営業日を返します。

**Returns:** Business — 前の営業日を表すインスタンス
---

### shiftToClosestBusinessDayAfter

```php
public Business shiftToClosestBusinessDayAfter()
```

この日が休業日の場合、翌営業日にシフトしたインスタンスを返します。

営業日の場合はそのまま自身を返します。

**Returns:** Business — この日または翌以降の直近営業日を表すインスタンス
---

### shiftToClosestBusinessDayBefore

```php
public Business shiftToClosestBusinessDayBefore()
```

この日が休業日の場合、前営業日にシフトしたインスタンスを返します。

営業日の場合はそのまま自身を返します。

**Returns:** Business — この日または前以前の直近営業日を表すインスタンス
---

### addBusinessDays

```php
public Business addBusinessDays($days)
```

指定した営業日数後の日付を返します。

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$days` | —  | 加算する営業日数（正の整数） |

**Returns:** Business — N営業日後を表すインスタンス
---

### subBusinessDays

```php
public Business subBusinessDays($days)
```

指定した営業日数前の日付を返します。

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$days` | —  | 減算する営業日数（正の整数） |

**Returns:** Business — N営業日前を表すインスタンス
---

### historicalEras

```php
public array historicalEras()
```

自身の日付に対応する歴史的元号を返す。

{\JapaneseDate\Components\HistoricalEra} を呼び出し、
大化以降に制定されたすべての元号（南北朝の並存元号を含む）を
{\JapaneseDate\Values\Era} バリューオブジェクトの配列として返します。
大化以前など元号が存在しない日付の場合は空配列を返します。

**Returns:** array — 該当する元号バリューオブジェクトの配列
**Throws:**

- [NativeDateTimeException](../JapaneseDate/Exceptions/NativeDateTimeException.md)
---

