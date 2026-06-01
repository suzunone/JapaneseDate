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
 * @since        2020-03-11
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
 * @since        2020-03-11
 * @mixin \JapaneseDate\DateTime
 * @mixin \JapaneseDate\DateTimeImmutable
 * @property-read int $solar_seasonal_festival 西暦の月日から五節句IDを取得する（スネークケース）。五節句定数（0〜5）を返す。節句でない場合は 0。
 * @property-read string $solar_seasonal_festival_name 西暦の月日から五節句の式名を取得する（スネークケース）。式名または空文字列。
 * @property-read string $solar_seasonal_festival_alias 西暦の月日から五節句の別名を取得する（スネークケース）。別名または空文字列。
 * @property-read int $lunar_seasonal_festival 旧暦の月日から五節句IDを取得する（スネークケース）。五節句定数（0〜5）を返す。節句でない場合は 0。
 * @property-read string $lunar_seasonal_festival_name 旧暦の月日から五節句の式名を取得する（スネークケース）。式名または空文字列。
 * @property-read string $lunar_seasonal_festival_alias 旧暦の月日から五節句の別名を取得する（スネークケース）。別名または空文字列。
 * @property-read int $misc_seasonal_node 雑節を取得する（スネークケース）。雑節定数（0〜9）を返す。雑節でない場合は 0。
 * @property-read string $misc_seasonal_node_text 雑節の日本語名を取得する（スネークケース）。雑節名または空文字列。
 * @property-read int|bool $solar_term 24節気を取得する。値は、 1 から 24 までの整数、または 24節気でない場合は false になります。
 * @property-read string $solar_term_text 24節気の名前を取得する。値は、 24節気の名前を表す文字列、または 24節気でない場合は空文字列になります。
 * @property-read bool $is_solar_term その日が24節気の一つであるかどうかを示すブール値。値は、 24節気である場合は true、そうでない場合は false になります。
 * @property-read string $era_name_text その日が属する元号の名前を取得する。値は、 元号の名前を表す文字列、または 元号でない場合は空文字列になります。
 * @property-read int $era_name その日が属する元号を整数で取得する。値は、 元号を表す整数、または 元号でない場合は 0 になります。
 * @property-read int $era_year その日が属する元号の年を整数で取得する。値は、 元号の年を表す整数、または 元号でない場合は 0 になります。
 * @property-read string $oriental_zodiac_text その日が属する十二支の名前を取得する。値は、 十二支の名前を表す文字列、または 十二支でない場合は空文字列になります。
 * @property-read int $oriental_zodiac その日が属する十二支を整数で取得する。値は、 十二支を表す整数、または 十二支でない場合は 0 になります。
 * @property-read string $heavenly_stem_text その日が属する十干の名前を取得する。値は、 十干の名前を表す文字列です。
 * @property-read int $heavenly_stem その日が属する十干を整数で取得する。値は、 十干を表す整数 (0〜9) です。
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
 * @property-read float $moon_phase_angle その日における月の位相角を取得する。値は 0°(新月)〜359.9° の浮動小数点数です。
 * @property-read int $moon_phase その日における月相を取得する。値は 0(新月)〜7(有明) の整数です。
 * @property-read string $moon_phase_text その日における月相名を日本語で取得する。値は「新月」「三日月」「上弦」「十三夜」「満月」「十六夜」「下弦」「有明」のいずれかです。
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
 * @property-read int $solarSeasonalFestival 西暦の月日から五節句IDを取得する。値は {@see \JapaneseDate\DateTime::SEASONAL_FESTIVAL_NONE}（0）〜{@see \JapaneseDate\DateTime::SEASONAL_FESTIVAL_CHOYO}（5）のいずれかです。節句でない場合は 0 を返します。
 * @property-read string $solarSeasonalFestivalName 西暦の月日から五節句の式名を取得する。「人日の節句」「上巳の節句」「端午の節句」「七夕の節句」「重陽の節句」のいずれか、または節句でない場合は空文字列を返します。
 * @property-read string $solarSeasonalFestivalAlias 西暦の月日から五節句の別名を取得する。「七草の節句」「桃の節句」「菖蒲の節句」「笹の節句」「菊の節句」のいずれか、または節句でない場合は空文字列を返します。
 * @property-read int $lunarSeasonalFestival 旧暦の月日から五節句IDを取得する。値は {@see \JapaneseDate\DateTime::SEASONAL_FESTIVAL_NONE}（0）〜{@see \JapaneseDate\DateTime::SEASONAL_FESTIVAL_CHOYO}（5）のいずれかです。節句でない場合は 0 を返します。
 * @property-read string $lunarSeasonalFestivalName 旧暦の月日から五節句の式名を取得する。「人日の節句」「上巳の節句」「端午の節句」「七夕の節句」「重陽の節句」のいずれか、または節句でない場合は空文字列を返します。
 * @property-read string $lunarSeasonalFestivalAlias 旧暦の月日から五節句の別名を取得する。「七草の節句」「桃の節句」「菖蒲の節句」「笹の節句」「菊の節句」のいずれか、または節句でない場合は空文字列を返します。
 * @property-read int $miscSeasonalNode その日が該当する雑節の定数を取得する。値は {@see \JapaneseDate\DateTime::MISC_SEASONAL_NODE_NONE}（0）〜{@see \JapaneseDate\DateTime::MISC_SEASONAL_NODE_NIHYAKUNIJUUNICHI}（9）のいずれかです。雑節でない場合は 0 を返します。
 * @property-read string $miscSeasonalNodeText その日が該当する雑節の日本語名を取得する。「節分」「彼岸」「社日」「八十八夜」「入梅」「半夏生」「土用」「二百十日」「二百二十日」のいずれか、または雑節でない場合は空文字列を返します。
 * @property-read int|bool $solarTerm 24節気を取得する。値は、 1 から 24 までの整数、または 24節気でない場合は false になります。
 * @property-read string $solarTermText 24節気の名前を取得する。値は、 24節気の名前を表す文字列、または 24節気でない場合は空文字列になります。
 * @property-read bool $isSolarTerm その日が24節気の一つであるかどうかを示すブール値。値は、 24節気である場合は true、そうでない場合は false になります。
 * @property-read string $eraNameText その日が属する元号の名前を取得する。値は、 元号の名前を表す文字列、または 元号でない場合は空文字列になります。
 * @property-read int $eraName その日が属する元号を整数で取得する。値は、 元号を表す整数、または 元号でない場合は 0 になります。
 * @property-read int $eraYear その日が属する元号の年を整数で取得する。値は、 元号の年を表す整数、または 元号でない場合は 0 になります。
 * @property-read string $orientalZodiacText その日が属する十二支の名前を取得する。値は、 十二支の名前を表す文字列、または 十二支でない場合は空文字列になります。
 * @property-read int $orientalZodiac その日が属する十二支を整数で取得する。値は、 十二支を表す整数、または 十二支でない場合は 0 になります。
 * @property-read string $heavenlyStemText その日が属する十干の名前を取得する。値は、 十干の名前を表す文字列です。
 * @property-read int $heavenlyStem その日が属する十干を整数で取得する。値は、 十干を表す整数 (0〜9) です。
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
 * @property-read float $moonPhaseAngle その日における月の位相角を取得する。値は 0°(新月)〜359.9° の浮動小数点数です。
 * @property-read int $moonPhase その日における月相を取得する。値は 0(新月)〜7(有明) の整数です。
 * @property-read string $moonPhaseText その日における月相名を日本語で取得する。値は「新月」「三日月」「上弦」「十三夜」「満月」「十六夜」「下弦」「有明」のいずれかです。
 * @property-read int $seventy_two_kou その日が属する七十二候の番号を取得する（スネークケース）。値は 1（立春初候）〜 72（大寒末候）の整数。
 * @property-read int $seventyTwoKou その日が属する七十二候の番号を取得する。値は 1（立春初候）〜 72（大寒末候）の整数。
 * @property-read string $seventy_two_kou_text その日が属する七十二候の現代名称を取得する（スネークケース）。例: "東風凍を解く"、"乃東生ず"。
 * @property-read string $seventyTwoKouText その日が属する七十二候の現代名称を取得する。例: "東風凍を解く"、"乃東生ず"。
 * @property-read string $seventy_two_kou_reading その日が属する七十二候の読みを取得する（スネークケース）。例: "はるかぜ こおりをとく"。
 * @property-read string $seventyTwoKouReading その日が属する七十二候の読みを取得する。例: "はるかぜ こおりをとく"。
 * @property-read string $seventy_two_kou_type その日が属する七十二候の候種別を取得する（スネークケース）。値は "初候"、"次候"、"末候" のいずれか。
 * @property-read string $seventyTwoKouType その日が属する七十二候の候種別を取得する。値は "初候"、"次候"、"末候" のいずれか。
 * @property-read \JapaneseDate\Values\Era[] $historical_eras 大化以降の歴史的元号を取得する（スネークケース）。該当する {@see \JapaneseDate\Values\Era} の配列。南北朝時代は北朝・南朝の両方を含む。元号が存在しない場合は空配列。
 * @property-read \JapaneseDate\Values\Era[] $historicalEras 大化以降の歴史的元号を取得する。該当する {@see \JapaneseDate\Values\Era} の配列。南北朝時代は北朝・南朝の両方を含む。元号が存在しない場合は空配列。
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
    public function getCalendar(int $calendar = CAL_GREGORIAN): array
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
        return match ($name) {
            'solar_seasonal_festival', 'solarSeasonalFestival' => $this->getSolarSeasonalFestival(),
            'solar_seasonal_festival_name', 'solarSeasonalFestivalName' => $this->viewSolarSeasonalFestivalName(),
            'solar_seasonal_festival_alias', 'solarSeasonalFestivalAlias' => $this->viewSolarSeasonalFestivalAlias(),
            'lunar_seasonal_festival', 'lunarSeasonalFestival' => $this->getLunarSeasonalFestival(),
            'lunar_seasonal_festival_name', 'lunarSeasonalFestivalName' => $this->viewLunarSeasonalFestivalName(),
            'lunar_seasonal_festival_alias', 'lunarSeasonalFestivalAlias' => $this->viewLunarSeasonalFestivalAlias(),
            'misc_seasonal_node', 'miscSeasonalNode' => $this->getMiscSeasonalNode(),
            'misc_seasonal_node_text', 'miscSeasonalNodeText' => $this->viewMiscSeasonalNode(),
            'solar_term_text', 'solarTermText' => $this->getSolarTerm(),
            'solar_term', 'solarTerm' => $this->getSolarTermKey(),
            'is_solar_term', 'isSolarTerm' => $this->isSolarTerm(),
            'syunbun' => $this->getSyunbun(),
            'next_syunbun', 'nextSyunbun' => $this->getNextSyunbun(),
            'before_syunbun', 'beforeSyunbun' => $this->getBeforeSyunbun(),
            'seimei' => $this->getSeimei(),
            'next_seimei', 'nextSeimei' => $this->getNextSeimei(),
            'before_seimei', 'beforeSeimei' => $this->getBeforeSeimei(),
            'kokuu' => $this->getKokuu(),
            'next_kokuu', 'nextKokuu' => $this->getNextKokuu(),
            'before_kokuu', 'beforeKokuu' => $this->getBeforeKokuu(),
            'rikka' => $this->getRikka(),
            'next_rikka', 'nextRikka' => $this->getNextRikka(),
            'before_rikka', 'beforeRikka' => $this->getBeforeRikka(),
            'syouman' => $this->getSyouman(),
            'next_syouman', 'nextSyouman' => $this->getNextSyouman(),
            'before_syouman', 'beforeSyouman' => $this->getBeforeSyouman(),
            'bousyu' => $this->getBousyu(),
            'next_bousyu', 'nextBousyu' => $this->getNextBousyu(),
            'before_bousyu', 'beforeBousyu' => $this->getBeforeBousyu(),
            'geshi' => $this->getGeshi(),
            'next_geshi', 'nextGeshi' => $this->getNextGeshi(),
            'before_geshi', 'beforeGeshi' => $this->getBeforeGeshi(),
            'syousyo' => $this->getSyousyo(),
            'next_syousyo', 'nextSyousyo' => $this->getNextSyousyo(),
            'before_syousyo', 'beforeSyousyo' => $this->getBeforeSyousyo(),
            'taisyo' => $this->getTaisyo(),
            'next_taisyo', 'nextTaisyo' => $this->getNextTaisyo(),
            'before_taisyo', 'beforeTaisyo' => $this->getBeforeTaisyo(),
            'rissyuu' => $this->getRissyuu(),
            'next_rissyuu', 'nextRissyuu' => $this->getNextRissyuu(),
            'before_rissyuu', 'beforeRissyuu' => $this->getBeforeRissyuu(),
            'syosyo' => $this->getSyosyo(),
            'next_syosyo', 'nextSyosyo' => $this->getNextSyosyo(),
            'before_syosyo', 'beforeSyosyo' => $this->getBeforeSyosyo(),
            'hakuro' => $this->getHakuro(),
            'next_hakuro', 'nextHakuro' => $this->getNextHakuro(),
            'before_hakuro', 'beforeHakuro' => $this->getBeforeHakuro(),
            'syuubun' => $this->getSyuubun(),
            'next_syuubun', 'nextSyuubun' => $this->getNextSyuubun(),
            'before_syuubun', 'beforeSyuubun' => $this->getBeforeSyuubun(),
            'kanro' => $this->getKanro(),
            'next_kanro', 'nextKanro' => $this->getNextKanro(),
            'before_kanro', 'beforeKanro' => $this->getBeforeKanro(),
            'soukou' => $this->getSoukou(),
            'next_soukou', 'nextSoukou' => $this->getNextSoukou(),
            'before_soukou', 'beforeSoukou' => $this->getBeforeSoukou(),
            'rittou' => $this->getRittou(),
            'next_rittou', 'nextRittou' => $this->getNextRittou(),
            'before_rittou', 'beforeRittou' => $this->getBeforeRittou(),
            'syousetsu' => $this->getSyousetsu(),
            'next_syousetsu', 'nextSyousetsu' => $this->getNextSyousetsu(),
            'before_syousetsu', 'beforeSyousetsu' => $this->getBeforeSyousetsu(),
            'taisetsu' => $this->getTaisetsu(),
            'next_taisetsu', 'nextTaisetsu' => $this->getNextTaisetsu(),
            'before_taisetsu', 'beforeTaisetsu' => $this->getBeforeTaisetsu(),
            'touji' => $this->getTouji(),
            'next_touji', 'nextTouji' => $this->getNextTouji(),
            'before_touji', 'beforeTouji' => $this->getBeforeTouji(),
            'syoukan' => $this->getSyoukan(),
            'next_syoukan', 'nextSyoukan' => $this->getNextSyoukan(),
            'before_syoukan', 'beforeSyoukan' => $this->getBeforeSyoukan(),
            'daikan' => $this->getDaikan(),
            'next_daikan', 'nextDaikan' => $this->getNextDaikan(),
            'before_daikan', 'beforeDaikan' => $this->getBeforeDaikan(),
            'rissyun' => $this->getRissyun(),
            'next_rissyun', 'nextRissyun' => $this->getNextRissyun(),
            'before_rissyun', 'beforeRissyun' => $this->getBeforeRissyun(),
            'usui' => $this->getUsui(),
            'next_usui', 'nextUsui' => $this->getNextUsui(),
            'before_usui', 'beforeUsui' => $this->getBeforeUsui(),
            'keichitsu' => $this->getKeichitsu(),
            'next_keichitsu', 'nextKeichitsu' => $this->getNextKeichitsu(),
            'before_keichitsu', 'beforeKeichitsu' => $this->getBeforeKeichitsu(),
            'era_name_text', 'eraNameText' => $this->viewEraName(),
            'era_name', 'eraName' => $this->getEraName(),
            'era_year', 'eraYear' => $this->getEraYear(),
            'oriental_zodiac_text', 'orientalZodiacText' => $this->viewOrientalZodiac(),
            'oriental_zodiac', 'orientalZodiac' => $this->getOrientalZodiac(),
            'heavenly_stem_text', 'heavenlyStemText' => $this->viewHeavenlyStem(),
            'heavenly_stem', 'heavenlyStem' => $this->getHeavenlyStem(),
            'six_weekday_text', 'sixWeekdayText' => $this->viewSixWeekday(),
            'six_weekday', 'sixWeekday' => $this->getSixWeekday(),
            'weekday_text', 'weekdayText' => $this->viewWeekday(),
            'month_text', 'monthText' => $this->viewMonth(),
            'holiday_text', 'holidayText' => $this->viewHoliday(),
            'holiday' => $this->getHoliday(),
            'is_holiday', 'isHoliday' => $this->getHoliday() !== self::NO_HOLIDAY,
            'lunar_month_text', 'lunarMonthText' => $this->viewLunarMonth(),
            'lunar_month', 'lunarMonth' => $this->getLunarMonth(),
            'lunar_year', 'lunarYear' => $this->getLunarYear(),
            'lunar_day', 'lunarDay' => $this->getLunarDay(),
            'is_leap_month', 'isLeapMonth' => $this->isLeapMonth(),
            'moon_age', 'moonAge' => $this->getMoonAge(),
            'moon_phase_angle', 'moonPhaseAngle' => $this->getMoonPhaseAngle(),
            'moon_phase', 'moonPhase' => $this->getMoonPhase(),
            'moon_phase_text', 'moonPhaseText' => $this->viewMoonPhase(),
            'seventy_two_kou', 'seventyTwoKou' => $this->getSeventyTwoKou(),
            'seventy_two_kou_text', 'seventyTwoKouText' => $this->getSeventyTwoKouText(),
            'seventy_two_kou_reading', 'seventyTwoKouReading' => $this->getSeventyTwoKouReading(),
            'seventy_two_kou_type', 'seventyTwoKouType' => $this->getSeventyTwoKouType(),
            'historical_eras', 'historicalEras' => $this->historicalEras(),
            default => parent::__get($name),
        };
        // @codeCoverageIgnoreStart
    }
    // @codeCoverageIgnoreEnd
}
