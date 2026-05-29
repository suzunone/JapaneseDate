<?php

namespace JapaneseDate\Components;

use DateTimeImmutable;
use DateTimeZone;
use JapaneseDate\DateTime;
use JapaneseDate\Elements\SolarTermDate;
use JapaneseDate\Exceptions\Exception;
use JapaneseDate\Exceptions\SolarTermException;

class SolarTerm
{
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

    public function __construct(private readonly ?Astronomy $astronomy = null)
    {
    }

    /**
     * @param int $year
     * @param int $solarTerm
     * @return \JapaneseDate\Elements\SolarTermDate
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    public function getSolarTerm(int $year, int $solarTerm): SolarTermDate
    {
        if (!array_key_exists($solarTerm, JapaneseDate::SOLAR_TERM)) {
            throw new Exception('undefined Solar Term:' . $solarTerm);
        }

        $month = self::SOLAR_TERM_MONTH[$solarTerm];
        $cal_days_in_month = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        for ($day = 1; $day <= $cal_days_in_month; $day++) {
            if ($this->findSolarTerm($year, $month, $day) === $solarTerm) {
                return new SolarTermDate($year, $solarTerm, $day);
            }
        }

        throw new SolarTermException('Solar term was not found by astronomical calculation.');
    }

    /**
     * 二十四節気配列を返す
     * @param int $year
     * @return SolarTermDate[]
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    public function getSolarTerms(int $year): array
    {
        return [
            DateTime::SOLAR_TERM_SYUNBUN   => $this->syunbun($year),
            DateTime::SOLAR_TERM_SEIMEI    => $this->seimei($year),
            DateTime::SOLAR_TERM_KOKUU     => $this->kokuu($year),
            DateTime::SOLAR_TERM_RIKKA     => $this->rikka($year),
            DateTime::SOLAR_TERM_SYOUMAN   => $this->syouman($year),
            DateTime::SOLAR_TERM_BOUSYU    => $this->bousyu($year),
            DateTime::SOLAR_TERM_GESHI     => $this->geshi($year),
            DateTime::SOLAR_TERM_SYOUSYO   => $this->syousyo($year),
            DateTime::SOLAR_TERM_TAISYO    => $this->taisyo($year),
            DateTime::SOLAR_TERM_RISSYUU   => $this->rissyuu($year),
            DateTime::SOLAR_TERM_SYOSYO    => $this->syosyo($year),
            DateTime::SOLAR_TERM_HAKURO    => $this->hakuro($year),
            DateTime::SOLAR_TERM_SYUUBUN   => $this->syuubun($year),
            DateTime::SOLAR_TERM_KANRO     => $this->kanro($year),
            DateTime::SOLAR_TERM_SOUKOU    => $this->soukou($year),
            DateTime::SOLAR_TERM_RITTOU    => $this->rittou($year),
            DateTime::SOLAR_TERM_SYOUSETSU => $this->syousetsu($year),
            DateTime::SOLAR_TERM_TAISETSU  => $this->taisetsu($year),
            DateTime::SOLAR_TERM_TOUJI     => $this->touji($year),
            DateTime::SOLAR_TERM_SYOUKAN   => $this->syoukan($year),
            DateTime::SOLAR_TERM_DAIKAN    => $this->daikan($year),
            DateTime::SOLAR_TERM_RISSYUN   => $this->rissyun($year),
            DateTime::SOLAR_TERM_USUI      => $this->usui($year),
            DateTime::SOLAR_TERM_KEICHITSU => $this->keichitsu($year),
        ];
    }

    /**
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    public function syunbun(int $year): SolarTermDate
    {
        return $this->getSolarTerm($year, DateTime::SOLAR_TERM_SYUNBUN);
    }

    /**
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    public function seimei(int $year): SolarTermDate
    {
        return $this->getSolarTerm($year, DateTime::SOLAR_TERM_SEIMEI);
    }

    /**
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    public function kokuu(int $year): SolarTermDate
    {
        return $this->getSolarTerm($year, DateTime::SOLAR_TERM_KOKUU);
    }

    /**
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    public function rikka(int $year): SolarTermDate
    {
        return $this->getSolarTerm($year, DateTime::SOLAR_TERM_RIKKA);
    }

    /**
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    public function syouman(int $year): SolarTermDate
    {
        return $this->getSolarTerm($year, DateTime::SOLAR_TERM_SYOUMAN);
    }

    /**
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    public function bousyu(int $year): SolarTermDate
    {
        return $this->getSolarTerm($year, DateTime::SOLAR_TERM_BOUSYU);
    }

    /**
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    public function geshi(int $year): SolarTermDate
    {
        return $this->getSolarTerm($year, DateTime::SOLAR_TERM_GESHI);
    }

    /**
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    public function syousyo(int $year): SolarTermDate
    {
        return $this->getSolarTerm($year, DateTime::SOLAR_TERM_SYOUSYO);
    }

    /**
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    public function taisyo(int $year): SolarTermDate
    {
        return $this->getSolarTerm($year, DateTime::SOLAR_TERM_TAISYO);
    }

    /**
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    public function rissyuu(int $year): SolarTermDate
    {
        return $this->getSolarTerm($year, DateTime::SOLAR_TERM_RISSYUU);
    }

    /**
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    public function syosyo(int $year): SolarTermDate
    {
        return $this->getSolarTerm($year, DateTime::SOLAR_TERM_SYOSYO);
    }

    /**
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    public function hakuro(int $year): SolarTermDate
    {
        return $this->getSolarTerm($year, DateTime::SOLAR_TERM_HAKURO);
    }

    /**
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    public function syuubun(int $year): SolarTermDate
    {
        return $this->getSolarTerm($year, DateTime::SOLAR_TERM_SYUUBUN);
    }

    /**
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    public function kanro(int $year): SolarTermDate
    {
        return $this->getSolarTerm($year, DateTime::SOLAR_TERM_KANRO);
    }

    /**
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    public function soukou(int $year): SolarTermDate
    {
        return $this->getSolarTerm($year, DateTime::SOLAR_TERM_SOUKOU);
    }

    /**
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    public function rittou(int $year): SolarTermDate
    {
        return $this->getSolarTerm($year, DateTime::SOLAR_TERM_RITTOU);
    }

    /**
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    public function syousetsu(int $year): SolarTermDate
    {
        return $this->getSolarTerm($year, DateTime::SOLAR_TERM_SYOUSETSU);
    }

    /**
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    public function taisetsu(int $year): SolarTermDate
    {
        return $this->getSolarTerm($year, DateTime::SOLAR_TERM_TAISETSU);
    }

    /**
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    public function touji(int $year): SolarTermDate
    {
        return $this->getSolarTerm($year, DateTime::SOLAR_TERM_TOUJI);
    }

    /**
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    public function syoukan(int $year): SolarTermDate
    {
        return $this->getSolarTerm($year, DateTime::SOLAR_TERM_SYOUKAN);
    }

    /**
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    public function daikan(int $year): SolarTermDate
    {
        return $this->getSolarTerm($year, DateTime::SOLAR_TERM_DAIKAN);
    }

    /**
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    public function rissyun(int $year): SolarTermDate
    {
        return $this->getSolarTerm($year, DateTime::SOLAR_TERM_RISSYUN);
    }

    /**
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    public function usui(int $year): SolarTermDate
    {
        return $this->getSolarTerm($year, DateTime::SOLAR_TERM_USUI);
    }

    /**
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    public function keichitsu(int $year): SolarTermDate
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
    public function findSolarTerm(int $year, int $month, int $day): bool|int
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
