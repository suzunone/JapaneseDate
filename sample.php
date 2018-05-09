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
$start_microtime = microtime(true);

include_once __DIR__.'/vendor/autoload.php';

use JapaneseDate\JapaneseDateTime;

?>
<html>
<style type="text/css"><!--
.holiday{
	text-align:right;
	background-color: #ffd2d2;
	font-size : 90%;
}

.sunday{
	text-align:right;
	background-color: #ff7575;
	font-size : 90%;
}

.saturday{
	text-align:right;
	background-color: #9b9bff;
	font-size : 90%;

}

.weekday{
	text-align:right;
	font-size : 90%;

}

.calendar_sunday{
	font-size: 13px;
}

.calendar_weekday{
	font-size: 13px;
}

.calendar_saturday{
	font-size: 13px;
}
--></style>

<body>
<?php


// 年のフォームデータの受け取り
if (isset($_GET["y"]) ? (strlen($_GET["y"]) == 4 && is_numeric($_GET["y"]) ? (int)$_GET["y"] < 1980 : true) : true) {
	$year = date("Y");
} else {
	$year = (int)$_GET["y"];
}
?>
<form>
<input type="text" name="y" value="<?php echo $year; ?>">年
<input type="submit" value="表示">
</form>
////////////////////////////strftimeのサンプル////////////////////////////<br />
<br />
<?php
echo JapaneseDateTime::factory(mktime(0,0,0,5,3,2005))->strftime("
%%%Y-%m-%d%%<table>
<tr><td>西暦</td><td>%Y</td></tr>
<tr><td>月1</td><td>%m</td></tr>
<tr><td>日1</td><td>%d</td></tr>
<tr><td>月2</td><td>%N</td></tr>
<tr><td>日2</td><td>%J</td></tr>
<tr><td>月3</td><td>%G</td></tr>
<tr><td>日3</td><td>%g</td></tr>
<tr><td>干支番号</td><td>%o</td></tr>
<tr><td>干支</td><td>%O</td></tr>
<tr><td>祝日番号</td><td>%l</td></tr>
<tr><td>祝日</td><td>%L</td></tr>
<tr><td>7曜番号</td><td>%w</td></tr>
<tr><td>7曜表示</td><td>%K</td></tr>
<tr><td>6曜番号</td><td>%6</td></tr>
<tr><td>6曜表示</td><td>%k</td></tr>
<tr><td>年号ID</td><td>%f</td></tr>
<tr><td>年号</td><td>%F</td></tr>
<tr><td>和暦</td><td>%E</td></tr>
</table>
");

?>
<br />
<?php
echo JapaneseDateTime::factory()->strftime("
%%%Y-%m-%d%%<table>
<tr><td>西暦</td><td>%Y</td></tr>
<tr><td>月1</td><td>%m</td></tr>
<tr><td>日1</td><td>%d</td></tr>
<tr><td>月2</td><td>%N</td></tr>
<tr><td>日2</td><td>%J</td></tr>
<tr><td>月3</td><td>%G</td></tr>
<tr><td>日3</td><td>%g</td></tr>
<tr><td>干支番号</td><td>%o</td></tr>
<tr><td>干支</td><td>%O</td></tr>
<tr><td>祝日番号</td><td>%l</td></tr>
<tr><td>祝日</td><td>%L</td></tr>
<tr><td>7曜番号</td><td>%w</td></tr>
<tr><td>7曜表示</td><td>%K</td></tr>
<tr><td>6曜番号</td><td>%6</td></tr>
<tr><td>6曜表示</td><td>%k</td></tr>
<tr><td>年号ID</td><td>%f</td></tr>
<tr><td>年号</td><td>%F</td></tr>
<tr><td>和暦</td><td>%E</td></tr>
</table>
");

?>
<br />
////////////////////////////カレンダー出力のサンプル////////////////////////////<br />
<br />

<?php
$month_array = range(1, 12);
foreach ($month_array as $month) {
    $jd = new JapaneseDateTime("{$year}-{$month}-01");

?>
<?=$jd->format('Y'); ?>年
(<?=$jd->viewEraName().$jd->getEraYear(); ?>年/<?=$jd->viewOrientalZodiac(); ?>)<br />
<?=$jd->format('m'); ?>月(<?php echo $jd->viewMonth();?>)
<?php
$noday = "-";
$_from = $jd->getDatesOfMonth();

$_foreach['calendar'] = array('total' => count($_from), 'iteration' => 0);

if ($_foreach['calendar']['total'] > 0):
	foreach ($_from as $key => $value):
	$_foreach['calendar']['iteration']++;
		if (($_foreach['calendar']['iteration'] <= 1)):
?>

<table border="1" cellspacing="0" cellpadding="0" summary="カレンダー" width="700">
<tr class="calendarhead">
<th class="calendar_sunday" align="middle" abbr="sunday" width="100">
日
</th>
<th class="calendar_weekday" align="middle" abbr="monday" width="100">
月
</th>
<th class="calendar_weekday" align="middle" abbr="tuesday" width="100">
火
</th>
<th class="calendar_weekday" align="middle" abbr="wednesday" width="100">
水
</th>
<th class="calendar_weekday" align="middle" abbr="thursday" width="100">
木
</th>
<th class="calendar_weekday" align="middle" abbr="friday" width="100">
金
</th>
<th class="calendar_saturday" align="middle" abbr="saturday" width="100">
土
</th>
</tr>
<?php endif; ?>
<?php if ($value->format('w') == 0): ?>
<tr class="calendarday">
<td class="<?php if ($value->getHoliday() == 0): ?>sunday<?php else: ?>holiday<?php endif; ?>">
<?php echo $value->format('n'); ?><br />
<?php echo $value->viewSixWeekday();?><br />
<small><?php echo $value->getLunarYear(); ?>/
<?php if ($value->isUruu()) : ?>
(閏)
<?php endif; ?>
<?php echo $value->viewLunarMonth(); ?>
<?php echo $value->getLunarDay(); ?><br /></small><?php if ($value->getHoliday() != 0) : ?>
<?php echo $value->viewHoliday(); ?>
<?php endif; ?>
</td>
<?php elseif ($value->format('w') > 0 && ($_foreach['calendar']['iteration'] <= 1)): ?>
<tr class="calendarday">
<td class="weekday"><?php echo $noday;?></td>
<?php endif;  if ($value->format('w') > 1 && ($_foreach['calendar']['iteration'] <= 1)): ?>
<td class="weekday"><?php echo $noday;?></td>
<?php endif;  if ($value->format('w') > 2 && ($_foreach['calendar']['iteration'] <= 1)): ?>
<td class="weekday"><?php echo $noday;?></td>
<?php endif;  if ($value->format('w') > 3 && ($_foreach['calendar']['iteration'] <= 1)): ?>
<td class="weekday"><?php echo $noday;?></td>
<?php endif;  if ($value->format('w') > 4 && ($_foreach['calendar']['iteration'] <= 1)): ?>
<td class="weekday"><?php echo $noday;?></td>
<?php endif;  if ($value->format('w') > 5 && ($_foreach['calendar']['iteration'] <= 1)): ?>
<td class="weekday"><?php echo $noday;?></td>
<?php endif;  if ($value->format('w') == 6): ?>
<td class="<?php if ($value->getHoliday() == 0): ?>saturday<?php else: ?>holiday<?php endif; ?>">
<?php echo $value->format('n'); ?><br />
<?php echo $value->viewSixWeekday();?><br />
<small><?php echo $value->getLunarYear(); ?>/
<?php if ($value->isUruu()) : ?>
(閏)
<?php endif; ?>
<?php echo $value->viewLunarMonth(); ?>
<?php echo $value->getLunarDay(); ?><br /></small>
<?php if ($value->getHoliday() != 0) : ?>
<?php echo $value->viewHoliday(); ?>
<?php endif; ?>
</td>
</tr>

<?php elseif ($value->format('w') > 0): ?>
<td class="<?php if ($value->getHoliday() == 0): ?>weekday<?php else: ?>holiday<?php endif; ?>">
<?php echo $value->format('n'); ?><br />
<?php echo $value->viewSixWeekday();?><br />
<small><?php echo $value->getLunarYear(); ?>/
<?php if ($value->isUruu()) : ?>
(閏)
<?php endif; ?>
<?php echo $value->viewLunarMonth(); ?>
<?php echo $value->getLunarDay(); ?><br /></small><?php if ($value->getHoliday() != 0) : ?>
<?php echo $value->viewHoliday(); ?>
<?php endif; ?>
</td>
<?php endif;  if (($_foreach['calendar']['iteration'] == $_foreach['calendar']['total'])):  if ($value->format('w') < 1): ?>
<td class="weekday"><?php echo $noday;?></td>
<?php endif;  if ($value->format('w') < 2): ?>
<td class="weekday"><?php echo $noday;?></td>
<?php endif;  if ($value->format('w') < 3): ?>
<td class="weekday"><?php echo $noday;?></td>
<?php endif;  if ($value->format('w') < 4): ?>
<td class="weekday"><?php echo $noday;?></td>
<?php endif;  if ($value->format('w') < 5): ?>
<td class="weekday"><?php echo $noday;?></td>
<?php endif;  if ($value->format('w') < 6): ?>
<td class="weekday"><?php echo $noday;?></td>
<?php endif; ?>
</table>
<?php endif;  endforeach; endif; unset($_from); ?>
<hr>
<?php
}
echo 'total:'.(microtime(true) - $start_microtime);
?>

</body>
</html>