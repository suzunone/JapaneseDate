<?php

/**
 * SeventyTwoKou.php
 *
 * 七十二候（しちじゅうにこう）に関する getter および日付移動メソッドを定義した Trait です。
 * このファイルは {@see \JapaneseDate\DateTime} および
 * {@see \JapaneseDate\DateTimeImmutable} に mix-in されます。
 *
 * @category    DateTime
 * @package     JapaneseDate
 * @subpackage  Traits
 * @author      Suzunone <suzunone.eleven@gmail.com>
 * @copyright   Suzunone
 * @license     BSD-2
 * @link        https://github.com/suzunone/JapaneseDate
 * @see         https://github.com/suzunone/JapaneseDate
 * @since       8.4.0
 */

namespace JapaneseDate\Traits;

/**
 * 七十二候の取得・日付移動メソッドを提供する Trait。
 *
 * このトレイトは {@see \JapaneseDate\DateTime} および
 * {@see \JapaneseDate\DateTimeImmutable} に mix-in されており、
 * 外部からは {@see \JapaneseDate\Traits\Getter} のマジックゲッター経由で
 * プロパティとして公開されます。
 *
 * **提供する機能**
 * - 七十二候番号の取得（1〜72）
 * - 七十二候名称・読み・候種別の取得
 * - 次候・前候の開始日への移動
 *
 * @category    DateTime
 * @package     JapaneseDate
 * @subpackage  Traits
 * @author      Suzunone <suzunone.eleven@gmail.com>
 * @copyright   Suzunone
 * @license     BSD-2
 * @link        https://github.com/suzunone/JapaneseDate
 * @see         https://github.com/suzunone/JapaneseDate
 * @since       8.4.0
 * @mixin \JapaneseDate\DateTime
 * @mixin \JapaneseDate\DateTimeImmutable
 */
trait SeventyTwoKou
{
    /**
     * その日が属する七十二候の番号（1〜72）を返します。
     *
     * 立春初候が 1、大寒末候が 72 です。
     * 計算は各二十四節気の入節日から次節気の入節日までを3等分して行います。
     *
     * @return int 七十二候番号（1〜72）
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getSeventyTwoKou(): int
    {
        return $this->SeventyTwoKouCalculator->getKouNumber($this);
    }

    /**
     * その日が属する七十二候の現代名称を返します。
     *
     * 例: "東風凍を解く"、"乃東生ず" など。
     *
     * @return string 七十二候名称
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getSeventyTwoKouText(): string
    {
        return $this->SeventyTwoKouCalculator->getKouText($this->getSeventyTwoKou());
    }

    /**
     * その日が属する七十二候の読みを返します。
     *
     * 例: "はるかぜ こおりをとく"、"なつかれくさ しょうず" など。
     *
     * @return string 七十二候の読み
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getSeventyTwoKouReading(): string
    {
        return $this->SeventyTwoKouCalculator->getKouReading($this->getSeventyTwoKou());
    }

    /**
     * その日が属する七十二候の候種別を返します。
     *
     * 返り値は "初候"、"次候"、"末候" のいずれかです。
     *
     * @return string 候種別（"初候" / "次候" / "末候"）
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    protected function getSeventyTwoKouType(): string
    {
        return $this->SeventyTwoKouCalculator->getKouType($this->getSeventyTwoKou());
    }

    /**
     * 次の七十二候が始まる日へ移動したインスタンスを返します。
     *
     * 現在の候の次候（または次節気の初候）の開始日を基準とした新しいインスタンスを返します。
     * 時刻はそのままに日付だけが変わります。
     *
     * @return static 次の七十二候の開始日へ移動した新しいインスタンス
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    public function nextSeventyTwoKou(): static
    {
        $nextTs = $this->SeventyTwoKouCalculator->getNextKouStartTimestamp($this);

        return $this->setDateTime(
            (int) date('Y', $nextTs),
            (int) date('n', $nextTs),
            (int) date('j', $nextTs),
            $this->hour,
            $this->minute,
            $this->second
        );
    }

    /**
     * 前の七十二候が始まる日へ移動したインスタンスを返します。
     *
     * 現在の候の直前の候の開始日を基準とした新しいインスタンスを返します。
     * 時刻はそのままに日付だけが変わります。
     *
     * @return static 前の七十二候の開始日へ移動した新しいインスタンス
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    public function previousSeventyTwoKou(): static
    {
        $prevTs = $this->SeventyTwoKouCalculator->getPreviousKouStartTimestamp($this);

        return $this->setDateTime(
            (int) date('Y', $prevTs),
            (int) date('n', $prevTs),
            (int) date('j', $prevTs),
            $this->hour,
            $this->minute,
            $this->second
        );
    }
}
