<?php /* Smarty version 2.6.18, created on 2017-03-02 18:59:35
         compiled from file:/var/www/html/atoffice/webapp/modules/admin/templates/hall_status.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'ext_include', 'file:/var/www/html/atoffice/webapp/modules/admin/templates/hall_status.tpl', 2, false),array('modifier', 't_escape', 'file:/var/www/html/atoffice/webapp/modules/admin/templates/hall_status.tpl', 25, false),)), $this); ?>
<?php echo $this->_tpl_vars['inc_header']; ?>

<?php echo smarty_function_ext_include(array('file' => "inc_subnavi_adminImageKakikomi.tpl"), $this);?>


<?php $this->assign('page_name', "運営状態変更"); ?>


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


<h2 id="ttl01">運営状態変更【<?php echo smarty_modifier_t_escape($this->_tpl_vars['hall_data']['hall_name']); ?>
】</h2>

<br>
<center>
<?php if ($this->_tpl_vars['msg']): ?><p class="actionMsg"><?php echo smarty_modifier_t_escape($this->_tpl_vars['msg']); ?>
</p><?php endif; ?>
<br><br>
※　以下の状態を満たしていないと、メンテナンス中・停止中から運営状態は変更できません。<br>
(運営中からは、メンテナンス中や停止中へ変更することはできます。)

<table border=1>
<tr>
<td align=left>
<span style="margin:5px">有効になっている部屋が1つ以上あるか</span>
</td>
<td>
<?php if ($this->_tpl_vars['room_flag_check']): ?>
<span style="margin:5px">○</span>
<?php else: ?>
<span style="margin:5px">×</span>
<?php endif; ?>
</td>
</tr>
<tr>
<td align=left>
<span style="margin:5px">画像１（会場外観）が登録されているか</span>
</td>
<td>
<?php if ($this->_tpl_vars['image1_check']): ?>
<span style="margin:5px">○</span>
<?php else: ?>
<span style="margin:5px">×</span>
<?php endif; ?>
</td>
</tr>
<tr>
<td align=left>
<span style="margin:5px">画像２（地図）が登録されているか</span>
</td>
<td>
<?php if ($this->_tpl_vars['image2_check']): ?>
<span style="margin:5px">○</span>
<?php else: ?>
<span style="margin:5px">×</span>
<?php endif; ?>
</td>
</tr>
<tr>
<td align=left>
<span style="margin:5px">指定口座の場合、口座設定をしてあるか（バーチャルの場合は○）</span>
</td>
<td>
<?php if ($this->_tpl_vars['bank_check']): ?>
<span style="margin:5px">○</span>
<?php else: ?>
<span style="margin:5px">×</span>
<?php endif; ?>
</td>
</tr>
<tr>
<td align=left>
<span style="margin:5px">会場の利用規約が入力されているか</span>
</td>
<td>
<?php if ($this->_tpl_vars['hall_data']['agreement']): ?>
<span style="margin:5px">○</span>
<?php else: ?>
<span style="margin:5px">×</span>
<?php endif; ?>
</td>
</tr>
</table>
<br><br>
<?php if (! $this->_tpl_vars['error'] || $this->_tpl_vars['hall_data']['flag'] == 0): ?>
<form name="add<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['num']); ?>
" action="./" method="post" enctype="multipart/form-data" >
<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
<input type="hidden" name="a" value="do_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('hall_status_change','do')); ?>
" />
<input type="hidden" name="sessid" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['PHPSESSID']); ?>
" />
<input type="hidden" name="delete_flag" value="0">
<input type="hidden" name="hall_id" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['hall_id']); ?>
">
<table>
<tr>
<td bgcolor=#FFDDCC width=400 height=30>
<input type="radio" name="flag" value="0" <?php if ($this->_tpl_vars['hall_data']['flag'] == 0): ?>checked<?php endif; ?>> 運営中　
<input type="radio" name="flag" value="1" <?php if ($this->_tpl_vars['hall_data']['flag'] == 1): ?>checked<?php endif; ?>> メンテナンス中　
<input type="radio" name="flag" value="2" <?php if ($this->_tpl_vars['hall_data']['flag'] == 2): ?>checked<?php endif; ?>> 停止中　
</td>
</tr>
<tr>
<td>
<input type="submit" value="　変　更　">
</td>
</tr>
</table>
</form>
<br>
<table border=3>
<tr>
<td align=left bgcolor="#66CC33">
<span style="margin:5px;"><b>運営中</b></span>
</td>
<td align=left><span style="margin:5px;">利用者から予約ができる状態です。</span></td>
</tr>
<tr>
<td align=left bgcolor="#FFCC66">
<span style="margin:5px;"><b>メンテナンス中</b></span>
</td>
<td align=left><span style="margin:5px;">利用者から会場の情報は見れますが、予約のできない状態です。</span></td>
</tr>
<tr>
<td align=left bgcolor="#FF3300">
<span style="margin:5px;"><b>停止中</b></span>
</td>
<td align=left><span style="margin:5px;">利用者からは会場の情報が見えない状態です。</span></td>
</tr>
</table>
<br>
<span style="font-size: 10pt;color: #FF3300;">※　運営状態を変更しても、既に受注した仮予約は消えません。</span>

<?php else: ?>
<span style="font-size: 16pt;color: #FF3300;"><b>条件を満たしていないため、運営状態を変更できません。</b></span>
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
