<?php /* Smarty version 2.6.18, created on 2016-12-15 03:43:26
         compiled from file:E:%5CA_project%5Catoffice/webapp/modules/admin/templates/edit_c_admin_config.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'ext_include', 'file:E:\\A_project\\atoffice/webapp/modules/admin/templates/edit_c_admin_config.tpl', 2, false),array('modifier', 't_escape', 'file:E:\\A_project\\atoffice/webapp/modules/admin/templates/edit_c_admin_config.tpl', 12, false),)), $this); ?>
<?php echo $this->_tpl_vars['inc_header']; ?>

<?php echo smarty_function_ext_include(array('file' => "inc_subnavi_adminStatisticalInformation.tpl"), $this);?>


<?php $this->assign('page_name', "サイト設定"); ?>
<?php echo smarty_function_ext_include(array('file' => "inc_tree_adminStatisticalInformation.tpl"), $this);?>

</div>

<?php if ($this->_tpl_vars['atoffice_auth_type'] == 4): ?>

<?php if ($this->_tpl_vars['msg']): ?><p class="actionMsg"><?php echo smarty_modifier_t_escape($this->_tpl_vars['msg']); ?>
</p><?php endif; ?>
<h2>サイト設定</h2>
<div class="contents">
<p class="caution" id="c01">※「設定変更する」ボタンを押すと設定が反映されます</p>
<form action="./" method="post">
<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
<input type="hidden" name="a" value="do_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('update_c_admin_config','do')); ?>
" />
<input type="hidden" name="sessid" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['PHPSESSID']); ?>
" />
<table class="basicType2">
<tr class="cell01">
<th colspan="2">サイト名</th>
<td><input class="basic" name="SNS_NAME" type="text" value="<?php echo smarty_modifier_t_escape(@SNS_NAME); ?>
" size="30" /></td>
</tr>
<tr class="cell02">
<th colspan="2">ページタイトル</th>
<td>
<span class="info">HTMLのtitle要素の内容になります</span><br />
<input class="basic" name="SNS_TITLE" type="text" value="<?php echo smarty_modifier_t_escape(@SNS_TITLE); ?>
" size="30" /><br />
<span class="caution">※省略時はサイト名が使用されます</span>
</td>
</tr>
<tr class="cell03">
<th colspan="2">管理用メールアドレス</th>
<td>
<span class="info">メンバーに送られるメールのFromに設定されます</span><br />
<input class="basic" name="ADMIN_EMAIL" type="text" value="<?php echo smarty_modifier_t_escape(@ADMIN_EMAIL); ?>
" size="40" /></td>
</tr>
<tr class="cell04">
<th colspan="2">招待制/オープン制</th>
<td>
<input class="basicRadio" name="IS_CLOSED_SNS" id="IS_CLOSED_SNS_1" type="radio" value="1"<?php if (@IS_CLOSED_SNS): ?> checked="checked"<?php endif; ?> /><label for="IS_CLOSED_SNS_1">招待制</label>　<span class="caution">（※参加者の招待がなければ登録できません）</span><br />
<input class="basicRadio" name="IS_CLOSED_SNS" id="IS_CLOSED_SNS_0" type="radio" value="0"<?php if (! @IS_CLOSED_SNS): ?> checked="checked"<?php endif; ?> /><label for="IS_CLOSED_SNS_0">オープン制</label>　<span class="caution">（※参加者の招待なしでも登録できます）</span>
</td>
</tr>
<tr class="cell08">
<th colspan="2">登録の可否</th>
<td>
<input class="basicRadio" name="OPENPNE_REGIST_FROM" id="OPENPNE_REGIST_FROM_PC" type="radio" value="<?php echo smarty_modifier_t_escape(@OPENPNE_REGIST_FROM_PC); ?>
"<?php if (@OPENPNE_REGIST_FROM == @OPENPNE_REGIST_FROM_PC): ?> checked="checked"<?php endif; ?> /><label for="OPENPNE_REGIST_FROM_PC">PCからのみ登録可</label><br />
<input class="basicRadio" name="OPENPNE_REGIST_FROM" id="OPENPNE_REGIST_FROM_NONE" type="radio" value="<?php echo smarty_modifier_t_escape(@OPENPNE_REGIST_FROM_NONE); ?>
"<?php if (@OPENPNE_REGIST_FROM == @OPENPNE_REGIST_FROM_NONE): ?> checked="checked"<?php endif; ?> /><label for="OPENPNE_REGIST_FROM_NONE">登録一時停止</label><span class="caution">※停止にすると新規入会を受け付けなくなります</span>
</td>
</tr>

<tr class="cell21">
<th colspan="2">ログイン制限</th>
<td>
<input class="basicRadio" name="LOGIN_CHECK_ENABLE" type="radio" value="0"<?php if (! @LOGIN_CHECK_ENABLE): ?> checked="checked"<?php endif; ?> />制限しない<br />
<input class="basicRadio" name="LOGIN_CHECK_ENABLE" type="radio" value="1"<?php if (@LOGIN_CHECK_ENABLE): ?> checked="checked"<?php endif; ?> />制限する<br />
<input class="basic" name="LOGIN_CHECK_TIME" type="text" value="<?php echo smarty_modifier_t_escape(@LOGIN_CHECK_TIME); ?>
" size="5" />分間に
<input class="basic" name="LOGIN_CHECK_NUM" type="text" value="<?php echo smarty_modifier_t_escape(@LOGIN_CHECK_NUM); ?>
" size="8" />回ログインに失敗したら
<input class="basic" name="LOGIN_REJECT_TIME" type="text" value="<?php echo smarty_modifier_t_escape(@LOGIN_REJECT_TIME); ?>
" size="5" />分間同一IPからのログインを制限する
</td>
</tr>
<tr class="cell22A">
<th rowspan="3">メール</th>
<th>キャッチコピー</th>
<td>
<span class="info">登録メンバーに送られるメールの署名に使用します</span><br />
<input class="basic" name="CATCH_COPY" type="text" value="<?php echo smarty_modifier_t_escape(@CATCH_COPY); ?>
" size="30" />
</td>
</tr>
<tr class="cell22B">
<th>運営会社</th>
<td>
<span class="info">登録メンバーに送られるメールの署名に使用します</span><br />
<input class="basic" name="OPERATION_COMPANY" type="text" value="<?php echo smarty_modifier_t_escape(@OPERATION_COMPANY); ?>
" size="30" /></td>
</tr>
<tr class="cell22C">
<th>Copyright</th>
<td>
<span class="info">登録メンバーに送られるメールの署名に使用します</span><br />
<input class="basic" name="COPYRIGHT" type="text" value="<?php echo smarty_modifier_t_escape(@COPYRIGHT); ?>
" size="30" /></td>
</tr>
<tr class="cell28">
<th colspan="2">登録/退会者のデータ</th>
<td>
<span class="info">登録/退会者のデータを管理者のメールアドレスに転送するかどうかを設定します</span><br />
<select class="basic" name="SEND_USER_DATA">
<option value="1"<?php if (@SEND_USER_DATA): ?> selected="selected"<?php endif; ?>>転送する</option>
<option value="0"<?php if (! @SEND_USER_DATA): ?> selected="selected"<?php endif; ?>>転送しない</option>
</select></td>
</tr>
</table>
<p class="textBtn"><input type="submit" value="設定変更する" /></p>
</form>
</div>

<?php else: ?>
<br>
<center>
<span style="font-size: 16px; color: #FF0033;"><b>アクセス権がありません。</b></span>
</center>
<?php endif; ?>
<div>
<?php echo $this->_tpl_vars['inc_footer']; ?>

