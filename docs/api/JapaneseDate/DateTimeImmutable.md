# DateTimeImmutable

**Namespace:** `JapaneseDate`

class **DateTimeImmutable** extends [CarbonImmutable](../Carbon/CarbonImmutable.md) implements [DateTimeInterface](../JapaneseDate/DateTimeInterface.md)

日本の暦（国民の祝日・元号・六曜・二十四節気・旧暦）に完全対応した不変（イミュータブル）日時クラス。

日時操作ライブラリ [\Carbon\CarbonImmutable](../Carbon/CarbonImmutable.html) を継承しており、CarbonImmutable および PHP 標準
[DateTimeImmutable](https://www.php.net/DateTimeImmutable) が持つすべてのメソッド・プロパティをそのまま利用できます。
加えて、日本のビジネス実務や伝統的な暦の計算に必要な機能を透過的に追加しています。

**イミュータブル（不変）設計について:**

このクラスは不変オブジェクトです。`addDays()` などの変更操作を呼び出しても
元のオブジェクトは変更されず、変更済みの新しいインスタンスが返ります。
これにより、日時オブジェクトを安全に共有・再利用できます。

```php
$date = DateTimeImmutable::parse('2026-05-01');
$next = $date->addDays(3);     // $date は変更されない
echo $date->format('Y-m-d');   // 2026-05-01（元のまま）
echo $next->format('Y-m-d');   // 2026-05-04
```

**可変版が必要な場合は {\JapaneseDate\DateTime} を使用してください。**

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

**使用例:**
```php
use JapaneseDate\DateTimeImmutable;

$date = DateTimeImmutable::parse('2026-05-03');
echo $date->holidayText;      // 憲法記念日
echo $date->eraNameText;      // 令和
echo $date->eraYear;          // 8
echo $date->sixWeekdayText;   // 大安・先勝 etc.
echo $date->solarTermText;    // 節気名（節気の日以外は空文字列）

// 次の祝日に移動する（元のオブジェクトは変更されない）
$nextHoliday = DateTimeImmutable::now()->nextHoliday();
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
| public | string | `$localeDayOfWeek` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | the day of week in current locale |
| public | string | `$shortLocaleDayOfWeek` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | the abbreviated day of week in current locale |
| public | string | `$localeMonth` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | the month in current locale |
| public | string | `$shortLocaleMonth` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | the abbreviated month in current locale |
| public | int | `$year` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ |  |
| public | int | `$yearIso` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ |  |
| public | int | `$month` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ |  |
| public | int | `$day` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ |  |
| public | int | `$hour` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ |  |
| public | int | `$minute` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ |  |
| public | int | `$second` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ |  |
| public | int | `$micro` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ |  |
| public | int | `$microsecond` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ |  |
| public | int | `$dayOfWeekIso` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | 1 (for Monday) through 7 (for Sunday) |
| public | int\|float\|string | `$timestamp` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | seconds since the Unix Epoch |
| public | string | `$englishDayOfWeek` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | the day of week in English |
| public | string | `$shortEnglishDayOfWeek` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | the abbreviated day of week in English |
| public | string | `$englishMonth` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | the month in English |
| public | string | `$shortEnglishMonth` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | the abbreviated month in English |
| public | int | `$milliseconds` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ |  |
| public | int | `$millisecond` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ |  |
| public | int | `$milli` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ |  |
| public | int | `$week` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | 1 through 53 |
| public | int | `$isoWeek` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | 1 through 53 |
| public | int | `$weekYear` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | year according to week format |
| public | int | `$isoWeekYear` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | year according to ISO week format |
| public | int | `$age` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | does a diffInYears() with default parameters |
| public | int | `$offset` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | the timezone offset in seconds from UTC |
| public | int | `$offsetMinutes` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | the timezone offset in minutes from UTC |
| public | int | `$offsetHours` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | the timezone offset in hours from UTC |
| public | CarbonTimeZone | `$timezone` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | the current timezone |
| public | CarbonTimeZone | `$tz` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | alias of $timezone |
| public | int | `$centuryOfMillennium` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the century starting from the beginning of the current millennium |
| public | int | `$dayOfCentury` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the day starting from the beginning of the current century |
| public | int | `$dayOfDecade` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the day starting from the beginning of the current decade |
| public | int | `$dayOfMillennium` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the day starting from the beginning of the current millennium |
| public | int | `$dayOfMonth` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the day starting from the beginning of the current month |
| public | int | `$dayOfQuarter` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the day starting from the beginning of the current quarter |
| public | int | `$dayOfWeek` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | 0 (for Sunday) through 6 (for Saturday) |
| public | int | `$dayOfYear` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | 1 through 366 |
| public | int | `$decadeOfCentury` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the decade starting from the beginning of the current century |
| public | int | `$decadeOfMillennium` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the decade starting from the beginning of the current millennium |
| public | int | `$hourOfCentury` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the hour starting from the beginning of the current century |
| public | int | `$hourOfDay` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the hour starting from the beginning of the current day |
| public | int | `$hourOfDecade` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the hour starting from the beginning of the current decade |
| public | int | `$hourOfMillennium` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the hour starting from the beginning of the current millennium |
| public | int | `$hourOfMonth` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the hour starting from the beginning of the current month |
| public | int | `$hourOfQuarter` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the hour starting from the beginning of the current quarter |
| public | int | `$hourOfWeek` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the hour starting from the beginning of the current week |
| public | int | `$hourOfYear` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the hour starting from the beginning of the current year |
| public | int | `$microsecondOfCentury` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the microsecond starting from the beginning of the current century |
| public | int | `$microsecondOfDay` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the microsecond starting from the beginning of the current day |
| public | int | `$microsecondOfDecade` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the microsecond starting from the beginning of the current decade |
| public | int | `$microsecondOfHour` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the microsecond starting from the beginning of the current hour |
| public | int | `$microsecondOfMillennium` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the microsecond starting from the beginning of the current millennium |
| public | int | `$microsecondOfMillisecond` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the microsecond starting from the beginning of the current millisecond |
| public | int | `$microsecondOfMinute` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the microsecond starting from the beginning of the current minute |
| public | int | `$microsecondOfMonth` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the microsecond starting from the beginning of the current month |
| public | int | `$microsecondOfQuarter` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the microsecond starting from the beginning of the current quarter |
| public | int | `$microsecondOfSecond` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the microsecond starting from the beginning of the current second |
| public | int | `$microsecondOfWeek` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the microsecond starting from the beginning of the current week |
| public | int | `$microsecondOfYear` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the microsecond starting from the beginning of the current year |
| public | int | `$millisecondOfCentury` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the millisecond starting from the beginning of the current century |
| public | int | `$millisecondOfDay` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the millisecond starting from the beginning of the current day |
| public | int | `$millisecondOfDecade` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the millisecond starting from the beginning of the current decade |
| public | int | `$millisecondOfHour` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the millisecond starting from the beginning of the current hour |
| public | int | `$millisecondOfMillennium` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the millisecond starting from the beginning of the current millennium |
| public | int | `$millisecondOfMinute` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the millisecond starting from the beginning of the current minute |
| public | int | `$millisecondOfMonth` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the millisecond starting from the beginning of the current month |
| public | int | `$millisecondOfQuarter` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the millisecond starting from the beginning of the current quarter |
| public | int | `$millisecondOfSecond` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the millisecond starting from the beginning of the current second |
| public | int | `$millisecondOfWeek` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the millisecond starting from the beginning of the current week |
| public | int | `$millisecondOfYear` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the millisecond starting from the beginning of the current year |
| public | int | `$minuteOfCentury` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the minute starting from the beginning of the current century |
| public | int | `$minuteOfDay` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the minute starting from the beginning of the current day |
| public | int | `$minuteOfDecade` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the minute starting from the beginning of the current decade |
| public | int | `$minuteOfHour` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the minute starting from the beginning of the current hour |
| public | int | `$minuteOfMillennium` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the minute starting from the beginning of the current millennium |
| public | int | `$minuteOfMonth` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the minute starting from the beginning of the current month |
| public | int | `$minuteOfQuarter` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the minute starting from the beginning of the current quarter |
| public | int | `$minuteOfWeek` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the minute starting from the beginning of the current week |
| public | int | `$minuteOfYear` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the minute starting from the beginning of the current year |
| public | int | `$monthOfCentury` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the month starting from the beginning of the current century |
| public | int | `$monthOfDecade` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the month starting from the beginning of the current decade |
| public | int | `$monthOfMillennium` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the month starting from the beginning of the current millennium |
| public | int | `$monthOfQuarter` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the month starting from the beginning of the current quarter |
| public | int | `$monthOfYear` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the month starting from the beginning of the current year |
| public | int | `$quarterOfCentury` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the quarter starting from the beginning of the current century |
| public | int | `$quarterOfDecade` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the quarter starting from the beginning of the current decade |
| public | int | `$quarterOfMillennium` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the quarter starting from the beginning of the current millennium |
| public | int | `$quarterOfYear` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the quarter starting from the beginning of the current year |
| public | int | `$secondOfCentury` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the second starting from the beginning of the current century |
| public | int | `$secondOfDay` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the second starting from the beginning of the current day |
| public | int | `$secondOfDecade` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the second starting from the beginning of the current decade |
| public | int | `$secondOfHour` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the second starting from the beginning of the current hour |
| public | int | `$secondOfMillennium` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the second starting from the beginning of the current millennium |
| public | int | `$secondOfMinute` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the second starting from the beginning of the current minute |
| public | int | `$secondOfMonth` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the second starting from the beginning of the current month |
| public | int | `$secondOfQuarter` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the second starting from the beginning of the current quarter |
| public | int | `$secondOfWeek` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the second starting from the beginning of the current week |
| public | int | `$secondOfYear` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the second starting from the beginning of the current year |
| public | int | `$weekOfCentury` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the week starting from the beginning of the current century |
| public | int | `$weekOfDecade` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the week starting from the beginning of the current decade |
| public | int | `$weekOfMillennium` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the week starting from the beginning of the current millennium |
| public | int | `$weekOfMonth` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | 1 through 5 |
| public | int | `$weekOfQuarter` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the week starting from the beginning of the current quarter |
| public | int | `$weekOfYear` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | ISO-8601 week number of year, weeks starting on Monday |
| public | int | `$yearOfCentury` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the year starting from the beginning of the current century |
| public | int | `$yearOfDecade` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the year starting from the beginning of the current decade |
| public | int | `$yearOfMillennium` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the year starting from the beginning of the current millennium |
| public _(read-only)_ | string | `$latinMeridiem` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | "am"/"pm" (Ante meridiem or Post meridiem latin lowercase mark) |
| public _(read-only)_ | string | `$latinUpperMeridiem` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | "AM"/"PM" (Ante meridiem or Post meridiem latin uppercase mark) |
| public _(read-only)_ | string | `$timezoneAbbreviatedName` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | the current timezone abbreviated name |
| public _(read-only)_ | string | `$tzAbbrName` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | alias of $timezoneAbbreviatedName |
| public _(read-only)_ | string | `$dayName` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | long name of weekday translated according to Carbon locale, in english if no translation available for current language |
| public _(read-only)_ | string | `$shortDayName` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | short name of weekday translated according to Carbon locale, in english if no translation available for current language |
| public _(read-only)_ | string | `$minDayName` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | very short name of weekday translated according to Carbon locale, in english if no translation available for current language |
| public _(read-only)_ | string | `$monthName` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | long name of month translated according to Carbon locale, in english if no translation available for current language |
| public _(read-only)_ | string | `$shortMonthName` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | short name of month translated according to Carbon locale, in english if no translation available for current language |
| public _(read-only)_ | string | `$meridiem` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | lowercase meridiem mark translated according to Carbon locale, in latin if no translation available for current language |
| public _(read-only)_ | string | `$upperMeridiem` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | uppercase meridiem mark translated according to Carbon locale, in latin if no translation available for current language |
| public _(read-only)_ | int | `$noZeroHour` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | current hour from 1 to 24 |
| public _(read-only)_ | int | `$isoWeeksInYear` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | 51 through 53 |
| public _(read-only)_ | int | `$weekNumberInMonth` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | 1 through 5 |
| public _(read-only)_ | int | `$firstWeekDay` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | 0 through 6 |
| public _(read-only)_ | int | `$lastWeekDay` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | 0 through 6 |
| public _(read-only)_ | int | `$quarter` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | the quarter of this instance, 1 - 4 |
| public _(read-only)_ | int | `$decade` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | the decade of this instance |
| public _(read-only)_ | int | `$century` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | the century of this instance |
| public _(read-only)_ | int | `$millennium` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | the millennium of this instance |
| public _(read-only)_ | bool | `$dst` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | daylight savings time indicator, true if DST, false otherwise |
| public _(read-only)_ | bool | `$local` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | checks if the timezone is local, true if local, false otherwise |
| public _(read-only)_ | bool | `$utc` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | checks if the timezone is UTC, true if UTC, false otherwise |
| public _(read-only)_ | string | `$timezoneName` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | the current timezone name |
| public _(read-only)_ | string | `$tzName` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | alias of $timezoneName |
| public _(read-only)_ | string | `$locale` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | locale of the current instance |
| public _(read-only)_ | int | `$centuriesInMillennium` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of centuries contained in the current millennium |
| public _(read-only)_ | int | `$daysInCentury` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of days contained in the current century |
| public _(read-only)_ | int | `$daysInDecade` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of days contained in the current decade |
| public _(read-only)_ | int | `$daysInMillennium` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of days contained in the current millennium |
| public _(read-only)_ | int | `$daysInMonth` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | number of days in the given month |
| public _(read-only)_ | int | `$daysInQuarter` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of days contained in the current quarter |
| public _(read-only)_ | int | `$daysInWeek` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of days contained in the current week |
| public _(read-only)_ | int | `$daysInYear` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | 365 or 366 |
| public _(read-only)_ | int | `$decadesInCentury` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of decades contained in the current century |
| public _(read-only)_ | int | `$decadesInMillennium` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of decades contained in the current millennium |
| public _(read-only)_ | int | `$hoursInCentury` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of hours contained in the current century |
| public _(read-only)_ | int | `$hoursInDay` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of hours contained in the current day |
| public _(read-only)_ | int | `$hoursInDecade` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of hours contained in the current decade |
| public _(read-only)_ | int | `$hoursInMillennium` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of hours contained in the current millennium |
| public _(read-only)_ | int | `$hoursInMonth` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of hours contained in the current month |
| public _(read-only)_ | int | `$hoursInQuarter` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of hours contained in the current quarter |
| public _(read-only)_ | int | `$hoursInWeek` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of hours contained in the current week |
| public _(read-only)_ | int | `$hoursInYear` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of hours contained in the current year |
| public _(read-only)_ | int | `$microsecondsInCentury` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of microseconds contained in the current century |
| public _(read-only)_ | int | `$microsecondsInDay` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of microseconds contained in the current day |
| public _(read-only)_ | int | `$microsecondsInDecade` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of microseconds contained in the current decade |
| public _(read-only)_ | int | `$microsecondsInHour` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of microseconds contained in the current hour |
| public _(read-only)_ | int | `$microsecondsInMillennium` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of microseconds contained in the current millennium |
| public _(read-only)_ | int | `$microsecondsInMillisecond` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of microseconds contained in the current millisecond |
| public _(read-only)_ | int | `$microsecondsInMinute` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of microseconds contained in the current minute |
| public _(read-only)_ | int | `$microsecondsInMonth` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of microseconds contained in the current month |
| public _(read-only)_ | int | `$microsecondsInQuarter` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of microseconds contained in the current quarter |
| public _(read-only)_ | int | `$microsecondsInSecond` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of microseconds contained in the current second |
| public _(read-only)_ | int | `$microsecondsInWeek` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of microseconds contained in the current week |
| public _(read-only)_ | int | `$microsecondsInYear` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of microseconds contained in the current year |
| public _(read-only)_ | int | `$millisecondsInCentury` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of milliseconds contained in the current century |
| public _(read-only)_ | int | `$millisecondsInDay` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of milliseconds contained in the current day |
| public _(read-only)_ | int | `$millisecondsInDecade` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of milliseconds contained in the current decade |
| public _(read-only)_ | int | `$millisecondsInHour` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of milliseconds contained in the current hour |
| public _(read-only)_ | int | `$millisecondsInMillennium` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of milliseconds contained in the current millennium |
| public _(read-only)_ | int | `$millisecondsInMinute` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of milliseconds contained in the current minute |
| public _(read-only)_ | int | `$millisecondsInMonth` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of milliseconds contained in the current month |
| public _(read-only)_ | int | `$millisecondsInQuarter` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of milliseconds contained in the current quarter |
| public _(read-only)_ | int | `$millisecondsInSecond` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of milliseconds contained in the current second |
| public _(read-only)_ | int | `$millisecondsInWeek` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of milliseconds contained in the current week |
| public _(read-only)_ | int | `$millisecondsInYear` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of milliseconds contained in the current year |
| public _(read-only)_ | int | `$minutesInCentury` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of minutes contained in the current century |
| public _(read-only)_ | int | `$minutesInDay` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of minutes contained in the current day |
| public _(read-only)_ | int | `$minutesInDecade` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of minutes contained in the current decade |
| public _(read-only)_ | int | `$minutesInHour` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of minutes contained in the current hour |
| public _(read-only)_ | int | `$minutesInMillennium` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of minutes contained in the current millennium |
| public _(read-only)_ | int | `$minutesInMonth` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of minutes contained in the current month |
| public _(read-only)_ | int | `$minutesInQuarter` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of minutes contained in the current quarter |
| public _(read-only)_ | int | `$minutesInWeek` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of minutes contained in the current week |
| public _(read-only)_ | int | `$minutesInYear` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of minutes contained in the current year |
| public _(read-only)_ | int | `$monthsInCentury` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of months contained in the current century |
| public _(read-only)_ | int | `$monthsInDecade` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of months contained in the current decade |
| public _(read-only)_ | int | `$monthsInMillennium` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of months contained in the current millennium |
| public _(read-only)_ | int | `$monthsInQuarter` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of months contained in the current quarter |
| public _(read-only)_ | int | `$monthsInYear` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of months contained in the current year |
| public _(read-only)_ | int | `$quartersInCentury` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of quarters contained in the current century |
| public _(read-only)_ | int | `$quartersInDecade` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of quarters contained in the current decade |
| public _(read-only)_ | int | `$quartersInMillennium` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of quarters contained in the current millennium |
| public _(read-only)_ | int | `$quartersInYear` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of quarters contained in the current year |
| public _(read-only)_ | int | `$secondsInCentury` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of seconds contained in the current century |
| public _(read-only)_ | int | `$secondsInDay` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of seconds contained in the current day |
| public _(read-only)_ | int | `$secondsInDecade` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of seconds contained in the current decade |
| public _(read-only)_ | int | `$secondsInHour` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of seconds contained in the current hour |
| public _(read-only)_ | int | `$secondsInMillennium` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of seconds contained in the current millennium |
| public _(read-only)_ | int | `$secondsInMinute` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of seconds contained in the current minute |
| public _(read-only)_ | int | `$secondsInMonth` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of seconds contained in the current month |
| public _(read-only)_ | int | `$secondsInQuarter` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of seconds contained in the current quarter |
| public _(read-only)_ | int | `$secondsInWeek` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of seconds contained in the current week |
| public _(read-only)_ | int | `$secondsInYear` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of seconds contained in the current year |
| public _(read-only)_ | int | `$weeksInCentury` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of weeks contained in the current century |
| public _(read-only)_ | int | `$weeksInDecade` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of weeks contained in the current decade |
| public _(read-only)_ | int | `$weeksInMillennium` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of weeks contained in the current millennium |
| public _(read-only)_ | int | `$weeksInMonth` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of weeks contained in the current month |
| public _(read-only)_ | int | `$weeksInQuarter` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of weeks contained in the current quarter |
| public _(read-only)_ | int | `$weeksInYear` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | 51 through 53 |
| public _(read-only)_ | int | `$yearsInCentury` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of years contained in the current century |
| public _(read-only)_ | int | `$yearsInDecade` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of years contained in the current decade |
| public _(read-only)_ | int | `$yearsInMillennium` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of years contained in the current millennium |

## Methods

| Return | Method | Description |
|---|---|---|
| Factory\|null | [createFromFormat()](#createfromformat) | フォーマット指定文字列から日時インスタンスを生成します。 |
| Factory | [factory()](#factory) | 多様な型の引数から {\JapaneseDate\DateTime} / {\JapaneseDate\DateTimeImmutable} インスタンスを生成するユニバーサルファクトリメソッドです。 |
| void | [setCacheMode()](#setcachemode) | 旧暦・祝日計算に使用するキャッシュモードを設定します。 |
| void | [setCacheFilePath()](#setcachefilepath) | ファイルキャッシュの保存先ディレクトリを設定します。 |
| void | [setCacheClosure()](#setcacheclosure) | 独自キャッシュロジックを実装したクロージャを登録します。 |
| Modifier | [nextHoliday()](#nextholiday) | 次の祝日にする |
| Modifier | [nextSixWeek()](#nextsixweek) | 指定された次の六曜にする |
| SeventyTwoKou | [nextSeventyTwoKou()](#nextseventytwokou) | 次の七十二候が始まる日へ移動したインスタンスを返します。 |
| SeventyTwoKou | [previousSeventyTwoKou()](#previousseventytwokou) | 前の七十二候が始まる日へ移動したインスタンスを返します。 |
| array | [getCalendar()](#getcalendar) | サポートされるカレンダーに変換する |
| array | [toArray()](#toarray) |  |
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
| void | [useSolarAlgorithm()](#usesolaralgorithm) | 太陽黄経計算で使用するアルゴリズムを設定する。 |
| string | [solarAlgorithm()](#solaralgorithm) | 現在の太陽黄経計算アルゴリズムを返す。 |
| void | [useMoonAlgorithm()](#usemoonalgorithm) | 月黄経計算で使用するアルゴリズムを設定する。 |
| string | [moonAlgorithm()](#moonalgorithm) | 現在の月黄経計算アルゴリズムを返す。 |
| CarbonImmutable | [CarbonImmutable::startOfTime](../Carbon/CarbonImmutable.md#startoftime) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Create a very old date representing start of time. |
| CarbonImmutable | [CarbonImmutable::endOfTime](../Carbon/CarbonImmutable.md#endoftime) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Create a very far date representing end of time. |
| bool | [CarbonImmutable::isUtc](../Carbon/CarbonImmutable.md#isutc) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ |  |
| bool | [CarbonImmutable::isLocal](../Carbon/CarbonImmutable.md#islocal) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Check if the current instance has non-UTC timezone. |
| bool | [CarbonImmutable::isValid](../Carbon/CarbonImmutable.md#isvalid) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Check if the current instance is a valid date. |
| bool | [CarbonImmutable::isDST](../Carbon/CarbonImmutable.md#isdst) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Check if the current instance is in a daylight saving time. |
| bool | [CarbonImmutable::isSunday](../Carbon/CarbonImmutable.md#issunday) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Checks if the instance day is sunday. |
| bool | [CarbonImmutable::isMonday](../Carbon/CarbonImmutable.md#ismonday) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Checks if the instance day is monday. |
| bool | [CarbonImmutable::isTuesday](../Carbon/CarbonImmutable.md#istuesday) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Checks if the instance day is tuesday. |
| bool | [CarbonImmutable::isWednesday](../Carbon/CarbonImmutable.md#iswednesday) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Checks if the instance day is wednesday. |
| bool | [CarbonImmutable::isThursday](../Carbon/CarbonImmutable.md#isthursday) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Checks if the instance day is thursday. |
| bool | [CarbonImmutable::isFriday](../Carbon/CarbonImmutable.md#isfriday) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Checks if the instance day is friday. |
| bool | [CarbonImmutable::isSaturday](../Carbon/CarbonImmutable.md#issaturday) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Checks if the instance day is saturday. |
| bool | [CarbonImmutable::isSameYear](../Carbon/CarbonImmutable.md#issameyear) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| bool | [CarbonImmutable::isCurrentYear](../Carbon/CarbonImmutable.md#iscurrentyear) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Checks if the instance is in the same year as the current moment. |
| bool | [CarbonImmutable::isNextYear](../Carbon/CarbonImmutable.md#isnextyear) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Checks if the instance is in the same year as the current moment next year. |
| bool | [CarbonImmutable::isLastYear](../Carbon/CarbonImmutable.md#islastyear) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Checks if the instance is in the same year as the current moment last year. |
| bool | [CarbonImmutable::isCurrentMonth](../Carbon/CarbonImmutable.md#iscurrentmonth) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Checks if the instance is in the same month as the current moment. |
| bool | [CarbonImmutable::isNextMonth](../Carbon/CarbonImmutable.md#isnextmonth) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Checks if the instance is in the same month as the current moment next month. |
| bool | [CarbonImmutable::isLastMonth](../Carbon/CarbonImmutable.md#islastmonth) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Checks if the instance is in the same month as the current moment last month. |
| bool | [CarbonImmutable::isSameWeek](../Carbon/CarbonImmutable.md#issameweek) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| bool | [CarbonImmutable::isCurrentWeek](../Carbon/CarbonImmutable.md#iscurrentweek) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Checks if the instance is in the same week as the current moment. |
| bool | [CarbonImmutable::isNextWeek](../Carbon/CarbonImmutable.md#isnextweek) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Checks if the instance is in the same week as the current moment next week. |
| bool | [CarbonImmutable::isLastWeek](../Carbon/CarbonImmutable.md#islastweek) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Checks if the instance is in the same week as the current moment last week. |
| bool | [CarbonImmutable::isSameDay](../Carbon/CarbonImmutable.md#issameday) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| bool | [CarbonImmutable::isCurrentDay](../Carbon/CarbonImmutable.md#iscurrentday) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Checks if the instance is in the same day as the current moment. |
| bool | [CarbonImmutable::isNextDay](../Carbon/CarbonImmutable.md#isnextday) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Checks if the instance is in the same day as the current moment next day. |
| bool | [CarbonImmutable::isLastDay](../Carbon/CarbonImmutable.md#islastday) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Checks if the instance is in the same day as the current moment last day. |
| bool | [CarbonImmutable::isSameHour](../Carbon/CarbonImmutable.md#issamehour) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| bool | [CarbonImmutable::isCurrentHour](../Carbon/CarbonImmutable.md#iscurrenthour) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Checks if the instance is in the same hour as the current moment. |
| bool | [CarbonImmutable::isNextHour](../Carbon/CarbonImmutable.md#isnexthour) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Checks if the instance is in the same hour as the current moment next hour. |
| bool | [CarbonImmutable::isLastHour](../Carbon/CarbonImmutable.md#islasthour) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Checks if the instance is in the same hour as the current moment last hour. |
| bool | [CarbonImmutable::isSameMinute](../Carbon/CarbonImmutable.md#issameminute) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| bool | [CarbonImmutable::isCurrentMinute](../Carbon/CarbonImmutable.md#iscurrentminute) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Checks if the instance is in the same minute as the current moment. |
| bool | [CarbonImmutable::isNextMinute](../Carbon/CarbonImmutable.md#isnextminute) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Checks if the instance is in the same minute as the current moment next minute. |
| bool | [CarbonImmutable::isLastMinute](../Carbon/CarbonImmutable.md#islastminute) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Checks if the instance is in the same minute as the current moment last minute. |
| bool | [CarbonImmutable::isSameSecond](../Carbon/CarbonImmutable.md#issamesecond) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| bool | [CarbonImmutable::isCurrentSecond](../Carbon/CarbonImmutable.md#iscurrentsecond) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Checks if the instance is in the same second as the current moment. |
| bool | [CarbonImmutable::isNextSecond](../Carbon/CarbonImmutable.md#isnextsecond) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Checks if the instance is in the same second as the current moment next second. |
| bool | [CarbonImmutable::isLastSecond](../Carbon/CarbonImmutable.md#islastsecond) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Checks if the instance is in the same second as the current moment last second. |
| bool | [CarbonImmutable::isSameMilli](../Carbon/CarbonImmutable.md#issamemilli) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| bool | [CarbonImmutable::isCurrentMilli](../Carbon/CarbonImmutable.md#iscurrentmilli) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Checks if the instance is in the same millisecond as the current moment. |
| bool | [CarbonImmutable::isNextMilli](../Carbon/CarbonImmutable.md#isnextmilli) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Checks if the instance is in the same millisecond as the current moment next millisecond. |
| bool | [CarbonImmutable::isLastMilli](../Carbon/CarbonImmutable.md#islastmilli) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Checks if the instance is in the same millisecond as the current moment last millisecond. |
| bool | [CarbonImmutable::isSameMillisecond](../Carbon/CarbonImmutable.md#issamemillisecond) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| bool | [CarbonImmutable::isCurrentMillisecond](../Carbon/CarbonImmutable.md#iscurrentmillisecond) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Checks if the instance is in the same millisecond as the current moment. |
| bool | [CarbonImmutable::isNextMillisecond](../Carbon/CarbonImmutable.md#isnextmillisecond) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Checks if the instance is in the same millisecond as the current moment next millisecond. |
| bool | [CarbonImmutable::isLastMillisecond](../Carbon/CarbonImmutable.md#islastmillisecond) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Checks if the instance is in the same millisecond as the current moment last millisecond. |
| bool | [CarbonImmutable::isSameMicro](../Carbon/CarbonImmutable.md#issamemicro) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| bool | [CarbonImmutable::isCurrentMicro](../Carbon/CarbonImmutable.md#iscurrentmicro) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Checks if the instance is in the same microsecond as the current moment. |
| bool | [CarbonImmutable::isNextMicro](../Carbon/CarbonImmutable.md#isnextmicro) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Checks if the instance is in the same microsecond as the current moment next microsecond. |
| bool | [CarbonImmutable::isLastMicro](../Carbon/CarbonImmutable.md#islastmicro) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Checks if the instance is in the same microsecond as the current moment last microsecond. |
| bool | [CarbonImmutable::isSameMicrosecond](../Carbon/CarbonImmutable.md#issamemicrosecond) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| bool | [CarbonImmutable::isCurrentMicrosecond](../Carbon/CarbonImmutable.md#iscurrentmicrosecond) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Checks if the instance is in the same microsecond as the current moment. |
| bool | [CarbonImmutable::isNextMicrosecond](../Carbon/CarbonImmutable.md#isnextmicrosecond) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Checks if the instance is in the same microsecond as the current moment next microsecond. |
| bool | [CarbonImmutable::isLastMicrosecond](../Carbon/CarbonImmutable.md#islastmicrosecond) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Checks if the instance is in the same microsecond as the current moment last microsecond. |
| bool | [CarbonImmutable::isSameDecade](../Carbon/CarbonImmutable.md#issamedecade) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| bool | [CarbonImmutable::isCurrentDecade](../Carbon/CarbonImmutable.md#iscurrentdecade) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Checks if the instance is in the same decade as the current moment. |
| bool | [CarbonImmutable::isNextDecade](../Carbon/CarbonImmutable.md#isnextdecade) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Checks if the instance is in the same decade as the current moment next decade. |
| bool | [CarbonImmutable::isLastDecade](../Carbon/CarbonImmutable.md#islastdecade) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Checks if the instance is in the same decade as the current moment last decade. |
| bool | [CarbonImmutable::isSameCentury](../Carbon/CarbonImmutable.md#issamecentury) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| bool | [CarbonImmutable::isCurrentCentury](../Carbon/CarbonImmutable.md#iscurrentcentury) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Checks if the instance is in the same century as the current moment. |
| bool | [CarbonImmutable::isNextCentury](../Carbon/CarbonImmutable.md#isnextcentury) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Checks if the instance is in the same century as the current moment next century. |
| bool | [CarbonImmutable::isLastCentury](../Carbon/CarbonImmutable.md#islastcentury) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Checks if the instance is in the same century as the current moment last century. |
| bool | [CarbonImmutable::isSameMillennium](../Carbon/CarbonImmutable.md#issamemillennium) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| bool | [CarbonImmutable::isCurrentMillennium](../Carbon/CarbonImmutable.md#iscurrentmillennium) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Checks if the instance is in the same millennium as the current moment. |
| bool | [CarbonImmutable::isNextMillennium](../Carbon/CarbonImmutable.md#isnextmillennium) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Checks if the instance is in the same millennium as the current moment next millennium. |
| bool | [CarbonImmutable::isLastMillennium](../Carbon/CarbonImmutable.md#islastmillennium) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Checks if the instance is in the same millennium as the current moment last millennium. |
| bool | [CarbonImmutable::isCurrentQuarter](../Carbon/CarbonImmutable.md#iscurrentquarter) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Checks if the instance is in the same quarter as the current moment. |
| bool | [CarbonImmutable::isNextQuarter](../Carbon/CarbonImmutable.md#isnextquarter) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Checks if the instance is in the same quarter as the current moment next quarter. |
| bool | [CarbonImmutable::isLastQuarter](../Carbon/CarbonImmutable.md#islastquarter) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Checks if the instance is in the same quarter as the current moment last quarter. |
| CarbonImmutable | [CarbonImmutable::years](../Carbon/CarbonImmutable.md#years) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Set current instance year to the given value. |
| CarbonImmutable | [CarbonImmutable::year](../Carbon/CarbonImmutable.md#year) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Set current instance year to the given value. |
| CarbonImmutable | [CarbonImmutable::setYears](../Carbon/CarbonImmutable.md#setyears) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Set current instance year to the given value. |
| CarbonImmutable | [CarbonImmutable::setYear](../Carbon/CarbonImmutable.md#setyear) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Set current instance year to the given value. |
| CarbonImmutable | [CarbonImmutable::months](../Carbon/CarbonImmutable.md#months) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Set current instance month to the given value. |
| CarbonImmutable | [CarbonImmutable::month](../Carbon/CarbonImmutable.md#month) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Set current instance month to the given value. |
| CarbonImmutable | [CarbonImmutable::setMonths](../Carbon/CarbonImmutable.md#setmonths) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Set current instance month to the given value. |
| CarbonImmutable | [CarbonImmutable::setMonth](../Carbon/CarbonImmutable.md#setmonth) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Set current instance month to the given value. |
| CarbonImmutable | [CarbonImmutable::days](../Carbon/CarbonImmutable.md#days) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Set current instance day to the given value. |
| CarbonImmutable | [CarbonImmutable::day](../Carbon/CarbonImmutable.md#day) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Set current instance day to the given value. |
| CarbonImmutable | [CarbonImmutable::setDays](../Carbon/CarbonImmutable.md#setdays) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Set current instance day to the given value. |
| CarbonImmutable | [CarbonImmutable::setDay](../Carbon/CarbonImmutable.md#setday) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Set current instance day to the given value. |
| CarbonImmutable | [CarbonImmutable::hours](../Carbon/CarbonImmutable.md#hours) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Set current instance hour to the given value. |
| CarbonImmutable | [CarbonImmutable::hour](../Carbon/CarbonImmutable.md#hour) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Set current instance hour to the given value. |
| CarbonImmutable | [CarbonImmutable::setHours](../Carbon/CarbonImmutable.md#sethours) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Set current instance hour to the given value. |
| CarbonImmutable | [CarbonImmutable::setHour](../Carbon/CarbonImmutable.md#sethour) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Set current instance hour to the given value. |
| CarbonImmutable | [CarbonImmutable::minutes](../Carbon/CarbonImmutable.md#minutes) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Set current instance minute to the given value. |
| CarbonImmutable | [CarbonImmutable::minute](../Carbon/CarbonImmutable.md#minute) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Set current instance minute to the given value. |
| CarbonImmutable | [CarbonImmutable::setMinutes](../Carbon/CarbonImmutable.md#setminutes) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Set current instance minute to the given value. |
| CarbonImmutable | [CarbonImmutable::setMinute](../Carbon/CarbonImmutable.md#setminute) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Set current instance minute to the given value. |
| CarbonImmutable | [CarbonImmutable::seconds](../Carbon/CarbonImmutable.md#seconds) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Set current instance second to the given value. |
| CarbonImmutable | [CarbonImmutable::second](../Carbon/CarbonImmutable.md#second) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Set current instance second to the given value. |
| CarbonImmutable | [CarbonImmutable::setSeconds](../Carbon/CarbonImmutable.md#setseconds) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Set current instance second to the given value. |
| CarbonImmutable | [CarbonImmutable::setSecond](../Carbon/CarbonImmutable.md#setsecond) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Set current instance second to the given value. |
| CarbonImmutable | [CarbonImmutable::millis](../Carbon/CarbonImmutable.md#millis) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Set current instance millisecond to the given value. |
| CarbonImmutable | [CarbonImmutable::milli](../Carbon/CarbonImmutable.md#milli) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Set current instance millisecond to the given value. |
| CarbonImmutable | [CarbonImmutable::setMillis](../Carbon/CarbonImmutable.md#setmillis) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Set current instance millisecond to the given value. |
| CarbonImmutable | [CarbonImmutable::setMilli](../Carbon/CarbonImmutable.md#setmilli) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Set current instance millisecond to the given value. |
| CarbonImmutable | [CarbonImmutable::milliseconds](../Carbon/CarbonImmutable.md#milliseconds) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Set current instance millisecond to the given value. |
| CarbonImmutable | [CarbonImmutable::millisecond](../Carbon/CarbonImmutable.md#millisecond) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Set current instance millisecond to the given value. |
| CarbonImmutable | [CarbonImmutable::setMilliseconds](../Carbon/CarbonImmutable.md#setmilliseconds) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Set current instance millisecond to the given value. |
| CarbonImmutable | [CarbonImmutable::setMillisecond](../Carbon/CarbonImmutable.md#setmillisecond) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Set current instance millisecond to the given value. |
| CarbonImmutable | [CarbonImmutable::micros](../Carbon/CarbonImmutable.md#micros) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Set current instance microsecond to the given value. |
| CarbonImmutable | [CarbonImmutable::micro](../Carbon/CarbonImmutable.md#micro) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Set current instance microsecond to the given value. |
| CarbonImmutable | [CarbonImmutable::setMicros](../Carbon/CarbonImmutable.md#setmicros) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Set current instance microsecond to the given value. |
| CarbonImmutable | [CarbonImmutable::setMicro](../Carbon/CarbonImmutable.md#setmicro) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Set current instance microsecond to the given value. |
| CarbonImmutable | [CarbonImmutable::microseconds](../Carbon/CarbonImmutable.md#microseconds) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Set current instance microsecond to the given value. |
| CarbonImmutable | [CarbonImmutable::microsecond](../Carbon/CarbonImmutable.md#microsecond) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Set current instance microsecond to the given value. |
| CarbonImmutable | [CarbonImmutable::setMicroseconds](../Carbon/CarbonImmutable.md#setmicroseconds) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Set current instance microsecond to the given value. |
| self | [CarbonImmutable::setMicrosecond](../Carbon/CarbonImmutable.md#setmicrosecond) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Set current instance microsecond to the given value. |
| CarbonImmutable | [CarbonImmutable::addYears](../Carbon/CarbonImmutable.md#addyears) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [CarbonImmutable::addYear](../Carbon/CarbonImmutable.md#addyear) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [CarbonImmutable::subYears](../Carbon/CarbonImmutable.md#subyears) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [CarbonImmutable::subYear](../Carbon/CarbonImmutable.md#subyear) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [CarbonImmutable::addYearsWithOverflow](../Carbon/CarbonImmutable.md#addyearswithoverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly allowed. |
| CarbonImmutable | [CarbonImmutable::addYearWithOverflow](../Carbon/CarbonImmutable.md#addyearwithoverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly allowed. |
| CarbonImmutable | [CarbonImmutable::subYearsWithOverflow](../Carbon/CarbonImmutable.md#subyearswithoverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly allowed. |
| CarbonImmutable | [CarbonImmutable::subYearWithOverflow](../Carbon/CarbonImmutable.md#subyearwithoverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly allowed. |
| CarbonImmutable | [CarbonImmutable::addYearsWithoutOverflow](../Carbon/CarbonImmutable.md#addyearswithoutoverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly forbidden. |
| CarbonImmutable | [CarbonImmutable::addYearWithoutOverflow](../Carbon/CarbonImmutable.md#addyearwithoutoverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly forbidden. |
| CarbonImmutable | [CarbonImmutable::subYearsWithoutOverflow](../Carbon/CarbonImmutable.md#subyearswithoutoverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly forbidden. |
| CarbonImmutable | [CarbonImmutable::subYearWithoutOverflow](../Carbon/CarbonImmutable.md#subyearwithoutoverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly forbidden. |
| CarbonImmutable | [CarbonImmutable::addYearsWithNoOverflow](../Carbon/CarbonImmutable.md#addyearswithnooverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly forbidden. |
| CarbonImmutable | [CarbonImmutable::addYearWithNoOverflow](../Carbon/CarbonImmutable.md#addyearwithnooverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly forbidden. |
| CarbonImmutable | [CarbonImmutable::subYearsWithNoOverflow](../Carbon/CarbonImmutable.md#subyearswithnooverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly forbidden. |
| CarbonImmutable | [CarbonImmutable::subYearWithNoOverflow](../Carbon/CarbonImmutable.md#subyearwithnooverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly forbidden. |
| CarbonImmutable | [CarbonImmutable::addYearsNoOverflow](../Carbon/CarbonImmutable.md#addyearsnooverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly forbidden. |
| CarbonImmutable | [CarbonImmutable::addYearNoOverflow](../Carbon/CarbonImmutable.md#addyearnooverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly forbidden. |
| CarbonImmutable | [CarbonImmutable::subYearsNoOverflow](../Carbon/CarbonImmutable.md#subyearsnooverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly forbidden. |
| CarbonImmutable | [CarbonImmutable::subYearNoOverflow](../Carbon/CarbonImmutable.md#subyearnooverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly forbidden. |
| CarbonImmutable | [CarbonImmutable::addMonths](../Carbon/CarbonImmutable.md#addmonths) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [CarbonImmutable::addMonth](../Carbon/CarbonImmutable.md#addmonth) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [CarbonImmutable::subMonths](../Carbon/CarbonImmutable.md#submonths) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [CarbonImmutable::subMonth](../Carbon/CarbonImmutable.md#submonth) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [CarbonImmutable::addMonthsWithOverflow](../Carbon/CarbonImmutable.md#addmonthswithoverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly allowed. |
| CarbonImmutable | [CarbonImmutable::addMonthWithOverflow](../Carbon/CarbonImmutable.md#addmonthwithoverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly allowed. |
| CarbonImmutable | [CarbonImmutable::subMonthsWithOverflow](../Carbon/CarbonImmutable.md#submonthswithoverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly allowed. |
| CarbonImmutable | [CarbonImmutable::subMonthWithOverflow](../Carbon/CarbonImmutable.md#submonthwithoverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly allowed. |
| CarbonImmutable | [CarbonImmutable::addMonthsWithoutOverflow](../Carbon/CarbonImmutable.md#addmonthswithoutoverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly forbidden. |
| CarbonImmutable | [CarbonImmutable::addMonthWithoutOverflow](../Carbon/CarbonImmutable.md#addmonthwithoutoverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly forbidden. |
| CarbonImmutable | [CarbonImmutable::subMonthsWithoutOverflow](../Carbon/CarbonImmutable.md#submonthswithoutoverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly forbidden. |
| CarbonImmutable | [CarbonImmutable::subMonthWithoutOverflow](../Carbon/CarbonImmutable.md#submonthwithoutoverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly forbidden. |
| CarbonImmutable | [CarbonImmutable::addMonthsWithNoOverflow](../Carbon/CarbonImmutable.md#addmonthswithnooverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly forbidden. |
| CarbonImmutable | [CarbonImmutable::addMonthWithNoOverflow](../Carbon/CarbonImmutable.md#addmonthwithnooverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly forbidden. |
| CarbonImmutable | [CarbonImmutable::subMonthsWithNoOverflow](../Carbon/CarbonImmutable.md#submonthswithnooverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly forbidden. |
| CarbonImmutable | [CarbonImmutable::subMonthWithNoOverflow](../Carbon/CarbonImmutable.md#submonthwithnooverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly forbidden. |
| CarbonImmutable | [CarbonImmutable::addMonthsNoOverflow](../Carbon/CarbonImmutable.md#addmonthsnooverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly forbidden. |
| CarbonImmutable | [CarbonImmutable::addMonthNoOverflow](../Carbon/CarbonImmutable.md#addmonthnooverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly forbidden. |
| CarbonImmutable | [CarbonImmutable::subMonthsNoOverflow](../Carbon/CarbonImmutable.md#submonthsnooverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly forbidden. |
| CarbonImmutable | [CarbonImmutable::subMonthNoOverflow](../Carbon/CarbonImmutable.md#submonthnooverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly forbidden. |
| CarbonImmutable | [CarbonImmutable::addDays](../Carbon/CarbonImmutable.md#adddays) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [CarbonImmutable::addDay](../Carbon/CarbonImmutable.md#addday) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [CarbonImmutable::subDays](../Carbon/CarbonImmutable.md#subdays) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [CarbonImmutable::subDay](../Carbon/CarbonImmutable.md#subday) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [CarbonImmutable::addHours](../Carbon/CarbonImmutable.md#addhours) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [CarbonImmutable::addHour](../Carbon/CarbonImmutable.md#addhour) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [CarbonImmutable::subHours](../Carbon/CarbonImmutable.md#subhours) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [CarbonImmutable::subHour](../Carbon/CarbonImmutable.md#subhour) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [CarbonImmutable::addMinutes](../Carbon/CarbonImmutable.md#addminutes) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [CarbonImmutable::addMinute](../Carbon/CarbonImmutable.md#addminute) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [CarbonImmutable::subMinutes](../Carbon/CarbonImmutable.md#subminutes) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [CarbonImmutable::subMinute](../Carbon/CarbonImmutable.md#subminute) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [CarbonImmutable::addSeconds](../Carbon/CarbonImmutable.md#addseconds) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [CarbonImmutable::addSecond](../Carbon/CarbonImmutable.md#addsecond) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [CarbonImmutable::subSeconds](../Carbon/CarbonImmutable.md#subseconds) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [CarbonImmutable::subSecond](../Carbon/CarbonImmutable.md#subsecond) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [CarbonImmutable::addMillis](../Carbon/CarbonImmutable.md#addmillis) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [CarbonImmutable::addMilli](../Carbon/CarbonImmutable.md#addmilli) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [CarbonImmutable::subMillis](../Carbon/CarbonImmutable.md#submillis) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [CarbonImmutable::subMilli](../Carbon/CarbonImmutable.md#submilli) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [CarbonImmutable::addMilliseconds](../Carbon/CarbonImmutable.md#addmilliseconds) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [CarbonImmutable::addMillisecond](../Carbon/CarbonImmutable.md#addmillisecond) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [CarbonImmutable::subMilliseconds](../Carbon/CarbonImmutable.md#submilliseconds) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [CarbonImmutable::subMillisecond](../Carbon/CarbonImmutable.md#submillisecond) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [CarbonImmutable::addMicros](../Carbon/CarbonImmutable.md#addmicros) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [CarbonImmutable::addMicro](../Carbon/CarbonImmutable.md#addmicro) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [CarbonImmutable::subMicros](../Carbon/CarbonImmutable.md#submicros) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [CarbonImmutable::subMicro](../Carbon/CarbonImmutable.md#submicro) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [CarbonImmutable::addMicroseconds](../Carbon/CarbonImmutable.md#addmicroseconds) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [CarbonImmutable::addMicrosecond](../Carbon/CarbonImmutable.md#addmicrosecond) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [CarbonImmutable::subMicroseconds](../Carbon/CarbonImmutable.md#submicroseconds) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [CarbonImmutable::subMicrosecond](../Carbon/CarbonImmutable.md#submicrosecond) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [CarbonImmutable::addMillennia](../Carbon/CarbonImmutable.md#addmillennia) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [CarbonImmutable::addMillennium](../Carbon/CarbonImmutable.md#addmillennium) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [CarbonImmutable::subMillennia](../Carbon/CarbonImmutable.md#submillennia) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [CarbonImmutable::subMillennium](../Carbon/CarbonImmutable.md#submillennium) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [CarbonImmutable::addMillenniaWithOverflow](../Carbon/CarbonImmutable.md#addmillenniawithoverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly allowed. |
| CarbonImmutable | [CarbonImmutable::addMillenniumWithOverflow](../Carbon/CarbonImmutable.md#addmillenniumwithoverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly allowed. |
| CarbonImmutable | [CarbonImmutable::subMillenniaWithOverflow](../Carbon/CarbonImmutable.md#submillenniawithoverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly allowed. |
| CarbonImmutable | [CarbonImmutable::subMillenniumWithOverflow](../Carbon/CarbonImmutable.md#submillenniumwithoverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly allowed. |
| CarbonImmutable | [CarbonImmutable::addMillenniaWithoutOverflow](../Carbon/CarbonImmutable.md#addmillenniawithoutoverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly forbidden. |
| CarbonImmutable | [CarbonImmutable::addMillenniumWithoutOverflow](../Carbon/CarbonImmutable.md#addmillenniumwithoutoverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly forbidden. |
| CarbonImmutable | [CarbonImmutable::subMillenniaWithoutOverflow](../Carbon/CarbonImmutable.md#submillenniawithoutoverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly forbidden. |
| CarbonImmutable | [CarbonImmutable::subMillenniumWithoutOverflow](../Carbon/CarbonImmutable.md#submillenniumwithoutoverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly forbidden. |
| CarbonImmutable | [CarbonImmutable::addMillenniaWithNoOverflow](../Carbon/CarbonImmutable.md#addmillenniawithnooverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly forbidden. |
| CarbonImmutable | [CarbonImmutable::addMillenniumWithNoOverflow](../Carbon/CarbonImmutable.md#addmillenniumwithnooverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly forbidden. |
| CarbonImmutable | [CarbonImmutable::subMillenniaWithNoOverflow](../Carbon/CarbonImmutable.md#submillenniawithnooverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly forbidden. |
| CarbonImmutable | [CarbonImmutable::subMillenniumWithNoOverflow](../Carbon/CarbonImmutable.md#submillenniumwithnooverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly forbidden. |
| CarbonImmutable | [CarbonImmutable::addMillenniaNoOverflow](../Carbon/CarbonImmutable.md#addmillennianooverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly forbidden. |
| CarbonImmutable | [CarbonImmutable::addMillenniumNoOverflow](../Carbon/CarbonImmutable.md#addmillenniumnooverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly forbidden. |
| CarbonImmutable | [CarbonImmutable::subMillenniaNoOverflow](../Carbon/CarbonImmutable.md#submillennianooverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly forbidden. |
| CarbonImmutable | [CarbonImmutable::subMillenniumNoOverflow](../Carbon/CarbonImmutable.md#submillenniumnooverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly forbidden. |
| CarbonImmutable | [CarbonImmutable::addCenturies](../Carbon/CarbonImmutable.md#addcenturies) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [CarbonImmutable::addCentury](../Carbon/CarbonImmutable.md#addcentury) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [CarbonImmutable::subCenturies](../Carbon/CarbonImmutable.md#subcenturies) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [CarbonImmutable::subCentury](../Carbon/CarbonImmutable.md#subcentury) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [CarbonImmutable::addCenturiesWithOverflow](../Carbon/CarbonImmutable.md#addcenturieswithoverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly allowed. |
| CarbonImmutable | [CarbonImmutable::addCenturyWithOverflow](../Carbon/CarbonImmutable.md#addcenturywithoverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly allowed. |
| CarbonImmutable | [CarbonImmutable::subCenturiesWithOverflow](../Carbon/CarbonImmutable.md#subcenturieswithoverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly allowed. |
| CarbonImmutable | [CarbonImmutable::subCenturyWithOverflow](../Carbon/CarbonImmutable.md#subcenturywithoverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly allowed. |
| CarbonImmutable | [CarbonImmutable::addCenturiesWithoutOverflow](../Carbon/CarbonImmutable.md#addcenturieswithoutoverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly forbidden. |
| CarbonImmutable | [CarbonImmutable::addCenturyWithoutOverflow](../Carbon/CarbonImmutable.md#addcenturywithoutoverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly forbidden. |
| CarbonImmutable | [CarbonImmutable::subCenturiesWithoutOverflow](../Carbon/CarbonImmutable.md#subcenturieswithoutoverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly forbidden. |
| CarbonImmutable | [CarbonImmutable::subCenturyWithoutOverflow](../Carbon/CarbonImmutable.md#subcenturywithoutoverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly forbidden. |
| CarbonImmutable | [CarbonImmutable::addCenturiesWithNoOverflow](../Carbon/CarbonImmutable.md#addcenturieswithnooverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly forbidden. |
| CarbonImmutable | [CarbonImmutable::addCenturyWithNoOverflow](../Carbon/CarbonImmutable.md#addcenturywithnooverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly forbidden. |
| CarbonImmutable | [CarbonImmutable::subCenturiesWithNoOverflow](../Carbon/CarbonImmutable.md#subcenturieswithnooverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly forbidden. |
| CarbonImmutable | [CarbonImmutable::subCenturyWithNoOverflow](../Carbon/CarbonImmutable.md#subcenturywithnooverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly forbidden. |
| CarbonImmutable | [CarbonImmutable::addCenturiesNoOverflow](../Carbon/CarbonImmutable.md#addcenturiesnooverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly forbidden. |
| CarbonImmutable | [CarbonImmutable::addCenturyNoOverflow](../Carbon/CarbonImmutable.md#addcenturynooverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly forbidden. |
| CarbonImmutable | [CarbonImmutable::subCenturiesNoOverflow](../Carbon/CarbonImmutable.md#subcenturiesnooverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly forbidden. |
| CarbonImmutable | [CarbonImmutable::subCenturyNoOverflow](../Carbon/CarbonImmutable.md#subcenturynooverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly forbidden. |
| CarbonImmutable | [CarbonImmutable::addDecades](../Carbon/CarbonImmutable.md#adddecades) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [CarbonImmutable::addDecade](../Carbon/CarbonImmutable.md#adddecade) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [CarbonImmutable::subDecades](../Carbon/CarbonImmutable.md#subdecades) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [CarbonImmutable::subDecade](../Carbon/CarbonImmutable.md#subdecade) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [CarbonImmutable::addDecadesWithOverflow](../Carbon/CarbonImmutable.md#adddecadeswithoverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly allowed. |
| CarbonImmutable | [CarbonImmutable::addDecadeWithOverflow](../Carbon/CarbonImmutable.md#adddecadewithoverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly allowed. |
| CarbonImmutable | [CarbonImmutable::subDecadesWithOverflow](../Carbon/CarbonImmutable.md#subdecadeswithoverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly allowed. |
| CarbonImmutable | [CarbonImmutable::subDecadeWithOverflow](../Carbon/CarbonImmutable.md#subdecadewithoverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly allowed. |
| CarbonImmutable | [CarbonImmutable::addDecadesWithoutOverflow](../Carbon/CarbonImmutable.md#adddecadeswithoutoverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly forbidden. |
| CarbonImmutable | [CarbonImmutable::addDecadeWithoutOverflow](../Carbon/CarbonImmutable.md#adddecadewithoutoverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly forbidden. |
| CarbonImmutable | [CarbonImmutable::subDecadesWithoutOverflow](../Carbon/CarbonImmutable.md#subdecadeswithoutoverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly forbidden. |
| CarbonImmutable | [CarbonImmutable::subDecadeWithoutOverflow](../Carbon/CarbonImmutable.md#subdecadewithoutoverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly forbidden. |
| CarbonImmutable | [CarbonImmutable::addDecadesWithNoOverflow](../Carbon/CarbonImmutable.md#adddecadeswithnooverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly forbidden. |
| CarbonImmutable | [CarbonImmutable::addDecadeWithNoOverflow](../Carbon/CarbonImmutable.md#adddecadewithnooverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly forbidden. |
| CarbonImmutable | [CarbonImmutable::subDecadesWithNoOverflow](../Carbon/CarbonImmutable.md#subdecadeswithnooverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly forbidden. |
| CarbonImmutable | [CarbonImmutable::subDecadeWithNoOverflow](../Carbon/CarbonImmutable.md#subdecadewithnooverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly forbidden. |
| CarbonImmutable | [CarbonImmutable::addDecadesNoOverflow](../Carbon/CarbonImmutable.md#adddecadesnooverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly forbidden. |
| CarbonImmutable | [CarbonImmutable::addDecadeNoOverflow](../Carbon/CarbonImmutable.md#adddecadenooverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly forbidden. |
| CarbonImmutable | [CarbonImmutable::subDecadesNoOverflow](../Carbon/CarbonImmutable.md#subdecadesnooverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly forbidden. |
| CarbonImmutable | [CarbonImmutable::subDecadeNoOverflow](../Carbon/CarbonImmutable.md#subdecadenooverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly forbidden. |
| CarbonImmutable | [CarbonImmutable::addQuarters](../Carbon/CarbonImmutable.md#addquarters) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [CarbonImmutable::addQuarter](../Carbon/CarbonImmutable.md#addquarter) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [CarbonImmutable::subQuarters](../Carbon/CarbonImmutable.md#subquarters) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [CarbonImmutable::subQuarter](../Carbon/CarbonImmutable.md#subquarter) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [CarbonImmutable::addQuartersWithOverflow](../Carbon/CarbonImmutable.md#addquarterswithoverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly allowed. |
| CarbonImmutable | [CarbonImmutable::addQuarterWithOverflow](../Carbon/CarbonImmutable.md#addquarterwithoverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly allowed. |
| CarbonImmutable | [CarbonImmutable::subQuartersWithOverflow](../Carbon/CarbonImmutable.md#subquarterswithoverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly allowed. |
| CarbonImmutable | [CarbonImmutable::subQuarterWithOverflow](../Carbon/CarbonImmutable.md#subquarterwithoverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly allowed. |
| CarbonImmutable | [CarbonImmutable::addQuartersWithoutOverflow](../Carbon/CarbonImmutable.md#addquarterswithoutoverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly forbidden. |
| CarbonImmutable | [CarbonImmutable::addQuarterWithoutOverflow](../Carbon/CarbonImmutable.md#addquarterwithoutoverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly forbidden. |
| CarbonImmutable | [CarbonImmutable::subQuartersWithoutOverflow](../Carbon/CarbonImmutable.md#subquarterswithoutoverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly forbidden. |
| CarbonImmutable | [CarbonImmutable::subQuarterWithoutOverflow](../Carbon/CarbonImmutable.md#subquarterwithoutoverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly forbidden. |
| CarbonImmutable | [CarbonImmutable::addQuartersWithNoOverflow](../Carbon/CarbonImmutable.md#addquarterswithnooverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly forbidden. |
| CarbonImmutable | [CarbonImmutable::addQuarterWithNoOverflow](../Carbon/CarbonImmutable.md#addquarterwithnooverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly forbidden. |
| CarbonImmutable | [CarbonImmutable::subQuartersWithNoOverflow](../Carbon/CarbonImmutable.md#subquarterswithnooverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly forbidden. |
| CarbonImmutable | [CarbonImmutable::subQuarterWithNoOverflow](../Carbon/CarbonImmutable.md#subquarterwithnooverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly forbidden. |
| CarbonImmutable | [CarbonImmutable::addQuartersNoOverflow](../Carbon/CarbonImmutable.md#addquartersnooverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly forbidden. |
| CarbonImmutable | [CarbonImmutable::addQuarterNoOverflow](../Carbon/CarbonImmutable.md#addquarternooverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly forbidden. |
| CarbonImmutable | [CarbonImmutable::subQuartersNoOverflow](../Carbon/CarbonImmutable.md#subquartersnooverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly forbidden. |
| CarbonImmutable | [CarbonImmutable::subQuarterNoOverflow](../Carbon/CarbonImmutable.md#subquarternooverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly forbidden. |
| CarbonImmutable | [CarbonImmutable::addWeeks](../Carbon/CarbonImmutable.md#addweeks) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [CarbonImmutable::addWeek](../Carbon/CarbonImmutable.md#addweek) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [CarbonImmutable::subWeeks](../Carbon/CarbonImmutable.md#subweeks) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [CarbonImmutable::subWeek](../Carbon/CarbonImmutable.md#subweek) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [CarbonImmutable::addWeekdays](../Carbon/CarbonImmutable.md#addweekdays) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [CarbonImmutable::addWeekday](../Carbon/CarbonImmutable.md#addweekday) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [CarbonImmutable::subWeekdays](../Carbon/CarbonImmutable.md#subweekdays) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [CarbonImmutable::subWeekday](../Carbon/CarbonImmutable.md#subweekday) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [CarbonImmutable::addUTCMicros](../Carbon/CarbonImmutable.md#addutcmicros) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [CarbonImmutable::addUTCMicro](../Carbon/CarbonImmutable.md#addutcmicro) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [CarbonImmutable::subUTCMicros](../Carbon/CarbonImmutable.md#subutcmicros) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [CarbonImmutable::subUTCMicro](../Carbon/CarbonImmutable.md#subutcmicro) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonPeriod | [CarbonImmutable::microsUntil](../Carbon/CarbonImmutable.md#microsuntil) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | for each microsecond or every X microseconds if a factor is given. |
| float | [CarbonImmutable::diffInUTCMicros](../Carbon/CarbonImmutable.md#diffinutcmicros) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Convert current and given date in UTC timezone and return a floating number of microseconds. |
| CarbonImmutable | [CarbonImmutable::addUTCMicroseconds](../Carbon/CarbonImmutable.md#addutcmicroseconds) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [CarbonImmutable::addUTCMicrosecond](../Carbon/CarbonImmutable.md#addutcmicrosecond) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [CarbonImmutable::subUTCMicroseconds](../Carbon/CarbonImmutable.md#subutcmicroseconds) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [CarbonImmutable::subUTCMicrosecond](../Carbon/CarbonImmutable.md#subutcmicrosecond) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonPeriod | [CarbonImmutable::microsecondsUntil](../Carbon/CarbonImmutable.md#microsecondsuntil) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | for each microsecond or every X microseconds if a factor is given. |
| float | [CarbonImmutable::diffInUTCMicroseconds](../Carbon/CarbonImmutable.md#diffinutcmicroseconds) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Convert current and given date in UTC timezone and return a floating number of microseconds. |
| CarbonImmutable | [CarbonImmutable::addUTCMillis](../Carbon/CarbonImmutable.md#addutcmillis) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [CarbonImmutable::addUTCMilli](../Carbon/CarbonImmutable.md#addutcmilli) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [CarbonImmutable::subUTCMillis](../Carbon/CarbonImmutable.md#subutcmillis) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [CarbonImmutable::subUTCMilli](../Carbon/CarbonImmutable.md#subutcmilli) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonPeriod | [CarbonImmutable::millisUntil](../Carbon/CarbonImmutable.md#millisuntil) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | for each millisecond or every X milliseconds if a factor is given. |
| float | [CarbonImmutable::diffInUTCMillis](../Carbon/CarbonImmutable.md#diffinutcmillis) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Convert current and given date in UTC timezone and return a floating number of milliseconds. |
| CarbonImmutable | [CarbonImmutable::addUTCMilliseconds](../Carbon/CarbonImmutable.md#addutcmilliseconds) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [CarbonImmutable::addUTCMillisecond](../Carbon/CarbonImmutable.md#addutcmillisecond) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [CarbonImmutable::subUTCMilliseconds](../Carbon/CarbonImmutable.md#subutcmilliseconds) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [CarbonImmutable::subUTCMillisecond](../Carbon/CarbonImmutable.md#subutcmillisecond) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonPeriod | [CarbonImmutable::millisecondsUntil](../Carbon/CarbonImmutable.md#millisecondsuntil) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | for each millisecond or every X milliseconds if a factor is given. |
| float | [CarbonImmutable::diffInUTCMilliseconds](../Carbon/CarbonImmutable.md#diffinutcmilliseconds) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Convert current and given date in UTC timezone and return a floating number of milliseconds. |
| CarbonImmutable | [CarbonImmutable::addUTCSeconds](../Carbon/CarbonImmutable.md#addutcseconds) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [CarbonImmutable::addUTCSecond](../Carbon/CarbonImmutable.md#addutcsecond) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [CarbonImmutable::subUTCSeconds](../Carbon/CarbonImmutable.md#subutcseconds) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [CarbonImmutable::subUTCSecond](../Carbon/CarbonImmutable.md#subutcsecond) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonPeriod | [CarbonImmutable::secondsUntil](../Carbon/CarbonImmutable.md#secondsuntil) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | for each second or every X seconds if a factor is given. |
| float | [CarbonImmutable::diffInUTCSeconds](../Carbon/CarbonImmutable.md#diffinutcseconds) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Convert current and given date in UTC timezone and return a floating number of seconds. |
| CarbonImmutable | [CarbonImmutable::addUTCMinutes](../Carbon/CarbonImmutable.md#addutcminutes) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [CarbonImmutable::addUTCMinute](../Carbon/CarbonImmutable.md#addutcminute) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [CarbonImmutable::subUTCMinutes](../Carbon/CarbonImmutable.md#subutcminutes) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [CarbonImmutable::subUTCMinute](../Carbon/CarbonImmutable.md#subutcminute) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonPeriod | [CarbonImmutable::minutesUntil](../Carbon/CarbonImmutable.md#minutesuntil) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | for each minute or every X minutes if a factor is given. |
| float | [CarbonImmutable::diffInUTCMinutes](../Carbon/CarbonImmutable.md#diffinutcminutes) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Convert current and given date in UTC timezone and return a floating number of minutes. |
| CarbonImmutable | [CarbonImmutable::addUTCHours](../Carbon/CarbonImmutable.md#addutchours) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [CarbonImmutable::addUTCHour](../Carbon/CarbonImmutable.md#addutchour) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [CarbonImmutable::subUTCHours](../Carbon/CarbonImmutable.md#subutchours) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [CarbonImmutable::subUTCHour](../Carbon/CarbonImmutable.md#subutchour) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonPeriod | [CarbonImmutable::hoursUntil](../Carbon/CarbonImmutable.md#hoursuntil) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | for each hour or every X hours if a factor is given. |
| float | [CarbonImmutable::diffInUTCHours](../Carbon/CarbonImmutable.md#diffinutchours) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Convert current and given date in UTC timezone and return a floating number of hours. |
| CarbonImmutable | [CarbonImmutable::addUTCDays](../Carbon/CarbonImmutable.md#addutcdays) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [CarbonImmutable::addUTCDay](../Carbon/CarbonImmutable.md#addutcday) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [CarbonImmutable::subUTCDays](../Carbon/CarbonImmutable.md#subutcdays) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [CarbonImmutable::subUTCDay](../Carbon/CarbonImmutable.md#subutcday) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonPeriod | [CarbonImmutable::daysUntil](../Carbon/CarbonImmutable.md#daysuntil) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | for each day or every X days if a factor is given. |
| float | [CarbonImmutable::diffInUTCDays](../Carbon/CarbonImmutable.md#diffinutcdays) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Convert current and given date in UTC timezone and return a floating number of days. |
| CarbonImmutable | [CarbonImmutable::addUTCWeeks](../Carbon/CarbonImmutable.md#addutcweeks) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [CarbonImmutable::addUTCWeek](../Carbon/CarbonImmutable.md#addutcweek) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [CarbonImmutable::subUTCWeeks](../Carbon/CarbonImmutable.md#subutcweeks) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [CarbonImmutable::subUTCWeek](../Carbon/CarbonImmutable.md#subutcweek) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonPeriod | [CarbonImmutable::weeksUntil](../Carbon/CarbonImmutable.md#weeksuntil) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | for each week or every X weeks if a factor is given. |
| float | [CarbonImmutable::diffInUTCWeeks](../Carbon/CarbonImmutable.md#diffinutcweeks) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Convert current and given date in UTC timezone and return a floating number of weeks. |
| CarbonImmutable | [CarbonImmutable::addUTCMonths](../Carbon/CarbonImmutable.md#addutcmonths) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [CarbonImmutable::addUTCMonth](../Carbon/CarbonImmutable.md#addutcmonth) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [CarbonImmutable::subUTCMonths](../Carbon/CarbonImmutable.md#subutcmonths) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [CarbonImmutable::subUTCMonth](../Carbon/CarbonImmutable.md#subutcmonth) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonPeriod | [CarbonImmutable::monthsUntil](../Carbon/CarbonImmutable.md#monthsuntil) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | for each month or every X months if a factor is given. |
| float | [CarbonImmutable::diffInUTCMonths](../Carbon/CarbonImmutable.md#diffinutcmonths) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Convert current and given date in UTC timezone and return a floating number of months. |
| CarbonImmutable | [CarbonImmutable::addUTCQuarters](../Carbon/CarbonImmutable.md#addutcquarters) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [CarbonImmutable::addUTCQuarter](../Carbon/CarbonImmutable.md#addutcquarter) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [CarbonImmutable::subUTCQuarters](../Carbon/CarbonImmutable.md#subutcquarters) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [CarbonImmutable::subUTCQuarter](../Carbon/CarbonImmutable.md#subutcquarter) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonPeriod | [CarbonImmutable::quartersUntil](../Carbon/CarbonImmutable.md#quartersuntil) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | for each quarter or every X quarters if a factor is given. |
| float | [CarbonImmutable::diffInUTCQuarters](../Carbon/CarbonImmutable.md#diffinutcquarters) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Convert current and given date in UTC timezone and return a floating number of quarters. |
| CarbonImmutable | [CarbonImmutable::addUTCYears](../Carbon/CarbonImmutable.md#addutcyears) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [CarbonImmutable::addUTCYear](../Carbon/CarbonImmutable.md#addutcyear) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [CarbonImmutable::subUTCYears](../Carbon/CarbonImmutable.md#subutcyears) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [CarbonImmutable::subUTCYear](../Carbon/CarbonImmutable.md#subutcyear) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonPeriod | [CarbonImmutable::yearsUntil](../Carbon/CarbonImmutable.md#yearsuntil) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | for each year or every X years if a factor is given. |
| float | [CarbonImmutable::diffInUTCYears](../Carbon/CarbonImmutable.md#diffinutcyears) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Convert current and given date in UTC timezone and return a floating number of years. |
| CarbonImmutable | [CarbonImmutable::addUTCDecades](../Carbon/CarbonImmutable.md#addutcdecades) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [CarbonImmutable::addUTCDecade](../Carbon/CarbonImmutable.md#addutcdecade) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [CarbonImmutable::subUTCDecades](../Carbon/CarbonImmutable.md#subutcdecades) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [CarbonImmutable::subUTCDecade](../Carbon/CarbonImmutable.md#subutcdecade) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonPeriod | [CarbonImmutable::decadesUntil](../Carbon/CarbonImmutable.md#decadesuntil) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | for each decade or every X decades if a factor is given. |
| float | [CarbonImmutable::diffInUTCDecades](../Carbon/CarbonImmutable.md#diffinutcdecades) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Convert current and given date in UTC timezone and return a floating number of decades. |
| CarbonImmutable | [CarbonImmutable::addUTCCenturies](../Carbon/CarbonImmutable.md#addutccenturies) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [CarbonImmutable::addUTCCentury](../Carbon/CarbonImmutable.md#addutccentury) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [CarbonImmutable::subUTCCenturies](../Carbon/CarbonImmutable.md#subutccenturies) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [CarbonImmutable::subUTCCentury](../Carbon/CarbonImmutable.md#subutccentury) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonPeriod | [CarbonImmutable::centuriesUntil](../Carbon/CarbonImmutable.md#centuriesuntil) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | for each century or every X centuries if a factor is given. |
| float | [CarbonImmutable::diffInUTCCenturies](../Carbon/CarbonImmutable.md#diffinutccenturies) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Convert current and given date in UTC timezone and return a floating number of centuries. |
| CarbonImmutable | [CarbonImmutable::addUTCMillennia](../Carbon/CarbonImmutable.md#addutcmillennia) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [CarbonImmutable::addUTCMillennium](../Carbon/CarbonImmutable.md#addutcmillennium) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [CarbonImmutable::subUTCMillennia](../Carbon/CarbonImmutable.md#subutcmillennia) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [CarbonImmutable::subUTCMillennium](../Carbon/CarbonImmutable.md#subutcmillennium) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonPeriod | [CarbonImmutable::millenniaUntil](../Carbon/CarbonImmutable.md#millenniauntil) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | for each millennium or every X millennia if a factor is given. |
| float | [CarbonImmutable::diffInUTCMillennia](../Carbon/CarbonImmutable.md#diffinutcmillennia) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Convert current and given date in UTC timezone and return a floating number of millennia. |
| CarbonImmutable | [CarbonImmutable::roundYear](../Carbon/CarbonImmutable.md#roundyear) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Round the current instance year with given precision using the given function. |
| CarbonImmutable | [CarbonImmutable::roundYears](../Carbon/CarbonImmutable.md#roundyears) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Round the current instance year with given precision using the given function. |
| CarbonImmutable | [CarbonImmutable::floorYear](../Carbon/CarbonImmutable.md#flooryear) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Truncate the current instance year with given precision. |
| CarbonImmutable | [CarbonImmutable::floorYears](../Carbon/CarbonImmutable.md#flooryears) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Truncate the current instance year with given precision. |
| CarbonImmutable | [CarbonImmutable::ceilYear](../Carbon/CarbonImmutable.md#ceilyear) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Ceil the current instance year with given precision. |
| CarbonImmutable | [CarbonImmutable::ceilYears](../Carbon/CarbonImmutable.md#ceilyears) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Ceil the current instance year with given precision. |
| CarbonImmutable | [CarbonImmutable::roundMonth](../Carbon/CarbonImmutable.md#roundmonth) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Round the current instance month with given precision using the given function. |
| CarbonImmutable | [CarbonImmutable::roundMonths](../Carbon/CarbonImmutable.md#roundmonths) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Round the current instance month with given precision using the given function. |
| CarbonImmutable | [CarbonImmutable::floorMonth](../Carbon/CarbonImmutable.md#floormonth) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Truncate the current instance month with given precision. |
| CarbonImmutable | [CarbonImmutable::floorMonths](../Carbon/CarbonImmutable.md#floormonths) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Truncate the current instance month with given precision. |
| CarbonImmutable | [CarbonImmutable::ceilMonth](../Carbon/CarbonImmutable.md#ceilmonth) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Ceil the current instance month with given precision. |
| CarbonImmutable | [CarbonImmutable::ceilMonths](../Carbon/CarbonImmutable.md#ceilmonths) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Ceil the current instance month with given precision. |
| CarbonImmutable | [CarbonImmutable::roundDay](../Carbon/CarbonImmutable.md#roundday) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Round the current instance day with given precision using the given function. |
| CarbonImmutable | [CarbonImmutable::roundDays](../Carbon/CarbonImmutable.md#rounddays) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Round the current instance day with given precision using the given function. |
| CarbonImmutable | [CarbonImmutable::floorDay](../Carbon/CarbonImmutable.md#floorday) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Truncate the current instance day with given precision. |
| CarbonImmutable | [CarbonImmutable::floorDays](../Carbon/CarbonImmutable.md#floordays) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Truncate the current instance day with given precision. |
| CarbonImmutable | [CarbonImmutable::ceilDay](../Carbon/CarbonImmutable.md#ceilday) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Ceil the current instance day with given precision. |
| CarbonImmutable | [CarbonImmutable::ceilDays](../Carbon/CarbonImmutable.md#ceildays) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Ceil the current instance day with given precision. |
| CarbonImmutable | [CarbonImmutable::roundHour](../Carbon/CarbonImmutable.md#roundhour) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Round the current instance hour with given precision using the given function. |
| CarbonImmutable | [CarbonImmutable::roundHours](../Carbon/CarbonImmutable.md#roundhours) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Round the current instance hour with given precision using the given function. |
| CarbonImmutable | [CarbonImmutable::floorHour](../Carbon/CarbonImmutable.md#floorhour) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Truncate the current instance hour with given precision. |
| CarbonImmutable | [CarbonImmutable::floorHours](../Carbon/CarbonImmutable.md#floorhours) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Truncate the current instance hour with given precision. |
| CarbonImmutable | [CarbonImmutable::ceilHour](../Carbon/CarbonImmutable.md#ceilhour) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Ceil the current instance hour with given precision. |
| CarbonImmutable | [CarbonImmutable::ceilHours](../Carbon/CarbonImmutable.md#ceilhours) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Ceil the current instance hour with given precision. |
| CarbonImmutable | [CarbonImmutable::roundMinute](../Carbon/CarbonImmutable.md#roundminute) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Round the current instance minute with given precision using the given function. |
| CarbonImmutable | [CarbonImmutable::roundMinutes](../Carbon/CarbonImmutable.md#roundminutes) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Round the current instance minute with given precision using the given function. |
| CarbonImmutable | [CarbonImmutable::floorMinute](../Carbon/CarbonImmutable.md#floorminute) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Truncate the current instance minute with given precision. |
| CarbonImmutable | [CarbonImmutable::floorMinutes](../Carbon/CarbonImmutable.md#floorminutes) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Truncate the current instance minute with given precision. |
| CarbonImmutable | [CarbonImmutable::ceilMinute](../Carbon/CarbonImmutable.md#ceilminute) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Ceil the current instance minute with given precision. |
| CarbonImmutable | [CarbonImmutable::ceilMinutes](../Carbon/CarbonImmutable.md#ceilminutes) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Ceil the current instance minute with given precision. |
| CarbonImmutable | [CarbonImmutable::roundSecond](../Carbon/CarbonImmutable.md#roundsecond) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Round the current instance second with given precision using the given function. |
| CarbonImmutable | [CarbonImmutable::roundSeconds](../Carbon/CarbonImmutable.md#roundseconds) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Round the current instance second with given precision using the given function. |
| CarbonImmutable | [CarbonImmutable::floorSecond](../Carbon/CarbonImmutable.md#floorsecond) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Truncate the current instance second with given precision. |
| CarbonImmutable | [CarbonImmutable::floorSeconds](../Carbon/CarbonImmutable.md#floorseconds) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Truncate the current instance second with given precision. |
| CarbonImmutable | [CarbonImmutable::ceilSecond](../Carbon/CarbonImmutable.md#ceilsecond) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Ceil the current instance second with given precision. |
| CarbonImmutable | [CarbonImmutable::ceilSeconds](../Carbon/CarbonImmutable.md#ceilseconds) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Ceil the current instance second with given precision. |
| CarbonImmutable | [CarbonImmutable::roundMillennium](../Carbon/CarbonImmutable.md#roundmillennium) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Round the current instance millennium with given precision using the given function. |
| CarbonImmutable | [CarbonImmutable::roundMillennia](../Carbon/CarbonImmutable.md#roundmillennia) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Round the current instance millennium with given precision using the given function. |
| CarbonImmutable | [CarbonImmutable::floorMillennium](../Carbon/CarbonImmutable.md#floormillennium) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Truncate the current instance millennium with given precision. |
| CarbonImmutable | [CarbonImmutable::floorMillennia](../Carbon/CarbonImmutable.md#floormillennia) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Truncate the current instance millennium with given precision. |
| CarbonImmutable | [CarbonImmutable::ceilMillennium](../Carbon/CarbonImmutable.md#ceilmillennium) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Ceil the current instance millennium with given precision. |
| CarbonImmutable | [CarbonImmutable::ceilMillennia](../Carbon/CarbonImmutable.md#ceilmillennia) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Ceil the current instance millennium with given precision. |
| CarbonImmutable | [CarbonImmutable::roundCentury](../Carbon/CarbonImmutable.md#roundcentury) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Round the current instance century with given precision using the given function. |
| CarbonImmutable | [CarbonImmutable::roundCenturies](../Carbon/CarbonImmutable.md#roundcenturies) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Round the current instance century with given precision using the given function. |
| CarbonImmutable | [CarbonImmutable::floorCentury](../Carbon/CarbonImmutable.md#floorcentury) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Truncate the current instance century with given precision. |
| CarbonImmutable | [CarbonImmutable::floorCenturies](../Carbon/CarbonImmutable.md#floorcenturies) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Truncate the current instance century with given precision. |
| CarbonImmutable | [CarbonImmutable::ceilCentury](../Carbon/CarbonImmutable.md#ceilcentury) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Ceil the current instance century with given precision. |
| CarbonImmutable | [CarbonImmutable::ceilCenturies](../Carbon/CarbonImmutable.md#ceilcenturies) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Ceil the current instance century with given precision. |
| CarbonImmutable | [CarbonImmutable::roundDecade](../Carbon/CarbonImmutable.md#rounddecade) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Round the current instance decade with given precision using the given function. |
| CarbonImmutable | [CarbonImmutable::roundDecades](../Carbon/CarbonImmutable.md#rounddecades) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Round the current instance decade with given precision using the given function. |
| CarbonImmutable | [CarbonImmutable::floorDecade](../Carbon/CarbonImmutable.md#floordecade) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Truncate the current instance decade with given precision. |
| CarbonImmutable | [CarbonImmutable::floorDecades](../Carbon/CarbonImmutable.md#floordecades) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Truncate the current instance decade with given precision. |
| CarbonImmutable | [CarbonImmutable::ceilDecade](../Carbon/CarbonImmutable.md#ceildecade) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Ceil the current instance decade with given precision. |
| CarbonImmutable | [CarbonImmutable::ceilDecades](../Carbon/CarbonImmutable.md#ceildecades) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Ceil the current instance decade with given precision. |
| CarbonImmutable | [CarbonImmutable::roundQuarter](../Carbon/CarbonImmutable.md#roundquarter) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Round the current instance quarter with given precision using the given function. |
| CarbonImmutable | [CarbonImmutable::roundQuarters](../Carbon/CarbonImmutable.md#roundquarters) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Round the current instance quarter with given precision using the given function. |
| CarbonImmutable | [CarbonImmutable::floorQuarter](../Carbon/CarbonImmutable.md#floorquarter) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Truncate the current instance quarter with given precision. |
| CarbonImmutable | [CarbonImmutable::floorQuarters](../Carbon/CarbonImmutable.md#floorquarters) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Truncate the current instance quarter with given precision. |
| CarbonImmutable | [CarbonImmutable::ceilQuarter](../Carbon/CarbonImmutable.md#ceilquarter) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Ceil the current instance quarter with given precision. |
| CarbonImmutable | [CarbonImmutable::ceilQuarters](../Carbon/CarbonImmutable.md#ceilquarters) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Ceil the current instance quarter with given precision. |
| CarbonImmutable | [CarbonImmutable::roundMillisecond](../Carbon/CarbonImmutable.md#roundmillisecond) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Round the current instance millisecond with given precision using the given function. |
| CarbonImmutable | [CarbonImmutable::roundMilliseconds](../Carbon/CarbonImmutable.md#roundmilliseconds) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Round the current instance millisecond with given precision using the given function. |
| CarbonImmutable | [CarbonImmutable::floorMillisecond](../Carbon/CarbonImmutable.md#floormillisecond) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Truncate the current instance millisecond with given precision. |
| CarbonImmutable | [CarbonImmutable::floorMilliseconds](../Carbon/CarbonImmutable.md#floormilliseconds) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Truncate the current instance millisecond with given precision. |
| CarbonImmutable | [CarbonImmutable::ceilMillisecond](../Carbon/CarbonImmutable.md#ceilmillisecond) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Ceil the current instance millisecond with given precision. |
| CarbonImmutable | [CarbonImmutable::ceilMilliseconds](../Carbon/CarbonImmutable.md#ceilmilliseconds) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Ceil the current instance millisecond with given precision. |
| CarbonImmutable | [CarbonImmutable::roundMicrosecond](../Carbon/CarbonImmutable.md#roundmicrosecond) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Round the current instance microsecond with given precision using the given function. |
| CarbonImmutable | [CarbonImmutable::roundMicroseconds](../Carbon/CarbonImmutable.md#roundmicroseconds) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Round the current instance microsecond with given precision using the given function. |
| CarbonImmutable | [CarbonImmutable::floorMicrosecond](../Carbon/CarbonImmutable.md#floormicrosecond) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Truncate the current instance microsecond with given precision. |
| CarbonImmutable | [CarbonImmutable::floorMicroseconds](../Carbon/CarbonImmutable.md#floormicroseconds) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Truncate the current instance microsecond with given precision. |
| CarbonImmutable | [CarbonImmutable::ceilMicrosecond](../Carbon/CarbonImmutable.md#ceilmicrosecond) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Ceil the current instance microsecond with given precision. |
| CarbonImmutable | [CarbonImmutable::ceilMicroseconds](../Carbon/CarbonImmutable.md#ceilmicroseconds) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Ceil the current instance microsecond with given precision. |
| string | [CarbonImmutable::shortAbsoluteDiffForHumans](../Carbon/CarbonImmutable.md#shortabsolutediffforhumans) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ |  |
| string | [CarbonImmutable::longAbsoluteDiffForHumans](../Carbon/CarbonImmutable.md#longabsolutediffforhumans) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ |  |
| string | [CarbonImmutable::shortRelativeDiffForHumans](../Carbon/CarbonImmutable.md#shortrelativediffforhumans) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ |  |
| string | [CarbonImmutable::longRelativeDiffForHumans](../Carbon/CarbonImmutable.md#longrelativediffforhumans) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ |  |
| string | [CarbonImmutable::shortRelativeToNowDiffForHumans](../Carbon/CarbonImmutable.md#shortrelativetonowdiffforhumans) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ |  |
| string | [CarbonImmutable::longRelativeToNowDiffForHumans](../Carbon/CarbonImmutable.md#longrelativetonowdiffforhumans) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ |  |
| string | [CarbonImmutable::shortRelativeToOtherDiffForHumans](../Carbon/CarbonImmutable.md#shortrelativetootherdiffforhumans) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ |  |
| string | [CarbonImmutable::longRelativeToOtherDiffForHumans](../Carbon/CarbonImmutable.md#longrelativetootherdiffforhumans) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ |  |
| int | [CarbonImmutable::centuriesInMillennium](../Carbon/CarbonImmutable.md#centuriesinmillennium) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of centuries contained in the current millennium |
| int|static | [CarbonImmutable::centuryOfMillennium](../Carbon/CarbonImmutable.md#centuryofmillennium) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the century starting from the beginning of the current millennium when called with no parameters, change the current century when called with an integer value |
| int|static | [CarbonImmutable::dayOfCentury](../Carbon/CarbonImmutable.md#dayofcentury) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the day starting from the beginning of the current century when called with no parameters, change the current day when called with an integer value |
| int|static | [CarbonImmutable::dayOfDecade](../Carbon/CarbonImmutable.md#dayofdecade) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the day starting from the beginning of the current decade when called with no parameters, change the current day when called with an integer value |
| int|static | [CarbonImmutable::dayOfMillennium](../Carbon/CarbonImmutable.md#dayofmillennium) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the day starting from the beginning of the current millennium when called with no parameters, change the current day when called with an integer value |
| int|static | [CarbonImmutable::dayOfMonth](../Carbon/CarbonImmutable.md#dayofmonth) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the day starting from the beginning of the current month when called with no parameters, change the current day when called with an integer value |
| int|static | [CarbonImmutable::dayOfQuarter](../Carbon/CarbonImmutable.md#dayofquarter) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the day starting from the beginning of the current quarter when called with no parameters, change the current day when called with an integer value |
| int|static | [CarbonImmutable::dayOfWeek](../Carbon/CarbonImmutable.md#dayofweek) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the day starting from the beginning of the current week when called with no parameters, change the current day when called with an integer value |
| int | [CarbonImmutable::daysInCentury](../Carbon/CarbonImmutable.md#daysincentury) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of days contained in the current century |
| int | [CarbonImmutable::daysInDecade](../Carbon/CarbonImmutable.md#daysindecade) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of days contained in the current decade |
| int | [CarbonImmutable::daysInMillennium](../Carbon/CarbonImmutable.md#daysinmillennium) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of days contained in the current millennium |
| int | [CarbonImmutable::daysInMonth](../Carbon/CarbonImmutable.md#daysinmonth) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of days contained in the current month |
| int | [CarbonImmutable::daysInQuarter](../Carbon/CarbonImmutable.md#daysinquarter) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of days contained in the current quarter |
| int | [CarbonImmutable::daysInWeek](../Carbon/CarbonImmutable.md#daysinweek) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of days contained in the current week |
| int | [CarbonImmutable::daysInYear](../Carbon/CarbonImmutable.md#daysinyear) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of days contained in the current year |
| int|static | [CarbonImmutable::decadeOfCentury](../Carbon/CarbonImmutable.md#decadeofcentury) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the decade starting from the beginning of the current century when called with no parameters, change the current decade when called with an integer value |
| int|static | [CarbonImmutable::decadeOfMillennium](../Carbon/CarbonImmutable.md#decadeofmillennium) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the decade starting from the beginning of the current millennium when called with no parameters, change the current decade when called with an integer value |
| int | [CarbonImmutable::decadesInCentury](../Carbon/CarbonImmutable.md#decadesincentury) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of decades contained in the current century |
| int | [CarbonImmutable::decadesInMillennium](../Carbon/CarbonImmutable.md#decadesinmillennium) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of decades contained in the current millennium |
| int|static | [CarbonImmutable::hourOfCentury](../Carbon/CarbonImmutable.md#hourofcentury) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the hour starting from the beginning of the current century when called with no parameters, change the current hour when called with an integer value |
| int|static | [CarbonImmutable::hourOfDay](../Carbon/CarbonImmutable.md#hourofday) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the hour starting from the beginning of the current day when called with no parameters, change the current hour when called with an integer value |
| int|static | [CarbonImmutable::hourOfDecade](../Carbon/CarbonImmutable.md#hourofdecade) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the hour starting from the beginning of the current decade when called with no parameters, change the current hour when called with an integer value |
| int|static | [CarbonImmutable::hourOfMillennium](../Carbon/CarbonImmutable.md#hourofmillennium) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the hour starting from the beginning of the current millennium when called with no parameters, change the current hour when called with an integer value |
| int|static | [CarbonImmutable::hourOfMonth](../Carbon/CarbonImmutable.md#hourofmonth) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the hour starting from the beginning of the current month when called with no parameters, change the current hour when called with an integer value |
| int|static | [CarbonImmutable::hourOfQuarter](../Carbon/CarbonImmutable.md#hourofquarter) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the hour starting from the beginning of the current quarter when called with no parameters, change the current hour when called with an integer value |
| int|static | [CarbonImmutable::hourOfWeek](../Carbon/CarbonImmutable.md#hourofweek) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the hour starting from the beginning of the current week when called with no parameters, change the current hour when called with an integer value |
| int|static | [CarbonImmutable::hourOfYear](../Carbon/CarbonImmutable.md#hourofyear) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the hour starting from the beginning of the current year when called with no parameters, change the current hour when called with an integer value |
| int | [CarbonImmutable::hoursInCentury](../Carbon/CarbonImmutable.md#hoursincentury) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of hours contained in the current century |
| int | [CarbonImmutable::hoursInDay](../Carbon/CarbonImmutable.md#hoursinday) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of hours contained in the current day |
| int | [CarbonImmutable::hoursInDecade](../Carbon/CarbonImmutable.md#hoursindecade) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of hours contained in the current decade |
| int | [CarbonImmutable::hoursInMillennium](../Carbon/CarbonImmutable.md#hoursinmillennium) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of hours contained in the current millennium |
| int | [CarbonImmutable::hoursInMonth](../Carbon/CarbonImmutable.md#hoursinmonth) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of hours contained in the current month |
| int | [CarbonImmutable::hoursInQuarter](../Carbon/CarbonImmutable.md#hoursinquarter) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of hours contained in the current quarter |
| int | [CarbonImmutable::hoursInWeek](../Carbon/CarbonImmutable.md#hoursinweek) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of hours contained in the current week |
| int | [CarbonImmutable::hoursInYear](../Carbon/CarbonImmutable.md#hoursinyear) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of hours contained in the current year |
| int|static | [CarbonImmutable::microsecondOfCentury](../Carbon/CarbonImmutable.md#microsecondofcentury) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the microsecond starting from the beginning of the current century when called with no parameters, change the current microsecond when called with an integer value |
| int|static | [CarbonImmutable::microsecondOfDay](../Carbon/CarbonImmutable.md#microsecondofday) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the microsecond starting from the beginning of the current day when called with no parameters, change the current microsecond when called with an integer value |
| int|static | [CarbonImmutable::microsecondOfDecade](../Carbon/CarbonImmutable.md#microsecondofdecade) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the microsecond starting from the beginning of the current decade when called with no parameters, change the current microsecond when called with an integer value |
| int|static | [CarbonImmutable::microsecondOfHour](../Carbon/CarbonImmutable.md#microsecondofhour) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the microsecond starting from the beginning of the current hour when called with no parameters, change the current microsecond when called with an integer value |
| int|static | [CarbonImmutable::microsecondOfMillennium](../Carbon/CarbonImmutable.md#microsecondofmillennium) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the microsecond starting from the beginning of the current millennium when called with no parameters, change the current microsecond when called with an integer value |
| int|static | [CarbonImmutable::microsecondOfMillisecond](../Carbon/CarbonImmutable.md#microsecondofmillisecond) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the microsecond starting from the beginning of the current millisecond when called with no parameters, change the current microsecond when called with an integer value |
| int|static | [CarbonImmutable::microsecondOfMinute](../Carbon/CarbonImmutable.md#microsecondofminute) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the microsecond starting from the beginning of the current minute when called with no parameters, change the current microsecond when called with an integer value |
| int|static | [CarbonImmutable::microsecondOfMonth](../Carbon/CarbonImmutable.md#microsecondofmonth) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the microsecond starting from the beginning of the current month when called with no parameters, change the current microsecond when called with an integer value |
| int|static | [CarbonImmutable::microsecondOfQuarter](../Carbon/CarbonImmutable.md#microsecondofquarter) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the microsecond starting from the beginning of the current quarter when called with no parameters, change the current microsecond when called with an integer value |
| int|static | [CarbonImmutable::microsecondOfSecond](../Carbon/CarbonImmutable.md#microsecondofsecond) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the microsecond starting from the beginning of the current second when called with no parameters, change the current microsecond when called with an integer value |
| int|static | [CarbonImmutable::microsecondOfWeek](../Carbon/CarbonImmutable.md#microsecondofweek) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the microsecond starting from the beginning of the current week when called with no parameters, change the current microsecond when called with an integer value |
| int|static | [CarbonImmutable::microsecondOfYear](../Carbon/CarbonImmutable.md#microsecondofyear) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the microsecond starting from the beginning of the current year when called with no parameters, change the current microsecond when called with an integer value |
| int | [CarbonImmutable::microsecondsInCentury](../Carbon/CarbonImmutable.md#microsecondsincentury) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of microseconds contained in the current century |
| int | [CarbonImmutable::microsecondsInDay](../Carbon/CarbonImmutable.md#microsecondsinday) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of microseconds contained in the current day |
| int | [CarbonImmutable::microsecondsInDecade](../Carbon/CarbonImmutable.md#microsecondsindecade) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of microseconds contained in the current decade |
| int | [CarbonImmutable::microsecondsInHour](../Carbon/CarbonImmutable.md#microsecondsinhour) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of microseconds contained in the current hour |
| int | [CarbonImmutable::microsecondsInMillennium](../Carbon/CarbonImmutable.md#microsecondsinmillennium) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of microseconds contained in the current millennium |
| int | [CarbonImmutable::microsecondsInMillisecond](../Carbon/CarbonImmutable.md#microsecondsinmillisecond) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of microseconds contained in the current millisecond |
| int | [CarbonImmutable::microsecondsInMinute](../Carbon/CarbonImmutable.md#microsecondsinminute) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of microseconds contained in the current minute |
| int | [CarbonImmutable::microsecondsInMonth](../Carbon/CarbonImmutable.md#microsecondsinmonth) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of microseconds contained in the current month |
| int | [CarbonImmutable::microsecondsInQuarter](../Carbon/CarbonImmutable.md#microsecondsinquarter) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of microseconds contained in the current quarter |
| int | [CarbonImmutable::microsecondsInSecond](../Carbon/CarbonImmutable.md#microsecondsinsecond) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of microseconds contained in the current second |
| int | [CarbonImmutable::microsecondsInWeek](../Carbon/CarbonImmutable.md#microsecondsinweek) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of microseconds contained in the current week |
| int | [CarbonImmutable::microsecondsInYear](../Carbon/CarbonImmutable.md#microsecondsinyear) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of microseconds contained in the current year |
| int|static | [CarbonImmutable::millisecondOfCentury](../Carbon/CarbonImmutable.md#millisecondofcentury) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the millisecond starting from the beginning of the current century when called with no parameters, change the current millisecond when called with an integer value |
| int|static | [CarbonImmutable::millisecondOfDay](../Carbon/CarbonImmutable.md#millisecondofday) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the millisecond starting from the beginning of the current day when called with no parameters, change the current millisecond when called with an integer value |
| int|static | [CarbonImmutable::millisecondOfDecade](../Carbon/CarbonImmutable.md#millisecondofdecade) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the millisecond starting from the beginning of the current decade when called with no parameters, change the current millisecond when called with an integer value |
| int|static | [CarbonImmutable::millisecondOfHour](../Carbon/CarbonImmutable.md#millisecondofhour) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the millisecond starting from the beginning of the current hour when called with no parameters, change the current millisecond when called with an integer value |
| int|static | [CarbonImmutable::millisecondOfMillennium](../Carbon/CarbonImmutable.md#millisecondofmillennium) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the millisecond starting from the beginning of the current millennium when called with no parameters, change the current millisecond when called with an integer value |
| int|static | [CarbonImmutable::millisecondOfMinute](../Carbon/CarbonImmutable.md#millisecondofminute) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the millisecond starting from the beginning of the current minute when called with no parameters, change the current millisecond when called with an integer value |
| int|static | [CarbonImmutable::millisecondOfMonth](../Carbon/CarbonImmutable.md#millisecondofmonth) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the millisecond starting from the beginning of the current month when called with no parameters, change the current millisecond when called with an integer value |
| int|static | [CarbonImmutable::millisecondOfQuarter](../Carbon/CarbonImmutable.md#millisecondofquarter) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the millisecond starting from the beginning of the current quarter when called with no parameters, change the current millisecond when called with an integer value |
| int|static | [CarbonImmutable::millisecondOfSecond](../Carbon/CarbonImmutable.md#millisecondofsecond) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the millisecond starting from the beginning of the current second when called with no parameters, change the current millisecond when called with an integer value |
| int|static | [CarbonImmutable::millisecondOfWeek](../Carbon/CarbonImmutable.md#millisecondofweek) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the millisecond starting from the beginning of the current week when called with no parameters, change the current millisecond when called with an integer value |
| int|static | [CarbonImmutable::millisecondOfYear](../Carbon/CarbonImmutable.md#millisecondofyear) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the millisecond starting from the beginning of the current year when called with no parameters, change the current millisecond when called with an integer value |
| int | [CarbonImmutable::millisecondsInCentury](../Carbon/CarbonImmutable.md#millisecondsincentury) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of milliseconds contained in the current century |
| int | [CarbonImmutable::millisecondsInDay](../Carbon/CarbonImmutable.md#millisecondsinday) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of milliseconds contained in the current day |
| int | [CarbonImmutable::millisecondsInDecade](../Carbon/CarbonImmutable.md#millisecondsindecade) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of milliseconds contained in the current decade |
| int | [CarbonImmutable::millisecondsInHour](../Carbon/CarbonImmutable.md#millisecondsinhour) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of milliseconds contained in the current hour |
| int | [CarbonImmutable::millisecondsInMillennium](../Carbon/CarbonImmutable.md#millisecondsinmillennium) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of milliseconds contained in the current millennium |
| int | [CarbonImmutable::millisecondsInMinute](../Carbon/CarbonImmutable.md#millisecondsinminute) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of milliseconds contained in the current minute |
| int | [CarbonImmutable::millisecondsInMonth](../Carbon/CarbonImmutable.md#millisecondsinmonth) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of milliseconds contained in the current month |
| int | [CarbonImmutable::millisecondsInQuarter](../Carbon/CarbonImmutable.md#millisecondsinquarter) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of milliseconds contained in the current quarter |
| int | [CarbonImmutable::millisecondsInSecond](../Carbon/CarbonImmutable.md#millisecondsinsecond) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of milliseconds contained in the current second |
| int | [CarbonImmutable::millisecondsInWeek](../Carbon/CarbonImmutable.md#millisecondsinweek) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of milliseconds contained in the current week |
| int | [CarbonImmutable::millisecondsInYear](../Carbon/CarbonImmutable.md#millisecondsinyear) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of milliseconds contained in the current year |
| int|static | [CarbonImmutable::minuteOfCentury](../Carbon/CarbonImmutable.md#minuteofcentury) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the minute starting from the beginning of the current century when called with no parameters, change the current minute when called with an integer value |
| int|static | [CarbonImmutable::minuteOfDay](../Carbon/CarbonImmutable.md#minuteofday) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the minute starting from the beginning of the current day when called with no parameters, change the current minute when called with an integer value |
| int|static | [CarbonImmutable::minuteOfDecade](../Carbon/CarbonImmutable.md#minuteofdecade) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the minute starting from the beginning of the current decade when called with no parameters, change the current minute when called with an integer value |
| int|static | [CarbonImmutable::minuteOfHour](../Carbon/CarbonImmutable.md#minuteofhour) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the minute starting from the beginning of the current hour when called with no parameters, change the current minute when called with an integer value |
| int|static | [CarbonImmutable::minuteOfMillennium](../Carbon/CarbonImmutable.md#minuteofmillennium) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the minute starting from the beginning of the current millennium when called with no parameters, change the current minute when called with an integer value |
| int|static | [CarbonImmutable::minuteOfMonth](../Carbon/CarbonImmutable.md#minuteofmonth) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the minute starting from the beginning of the current month when called with no parameters, change the current minute when called with an integer value |
| int|static | [CarbonImmutable::minuteOfQuarter](../Carbon/CarbonImmutable.md#minuteofquarter) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the minute starting from the beginning of the current quarter when called with no parameters, change the current minute when called with an integer value |
| int|static | [CarbonImmutable::minuteOfWeek](../Carbon/CarbonImmutable.md#minuteofweek) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the minute starting from the beginning of the current week when called with no parameters, change the current minute when called with an integer value |
| int|static | [CarbonImmutable::minuteOfYear](../Carbon/CarbonImmutable.md#minuteofyear) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the minute starting from the beginning of the current year when called with no parameters, change the current minute when called with an integer value |
| int | [CarbonImmutable::minutesInCentury](../Carbon/CarbonImmutable.md#minutesincentury) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of minutes contained in the current century |
| int | [CarbonImmutable::minutesInDay](../Carbon/CarbonImmutable.md#minutesinday) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of minutes contained in the current day |
| int | [CarbonImmutable::minutesInDecade](../Carbon/CarbonImmutable.md#minutesindecade) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of minutes contained in the current decade |
| int | [CarbonImmutable::minutesInHour](../Carbon/CarbonImmutable.md#minutesinhour) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of minutes contained in the current hour |
| int | [CarbonImmutable::minutesInMillennium](../Carbon/CarbonImmutable.md#minutesinmillennium) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of minutes contained in the current millennium |
| int | [CarbonImmutable::minutesInMonth](../Carbon/CarbonImmutable.md#minutesinmonth) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of minutes contained in the current month |
| int | [CarbonImmutable::minutesInQuarter](../Carbon/CarbonImmutable.md#minutesinquarter) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of minutes contained in the current quarter |
| int | [CarbonImmutable::minutesInWeek](../Carbon/CarbonImmutable.md#minutesinweek) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of minutes contained in the current week |
| int | [CarbonImmutable::minutesInYear](../Carbon/CarbonImmutable.md#minutesinyear) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of minutes contained in the current year |
| int|static | [CarbonImmutable::monthOfCentury](../Carbon/CarbonImmutable.md#monthofcentury) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the month starting from the beginning of the current century when called with no parameters, change the current month when called with an integer value |
| int|static | [CarbonImmutable::monthOfDecade](../Carbon/CarbonImmutable.md#monthofdecade) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the month starting from the beginning of the current decade when called with no parameters, change the current month when called with an integer value |
| int|static | [CarbonImmutable::monthOfMillennium](../Carbon/CarbonImmutable.md#monthofmillennium) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the month starting from the beginning of the current millennium when called with no parameters, change the current month when called with an integer value |
| int|static | [CarbonImmutable::monthOfQuarter](../Carbon/CarbonImmutable.md#monthofquarter) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the month starting from the beginning of the current quarter when called with no parameters, change the current month when called with an integer value |
| int|static | [CarbonImmutable::monthOfYear](../Carbon/CarbonImmutable.md#monthofyear) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the month starting from the beginning of the current year when called with no parameters, change the current month when called with an integer value |
| int | [CarbonImmutable::monthsInCentury](../Carbon/CarbonImmutable.md#monthsincentury) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of months contained in the current century |
| int | [CarbonImmutable::monthsInDecade](../Carbon/CarbonImmutable.md#monthsindecade) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of months contained in the current decade |
| int | [CarbonImmutable::monthsInMillennium](../Carbon/CarbonImmutable.md#monthsinmillennium) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of months contained in the current millennium |
| int | [CarbonImmutable::monthsInQuarter](../Carbon/CarbonImmutable.md#monthsinquarter) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of months contained in the current quarter |
| int | [CarbonImmutable::monthsInYear](../Carbon/CarbonImmutable.md#monthsinyear) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of months contained in the current year |
| int|static | [CarbonImmutable::quarterOfCentury](../Carbon/CarbonImmutable.md#quarterofcentury) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the quarter starting from the beginning of the current century when called with no parameters, change the current quarter when called with an integer value |
| int|static | [CarbonImmutable::quarterOfDecade](../Carbon/CarbonImmutable.md#quarterofdecade) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the quarter starting from the beginning of the current decade when called with no parameters, change the current quarter when called with an integer value |
| int|static | [CarbonImmutable::quarterOfMillennium](../Carbon/CarbonImmutable.md#quarterofmillennium) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the quarter starting from the beginning of the current millennium when called with no parameters, change the current quarter when called with an integer value |
| int|static | [CarbonImmutable::quarterOfYear](../Carbon/CarbonImmutable.md#quarterofyear) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the quarter starting from the beginning of the current year when called with no parameters, change the current quarter when called with an integer value |
| int | [CarbonImmutable::quartersInCentury](../Carbon/CarbonImmutable.md#quartersincentury) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of quarters contained in the current century |
| int | [CarbonImmutable::quartersInDecade](../Carbon/CarbonImmutable.md#quartersindecade) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of quarters contained in the current decade |
| int | [CarbonImmutable::quartersInMillennium](../Carbon/CarbonImmutable.md#quartersinmillennium) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of quarters contained in the current millennium |
| int | [CarbonImmutable::quartersInYear](../Carbon/CarbonImmutable.md#quartersinyear) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of quarters contained in the current year |
| int|static | [CarbonImmutable::secondOfCentury](../Carbon/CarbonImmutable.md#secondofcentury) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the second starting from the beginning of the current century when called with no parameters, change the current second when called with an integer value |
| int|static | [CarbonImmutable::secondOfDay](../Carbon/CarbonImmutable.md#secondofday) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the second starting from the beginning of the current day when called with no parameters, change the current second when called with an integer value |
| int|static | [CarbonImmutable::secondOfDecade](../Carbon/CarbonImmutable.md#secondofdecade) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the second starting from the beginning of the current decade when called with no parameters, change the current second when called with an integer value |
| int|static | [CarbonImmutable::secondOfHour](../Carbon/CarbonImmutable.md#secondofhour) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the second starting from the beginning of the current hour when called with no parameters, change the current second when called with an integer value |
| int|static | [CarbonImmutable::secondOfMillennium](../Carbon/CarbonImmutable.md#secondofmillennium) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the second starting from the beginning of the current millennium when called with no parameters, change the current second when called with an integer value |
| int|static | [CarbonImmutable::secondOfMinute](../Carbon/CarbonImmutable.md#secondofminute) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the second starting from the beginning of the current minute when called with no parameters, change the current second when called with an integer value |
| int|static | [CarbonImmutable::secondOfMonth](../Carbon/CarbonImmutable.md#secondofmonth) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the second starting from the beginning of the current month when called with no parameters, change the current second when called with an integer value |
| int|static | [CarbonImmutable::secondOfQuarter](../Carbon/CarbonImmutable.md#secondofquarter) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the second starting from the beginning of the current quarter when called with no parameters, change the current second when called with an integer value |
| int|static | [CarbonImmutable::secondOfWeek](../Carbon/CarbonImmutable.md#secondofweek) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the second starting from the beginning of the current week when called with no parameters, change the current second when called with an integer value |
| int|static | [CarbonImmutable::secondOfYear](../Carbon/CarbonImmutable.md#secondofyear) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the second starting from the beginning of the current year when called with no parameters, change the current second when called with an integer value |
| int | [CarbonImmutable::secondsInCentury](../Carbon/CarbonImmutable.md#secondsincentury) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of seconds contained in the current century |
| int | [CarbonImmutable::secondsInDay](../Carbon/CarbonImmutable.md#secondsinday) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of seconds contained in the current day |
| int | [CarbonImmutable::secondsInDecade](../Carbon/CarbonImmutable.md#secondsindecade) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of seconds contained in the current decade |
| int | [CarbonImmutable::secondsInHour](../Carbon/CarbonImmutable.md#secondsinhour) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of seconds contained in the current hour |
| int | [CarbonImmutable::secondsInMillennium](../Carbon/CarbonImmutable.md#secondsinmillennium) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of seconds contained in the current millennium |
| int | [CarbonImmutable::secondsInMinute](../Carbon/CarbonImmutable.md#secondsinminute) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of seconds contained in the current minute |
| int | [CarbonImmutable::secondsInMonth](../Carbon/CarbonImmutable.md#secondsinmonth) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of seconds contained in the current month |
| int | [CarbonImmutable::secondsInQuarter](../Carbon/CarbonImmutable.md#secondsinquarter) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of seconds contained in the current quarter |
| int | [CarbonImmutable::secondsInWeek](../Carbon/CarbonImmutable.md#secondsinweek) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of seconds contained in the current week |
| int | [CarbonImmutable::secondsInYear](../Carbon/CarbonImmutable.md#secondsinyear) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of seconds contained in the current year |
| int|static | [CarbonImmutable::weekOfCentury](../Carbon/CarbonImmutable.md#weekofcentury) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the week starting from the beginning of the current century when called with no parameters, change the current week when called with an integer value |
| int|static | [CarbonImmutable::weekOfDecade](../Carbon/CarbonImmutable.md#weekofdecade) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the week starting from the beginning of the current decade when called with no parameters, change the current week when called with an integer value |
| int|static | [CarbonImmutable::weekOfMillennium](../Carbon/CarbonImmutable.md#weekofmillennium) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the week starting from the beginning of the current millennium when called with no parameters, change the current week when called with an integer value |
| int|static | [CarbonImmutable::weekOfMonth](../Carbon/CarbonImmutable.md#weekofmonth) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the week starting from the beginning of the current month when called with no parameters, change the current week when called with an integer value |
| int|static | [CarbonImmutable::weekOfQuarter](../Carbon/CarbonImmutable.md#weekofquarter) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the week starting from the beginning of the current quarter when called with no parameters, change the current week when called with an integer value |
| int|static | [CarbonImmutable::weekOfYear](../Carbon/CarbonImmutable.md#weekofyear) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the week starting from the beginning of the current year when called with no parameters, change the current week when called with an integer value |
| int | [CarbonImmutable::weeksInCentury](../Carbon/CarbonImmutable.md#weeksincentury) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of weeks contained in the current century |
| int | [CarbonImmutable::weeksInDecade](../Carbon/CarbonImmutable.md#weeksindecade) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of weeks contained in the current decade |
| int | [CarbonImmutable::weeksInMillennium](../Carbon/CarbonImmutable.md#weeksinmillennium) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of weeks contained in the current millennium |
| int | [CarbonImmutable::weeksInMonth](../Carbon/CarbonImmutable.md#weeksinmonth) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of weeks contained in the current month |
| int | [CarbonImmutable::weeksInQuarter](../Carbon/CarbonImmutable.md#weeksinquarter) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of weeks contained in the current quarter |
| int|static | [CarbonImmutable::yearOfCentury](../Carbon/CarbonImmutable.md#yearofcentury) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the year starting from the beginning of the current century when called with no parameters, change the current year when called with an integer value |
| int|static | [CarbonImmutable::yearOfDecade](../Carbon/CarbonImmutable.md#yearofdecade) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the year starting from the beginning of the current decade when called with no parameters, change the current year when called with an integer value |
| int|static | [CarbonImmutable::yearOfMillennium](../Carbon/CarbonImmutable.md#yearofmillennium) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the year starting from the beginning of the current millennium when called with no parameters, change the current year when called with an integer value |
| int | [CarbonImmutable::yearsInCentury](../Carbon/CarbonImmutable.md#yearsincentury) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of years contained in the current century |
| int | [CarbonImmutable::yearsInDecade](../Carbon/CarbonImmutable.md#yearsindecade) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of years contained in the current decade |
| int | [CarbonImmutable::yearsInMillennium](../Carbon/CarbonImmutable.md#yearsinmillennium) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of years contained in the current millennium |

---

## Method Details

### createFromFormat

```php
static public Factory\|null createFromFormat($format, $time, $timezone = null)
```

フォーマット指定文字列から日時インスタンスを生成します。

Carbon の `createFromFormat()` はコンストラクタを経由しないため、
JapaneseDate 固有のコンポーネントが未初期化のまま返されることがあります。
このオーバーライドにより、返却されたインスタンスのコンポーネントを確実に初期化します。

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| string | `$format` | —  | 日時フォーマット文字列 |
| string | `$time` | —  | パース対象の日時文字列 |
| [DateTimeZone](https://www.php.net/class.datetimezone)\|string\|int\|null | `$timezone` | `null` | タイムゾーン（省略可） |

**Returns:** Factory\|null
---

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

- DateInvalidTimeZoneException
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

### toArray

```php
public array toArray()
```

**Returns:** array
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

### useSolarAlgorithm

```php
static public void useSolarAlgorithm($algorithm)
```

太陽黄経計算で使用するアルゴリズムを設定する。

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| string | `$algorithm` | —  | 太陽アルゴリズム |

**Returns:** void
**Throws:**

- [InvalidArgumentException](https://www.php.net/class.invalidargumentexception)
---

### solarAlgorithm

```php
static public string solarAlgorithm()
```

現在の太陽黄経計算アルゴリズムを返す。

**Returns:** string — 太陽アルゴリズム
---

### useMoonAlgorithm

```php
static public void useMoonAlgorithm($algorithm)
```

月黄経計算で使用するアルゴリズムを設定する。

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| string | `$algorithm` | —  | 月アルゴリズム |

**Returns:** void
**Throws:**

- [InvalidArgumentException](https://www.php.net/class.invalidargumentexception)
---

### moonAlgorithm

```php
static public string moonAlgorithm()
```

現在の月黄経計算アルゴリズムを返す。

**Returns:** string — 月アルゴリズム
---

