<?php /* Smarty version 2.6.18, created on 2016-10-25 19:38:12
         compiled from file:/var/www/atoffice/webapp/modules/pc/templates/common/layout.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 't_escape', 'file:/var/www/atoffice/webapp/modules/pc/templates/common/layout.tpl', 9, false),array('function', 't_url_style', 'file:/var/www/atoffice/webapp/modules/pc/templates/common/layout.tpl', 10, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
 "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<?php if ($this->_tpl_vars['INC_HEADER_inc_html_head']): ?><?php echo $this->_tpl_vars['INC_HEADER_inc_html_head']; ?>
<?php endif; ?>
<meta http-equiv="Content-Style-Type" content="text/css" />
<meta http-equiv="Content-Script-Type" content="text/javascript" />
<title><?php echo smarty_modifier_t_escape($this->_tpl_vars['INC_HEADER_title']); ?>
</title>
<?php echo smarty_function_t_url_style(array(), $this);?>

<script type="text/javascript" src="./js/prototype.js?r7140"></script>
<script type="text/javascript" src="./js/Selection.js?r7140"></script>
<script type="text/javascript" src="./js/pne.js"></script>

<script type="text/javascript">
function Hiddenurl(){
window.status = '';
return true;
}
if (document.layers)
document.captureEvents(Event.MOUSEOVER | Event.MOUSEOUT);
document.onmouseover = Hiddenurl;
document.onmouseout = Hiddenurl;
</script>

<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-479986-19']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>

</head>
<body id="pc_page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['INC_HEADER_page_name']); ?>
"><div id="Body">

<script tyep="text/javascript">
	function RollOver (obj,val) {
	  obj.src = val;
	}
</script>


<div id="Container">

<?php if (! $this->_tpl_vars['INC_HEADER_is_login']): ?>


<?php if ($this->_tpl_vars['c_member']['nickname']): ?>

<center>




</center>

<?php endif; ?><?php endif; ?>

<br>


<!-- start of op_content -->
<?php echo $this->_tpl_vars['op_content']; ?>

<!-- end of op_content -->

<?php if (! $this->_tpl_vars['INC_FOOTER_is_login']): ?>
<div id="Footer">
<p><?php echo $this->_tpl_vars['INC_FOOTER_inc_page_footer']; ?>
</p>
</div>
<?php endif; ?>


</div><!-- Container -->
</div><!-- Body -->

<script type="text/javascript">
(function(){
    var p = (("https:" == document.location.protocol) ? "https://" : "http://"), r=Math.round(Math.random() * 10000000), rf = window.top.location.href, prf = window.top.document.referrer;
    document.write(unescape('%3C')+'img src="'+ p + 'acq-3pas.admatrix.jp/if/5/01/fdf68a917cdad4763e334299f50a384a.fs?cb=' + encodeURIComponent(r) + '&rf=' + encodeURIComponent(rf) +'&prf=' + encodeURIComponent(prf) + '" alt=""  width="1" height="1" '+unescape('%2F%3E'));
})();
</script>
<noscript><img src="//acq-3pas.admatrix.jp/if/6/01/fdf68a917cdad4763e334299f50a384a.fs" alt="" width="1" height="1" /></noscript>


<script type="text/javascript">
piAId = '74352';
piCId = '1414';

(function() {
	function async_load(){
		var s = document.createElement('script'); s.type = 'text/javascript';
		s.src = ('https:' == document.location.protocol ? 'https://pi' : 'http://cdn') + '.pardot.com/pd.js';
		var c = document.getElementsByTagName('script')[0]; c.parentNode.insertBefore(s, c);
	}
	if(window.attachEvent) { window.attachEvent('onload', async_load); }
	else { window.addEventListener('load', async_load, false); }
})();
</script>


</body>
</html>