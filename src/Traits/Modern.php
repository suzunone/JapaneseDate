<?php

/**
 * Modern.php
 *
 * 近代日本の暦体系（元号・六曜・二十四節気・祝日・旧暦）に関する
 * 内部計算ロジックをまとめた Trait です。
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
 * @since       2020-03-11
 */

namespace JapaneseDate\Traits;

/**
 * 近代日本の暦体系に関する内部計算ロジックをまとめた Trait。
 *
 * このトレイトは {@see \JapaneseDate\DateTime} および
 * {@see \JapaneseDate\DateTimeImmutable} に mix-in されており、
 * 外部から直接呼ばれることはありません。
 * 各 `protected` メソッドは {@see \JapaneseDate\Traits\Getter} の
 * マジックゲッター経由でプロパティとして公開されます。
 *
 * **実装している計算カテゴリ**
 * - 十二支（oriental zodiac）: 年単位の十二支キーおよびテキスト
 * - 十干（heavenly stem）: 年単位の十干キーおよびテキスト
 * - 祝日・休日: 国民の祝日法に基づく判定
 * - 曜日テキスト: 日本語曜日名
 * - 月テキスト: 日本語月名
 * - 元号: 明治〜令和の元号名・元号年
 *
 * @category    DateTime
 * @package     JapaneseDate
 * @subpackage  Traits
 * @author      Suzunone <suzunone.eleven@gmail.com>
 * @copyright   Suzunone
 * @license     BSD-2
 * @link        https://github.com/suzunone/JapaneseDate
 * @see         https://github.com/suzunone/JapaneseDate
 * @since       2020-03-11
 * @mixin \JapaneseDate\DateTime
 * @mixin \JapaneseDate\DateTimeImmutable
 */
trait Modern
{
    /**
     * 日付が属する年の十二支（じゅうにし）を整数キーで返します。
     *
     * 十二支は「子・丑・寅・卯・辰・巳・午・未・申・酉・戌・亥」の
     * 12種類が1年ごとに巡ります（干支の12年サイクル）。
     * 返り値の整数キーは {@see \JapaneseDate\DateTime::ORIENTAL_ZODIAC_NE} 等の
     * 定数と対応しています。
     *
     * キー値の対応:
     * - 0 = 亥（い）
     * - 1 = 子（ね）
     * - 2 = 丑（うし）
     * - 3 = 寅（とら）
     * - 4 = 卯（う）
     * - 5 = 辰（たつ）
     * - 6 = 巳（み）
     * - 7 = 午（うま）
     * - 8 = 未（ひつじ）
     * - 9 = 申（さる）
     * - 10 = 酉（とり）
     * - 11 = 戌（いぬ）
     *
     * @return int 十二支の整数キー（0〜11）
     */
    protected function getOrientalZodiac(): int
    {
        return $this->SexagenaryCycle->getOrientalZodiacKey($this->year);
    }

    /**
     * 日付が属する年の十二支（じゅうにし）を日本語テキストで返します。
     *
     * 例: 2026年 → 「午」、2024年 → 「辰」
     *
     * 内部では {@see getOrientalZodiac()} で整数キーを取得し、
     * {@see \JapaneseDate\Components\SexagenaryCycle::viewOrientalZodiac()} で
     * 日本語文字列に変換します。
     *
     * @return string 十二支の日本語テキスト（例: 「午」「辰」）
     */
    protected function viewOrientalZodiac(): string
    {
        return $this->SexagenaryCycle->viewOrientalZodiac($this->getOrientalZodiac());
    }

    /**
     * 日付が属する年の十干（じっかん）を整数キーで返します。
     *
     * 十干は「甲・乙・丙・丁・戊・己・庚・辛・壬・癸」の
     * 10種類が1年ごとに巡ります（干支の10年サイクル）。
     * 十二支と組み合わせて60年周期の「六十干支（干支）」を構成します。
     * 返り値の整数キーは {@see \JapaneseDate\DateTime::HEAVENLY_STEM_KINOE} 等の
     * 定数と対応しています。
     *
     * キー値の対応:
     * - 0 = 甲（きのえ）
     * - 1 = 乙（きのと）
     * - 2 = 丙（ひのえ）
     * - 3 = 丁（ひのと）
     * - 4 = 戊（つちのえ）
     * - 5 = 己（つちのと）
     * - 6 = 庚（かのえ）
     * - 7 = 辛（かのと）
     * - 8 = 壬（みずのえ）
     * - 9 = 癸（みずのと）
     *
     * @return int 十干の整数キー（0〜9）
     */
    protected function getHeavenlyStem(): int
    {
        return $this->SexagenaryCycle->getHeavenlyStemKey($this->year);
    }

