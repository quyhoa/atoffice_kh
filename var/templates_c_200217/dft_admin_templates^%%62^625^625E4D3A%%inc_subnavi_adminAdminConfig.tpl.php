<?php /* Smarty version 2.6.18, created on 2016-12-13 09:51:07
         compiled from file:E:%5CA_project%5Catoffice/webapp/modules/admin/templates/inc_subnavi_adminAdminConfig.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 't_escape', 'file:E:\\A_project\\atoffice/webapp/modules/admin/templates/inc_subnavi_adminAdminConfig.tpl', 3, false),)), $this); ?>
<div class="subNavi">
<?php echo '<a href="?m='; ?><?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?><?php echo '&amp;a=page_'; ?><?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('edit_admin_password')); ?><?php echo '">パスワード変更</a>&nbsp;|&nbsp;'; ?><?php echo ''; ?>

</div>