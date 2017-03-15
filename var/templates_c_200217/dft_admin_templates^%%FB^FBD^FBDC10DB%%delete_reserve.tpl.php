<?php /* Smarty version 2.6.18, created on 2016-10-31 14:44:31
         compiled from file:/var/www/atoffice/webapp/modules/admin/templates/delete_reserve.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'ext_include', 'file:/var/www/atoffice/webapp/modules/admin/templates/delete_reserve.tpl', 2, false),array('modifier', 't_escape', 'file:/var/www/atoffice/webapp/modules/admin/templates/delete_reserve.tpl', 22, false),)), $this); ?>
<?php echo $this->_tpl_vars['inc_header']; ?>

<?php echo smarty_function_ext_include(array('file' => "inc_subnavi_adminStatisticalInformation.tpl"), $this);?>


<?php $this->assign('page_name', "予約削除"); ?>
<?php echo smarty_function_ext_include(array('file' => "inc_tree_adminStatisticalInformation.tpl"), $this);?>

</div>

<?php if ($this->_tpl_vars['atoffice_auth_type'] == 4): ?>

<script type="text/javascript">
function confirm1(){
	if(window.confirm('予約を削除しますか？')){
		return;
	}else{
		return false;
	}
}
</script>

<?php if ($this->_tpl_vars['msg']): ?><p class="actionMsg"><?php echo smarty_modifier_t_escape($this->_tpl_vars['msg']); ?>
</p><?php endif; ?>
<h2>予約削除</h2>
<div class="contents">
<p class="info">予約データを削除します。</p>
<p class="info">カンマ区切りで複数予約を同時に削除できます。</p>
ハイフン（-）を入れて範囲を指定できます。<br>
<br>
以下は同じ動作です。<br>
<span style="font-size:20px;color:#FF0000;"><b>1,2,3,4,5</b></span>　　=　　
<span style="font-size:20px;color:#00AA00;"><b>1,2-4,5</b></span>　　=　　
<span style="font-size:20px;color:#0000FF;"><b>1-5</b><br></span>
<br>



<form action="./" onSubmit="Javascript:return confirm1();" method="post" enctype="multipart/form-data">
<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
<input type="hidden" name="a" value="do_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('delete_reserve','do')); ?>
" />
<input type="hidden" name="sessid" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['PHPSESSID']); ?>
" />

<table class="basicType2">
<?php ob_start(); ?>
<tr>
<th>削除対象予約ID</th>
<th>操作</th>
</tr>
<tr>
<td>
<input type="text" name="delete_id" value="" size=80>
</td>
<td>
<p class="textBtn"><input type="submit" class="submit" value="　削　除　" /></p
</td>
</tr>
</table>
</form>

<?php else: ?>
<br>
<center>
<span style="font-size: 16px; color: #FF0033;"><b>アクセス権がありません。</b></span>
</center>
<?php endif; ?>
<div>
<?php echo $this->_tpl_vars['inc_footer']; ?>