<?php

/**
 * MiscSeasonalNode.php
 *
 * 雑節（ざっせつ）の判定を行うコンポーネント。
 *
 * @category    DateTime
 * @package     JapaneseDate
 * @subpackage  Component
 * @author      Suzunone <suzunone.eleven@gmail.com>
 * @copyright   Suzunone
 * @license     BSD-2
 * @link        https://github.com/suzunone/JapaneseDate
 * @see         https://github.com/suzunone/JapaneseDate
 * @since       2026-05-29
 */

namespace JapaneseDate\Components;

use DateTimeImmutable as NativeDateTimeImmutable;
use DateTimeZone;
use JapaneseDate\DateTime;
use JapaneseDate\DateTimeImmutable;
use JapaneseDate\Elements\SolarTermDate;
use Throwable;

/**
 * 雑節（節分・彼岸・社日・八十八夜・入梅・半夏生・土用・二百十日・二百二十日）の
 * 判定を行うコンポーネントクラス。
 *
 * 各雑節の計算ロジックを集約し、{@see \JapaneseDate\DateTime} および
 * {@see \JapaneseDate\DateTimeImmutable} から利用されます。
 * また {@see \JapaneseDate\DatePeriod} の土用・彼岸フィルタからも利用されます。
 *
 * **判定する雑節の一覧（優先順位順）:**
 * 1. 節分   — 立春の前日
 * 2. 彼岸   — 春分・秋分を中日とした前後3日間（計7日）
 * 3. 社日   — 春分・秋分に最も近い戊（つちのえ）の日
 * 4. 八十八夜 — 立春から数えて88日目
 * 5. 入梅   — 太陽黄経が80°に達する日
 * 6. 半夏生  — 太陽黄経が100°に達する日
 * 7. 土用   — 立春・立夏・立秋・立冬の各18日前から節気前日まで
 * 8. 二百十日 — 立春から数えて210日目
 * 9. 二百二十日 — 立春から数えて220日目
 *
 * @category    DateTime
 * @package     JapaneseDate
 * @subpackage  Component
 * @author      Suzunone <suzunone.eleven@gmail.com>
 * @copyright   Suzunone
 * @license     BSD-2
 * @link        https://github.com/suzunone/JapaneseDate
 * @see         https://github.com/suzunone/JapaneseDate
 * @since       2026-05-29
 */
class MiscSeasonalNode
{
    /**
     * 雑節名の配列。
     *
     * キーは {@see \JapaneseDate\DateTime::MISC_SEASONAL_NODE_*} 定数に対応し、
     * 値は日本語の雑節名です。雑節でない場合（key=0）は空文字列を返します。
     *
     * @var array<int, string>
     */
    public const MISC_SEASONAL_NODE_NAMES = [
        0 => '',
        1 => '節分',
        2 => '彼岸',
        3 => '社日',
        4 => '八十八夜',
        5 => '入梅',
        6 => '半夏生',
        7 => '土用',
        8 => '二百十日',
        9 => '二百二十日',
    ];

    /**
     * ファクトリー（シングルトン）。
     *
     * @return static
     */
    public static function factory(): static
    {
        static $instance;
        if (!$instance) {
            // @codeCoverageIgnoreStart
            $instance = new static();
            // @codeCoverageIgnoreEnd
        }

        return $instance;
    }

    /**
     * 指定した日付が該当する雑節の定数キーを返します。
     *
     * 複数の雑節に該当する可能性がある場合は、以下の優先順位で最初に一致したものを返します:
     * 節分 > 彼岸 > 社日 > 八十八夜 > 入梅 > 半夏生 > 土用 > 二百十日 > 二百二十日
     *
     * 雑節でない日は {@see \JapaneseDate\DateTime::MISC_SEASONAL_NODE_NONE}（= 0）を返します。
     *
     * @param \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable $date 判定対象の日付
     * @return int 雑節定数（{@see \JapaneseDate\DateTime::MISC_SEASONAL_NODE_NONE} ～ {@see \JapaneseDate\DateTime::MISC_SEASONAL_NODE_NIHYAKUNIJUUNICHI}）
     */
    public function getMiscSeasonalNodeKey(DateTime|DateTimeImmutable $date): int
    {
        if ($this->isSetsubun($date)) {
            return DateTime::MISC_SEASONAL_NODE_SETSUBUN;
        }
        if ($this->isHigan($date)) {
            return DateTime::MISC_SEASONAL_NODE_HIGAN;
        }
        if ($this->isShanichi($date)) {
            return DateTime::MISC_SEASONAL_NODE_SHANICHI;
        }
        if ($this->isHachijuhachiya($date)) {
            return DateTime::MISC_SEASONAL_NODE_HACHIJUHACHIYA;
        }
        if ($this->isNyubai($date)) {
            return DateTime::MISC_SEASONAL_NODE_NYUBAI;
        }
        if ($this->isHangesho($date)) {
            return DateTime::MISC_SEASONAL_NODE_HANGESHO;
        }
        if ($this->isDoyo($date)) {
            return DateTime::MISC_SEASONAL_NODE_DOYO;
        }
        if ($this->isNihyakutoka($date)) {
            return DateTime::MISC_SEASONAL_NODE_NIHYAKUTOKA;
        }
        if ($this->isNihyakunijuunichi($date)) {
            return DateTime::MISC_SEASONAL_NODE_NIHYAKUNIJUUNICHI;
        }

        return DateTime::MISC_SEASONAL_NODE_NONE;
    }

