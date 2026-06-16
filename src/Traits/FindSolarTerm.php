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
 * @since       Release 1.0.0 から利用可能
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
    protected function getSyunbun(): DateTime|DateTimeImmutable
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
    protected function getSolarTermDate(string $method, int $year): DateTime|DateTimeImmutable
    {
        $st = $this->findSolarTerm($method, $year);

        return $this->copy()->setDateTime($st->year, $st->month, $st->day, $this->hour, $this->minute, $this->second);
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
    protected function findSolarTerm(string $method, int $year): SolarTermDate
    {
        if (Astronomy::solarAlgorithm() === Astronomy::SOLAR_VSOP87) {
            return static::callSolarTermMethod(new SolarTerm(), $method, $year);
        }

        try {
            $SolarTerm = new SimpleSolarTerm();

            return static::callSolarTermMethod($SolarTerm, $method, $year);
        } catch (Throwable) {
            $SolarTerm = new SolarTerm();

            return static::callSolarTermMethod($SolarTerm, $method, $year);
        }
    }

    /**
     * 二十四節気計算クラスのメソッドを明示分岐で呼び出す。
     *
     * @param SimpleSolarTerm|SolarTerm $solarTerm 二十四節気計算クラス
     * @param string $method 節気メソッド名
     * @param int $year 計算対象年
     * @return SolarTermDate 二十四節気の日付
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected static function callSolarTermMethod(SimpleSolarTerm|SolarTerm $solarTerm, string $method, int $year): SolarTermDate
    {
        return match ($method) {
            'syunbun' => $solarTerm->syunbun($year),
            'seimei' => $solarTerm->seimei($year),
            'kokuu' => $solarTerm->kokuu($year),
            'rikka' => $solarTerm->rikka($year),
            'syouman' => $solarTerm->syouman($year),
            'bousyu' => $solarTerm->bousyu($year),
            'geshi' => $solarTerm->geshi($year),
            'syousyo' => $solarTerm->syousyo($year),
            'taisyo' => $solarTerm->taisyo($year),
            'rissyuu' => $solarTerm->rissyuu($year),
            'syosyo' => $solarTerm->syosyo($year),
            'hakuro' => $solarTerm->hakuro($year),
            'syuubun' => $solarTerm->syuubun($year),
            'kanro' => $solarTerm->kanro($year),
            'soukou' => $solarTerm->soukou($year),
            'rittou' => $solarTerm->rittou($year),
            'syousetsu' => $solarTerm->syousetsu($year),
            'taisetsu' => $solarTerm->taisetsu($year),
            'touji' => $solarTerm->touji($year),
            'syoukan' => $solarTerm->syoukan($year),
            'daikan' => $solarTerm->daikan($year),
            'rissyun' => $solarTerm->rissyun($year),
            'usui' => $solarTerm->usui($year),
            'keichitsu' => $solarTerm->keichitsu($year),
        };
    }

    /**
     * 次の春分の日を取得する
     * @return DateTime|DateTimeImmutable
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getNextSyunbun(): DateTime|DateTimeImmutable
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
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getBeforeSyunbun(): DateTime|DateTimeImmutable
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
     * 今年の清明の日を取得する。
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getSeimei(): DateTime|DateTimeImmutable
    {
        return $this->getSolarTermDate('seimei', $this->year);
    }

    /**
     * 次の清明の日を取得する。
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getNextSeimei(): DateTime|DateTimeImmutable
    {
        return $this->getNextSolarTermDate('seimei');
    }

    /**
     * 前回の清明の日を取得する。
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getBeforeSeimei(): DateTime|DateTimeImmutable
    {
        return $this->getBeforeSolarTermDate('seimei');
    }

    /**
     * 今年の穀雨の日を取得する。
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getKokuu(): DateTime|DateTimeImmutable
    {
        return $this->getSolarTermDate('kokuu', $this->year);
    }

    /**
     * 次の穀雨の日を取得する。
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getNextKokuu(): DateTime|DateTimeImmutable
    {
        return $this->getNextSolarTermDate('kokuu');
    }

    /**
     * 前回の穀雨の日を取得する。
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getBeforeKokuu(): DateTime|DateTimeImmutable
    {
        return $this->getBeforeSolarTermDate('kokuu');
    }

    /**
     * 今年の立夏の日を取得する。
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getRikka(): DateTime|DateTimeImmutable
    {
        return $this->getSolarTermDate('rikka', $this->year);
    }

    /**
     * 次の立夏の日を取得する。
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getNextRikka(): DateTime|DateTimeImmutable
    {
        return $this->getNextSolarTermDate('rikka');
    }

    /**
     * 前回の立夏の日を取得する。
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getBeforeRikka(): DateTime|DateTimeImmutable
    {
        return $this->getBeforeSolarTermDate('rikka');
    }

    /**
     * 今年の小満の日を取得する。
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getSyouman(): DateTime|DateTimeImmutable
    {
        return $this->getSolarTermDate('syouman', $this->year);
    }

    /**
     * 次の小満の日を取得する。
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getNextSyouman(): DateTime|DateTimeImmutable
    {
        return $this->getNextSolarTermDate('syouman');
    }

    /**
     * 前回の小満の日を取得する。
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getBeforeSyouman(): DateTime|DateTimeImmutable
    {
        return $this->getBeforeSolarTermDate('syouman');
    }

    /**
     * 今年の芒種の日を取得する。
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getBousyu(): DateTime|DateTimeImmutable
    {
        return $this->getSolarTermDate('bousyu', $this->year);
    }

    /**
     * 次の芒種の日を取得する。
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getNextBousyu(): DateTime|DateTimeImmutable
    {
        return $this->getNextSolarTermDate('bousyu');
    }

    /**
     * 前回の芒種の日を取得する。
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getBeforeBousyu(): DateTime|DateTimeImmutable
    {
        return $this->getBeforeSolarTermDate('bousyu');
    }

    /**
     * 今年の夏至の日を取得する。
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getGeshi(): DateTime|DateTimeImmutable
    {
        return $this->getSolarTermDate('geshi', $this->year);
    }

    /**
     * 次の夏至の日を取得する。
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getNextGeshi(): DateTime|DateTimeImmutable
    {
        return $this->getNextSolarTermDate('geshi');
    }

    /**
     * 前回の夏至の日を取得する。
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getBeforeGeshi(): DateTime|DateTimeImmutable
    {
        return $this->getBeforeSolarTermDate('geshi');
    }

    /**
     * 今年の小暑の日を取得する。
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getSyousyo(): DateTime|DateTimeImmutable
    {
        return $this->getSolarTermDate('syousyo', $this->year);
    }

    /**
     * 次の小暑の日を取得する。
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getNextSyousyo(): DateTime|DateTimeImmutable
    {
        return $this->getNextSolarTermDate('syousyo');
    }

    /**
     * 前回の小暑の日を取得する。
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getBeforeSyousyo(): DateTime|DateTimeImmutable
    {
        return $this->getBeforeSolarTermDate('syousyo');
    }

    /**
     * 今年の大暑の日を取得する。
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getTaisyo(): DateTime|DateTimeImmutable
    {
        return $this->getSolarTermDate('taisyo', $this->year);
    }

    /**
     * 次の大暑の日を取得する。
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getNextTaisyo(): DateTime|DateTimeImmutable
    {
        return $this->getNextSolarTermDate('taisyo');
    }

    /**
     * 前回の大暑の日を取得する。
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getBeforeTaisyo(): DateTime|DateTimeImmutable
    {
        return $this->getBeforeSolarTermDate('taisyo');
    }

    /**
     * 今年の立秋の日を取得する。
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getRissyuu(): DateTime|DateTimeImmutable
    {
        return $this->getSolarTermDate('rissyuu', $this->year);
    }

    /**
     * 次の立秋の日を取得する。
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getNextRissyuu(): DateTime|DateTimeImmutable
    {
        return $this->getNextSolarTermDate('rissyuu');
    }

    /**
     * 前回の立秋の日を取得する。
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getBeforeRissyuu(): DateTime|DateTimeImmutable
    {
        return $this->getBeforeSolarTermDate('rissyuu');
    }

    /**
     * 今年の処暑の日を取得する。
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getSyosyo(): DateTime|DateTimeImmutable
    {
        return $this->getSolarTermDate('syosyo', $this->year);
    }

    /**
     * 次の処暑の日を取得する。
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getNextSyosyo(): DateTime|DateTimeImmutable
    {
        return $this->getNextSolarTermDate('syosyo');
    }

    /**
     * 前回の処暑の日を取得する。
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getBeforeSyosyo(): DateTime|DateTimeImmutable
    {
        return $this->getBeforeSolarTermDate('syosyo');
    }

    /**
     * 今年の白露の日を取得する。
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getHakuro(): DateTime|DateTimeImmutable
    {
        return $this->getSolarTermDate('hakuro', $this->year);
    }

    /**
     * 次の白露の日を取得する。
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getNextHakuro(): DateTime|DateTimeImmutable
    {
        return $this->getNextSolarTermDate('hakuro');
    }

    /**
     * 前回の白露の日を取得する。
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getBeforeHakuro(): DateTime|DateTimeImmutable
    {
        return $this->getBeforeSolarTermDate('hakuro');
    }

    /**
     * 今年の秋分の日を取得する。
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getSyuubun(): DateTime|DateTimeImmutable
    {
        return $this->getSolarTermDate('syuubun', $this->year);
    }

    /**
     * 次の秋分の日を取得する。
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getNextSyuubun(): DateTime|DateTimeImmutable
    {
        return $this->getNextSolarTermDate('syuubun');
    }

    /**
     * 前回の秋分の日を取得する。
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getBeforeSyuubun(): DateTime|DateTimeImmutable
    {
        return $this->getBeforeSolarTermDate('syuubun');
    }

    /**
     * 今年の寒露の日を取得する。
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getKanro(): DateTime|DateTimeImmutable
    {
        return $this->getSolarTermDate('kanro', $this->year);
    }

    /**
     * 次の寒露の日を取得する。
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getNextKanro(): DateTime|DateTimeImmutable
    {
        return $this->getNextSolarTermDate('kanro');
    }

    /**
     * 前回の寒露の日を取得する。
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getBeforeKanro(): DateTime|DateTimeImmutable
    {
        return $this->getBeforeSolarTermDate('kanro');
    }

    /**
     * 今年の霜降の日を取得する。
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getSoukou(): DateTime|DateTimeImmutable
    {
        return $this->getSolarTermDate('soukou', $this->year);
    }

    /**
     * 次の霜降の日を取得する。
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getNextSoukou(): DateTime|DateTimeImmutable
    {
        return $this->getNextSolarTermDate('soukou');
    }

    /**
     * 前回の霜降の日を取得する。
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getBeforeSoukou(): DateTime|DateTimeImmutable
    {
        return $this->getBeforeSolarTermDate('soukou');
    }

    /**
     * 今年の立冬の日を取得する。
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getRittou(): DateTime|DateTimeImmutable
    {
        return $this->getSolarTermDate('rittou', $this->year);
    }

    /**
     * 次の立冬の日を取得する。
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getNextRittou(): DateTime|DateTimeImmutable
    {
        return $this->getNextSolarTermDate('rittou');
    }

    /**
     * 前回の立冬の日を取得する。
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getBeforeRittou(): DateTime|DateTimeImmutable
    {
        return $this->getBeforeSolarTermDate('rittou');
    }

    /**
     * 今年の小雪の日を取得する。
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getSyousetsu(): DateTime|DateTimeImmutable
    {
        return $this->getSolarTermDate('syousetsu', $this->year);
    }

    /**
     * 次の小雪の日を取得する。
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getNextSyousetsu(): DateTime|DateTimeImmutable
    {
        return $this->getNextSolarTermDate('syousetsu');
    }

    /**
     * 前回の小雪の日を取得する。
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getBeforeSyousetsu(): DateTime|DateTimeImmutable
    {
        return $this->getBeforeSolarTermDate('syousetsu');
    }

    /**
     * 今年の大雪の日を取得する。
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getTaisetsu(): DateTime|DateTimeImmutable
    {
        return $this->getSolarTermDate('taisetsu', $this->year);
    }

    /**
     * 次の大雪の日を取得する。
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getNextTaisetsu(): DateTime|DateTimeImmutable
    {
        return $this->getNextSolarTermDate('taisetsu');
    }

    /**
     * 前回の大雪の日を取得する。
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getBeforeTaisetsu(): DateTime|DateTimeImmutable
    {
        return $this->getBeforeSolarTermDate('taisetsu');
    }

    /**
     * 今年の冬至の日を取得する。
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getTouji(): DateTime|DateTimeImmutable
    {
        return $this->getSolarTermDate('touji', $this->year);
    }

    /**
     * 次の冬至の日を取得する。
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getNextTouji(): DateTime|DateTimeImmutable
    {
        return $this->getNextSolarTermDate('touji');
    }

    /**
     * 前回の冬至の日を取得する。
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getBeforeTouji(): DateTime|DateTimeImmutable
    {
        return $this->getBeforeSolarTermDate('touji');
    }

    /**
     * 今年の小寒の日を取得する。
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getSyoukan(): DateTime|DateTimeImmutable
    {
        return $this->getSolarTermDate('syoukan', $this->year);
    }

    /**
     * 次の小寒の日を取得する。
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getNextSyoukan(): DateTime|DateTimeImmutable
    {
        return $this->getNextSolarTermDate('syoukan');
    }

    /**
     * 前回の小寒の日を取得する。
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getBeforeSyoukan(): DateTime|DateTimeImmutable
    {
        return $this->getBeforeSolarTermDate('syoukan');
    }

    /**
     * 今年の大寒の日を取得する。
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getDaikan(): DateTime|DateTimeImmutable
    {
        return $this->getSolarTermDate('daikan', $this->year);
    }

    /**
     * 次の大寒の日を取得する。
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getNextDaikan(): DateTime|DateTimeImmutable
    {
        return $this->getNextSolarTermDate('daikan');
    }

    /**
     * 前回の大寒の日を取得する。
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getBeforeDaikan(): DateTime|DateTimeImmutable
    {
        return $this->getBeforeSolarTermDate('daikan');
    }

    /**
     * 今年の立春の日を取得する。
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getRissyun(): DateTime|DateTimeImmutable
    {
        return $this->getSolarTermDate('rissyun', $this->year);
    }

    /**
     * 次の立春の日を取得する。
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getNextRissyun(): DateTime|DateTimeImmutable
    {
        return $this->getNextSolarTermDate('rissyun');
    }

    /**
     * 前回の立春の日を取得する。
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getBeforeRissyun(): DateTime|DateTimeImmutable
    {
        return $this->getBeforeSolarTermDate('rissyun');
    }

    /**
     * 今年の雨水の日を取得する。
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getUsui(): DateTime|DateTimeImmutable
    {
        return $this->getSolarTermDate('usui', $this->year);
    }

    /**
     * 次の雨水の日を取得する。
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getNextUsui(): DateTime|DateTimeImmutable
    {
        return $this->getNextSolarTermDate('usui');
    }

    /**
     * 前回の雨水の日を取得する。
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getBeforeUsui(): DateTime|DateTimeImmutable
    {
        return $this->getBeforeSolarTermDate('usui');
    }

    /**
     * 今年の啓蟄の日を取得する。
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getKeichitsu(): DateTime|DateTimeImmutable
    {
        return $this->getSolarTermDate('keichitsu', $this->year);
    }

    /**
     * 次の啓蟄の日を取得する。
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getNextKeichitsu(): DateTime|DateTimeImmutable
    {
        return $this->getNextSolarTermDate('keichitsu');
    }

    /**
     * 前回の啓蟄の日を取得する。
     * @return \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getBeforeKeichitsu(): DateTime|DateTimeImmutable
    {
        return $this->getBeforeSolarTermDate('keichitsu');
    }
}
