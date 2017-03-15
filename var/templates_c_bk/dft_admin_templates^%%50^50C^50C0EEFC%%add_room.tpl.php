<?php /* Smarty version 2.6.18, created on 2015-11-30 16:37:06
         compiled from file:/var/www/atoffice/webapp/modules/admin/templates/add_room.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'ext_include', 'file:/var/www/atoffice/webapp/modules/admin/templates/add_room.tpl', 2, false),array('modifier', 't_escape', 'file:/var/www/atoffice/webapp/modules/admin/templates/add_room.tpl', 37, false),)), $this); ?>
<?php echo $this->_tpl_vars['inc_header']; ?>

<?php echo smarty_function_ext_include(array('file' => "inc_subnavi_adminImageKakikomi.tpl"), $this);?>

<?php $this->assign('page_name', "部屋登録"); ?>
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
<script type="text/javascript">

function Sel(){
	var obj=document.forms['add_room'].elements['type'];
	if(obj[0].checked){
	document.getElementById('d1').style.display='block';
	document.getElementById('d2').style.display='none';
	}
	if(obj[1].checked){
	document.getElementById('d1').style.display='none';
	document.getElementById('d2').style.display='block';
	}
}

</script>


<h2 id="ttl01">部屋登録【<?php echo smarty_modifier_t_escape($this->_tpl_vars['hall_name']); ?>
】【部屋<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_id']); ?>
】</h2>
<br>
<div align=right>
<form method="POST" action="./">
<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
<input type="hidden" name="a" value="page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('room_list','page')); ?>
" />
<input type="hidden" name="hall_id" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['hall_id']); ?>
">
<input type="submit" value="　部屋一覧へ戻る　">
</form>
</div>
<br>
<center>
<?php if ($this->_tpl_vars['msg']): ?><p class="actionMsg"><?php echo smarty_modifier_t_escape($this->_tpl_vars['msg']); ?>
</p><br><br><?php endif; ?>

<br><br>

<form name="add_room" method="POST" action="./">
<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
<input type="hidden" name="a" value="page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('add_room_confrim','page')); ?>
" />
<input type="hidden" name="sessid" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['PHPSESSID']); ?>
" />
<input type="hidden" name="hall_id" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['hall_id']); ?>
">
<input type="hidden" name="room_id" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_id']); ?>
">


<table border=1 width=700>
<tr>
<th height=30 bgcolor=#FFFFCC><b>コマ設定タイプ</b></th>
</tr>
<tr>
<td align=center>
	<table>
	<td  width=300 height=20>
	<input type="radio" name="type" value="1" onclick="Sel()"
	<?php if ($this->_tpl_vars['room_data']['type'] == 1): ?>checked<?php endif; ?>> 時間指定（池袋タイプ）
	</td>
	<td>
	<input type="radio" name="type" value="2" onclick="Sel()"
	<?php if ($this->_tpl_vars['room_data']['type'] == 2): ?>checked<?php endif; ?>> 時間当たり（神田タイプ）
	</td>
	</table>


</td>
</tr>
</table>
<br>
<br>

<div id="d1" <?php if ($this->_tpl_vars['room_data']['type'] == 1): ?>style="display:block;"<?php else: ?>style="display:none;"<?php endif; ?>>

<table border=1>
<tr>
<th colspan=3 align=center width=700 height=30 bgcolor=#F0FFF0>基本設定　-時間指定（池袋タイプ）-</th>
</tr>
<tr>
<td bgcolor=#F0F0F0 width=150><b>部屋名称</b></td>
<td colspan=2 align=left><input type="text" name="room_name1" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data']['room_name1']); ?>
" size="30"></td>
</tr>
<tr>
<td bgcolor=#F0F0F0><b>収容人数</b></td>
<td colspan=2>
<table>
<td width=170>
スクール：<input type="text" name="num_school1" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data']['num_school1']); ?>
" size="10">人
</td>
<td width=170>
口の字：<input type="text" name="num_mouth1" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data']['num_mouth1']); ?>
" size="10">人
</td>
<td width=170>
シアター：<input type="text" name="num_theater1" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data']['num_theater1']); ?>
" size="10">人
</td>
</table>
</td>
</tr>
<tr>
<td bgcolor=#F0F0F0 width=150><b>利用可能属性</b></td>
<td colspan=2>

<table>
<td width=80>
<input type="checkbox" name="corp1" value="1" <?php if ($this->_tpl_vars['room_data']['corp1']): ?>checked<?php endif; ?>> 法人
</td>
<td>
<input type="checkbox" name="individual1" value="1" <?php if ($this->_tpl_vars['room_data']['individual1']): ?>checked<?php endif; ?>> 個人
</td>

</table>

</td>
</tr>
<tr>
<td bgcolor=#F0F0F0 width=150><b>利用可能用途</b></td>
<td colspan=2>

<table>
<td width=60>
<input type="checkbox" name="conference1" value="1" <?php if ($this->_tpl_vars['room_data']['conference1']): ?>checked<?php endif; ?>> 会議
</td>
<td width=70>
<input type="checkbox" name="seminar1" value="1" <?php if ($this->_tpl_vars['room_data']['seminar1']): ?>checked<?php endif; ?>> セミナー
</td>
<td width=60>
<input type="checkbox" name="training1" value="1" <?php if ($this->_tpl_vars['room_data']['training1']): ?>checked<?php endif; ?>> 研修
</td>
<td width=100>
<input type="checkbox" name="interview1" value="1" <?php if ($this->_tpl_vars['room_data']['interview1']): ?>checked<?php endif; ?>> 面接・試験
</td>
<td width=130>
<input type="checkbox" name="party1" value="1" <?php if ($this->_tpl_vars['room_data']['party1']): ?>checked<?php endif; ?>> 懇談会・パーティ
</td>
<td>
<input type="checkbox" name="etc1" value="1" <?php if ($this->_tpl_vars['room_data']['etc1']): ?>checked<?php endif; ?>> その他
</td>
</table>
</td>
</tr>
<tr>
<th colspan=3 align=center width=700 height=30 bgcolor=#F0FFF0>コマ設定　※ この会場の運営時間は、<?php echo smarty_modifier_t_escape($this->_tpl_vars['begin']); ?>
時～<?php echo smarty_modifier_t_escape($this->_tpl_vars['finish']); ?>
時です。</th>
</tr>
<tr>
<td align=center bgcolor=#FE3568><span style="color: #FFFFFF;"><b>コマ</b></span></td>
<td align=center bgcolor=#FE3568><span style="color: #FFFFFF;"><b>開始時間～終了時間</b></span></td>
<td align=center bgcolor=#FE3568><span style="color: #FFFFFF;"><b>料金（税込）</b></span></td>
</tr>
<?php $_from = $this->_tpl_vars['koma_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<tr>
<td align=center bgcolor=#FFC6C0><b><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['num']); ?>
コマ目</b></td>
<td align=center>
<input type="text" name="begin_time<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['num']); ?>
" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['begin_time']); ?>
" size=10> 時　～　<input type="text" name="finish_time<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['num']); ?>
" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['finish_time']); ?>
" size=10> 時
</td>
<td align=center bgcolor=#FFD9DC>
<input type="text" name="price<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['num']); ?>
" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['price']); ?>
" size=15> 円
</td>
</tr>
<?php endforeach; endif; unset($_from); ?>


</table>

</div>

<div id="d2" <?php if ($this->_tpl_vars['room_data']['type'] == 2): ?>style="display:block;"<?php else: ?>style="display:none;"<?php endif; ?>>


<table border=1>
<tr>
<th colspan=4 align=center width=700 height=30 bgcolor=#DCDCFF>基本設定　-時間当たり（神田タイプ）-</th>
</tr>
<tr>
<td bgcolor=#F0F0F0 width=150><b>部屋名称</b></td>
<td colspan=3 align=left><input type="text" name="room_name2" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data']['room_name2']); ?>
" size="30"></td>
</tr>
<tr>
<td bgcolor=#F0F0F0><b>収容人数</b></td>
<td colspan=3>
<table>
<td width=170>
スクール：<input type="text" name="num_school2" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data']['num_school2']); ?>
" size="10">人
</td>
<td width=170>
口の字：<input type="text" name="num_mouth2" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data']['num_mouth2']); ?>
" size="10">人
</td>
<td width=170>
シアター：<input type="text" name="num_theater2" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data']['num_theater2']); ?>
" size="10">人
</td>
</table>
</td>
</tr>
<tr>
<td bgcolor=#F0F0F0 width=150><b>利用可能属性</b></td>
<td colspan=3>

<table>
<td width=80>
<input type="checkbox" name="corp2" value="1" <?php if ($this->_tpl_vars['room_data']['corp2']): ?>checked<?php endif; ?>> 法人
</td>
<td>
<input type="checkbox" name="individual2" value="1" <?php if ($this->_tpl_vars['room_data']['individual2']): ?>checked<?php endif; ?>> 個人
</td>

</table>

</td>
</tr>
<tr>
<td bgcolor=#F0F0F0 width=150><b>利用可能用途</b></td>
<td colspan=3>

<table>
<td width=60>
<input type="checkbox" name="conference2" value="1" <?php if ($this->_tpl_vars['room_data']['conference2']): ?>checked<?php endif; ?>> 会議
</td>
<td width=70>
<input type="checkbox" name="seminar2" value="1" <?php if ($this->_tpl_vars['room_data']['seminar2']): ?>checked<?php endif; ?>> セミナー
</td>
<td width=60>
<input type="checkbox" name="training2" value="1" <?php if ($this->_tpl_vars['room_data']['training2']): ?>checked<?php endif; ?>> 研修
</td>
<td width=100>
<input type="checkbox" name="interview2" value="1" <?php if ($this->_tpl_vars['room_data']['interview2']): ?>checked<?php endif; ?>> 面接・試験
</td>
<td width=130>
<input type="checkbox" name="party2" value="1" <?php if ($this->_tpl_vars['room_data']['party2']): ?>checked<?php endif; ?>> 懇談会・パーティ
</td>
<td>
<input type="checkbox" name="etc2" value="1" <?php if ($this->_tpl_vars['room_data']['etc2']): ?>checked<?php endif; ?>> その他
</td>
</table>
</td>
</tr>
<tr>
<th colspan=4 align=center width=700 height=30 bgcolor=#DCDCFF>コマ設定　※ この会場の運営時間は、<?php echo smarty_modifier_t_escape($this->_tpl_vars['begin']); ?>
時～<?php echo smarty_modifier_t_escape($this->_tpl_vars['finish']); ?>
時です。</th>
</tr>
<tr>
<td bgcolor=#FFC6C0 width=150 align=center><b>1コマあたりの時間単位</b></td>
<td width=70>
<select name="koma">
<option value="0.25" <?php if ($this->_tpl_vars['room_data']['koma'] == 0.25): ?>selected<?php endif; ?>>　15分　</option>
<option value="0.5" <?php if ($this->_tpl_vars['room_data']['koma'] == 0.5): ?>selected<?php endif; ?>>　30分　</option>
<option value="1" <?php if ($this->_tpl_vars['room_data']['koma'] == 1): ?>selected<?php endif; ?>>　1時間　</option>
<option value="2" <?php if ($this->_tpl_vars['room_data']['koma'] == 2): ?>selected<?php endif; ?>>　2時間　</option>
<option value="3" <?php if ($this->_tpl_vars['room_data']['koma'] == 3): ?>selected<?php endif; ?>>　3時間　</option>
<option value="4" <?php if ($this->_tpl_vars['room_data']['koma'] == 4): ?>selected<?php endif; ?>>　4時間　</option>
<option value="5" <?php if ($this->_tpl_vars['room_data']['koma'] == 5): ?>selected<?php endif; ?>>　5時間　</option>
<option value="6" <?php if ($this->_tpl_vars['room_data']['koma'] == 6): ?>selected<?php endif; ?>>　6時間　</option>
</select>
</td>
<td bgcolor=#FFC6C0 width=150 align=center><b>最低予約コマ数<b></td>
<td>
<input type="text" name="lowest_koma" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data']['lowest_koma']); ?>
"> コマから予約可能
</td>
</tr>
<tr>
<td bgcolor=#FFC6C0 width=150 align=center><b>1コマあたりの値段１</b></td>
<td colspan=3 align=left>
<input type="text" name="k_capa_lowest" value="<?php if ($this->_tpl_vars['room_data']['k_capa_lowest']): ?><?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data']['k_capa_lowest']); ?>
<?php endif; ?>" size=10> 人　まで　
<input type="text" name="k_lowest_price" value="<?php if ($this->_tpl_vars['room_data']['k_lowest_price']): ?><?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data']['k_lowest_price']); ?>
<?php endif; ?>" size=15> 円（税込）
</td>
</tr>
<tr>
<td bgcolor=#FFC6C0 width=150 align=center><b>1コマあたりの値段２</b></td>
<td colspan=3 align=left>
<input type="text" name="k_capa_low2" value="<?php if ($this->_tpl_vars['room_data']['k_capa_low2']): ?><?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data']['k_capa_low2']); ?>
<?php endif; ?>" size=10> 人　～
<input type="text" name="k_capa_high2" value="<?php if ($this->_tpl_vars['room_data']['k_capa_high2']): ?><?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data']['k_capa_high2']); ?>
<?php endif; ?>" size=10> 人　まで　
<input type="text" name="k_price2" value="<?php if ($this->_tpl_vars['room_data']['k_price2']): ?><?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data']['k_price2']); ?>
<?php endif; ?>" size=15> 円（税込）
</td>
</tr>
<tr>
<td bgcolor=#FFC6C0 width=150 align=center><b>1コマあたりの値段３</b></td>
<td colspan=3 align=left>
<input type="text" name="k_capa_low3" value="<?php if ($this->_tpl_vars['room_data']['k_capa_low3']): ?><?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data']['k_capa_low3']); ?>
<?php endif; ?>" size=10> 人　～
<input type="text" name="k_capa_high3" value="<?php if ($this->_tpl_vars['room_data']['k_capa_high3']): ?><?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data']['k_capa_high3']); ?>
<?php endif; ?>" size=10> 人　まで　
<input type="text" name="k_price3" value="<?php if ($this->_tpl_vars['room_data']['k_price3']): ?><?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data']['k_price3']); ?>
<?php endif; ?>" size=15> 円（税込）
</td>
</tr>
<tr>
<td bgcolor=#FFC6C0 width=150 align=center><b>1コマあたりの値段４</b></td>
<td colspan=3 align=left>
<input type="text" name="k_capa_highest" value="<?php if ($this->_tpl_vars['room_data']['k_capa_highest']): ?><?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data']['k_capa_highest']); ?>
<?php endif; ?>" size=10> 人　以上　
<input type="text" name="k_highest_price" value="<?php if ($this->_tpl_vars['room_data']['k_highest_price']): ?><?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data']['k_highest_price']); ?>
<?php endif; ?>" size=15> 円（税込）
</td>
</tr>

</table>

</div>


<br>
<hr width=800>
<br>
<table width=700>
<td>
<span style="font-size: 15pt;color: #FF3300;"><b>【キャンセル料率パターン】</b></span><br>
<br>
<?php if ($this->_tpl_vars['cancel_charge']): ?>
<table>
<?php $_from = $this->_tpl_vars['cancel_charge']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<tr>
<td>
<input type="radio" name="cancel" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['pattern_id']); ?>
" <?php if ($this->_tpl_vars['item']['pattern_id'] == $this->_tpl_vars['room_data']['cancel']): ?>checked<?php endif; ?>>
</td><td width=80>
パターン<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['pattern_id']); ?>
： 
</td><td>
<?php if ($this->_tpl_vars['item']['percent1']): ?>
<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['day1']); ?>
日前まで <?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['percent1']); ?>
％</td><td>
<?php endif; ?>
<?php if ($this->_tpl_vars['item']['percent2']): ?>
 ／ <?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['day2']); ?>
日前まで <?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['percent2']); ?>
％</td><td>
<?php endif; ?>
<?php if ($this->_tpl_vars['item']['percent3']): ?>
 ／ <?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['day3']); ?>
日前まで <?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['percent3']); ?>
％</td><td>
<?php endif; ?>
<?php if ($this->_tpl_vars['item']['percent4']): ?>
 ／ <?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['day4']); ?>
日前まで <?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['percent4']); ?>
％</td><td>
<?php endif; ?>
<?php if ($this->_tpl_vars['item']['percent5']): ?>
 ／ <?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['day5']); ?>
日前まで <?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['percent5']); ?>
％
<?php endif; ?>
</td></tr>
<?php endforeach; endif; unset($_from); ?>
</table>



<?php else: ?>
会場のキャンセル料率パターンが設定されていません。<br>
先にキャンセル料率パターンを設定してください。<br>
<br>
</form>
<form name="cancel" method="POST" action="./">
<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
<input type="hidden" name="a" value="page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('cancel_config','page')); ?>
" />
<input type="hidden" name="hall_id" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['hall_id']); ?>
" />
<input type="submit" style="color:#FF0000" value="　キャンセル料率パターン設定へ　">

<?php endif; ?>
</td>
</table>
<br>
<hr width=800>
<br>
<?php if ($this->_tpl_vars['cancel_charge']): ?>
<input type="submit" value="　確　認　">
<?php endif; ?>

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
