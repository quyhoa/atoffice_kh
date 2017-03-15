<?php /* Smarty version 2.6.18, created on 2016-10-26 17:31:54
         compiled from file:/var/www/atoffice/webapp/modules/pc/templates/o_login2.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 't_form_block', 'file:/var/www/atoffice/webapp/modules/pc/templates/o_login2.tpl', 53, false),array('modifier', 't_escape', 'file:/var/www/atoffice/webapp/modules/pc/templates/o_login2.tpl', 54, false),)), $this); ?>
<link href="./atoffice/css/style.css" rel="stylesheet" type="text/css" />

<style type="text/css">
	<!--
table#table-01 {
    width: 880px;
    border: 0px;
    border-collapse: collapse;
    border-spacing: 0;
}

table#table-01 td {
    border: 0px;
    border-width: 0px;
    padding-top: 10px;
    padding-left: 10px;
    vertical-align:top;
    text-align:left;
}

-->
</style>

<div id="container">
<div id="header">
<h1></h1>
</div><!--heaer_end-->

<div id="menu">
<ul>
<li class="home"><a href="http://abc-kaigishitsu.com/">他の会場を探す</a></li>
<li><a href="./?page=reserved_info">会員用予約確認</a></li>
<li><a href="./?page=search">　</a></li>
</ul>

</div><!-- menu end -->

<div id="LayoutC">

<table id="table-01">
<tr>
<td width=10></td>
<td width=610>

<div class="dparts formTable"><div class="parts">
<div class="partsHeading"><h3>PCメールアドレス登録</h3></div>

<div class="partsInfo">
<p>PCメールアドレスの登録をおこないます。<br />パスワードを入力してください。</p>
</div>

<?php $this->_tag_stack[] = array('t_form_block', array('m' => 'pc','a' => 'do_o_login2_change_mail')); $_block_repeat=true;smarty_block_t_form_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
<input type="hidden" name="sid" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['sid']); ?>
" />
<input type="hidden" name="username" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['username']); ?>
" />
<table>
<tr><th>メールアドレス</th>
<td style='border: 1px #CDCDCD solid;'><?php echo smarty_modifier_t_escape($this->_tpl_vars['pc_address']); ?>
<br />
<p class="caution">※ログインアカウントのメールアドレスもこちらに変わります。</p>
</td></tr>
<tr><th>パスワード</th>
<td style='border: 1px #CDCDCD solid;'><input type="password" name="password" class="text" />
</td></tr>
</table>

<div class="operation">
<ul class="moreInfo button">
<li><input type="submit" class="input_submit" value="　登　録　" /></li>
</ul>
</div>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t_form_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

</div></div>

</td>
<td width=210></td>
</tr>
</table>

</div><!-- LayoutC -->

</div>
<script type="text/javascript" src="./atoffice/js/ajax.js"></script>

<script type="text/javascript">
function PerformInputLink2(){
	LoadHTML('footer', 'sub/footer.html');
}
</script>
<div id="LoadingBar">
	<img border="0" src="./atoffice/img/loading.gif"/>
</div>
<div id="footer">
	<script type="text/javascript">PerformInputLink2();</script>
</div>
