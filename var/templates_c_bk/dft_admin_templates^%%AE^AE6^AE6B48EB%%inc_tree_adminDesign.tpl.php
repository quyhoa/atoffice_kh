<?php /* Smarty version 2.6.18, created on 2015-11-27 17:37:39
         compiled from file:/var/www/atoffice/webapp/modules/admin/templates/inc_tree_adminDesign.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 't_escape', 'file:/var/www/atoffice/webapp/modules/admin/templates/inc_tree_adminDesign.tpl', 1, false),)), $this); ?>
<div class="tree"><a href="?m=<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
">管理画面TOP</a>&nbsp;＞&nbsp;準備担当者メニュー：<?php if ($this->_tpl_vars['parent_page_name']): ?><a href="<?php echo $this->_smarty_vars['capture']['parent_page_url']; ?>
"><?php echo smarty_modifier_t_escape($this->_tpl_vars['parent_page_name']); ?>
</a>&nbsp;＞&nbsp;<?php endif; ?><?php echo smarty_modifier_t_escape($this->_tpl_vars['page_name']); ?>
</div>