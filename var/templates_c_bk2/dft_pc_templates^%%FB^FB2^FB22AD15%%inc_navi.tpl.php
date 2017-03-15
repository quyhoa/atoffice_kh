<?php /* Smarty version 2.6.18, created on 2016-10-25 19:36:59
         compiled from file:/var/www/atoffice/webapp/modules/pc/templates/inc_navi.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 't_escape', 'file:/var/www/atoffice/webapp/modules/pc/templates/inc_navi.tpl', 6, false),)), $this); ?>
<?php if ($this->_tpl_vars['INC_NAVI_type'] === 'h'): ?>
<div class="parts localNav" id="hLocalNav">
<ul>
<?php $_from = $this->_tpl_vars['navi']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
<?php if ($this->_tpl_vars['item']['url']): ?>
<li id="hLocalNav_<?php echo smarty_modifier_t_escape($this->_tpl_vars['key']+1); ?>
"><a href="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['url']); ?>
"><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['caption']); ?>
</a></li>
<?php endif; ?>
<?php endforeach; endif; unset($_from); ?>
</ul>
</div>
<?php elseif ($this->_tpl_vars['INC_NAVI_type'] === 'f'): ?>
<div class="parts localNav" id="fLocalNav">
<ul>
<?php $_from = $this->_tpl_vars['navi']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
<?php if ($this->_tpl_vars['item']['url']): ?>
<li id="fLocalNav_<?php echo smarty_modifier_t_escape($this->_tpl_vars['key']+1); ?>
"><a href="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['url']); ?>
&amp;target_c_member_id=<?php echo smarty_modifier_t_escape($this->_tpl_vars['INC_NAVI_c_member_id_friend']); ?>
"><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['caption']); ?>
</a></li>
<?php endif; ?>
<?php endforeach; endif; unset($_from); ?>
</ul>
</div>
<?php elseif ($this->_tpl_vars['INC_NAVI_type'] === 'c'): ?>
<div class="parts localNav" id="cLocalNav">
<ul>
<?php $_from = $this->_tpl_vars['navi']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
<?php if ($this->_tpl_vars['item']['url']): ?>
<li id="cLocalNav_<?php echo smarty_modifier_t_escape($this->_tpl_vars['key']+1); ?>
"><a href="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['url']); ?>
&amp;target_c_commu_id=<?php echo smarty_modifier_t_escape($this->_tpl_vars['INC_NAVI_c_commu_id']); ?>
"><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['caption']); ?>
</a></li>
<?php endif; ?>
<?php endforeach; endif; unset($_from); ?>
</ul>
</div>
<?php endif; ?>