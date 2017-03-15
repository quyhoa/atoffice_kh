<?php /* Smarty version 2.6.18, created on 2016-12-15 05:15:14
         compiled from file:E:%5CA_project%5Catoffice/webapp/modules/admin/templates/hall_image.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'ext_include', 'file:E:\\A_project\\atoffice/webapp/modules/admin/templates/hall_image.tpl', 2, false),array('modifier', 't_escape', 'file:E:\\A_project\\atoffice/webapp/modules/admin/templates/hall_image.tpl', 13, false),)), $this); ?>
<?php echo $this->_tpl_vars['inc_header']; ?>

<?php echo smarty_function_ext_include(array('file' => "inc_subnavi_adminImageKakikomi.tpl"), $this);?>

<?php $this->assign('page_name', "会場画像登録"); ?>
<?php echo smarty_function_ext_include(array('file' => "inc_tree_adminImageKakikomi.tpl"), $this);?>

</div>


<?php if ($this->_tpl_vars['atoffice_auth_type'] == 1 || $this->_tpl_vars['atoffice_auth_type'] == 4): ?>


<h2 id="ttl01">会場画像登録【<?php echo smarty_modifier_t_escape($this->_tpl_vars['hall_name']); ?>
】</h2>
<br>
<center>
<?php if ($this->_tpl_vars['msg']): ?><p class="actionMsg"><?php echo smarty_modifier_t_escape($this->_tpl_vars['msg']); ?>
</p><br><br><?php endif; ?>
<br>
<?php $_from = $this->_tpl_vars['image_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
※ 画像<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['num']); ?>
は<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['x']); ?>
ｘ<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['y']); ?>
ピクセルで登録してください。<br>

<br><br>
<table border=1>
<tr>
<th bgcolor=#CCCFFF height=30>画像ID</th>
<th bgcolor=#CCCFFF>登録画像プレビュー</th>
<th bgcolor=#CCCFFF>登録画像参照</th>
</tr>
<tr>
<td width=80 align=center bgcolor=#CCCCCC><b>画像<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['num']); ?>
</b><br><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['use']); ?>
</td>
<td>
<?php if ($this->_tpl_vars['image_data'][$this->_tpl_vars['key']]['image_filename']): ?>
<img src='./img.php?filename=<?php echo smarty_modifier_t_escape($this->_tpl_vars['image_data'][$this->_tpl_vars['key']]['image_filename']); ?>
' width='<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['x']); ?>
' height='<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['y']); ?>
'>
<?php else: ?>
<img src='./img.php?filename=skin_no_image.gif' width='<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['x']); ?>
' height='<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['y']); ?>
'>
<?php endif; ?>
</td>
<td align=right>
<form name="add<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['num']); ?>
" action="./" method="post" enctype="multipart/form-data" >
<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
<input type="hidden" name="a" value="do_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('insert_a_image','do')); ?>
" />
<input type="hidden" name="sessid" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['PHPSESSID']); ?>
" />
<input type="hidden" name="image_id" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['num']); ?>
">
<input type="hidden" name="delete_flag" value="0">
<input type="hidden" name="hall_id" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['hall_id']); ?>
">
<input type="hidden" class="basic" name="filename" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['hall_id']); ?>
_<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['num']); ?>
" size="30" />
<div align=center>画像タイトル：<input type="text" name="title" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['image_data'][$this->_tpl_vars['key']]['title']); ?>
"><br></div>
<br>
<input type="file" class="basic" name="upfile" /><span>（GIF・JPG・PNG形式）</span>
<br>
<br>
画像<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['num']); ?>
を登録する：　<input type="submit" value="　登　録　" />
</form>
<br>
<br>
<form name="del<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['num']); ?>
" action="./" method="post" enctype="multipart/form-data" >
<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
<input type="hidden" name="a" value="do_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('insert_a_image','do')); ?>
" />
<input type="hidden" name="sessid" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['PHPSESSID']); ?>
" />
<input type="hidden" name="image_id" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['num']); ?>
">
<input type="hidden" name="delete_flag" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['num']); ?>
">
<input type="hidden" name="hall_id" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['hall_id']); ?>
">
画像<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['num']); ?>
を削除する：　<input type="submit" value="　削　除　" />
</form>

</td>
</tr>
</table>
<br>
<br>
<?php endforeach; endif; unset($_from); ?>


</center>

<?php else: ?>
<br>
<center>
<span style="font-size: 16px; color: #FF0033;"><b>アクセス権がありません。</b></span>
</center>
<?php endif; ?>
<div>
<?php echo $this->_tpl_vars['inc_footer']; ?>
