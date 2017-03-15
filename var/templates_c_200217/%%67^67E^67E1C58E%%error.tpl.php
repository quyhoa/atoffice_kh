<?php /* Smarty version 2.6.18, created on 2016-10-30 06:26:29
         compiled from error.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 't_escape', 'error.tpl', 3, false),)), $this); ?>
<html>
<head>
<title><?php if (defined ( 'SNS_NAME' )): ?><?php echo smarty_modifier_t_escape(@SNS_NAME); ?>
<?php else: ?>ページが表示できませんでした<?php endif; ?></title>
</head>
<body>
<?php if ($this->_tpl_vars['errors']): ?><p>エラーが発生しました。</p>
<ul>
<?php $_from = $this->_tpl_vars['errors']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<li><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']); ?>
</li>
<?php endforeach; endif; unset($_from); ?>
</ul>

<?php else: ?>
<?php if ($this->_tpl_vars['notfound']): ?>
<p>ページが見つかりません。</p>
<?php else: ?>
<p>
<?php if (@OPENPNE_MAINTENANCE_TEXT): ?>
<?php echo @OPENPNE_MAINTENANCE_TEXT; ?>

<?php else: ?>
現在、サーバが混み合っているか、メンテナンス中です。<br>
ご迷惑をおかけいたしますが、しばらく時間を空けて再度アクセスしてください。
<?php endif; ?>
</p>
<?php endif; ?>

<?php endif; ?>

<p><?php if (defined ( 'SNS_NAME' )): ?><?php echo smarty_modifier_t_escape(@SNS_NAME); ?>
<br><?php endif; ?>
<a href="<?php echo smarty_modifier_t_escape(@OPENPNE_URL); ?>
"><?php echo smarty_modifier_t_escape(@OPENPNE_URL); ?>
</a></p>
</body>
</html>