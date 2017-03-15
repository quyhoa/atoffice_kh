<?php /* Smarty version 2.6.18, created on 2016-12-29 08:17:20
         compiled from file:/var/www/html/atoffice/webapp/modules/admin/templates/import_pay_money.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'ext_include', 'file:/var/www/html/atoffice/webapp/modules/admin/templates/import_pay_money.tpl', 2, false),array('modifier', 't_escape', 'file:/var/www/html/atoffice/webapp/modules/admin/templates/import_pay_money.tpl', 15, false),)), $this); ?>
<?php echo $this->_tpl_vars['inc_header']; ?>

<?php echo smarty_function_ext_include(array('file' => "inc_subnavi_adminSiteMember.tpl"), $this);?>

<?php $this->assign('page_name', "eマッチング入金処理"); ?>
<?php echo smarty_function_ext_include(array('file' => "inc_tree_adminSiteMember.tpl"), $this);?>

</div>

<?php if ($this->_tpl_vars['atoffice_auth_type'] == 2 || $this->_tpl_vars['atoffice_auth_type'] == 4): ?>

<h2>eマッチング入金処理</h2>
<div class="contents">

<?php if ($this->_tpl_vars['requests']['msg']): ?>
<p class="actionMsg"><?php echo smarty_modifier_t_escape($this->_tpl_vars['requests']['msg']); ?>
</p>
<?php endif; ?>

<p>以下のフォームからeマッチングでダウンロードしたCSVファイルをアップロードすると、入金を登録することができます。</p>

<ul class="caution">
<li>※1ファイルで登録処理がおこなわれるのは1000行目までです。以降の行は無視されます。</li>
<li>※この処理には長時間かかる場合があります。</li>
</ul>

<form action="./" method="post" enctype="multipart/form-data">
<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
<input type="hidden" name="a" value="do_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('import_pay_money','do')); ?>
" />
<input type="hidden" name="sessid" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['PHPSESSID']); ?>
" />
<p><input type="file" name="member_file" /></p>
<p class="textBtn"><input type="submit" class="submit" value="　登　録　" /></p>
</form>
<br>
<h3 class="item">CSVファイル形式</h3>
<ul>
<li>文字コード： UTF-8</li>
<li>ファイルの拡張子： .csv</li>
</ul>
<p>1行目にヘッダ行、2行目以降に入金情報を記載します。</p>
<p>ヘッダ行には以下の項目が記載できます。</p>

<table class="basicType2">
<tr><th>bill_id ※</th><td>請求番号</td></tr>
<tr><th>c_member_id ※</th><td>取引先コード</td></tr>
<tr><th>branch_id ※</th><td>仮想支店番号</td></tr>
<tr><th>type ※</th><td>口座科目　普通：１　当座：２</td></tr>
<tr><th>virtual_code ※</th><td>バーチャル口座番号</td></tr>
<tr><th>pay_money ※</th><td>入金額</td></tr>

</table>

<?php else: ?>
<br>
<center>
<span style="font-size: 16px; color: #FF0033;"><b>アクセス権がありません。</b></span>
</center>
<?php endif; ?>
<div>
<?php echo $this->_tpl_vars['inc_footer']; ?>