    /**
     * 日付が属する年の十干（じっかん）を日本語テキストで返します。
     *
     * 例: 2026年 → 「午（うま）」の年は十干が「丙（ひのえ）」
     *
     * 内部では {@see getHeavenlyStem()} で整数キーを取得し、
     * {@see \JapaneseDate\Components\SexagenaryCycle::viewHeavenlyStem()} で
     * 日本語文字列に変換します。
     *
     * @return string 十干の日本語テキスト（例: 「甲」「乙」「丙」）
     */
    protected function viewHeavenlyStem(): string
    {
        return $this->SexagenaryCycle->viewHeavenlyStem($this->getHeavenlyStem());
    }

    // =========================================================================
    // 五節句（西暦）
    // =========================================================================

    /**
     * 西暦の月日から五節句の定数キーを返します。
     *
     * グレゴリオ暦（新暦）の月日を基準に五節句を判定します。
     * いずれの節句にも該当しない場合は {@see \JapaneseDate\DateTime::SEASONAL_FESTIVAL_NONE}（= 0）を返します。
     *
     * @return int 五節句定数（{@see \JapaneseDate\DateTime::SEASONAL_FESTIVAL_NONE} ～ {@see \JapaneseDate\DateTime::SEASONAL_FESTIVAL_CHOYO}）
     */
    protected function getSolarSeasonalFestival(): int
    {
        return $this->SeasonalFestival->getSolarFestivalKey($this);
    }

    /**
     * 西暦の月日から五節句の式名（正式名称）を返します。
     *
     * 「人日の節句」「上巳の節句」「端午の節句」「七夕の節句」「重陽の節句」のいずれかを返します。
     * 節句でない場合は空文字列（`''`）を返します。
     *
     * @return string 五節句の式名、または節句でない場合は空文字列
     */
    protected function viewSolarSeasonalFestivalName(): string
    {
        return $this->SeasonalFestival->viewSolarFestivalName($this);
    }

    /**
     * 西暦の月日から五節句の別名（通称）を返します。
     *
     * 「七草の節句」「桃の節句」「菖蒲の節句」「笹の節句」「菊の節句」のいずれかを返します。
     * 節句でない場合は空文字列（`''`）を返します。
     *
     * @return string 五節句の別名（通称）、または節句でない場合は空文字列
     */
    protected function viewSolarSeasonalFestivalAlias(): string
    {
        return $this->SeasonalFestival->viewSolarFestivalAlias($this);
    }

    // =========================================================================
    // 五節句（旧暦）
    // =========================================================================

    /**
     * 旧暦の月日から五節句の定数キーを返します。
     *
     * 旧暦（太陰太陽暦）の月日を基準に五節句を判定します。
     * いずれの節句にも該当しない場合は {@see \JapaneseDate\DateTime::SEASONAL_FESTIVAL_NONE}（= 0）を返します。
     *
     * @return int 五節句定数（{@see \JapaneseDate\DateTime::SEASONAL_FESTIVAL_NONE} ～ {@see \JapaneseDate\DateTime::SEASONAL_FESTIVAL_CHOYO}）
     */
    protected function getLunarSeasonalFestival(): int
    {
        return $this->SeasonalFestival->getLunarFestivalKey($this);
    }

    /**
     * 旧暦の月日から五節句の式名（正式名称）を返します。
     *
     * 「人日の節句」「上巳の節句」「端午の節句」「七夕の節句」「重陽の節句」のいずれかを返します。
     * 節句でない場合は空文字列（`''`）を返します。
     *
     * @return string 五節句の式名、または節句でない場合は空文字列
     */
    protected function viewLunarSeasonalFestivalName(): string
    {
        return $this->SeasonalFestival->viewLunarFestivalName($this);
    }

    /**
     * 旧暦の月日から五節句の別名（通称）を返します。
     *
     * 「七草の節句」「桃の節句」「菖蒲の節句」「笹の節句」「菊の節句」のいずれかを返します。
     * 節句でない場合は空文字列（`''`）を返します。
     *
     * @return string 五節句の別名（通称）、または節句でない場合は空文字列
     */
    protected function viewLunarSeasonalFestivalAlias(): string
    {
        return $this->SeasonalFestival->viewLunarFestivalAlias($this);
    }

