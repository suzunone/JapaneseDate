<?php

namespace JapaneseDate\Components;

use DateTimeImmutable;
use DateTimeZone;
use JapaneseDate\Components\Traits\GetSolarTerm;
use JapaneseDate\DateTime;
use JapaneseDate\Elements\SolarTermDate;
use JapaneseDate\Exceptions\Exception;
use JapaneseDate\Exceptions\SolarTermException;

class SolarTerm
{
    /**
     * @var \JapaneseDate\Components\Astronomy|null
     */
    private $astronomy;
    use GetSolarTerm;

    private const SOLAR_TERM_MONTH = [
        3, 4, 4, 5, 5, 6, 6, 7, 7, 8, 8, 9, 9, 10, 10, 11, 11, 12, 12, 1, 1, 2, 2, 3,
    ];

    /**
     * The legacy solar longitude formula runs about six hours late against NAOJ 2000
     * Reki Yoko values within the old table's practical range.
     */
    private const DAY_BOUNDARY_HOUR = 6;

    private const LEGACY_TABLE_START_YEAR = 1600;

    private const LEGACY_TABLE_END_YEAR = 2399;

    public function __construct(?Astronomy $astronomy = null)
    {
        /**
         * @readonly
         */
        $this->astronomy = $astronomy;
    }

    /**
     * @param int $year
     * @param int $solar_term
     * @return \JapaneseDate\Elements\SolarTermDate
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
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
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     * @param int $year
     */
    public function syunbun($year): SolarTermDate
    {
        return $this->getSolarTerm($year, DateTime::SOLAR_TERM_SYUNBUN);
    }

    /**
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     * @param int $year
     */
    public function seimei($year): SolarTermDate
    {
        return $this->getSolarTerm($year, DateTime::SOLAR_TERM_SEIMEI);
    }

    /**
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     * @param int $year
     */
    public function kokuu($year): SolarTermDate
    {
        return $this->getSolarTerm($year, DateTime::SOLAR_TERM_KOKUU);
    }

    /**
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     * @param int $year
     */
    public function rikka($year): SolarTermDate
    {
        return $this->getSolarTerm($year, DateTime::SOLAR_TERM_RIKKA);
    }

    /**
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     * @param int $year
     */
    public function syouman($year): SolarTermDate
    {
        return $this->getSolarTerm($year, DateTime::SOLAR_TERM_SYOUMAN);
    }

    /**
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     * @param int $year
     */
    public function bousyu($year): SolarTermDate
    {
        return $this->getSolarTerm($year, DateTime::SOLAR_TERM_BOUSYU);
    }

    /**
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     * @param int $year
     */
    public function geshi($year): SolarTermDate
    {
        return $this->getSolarTerm($year, DateTime::SOLAR_TERM_GESHI);
    }

    /**
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     * @param int $year
     */
    public function syousyo($year): SolarTermDate
    {
        return $this->getSolarTerm($year, DateTime::SOLAR_TERM_SYOUSYO);
    }

    /**
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     * @param int $year
     */
    public function taisyo($year): SolarTermDate
    {
        return $this->getSolarTerm($year, DateTime::SOLAR_TERM_TAISYO);
    }

    /**
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     * @param int $year
     */
    public function rissyuu($year): SolarTermDate
    {
        return $this->getSolarTerm($year, DateTime::SOLAR_TERM_RISSYUU);
    }

    /**
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     * @param int $year
     */
    public function syosyo($year): SolarTermDate
    {
        return $this->getSolarTerm($year, DateTime::SOLAR_TERM_SYOSYO);
    }

    /**
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     * @param int $year
     */
    public function hakuro($year): SolarTermDate
    {
        return $this->getSolarTerm($year, DateTime::SOLAR_TERM_HAKURO);
    }

    /**
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     * @param int $year
     */
    public function syuubun($year): SolarTermDate
    {
        return $this->getSolarTerm($year, DateTime::SOLAR_TERM_SYUUBUN);
    }

    /**
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     * @param int $year
     */
    public function kanro($year): SolarTermDate
    {
        return $this->getSolarTerm($year, DateTime::SOLAR_TERM_KANRO);
    }

    /**
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     * @param int $year
     */
    public function soukou($year): SolarTermDate
    {
        return $this->getSolarTerm($year, DateTime::SOLAR_TERM_SOUKOU);
    }

    /**
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     * @param int $year
     */
    public function rittou($year): SolarTermDate
    {
        return $this->getSolarTerm($year, DateTime::SOLAR_TERM_RITTOU);
    }

    /**
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     * @param int $year
     */
    public function syousetsu($year): SolarTermDate
    {
        return $this->getSolarTerm($year, DateTime::SOLAR_TERM_SYOUSETSU);
    }

    /**
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     * @param int $year
     */
    public function taisetsu($year): SolarTermDate
    {
        return $this->getSolarTerm($year, DateTime::SOLAR_TERM_TAISETSU);
    }

    /**
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     * @param int $year
     */
    public function touji($year): SolarTermDate
    {
        return $this->getSolarTerm($year, DateTime::SOLAR_TERM_TOUJI);
    }

    /**
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     * @param int $year
     */
    public function syoukan($year): SolarTermDate
    {
        return $this->getSolarTerm($year, DateTime::SOLAR_TERM_SYOUKAN);
    }

    /**
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     * @param int $year
     */
    public function daikan($year): SolarTermDate
    {
        return $this->getSolarTerm($year, DateTime::SOLAR_TERM_DAIKAN);
    }

    /**
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     * @param int $year
     */
    public function rissyun($year): SolarTermDate
    {
        return $this->getSolarTerm($year, DateTime::SOLAR_TERM_RISSYUN);
    }

    /**
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     * @param int $year
     */
    public function usui($year): SolarTermDate
    {
        return $this->getSolarTerm($year, DateTime::SOLAR_TERM_USUI);
    }

    /**
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     * @param int $year
     */
    public function keichitsu($year): SolarTermDate
    {
        return $this->getSolarTerm($year, DateTime::SOLAR_TERM_KEICHITSU);
    }

    /**
     * その日が二十四節気かどうか
     *
     * @param int $year , $month, $day  グレゴリオ暦による年月日
     * @param int $month
     * @param int $day
     * @return    int|bool
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \Exception
     */
    public function findSolarTerm($year, $month, $day)
    {
        $astronomy = $this->astronomy ?? Astronomy::factory();
        $start = new DateTimeImmutable(
            sprintf('%04d-%02d-%02d %02d:00:00', $year, $month, $day, $this->dayBoundaryHour($year)),
            new DateTimeZone('Asia/Tokyo')
        );
        $end = $start->modify('+1 day');

        $longitude_sun_1 = $this->longitudeSunAt($astronomy, $start);
        $longitude_sun_2 = $this->longitudeSunAt($astronomy, $end);

        $tmp_1 = (int) floor($longitude_sun_1 / 15);
        $tmp_2 = (int) floor($longitude_sun_2 / 15);

        return ($tmp_1 !== $tmp_2 && array_key_exists($tmp_2, JapaneseDate::SOLAR_TERM)) ? $tmp_2 : false;
    }

    private function dayBoundaryHour(int $year): int
    {
        if ($year >= self::LEGACY_TABLE_START_YEAR && $year <= self::LEGACY_TABLE_END_YEAR) {
            return self::DAY_BOUNDARY_HOUR;
        }

        return 0;
    }

    /**
     * @throws \JapaneseDate\Exceptions\Exception
     */
    private function longitudeSunAt(Astronomy $astronomy, DateTimeImmutable $dateTime): float
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
}
