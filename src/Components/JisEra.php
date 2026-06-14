<?php

/**
 * JisEra.php
 *
 * 近代元号（明治〜令和）に関する判定・変換・表示・パースのロジックを集約したコンポーネントです。
 * {@see \JapaneseDate\Traits\Modern} および {@see \JapaneseDate\Traits\Factory} の
 * 元号処理をここに統一し、元号の追加・修正を一箇所で管理できるようにします。
 *
 * @category    DateTime
 * @package     JapaneseDate
 * @subpackage  Components
 * @author      Suzunone <suzunone.eleven@gmail.com>
 * @copyright   Suzunone
 * @license     BSD-2
 * @link        https://github.com/suzunone/JapaneseDate
 * @see         https://github.com/suzunone/JapaneseDate
 * @since       8.4.0
 */

namespace JapaneseDate\Components;

use DateTimeImmutable;
use DateTimeInterface;
use DateTimeZone;
use JapaneseDate\DateTime;

/**
 * 近代元号（明治〜令和）の判定・変換・表示・パースを担うコンポーネント。
 *
 * 以下の機能を提供します:
 * - 日付から元号定数を判定する {@see getEraKey()}
 * - 西暦年と元号定数から元号年を計算する {@see getEraYear()}
 * - 元号定数から元号名文字列を返す {@see getEraNameString()}
 * - JIS 形式・和暦形式の日付文字列を Unix タイムスタンプへ変換する {@see parseJisDate()}
 *
 * @category    DateTime
 * @package     JapaneseDate
 * @subpackage  Components
 * @author      Suzunone <suzunone.eleven@gmail.com>
 * @copyright   Suzunone
 * @license     BSD-2
 * @link        https://github.com/suzunone/JapaneseDate
 * @see         https://github.com/suzunone/JapaneseDate
 * @since       8.4.0
 */
class JisEra
{
    /**
     * Era のシングルトンインスタンス。
     *
     * @var static|null
     */
    protected static $instance;

    /**
     * 元号定数と元号名文字列のマップ。
     *
     * @var array<int, string>
     */
    protected $eraNames = [
        DateTime::ERA_MEIJI => '明治',
        DateTime::ERA_TAISHO => '大正',
        DateTime::ERA_SHOWA => '昭和',
        DateTime::ERA_HEISEI => '平成',
        DateTime::ERA_REIWA => '令和',
    ];

    /**
     * 元号定数と元号開始年（西暦）のマップ。
     * 元号年の計算に使用します（元号年 = 西暦年 - 開始年 + 1）。
     *
     * @var array<int, int>
     */
    protected $eraStartYears = [
        DateTime::ERA_MEIJI => 1868,
        DateTime::ERA_TAISHO => 1912,
        DateTime::ERA_SHOWA => 1926,
        DateTime::ERA_HEISEI => 1989,
        DateTime::ERA_REIWA => 2019,
    ];

    /**
     * JIS 日付パース用の元号ベース年マップ。
     *
     * キーは元号の漢字名および一文字アルファベット略称、値は「元号開始年 - 1」です。
     * パース時に `ベース年 + 元号年 = 西暦年` となるよう調整されています。
     *
     * @var array<string, int>
     */
    protected $eraParseBaseYears = [
        '明治' => 1867,
        '大正' => 1911,
        '昭和' => 1925,
        '平成' => 1988,
        '令和' => 2018,
        'M' => 1867,
        'T' => 1911,
        'S' => 1925,
        'H' => 1988,
        'R' => 2018,
    ];

    /**
     * 元号の開始日時（Asia/Tokyo）の Unix タイムスタンプキャッシュ。
     *
     * @var array<int, int>
     */
    protected $eraStartTimestamps = [];

    /**
     * Era コンストラクタ。
     * 元号開始日時の Unix タイムスタンプをあらかじめ計算してキャッシュします。
     */
    public function __construct()
    {
        $jst = new DateTimeZone('Asia/Tokyo');

        $starts = [
            DateTime::ERA_TAISHO => '1912-07-30 00:00:00',
            DateTime::ERA_SHOWA => '1926-12-25 00:00:00',
            DateTime::ERA_HEISEI => '1989-01-08 00:00:00',
            DateTime::ERA_REIWA => '2019-05-01 00:00:00',
        ];

        foreach ($starts as $era => $dateStr) {
            $dt = DateTimeImmutable::createFromFormat('!Y-m-d H:i:s', $dateStr, $jst);
            $this->eraStartTimestamps[$era] = $dt->getTimestamp();
        }
    }

    /**
     * Era コンポーネントのファクトリメソッド。
     *
     * @return static
     */
    public static function factory()
    {
        if (static::$instance === null) {
            static::$instance = new static();
        }

        return static::$instance;
    }

    /**
     * 指定した日付が属する近代元号の定数を返します。
     *
     * 日付のタイムスタンプと各元号開始日時のタイムスタンプを比較して判定します。
     *
     * @param DateTimeInterface $date 判定対象の日付
     * @return int 元号定数（{@see DateTime::ERA_MEIJI} ～ {@see DateTime::ERA_REIWA}）
     */
    public function getEraKey($date): int
    {
        $ts = $date->getTimestamp();

        if ($ts < $this->eraStartTimestamps[DateTime::ERA_TAISHO]) {
            return DateTime::ERA_MEIJI;
        }

        if ($ts < $this->eraStartTimestamps[DateTime::ERA_SHOWA]) {
            return DateTime::ERA_TAISHO;
        }

        if ($ts < $this->eraStartTimestamps[DateTime::ERA_HEISEI]) {
            return DateTime::ERA_SHOWA;
        }

        if ($ts < $this->eraStartTimestamps[DateTime::ERA_REIWA]) {
            return DateTime::ERA_HEISEI;
        }

        return DateTime::ERA_REIWA;
    }

