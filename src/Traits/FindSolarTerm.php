<?php

namespace JapaneseDate\Traits;

use JapaneseDate\Components\Astronomy;
use JapaneseDate\Components\SimpleSolarTerm;
use JapaneseDate\Components\SolarTerm;
use JapaneseDate\DateTime;
use JapaneseDate\DateTimeImmutable;
use JapaneseDate\Elements\SolarTermDate;
use Throwable;

/**
 * Trait SolarTerm
 *
 * @category    DateTime
 * @package     JapaneseDate
 * @subpackage  Traits
 * @author      Suzunone <suzunone.eleven@gmail.com>
 * @copyright   Suzunone
 * @license     BSD-2
 * @link        https://github.com/suzunone/JapaneseDate
 * @see         https://github.com/suzunone/JapaneseDate
 * @since        2026-05-28
 * @mixin DateTime
 * @mixin DateTimeImmutable
 */
trait FindSolarTerm
{
    /**
     * 今年の春分の日を取得する
     * @return DateTime|DateTimeImmutable
     */
    protected function getSyunbun(): DateTime|DateTimeImmutable
    {
        return $this->getSolarTermDate('syunbun', $this->year);
    }

    /**
     * @param string $method
     * @param int $year
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getSolarTermDate(string $method, int $year): DateTime|DateTimeImmutable
    {
        $st = $this->findSolarTerm($method, $year);

        return $this->setDateTime($st->year, $st->month, $st->day, $this->hour, $this->minute, $this->second);
    }

    /**
     * @param string $method
     * @param int $year
     * @return \JapaneseDate\Elements\SolarTermDate
     */
    protected function findSolarTerm(string $method, int $year): SolarTermDate
    {
        if (Astronomy::solarAlgorithm() === Astronomy::SOLAR_VSOP87) {
            return (new SolarTerm())->{$method}($year);
        }

        try {
            $SolarTerm = new SimpleSolarTerm();

            return $SolarTerm->{$method}($year);
        } catch (Throwable) {
            $SolarTerm = new SolarTerm();

            return $SolarTerm->{$method}($year);
        }
    }

    /**
     * 次の春分の日を取得する
     * @return DateTime|DateTimeImmutable
     */
    protected function getNextSyunbun(): DateTime|DateTimeImmutable
    {
        return $this->getNextSolarTermDate('syunbun');
    }

    /**
     * @param string $method
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getNextSolarTermDate(string $method): DateTime|DateTimeImmutable
    {
        $year = $this->year;
        $st = $this->findSolarTerm($method, $year);

        if ($this->month > $st->month || ($this->month === $st->month && $this->day >= $st->day)) {
            ++$year;
        }

        return $this->getSolarTermDate($method, $year);
    }

    /**
     * 前回の春分の日を取得する
     * @return DateTime|DateTimeImmutable
     */
    protected function getBeforeSyunbun(): DateTime|DateTimeImmutable
    {
        return $this->getBeforeSolarTermDate('syunbun');
    }

