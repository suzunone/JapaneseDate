<?php

namespace JapaneseDate\Components;

use DateTimeImmutable;
use DateTimeZone;
use JapaneseDate\Components\Traits\GetSolarTerm;
use JapaneseDate\DateTime;
use JapaneseDate\Elements\SolarTermDate;
use JapaneseDate\Exceptions\Exception;
use JapaneseDate\Exceptions\SolarTermException;

/**
 * 太陽黄経から二十四節気の日付を探索する天文計算版コンポーネント。
 *
 * 指定年・指定節気について、対象となる月の日付を順に調べ、
 * 太陽黄経が該当する節気境界に達する日を {@see SolarTermDate}
 * として返します。実際の黄経計算は {@see Astronomy} に委譲します。
 *
 * **計算の流れ:**
 * - 節気定数から候補月を決定
 * - 候補月の日付を走査して {@see findSolarTerm()} で節気を判定
 * - 最初に一致した日付を二十四節気日として返却
 *
 * 対応表ではなく天文計算に基づくため、将来の拡張やアルゴリズム切り替えに対応しやすい一方、
 * 計算結果は選択中の天文計算アルゴリズム（legacy / VSOP87）に依存します。
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
class SolarTerm
{
    /**
     * @var \JapaneseDate\Components\Astronomy|null
     */
    protected $astronomy;
    use GetSolarTerm;

    protected const SOLAR_TERM_MONTH = [
        3, 4, 4, 5, 5, 6, 6, 7, 7, 8, 8, 9, 9, 10, 10, 11, 11, 12, 12, 1, 1, 2, 2, 3,
    ];

    /**
     * The legacy solar longitude formula runs about six hours late against NAOJ 2000
     * Reki Yoko values within the old table's practical range.
     */
    protected const DAY_BOUNDARY_HOUR = 6;

    protected const LEGACY_TABLE_START_YEAR = 1600;

    protected const LEGACY_TABLE_END_YEAR = 2399;

    /**
     * @param \JapaneseDate\Components\Astronomy|null $astronomy
     */
    public function __construct(?Astronomy $astronomy = null)
    {
        /**
         * @readonly
         */
        $this->astronomy = $astronomy;
    }

    /**
     * @throws Exception
     * @throws SolarTermException
     * @param int $year
     */
    public function syunbun($year): SolarTermDate
    {
        return $this->getSolarTerm($year, DateTime::SOLAR_TERM_SYUNBUN);
    }

    /**
     * @param int $year
     * @param int $solar_term
     * @return SolarTermDate
     * @throws Exception
     * @throws SolarTermException
     */
    public function getSolarTerm($year, $solar_term): SolarTermDate
    {
        if (!array_key_exists($solar_term, JapaneseDate::SOLAR_TERM)) {
            throw new Exception('undefined Solar Term:' . $solar_term);
        }

        $month = self::SOLAR_TERM_MONTH[$solar_term];
        $cal_days_in_month = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        for ($day = 1; $day <= $cal_days_in_month; $day++) {
            if ($this->findSolarTerm($year, $month, $day) === $solar_term) {
                return new SolarTermDate($year, $solar_term, $day);
            }
        }

        throw new SolarTermException('Solar term was not found by astronomical calculation.');
    }

    /**
     * その日が二十四節気かどうか
     *
     * @param int $year , $month, $day  グレゴリオ暦による年月日
     * @param int $month
     * @param int $day
     * @return    int|bool
     * @throws Exception
     * @throws \Exception
     */
    public function findSolarTerm($year, $month, $day)
    {
        $astronomy = $this->astronomy ?? Astronomy::factory();
        $start = new DateTimeImmutable(
            sprintf('%04d-%02d-%02d %02d:00:00', $year, $month, $day, $this->dayBoundaryHour($year, $astronomy)),
            new DateTimeZone('Asia/Tokyo')
        );
        $end = $start->modify('+1 day');

        $longitude_sun_1 = $this->longitudeSunAt($astronomy, $start);
        $longitude_sun_2 = $this->longitudeSunAt($astronomy, $end);

        $tmp_1 = (int) floor($longitude_sun_1 / 15);
        $tmp_2 = (int) floor($longitude_sun_2 / 15);

        return ($tmp_1 !== $tmp_2 && array_key_exists($tmp_2, JapaneseDate::SOLAR_TERM)) ? $tmp_2 : false;
    }

    /**
     * @param int $year
     * @param \JapaneseDate\Components\Astronomy $astronomy
     * @return int
     */
    protected function dayBoundaryHour($year, $astronomy): int
    {
        if ($astronomy->sunAlgorithmName() === Astronomy::SOLAR_VSOP87) {
            return 0;
        }

        if ($year >= self::LEGACY_TABLE_START_YEAR && $year <= self::LEGACY_TABLE_END_YEAR) {
            return self::DAY_BOUNDARY_HOUR;
        }

        return 0;
    }

    /**
     * @param Astronomy $astronomy
     * @param DateTimeImmutable $dateTime
     * @return float
     * @throws \Exception
     */
    protected function longitudeSunAt($astronomy, $dateTime): float
    {
        return $astronomy->longitudeSun(
            (int) $dateTime->format('Y'),
            (int) $dateTime->format('m'),
            (int) $dateTime->format('d'),
            (int) $dateTime->format('H'),
            (int) $dateTime->format('i'),
            (int) $dateTime->format('s')
        );
    }

    /**
     * @throws Exception
     * @throws SolarTermException
     * @param int $year
     */
    public function seimei($year): SolarTermDate
    {
        return $this->getSolarTerm($year, DateTime::SOLAR_TERM_SEIMEI);
    }

    /**
     * @throws Exception
     * @throws SolarTermException
     * @param int $year
     */
    public function kokuu($year): SolarTermDate
    {
        return $this->getSolarTerm($year, DateTime::SOLAR_TERM_KOKUU);
    }

    /**
     * @throws Exception
     * @throws SolarTermException
     * @param int $year
     */
    public function rikka($year): SolarTermDate
    {
        return $this->getSolarTerm($year, DateTime::SOLAR_TERM_RIKKA);
    }

    /**
     * @throws Exception
     * @throws SolarTermException
     * @param int $year
     */
    public function syouman($year): SolarTermDate
    {
        return $this->getSolarTerm($year, DateTime::SOLAR_TERM_SYOUMAN);
    }

    /**
     * @throws Exception
     * @throws SolarTermException
     * @param int $year
     */
    public function bousyu($year): SolarTermDate
    {
        return $this->getSolarTerm($year, DateTime::SOLAR_TERM_BOUSYU);
    }

    /**
     * @throws Exception
     * @throws SolarTermException
     * @param int $year
     */
    public function geshi($year): SolarTermDate
    {
        return $this->getSolarTerm($year, DateTime::SOLAR_TERM_GESHI);
    }

    /**
     * @throws Exception
     * @throws SolarTermException
     * @param int $year
     */
    public function syousyo($year): SolarTermDate
    {
        return $this->getSolarTerm($year, DateTime::SOLAR_TERM_SYOUSYO);
    }

    /**
     * @throws Exception
     * @throws SolarTermException
     * @param int $year
     */
    public function taisyo($year): SolarTermDate
    {
        return $this->getSolarTerm($year, DateTime::SOLAR_TERM_TAISYO);
    }

    /**
     * @throws Exception
     * @throws SolarTermException
     * @param int $year
     */
    public function rissyuu($year): SolarTermDate
    {
        return $this->getSolarTerm($year, DateTime::SOLAR_TERM_RISSYUU);
    }

    /**
     * @throws Exception
     * @throws SolarTermException
     * @param int $year
     */
    public function syosyo($year): SolarTermDate
    {
        return $this->getSolarTerm($year, DateTime::SOLAR_TERM_SYOSYO);
    }

    /**
     * @throws Exception
     * @throws SolarTermException
     * @param int $year
     */
    public function hakuro($year): SolarTermDate
    {
        return $this->getSolarTerm($year, DateTime::SOLAR_TERM_HAKURO);
    }

    /**
     * @throws Exception
     * @throws SolarTermException
     * @param int $year
     */
    public function syuubun($year): SolarTermDate
    {
        return $this->getSolarTerm($year, DateTime::SOLAR_TERM_SYUUBUN);
    }

    /**
     * @throws Exception
     * @throws SolarTermException
     * @param int $year
     */
    public function kanro($year): SolarTermDate
    {
        return $this->getSolarTerm($year, DateTime::SOLAR_TERM_KANRO);
    }

    /**
     * @throws Exception
     * @throws SolarTermException
     * @param int $year
     */
    public function soukou($year): SolarTermDate
    {
        return $this->getSolarTerm($year, DateTime::SOLAR_TERM_SOUKOU);
    }

    /**
     * @throws Exception
     * @throws SolarTermException
     * @param int $year
     */
    public function rittou($year): SolarTermDate
    {
        return $this->getSolarTerm($year, DateTime::SOLAR_TERM_RITTOU);
    }

    /**
     * @throws Exception
     * @throws SolarTermException
     * @param int $year
     */
    public function syousetsu($year): SolarTermDate
    {
        return $this->getSolarTerm($year, DateTime::SOLAR_TERM_SYOUSETSU);
    }

    /**
     * @throws Exception
     * @throws SolarTermException
     * @param int $year
     */
    public function taisetsu($year): SolarTermDate
    {
        return $this->getSolarTerm($year, DateTime::SOLAR_TERM_TAISETSU);
    }

    /**
     * @throws Exception
     * @throws SolarTermException
     * @param int $year
     */
    public function touji($year): SolarTermDate
    {
        return $this->getSolarTerm($year, DateTime::SOLAR_TERM_TOUJI);
    }

    /**
     * @throws Exception
     * @throws SolarTermException
     * @param int $year
     */
    public function syoukan($year): SolarTermDate
    {
        return $this->getSolarTerm($year, DateTime::SOLAR_TERM_SYOUKAN);
    }

    /**
     * @throws Exception
     * @throws SolarTermException
     * @param int $year
     */
    public function daikan($year): SolarTermDate
    {
        return $this->getSolarTerm($year, DateTime::SOLAR_TERM_DAIKAN);
    }

    /**
     * @throws Exception
     * @throws SolarTermException
     * @param int $year
     */
    public function rissyun($year): SolarTermDate
    {
        return $this->getSolarTerm($year, DateTime::SOLAR_TERM_RISSYUN);
    }

    /**
     * @throws Exception
     * @throws SolarTermException
     * @param int $year
     */
    public function usui($year): SolarTermDate
    {
        return $this->getSolarTerm($year, DateTime::SOLAR_TERM_USUI);
    }

    /**
     * @throws Exception
     * @throws SolarTermException
     * @param int $year
     */
    public function keichitsu($year): SolarTermDate
    {
        return $this->getSolarTerm($year, DateTime::SOLAR_TERM_KEICHITSU);
    }
}
