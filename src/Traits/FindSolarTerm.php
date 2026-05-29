<?php

namespace JapaneseDate\Traits;

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
 * @mixin \JapaneseDate\DateTime
 * @mixin \JapaneseDate\DateTimeImmutable
 */
trait FindSolarTerm
{
    /**
     * 今年の春分の日を取得する
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getSyunbun()
    {
        return $this->getSolarTermDate('syunbun', $this->year);
    }

    /**
     * 次の春分の日を取得する
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getNextSyunbun()
    {
        return $this->getNextSolarTermDate('syunbun');
    }

    /**
     * 前回の春分の日を取得する
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getBeforeSyunbun()
    {
        return $this->getBeforeSolarTermDate('syunbun');
    }

    /**
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getSeimei()
    {
        return $this->getSolarTermDate('seimei', $this->year);
    }

    /**
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getNextSeimei()
    {
        return $this->getNextSolarTermDate('seimei');
    }

    /**
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getBeforeSeimei()
    {
        return $this->getBeforeSolarTermDate('seimei');
    }

    /**
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getKokuu()
    {
        return $this->getSolarTermDate('kokuu', $this->year);
    }

    /**
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getNextKokuu()
    {
        return $this->getNextSolarTermDate('kokuu');
    }

    /**
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getBeforeKokuu()
    {
        return $this->getBeforeSolarTermDate('kokuu');
    }

    /**
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getRikka()
    {
        return $this->getSolarTermDate('rikka', $this->year);
    }

    /**
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getNextRikka()
    {
        return $this->getNextSolarTermDate('rikka');
    }

    /**
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getBeforeRikka()
    {
        return $this->getBeforeSolarTermDate('rikka');
    }

    /**
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getSyouman()
    {
        return $this->getSolarTermDate('syouman', $this->year);
    }

    /**
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getNextSyouman()
    {
        return $this->getNextSolarTermDate('syouman');
    }

    /**
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getBeforeSyouman()
    {
        return $this->getBeforeSolarTermDate('syouman');
    }

    /**
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getBousyu()
    {
        return $this->getSolarTermDate('bousyu', $this->year);
    }

    /**
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getNextBousyu()
    {
        return $this->getNextSolarTermDate('bousyu');
    }

    /**
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getBeforeBousyu()
    {
        return $this->getBeforeSolarTermDate('bousyu');
    }

    /**
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getGeshi()
    {
        return $this->getSolarTermDate('geshi', $this->year);
    }

    /**
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getNextGeshi()
    {
        return $this->getNextSolarTermDate('geshi');
    }

    /**
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getBeforeGeshi()
    {
        return $this->getBeforeSolarTermDate('geshi');
    }

    /**
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getSyousyo()
    {
        return $this->getSolarTermDate('syousyo', $this->year);
    }

    /**
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getNextSyousyo()
    {
        return $this->getNextSolarTermDate('syousyo');
    }

    /**
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getBeforeSyousyo()
    {
        return $this->getBeforeSolarTermDate('syousyo');
    }

    /**
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getTaisyo()
    {
        return $this->getSolarTermDate('taisyo', $this->year);
    }

    /**
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getNextTaisyo()
    {
        return $this->getNextSolarTermDate('taisyo');
    }

    /**
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getBeforeTaisyo()
    {
        return $this->getBeforeSolarTermDate('taisyo');
    }

    /**
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getRissyuu()
    {
        return $this->getSolarTermDate('rissyuu', $this->year);
    }

    /**
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getNextRissyuu()
    {
        return $this->getNextSolarTermDate('rissyuu');
    }

    /**
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getBeforeRissyuu()
    {
        return $this->getBeforeSolarTermDate('rissyuu');
    }

    /**
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getSyosyo()
    {
        return $this->getSolarTermDate('syosyo', $this->year);
    }

    /**
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getNextSyosyo()
    {
        return $this->getNextSolarTermDate('syosyo');
    }

    /**
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getBeforeSyosyo()
    {
        return $this->getBeforeSolarTermDate('syosyo');
    }

    /**
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getHakuro()
    {
        return $this->getSolarTermDate('hakuro', $this->year);
    }

    /**
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getNextHakuro()
    {
        return $this->getNextSolarTermDate('hakuro');
    }

    /**
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getBeforeHakuro()
    {
        return $this->getBeforeSolarTermDate('hakuro');
    }

    /**
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getSyuubun()
    {
        return $this->getSolarTermDate('syuubun', $this->year);
    }

    /**
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getNextSyuubun()
    {
        return $this->getNextSolarTermDate('syuubun');
    }

    /**
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getBeforeSyuubun()
    {
        return $this->getBeforeSolarTermDate('syuubun');
    }

    /**
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getKanro()
    {
        return $this->getSolarTermDate('kanro', $this->year);
    }

    /**
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getNextKanro()
    {
        return $this->getNextSolarTermDate('kanro');
    }

    /**
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getBeforeKanro()
    {
        return $this->getBeforeSolarTermDate('kanro');
    }

    /**
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getSoukou()
    {
        return $this->getSolarTermDate('soukou', $this->year);
    }

    /**
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getNextSoukou()
    {
        return $this->getNextSolarTermDate('soukou');
    }

    /**
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getBeforeSoukou()
    {
        return $this->getBeforeSolarTermDate('soukou');
    }

    /**
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getRittou()
    {
        return $this->getSolarTermDate('rittou', $this->year);
    }

    /**
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getNextRittou()
    {
        return $this->getNextSolarTermDate('rittou');
    }

    /**
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getBeforeRittou()
    {
        return $this->getBeforeSolarTermDate('rittou');
    }

    /**
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getSyousetsu()
    {
        return $this->getSolarTermDate('syousetsu', $this->year);
    }

    /**
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getNextSyousetsu()
    {
        return $this->getNextSolarTermDate('syousetsu');
    }

    /**
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getBeforeSyousetsu()
    {
        return $this->getBeforeSolarTermDate('syousetsu');
    }

    /**
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getTaisetsu()
    {
        return $this->getSolarTermDate('taisetsu', $this->year);
    }

    /**
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getNextTaisetsu()
    {
        return $this->getNextSolarTermDate('taisetsu');
    }

    /**
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getBeforeTaisetsu()
    {
        return $this->getBeforeSolarTermDate('taisetsu');
    }

    /**
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getTouji()
    {
        return $this->getSolarTermDate('touji', $this->year);
    }

    /**
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getNextTouji()
    {
        return $this->getNextSolarTermDate('touji');
    }

    /**
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getBeforeTouji()
    {
        return $this->getBeforeSolarTermDate('touji');
    }

    /**
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getSyoukan()
    {
        return $this->getSolarTermDate('syoukan', $this->year);
    }

    /**
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getNextSyoukan()
    {
        return $this->getNextSolarTermDate('syoukan');
    }

    /**
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getBeforeSyoukan()
    {
        return $this->getBeforeSolarTermDate('syoukan');
    }

    /**
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getDaikan()
    {
        return $this->getSolarTermDate('daikan', $this->year);
    }

    /**
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getNextDaikan()
    {
        return $this->getNextSolarTermDate('daikan');
    }

    /**
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getBeforeDaikan()
    {
        return $this->getBeforeSolarTermDate('daikan');
    }

    /**
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getRissyun()
    {
        return $this->getSolarTermDate('rissyun', $this->year);
    }

    /**
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getNextRissyun()
    {
        return $this->getNextSolarTermDate('rissyun');
    }

    /**
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getBeforeRissyun()
    {
        return $this->getBeforeSolarTermDate('rissyun');
    }

    /**
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getUsui()
    {
        return $this->getSolarTermDate('usui', $this->year);
    }

    /**
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getNextUsui()
    {
        return $this->getNextSolarTermDate('usui');
    }

    /**
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getBeforeUsui()
    {
        return $this->getBeforeSolarTermDate('usui');
    }

    /**
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getKeichitsu()
    {
        return $this->getSolarTermDate('keichitsu', $this->year);
    }

    /**
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getNextKeichitsu()
    {
        return $this->getNextSolarTermDate('keichitsu');
    }

    /**
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getBeforeKeichitsu()
    {
        return $this->getBeforeSolarTermDate('keichitsu');
    }

    /**
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    private function getNextSolarTermDate(string $method)
    {
        $year = $this->year;
        $st = $this->findSolarTerm($method, $year);

        if ($this->month > $st->month || ($this->month === $st->month && $this->day >= $st->day)) {
            ++$year;
        }

        return $this->getSolarTermDate($method, $year);
    }

    /**
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    private function getBeforeSolarTermDate(string $method)
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
    private function getSolarTermDate(string $method, int $year)
    {
        $st = $this->findSolarTerm($method, $year);

        return $this->setDateTime($st->year, $st->month, $st->day, $this->hour, $this->minute, $this->second);
    }

    private function findSolarTerm(string $method, int $year): SolarTermDate
    {
        try {
            $SolarTerm = new SimpleSolarTerm();

            return $SolarTerm->{$method}($year);
        } catch (Throwable $exception) {
            $SolarTerm = new SolarTerm();

            return $SolarTerm->{$method}($year);
        }
    }
}
