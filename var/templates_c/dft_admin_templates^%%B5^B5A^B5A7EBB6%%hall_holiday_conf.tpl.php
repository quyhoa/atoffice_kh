<?php /* Smarty version 2.6.18, created on 2017-03-14 07:52:55
         compiled from file:E:%5CA_project%5Catoffice_kh/webapp/modules/admin/templates/hall_holiday_conf.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'ext_include', 'file:E:\\A_project\\atoffice_kh/webapp/modules/admin/templates/hall_holiday_conf.tpl', 2, false),array('modifier', 't_escape', 'file:E:\\A_project\\atoffice_kh/webapp/modules/admin/templates/hall_holiday_conf.tpl', 64, false),)), $this); ?>
<?php echo $this->_tpl_vars['inc_header']; ?>

<?php echo smarty_function_ext_include(array('file' => "inc_subnavi_adminImageKakikomi.tpl"), $this);?>

<?php $this->assign('page_name', "会場休日登録"); ?>
<?php echo smarty_function_ext_include(array('file' => "inc_tree_adminImageKakikomi.tpl"), $this);?>

</div>


<?php if ($this->_tpl_vars['atoffice_auth_type'] == 1 || $this->_tpl_vars['atoffice_auth_type'] == 4): ?>

<STYLE TYPE="text/css">
<!--
.c1{
position:absolute; left:0px; top:0px; visibility:hidden;
font-size:9pt; color:#0099FF; 
background-color:#FFFFFF; layer-background-color:#FFFFFF;
border:1px solid #0099FF; padding:10px;
}
-->
</STYLE>

<SCRIPT LANGUAGE="JavaScript">
<!--
var IE = 0,NN = 0,N6 = 0,FF = 0;
if(document.all) IE = true;
else if(document.layers) NN = true;
else if(document.getElementById) N6 = true;
else if(strUA.indexOf("firefox") != -1) FF = true;
function OnLink(Msg,mX,mY,nX,nY){
var pX = 0,pY = 0;
var sX = 10,sY = 30;
if(IE){
MyMsg = document.all(Msg).style;
MyMsg.visibility = "visible";
}
if(NN){
MyMsg = document.layers[Msg];
MyMsg.visibility = "show";
}
if(N6){
MyMsg = document.getElementById(Msg).style;
MyMsg.visibility = "visible";
}
if(IE){
pX = document.body.scrollLeft;
pY = document.body.scrollTop;
MyMsg.left = mX + pX + sX;
MyMsg.top = mY + pY + sY;
}
if(NN || N6){
MyMsg.left = nX+ sX;
MyMsg.top = nY + sY;
}
}
function OffLink(Msg){
if(IE) document.all(Msg).style.visibility = "hidden";
if(NN) document.layers[Msg].visibility = "hide";
if(N6) document.getElementById(Msg).style.visibility = "hidden";
}
//-->
</SCRIPT>

<h2 id="ttl01">会場休日登録【<?php echo smarty_modifier_t_escape($this->_tpl_vars['hall_name']); ?>
】</h2>
<br>
<center>
<?php if ($this->_tpl_vars['msg']): ?><p class="actionMsg"><?php echo smarty_modifier_t_escape($this->_tpl_vars['msg']); ?>
</p><br><br><?php endif; ?>

<table>
<tr>
<td width=400 valign="top" align=left>

<table border=1 width=350>
<tr>
<th colspan=7 height=50 bgcolor=#FF0000>　
<span style="font-size: 16pt; color: #FFFFFF"><b>休日確認</b></span>
</th>
</tr>
<tr>
<td>

<form name="back" method="POST" action="./">
<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
<input type="hidden" name="a" value="page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('hall_holiday_conf','page')); ?>
" />
<input type="hidden" name="sessid" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['PHPSESSID']); ?>
" />
<input type="hidden" name="hall_id" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['hall_id']); ?>
" />
<input type="hidden" name="target_month" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['month']-1); ?>
" />
<input type="hidden" name="target_year" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['year']); ?>
" />
<input type="submit" value="<<前月">
</form>
</td>
<td colspan=5 align=center><b><?php echo smarty_modifier_t_escape($this->_tpl_vars['year']); ?>
年<?php echo smarty_modifier_t_escape($this->_tpl_vars['month']); ?>
月</b><br>

<form name="next" method="POST" action="./">
<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
<input type="hidden" name="a" value="page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('hall_holiday_conf','page')); ?>
" />
<input type="hidden" name="sessid" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['PHPSESSID']); ?>
" />
<input type="hidden" name="hall_id" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['hall_id']); ?>
" />
<input type="hidden" name="target_month" value="" />
<input type="hidden" name="target_year" value="" />
<input type="submit" value="リセット">
</form>
</td>
<td>
<form name="next" method="POST" action="./">
<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
<input type="hidden" name="a" value="page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('hall_holiday_conf','page')); ?>
" />
<input type="hidden" name="sessid" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['PHPSESSID']); ?>
" />
<input type="hidden" name="hall_id" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['hall_id']); ?>
" />
<input type="hidden" name="target_month" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['month']+1); ?>
" />
<input type="hidden" name="target_year" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['year']); ?>
" />
<input type="submit" value="次月>>">
</form>
</td>
</tr>
<tr>
<form name="bank" method="POST" action="./">
<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
<input type="hidden" name="a" value="do_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('add_hall_holiday','do')); ?>
" />
<input type="hidden" name="sessid" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['PHPSESSID']); ?>
" />
<input type="hidden" name="hall_id" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['hall_id']); ?>
" />
<input type="hidden" name="checkbox_flag" value="1" />
<input type="hidden" name="year<?php echo smarty_modifier_t_escape($this->_tpl_vars['key']); ?>
" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['year']); ?>
">
<input type="hidden" name="month<?php echo smarty_modifier_t_escape($this->_tpl_vars['key']); ?>
" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['month']); ?>
">

<td width=50>日</td>
<td width=50>月</td>
<td width=50>火</td>
<td width=50>水</td>
<td width=50>木</td>
<td width=50>金</td>
<td width=50>土</td>
</tr>

<?php if ($this->_tpl_vars['wtop'] > 0): ?>
<td></td>
<?php endif; ?>
<?php if ($this->_tpl_vars['wtop'] > 1): ?>
<td></td>
<?php endif; ?>
<?php if ($this->_tpl_vars['wtop'] > 2): ?>
<td></td>
<?php endif; ?>
<?php if ($this->_tpl_vars['wtop'] > 3): ?>
<td></td>
<?php endif; ?>
<?php if ($this->_tpl_vars['wtop'] > 4): ?>
<td></td>
<?php endif; ?>
<?php if ($this->_tpl_vars['wtop'] > 5): ?>
<td></td>
<?php endif; ?>

<?php $_from = $this->_tpl_vars['day_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
<span id="L<?php echo smarty_modifier_t_escape($this->_tpl_vars['key']); ?>
" class="c1">― <?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['holiday_jp']['name']); ?>
 ―</span>
<td 
<?php if (( $this->_tpl_vars['year'] == $this->_tpl_vars['this_year'] && $this->_tpl_vars['month'] == $this->_tpl_vars['this_month'] && $this->_tpl_vars['item']['day'] < $this->_tpl_vars['today'] ) || ( $this->_tpl_vars['year'] == $this->_tpl_vars['this_year'] && $this->_tpl_vars['month'] < $this->_tpl_vars['this_month'] ) || ( $this->_tpl_vars['year'] < $this->_tpl_vars['this_year'] )): ?>
bgcolor=#D0D0D0 
<?php else: ?>

<?php if ($this->_tpl_vars['item']['holiday']): ?>bgcolor=#FFDDDD 
<?php endif; ?>


<?php endif; ?>

<?php if ($this->_tpl_vars['item']['holiday_jp']['day'] == $this->_tpl_vars['item']['day']): ?> onMouseOver="OnLink('L<?php echo smarty_modifier_t_escape($this->_tpl_vars['key']); ?>
',event.x,event.y,event.pageX,event.pageY)" onMouseOut="OffLink('L<?php echo smarty_modifier_t_escape($this->_tpl_vars['key']); ?>
')"<?php endif; ?>
>
<?php if ($this->_tpl_vars['item']['holiday_jp']['day'] == $this->_tpl_vars['item']['day']): ?>
<span style="color: #FF0000;"><b>
<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['day']); ?>
</b>
</span>
<?php else: ?>
<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['day']); ?>

<?php endif; ?>
<?php if (( $this->_tpl_vars['this_year'] < $this->_tpl_vars['year'] || ( $this->_tpl_vars['this_year'] == $this->_tpl_vars['year'] && $this->_tpl_vars['this_month'] < $this->_tpl_vars['month'] ) || ( $this->_tpl_vars['this_year'] == $this->_tpl_vars['year'] && $this->_tpl_vars['this_month'] == $this->_tpl_vars['month'] && $this->_tpl_vars['item']['day'] >= $this->_tpl_vars['today'] ) ) && ! $this->_tpl_vars['item']['holiday']): ?>
<input type="checkbox" name="day<?php echo smarty_modifier_t_escape($this->_tpl_vars['key']+1); ?>
" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['day']); ?>
">
<?php endif; ?>
</td>
<?php if ($this->_tpl_vars['wtop'] == 0 && ( $this->_tpl_vars['key'] + 1 ) % 7 == 0): ?></tr><tr><?php endif; ?>
<?php if ($this->_tpl_vars['wtop'] == 1 && ( $this->_tpl_vars['key'] + 2 ) % 7 == 0): ?></tr><tr><?php endif; ?>
<?php if ($this->_tpl_vars['wtop'] == 2 && ( $this->_tpl_vars['key'] + 3 ) % 7 == 0): ?></tr><tr><?php endif; ?>
<?php if ($this->_tpl_vars['wtop'] == 3 && ( $this->_tpl_vars['key'] + 4 ) % 7 == 0): ?></tr><tr><?php endif; ?>
<?php if ($this->_tpl_vars['wtop'] == 4 && ( $this->_tpl_vars['key'] + 5 ) % 7 == 0): ?></tr><tr><?php endif; ?>
<?php if ($this->_tpl_vars['wtop'] == 5 && ( $this->_tpl_vars['key'] + 6 ) % 7 == 0): ?></tr><tr><?php endif; ?>
<?php if ($this->_tpl_vars['wtop'] == 6 && ( $this->_tpl_vars['key'] + 7 ) % 7 == 0): ?></tr><tr><?php endif; ?>
<?php endforeach; endif; unset($_from); ?>
</tr>
<tr>
<td colspan=7>
<input type="submit" value="　日付指定に登録する　">
</td>
</tr>
</table>
</form>
<br>
<span style="color: #FF0000;">赤字：</span>祝日　
<span style="color: #D0D0D0;">■</span> 過ぎた日にち　
<span style="color: #FFDDDD;">■</span> 休日<br>
<br>
<span style="color: #FF0000;">
※ 日付指定の登録は月を切り替えると選択が消えますので、<br>
　 月ごとに設定してください。
</span>
</td>
<td valign="top">

<form name="bank" method="POST" action="./">
<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
<input type="hidden" name="a" value="do_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('add_hall_regular_holiday','do')); ?>
" />
<input type="hidden" name="sessid" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['PHPSESSID']); ?>
" />
<input type="hidden" name="hall_id" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['hall_id']); ?>
" />

<table border=1 width=650>
<tr>
<th colspan=2 height=50 bgcolor=#FF0000>　
<span style="font-size: 16pt; color: #FFFFFF"><b>定休日　</b></span><input type="submit" value="　設　定　">
</th>
</tr>
<tr>
<td width=150 align=center bgcolor=#FFEEF4>-月(毎年)-</td>
<td width=500>

<table>
<tr>
<td>
<input type="checkbox" name="january" value="1" <?php if ($this->_tpl_vars['regular_data']['january']): ?>checked<?php endif; ?>> 1月
</td><td>
<input type="checkbox" name="february" value="1" <?php if ($this->_tpl_vars['regular_data']['february']): ?>checked<?php endif; ?>> 2月
</td><td>
<input type="checkbox" name="march" value="1" <?php if ($this->_tpl_vars['regular_data']['march']): ?>checked<?php endif; ?>> 3月
</td><td>
<input type="checkbox" name="april" value="1" <?php if ($this->_tpl_vars['regular_data']['april']): ?>checked<?php endif; ?>> 4月
</td><td>
<input type="checkbox" name="may" value="1" <?php if ($this->_tpl_vars['regular_data']['may']): ?>checked<?php endif; ?>> 5月
</td><td>
<input type="checkbox" name="june" value="1" <?php if ($this->_tpl_vars['regular_data']['june']): ?>checked<?php endif; ?>> 6月
</td></tr><tr><td>
<input type="checkbox" name="july" value="1" <?php if ($this->_tpl_vars['regular_data']['july']): ?>checked<?php endif; ?>> 7月
</td><td>
<input type="checkbox" name="august" value="1" <?php if ($this->_tpl_vars['regular_data']['august']): ?>checked<?php endif; ?>> 8月
</td><td>
<input type="checkbox" name="september" value="1" <?php if ($this->_tpl_vars['regular_data']['september']): ?>checked<?php endif; ?>> 9月
</td><td>
<input type="checkbox" name="october" value="1" <?php if ($this->_tpl_vars['regular_data']['october']): ?>checked<?php endif; ?>> 10月
</td><td>
<input type="checkbox" name="november" value="1" <?php if ($this->_tpl_vars['regular_data']['november']): ?>checked<?php endif; ?>> 11月
</td><td>
<input type="checkbox" name="december" value="1" <?php if ($this->_tpl_vars['regular_data']['december']): ?>checked<?php endif; ?>> 12月
</td>
</table>

</td>
</tr>
<tr>
<td  align=center bgcolor=#FFEEF4>-曜日(毎月)-</td>
<td>

<table>
<tr>
<td>

<input type="checkbox" name="sunday" value="1" <?php if ($this->_tpl_vars['regular_data']['sunday']): ?>checked<?php endif; ?>> 日曜日
</td><td>
<input type="checkbox" name="monday" value="1" <?php if ($this->_tpl_vars['regular_data']['monday']): ?>checked<?php endif; ?>> 月曜日
</td><td>
<input type="checkbox" name="tuesday" value="1" <?php if ($this->_tpl_vars['regular_data']['tuesday']): ?>checked<?php endif; ?>> 火曜日
</td><td>
<input type="checkbox" name="wednesday" value="1" <?php if ($this->_tpl_vars['regular_data']['wednesday']): ?>checked<?php endif; ?>> 水曜日
</td><td>
<input type="checkbox" name="thursday" value="1" <?php if ($this->_tpl_vars['regular_data']['thursday']): ?>checked<?php endif; ?>> 木曜日
</td><td>
<input type="checkbox" name="friday" value="1" <?php if ($this->_tpl_vars['regular_data']['friday']): ?>checked<?php endif; ?>> 金曜日
</td><td>
<input type="checkbox" name="saturday" value="1" <?php if ($this->_tpl_vars['regular_data']['saturday']): ?>checked<?php endif; ?>> 土曜日
</td>
</tr>
</table>

</td>
</tr>
<tr>
<td  align=center bgcolor=#FFEEF4>-日(毎月)-</td>
<td>

<table border=1>
<tr>
<td>
<input type="checkbox" name="day1" value="1" <?php if ($this->_tpl_vars['regular_data']['day1']): ?>checked<?php endif; ?>> 1日
</td><td>
<input type="checkbox" name="day2" value="1" <?php if ($this->_tpl_vars['regular_data']['day2']): ?>checked<?php endif; ?>> 2日
</td><td>
<input type="checkbox" name="day3" value="1" <?php if ($this->_tpl_vars['regular_data']['day3']): ?>checked<?php endif; ?>> 3日
</td><td>
<input type="checkbox" name="day4" value="1" <?php if ($this->_tpl_vars['regular_data']['day4']): ?>checked<?php endif; ?>> 4日
</td><td>
<input type="checkbox" name="day5" value="1" <?php if ($this->_tpl_vars['regular_data']['day5']): ?>checked<?php endif; ?>> 5日
</td><td>
<input type="checkbox" name="day6" value="1" <?php if ($this->_tpl_vars['regular_data']['day6']): ?>checked<?php endif; ?>> 6日
</td><td>
<input type="checkbox" name="day7" value="1" <?php if ($this->_tpl_vars['regular_data']['day7']): ?>checked<?php endif; ?>> 7日
</td></tr><tr><td>
<input type="checkbox" name="day8" value="1" <?php if ($this->_tpl_vars['regular_data']['day8']): ?>checked<?php endif; ?>> 8日
</td><td>
<input type="checkbox" name="day9" value="1" <?php if ($this->_tpl_vars['regular_data']['day9']): ?>checked<?php endif; ?>> 9日
</td><td>
<input type="checkbox" name="day10" value="1" <?php if ($this->_tpl_vars['regular_data']['day10']): ?>checked<?php endif; ?>> 10日
</td><td>
<input type="checkbox" name="day11" value="1" <?php if ($this->_tpl_vars['regular_data']['day11']): ?>checked<?php endif; ?>> 11日
</td><td>
<input type="checkbox" name="day12" value="1" <?php if ($this->_tpl_vars['regular_data']['day12']): ?>checked<?php endif; ?>> 12日
</td><td>
<input type="checkbox" name="day13" value="1" <?php if ($this->_tpl_vars['regular_data']['day13']): ?>checked<?php endif; ?>> 13日
</td><td>
<input type="checkbox" name="day14" value="1" <?php if ($this->_tpl_vars['regular_data']['day14']): ?>checked<?php endif; ?>> 14日
</td></tr><tr><td>
<input type="checkbox" name="day15" value="1" <?php if ($this->_tpl_vars['regular_data']['day15']): ?>checked<?php endif; ?>> 15日
</td><td>
<input type="checkbox" name="day16" value="1" <?php if ($this->_tpl_vars['regular_data']['day16']): ?>checked<?php endif; ?>> 16日
</td><td>
<input type="checkbox" name="day17" value="1" <?php if ($this->_tpl_vars['regular_data']['day17']): ?>checked<?php endif; ?>> 17日
</td><td>
<input type="checkbox" name="day18" value="1" <?php if ($this->_tpl_vars['regular_data']['day18']): ?>checked<?php endif; ?>> 18日
</td><td>
<input type="checkbox" name="day19" value="1" <?php if ($this->_tpl_vars['regular_data']['day19']): ?>checked<?php endif; ?>> 19日
</td><td>
<input type="checkbox" name="day20" value="1" <?php if ($this->_tpl_vars['regular_data']['day20']): ?>checked<?php endif; ?>> 20日
</td><td>
<input type="checkbox" name="day21" value="1" <?php if ($this->_tpl_vars['regular_data']['day21']): ?>checked<?php endif; ?>> 21日
</td></tr><tr><td>
<input type="checkbox" name="day22" value="1" <?php if ($this->_tpl_vars['regular_data']['day22']): ?>checked<?php endif; ?>> 22日
</td><td>
<input type="checkbox" name="day23" value="1" <?php if ($this->_tpl_vars['regular_data']['day23']): ?>checked<?php endif; ?>> 23日
</td><td>
<input type="checkbox" name="day24" value="1" <?php if ($this->_tpl_vars['regular_data']['day24']): ?>checked<?php endif; ?>> 24日
</td><td>
<input type="checkbox" name="day25" value="1" <?php if ($this->_tpl_vars['regular_data']['day25']): ?>checked<?php endif; ?>> 25日
</td><td>
<input type="checkbox" name="day26" value="1" <?php if ($this->_tpl_vars['regular_data']['day26']): ?>checked<?php endif; ?>> 26日
</td><td>
<input type="checkbox" name="day27" value="1" <?php if ($this->_tpl_vars['regular_data']['day27']): ?>checked<?php endif; ?>> 27日
</td><td>
<input type="checkbox" name="day28" value="1" <?php if ($this->_tpl_vars['regular_data']['day28']): ?>checked<?php endif; ?>> 28日
</td></tr><tr><td>
<input type="checkbox" name="day29" value="1" <?php if ($this->_tpl_vars['regular_data']['day29']): ?>checked<?php endif; ?>> 29日
</td><td>
<input type="checkbox" name="day30" value="1" <?php if ($this->_tpl_vars['regular_data']['day30']): ?>checked<?php endif; ?>> 30日
</td><td>
<input type="checkbox" name="day31" value="1" <?php if ($this->_tpl_vars['regular_data']['day31']): ?>checked<?php endif; ?>> 31日
</td>
</tr>
</table>

</td>
</tr>
<tr>
<td bgcolor=#FFEEF4>
-祝日（毎年）-
</td>
<td align=left>
<span style="margin:5px">
<input type="checkbox" name="holiday" value="1" <?php if ($this->_tpl_vars['regular_data']['holiday']): ?>checked<?php endif; ?>> 祝日を一括で休日にする</span>
</td>
</tr>
</table>
</form>
<br><br>

<form name="bank" method="POST" action="./">
<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
<input type="hidden" name="a" value="do_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('add_hall_holiday','do')); ?>
" />
<input type="hidden" name="sessid" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['PHPSESSID']); ?>
" />
<input type="hidden" name="hall_id" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['hall_id']); ?>
" />

<table border=1 width=650>
<tr>
<th colspan=3 height=50 bgcolor=#FF0000>　
<span style="font-size: 16pt; color: #FFFFFF"><b>日付指定　</b></span><input type="submit" value="　設　定　">
</th>
</tr>
<?php $_from = $this->_tpl_vars['holiday_num_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
<tr>
<td width=150 align=center bgcolor=#FFEEF4>設定<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']); ?>
</td>
<td align=center>
<input type="text" name="year<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']); ?>
" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['holiday_list'][$this->_tpl_vars['key']]['year']); ?>
" size=10> 年 
<input type="text" name="month<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']); ?>
" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['holiday_list'][$this->_tpl_vars['key']]['month']); ?>
" size=10> 月 
<input type="text" name="day<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']); ?>
" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['holiday_list'][$this->_tpl_vars['key']]['day']); ?>
" size=10> 日
</td>
<td>
<input type="checkbox" name="delete<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']); ?>
"> 削除
</td>
</tr>
<?php endforeach; endif; unset($_from); ?>
<tr>
<th colspan=3 height=50 bgcolor=#FF0000>　
<input type="submit" value="　設　定　">
</th>
</tr>
</table>
<br>
<span style="color: #FF0000;"><b>
※ 日付を指定して30日分の休日を設定できます。<br>
※ 日付の過ぎた指定休日のデータは、このページを開いたときに削除され、新たに設定できます。
</b></span>

</td>
</tr>
</table>

</form>

</center>

<?php else: ?>
<br>
<center>
<span style="font-size: 16px; color: #FF0033;"><b>アクセス権がありません。</b></span>
</center>
<?php endif; ?>
<div>
<?php echo $this->_tpl_vars['inc_footer']; ?>
