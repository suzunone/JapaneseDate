<?php

/**
 * Getter.php
 *
 * @category    DateTime
 * @package     JapaneseDate
 * @subpackage  Traits
 * @author      Suzunone <suzunone.eleven@gmail.com>
 * @copyright   Suzunone
 * @license     BSD-2
 * @link        https://github.com/suzunone/JapaneseDate
 * @see         https://github.com/suzunone/JapaneseDate
 * @since        1.0.0
 */

namespace JapaneseDate\Traits;

use JapaneseDate\DateTime;
use JapaneseDate\DateTimeImmutable;

/**
 * Trait Getter
 *
 * @category    DateTime
 * @package     JapaneseDate
 * @subpackage  Traits
 * @author      Suzunone <suzunone.eleven@gmail.com>
 * @copyright   Suzunone
 * @license     BSD-2
 * @link        https://github.com/suzunone/JapaneseDate
 * @see         https://github.com/suzunone/JapaneseDate
 * @since        1.0.0
 * @mixin \JapaneseDate\DateTime
 * @mixin \JapaneseDate\DateTimeImmutable
 * @property-read int|bool $solar_term 24節気を取得する。値は、 1 から 24 までの整数、または 24節気でない場合は false になります。
 * @property-read string $solar_term_text 24節気の名前を取得する。値は、 24節気の名前を表す文字列、または 24節気でない場合は空文字列になります。
 * @property-read bool $is_solar_term その日が24節気の一つであるかどうかを示すブール値。値は、 24節気である場合は true、そうでない場合は false になります。
 * @property-read string $era_name_text その日が属する元号の名前を取得する。値は、 元号の名前を表す文字列、または 元号でない場合は空文字列になります。
 * @property-read int $era_name その日が属する元号を整数で取得する。値は、 元号を表す整数、または 元号でない場合は 0 になります。
 * @property-read int $era_year その日が属する元号の年を整数で取得する。値は、 元号の年を表す整数、または 元号でない場合は 0 になります。
 * @property-read string $oriental_zodiac_text その日が属する十二支の名前を取得する。値は、 十二支の名前を表す文字列、または 十二支でない場合は空文字列になります。
 * @property-read int $oriental_zodiac その日が属する十二支を整数で取得する。値は、 十二支を表す整数、または 十二支でない場合は 0 になります。
 * @property-read string $six_weekday_text その日が属する六曜の名前を取得する。値は、 六曜の名前を表す文字列、または 六曜でない場合は空文字列になります。
 * @property-read int $six_weekday その日が属する六曜を整数で取得する。値は、 六曜を表す整数、または 六曜でない場合は 0 になります。
 * @property-read int $weekday_text その日が属する曜日の名前を取得する。値は、 曜日の名前を表す文字列、または 曜日でない場合は空文字列になります。
 * @property-read string $month_text その日が属する月の名前を取得する。値は、 月の名前を表す文字列、または 月でない場合は空文字列になります。
 * @property-read string $holiday_text その日が祝日である場合、祝日の名前を取得する。値は、 祝日の名前を表す文字列、または 祝日でない場合は空文字列になります。
 * @property-read int $holiday その日が祝日である場合、祝日の番号を取得する。値は、 祝日の番号を表す整数、または 祝日でない場合は 0 になります。
 * @property-read bool $is_holiday その日が祝日であるかどうかを示すブール値。値は、 祝日である場合は true、そうでない場合は false になります。
 * @property-read string $lunar_month_text その日が属する陰暦の月の名前を取得する。値は、 陰暦の月の名前を表す文字列、または 陰暦の月でない場合は空文字列になります。
 * @property-read int $lunar_month その日が属する陰暦の月を整数で取得する。値は、 陰暦の月を表す整数、または 陰暦の月でない場合は 0 になります。
 * @property-read int $lunar_year その日が属する陰暦の年を整数で取得する。値は、 陰暦の年を表す整数、または 陰暦の年でない場合は 0 になります。
 * @property-read int $lunar_day その日が属する陰暦の日を整数で取得する。値は、 陰暦の日を表す整数、または 陰暦の日でない場合は 0 になります。
 * @property-read bool $is_leap_month その日が閏月であるかどうかを示すブール値。値は、 閏月である場合は true、そうでない場合は false になります。
 * @property-read float $moon_age その日における月齢を取得する。値は、 月齢を表す浮動小数点数、または 不明な場合は false になります。
 * @property-read DateTime|DateTimeImmutable $syunbun その年の春分の日の日時を取得する。値は、 春分の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。
 * @property-read DateTime|DateTimeImmutable $next_syunbun 次の春分の日の日時を取得する。値は、 次の春分の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が春分の日の場合は翌年の春分の日が返されます。
 * @property-read DateTime|DateTimeImmutable $before_syunbun 前の春分の日の日時を取得する。値は、 前の春分の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が春分の日の場合は前年の春分の日が返されます。
 * @property-read DateTime|DateTimeImmutable $seimei その年の清明の日の日時を取得する。値は、 清明の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。
 * @property-read DateTime|DateTimeImmutable $next_seimei 次の清明の日の日時を取得する。値は、 次の清明の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が清明の日の場合は翌年の清明の日が返されます。
 * @property-read DateTime|DateTimeImmutable $before_seimei 前の清明の日の日時を取得する。値は、 前の清明の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が清明の日の場合は前年の清明の日が返されます。
 * @property-read DateTime|DateTimeImmutable $kokuu その年の穀雨の日の日時を取得する。値は、 穀雨の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。
 * @property-read DateTime|DateTimeImmutable $next_kokuu 次の穀雨の日の日時を取得する。値は、 次の穀雨の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が穀雨の日の場合は翌年の穀雨の日が返されます。
 * @property-read DateTime|DateTimeImmutable $before_kokuu 前の穀雨の日の日時を取得する。値は、 前の穀雨の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が穀雨の日の場合は前年の穀雨の日が返されます。
 * @property-read DateTime|DateTimeImmutable $rikka その年の立夏の日の日時を取得する。値は、 立夏の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。
 * @property-read DateTime|DateTimeImmutable $next_rikka 次の立夏の日の日時を取得する。値は、 次の立夏の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が立夏の日の場合は翌年の立夏の日が返されます。
 * @property-read DateTime|DateTimeImmutable $before_rikka 前の立夏の日の日時を取得する。値は、 前の立夏の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が立夏の日の場合は前年の立夏の日が返されます。
 * @property-read DateTime|DateTimeImmutable $syouman その年の小満の日の日時を取得する。値は、 小満の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。
 * @property-read DateTime|DateTimeImmutable $next_syouman 次の小満の日の日時を取得する。値は、 次の小満の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が小満の日の場合は翌年の小満の日が返されます。
 * @property-read DateTime|DateTimeImmutable $before_syouman 前の小満の日の日時を取得する。値は、 前の小満の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が小満の日の場合は前年の小満の日が返されます。
 * @property-read DateTime|DateTimeImmutable $bousyu その年の芒種の日の日時を取得する。値は、 芒種の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。
 * @property-read DateTime|DateTimeImmutable $next_bousyu 次の芒種の日の日時を取得する。値は、 次の芒種の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が芒種の日の場合は翌年の芒種の日が返されます。
 * @property-read DateTime|DateTimeImmutable $before_bousyu 前の芒種の日の日時を取得する。値は、 前の芒種の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が芒種の日の場合は前年の芒種の日が返されます。
 * @property-read DateTime|DateTimeImmutable $geshi その年の夏至の日の日時を取得する。値は、 夏至の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。
 * @property-read DateTime|DateTimeImmutable $next_geshi 次の夏至の日の日時を取得する。値は、 次の夏至の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が夏至の日の場合は翌年の夏至の日が返されます。
 * @property-read DateTime|DateTimeImmutable $before_geshi 前の夏至の日の日時を取得する。値は、 前の夏至の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が夏至の日の場合は前年の夏至の日が返されます。
 * @property-read DateTime|DateTimeImmutable $syousyo その年の小暑の日の日時を取得する。値は、 小暑の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。
 * @property-read DateTime|DateTimeImmutable $next_syousyo 次の小暑の日の日時を取得する。値は、 次の小暑の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が小暑の日の場合は翌年の小暑の日が返されます。
 * @property-read DateTime|DateTimeImmutable $before_syousyo 前の小暑の日の日時を取得する。値は、 前の小暑の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が小暑の日の場合は前年の小暑の日が返されます。
 * @property-read DateTime|DateTimeImmutable $taisyo その年の大暑の日の日時を取得する。値は、 大暑の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。
 * @property-read DateTime|DateTimeImmutable $next_taisyo 次の大暑の日の日時を取得する。値は、 次の大暑の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が大暑の日の場合は翌年の大暑の日が返されます。o
 * @property-read DateTime|DateTimeImmutable $before_taisyo 前の大暑の日の日時を取得する。値は、 前の大暑の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が大暑の日の場合は前年の大暑の日が返されます。
 * @property-read DateTime|DateTimeImmutable $rissyuu その年の立秋の日の日時を取得する。値は、 立秋の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。
 * @property-read DateTime|DateTimeImmutable $next_rissyuu 次の立秋の日の日時を取得する。値は、 次の立秋の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が立秋の日の場合は翌年の立秋の日が返されます。
 * @property-read DateTime|DateTimeImmutable $before_rissyuu 前の立秋の日の日時を取得する。値は、 前の立秋の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が立秋の日の場合は前年の立秋の日が返されます。
 * @property-read DateTime|DateTimeImmutable $syosyo その年の処暑の日の日時を取得する。値は、 処暑の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。
 * @property-read DateTime|DateTimeImmutable $next_syosyo 次の処暑の日の日時を取得する。値は、 次の処暑の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が処暑の日の場合は翌年の処暑の日が返されます。
 * @property-read DateTime|DateTimeImmutable $before_syosyo 前の処暑の日の日時を取得する。値は、 前の処暑の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が処暑の日の場合は前年の処暑の日が返されます。
 * @property-read DateTime|DateTimeImmutable $hakuro その年の白露の日の日時を取得する。値は、 白露の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。
 * @property-read DateTime|DateTimeImmutable $next_hakuro 次の白露の日の日時を取得する。値は、 次の白露の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が白露の日の場合は翌年の白露の日が返されます。
 * @property-read DateTime|DateTimeImmutable $before_hakuro 前の白露の日の日時を取得する。値は、 前の白露の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が白露の日の場合は前年の白露の日が返されます。
 * @property-read DateTime|DateTimeImmutable $syuubun その年の秋分の日の日時を取得する。値は、 秋分の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。
 * @property-read DateTime|DateTimeImmutable $next_syuubun 次の秋分の日の日時を取得する。値は、 次の秋分の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が秋分の日の場合は翌年の秋分の日が返されます。
 * @property-read DateTime|DateTimeImmutable $before_syuubun 前の秋分の日の日時を取得する。値は、 前の秋分の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が秋分の日の場合は前年の秋分の日が返されます。
 * @property-read DateTime|DateTimeImmutable $kanro その年の寒露の日の日時を取得する。値は、 寒露の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。
 * @property-read DateTime|DateTimeImmutable $next_kanro 次の寒露の日の日時を取得する。値は、 次の寒露の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が寒露の日の場合は翌年の寒露の日が返されます。
 * @property-read DateTime|DateTimeImmutable $before_kanro 前の寒露の日の日時を取得する。値は、 前の寒露の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が寒露の日の場合は前年の寒露の日が返されます。
 * @property-read DateTime|DateTimeImmutable $soukou その年の霜降の日の日時を取得する。値は、 霜降の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。
 * @property-read DateTime|DateTimeImmutable $next_soukou 次の霜降の日の日時を取得する。値は、 次の霜降の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が霜降の日の場合は翌年の霜降の日が返されます。
 * @property-read DateTime|DateTimeImmutable $before_soukou 前の霜降の日の日時を取得する。値は、 前の霜降の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が霜降の日の場合は前年の霜降の日が返されます。
 * @property-read DateTime|DateTimeImmutable $rittou その年の立冬の日の日時を取得する。値は、 立冬の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。
 * @property-read DateTime|DateTimeImmutable $next_rittou 次の立冬の日の日時を取得する。値は、 次の立冬の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が立冬の日の場合は翌年の立冬の日が返されます。
 * @property-read DateTime|DateTimeImmutable $before_rittou 前の立冬の日の日時を取得する。値は、 前の立冬の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が立冬の日の場合は前年の立冬の日が返されます。
 * @property-read DateTime|DateTimeImmutable $syousetsu その年の小雪の日の日時を取得する。値は、 小雪の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。
 * @property-read DateTime|DateTimeImmutable $next_syousetsu 次の小雪の日の日時を取得する。値は、 次の小雪の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が小雪の日の場合は翌年の小雪の日が返されます。
 * @property-read DateTime|DateTimeImmutable $before_syousetsu 前の小雪の日の日時を取得する。値は、 前の小雪の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が小雪の日の場合は前年の小雪の日が返されます。
 * @property-read DateTime|DateTimeImmutable $taisetsu その年の大雪の日の日時を取得する。値は、 大雪の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。
 * @property-read DateTime|DateTimeImmutable $next_taisetsu 次の大雪の日の日時を取得する。値は、 次の大雪の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が大雪の日の場合は翌年の大雪の日が返されます。
 * @property-read DateTime|DateTimeImmutable $before_taisetsu 前の大雪の日の日時を取得する。値は、 前の大雪の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が大雪の日の場合は前年の大雪の日が返されます。
 * @property-read DateTime|DateTimeImmutable $touji その年の冬至の日の日時を取得する。値は、 冬至の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。
 * @property-read DateTime|DateTimeImmutable $next_touji 次の冬至の日の日時を取得する。値は、 次の冬至の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が冬至の日の場合は翌年の冬至の日が返されます。
 * @property-read DateTime|DateTimeImmutable $before_touji 前の冬至の日の日時を取得する。値は、 前の冬至の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が冬至の日の場合は前年の冬至の日が返されます。
 * @property-read DateTime|DateTimeImmutable $syoukan その年の小寒の日の日時を取得する。値は、 小寒の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。
 * @property-read DateTime|DateTimeImmutable $next_syoukan 次の小寒の日の日時を取得する。値は、 次の小寒の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が小寒の日の場合は翌年の小寒の日が返されます。
 * @property-read DateTime|DateTimeImmutable $before_syoukan 前の小寒の日の日時を取得する。値は、 前の小寒の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が小寒の日の場合は前年の小寒の日が返されます。
 * @property-read DateTime|DateTimeImmutable $daikan その年の大寒の日の日時を取得する。値は、 大寒の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。_syoukan
 * @property-read DateTime|DateTimeImmutable $next_daikan 次の大寒の日の日時を取得する。値は、 次の大寒の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が大寒の日の場合は翌年の大寒の日が返されます。
 * @property-read DateTime|DateTimeImmutable $before_daikan 前の大寒の日の日時を取得する。値は、 前の大寒の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が大寒の日の場合は前年の大寒の日が返されます。
 * @property-read DateTime|DateTimeImmutable $rissyun その年の立春の日の日時を取得する。値は、 立春の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。
 * @property-read DateTime|DateTimeImmutable $next_rissyun 次の立春の日の日時を取得する。値は、 次の立春の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が立春の日の場合は翌年の立春の日が返されます。
 * @property-read DateTime|DateTimeImmutable $before_rissyun 前の立春の日の日時を取得する。値は、 前の立春の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が立春の日の場合は前年の立春の日が返されます。
 * @property-read DateTime|DateTimeImmutable $usui その年の雨水の日の日時を取得する。値は、 雨水の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。
 * @property-read DateTime|DateTimeImmutable $next_usui 次の雨水の日の日時を取得する。値は、 次の雨水の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が雨水の日の場合は翌年の雨水の日が返されます。
 * @property-read DateTime|DateTimeImmutable $before_usui 前の雨水の日の日時を取得する。値は、 前の雨水の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が雨水の日の場合は前年の雨水の日が返されます。
 * @property-read DateTime|DateTimeImmutable $keichitsu その年の啓蟄の日の日時を取得する。値は、 啓蟄の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。
 * @property-read DateTime|DateTimeImmutable $next_keichitsu 次の啓蟄の日の日時を取得する。値は、 次の啓蟄の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が啓蟄の日の場合は翌年の啓蟄の日が返されます。
 * @property-read DateTime|DateTimeImmutable $before_keichitsu 前の啓蟄の日の日時を取得する。値は、 前の啓蟄の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が啓蟄の日の場合は前年の啓蟄の日が返されます。
 * @property-read int|bool $solarTerm 24節気を取得する。値は、 1 から 24 までの整数、または 24節気でない場合は false になります。
 * @property-read string $solarTermText 24節気の名前を取得する。値は、 24節気の名前を表す文字列、または 24節気でない場合は空文字列になります。
 * @property-read bool $isSolarTerm その日が24節気の一つであるかどうかを示すブール値。値は、 24節気である場合は true、そうでない場合は false になります。
 * @property-read string $eraNameText その日が属する元号の名前を取得する。値は、 元号の名前を表す文字列、または 元号でない場合は空文字列になります。
 * @property-read int $eraName その日が属する元号を整数で取得する。値は、 元号を表す整数、または 元号でない場合は 0 になります。
 * @property-read int $eraYear その日が属する元号の年を整数で取得する。値は、 元号の年を表す整数、または 元号でない場合は 0 になります。
 * @property-read string $orientalZodiacText その日が属する十二支の名前を取得する。値は、 十二支の名前を表す文字列、または 十二支でない場合は空文字列になります。
 * @property-read int $orientalZodiac その日が属する十二支を整数で取得する。値は、 十二支を表す整数、または 十二支でない場合は 0 になります。
 * @property-read string $sixWeekdayText その日が属する六曜の名前を取得する。値は、 六曜の名前を表す文字列、または 六曜でない場合は空文字列になります。
 * @property-read int $sixWeekday その日が属する六曜を整数で取得する。値は、 六曜を表す整数、または 六曜でない場合は 0 になります。
 * @property-read int $weekdayText その日が属する曜日の名前を取得する。値は、 曜日の名前を表す文字列、または 曜日でない場合は空文字列になります。
 * @property-read string $monthText その日が属する月の名前を取得する。値は、 月の名前を表す文字列、または 月でない場合は空文字列になります。
 * @property-read string $holidayText その日が祝日である場合、祝日の名前を取得する。値は、 祝日の名前を表す文字列、または 祝日でない場合は空文字列になります。
 * @property-read bool $isHoliday その日が祝日であるかどうかを示すブール値。値は、 祝日である場合は true、そうでない場合は false になります。
 * @property-read string $lunarMonthText その日が属する陰暦の月の名前を取得する。値は、 陰暦の月の名前を表す文字列、または 陰暦の月でない場合は空文字列になります。
 * @property-read int $lunarMonth その日が属する陰暦の月を整数で取得する。値は、 陰暦の月を表す整数、または 陰暦の月でない場合は 0 になります。
 * @property-read int $lunarYear その日が属する陰暦の年を整数で取得する。値は、 陰暦の年を表す整数、または 陰暦の年でない場合は 0 になります。
 * @property-read int $lunarDay その日が属する陰暦の日を整数で取得する。値は、 陰暦の日を表す整数、または 陰暦の日でない場合は 0 になります。
 * @property-read bool $isLeapMonth その日が閏月であるかどうかを示すブール値。値は、 閏月である場合は true、そうでない場合は false になります。
 * @property-read float $moonAge その日における月齢を取得する。値は、 月齢を表す浮動小数点数、または 不明な場合は false になります。
 * @property-read DateTime|DateTimeImmutable $nextSyunbun 次の春分の日の日時を取得する。値は、 次の春分の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が春分の日の場合は翌年の春分の日が返されます。
 * @property-read DateTime|DateTimeImmutable $beforeSyunbun 前の春分の日の日時を取得する。値は、 前の春分の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が春分の日の場合は前年の春分の日が返されます。
 * @property-read DateTime|DateTimeImmutable $nextSeimei 次の清明の日の日時を取得する。値は、 次の清明の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が清明の日の場合は翌年の清明の日が返されます。
 * @property-read DateTime|DateTimeImmutable $beforeSeimei 前の清明の日の日時を取得する。値は、 前の清明の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が清明の日の場合は前年の清明の日が返されます。
 * @property-read DateTime|DateTimeImmutable $nextKokuu 次の穀雨の日の日時を取得する。値は、 次の穀雨の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が穀雨の日の場合は翌年の穀雨の日が返されます。
 * @property-read DateTime|DateTimeImmutable $beforeKokuu 前の穀雨の日の日時を取得する。値は、 前の穀雨の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が穀雨の日の場合は前年の穀雨の日が返されます。
 * @property-read DateTime|DateTimeImmutable $nextRikka 次の立夏の日の日時を取得する。値は、 次の立夏の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が立夏の日の場合は翌年の立夏の日が返されます。
 * @property-read DateTime|DateTimeImmutable $beforeRikka 前の立夏の日の日時を取得する。値は、 前の立夏の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が立夏の日の場合は前年の立夏の日が返されます。
 * @property-read DateTime|DateTimeImmutable $nextSyouman 次の小満の日の日時を取得する。値は、 次の小満の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が小満の日の場合は翌年の小満の日が返されます。
 * @property-read DateTime|DateTimeImmutable $beforeSyouman 前の小満の日の日時を取得する。値は、 前の小満の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が小満の日の場合は前年の小満の日が返されます。
 * @property-read DateTime|DateTimeImmutable $nextBousyu 次の芒種の日の日時を取得する。値は、 次の芒種の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が芒種の日の場合は翌年の芒種の日が返されます。
 * @property-read DateTime|DateTimeImmutable $beforeBousyu 前の芒種の日の日時を取得する。値は、 前の芒種の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が芒種の日の場合は前年の芒種の日が返されます。
 * @property-read DateTime|DateTimeImmutable $nextGeshi 次の夏至の日の日時を取得する。値は、 次の夏至の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が夏至の日の場合は翌年の夏至の日が返されます。
 * @property-read DateTime|DateTimeImmutable $beforeGeshi 前の夏至の日の日時を取得する。値は、 前の夏至の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が夏至の日の場合は前年の夏至の日が返されます。
 * @property-read DateTime|DateTimeImmutable $nextSyousyo 次の小暑の日の日時を取得する。値は、 次の小暑の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が小暑の日の場合は翌年の小暑の日が返されます。
 * @property-read DateTime|DateTimeImmutable $beforeSyousyo 前の小暑の日の日時を取得する。値は、 前の小暑の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が小暑の日の場合は前年の小暑の日が返されます。
 * @property-read DateTime|DateTimeImmutable $nextTaisyo 次の大暑の日の日時を取得する。値は、 次の大暑の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が大暑の日の場合は翌年の大暑の日が返されます。
 * @property-read DateTime|DateTimeImmutable $beforeTaisyo 前の大暑の日の日時を取得する。値は、 前の大暑の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が大暑の日の場合は前年の大暑の日が返されます。
 * @property-read DateTime|DateTimeImmutable $nextRissyuu 次の立秋の日の日時を取得する。値は、 次の立秋の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が立秋の日の場合は翌年の立秋の日が返されます。
 * @property-read DateTime|DateTimeImmutable $beforeRissyuu 前の立秋の日の日時を取得する。値は、 前の立秋の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が立秋の日の場合は前年の立秋の日が返されます。
 * @property-read DateTime|DateTimeImmutable $nextSyosyo 次の処暑の日の日時を取得する。値は、 次の処暑の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が処暑の日の場合は翌年の処暑の日が返されます。
 * @property-read DateTime|DateTimeImmutable $beforeSyosyo 前の処暑の日の日時を取得する。値は、 前の処暑の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が処暑の日の場合は前年の処暑の日が返されます。
 * @property-read DateTime|DateTimeImmutable $nextHakuro 次の白露の日の日時を取得する。値は、 次の白露の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が白露の日の場合は翌年の白露の日が返されます。
 * @property-read DateTime|DateTimeImmutable $beforeHakuro 前の白露の日の日時を取得する。値は、 前の白露の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が白露の日の場合は前年の白露の日が返されます。
 * @property-read DateTime|DateTimeImmutable $nextSyuubun 次の秋分の日の日時を取得する。値は、 次の秋分の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が秋分の日の場合は翌年の秋分の日が返されます。
 * @property-read DateTime|DateTimeImmutable $beforeSyuubun 前の秋分の日の日時を取得する。値は、 前の秋分の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が秋分の日の場合は前年の秋分の日が返されます。
 * @property-read DateTime|DateTimeImmutable $nextKanro 次の寒露の日の日時を取得する。値は、 次の寒露の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が寒露の日の場合は翌年の寒露の日が返されます。
 * @property-read DateTime|DateTimeImmutable $beforeKanro 前の寒露の日の日時を取得する。値は、 前の寒露の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が寒露の日の場合は前年の寒露の日が返されます。
 * @property-read DateTime|DateTimeImmutable $nextSoukou 次の霜降の日の日時を取得する。値は、 次の霜降の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が霜降の日の場合は翌年の霜降の日が返されます。
 * @property-read DateTime|DateTimeImmutable $beforeSoukou 前の霜降の日の日時を取得する。値は、 前の霜降の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が霜降の日の場合は前年の霜降の日が返されます。
 * @property-read DateTime|DateTimeImmutable $nextRittou 次の立冬の日の日時を取得する。値は、 次の立冬の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が立冬の日の場合は翌年の立冬の日が返されます。
 * @property-read DateTime|DateTimeImmutable $beforeRittou 前の立冬の日の日時を取得する。値は、 前の立冬の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が立冬の日の場合は前年の立冬の日が返されます。
 * @property-read DateTime|DateTimeImmutable $nextSyousetsu 次の小雪の日の日時を取得する。値は、 次の小雪の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が小雪の日の場合は翌年の小雪の日が返されます。
 * @property-read DateTime|DateTimeImmutable $beforeSyousetsu 前の小雪の日の日時を取得する。値は、 前の小雪の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が小雪の日の場合は前年の小雪の日が返されます。
 * @property-read DateTime|DateTimeImmutable $nextTaisetsu 次の大雪の日の日時を取得する。値は、 次の大雪の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が大雪の日の場合は翌年の大雪の日が返されます。
 * @property-read DateTime|DateTimeImmutable $beforeTaisetsu 前の大雪の日の日時を取得する。値は、 前の大雪の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が大雪の日の場合は前年の大雪の日が返されます。
 * @property-read DateTime|DateTimeImmutable $nextTouji 次の冬至の日の日時を取得する。値は、 次の冬至の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が冬至の日の場合は翌年の冬至の日が返されます。
 * @property-read DateTime|DateTimeImmutable $beforeTouji 前の冬至の日の日時を取得する。値は、 前の冬至の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が冬至の日の場合は前年の冬至の日が返されます。
 * @property-read DateTime|DateTimeImmutable $nextSyoukan 次の小寒の日の日時を取得する。値は、 次の小寒の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が小寒の日の場合は翌年の小寒の日が返されます。
 * @property-read DateTime|DateTimeImmutable $beforeSyoukan 前の小寒の日の日時を取得する。値は、 前の小寒の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が小寒の日の場合は前年の小寒の日が返されます。
 * @property-read DateTime|DateTimeImmutable $nextDaikan 次の大寒の日の日時を取得する。値は、 次の大寒の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が大寒の日の場合は翌年の大寒の日が返されます。
 * @property-read DateTime|DateTimeImmutable $beforeDaikan 前の大寒の日の日時を取得する。値は、 前の大寒の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が大寒の日の場合は前年の大寒の日が返されます。
 * @property-read DateTime|DateTimeImmutable $nextRissyun 次の立春の日の日時を取得する。値は、 次の立春の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が立春の日の場合は翌年の立春の日が返されます。
 * @property-read DateTime|DateTimeImmutable $beforeRissyun 前の立春の日の日時を取得する。値は、 前の立春の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が立春の日の場合は前年の立春の日が返されます。
 * @property-read DateTime|DateTimeImmutable $nextUsui 次の雨水の日の日時を取得する。値は、 次の雨水の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が雨水の日の場合は翌年の雨水の日が返されます。
 * @property-read DateTime|DateTimeImmutable $beforeUsui 前の雨水の日の日時を取得する。値は、 前の雨水の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が雨水の日の場合は前年の雨水の日が返されます。
 * @property-read DateTime|DateTimeImmutable $nextKeichitsu 次の啓蟄の日の日時を取得する。値は、 次の啓蟄の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が啓蟄の日の場合は翌年の啓蟄の日が返されます。
 * @property-read DateTime|DateTimeImmutable $beforeKeichitsu 前の啓蟄の日の日時を取得する。値は、 前の啓蟄の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が啓蟄の日の場合は前年の啓蟄の日が返されます。
 */
