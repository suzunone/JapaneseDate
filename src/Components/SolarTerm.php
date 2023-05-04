<?php

namespace JapaneseDate\Components;

use JapaneseDate\DateTime;
use JapaneseDate\Elements\SolarTermDate;
use JapaneseDate\Exceptions\Exception;
use JapaneseDate\Exceptions\SolarTermException;

class SolarTerm
{

    /**
     * @param int $year
     * @param int $solar_term
     * @return \JapaneseDate\Elements\SolarTermDate
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    public function getSolarTerm(int $year, int $solar_term): SolarTermDate
    {
        switch ($solar_term) {
            case DateTime::SOLAR_TERM_SYUNBUN :
                return $this->syunbun($year);
            case DateTime::SOLAR_TERM_SEIMEI :
                return $this->seimei($year);
            case DateTime::SOLAR_TERM_KOKUU :
                return $this->kokuu($year);
            case DateTime::SOLAR_TERM_RIKKA :
                return $this->rikka($year);
            case DateTime::SOLAR_TERM_SYOUMAN :
                return $this->syouman($year);
            case DateTime::SOLAR_TERM_BOUSYU :
                return $this->bousyu($year);
            case DateTime::SOLAR_TERM_GESHI :
                return $this->geshi($year);
            case DateTime::SOLAR_TERM_SYOUSYO :
                return $this->syousyo($year);
            case DateTime::SOLAR_TERM_TAISYO :
                return $this->taisyo($year);
            case DateTime::SOLAR_TERM_RISSYUU :
                return $this->rissyuu($year);
            case DateTime::SOLAR_TERM_SYOSYO :
                return $this->syosyo($year);
            case DateTime::SOLAR_TERM_HAKURO :
                return $this->hakuro($year);
            case DateTime::SOLAR_TERM_SYUUBUN :
                return $this->syuubun($year);
            case DateTime::SOLAR_TERM_KANRO :
                return $this->kanro($year);
            case DateTime::SOLAR_TERM_SOUKOU :
                return $this->soukou($year);
            case DateTime::SOLAR_TERM_RITTOU :
                return $this->rittou($year);
            case DateTime::SOLAR_TERM_SYOUSETSU :
                return $this->syousetsu($year);
            case DateTime::SOLAR_TERM_TAISETSU :
                return $this->taisetsu($year);
            case DateTime::SOLAR_TERM_TOUJI :
                return $this->touji($year);
            case DateTime::SOLAR_TERM_SYOUKAN :
                return $this->syoukan($year);
            case DateTime::SOLAR_TERM_DAIKAN :
                return $this->daikan($year);
            case DateTime::SOLAR_TERM_RISSYUN :
                return $this->rissyun($year);
            case DateTime::SOLAR_TERM_USUI :
                return $this->usui($year);
            case DateTime::SOLAR_TERM_KEICHITSU :
                return $this->keichitsu($year);
        }

        throw new Exception('undefined Solar Term:' . $solar_term);
    }

    /**
     * 二十四節気配列を返す
     * @param int $year
     * @return SolarTermDate[]
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    public function getSolarTerms(int $year): array
    {
        return [
            DateTime::SOLAR_TERM_SYUNBUN => $this->syunbun($year),
            DateTime::SOLAR_TERM_SEIMEI => $this->seimei($year),
            DateTime::SOLAR_TERM_KOKUU => $this->kokuu($year),
            DateTime::SOLAR_TERM_RIKKA => $this->rikka($year),
            DateTime::SOLAR_TERM_SYOUMAN => $this->syouman($year),
            DateTime::SOLAR_TERM_BOUSYU => $this->bousyu($year),
            DateTime::SOLAR_TERM_GESHI => $this->geshi($year),
            DateTime::SOLAR_TERM_SYOUSYO => $this->syousyo($year),
            DateTime::SOLAR_TERM_TAISYO => $this->taisyo($year),
            DateTime::SOLAR_TERM_RISSYUU => $this->rissyuu($year),
            DateTime::SOLAR_TERM_SYOSYO => $this->syosyo($year),
            DateTime::SOLAR_TERM_HAKURO => $this->hakuro($year),
            DateTime::SOLAR_TERM_SYUUBUN => $this->syuubun($year),
            DateTime::SOLAR_TERM_KANRO => $this->kanro($year),
            DateTime::SOLAR_TERM_SOUKOU => $this->soukou($year),
            DateTime::SOLAR_TERM_RITTOU => $this->rittou($year),
            DateTime::SOLAR_TERM_SYOUSETSU => $this->syousetsu($year),
            DateTime::SOLAR_TERM_TAISETSU => $this->taisetsu($year),
            DateTime::SOLAR_TERM_TOUJI => $this->touji($year),
            DateTime::SOLAR_TERM_SYOUKAN => $this->syoukan($year),
            DateTime::SOLAR_TERM_DAIKAN => $this->daikan($year),
            DateTime::SOLAR_TERM_RISSYUN => $this->rissyun($year),
            DateTime::SOLAR_TERM_USUI => $this->usui($year),
            DateTime::SOLAR_TERM_KEICHITSU => $this->keichitsu($year),
        ];
    }

    /**
     * 春分
     *
     * @param int $year
     * @return \JapaneseDate\Elements\SolarTermDate
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    public function syunbun(int $year): SolarTermDate
    {
        if ($year >= 1600 && $year <= 1631) {
            $days = [20, 20, 21, 21,];
        } elseif ($year >= 1632 && $year <= 1663) {
            $days = [20, 20, 20, 21,];
        } elseif ($year >= 1664 && $year <= 1699) {
            $days = [20, 20, 20, 20,];
        } elseif ($year >= 1700 && $year <= 1731) {
            $days = [20, 21, 21, 21,];
        } elseif ($year >= 1732 && $year <= 1763) {
            $days = [20, 20, 21, 21,];
        } elseif ($year >= 1764 && $year <= 1795) {
            $days = [20, 20, 20, 21,];
        } elseif ($year >= 1796 && $year <= 1799) {
            $days = [20, 20, 20, 20,];
        } elseif ($year >= 1800 && $year <= 1827) {
            $days = [21, 21, 21, 21,];
        } elseif ($year >= 1828 && $year <= 1859) {
            $days = [20, 21, 21, 21,];
        } elseif ($year >= 1860 && $year <= 1891) {
            $days = [20, 20, 21, 21,];
        } elseif ($year >= 1892 && $year <= 1899) {
            $days = [20, 20, 20, 21,];
        } elseif ($year >= 1900 && $year <= 1923) {
            $days = [21, 21, 21, 22,];
        } elseif ($year >= 1924 && $year <= 1959) {
            $days = [21, 21, 21, 21,];
        } elseif ($year >= 1960 && $year <= 1991) {
            $days = [20, 21, 21, 21,];
        } elseif ($year >= 1992 && $year <= 2023) {
            $days = [20, 20, 21, 21,];
        } elseif ($year >= 2024 && $year <= 2055) {
            $days = [20, 20, 20, 21,];
        } elseif ($year >= 2056 && $year <= 2091) {
            $days = [20, 20, 20, 20,];
        } elseif ($year >= 2092 && $year <= 2099) {
            $days = [19, 20, 20, 20,];
        } elseif ($year >= 2100 && $year <= 2123) {
            $days = [20, 21, 21, 21,];
        } elseif ($year >= 2124 && $year <= 2155) {
            $days = [20, 20, 21, 21,];
        } elseif ($year >= 2156 && $year <= 2187) {
            $days = [20, 20, 20, 21,];
        } elseif ($year >= 2188 && $year <= 2199) {
            $days = [20, 20, 20, 20,];
        } elseif ($year >= 2200 && $year <= 2223) {
            $days = [21, 21, 21, 21,];
        } elseif ($year >= 2224 && $year <= 2255) {
            $days = [20, 21, 21, 21,];
        } elseif ($year >= 2256 && $year <= 2287) {
            $days = [20, 20, 21, 21,];
        } elseif ($year >= 2288 && $year <= 2299) {
            $days = [20, 20, 20, 21,];
        } elseif ($year >= 2300 && $year <= 2319) {
            $days = [21, 21, 21, 22,];
        } elseif ($year >= 2320 && $year <= 2351) {
            $days = [21, 21, 21, 21,];
        } elseif ($year >= 2352 && $year <= 2383) {
            $days = [20, 21, 21, 21,];
        } elseif ($year >= 2384 && $year <= 2399) {
            $days = [20, 20, 21, 21,];
        } else {
            throw new SolarTermException;
        }

        return new SolarTermDate($year, DateTime::SOLAR_TERM_SYUNBUN, $days[$year % 4]);
    }

    /**
     * 清明
     *
     * @param int $year
     * @return \JapaneseDate\Elements\SolarTermDate
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    public function seimei(int $year): SolarTermDate
    {
        if ($year >= 1600 && $year <= 1627) {
            $days = [4, 5, 5, 5,];
        } elseif ($year >= 1628 && $year <= 1659) {
            $days = [4, 4, 5, 5,];
        } elseif ($year >= 1660 && $year <= 1691) {
            $days = [4, 4, 4, 5,];
        } elseif ($year >= 1692 && $year <= 1699) {
            $days = [4, 4, 4, 4,];
        } elseif ($year >= 1700 && $year <= 1727) {
            $days = [5, 5, 5, 5,];
        } elseif ($year >= 1728 && $year <= 1755) {
            $days = [4, 5, 5, 5,];
        } elseif ($year >= 1756 && $year <= 1787) {
            $days = [4, 4, 5, 5,];
        } elseif ($year >= 1788 && $year <= 1799) {
            $days = [4, 4, 4, 5,];
        } elseif ($year >= 1800 && $year <= 1819) {
            $days = [5, 5, 5, 6,];
        } elseif ($year >= 1820 && $year <= 1855) {
            $days = [5, 5, 5, 5,];
        } elseif ($year >= 1856 && $year <= 1883) {
            $days = [4, 5, 5, 5,];
        } elseif ($year >= 1884 && $year <= 1899) {
            $days = [4, 4, 5, 5,];
        } elseif ($year >= 1900 && $year <= 1915) {
            $days = [5, 5, 6, 6,];
        } elseif ($year >= 1916 && $year <= 1947) {
            $days = [5, 5, 5, 6,];
        } elseif ($year >= 1948 && $year <= 1983) {
            $days = [5, 5, 5, 5,];
        } elseif ($year >= 1984 && $year <= 2015) {
            $days = [4, 5, 5, 5,];
        } elseif ($year >= 2016 && $year <= 2043) {
            $days = [4, 4, 5, 5,];
        } elseif ($year >= 2044 && $year <= 2075) {
            $days = [4, 4, 4, 5,];
        } elseif ($year >= 2076 && $year <= 2099) {
            $days = [4, 4, 4, 4,];
        } elseif ($year >= 2100 && $year <= 2111) {
            $days = [5, 5, 5, 5,];
        } elseif ($year >= 2112 && $year <= 2139) {
            $days = [4, 5, 5, 5,];
        } elseif ($year >= 2140 && $year <= 2171) {
            $days = [4, 4, 5, 5,];
        } elseif ($year >= 2172 && $year <= 2199) {
            $days = [4, 4, 4, 5,];
        } elseif ($year >= 2200 && $year <= 2203) {
            $days = [5, 5, 5, 6,];
        } elseif ($year >= 2204 && $year <= 2239) {
            $days = [5, 5, 5, 5,];
        } elseif ($year >= 2240 && $year <= 2271) {
            $days = [4, 5, 5, 5,];
        } elseif ($year >= 2272 && $year <= 2299) {
            $days = [4, 4, 5, 5,];
        } elseif ($year >= 2300 && $year <= 2331) {
            $days = [5, 5, 5, 6,];
        } elseif ($year >= 2332 && $year <= 2367) {
            $days = [5, 5, 5, 5,];
        } elseif ($year >= 2368 && $year <= 2399) {
            $days = [4, 5, 5, 5,];
        } else {
            throw new SolarTermException;
        }

        return new SolarTermDate($year, DateTime::SOLAR_TERM_SEIMEI, $days[$year % 4]);
    }


    /**
     * 穀雨
     *
     * @param int $year
     * @return \JapaneseDate\Elements\SolarTermDate
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    public function kokuu(int $year): SolarTermDate
    {
        if ($year >= 1600 && $year <= 1607) {
            $days = [20, 20, 20, 21,];
        } elseif ($year >= 1608 && $year <= 1639) {
            $days = [20, 20, 20, 20,];
        } elseif ($year >= 1640 && $year <= 1671) {
            $days = [19, 20, 20, 20,];
        } elseif ($year >= 1672 && $year <= 1699) {
            $days = [19, 19, 20, 20,];
        } elseif ($year >= 1700 && $year <= 1703) {
            $days = [20, 20, 21, 21,];
        } elseif ($year >= 1704 && $year <= 1735) {
            $days = [20, 20, 20, 21,];
        } elseif ($year >= 1736 && $year <= 1767) {
            $days = [20, 20, 20, 20,];
        } elseif ($year >= 1768 && $year <= 1799) {
            $days = [19, 20, 20, 20,];
        } elseif ($year >= 1800 && $year <= 1827) {
            $days = [20, 20, 21, 21,];
        } elseif ($year >= 1828 && $year <= 1859) {
            $days = [20, 20, 20, 21,];
        } elseif ($year >= 1860 && $year <= 1895) {
            $days = [20, 20, 20, 20,];
        } elseif ($year >= 1896 && $year <= 1899) {
            $days = [19, 20, 20, 20,];
        } elseif ($year >= 1900 && $year <= 1923) {
            $days = [20, 21, 21, 21,];
        } elseif ($year >= 1924 && $year <= 1955) {
            $days = [20, 20, 21, 21,];
        } elseif ($year >= 1956 && $year <= 1983) {
            $days = [20, 20, 20, 21,];
        } elseif ($year >= 1984 && $year <= 2019) {
            $days = [20, 20, 20, 20,];
        } elseif ($year >= 2020 && $year <= 2051) {
            $days = [19, 20, 20, 20,];
        } elseif ($year >= 2052 && $year <= 2079) {
            $days = [19, 19, 20, 20,];
        } elseif ($year >= 2080 && $year <= 2099) {
            $days = [19, 19, 19, 20,];
        } elseif ($year >= 2100 && $year <= 2111) {
            $days = [20, 20, 20, 21,];
        } elseif ($year >= 2112 && $year <= 2147) {
            $days = [20, 20, 20, 20,];
        } elseif ($year >= 2148 && $year <= 2175) {
            $days = [19, 20, 20, 20,];
        } elseif ($year >= 2176 && $year <= 2199) {
            $days = [19, 19, 20, 20,];
        } elseif ($year >= 2200 && $year <= 2207) {
            $days = [20, 20, 21, 21,];
        } elseif ($year >= 2208 && $year <= 2239) {
            $days = [20, 20, 20, 21,];
        } elseif ($year >= 2240 && $year <= 2271) {
            $days = [20, 20, 20, 20,];
        } elseif ($year >= 2272 && $year <= 2299) {
            $days = [19, 20, 20, 20,];
        } elseif ($year >= 2300 && $year <= 2303) {
            $days = [20, 21, 21, 21,];
        } elseif ($year >= 2304 && $year <= 2331) {
            $days = [20, 20, 21, 21,];
        } elseif ($year >= 2332 && $year <= 2363) {
            $days = [20, 20, 20, 21,];
        } elseif ($year >= 2364 && $year <= 2399) {
            $days = [20, 20, 20, 20,];
        } else {
            throw new SolarTermException;
        }
        return new SolarTermDate($year, DateTime::SOLAR_TERM_KOKUU, $days[$year % 4]);
    }

    /**
     * 立夏
     *
     * @param int $year
     * @return \JapaneseDate\Elements\SolarTermDate
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    public function rikka(int $year): SolarTermDate
    {
        if ($year >= 1600 && $year <= 1607) {
            $days = [5, 6, 6, 6,];
        } elseif ($year >= 1608 && $year <= 1635) {
            $days = [5, 5, 6, 6,];
        } elseif ($year >= 1636 && $year <= 1667) {
            $days = [5, 5, 5, 6,];
        } elseif ($year >= 1668 && $year <= 1699) {
            $days = [5, 5, 5, 5,];
        } elseif ($year >= 1700 && $year <= 1731) {
            $days = [5, 6, 6, 6,];
        } elseif ($year >= 1732 && $year <= 1763) {
            $days = [5, 5, 6, 6,];
        } elseif ($year >= 1764 && $year <= 1791) {
            $days = [5, 5, 5, 6,];
        } elseif ($year >= 1792 && $year <= 1799) {
            $days = [5, 5, 5, 5,];
        } elseif ($year >= 1800 && $year <= 1823) {
            $days = [6, 6, 6, 6,];
        } elseif ($year >= 1824 && $year <= 1855) {
            $days = [5, 6, 6, 6,];
        } elseif ($year >= 1856 && $year <= 1883) {
            $days = [5, 5, 6, 6,];
        } elseif ($year >= 1884 && $year <= 1899) {
            $days = [5, 5, 5, 6,];
        } elseif ($year >= 1900 && $year <= 1915) {
            $days = [6, 6, 6, 7,];
        } elseif ($year >= 1916 && $year <= 1947) {
            $days = [6, 6, 6, 6,];
        } elseif ($year >= 1948 && $year <= 1979) {
            $days = [5, 6, 6, 6,];
        } elseif ($year >= 1980 && $year <= 2007) {
            $days = [5, 5, 6, 6,];
        } elseif ($year >= 2008 && $year <= 2039) {
            $days = [5, 5, 5, 6,];
        } elseif ($year >= 2040 && $year <= 2071) {
            $days = [5, 5, 5, 5,];
        } elseif ($year >= 2072 && $year <= 2099) {
            $days = [4, 5, 5, 5,];
        } elseif ($year >= 2100 && $year <= 2103) {
            $days = [5, 6, 6, 6,];
        } elseif ($year >= 2104 && $year <= 2131) {
            $days = [5, 5, 6, 6,];
        } elseif ($year >= 2132 && $year <= 2159) {
            $days = [5, 5, 5, 6,];
        } elseif ($year >= 2160 && $year <= 2195) {
            $days = [5, 5, 5, 5,];
        } elseif ($year >= 2196 && $year <= 2199) {
            $days = [4, 5, 5, 5,];
        } elseif ($year >= 2200 && $year <= 2227) {
            $days = [5, 6, 6, 6,];
        } elseif ($year >= 2228 && $year <= 2255) {
            $days = [5, 5, 6, 6,];
        } elseif ($year >= 2256 && $year <= 2287) {
            $days = [5, 5, 5, 6,];
        } elseif ($year >= 2288 && $year <= 2299) {
            $days = [5, 5, 5, 5,];
        } elseif ($year >= 2300 && $year <= 2319) {
            $days = [6, 6, 6, 6,];
        } elseif ($year >= 2320 && $year <= 2351) {
            $days = [5, 6, 6, 6,];
        } elseif ($year >= 2352 && $year <= 2379) {
            $days = [5, 5, 6, 6,];
        } elseif ($year >= 2380 && $year <= 2399) {
            $days = [5, 5, 5, 6,];
        } else {
            throw new SolarTermException;
        }
        return new SolarTermDate($year, DateTime::SOLAR_TERM_RIKKA, $days[$year % 4]);
    }

    /**
     * 小満
     *
     * @param int $year
     * @return \JapaneseDate\Elements\SolarTermDate
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    public function syouman(int $year): SolarTermDate
    {
        if ($year >= 1600 && $year <= 1615) {
            $days = [21, 21, 21, 22,];
        } elseif ($year >= 1616 && $year <= 1651) {
            $days = [21, 21, 21, 21,];
        } elseif ($year >= 1652 && $year <= 1679) {
            $days = [20, 21, 21, 21,];
        } elseif ($year >= 1680 && $year <= 1699) {
            $days = [20, 20, 21, 21,];
        } elseif ($year >= 1700 && $year <= 1707) {
            $days = [21, 21, 22, 22,];
        } elseif ($year >= 1708 && $year <= 1739) {
            $days = [21, 21, 21, 22,];
        } elseif ($year >= 1740 && $year <= 1771) {
            $days = [21, 21, 21, 21,];
        } elseif ($year >= 1772 && $year <= 1799) {
            $days = [20, 21, 21, 21,];
        } elseif ($year >= 1800 && $year <= 1831) {
            $days = [21, 21, 22, 22,];
        } elseif ($year >= 1832 && $year <= 1859) {
            $days = [21, 21, 21, 22,];
        } elseif ($year >= 1860 && $year <= 1891) {
            $days = [21, 21, 21, 21,];
        } elseif ($year >= 1892 && $year <= 1899) {
            $days = [20, 21, 21, 21,];
        } elseif ($year >= 1900 && $year <= 1923) {
            $days = [21, 22, 22, 22,];
        } elseif ($year >= 1924 && $year <= 1951) {
            $days = [21, 21, 22, 22,];
        } elseif ($year >= 1952 && $year <= 1983) {
            $days = [21, 21, 21, 22,];
        } elseif ($year >= 1984 && $year <= 2015) {
            $days = [21, 21, 21, 21,];
        } elseif ($year >= 2016 && $year <= 2043) {
            $days = [20, 21, 21, 21,];
        } elseif ($year >= 2044 && $year <= 2075) {
            $days = [20, 20, 21, 21,];
        } elseif ($year >= 2076 && $year <= 2099) {
            $days = [20, 20, 20, 21,];
        } elseif ($year >= 2100 && $year <= 2103) {
            $days = [21, 21, 21, 22,];
        } elseif ($year >= 2104 && $year <= 2135) {
            $days = [21, 21, 21, 21,];
        } elseif ($year >= 2136 && $year <= 2167) {
            $days = [20, 21, 21, 21,];
        } elseif ($year >= 2168 && $year <= 2195) {
            $days = [20, 20, 21, 21,];
        } elseif ($year >= 2196 && $year <= 2199) {
            $days = [20, 20, 20, 21,];
        } elseif ($year >= 2200 && $year <= 2223) {
            $days = [21, 21, 21, 22,];
        } elseif ($year >= 2224 && $year <= 2259) {
            $days = [21, 21, 21, 21,];
        } elseif ($year >= 2260 && $year <= 2287) {
            $days = [20, 21, 21, 21,];
        } elseif ($year >= 2288 && $year <= 2299) {
            $days = [20, 20, 21, 21,];
        } elseif ($year >= 2300 && $year <= 2315) {
            $days = [21, 21, 22, 22,];
        } elseif ($year >= 2316 && $year <= 2347) {
            $days = [21, 21, 21, 22,];
        } elseif ($year >= 2348 && $year <= 2379) {
            $days = [21, 21, 21, 21,];
        } elseif ($year >= 2380 && $year <= 2399) {
            $days = [20, 21, 21, 21,];
        } else {
            throw new SolarTermException;
        }
        return new SolarTermDate($year, DateTime::SOLAR_TERM_SYOUMAN, $days[$year % 4]);
    }

    /**
     * 芒種
     *
     * @param int $year
     * @return \JapaneseDate\Elements\SolarTermDate
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    public function bousyu(int $year): SolarTermDate
    {

        if ($year >= 1600 && $year <= 1611) {
            $days = [6, 6, 6, 6,];
        } elseif ($year >= 1612 && $year <= 1639) {
            $days = [5, 6, 6, 6,];
        } elseif ($year >= 1640 && $year <= 1667) {
            $days = [5, 5, 6, 6,];
        } elseif ($year >= 1668 && $year <= 1695) {
            $days = [5, 5, 5, 6,];
        } elseif ($year >= 1696 && $year <= 1699) {
            $days = [5, 5, 5, 5,];
        } elseif ($year >= 1700 && $year <= 1731) {
            $days = [6, 6, 6, 6,];
        } elseif ($year >= 1732 && $year <= 1759) {
            $days = [5, 6, 6, 6,];
        } elseif ($year >= 1760 && $year <= 1787) {
            $days = [5, 5, 6, 6,];
        } elseif ($year >= 1788 && $year <= 1799) {
            $days = [5, 5, 5, 6,];
        } elseif ($year >= 1800 && $year <= 1815) {
            $days = [6, 6, 6, 7,];
        } elseif ($year >= 1816 && $year <= 1851) {
            $days = [6, 6, 6, 6,];
        } elseif ($year >= 1852 && $year <= 1879) {
            $days = [5, 6, 6, 6,];
        } elseif ($year >= 1880 && $year <= 1899) {
            $days = [5, 5, 6, 6,];
        } elseif ($year >= 1900 && $year <= 1907) {
            $days = [6, 6, 7, 7,];
        } elseif ($year >= 1908 && $year <= 1935) {
            $days = [6, 6, 6, 7,];
        } elseif ($year >= 1936 && $year <= 1971) {
            $days = [6, 6, 6, 6,];
        } elseif ($year >= 1972 && $year <= 1999) {
            $days = [5, 6, 6, 6,];
        } elseif ($year >= 2000 && $year <= 2027) {
            $days = [5, 5, 6, 6,];
        } elseif ($year >= 2028 && $year <= 2059) {
            $days = [5, 5, 5, 6,];
        } elseif ($year >= 2060 && $year <= 2091) {
            $days = [5, 5, 5, 5,];
        } elseif ($year >= 2092 && $year <= 2099) {
            $days = [4, 5, 5, 5,];
        } elseif ($year >= 2100 && $year <= 2119) {
            $days = [5, 6, 6, 6,];
        } elseif ($year >= 2120 && $year <= 2147) {
            $days = [5, 5, 6, 6,];
        } elseif ($year >= 2148 && $year <= 2179) {
            $days = [5, 5, 5, 6,];
        } elseif ($year >= 2180 && $year <= 2199) {
            $days = [5, 5, 5, 5,];
        } elseif ($year >= 2200 && $year <= 2211) {
            $days = [6, 6, 6, 6,];
        } elseif ($year >= 2212 && $year <= 2239) {
            $days = [5, 6, 6, 6,];
        } elseif ($year >= 2240 && $year <= 2267) {
            $days = [5, 5, 6, 6,];
        } elseif ($year >= 2268 && $year <= 2299) {
            $days = [5, 5, 5, 6,];
        } elseif ($year >= 2300 && $year <= 2331) {
            $days = [6, 6, 6, 6,];
        } elseif ($year >= 2332 && $year <= 2359) {
            $days = [5, 6, 6, 6,];
        } elseif ($year >= 2360 && $year <= 2391) {
            $days = [5, 5, 6, 6,];
        } elseif ($year >= 2392 && $year <= 2399) {
            $days = [5, 5, 5, 6,];
        } else {
            throw new SolarTermException;
        }
        return new SolarTermDate($year, DateTime::SOLAR_TERM_BOUSYU, $days[$year % 4]);
    }

    /**
     * 夏至
     *
     * @param int $year
     * @return \JapaneseDate\Elements\SolarTermDate
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    public function geshi(int $year): SolarTermDate
    {

        if ($year >= 1600 && $year <= 1603) {
            $days = [21, 22, 22, 22,];
        } elseif ($year >= 1604 && $year <= 1635) {
            $days = [21, 21, 22, 22,];
        } elseif ($year >= 1636 && $year <= 1663) {
            $days = [21, 21, 21, 22,];
        } elseif ($year >= 1664 && $year <= 1695) {
            $days = [21, 21, 21, 21,];
        } elseif ($year >= 1696 && $year <= 1699) {
            $days = [20, 21, 21, 21,];
        } elseif ($year >= 1700 && $year <= 1723) {
            $days = [21, 22, 22, 22,];
        } elseif ($year >= 1724 && $year <= 1755) {
            $days = [21, 21, 22, 22,];
        } elseif ($year >= 1756 && $year <= 1783) {
            $days = [21, 21, 21, 22,];
        } elseif ($year >= 1784 && $year <= 1799) {
            $days = [21, 21, 21, 21,];
        } elseif ($year >= 1800 && $year <= 1815) {
            $days = [22, 22, 22, 22,];
        } elseif ($year >= 1816 && $year <= 1843) {
            $days = [21, 22, 22, 22,];
        } elseif ($year >= 1844 && $year <= 1875) {
            $days = [21, 21, 22, 22,];
        } elseif ($year >= 1876 && $year <= 1899) {
            $days = [21, 21, 21, 22,];
        } elseif ($year >= 1900 && $year <= 1903) {
            $days = [22, 22, 22, 23,];
        } elseif ($year >= 1904 && $year <= 1935) {
            $days = [22, 22, 22, 22,];
        } elseif ($year >= 1936 && $year <= 1963) {
            $days = [21, 22, 22, 22,];
        } elseif ($year >= 1964 && $year <= 1991) {
            $days = [21, 21, 22, 22,];
        } elseif ($year >= 1992 && $year <= 2019) {
            $days = [21, 21, 21, 22,];
        } elseif ($year >= 2020 && $year <= 2055) {
            $days = [21, 21, 21, 21,];
        } elseif ($year >= 2056 && $year <= 2083) {
            $days = [20, 21, 21, 21,];
        } elseif ($year >= 2084 && $year <= 2099) {
            $days = [20, 20, 21, 21,];
        } elseif ($year >= 2100 && $year <= 2111) {
            $days = [21, 21, 22, 22,];
        } elseif ($year >= 2112 && $year <= 2139) {
            $days = [21, 21, 21, 22,];
        } elseif ($year >= 2140 && $year <= 2175) {
            $days = [21, 21, 21, 21,];
        } elseif ($year >= 2176 && $year <= 2199) {
            $days = [20, 21, 21, 21,];
        } elseif ($year >= 2200 && $year <= 2203) {
            $days = [21, 22, 22, 22,];
        } elseif ($year >= 2204 && $year <= 2231) {
            $days = [21, 21, 22, 22,];
        } elseif ($year >= 2232 && $year <= 2259) {
            $days = [21, 21, 21, 22,];
        } elseif ($year >= 2260 && $year <= 2291) {
            $days = [21, 21, 21, 21,];
        } elseif ($year >= 2292 && $year <= 2299) {
            $days = [20, 21, 21, 21,];
        } elseif ($year >= 2300 && $year <= 2319) {
            $days = [21, 22, 22, 22,];
        } elseif ($year >= 2320 && $year <= 2351) {
            $days = [21, 21, 22, 22,];
        } elseif ($year >= 2352 && $year <= 2379) {
            $days = [21, 21, 21, 22,];
        } elseif ($year >= 2380 && $year <= 2399) {
            $days = [21, 21, 21, 21,];
        } else {
            throw new SolarTermException;
        }
        return new SolarTermDate($year, DateTime::SOLAR_TERM_GESHI, $days[$year % 4]);
    }

    /**
     * 小暑
     *
     * @param int $year
     * @return \JapaneseDate\Elements\SolarTermDate
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    public function syousyo(int $year): SolarTermDate
    {
        if ($year >= 1600 && $year <= 1603) {
            $days = [7, 7, 8, 8,];
        } elseif ($year >= 1604 && $year <= 1631) {
            $days = [7, 7, 7, 8,];
        } elseif ($year >= 1632 && $year <= 1663) {
            $days = [7, 7, 7, 7,];
        } elseif ($year >= 1664 && $year <= 1691) {
            $days = [6, 7, 7, 7,];
        } elseif ($year >= 1692 && $year <= 1699) {
            $days = [6, 6, 7, 7,];
        } elseif ($year >= 1700 && $year <= 1723) {
            $days = [7, 7, 8, 8,];
        } elseif ($year >= 1724 && $year <= 1751) {
            $days = [7, 7, 7, 8,];
        } elseif ($year >= 1752 && $year <= 1783) {
            $days = [7, 7, 7, 7,];
        } elseif ($year >= 1784 && $year <= 1799) {
            $days = [6, 7, 7, 7,];
        } elseif ($year >= 1800 && $year <= 1811) {
            $days = [7, 8, 8, 8,];
        } elseif ($year >= 1812 && $year <= 1839) {
            $days = [7, 7, 8, 8,];
        } elseif ($year >= 1840 && $year <= 1871) {
            $days = [7, 7, 7, 8,];
        } elseif ($year >= 1872 && $year <= 1899) {
            $days = [7, 7, 7, 7,];
        } elseif ($year >= 1900 && $year <= 1903) {
            $days = [8, 8, 8, 8,];
        } elseif ($year >= 1904 && $year <= 1931) {
            $days = [7, 8, 8, 8,];
        } elseif ($year >= 1932 && $year <= 1959) {
            $days = [7, 7, 8, 8,];
        } elseif ($year >= 1960 && $year <= 1987) {
            $days = [7, 7, 7, 8,];
        } elseif ($year >= 1988 && $year <= 2023) {
            $days = [7, 7, 7, 7,];
        } elseif ($year >= 2024 && $year <= 2051) {
            $days = [6, 7, 7, 7,];
        } elseif ($year >= 2052 && $year <= 2079) {
            $days = [6, 6, 7, 7,];
        } elseif ($year >= 2080 && $year <= 2099) {
            $days = [6, 6, 6, 7,];
        } elseif ($year >= 2100 && $year <= 2107) {
            $days = [7, 7, 7, 8,];
        } elseif ($year >= 2108 && $year <= 2139) {
            $days = [7, 7, 7, 7,];
        } elseif ($year >= 2140 && $year <= 2171) {
            $days = [6, 7, 7, 7,];
        } elseif ($year >= 2172 && $year <= 2195) {
            $days = [6, 6, 7, 7,];
        } elseif ($year >= 2196 && $year <= 2199) {
            $days = [6, 6, 6, 7,];
        } elseif ($year >= 2200 && $year <= 2227) {
            $days = [7, 7, 7, 8,];
        } elseif ($year >= 2228 && $year <= 2259) {
            $days = [7, 7, 7, 7,];
        } elseif ($year >= 2260 && $year <= 2287) {
            $days = [6, 7, 7, 7,];
        } elseif ($year >= 2288 && $year <= 2299) {
            $days = [6, 6, 7, 7,];
        } elseif ($year >= 2300 && $year <= 2315) {
            $days = [7, 7, 8, 8,];
        } elseif ($year >= 2316 && $year <= 2343) {
            $days = [7, 7, 7, 8,];
        } elseif ($year >= 2344 && $year <= 2379) {
            $days = [7, 7, 7, 7,];
        } elseif ($year >= 2380 && $year <= 2399) {
            $days = [6, 7, 7, 7,];
        } else {
            throw new SolarTermException;
        }
        return new SolarTermDate($year, DateTime::SOLAR_TERM_SYOUSYO, $days[$year % 4]);
    }

    /**
     * 大暑
     *
     * @param int $year
     * @return \JapaneseDate\Elements\SolarTermDate
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    public function taisyo(int $year): SolarTermDate
    {
        if ($year >= 1600 && $year <= 1631) {
            $days = [23, 23, 23, 23,];
        } elseif ($year >= 1632 && $year <= 1659) {
            $days = [22, 23, 23, 23,];
        } elseif ($year >= 1660 && $year <= 1687) {
            $days = [22, 22, 23, 23,];
        } elseif ($year >= 1688 && $year <= 1699) {
            $days = [22, 22, 22, 23,];
        } elseif ($year >= 1700 && $year <= 1719) {
            $days = [23, 23, 23, 24,];
        } elseif ($year >= 1720 && $year <= 1751) {
            $days = [23, 23, 23, 23,];
        } elseif ($year >= 1752 && $year <= 1779) {
            $days = [22, 23, 23, 23,];
        } elseif ($year >= 1780 && $year <= 1799) {
            $days = [22, 22, 23, 23,];
        } elseif ($year >= 1800 && $year <= 1807) {
            $days = [23, 23, 24, 24,];
        } elseif ($year >= 1808 && $year <= 1835) {
            $days = [23, 23, 23, 24,];
        } elseif ($year >= 1836 && $year <= 1871) {
            $days = [23, 23, 23, 23,];
        } elseif ($year >= 1872 && $year <= 1899) {
            $days = [22, 23, 23, 23,];
        } elseif ($year >= 1900 && $year <= 1927) {
            $days = [23, 23, 24, 24,];
        } elseif ($year >= 1928 && $year <= 1955) {
            $days = [23, 23, 23, 24,];
        } elseif ($year >= 1956 && $year <= 1987) {
            $days = [23, 23, 23, 23,];
        } elseif ($year >= 1988 && $year <= 2019) {
            $days = [22, 23, 23, 23,];
        } elseif ($year >= 2020 && $year <= 2047) {
            $days = [22, 22, 23, 23,];
        } elseif ($year >= 2048 && $year <= 2075) {
            $days = [22, 22, 22, 23,];
        } elseif ($year >= 2076 && $year <= 2099) {
            $days = [22, 22, 22, 22,];
        } elseif ($year >= 2100 && $year <= 2107) {
            $days = [23, 23, 23, 23,];
        } elseif ($year >= 2108 && $year <= 2135) {
            $days = [22, 23, 23, 23,];
        } elseif ($year >= 2136 && $year <= 2163) {
            $days = [22, 22, 23, 23,];
        } elseif ($year >= 2164 && $year <= 2195) {
            $days = [22, 22, 22, 23,];
        } elseif ($year >= 2196 && $year <= 2199) {
            $days = [22, 22, 22, 22,];
        } elseif ($year >= 2200 && $year <= 2227) {
            $days = [23, 23, 23, 23,];
        } elseif ($year >= 2228 && $year <= 2255) {
            $days = [22, 23, 23, 23,];
        } elseif ($year >= 2256 && $year <= 2283) {
            $days = [22, 22, 23, 23,];
        } elseif ($year >= 2284 && $year <= 2299) {
            $days = [22, 22, 22, 23,];
        } elseif ($year >= 2300 && $year <= 2315) {
            $days = [23, 23, 23, 24,];
        } elseif ($year >= 2316 && $year <= 2343) {
            $days = [23, 23, 23, 23,];
        } elseif ($year >= 2344 && $year <= 2375) {
            $days = [22, 23, 23, 23,];
        } elseif ($year >= 2376 && $year <= 2399) {
            $days = [22, 22, 23, 23,];
        } else {
            throw new SolarTermException;
        }
        return new SolarTermDate($year, DateTime::SOLAR_TERM_TAISYO, $days[$year % 4]);
    }

    /**
     * 立秋
     *
     * @param int $year
     * @return \JapaneseDate\Elements\SolarTermDate
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    public function rissyuu(int $year): SolarTermDate
    {
        if ($year >= 1600 && $year <= 1619) {
            $days = [7, 8, 8, 8,];
        } elseif ($year >= 1620 && $year <= 1647) {
            $days = [7, 7, 8, 8,];
        } elseif ($year >= 1648 && $year <= 1675) {
            $days = [7, 7, 7, 8,];
        } elseif ($year >= 1676 && $year <= 1699) {
            $days = [7, 7, 7, 7,];
        } elseif ($year >= 1700 && $year <= 1711) {
            $days = [8, 8, 8, 8,];
        } elseif ($year >= 1712 && $year <= 1739) {
            $days = [7, 8, 8, 8,];
        } elseif ($year >= 1740 && $year <= 1767) {
            $days = [7, 7, 8, 8,];
        } elseif ($year >= 1768 && $year <= 1799) {
            $days = [7, 7, 7, 8,];
        } elseif ($year >= 1800 && $year <= 1831) {
            $days = [8, 8, 8, 8,];
        } elseif ($year >= 1832 && $year <= 1859) {
            $days = [7, 8, 8, 8,];
        } elseif ($year >= 1860 && $year <= 1891) {
            $days = [7, 7, 8, 8,];
        } elseif ($year >= 1892 && $year <= 1899) {
            $days = [7, 7, 7, 8,];
        } elseif ($year >= 1900 && $year <= 1915) {
            $days = [8, 8, 8, 9,];
        } elseif ($year >= 1916 && $year <= 1951) {
            $days = [8, 8, 8, 8,];
        } elseif ($year >= 1952 && $year <= 1979) {
            $days = [7, 8, 8, 8,];
        } elseif ($year >= 1980 && $year <= 2007) {
            $days = [7, 7, 8, 8,];
        } elseif ($year >= 2008 && $year <= 2039) {
            $days = [7, 7, 7, 8,];
        } elseif ($year >= 2040 && $year <= 2071) {
            $days = [7, 7, 7, 7,];
        } elseif ($year >= 2072 && $year <= 2099) {
            $days = [6, 7, 7, 7,];
        } elseif ($year >= 2100 && $year <= 2127) {
            $days = [7, 7, 8, 8,];
        } elseif ($year >= 2128 && $year <= 2159) {
            $days = [7, 7, 7, 8,];
        } elseif ($year >= 2160 && $year <= 2191) {
            $days = [7, 7, 7, 7,];
        } elseif ($year >= 2192 && $year <= 2199) {
            $days = [6, 7, 7, 7,];
        } elseif ($year >= 2200 && $year <= 2219) {
            $days = [7, 8, 8, 8,];
        } elseif ($year >= 2220 && $year <= 2247) {
            $days = [7, 7, 8, 8,];
        } elseif ($year >= 2248 && $year <= 2279) {
            $days = [7, 7, 7, 8,];
        } elseif ($year >= 2280 && $year <= 2299) {
            $days = [7, 7, 7, 7,];
        } elseif ($year >= 2300 && $year <= 2307) {
            $days = [8, 8, 8, 8,];
        } elseif ($year >= 2308 && $year <= 2339) {
            $days = [7, 8, 8, 8,];
        } elseif ($year >= 2340 && $year <= 2367) {
            $days = [7, 7, 8, 8,];
        } elseif ($year >= 2368 && $year <= 2395) {
            $days = [7, 7, 7, 8,];
        } elseif ($year >= 2396 && $year <= 2399) {
            $days = [7, 7, 7, 7,];
        } else {
            throw new SolarTermException;
        }
        return new SolarTermDate($year, DateTime::SOLAR_TERM_RISSYUU, $days[$year % 4]);
    }

    /**
     * 処暑
     *
     * @param int $year
     * @return \JapaneseDate\Elements\SolarTermDate
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    public function syosyo(int $year): SolarTermDate
    {

        if ($year >= 1600 && $year <= 1627) {
            $days = [23, 23, 23, 24,];
        } elseif ($year >= 1628 && $year <= 1659) {
            $days = [23, 23, 23, 23,];
        } elseif ($year >= 1660 && $year <= 1687) {
            $days = [22, 23, 23, 23,];
        } elseif ($year >= 1688 && $year <= 1699) {
            $days = [22, 22, 23, 23,];
        } elseif ($year >= 1700 && $year <= 1719) {
            $days = [23, 23, 24, 24,];
        } elseif ($year >= 1720 && $year <= 1747) {
            $days = [23, 23, 23, 24,];
        } elseif ($year >= 1748 && $year <= 1783) {
            $days = [23, 23, 23, 23,];
        } elseif ($year >= 1784 && $year <= 1799) {
            $days = [22, 23, 23, 23,];
        } elseif ($year >= 1800 && $year <= 1811) {
            $days = [23, 24, 24, 24,];
        } elseif ($year >= 1812 && $year <= 1839) {
            $days = [23, 23, 24, 24,];
        } elseif ($year >= 1840 && $year <= 1871) {
            $days = [23, 23, 23, 24,];
        } elseif ($year >= 1872 && $year <= 1899) {
            $days = [23, 23, 23, 23,];
        } elseif ($year >= 1900 && $year <= 1903) {
            $days = [24, 24, 24, 24,];
        } elseif ($year >= 1904 && $year <= 1931) {
            $days = [23, 24, 24, 24,];
        } elseif ($year >= 1932 && $year <= 1963) {
            $days = [23, 23, 24, 24,];
        } elseif ($year >= 1964 && $year <= 1991) {
            $days = [23, 23, 23, 24,];
        } elseif ($year >= 1992 && $year <= 2023) {
            $days = [23, 23, 23, 23,];
        } elseif ($year >= 2024 && $year <= 2055) {
            $days = [22, 23, 23, 23,];
        } elseif ($year >= 2056 && $year <= 2083) {
            $days = [22, 22, 23, 23,];
        } elseif ($year >= 2084 && $year <= 2099) {
            $days = [22, 22, 22, 23,];
        } elseif ($year >= 2100 && $year <= 2111) {
            $days = [23, 23, 23, 24,];
        } elseif ($year >= 2112 && $year <= 2147) {
            $days = [23, 23, 23, 23,];
        } elseif ($year >= 2148 && $year <= 2175) {
            $days = [22, 23, 23, 23,];
        } elseif ($year >= 2176 && $year <= 2199) {
            $days = [22, 22, 23, 23,];
        } elseif ($year >= 2200 && $year <= 2203) {
            $days = [23, 23, 24, 24,];
        } elseif ($year >= 2204 && $year <= 2231) {
            $days = [23, 23, 23, 24,];
        } elseif ($year >= 2232 && $year <= 2267) {
            $days = [23, 23, 23, 23,];
        } elseif ($year >= 2268 && $year <= 2295) {
            $days = [22, 23, 23, 23,];
        } elseif ($year >= 2296 && $year <= 2299) {
            $days = [22, 22, 23, 23,];
        } elseif ($year >= 2300 && $year <= 2323) {
            $days = [23, 23, 24, 24,];
        } elseif ($year >= 2324 && $year <= 2355) {
            $days = [23, 23, 23, 24,];
        } elseif ($year >= 2356 && $year <= 2383) {
            $days = [23, 23, 23, 23,];
        } elseif ($year >= 2384 && $year <= 2399) {
            $days = [22, 23, 23, 23,];
        } else {
            throw new SolarTermException;
        }
        return new SolarTermDate($year, DateTime::SOLAR_TERM_SYOSYO, $days[$year % 4]);
    }

    /**
     * 白露
     *
     * @param int $year
     * @return \JapaneseDate\Elements\SolarTermDate
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    public function hakuro(int $year): SolarTermDate
    {
        if ($year >= 1600 && $year <= 1623) {
            $days = [7, 8, 8, 8,];
        } elseif ($year >= 1624 && $year <= 1651) {
            $days = [7, 7, 8, 8,];
        } elseif ($year >= 1652 && $year <= 1683) {
            $days = [7, 7, 7, 8,];
        } elseif ($year >= 1684 && $year <= 1699) {
            $days = [7, 7, 7, 7,];
        } elseif ($year >= 1700 && $year <= 1715) {
            $days = [8, 8, 8, 8,];
        } elseif ($year >= 1716 && $year <= 1747) {
            $days = [7, 8, 8, 8,];
        } elseif ($year >= 1748 && $year <= 1779) {
            $days = [7, 7, 8, 8,];
        } elseif ($year >= 1780 && $year <= 1799) {
            $days = [7, 7, 7, 8,];
        } elseif ($year >= 1800 && $year <= 1807) {
            $days = [8, 8, 8, 9,];
        } elseif ($year >= 1808 && $year <= 1839) {
            $days = [8, 8, 8, 8,];
        } elseif ($year >= 1840 && $year <= 1871) {
            $days = [7, 8, 8, 8,];
        } elseif ($year >= 1872 && $year <= 1899) {
            $days = [7, 7, 8, 8,];
        } elseif ($year >= 1900 && $year <= 1931) {
            $days = [8, 8, 8, 9,];
        } elseif ($year >= 1932 && $year <= 1963) {
            $days = [8, 8, 8, 8,];
        } elseif ($year >= 1964 && $year <= 1995) {
            $days = [7, 8, 8, 8,];
        } elseif ($year >= 1996 && $year <= 2023) {
            $days = [7, 7, 8, 8,];
        } elseif ($year >= 2024 && $year <= 2055) {
            $days = [7, 7, 7, 8,];
        } elseif ($year >= 2056 && $year <= 2087) {
            $days = [7, 7, 7, 7,];
        } elseif ($year >= 2088 && $year <= 2099) {
            $days = [6, 7, 7, 7,];
        } elseif ($year >= 2100 && $year <= 2115) {
            $days = [7, 8, 8, 8,];
        } elseif ($year >= 2116 && $year <= 2147) {
            $days = [7, 7, 8, 8,];
        } elseif ($year >= 2148 && $year <= 2175) {
            $days = [7, 7, 7, 8,];
        } elseif ($year >= 2176 && $year <= 2199) {
            $days = [7, 7, 7, 7,];
        } elseif ($year >= 2200 && $year <= 2211) {
            $days = [8, 8, 8, 8,];
        } elseif ($year >= 2212 && $year <= 2239) {
            $days = [7, 8, 8, 8,];
        } elseif ($year >= 2240 && $year <= 2267) {
            $days = [7, 7, 8, 8,];
        } elseif ($year >= 2268 && $year <= 2299) {
            $days = [7, 7, 7, 8,];
        } elseif ($year >= 2300 && $year <= 2331) {
            $days = [8, 8, 8, 8,];
        } elseif ($year >= 2332 && $year <= 2359) {
            $days = [7, 8, 8, 8,];
        } elseif ($year >= 2360 && $year <= 2391) {
            $days = [7, 7, 8, 8,];
        } elseif ($year >= 2392 && $year <= 2399) {
            $days = [7, 7, 7, 8,];
        } else {
            throw new SolarTermException;
        }
        return new SolarTermDate($year, DateTime::SOLAR_TERM_HAKURO, $days[$year % 4]);
    }

    /**
     * 秋分
     *
     * @param int $year
     * @return \JapaneseDate\Elements\SolarTermDate
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    public function syuubun(int $year): SolarTermDate
    {
        if ($year >= 1600 && $year <= 1635) {
            $days = [23, 23, 23, 23,];
        } elseif ($year >= 1636 && $year <= 1667) {
            $days = [22, 23, 23, 23,];
        } elseif ($year >= 1668 && $year <= 1695) {
            $days = [22, 22, 23, 23,];
        } elseif ($year >= 1696 && $year <= 1699) {
            $days = [22, 22, 22, 23,];
        } elseif ($year >= 1700 && $year <= 1727) {
            $days = [23, 23, 23, 24,];
        } elseif ($year >= 1728 && $year <= 1763) {
            $days = [23, 23, 23, 23,];
        } elseif ($year >= 1764 && $year <= 1791) {
            $days = [22, 23, 23, 23,];
        } elseif ($year >= 1792 && $year <= 1799) {
            $days = [22, 22, 23, 23,];
        } elseif ($year >= 1800 && $year <= 1823) {
            $days = [23, 23, 24, 24,];
        } elseif ($year >= 1824 && $year <= 1851) {
            $days = [23, 23, 23, 24,];
        } elseif ($year >= 1852 && $year <= 1887) {
            $days = [23, 23, 23, 23,];
        } elseif ($year >= 1888 && $year <= 1899) {
            $days = [22, 23, 23, 23,];
        } elseif ($year >= 1900 && $year <= 1919) {
            $days = [23, 24, 24, 24,];
        } elseif ($year >= 1920 && $year <= 1947) {
            $days = [23, 23, 24, 24,];
        } elseif ($year >= 1948 && $year <= 1979) {
            $days = [23, 23, 23, 24,];
        } elseif ($year >= 1980 && $year <= 2011) {
            $days = [23, 23, 23, 23,];
        } elseif ($year >= 2012 && $year <= 2043) {
            $days = [22, 23, 23, 23,];
        } elseif ($year >= 2044 && $year <= 2075) {
            $days = [22, 22, 23, 23,];
        } elseif ($year >= 2076 && $year <= 2099) {
            $days = [22, 22, 22, 23,];
        } elseif ($year >= 2100 && $year <= 2103) {
            $days = [23, 23, 23, 24,];
        } elseif ($year >= 2104 && $year <= 2139) {
            $days = [23, 23, 23, 23,];
        } elseif ($year >= 2140 && $year <= 2167) {
            $days = [22, 23, 23, 23,];
        } elseif ($year >= 2168 && $year <= 2199) {
            $days = [22, 22, 23, 23,];
        } elseif ($year >= 2200 && $year <= 2227) {
            $days = [23, 23, 23, 24,];
        } elseif ($year >= 2228 && $year <= 2263) {
            $days = [23, 23, 23, 23,];
        } elseif ($year >= 2264 && $year <= 2291) {
            $days = [22, 23, 23, 23,];
        } elseif ($year >= 2292 && $year <= 2299) {
            $days = [22, 22, 23, 23,];
        } elseif ($year >= 2300 && $year <= 2323) {
            $days = [23, 23, 24, 24,];
        } elseif ($year >= 2324 && $year <= 2351) {
            $days = [23, 23, 23, 24,];
        } elseif ($year >= 2352 && $year <= 2383) {
            $days = [23, 23, 23, 23,];
        } elseif ($year >= 2384 && $year <= 2399) {
            $days = [22, 23, 23, 23,];
        } else {
            throw new SolarTermException;
        }
        return new SolarTermDate($year, DateTime::SOLAR_TERM_SYUUBUN, $days[$year % 4]);
    }

    /**
     * 寒露
     *
     * @param int $year
     * @return \JapaneseDate\Elements\SolarTermDate
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    public function kanro(int $year): SolarTermDate
    {

        if ($year >= 1600 && $year <= 1627) {
            $days = [8, 8, 8, 9,];
        } elseif ($year >= 1628 && $year <= 1659) {
            $days = [8, 8, 8, 8,];
        } elseif ($year >= 1660 && $year <= 1691) {
            $days = [7, 8, 8, 8,];
        } elseif ($year >= 1692 && $year <= 1699) {
            $days = [7, 7, 8, 8,];
        } elseif ($year >= 1700 && $year <= 1723) {
            $days = [8, 8, 9, 9,];
        } elseif ($year >= 1724 && $year <= 1755) {
            $days = [8, 8, 8, 9,];
        } elseif ($year >= 1756 && $year <= 1791) {
            $days = [8, 8, 8, 8,];
        } elseif ($year >= 1792 && $year <= 1799) {
            $days = [7, 8, 8, 8,];
        } elseif ($year >= 1800 && $year <= 1823) {
            $days = [8, 9, 9, 9,];
        } elseif ($year >= 1824 && $year <= 1851) {
            $days = [8, 8, 9, 9,];
        } elseif ($year >= 1852 && $year <= 1883) {
            $days = [8, 8, 8, 9,];
        } elseif ($year >= 1884 && $year <= 1899) {
            $days = [8, 8, 8, 8,];
        } elseif ($year >= 1900 && $year <= 1919) {
            $days = [9, 9, 9, 9,];
        } elseif ($year >= 1920 && $year <= 1951) {
            $days = [8, 9, 9, 9,];
        } elseif ($year >= 1952 && $year <= 1983) {
            $days = [8, 8, 9, 9,];
        } elseif ($year >= 1984 && $year <= 2011) {
            $days = [8, 8, 8, 9,];
        } elseif ($year >= 2012 && $year <= 2047) {
            $days = [8, 8, 8, 8,];
        } elseif ($year >= 2048 && $year <= 2079) {
            $days = [7, 8, 8, 8,];
        } elseif ($year >= 2080 && $year <= 2099) {
            $days = [7, 7, 8, 8,];
        } elseif ($year >= 2100 && $year <= 2107) {
            $days = [8, 8, 9, 9,];
        } elseif ($year >= 2108 && $year <= 2139) {
            $days = [8, 8, 8, 9,];
        } elseif ($year >= 2140 && $year <= 2175) {
            $days = [8, 8, 8, 8,];
        } elseif ($year >= 2176 && $year <= 2199) {
            $days = [7, 8, 8, 8,];
        } elseif ($year >= 2200 && $year <= 2203) {
            $days = [8, 9, 9, 9,];
        } elseif ($year >= 2204 && $year <= 2235) {
            $days = [8, 8, 9, 9,];
        } elseif ($year >= 2236 && $year <= 2267) {
            $days = [8, 8, 8, 9,];
        } elseif ($year >= 2268 && $year <= 2299) {
            $days = [8, 8, 8, 8,];
        } elseif ($year >= 2300 && $year <= 2331) {
            $days = [8, 9, 9, 9,];
        } elseif ($year >= 2332 && $year <= 2359) {
            $days = [8, 8, 9, 9,];
        } elseif ($year >= 2360 && $year <= 2391) {
            $days = [8, 8, 8, 9,];
        } elseif ($year >= 2392 && $year <= 2399) {
            $days = [8, 8, 8, 8,];
        } else {
            throw new SolarTermException;
        }
        return new SolarTermDate($year, DateTime::SOLAR_TERM_KANRO, $days[$year % 4]);
    }

    /**
     * 霜降
     *
     * @param int $year
     * @return \JapaneseDate\Elements\SolarTermDate
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    public function soukou(int $year): SolarTermDate
    {

        if ($year >= 1600 && $year <= 1603) {
            $days = [23, 23, 24, 24,];
        } elseif ($year >= 1604 && $year <= 1635) {
            $days = [23, 23, 23, 24,];
        } elseif ($year >= 1636 && $year <= 1671) {
            $days = [23, 23, 23, 23,];
        } elseif ($year >= 1672 && $year <= 1699) {
            $days = [22, 23, 23, 23,];
        } elseif ($year >= 1700 && $year <= 1703) {
            $days = [23, 24, 24, 24,];
        } elseif ($year >= 1704 && $year <= 1735) {
            $days = [23, 23, 24, 24,];
        } elseif ($year >= 1736 && $year <= 1767) {
            $days = [23, 23, 23, 24,];
        } elseif ($year >= 1768 && $year <= 1799) {
            $days = [23, 23, 23, 23,];
        } elseif ($year >= 1800 && $year <= 1803) {
            $days = [24, 24, 24, 24,];
        } elseif ($year >= 1804 && $year <= 1835) {
            $days = [23, 24, 24, 24,];
        } elseif ($year >= 1836 && $year <= 1867) {
            $days = [23, 23, 24, 24,];
        } elseif ($year >= 1868 && $year <= 1899) {
            $days = [23, 23, 23, 24,];
        } elseif ($year >= 1900 && $year <= 1935) {
            $days = [24, 24, 24, 24,];
        } elseif ($year >= 1936 && $year <= 1967) {
            $days = [23, 24, 24, 24,];
        } elseif ($year >= 1968 && $year <= 1995) {
            $days = [23, 23, 24, 24,];
        } elseif ($year >= 1996 && $year <= 2027) {
            $days = [23, 23, 23, 24,];
        } elseif ($year >= 2028 && $year <= 2063) {
            $days = [23, 23, 23, 23,];
        } elseif ($year >= 2064 && $year <= 2095) {
            $days = [22, 23, 23, 23,];
        } elseif ($year >= 2096 && $year <= 2099) {
            $days = [22, 22, 23, 23,];
        } elseif ($year >= 2100 && $year <= 2127) {
            $days = [23, 23, 24, 24,];
        } elseif ($year >= 2128 && $year <= 2155) {
            $days = [23, 23, 23, 24,];
        } elseif ($year >= 2156 && $year <= 2191) {
            $days = [23, 23, 23, 23,];
        } elseif ($year >= 2192 && $year <= 2199) {
            $days = [22, 23, 23, 23,];
        } elseif ($year >= 2200 && $year <= 2223) {
            $days = [23, 24, 24, 24,];
        } elseif ($year >= 2224 && $year <= 2255) {
            $days = [23, 23, 24, 24,];
        } elseif ($year >= 2256 && $year <= 2287) {
            $days = [23, 23, 23, 24,];
        } elseif ($year >= 2288 && $year <= 2299) {
            $days = [23, 23, 23, 23,];
        } elseif ($year >= 2300 && $year <= 2323) {
            $days = [24, 24, 24, 24,];
        } elseif ($year >= 2324 && $year <= 2355) {
            $days = [23, 24, 24, 24,];
        } elseif ($year >= 2356 && $year <= 2383) {
            $days = [23, 23, 24, 24,];
        } elseif ($year >= 2384 && $year <= 2399) {
            $days = [23, 23, 23, 24,];
        } else {
            throw new SolarTermException;
        }
        return new SolarTermDate($year, DateTime::SOLAR_TERM_SOUKOU, $days[$year % 4]);
    }

    /**
     * 立冬
     *
     * @param int $year
     * @return \JapaneseDate\Elements\SolarTermDate
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    public function rittou(int $year): SolarTermDate
    {

        if ($year >= 1600 && $year <= 1631) {
            $days = [7, 7, 7, 8,];
        } elseif ($year >= 1632 && $year <= 1667) {
            $days = [7, 7, 7, 7,];
        } elseif ($year >= 1668 && $year <= 1699) {
            $days = [6, 7, 7, 7,];
        } elseif ($year >= 1700 && $year <= 1731) {
            $days = [7, 7, 8, 8,];
        } elseif ($year >= 1732 && $year <= 1763) {
            $days = [7, 7, 7, 8,];
        } elseif ($year >= 1764 && $year <= 1799) {
            $days = [7, 7, 7, 7,];
        } elseif ($year >= 1800 && $year <= 1831) {
            $days = [7, 8, 8, 8,];
        } elseif ($year >= 1832 && $year <= 1863) {
            $days = [7, 7, 8, 8,];
        } elseif ($year >= 1864 && $year <= 1895) {
            $days = [7, 7, 7, 8,];
        } elseif ($year >= 1896 && $year <= 1899) {
            $days = [7, 7, 7, 7,];
        } elseif ($year >= 1900 && $year <= 1931) {
            $days = [8, 8, 8, 8,];
        } elseif ($year >= 1932 && $year <= 1967) {
            $days = [7, 8, 8, 8,];
        } elseif ($year >= 1968 && $year <= 1999) {
            $days = [7, 7, 8, 8,];
        } elseif ($year >= 2000 && $year <= 2031) {
            $days = [7, 7, 7, 8,];
        } elseif ($year >= 2032 && $year <= 2067) {
            $days = [7, 7, 7, 7,];
        } elseif ($year >= 2068 && $year <= 2099) {
            $days = [6, 7, 7, 7,];
        } elseif ($year >= 2100 && $year <= 2131) {
            $days = [7, 7, 8, 8,];
        } elseif ($year >= 2132 && $year <= 2163) {
            $days = [7, 7, 7, 8,];
        } elseif ($year >= 2164 && $year <= 2195) {
            $days = [7, 7, 7, 7,];
        } elseif ($year >= 2196 && $year <= 2199) {
            $days = [6, 7, 7, 7,];
        } elseif ($year >= 2200 && $year <= 2227) {
            $days = [7, 8, 8, 8,];
        } elseif ($year >= 2228 && $year <= 2263) {
            $days = [7, 7, 8, 8,];
        } elseif ($year >= 2264 && $year <= 2291) {
            $days = [7, 7, 7, 8,];
        } elseif ($year >= 2292 && $year <= 2299) {
            $days = [7, 7, 7, 7,];
        } elseif ($year >= 2300 && $year <= 2327) {
            $days = [8, 8, 8, 8,];
        } elseif ($year >= 2328 && $year <= 2359) {
            $days = [7, 8, 8, 8,];
        } elseif ($year >= 2360 && $year <= 2391) {
            $days = [7, 7, 8, 8,];
        } elseif ($year >= 2392 && $year <= 2399) {
            $days = [7, 7, 7, 8,];
        } else {
            throw new SolarTermException;
        }
        return new SolarTermDate($year, DateTime::SOLAR_TERM_RITTOU, $days[$year % 4]);
    }

    /**
     * 小雪
     *
     * @param int $year
     * @return \JapaneseDate\Elements\SolarTermDate
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    public function syousetsu(int $year): SolarTermDate
    {
        if ($year >= 1600 && $year <= 1611) {
            $days = [22, 22, 22, 23,];
        } elseif ($year >= 1612 && $year <= 1647) {
            $days = [22, 22, 22, 22,];
        } elseif ($year >= 1648 && $year <= 1679) {
            $days = [21, 22, 22, 22,];
        } elseif ($year >= 1680 && $year <= 1699) {
            $days = [21, 21, 22, 22,];
        } elseif ($year >= 1700 && $year <= 1711) {
            $days = [22, 22, 23, 23,];
        } elseif ($year >= 1712 && $year <= 1747) {
            $days = [22, 22, 22, 23,];
        } elseif ($year >= 1748 && $year <= 1783) {
            $days = [22, 22, 22, 22,];
        } elseif ($year >= 1784 && $year <= 1799) {
            $days = [21, 22, 22, 22,];
        } elseif ($year >= 1800 && $year <= 1815) {
            $days = [22, 23, 23, 23,];
        } elseif ($year >= 1816 && $year <= 1847) {
            $days = [22, 22, 23, 23,];
        } elseif ($year >= 1848 && $year <= 1879) {
            $days = [22, 22, 22, 23,];
        } elseif ($year >= 1880 && $year <= 1899) {
            $days = [22, 22, 22, 22,];
        } elseif ($year >= 1900 && $year <= 1915) {
            $days = [23, 23, 23, 23,];
        } elseif ($year >= 1916 && $year <= 1951) {
            $days = [22, 23, 23, 23,];
        } elseif ($year >= 1952 && $year <= 1983) {
            $days = [22, 22, 23, 23,];
        } elseif ($year >= 1984 && $year <= 2015) {
            $days = [22, 22, 22, 23,];
        } elseif ($year >= 2016 && $year <= 2051) {
            $days = [22, 22, 22, 22,];
        } elseif ($year >= 2052 && $year <= 2083) {
            $days = [21, 22, 22, 22,];
        } elseif ($year >= 2084 && $year <= 2099) {
            $days = [21, 21, 22, 22,];
        } elseif ($year >= 2100 && $year <= 2115) {
            $days = [22, 22, 23, 23,];
        } elseif ($year >= 2116 && $year <= 2151) {
            $days = [22, 22, 22, 23,];
        } elseif ($year >= 2152 && $year <= 2187) {
            $days = [22, 22, 22, 22,];
        } elseif ($year >= 2188 && $year <= 2199) {
            $days = [21, 22, 22, 22,];
        } elseif ($year >= 2200 && $year <= 2219) {
            $days = [22, 23, 23, 23,];
        } elseif ($year >= 2220 && $year <= 2251) {
            $days = [22, 22, 23, 23,];
        } elseif ($year >= 2252 && $year <= 2283) {
            $days = [22, 22, 22, 23,];
        } elseif ($year >= 2284 && $year <= 2299) {
            $days = [22, 22, 22, 22,];
        } elseif ($year >= 2300 && $year <= 2319) {
            $days = [23, 23, 23, 23,];
        } elseif ($year >= 2320 && $year <= 2351) {
            $days = [22, 23, 23, 23,];
        } elseif ($year >= 2352 && $year <= 2383) {
            $days = [22, 22, 23, 23,];
        } elseif ($year >= 2384 && $year <= 2399) {
            $days = [22, 22, 22, 23,];
        } else {
            throw new SolarTermException;
        }
        return new SolarTermDate($year, DateTime::SOLAR_TERM_SYOUSETSU, $days[$year % 4]);
    }

    /**
     * 大雪
     *
     * @param int $year
     * @return \JapaneseDate\Elements\SolarTermDate
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    public function taisetsu(int $year): SolarTermDate
    {
        if ($year >= 1600 && $year <= 1615) {
            $days = [7, 7, 7, 7,];
        } elseif ($year >= 1616 && $year <= 1647) {
            $days = [6, 7, 7, 7,];
        } elseif ($year >= 1648 && $year <= 1683) {
            $days = [6, 6, 7, 7,];
        } elseif ($year >= 1684 && $year <= 1699) {
            $days = [6, 6, 6, 7,];
        } elseif ($year >= 1700 && $year <= 1715) {
            $days = [7, 7, 7, 8,];
        } elseif ($year >= 1716 && $year <= 1751) {
            $days = [7, 7, 7, 7,];
        } elseif ($year >= 1752 && $year <= 1787) {
            $days = [6, 7, 7, 7,];
        } elseif ($year >= 1788 && $year <= 1799) {
            $days = [6, 6, 7, 7,];
        } elseif ($year >= 1800 && $year <= 1819) {
            $days = [7, 7, 8, 8,];
        } elseif ($year >= 1820 && $year <= 1855) {
            $days = [7, 7, 7, 8,];
        } elseif ($year >= 1856 && $year <= 1891) {
            $days = [7, 7, 7, 7,];
        } elseif ($year >= 1892 && $year <= 1899) {
            $days = [6, 7, 7, 7,];
        } elseif ($year >= 1900 && $year <= 1923) {
            $days = [7, 8, 8, 8,];
        } elseif ($year >= 1924 && $year <= 1955) {
            $days = [7, 7, 8, 8,];
        } elseif ($year >= 1956 && $year <= 1987) {
            $days = [7, 7, 7, 8,];
        } elseif ($year >= 1988 && $year <= 2027) {
            $days = [7, 7, 7, 7,];
        } elseif ($year >= 2028 && $year <= 2059) {
            $days = [6, 7, 7, 7,];
        } elseif ($year >= 2060 && $year <= 2095) {
            $days = [6, 6, 7, 7,];
        } elseif ($year >= 2096 && $year <= 2099) {
            $days = [6, 6, 6, 7,];
        } elseif ($year >= 2100 && $year <= 2127) {
            $days = [7, 7, 7, 8,];
        } elseif ($year >= 2128 && $year <= 2163) {
            $days = [7, 7, 7, 7,];
        } elseif ($year >= 2164 && $year <= 2195) {
            $days = [6, 7, 7, 7,];
        } elseif ($year >= 2196 && $year <= 2199) {
            $days = [6, 6, 7, 7,];
        } elseif ($year >= 2200 && $year <= 2227) {
            $days = [7, 7, 8, 8,];
        } elseif ($year >= 2228 && $year <= 2263) {
            $days = [7, 7, 7, 8,];
        } elseif ($year >= 2264 && $year <= 2299) {
            $days = [7, 7, 7, 7,];
        } elseif ($year >= 2300 && $year <= 2331) {
            $days = [7, 8, 8, 8,];
        } elseif ($year >= 2332 && $year <= 2363) {
            $days = [7, 7, 8, 8,];
        } elseif ($year >= 2364 && $year <= 2395) {
            $days = [7, 7, 7, 8,];
        } elseif ($year >= 2396 && $year <= 2399) {
            $days = [7, 7, 7, 7,];
        } else {
            throw new SolarTermException;
        }
        return new SolarTermDate($year, DateTime::SOLAR_TERM_TAISETSU, $days[$year % 4]);
    }

    /**
     * 冬至
     *
     * @param int $year
     * @return \JapaneseDate\Elements\SolarTermDate
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    public function touji(int $year): SolarTermDate
    {
        if ($year >= 1600 && $year <= 1611) {
            $days = [21, 22, 22, 22,];
        } elseif ($year >= 1612 && $year <= 1643) {
            $days = [21, 21, 22, 22,];
        } elseif ($year >= 1644 && $year <= 1679) {
            $days = [21, 21, 21, 22,];
        } elseif ($year >= 1680 && $year <= 1699) {
            $days = [21, 21, 21, 21,];
        } elseif ($year >= 1700 && $year <= 1715) {
            $days = [22, 22, 22, 22,];
        } elseif ($year >= 1716 && $year <= 1751) {
            $days = [21, 22, 22, 22,];
        } elseif ($year >= 1752 && $year <= 1783) {
            $days = [21, 21, 22, 22,];
        } elseif ($year >= 1784 && $year <= 1799) {
            $days = [21, 21, 21, 22,];
        } elseif ($year >= 1800 && $year <= 1819) {
            $days = [22, 22, 22, 23,];
        } elseif ($year >= 1820 && $year <= 1855) {
            $days = [22, 22, 22, 22,];
        } elseif ($year >= 1856 && $year <= 1887) {
            $days = [21, 22, 22, 22,];
        } elseif ($year >= 1888 && $year <= 1899) {
            $days = [21, 21, 22, 22,];
        } elseif ($year >= 1900 && $year <= 1919) {
            $days = [22, 22, 23, 23,];
        } elseif ($year >= 1920 && $year <= 1955) {
            $days = [22, 22, 22, 23,];
        } elseif ($year >= 1956 && $year <= 1991) {
            $days = [22, 22, 22, 22,];
        } elseif ($year >= 1992 && $year <= 2027) {
            $days = [21, 22, 22, 22,];
        } elseif ($year >= 2028 && $year <= 2059) {
            $days = [21, 21, 22, 22,];
        } elseif ($year >= 2060 && $year <= 2095) {
            $days = [21, 21, 21, 22,];
        } elseif ($year >= 2096 && $year <= 2099) {
            $days = [21, 21, 21, 21,];
        } elseif ($year >= 2100 && $year <= 2131) {
            $days = [22, 22, 22, 22,];
        } elseif ($year >= 2132 && $year <= 2163) {
            $days = [21, 22, 22, 22,];
        } elseif ($year >= 2164 && $year <= 2195) {
            $days = [21, 21, 22, 22,];
        } elseif ($year >= 2196 && $year <= 2199) {
            $days = [21, 21, 21, 22,];
        } elseif ($year >= 2200 && $year <= 2227) {
            $days = [22, 22, 22, 23,];
        } elseif ($year >= 2228 && $year <= 2267) {
            $days = [22, 22, 22, 22,];
        } elseif ($year >= 2268 && $year <= 2299) {
            $days = [21, 22, 22, 22,];
        } elseif ($year >= 2300 && $year <= 2335) {
            $days = [22, 22, 23, 23,];
        } elseif ($year >= 2336 && $year <= 2363) {
            $days = [22, 22, 22, 23,];
        } elseif ($year >= 2364 && $year <= 2399) {
            $days = [22, 22, 22, 22,];
        } else {
            throw new SolarTermException;
        }
        return new SolarTermDate($year, DateTime::SOLAR_TERM_TOUJI, $days[$year % 4]);
    }

    /**
     * 小寒
     *
     * @param int $year
     * @return \JapaneseDate\Elements\SolarTermDate
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    public function syoukan(int $year): SolarTermDate
    {

        if ($year >= 1601 && $year <= 1604) {
            $days = [5, 5, 6, 6,];
        } elseif ($year >= 1605 && $year <= 1640) {
            $days = [5, 5, 5, 6,];
        } elseif ($year >= 1641 && $year <= 1676) {
            $days = [5, 5, 5, 5,];
        } elseif ($year >= 1677 && $year <= 1700) {
            $days = [4, 5, 5, 5,];
        } elseif ($year >= 1701 && $year <= 1708) {
            $days = [5, 6, 6, 6,];
        } elseif ($year >= 1709 && $year <= 1744) {
            $days = [5, 5, 6, 6,];
        } elseif ($year >= 1745 && $year <= 1780) {
            $days = [5, 5, 5, 6,];
        } elseif ($year >= 1781 && $year <= 1800) {
            $days = [5, 5, 5, 5,];
        } elseif ($year >= 1801 && $year <= 1816) {
            $days = [6, 6, 6, 6,];
        } elseif ($year >= 1817 && $year <= 1848) {
            $days = [5, 6, 6, 6,];
        } elseif ($year >= 1849 && $year <= 1884) {
            $days = [5, 5, 6, 6,];
        } elseif ($year >= 1885 && $year <= 1900) {
            $days = [5, 5, 5, 6,];
        } elseif ($year >= 1901 && $year <= 1916) {
            $days = [6, 6, 6, 7,];
        } elseif ($year >= 1917 && $year <= 1956) {
            $days = [6, 6, 6, 6,];
        } elseif ($year >= 1957 && $year <= 1988) {
            $days = [5, 6, 6, 6,];
        } elseif ($year >= 1989 && $year <= 2024) {
            $days = [5, 5, 6, 6,];
        } elseif ($year >= 2025 && $year <= 2056) {
            $days = [5, 5, 5, 6,];
        } elseif ($year >= 2057 && $year <= 2092) {
            $days = [5, 5, 5, 5,];
        } elseif ($year >= 2093 && $year <= 2100) {
            $days = [4, 5, 5, 5,];
        } elseif ($year >= 2101 && $year <= 2124) {
            $days = [5, 6, 6, 6,];
        } elseif ($year >= 2125 && $year <= 2160) {
            $days = [5, 5, 6, 6,];
        } elseif ($year >= 2161 && $year <= 2192) {
            $days = [5, 5, 5, 6,];
        } elseif ($year >= 2193 && $year <= 2200) {
            $days = [5, 5, 5, 5,];
        } elseif ($year >= 2201 && $year <= 2228) {
            $days = [6, 6, 6, 6,];
        } elseif ($year >= 2229 && $year <= 2264) {
            $days = [5, 6, 6, 6,];
        } elseif ($year >= 2265 && $year <= 2296) {
            $days = [5, 5, 6, 6,];
        } elseif ($year >= 2297 && $year <= 2300) {
            $days = [5, 5, 5, 6,];
        } elseif ($year >= 2301 && $year <= 2328) {
            $days = [6, 6, 6, 7,];
        } elseif ($year >= 2329 && $year <= 2368) {
            $days = [6, 6, 6, 6,];
        } elseif ($year >= 2369 && $year <= 2400) {
            $days = [5, 6, 6, 6,];
        } else {
            throw new SolarTermException;
        }
        return new SolarTermDate($year, DateTime::SOLAR_TERM_SYOUKAN, $days[$year % 4]);
    }

    /**
     * 大寒
     *
     * @param int $year
     * @return \JapaneseDate\Elements\SolarTermDate
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    public function daikan(int $year): SolarTermDate
    {
        if ($year >= 1601 && $year <= 1640) {
            $days = [20, 20, 20, 20,];
        } elseif ($year >= 1641 && $year <= 1672) {
            $days = [19, 20, 20, 20,];
        } elseif ($year >= 1673 && $year <= 1700) {
            $days = [19, 19, 20, 20,];
        } elseif ($year >= 1701 && $year <= 1708) {
            $days = [20, 20, 21, 21,];
        } elseif ($year >= 1709 && $year <= 1740) {
            $days = [20, 20, 20, 21,];
        } elseif ($year >= 1741 && $year <= 1780) {
            $days = [20, 20, 20, 20,];
        } elseif ($year >= 1781 && $year <= 1800) {
            $days = [19, 20, 20, 20,];
        } elseif ($year >= 1801 && $year <= 1812) {
            $days = [20, 21, 21, 21,];
        } elseif ($year >= 1813 && $year <= 1844) {
            $days = [20, 20, 21, 21,];
        } elseif ($year >= 1845 && $year <= 1880) {
            $days = [20, 20, 20, 21,];
        } elseif ($year >= 1881 && $year <= 1900) {
            $days = [20, 20, 20, 20,];
        } elseif ($year >= 1901 && $year <= 1916) {
            $days = [21, 21, 21, 21,];
        } elseif ($year >= 1917 && $year <= 1948) {
            $days = [20, 21, 21, 21,];
        } elseif ($year >= 1949 && $year <= 1984) {
            $days = [20, 20, 21, 21,];
        } elseif ($year >= 1985 && $year <= 2016) {
            $days = [20, 20, 20, 21,];
        } elseif ($year >= 2017 && $year <= 2052) {
            $days = [20, 20, 20, 20,];
        } elseif ($year >= 2053 && $year <= 2088) {
            $days = [19, 20, 20, 20,];
        } elseif ($year >= 2089 && $year <= 2100) {
            $days = [19, 19, 20, 20,];
        } elseif ($year >= 2101 && $year <= 2120) {
            $days = [20, 20, 21, 21,];
        } elseif ($year >= 2121 && $year <= 2156) {
            $days = [20, 20, 20, 21,];
        } elseif ($year >= 2157 && $year <= 2192) {
            $days = [20, 20, 20, 20,];
        } elseif ($year >= 2193 && $year <= 2200) {
            $days = [19, 20, 20, 20,];
        } elseif ($year >= 2201 && $year <= 2228) {
            $days = [20, 21, 21, 21,];
        } elseif ($year >= 2229 && $year <= 2260) {
            $days = [20, 20, 21, 21,];
        } elseif ($year >= 2261 && $year <= 2292) {
            $days = [20, 20, 20, 21,];
        } elseif ($year >= 2293 && $year <= 2300) {
            $days = [20, 20, 20, 20,];
        } elseif ($year >= 2301 && $year <= 2328) {
            $days = [21, 21, 21, 21,];
        } elseif ($year >= 2329 && $year <= 2360) {
            $days = [20, 21, 21, 21,];
        } elseif ($year >= 2361 && $year <= 2396) {
            $days = [20, 20, 21, 21,];
        } elseif ($year >= 2397 && $year <= 2400) {
            $days = [20, 20, 20, 21,];
        } else {
            throw new SolarTermException;
        }
        return new SolarTermDate($year, DateTime::SOLAR_TERM_DAIKAN, $days[$year % 4]);
    }

    /**
     * 立春
     *
     * @param int $year
     * @return \JapaneseDate\Elements\SolarTermDate
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    public function rissyun(int $year): SolarTermDate
    {

        if ($year >= 1601 && $year <= 1612) {
            $days = [4, 4, 4, 4,];
        } elseif ($year >= 1613 && $year <= 1644) {
            $days = [3, 4, 4, 4,];
        } elseif ($year >= 1645 && $year <= 1676) {
            $days = [3, 3, 4, 4,];
        } elseif ($year >= 1677 && $year <= 1700) {
            $days = [3, 3, 3, 4,];
        } elseif ($year >= 1701 && $year <= 1708) {
            $days = [4, 4, 4, 5,];
        } elseif ($year >= 1709 && $year <= 1748) {
            $days = [4, 4, 4, 4,];
        } elseif ($year >= 1749 && $year <= 1780) {
            $days = [3, 4, 4, 4,];
        } elseif ($year >= 1781 && $year <= 1800) {
            $days = [3, 3, 4, 4,];
        } elseif ($year >= 1801 && $year <= 1816) {
            $days = [4, 4, 5, 5,];
        } elseif ($year >= 1817 && $year <= 1848) {
            $days = [4, 4, 4, 5,];
        } elseif ($year >= 1849 && $year <= 1884) {
            $days = [4, 4, 4, 4,];
        } elseif ($year >= 1885 && $year <= 1900) {
            $days = [3, 4, 4, 4,];
        } elseif ($year >= 1901 && $year <= 1916) {
            $days = [4, 5, 5, 5,];
        } elseif ($year >= 1917 && $year <= 1952) {
            $days = [4, 4, 5, 5,];
        } elseif ($year >= 1953 && $year <= 1984) {
            $days = [4, 4, 4, 5,];
        } elseif ($year >= 1985 && $year <= 2020) {
            $days = [4, 4, 4, 4,];
        } elseif ($year >= 2021 && $year <= 2056) {
            $days = [3, 4, 4, 4,];
        } elseif ($year >= 2057 && $year <= 2088) {
            $days = [3, 3, 4, 4,];
        } elseif ($year >= 2089 && $year <= 2100) {
            $days = [3, 3, 3, 4,];
        } elseif ($year >= 2101 && $year <= 2120) {
            $days = [4, 4, 4, 5,];
        } elseif ($year >= 2121 && $year <= 2156) {
            $days = [4, 4, 4, 4,];
        } elseif ($year >= 2157 && $year <= 2192) {
            $days = [3, 4, 4, 4,];
        } elseif ($year >= 2193 && $year <= 2200) {
            $days = [3, 3, 4, 4,];
        } elseif ($year >= 2201 && $year <= 2224) {
            $days = [4, 4, 5, 5,];
        } elseif ($year >= 2225 && $year <= 2260) {
            $days = [4, 4, 4, 5,];
        } elseif ($year >= 2261 && $year <= 2296) {
            $days = [4, 4, 4, 4,];
        } elseif ($year >= 2297 && $year <= 2300) {
            $days = [3, 4, 4, 4,];
        } elseif ($year >= 2301 && $year <= 2328) {
            $days = [4, 5, 5, 5,];
        } elseif ($year >= 2329 && $year <= 2360) {
            $days = [4, 4, 5, 5,];
        } elseif ($year >= 2361 && $year <= 2396) {
            $days = [4, 4, 4, 5,];
        } elseif ($year >= 2397 && $year <= 2432) {
            $days = [4, 4, 4, 4,];
        } elseif ($year >= 2433 && $year <= 2464) {
            $days = [3, 4, 4, 4,];
        } elseif ($year >= 2465 && $year <= 2496) {
            $days = [3, 3, 4, 4,];
        } elseif ($year >= 2497 && $year <= 2500) {
            $days = [3, 3, 3, 4,];
        } elseif ($year >= 2501 && $year <= 2528) {
            $days = [4, 4, 4, 5,];
        } elseif ($year >= 2529 && $year <= 2568) {
            $days = [4, 4, 4, 4,];
        } elseif ($year >= 2569 && $year <= 2600) {
            $days = [3, 4, 4, 4,];
        } elseif ($year >= 2601 && $year <= 2636) {
            $days = [4, 4, 5, 5,];
        } elseif ($year >= 2637 && $year <= 2668) {
            $days = [4, 4, 4, 5,];
        } elseif ($year >= 2669 && $year <= 2700) {
            $days = [4, 4, 4, 4,];
        } elseif ($year >= 2701 && $year <= 2704) {
            $days = [5, 5, 5, 5,];
        } elseif ($year >= 2705 && $year <= 2736) {
            $days = [4, 5, 5, 5,];
        } elseif ($year >= 2737 && $year <= 2768) {
            $days = [4, 4, 5, 5,];
        } elseif ($year >= 2769 && $year <= 2800) {
            $days = [4, 4, 4, 5,];
        } else {
            throw new SolarTermException;
        }
        return new SolarTermDate($year, DateTime::SOLAR_TERM_RISSYUN, $days[$year % 4]);
    }

    /**
     * 雨水
     *
     * @param int $year
     * @return \JapaneseDate\Elements\SolarTermDate
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    public function usui(int $year): SolarTermDate
    {
        if ($year >= 1601 && $year <= 1624) {
            $days = [18, 19, 19, 19,];
        } elseif ($year >= 1625 && $year <= 1656) {
            $days = [18, 18, 19, 19,];
        } elseif ($year >= 1657 && $year <= 1692) {
            $days = [18, 18, 18, 19,];
        } elseif ($year >= 1693 && $year <= 1700) {
            $days = [18, 18, 18, 18,];
        } elseif ($year >= 1701 && $year <= 1728) {
            $days = [19, 19, 19, 19,];
        } elseif ($year >= 1729 && $year <= 1760) {
            $days = [18, 19, 19, 19,];
        } elseif ($year >= 1761 && $year <= 1792) {
            $days = [18, 18, 19, 19,];
        } elseif ($year >= 1793 && $year <= 1800) {
            $days = [18, 18, 18, 19,];
        } elseif ($year >= 1801 && $year <= 1824) {
            $days = [19, 19, 19, 20,];
        } elseif ($year >= 1825 && $year <= 1860) {
            $days = [19, 19, 19, 19,];
        } elseif ($year >= 1861 && $year <= 1896) {
            $days = [18, 19, 19, 19,];
        } elseif ($year >= 1897 && $year <= 1900) {
            $days = [18, 18, 19, 19,];
        } elseif ($year >= 1901 && $year <= 1928) {
            $days = [19, 19, 20, 20,];
        } elseif ($year >= 1929 && $year <= 1960) {
            $days = [19, 19, 19, 20,];
        } elseif ($year >= 1961 && $year <= 1996) {
            $days = [19, 19, 19, 19,];
        } elseif ($year >= 1997 && $year <= 2028) {
            $days = [18, 19, 19, 19,];
        } elseif ($year >= 2029 && $year <= 2064) {
            $days = [18, 18, 19, 19,];
        } elseif ($year >= 2065 && $year <= 2096) {
            $days = [18, 18, 18, 19,];
        } elseif ($year >= 2097 && $year <= 2100) {
            $days = [18, 18, 18, 18,];
        } elseif ($year >= 2101 && $year <= 2132) {
            $days = [19, 19, 19, 19,];
        } elseif ($year >= 2133 && $year <= 2168) {
            $days = [18, 19, 19, 19,];
        } elseif ($year >= 2169 && $year <= 2200) {
            $days = [18, 18, 19, 19,];
        } elseif ($year >= 2201 && $year <= 2232) {
            $days = [19, 19, 19, 20,];
        } elseif ($year >= 2233 && $year <= 2268) {
            $days = [19, 19, 19, 19,];
        } elseif ($year >= 2269 && $year <= 2300) {
            $days = [18, 19, 19, 19,];
        } elseif ($year >= 2301 && $year <= 2336) {
            $days = [19, 19, 20, 20,];
        } elseif ($year >= 2337 && $year <= 2368) {
            $days = [19, 19, 19, 20,];
        } elseif ($year >= 2369 && $year <= 2400) {
            $days = [19, 19, 19, 19,];
        } else {
            throw new SolarTermException;
        }
        return new SolarTermDate($year, DateTime::SOLAR_TERM_USUI, $days[$year % 4]);
    }

    /**
     * 啓蟄
     *
     * @param int $year
     * @return \JapaneseDate\Elements\SolarTermDate
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    public function keichitsu(int $year): SolarTermDate
    {

        if ($year >= 1600 && $year <= 1619) {
            $days = [5, 5, 6, 6,];
        } elseif ($year >= 1620 && $year <= 1651) {
            $days = [5, 5, 5, 6,];
        } elseif ($year >= 1652 && $year <= 1687) {
            $days = [5, 5, 5, 5,];
        } elseif ($year >= 1688 && $year <= 1699) {
            $days = [4, 5, 5, 5,];
        } elseif ($year >= 1700 && $year <= 1719) {
            $days = [5, 6, 6, 6,];
        } elseif ($year >= 1720 && $year <= 1751) {
            $days = [5, 5, 6, 6,];
        } elseif ($year >= 1752 && $year <= 1783) {
            $days = [5, 5, 5, 6,];
        } elseif ($year >= 1784 && $year <= 1799) {
            $days = [5, 5, 5, 5,];
        } elseif ($year >= 1800 && $year <= 1823) {
            $days = [6, 6, 6, 6,];
        } elseif ($year >= 1824 && $year <= 1855) {
            $days = [5, 6, 6, 6,];
        } elseif ($year >= 1856 && $year <= 1887) {
            $days = [5, 5, 6, 6,];
        } elseif ($year >= 1888 && $year <= 1899) {
            $days = [5, 5, 5, 6,];
        } elseif ($year >= 1900 && $year <= 1919) {
            $days = [6, 6, 6, 7,];
        } elseif ($year >= 1920 && $year <= 1955) {
            $days = [6, 6, 6, 6,];
        } elseif ($year >= 1956 && $year <= 1987) {
            $days = [5, 6, 6, 6,];
        } elseif ($year >= 1988 && $year <= 2019) {
            $days = [5, 5, 6, 6,];
        } elseif ($year >= 2020 && $year <= 2051) {
            $days = [5, 5, 5, 6,];
        } elseif ($year >= 2052 && $year <= 2087) {
            $days = [5, 5, 5, 5,];
        } elseif ($year >= 2088 && $year <= 2099) {
            $days = [4, 5, 5, 5,];
        } elseif ($year >= 2100 && $year <= 2119) {
            $days = [5, 6, 6, 6,];
        } elseif ($year >= 2120 && $year <= 2155) {
            $days = [5, 5, 6, 6,];
        } elseif ($year >= 2156 && $year <= 2183) {
            $days = [5, 5, 5, 6,];
        } elseif ($year >= 2184 && $year <= 2199) {
            $days = [5, 5, 5, 5,];
        } elseif ($year >= 2200 && $year <= 2219) {
            $days = [6, 6, 6, 6,];
        } elseif ($year >= 2220 && $year <= 2251) {
            $days = [5, 6, 6, 6,];
        } elseif ($year >= 2252 && $year <= 2283) {
            $days = [5, 5, 6, 6,];
        } elseif ($year >= 2284 && $year <= 2299) {
            $days = [5, 5, 5, 6,];
        } elseif ($year >= 2300 && $year <= 2319) {
            $days = [6, 6, 6, 7,];
        } elseif ($year >= 2320 && $year <= 2355) {
            $days = [6, 6, 6, 6,];
        } elseif ($year >= 2356 && $year <= 2387) {
            $days = [5, 6, 6, 6,];
        } elseif ($year >= 2388 && $year <= 2399) {
            $days = [5, 5, 6, 6,];
        } else {
            throw new SolarTermException;
        }
        return new SolarTermDate($year, DateTime::SOLAR_TERM_KEICHITSU, $days[$year % 4]);
    }
}