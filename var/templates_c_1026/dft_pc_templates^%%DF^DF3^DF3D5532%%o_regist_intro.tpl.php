<?php /* Smarty version 2.6.18, created on 2016-10-26 08:37:44
         compiled from file:/var/www/atoffice/webapp/modules/pc/templates/o_regist_intro.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 't_escape', 'file:/var/www/atoffice/webapp/modules/pc/templates/o_regist_intro.tpl', 60, false),array('modifier', 't_url2a', 'file:/var/www/atoffice/webapp/modules/pc/templates/o_regist_intro.tpl', 60, false),array('modifier', 'nl2br', 'file:/var/www/atoffice/webapp/modules/pc/templates/o_regist_intro.tpl', 60, false),array('block', 't_form_block', 'file:/var/www/atoffice/webapp/modules/pc/templates/o_regist_intro.tpl', 78, false),)), $this); ?>
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
<td width=20></td>
<td width=610>

<div class="dparts descriptionBox"><div class="parts">
<div class="partsHeading"><h3>会員登録</h3></div>
<div class="block">
<p>サービスを利用するには、以下の規約を遵守してください。<br />利用者ご本人により会員規約に同意のうえ、登録手続きを進めてください。</p>
</div>
</div></div>

<div class="dparts descriptionBox"><div class="parts">
<div class="partsHeading"><h3>利用規約</h3></div>
<div class="block">
<p>
<?php if ($this->_tpl_vars['c_siteadmin'] != ""): ?>
<?php echo ((is_array($_tmp=((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['c_siteadmin']))) ? $this->_run_mod_handler('t_url2a', true, $_tmp) : smarty_modifier_t_url2a($_tmp)))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>

<?php else: ?>
<a href="http://abc-kaigishitsu.com/ikebukuro/kiyaku.html" target="_blank">利用規約はこちらをクリック</a>
<?php endif; ?>
</p>
</div>
</div></div>

</td><td width=5></td><td>

</td>
</tr>
</table>


<div class="parts buttonLine">
<?php $this->_tag_stack[] = array('t_form_block', array('m' => 'pc','a' => 'page_o_regist_prof')); $_block_repeat=true;smarty_block_t_form_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
<input type="hidden" name="mode" value="input" />
<input type="hidden" name="sid" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['sid']); ?>
" />
<input type="submit" class="input_submit" value="同意して登録手続きへ" />
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t_form_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
</div>


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

