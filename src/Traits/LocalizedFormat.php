<?php
/**
 * LocalizedFormat.php
 *
 * @category    DateTime
 * @package     JapaneseDate
 * @subpackage  Traits
 * @author      Suzunone <suzunone.eleven@gmail.com>
 * @copyright   Suzunone
 * @license     BSD-2
 * @link        https://github.com/suzunone/JapaneseDate
 * @see         https://github.com/suzunone/JapaneseDate
 * @since       Class available since Release 1.0.0
 */

namespace JapaneseDate\Traits;

/**
 * Trait LocalizedFormat
 *
 * @category    DateTime
 * @package     JapaneseDate
 * @subpackage  Traits
 * @author      Suzunone <suzunone.eleven@gmail.com>
 * @copyright   Suzunone
 * @license     BSD-2
 * @link        https://github.com/suzunone/JapaneseDate
 * @see         https://github.com/suzunone/JapaneseDate
 * @since       Class available since Release 1.0.0
 * @mixin \JapaneseDate\DateTime
 */
trait LocalizedFormat
{
    /**
     * 日本語カレンダー対応したstrftime()
     *
     * {@link http://php.net/manual/ja/function.strftime.php function.strftime strftimeの仕様}
     * に加え、
     *
     * - %J 1～31の日
     * - %e 1～9なら先頭にスペースを付ける、1～31の日
     * - %g 1～9なら先頭にスペースを付ける、1～12の月
     * - %k 六曜番号
     * - %6 六曜
     * - %K 曜日
     * - %l 祝日番号
     * - %L 祝日
     * - %o 干支番号
     * - %O 干支
     * - %E 旧暦年
     * - %G 旧暦の月
     * - %F 年号
     * - %f 年号ID
     *
     * が使用できます。
     *
     * このメソッドは非推奨です。 {@see DateTime::formatLocalized()}を使用してください。
     *
     * @param string $format フォーマット
     * @return string  指定したフォーマット文字列に基づき文字列をフォーマットして返します。 月および曜日の名前、およびその他の言語依存の文字列は、 setlocale() で設定された現在のロケールを尊重して表示されます。
     * @throws \JapaneseDate\Exceptions\ErrorException
     * @throws \JapaneseDate\Exceptions\Exception
     * @since 1.1
     * @deprecated
     */
    public function strftime($format): string
    {
        $res_str = $this->strftimeJa($format, '%');

        return strftime($res_str, $this->timestamp);
    }

