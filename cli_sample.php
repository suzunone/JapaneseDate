<?php
/**
 * @package    %%project_name%%
 * @subpackage %%subpackage_name%%
 * @author     Suzunone <suzunone.eleven@gmail.com>
 * @copyright  %%your_project%%
 * @license    %%your_license%%
 * @link       %%your_link%%
 * @see        %%your_see%%
 * @sinse Class available since Release 1.0.0
 */
if (php_sapi_name() != 'cli') {
    echo 'please execute cli.';
    exit;
}

$start_microtime = microtime(true);
//サンプルコード
require __DIR__.'/libs/JapaneseDateTime.php';
function cecho($text, $color)
{
    $cmd = 'echo -e "\e[3'.$color.'m'.$text.'\e[m"';
    echo trim(`$cmd`);
}

function calendar_1($now_jd)
{
    echo '     '.$now_jd->format('n月Y年')."\n日 月 火 水 木 金 土\n";

    $i = 0;
    foreach ($now_jd->getDatesOfMonth() as $jd) {
        if ($i === 0 && $jd->format('w') > 0) {
            echo str_pad(' ', $jd->format('w') * 3);
        }
        if ($jd->format('w') == JapaneseDateTime::SUNDAY) {
            cecho($jd->strftime('%g'), 1);
        } elseif ($jd->format('w') == JapaneseDateTime::SATURDAY) {
            cecho($jd->strftime('%g'), 4);
        } elseif ($jd->getHoliday() == JapaneseDateTime::NO_HOLIDAY) {
            echo $jd->strftime('%g');
        } else {
            cecho($jd->strftime('%g'), 1);
        }

        if ($jd->format('w') == JapaneseDateTime::SATURDAY) {
            echo "\n";
        } else {
            echo ' ';
        }
        $i++;
    }
    echo "\n";
}

$year        = $argv[1] ?? date('Y');
$month_array = range(1, 12);

foreach ($month_array as $month) {
    $now_jd = new JapaneseDateTime("{$year}-{$month}-01");
    calendar_1($now_jd);
    echo "\n";
}

echo 'total:',(microtime(true) - $start_microtime),"\n";