    /**
     * @param string $method
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getBeforeSolarTermDate(string $method): DateTime|DateTimeImmutable
    {
        $year = $this->year;
        $st = $this->findSolarTerm($method, $year);

        if ($this->month < $st->month || ($this->month === $st->month && $this->day <= $st->day)) {
            --$year;
        }

        return $this->getSolarTermDate($method, $year);
    }

    /**
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getSeimei(): DateTime|DateTimeImmutable
    {
        return $this->getSolarTermDate('seimei', $this->year);
    }

    /**
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getNextSeimei(): DateTime|DateTimeImmutable
    {
        return $this->getNextSolarTermDate('seimei');
    }

    /**
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getBeforeSeimei(): DateTime|DateTimeImmutable
    {
        return $this->getBeforeSolarTermDate('seimei');
    }

    /**
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getKokuu(): DateTime|DateTimeImmutable
    {
        return $this->getSolarTermDate('kokuu', $this->year);
    }

    /**
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getNextKokuu(): DateTime|DateTimeImmutable
    {
        return $this->getNextSolarTermDate('kokuu');
    }

    /**
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getBeforeKokuu(): DateTime|DateTimeImmutable
    {
        return $this->getBeforeSolarTermDate('kokuu');
    }

    /**
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getRikka(): DateTime|DateTimeImmutable
    {
        return $this->getSolarTermDate('rikka', $this->year);
    }

    /**
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getNextRikka(): DateTime|DateTimeImmutable
    {
        return $this->getNextSolarTermDate('rikka');
    }

    /**
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getBeforeRikka(): DateTime|DateTimeImmutable
    {
        return $this->getBeforeSolarTermDate('rikka');
    }

    /**
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getSyouman(): DateTime|DateTimeImmutable
    {
        return $this->getSolarTermDate('syouman', $this->year);
    }

    /**
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getNextSyouman(): DateTime|DateTimeImmutable
    {
        return $this->getNextSolarTermDate('syouman');
    }

    /**
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getBeforeSyouman(): DateTime|DateTimeImmutable
    {
        return $this->getBeforeSolarTermDate('syouman');
    }

    /**
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getBousyu(): DateTime|DateTimeImmutable
    {
        return $this->getSolarTermDate('bousyu', $this->year);
    }

    /**
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getNextBousyu(): DateTime|DateTimeImmutable
    {
        return $this->getNextSolarTermDate('bousyu');
    }

    /**
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getBeforeBousyu(): DateTime|DateTimeImmutable
    {
        return $this->getBeforeSolarTermDate('bousyu');
    }

    /**
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getGeshi(): DateTime|DateTimeImmutable
    {
        return $this->getSolarTermDate('geshi', $this->year);
    }

    /**
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getNextGeshi(): DateTime|DateTimeImmutable
    {
        return $this->getNextSolarTermDate('geshi');
    }

    /**
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getBeforeGeshi(): DateTime|DateTimeImmutable
    {
        return $this->getBeforeSolarTermDate('geshi');
    }

    /**
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getSyousyo(): DateTime|DateTimeImmutable
    {
        return $this->getSolarTermDate('syousyo', $this->year);
    }

    /**
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getNextSyousyo(): DateTime|DateTimeImmutable
    {
        return $this->getNextSolarTermDate('syousyo');
    }

    /**
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getBeforeSyousyo(): DateTime|DateTimeImmutable
    {
        return $this->getBeforeSolarTermDate('syousyo');
    }

    /**
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getTaisyo(): DateTime|DateTimeImmutable
    {
        return $this->getSolarTermDate('taisyo', $this->year);
    }

    /**
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getNextTaisyo(): DateTime|DateTimeImmutable
    {
        return $this->getNextSolarTermDate('taisyo');
    }

    /**
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getBeforeTaisyo(): DateTime|DateTimeImmutable
    {
        return $this->getBeforeSolarTermDate('taisyo');
    }

    /**
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getRissyuu(): DateTime|DateTimeImmutable
    {
        return $this->getSolarTermDate('rissyuu', $this->year);
    }

    /**
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getNextRissyuu(): DateTime|DateTimeImmutable
    {
        return $this->getNextSolarTermDate('rissyuu');
    }

    /**
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getBeforeRissyuu(): DateTime|DateTimeImmutable
    {
        return $this->getBeforeSolarTermDate('rissyuu');
    }

    /**
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getSyosyo(): DateTime|DateTimeImmutable
    {
        return $this->getSolarTermDate('syosyo', $this->year);
    }

    /**
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getNextSyosyo(): DateTime|DateTimeImmutable
    {
        return $this->getNextSolarTermDate('syosyo');
    }

    /**
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getBeforeSyosyo(): DateTime|DateTimeImmutable
    {
        return $this->getBeforeSolarTermDate('syosyo');
    }

    /**
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getHakuro(): DateTime|DateTimeImmutable
    {
        return $this->getSolarTermDate('hakuro', $this->year);
    }

    /**
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getNextHakuro(): DateTime|DateTimeImmutable
    {
        return $this->getNextSolarTermDate('hakuro');
    }

    /**
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getBeforeHakuro(): DateTime|DateTimeImmutable
    {
        return $this->getBeforeSolarTermDate('hakuro');
    }

    /**
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getSyuubun(): DateTime|DateTimeImmutable
    {
        return $this->getSolarTermDate('syuubun', $this->year);
    }

    /**
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getNextSyuubun(): DateTime|DateTimeImmutable
    {
        return $this->getNextSolarTermDate('syuubun');
    }

    /**
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getBeforeSyuubun(): DateTime|DateTimeImmutable
    {
        return $this->getBeforeSolarTermDate('syuubun');
    }

    /**
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getKanro(): DateTime|DateTimeImmutable
    {
        return $this->getSolarTermDate('kanro', $this->year);
    }

    /**
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getNextKanro(): DateTime|DateTimeImmutable
    {
        return $this->getNextSolarTermDate('kanro');
    }

    /**
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getBeforeKanro(): DateTime|DateTimeImmutable
    {
        return $this->getBeforeSolarTermDate('kanro');
    }

    /**
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getSoukou(): DateTime|DateTimeImmutable
    {
        return $this->getSolarTermDate('soukou', $this->year);
    }

    /**
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getNextSoukou(): DateTime|DateTimeImmutable
    {
        return $this->getNextSolarTermDate('soukou');
    }

    /**
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getBeforeSoukou(): DateTime|DateTimeImmutable
    {
        return $this->getBeforeSolarTermDate('soukou');
    }

    /**
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getRittou(): DateTime|DateTimeImmutable
    {
        return $this->getSolarTermDate('rittou', $this->year);
    }

    /**
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getNextRittou(): DateTime|DateTimeImmutable
    {
        return $this->getNextSolarTermDate('rittou');
    }

    /**
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getBeforeRittou(): DateTime|DateTimeImmutable
    {
        return $this->getBeforeSolarTermDate('rittou');
    }

    /**
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getSyousetsu(): DateTime|DateTimeImmutable
    {
        return $this->getSolarTermDate('syousetsu', $this->year);
    }

    /**
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getNextSyousetsu(): DateTime|DateTimeImmutable
    {
        return $this->getNextSolarTermDate('syousetsu');
    }

    /**
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getBeforeSyousetsu(): DateTime|DateTimeImmutable
    {
        return $this->getBeforeSolarTermDate('syousetsu');
    }

    /**
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getTaisetsu(): DateTime|DateTimeImmutable
    {
        return $this->getSolarTermDate('taisetsu', $this->year);
    }

    /**
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getNextTaisetsu(): DateTime|DateTimeImmutable
    {
        return $this->getNextSolarTermDate('taisetsu');
    }

    /**
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getBeforeTaisetsu(): DateTime|DateTimeImmutable
    {
        return $this->getBeforeSolarTermDate('taisetsu');
    }

    /**
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getTouji(): DateTime|DateTimeImmutable
    {
        return $this->getSolarTermDate('touji', $this->year);
    }

    /**
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getNextTouji(): DateTime|DateTimeImmutable
    {
        return $this->getNextSolarTermDate('touji');
    }

    /**
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getBeforeTouji(): DateTime|DateTimeImmutable
    {
        return $this->getBeforeSolarTermDate('touji');
    }

    /**
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getSyoukan(): DateTime|DateTimeImmutable
    {
        return $this->getSolarTermDate('syoukan', $this->year);
    }

    /**
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getNextSyoukan(): DateTime|DateTimeImmutable
    {
        return $this->getNextSolarTermDate('syoukan');
    }

    /**
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getBeforeSyoukan(): DateTime|DateTimeImmutable
    {
        return $this->getBeforeSolarTermDate('syoukan');
    }

    /**
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getDaikan(): DateTime|DateTimeImmutable
    {
        return $this->getSolarTermDate('daikan', $this->year);
    }

    /**
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getNextDaikan(): DateTime|DateTimeImmutable
    {
        return $this->getNextSolarTermDate('daikan');
    }

    /**
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getBeforeDaikan(): DateTime|DateTimeImmutable
    {
        return $this->getBeforeSolarTermDate('daikan');
    }

    /**
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getRissyun(): DateTime|DateTimeImmutable
    {
        return $this->getSolarTermDate('rissyun', $this->year);
    }

    /**
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getNextRissyun(): DateTime|DateTimeImmutable
    {
        return $this->getNextSolarTermDate('rissyun');
    }

    /**
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getBeforeRissyun(): DateTime|DateTimeImmutable
    {
        return $this->getBeforeSolarTermDate('rissyun');
    }

    /**
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getUsui(): DateTime|DateTimeImmutable
    {
        return $this->getSolarTermDate('usui', $this->year);
    }

    /**
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getNextUsui(): DateTime|DateTimeImmutable
    {
        return $this->getNextSolarTermDate('usui');
    }

    /**
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getBeforeUsui(): DateTime|DateTimeImmutable
    {
        return $this->getBeforeSolarTermDate('usui');
    }

    /**
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getKeichitsu(): DateTime|DateTimeImmutable
    {
        return $this->getSolarTermDate('keichitsu', $this->year);
    }

    /**
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getNextKeichitsu(): DateTime|DateTimeImmutable
    {
        return $this->getNextSolarTermDate('keichitsu');
    }

    /**
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getBeforeKeichitsu(): DateTime|DateTimeImmutable
    {
        return $this->getBeforeSolarTermDate('keichitsu');
    }
}