    /**
     * 雑節定数キーから日本語の雑節名を返します。
     *
     * @param int $key 雑節定数（{@see \JapaneseDate\DateTime::MISC_SEASONAL_NODE_*}）
     * @return string 雑節名（例: 「節分」「土用」）、または雑節でない場合は空文字列
     */
    public function viewMiscSeasonalNode(int $key): string
    {
        return self::MISC_SEASONAL_NODE_NAMES[$key] ?? '';
    }

    /**
     * 指定した日付が節分（立春の前日）かどうかを判定します。
     *
     * 節分は季節の分かれ目（立春・立夏・立秋・立冬）の前日を指しますが、
     * 現代では立春の前日のみを指すことが一般的です。
     *
     * @param \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable $date 判定対象の日付
     * @return bool 節分であれば true
     */
    public function isSetsubun(DateTime|DateTimeImmutable $date): bool
    {
        try {
            $risshun = $this->resolveSingleSolarTerm('rissyun', $date->year);
            $risshunDt = $this->solarTermToNativeDate($risshun);
            $setsubun = $risshunDt->modify('-1 day');

            return $date->format('Y-m-d') === $setsubun->format('Y-m-d');
            // @codeCoverageIgnoreStart
        } catch (Throwable) {
            return false;
        }
        // @codeCoverageIgnoreEnd
    }

    /**
     * 指定した日付が彼岸（春分・秋分を中日とした前後3日間）かどうかを判定します。
     *
     * 春彼岸と秋彼岸の両方を判定します。
     * 彼岸は中日（春分または秋分）の前後3日を含む計7日間の期間です。
     *
     * @param \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable $date 判定対象の日付
     * @return bool 彼岸期間内であれば true
     */
    public function isHigan(DateTime|DateTimeImmutable $date): bool
    {
        $higanTerms = ['syunbun', 'syuubun'];
        $dateTs = $date->startOfDay()->timestamp;

        foreach ($higanTerms as $term) {
            foreach ([$date->year - 1, $date->year, $date->year + 1] as $year) {
                try {
                    $termDate = $this->resolveSingleSolarTerm($term, $year);
                    $termTs = $this->solarTermToDateTime($termDate)->startOfDay()->timestamp;
                    if ($dateTs >= $termTs - 3 * 86400 && $dateTs <= $termTs + 3 * 86400) {
                        return true;
                    }
                    // @codeCoverageIgnoreStart
                } catch (Throwable) {
                    continue;
                }
                // @codeCoverageIgnoreEnd
            }
        }

        return false;
    }

    /**
     * 指定した日付が社日（春分・秋分に最も近い戊の日）かどうかを判定します。
     *
     * 社日は農業の守護神（産土神）を祀る日で、春分・秋分に最も近い
     * 「戊（つちのえ）」の日です。同距離の場合は前の日が優先されます。
     *
     * 十干の戊の日の判定には、ユリウス日（JD）を用います:
     * `cal_to_jd(CAL_GREGORIAN, $month, $day, $year) % 10 === 4` のとき戊の日。
     *
     * @param \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable $date 判定対象の日付
     * @return bool 社日であれば true
     */
    public function isShanichi(DateTime|DateTimeImmutable $date): bool
    {
        $jd = cal_to_jd(CAL_GREGORIAN, $date->month, $date->day, $date->year);
        if ($jd % 10 !== 4) {
            return false;
        }

        foreach (['syunbun', 'syuubun'] as $term) {
            try {
                $termDate = $this->resolveSingleSolarTerm($term, $date->year);
                $termJd = cal_to_jd(CAL_GREGORIAN, $termDate->month, $termDate->day, $termDate->year);
                $diff = $jd - $termJd;
                $dist = abs($diff);

                // 距離が5日以内なら最も近い戊の日（次の戊日は10日先なので10-dist>=5）
                // 同距離（dist==5）のときは前の日（diff<0）を優先
                if ($dist < 5 || ($dist === 5 && $diff < 0)) {
                    return true;
                }
                // @codeCoverageIgnoreStart
            } catch (Throwable) {
                continue;
            }
            // @codeCoverageIgnoreEnd
        }

        return false;
    }

