<?php /* Smarty version 2.6.18, created on 2017-03-15 10:35:28
         compiled from file:/var/www/html/atoffice/webapp/modules/pc/templates/h_config_prof_confirm.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 't_url', 'file:/var/www/html/atoffice/webapp/modules/pc/templates/h_config_prof_confirm.tpl', 33, false),array('function', 'counter', 'file:/var/www/html/atoffice/webapp/modules/pc/templates/h_config_prof_confirm.tpl', 79, false),array('modifier', 't_escape', 'file:/var/www/html/atoffice/webapp/modules/pc/templates/h_config_prof_confirm.tpl', 33, false),array('modifier', 'nl2br', 'file:/var/www/html/atoffice/webapp/modules/pc/templates/h_config_prof_confirm.tpl', 108, false),array('modifier', 't_url2cmd', 'file:/var/www/html/atoffice/webapp/modules/pc/templates/h_config_prof_confirm.tpl', 108, false),array('modifier', 't_cmd', 'file:/var/www/html/atoffice/webapp/modules/pc/templates/h_config_prof_confirm.tpl', 108, false),array('modifier', 't_implode', 'file:/var/www/html/atoffice/webapp/modules/pc/templates/h_config_prof_confirm.tpl', 110, false),array('block', 't_form_block', 'file:/var/www/html/atoffice/webapp/modules/pc/templates/h_config_prof_confirm.tpl', 139, false),)), $this); ?>
<link href="./atoffice/css/style.css" rel="stylesheet" type="text/css" />

<style type="text/css">
	<!--
table#table-01 {
    width: 880px;
    border: 0px;
    border-collapse: collapse;
    border-spacing: 0;
}

table#table-01 td {
    border: 0px;
    border-width: 0px;
    padding-top: 10px;
    padding-left: 10px;
    vertical-align:top;
    text-align:left;
}

-->
</style>

<div id="container">
<div id="header">
<h1></h1>
</div><!--heaer_end-->
<div id="menu">
<ul>
<li class="home"><a href="http://abc-kaigishitsu.com/">他の会場を探す</a></li>
<li><a href="./?page=reserved_info">会員用予約確認</a></li>
<li>
<a href="<?php echo smarty_function_t_url(array('m' => 'pc','a' => 'do_inc_page_header_logout'), $this);?>
&amp;sessid=<?php echo smarty_modifier_t_escape($this->_tpl_vars['PHPSESSID']); ?>
">
ログアウト
</a></li>
<li><a href="./?page=search">　</a></li>
</ul>
</div><!-- menu end -->


<div id="LayoutC">


<table id="table-01">
<tr>
<td width=20></td>
<td width=610>

<div class="dparts formTable"><div class="parts">
<div class="partsHeading"><h3>登録情報の確認</h3><p>(<strong>※</strong>の項目は必須です)</p></div>
<table>

<?php ob_start(); ?>
<tr>
<th><?php echo smarty_modifier_t_escape($this->_tpl_vars['WORD_NICKNAME']); ?>
 <strong>※</strong></th>
<td style='border: 1px #CDCDCD solid;'><?php echo smarty_modifier_t_escape($this->_tpl_vars['prof']['nickname']); ?>
</td>
</tr>
<?php $this->_smarty_vars['capture']['nick'] = ob_get_contents(); ob_end_clean(); ?>
<?php ob_start(); ?>
<?php $this->_smarty_vars['capture']['birth'] = ob_get_contents(); ob_end_clean(); ?>
<?php $_from = $this->_tpl_vars['profile_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['profile']):
?>
<?php echo ''; ?><?php if (! smarty_modifier_t_escape($this->_tpl_vars['_cnt_nick']) && smarty_modifier_t_escape($this->_tpl_vars['profile']['sort_order']) >= smarty_modifier_t_escape(@SORT_ORDER_NICK) && ! smarty_modifier_t_escape($this->_tpl_vars['_cnt_birth']) && smarty_modifier_t_escape($this->_tpl_vars['profile']['sort_order']) >= smarty_modifier_t_escape(@SORT_ORDER_BIRTH)): ?><?php echo ''; ?><?php echo smarty_function_counter(array('assign' => '_cnt_nick'), $this);?><?php echo ''; ?><?php echo smarty_function_counter(array('assign' => '_cnt_birth'), $this);?><?php echo ''; ?><?php if (@SORT_ORDER_NICK > @SORT_ORDER_BIRTH): ?><?php echo ''; ?><?php echo $this->_smarty_vars['capture']['birth']; ?><?php echo ''; ?><?php echo $this->_smarty_vars['capture']['nick']; ?><?php echo ''; ?><?php else: ?><?php echo ''; ?><?php echo $this->_smarty_vars['capture']['nick']; ?><?php echo ''; ?><?php echo $this->_smarty_vars['capture']['birth']; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php if (! $this->_tpl_vars['_cnt_nick'] && $this->_tpl_vars['profile']['sort_order'] >= @SORT_ORDER_NICK): ?><?php echo ''; ?><?php echo smarty_function_counter(array('assign' => '_cnt_nick'), $this);?><?php echo ''; ?><?php echo $this->_smarty_vars['capture']['nick']; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php if (! $this->_tpl_vars['_cnt_birth'] && $this->_tpl_vars['profile']['sort_order'] >= @SORT_ORDER_BIRTH): ?><?php echo ''; ?><?php echo smarty_function_counter(array('assign' => '_cnt_birth'), $this);?><?php echo ''; ?><?php echo $this->_smarty_vars['capture']['birth']; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?>

<?php if ($this->_tpl_vars['profile']['disp_config']): ?>
<tr>
<th><?php echo smarty_modifier_t_escape($this->_tpl_vars['profile']['caption']); ?>
<?php if ($this->_tpl_vars['profile']['is_required']): ?> <strong>※</strong><?php endif; ?></th>
<td style='border: 1px #CDCDCD solid;'>
<?php if ($this->_tpl_vars['prof']['profile'][$this->_tpl_vars['profile']['name']]['value']): ?>

<?php if ($this->_tpl_vars['profile']['form_type'] == 'textarea'): ?>
    <?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['prof']['profile'][$this->_tpl_vars['profile']['name']]['value']))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)))) ? $this->_run_mod_handler('t_url2cmd', true, $_tmp, 'profile', smarty_modifier_t_escape($this->_tpl_vars['u'])) : smarty_modifier_t_url2cmd($_tmp, 'profile', smarty_modifier_t_escape($this->_tpl_vars['u']))))) ? $this->_run_mod_handler('t_cmd', true, $_tmp, 'profile') : smarty_modifier_t_cmd($_tmp, 'profile')); ?>

<?php elseif ($this->_tpl_vars['profile']['form_type'] == 'checkbox'): ?>
    <?php echo smarty_modifier_t_implode(smarty_modifier_t_escape($this->_tpl_vars['prof']['profile'][$this->_tpl_vars['profile']['name']]['value']), ", "); ?>

<?php else: ?>
    <?php echo smarty_modifier_t_escape($this->_tpl_vars['prof']['profile'][$this->_tpl_vars['profile']['name']]['value']); ?>

<?php endif; ?>



<?php endif; ?>
</td>
</tr>
<?php endif; ?>
<?php endforeach; endif; unset($_from); ?>

<?php if (! $this->_tpl_vars['_cnt_nick'] && ! $this->_tpl_vars['_cnt_birth']): ?>
<?php if (@SORT_ORDER_NICK > @SORT_ORDER_BIRTH): ?>
<?php echo $this->_smarty_vars['capture']['birth']; ?>

<?php echo $this->_smarty_vars['capture']['nick']; ?>

<?php else: ?>
<?php echo $this->_smarty_vars['capture']['nick']; ?>

<?php echo $this->_smarty_vars['capture']['birth']; ?>

<?php endif; ?>
<?php else: ?>
<?php if (! $this->_tpl_vars['_cnt_nick']): ?><?php echo $this->_smarty_vars['capture']['nick']; ?>
<?php endif; ?>
<?php if (! $this->_tpl_vars['_cnt_birth']): ?><?php echo $this->_smarty_vars['capture']['birth']; ?>
<?php endif; ?>
<?php endif; ?>
</table>
<div class="operation">
<ul class="moreInfo button">
<li>
<?php $this->_tag_stack[] = array('t_form_block', array('m' => 'pc','a' => 'do_h_config_prof')); $_block_repeat=true;smarty_block_t_form_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
<input type="hidden" name="mode" value="register" />
<input type="hidden" name="is_search_result" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['prof']['is_search_result']); ?>
" />
<input type="hidden" name="nickname" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['prof']['nickname']); ?>
" />
<input type="hidden" name="birth_year" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['prof']['birth_year']); ?>
" />
<input type="hidden" name="birth_month" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['prof']['birth_month']); ?>
" />
<input type="hidden" name="birth_day" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['prof']['birth_day']); ?>
" />
<input type="hidden" name="public_flag_birth_year" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['prof']['public_flag_birth_year']); ?>
" />
<input type="hidden" name="public_flag_birth_month_day" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['prof']['public_flag_birth_month_day']); ?>
" />
<?php echo ''; ?><?php $_from = $this->_tpl_vars['prof']['profile']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?><?php echo ''; ?><?php if (is_array ( $this->_tpl_vars['item']['c_profile_option_id'] )): ?><?php echo ''; ?><?php $_from = $this->_tpl_vars['item']['c_profile_option_id']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['i']):
?><?php echo ''; ?><?php if ($this->_tpl_vars['i']): ?><?php echo '<input type="hidden" name="profile['; ?><?php echo smarty_modifier_t_escape($this->_tpl_vars['key']); ?><?php echo '][]" value="'; ?><?php echo smarty_modifier_t_escape($this->_tpl_vars['i']); ?><?php echo '" />'; ?><?php endif; ?><?php echo ''; ?><?php endforeach; endif; unset($_from); ?><?php echo ''; ?><?php elseif ($this->_tpl_vars['item']['c_profile_option_id']): ?><?php echo '<input type="hidden" name="profile['; ?><?php echo smarty_modifier_t_escape($this->_tpl_vars['key']); ?><?php echo ']" value="'; ?><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['c_profile_option_id']); ?><?php echo '" />'; ?><?php else: ?><?php echo '<input type="hidden" name="profile['; ?><?php echo smarty_modifier_t_escape($this->_tpl_vars['key']); ?><?php echo ']" value="'; ?><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['value']); ?><?php echo '" />'; ?><?php endif; ?><?php echo '<input type="hidden" name="public_flag['; ?><?php echo smarty_modifier_t_escape($this->_tpl_vars['key']); ?><?php echo ']" value="'; ?><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['public_flag']); ?><?php echo '" />'; ?><?php endforeach; endif; unset($_from); ?><?php echo ''; ?>

<input type="submit" class="input_submit" value="　確　定　" />
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t_form_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
</li>
<li>
<?php $this->_tag_stack[] = array('t_form_block', array('m' => 'pc','a' => 'do_h_config_prof')); $_block_repeat=true;smarty_block_t_form_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
<input type="hidden" name="mode" value="input" />
<input type="hidden" name="is_search_result" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['prof']['is_search_result']); ?>
" />
<input type="hidden" name="nickname" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['prof']['nickname']); ?>
" />
<input type="hidden" name="birth_year" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['prof']['birth_year']); ?>
" />
<input type="hidden" name="birth_month" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['prof']['birth_month']); ?>
" />
<input type="hidden" name="birth_day" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['prof']['birth_day']); ?>
" />
<input type="hidden" name="public_flag_birth_year" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['prof']['public_flag_birth_year']); ?>
" />
<input type="hidden" name="public_flag_birth_month_day" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['prof']['public_flag_birth_month_day']); ?>
" />
<?php echo ''; ?><?php $_from = $this->_tpl_vars['prof']['profile']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?><?php echo ''; ?><?php if (is_array ( $this->_tpl_vars['item']['c_profile_option_id'] )): ?><?php echo ''; ?><?php $_from = $this->_tpl_vars['item']['c_profile_option_id']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['i']):
?><?php echo ''; ?><?php if ($this->_tpl_vars['i']): ?><?php echo '<input type="hidden" name="profile['; ?><?php echo smarty_modifier_t_escape($this->_tpl_vars['key']); ?><?php echo '][]" value="'; ?><?php echo smarty_modifier_t_escape($this->_tpl_vars['i']); ?><?php echo '" />'; ?><?php endif; ?><?php echo ''; ?><?php endforeach; endif; unset($_from); ?><?php echo ''; ?><?php elseif ($this->_tpl_vars['item']['c_profile_option_id']): ?><?php echo '<input type="hidden" name="profile['; ?><?php echo smarty_modifier_t_escape($this->_tpl_vars['key']); ?><?php echo ']" value="'; ?><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['c_profile_option_id']); ?><?php echo '" />'; ?><?php else: ?><?php echo '<input type="hidden" name="profile['; ?><?php echo smarty_modifier_t_escape($this->_tpl_vars['key']); ?><?php echo ']" value="'; ?><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['value']); ?><?php echo '" />'; ?><?php endif; ?><?php echo '<input type="hidden" name="public_flag['; ?><?php echo smarty_modifier_t_escape($this->_tpl_vars['key']); ?><?php echo ']" value="'; ?><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['public_flag']); ?><?php echo '" />'; ?><?php endforeach; endif; unset($_from); ?><?php echo ''; ?>

<input type="submit" class="input_submit" value="　修　正　" />
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t_form_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
</li>
</ul>
</div>
</div></div>

</td><td width=5></td><td>

</td>

</tr>

</table>


</div><!-- LayoutC -->


</div>

<script type="text/javascript" src="./atoffice/js/ajax.js"></script>

<script type="text/javascript">
function PerformInputLink2(){
	LoadHTML('footer', 'sub/footer.html');
}
</script>
<div id="LoadingBar">
	<img border="0" src="./atoffice/img/loading.gif"/>
</div>
<div id="footer">
	<script type="text/javascript">PerformInputLink2();</script>
</div>
