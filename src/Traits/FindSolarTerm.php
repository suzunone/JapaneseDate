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
 * @since        1.0.0
 * @mixin \JapaneseDate\DateTime
 * @mixin \JapaneseDate\DateTimeImmutable
 */
trait FindSolarTerm
{
    /**
     * 今年の春分の日を取得する
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getSyunbun(): DateTime|DateTimeImmutable
    {
        return $this->getSolarTermDate('syunbun', $this->year);
    }

    /**
     * 次の春分の日を取得する
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getNextSyunbun(): DateTime|DateTimeImmutable
    {
        return $this->getNextSolarTermDate('syunbun');
    }

    /**
     * 前回の春分の日を取得する
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     */
    protected function getBeforeSyunbun(): DateTime|DateTimeImmutable
    {
        return $this->getBeforeSolarTermDate('syunbun');
    }

    protected function getSeimei(): DateTime|DateTimeImmutable
    {
        return $this->getSolarTermDate('seimei', $this->year);
    }

    protected function getNextSeimei(): DateTime|DateTimeImmutable
    {
        return $this->getNextSolarTermDate('seimei');
    }

    protected function getBeforeSeimei(): DateTime|DateTimeImmutable
    {
        return $this->getBeforeSolarTermDate('seimei');
    }

    protected function getKokuu(): DateTime|DateTimeImmutable
    {
        return $this->getSolarTermDate('kokuu', $this->year);
    }

    protected function getNextKokuu(): DateTime|DateTimeImmutable
    {
        return $this->getNextSolarTermDate('kokuu');
    }

    protected function getBeforeKokuu(): DateTime|DateTimeImmutable
    {
        return $this->getBeforeSolarTermDate('kokuu');
    }

    protected function getRikka(): DateTime|DateTimeImmutable
    {
        return $this->getSolarTermDate('rikka', $this->year);
    }

    protected function getNextRikka(): DateTime|DateTimeImmutable
    {
        return $this->getNextSolarTermDate('rikka');
    }

    protected function getBeforeRikka(): DateTime|DateTimeImmutable
    {
        return $this->getBeforeSolarTermDate('rikka');
    }

    protected function getSyouman(): DateTime|DateTimeImmutable
    {
        return $this->getSolarTermDate('syouman', $this->year);
    }

    protected function getNextSyouman(): DateTime|DateTimeImmutable
    {
        return $this->getNextSolarTermDate('syouman');
    }

    protected function getBeforeSyouman(): DateTime|DateTimeImmutable
    {
        return $this->getBeforeSolarTermDate('syouman');
    }

    protected function getBousyu(): DateTime|DateTimeImmutable
    {
        return $this->getSolarTermDate('bousyu', $this->year);
    }

    protected function getNextBousyu(): DateTime|DateTimeImmutable
    {
        return $this->getNextSolarTermDate('bousyu');
    }

    protected function getBeforeBousyu(): DateTime|DateTimeImmutable
    {
        return $this->getBeforeSolarTermDate('bousyu');
    }

    protected function getGeshi(): DateTime|DateTimeImmutable
    {
        return $this->getSolarTermDate('geshi', $this->year);
    }

    protected function getNextGeshi(): DateTime|DateTimeImmutable
    {
        return $this->getNextSolarTermDate('geshi');
    }

    protected function getBeforeGeshi(): DateTime|DateTimeImmutable
    {
        return $this->getBeforeSolarTermDate('geshi');
    }

    protected function getSyousyo(): DateTime|DateTimeImmutable
    {
        return $this->getSolarTermDate('syousyo', $this->year);
    }

    protected function getNextSyousyo(): DateTime|DateTimeImmutable
    {
        return $this->getNextSolarTermDate('syousyo');
    }

    protected function getBeforeSyousyo(): DateTime|DateTimeImmutable
    {
        return $this->getBeforeSolarTermDate('syousyo');
    }

    protected function getTaisyo(): DateTime|DateTimeImmutable
    {
        return $this->getSolarTermDate('taisyo', $this->year);
    }

