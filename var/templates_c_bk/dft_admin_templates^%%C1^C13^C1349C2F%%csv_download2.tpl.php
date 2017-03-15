<?php /* Smarty version 2.6.18, created on 2015-11-30 15:23:56
         compiled from file:/var/www/atoffice/webapp/modules/admin/templates/csv_download2.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'ext_include', 'file:/var/www/atoffice/webapp/modules/admin/templates/csv_download2.tpl', 2, false),array('modifier', 't_escape', 'file:/var/www/atoffice/webapp/modules/admin/templates/csv_download2.tpl', 15, false),)), $this); ?>
<?php echo $this->_tpl_vars['inc_header']; ?>

<?php echo smarty_function_ext_include(array('file' => "inc_subnavi_adminSiteMember.tpl"), $this);?>

<?php $this->assign('page_name', "請求データCSVダウンロード"); ?>
<?php echo smarty_function_ext_include(array('file' => "inc_tree_adminSiteMember.tpl"), $this);?>

</div>

<?php if ($this->_tpl_vars['atoffice_auth_type'] == 2 || $this->_tpl_vars['atoffice_auth_type'] == 4): ?>

<h2>請求データCSVダウンロード</h2>
<div class="contents">

<?php if ($this->_tpl_vars['msg']): ?>
<p class="actionMsg"><?php echo smarty_modifier_t_escape($this->_tpl_vars['msg']); ?>
</p>
<?php endif; ?>

<p class="caution">※ 請求件数が多いと処理が重くなり、サーバーに負荷がかかる場合があります。</p>
<br>
★　現在の請求件数　★<br>
予約による請求中件数：<?php echo smarty_modifier_t_escape($this->_tpl_vars['reserve_bill']); ?>
件<br>
キャンセル料金などそれ以外の請求中件数：<?php echo smarty_modifier_t_escape($this->_tpl_vars['etc_bill']); ?>
件<br>
合計請求中件数：<?php echo smarty_modifier_t_escape($this->_tpl_vars['total_bill']); ?>
件<br>
<br>
<h3 class="item">全件ダウンロード</h3>
<?php if ($this->_tpl_vars['total_bill'] > 0): ?>
<form  action="./" method="get">
<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
<input type="hidden" name="a" value="do_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('csv_bill_list','do')); ?>
" />
<input type="hidden" name="sessid" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['PHPSESSID']); ?>
" />

<input type="hidden" name="start_id" value="0" />
<input type="hidden" name="end_id" value="0" />
<input type="hidden" name="allflag" value="1" />
<input type="hidden" name="timestamp" value="<?php echo smarty_modifier_t_escape(time()); ?>
" />
<p class="textBtn"><input type="submit" value="ダウンロード" /></p>
</form>
<?php else: ?>
現在請求中のデータはありません。<br>
<?php endif; ?>

<?php else: ?>
<br>
<center>
<span style="font-size: 16px; color: #FF0033;"><b>アクセス権がありません。</b></span>
</center>
<?php endif; ?>
<div>
<?php echo $this->_tpl_vars['inc_footer']; ?>

