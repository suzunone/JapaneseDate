# Getter

**Namespace:** `JapaneseDate\Traits`

trait **Getter**

Trait Getter

## Properties

| Modifier | Type | Name | Description |
|---|---|---|---|
| public _(read-only)_ | int|bool | `$solar_term` | 24節気を取得する。値は、 1 から 24 までの整数、または 24節気でない場合は false になります。 |
| public _(read-only)_ | string | `$solar_term_text` | 24節気の名前を取得する。値は、 24節気の名前を表す文字列、または 24節気でない場合は空文字列になります。 |
| public _(read-only)_ | bool | `$is_solar_term` | その日が24節気の一つであるかどうかを示すブール値。値は、 24節気である場合は true、そうでない場合は false になります。 |
| public _(read-only)_ | string | `$era_name_text` | その日が属する元号の名前を取得する。値は、 元号の名前を表す文字列、または 元号でない場合は空文字列になります。 |
| public _(read-only)_ | int | `$era_name` | その日が属する元号を整数で取得する。値は、 元号を表す整数、または 元号でない場合は 0 になります。 |
| public _(read-only)_ | int | `$era_year` | その日が属する元号の年を整数で取得する。値は、 元号の年を表す整数、または 元号でない場合は 0 になります。 |
| public _(read-only)_ | string | `$oriental_zodiac_text` | その日が属する十二支の名前を取得する。値は、 十二支の名前を表す文字列、または 十二支でない場合は空文字列になります。 |
| public _(read-only)_ | int | `$oriental_zodiac` | その日が属する十二支を整数で取得する。値は、 十二支を表す整数、または 十二支でない場合は 0 になります。 |
| public _(read-only)_ | string | `$six_weekday_text` | その日が属する六曜の名前を取得する。値は、 六曜の名前を表す文字列、または 六曜でない場合は空文字列になります。 |
| public _(read-only)_ | int | `$six_weekday` | その日が属する六曜を整数で取得する。値は、 六曜を表す整数、または 六曜でない場合は 0 になります。 |
| public _(read-only)_ | int | `$weekday_text` | その日が属する曜日の名前を取得する。値は、 曜日の名前を表す文字列、または 曜日でない場合は空文字列になります。 |
| public _(read-only)_ | string | `$month_text` | その日が属する月の名前を取得する。値は、 月の名前を表す文字列、または 月でない場合は空文字列になります。 |
| public _(read-only)_ | string | `$holiday_text` | その日が祝日である場合、祝日の名前を取得する。値は、 祝日の名前を表す文字列、または 祝日でない場合は空文字列になります。 |
| public _(read-only)_ | int | `$holiday` | その日が祝日である場合、祝日の番号を取得する。値は、 祝日の番号を表す整数、または 祝日でない場合は 0 になります。 |
| public _(read-only)_ | bool | `$is_holiday` | その日が祝日であるかどうかを示すブール値。値は、 祝日である場合は true、そうでない場合は false になります。 |
| public _(read-only)_ | string | `$lunar_month_text` | その日が属する陰暦の月の名前を取得する。値は、 陰暦の月の名前を表す文字列、または 陰暦の月でない場合は空文字列になります。 |
| public _(read-only)_ | int | `$lunar_month` | その日が属する陰暦の月を整数で取得する。値は、 陰暦の月を表す整数、または 陰暦の月でない場合は 0 になります。 |
| public _(read-only)_ | int | `$lunar_year` | その日が属する陰暦の年を整数で取得する。値は、 陰暦の年を表す整数、または 陰暦の年でない場合は 0 になります。 |
| public _(read-only)_ | int | `$lunar_day` | その日が属する陰暦の日を整数で取得する。値は、 陰暦の日を表す整数、または 陰暦の日でない場合は 0 になります。 |
| public _(read-only)_ | bool | `$is_leap_month` | その日が閏月であるかどうかを示すブール値。値は、 閏月である場合は true、そうでない場合は false になります。 |
| public _(read-only)_ | float | `$moon_age` | その日における月齢を取得する。値は、 月齢を表す浮動小数点数、または 不明な場合は false になります。 |
| public _(read-only)_ | [DateTime](../../JapaneseDate/DateTime.md)|[DateTimeImmutable](../../JapaneseDate/DateTimeImmutable.md) | `$syunbun` | その年の春分の日の日時を取得する。値は、 春分の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。 |
| public _(read-only)_ | [DateTime](../../JapaneseDate/DateTime.md)|[DateTimeImmutable](../../JapaneseDate/DateTimeImmutable.md) | `$next_syunbun` | 次の春分の日の日時を取得する。値は、 次の春分の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が春分の日の場合は翌年の春分の日が返されます。 |
| public _(read-only)_ | [DateTime](../../JapaneseDate/DateTime.md)|[DateTimeImmutable](../../JapaneseDate/DateTimeImmutable.md) | `$before_syunbun` | 前の春分の日の日時を取得する。値は、 前の春分の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が春分の日の場合は前年の春分の日が返されます。 |
| public _(read-only)_ | [DateTime](../../JapaneseDate/DateTime.md)|[DateTimeImmutable](../../JapaneseDate/DateTimeImmutable.md) | `$seimei` | その年の清明の日の日時を取得する。値は、 清明の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。 |
| public _(read-only)_ | [DateTime](../../JapaneseDate/DateTime.md)|[DateTimeImmutable](../../JapaneseDate/DateTimeImmutable.md) | `$next_seimei` | 次の清明の日の日時を取得する。値は、 次の清明の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が清明の日の場合は翌年の清明の日が返されます。 |
| public _(read-only)_ | [DateTime](../../JapaneseDate/DateTime.md)|[DateTimeImmutable](../../JapaneseDate/DateTimeImmutable.md) | `$before_seimei` | 前の清明の日の日時を取得する。値は、 前の清明の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が清明の日の場合は前年の清明の日が返されます。 |
| public _(read-only)_ | [DateTime](../../JapaneseDate/DateTime.md)|[DateTimeImmutable](../../JapaneseDate/DateTimeImmutable.md) | `$kokuu` | その年の穀雨の日の日時を取得する。値は、 穀雨の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。 |
| public _(read-only)_ | [DateTime](../../JapaneseDate/DateTime.md)|[DateTimeImmutable](../../JapaneseDate/DateTimeImmutable.md) | `$next_kokuu` | 次の穀雨の日の日時を取得する。値は、 次の穀雨の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が穀雨の日の場合は翌年の穀雨の日が返されます。 |
| public _(read-only)_ | [DateTime](../../JapaneseDate/DateTime.md)|[DateTimeImmutable](../../JapaneseDate/DateTimeImmutable.md) | `$before_kokuu` | 前の穀雨の日の日時を取得する。値は、 前の穀雨の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が穀雨の日の場合は前年の穀雨の日が返されます。 |
| public _(read-only)_ | [DateTime](../../JapaneseDate/DateTime.md)|[DateTimeImmutable](../../JapaneseDate/DateTimeImmutable.md) | `$rikka` | その年の立夏の日の日時を取得する。値は、 立夏の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。 |
| public _(read-only)_ | [DateTime](../../JapaneseDate/DateTime.md)|[DateTimeImmutable](../../JapaneseDate/DateTimeImmutable.md) | `$next_rikka` | 次の立夏の日の日時を取得する。値は、 次の立夏の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が立夏の日の場合は翌年の立夏の日が返されます。 |
| public _(read-only)_ | [DateTime](../../JapaneseDate/DateTime.md)|[DateTimeImmutable](../../JapaneseDate/DateTimeImmutable.md) | `$before_rikka` | 前の立夏の日の日時を取得する。値は、 前の立夏の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が立夏の日の場合は前年の立夏の日が返されます。 |
| public _(read-only)_ | [DateTime](../../JapaneseDate/DateTime.md)|[DateTimeImmutable](../../JapaneseDate/DateTimeImmutable.md) | `$syouman` | その年の小満の日の日時を取得する。値は、 小満の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。 |
| public _(read-only)_ | [DateTime](../../JapaneseDate/DateTime.md)|[DateTimeImmutable](../../JapaneseDate/DateTimeImmutable.md) | `$next_syouman` | 次の小満の日の日時を取得する。値は、 次の小満の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が小満の日の場合は翌年の小満の日が返されます。 |
| public _(read-only)_ | [DateTime](../../JapaneseDate/DateTime.md)|[DateTimeImmutable](../../JapaneseDate/DateTimeImmutable.md) | `$before_syouman` | 前の小満の日の日時を取得する。値は、 前の小満の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が小満の日の場合は前年の小満の日が返されます。 |
| public _(read-only)_ | [DateTime](../../JapaneseDate/DateTime.md)|[DateTimeImmutable](../../JapaneseDate/DateTimeImmutable.md) | `$bousyu` | その年の芒種の日の日時を取得する。値は、 芒種の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。 |
| public _(read-only)_ | [DateTime](../../JapaneseDate/DateTime.md)|[DateTimeImmutable](../../JapaneseDate/DateTimeImmutable.md) | `$next_bousyu` | 次の芒種の日の日時を取得する。値は、 次の芒種の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が芒種の日の場合は翌年の芒種の日が返されます。 |
| public _(read-only)_ | [DateTime](../../JapaneseDate/DateTime.md)|[DateTimeImmutable](../../JapaneseDate/DateTimeImmutable.md) | `$before_bousyu` | 前の芒種の日の日時を取得する。値は、 前の芒種の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が芒種の日の場合は前年の芒種の日が返されます。 |
| public _(read-only)_ | [DateTime](../../JapaneseDate/DateTime.md)|[DateTimeImmutable](../../JapaneseDate/DateTimeImmutable.md) | `$geshi` | その年の夏至の日の日時を取得する。値は、 夏至の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。 |
| public _(read-only)_ | [DateTime](../../JapaneseDate/DateTime.md)|[DateTimeImmutable](../../JapaneseDate/DateTimeImmutable.md) | `$next_geshi` | 次の夏至の日の日時を取得する。値は、 次の夏至の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が夏至の日の場合は翌年の夏至の日が返されます。 |
| public _(read-only)_ | [DateTime](../../JapaneseDate/DateTime.md)|[DateTimeImmutable](../../JapaneseDate/DateTimeImmutable.md) | `$before_geshi` | 前の夏至の日の日時を取得する。値は、 前の夏至の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が夏至の日の場合は前年の夏至の日が返されます。 |
| public _(read-only)_ | [DateTime](../../JapaneseDate/DateTime.md)|[DateTimeImmutable](../../JapaneseDate/DateTimeImmutable.md) | `$syousyo` | その年の小暑の日の日時を取得する。値は、 小暑の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。 |
| public _(read-only)_ | [DateTime](../../JapaneseDate/DateTime.md)|[DateTimeImmutable](../../JapaneseDate/DateTimeImmutable.md) | `$next_syousyo` | 次の小暑の日の日時を取得する。値は、 次の小暑の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が小暑の日の場合は翌年の小暑の日が返されます。 |
| public _(read-only)_ | [DateTime](../../JapaneseDate/DateTime.md)|[DateTimeImmutable](../../JapaneseDate/DateTimeImmutable.md) | `$before_syousyo` | 前の小暑の日の日時を取得する。値は、 前の小暑の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が小暑の日の場合は前年の小暑の日が返されます。 |
| public _(read-only)_ | [DateTime](../../JapaneseDate/DateTime.md)|[DateTimeImmutable](../../JapaneseDate/DateTimeImmutable.md) | `$taisyo` | その年の大暑の日の日時を取得する。値は、 大暑の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。 |
| public _(read-only)_ | [DateTime](../../JapaneseDate/DateTime.md)|[DateTimeImmutable](../../JapaneseDate/DateTimeImmutable.md) | `$next_taisyo` | 次の大暑の日の日時を取得する。値は、 次の大暑の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が大暑の日の場合は翌年の大暑の日が返されます。o |
| public _(read-only)_ | [DateTime](../../JapaneseDate/DateTime.md)|[DateTimeImmutable](../../JapaneseDate/DateTimeImmutable.md) | `$before_taisyo` | 前の大暑の日の日時を取得する。値は、 前の大暑の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が大暑の日の場合は前年の大暑の日が返されます。 |
| public _(read-only)_ | [DateTime](../../JapaneseDate/DateTime.md)|[DateTimeImmutable](../../JapaneseDate/DateTimeImmutable.md) | `$rissyuu` | その年の立秋の日の日時を取得する。値は、 立秋の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。 |
| public _(read-only)_ | [DateTime](../../JapaneseDate/DateTime.md)|[DateTimeImmutable](../../JapaneseDate/DateTimeImmutable.md) | `$next_rissyuu` | 次の立秋の日の日時を取得する。値は、 次の立秋の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が立秋の日の場合は翌年の立秋の日が返されます。 |
| public _(read-only)_ | [DateTime](../../JapaneseDate/DateTime.md)|[DateTimeImmutable](../../JapaneseDate/DateTimeImmutable.md) | `$before_rissyuu` | 前の立秋の日の日時を取得する。値は、 前の立秋の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が立秋の日の場合は前年の立秋の日が返されます。 |
| public _(read-only)_ | [DateTime](../../JapaneseDate/DateTime.md)|[DateTimeImmutable](../../JapaneseDate/DateTimeImmutable.md) | `$syosyo` | その年の処暑の日の日時を取得する。値は、 処暑の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。 |
| public _(read-only)_ | [DateTime](../../JapaneseDate/DateTime.md)|[DateTimeImmutable](../../JapaneseDate/DateTimeImmutable.md) | `$next_syosyo` | 次の処暑の日の日時を取得する。値は、 次の処暑の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が処暑の日の場合は翌年の処暑の日が返されます。 |
| public _(read-only)_ | [DateTime](../../JapaneseDate/DateTime.md)|[DateTimeImmutable](../../JapaneseDate/DateTimeImmutable.md) | `$before_syosyo` | 前の処暑の日の日時を取得する。値は、 前の処暑の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が処暑の日の場合は前年の処暑の日が返されます。 |
| public _(read-only)_ | [DateTime](../../JapaneseDate/DateTime.md)|[DateTimeImmutable](../../JapaneseDate/DateTimeImmutable.md) | `$hakuro` | その年の白露の日の日時を取得する。値は、 白露の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。 |
| public _(read-only)_ | [DateTime](../../JapaneseDate/DateTime.md)|[DateTimeImmutable](../../JapaneseDate/DateTimeImmutable.md) | `$next_hakuro` | 次の白露の日の日時を取得する。値は、 次の白露の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が白露の日の場合は翌年の白露の日が返されます。 |
| public _(read-only)_ | [DateTime](../../JapaneseDate/DateTime.md)|[DateTimeImmutable](../../JapaneseDate/DateTimeImmutable.md) | `$before_hakuro` | 前の白露の日の日時を取得する。値は、 前の白露の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が白露の日の場合は前年の白露の日が返されます。 |
| public _(read-only)_ | [DateTime](../../JapaneseDate/DateTime.md)|[DateTimeImmutable](../../JapaneseDate/DateTimeImmutable.md) | `$syuubun` | その年の秋分の日の日時を取得する。値は、 秋分の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。 |
| public _(read-only)_ | [DateTime](../../JapaneseDate/DateTime.md)|[DateTimeImmutable](../../JapaneseDate/DateTimeImmutable.md) | `$next_syuubun` | 次の秋分の日の日時を取得する。値は、 次の秋分の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が秋分の日の場合は翌年の秋分の日が返されます。 |
| public _(read-only)_ | [DateTime](../../JapaneseDate/DateTime.md)|[DateTimeImmutable](../../JapaneseDate/DateTimeImmutable.md) | `$before_syuubun` | 前の秋分の日の日時を取得する。値は、 前の秋分の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が秋分の日の場合は前年の秋分の日が返されます。 |
| public _(read-only)_ | [DateTime](../../JapaneseDate/DateTime.md)|[DateTimeImmutable](../../JapaneseDate/DateTimeImmutable.md) | `$kanro` | その年の寒露の日の日時を取得する。値は、 寒露の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。 |
| public _(read-only)_ | [DateTime](../../JapaneseDate/DateTime.md)|[DateTimeImmutable](../../JapaneseDate/DateTimeImmutable.md) | `$next_kanro` | 次の寒露の日の日時を取得する。値は、 次の寒露の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が寒露の日の場合は翌年の寒露の日が返されます。 |
| public _(read-only)_ | [DateTime](../../JapaneseDate/DateTime.md)|[DateTimeImmutable](../../JapaneseDate/DateTimeImmutable.md) | `$before_kanro` | 前の寒露の日の日時を取得する。値は、 前の寒露の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が寒露の日の場合は前年の寒露の日が返されます。 |
| public _(read-only)_ | [DateTime](../../JapaneseDate/DateTime.md)|[DateTimeImmutable](../../JapaneseDate/DateTimeImmutable.md) | `$soukou` | その年の霜降の日の日時を取得する。値は、 霜降の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。 |
| public _(read-only)_ | [DateTime](../../JapaneseDate/DateTime.md)|[DateTimeImmutable](../../JapaneseDate/DateTimeImmutable.md) | `$next_soukou` | 次の霜降の日の日時を取得する。値は、 次の霜降の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が霜降の日の場合は翌年の霜降の日が返されます。 |
| public _(read-only)_ | [DateTime](../../JapaneseDate/DateTime.md)|[DateTimeImmutable](../../JapaneseDate/DateTimeImmutable.md) | `$before_soukou` | 前の霜降の日の日時を取得する。値は、 前の霜降の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が霜降の日の場合は前年の霜降の日が返されます。 |
| public _(read-only)_ | [DateTime](../../JapaneseDate/DateTime.md)|[DateTimeImmutable](../../JapaneseDate/DateTimeImmutable.md) | `$rittou` | その年の立冬の日の日時を取得する。値は、 立冬の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。 |
| public _(read-only)_ | [DateTime](../../JapaneseDate/DateTime.md)|[DateTimeImmutable](../../JapaneseDate/DateTimeImmutable.md) | `$next_rittou` | 次の立冬の日の日時を取得する。値は、 次の立冬の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が立冬の日の場合は翌年の立冬の日が返されます。 |
| public _(read-only)_ | [DateTime](../../JapaneseDate/DateTime.md)|[DateTimeImmutable](../../JapaneseDate/DateTimeImmutable.md) | `$before_rittou` | 前の立冬の日の日時を取得する。値は、 前の立冬の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が立冬の日の場合は前年の立冬の日が返されます。 |
| public _(read-only)_ | [DateTime](../../JapaneseDate/DateTime.md)|[DateTimeImmutable](../../JapaneseDate/DateTimeImmutable.md) | `$syousetsu` | その年の小雪の日の日時を取得する。値は、 小雪の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。 |
| public _(read-only)_ | [DateTime](../../JapaneseDate/DateTime.md)|[DateTimeImmutable](../../JapaneseDate/DateTimeImmutable.md) | `$next_syousetsu` | 次の小雪の日の日時を取得する。値は、 次の小雪の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が小雪の日の場合は翌年の小雪の日が返されます。 |
| public _(read-only)_ | [DateTime](../../JapaneseDate/DateTime.md)|[DateTimeImmutable](../../JapaneseDate/DateTimeImmutable.md) | `$before_syousetsu` | 前の小雪の日の日時を取得する。値は、 前の小雪の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が小雪の日の場合は前年の小雪の日が返されます。 |
| public _(read-only)_ | [DateTime](../../JapaneseDate/DateTime.md)|[DateTimeImmutable](../../JapaneseDate/DateTimeImmutable.md) | `$taisetsu` | その年の大雪の日の日時を取得する。値は、 大雪の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。 |
| public _(read-only)_ | [DateTime](../../JapaneseDate/DateTime.md)|[DateTimeImmutable](../../JapaneseDate/DateTimeImmutable.md) | `$next_taisetsu` | 次の大雪の日の日時を取得する。値は、 次の大雪の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が大雪の日の場合は翌年の大雪の日が返されます。 |
| public _(read-only)_ | [DateTime](../../JapaneseDate/DateTime.md)|[DateTimeImmutable](../../JapaneseDate/DateTimeImmutable.md) | `$before_taisetsu` | 前の大雪の日の日時を取得する。値は、 前の大雪の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が大雪の日の場合は前年の大雪の日が返されます。 |
| public _(read-only)_ | [DateTime](../../JapaneseDate/DateTime.md)|[DateTimeImmutable](../../JapaneseDate/DateTimeImmutable.md) | `$touji` | その年の冬至の日の日時を取得する。値は、 冬至の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。 |
| public _(read-only)_ | [DateTime](../../JapaneseDate/DateTime.md)|[DateTimeImmutable](../../JapaneseDate/DateTimeImmutable.md) | `$next_touji` | 次の冬至の日の日時を取得する。値は、 次の冬至の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が冬至の日の場合は翌年の冬至の日が返されます。 |
| public _(read-only)_ | [DateTime](../../JapaneseDate/DateTime.md)|[DateTimeImmutable](../../JapaneseDate/DateTimeImmutable.md) | `$before_touji` | 前の冬至の日の日時を取得する。値は、 前の冬至の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が冬至の日の場合は前年の冬至の日が返されます。 |
| public _(read-only)_ | [DateTime](../../JapaneseDate/DateTime.md)|[DateTimeImmutable](../../JapaneseDate/DateTimeImmutable.md) | `$syoukan` | その年の小寒の日の日時を取得する。値は、 小寒の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。 |
| public _(read-only)_ | [DateTime](../../JapaneseDate/DateTime.md)|[DateTimeImmutable](../../JapaneseDate/DateTimeImmutable.md) | `$next_syoukan` | 次の小寒の日の日時を取得する。値は、 次の小寒の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が小寒の日の場合は翌年の小寒の日が返されます。 |
| public _(read-only)_ | [DateTime](../../JapaneseDate/DateTime.md)|[DateTimeImmutable](../../JapaneseDate/DateTimeImmutable.md) | `$before_syoukan` | 前の小寒の日の日時を取得する。値は、 前の小寒の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が小寒の日の場合は前年の小寒の日が返されます。 |
| public _(read-only)_ | [DateTime](../../JapaneseDate/DateTime.md)|[DateTimeImmutable](../../JapaneseDate/DateTimeImmutable.md) | `$daikan` | その年の大寒の日の日時を取得する。値は、 大寒の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。_syoukan |
| public _(read-only)_ | [DateTime](../../JapaneseDate/DateTime.md)|[DateTimeImmutable](../../JapaneseDate/DateTimeImmutable.md) | `$next_daikan` | 次の大寒の日の日時を取得する。値は、 次の大寒の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が大寒の日の場合は翌年の大寒の日が返されます。 |
| public _(read-only)_ | [DateTime](../../JapaneseDate/DateTime.md)|[DateTimeImmutable](../../JapaneseDate/DateTimeImmutable.md) | `$before_daikan` | 前の大寒の日の日時を取得する。値は、 前の大寒の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が大寒の日の場合は前年の大寒の日が返されます。 |
| public _(read-only)_ | [DateTime](../../JapaneseDate/DateTime.md)|[DateTimeImmutable](../../JapaneseDate/DateTimeImmutable.md) | `$rissyun` | その年の立春の日の日時を取得する。値は、 立春の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。 |
| public _(read-only)_ | [DateTime](../../JapaneseDate/DateTime.md)|[DateTimeImmutable](../../JapaneseDate/DateTimeImmutable.md) | `$next_rissyun` | 次の立春の日の日時を取得する。値は、 次の立春の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が立春の日の場合は翌年の立春の日が返されます。 |
| public _(read-only)_ | [DateTime](../../JapaneseDate/DateTime.md)|[DateTimeImmutable](../../JapaneseDate/DateTimeImmutable.md) | `$before_rissyun` | 前の立春の日の日時を取得する。値は、 前の立春の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が立春の日の場合は前年の立春の日が返されます。 |
| public _(read-only)_ | [DateTime](../../JapaneseDate/DateTime.md)|[DateTimeImmutable](../../JapaneseDate/DateTimeImmutable.md) | `$usui` | その年の雨水の日の日時を取得する。値は、 雨水の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。 |
| public _(read-only)_ | [DateTime](../../JapaneseDate/DateTime.md)|[DateTimeImmutable](../../JapaneseDate/DateTimeImmutable.md) | `$next_usui` | 次の雨水の日の日時を取得する。値は、 次の雨水の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が雨水の日の場合は翌年の雨水の日が返されます。 |
| public _(read-only)_ | [DateTime](../../JapaneseDate/DateTime.md)|[DateTimeImmutable](../../JapaneseDate/DateTimeImmutable.md) | `$before_usui` | 前の雨水の日の日時を取得する。値は、 前の雨水の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が雨水の日の場合は前年の雨水の日が返されます。 |
| public _(read-only)_ | [DateTime](../../JapaneseDate/DateTime.md)|[DateTimeImmutable](../../JapaneseDate/DateTimeImmutable.md) | `$keichitsu` | その年の啓蟄の日の日時を取得する。値は、 啓蟄の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。 |
| public _(read-only)_ | [DateTime](../../JapaneseDate/DateTime.md)|[DateTimeImmutable](../../JapaneseDate/DateTimeImmutable.md) | `$next_keichitsu` | 次の啓蟄の日の日時を取得する。値は、 次の啓蟄の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が啓蟄の日の場合は翌年の啓蟄の日が返されます。 |
| public _(read-only)_ | [DateTime](../../JapaneseDate/DateTime.md)|[DateTimeImmutable](../../JapaneseDate/DateTimeImmutable.md) | `$before_keichitsu` | 前の啓蟄の日の日時を取得する。値は、 前の啓蟄の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が啓蟄の日の場合は前年の啓蟄の日が返されます。 |
| public _(read-only)_ | int|bool | `$solarTerm` | 24節気を取得する。値は、 1 から 24 までの整数、または 24節気でない場合は false になります。 |
| public _(read-only)_ | string | `$solarTermText` | 24節気の名前を取得する。値は、 24節気の名前を表す文字列、または 24節気でない場合は空文字列になります。 |
| public _(read-only)_ | bool | `$isSolarTerm` | その日が24節気の一つであるかどうかを示すブール値。値は、 24節気である場合は true、そうでない場合は false になります。 |
| public _(read-only)_ | string | `$eraNameText` | その日が属する元号の名前を取得する。値は、 元号の名前を表す文字列、または 元号でない場合は空文字列になります。 |
| public _(read-only)_ | int | `$eraName` | その日が属する元号を整数で取得する。値は、 元号を表す整数、または 元号でない場合は 0 になります。 |
| public _(read-only)_ | int | `$eraYear` | その日が属する元号の年を整数で取得する。値は、 元号の年を表す整数、または 元号でない場合は 0 になります。 |
| public _(read-only)_ | string | `$orientalZodiacText` | その日が属する十二支の名前を取得する。値は、 十二支の名前を表す文字列、または 十二支でない場合は空文字列になります。 |
| public _(read-only)_ | int | `$orientalZodiac` | その日が属する十二支を整数で取得する。値は、 十二支を表す整数、または 十二支でない場合は 0 になります。 |
| public _(read-only)_ | string | `$sixWeekdayText` | その日が属する六曜の名前を取得する。値は、 六曜の名前を表す文字列、または 六曜でない場合は空文字列になります。 |
| public _(read-only)_ | int | `$sixWeekday` | その日が属する六曜を整数で取得する。値は、 六曜を表す整数、または 六曜でない場合は 0 になります。 |
| public _(read-only)_ | int | `$weekdayText` | その日が属する曜日の名前を取得する。値は、 曜日の名前を表す文字列、または 曜日でない場合は空文字列になります。 |
| public _(read-only)_ | string | `$monthText` | その日が属する月の名前を取得する。値は、 月の名前を表す文字列、または 月でない場合は空文字列になります。 |
| public _(read-only)_ | string | `$holidayText` | その日が祝日である場合、祝日の名前を取得する。値は、 祝日の名前を表す文字列、または 祝日でない場合は空文字列になります。 |
| public _(read-only)_ | bool | `$isHoliday` | その日が祝日であるかどうかを示すブール値。値は、 祝日である場合は true、そうでない場合は false になります。 |
| public _(read-only)_ | string | `$lunarMonthText` | その日が属する陰暦の月の名前を取得する。値は、 陰暦の月の名前を表す文字列、または 陰暦の月でない場合は空文字列になります。 |
| public _(read-only)_ | int | `$lunarMonth` | その日が属する陰暦の月を整数で取得する。値は、 陰暦の月を表す整数、または 陰暦の月でない場合は 0 になります。 |
| public _(read-only)_ | int | `$lunarYear` | その日が属する陰暦の年を整数で取得する。値は、 陰暦の年を表す整数、または 陰暦の年でない場合は 0 になります。 |
| public _(read-only)_ | int | `$lunarDay` | その日が属する陰暦の日を整数で取得する。値は、 陰暦の日を表す整数、または 陰暦の日でない場合は 0 になります。 |
| public _(read-only)_ | bool | `$isLeapMonth` | その日が閏月であるかどうかを示すブール値。値は、 閏月である場合は true、そうでない場合は false になります。 |
| public _(read-only)_ | float | `$moonAge` | その日における月齢を取得する。値は、 月齢を表す浮動小数点数、または 不明な場合は false になります。 |
| public _(read-only)_ | [DateTime](../../JapaneseDate/DateTime.md)|[DateTimeImmutable](../../JapaneseDate/DateTimeImmutable.md) | `$nextSyunbun` | 次の春分の日の日時を取得する。値は、 次の春分の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が春分の日の場合は翌年の春分の日が返されます。 |
| public _(read-only)_ | [DateTime](../../JapaneseDate/DateTime.md)|[DateTimeImmutable](../../JapaneseDate/DateTimeImmutable.md) | `$beforeSyunbun` | 前の春分の日の日時を取得する。値は、 前の春分の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が春分の日の場合は前年の春分の日が返されます。 |
| public _(read-only)_ | [DateTime](../../JapaneseDate/DateTime.md)|[DateTimeImmutable](../../JapaneseDate/DateTimeImmutable.md) | `$nextSeimei` | 次の清明の日の日時を取得する。値は、 次の清明の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が清明の日の場合は翌年の清明の日が返されます。 |
| public _(read-only)_ | [DateTime](../../JapaneseDate/DateTime.md)|[DateTimeImmutable](../../JapaneseDate/DateTimeImmutable.md) | `$beforeSeimei` | 前の清明の日の日時を取得する。値は、 前の清明の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が清明の日の場合は前年の清明の日が返されます。 |
| public _(read-only)_ | [DateTime](../../JapaneseDate/DateTime.md)|[DateTimeImmutable](../../JapaneseDate/DateTimeImmutable.md) | `$nextKokuu` | 次の穀雨の日の日時を取得する。値は、 次の穀雨の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が穀雨の日の場合は翌年の穀雨の日が返されます。 |
| public _(read-only)_ | [DateTime](../../JapaneseDate/DateTime.md)|[DateTimeImmutable](../../JapaneseDate/DateTimeImmutable.md) | `$beforeKokuu` | 前の穀雨の日の日時を取得する。値は、 前の穀雨の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が穀雨の日の場合は前年の穀雨の日が返されます。 |
| public _(read-only)_ | [DateTime](../../JapaneseDate/DateTime.md)|[DateTimeImmutable](../../JapaneseDate/DateTimeImmutable.md) | `$nextRikka` | 次の立夏の日の日時を取得する。値は、 次の立夏の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が立夏の日の場合は翌年の立夏の日が返されます。 |
| public _(read-only)_ | [DateTime](../../JapaneseDate/DateTime.md)|[DateTimeImmutable](../../JapaneseDate/DateTimeImmutable.md) | `$beforeRikka` | 前の立夏の日の日時を取得する。値は、 前の立夏の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が立夏の日の場合は前年の立夏の日が返されます。 |
| public _(read-only)_ | [DateTime](../../JapaneseDate/DateTime.md)|[DateTimeImmutable](../../JapaneseDate/DateTimeImmutable.md) | `$nextSyouman` | 次の小満の日の日時を取得する。値は、 次の小満の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が小満の日の場合は翌年の小満の日が返されます。 |
| public _(read-only)_ | [DateTime](../../JapaneseDate/DateTime.md)|[DateTimeImmutable](../../JapaneseDate/DateTimeImmutable.md) | `$beforeSyouman` | 前の小満の日の日時を取得する。値は、 前の小満の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が小満の日の場合は前年の小満の日が返されます。 |
| public _(read-only)_ | [DateTime](../../JapaneseDate/DateTime.md)|[DateTimeImmutable](../../JapaneseDate/DateTimeImmutable.md) | `$nextBousyu` | 次の芒種の日の日時を取得する。値は、 次の芒種の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が芒種の日の場合は翌年の芒種の日が返されます。 |
| public _(read-only)_ | [DateTime](../../JapaneseDate/DateTime.md)|[DateTimeImmutable](../../JapaneseDate/DateTimeImmutable.md) | `$beforeBousyu` | 前の芒種の日の日時を取得する。値は、 前の芒種の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が芒種の日の場合は前年の芒種の日が返されます。 |
| public _(read-only)_ | [DateTime](../../JapaneseDate/DateTime.md)|[DateTimeImmutable](../../JapaneseDate/DateTimeImmutable.md) | `$nextGeshi` | 次の夏至の日の日時を取得する。値は、 次の夏至の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が夏至の日の場合は翌年の夏至の日が返されます。 |
| public _(read-only)_ | [DateTime](../../JapaneseDate/DateTime.md)|[DateTimeImmutable](../../JapaneseDate/DateTimeImmutable.md) | `$beforeGeshi` | 前の夏至の日の日時を取得する。値は、 前の夏至の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が夏至の日の場合は前年の夏至の日が返されます。 |
| public _(read-only)_ | [DateTime](../../JapaneseDate/DateTime.md)|[DateTimeImmutable](../../JapaneseDate/DateTimeImmutable.md) | `$nextSyousyo` | 次の小暑の日の日時を取得する。値は、 次の小暑の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が小暑の日の場合は翌年の小暑の日が返されます。 |
| public _(read-only)_ | [DateTime](../../JapaneseDate/DateTime.md)|[DateTimeImmutable](../../JapaneseDate/DateTimeImmutable.md) | `$beforeSyousyo` | 前の小暑の日の日時を取得する。値は、 前の小暑の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が小暑の日の場合は前年の小暑の日が返されます。 |
| public _(read-only)_ | [DateTime](../../JapaneseDate/DateTime.md)|[DateTimeImmutable](../../JapaneseDate/DateTimeImmutable.md) | `$nextTaisyo` | 次の大暑の日の日時を取得する。値は、 次の大暑の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が大暑の日の場合は翌年の大暑の日が返されます。 |
| public _(read-only)_ | [DateTime](../../JapaneseDate/DateTime.md)|[DateTimeImmutable](../../JapaneseDate/DateTimeImmutable.md) | `$beforeTaisyo` | 前の大暑の日の日時を取得する。値は、 前の大暑の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が大暑の日の場合は前年の大暑の日が返されます。 |
| public _(read-only)_ | [DateTime](../../JapaneseDate/DateTime.md)|[DateTimeImmutable](../../JapaneseDate/DateTimeImmutable.md) | `$nextRissyuu` | 次の立秋の日の日時を取得する。値は、 次の立秋の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が立秋の日の場合は翌年の立秋の日が返されます。 |
| public _(read-only)_ | [DateTime](../../JapaneseDate/DateTime.md)|[DateTimeImmutable](../../JapaneseDate/DateTimeImmutable.md) | `$beforeRissyuu` | 前の立秋の日の日時を取得する。値は、 前の立秋の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が立秋の日の場合は前年の立秋の日が返されます。 |
| public _(read-only)_ | [DateTime](../../JapaneseDate/DateTime.md)|[DateTimeImmutable](../../JapaneseDate/DateTimeImmutable.md) | `$nextSyosyo` | 次の処暑の日の日時を取得する。値は、 次の処暑の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が処暑の日の場合は翌年の処暑の日が返されます。 |
| public _(read-only)_ | [DateTime](../../JapaneseDate/DateTime.md)|[DateTimeImmutable](../../JapaneseDate/DateTimeImmutable.md) | `$beforeSyosyo` | 前の処暑の日の日時を取得する。値は、 前の処暑の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が処暑の日の場合は前年の処暑の日が返されます。 |
| public _(read-only)_ | [DateTime](../../JapaneseDate/DateTime.md)|[DateTimeImmutable](../../JapaneseDate/DateTimeImmutable.md) | `$nextHakuro` | 次の白露の日の日時を取得する。値は、 次の白露の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が白露の日の場合は翌年の白露の日が返されます。 |
| public _(read-only)_ | [DateTime](../../JapaneseDate/DateTime.md)|[DateTimeImmutable](../../JapaneseDate/DateTimeImmutable.md) | `$beforeHakuro` | 前の白露の日の日時を取得する。値は、 前の白露の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が白露の日の場合は前年の白露の日が返されます。 |
| public _(read-only)_ | [DateTime](../../JapaneseDate/DateTime.md)|[DateTimeImmutable](../../JapaneseDate/DateTimeImmutable.md) | `$nextSyuubun` | 次の秋分の日の日時を取得する。値は、 次の秋分の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が秋分の日の場合は翌年の秋分の日が返されます。 |
| public _(read-only)_ | [DateTime](../../JapaneseDate/DateTime.md)|[DateTimeImmutable](../../JapaneseDate/DateTimeImmutable.md) | `$beforeSyuubun` | 前の秋分の日の日時を取得する。値は、 前の秋分の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が秋分の日の場合は前年の秋分の日が返されます。 |
| public _(read-only)_ | [DateTime](../../JapaneseDate/DateTime.md)|[DateTimeImmutable](../../JapaneseDate/DateTimeImmutable.md) | `$nextKanro` | 次の寒露の日の日時を取得する。値は、 次の寒露の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が寒露の日の場合は翌年の寒露の日が返されます。 |
| public _(read-only)_ | [DateTime](../../JapaneseDate/DateTime.md)|[DateTimeImmutable](../../JapaneseDate/DateTimeImmutable.md) | `$beforeKanro` | 前の寒露の日の日時を取得する。値は、 前の寒露の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が寒露の日の場合は前年の寒露の日が返されます。 |
| public _(read-only)_ | [DateTime](../../JapaneseDate/DateTime.md)|[DateTimeImmutable](../../JapaneseDate/DateTimeImmutable.md) | `$nextSoukou` | 次の霜降の日の日時を取得する。値は、 次の霜降の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が霜降の日の場合は翌年の霜降の日が返されます。 |
| public _(read-only)_ | [DateTime](../../JapaneseDate/DateTime.md)|[DateTimeImmutable](../../JapaneseDate/DateTimeImmutable.md) | `$beforeSoukou` | 前の霜降の日の日時を取得する。値は、 前の霜降の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が霜降の日の場合は前年の霜降の日が返されます。 |
| public _(read-only)_ | [DateTime](../../JapaneseDate/DateTime.md)|[DateTimeImmutable](../../JapaneseDate/DateTimeImmutable.md) | `$nextRittou` | 次の立冬の日の日時を取得する。値は、 次の立冬の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が立冬の日の場合は翌年の立冬の日が返されます。 |
| public _(read-only)_ | [DateTime](../../JapaneseDate/DateTime.md)|[DateTimeImmutable](../../JapaneseDate/DateTimeImmutable.md) | `$beforeRittou` | 前の立冬の日の日時を取得する。値は、 前の立冬の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が立冬の日の場合は前年の立冬の日が返されます。 |
| public _(read-only)_ | [DateTime](../../JapaneseDate/DateTime.md)|[DateTimeImmutable](../../JapaneseDate/DateTimeImmutable.md) | `$nextSyousetsu` | 次の小雪の日の日時を取得する。値は、 次の小雪の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が小雪の日の場合は翌年の小雪の日が返されます。 |
| public _(read-only)_ | [DateTime](../../JapaneseDate/DateTime.md)|[DateTimeImmutable](../../JapaneseDate/DateTimeImmutable.md) | `$beforeSyousetsu` | 前の小雪の日の日時を取得する。値は、 前の小雪の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が小雪の日の場合は前年の小雪の日が返されます。 |
| public _(read-only)_ | [DateTime](../../JapaneseDate/DateTime.md)|[DateTimeImmutable](../../JapaneseDate/DateTimeImmutable.md) | `$nextTaisetsu` | 次の大雪の日の日時を取得する。値は、 次の大雪の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が大雪の日の場合は翌年の大雪の日が返されます。 |
| public _(read-only)_ | [DateTime](../../JapaneseDate/DateTime.md)|[DateTimeImmutable](../../JapaneseDate/DateTimeImmutable.md) | `$beforeTaisetsu` | 前の大雪の日の日時を取得する。値は、 前の大雪の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が大雪の日の場合は前年の大雪の日が返されます。 |
| public _(read-only)_ | [DateTime](../../JapaneseDate/DateTime.md)|[DateTimeImmutable](../../JapaneseDate/DateTimeImmutable.md) | `$nextTouji` | 次の冬至の日の日時を取得する。値は、 次の冬至の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が冬至の日の場合は翌年の冬至の日が返されます。 |
| public _(read-only)_ | [DateTime](../../JapaneseDate/DateTime.md)|[DateTimeImmutable](../../JapaneseDate/DateTimeImmutable.md) | `$beforeTouji` | 前の冬至の日の日時を取得する。値は、 前の冬至の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が冬至の日の場合は前年の冬至の日が返されます。 |
| public _(read-only)_ | [DateTime](../../JapaneseDate/DateTime.md)|[DateTimeImmutable](../../JapaneseDate/DateTimeImmutable.md) | `$nextSyoukan` | 次の小寒の日の日時を取得する。値は、 次の小寒の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が小寒の日の場合は翌年の小寒の日が返されます。 |
| public _(read-only)_ | [DateTime](../../JapaneseDate/DateTime.md)|[DateTimeImmutable](../../JapaneseDate/DateTimeImmutable.md) | `$beforeSyoukan` | 前の小寒の日の日時を取得する。値は、 前の小寒の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が小寒の日の場合は前年の小寒の日が返されます。 |
| public _(read-only)_ | [DateTime](../../JapaneseDate/DateTime.md)|[DateTimeImmutable](../../JapaneseDate/DateTimeImmutable.md) | `$nextDaikan` | 次の大寒の日の日時を取得する。値は、 次の大寒の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が大寒の日の場合は翌年の大寒の日が返されます。 |
| public _(read-only)_ | [DateTime](../../JapaneseDate/DateTime.md)|[DateTimeImmutable](../../JapaneseDate/DateTimeImmutable.md) | `$beforeDaikan` | 前の大寒の日の日時を取得する。値は、 前の大寒の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が大寒の日の場合は前年の大寒の日が返されます。 |
| public _(read-only)_ | [DateTime](../../JapaneseDate/DateTime.md)|[DateTimeImmutable](../../JapaneseDate/DateTimeImmutable.md) | `$nextRissyun` | 次の立春の日の日時を取得する。値は、 次の立春の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が立春の日の場合は翌年の立春の日が返されます。 |
| public _(read-only)_ | [DateTime](../../JapaneseDate/DateTime.md)|[DateTimeImmutable](../../JapaneseDate/DateTimeImmutable.md) | `$beforeRissyun` | 前の立春の日の日時を取得する。値は、 前の立春の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が立春の日の場合は前年の立春の日が返されます。 |
| public _(read-only)_ | [DateTime](../../JapaneseDate/DateTime.md)|[DateTimeImmutable](../../JapaneseDate/DateTimeImmutable.md) | `$nextUsui` | 次の雨水の日の日時を取得する。値は、 次の雨水の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が雨水の日の場合は翌年の雨水の日が返されます。 |
| public _(read-only)_ | [DateTime](../../JapaneseDate/DateTime.md)|[DateTimeImmutable](../../JapaneseDate/DateTimeImmutable.md) | `$beforeUsui` | 前の雨水の日の日時を取得する。値は、 前の雨水の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が雨水の日の場合は前年の雨水の日が返されます。 |
| public _(read-only)_ | [DateTime](../../JapaneseDate/DateTime.md)|[DateTimeImmutable](../../JapaneseDate/DateTimeImmutable.md) | `$nextKeichitsu` | 次の啓蟄の日の日時を取得する。値は、 次の啓蟄の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が啓蟄の日の場合は翌年の啓蟄の日が返されます。 |
| public _(read-only)_ | [DateTime](../../JapaneseDate/DateTime.md)|[DateTimeImmutable](../../JapaneseDate/DateTimeImmutable.md) | `$beforeKeichitsu` | 前の啓蟄の日の日時を取得する。値は、 前の啓蟄の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が啓蟄の日の場合は前年の啓蟄の日が返されます。 |

## Methods

| Return | Method | Description |
|---|---|---|
| array | [getCalendar()](#getcalendar) | サポートされるカレンダーに変換する |

---

## Method Details

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