    /**
     * 日本語カレンダー対応したstrftime()の事前メソッド
     *
     * @param string $format フォーマット
     * @param string $delimiter
     * @return string  指定したフォーマット文字列に基づき文字列をフォーマットして返します。 月および曜日の名前、およびその他の言語依存の文字列は、 setlocale() で設定された現在のロケールを尊重して表示されます。
     * @throws \JapaneseDate\Exceptions\ErrorException
     * @throws \JapaneseDate\Exceptions\Exception
     * @since 1.1
     */
    protected function strftimeJa($format, $delimiter = '%#'): string
    {
        $res_str = '';
        $format_array = explode($delimiter, $format);
        foreach ($format_array as $key => $strings) {
            if ($key === 0) {
                $res_str .= $strings;
                continue;
            }
            if ($delimiter !== '%' && mb_substr($format_array[$key - 1], -1, 1) === '%') {
                $re_format = $delimiter . $strings;
                $res_str .= $re_format;
                continue;
            }

            $pattern = mb_substr($strings, 0, 1);

            if ($pattern === '-') {
                $pattern = mb_substr($strings, 0, 2);
            }

            switch ($pattern) {
                case 'o':
                    $re_format = $this->getOrientalZodiac();
                    break;
                case 'O':
                    $re_format = $this->viewOrientalZodiac();
                    break;
                case 'l':
                    $re_format = $this->getHoliday();
                    break;
                case 'L':
                    $re_format = $this->viewHoliday();
                    break;
                case 'K':
                    $re_format = $this->viewWeekday();
                    break;
                case 'k':
                    $re_format = $this->viewSixWeekday();
                    break;
                case '6':
                    $re_format = $this->getSixWeekday();
                    break;
                case 'e':
                    $re_format = $this->format('j');
                    if (strlen($re_format) === 1) {
                        $re_format = ' ' . $re_format;
                    }
                    break;
                case 'g':
                    $re_format = $this->format('n');
                    if (strlen($re_format) === 1) {
                        $re_format = ' ' . $re_format;
                    }
                    break;
                case 'J':
                    $re_format = $this->format('j');
                    break;
                case 'G':
                    $re_format = $this->viewMonth();
                    break;
                case 'F':
                    $re_format = $this->viewEraName();
                    break;
                case 'f':
                    $re_format = $this->getEraName();
                    break;
                case 'E':
                    $re_format = $this->getEraYear();
                    break;
                default:
                    $re_format = false;

                    if ($delimiter !== '%') {
                        switch ($pattern) {
                            case '-d':
                                $re_format = $this->getLunarDay();
                                break;
                            case 'd':
                                $re_format = $this->getLunarDay();
                                if (strlen($re_format) === 1) {
                                    $re_format = '0' . $re_format;
                                }
                                break;
                            case 'j':
                                $re_format = $this->getLunarDay();
                                if (strlen($re_format) === 1) {
                                    $re_format = ' ' . $re_format;
                                }
                                break;
                            case '-m':
                                $re_format = $this->getLunarMonth();
                                break;
                            case 'm':
                                $re_format = $this->getLunarMonth();
                                if (strlen($re_format) === 1) {
                                    $re_format = '0' . $re_format;
                                }
                                break;
                            case 'n':
                                $re_format = $this->getLunarMonth();
                                if (strlen($re_format) === 1) {
                                    $re_format = ' ' . $re_format;
                                }
                                break;
                            case 'b':
                            case 'h':
                                $re_format = $this->viewLunarMonth();
                                break;
                            case'B':
                                $re_format = $this->viewLunarMonth();
                                if ($this->isLeapMonth()) {
                                    $re_format .= '(閏月)';
                                }
                                break;
                            case 'u':
                                $re_format = $this->isLeapMonth() ? '閏' : '';
                                break;
                            case 'U':
                                $re_format = $this->isLeapMonth() ? '(閏)' : '';
                                break;
                        }
                    }

                    if ($re_format === false) {
                        $re_format = $delimiter . $strings;
                        $res_str .= $re_format;
                        continue 2;
                    }
                    break;
            }
            $res_str .= $re_format . mb_substr($strings, strlen($pattern));
        }

        return $res_str;
    }

    /**
     * 日本語カレンダー対応したstrftime()
     *
     * {@link http://php.net/manual/ja/function.strftime.php function.strftime strftimeの仕様}
     * に加え、
     * - %#J %-dへのエイリアス
     * - %#e 1～9なら先頭にスペースを付ける、1～31の日(%eのwin対応版)
     * - %#g 1～9なら先頭にスペースを付ける、1～12の月
     * - %#G 古い名前の月名(睦月、如月)
     * - %#k 六曜番号
     * - %#6 六曜
     * - %#K 曜日
     * - %#l 祝日番号
     * - %#L 祝日
     * - %#o 干支番号
     * - %#O 干支
     * - %#E 旧暦年
     * - %#d 旧暦の日(01,02...)
     * - %#-d 旧暦の日(1,2,3....)
     * - %#j 旧暦の1桁の場合は先頭にスペースをいれた日（ 1, 2, 3）
     * - %#m 旧暦の月(01,02...)
     * - %#-m 旧暦の月(1,2,3....)
     * - %#n 旧暦の1桁の場合は先頭にスペースをいれた月（ 1, 2, 3）
     * - %#b 旧暦の月(睦月,如月...)
     * - %#h %#bへのエイリアス
     * - %#B 旧暦の月で閏月まで表示する 皐月(閏月)
     * - %#u 閏月の場合 閏 と出力させる
     * - %#U 閏月の場合 (閏) と出力させる
     * - %#F 年号
     * - %#f 年号ID
     *
     * が使用できます。
     *
     * @param string $format フォーマット
     * @return string  指定したフォーマット文字列に基づき文字列をフォーマットして返します。 月および曜日の名前、およびその他の言語依存の文字列は、 setlocale() で設定された現在のロケールを尊重して表示されます。
     * @throws \JapaneseDate\Exceptions\ErrorException
     * @throws \JapaneseDate\Exceptions\Exception
     * @since 1.1
     */
    public function formatLocalized($format)
    {
        $format = $this->strftimeJa($format);

        return parent::formatLocalized($format);
    }

    /**
     * CarbonデフォルトのformatLocalizedへのエイリアス
     *
     * @param string $format フォーマット
     * @return string
     */
    public function formatLocalizedSimple($format): string
    {
        return parent::formatLocalized($format);
    }
}