    /**
     * 指定した日付が八十八夜（立春から数えて88日目）かどうかを判定します。
     *
     * 立春を1日目として数えると、88日目（立春の翌87日後）が八十八夜です。
     * 農業の種まきの目安とされ、茶摘みの時期としても知られています。
     *
     * @param \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable $date 判定対象の日付
     * @return bool 八十八夜であれば true
     */
    public function isHachijuhachiya(DateTime|DateTimeImmutable $date): bool
    {
        try {
            $risshun = $this->resolveSingleSolarTerm('rissyun', $date->year);
            $target = $this->solarTermToDateTime($risshun)->addDays(87)->format('Y-m-d');

            return $date->format('Y-m-d') === $target;
            // @codeCoverageIgnoreStart
        } catch (Throwable) {
            return false;
        }
        // @codeCoverageIgnoreEnd
    }

    /**
     * 指定した日付が入梅（太陽黄経80°）かどうかを判定します。
     *
     * 入梅は太陽の黄経が80°に達する日で、梅雨入りの目安とされます。
     * 芒種（黄経75°）の数日後にあたり、年によって変動します。
     *
     * @param \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable $date 判定対象の日付
     * @return bool 入梅であれば true
     */
    public function isNyubai(DateTime|DateTimeImmutable $date): bool
    {
        return $this->isSolarLongitudeDay($date, 80.0);
    }

    /**
     * 指定した日付が半夏生（太陽黄経100°）かどうかを判定します。
     *
     * 半夏生は太陽の黄経が100°に達する日で、夏至（黄経90°）の約10〜11日後にあたります。
     * 農家の農作業の目安とされ、関西地方ではタコを食べる習慣があります。
     *
     * @param \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable $date 判定対象の日付
     * @return bool 半夏生であれば true
     */
    public function isHangesho(DateTime|DateTimeImmutable $date): bool
    {
        return $this->isSolarLongitudeDay($date, 100.0);
    }

    /**
     * 指定した日付が土用期間内かどうかを判定します。
     *
     * 土用は立春・立夏・立秋・立冬のそれぞれ18日前から節気前日までの期間で、
     * 1年間に4回あります。「土用の丑の日」は夏の土用（立秋前）が有名です。
     *
     * @param \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable $date 判定対象の日付
     * @return bool 土用期間内であれば true
     */
    public function isDoyo(DateTime|DateTimeImmutable $date): bool
    {
        $doyoTerms = ['rissyun', 'rikka', 'rissyuu', 'rittou'];
        $dateTs = $date->startOfDay()->timestamp;

        foreach ([$date->year, $date->year + 1] as $year) {
            foreach ($doyoTerms as $term) {
                try {
                    $termDate = $this->resolveSingleSolarTerm($term, $year);
                    $termTs = $this->solarTermToDateTime($termDate)->startOfDay()->timestamp;
                    $doyoStart = $termTs - 18 * 86400;
                    $doyoEnd = $termTs - 86400;

                    if ($dateTs >= $doyoStart && $dateTs <= $doyoEnd) {
                        return true;
                    }
                    // @codeCoverageIgnoreStart
                } catch (Throwable) {
                    continue;
                }
                // @codeCoverageIgnoreEnd
            }
        }

        return false;
    }

    /**
     * 指定した日付が二百十日（立春から数えて210日目）かどうかを判定します。
     *
     * 立春を1日目として数えると、210日目（立春の翌209日後）が二百十日です。
     * 台風の多い時期として農家が警戒する日とされています（9月1日頃）。
     *
     * @param \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable $date 判定対象の日付
     * @return bool 二百十日であれば true
     */
    public function isNihyakutoka(DateTime|DateTimeImmutable $date): bool
    {
        try {
            $risshun = $this->resolveSingleSolarTerm('rissyun', $date->year);
            $target = $this->solarTermToDateTime($risshun)->addDays(209)->format('Y-m-d');

            return $date->format('Y-m-d') === $target;
            // @codeCoverageIgnoreStart
        } catch (Throwable) {
            return false;
        }
        // @codeCoverageIgnoreEnd
    }

