<?php /* Smarty version 2.6.18, created on 2016-12-29 08:15:05
         compiled from file:/var/www/html/atoffice/webapp/modules/admin/templates/vessel_list.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'ext_include', 'file:/var/www/html/atoffice/webapp/modules/admin/templates/vessel_list.tpl', 2, false),array('modifier', 't_escape', 'file:/var/www/html/atoffice/webapp/modules/admin/templates/vessel_list.tpl', 22, false),array('modifier', 'nl2br', 'file:/var/www/html/atoffice/webapp/modules/admin/templates/vessel_list.tpl', 75, false),array('modifier', 't_url2cmd', 'file:/var/www/html/atoffice/webapp/modules/admin/templates/vessel_list.tpl', 75, false),array('modifier', 't_cmd', 'file:/var/www/html/atoffice/webapp/modules/admin/templates/vessel_list.tpl', 75, false),array('modifier', 't_decoration', 'file:/var/www/html/atoffice/webapp/modules/admin/templates/vessel_list.tpl', 75, false),)), $this); ?>
<?php echo $this->_tpl_vars['inc_header']; ?>

<?php echo smarty_function_ext_include(array('file' => "inc_subnavi_adminImageKakikomi.tpl"), $this);?>

<?php $this->assign('page_name', "備品一覧"); ?>
<?php echo smarty_function_ext_include(array('file' => "inc_tree_adminImageKakikomi.tpl"), $this);?>

</div>


<?php if ($this->_tpl_vars['atoffice_auth_type'] == 1 || $this->_tpl_vars['atoffice_auth_type'] == 4): ?>

<style type="text/css">
<!--
HR {
	border-style:dotted;color:#3399FF

}
-->
</style>


<h2 id="ttl01">備品一覧【<?php echo smarty_modifier_t_escape($this->_tpl_vars['hall_name']); ?>
】</h2>
<br>
<center>
<?php if ($this->_tpl_vars['msg']): ?><p class="actionMsg"><?php echo smarty_modifier_t_escape($this->_tpl_vars['msg']); ?>
</p><br><br><?php endif; ?>

<br><br>
<form name="add_vessel" method="POST" action="./">
<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
<input type="hidden" name="a" value="page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('add_vessel','page')); ?>
" />
<input type="hidden" name="hall_id" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['hall_id']); ?>
" />
<input type="submit" value="　新規備品登録　">
</form>
<br>
<?php if ($this->_tpl_vars['vessel_list']): ?>

<table border=1>
<tr>
<th bgcolor=#FF9900>備品ID</th>
<th height=30 bgcolor=#FF9900>備品名</th>
<th bgcolor=#FF9900>在庫数</th>
<th bgcolor=#FF9900>利用料金</th>
<th bgcolor=#FF9900>並び順値</th>
<th bgcolor=#FF9900>料金区分</th>
<th bgcolor=#FF9900>状態</th>
<th bgcolor=#FF9900>メモ１</th>
<th bgcolor=#FF9900>メモ２</th>
<th bgcolor=#FF9900>編集</th>
<th bgcolor=#FF9900>削除</th>
</tr>
<?php $_from = $this->_tpl_vars['vessel_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
<tr>
<td align=left <?php if ($this->_tpl_vars['key'] % 2 == 0): ?>bgcolor=#FFD9DC<?php else: ?>bgcolor=#FFFFCC<?php endif; ?>><span style="margin:5px"><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['vessel_id']); ?>
</span></td>
<td align=left <?php if ($this->_tpl_vars['key'] % 2 == 0): ?>bgcolor=#FFD9DC<?php else: ?>bgcolor=#FFFFCC<?php endif; ?>><span style="margin:5px"><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['vessel_name']); ?>
</span></td>
<td align=center <?php if ($this->_tpl_vars['key'] % 2 == 0): ?>bgcolor=#FFD9DC<?php else: ?>bgcolor=#FFFFCC<?php endif; ?>><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['num']); ?>
</td>
<td align=right <?php if ($this->_tpl_vars['key'] % 2 == 0): ?>bgcolor=#FFD9DC<?php else: ?>bgcolor=#FFFFCC<?php endif; ?>><span style="margin:5px"><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['price']); ?>
円</span></td>
<td align=right <?php if ($this->_tpl_vars['key'] % 2 == 0): ?>bgcolor=#FFD9DC<?php else: ?>bgcolor=#FFFFCC<?php endif; ?>><span style="margin:5px"><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['weight']); ?>
</span></td>
<td align=center <?php if ($this->_tpl_vars['key'] % 2 == 0): ?>bgcolor=#FFD9DC<?php else: ?>bgcolor=#FFFFCC<?php endif; ?>>
<?php if ($this->_tpl_vars['item']['charge_devision'] == 1): ?>
<span style="color: #3300FF;"><b>予約毎</b></span>
<?php else: ?>
<span style="color: #009900;"><b>時間毎</b></span>
<?php endif; ?>
</td>
<td align=center <?php if ($this->_tpl_vars['key'] % 2 == 0): ?>bgcolor=#FFD9DC<?php else: ?>bgcolor=#FFFFCC<?php endif; ?>>
<span style="margin:5px">
<?php if ($this->_tpl_vars['item']['flag'] == 1): ?>
<span style="color: #FF0000;"><b>公開</b></span>
<?php else: ?>
非公開
<?php endif; ?>
</span>
</td>
<td align=left <?php if ($this->_tpl_vars['key'] % 2 == 0): ?>bgcolor=#FFD9DC<?php else: ?>bgcolor=#FFFFCC<?php endif; ?>>
<?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['memo1']))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)))) ? $this->_run_mod_handler('t_url2cmd', true, $_tmp, 'diary', smarty_modifier_t_escape($this->_tpl_vars['member']['c_member_id'])) : smarty_modifier_t_url2cmd($_tmp, 'diary', smarty_modifier_t_escape($this->_tpl_vars['member']['c_member_id']))))) ? $this->_run_mod_handler('t_cmd', true, $_tmp, 'diary') : smarty_modifier_t_cmd($_tmp, 'diary')))) ? $this->_run_mod_handler('t_decoration', true, $_tmp) : smarty_modifier_t_decoration($_tmp)); ?>

</td>
<td align=left <?php if ($this->_tpl_vars['key'] % 2 == 0): ?>bgcolor=#FFD9DC<?php else: ?>bgcolor=#FFFFCC<?php endif; ?>>
<?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['memo2']))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)))) ? $this->_run_mod_handler('t_url2cmd', true, $_tmp, 'diary', smarty_modifier_t_escape($this->_tpl_vars['member']['c_member_id'])) : smarty_modifier_t_url2cmd($_tmp, 'diary', smarty_modifier_t_escape($this->_tpl_vars['member']['c_member_id']))))) ? $this->_run_mod_handler('t_cmd', true, $_tmp, 'diary') : smarty_modifier_t_cmd($_tmp, 'diary')))) ? $this->_run_mod_handler('t_decoration', true, $_tmp) : smarty_modifier_t_decoration($_tmp)); ?>

</td>
<td valign=middle <?php if ($this->_tpl_vars['key'] % 2 == 0): ?>bgcolor=#FFD9DC<?php else: ?>bgcolor=#FFFFCC<?php endif; ?>>
<form name="change_vessel" method="POST" action="./">
<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
<input type="hidden" name="a" value="page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('add_vessel','page')); ?>
" />
<input type="hidden" name="hall_id" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['hall_id']); ?>
" />
<input type="hidden" name="vessel_id" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['vessel_id']); ?>
" />
<input type="hidden" name="delete_flag" value="1" />
<input type="submit" value="　編集　">
</form>

</td>
<td valign=middle <?php if ($this->_tpl_vars['key'] % 2 == 0): ?>bgcolor=#FFD9DC<?php else: ?>bgcolor=#FFFFCC<?php endif; ?>>
<form name="delete_vessel" method="POST" action="./">
<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
<input type="hidden" name="a" value="page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('add_vessel','page')); ?>
" />
<input type="hidden" name="hall_id" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['hall_id']); ?>
" />
<input type="hidden" name="vessel_id" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['vessel_id']); ?>
" />
<input type="hidden" name="delete_flag" value="2" />
<input type="submit" value="　削除　">
</form>

</td>
</tr>
<?php endforeach; endif; unset($_from); ?>
</table>

<?php else: ?>
<span style="font-size: 16pt;color: #FF3300;"><b>この会場の備品はまだ登録されていません。<b></span>
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
