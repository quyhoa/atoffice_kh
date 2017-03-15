<?php /* Smarty version 2.6.18, created on 2015-11-27 17:33:36
         compiled from file:/var/www/atoffice/webapp/modules/admin/templates/inc_subnavi_adminImageKakikomi.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 't_escape', 'file:/var/www/atoffice/webapp/modules/admin/templates/inc_subnavi_adminImageKakikomi.tpl', 3, false),)), $this); ?>
<div class="subNavi">
<?php echo '<a href="?m='; ?><?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?><?php echo '&amp;a=page_'; ?><?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('hall_list')); ?><?php echo '">会場一覧表示</a>&nbsp;|&nbsp;<a href="?m='; ?><?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?><?php echo '&amp;a=page_'; ?><?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('add_hall')); ?><?php echo '">新規会場追加</a>&nbsp;|&nbsp;'; ?><?php echo ''; ?>

</div>