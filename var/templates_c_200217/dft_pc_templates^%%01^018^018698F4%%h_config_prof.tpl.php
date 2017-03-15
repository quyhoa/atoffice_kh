<?php /* Smarty version 2.6.18, created on 2016-12-23 02:21:59
         compiled from file:E:%5CA_project%5Catoffice/webapp/modules/pc/templates/h_config_prof.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 't_url', 'file:E:\\A_project\\atoffice/webapp/modules/pc/templates/h_config_prof.tpl', 38, false),array('function', 't_img_url_skin', 'file:E:\\A_project\\atoffice/webapp/modules/pc/templates/h_config_prof.tpl', 55, false),array('function', 'counter', 'file:E:\\A_project\\atoffice/webapp/modules/pc/templates/h_config_prof.tpl', 131, false),array('modifier', 't_escape', 'file:E:\\A_project\\atoffice/webapp/modules/pc/templates/h_config_prof.tpl', 38, false),array('modifier', 'default', 'file:E:\\A_project\\atoffice/webapp/modules/pc/templates/h_config_prof.tpl', 170, false),array('block', 't_form_block', 'file:E:\\A_project\\atoffice/webapp/modules/pc/templates/h_config_prof.tpl', 74, false),)), $this); ?>
<div id="LayoutC">


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

<link href="./atoffice/css/style.css" rel="stylesheet" type="text/css" />

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

<table id="table-01">
<tr>
<td width=20></td>
<td width=610>

<?php if (! $this->_tpl_vars['no_use_alert'] && ( $this->_tpl_vars['msg'] || $this->_tpl_vars['msg1'] || $this->_tpl_vars['msg2'] || $this->_tpl_vars['msg3'] || $this->_tpl_vars['err_msg'] )): ?>
<div class="dparts alertBox"><div class="parts">
<table><tr>
<th><img src="<?php echo smarty_function_t_img_url_skin(array('filename' => 'icon_alert_l'), $this);?>
" alt="警告" /></th>
<td style='text-align:center;vertical-align:middle;'>
<?php if ($this->_tpl_vars['msg']): ?><?php echo smarty_modifier_t_escape($this->_tpl_vars['msg']); ?>
<br /><?php endif; ?>
<?php if ($this->_tpl_vars['msg1']): ?><?php echo smarty_modifier_t_escape($this->_tpl_vars['msg1']); ?>
<br /><?php endif; ?>
<?php if ($this->_tpl_vars['msg2']): ?><?php echo smarty_modifier_t_escape($this->_tpl_vars['msg2']); ?>
<br /><?php endif; ?>
<?php if ($this->_tpl_vars['msg3']): ?><?php echo smarty_modifier_t_escape($this->_tpl_vars['msg3']); ?>
<br /><?php endif; ?>
<?php $_from = $this->_tpl_vars['err_msg']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']); ?>
<br />
<?php endforeach; endif; unset($_from); ?>
</td>
</tr></table>
</div></div>
<?php endif; ?>


<div class="dparts formTable"><div class="parts">
<div class="partsHeading"><div class="text"><h3>登録情報の変更</h3><p>(<strong>※</strong>の項目は必須です)</p></div><?php if ($this->_tpl_vars['SSL_SELECT_URL']): ?><p class="link"><a href="<?php echo smarty_modifier_t_escape($this->_tpl_vars['SSL_SELECT_URL']); ?>
"><?php if ($this->_tpl_vars['HTTPS']): ?>標準(http)<?php else: ?>SSL(https)<?php endif; ?>はこちら</a></p><?php endif; ?></div>

<?php $this->_tag_stack[] = array('t_form_block', array('m' => 'pc','a' => 'do_h_config_prof')); $_block_repeat=true;smarty_block_t_form_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>

<table>

<input type="hidden" id="is_search_result_1" class="input_radio" name="is_search_result" value="0">

<?php ob_start(); ?>
<tr>
<th><?php echo smarty_modifier_t_escape($this->_tpl_vars['WORD_NICKNAME']); ?>
 <strong>※</strong></th>
<td style='border: 1px #CDCDCD solid;'><input type="text" class="input_text" name="nickname" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['c_member']['nickname']); ?>
" size="30" /></td>
</tr>
<?php $this->_smarty_vars['capture']['nick'] = ob_get_contents(); ob_end_clean(); ?>
<?php ob_start(); ?>
<input type="hidden" name="birth_year" value="2000">
<input type="hidden" name="birth_month" value="1">
<input type="hidden" name="birth_day" value="1">
<input type="hidden" name="public_flag_birth_year" value="private">
<input type="hidden" name="public_flag_birth_month_day" value="private">
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
<?php if ($this->_tpl_vars['profile']['public_flag_edit']): ?><table><tr><td><?php endif; ?>

<?php echo ''; ?><?php if ($this->_tpl_vars['profile']['form_type'] == 'text'): ?><?php echo '<input type="text" class="input_text" name="profile['; ?><?php echo smarty_modifier_t_escape($this->_tpl_vars['profile']['name']); ?><?php echo ']" value="'; ?><?php echo smarty_modifier_t_escape($this->_tpl_vars['c_member']['profile'][$this->_tpl_vars['profile']['name']]['value']); ?><?php echo '" size="30" />'; ?><?php elseif ($this->_tpl_vars['profile']['form_type'] == 'textlong'): ?><?php echo '<input type="text" class="input_text input_text_long" name="profile['; ?><?php echo smarty_modifier_t_escape($this->_tpl_vars['profile']['name']); ?><?php echo ']" value="'; ?><?php echo smarty_modifier_t_escape($this->_tpl_vars['c_member']['profile'][$this->_tpl_vars['profile']['name']]['value']); ?><?php echo '" size="60" />'; ?><?php elseif ($this->_tpl_vars['profile']['form_type'] == 'textarea'): ?><?php echo '<textarea name="profile['; ?><?php echo smarty_modifier_t_escape($this->_tpl_vars['profile']['name']); ?><?php echo ']" rows="6" cols="50">'; ?><?php echo smarty_modifier_t_escape($this->_tpl_vars['c_member']['profile'][$this->_tpl_vars['profile']['name']]['value']); ?><?php echo '</textarea>'; ?><?php elseif ($this->_tpl_vars['profile']['form_type'] == 'select'): ?><?php echo '<select name="profile['; ?><?php echo smarty_modifier_t_escape($this->_tpl_vars['profile']['name']); ?><?php echo ']"><option value="">選択してください</option>'; ?><?php $_from = $this->_tpl_vars['profile']['options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?><?php echo '<option value="'; ?><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['c_profile_option_id']); ?><?php echo '"'; ?><?php if ($this->_tpl_vars['c_member']['profile'][$this->_tpl_vars['profile']['name']]['value'] == $this->_tpl_vars['item']['value']): ?><?php echo ' selected="selected"'; ?><?php endif; ?><?php echo '>'; ?><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['value']))) ? $this->_run_mod_handler('default', true, $_tmp, "--") : smarty_modifier_default($_tmp, "--")); ?><?php echo '</option>'; ?><?php endforeach; endif; unset($_from); ?><?php echo '</select>'; ?><?php elseif ($this->_tpl_vars['profile']['form_type'] == 'radio'): ?><?php echo '<div class="checkList">'; ?><?php $_from = $this->_tpl_vars['profile']['options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?><?php echo ''; ?><?php echo smarty_function_counter(array('name' => smarty_modifier_t_escape($this->_tpl_vars['profile']['name']),'assign' => '_cnt'), $this);?><?php echo ''; ?><?php if ($this->_tpl_vars['_cnt'] % 3 == 1): ?><?php echo '<ul>'; ?><?php endif; ?><?php echo '<li><div class="item"><input type="radio" class="input_radio" name="profile['; ?><?php echo smarty_modifier_t_escape($this->_tpl_vars['profile']['name']); ?><?php echo ']" id="profile-'; ?><?php echo smarty_modifier_t_escape($this->_tpl_vars['profile']['name']); ?><?php echo '-'; ?><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['c_profile_option_id']); ?><?php echo '" value="'; ?><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['c_profile_option_id']); ?><?php echo '"'; ?><?php if ($this->_tpl_vars['c_member']['profile'][$this->_tpl_vars['profile']['name']]['value'] == $this->_tpl_vars['item']['value']): ?><?php echo ' checked="checked"'; ?><?php endif; ?><?php echo ' /><label for="profile-'; ?><?php echo smarty_modifier_t_escape($this->_tpl_vars['profile']['name']); ?><?php echo '-'; ?><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['c_profile_option_id']); ?><?php echo '">'; ?><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['value']))) ? $this->_run_mod_handler('default', true, $_tmp, "--") : smarty_modifier_default($_tmp, "--")); ?><?php echo '</label></div></li>'; ?><?php if ($this->_tpl_vars['_cnt'] % 3 == 0): ?><?php echo '</ul>'; ?><?php endif; ?><?php echo ''; ?><?php endforeach; endif; unset($_from); ?><?php echo ''; ?><?php if ($this->_tpl_vars['_cnt'] % 3 != 0): ?><?php echo '</ul>'; ?><?php endif; ?><?php echo '</div>'; ?><?php elseif ($this->_tpl_vars['profile']['form_type'] == 'checkbox'): ?><?php echo '<div class="checkList">'; ?><?php $_from = $this->_tpl_vars['profile']['options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['check'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['check']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['item']):
        $this->_foreach['check']['iteration']++;
?><?php echo ''; ?><?php echo smarty_function_counter(array('name' => smarty_modifier_t_escape($this->_tpl_vars['profile']['name']),'assign' => '_cnt'), $this);?><?php echo ''; ?><?php if ($this->_tpl_vars['_cnt'] % 3 == 1): ?><?php echo '<ul>'; ?><?php endif; ?><?php echo '<li><div class="item"><input type="checkbox" class="input_checkbox" name="profile['; ?><?php echo smarty_modifier_t_escape($this->_tpl_vars['profile']['name']); ?><?php echo '][]" id="profile-'; ?><?php echo smarty_modifier_t_escape($this->_tpl_vars['profile']['name']); ?><?php echo '-'; ?><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['c_profile_option_id']); ?><?php echo '" value="'; ?><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['c_profile_option_id']); ?><?php echo '"'; ?><?php if ($this->_tpl_vars['c_member']['profile'][$this->_tpl_vars['profile']['name']]['value'] && in_array ( $this->_tpl_vars['item']['value'] , $this->_tpl_vars['c_member']['profile'][$this->_tpl_vars['profile']['name']]['value'] )): ?><?php echo ' checked="checked"'; ?><?php endif; ?><?php echo ' /><label for="profile-'; ?><?php echo smarty_modifier_t_escape($this->_tpl_vars['profile']['name']); ?><?php echo '-'; ?><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['c_profile_option_id']); ?><?php echo '">'; ?><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['value']))) ? $this->_run_mod_handler('default', true, $_tmp, "--") : smarty_modifier_default($_tmp, "--")); ?><?php echo '</label></div></li>'; ?><?php if ($this->_tpl_vars['_cnt'] % 3 == 0): ?><?php echo '</ul>'; ?><?php endif; ?><?php echo ''; ?><?php endforeach; endif; unset($_from); ?><?php echo ''; ?><?php if ($this->_tpl_vars['_cnt'] % 3 != 0): ?><?php echo '</ul>'; ?><?php endif; ?><?php echo '</div>'; ?><?php endif; ?><?php echo ''; ?>


<?php if ($this->_tpl_vars['profile']['info']): ?><p class="caution"><?php echo smarty_modifier_t_escape($this->_tpl_vars['profile']['info']); ?>
</p><?php endif; ?>

<?php if ($this->_tpl_vars['profile']['public_flag_edit']): ?>
</td><td class="publicSelector">
<?php if ($this->_tpl_vars['c_member']['profile'][$this->_tpl_vars['profile']['name']]['public_flag']): ?>
<?php $this->assign('pflag', smarty_modifier_t_escape($this->_tpl_vars['c_member']['profile'][$this->_tpl_vars['profile']['name']]['public_flag'])); ?>
<?php else: ?>
<?php $this->assign('pflag', smarty_modifier_t_escape($this->_tpl_vars['profile']['public_flag_default'])); ?>
<?php endif; ?>
<select name="public_flag[<?php echo smarty_modifier_t_escape($this->_tpl_vars['profile']['name']); ?>
]">
<?php $_from = $this->_tpl_vars['public_flags']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
<option value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['key']); ?>
"<?php if ($this->_tpl_vars['pflag'] == $this->_tpl_vars['key']): ?> selected="selected"<?php endif; ?>><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']); ?>
</option>
<?php endforeach; endif; unset($_from); ?>
</select>
</td></tr></table>
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
<li><input type="submit" class="input_submit" value="確認画面" /></li>
</ul>
</div>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t_form_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
</div></div>


</td><td width=5></td><td>
<div id="side">
<ul class="category">
<li><a href="./?m=pc&a=page_h_config">メールアドレス・パスワード変更</a></li>
</ul>
</div>
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