trait Getter
{
    /**
     * サポートされるカレンダーに変換する
     *
     * サポートされる $calendar の値は、 CAL_GREGORIAN、 CAL_JULIAN、 CAL_JEWISH および CAL_FRENCH です。
     *
     * @access      public
     * @param int $calendar サポートされるカレンダー
     * @return      array カレンダーの情報を含む配列を返します。この配列には、 年、月、日、週、曜日名、月名、"月/日/年" 形式の文字列 などが含まれます。
     */
    public function getCalendar($calendar = CAL_GREGORIAN): array
    {
        return cal_from_jd(unixtojd($this->timestamp), $calendar);
    }

    /**
     * MagicMethod:__get()
     *
     * @link https://carbon.nesbot.com/docs/#api-getters
     * @param string $name
     * @return mixed
     * @throws \JapaneseDate\Exceptions\ErrorException
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JsonException
     * @noinspection PhpMultipleClassDeclarationsInspection
     */
    public function __get($name)
    {
        switch ($name) {
            case 'solar_term_text':
            case 'solarTermText':
                return $this->getSolarTerm();
            case 'solar_term':
            case 'solarTerm':
                return $this->getSolarTermKey();
            case 'is_solar_term':
            case 'isSolarTerm':
                return $this->isSolarTerm();
            case 'syunbun':
                return $this->getSyunbun();
            case 'next_syunbun':
            case 'nextSyunbun':
                return $this->getNextSyunbun();
            case 'before_syunbun':
            case 'beforeSyunbun':
                return $this->getBeforeSyunbun();
            case 'seimei':
                return $this->getSeimei();
            case 'next_seimei':
            case 'nextSeimei':
                return $this->getNextSeimei();
            case 'before_seimei':
            case 'beforeSeimei':
                return $this->getBeforeSeimei();
            case 'kokuu':
                return $this->getKokuu();
            case 'next_kokuu':
            case 'nextKokuu':
                return $this->getNextKokuu();
            case 'before_kokuu':
            case 'beforeKokuu':
                return $this->getBeforeKokuu();
            case 'rikka':
                return $this->getRikka();
            case 'next_rikka':
            case 'nextRikka':
                return $this->getNextRikka();
            case 'before_rikka':
            case 'beforeRikka':
                return $this->getBeforeRikka();
            case 'syouman':
                return $this->getSyouman();
            case 'next_syouman':
            case 'nextSyouman':
                return $this->getNextSyouman();
            case 'before_syouman':
            case 'beforeSyouman':
                return $this->getBeforeSyouman();
            case 'bousyu':
                return $this->getBousyu();
            case 'next_bousyu':
            case 'nextBousyu':
                return $this->getNextBousyu();
            case 'before_bousyu':
            case 'beforeBousyu':
                return $this->getBeforeBousyu();
            case 'geshi':
                return $this->getGeshi();
            case 'next_geshi':
            case 'nextGeshi':
                return $this->getNextGeshi();
            case 'before_geshi':
            case 'beforeGeshi':
                return $this->getBeforeGeshi();
            case 'syousyo':
                return $this->getSyousyo();
            case 'next_syousyo':
            case 'nextSyousyo':
                return $this->getNextSyousyo();
            case 'before_syousyo':
            case 'beforeSyousyo':
                return $this->getBeforeSyousyo();
            case 'taisyo':
                return $this->getTaisyo();
            case 'next_taisyo':
            case 'nextTaisyo':
                return $this->getNextTaisyo();
            case 'before_taisyo':
            case 'beforeTaisyo':
                return $this->getBeforeTaisyo();
            case 'rissyuu':
                return $this->getRissyuu();
            case 'next_rissyuu':
            case 'nextRissyuu':
                return $this->getNextRissyuu();
            case 'before_rissyuu':
            case 'beforeRissyuu':
                return $this->getBeforeRissyuu();
            case 'syosyo':
                return $this->getSyosyo();
            case 'next_syosyo':
            case 'nextSyosyo':
                return $this->getNextSyosyo();
            case 'before_syosyo':
            case 'beforeSyosyo':
                return $this->getBeforeSyosyo();
            case 'hakuro':
                return $this->getHakuro();
            case 'next_hakuro':
            case 'nextHakuro':
                return $this->getNextHakuro();
            case 'before_hakuro':
            case 'beforeHakuro':
                return $this->getBeforeHakuro();
            case 'syuubun':
                return $this->getSyuubun();
            case 'next_syuubun':
            case 'nextSyuubun':
                return $this->getNextSyuubun();
            case 'before_syuubun':
            case 'beforeSyuubun':
                return $this->getBeforeSyuubun();
            case 'kanro':
                return $this->getKanro();
            case 'next_kanro':
            case 'nextKanro':
                return $this->getNextKanro();
            case 'before_kanro':
            case 'beforeKanro':
                return $this->getBeforeKanro();
            case 'soukou':
                return $this->getSoukou();
            case 'next_soukou':
            case 'nextSoukou':
                return $this->getNextSoukou();
            case 'before_soukou':
            case 'beforeSoukou':
                return $this->getBeforeSoukou();
            case 'rittou':
                return $this->getRittou();
            case 'next_rittou':
            case 'nextRittou':
                return $this->getNextRittou();
            case 'before_rittou':
            case 'beforeRittou':
                return $this->getBeforeRittou();
            case 'syousetsu':
                return $this->getSyousetsu();
            case 'next_syousetsu':
            case 'nextSyousetsu':
                return $this->getNextSyousetsu();
            case 'before_syousetsu':
            case 'beforeSyousetsu':
                return $this->getBeforeSyousetsu();
            case 'taisetsu':
                return $this->getTaisetsu();
            case 'next_taisetsu':
            case 'nextTaisetsu':
                return $this->getNextTaisetsu();
            case 'before_taisetsu':
            case 'beforeTaisetsu':
                return $this->getBeforeTaisetsu();
            case 'touji':
                return $this->getTouji();
            case 'next_touji':
            case 'nextTouji':
                return $this->getNextTouji();
            case 'before_touji':
            case 'beforeTouji':
                return $this->getBeforeTouji();
            case 'syoukan':
                return $this->getSyoukan();
            case 'next_syoukan':
            case 'nextSyoukan':
                return $this->getNextSyoukan();
            case 'before_syoukan':
            case 'beforeSyoukan':
                return $this->getBeforeSyoukan();
            case 'daikan':
                return $this->getDaikan();
            case 'next_daikan':
            case 'nextDaikan':
                return $this->getNextDaikan();
            case 'before_daikan':
            case 'beforeDaikan':
                return $this->getBeforeDaikan();
            case 'rissyun':
                return $this->getRissyun();
            case 'next_rissyun':
            case 'nextRissyun':
                return $this->getNextRissyun();
            case 'before_rissyun':
            case 'beforeRissyun':
                return $this->getBeforeRissyun();
            case 'usui':
                return $this->getUsui();
            case 'next_usui':
            case 'nextUsui':
                return $this->getNextUsui();
            case 'before_usui':
            case 'beforeUsui':
                return $this->getBeforeUsui();
            case 'keichitsu':
                return $this->getKeichitsu();
            case 'next_keichitsu':
            case 'nextKeichitsu':
                return $this->getNextKeichitsu();
            case 'before_keichitsu':
            case 'beforeKeichitsu':
                return $this->getBeforeKeichitsu();
            case 'era_name_text':
            case 'eraNameText':
                return $this->viewEraName();
            case 'era_name':
            case 'eraName':
                return $this->getEraName();
            case 'era_year':
            case 'eraYear':
                return $this->getEraYear();
            case 'oriental_zodiac_text':
            case 'orientalZodiacText':
                return $this->viewOrientalZodiac();
            case 'oriental_zodiac':
            case 'orientalZodiac':
                return $this->getOrientalZodiac();
            case 'six_weekday_text':
            case 'sixWeekdayText':
                return $this->viewSixWeekday();
            case 'six_weekday':
            case 'sixWeekday':
                return $this->getSixWeekday();
            case 'weekday_text':
            case 'weekdayText':
                return $this->viewWeekday();
            case 'month_text':
            case 'monthText':
                return $this->viewMonth();
            case 'holiday_text':
            case 'holidayText':
                return $this->viewHoliday();
            case 'holiday':
                return $this->getHoliday();
            case 'is_holiday':
            case 'isHoliday':
                return $this->getHoliday() !== self::NO_HOLIDAY;
            case 'lunar_month_text':
            case 'lunarMonthText':
                return $this->viewLunarMonth();
            case 'lunar_month':
            case 'lunarMonth':
                return $this->getLunarMonth();
            case 'lunar_year':
            case 'lunarYear':
                return $this->getLunarYear();
            case 'lunar_day':
            case 'lunarDay':
                return $this->getLunarDay();
            case 'is_leap_month':
            case 'isLeapMonth':
                return $this->isLeapMonth();
            case 'moon_age':
            case 'moonAge':
                return $this->getMoonAge();
            default:
                return parent::__get($name);
        }
        // @codeCoverageIgnoreStart
    }
    // @codeCoverageIgnoreEnd
}
