<?php /* Smarty version 2.6.18, created on 2016-11-16 11:47:27
         compiled from file:/var/www/atoffice/webapp/modules/admin/templates/consumption_tax_rate.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'ext_include', 'file:/var/www/atoffice/webapp/modules/admin/templates/consumption_tax_rate.tpl', 2, false),array('modifier', 't_escape', 'file:/var/www/atoffice/webapp/modules/admin/templates/consumption_tax_rate.tpl', 15, false),)), $this); ?>
<?php echo $this->_tpl_vars['inc_header']; ?>

<?php echo smarty_function_ext_include(array('file' => "inc_subnavi_adminStatisticalInformation.tpl"), $this);?>

<?php $this->assign('page_name', "バーチャル口座設定"); ?>
<?php echo smarty_function_ext_include(array('file' => "inc_tree_adminStatisticalInformation.tpl"), $this);?>

</div>


<?php if ($this->_tpl_vars['atoffice_auth_type'] == 4): ?>

<h2 id="ttl01">消費税率設定</h2>
<br>
<center>
<?php if ($this->_tpl_vars['msg']): ?><p class="actionMsg"><?php echo smarty_modifier_t_escape($this->_tpl_vars['msg']); ?>
</p><br><br><?php endif; ?>

<form name="approval" method="POST" action="./">
<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
<input type="hidden" name="a" value="do_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('consumption_tax_rate','do')); ?>
" />
<input type="hidden" name="sessid" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['PHPSESSID']); ?>
" />

<!-- 2013.12.18 消費税率改定対応 begin -->

<table border=1>
	<tr align=center>
		<th>消費税率</th>
		<th>適用開始日</th>
	</tr>

<?php unset($this->_sections['row']);
$this->_sections['row']['name'] = 'row';
$this->_sections['row']['start'] = (int)0;
$this->_sections['row']['loop'] = is_array($_loop=smarty_modifier_t_escape($this->_tpl_vars['rows'])) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['row']['step'] = ((int)1) == 0 ? 1 : (int)1;
$this->_sections['row']['show'] = true;
$this->_sections['row']['max'] = $this->_sections['row']['loop'];
if ($this->_sections['row']['start'] < 0)
    $this->_sections['row']['start'] = max($this->_sections['row']['step'] > 0 ? 0 : -1, $this->_sections['row']['loop'] + $this->_sections['row']['start']);
else
    $this->_sections['row']['start'] = min($this->_sections['row']['start'], $this->_sections['row']['step'] > 0 ? $this->_sections['row']['loop'] : $this->_sections['row']['loop']-1);
if ($this->_sections['row']['show']) {
    $this->_sections['row']['total'] = min(ceil(($this->_sections['row']['step'] > 0 ? $this->_sections['row']['loop'] - $this->_sections['row']['start'] : $this->_sections['row']['start']+1)/abs($this->_sections['row']['step'])), $this->_sections['row']['max']);
    if ($this->_sections['row']['total'] == 0)
        $this->_sections['row']['show'] = false;
} else
    $this->_sections['row']['total'] = 0;
if ($this->_sections['row']['show']):

            for ($this->_sections['row']['index'] = $this->_sections['row']['start'], $this->_sections['row']['iteration'] = 1;
                 $this->_sections['row']['iteration'] <= $this->_sections['row']['total'];
                 $this->_sections['row']['index'] += $this->_sections['row']['step'], $this->_sections['row']['iteration']++):
$this->_sections['row']['rownum'] = $this->_sections['row']['iteration'];
$this->_sections['row']['index_prev'] = $this->_sections['row']['index'] - $this->_sections['row']['step'];
$this->_sections['row']['index_next'] = $this->_sections['row']['index'] + $this->_sections['row']['step'];
$this->_sections['row']['first']      = ($this->_sections['row']['iteration'] == 1);
$this->_sections['row']['last']       = ($this->_sections['row']['iteration'] == $this->_sections['row']['total']);
?>
 	<tr>
		<td>
			<input type="text" name="rate<?php echo smarty_modifier_t_escape($this->_sections['row']['index']); ?>
"
				value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['rate'][$this->_sections['row']['index']]); ?>
"
				size=4 style='text-align:right;border-style:none;'>
			%&nbsp;
		</td>
		<td>
			<input type="text" name="stadate<?php echo smarty_modifier_t_escape($this->_sections['row']['index']); ?>
"
				value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['stadate'][$this->_sections['row']['index']]); ?>
"
				size=12 style='text-align:center;border-style:none;'>
		</td>
	</tr>
<?php endfor; endif; ?>

</table>

<input type="hidden" name="rows" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['rows']); ?>
">

<br>

<input type="submit" value="　　決　定　　">

<br>
<br>
消費税率を空白にした行は削除されます。
<br>

<!-- 2013.12.18 消費税率改定対応 end -->

</form>

</center>
<?php else: ?>
<br>
<center>
<span style="font-size: 16px; color: #FF0033;"><b>アクセス権がありません。</b></span>
</center>
<?php endif; ?>
<div>
<?php echo $this->_tpl_vars['inc_footer']; ?>