    /**
     * その日が該当する雑節の定数キーを返します。
     *
     * 判定する雑節とその優先順位:
     * 1. 節分（立春の前日）
     * 2. 彼岸（春分・秋分を中日とした前後3日間）
     * 3. 社日（春分・秋分に最も近い戊の日）
     * 4. 八十八夜（立春から数えて88日目）
     * 5. 入梅（太陽黄経80°）
     * 6. 半夏生（太陽黄経100°）
     * 7. 土用（立春・立夏・立秋・立冬の18日前〜前日）
     * 8. 二百十日（立春から数えて210日目）
     * 9. 二百二十日（立春から数えて220日目）
     *
     * 複数の雑節に該当する場合は上記の優先順位で最初の雑節を返します。
     * いずれにも該当しない場合は {@see \JapaneseDate\DateTime::MISC_SEASONAL_NODE_NONE}（= 0）を返します。
     *
     * @return int 雑節定数（{@see \JapaneseDate\DateTime::MISC_SEASONAL_NODE_NONE} ～ {@see \JapaneseDate\DateTime::MISC_SEASONAL_NODE_NIHYAKUNIJUUNICHI}）
     */
    protected function getMiscSeasonalNode(): int
    {
        return $this->MiscSeasonalNode->getMiscSeasonalNodeKey($this);
    }

    /**
     * その日が該当する雑節の日本語名を返します。
     *
     * 雑節に該当する場合は「節分」「彼岸」「社日」「八十八夜」「入梅」
     * 「半夏生」「土用」「二百十日」「二百二十日」のいずれかを返します。
     * いずれの雑節にも該当しない場合は空文字列（`''`）を返します。
     *
     * 内部では {@see getMiscSeasonalNode()} で雑節定数を取得し、
     * {@see \JapaneseDate\Components\MiscSeasonalNode::viewMiscSeasonalNode()} で
     * 日本語名に変換します。
     *
     * @return string 雑節名（例: 「節分」「土用」）、または該当なしの場合は空文字列
     */
    protected function viewMiscSeasonalNode(): string
    {
        return $this->MiscSeasonalNode->viewMiscSeasonalNode($this->getMiscSeasonalNode());
    }

    /**
     * その日が祝日・休日種別を整数定数で返します。
     *
     * 日本の「国民の祝日に関する法律（祝日法）」に基づき、
     * 当該日が祝日・休日（振替休日・国民の休日を含む）かどうかを判定します。
     * 祝日でない場合は {@see \JapaneseDate\DateTime::NO_HOLIDAY}（= 0）を返します。
     *
     * 内部では {@see \JapaneseDate\Components\JapaneseDate::getHolidayList()} が
     * 返す月ごとの祝日マップを参照して当日の値を取得します。
     *
     * 返り値の定数一覧（抜粋）:
     * - {@see \JapaneseDate\DateTime::NO_HOLIDAY} = 0（祝日でない）
     * - {@see \JapaneseDate\DateTime::NEW_YEAR_S_DAY} = 1（元旦）
     * - {@see \JapaneseDate\DateTime::CONSTITUTION_DAY} = 10（憲法記念日）
     * - {@see \JapaneseDate\DateTime::COMPENSATING_HOLIDAY} = 13（振替休日）
     *
     * @return int 祝日・休日種別を表す定数（{@see \JapaneseDate\DateTime::NO_HOLIDAY} ～ 最大値）
     * @throws \JapaneseDate\Exceptions\ErrorException
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\NativeDateTimeException
     * @throws \JapaneseDate\Exceptions\SolarTermException
     * @throws \JsonException
     */
    protected function getHoliday(): int
    {
        $holiday_list = $this->JapaneseDate->getHolidayList($this);

        return $holiday_list[$this->day] ?? self::NO_HOLIDAY;
    }

    /**
     * その日の祝日・休日名を日本語テキストで返します。
     *
     * 祝日の場合は「元旦」「憲法記念日」「振替休日」などの日本語名を返します。
     * 祝日でない場合は空文字列（`''`）を返します。
     *
     * 内部では {@see getHoliday()} で祝日定数を取得し、
     * {@see \JapaneseDate\Components\JapaneseDate::viewHoliday()} で
     * 日本語名に変換します。
     *
     * @return string 祝日名（例: 「元旦」「憲法記念日」）、または非祝日の場合は空文字列
     * @throws \JapaneseDate\Exceptions\ErrorException
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\NativeDateTimeException
     * @throws \JapaneseDate\Exceptions\SolarTermException
     * @throws \JsonException
     */
    protected function viewHoliday(): string
    {
        $key = $this->getHoliday();

        return $this->JapaneseDate->viewHoliday($key);
    }

