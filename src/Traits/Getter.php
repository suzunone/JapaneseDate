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
 * @mixin DateTime
 * @mixin DateTimeImmutable
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
 * @property-read string $weekday_text その日が属する曜日の名前を取得する。値は、 曜日の名前を表す文字列、または 曜日でない場合は空文字列になります。
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
 * @property-read int|null $moon_phase その日における月相を取得する。値は 0(新月)〜7(有明) の整数、または主要な月相点以外の場合は null です。
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
 * @property-read int $solarSeasonalFestival 西暦の月日から五節句IDを取得する。値は {@see DateTime::SEASONAL_FESTIVAL_NONE}（0）〜{@see DateTime::SEASONAL_FESTIVAL_CHOYO}（5）のいずれかです。節句でない場合は 0 を返します。
 * @property-read string $solarSeasonalFestivalName 西暦の月日から五節句の式名を取得する。「人日の節句」「上巳の節句」「端午の節句」「七夕の節句」「重陽の節句」のいずれか、または節句でない場合は空文字列を返します。
 * @property-read string $solarSeasonalFestivalAlias 西暦の月日から五節句の別名を取得する。「七草の節句」「桃の節句」「菖蒲の節句」「笹の節句」「菊の節句」のいずれか、または節句でない場合は空文字列を返します。
 * @property-read int $lunarSeasonalFestival 旧暦の月日から五節句IDを取得する。値は {@see DateTime::SEASONAL_FESTIVAL_NONE}（0）〜{@see DateTime::SEASONAL_FESTIVAL_CHOYO}（5）のいずれかです。節句でない場合は 0 を返します。
 * @property-read string $lunarSeasonalFestivalName 旧暦の月日から五節句の式名を取得する。「人日の節句」「上巳の節句」「端午の節句」「七夕の節句」「重陽の節句」のいずれか、または節句でない場合は空文字列を返します。
 * @property-read string $lunarSeasonalFestivalAlias 旧暦の月日から五節句の別名を取得する。「七草の節句」「桃の節句」「菖蒲の節句」「笹の節句」「菊の節句」のいずれか、または節句でない場合は空文字列を返します。
 * @property-read int $miscSeasonalNode その日が該当する雑節の定数を取得する。値は {@see DateTime::MISC_SEASONAL_NODE_NONE}（0）〜{@see DateTime::MISC_SEASONAL_NODE_NIHYAKUNIJUUNICHI}（9）のいずれかです。雑節でない場合は 0 を返します。
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
 * @property-read int|null $moonPhase その日における月相を取得する。値は 0(新月)〜7(有明) の整数、または主要な月相点以外の場合は null です。
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
    public function getCalendar($calendar = CAL_GREGORIAN): array
    {
        return cal_from_jd(unixtojd($this->timestamp), $calendar);
    }

    /**
     * MagicMethod:__get()
     *
     * @link https://carbon.nesbot.com/docs/#api-getters
     * @param string $name
     * @return \DateTimeZone|int|string
     * @throws \DateInvalidTimeZoneException
     * @throws \DateMalformedStringException
     * @throws \JapaneseDate\Exceptions\ErrorException
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\NativeDateTimeException
     * @throws \JapaneseDate\Exceptions\SolarTermException
     * @throws \JsonException
     */
    #[\ReturnTypeWillChange]
    public function __get($name)
    {
        switch ($name) {
            case 'solar_seasonal_festival':
            case 'solarSeasonalFestival':
                return $this->getSolarSeasonalFestival();
            case 'solar_seasonal_festival_name':
            case 'solarSeasonalFestivalName':
                return $this->viewSolarSeasonalFestivalName();
            case 'solar_seasonal_festival_alias':
            case 'solarSeasonalFestivalAlias':
                return $this->viewSolarSeasonalFestivalAlias();
            case 'lunar_seasonal_festival':
            case 'lunarSeasonalFestival':
                return $this->getLunarSeasonalFestival();
            case 'lunar_seasonal_festival_name':
            case 'lunarSeasonalFestivalName':
                return $this->viewLunarSeasonalFestivalName();
            case 'lunar_seasonal_festival_alias':
            case 'lunarSeasonalFestivalAlias':
                return $this->viewLunarSeasonalFestivalAlias();
            case 'misc_seasonal_node':
            case 'miscSeasonalNode':
                return $this->getMiscSeasonalNode();
            case 'misc_seasonal_node_text':
            case 'miscSeasonalNodeText':
                return $this->viewMiscSeasonalNode();
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
            case 'heavenly_stem_text':
            case 'heavenlyStemText':
                return $this->viewHeavenlyStem();
            case 'heavenly_stem':
            case 'heavenlyStem':
                return $this->getHeavenlyStem();
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
            case 'moon_phase_angle':
            case 'moonPhaseAngle':
                return $this->getMoonPhaseAngle();
            case 'moon_phase':
            case 'moonPhase':
                return $this->getMoonPhase();
            case 'moon_phase_text':
            case 'moonPhaseText':
                return $this->viewMoonPhase();
            case 'seventy_two_kou':
            case 'seventyTwoKou':
                return $this->getSeventyTwoKou();
            case 'seventy_two_kou_text':
            case 'seventyTwoKouText':
                return $this->getSeventyTwoKouText();
            case 'seventy_two_kou_reading':
            case 'seventyTwoKouReading':
                return $this->getSeventyTwoKouReading();
            case 'seventy_two_kou_type':
            case 'seventyTwoKouType':
                return $this->getSeventyTwoKouType();
            case 'historical_eras':
            case 'historicalEras':
                return $this->historicalEras();
            default:
                return parent::__get($name);
        }
        // @codeCoverageIgnoreStart
    }
    // @codeCoverageIgnoreEnd

    /**
     * @inheritDoc
     * @return array
     */
    public function toArray(): array
    {
        $moon_phase_angle = $this->moon_phase_angle;
        $moon_phase = $this->moon_phase;
        $moon_phase_text = $this->moon_phase_text;
        $moon_age = $this->moon_age;

        /** @noinspection PhpMultipleClassDeclarationsInspection */
        return array_merge(parent::toArray(), [
            'solar_seasonal_festival' => $this->solar_seasonal_festival,
            'solar_seasonal_festival_name' => $this->solar_seasonal_festival_name,
            'solar_seasonal_festival_alias' => $this->solar_seasonal_festival_alias,
            'lunar_seasonal_festival' => $this->lunar_seasonal_festival,
            'lunar_seasonal_festival_name' => $this->lunar_seasonal_festival_name,
            'lunar_seasonal_festival_alias' => $this->lunar_seasonal_festival_alias,
            'misc_seasonal_node' => $this->misc_seasonal_node,
            'misc_seasonal_node_text' => $this->misc_seasonal_node_text,
            'solar_term' => $this->solar_term,
            'solar_term_text' => $this->solar_term_text,
            'is_solar_term' => $this->is_solar_term,
            'era_name_text' => $this->era_name_text,
            'era_name' => $this->era_name,
            'era_year' => $this->era_year,
            'oriental_zodiac_text' => $this->oriental_zodiac_text,
            'oriental_zodiac' => $this->oriental_zodiac,
            'heavenly_stem_text' => $this->heavenly_stem_text,
            'heavenly_stem' => $this->heavenly_stem,
            'six_weekday_text' => $this->six_weekday_text,
            'six_weekday' => $this->six_weekday,
            'weekday_text' => $this->weekday_text,
            'month_text' => $this->month_text,
            'holiday_text' => $this->holiday_text,
            'holiday' => $this->holiday,
            'is_holiday' => $this->is_holiday,
            'lunar_month_text' => $this->lunar_month_text,
            'lunar_month' => $this->lunar_month,
            'lunar_year' => $this->lunar_year,
            'lunar_day' => $this->lunar_day,
            'is_leap_month' => $this->is_leap_month,
            'moon_age' => $moon_age,
            'moon_phase_angle' => $moon_phase_angle,
            'moon_phase' => $moon_phase,
            'moon_phase_text' => $moon_phase_text,
        ]);
    }
}
