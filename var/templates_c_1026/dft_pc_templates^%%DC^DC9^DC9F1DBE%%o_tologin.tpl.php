<?php /* Smarty version 2.6.18, created on 2016-10-25 19:40:40
         compiled from file:/var/www/atoffice/webapp/modules/pc/templates/o_tologin.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 't_img_url_skin', 'file:/var/www/atoffice/webapp/modules/pc/templates/o_tologin.tpl', 49, false),array('modifier', 't_escape', 'file:/var/www/atoffice/webapp/modules/pc/templates/o_tologin.tpl', 51, false),)), $this); ?>
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

<?php if (! $this->_tpl_vars['no_use_alert'] && ( $this->_tpl_vars['msg'] || $this->_tpl_vars['msg1'] || $this->_tpl_vars['msg2'] || $this->_tpl_vars['msg3'] || $this->_tpl_vars['err_msg'] )): ?>
<div class="dparts alertBox"><div class="parts">
<table><tr>
<th><img src="<?php echo smarty_function_t_img_url_skin(array('filename' => 'icon_alert_l'), $this);?>
" alt="警告" /></th>
<td style='text-align:center;vertical-align:middle;'>
<?php if ($this->_tpl_vars['msg']): ?><?php echo smarty_modifier_t_escape($this->_tpl_vars['msg']); ?>
<br /><?php endif; ?>
<?php if ($this->_tpl_vars['msg1']): ?><?php echo smarty_modifier_t_escape($this->_tpl_vars['msg1']); ?>
<br /><?php endif; ?>
<?php if ($this->_tpl_vars['msg2']): ?><?php echo smarty_modifier_t_escape($this->_tpl_vars['msg2']); ?>
<br /><?php endif; ?>
<?php if ($this->_tpl_vars['msg3']): ?><?php echo smarty_modifier_t_escape($this->_tpl_vars['msg3']); ?>
<br /><?php endif; ?>
<?php $_from = $this->_tpl_vars['err_msg']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']); ?>
<br />
<?php endforeach; endif; unset($_from); ?>
</td>
</tr></table>
</div></div>
<?php endif; ?>

<div class="parts linkLine"><ul class="moreInfo">
<li><a href="<?php echo smarty_modifier_t_escape($this->_tpl_vars['login_url']); ?>
">ログインページへ</a></li>
</ul></div>

</td><td width=5></td><td>

</td>
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