    /**
     * その日の曜日名を日本語テキストで返します。
     *
     * Carbon の `dayOfWeek` プロパティ（0 = 日曜〜6 = 土曜）をもとに、
     * 「日」「月」「火」「水」「木」「金」「土」のいずれかを返します。
     *
     * @return string 日本語曜日名（「日」〜「土」の1文字）
     */
    protected function viewWeekday(): string
    {
        $key = $this->dayOfWeek;

        return $this->JapaneseDate->viewWeekday($key);
    }

    /**
     * その日が属する月の日本語月名を返します。
     *
     * `month` プロパティの値（1〜12）をもとに、
     * 「睦月」「如月」「弥生」…「師走」の順で日本語月名を返します。
     *
     * 旧暦（太陰太陽暦）の月名とは異なり、グレゴリオ暦の月に対応した
     * 伝統的な日本語呼称です。
     *
     * 月番号と月名の対応:
     * - 1月 = 睦月（むつき）
     * - 2月 = 如月（きさらぎ）
     * - 3月 = 弥生（やよい）
     * - 4月 = 卯月（うづき）
     * - 5月 = 皐月（さつき）
     * - 6月 = 水無月（みなづき）
     * - 7月 = 文月（ふみづき）
     * - 8月 = 葉月（はづき）
     * - 9月 = 長月（ながつき）
     * - 10月 = 神無月（かんなづき）
     * - 11月 = 霜月（しもつき）
     * - 12月 = 師走（しわす）
     *
     * @return string 日本語月名（例: 「睦月」「師走」）
     */
    protected function viewMonth(): string
    {
        $key = $this->month;

        return $this->JapaneseDate->viewMonth($key);
    }

    /**
     * その日が属する元号名を日本語テキストで返します。
     *
     * 内部で {@see getEraName()} により元号定数を取得し、
     * {@see \JapaneseDate\Components\JapaneseDate::viewEraName()} で
     * 日本語文字列（「明治」「大正」「昭和」「平成」「令和」）に変換します。
     *
     * @return string 元号名（「明治」「大正」「昭和」「平成」「令和」のいずれか）
     * @throws \JapaneseDate\Exceptions\Exception
     */
    protected function viewEraName(): string
    {
        return $this->jisEra->getEraNameString($this->getEraName());
    }

    /**
     * その日が属する元号を整数定数で返します。
     *
     * 日付と各元号の開始日を比較して、明治・大正・昭和・平成・令和の
     * いずれに属するかを判定します。
     *
     * 各元号の開始日（比較基準）:
     * - 大正: 1912年7月30日 00:00:00
     * - 昭和: 1926年12月25日 00:00:00
     * - 平成: 1989年1月8日 00:00:00
     * - 令和: 2019年5月1日 00:00:00
     * - （上記未満は明治扱い）
     *
     * 返り値の定数:
     * - {@see \JapaneseDate\DateTime::ERA_MEIJI}  = 1000（明治）
     * - {@see \JapaneseDate\DateTime::ERA_TAISHO} = 1001（大正）
     * - {@see \JapaneseDate\DateTime::ERA_SHOWA}  = 1002（昭和）
     * - {@see \JapaneseDate\DateTime::ERA_HEISEI} = 1003（平成）
     * - {@see \JapaneseDate\DateTime::ERA_REIWA}  = 1004（令和）
     *
     * @return int 元号定数（{@see \JapaneseDate\DateTime::ERA_MEIJI} ～ {@see \JapaneseDate\DateTime::ERA_REIWA}）
     */
    protected function getEraName(): int
    {
        return $this->jisEra->getEraKey($this);
    }

    /**
     * その日が属する和暦の年（元号年）を整数で返します。
     *
     * 「令和X年」「平成Y年」のように、元号の開始年を基準とした
     * 1始まりの年数を返します。計算式は「西暦年 - 元号開始年 + 1」です。
     *
     * 元号ごとの開始年（計算基準）:
     * - 明治: 1868年
     * - 大正: 1912年
     * - 昭和: 1926年
     * - 平成: 1989年
     * - 令和: 2019年
     *
     * 例:
     * - 2026年 → 令和8年（2026 - 2019 + 1 = 8）
     * - 1989年 → 平成1年（1989 - 1989 + 1 = 1）
     *
     * @param int|null $era_key 元号定数（省略時は {@see getEraName()} で自動判定）
     * @return int 元号年（1始まりの正整数）
     * @throws \JapaneseDate\Exceptions\Exception
     */
    protected function getEraYear(?int $era_key = null): int
    {
        $era_key = $era_key ?? $this->getEraName();

        return $this->jisEra->getEraYear($this->year, $era_key);
    }
}
