<?php /* Smarty version 2.6.18, created on 2015-08-05 10:07:05
         compiled from file:/var/www/atoffice/webapp/modules/admin/templates/hall_delete.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'ext_include', 'file:/var/www/atoffice/webapp/modules/admin/templates/hall_delete.tpl', 2, false),array('modifier', 't_escape', 'file:/var/www/atoffice/webapp/modules/admin/templates/hall_delete.tpl', 15, false),)), $this); ?>
<?php echo $this->_tpl_vars['inc_header']; ?>

<?php echo smarty_function_ext_include(array('file' => "inc_subnavi_adminImageKakikomi.tpl"), $this);?>

<?php $this->assign('page_name', "会場削除"); ?>
<?php echo smarty_function_ext_include(array('file' => "inc_tree_adminImageKakikomi.tpl"), $this);?>

</div>


<?php if ($this->_tpl_vars['atoffice_auth_type'] == 1 || $this->_tpl_vars['atoffice_auth_type'] == 4): ?>

<h2 id="ttl01">会場削除</h2>
<br>

<?php if ($this->_tpl_vars['msg']): ?><p class="actionMsg"><?php echo smarty_modifier_t_escape($this->_tpl_vars['msg']); ?>
</p><?php endif; ?>
<center>

<h3>削除対象のデータ一覧</h3><br>
部屋が設定されている場合は、関連する部屋の設定データも対象です。<br>
予約データが存在する場合は、関連する予約データも対象です。<br>
<br>
<table border=1 width=300>
<tr>
<td align=left>
対象会場名
</td>
<td>
<?php echo smarty_modifier_t_escape($this->_tpl_vars['hall_data']['hall_name']); ?>

</td>
</tr>

<tr>
<td align=left>
設定部屋データ数
</td>
<td>
<?php echo smarty_modifier_t_escape($this->_tpl_vars['a_room']); ?>

</td>
</tr>

<tr>
<td align=left>
総予約データ数
</td>
<td>
<?php echo smarty_modifier_t_escape($this->_tpl_vars['a_reserve_list']); ?>

</td>
</tr>

<tr>
<td align=left>
設定備品数
</td>
<td>
<?php echo smarty_modifier_t_escape($this->_tpl_vars['a_vessel_data']); ?>

</td>
</tr>

<tr>
<td align=left>
設定サービス数
</td>
<td>
<?php echo smarty_modifier_t_escape($this->_tpl_vars['a_service_data']); ?>

</td>
</tr>

<tr>
<td align=left>
設定キャンセル料率数
</td>
<td>
<?php echo smarty_modifier_t_escape($this->_tpl_vars['cancel_charge']); ?>

</td>
</tr>

<tr>
<td align=left>
設定会場休日数
</td>
<td>
<?php echo smarty_modifier_t_escape($this->_tpl_vars['a_hall_holiday']); ?>

</td>
</tr>

<tr>
<td align=left>
設定会場定休日数
</td>
<td>
<?php echo smarty_modifier_t_escape($this->_tpl_vars['a_hall_regular_holiday']); ?>

</td>
</tr>

<tr>
<td align=left>
設定会場画像数
</td>
<td>
<?php echo smarty_modifier_t_escape($this->_tpl_vars['a_hall_image']); ?>

</td>
</tr>

<tr>
<td align=left>
設定会場貸し止め数
</td>
<td>
<?php echo smarty_modifier_t_escape($this->_tpl_vars['a_rental_stop']); ?>

</td>
</tr>

</table>
<br>
<form action="./" method="post">
<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
<input type="hidden" name="a" value="do_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('delete_hall_data','do')); ?>
" />
<input type="hidden" name="sessid" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['PHPSESSID']); ?>
" />
<input type="hidden" name="hall_id" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['hall_id']); ?>
">
<input type="submit" value="削除する">
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
