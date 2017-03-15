<?php /* Smarty version 2.6.18, created on 2011-05-27 09:39:22
         compiled from file:/var/www/atoffice/webapp/modules/admin/templates/receipt_list.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'ext_include', 'file:/var/www/atoffice/webapp/modules/admin/templates/receipt_list.tpl', 2, false),array('modifier', 't_escape', 'file:/var/www/atoffice/webapp/modules/admin/templates/receipt_list.tpl', 16, false),)), $this); ?>
<?php echo $this->_tpl_vars['inc_header']; ?>

<?php echo smarty_function_ext_include(array('file' => "inc_subnavi_adminStatisticalInformation.tpl"), $this);?>

<?php $this->assign('page_name', "領収書印刷者リスト"); ?>
<?php echo smarty_function_ext_include(array('file' => "inc_tree_adminStatisticalInformation.tpl"), $this);?>

</div>


<?php if ($this->_tpl_vars['atoffice_auth_type'] == 4): ?>

<h2 id="ttl01">領収書印刷者リスト</h2>
<br>
<center>

<?php if ($this->_tpl_vars['msg']): ?><p class="actionMsg"><?php echo smarty_modifier_t_escape($this->_tpl_vars['msg']); ?>
</p><br><br><?php endif; ?>

<form name="search" method="POST" action="./">
<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
<input type="hidden" name="a" value="page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('receipt_list','page')); ?>
" />

<table border=1 width=800>
<tr>
<td colspan=4 bgcolor=#CDCDCD>検索オプション</td>
</tr>
<tr>
<th bgcolor=#FFD9DC>印刷期間（年-月-日）</th>
<td rowspan=2 bgcolor=#FFD9DC>
<input type="submit" value="検索する">
</td>
</tr>
<tr>
<td>
<input type="text" name="begin_date" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['begin_date']); ?>
" size="8"> ～
<input type="text" name="finish_date" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['finish_date']); ?>
" size="8">
</td>
</tr>
</table>

</form>
<br>

<?php if ($this->_tpl_vars['reserve_data']): ?>
<table width=800 border=1>
<tr>
<th bgcolor=#CDCDCD>相手名</th>
<th bgcolor=#CDCDCD>発行日</th>
<th bgcolor=#CDCDCD>ご利用金額</th>
<th bgcolor=#CDCDCD>印紙額</th>
</tr>
<?php $_from = $this->_tpl_vars['reserve_data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
<tr>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['corp']); ?>
</td>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['date']); ?>
</td>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['price']); ?>
円</td>
<td>
<?php if ($this->_tpl_vars['item']['total_price'] < 30000): ?>
0円
<?php elseif ($this->_tpl_vars['item']['total_price'] >= 30000 && $this->_tpl_vars['item']['total_price'] <= 1000000): ?>
200円
<?php elseif ($this->_tpl_vars['item']['total_price'] > 1000000): ?>
400円
<?php endif; ?>
</td>
</tr>
<?php endforeach; endif; unset($_from); ?>

<?php $_from = $this->_tpl_vars['ab_data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
<tr>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['corp']); ?>
</td>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['date']); ?>
</td>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['price']); ?>
円</td>
<td>
<?php if ($this->_tpl_vars['item']['total_price'] < 30000): ?>
0円
<?php elseif ($this->_tpl_vars['item']['total_price'] >= 30000 && $this->_tpl_vars['item']['total_price'] <= 1000000): ?>
200円
<?php elseif ($this->_tpl_vars['item']['total_price'] > 1000000): ?>
400円
<?php endif; ?>
</td>
</tr>
<?php endforeach; endif; unset($_from); ?>

</table>
<?php endif; ?>

</center>
<?php else: ?>
<br>
<center>
<span style="font-size: 16px; color: #FF0033;"><b>アクセス権がありません。</b></span>
</center>
<?php endif; ?>
<div>
<?php echo $this->_tpl_vars['inc_footer']; ?>
