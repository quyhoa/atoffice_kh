<?php /* Smarty version 2.6.18, created on 2016-12-15 03:57:31
         compiled from file:E:%5CA_project%5Catoffice/webapp/modules/admin/templates/csv_download.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'ext_include', 'file:E:\\A_project\\atoffice/webapp/modules/admin/templates/csv_download.tpl', 2, false),array('modifier', 't_escape', 'file:E:\\A_project\\atoffice/webapp/modules/admin/templates/csv_download.tpl', 15, false),)), $this); ?>
<?php echo $this->_tpl_vars['inc_header']; ?>

<?php echo smarty_function_ext_include(array('file' => "inc_subnavi_adminStatisticalInformation.tpl"), $this);?>

<?php $this->assign('page_name', "CSVダウンロード"); ?>
<?php echo smarty_function_ext_include(array('file' => "inc_tree_adminStatisticalInformation.tpl"), $this);?>

</div>

<?php if ($this->_tpl_vars['atoffice_auth_type'] == 4): ?>

<h2>CSVダウンロード</h2>
<div class="contents">

<?php if ($this->_tpl_vars['msg']): ?>
<p class="actionMsg"><?php echo smarty_modifier_t_escape($this->_tpl_vars['msg']); ?>
</p>
<?php endif; ?>

<p class="caution">※全件ダウンロードすると処理が重くなり、サーバーに負荷がかかる場合があります。</p>

<h3 class="item">全件ダウンロード</h3>
<p>全てのメンバーの情報をCSV形式でダウンロードします。</p>
<form  action="./" method="get">
<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
<input type="hidden" name="a" value="do_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('csv_member','do')); ?>
" />
<input type="hidden" name="sessid" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['PHPSESSID']); ?>
" />
<input type="radio" name="mode" value="0" checked>ノーマル出力
<input type="radio" name="mode" value="1">CKRS仕様出力
<input type="radio" name="mode" value="2">取引先マスタ出力
<br>
<input type="hidden" name="start_id" value="0" />
<input type="hidden" name="end_id" value="0" />
<input type="hidden" name="allflag" value="1" />
<input type="hidden" name="timestamp" value="<?php echo smarty_modifier_t_escape(time()); ?>
" />
<p class="textBtn"><input type="submit" value="ダウンロード" /></p>
</form>
<br>
<h3 class="item">メンバーIDを指定してダウンロード</h3>
<p>メンバーIDが指定された範囲内のメンバーの情報をCSV形式でダウンロードします。</p>
<form  action="./" method="get">
<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
<input type="hidden" name="a" value="do_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('csv_member','do')); ?>
" />
<input type="hidden" name="sessid" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['PHPSESSID']); ?>
" />
<input type="radio" name="mode" value="0" checked>ノーマル出力
<input type="radio" name="mode" value="1">CKRS仕様出力
<input type="radio" name="mode" value="2">取引先マスタ出力
<br>
<input class="basic" type="text" name="start_id" value="" size="5" />　～　<input class="basic" type="text" name="end_id" value="" size="5" />
<input type="hidden" name="allflag" value="0" />
<input type="hidden" name="timestamp" value="<?php echo smarty_modifier_t_escape(time()); ?>
" />
<p class="textBtn"><input type="submit" value="ダウンロード" /></p>
</form>

<?php else: ?>
<br>
<center>
<span style="font-size: 16px; color: #FF0033;"><b>アクセス権がありません。</b></span>
</center>
<?php endif; ?>
<div>
<?php echo $this->_tpl_vars['inc_footer']; ?>