    protected function getNextTaisyo(): DateTime|DateTimeImmutable
    {
        return $this->getNextSolarTermDate('taisyo');
    }

    protected function getBeforeTaisyo(): DateTime|DateTimeImmutable
    {
        return $this->getBeforeSolarTermDate('taisyo');
    }

    protected function getRissyuu(): DateTime|DateTimeImmutable
    {
        return $this->getSolarTermDate('rissyuu', $this->year);
    }

    protected function getNextRissyuu(): DateTime|DateTimeImmutable
    {
        return $this->getNextSolarTermDate('rissyuu');
    }

    protected function getBeforeRissyuu(): DateTime|DateTimeImmutable
    {
        return $this->getBeforeSolarTermDate('rissyuu');
    }

    protected function getSyosyo(): DateTime|DateTimeImmutable
    {
        return $this->getSolarTermDate('syosyo', $this->year);
    }

    protected function getNextSyosyo(): DateTime|DateTimeImmutable
    {
        return $this->getNextSolarTermDate('syosyo');
    }

    protected function getBeforeSyosyo(): DateTime|DateTimeImmutable
    {
        return $this->getBeforeSolarTermDate('syosyo');
    }

    protected function getHakuro(): DateTime|DateTimeImmutable
    {
        return $this->getSolarTermDate('hakuro', $this->year);
    }

    protected function getNextHakuro(): DateTime|DateTimeImmutable
    {
        return $this->getNextSolarTermDate('hakuro');
    }

    protected function getBeforeHakuro(): DateTime|DateTimeImmutable
    {
        return $this->getBeforeSolarTermDate('hakuro');
    }

    protected function getSyuubun(): DateTime|DateTimeImmutable
    {
        return $this->getSolarTermDate('syuubun', $this->year);
    }

    protected function getNextSyuubun(): DateTime|DateTimeImmutable
    {
        return $this->getNextSolarTermDate('syuubun');
    }

    protected function getBeforeSyuubun(): DateTime|DateTimeImmutable
    {
        return $this->getBeforeSolarTermDate('syuubun');
    }

    protected function getKanro(): DateTime|DateTimeImmutable
    {
        return $this->getSolarTermDate('kanro', $this->year);
    }

    protected function getNextKanro(): DateTime|DateTimeImmutable
    {
        return $this->getNextSolarTermDate('kanro');
    }

    protected function getBeforeKanro(): DateTime|DateTimeImmutable
    {
        return $this->getBeforeSolarTermDate('kanro');
    }

    protected function getSoukou(): DateTime|DateTimeImmutable
    {
        return $this->getSolarTermDate('soukou', $this->year);
    }

    protected function getNextSoukou(): DateTime|DateTimeImmutable
    {
        return $this->getNextSolarTermDate('soukou');
    }

    protected function getBeforeSoukou(): DateTime|DateTimeImmutable
    {
        return $this->getBeforeSolarTermDate('soukou');
    }

    protected function getRittou(): DateTime|DateTimeImmutable
    {
        return $this->getSolarTermDate('rittou', $this->year);
    }

    protected function getNextRittou(): DateTime|DateTimeImmutable
    {
        return $this->getNextSolarTermDate('rittou');
    }

    protected function getBeforeRittou(): DateTime|DateTimeImmutable
    {
        return $this->getBeforeSolarTermDate('rittou');
    }

    protected function getSyousetsu(): DateTime|DateTimeImmutable
    {
        return $this->getSolarTermDate('syousetsu', $this->year);
    }

    protected function getNextSyousetsu(): DateTime|DateTimeImmutable
    {
        return $this->getNextSolarTermDate('syousetsu');
    }

    protected function getBeforeSyousetsu(): DateTime|DateTimeImmutable
    {
        return $this->getBeforeSolarTermDate('syousetsu');
    }

    protected function getTaisetsu(): DateTime|DateTimeImmutable
    {
        return $this->getSolarTermDate('taisetsu', $this->year);
    }

    protected function getNextTaisetsu(): DateTime|DateTimeImmutable
    {
        return $this->getNextSolarTermDate('taisetsu');
    }

