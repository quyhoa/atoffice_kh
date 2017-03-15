<?php /* Smarty version 2.6.18, created on 2016-12-29 08:14:33
         compiled from file:/var/www/html/atoffice/webapp/modules/admin/templates/room_list.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'ext_include', 'file:/var/www/html/atoffice/webapp/modules/admin/templates/room_list.tpl', 3, false),array('modifier', 't_escape', 'file:/var/www/html/atoffice/webapp/modules/admin/templates/room_list.tpl', 23, false),)), $this); ?>
<?php echo $this->_tpl_vars['inc_header']; ?>

<a name="top">
<?php echo smarty_function_ext_include(array('file' => "inc_subnavi_adminImageKakikomi.tpl"), $this);?>

<?php $this->assign('page_name', "部屋一覧"); ?>
<?php echo smarty_function_ext_include(array('file' => "inc_tree_adminImageKakikomi.tpl"), $this);?>

</div>


<?php if ($this->_tpl_vars['atoffice_auth_type'] == 1 || $this->_tpl_vars['atoffice_auth_type'] == 4): ?>

<style type="text/css">
<!--
HR {
	border-style:dotted;color:#3399FF

}
-->
</style>


<h2 id="ttl01">部屋一覧【<?php echo smarty_modifier_t_escape($this->_tpl_vars['hall_name']); ?>
】</h2>
<br>
<center>
<?php if ($this->_tpl_vars['msg']): ?><p class="actionMsg"><?php echo smarty_modifier_t_escape($this->_tpl_vars['msg']); ?>
</p><br><br><?php endif; ?>

<br><br>
<?php $_from = $this->_tpl_vars['rooms']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<a href="./#room<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']+1); ?>
">|部屋<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']+1); ?>
|</a>
<?php endforeach; endif; unset($_from); ?>
<br><br>

<table border=1 width=750>

<?php $_from = $this->_tpl_vars['rooms']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>

<?php if ($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['room_name']): ?>

<tr>
<?php if ($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['flag']): ?>
<td width=100 height=50 bgcolor=#FFCC00>
<span style="font-size: 16pt;"><b>部屋<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']+1); ?>
</b></span><br><br>
<span style="font-size: 16pt;color:#FF0000;"><b>有効</b></span><br><br>
<form name="flag_off" method="POST" action="./">
<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
<input type="hidden" name="a" value="page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('room_list','page')); ?>
" />
<input type="hidden" name="hall_id" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['hall_id']); ?>
" />
<input type="hidden" name="room_id" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']+1); ?>
" />
<input type="hidden" name="flag_change" value="100">
<input type="submit" value="　無効にする　">
</form>

<?php else: ?>
<td width=100 height=50 bgcolor=#000000>
<span style="font-size: 16pt;color:#FFFFFF;"><b>部屋<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']+1); ?>
</b></span><br><br>
<span style="font-size: 16pt;color:#FFFF00;"><b>無効</b></span><br><br>
<form name="flag_on" method="POST" action="./">
<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
<input type="hidden" name="a" value="page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('room_list','page')); ?>
" />
<input type="hidden" name="hall_id" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['hall_id']); ?>
" />
<input type="hidden" name="room_id" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']+1); ?>
" />
<input type="hidden" name="flag_change" value="200">
<input type="submit" value="　有効にする　">
</form>


<?php endif; ?>
<br>
<a href="#top">Topへ戻る</a>
</td>
<td align=center>

<table width=600>
<tr><td align=left>
<a name="room<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']+1); ?>
">
<span style="color: #6633FF;"><b>部屋名称：</b></span><?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['room_name']); ?>
<br>
<span style="color: #6633FF;"><b>コマ設定タイプ：</b></span>
<?php if ($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['type'] == 1): ?>
時間指定（池袋タイプ）
<?php else: ?>
時間当たり（神田タイプ）
<?php endif; ?>
<br>
<span style="color: #6633FF;"><b>使用人数：</b></span>
スクール<b><?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['num_school']); ?>
</b>人／
口の字<b><?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['num_mouth']); ?>
</b>人／
シアター<b><?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['num_theater']); ?>
</b>人
<br>
<span style="color: #6633FF;"><b>利用可能属性：</b></span>
<?php if ($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['corp']): ?>
<b>○</b>
<?php else: ?>
<b>×</b>
<?php endif; ?>法人　
<?php if ($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['individual']): ?>
<b>○</b>
<?php else: ?>
<b>×</b>
<?php endif; ?>個人　
<br>
<span style="color: #6633FF;"><b>利用可能用途：</b></span>
<?php if ($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['conference']): ?>
<b>○</b>
<?php else: ?>
<b>×</b>
<?php endif; ?>会議　
<?php if ($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['seminar']): ?>
<b>○</b>
<?php else: ?>
<b>×</b>
<?php endif; ?>セミナー　
<?php if ($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['training']): ?>
<b>○</b>
<?php else: ?>
<b>×</b>
<?php endif; ?>研修　
<?php if ($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['interview']): ?>
<b>○</b>
<?php else: ?>
<b>×</b>
<?php endif; ?>面接・試験　
<?php if ($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['party']): ?>
<b>○</b>
<?php else: ?>
<b>×</b>
<?php endif; ?>懇談会・パーティ　
<?php if ($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['etc']): ?>
<b>○</b>
<?php else: ?>
<b>×</b>
<?php endif; ?>その他
<br>
<hr>
<br>
<span style="color: #6633FF;"><b>コマ設定プレビュー</b></span><br>
<br>

<?php $_from = $this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['ikebukuro']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['value']):
?>
<span style="color: #6633FF;"><b><?php echo smarty_modifier_t_escape($this->_tpl_vars['value']['koma']); ?>
コマ目：</b></span>
<b><?php echo smarty_modifier_t_escape($this->_tpl_vars['value']['begin_time']); ?>
</b>時　～　<b><?php echo smarty_modifier_t_escape($this->_tpl_vars['value']['finish_time']); ?>
</b>時　<b><?php echo smarty_modifier_t_escape($this->_tpl_vars['value']['price']); ?>
</b>円<br>
<?php endforeach; endif; unset($_from); ?>

<?php if ($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['type'] == 1): ?>

<br>
<?php elseif ($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['type'] == 2): ?>
<span style="color: #6633FF;"><b>１コマあたりの時間単位：</b></span>
<?php if ($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['koma'] < 1): ?>
<b>
<?php if ($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['koma'] == 0.25): ?>
15
<?php else: ?>
30
<?php endif; ?>
</b>分<br>
<?php else: ?>
<b><?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['koma']); ?>
</b>時間<br>
<?php endif; ?>
<span style="color: #6633FF;"><b>１コマあたりの人数と値段：</b></span><br>
<table>
<?php if ($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['k_lowest_price']): ?>
<tr>
<td width=200><b><?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['k_capa_lowest']); ?>
</b> 人　まで　</td>
<td align=right>
<b><?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['k_lowest_price']); ?>
</b>円<br>
</td>
</tr>
<?php endif; ?>
<?php if ($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['k_price2']): ?>
<tr>
<td width=200><b><?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['k_capa_low2']); ?>
</b> 人　～　
<b><?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['k_capa_high2']); ?>
</b> 人　まで　</td>
<td align=right>
<b><?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['k_price2']); ?>
</b>円<br>
</td>
</tr>
<?php endif; ?>
<?php if ($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['k_price3']): ?>
<tr>
<td width=200><b><?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['k_capa_low3']); ?>
</b> 人　～　
<b><?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['k_capa_high3']); ?>
</b> 人　まで　</td>
<td align=right>
<b><?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['k_price3']); ?>
</b>円<br>
</td>
</tr>
<?php endif; ?>
<?php if ($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['k_highest_price']): ?>
<tr>
<td width=200><b><?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['k_capa_highest']); ?>
</b> 人　以上　</td>
<td align=right>
<b><?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['k_highest_price']); ?>
</b>円<br>
</td>
</tr>
<?php endif; ?>
</table>

<span style="color: #6633FF;"><b>最低予約コマ数：</b></span>
<b><?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['lowest_koma']); ?>
</b>コマから予約可能<br>
<br>
<?php endif; ?>
<!-- 1 -->
<span style="color: #6633FF;"><b>平日</b></span>
<br/>
■　会場営業時間外　
<span style="color: #66CC00;">■</span>　予約可能な１コマ　
<span style="color: #FF6600;">■</span>　休憩時間又は余りのコマ（予約不可）
<?php if ($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['type'] == 1 || ( $this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['type'] == 2 && $this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['koma'] >= 1 )): ?>
<table border=1>
<tr>
<th width=20>00</th>
<th width=20>01</th>
<th width=20>02</th>
<th width=20>03</th>
<th width=20>04</th>
<th width=20>05</th>
<th width=20>06</th>
<th width=20>07</th>
<th width=20>08</th>
<th width=20>09</th>
<th width=20>10</th>
<th width=20>11</th>
<th width=20>12</th>
<th width=20>13</th>
<th width=20>14</th>
<th width=20>15</th>
<th width=20>16</th>
<th width=20>17</th>
<th width=20>18</th>
<th width=20>19</th>
<th width=20>20</th>
<th width=20>21</th>
<th width=20>22</th>
<th width=20>23</th>
<th width=20>24</th>
</tr>
<tr>
<?php if ($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['type'] == 1): ?>
<?php if ($this->_tpl_vars['hall_begin1']): ?>
<td height=20 colspan=<?php echo smarty_modifier_t_escape($this->_tpl_vars['hall_begin1']); ?>
 align=center bgcolor=#000000>
</td>
<?php endif; ?>

<?php $_from = $this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['span_list1']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item2']):
?>

<?php if ($this->_tpl_vars['item2']['span'] > 0): ?>
    <td colspan=<?php echo smarty_modifier_t_escape($this->_tpl_vars['item2']['span']); ?>
 bgcolor=<?php if ($this->_tpl_vars['item2']['rest']): ?>#FF6600<?php else: ?>#66CC00<?php endif; ?>></td>
<?php endif; ?>

<?php endforeach; endif; unset($_from); ?>

<td height=20 colspan=<?php echo smarty_modifier_t_escape($this->_tpl_vars['day_time']-$this->_tpl_vars['hall_finish1']); ?>
 align=center bgcolor=#000000></td>


<?php elseif ($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['type'] == 2): ?>

<td height=20 colspan=<?php echo smarty_modifier_t_escape($this->_tpl_vars['hall_begin1']); ?>
 align=center bgcolor=#000000>
</td>
<?php $_from = $this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['loop_list1']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item2']):
?>
    <td colspan=<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['koma']); ?>
 bgcolor=#66CC00></td>
<?php endforeach; endif; unset($_from); ?>
<?php $_from = $this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['etc_list1']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item2']):
?>
    <td bgcolor=#FF6600></td>
<?php endforeach; endif; unset($_from); ?>
<?php if ($this->_tpl_vars['day_time'] - $this->_tpl_vars['hall_finish1'] + 1): ?>
<td height=20 colspan=<?php echo smarty_modifier_t_escape($this->_tpl_vars['day_time']-$this->_tpl_vars['hall_finish1']+1); ?>
 align=center bgcolor=#000000></td>
<?php endif; ?>
<?php endif; ?>

</tr>
</table>
<?php else: ?>
<br>

<table border=1>
<tr>
<th width=20 colspan=<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['th_span']); ?>
>00</th>
<th width=20 colspan=<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['th_span']); ?>
>01</th>
<th width=20 colspan=<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['th_span']); ?>
>02</th>
<th width=20 colspan=<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['th_span']); ?>
>03</th>
<th width=20 colspan=<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['th_span']); ?>
>04</th>
<th width=20 colspan=<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['th_span']); ?>
>05</th>
<th width=20 colspan=<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['th_span']); ?>
>06</th>
<th width=20 colspan=<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['th_span']); ?>
>07</th>
<th width=20 colspan=<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['th_span']); ?>
>08</th>
<th width=20 colspan=<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['th_span']); ?>
>09</th>
<th width=20 colspan=<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['th_span']); ?>
>10</th>
<th width=20 colspan=<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['th_span']); ?>
>11</th>
<th width=20 colspan=<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['th_span']); ?>
>12</th>
<th width=20 colspan=<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['th_span']); ?>
>13</th>
<th width=20 colspan=<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['th_span']); ?>
>14</th>
<th width=20 colspan=<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['th_span']); ?>
>15</th>
<th width=20 colspan=<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['th_span']); ?>
>16</th>
<th width=20 colspan=<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['th_span']); ?>
>17</th>
<th width=20 colspan=<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['th_span']); ?>
>18</th>
<th width=20 colspan=<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['th_span']); ?>
>19</th>
<th width=20 colspan=<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['th_span']); ?>
>20</th>
<th width=20 colspan=<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['th_span']); ?>
>21</th>
<th width=20 colspan=<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['th_span']); ?>
>22</th>
<th width=20 colspan=<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['th_span']); ?>
>23</th>
<th width=20 colspan=<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['th_span']); ?>
>24</th>
</tr>
<tr>

<td colspan=<?php echo smarty_modifier_t_escape($this->_tpl_vars['hall_begin1']*$this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['th_span']); ?>
 bgcolor=#000000></td>

<?php $_from = $this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['minutes']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['min']):
?>

<?php if ($this->_tpl_vars['min'] > $this->_tpl_vars['hall_begin1'] && $this->_tpl_vars['min'] <= $this->_tpl_vars['hall_finish1']): ?>

<td bgcolor=#66CC00 height=20 width=2></td>
<td bgcolor=#66CC00 height=20 width=2></td>
<?php if ($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['th_span'] == 4): ?>
<td bgcolor=#66CC00 height=20 width=2></td>
<td bgcolor=#66CC00 height=20 width=2></td>
<?php endif; ?>
<?php endif; ?>
<?php endforeach; endif; unset($_from); ?>

<td colspan=24-<?php echo smarty_modifier_t_escape($this->_tpl_vars['hall_finish1']); ?>
 bgcolor=#000000></td>

</tr>


</table>

<br>
<?php endif; ?>
<!-- 2 -->
<span style="color: #6633FF;"><b>土曜日</b></span>
<br/>
■　会場営業時間外　
<span style="color: #66CC00;">■</span>　予約可能な１コマ　
<span style="color: #FF6600;">■</span>　休憩時間又は余りのコマ（予約不可）
<?php if ($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['type'] == 1 || ( $this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['type'] == 2 && $this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['koma'] >= 1 )): ?>
<table border=1>
<tr>
<th width=20>00</th>
<th width=20>01</th>
<th width=20>02</th>
<th width=20>03</th>
<th width=20>04</th>
<th width=20>05</th>
<th width=20>06</th>
<th width=20>07</th>
<th width=20>08</th>
<th width=20>09</th>
<th width=20>10</th>
<th width=20>11</th>
<th width=20>12</th>
<th width=20>13</th>
<th width=20>14</th>
<th width=20>15</th>
<th width=20>16</th>
<th width=20>17</th>
<th width=20>18</th>
<th width=20>19</th>
<th width=20>20</th>
<th width=20>21</th>
<th width=20>22</th>
<th width=20>23</th>
<th width=20>24</th>
</tr>
<tr>
<?php if ($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['type'] == 1): ?>
<?php if ($this->_tpl_vars['hall_begin2']): ?>
<td height=20 colspan=<?php echo smarty_modifier_t_escape($this->_tpl_vars['hall_begin2']); ?>
 align=center bgcolor=#000000>
</td>
<?php endif; ?>

<?php $_from = $this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['span_list2']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item2']):
?>

<?php if ($this->_tpl_vars['item2']['span'] > 0): ?>
    <td colspan=<?php echo smarty_modifier_t_escape($this->_tpl_vars['item2']['span']); ?>
 bgcolor=<?php if ($this->_tpl_vars['item2']['rest']): ?>#FF6600<?php else: ?>#66CC00<?php endif; ?>></td>
<?php endif; ?>

<?php endforeach; endif; unset($_from); ?>

<td height=20 colspan=<?php echo smarty_modifier_t_escape($this->_tpl_vars['day_time']-$this->_tpl_vars['hall_finish2']); ?>
 align=center bgcolor=#000000></td>


<?php elseif ($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['type'] == 2): ?>

<td height=20 colspan=<?php echo smarty_modifier_t_escape($this->_tpl_vars['hall_begin2']); ?>
 align=center bgcolor=#000000>
</td>
<?php $_from = $this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['loop_list2']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item2']):
?>
    <td colspan=<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['koma']); ?>
 bgcolor=#66CC00></td>
<?php endforeach; endif; unset($_from); ?>
<?php $_from = $this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['etc_list2']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item2']):
?>
    <td bgcolor=#FF6600></td>
<?php endforeach; endif; unset($_from); ?>
<?php if ($this->_tpl_vars['day_time'] - $this->_tpl_vars['hall_finish2'] + 1): ?>
<td height=20 colspan=<?php echo smarty_modifier_t_escape($this->_tpl_vars['day_time']-$this->_tpl_vars['hall_finish2']+1); ?>
 align=center bgcolor=#000000></td>
<?php endif; ?>
<?php endif; ?>

</tr>
</table>
<?php else: ?>
<br>

<table border=1>
<tr>
<th width=20 colspan=<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['th_span']); ?>
>00</th>
<th width=20 colspan=<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['th_span']); ?>
>01</th>
<th width=20 colspan=<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['th_span']); ?>
>02</th>
<th width=20 colspan=<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['th_span']); ?>
>03</th>
<th width=20 colspan=<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['th_span']); ?>
>04</th>
<th width=20 colspan=<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['th_span']); ?>
>05</th>
<th width=20 colspan=<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['th_span']); ?>
>06</th>
<th width=20 colspan=<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['th_span']); ?>
>07</th>
<th width=20 colspan=<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['th_span']); ?>
>08</th>
<th width=20 colspan=<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['th_span']); ?>
>09</th>
<th width=20 colspan=<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['th_span']); ?>
>10</th>
<th width=20 colspan=<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['th_span']); ?>
>11</th>
<th width=20 colspan=<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['th_span']); ?>
>12</th>
<th width=20 colspan=<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['th_span']); ?>
>13</th>
<th width=20 colspan=<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['th_span']); ?>
>14</th>
<th width=20 colspan=<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['th_span']); ?>
>15</th>
<th width=20 colspan=<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['th_span']); ?>
>16</th>
<th width=20 colspan=<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['th_span']); ?>
>17</th>
<th width=20 colspan=<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['th_span']); ?>
>18</th>
<th width=20 colspan=<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['th_span']); ?>
>19</th>
<th width=20 colspan=<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['th_span']); ?>
>20</th>
<th width=20 colspan=<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['th_span']); ?>
>21</th>
<th width=20 colspan=<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['th_span']); ?>
>22</th>
<th width=20 colspan=<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['th_span']); ?>
>23</th>
<th width=20 colspan=<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['th_span']); ?>
>24</th>
</tr>
<tr>

<td colspan=<?php echo smarty_modifier_t_escape($this->_tpl_vars['hall_begin2']*$this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['th_span']); ?>
 bgcolor=#000000></td>

<?php $_from = $this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['minutes']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['min']):
?>

<?php if ($this->_tpl_vars['min'] > $this->_tpl_vars['hall_begin2'] && $this->_tpl_vars['min'] <= $this->_tpl_vars['hall_finish2']): ?>

<td bgcolor=#66CC00 height=20 width=2></td>
<td bgcolor=#66CC00 height=20 width=2></td>
<?php if ($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['th_span'] == 4): ?>
<td bgcolor=#66CC00 height=20 width=2></td>
<td bgcolor=#66CC00 height=20 width=2></td>
<?php endif; ?>
<?php endif; ?>
<?php endforeach; endif; unset($_from); ?>

<td colspan=24-<?php echo smarty_modifier_t_escape($this->_tpl_vars['hall_finish2']); ?>
 bgcolor=#000000></td>

</tr>


</table>

<br>
<?php endif; ?>
<!-- 3 -->
<span style="color: #6633FF;"><b>日曜日</b></span>
<br/>
■　会場営業時間外　
<span style="color: #66CC00;">■</span>　予約可能な１コマ　
<span style="color: #FF6600;">■</span>　休憩時間又は余りのコマ（予約不可）
<?php if ($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['type'] == 1 || ( $this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['type'] == 2 && $this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['koma'] >= 1 )): ?>
<table border=1>
<tr>
<th width=20>00</th>
<th width=20>01</th>
<th width=20>02</th>
<th width=20>03</th>
<th width=20>04</th>
<th width=20>05</th>
<th width=20>06</th>
<th width=20>07</th>
<th width=20>08</th>
<th width=20>09</th>
<th width=20>10</th>
<th width=20>11</th>
<th width=20>12</th>
<th width=20>13</th>
<th width=20>14</th>
<th width=20>15</th>
<th width=20>16</th>
<th width=20>17</th>
<th width=20>18</th>
<th width=20>19</th>
<th width=20>20</th>
<th width=20>21</th>
<th width=20>22</th>
<th width=20>23</th>
<th width=20>24</th>
</tr>
<tr>
<?php if ($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['type'] == 1): ?>
<?php if ($this->_tpl_vars['hall_begin3']): ?>
<td height=20 colspan=<?php echo smarty_modifier_t_escape($this->_tpl_vars['hall_begin3']); ?>
 align=center bgcolor=#000000>
</td>
<?php endif; ?>

<?php $_from = $this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['span_list3']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item2']):
?>

<?php if ($this->_tpl_vars['item2']['span'] > 0): ?>
    <td colspan=<?php echo smarty_modifier_t_escape($this->_tpl_vars['item2']['span']); ?>
 bgcolor=<?php if ($this->_tpl_vars['item2']['rest']): ?>#FF6600<?php else: ?>#66CC00<?php endif; ?>></td>
<?php endif; ?>

<?php endforeach; endif; unset($_from); ?>

<td height=20 colspan=<?php echo smarty_modifier_t_escape($this->_tpl_vars['day_time']-$this->_tpl_vars['hall_finish3']); ?>
 align=center bgcolor=#000000></td>


<?php elseif ($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['type'] == 2): ?>

<td height=20 colspan=<?php echo smarty_modifier_t_escape($this->_tpl_vars['hall_begin3']); ?>
 align=center bgcolor=#000000>
</td>
<?php $_from = $this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['loop_list3']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item2']):
?>
    <td colspan=<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['koma']); ?>
 bgcolor=#66CC00></td>
<?php endforeach; endif; unset($_from); ?>
<?php $_from = $this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['etc_list3']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item2']):
?>
    <td bgcolor=#FF6600></td>
<?php endforeach; endif; unset($_from); ?>
<?php if ($this->_tpl_vars['day_time'] - $this->_tpl_vars['hall_finish3'] + 1): ?>
<td height=20 colspan=<?php echo smarty_modifier_t_escape($this->_tpl_vars['day_time']-$this->_tpl_vars['hall_finish3']+1); ?>
 align=center bgcolor=#000000></td>
<?php endif; ?>
<?php endif; ?>

</tr>
</table>
<?php else: ?>
<br>

<table border=1>
<tr>
<th width=20 colspan=<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['th_span']); ?>
>00</th>
<th width=20 colspan=<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['th_span']); ?>
>01</th>
<th width=20 colspan=<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['th_span']); ?>
>02</th>
<th width=20 colspan=<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['th_span']); ?>
>03</th>
<th width=20 colspan=<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['th_span']); ?>
>04</th>
<th width=20 colspan=<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['th_span']); ?>
>05</th>
<th width=20 colspan=<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['th_span']); ?>
>06</th>
<th width=20 colspan=<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['th_span']); ?>
>07</th>
<th width=20 colspan=<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['th_span']); ?>
>08</th>
<th width=20 colspan=<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['th_span']); ?>
>09</th>
<th width=20 colspan=<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['th_span']); ?>
>10</th>
<th width=20 colspan=<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['th_span']); ?>
>11</th>
<th width=20 colspan=<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['th_span']); ?>
>12</th>
<th width=20 colspan=<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['th_span']); ?>
>13</th>
<th width=20 colspan=<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['th_span']); ?>
>14</th>
<th width=20 colspan=<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['th_span']); ?>
>15</th>
<th width=20 colspan=<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['th_span']); ?>
>16</th>
<th width=20 colspan=<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['th_span']); ?>
>17</th>
<th width=20 colspan=<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['th_span']); ?>
>18</th>
<th width=20 colspan=<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['th_span']); ?>
>19</th>
<th width=20 colspan=<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['th_span']); ?>
>20</th>
<th width=20 colspan=<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['th_span']); ?>
>21</th>
<th width=20 colspan=<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['th_span']); ?>
>22</th>
<th width=20 colspan=<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['th_span']); ?>
>23</th>
<th width=20 colspan=<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['th_span']); ?>
>24</th>
</tr>
<tr>

<td colspan=<?php echo smarty_modifier_t_escape($this->_tpl_vars['hall_begin3']*$this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['th_span']); ?>
 bgcolor=#000000></td>

<?php $_from = $this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['minutes']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['min']):
?>

<?php if ($this->_tpl_vars['min'] > $this->_tpl_vars['hall_begin3'] && $this->_tpl_vars['min'] <= $this->_tpl_vars['hall_finish3']): ?>

<td bgcolor=#66CC00 height=20 width=2></td>
<td bgcolor=#66CC00 height=20 width=2></td>
<?php if ($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['th_span'] == 4): ?>
<td bgcolor=#66CC00 height=20 width=2></td>
<td bgcolor=#66CC00 height=20 width=2></td>
<?php endif; ?>
<?php endif; ?>
<?php endforeach; endif; unset($_from); ?>

<td colspan=24-<?php echo smarty_modifier_t_escape($this->_tpl_vars['hall_finish3']); ?>
 bgcolor=#000000></td>

</tr>


</table>

<br>
<?php endif; ?>
<!-- 4 -->
<span style="color: #6633FF;"><b>祝日</b></span>
<br/>
■　会場営業時間外　
<span style="color: #66CC00;">■</span>　予約可能な１コマ　
<span style="color: #FF6600;">■</span>　休憩時間又は余りのコマ（予約不可）
<?php if ($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['type'] == 1 || ( $this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['type'] == 2 && $this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['koma'] >= 1 )): ?>
<table border=1>
<tr>
<th width=20>00</th>
<th width=20>01</th>
<th width=20>02</th>
<th width=20>03</th>
<th width=20>04</th>
<th width=20>05</th>
<th width=20>06</th>
<th width=20>07</th>
<th width=20>08</th>
<th width=20>09</th>
<th width=20>10</th>
<th width=20>11</th>
<th width=20>12</th>
<th width=20>13</th>
<th width=20>14</th>
<th width=20>15</th>
<th width=20>16</th>
<th width=20>17</th>
<th width=20>18</th>
<th width=20>19</th>
<th width=20>20</th>
<th width=20>21</th>
<th width=20>22</th>
<th width=20>23</th>
<th width=20>24</th>
</tr>
<tr>
<?php if ($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['type'] == 1): ?>
<?php if ($this->_tpl_vars['hall_begin4']): ?>
<td height=20 colspan=<?php echo smarty_modifier_t_escape($this->_tpl_vars['hall_begin4']); ?>
 align=center bgcolor=#000000>
</td>
<?php endif; ?>

<?php $_from = $this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['span_list4']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item2']):
?>

<?php if ($this->_tpl_vars['item2']['span'] > 0): ?>
    <td colspan=<?php echo smarty_modifier_t_escape($this->_tpl_vars['item2']['span']); ?>
 bgcolor=<?php if ($this->_tpl_vars['item2']['rest']): ?>#FF6600<?php else: ?>#66CC00<?php endif; ?>></td>
<?php endif; ?>

<?php endforeach; endif; unset($_from); ?>

<td height=20 colspan=<?php echo smarty_modifier_t_escape($this->_tpl_vars['day_time']-$this->_tpl_vars['hall_finish4']); ?>
 align=center bgcolor=#000000></td>


<?php elseif ($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['type'] == 2): ?>

<td height=20 colspan=<?php echo smarty_modifier_t_escape($this->_tpl_vars['hall_begin4']); ?>
 align=center bgcolor=#000000>
</td>
<?php $_from = $this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['loop_list4']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item2']):
?>
    <td colspan=<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['koma']); ?>
 bgcolor=#66CC00></td>
<?php endforeach; endif; unset($_from); ?>
<?php $_from = $this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['etc_list4']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item2']):
?>
    <td bgcolor=#FF6600></td>
<?php endforeach; endif; unset($_from); ?>
<?php if ($this->_tpl_vars['day_time'] - $this->_tpl_vars['hall_finish4'] + 1): ?>
<td height=20 colspan=<?php echo smarty_modifier_t_escape($this->_tpl_vars['day_time']-$this->_tpl_vars['hall_finish4']+1); ?>
 align=center bgcolor=#000000></td>
<?php endif; ?>
<?php endif; ?>

</tr>
</table>
<?php else: ?>
<br>

<table border=1>
<tr>
<th width=20 colspan=<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['th_span']); ?>
>00</th>
<th width=20 colspan=<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['th_span']); ?>
>01</th>
<th width=20 colspan=<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['th_span']); ?>
>02</th>
<th width=20 colspan=<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['th_span']); ?>
>03</th>
<th width=20 colspan=<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['th_span']); ?>
>04</th>
<th width=20 colspan=<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['th_span']); ?>
>05</th>
<th width=20 colspan=<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['th_span']); ?>
>06</th>
<th width=20 colspan=<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['th_span']); ?>
>07</th>
<th width=20 colspan=<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['th_span']); ?>
>08</th>
<th width=20 colspan=<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['th_span']); ?>
>09</th>
<th width=20 colspan=<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['th_span']); ?>
>10</th>
<th width=20 colspan=<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['th_span']); ?>
>11</th>
<th width=20 colspan=<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['th_span']); ?>
>12</th>
<th width=20 colspan=<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['th_span']); ?>
>13</th>
<th width=20 colspan=<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['th_span']); ?>
>14</th>
<th width=20 colspan=<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['th_span']); ?>
>15</th>
<th width=20 colspan=<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['th_span']); ?>
>16</th>
<th width=20 colspan=<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['th_span']); ?>
>17</th>
<th width=20 colspan=<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['th_span']); ?>
>18</th>
<th width=20 colspan=<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['th_span']); ?>
>19</th>
<th width=20 colspan=<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['th_span']); ?>
>20</th>
<th width=20 colspan=<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['th_span']); ?>
>21</th>
<th width=20 colspan=<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['th_span']); ?>
>22</th>
<th width=20 colspan=<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['th_span']); ?>
>23</th>
<th width=20 colspan=<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['th_span']); ?>
>24</th>
</tr>
<tr>

<td colspan=<?php echo smarty_modifier_t_escape($this->_tpl_vars['hall_begin4']*$this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['th_span']); ?>
 bgcolor=#000000></td>

<?php $_from = $this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['minutes']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['min']):
?>

<?php if ($this->_tpl_vars['min'] > $this->_tpl_vars['hall_begin'] && $this->_tpl_vars['min'] <= $this->_tpl_vars['hall_finish4']): ?>

<td bgcolor=#66CC00 height=20 width=2></td>
<td bgcolor=#66CC00 height=20 width=2></td>
<?php if ($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['th_span'] == 4): ?>
<td bgcolor=#66CC00 height=20 width=2></td>
<td bgcolor=#66CC00 height=20 width=2></td>
<?php endif; ?>
<?php endif; ?>
<?php endforeach; endif; unset($_from); ?>

<td colspan=24-<?php echo smarty_modifier_t_escape($this->_tpl_vars['hall_finish4']); ?>
 bgcolor=#000000></td>

</tr>


</table>

<br>
<?php endif; ?>
<hr>

<span style="color: #6633FF;"><b>選択キャンセル料率：</b></span>パターン<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['cancel']); ?>
<br>
<?php if ($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['cancel_pattern']['day1'] != ""): ?>
<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['cancel_pattern']['day1']); ?>
日前まで <?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['cancel_pattern']['percent1']); ?>
％ 
<?php endif; ?>
<?php if ($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['cancel_pattern']['day2'] != ""): ?>
 ／ <?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['cancel_pattern']['day2']); ?>
日前まで <?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['cancel_pattern']['percent2']); ?>
％ 
<?php endif; ?>
<?php if ($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['cancel_pattern']['day3'] != ""): ?>
 ／ <?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['cancel_pattern']['day3']); ?>
日前まで <?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['cancel_pattern']['percent3']); ?>
％ 
<?php endif; ?>
<?php if ($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['cancel_pattern']['day4'] != ""): ?>
 ／ <?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['cancel_pattern']['day4']); ?>
日前まで <?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['cancel_pattern']['percent4']); ?>
％ 
<?php endif; ?>
<?php if ($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['cancel_pattern']['day5'] != ""): ?>
 ／ <?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['cancel_pattern']['day5']); ?>
日前まで <?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['cancel_pattern']['percent5']); ?>
％ 
<?php endif; ?>

<hr>

<form name="hall_conf" method="POST" action="./">
<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
<input type="hidden" name="a" value="page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('room_discount_conf','page')); ?>
" />
<input type="hidden" name="hall_id" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['hall_id']); ?>
" />
<input type="hidden" name="room_id" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']+1); ?>
" />
<span style="color: #6633FF;"><b>部屋別割引設定：</b></span><input type="submit" value="　割引・パック料金を設定する　">
</form>
<br>
<table>
<?php $_from = $this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['discount']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['d_key'] => $this->_tpl_vars['d_item']):
?>
<tr>
<td><?php if ($this->_tpl_vars['d_key'] == 0): ?>有効割引：<?php endif; ?></td>
<?php if ($this->_tpl_vars['d_item']['pattern_id'] < 4): ?>
<td>パターン<?php echo smarty_modifier_t_escape($this->_tpl_vars['d_item']['pattern_id']); ?>
：　<?php echo smarty_modifier_t_escape($this->_tpl_vars['d_item']['begin_year']); ?>
年<?php echo smarty_modifier_t_escape($this->_tpl_vars['d_item']['begin_month']); ?>
月<?php echo smarty_modifier_t_escape($this->_tpl_vars['d_item']['begin_day']); ?>
日　～　<?php echo smarty_modifier_t_escape($this->_tpl_vars['d_item']['finish_year']); ?>
年<?php echo smarty_modifier_t_escape($this->_tpl_vars['d_item']['finish_month']); ?>
月<?php echo smarty_modifier_t_escape($this->_tpl_vars['d_item']['finish_day']); ?>
日　<?php echo smarty_modifier_t_escape($this->_tpl_vars['d_item']['percent']); ?>
%割引</td>
<?php else: ?>
<td>パターン<?php echo smarty_modifier_t_escape($this->_tpl_vars['d_item']['pattern_id']); ?>
：
<?php if ($this->_tpl_vars['d_item']['continuance'] == 1): ?>
全ての平日営業日
<?php elseif ($this->_tpl_vars['d_item']['continuance'] == 2): ?>
全ての土曜営業日
<?php elseif ($this->_tpl_vars['d_item']['continuance'] == 3): ?>
全ての日祭日営業日
<?php elseif ($this->_tpl_vars['d_item']['continuance'] == 4): ?>
全ての営業日
<?php endif; ?>
　<?php echo smarty_modifier_t_escape($this->_tpl_vars['d_item']['percent']); ?>
%割引</td>
<?php endif; ?>
</tr>
<?php endforeach; else: ?>
<tr>
<td>
有効割引：　<b>未設定</b>
</td>
</tr>
<?php endif; unset($_from); ?>
</table>

<table>
<?php $_from = $this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['pack']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['p_key'] => $this->_tpl_vars['p_item']):
?>
<tr>
<td><?php if ($this->_tpl_vars['p_key'] == 0): ?>有効Pack：<?php endif; ?></td>
<td>パック料金設定<?php echo smarty_modifier_t_escape($this->_tpl_vars['p_item']['pack_id']); ?>
：　<?php echo smarty_modifier_t_escape($this->_tpl_vars['p_item']['pack_name']); ?>
　
<?php if ($this->_tpl_vars['p_item']['begin_time'] || $this->_tpl_vars['p_item']['finish_time']): ?>
<?php echo smarty_modifier_t_escape($this->_tpl_vars['p_item']['begin_time']); ?>
時　～　<?php echo smarty_modifier_t_escape($this->_tpl_vars['p_item']['finish_time']); ?>
時　
<?php elseif ($this->_tpl_vars['p_item']['koma']): ?>
<?php echo smarty_modifier_t_escape($this->_tpl_vars['p_item']['koma']); ?>
コマ予約で、ひとコマあたり　
<?php endif; ?>
<?php if ($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['type'] == 1): ?>
    <?php echo smarty_modifier_t_escape($this->_tpl_vars['p_item']['price']); ?>
円
<?php else: ?>
    <?php echo smarty_modifier_t_escape($this->_tpl_vars['p_item']['price']); ?>
%割引き
<?php endif; ?>
</td>
</tr>
<?php endforeach; else: ?>
<tr>
<td>
有効割引2：　<b>未設定</b>
</td>
</tr>
<?php endif; unset($_from); ?>
</table>

<hr>

<form name="hall_conf" method="POST" action="./">
<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
<input type="hidden" name="a" value="page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('room_holiday_conf','page')); ?>
" />
<input type="hidden" name="hall_id" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['hall_id']); ?>
" />
<input type="hidden" name="room_id" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']+1); ?>
" />
<span style="color: #6633FF;"><b>部屋別休日設定：</b></span><input type="submit" value="　休日設定をする　">
</form>


<hr>

<form name="hall_conf" method="POST" action="./">
<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
<input type="hidden" name="a" value="page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('room_vessel_conf','page')); ?>
" />
<input type="hidden" name="hall_id" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['hall_id']); ?>
" />
<input type="hidden" name="room_id" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']+1); ?>
" />
<span style="color: #6633FF;"><b>部屋別備品設定：</b></span><input type="submit" value="　備品設定をする　">
</form>
選択備品一覧：
<?php if ($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['vessel_list']): ?>
<b><?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['vessel_list']); ?>
</b>
<?php else: ?>
<b>未選択</b>
<?php endif; ?>
<br>
<hr>

<form name="hall_conf" method="POST" action="./">
<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
<input type="hidden" name="a" value="page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('room_service_conf','page')); ?>
" />
<input type="hidden" name="hall_id" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['hall_id']); ?>
" />
<input type="hidden" name="room_id" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']+1); ?>
" />
<span style="color: #6633FF;"><b>部屋別サービス設定：</b></span><input type="submit" value="　サービス設定をする　">
</form>
選択サービス一覧：
<?php if ($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['service_list']): ?>
<b><?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data'][$this->_tpl_vars['item']]['service_list']); ?>
</b>
<?php else: ?>
<b>未選択</b>
<?php endif; ?>


<?php else: ?>

<tr>

<td width=100 height=50 bgcolor=#CCFFCC>
<span style="font-size: 16pt;"><b>部屋<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']+1); ?>
</b></span>
<br>
<a href="#top">Topへ戻る</a>
</td>
<td align=center>

<table width=600>
<tr><td align=left>
<a name="room<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']+1); ?>
">
<span style="color: #FF0000;"><b>未設定</b></span>
<?php endif; ?>
<hr>
<form name="hall_conf" method="POST" action="./">
<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
<input type="hidden" name="a" value="page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('add_room','page')); ?>
" />
<input type="hidden" name="hall_id" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['hall_id']); ?>
" />
<input type="hidden" name="room_id" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']+1); ?>
" />
<input type="submit" value="　この部屋の設定をする　">
</form>
</td></tr>
</table>

</td>
</tr>
<?php endforeach; endif; unset($_from); ?>

</table>

</center>

<?php else: ?>
<br>
<center>
<span style="font-size: 16px; color: #FF0033;"><b>アクセス権がありません。</b></span>
</center>
<?php endif; ?>

<div>
<?php echo $this->_tpl_vars['inc_footer']; ?>