    /**
     * 西暦年と元号定数から元号年（1始まり）を計算して返します。
     *
     * 計算式: 元号年 = 西暦年 - 元号開始年 + 1
     *
     * @param int $gregorianYear 西暦年
     * @param int $eraKey 元号定数
     * @return int 元号年（1始まりの正整数）
     */
    public function getEraYear($gregorianYear, $eraKey): int
    {
        return $gregorianYear - $this->eraStartYears[$eraKey] + 1;
    }

    /**
     * 元号定数に対応する元号名文字列（日本語）を返します。
     *
     * @param int $eraKey 元号定数
     * @return string 元号名（「明治」「大正」「昭和」「平成」「令和」のいずれか）。未知のキーは空文字列。
     */
    public function getEraNameString($eraKey): string
    {
        return $this->eraNames[$eraKey] ?? '';
    }

    /**
     * JIS 形式・和暦形式の日付文字列を Unix タイムスタンプへ変換します。
     *
     * 以下の書式に対応しています:
     * - ISO / JIS 形式: `YYYY-MM-DD` / `YYYY/MM/DD` （時刻部分は省略可）
     * - 日本語西暦形式: `YYYY年MM月DD日` （時刻部分は省略可）
     * - 漢字元号形式: `明治MM年NN月DD日` 〜 `令和MM年NN月DD日` （時刻部分は省略可）
     * - アルファベット元号形式: `MYY-MM-DD` / `TYY-MM-DD` など（M/T/S/H/R）
     * - 上記以外: `strtotime()` でのフォールバック解析
     * - マイクロ秒サフィックス `.NNNNNN` がある場合、浮動小数点数として返します。
     *
     * @param string $date_str パースする日付文字列
     * @return int|float|null Unix タイムスタンプ（マイクロ秒がある場合は float）、解析失敗時は null
     * @param \DateTimeZone|null $default_timezone
     */
    public function parseJisDate($date_str, $default_timezone = null)
    {
        $date_str = trim($date_str);
        $japaneseTimezone = new DateTimeZone('Asia/Tokyo');

        $microtime = 0.0;
        if (preg_match('/\.(\d{1,6})\s*$/', $date_str, $matches) === 1) {
            $microtime = (float) ('0.' . $matches[1]);
            $date_str = preg_replace('/\.\d{1,6}\s*$/', '', $date_str);
        }

        $parseComponents = static function (array $matches): array {
            return [
                (int) $matches[1],
                (int) $matches[2],
                (int) $matches[3],
                isset($matches[4]) && $matches[4] !== '' ? (int) $matches[4] : 0,
                isset($matches[5]) && $matches[5] !== '' ? (int) $matches[5] : 0,
                isset($matches[6]) && $matches[6] !== '' ? (int) $matches[6] : 0,
            ];
        };

        $createTimestamp = static function (int $year, int $month, int $day, int $hour, int $minute, int $second, DateTimeZone $timezone) use ($microtime): ?float {
            $date = DateTimeImmutable::createFromFormat(
                '!Y-m-d H:i:s',
                sprintf('%04d-%02d-%02d %02d:%02d:%02d', $year, $month, $day, $hour, $minute, $second),
                $timezone
            );
            $errors = DateTimeImmutable::getLastErrors();

            if ($date === false || ($errors !== false && ($errors['warning_count'] > 0 || $errors['error_count'] > 0))) {
                return null;
            }

            return (float) $date->getTimestamp() + $microtime;
        };

        if (preg_match('/^(\d{4})[-\/](\d{1,2})[-\/](\d{1,2})(?:[ T](\d{1,2}):(\d{1,2})(?::(\d{1,2}))?)?$/', $date_str, $matches) === 1) {
            $tz = $default_timezone ?? $japaneseTimezone;
            [$year, $month, $day, $hour, $minute, $second] = $parseComponents($matches);

            return $createTimestamp($year, $month, $day, $hour, $minute, $second, $tz);
        }

        $timePattern = '(?:\s+(\d{1,2})時(\d{1,2})分(?:(\d{1,2})秒)?)?';
        if (preg_match('/^(\d{4})年(\d{1,2})月(\d{1,2})日' . $timePattern . '$/u', $date_str, $matches) === 1) {
            [$year, $month, $day, $hour, $minute, $second] = $parseComponents($matches);

            return $createTimestamp($year, $month, $day, $hour, $minute, $second, $japaneseTimezone);
        }

        if (preg_match('/^(明治|大正|昭和|平成|令和)(\d{1,2})年(\d{1,2})月(\d{1,2})日' . $timePattern . '$/u', $date_str, $matches) === 1) {
            return $createTimestamp(
                $this->eraParseBaseYears[$matches[1]] + (int) $matches[2],
                (int) $matches[3],
                (int) $matches[4],
                isset($matches[5]) && $matches[5] !== '' ? (int) $matches[5] : 0,
                isset($matches[6]) && $matches[6] !== '' ? (int) $matches[6] : 0,
                isset($matches[7]) && $matches[7] !== '' ? (int) $matches[7] : 0,
                $japaneseTimezone
            );
        }

        if (preg_match('/^([MTSHR])(\d{1,2})[-\/](\d{1,2})[-\/](\d{1,2})$/i', $date_str, $matches) === 1) {
            $era = strtoupper($matches[1]);

            return $createTimestamp(
                $this->eraParseBaseYears[$era] + (int) $matches[2],
                (int) $matches[3],
                (int) $matches[4],
                0,
                0,
                0,
                $japaneseTimezone
            );
        }

        $timestamp = strtotime($date_str);
        if ($timestamp !== false) {
            return (float) $timestamp + $microtime;
        }

        return null;
    }
}