    protected function getBeforeTaisetsu(): DateTime|DateTimeImmutable
    {
        return $this->getBeforeSolarTermDate('taisetsu');
    }

    protected function getTouji(): DateTime|DateTimeImmutable
    {
        return $this->getSolarTermDate('touji', $this->year);
    }

    protected function getNextTouji(): DateTime|DateTimeImmutable
    {
        return $this->getNextSolarTermDate('touji');
    }

    protected function getBeforeTouji(): DateTime|DateTimeImmutable
    {
        return $this->getBeforeSolarTermDate('touji');
    }

    protected function getSyoukan(): DateTime|DateTimeImmutable
    {
        return $this->getSolarTermDate('syoukan', $this->year);
    }

    protected function getNextSyoukan(): DateTime|DateTimeImmutable
    {
        return $this->getNextSolarTermDate('syoukan');
    }

    protected function getBeforeSyoukan(): DateTime|DateTimeImmutable
    {
        return $this->getBeforeSolarTermDate('syoukan');
    }

    protected function getDaikan(): DateTime|DateTimeImmutable
    {
        return $this->getSolarTermDate('daikan', $this->year);
    }

    protected function getNextDaikan(): DateTime|DateTimeImmutable
    {
        return $this->getNextSolarTermDate('daikan');
    }

    protected function getBeforeDaikan(): DateTime|DateTimeImmutable
    {
        return $this->getBeforeSolarTermDate('daikan');
    }

    protected function getRissyun(): DateTime|DateTimeImmutable
    {
        return $this->getSolarTermDate('rissyun', $this->year);
    }

    protected function getNextRissyun(): DateTime|DateTimeImmutable
    {
        return $this->getNextSolarTermDate('rissyun');
    }

    protected function getBeforeRissyun(): DateTime|DateTimeImmutable
    {
        return $this->getBeforeSolarTermDate('rissyun');
    }

    protected function getUsui(): DateTime|DateTimeImmutable
    {
        return $this->getSolarTermDate('usui', $this->year);
    }

    protected function getNextUsui(): DateTime|DateTimeImmutable
    {
        return $this->getNextSolarTermDate('usui');
    }

    protected function getBeforeUsui(): DateTime|DateTimeImmutable
    {
        return $this->getBeforeSolarTermDate('usui');
    }

    protected function getKeichitsu(): DateTime|DateTimeImmutable
    {
        return $this->getSolarTermDate('keichitsu', $this->year);
    }

    protected function getNextKeichitsu(): DateTime|DateTimeImmutable
    {
        return $this->getNextSolarTermDate('keichitsu');
    }

    protected function getBeforeKeichitsu(): DateTime|DateTimeImmutable
    {
        return $this->getBeforeSolarTermDate('keichitsu');
    }

    private function getNextSolarTermDate(string $method): DateTime|DateTimeImmutable
    {
        $year = $this->year;
        $st = $this->findSolarTerm($method, $year);

        if ($this->month > $st->month || ($this->month === $st->month && $this->day >= $st->day)) {
            $year += 1;
        }

        return $this->getSolarTermDate($method, $year);
    }

    private function getBeforeSolarTermDate(string $method): DateTime|DateTimeImmutable
    {
        $year = $this->year;
        $st = $this->findSolarTerm($method, $year);

        if ($this->month < $st->month || ($this->month === $st->month && $this->day <= $st->day)) {
            $year -= 1;
        }

        return $this->getSolarTermDate($method, $year);
    }

    private function getSolarTermDate(string $method, int $year): DateTime|DateTimeImmutable
    {
        $st = $this->findSolarTerm($method, $year);

        return $this->setDateTime($st->year, $st->month, $st->day, $this->hour, $this->minute, $this->second);
    }

    private function findSolarTerm(string $method, int $year): SolarTermDate
    {
        try {
            $SolarTerm = new SimpleSolarTerm();

            return $SolarTerm->{$method}($year);
        } catch (Throwable) {
            $SolarTerm = new SolarTerm();

            return $SolarTerm->{$method}($year);
        }
    }
}
