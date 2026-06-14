<?php

namespace JapaneseDate\Components\Traits;

use JapaneseDate\DateTime;
use JapaneseDate\Elements\SolarTermDate;

/**
 * 二十四節気一覧をまとめて取得するための共通トレイト。
 *
 * {@see \JapaneseDate\Components\SolarTerm} と
 * {@see \JapaneseDate\Components\SimpleSolarTerm} の両方で利用され、
 * 各節気メソッド（`syunbun()`、`seimei()` など）を順に呼び出して、
 * 指定年の二十四節気を定数キー付き配列として返します。
 *
 * **戻り値の構造:**
 * キーは {@see DateTime::SOLAR_TERM_*} 定数、
 * 値は対応する {@see SolarTermDate} オブジェクトです。
 *
 * @mixin \JapaneseDate\Components\SolarTerm
 * @mixin \JapaneseDate\Components\SimpleSolarTerm
 */
trait GetSolarTerm
{
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
}