    /**
     * 指定した日付が二百二十日（立春から数えて220日目）かどうかを判定します。
     *
     * 立春を1日目として数えると、220日目（立春の翌219日後）が二百二十日です。
     * 二百十日に続く台風警戒日で、9月11日頃にあたります。
     *
     * @param \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable $date 判定対象の日付
     * @return bool 二百二十日であれば true
     */
    public function isNihyakunijuunichi(DateTime|DateTimeImmutable $date): bool
    {
        try {
            $risshun = $this->resolveSingleSolarTerm('rissyun', $date->year);
            $target = $this->solarTermToDateTime($risshun)->addDays(219)->format('Y-m-d');

            return $date->format('Y-m-d') === $target;
            // @codeCoverageIgnoreStart
        } catch (Throwable) {
            return false;
        }
        // @codeCoverageIgnoreEnd
    }

    /**
     * 指定した日付が太陽黄経 $targetLon 度に達する日かどうかを判定します。
     *
     * 入梅（80°）・半夏生（100°）の判定に使用します。
     * 当日の06:00 UTC時点での黄経が $targetLon 未満で、翌日の同時刻以降であれば true を返します。
     *
     * @param \JapaneseDate\DateTime $date      判定対象の日付
     * @param float                  $targetLon 目標の太陽黄経（度）
     * @return bool 指定黄経に達する日であれば true
     */
    private function isSolarLongitudeDay(DateTime $date, float $targetLon): bool
    {
        try {
            $astronomy = Astronomy::factory();
            $lon1 = $astronomy->longitudeSun($date->year, $date->month, $date->day, 6, 0, 0);

            $tomorrow = $this->addOneDay($date->year, $date->month, $date->day);
            $lon2 = $astronomy->longitudeSun($tomorrow[0], $tomorrow[1], $tomorrow[2], 6, 0, 0);

            return $lon1 < $targetLon && $lon2 >= $targetLon;
            // @codeCoverageIgnoreStart
        } catch (Throwable) {
            return false;
        }
        // @codeCoverageIgnoreEnd
    }

    /**
     * 指定した節気メソッド名と年から {@see \JapaneseDate\Elements\SolarTermDate} を返します。
     *
     * @param string $method 節気メソッド名（'rissyun', 'syunbun' など）
     * @param int    $year   西暦年
     * @return \JapaneseDate\Elements\SolarTermDate 節気データ
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function resolveSingleSolarTerm(string $method, int $year): SolarTermDate
    {
        try {
            return (new SimpleSolarTerm())->{$method}($year);
        } catch (Throwable) {
            return (new SolarTerm())->{$method}($year);
        }
    }

    /**
     * {@see \JapaneseDate\Elements\SolarTermDate} から {@see \JapaneseDate\DateTime} を生成します。
     *
     * @param \JapaneseDate\Elements\SolarTermDate $termDate 節気データ
     * @return \JapaneseDate\DateTime 節気日の DateTime
     */
    private function solarTermToDateTime(SolarTermDate $termDate): DateTime
    {
        return DateTime::create($termDate->year, $termDate->month, $termDate->day);
    }

    /**
     * {@see \JapaneseDate\Elements\SolarTermDate} からネイティブ {@see \DateTimeImmutable} を生成します。
     *
     * 循環依存を避けるため、{@see \JapaneseDate\DateTime} を使わずネイティブクラスを使用します。
     *
     * @param \JapaneseDate\Elements\SolarTermDate $termDate 節気データ
     * @return \DateTimeImmutable 節気日の DateTimeImmutable
     * @throws \Exception
     */
    private function solarTermToNativeDate(SolarTermDate $termDate): NativeDateTimeImmutable
    {
        return new NativeDateTimeImmutable(
            sprintf('%04d-%02d-%02d', $termDate->year, $termDate->month, $termDate->day),
            new DateTimeZone('Asia/Tokyo')
        );
    }

    /**
     * 指定した年月日の翌日の年月日を配列で返します。
     *
     * @param int $year  年
     * @param int $month 月
     * @param int $day   日
     * @return array{0: int, 1: int, 2: int} [年, 月, 日]
     */
    private function addOneDay(int $year, int $month, int $day): array
    {
        $jd = cal_to_jd(CAL_GREGORIAN, $month, $day, $year);
        $cal = cal_from_jd($jd + 1, CAL_GREGORIAN);

        return [$cal['year'], $cal['month'], $cal['day']];
    }
}
