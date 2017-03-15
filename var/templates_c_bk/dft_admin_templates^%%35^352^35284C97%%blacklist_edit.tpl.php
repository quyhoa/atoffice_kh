<?php /* Smarty version 2.6.18, created on 2011-06-27 17:06:58
         compiled from file:/var/www/atoffice/webapp/modules/admin/templates/blacklist_edit.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'ext_include', 'file:/var/www/atoffice/webapp/modules/admin/templates/blacklist_edit.tpl', 2, false),array('modifier', 't_escape', 'file:/var/www/atoffice/webapp/modules/admin/templates/blacklist_edit.tpl', 5, false),)), $this); ?>
<?php echo $this->_tpl_vars['inc_header']; ?>

<?php echo smarty_function_ext_include(array('file' => "inc_subnavi_adminSiteMember.tpl"), $this);?>

<?php $this->assign('page_name', "ブラックリスト編集"); ?>
<?php $this->assign('parent_page_name', "ブラックリスト管理"); ?>
<?php ob_start(); ?>?m=<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
&amp;a=page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('blacklist')); ?>
<?php $this->_smarty_vars['capture']['parent_page_url'] = ob_get_contents(); ob_end_clean(); ?>

<?php echo smarty_function_ext_include(array('file' => "inc_tree_adminSiteMember.tpl"), $this);?>

</div>


<?php if ($this->_tpl_vars['msg']): ?><p class="actionMsg"><?php echo smarty_modifier_t_escape($this->_tpl_vars['msg']); ?>
</p><?php endif; ?>
<h2>ブラックリスト編集</h2>
<div class="contents">

<p class="caution">※ブラックリストに追加された顧客のメールアドレスで、部屋の予約・ログインができなくなります。</p>

<form name="add_blacklist" method="POST" action="./">
<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
<input type="hidden" name="a" value="do_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('add_blacklist','do')); ?>
" />
<input type="hidden" name="sessid" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['PHPSESSID']); ?>
" />
<input type="hidden" name="c_member_id" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['c_member']['c_member_id']); ?>
">

<table class="basicType2">
<tbody>
<tr>
<th>氏名</th>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['blacklist']['nickname']); ?>
</td>
</tr>
<tr>
<th>メールアドレス</th>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['blacklist']['mail']); ?>
</td>
</tr>
<tr>
<th>備考</th>
<td><textarea class="basic" name="info" cols="30" rows="3"><?php echo smarty_modifier_t_escape($this->_tpl_vars['blacklist']['info']); ?>
</textarea></td>
</tr>
</tbody>
</table>

<p class="textBtn"><input type="submit" class="submit" value="　決　定　" /></p>
</form>

<?php echo $this->_tpl_vars['inc_footer']; ?>
