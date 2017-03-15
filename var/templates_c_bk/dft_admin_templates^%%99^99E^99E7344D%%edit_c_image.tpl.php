<?php /* Smarty version 2.6.18, created on 2011-10-03 19:39:47
         compiled from file:/var/www/atoffice/webapp/modules/admin/templates/edit_c_image.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'ext_include', 'file:/var/www/atoffice/webapp/modules/admin/templates/edit_c_image.tpl', 2, false),array('function', 't_img_url', 'file:/var/www/atoffice/webapp/modules/admin/templates/edit_c_image.tpl', 52, false),array('modifier', 't_escape', 'file:/var/www/atoffice/webapp/modules/admin/templates/edit_c_image.tpl', 9, false),)), $this); ?>
<?php echo $this->_tpl_vars['inc_header']; ?>

<?php echo smarty_function_ext_include(array('file' => "inc_subnavi_adminImageKakikomi.tpl"), $this);?>

<?php $this->assign('page_name', "画像アップロード・削除"); ?>
<?php echo smarty_function_ext_include(array('file' => "inc_tree_adminImageKakikomi.tpl"), $this);?>

</div>


<?php if ($this->_tpl_vars['msg']): ?><p class="actionMsg"><?php echo smarty_modifier_t_escape($this->_tpl_vars['msg']); ?>
</p><?php endif; ?>
<h2 id="ttl01">画像のアップロード</h2>

<div class="contents">

<p class="caution" id="c01">※同じファイル名で既に登録されている画像がある場合、上書きされます。</p>
<form action="./" method="post" enctype="multipart/form-data" >
<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
<input type="hidden" name="a" value="do_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('insert_c_image','do')); ?>
" />
<input type="hidden" name="sessid" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['PHPSESSID']); ?>
" />
<dl>
<dt class="filename"><strong class="item">ファイル名</strong></dt>
<dd class="filename"><input type="text" class="basic" name="filename" value="" size="30" /></dd>
<dt class="upfile"><strong class="item">画像</strong></dt>
<dd class="upfile"><input type="file" name="upfile" /><span>（GIF・JPG・PNG形式）</span></dd>
</dl>
<p class="textBtn"><input type="submit" value="　登　録　" /></p>
</form>

</div>


<h2 id="ttl02">画像の表示・削除</h2>

<div class="contents">

<form action="./" method="post">
<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
<input type="hidden" name="a" value="page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('edit_c_image')); ?>
" />
<dl>
<dt class="filename"><strong class="item">ファイル名</strong></dt>
<dd class="filename"><input type="text" class="basic" name="filename" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['requests']['filename']); ?>
" size="30" /></dd>
</dl>
<p class="textBtn"><input type="submit" value="　表　示　" /></p>
</form>
<?php if ($this->_tpl_vars['requests']['filename']): ?>
<?php if ($this->_tpl_vars['is_image']): ?>
<form action="./" method="post">
<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
<input type="hidden" name="a" value="do_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('delete_c_image','do')); ?>
" />
<input type="hidden" name="sessid" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['PHPSESSID']); ?>
" />
<input type="hidden" name="filename" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['requests']['filename']); ?>
" />
<p class="delImg"><a href="<?php echo smarty_function_t_img_url(array('filename' => smarty_modifier_t_escape($this->_tpl_vars['requests']['filename'])), $this);?>
" target="_blank"><img src="<?php echo smarty_function_t_img_url(array('filename' => smarty_modifier_t_escape($this->_tpl_vars['requests']['filename']),'w' => 120,'h' => 120), $this);?>
"></a></p>
<?php if (strpos ( $this->_tpl_vars['requests']['filename'] , 'skin_' ) !== 0 && strpos ( $this->_tpl_vars['requests']['filename'] , 'no_' ) !== 0): ?>
<p class="textBtn"><input type="submit" value="この画像を削除する"></p>
<?php endif; ?>
</form>
<?php else: ?>
<p class="caution" id="c02"><strong><?php echo smarty_modifier_t_escape($this->_tpl_vars['requests']['filename']); ?>
</strong>は登録されていません。</p>
<p class="groupLing"><a href="?m=<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
&amp;a=page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('list_c_image')); ?>
">アップロード画像リストへ</a></p>
<?php endif; ?>
<?php endif; ?>
<?php echo $this->_tpl_vars['inc_footer']; ?>
