<?php /* Smarty version 2.6.18, created on 2017-02-20 01:45:50
         compiled from file:/var/www/html/atoffice/webapp/modules/admin/templates/find_c_member.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'ext_include', 'file:/var/www/html/atoffice/webapp/modules/admin/templates/find_c_member.tpl', 3, false),array('function', 'counter', 'file:/var/www/html/atoffice/webapp/modules/admin/templates/find_c_member.tpl', 87, false),array('modifier', 't_escape', 'file:/var/www/html/atoffice/webapp/modules/admin/templates/find_c_member.tpl', 10, false),array('modifier', 'default', 'file:/var/www/html/atoffice/webapp/modules/admin/templates/find_c_member.tpl', 89, false),array('block', 't_form_block', 'file:/var/www/html/atoffice/webapp/modules/admin/templates/find_c_member.tpl', 15, false),)), $this); ?>
<?php echo $this->_tpl_vars['inc_header']; ?>


<?php echo smarty_function_ext_include(array('file' => "inc_subnavi_adminSiteMember.tpl"), $this);?>

<?php $this->assign('page_name', "メンバー検索"); ?>
<?php echo smarty_function_ext_include(array('file' => "inc_tree_adminSiteMember.tpl"), $this);?>

</div>


<?php if ($this->_tpl_vars['msg']): ?><p class="actionMsg"><?php echo smarty_modifier_t_escape($this->_tpl_vars['msg']); ?>
</p><?php endif; ?>
<h2 id="ttl01">メンバー検索</h2>
<div class="contents">

<div class="find_item">
<?php $this->_tag_stack[] = array('t_form_block', array('_method' => 'get','m' => smarty_modifier_t_escape($this->_tpl_vars['module_name']))); $_block_repeat=true;smarty_block_t_form_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
<input type="hidden" name="a" value="page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('list_c_member','page')); ?>
" />

<table class="basicType2">
<tr>
<th>ID（完全一致）</th>
<td>
<input type="text" class="input_text" name="id" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['cond_list']['id']); ?>
" size="10" />
</td>
</tr>
<?php if (@OPENPNE_AUTH_MODE != 'email'): ?>
<tr>
<th>ログインID（完全一致）</th>
<td>
<input type="text" class="input_text" name="username" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['cond_list']['username']); ?>
" size="50" />
</td>
</tr>
<?php endif; ?>
<tr>
<th><?php echo smarty_modifier_t_escape($this->_tpl_vars['WORD_NICKNAME']); ?>
</th>
<td>
<input type="text" class="input_text" name="nickname" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['cond_list']['nickname']); ?>
" size="50" />
</td>

</tr>
<tr>
<th>最終ログイン</th>
<td>
<select class="basic" name="last_login">
<option value="">指定しない</option>
<?php $_from = $this->_tpl_vars['select_last_login']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
<option <?php if ($this->_tpl_vars['cond_list']['last_login'] == $this->_tpl_vars['key']): ?>selected<?php endif; ?> value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['key']); ?>
"><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']); ?>
</option>
<?php endforeach; endif; unset($_from); ?>
</select>
</td>
</tr>

<tr>
<th>生年月日</th>
<td>
<select class="basic" name="s_year">
<option value="">指定しない</option>
<?php $_from = $this->_tpl_vars['years']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<option <?php if ($this->_tpl_vars['cond_list']['s_year'] == $this->_tpl_vars['item']): ?>selected<?php endif; ?> value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']); ?>
"><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']); ?>
</option>
<?php endforeach; endif; unset($_from); ?>
</select>
年～
<select class="basic" name="e_year">
<option value="">指定しない</option>
<?php $_from = $this->_tpl_vars['years']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<option <?php if ($this->_tpl_vars['cond_list']['e_year'] == $this->_tpl_vars['item']): ?>selected<?php endif; ?> value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']); ?>
"><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']); ?>
</option>
<?php endforeach; endif; unset($_from); ?>
</select>
年
</td>
</tr>

<?php $_from = $this->_tpl_vars['profile_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['profile']):
?>
<tr>
<th><?php echo smarty_modifier_t_escape($this->_tpl_vars['profile']['caption']); ?>
</th>
<td>
<?php echo ''; ?><?php if ($this->_tpl_vars['profile']['form_type'] == 'select' || $this->_tpl_vars['profile']['form_type'] == 'radio'): ?><?php echo '<select name="profile['; ?><?php echo smarty_modifier_t_escape($this->_tpl_vars['profile']['name']); ?><?php echo ']")><option value="0" selected="selected">指定しない</option>'; ?><?php $_from = $this->_tpl_vars['profile_list'][$this->_tpl_vars['profile']['name']]['options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?><?php echo '<option value="'; ?><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['c_profile_option_id']); ?><?php echo '" '; ?><?php if ($this->_tpl_vars['cond_list']['profile'][$this->_tpl_vars['profile']['name']] == $this->_tpl_vars['item']['c_profile_option_id']): ?><?php echo 'selected="selected"'; ?><?php endif; ?><?php echo '>'; ?><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['value']); ?><?php echo '</option>'; ?><?php endforeach; endif; unset($_from); ?><?php echo '</select>'; ?><?php elseif ($this->_tpl_vars['profile']['form_type'] == 'checkbox'): ?><?php echo '<div class="checkList">'; ?><?php $_from = $this->_tpl_vars['profile']['options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['check'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['check']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['item']):
        $this->_foreach['check']['iteration']++;
?><?php echo ''; ?><?php echo smarty_function_counter(array('name' => smarty_modifier_t_escape($this->_tpl_vars['profile']['name']),'assign' => '_cnt'), $this);?><?php echo ''; ?><?php if ($this->_tpl_vars['_cnt'] % 3 == 1): ?><?php echo '<ul>'; ?><?php endif; ?><?php echo '<li><input type="checkbox" class="input_checkbox" name="profile['; ?><?php echo smarty_modifier_t_escape($this->_tpl_vars['profile']['name']); ?><?php echo '][]" id="profile-'; ?><?php echo smarty_modifier_t_escape($this->_tpl_vars['profile']['name']); ?><?php echo '-'; ?><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['c_profile_option_id']); ?><?php echo '" value="'; ?><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['c_profile_option_id']); ?><?php echo '" '; ?><?php if (in_array ( $this->_tpl_vars['item']['c_profile_option_id'] , ( array ) $this->_tpl_vars['cond_list']['profile'][$this->_tpl_vars['profile']['name']] )): ?><?php echo 'checked="checked"'; ?><?php endif; ?><?php echo ' /><label for="profile-'; ?><?php echo smarty_modifier_t_escape($this->_tpl_vars['profile']['name']); ?><?php echo '-'; ?><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['c_profile_option_id']); ?><?php echo '">'; ?><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['value']))) ? $this->_run_mod_handler('default', true, $_tmp, "--") : smarty_modifier_default($_tmp, "--")); ?><?php echo '</label></li>'; ?><?php if ($this->_tpl_vars['_cnt'] % 3 == 0): ?><?php echo '</ul>'; ?><?php endif; ?><?php echo ''; ?><?php endforeach; endif; unset($_from); ?><?php echo '</div>'; ?><?php elseif ($this->_tpl_vars['profile']['form_type'] == 'text' || $this->_tpl_vars['profile']['form_type'] == 'textlong' || $this->_tpl_vars['profile']['form_type'] == 'textarea'): ?><?php echo '<input type="text" class="input_text" name="profile['; ?><?php echo smarty_modifier_t_escape($this->_tpl_vars['profile']['name']); ?><?php echo ']" value="'; ?><?php echo smarty_modifier_t_escape($this->_tpl_vars['cond_list']['profile'][$this->_tpl_vars['profile']['name']]); ?><?php echo '" size="50" />'; ?><?php endif; ?><?php echo ''; ?>

</td>
</tr>
<?php endforeach; endif; unset($_from); ?>

<tr>
<th>メールアドレス（完全一致）</th>
<td>
<input type="text" class="input_text" name="mail_address" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['cond_list']['mail_address']); ?>
" size="50" />
</td>
</tr>

<tr>
<th>PCメールアドレス</th>
<td>
<select class="basic" name="is_pc_address">
<option value="">指定しない</option>
<option value="1"<?php if ($this->_tpl_vars['cond_list']['is_pc_address'] == 1): ?> selected="selected"<?php endif; ?>>登録している</option>
<option value="2"<?php if ($this->_tpl_vars['cond_list']['is_pc_address'] == 2): ?> selected="selected"<?php endif; ?>>登録していない</option>
</select>
</td>
</tr>

<tr>
<th>携帯メールアドレス</th>
<td>
<select class="basic" name="is_ktai_address">
<option value="">指定しない</option>
<option value="1"<?php if ($this->_tpl_vars['cond_list']['is_ktai_address'] == 1): ?> selected="selected"<?php endif; ?>>登録している</option>
<option value="2"<?php if ($this->_tpl_vars['cond_list']['is_ktai_address'] == 2): ?> selected="selected"<?php endif; ?>>登録していない</option>
</select>
</td>
</tr>

<?php if (@OPENPNE_USE_POINT_RANK): ?>
<tr>
<th>ポイントランク</th>
<td>
<select class="basic" name="s_rank">
<option value="">指定しない</option>
<?php $_from = $this->_tpl_vars['rank_data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<option<?php if ($this->_tpl_vars['cond_list']['s_rank'] == $this->_tpl_vars['item']['c_rank_id']): ?> selected<?php endif; ?> value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['c_rank_id']); ?>
"><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['name']); ?>
</option>
<?php endforeach; endif; unset($_from); ?>
</select>
～
<select class="basic" name="e_rank">
<option value="">指定しない</option>
<?php $_from = $this->_tpl_vars['rank_data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<option<?php if ($this->_tpl_vars['cond_list']['e_rank'] == $this->_tpl_vars['item']['c_rank_id']): ?> selected<?php endif; ?> value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['c_rank_id']); ?>
"><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['name']); ?>
</option>
<?php endforeach; endif; unset($_from); ?>
</select>
</td>
</tr>
<?php endif; ?>

</table>

<p class="textBtn">
<input type="submit" class="input_submit" value="検索" style="width: 100px" />
</p>

<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t_form_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
</div>

<?php echo $this->_tpl_vars['inc_footer']; ?>
