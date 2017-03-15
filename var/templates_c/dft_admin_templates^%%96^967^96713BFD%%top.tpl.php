<?php /* Smarty version 2.6.18, created on 2017-02-20 02:44:55
         compiled from file:/var/www/html/atoffice/webapp/modules/admin/templates/top.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 't_escape', 'file:/var/www/html/atoffice/webapp/modules/admin/templates/top.tpl', 9, false),)), $this); ?>
<?php echo $this->_tpl_vars['inc_header']; ?>

<div class="subNavi"></div>
</div>



<?php if ($this->_tpl_vars['msg']): ?>
<p class="actionMsg"><?php echo smarty_modifier_t_escape($this->_tpl_vars['msg']); ?>
</p>
<?php endif; ?>

<br>
<table width=100%>
<tr>
<td width="10"></td>
<td>
<span style="font-size: 16px;"><span style="color: #336600;"><b><?php echo smarty_modifier_t_escape($this->_tpl_vars['name']); ?>
</b></span> さん、お疲れ様です。<br>
<br>
あなたのアクセス権限は、
<span style="color: #FF0000;"><b>
<?php if ($this->_tpl_vars['atoffice_auth_type'] == '1'): ?>
	初期設定担当者
<?php elseif ($this->_tpl_vars['atoffice_auth_type'] == '2'): ?>
	予約受付担当者
<?php elseif ($this->_tpl_vars['atoffice_auth_type'] == '3'): ?>
	準備担当者
<?php elseif ($this->_tpl_vars['atoffice_auth_type'] == '4'): ?>
	管理者
<?php else: ?>
	不明な権限
<?php endif; ?>
</b></span>
です。<br>

<?php if ($this->_tpl_vars['atoffice_auth_type'] == '1'): ?>

<?php elseif ($this->_tpl_vars['atoffice_auth_type'] == '2'): ?>

<?php elseif ($this->_tpl_vars['atoffice_auth_type'] == '3'): ?>

担当会場は、<b> <?php echo smarty_modifier_t_escape($this->_tpl_vars['hall_name']); ?>
 </b>です。

<?php elseif ($this->_tpl_vars['atoffice_auth_type'] == '4'): ?>

<br>
<hr>
<br>
<center>
<span style="color: #FF0000;font-size:30px"><b>アラート</b></span><br>
<br>
<table width=800 border=1>
<tr>
<td width=450 align=left>仮予約の承認待ち（２営業日以上経過数）</td>
<td align=right><?php echo smarty_modifier_t_escape($this->_tpl_vars['tmp_alert']); ?>
 件</td>
</tr>

<tr>
<td width=450 align=left>返金処理待ち件数</td>
<td align=right><?php echo smarty_modifier_t_escape($this->_tpl_vars['repay_alert']); ?>
 件</td>
</tr>

<tr>
<td width=450 align=left>バーチャル口座利用数（利用数/総数）</td>
<td align=right><?php echo smarty_modifier_t_escape($this->_tpl_vars['kotei_vn']); ?>
 / <?php echo smarty_modifier_t_escape($this->_tpl_vars['all_vn']); ?>
 件</td>
</tr>

<tr>
<td width=450 align=left>完了報告漏れ数</td>
<td align=right>
<?php $_from = $this->_tpl_vars['comp_alert']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['hall_name']); ?>
 : <?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['alert_num']); ?>
 件<br>
<?php endforeach; else: ?>
0 件
<?php endif; unset($_from); ?>

</td>
</tr>

<tr>
<td width=450 align=left>予約入金予定日超過件数</td>
<td align=right>
<?php $_from = $this->_tpl_vars['unpayment_alert']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['hall_name']); ?>
 : <?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['alert_num']); ?>
 件<br>
<?php endforeach; else: ?>
0 件
<?php endif; unset($_from); ?>

</td>
</tr>

<tr>
<td width=450 align=left>ブラックリスト登録申請待ち</td>
<td align=right><?php echo smarty_modifier_t_escape($this->_tpl_vars['blist_alert']); ?>
 件</td>
</tr>

</table>
</center>

<?php else: ?>

<?php endif; ?>

</span>

</td>
<td align=right valign=top>

</td>
</tr>
</table>

<div class="contents">


<?php echo $this->_tpl_vars['inc_footer']; ?>
