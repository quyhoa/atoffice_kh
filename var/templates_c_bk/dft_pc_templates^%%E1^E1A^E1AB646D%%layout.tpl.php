<?php /* Smarty version 2.6.18, created on 2010-08-26 19:40:29
         compiled from file:/var/www/atoffice_torioki20100712/webapp/modules/pc/templates/common/layout.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 't_escape', 'file:/var/www/atoffice_torioki20100712/webapp/modules/pc/templates/common/layout.tpl', 9, false),array('function', 't_url_style', 'file:/var/www/atoffice_torioki20100712/webapp/modules/pc/templates/common/layout.tpl', 10, false),)), $this); ?>
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
</body>
</html>