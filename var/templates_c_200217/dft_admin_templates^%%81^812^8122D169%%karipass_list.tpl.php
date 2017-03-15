<?php /* Smarty version 2.6.18, created on 2016-12-29 08:35:50
         compiled from file:/var/www/html/atoffice/webapp/modules/admin/templates/karipass_list.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'ext_include', 'file:/var/www/html/atoffice/webapp/modules/admin/templates/karipass_list.tpl', 2, false),array('modifier', 't_escape', 'file:/var/www/html/atoffice/webapp/modules/admin/templates/karipass_list.tpl', 14, false),)), $this); ?>
<?php echo $this->_tpl_vars['inc_header']; ?>

<?php echo smarty_function_ext_include(array('file' => "inc_subnavi_adminStatisticalInformation.tpl"), $this);?>

<?php $this->assign('page_name', "仮パスリスト"); ?>
<?php echo smarty_function_ext_include(array('file' => "inc_tree_adminStatisticalInformation.tpl"), $this);?>

</div>


<?php if ($this->_tpl_vars['atoffice_auth_type'] == 4): ?>

<h2 id="ttl01">仮パスリスト (
<?php if ($this->_tpl_vars['data']): ?>
	<?php echo smarty_modifier_t_escape($this->_tpl_vars['num']); ?>
件
<?php else: ?>
	0件
<?php endif; ?>

)</h2>
<br>
<center>

<?php if ($this->_tpl_vars['msg']): ?><p class="actionMsg"><?php echo smarty_modifier_t_escape($this->_tpl_vars['msg']); ?>
</p><br><br><?php endif; ?>



<br>

<br>
パスワードが <b>"karipass123"</b> の顧客を表示します。<br><br>

<?php if ($this->_tpl_vars['data']): ?>

<table width=800 border=1>
<tr>
	<td bgcolor=#CC1111><b><span style="color: #FFFFFF;margin:5px;">顧客ID</span></b></td>
	<td bgcolor=#CC1111><b><span style="color: #FFFFFF;margin:5px;">顧客名</span></b></td>
	<td bgcolor=#CC1111><b><span style="color: #FFFFFF;margin:5px;">法人/団体名</span></b></td>
	<td bgcolor=#CC1111><b><span style="color: #FFFFFF;margin:5px;">メールアドレス</span></b></td>
</tr>

<?php $_from = $this->_tpl_vars['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>

	<tr>
		<td>
			<span style="margin:5px;">
				<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['c_member_id']); ?>

			</span>
		</td>
		<td>
			<span style="margin:5px;">
				<a href="./?m=admin&a=page_c_member_detail&target_c_member_id=<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['c_member_id']); ?>
">
				<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['c_member']['nickname']); ?>

				</a>
			</span>
		</td>
		<td>
			<span style="margin:5px;">
				<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['corp']); ?>

			</span>
		</td>
		<td>
			<span style="margin:5px;">
				<a href="mailto:<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['mail']); ?>
">
				<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['mail']); ?>

				</a>
			</span>
		</td>
	</tr>

<?php endforeach; endif; unset($_from); ?>

</table>

<?php else: ?>
該当するデータはありませんでした。<br>
<?php endif; ?>

<br>

</center>
<?php else: ?>
<br>
<center>
<span style="font-size: 16px; color: #FF0033;"><b>アクセス権がありません。</b></span>
</center>
<?php endif; ?>
<div>
<?php echo $this->_tpl_vars['inc_footer']; ?>
