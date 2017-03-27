<?php /* Smarty version 2.6.18, created on 2017-03-02 19:28:38
         compiled from file:/var/www/html/atoffice/webapp/modules/admin/templates/edit_c_admin_info.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'ext_include', 'file:/var/www/html/atoffice/webapp/modules/admin/templates/edit_c_admin_info.tpl', 2, false),array('modifier', 't_escape', 'file:/var/www/html/atoffice/webapp/modules/admin/templates/edit_c_admin_info.tpl', 23, false),array('modifier', 'default', 'file:/var/www/html/atoffice/webapp/modules/admin/templates/edit_c_admin_info.tpl', 81, false),)), $this); ?>
<?php echo $this->_tpl_vars['inc_header']; ?>

<?php echo smarty_function_ext_include(array('file' => "inc_subnavi_adminStatisticalInformation.tpl"), $this);?>


<?php $this->assign('page_name', "お知らせ・規約設定"); ?>
<?php echo smarty_function_ext_include(array('file' => "inc_tree_adminStatisticalInformation.tpl"), $this);?>

</div>


<?php if ($this->_tpl_vars['atoffice_auth_type'] == 4): ?>


<h2>お知らせ・規約設定</h2>

<table class="contents" cellpadding="0" cellspacing="0" border="0">
<tr>
<td class="menu">
<dl>
<dt><strong class="item">お知らせ</strong></dt>
<dd>
<ul>
<li><a href="?m=<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
&amp;a=page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('edit_c_admin_info')); ?>
&amp;target=h_home">お知らせ</a></li>
</ul>
</dd>
<dt><strong class="item">規約</strong></dt>
<dd>
<ul>
<li><a href="?m=<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
&amp;a=page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('edit_c_admin_info')); ?>
&amp;target=sns_kiyaku">利用規約</a></li>
<li><a href="?m=<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
&amp;a=page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('edit_c_admin_info')); ?>
&amp;target=sns_privacy">プライバシーポリシー</a></li>
</ul>
</dd>
</dl>
</td>
<td class="detail">
<h3>
<?php if ($this->_tpl_vars['requests']['target'] == 'h_home'): ?>
お知らせ
<?php elseif ($this->_tpl_vars['requests']['target'] == 'k_h_home'): ?>
＜携帯版＞ホームのお知らせ
<?php elseif ($this->_tpl_vars['requests']['target'] == 'k_fh_diary'): ?>
＜携帯版＞<?php echo smarty_modifier_t_escape($this->_tpl_vars['WORD_DIARY']); ?>
ページのお知らせ
<?php elseif ($this->_tpl_vars['requests']['target'] == 'k_f_home'): ?>
＜携帯版＞<?php echo smarty_modifier_t_escape($this->_tpl_vars['WORD_FRIEND']); ?>
ページのお知らせ
<?php elseif ($this->_tpl_vars['requests']['target'] == 'k_c_home'): ?>
＜携帯版＞<?php echo smarty_modifier_t_escape($this->_tpl_vars['WORD_COMMUNITY']); ?>
ページのお知らせ
<?php elseif ($this->_tpl_vars['requests']['target'] == 'sns_kiyaku'): ?>
利用規約
<?php elseif ($this->_tpl_vars['requests']['target'] == 'sns_privacy'): ?>
プライバシーポリシー
<?php elseif ($this->_tpl_vars['requests']['target'] == 'daily_news_head'): ?>
デイリーニュース上部
<?php elseif ($this->_tpl_vars['requests']['target'] == 'daily_news_foot'): ?>
デイリーニュース下部
<?php endif; ?>
</h3>
<?php if ($this->_tpl_vars['msg']): ?><p class="actionMsg"><?php echo smarty_modifier_t_escape($this->_tpl_vars['msg']); ?>
</p><?php endif; ?>
<?php if ($this->_tpl_vars['requests']['target'] == 'sns_kiyaku' || $this->_tpl_vars['requests']['target'] == 'sns_privacy'): ?>
<p class="caution" id="c01">※HTMLタグは<strong>使用できません</strong>が、URLはリンクされます。</p>
<?php elseif ($this->_tpl_vars['requests']['target'] == 'daily_news_head' || $this->_tpl_vars['requests']['target'] == 'daily_news_foot'): ?>
<?php elseif ($this->_tpl_vars['requests']['target'] == 'k_h_home' || $this->_tpl_vars['requests']['target'] == 'k_fh_diary' || $this->_tpl_vars['requests']['target'] == 'k_f_home' || $this->_tpl_vars['requests']['target'] == 'k_c_home'): ?>
<p class="caution" id="c01">※HTMLタグが使用できますが、タグの閉じ忘れ等がありますと表示が崩れるなどの問題が起こることがありますのでご注意ください。<br />
※携帯版のお知らせ内に外部サイトへのリンクを含めると、外部サイトにリファラから「第三者によるログインが可能な情報」が漏えいする危険性があります。</p>
<?php else: ?>
<p class="caution" id="c01">※HTMLタグが使用できますが、タグの閉じ忘れ等がありますと表示が崩れるなどの問題が起こることがありますのでご注意ください。</p>
<?php endif; ?>

<form action="./" method="post">
<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
<input type="hidden" name="a" value="do_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('edit_c_admin_info','do')); ?>
" />
<input type="hidden" name="sessid" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['PHPSESSID']); ?>
" />
<input type="hidden" name="target" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['requests']['target']); ?>
" />
<textarea name="body" cols="<?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['cols']))) ? $this->_run_mod_handler('default', true, $_tmp, 60) : smarty_modifier_default($_tmp, 60)); ?>
" rows="<?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['rows']))) ? $this->_run_mod_handler('default', true, $_tmp, 10) : smarty_modifier_default($_tmp, 10)); ?>
"><?php echo smarty_modifier_t_escape($this->_tpl_vars['c_siteadmin']['body']); ?>
</textarea>
<p class="textBtn"><input type="submit" value="変更する" /></p>
</form>
<?php if ($this->_tpl_vars['requests']['target'] == 'k_h_home' || $this->_tpl_vars['requests']['target'] == 'k_fh_diary' || $this->_tpl_vars['requests']['target'] == 'k_f_home' || $this->_tpl_vars['requests']['target'] == 'k_c_home'): ?>
<h4>【携帯】お知らせ挿入場所対応図[ <?php if ($this->_tpl_vars['requests']['target'] == 'k_h_home'): ?>
ホーム
<?php elseif ($this->_tpl_vars['requests']['target'] == 'k_f_home'): ?>
<?php echo smarty_modifier_t_escape($this->_tpl_vars['WORD_FRIEND']); ?>
ページ
<?php elseif ($this->_tpl_vars['requests']['target'] == 'k_c_home'): ?>
<?php echo smarty_modifier_t_escape($this->_tpl_vars['WORD_COMMUNITY']); ?>
ページ
<?php elseif ($this->_tpl_vars['requests']['target'] == 'k_fh_diary'): ?>
<?php echo smarty_modifier_t_escape($this->_tpl_vars['WORD_DIARY']); ?>
ページ
<?php endif; ?> ]</h4>
<p class="image">
<img src="modules/admin/img/admin_info_<?php echo smarty_modifier_t_escape($this->_tpl_vars['requests']['target']); ?>
.gif" />
</p>
<?php endif; ?>
</td>
</tr>
</table>

<div class="contents">
<?php else: ?>
<br>
<center>
<span style="font-size: 16px; color: #FF0033;"><b>アクセス権がありません。</b></span>
</center>
<?php endif; ?>
<div>
<?php echo $this->_tpl_vars['inc_footer']; ?>
