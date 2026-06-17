<?php

namespace JapaneseDate\Values;

use ErrorException;
use JapaneseDate\DateTime;
use JapaneseDate\DateTimeImmutable;

/**
 * 歴史的元号の名称・朝廷区分・有効期間を表す読み取り専用の値オブジェクト。
 *
 * {@see \JapaneseDate\Components\HistoricalEra} が、指定日の前後に存在する元号情報を
 * 返す際に使用します。元号名・読み・朝廷区分は public readonly プロパティとして公開し、
 * 開始日・終了日は magic property として clone した日付オブジェクトを返します。
 *
 * 開始日と終了日は、コンストラクタに渡された基準日オブジェクトと同じ可変性を保ちます。
 * つまり {@see DateTime} を渡した場合は {@see startDate} と {@see endDate} も
 * {@see DateTime}、{@see DateTimeImmutable} を渡した場合は
 * {@see DateTimeImmutable} になります。
 *
 * @category    DateTime
 * @package     JapaneseDate
 * @subpackage  Values
 * @author      Suzunone <suzunone.eleven@gmail.com>
 * @version     GIT: $Id$
 * @link        https://github.com/suzunone/JapaneseDate
 * @see         \JapaneseDate\Components\HistoricalEra
 * @see         https://github.com/suzunone/JapaneseDate
 * @since       1.0.0
 *
 * @property-read DateTime|DateTimeImmutable $startDate 元号の開始日。
 * @property-read DateTime|DateTimeImmutable $endDate   元号の終了日。
 */
class Era
{
    /**
     * 元号の開始日。
     *
     * 外部から取得される際は {@see __get()} により clone が返されます。
     *
     * @var DateTime|DateTimeImmutable
     */
    protected DateTime|DateTimeImmutable $startDate;

    /**
     * 元号の終了日。
     *
     * 外部から取得される際は {@see __get()} により clone が返されます。
     *
     * @var DateTime|DateTimeImmutable
     */
    protected DateTime|DateTimeImmutable $endDate;

    /**
     * 元号情報を生成します。
     *
     * `$start` と `$end` は {@see DateTime::factory} または
     * {@see DateTimeImmutable::factory} に渡される日付文字列です。
     * `$currentDate` が immutable の場合は開始日・終了日も immutable、mutable の場合は
     * mutable な日付オブジェクトとして保持します。
     *
     * @param string $name 元号名（例: "延元"）。
     * @param string $kana 元号名の読み。
     * @param string $court 朝廷区分（{@see DateTime::CHOUTEI_NORTH}、{@see DateTime::CHOUTEI_SOUTH}、{@see DateTime::CHOUTEI_MAIN}）。
     * @param string $start 元号の開始日を表す日付文字列。
     * @param string $end 元号の終了日を表す日付文字列。
     * @param DateTime|DateTimeImmutable $currentDate 作成元の日付オブジェクト。
     *
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\NativeDateTimeException
     */
    public function __construct(public readonly string $name, public readonly string $kana, public readonly string $court, string $start, string $end, protected readonly DateTime|DateTimeImmutable $currentDate)
    {
        if ($currentDate instanceof DateTimeImmutable) {
            $this->startDate = DateTimeImmutable::factory($start);
            $this->endDate = DateTimeImmutable::factory($end);
        } else {
            $this->startDate = DateTime::factory($start);
            $this->endDate = DateTime::factory($end);
        }
    }

    /**
     * protected な日付プロパティを読み取り専用で取得します。
     *
     * `startDate` と `endDate` は内部状態を変更されないよう clone を返します。
     *
     * @param string $name 取得するプロパティ名。
     *
     * @return DateTime|DateTimeImmutable 元号の開始日または終了日。
     * @throws ErrorException 未定義プロパティを取得しようとした場合。
     */
    public function __get(string $name): DateTime|DateTimeImmutable
    {
        if ($name !== 'startDate' && $name !== 'endDate') {
            throw new ErrorException('Undefined property ' . $name);
        }

        return clone $this->$name;
    }

    /**
     * 読み取り専用オブジェクトへの代入を拒否します。
     *
     * @param string $name 代入しようとしたプロパティ名。
     * @param mixed $value 代入しようとした値。
     *
     * @throws ErrorException
     */
    public function __set(string $name, mixed $value): void
    {
        throw new ErrorException('Cannot modify readonly property ' . $name);
    }

    /**
     * 指定したプロパティが存在するかを判定します。
     *
     * @param string $name 判定するプロパティ名。
     *
     * @return bool プロパティが存在する場合は true。
     */
    public function __isset(string $name): bool
    {
        return isset($this->$name);
    }
}
