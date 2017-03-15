<?php /* Smarty version 2.6.18, created on 2016-10-26 17:29:05
         compiled from file:/var/www/atoffice/webapp/modules/pc/templates/h_config.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 't_url', 'file:/var/www/atoffice/webapp/modules/pc/templates/h_config.tpl', 38, false),array('function', 't_img_url_skin', 'file:/var/www/atoffice/webapp/modules/pc/templates/h_config.tpl', 55, false),array('modifier', 't_escape', 'file:/var/www/atoffice/webapp/modules/pc/templates/h_config.tpl', 38, false),array('block', 't_form_block', 'file:/var/www/atoffice/webapp/modules/pc/templates/h_config.tpl', 74, false),)), $this); ?>
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
<link href="./atoffice/css/highslide.css" rel="stylesheet" type="text/css" />


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
<td style='text-align:left;vertical-align:middle;'>
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
<div class="partsHeading"><h3>PCメールアドレス変更</h3></div>
<?php $this->_tag_stack[] = array('t_form_block', array('m' => 'pc','a' => 'do_h_config_1')); $_block_repeat=true;smarty_block_t_form_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
<table><tr>
<th>メールアドレス</th>
<td style='border: 1px #CDCDCD solid;'>
<input type="text" class="input_text" name="pc_address" value="" size="40" />

</td>
</tr><tr>
<th>メールアドレス確認</th>
<td style='border: 1px #CDCDCD solid;'>
<input type="text" class="input_text" name="pc_address2" value="" size="40" />
</td>
</tr></table>
<div class="operation">
<ul class="moreInfo button">
<li><input type="submit" class="input_submit" value="メールアドレス変更" /></li>
</ul>
</div>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t_form_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
</div></div>

<?php if (@OPENPNE_AUTH_MODE != 'slavepne'): ?>
<div class="dparts formTable"><div class="parts">
<div class="partsHeading"><h3>パスワード変更</h3></div>
<?php $this->_tag_stack[] = array('t_form_block', array('m' => 'pc','a' => 'do_h_config_2')); $_block_repeat=true;smarty_block_t_form_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
<table><tr>
<th>現在のパスワード</th>
<td style='border: 1px #CDCDCD solid;'>
<input type="password" class="input_password" name="old_password" value="" size="40" />
</td>
</tr><tr>
<th>新しいパスワード</th>
<td style='border: 1px #CDCDCD solid;'>
<input type="password" class="input_password" name="new_password" value="" size="40" />
<p class="caution">※パスワードは6～12文字の半角英数で入力してください。</p>
</td>
</tr><tr>
<th>新しいパスワード確認</th>
<td style='border: 1px #CDCDCD solid;'>
<input type="password" class="input_password" name="new_password2" value="" size="40" />
</td>
</tr></table>
<div class="operation">
<ul class="moreInfo button">
<li>
<input type="submit" class="input_submit" value="パスワード変更" /></li>
</ul>
</div>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t_form_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
</div></div>

<div class="dparts formTable"><div class="parts">
<div class="partsHeading"><h3>秘密の質問変更</h3></div>
<?php $this->_tag_stack[] = array('t_form_block', array('m' => 'pc','a' => 'do_h_config_3')); $_block_repeat=true;smarty_block_t_form_block($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
<table>
<tr>
<th>秘密の質問</th>
<td style='border: 1px #CDCDCD solid;'>
<select name="c_password_query_id">
<?php $_from = $this->_tpl_vars['password_query_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
<option value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['key']); ?>
"<?php if ($this->_tpl_vars['c_member']['c_password_query_id'] == $this->_tpl_vars['key']): ?> selected="selected"<?php endif; ?>><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']); ?>
</option>
<?php endforeach; endif; unset($_from); ?>
</select>
</td>
</tr>
<tr>
<th>秘密の質問の答え</th>
<td style='border: 1px #CDCDCD solid;'>
<input type="text" class="input_text" name="c_password_query_answer" value="" size="30" />
</td>
</tr>
</table>
<div class="operation">
<ul class="moreInfo button">
<li><input type="submit" class="input_submit" value="設定変更" /></li>
</ul>
</div>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t_form_block($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
</div></div>


<?php endif; ?>


</td><td width=5></td><td>
<div id="side">
<ul class="category">
<li><a href="./?m=pc&a=page_h_config_prof">アカウント情報変更</a></li>
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



