<?php /* Smarty version 2.6.18, created on 2016-12-15 04:41:56
         compiled from file:E:%5CA_project%5Catoffice/webapp/modules/admin/templates/edit_c_admin_user.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'ext_include', 'file:E:\\A_project\\atoffice/webapp/modules/admin/templates/edit_c_admin_user.tpl', 2, false),array('modifier', 't_escape', 'file:E:\\A_project\\atoffice/webapp/modules/admin/templates/edit_c_admin_user.tpl', 5, false),)), $this); ?>
<?php echo $this->_tpl_vars['inc_header']; ?>

<?php echo smarty_function_ext_include(array('file' => "inc_subnavi_adminAdminConfig.tpl"), $this);?>


<?php $this->assign('parent_page_name', "アカウント管理"); ?>
<?php ob_start(); ?>?m=<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
&amp;a=page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('list_c_admin_user')); ?>
<?php $this->_smarty_vars['capture']['parent_page_url'] = ob_get_contents(); ob_end_clean(); ?>

	<?php $this->assign('page_name', "アカウント追加"); ?>
	<?php echo smarty_function_ext_include(array('file' => "inc_tree_adminAdminConfig.tpl"), $this);?>

</div>
<script type="text/javascript">
function Sel(){
	var obj=document.forms['admin_user'].elements['atoffice_auth_type'];
	if(obj[0].checked){
		document.getElementById('d1').style.display='none';
		document.getElementById('d2').style.display='none';
	}
	if(obj[1].checked){
		document.getElementById('d1').style.display='none';
		document.getElementById('d2').style.display='none';
	}
	if(obj[2].checked){
		var check = document.getElementById('d2');
		if(check === null){	
			document.getElementById('d1').style.display = 'block';
		}
		document.getElementById('d2').style.display = 'block';
	}
	if(obj[3].checked){
		document.getElementById('d1').style.display='none';
		document.getElementById('d2').style.display='none';
	}
}	
</script>
<?php if ($this->_tpl_vars['msg']): ?><p class="actionMsg"><?php echo smarty_modifier_t_escape($this->_tpl_vars['msg']); ?>
</p><?php endif; ?>
<h2>編集</h2>
<div class="contents">
<?php $_from = $this->_tpl_vars['info_admin']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<form action="./" method="post" id="admin_user" name="admin_user">
	<table class="basicType1">
		<tr>
			<th>アカウント名
				<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
				<input type="hidden" name="a" value="do_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('edit_c_admin_user','do')); ?>
" />
				<input type="hidden" name="sessid" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['PHPSESSID']); ?>
" />				
			</th>
			<td>
				<input type="text" name="username_acc" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['username']); ?>
">
			</td>
		</tr>
		<tr>
			<th>氏　名</th>
			<td><input type="text" name="name_acc" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['name']); ?>
"></td>
		</tr>
		<tr>
			<th>権限</th>
			<td>
			<input type = "hidden" name="check_type" value=<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['atoffice_auth_type']); ?>
>
			<input class="basic" type="hidden" name="auth_type" value="all">
			<input class="basic" type="radio" name="atoffice_auth_type" <?php if ($this->_tpl_vars['item']['atoffice_auth_type'] == '1'): ?> checked <?php endif; ?> onclick="Sel()" value="1">初期設定担当者　
			<input class="basic" type="radio" name="atoffice_auth_type" <?php if ($this->_tpl_vars['item']['atoffice_auth_type'] == '2'): ?> checked <?php endif; ?> onclick="Sel()" value="2">予約受付担当者　
			<input class="basic" type="radio" id ="check" name="atoffice_auth_type" <?php if ($this->_tpl_vars['item']['atoffice_auth_type'] == '3'): ?> checked <?php endif; ?> onclick="Sel()" value="3">準備担当者　
			<input class="basic" type="radio" name="atoffice_auth_type" <?php if ($this->_tpl_vars['item']['atoffice_auth_type'] == '4'): ?> checked <?php endif; ?> onclick="Sel()" value="4">管理者
			</td>
		</tr>
		<input type ="hidden" name ="hall_id" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['hall_id']); ?>
"/>
		<input type ="hidden" name ="c_admin_user_id" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['c_admin_user_id']); ?>
"/>
		<?php endforeach; endif; unset($_from); ?>
	</table>
<?php if ($this->_tpl_vars['item']['atoffice_auth_type'] == '3'): ?>
<div id = "d2" style="display: block">
<table class="basicType1">
	<tr>
		<th rowspan="2" width=150>準備担当会場</th>
		<td>
			【閲覧可能会場】
		</td>
		<td>
			<ul class="address_add">				
				<?php $_from = $this->_tpl_vars['hall_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>									
					<li>							
						<label>
							<input  type="checkbox" name="ad1[]" <?php $_from = $this->_tpl_vars['list_hall_id']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['foo']):
?> id="t<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['hall_id']); ?>
" onclick="checkChecked(<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['hall_id']); ?>
)" <?php if ($this->_tpl_vars['foo'] == $this->_tpl_vars['item']['hall_id']): ?>checked<?php endif; ?> <?php endforeach; endif; unset($_from); ?> value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['hall_id']); ?>
"><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['hall_name']); ?>

						</label>
					</li>						
				<?php endforeach; endif; unset($_from); ?>
			</ul>
		</td>
	</tr>
</table>
</div>
<?php endif; ?>
<div id="d1" style="display: none">
<table class="basicType1">
	<tr>
		<th rowspan="2" width=150>準備担当会場</th>
		<td>
			【閲覧可能会場】
		</td>
		<td>
			<ul class="address_add">				
				<?php $_from = $this->_tpl_vars['hall_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>									
					<li>							
						<label>
							<input type="checkbox" name="ad[]" <?php $_from = $this->_tpl_vars['list_hall_id']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['foo']):
?> <?php if ($this->_tpl_vars['foo'] == $this->_tpl_vars['item']['hall_id']): ?>checked<?php endif; ?> <?php endforeach; endif; unset($_from); ?> value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['hall_id']); ?>
"><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['hall_name']); ?>

						</label>
					</li>						
				<?php endforeach; endif; unset($_from); ?>
			</ul>
		</td>
	</tr>
</table>
</div>
<p class="textBtn"><input type="submit" value="追加する"></p>
</form>
<p class="groupLing"><a href="?m=<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
&amp;a=page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('list_c_admin_user')); ?>
">アカウント管理へ戻る</a></p>
<?php echo $this->_tpl_vars['inc_footer']; ?>

<style>
.address_add{
	margin-bottom: 10px;
}
.address_add li input[type="checkbox"]{
    display:inline-block;
    width:19px;
    height:19px;
    margin:-1px 4px 5px 0;
    vertical-align:middle;
    cursor:pointer;
}
.contents table.basicType1 td{
	border: 1px solid #A3A3A6;
}
</style>
<script type="text/javascript">
	function checkChecked(id){
		if(document.getElementById("t"+id).hasAttribute('checked')) {
			document.getElementById("t"+id).removeAttribute('checked');
		}
	}
</script>