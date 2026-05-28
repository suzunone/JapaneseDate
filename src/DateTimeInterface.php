<?php

namespace JapaneseDate;

/**
 * 日本の暦機能を提供する日付オブジェクト用の共通インターフェース。
 *
 * 可変（Mutable）オブジェクトである {@see \JapaneseDate\DateTime} と、
 * 不変（Immutable）オブジェクトである {@see \JapaneseDate\DateTimeImmutable} の
 * 両方に共通する暦判定・取得メソッドの規格を定義します。
 *
 * 【設計の目的】
 * 本パッケージのオブジェクトを引数や返り値の型宣言として受け取る際、オブジェクトの可変・不変の特性に
 * 依存せず、日本の祝日判定や元号取得などの暦機能を共通のAPIとして透過的に扱う（ポリモーフィズムを実現する）
 * ために用意されています。
 *
 * 【コード例：型宣言での活用】
 * ```php
 * // 可変・不変のどちらのインスタンスが渡されても、安全に祝日判定を行える
 * public function processBusinessLogic(DateTimeInterface $date)
 * {
 * if ($date->isHoliday()) {
 * // 祝日時の処理
 * }
 * }
 * ```
 *
 * @category    DateTime
 * @package     JapaneseDate
 * @subpackage  DateTime
 * @author      Suzunone <suzunone.eleven@gmail.com>
 * @copyright   Suzunone
 * @license     BSD-2
 * @link        https://github.com/suzunone/JapaneseDate
 * @see         https://github.com/suzunone/JapaneseDate
 * @see         https://carbon.nesbot.com/docs/
 * @since        1.0.0
 */
interface DateTimeInterface
{

}
