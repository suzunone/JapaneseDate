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
 * 二十四節気の日付取得・移動メソッドをまとめたトレイト。
 *
 * 太陽アルゴリズムに応じて SimpleSolarTerm（参照テーブル）または SolarTerm（天文計算）を
 * 自動選択し、今年・次回・前回の各節気日付を DateTime / DateTimeImmutable で返す。
 *
 * @category    DateTime
 * @package     JapaneseDate
 * @subpackage  Traits
 * @author      Suzunone <suzunone.eleven@gmail.com>
 * @copyright   JapaneseDate
 * @license     BSD-2
 * @link        https://github.com/suzunone/JapaneseDate
 * @see         https://github.com/suzunone/JapaneseDate
 * @since       1.0.0
 * @mixin DateTime
 * @mixin DateTimeImmutable
 */
trait FindSolarTerm
{
    /**
     * 今年の春分の日を取得する
     * @return DateTime|DateTimeImmutable
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getSyunbun()
    {
        return $this->getSolarTermDate('syunbun', $this->year);
    }

    /**
     * 指定節気メソッドと年を使って二十四節気の日付を取得し、現在インスタンスと同じ時刻でコピーを返す。
     *
     * @param string $method 節気メソッド名（例: 'syunbun'）
     * @param int $year 計算対象年
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getSolarTermDate($method, $year)
    {
        $SolarTermDate = $this->findSolarTerm($method, $year);

        return $this->copy()->setDateTime($SolarTermDate->year, $SolarTermDate->month, $SolarTermDate->day, $this->hour, $this->minute, $this->second);
    }

    /**
     * 太陽アルゴリズムを選択して二十四節気の日付情報を取得する。
     *
     * VSOP87 の場合は SolarTerm を直接使用し、それ以外は SimpleSolarTerm を試みて
     * 失敗した場合に SolarTerm へフォールバックする。
     *
     * @param string $method 節気メソッド名（例: 'syunbun'）
     * @param int $year 計算対象年
     * @return \JapaneseDate\Elements\SolarTermDate
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function findSolarTerm($method, $year): SolarTermDate
    {
        if (Astronomy::solarAlgorithm() === Astronomy::SOLAR_VSOP87) {
            return static::callSolarTermMethod(new SolarTerm(), $method, $year);
        }

        try {
            $SolarTerm = new SimpleSolarTerm();

            return static::callSolarTermMethod($SolarTerm, $method, $year);
        } catch (Throwable $exception) {
            $SolarTerm = new SolarTerm();

            return static::callSolarTermMethod($SolarTerm, $method, $year);
        }
    }

    /**
     * 二十四節気計算クラスのメソッドを明示分岐で呼び出す。
     *
     * @param SimpleSolarTerm|SolarTerm $SolarTerm 二十四節気計算クラス
     * @param string $method 節気メソッド名
     * @param int $year 計算対象年
     * @return SolarTermDate 二十四節気の日付
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected static function callSolarTermMethod($SolarTerm, $method, $year): SolarTermDate
    {
        switch ($method) {
            case 'syunbun':
                return $SolarTerm->syunbun($year);
            case 'seimei':
                return $SolarTerm->seimei($year);
            case 'kokuu':
                return $SolarTerm->kokuu($year);
            case 'rikka':
                return $SolarTerm->rikka($year);
            case 'syouman':
                return $SolarTerm->syouman($year);
            case 'bousyu':
                return $SolarTerm->bousyu($year);
            case 'geshi':
                return $SolarTerm->geshi($year);
            case 'syousyo':
                return $SolarTerm->syousyo($year);
            case 'taisyo':
                return $SolarTerm->taisyo($year);
            case 'rissyuu':
                return $SolarTerm->rissyuu($year);
            case 'syosyo':
                return $SolarTerm->syosyo($year);
            case 'hakuro':
                return $SolarTerm->hakuro($year);
            case 'syuubun':
                return $SolarTerm->syuubun($year);
            case 'kanro':
                return $SolarTerm->kanro($year);
            case 'soukou':
                return $SolarTerm->soukou($year);
            case 'rittou':
                return $SolarTerm->rittou($year);
            case 'syousetsu':
                return $SolarTerm->syousetsu($year);
            case 'taisetsu':
                return $SolarTerm->taisetsu($year);
            case 'touji':
                return $SolarTerm->touji($year);
            case 'syoukan':
                return $SolarTerm->syoukan($year);
            case 'daikan':
                return $SolarTerm->daikan($year);
            case 'rissyun':
                return $SolarTerm->rissyun($year);
            case 'usui':
                return $SolarTerm->usui($year);
            case 'keichitsu':
                return $SolarTerm->keichitsu($year);
        }
    }

    /**
     * 次の春分の日を取得する
     * @return DateTime|DateTimeImmutable
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getNextSyunbun()
    {
        return $this->getNextSolarTermDate('syunbun');
    }

    /**
     * 次回の二十四節気日付を取得する。
     *
     * 当年の節気日が現在日時以前であれば翌年の日付を返す。
     *
     * @param string $method 節気メソッド名（例: 'syunbun'）
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getNextSolarTermDate($method)
    {
        $year = $this->year;
        $SolarTermDate = $this->findSolarTerm($method, $year);

        if ($this->month > $SolarTermDate->month || ($this->month === $SolarTermDate->month && $this->day >= $SolarTermDate->day)) {
            ++$year;
        }

        return $this->getSolarTermDate($method, $year);
    }

    /**
     * 前回の春分の日を取得する
     * @return DateTime|DateTimeImmutable
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getBeforeSyunbun()
    {
        return $this->getBeforeSolarTermDate('syunbun');
    }

    /**
     * 前回の二十四節気日付を取得する。
     *
     * 当年の節気日が現在日時以降であれば前年の日付を返す。
     *
     * @param string $method 節気メソッド名（例: 'syunbun'）
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getBeforeSolarTermDate($method)
    {
        $year = $this->year;
        $SolarTermDate = $this->findSolarTerm($method, $year);

        if ($this->month < $SolarTermDate->month || ($this->month === $SolarTermDate->month && $this->day <= $SolarTermDate->day)) {
            --$year;
        }

        return $this->getSolarTermDate($method, $year);
    }

    /**
     * 今年の清明の日を取得する。
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getSeimei()
    {
        return $this->getSolarTermDate('seimei', $this->year);
    }

    /**
     * 次の清明の日を取得する。
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getNextSeimei()
    {
        return $this->getNextSolarTermDate('seimei');
    }

    /**
     * 前回の清明の日を取得する。
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getBeforeSeimei()
    {
        return $this->getBeforeSolarTermDate('seimei');
    }

    /**
     * 今年の穀雨の日を取得する。
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getKokuu()
    {
        return $this->getSolarTermDate('kokuu', $this->year);
    }

    /**
     * 次の穀雨の日を取得する。
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getNextKokuu()
    {
        return $this->getNextSolarTermDate('kokuu');
    }

    /**
     * 前回の穀雨の日を取得する。
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getBeforeKokuu()
    {
        return $this->getBeforeSolarTermDate('kokuu');
    }

    /**
     * 今年の立夏の日を取得する。
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getRikka()
    {
        return $this->getSolarTermDate('rikka', $this->year);
    }

    /**
     * 次の立夏の日を取得する。
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getNextRikka()
    {
        return $this->getNextSolarTermDate('rikka');
    }

    /**
     * 前回の立夏の日を取得する。
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getBeforeRikka()
    {
        return $this->getBeforeSolarTermDate('rikka');
    }

    /**
     * 今年の小満の日を取得する。
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getSyouman()
    {
        return $this->getSolarTermDate('syouman', $this->year);
    }

    /**
     * 次の小満の日を取得する。
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getNextSyouman()
    {
        return $this->getNextSolarTermDate('syouman');
    }

    /**
     * 前回の小満の日を取得する。
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getBeforeSyouman()
    {
        return $this->getBeforeSolarTermDate('syouman');
    }

    /**
     * 今年の芒種の日を取得する。
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getBousyu()
    {
        return $this->getSolarTermDate('bousyu', $this->year);
    }

    /**
     * 次の芒種の日を取得する。
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getNextBousyu()
    {
        return $this->getNextSolarTermDate('bousyu');
    }

    /**
     * 前回の芒種の日を取得する。
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getBeforeBousyu()
    {
        return $this->getBeforeSolarTermDate('bousyu');
    }

    /**
     * 今年の夏至の日を取得する。
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getGeshi()
    {
        return $this->getSolarTermDate('geshi', $this->year);
    }

    /**
     * 次の夏至の日を取得する。
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getNextGeshi()
    {
        return $this->getNextSolarTermDate('geshi');
    }

    /**
     * 前回の夏至の日を取得する。
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getBeforeGeshi()
    {
        return $this->getBeforeSolarTermDate('geshi');
    }

    /**
     * 今年の小暑の日を取得する。
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getSyousyo()
    {
        return $this->getSolarTermDate('syousyo', $this->year);
    }

    /**
     * 次の小暑の日を取得する。
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getNextSyousyo()
    {
        return $this->getNextSolarTermDate('syousyo');
    }

    /**
     * 前回の小暑の日を取得する。
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getBeforeSyousyo()
    {
        return $this->getBeforeSolarTermDate('syousyo');
    }

    /**
     * 今年の大暑の日を取得する。
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getTaisyo()
    {
        return $this->getSolarTermDate('taisyo', $this->year);
    }

    /**
     * 次の大暑の日を取得する。
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getNextTaisyo()
    {
        return $this->getNextSolarTermDate('taisyo');
    }

    /**
     * 前回の大暑の日を取得する。
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getBeforeTaisyo()
    {
        return $this->getBeforeSolarTermDate('taisyo');
    }

    /**
     * 今年の立秋の日を取得する。
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getRissyuu()
    {
        return $this->getSolarTermDate('rissyuu', $this->year);
    }

    /**
     * 次の立秋の日を取得する。
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getNextRissyuu()
    {
        return $this->getNextSolarTermDate('rissyuu');
    }

    /**
     * 前回の立秋の日を取得する。
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getBeforeRissyuu()
    {
        return $this->getBeforeSolarTermDate('rissyuu');
    }

    /**
     * 今年の処暑の日を取得する。
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getSyosyo()
    {
        return $this->getSolarTermDate('syosyo', $this->year);
    }

    /**
     * 次の処暑の日を取得する。
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getNextSyosyo()
    {
        return $this->getNextSolarTermDate('syosyo');
    }

    /**
     * 前回の処暑の日を取得する。
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getBeforeSyosyo()
    {
        return $this->getBeforeSolarTermDate('syosyo');
    }

    /**
     * 今年の白露の日を取得する。
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getHakuro()
    {
        return $this->getSolarTermDate('hakuro', $this->year);
    }

    /**
     * 次の白露の日を取得する。
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getNextHakuro()
    {
        return $this->getNextSolarTermDate('hakuro');
    }

    /**
     * 前回の白露の日を取得する。
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getBeforeHakuro()
    {
        return $this->getBeforeSolarTermDate('hakuro');
    }

    /**
     * 今年の秋分の日を取得する。
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getSyuubun()
    {
        return $this->getSolarTermDate('syuubun', $this->year);
    }

    /**
     * 次の秋分の日を取得する。
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getNextSyuubun()
    {
        return $this->getNextSolarTermDate('syuubun');
    }

    /**
     * 前回の秋分の日を取得する。
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getBeforeSyuubun()
    {
        return $this->getBeforeSolarTermDate('syuubun');
    }

    /**
     * 今年の寒露の日を取得する。
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getKanro()
    {
        return $this->getSolarTermDate('kanro', $this->year);
    }

    /**
     * 次の寒露の日を取得する。
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getNextKanro()
    {
        return $this->getNextSolarTermDate('kanro');
    }

    /**
     * 前回の寒露の日を取得する。
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getBeforeKanro()
    {
        return $this->getBeforeSolarTermDate('kanro');
    }

    /**
     * 今年の霜降の日を取得する。
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getSoukou()
    {
        return $this->getSolarTermDate('soukou', $this->year);
    }

    /**
     * 次の霜降の日を取得する。
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getNextSoukou()
    {
        return $this->getNextSolarTermDate('soukou');
    }

    /**
     * 前回の霜降の日を取得する。
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getBeforeSoukou()
    {
        return $this->getBeforeSolarTermDate('soukou');
    }

    /**
     * 今年の立冬の日を取得する。
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getRittou()
    {
        return $this->getSolarTermDate('rittou', $this->year);
    }

    /**
     * 次の立冬の日を取得する。
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getNextRittou()
    {
        return $this->getNextSolarTermDate('rittou');
    }

    /**
     * 前回の立冬の日を取得する。
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getBeforeRittou()
    {
        return $this->getBeforeSolarTermDate('rittou');
    }

    /**
     * 今年の小雪の日を取得する。
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getSyousetsu()
    {
        return $this->getSolarTermDate('syousetsu', $this->year);
    }

    /**
     * 次の小雪の日を取得する。
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getNextSyousetsu()
    {
        return $this->getNextSolarTermDate('syousetsu');
    }

    /**
     * 前回の小雪の日を取得する。
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getBeforeSyousetsu()
    {
        return $this->getBeforeSolarTermDate('syousetsu');
    }

    /**
     * 今年の大雪の日を取得する。
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getTaisetsu()
    {
        return $this->getSolarTermDate('taisetsu', $this->year);
    }

    /**
     * 次の大雪の日を取得する。
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getNextTaisetsu()
    {
        return $this->getNextSolarTermDate('taisetsu');
    }

    /**
     * 前回の大雪の日を取得する。
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getBeforeTaisetsu()
    {
        return $this->getBeforeSolarTermDate('taisetsu');
    }

    /**
     * 今年の冬至の日を取得する。
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getTouji()
    {
        return $this->getSolarTermDate('touji', $this->year);
    }

    /**
     * 次の冬至の日を取得する。
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getNextTouji()
    {
        return $this->getNextSolarTermDate('touji');
    }

    /**
     * 前回の冬至の日を取得する。
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getBeforeTouji()
    {
        return $this->getBeforeSolarTermDate('touji');
    }

    /**
     * 今年の小寒の日を取得する。
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getSyoukan()
    {
        return $this->getSolarTermDate('syoukan', $this->year);
    }

    /**
     * 次の小寒の日を取得する。
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getNextSyoukan()
    {
        return $this->getNextSolarTermDate('syoukan');
    }

    /**
     * 前回の小寒の日を取得する。
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getBeforeSyoukan()
    {
        return $this->getBeforeSolarTermDate('syoukan');
    }

    /**
     * 今年の大寒の日を取得する。
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getDaikan()
    {
        return $this->getSolarTermDate('daikan', $this->year);
    }

    /**
     * 次の大寒の日を取得する。
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getNextDaikan()
    {
        return $this->getNextSolarTermDate('daikan');
    }

    /**
     * 前回の大寒の日を取得する。
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getBeforeDaikan()
    {
        return $this->getBeforeSolarTermDate('daikan');
    }

    /**
     * 今年の立春の日を取得する。
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getRissyun()
    {
        return $this->getSolarTermDate('rissyun', $this->year);
    }

    /**
     * 次の立春の日を取得する。
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getNextRissyun()
    {
        return $this->getNextSolarTermDate('rissyun');
    }

    /**
     * 前回の立春の日を取得する。
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getBeforeRissyun()
    {
        return $this->getBeforeSolarTermDate('rissyun');
    }

    /**
     * 今年の雨水の日を取得する。
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getUsui()
    {
        return $this->getSolarTermDate('usui', $this->year);
    }

    /**
     * 次の雨水の日を取得する。
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getNextUsui()
    {
        return $this->getNextSolarTermDate('usui');
    }

    /**
     * 前回の雨水の日を取得する。
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getBeforeUsui()
    {
        return $this->getBeforeSolarTermDate('usui');
    }

    /**
     * 今年の啓蟄の日を取得する。
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getKeichitsu()
    {
        return $this->getSolarTermDate('keichitsu', $this->year);
    }

    /**
     * 次の啓蟄の日を取得する。
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getNextKeichitsu()
    {
        return $this->getNextSolarTermDate('keichitsu');
    }

    /**
     * 前回の啓蟄の日を取得する。
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getBeforeKeichitsu()
    {
        return $this->getBeforeSolarTermDate('keichitsu');
    }
}
