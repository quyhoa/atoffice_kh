<?php /* Smarty version 2.6.18, created on 2016-12-13 04:30:10
         compiled from file:E:%5CA_project%5Catoffice/webapp/modules/admin/templates/inc_tree_adminImageKakikomi.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 't_escape', 'file:E:\\A_project\\atoffice/webapp/modules/admin/templates/inc_tree_adminImageKakikomi.tpl', 1, false),)), $this); ?>
<div class="tree"><a href="?m=<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
">管理画面TOP</a>&nbsp;＞&nbsp;初期設定担当メニュー：<?php if ($this->_tpl_vars['parent_page_name']): ?><a href="<?php echo $this->_smarty_vars['capture']['parent_page_url']; ?>
"><?php echo smarty_modifier_t_escape($this->_tpl_vars['parent_page_name']); ?>
</a>&nbsp;＞&nbsp;<?php endif; ?><?php echo smarty_modifier_t_escape($this->_tpl_vars['page_name']); ?>
</div>