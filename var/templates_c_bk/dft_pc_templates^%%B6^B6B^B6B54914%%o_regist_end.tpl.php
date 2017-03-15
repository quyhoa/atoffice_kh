<?php /* Smarty version 2.6.18, created on 2015-11-28 12:46:39
         compiled from file:/var/www/atoffice/webapp/modules/pc/templates/o_regist_end.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 't_escape', 'file:/var/www/atoffice/webapp/modules/pc/templates/o_regist_end.tpl', 50, false),)), $this); ?>
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

<div class="dparts simpleBox"><div class="parts">
<div class="partsHeading"><h3>登録完了</h3></div>
<div class="block">
<p>登録が完了しました。<br />以下のページからログインしてください。<br /><br /><a href="<?php echo smarty_modifier_t_escape($this->_tpl_vars['login_url']); ?>
">ログインページへ</a></p>
</div>
</div></div>

</td><td width=5></td><td>

</td>
</tr>
</table>

<?php echo $this->_tpl_vars['aftag']; ?>



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
