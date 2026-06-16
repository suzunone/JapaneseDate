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
 * 各雑節の計算ロジックを集約し、{@see DateTime} および
 * {@see DateTimeImmutable} から利用されます。
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
     * キーは {@see DateTime::MISC_SEASONAL_NODE_*} 定数に対応し、
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
     * 指定した日付が該当する雑節の定数キーを返します。
     *
     * 複数の雑節に該当する可能性がある場合は、以下の優先順位で最初に一致したものを返します:
     * 節分 > 彼岸 > 社日 > 八十八夜 > 入梅 > 半夏生 > 土用 > 二百十日 > 二百二十日
     *
     * 雑節でない日は {@see DateTime::MISC_SEASONAL_NODE_NONE}（= 0）を返します。
     *
     * @param DateTime|DateTimeImmutable $date 判定対象の日付
     * @return int 雑節定数（{@see DateTime::MISC_SEASONAL_NODE_NONE} ～ {@see DateTime::MISC_SEASONAL_NODE_NIHYAKUNIJUUNICHI}）
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
     * 指定した日付が節分（立春の前日）かどうかを判定します。
     *
     * 節分は季節の分かれ目（立春・立夏・立秋・立冬）の前日を指しますが、
     * 現代では立春の前日のみを指すことが一般的です。
     *
     * @param DateTime|DateTimeImmutable $date 判定対象の日付
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
     * 指定した節気名と年から {@see SolarTermDate} を返します。
     *
     * @param string $term 節気名（'rissyun', 'syunbun', 'syuubun', 'rikka', 'rissyuu', 'rittou'）
     * @param int $year 西暦年
     * @return SolarTermDate 節気データ
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function resolveSingleSolarTerm(string $term, int $year): SolarTermDate
    {
        if (Astronomy::solarAlgorithm() === Astronomy::SOLAR_VSOP87) {
            return $this->callSolarTermMethod(new SolarTerm(), $term, $year);
        }

        try {
            return $this->callSolarTermMethod(new SimpleSolarTerm(), $term, $year);
        } catch (Throwable) {
            return $this->callSolarTermMethod(new SolarTerm(), $term, $year);
        }
    }

    /**
     * 節気名に対応するメソッドを match で呼び出します。
     *
     * @param SolarTerm|SimpleSolarTerm $obj 節気計算オブジェクト
     * @param string $term 節気名
     * @param int $year 西暦年
     * @return SolarTermDate 節気データ
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function callSolarTermMethod(SolarTerm|SimpleSolarTerm $obj, string $term, int $year): SolarTermDate
    {
        return match ($term) {
            'rissyun' => $obj->rissyun($year),
            'syunbun' => $obj->syunbun($year),
            'syuubun' => $obj->syuubun($year),
            'rikka' => $obj->rikka($year),
            'rissyuu' => $obj->rissyuu($year),
            'rittou' => $obj->rittou($year),
        };
    }

    /**
     * {@see SolarTermDate} からネイティブ {@see NativeDateTimeImmutable} を生成します。
     *
     * 循環依存を避けるため、{@see DateTime} を使わずネイティブクラスを使用します。
     *
     * @param SolarTermDate $termDate 節気データ
     * @return NativeDateTimeImmutable 節気日の DateTimeImmutable
     * @throws \Exception
     */
    protected function solarTermToNativeDate(SolarTermDate $termDate): NativeDateTimeImmutable
    {
        return new NativeDateTimeImmutable(
            sprintf('%04d-%02d-%02d', $termDate->year, $termDate->month, $termDate->day),
            new DateTimeZone('Asia/Tokyo')
        );
    }

    /**
     * 指定した日付が彼岸（春分・秋分を中日とした前後3日間）かどうかを判定します。
     *
     * 春彼岸と秋彼岸の両方を判定します。
     * 彼岸は中日（春分または秋分）の前後3日を含む計7日間の期間です。
     *
     * @param DateTime|DateTimeImmutable $date 判定対象の日付
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
     * {@see SolarTermDate} から {@see DateTime} を生成します。
     *
     * @param SolarTermDate $termDate 節気データ
     * @return DateTime 節気日の DateTime
     */
    protected function solarTermToDateTime(SolarTermDate $termDate): DateTime
    {
        return DateTime::create($termDate->year, $termDate->month, $termDate->day);
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
     * @param DateTime|DateTimeImmutable $date 判定対象の日付
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
     * @param DateTime|DateTimeImmutable $date 判定対象の日付
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
     * @param DateTime|DateTimeImmutable $date 判定対象の日付
     * @return bool 入梅であれば true
     */
    public function isNyubai(DateTime|DateTimeImmutable $date): bool
    {
        return $this->isSolarLongitudeDay($date, 80.0);
    }

    /**
     * 指定した日付が太陽黄経 $targetLon 度に達する日かどうかを判定します。
     *
     * 入梅（80°）・半夏生（100°）の判定に使用します。
     * JST の日付境界は UTC 15:00（= JST 翌0:00）に相当するため、
     * UTC ($date-1) 15:00 時点での黄経が $targetLon 未満で、
     * UTC $date 15:00 時点での黄経が $targetLon 以上であれば true を返します。
     *
     * @param DateTime|DateTimeImmutable $date 判定対象の日付
     * @param float $targetLon 目標の太陽黄経（度）
     * @return bool 指定黄経に達する日であれば true
     */
    protected function isSolarLongitudeDay(DateTime|DateTimeImmutable $date, float $targetLon): bool
    {
        try {
            $astronomy = Astronomy::factory();
            // longitudeSun() はJST引数を受け取る。
            // VSOP87 は JST 00:00（= UTC 前日15:00）基準、
            // Legacy は約6時間遅れる特性があるため JST 06:00 基準（SolarTerm と同じ方針）。
            // $date の境界時刻から +1日 で閾値を跨いでいるかを判定する。
            $boundaryHour = ($astronomy->sunAlgorithmName() === Astronomy::SOLAR_VSOP87) ? 0 : 6;
            $nextDay = $this->addOneDay($date->year, $date->month, $date->day);
            $lon1 = $astronomy->longitudeSun($date->year, $date->month, $date->day, $boundaryHour, 0, 0);
            $lon2 = $astronomy->longitudeSun($nextDay[0], $nextDay[1], $nextDay[2], $boundaryHour, 0, 0);

            return $lon1 < $targetLon && $lon2 >= $targetLon;
            // @codeCoverageIgnoreStart
        } catch (Throwable) {
            return false;
        }
        // @codeCoverageIgnoreEnd
    }

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
     * 指定した年月日の翌日の年月日を配列で返します。
     *
     * @param int $year 年
     * @param int $month 月
     * @param int $day 日
     * @return array{0: int, 1: int, 2: int} [年, 月, 日]
     */
    protected function addOneDay(int $year, int $month, int $day): array
    {
        $jd = cal_to_jd(CAL_GREGORIAN, $month, $day, $year);
        $cal = cal_from_jd($jd + 1, CAL_GREGORIAN);

        return [$cal['year'], $cal['month'], $cal['day']];
    }

    /**
     * 指定した日付が半夏生（太陽黄経100°）かどうかを判定します。
     *
     * 半夏生は太陽の黄経が100°に達する日で、夏至（黄経90°）の約10〜11日後にあたります。
     * 農家の農作業の目安とされ、関西地方ではタコを食べる習慣があります。
     *
     * @param DateTime|DateTimeImmutable $date 判定対象の日付
     * @return bool 半夏生であれば true
     */
    public function isHangesho(DateTime|DateTimeImmutable $date): bool
    {
        return $this->isSolarLongitudeDay($date, 100.0);
    }

    /**
     * 指定した日付が土用期間内かどうかを判定します。
     *
     * 土用は各四立（立春・立夏・立秋・立冬）の18°手前から四立直前までの期間です。
     * 1年間に4回あります。「土用の丑の日」は夏の土用（立秋前）が有名です。
     *
     * 判定方法: UTC 15:00（= JST 翌0:00）時点の太陽黄経が各土用範囲内にあるかを確認します。
     * - 冬土用: 297° ≤ lon < 315°（立春）
     * - 春土用:  27° ≤ lon <  45°（立夏）
     * - 夏土用: 117° ≤ lon < 135°（立秋）
     * - 秋土用: 207° ≤ lon < 225°（立冬）
     *
     * @param DateTime|DateTimeImmutable $date 判定対象の日付
     * @return bool 土用期間内であれば true
     */
    public function isDoyo(DateTime|DateTimeImmutable $date): bool
    {
        // 土用入りの境界は太陽黄経が 27°/117°/207°/297° を跨ぐ瞬間で決まり、
        // 境界アルゴリズム（デフォルト VSOP87）の太陽黄経で判定する。

        // 四立当日は土用明けのため土用に含まない。
        // 四立が日付の極端に遅い時刻（23:59 JST など）に発生する場合、
        // 翌日0:00の黄経が上限未満のまま帯内に残ることがあるため、
        // 通常アルゴリズムで明示的に除外する。
        try {
            foreach (['rissyun', 'rikka', 'rissyuu', 'rittou'] as $shiristu) {
                $shiristuDate = $this->resolveSingleSolarTerm($shiristu, $date->year);
                $shiristuStr = sprintf('%04d-%02d-%02d', $shiristuDate->year, $shiristuDate->month, $shiristuDate->day);
                if ($date->format('Y-m-d') === $shiristuStr) {
                    return false;
                }
            }

            // @codeCoverageIgnoreStart
        } catch (Throwable) {
            // 節気取得に失敗した場合は除外せず、後続の黄経判定に委ねる
        }
        // @codeCoverageIgnoreEnd

        try {
            $astronomy = Astronomy::factoryForBoundary();
            // $date が土用期間内かどうかを「翌日JST 0:00の太陽黄経」だけで判定する。
            // - 土用入り日: lon(今日0:00) < 下限 だが lon(翌日0:00) ≥ 下限 → 翌日経度が帯内 → true ✓
            // - 土用期間中: lon(翌日0:00) も帯内 → true ✓
            // - 四立当日（土用明け）: 四立は $date 内に発生するため lon(翌日0:00) ≥ 上限 → 帯外 → false ✓
            $nextDay = $this->addOneDay($date->year, $date->month, $date->day);
            $lon2 = $astronomy->longitudeSun($nextDay[0], $nextDay[1], $nextDay[2], 0, 0, 0);

            $inDoyoBand = static fn (float $lon): bool => ($lon >= 297.0 && $lon < 315.0)
                || ($lon >= 27.0 && $lon < 45.0)
                || ($lon >= 117.0 && $lon < 135.0)
                || ($lon >= 207.0 && $lon < 225.0);

            return $inDoyoBand($lon2);
            // @codeCoverageIgnoreStart
        } catch (Throwable) {
            return false;
            // @codeCoverageIgnoreEnd
        }
    }

    /**
     * 指定した日付が二百十日（立春から数えて210日目）かどうかを判定します。
     *
     * 立春を1日目として数えると、210日目（立春の翌209日後）が二百十日です。
     * 台風の多い時期として農家が警戒する日とされています（9月1日頃）。
     *
     * @param DateTime|DateTimeImmutable $date 判定対象の日付
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
     * @param DateTime|DateTimeImmutable $date 判定対象の日付
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
     * 雑節定数キーから日本語の雑節名を返します。
     *
     * @param int $key 雑節定数（{@see DateTime::MISC_SEASONAL_NODE_*}）
     * @return string 雑節名（例: 「節分」「土用」）、または雑節でない場合は空文字列
     */
    public function viewMiscSeasonalNode(int $key): string
    {
        return self::MISC_SEASONAL_NODE_NAMES[$key] ?? '';
    }
}
