<?php
/**
 * make_mapping.php
 *
 * Class ${NAME}
 *
 * @category   Contender
 * @subpackage ${NAMESPACE}
 * @author     suzunone<suzunone.eleven@gmail.com>
 * @copyright  Project Contender
 * @license    MIT
 * @version    1.0
 * @link       https://github.com/suzunone/Contender
 * @see        https://github.com/suzunone/Contender
 * @since      2020/12/19
 */
include './vendor/autoload.php';

use JapaneseDate\Components\LunarCalendar;

if (!isset($argv[1]) || !ctype_digit($argv[1])) {
    echo 'usage : php make_mapping.php {Year}';
}

$instance = LunarCalendar::factory();
$method_name = 'makeLunarCalendar';

$reflection = new ReflectionClass($instance);
$method = $reflection->getMethod($method_name);
$method->setAccessible(true);

$res = $method->invokeArgs($instance, [$argv[1]]);
foreach ($res as &$val) {
    unset($val['jd']);
}

unset($val);

$res = var_export($res, true);

$res = mb_ereg_replace(' *[0-9]+ *=>', '', $res);
$res = str_replace(['array', '(', ')'], ['', '[', ']'], $res);

$date = date('Y/m/d');

echo <<<EOF
<?php

/**
 * {$argv[1]}.php
 *
 * LC mapping
 *
 * @category   JapaneseDate
 * @subpackage LC
 * @author     suzunone<suzunone.eleven@gmail.com>
 * @copyright  Project Contender
 * @license    MIT
 * @version    1.0
 * @link       https://github.com/suzunone/JapaneseDate
 * @see        https://github.com/suzunone/JapaneseDate
 * @since      {$date}
 */

/**
    グレゴリオ年ごとの 旧暦、1日の配列。

    'year' => グレゴリオ暦の年,
    'month' => グレゴリオ暦の月,
    'day' => グレゴリオ暦の日,
    'age' => 月齢,
    'lunar_month' => 旧暦月,
    'lunar_month_leap' => 閏月ならtrue,
    'lunar_year' => 旧暦年,

*/

return {$res};

EOF;
