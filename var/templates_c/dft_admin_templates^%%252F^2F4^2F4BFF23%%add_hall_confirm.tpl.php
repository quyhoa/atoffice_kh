<?php /* Smarty version 2.6.18, created on 2017-03-02 19:00:38
         compiled from file:/var/www/html/atoffice/webapp/modules/admin/templates/add_hall_confirm.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'ext_include', 'file:/var/www/html/atoffice/webapp/modules/admin/templates/add_hall_confirm.tpl', 8, false),array('modifier', 't_escape', 'file:/var/www/html/atoffice/webapp/modules/admin/templates/add_hall_confirm.tpl', 21, false),array('modifier', 'nl2br', 'file:/var/www/html/atoffice/webapp/modules/admin/templates/add_hall_confirm.tpl', 361, false),array('modifier', 't_url2cmd', 'file:/var/www/html/atoffice/webapp/modules/admin/templates/add_hall_confirm.tpl', 361, false),array('modifier', 't_cmd', 'file:/var/www/html/atoffice/webapp/modules/admin/templates/add_hall_confirm.tpl', 361, false),array('modifier', 't_decoration', 'file:/var/www/html/atoffice/webapp/modules/admin/templates/add_hall_confirm.tpl', 361, false),)), $this); ?>
<style>
.spDate{
	margin-left:5px;
	display:block;		
}	
</style>
<?php echo $this->_tpl_vars['inc_header']; ?>

<?php echo smarty_function_ext_include(array('file' => "inc_subnavi_adminImageKakikomi.tpl"), $this);?>

<?php if ($this->_tpl_vars['post_data']['hall_id']): ?>
<?php $this->assign('page_name', "会場編集(確認)"); ?>
<?php else: ?>
<?php $this->assign('page_name', "新規会場追加(確認)"); ?>
<?php endif; ?>
<?php echo smarty_function_ext_include(array('file' => "inc_tree_adminImageKakikomi.tpl"), $this);?>

</div>
<?php if ($this->_tpl_vars['atoffice_auth_type'] == 1 || $this->_tpl_vars['atoffice_auth_type'] == 4): ?>

<?php if ($this->_tpl_vars['post_data']['hall_id']): ?>
<h2 id="ttl01">会場編集【<?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['hall_name']); ?>
】(確認)</h2>
<?php else: ?>
<h2 id="ttl01">新規会場追加(確認)</h2>
<?php endif; ?>
<br>
<center>
<?php if ($this->_tpl_vars['errors']): ?>
<table border=1 bgcolor=#000000 width=500>
<tr>
<td style="color:#FF0000">
<b>以下の入力項目にエラーがあります。修正してください。</b>
</td>
</tr>
<?php $_from = $this->_tpl_vars['errors']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
	<tr><td style="color:#FFFF00">
	・ <?php echo smarty_modifier_t_escape($this->_tpl_vars['item']); ?>

	</td></tr>
<?php endforeach; endif; unset($_from); ?>
</table>
<?php else: ?>
<span style="font-size: 16pt;">
<?php if ($this->_tpl_vars['post_data']['hall_id']): ?>
会場データを以下の内容に更新します。よろしいですか？
<?php else: ?>
以下の内容で会場を追加します。よろしいですか？
<?php endif; ?>
</span>
<?php endif; ?>
<br><br>
<table border=1 width=740 >
<tr>
<td colspan=2 bgcolor=#FFCCCC align=center height=30><b>
<?php if ($this->_tpl_vars['post_data']['hall_id']): ?>
会場編集
<?php else: ?>
会場登録
<?php endif; ?>
</tr>
<tr>
<td bgcolor=#FFE7D6><b>会場名称</b></td>
<td align=left>
　<span style="color: #FF0033;"><b><?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['hall_name']); ?>
</b></span>
</td>
</tr>
<tr>
<td bgcolor=#FFE7D6><b>会場属性</b></td>
<td align=left>
<span style="color: #FF0033;"><b>
<?php if ($this->_tpl_vars['post_data']['hall_attribute'] == 0): ?>
　AO管理会議室
<?php else: ?>
　シェア会議室
<?php endif; ?>
</b></span>
</td>
</tr>
<tr>
<td bgcolor=#FFE7D6><b>運営状態</b></td>
<td align=left>
　<span style="color: #FF0033;"><b>停止中（デフォルト）</b></span></td>
</tr>
<tr>
<td bgcolor=#FFE7D6><b>キャンセル有効期間</b></td>
<td align=left>
　<span style="color: #FF0033;"><b><?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['cancel_days']); ?>
</b></span>
 日前までキャンセル有効</td>
</tr>
<tr>
<td bgcolor=#FFE7D6><b>総部屋数</b></td>
<td align=left>
　<span style="color: #FF0033;"><b><?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['rooms']); ?>
</b></span>
 部屋</td>
</tr>
<tr>
<td bgcolor=#FFE7D6><b>利用可能時間</b></td>
<td align=left>
 <span class="spDate" >
	平日 	
　<span style="color: #FF0033;"><b><?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['begin1']); ?>
</b></span>
 時から 
<span style="color: #FF0033;"><b><?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['finish1']); ?>
</b></span>
 時まで
</span>
 <span class="spDate" >
	土曜日 	
　<span style="color: #FF0033;"><b><?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['begin2']); ?>
</b></span>
 時から 
<span style="color: #FF0033;"><b><?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['finish2']); ?>
</b></span>
 時まで
</span>
 <span class="spDate" >
	日曜日 	
　<span style="color: #FF0033;"><b><?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['begin3']); ?>
</b></span>
 時から 
<span style="color: #FF0033;"><b><?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['finish3']); ?>
</b></span>
 時まで
</span>
 <span class="spDate" >
	祝日 	
　<span style="color: #FF0033;"><b><?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['begin4']); ?>
</b></span>
 時から 
<span style="color: #FF0033;"><b><?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['finish4']); ?>
</b></span>
 時まで
</span>
</td>
</tr>
<tr>
<td bgcolor=#FFE7D6 width="180"><b>予約可能日程範囲</b></td>
<td align=left>
　<span style="color: #FF0033;"><b><?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['reservation_month']); ?>
ヵ月</b></span> 先まで予約可能

</td>
</tr>
<tr>
<td bgcolor=#FFE7D6 width="180"><b>振込方式</b></td>
<td align=left>
<?php if ($this->_tpl_vars['post_data']['bank_flag'] == 0): ?>
　<span style="color: #FF0033;"><b>バーチャル口座</b></span>
<?php else: ?>
　<span style="color: #FF0033;"><b>指定口座</b></span>
<?php endif; ?>
</td>
</tr>
<tr>
<td bgcolor=#FFE7D6 width="180"><b>看板出力</b></td>
<td align=left>
<?php if ($this->_tpl_vars['post_data']['kanban'] == 0): ?>
　<span style="color: #FF0033;"><b>準備担当が印刷</b></span>
<?php else: ?>
　<span style="color: #FF0033;"><b>セルフサービス</b></span>
<?php endif; ?>
</td>
</tr>

<tr>
<td bgcolor=#FFE7D6 width="180"><b>利用形態</b></td>
<td align=left>
<?php if ($this->_tpl_vars['post_data']['web_reserve'] == 0): ?>
　<span style="color: #FF0033;"><b>電話でのみ予約受け付け</b></span>
<?php else: ?>
　<span style="color: #FF0033;"><b>Webからも予約を受付する</b></span>
<?php endif; ?>
</td>
</tr>

</tr>
<tr>
<td bgcolor=#FFE7D6><b>オーナー収益配分</b></td>
<td align=left>
	<table>
	<td>
		部屋の収益配分：
		<span style="color: #FF0033;"><b><?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['owner_room']); ?>
</b><//span>％
	</td>
	<td width=10>
	</td>
	<td>
		備品の収益配分：
		<span style="color: #FF0033;"><b><?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['owner_vessel']); ?>
</b></span>％
	</td>
	</table>
</td>

</tr>

<tr>
<td bgcolor=#FFE7D6><b>プルダウン順序設定</b></td>
<td align=left>
	<span style="color: #FF0033;"><b><?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['pulldown']); ?>
</b></span>
</td>

</tr>
<tr>
<td bgcolor=#FFE7D6><b>一般利用可能</b></td>
<td align=left>
	<?php if ($this->_tpl_vars['date1'] == 1): ?>
	<span class="spDate">
		平日 <span style="color:red; font-weight: bold"><?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['begin_often1']); ?>
</span> 時から  <span style="color:red; font-weight: bold"><?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['finish_often1']); ?>
</span> 時まで

	</span>

	<?php endif; ?>	
	<?php if ($this->_tpl_vars['date2'] == 1): ?>
	
	<span class="spDate">
		土曜日 <span style="color:red; font-weight: bold"><?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['begin_often2']); ?>
</span> 時から  <span style="color:red; font-weight: bold"><?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['finish_often2']); ?>
</span> 時まで

	</span>
	<?php endif; ?>	
	<?php if ($this->_tpl_vars['date3'] == 1): ?>
	
	<span class="spDate">
		日曜日 <span style="color:red; font-weight: bold"><?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['begin_often3']); ?>
</span> 時から  <span style="color:red; font-weight: bold"><?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['finish_often3']); ?>
</span> 時まで

	</span>
	<?php endif; ?>	
	<?php if ($this->_tpl_vars['date4'] == 1): ?>
	
	<span class="spDate">
		祝日 <span style="color:red; font-weight: bold"><?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['begin_often4']); ?>
</span> 時から  <span style="color:red; font-weight: bold"><?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['finish_often4']); ?>
</span> 時まで

	</span>
	<?php endif; ?>	
</td>
</tr>
<!--<tr>
<td bgcolor=#FFE7D6><b>一般利用可能時間</b></td>
<td align=left>
	<span style="color:red; font-weight: bold"><?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['begin_often']); ?>
</span> 時から  <span style="color:red; font-weight: bold"><?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['finish_often']); ?>
</span> 時まで
</td>
</tr>-->
</table>

<?php if ($this->_tpl_vars['post_data']['hall_attribute'] == 1): ?>
<br>
<table border=1 width=740 >
<tr>
<td colspan=2 bgcolor=#FFFF99 align=center height=30><b>シェア会場追記項目</b></td>
</tr>
<tr>
<td bgcolor=#FFFFCC width="180"><b>入室導線</b></td>
<td align=left>
　<span style="color: #FF0033;"><b>
<?php if ($this->_tpl_vars['post_data']['share_option1'] == 0): ?>
	直接入室できる
<?php else: ?>
	事務所内を通過して入室
<?php endif; ?>
</b></span>
</td>
</tr>
<tr>
<td bgcolor=#FFFFCC><b>トイレ導線</b></td>
<td align=left>
　<span style="color: #FF0033;"><b>
<?php if ($this->_tpl_vars['post_data']['share_option2'] == 0): ?>
	直接入室できる
<?php else: ?>
	事務所内を通過して入室
<?php endif; ?>
</b></span>
</td>
</tr>
</table>
<?php endif; ?>


<br>


<table border=1 width=100%>
<tr>
<td colspan=2 bgcolor=#99FFCC align=center height=30><b>会場住所等</b></td>
</tr>
<tr>
<td bgcolor="#CCFFCC" width=180><b>住所</b></td>
<td align=left>
　郵便番号：
　<span style="color: #FF0033;"><b><?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['address_zip']); ?>
</b></span>
<br>
　都道府県：
　<span style="color: #FF0033;"><b><?php echo smarty_modifier_t_escape($this->_tpl_vars['prefecture']); ?>
</b></span>
<br>
　市区町村：
　<span style="color: #FF0033;"><b><?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['address_city']); ?>
</b></span><br>
　以下住所：
　<span style="color: #FF0033;"><b><?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['address_other']); ?>
</b></span><br>
　電話番号：
　<span style="color: #FF0033;"><b><?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['telephone']); ?>
</b></span><br>
　FAX 番号：
　<span style="color: #FF0033;"><b><?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['fax']); ?>
</b></span><br>
</td>
</tr>
<tr>
<td bgcolor=#CCFFCC><b>交通</b></td>
<td align=left>
　最寄り駅１ <span style="color: #FF0033;"><b><?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['line1']); ?>
</b></span> 線 <span style="color: #FF0033;"><b><?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['station1']); ?>
</b></span> 駅から 
	<?php $_from = $this->_tpl_vars['transportation_list']['options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
	<?php if ($this->_tpl_vars['post_data']['transportation1'] == $this->_tpl_vars['item']['c_profile_option_id']): ?>
		<span style="color: #FF0033;"><b><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['value']); ?>
</b></span>
	<?php endif; ?>
	<?php endforeach; endif; unset($_from); ?>
<span style="color: #FF0033;"><b><?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['time1']); ?>
</b></span> 分<br>

<?php if ($this->_tpl_vars['post_data']['line2']): ?>
　最寄り駅２ <span style="color: #FF0033;"><b><?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['line2']); ?>
</b></span> 線 <span style="color: #FF0033;"><b><?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['station2']); ?>
</b></span> 駅から 
	<?php $_from = $this->_tpl_vars['transportation_list']['options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
	<?php if ($this->_tpl_vars['post_data']['transportation2'] == $this->_tpl_vars['item']['c_profile_option_id']): ?>
		<span style="color: #FF0033;"><b><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['value']); ?>
</b></span>
	<?php endif; ?>
	<?php endforeach; endif; unset($_from); ?>
<span style="color: #FF0033;"><b><?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['time2']); ?>
</b></span> 分<br>
<?php endif; ?>

<?php if ($this->_tpl_vars['post_data']['line3']): ?>
　最寄り駅３ <span style="color: #FF0033;"><b><?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['line3']); ?>
</b></span> 線 <span style="color: #FF0033;"><b><?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['station3']); ?>
</b></span> 駅から 
	<?php $_from = $this->_tpl_vars['transportation_list']['options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
	<?php if ($this->_tpl_vars['post_data']['transportation3'] == $this->_tpl_vars['item']['c_profile_option_id']): ?>
		<span style="color: #FF0033;"><b><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['value']); ?>
</b></span>
	<?php endif; ?>
	<?php endforeach; endif; unset($_from); ?>
<span style="color: #FF0033;"><b><?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['time3']); ?>
</b></span> 分<br>
<?php endif; ?>

</td>
</tr>
<tr>
<td bgcolor=#CCFFCC><b>google maps URL</b></td>
<td align=left>

URL: 
<span style="color: #FF0033;"><b><?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['google_maps']); ?>
</b></span>

</td>
</tr>

<tr>
<td bgcolor=#CCFFCC><b>規約 URL</b></td>
<td align=left>

URL: 
<span style="color: #FF0033;"><b><?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['kiyaku_url']); ?>
</b></span>

</td>
</tr>

<tr>
<td bgcolor=#CCFFCC><b>メーリングリスト</b></td>
<td align=left>

<span style="color: #FF0033;"><b><?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['mailing_list']); ?>
</b></span>

</td>
</tr>

<tr>
<td bgcolor=#CCFFCC><b>会場へのアクセス</b></td>
<td align=left>

<span style="color: #FF0033;"><b>
<?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['post_data']['access']))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)))) ? $this->_run_mod_handler('t_url2cmd', true, $_tmp, 'diary', smarty_modifier_t_escape($this->_tpl_vars['member']['c_member_id'])) : smarty_modifier_t_url2cmd($_tmp, 'diary', smarty_modifier_t_escape($this->_tpl_vars['member']['c_member_id']))))) ? $this->_run_mod_handler('t_cmd', true, $_tmp, 'diary') : smarty_modifier_t_cmd($_tmp, 'diary')))) ? $this->_run_mod_handler('t_decoration', true, $_tmp) : smarty_modifier_t_decoration($_tmp)); ?>

</b></span>

</td>
</tr>
<tr>
<td bgcolor=#CCFFCC><b>会場の特徴</b></td>
<td align=left>
<span style="color: #FF0033;"><b>
<?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['post_data']['characteristic']))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)))) ? $this->_run_mod_handler('t_url2cmd', true, $_tmp, 'diary', smarty_modifier_t_escape($this->_tpl_vars['member']['c_member_id'])) : smarty_modifier_t_url2cmd($_tmp, 'diary', smarty_modifier_t_escape($this->_tpl_vars['member']['c_member_id']))))) ? $this->_run_mod_handler('t_cmd', true, $_tmp, 'diary') : smarty_modifier_t_cmd($_tmp, 'diary')))) ? $this->_run_mod_handler('t_decoration', true, $_tmp) : smarty_modifier_t_decoration($_tmp)); ?>

</b></span>
</td>
</tr>
<tr>
<td bgcolor=#CCFFCC><b>基本設備</b></td>
<td align=left>
<span style="color: #FF0033;"><b>
<?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['post_data']['facilities']))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)))) ? $this->_run_mod_handler('t_url2cmd', true, $_tmp, 'diary', smarty_modifier_t_escape($this->_tpl_vars['member']['c_member_id'])) : smarty_modifier_t_url2cmd($_tmp, 'diary', smarty_modifier_t_escape($this->_tpl_vars['member']['c_member_id']))))) ? $this->_run_mod_handler('t_cmd', true, $_tmp, 'diary') : smarty_modifier_t_cmd($_tmp, 'diary')))) ? $this->_run_mod_handler('t_decoration', true, $_tmp) : smarty_modifier_t_decoration($_tmp)); ?>

</b></span>
</td>
</tr>
<tr>
<td bgcolor=#CCFFCC><b>ご案内</b></td>
<td align=left>
<span style="color: #FF0033;"><b>
<?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['post_data']['remarks']))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)))) ? $this->_run_mod_handler('t_url2cmd', true, $_tmp, 'diary', smarty_modifier_t_escape($this->_tpl_vars['member']['c_member_id'])) : smarty_modifier_t_url2cmd($_tmp, 'diary', smarty_modifier_t_escape($this->_tpl_vars['member']['c_member_id']))))) ? $this->_run_mod_handler('t_cmd', true, $_tmp, 'diary') : smarty_modifier_t_cmd($_tmp, 'diary')))) ? $this->_run_mod_handler('t_decoration', true, $_tmp) : smarty_modifier_t_decoration($_tmp)); ?>

</b></span>
</td>
</tr>
<tr>
<td bgcolor=#CCFFCC><b>会員登録規約</b></td>
<td align=left>
<span style="color: #FF0033;"><b>
<?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['post_data']['agreement']))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)))) ? $this->_run_mod_handler('t_url2cmd', true, $_tmp, 'diary', smarty_modifier_t_escape($this->_tpl_vars['member']['c_member_id'])) : smarty_modifier_t_url2cmd($_tmp, 'diary', smarty_modifier_t_escape($this->_tpl_vars['member']['c_member_id']))))) ? $this->_run_mod_handler('t_cmd', true, $_tmp, 'diary') : smarty_modifier_t_cmd($_tmp, 'diary')))) ? $this->_run_mod_handler('t_decoration', true, $_tmp) : smarty_modifier_t_decoration($_tmp)); ?>

</b></span>
</td>
</tr>
</table>

<br>

<table>
<tr>
<td>



<?php if (! $this->_tpl_vars['errors']): ?>
	<form name="add_hall_data" method="POST" action="./">
		<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
		<input type="hidden" name="a" value="do_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('add_hall_data','do')); ?>
" />
		<input type="hidden" name="sessid" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['PHPSESSID']); ?>
" />
		<input type="hidden" name="hall_name" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['hall_name']); ?>
">
		<input type="hidden" name="hall_attribute" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['hall_attribute']); ?>
">
		<input type="hidden" name="flag" value="2">
		<input type="hidden" name="cancel_days" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['cancel_days']); ?>
" >
		<input type="hidden" name="rooms" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['rooms']); ?>
" >
		<input type="hidden" name="begin_often" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['begin_often']); ?>
">
		<input type="hidden" name="finish_often" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['finish_often']); ?>
">
		<input type="hidden" name="begin" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['begin']); ?>
">
		<input type="hidden" name="finish" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['finish']); ?>
">
		<!-- add 2016-06-21-->
		<input type="hidden" name="begin1" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['begin1']); ?>
">
		<input type="hidden" name="finish1" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['finish1']); ?>
">
		<input type="hidden" name="begin2" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['begin2']); ?>
">
		<input type="hidden" name="finish2" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['finish2']); ?>
">
		<input type="hidden" name="begin3" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['begin3']); ?>
">
		<input type="hidden" name="finish3" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['finish3']); ?>
">
		<input type="hidden" name="begin4" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['begin4']); ?>
">
		<input type="hidden" name="finish4" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['finish4']); ?>
">

		<input type="hidden" name="begin_often1" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['begin_often1']); ?>
">
		<input type="hidden" name="finish_often1" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['finish_often1']); ?>
">
		<input type="hidden" name="begin_often2" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['begin_often2']); ?>
">
		<input type="hidden" name="finish_often2" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['finish_often2']); ?>
">
		<input type="hidden" name="begin_often3" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['begin_often3']); ?>
">
		<input type="hidden" name="finish_often3" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['finish_often3']); ?>
">
		<input type="hidden" name="begin_often4" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['begin_often4']); ?>
">
		<input type="hidden" name="finish_often4" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['finish_often4']); ?>
">
		<!-- end -->
		<input type="hidden" name="reservation_month" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['reservation_month']); ?>
">
		<?php if ($this->_tpl_vars['post_data']['hall_attribute'] == 1): ?>
		<input type="hidden" name="share_option1" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['share_option1']); ?>
">
		<input type="hidden" name="share_option2" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['share_option2']); ?>
">
		<?php endif; ?>
		<input type="hidden" name="address_zip" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['address_zip']); ?>
">
		<input type="hidden" name="address_prefecture" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['address_prefecture']); ?>
">
		<input type="hidden" name="address_city" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['address_city']); ?>
">
		<input type="hidden" name="address_other" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['address_other']); ?>
">
		<input type="hidden" name="telephone" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['telephone']); ?>
">
		<input type="hidden" name="fax" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['fax']); ?>
">
		<input type="hidden" name="line1" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['line1']); ?>
">
		<input type="hidden" name="station1" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['station1']); ?>
">
		<input type="hidden" name="transportation1" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['transportation1']); ?>
">
		<input type="hidden" name="time1" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['time1']); ?>
">
		<?php if ($this->_tpl_vars['post_data']['line2'] || $this->_tpl_vars['post_data']['station2'] || $this->_tpl_vars['post_data']['transportation2'] || $this->_tpl_vars['post_data']['time2']): ?>
		<input type="hidden" name="line2" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['line2']); ?>
">
		<input type="hidden" name="station2" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['station2']); ?>
">
		<input type="hidden" name="transportation2" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['transportation2']); ?>
">
		<input type="hidden" name="time2" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['time2']); ?>
">
		<?php endif; ?>
		<?php if ($this->_tpl_vars['post_data']['line3'] || $this->_tpl_vars['post_data']['station3'] || $this->_tpl_vars['post_data']['transportation3'] || $this->_tpl_vars['post_data']['time3']): ?>
		<input type="hidden" name="line3" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['line3']); ?>
">
		<input type="hidden" name="station3" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['station3']); ?>
">
		<input type="hidden" name="transportation3" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['transportation3']); ?>
">
		<input type="hidden" name="time3" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['time3']); ?>
">
		<?php endif; ?>
		<input type="hidden" name="characteristic" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['characteristic']); ?>
">
		<input type="hidden" name="facilities" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['facilities']); ?>
">
		<input type="hidden" name="remarks" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['remarks']); ?>
">
		<input type="hidden" name="agreement" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['agreement']); ?>
">
		<input type="hidden" name="bank_flag" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['bank_flag']); ?>
">
		<input type="hidden" name="kanban" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['kanban']); ?>
">
		<input type="hidden" name="web_reserve" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['web_reserve']); ?>
">
		<input type="hidden" name="owner_room" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['owner_room']); ?>
">
		<input type="hidden" name="owner_vessel" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['owner_vessel']); ?>
">
		<input type="hidden" name="google_maps" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['google_maps']); ?>
">
		<input type="hidden" name="access" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['access']); ?>
">
		<input type="hidden" name="kiyaku_url" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['kiyaku_url']); ?>
">
		<input type="hidden" name="mailing_list" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['mailing_list']); ?>
">
		<input type="hidden" name="pulldown" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['pulldown']); ?>
">
		<?php if ($this->_tpl_vars['post_data']['hall_id']): ?>
		<input type="hidden" name="hall_id" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['hall_id']); ?>
" />
		<?php endif; ?>
		<input type="hidden" name="usedate" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['usedate_data']); ?>
" />
		<input type="submit" class="input_submit" value="　登　録　" />
	</form>
<?php endif; ?>
</td><td width=50></td><td>
	<form name="add_hall" method="POST" action="./">
		<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
		<input type="hidden" name="a" value="page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('add_hall','page')); ?>
" />
		<input type="hidden" name="correction" value="100">
		<input type="hidden" name="hall_name" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['hall_name']); ?>
">
		<input type="hidden" name="hall_attribute" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['hall_attribute']); ?>
">
		<input type="hidden" name="flag" value="2">
		<input type="hidden" name="cancel_days" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['cancel_days']); ?>
" >
		<input type="hidden" name="rooms" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['rooms']); ?>
" >
		<input type="hidden" name="begin" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['begin']); ?>
">
		<input type="hidden" name="finish" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['finish']); ?>
">
		<input type="hidden" name="reservation_month" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['reservation_month']); ?>
">
		<?php if ($this->_tpl_vars['post_data']['hall_attribute'] == 1): ?>
		<input type="hidden" name="share_option1" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['share_option1']); ?>
">
		<input type="hidden" name="share_option2" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['share_option2']); ?>
">
		<?php endif; ?>
		<input type="hidden" name="begin_often" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['begin_often']); ?>
">
		<input type="hidden" name="finish_often" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['finish_often']); ?>
">
		<input type="hidden" name="usedate" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['usedate_data']); ?>
"/>
		<input type="hidden" name="address_zip" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['address_zip']); ?>
">
		<input type="hidden" name="address_prefecture" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['address_prefecture']); ?>
">
		<input type="hidden" name="address_city" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['address_city']); ?>
">
		<input type="hidden" name="address_other" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['address_other']); ?>
">
		<input type="hidden" name="telephone" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['telephone']); ?>
">
		<input type="hidden" name="fax" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['fax']); ?>
">
		<input type="hidden" name="line1" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['line1']); ?>
">
		<input type="hidden" name="station1" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['station1']); ?>
">
		<input type="hidden" name="transportation1" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['transportation1']); ?>
">
		<input type="hidden" name="time1" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['time1']); ?>
">
		<?php if ($this->_tpl_vars['post_data']['line2'] || $this->_tpl_vars['post_data']['station2'] || $this->_tpl_vars['post_data']['transportation2'] || $this->_tpl_vars['post_data']['time2']): ?>
		<input type="hidden" name="line2" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['line2']); ?>
">
		<input type="hidden" name="station2" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['station2']); ?>
">
		<input type="hidden" name="transportation2" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['transportation2']); ?>
">
		<input type="hidden" name="time2" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['time2']); ?>
">
		<?php endif; ?>
		<?php if ($this->_tpl_vars['post_data']['line3'] || $this->_tpl_vars['post_data']['station3'] || $this->_tpl_vars['post_data']['transportation3'] || $this->_tpl_vars['post_data']['time3']): ?>
		<input type="hidden" name="line3" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['line3']); ?>
">
		<input type="hidden" name="station3" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['station3']); ?>
">
		<input type="hidden" name="transportation3" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['transportation3']); ?>
">
		<input type="hidden" name="time3" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['time3']); ?>
">
		<?php endif; ?>
		<input type="hidden" name="characteristic" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['characteristic']); ?>
">
		<input type="hidden" name="facilities" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['facilities']); ?>
">
		<input type="hidden" name="remarks" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['remarks']); ?>
">
		<input type="hidden" name="agreement" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['agreement']); ?>
">
		<input type="hidden" name="bank_flag" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['bank_flag']); ?>
">
		<input type="hidden" name="kanban" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['kanban']); ?>
">
		<input type="hidden" name="web_reserve" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['web_reserve']); ?>
">
		<input type="hidden" name="owner_room" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['owner_room']); ?>
">
		<input type="hidden" name="owner_vessel" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['owner_vessel']); ?>
">
		<input type="hidden" name="google_maps" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['google_maps']); ?>
">
		<input type="hidden" name="access" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['access']); ?>
">
		<input type="hidden" name="kiyaku_url" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['kiyaku_url']); ?>
">
		<input type="hidden" name="mailing_list" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['mailing_list']); ?>
">
		<input type="hidden" name="pulldown" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['pulldown']); ?>
">
		<?php if ($this->_tpl_vars['post_data']['hall_id']): ?>
		<input type="hidden" name="hall_id" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['hall_id']); ?>
" />
		<?php endif; ?>
		<input type="submit" class="input_submit" value="　修　正　" />
	</form>

</td></tr>
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
