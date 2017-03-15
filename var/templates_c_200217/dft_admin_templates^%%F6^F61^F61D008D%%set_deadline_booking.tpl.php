<?php /* Smarty version 2.6.18, created on 2016-12-13 09:51:22
         compiled from file:E:%5CA_project%5Catoffice/webapp/modules/admin/templates/set_deadline_booking.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'ext_include', 'file:E:\\A_project\\atoffice/webapp/modules/admin/templates/set_deadline_booking.tpl', 2, false),array('modifier', 't_escape', 'file:E:\\A_project\\atoffice/webapp/modules/admin/templates/set_deadline_booking.tpl', 18, false),)), $this); ?>
<?php echo $this->_tpl_vars['inc_header']; ?>

<?php echo smarty_function_ext_include(array('file' => "inc_subnavi_adminStatisticalInformation.tpl"), $this);?>


<?php $this->assign('page_name', "メール文言変更"); ?>
<?php echo smarty_function_ext_include(array('file' => "inc_tree_adminStatisticalInformation.tpl"), $this);?>

</div>

<?php if ($this->_tpl_vars['atoffice_auth_type'] == 4): ?>

<h2>前日予約分の締切設定</h2>
<div class="contents">
<table class="contents" cellpadding="0" cellspacing="0" border="0">
<tr>
<td class="detail">
<form action="./" method="post">
<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
<input type="hidden" name="a" value="page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('set_deadline_booking','page')); ?>
" />
<input type="hidden" name="sessid" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['PHPSESSID']); ?>
" />
<input type="hidden" name="target" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['requests']['target']); ?>
" />

<dt>
    <strong class="item">前日予約締切時間</strong>
   
    <select name="hour">
        <?php $_from = $this->_tpl_vars['hours']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
            <option value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']); ?>
" <?php if ($this->_tpl_vars['hour'] == $this->_tpl_vars['item']): ?>selected<?php endif; ?>><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']); ?>
 <?php echo '時'; ?>
</option>
        <?php endforeach; endif; unset($_from); ?>
    </select>
    <select name="minute">
        <?php $_from = $this->_tpl_vars['minutes']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
             <option value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']); ?>
" <?php if ($this->_tpl_vars['minute'] == $this->_tpl_vars['item']): ?>selected<?php endif; ?>>
                <?php if ($this->_tpl_vars['item'] < 10): ?><?php echo '0'; ?>
<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']); ?>
 <?php echo '分'; ?>

                <?php else: ?> 
                    <?php echo smarty_modifier_t_escape($this->_tpl_vars['item']); ?>
 <?php echo '分'; ?>

                <?php endif; ?>
                
             </option>
        <?php endforeach; endif; unset($_from); ?>
    </select>
</dt>
    <p class="textBtn">
        <input type="submit" value="設定" onclick="alert('締切時間を設定しました。')">
    </p>
</form>
</td>
</tr>
</table>

<?php else: ?>
<br>
<center>
<span style="font-size: 16px; color: #FF0033;">
    <b>アクセス権がありません。</b>
</span>
</center>
<?php endif; ?>
<div>
<?php echo $this->_tpl_vars['inc_footer']; ?>