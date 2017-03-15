<?php /* Smarty version 2.6.18, created on 2016-11-18 15:36:58
         compiled from file:/var/www/atoffice/webapp/modules/admin/templates/import_c_member.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'ext_include', 'file:/var/www/atoffice/webapp/modules/admin/templates/import_c_member.tpl', 2, false),array('modifier', 't_escape', 'file:/var/www/atoffice/webapp/modules/admin/templates/import_c_member.tpl', 16, false),)), $this); ?>
<?php echo $this->_tpl_vars['inc_header']; ?>

<?php echo smarty_function_ext_include(array('file' => "inc_subnavi_adminStatisticalInformation.tpl"), $this);?>

<?php $this->assign('page_name', "CSVインポート"); ?>
<?php echo smarty_function_ext_include(array('file' => "inc_tree_adminStatisticalInformation.tpl"), $this);?>

</div>


<?php if ($this->_tpl_vars['atoffice_auth_type'] == 4): ?>

<h2>CSVインポート</h2>
<div class="contents">

<?php if ($this->_tpl_vars['requests']['msg']): ?>
<p class="actionMsg"><?php echo smarty_modifier_t_escape($this->_tpl_vars['requests']['msg']); ?>
</p>
<?php endif; ?>

<p>以下のフォームからメンバー情報の記載されたCSVファイルをアップロードすると、メンバーを登録することができます。</p>

<ul class="caution">
<li>※1ファイルで登録処理がおこなわれるのは1000行目までです。以降の行は無視されます。</li>
<li>※この処理には長時間かかる場合があります。</li>
</ul>

<form action="./" method="post" enctype="multipart/form-data">
<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
<input type="hidden" name="a" value="do_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('import_c_member','do')); ?>
" />
<input type="hidden" name="sessid" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['PHPSESSID']); ?>
" />
<p><input type="file" name="member_file" /></p>
<p class="textBtn"><input type="submit" class="submit" value="　登　録　" /></p>
</form>

<h3 class="item">CSVファイル形式</h3>
<ul>
<li>文字コード： UTF-8</li>
<li>ファイルの拡張子： .csv</li>
</ul>
<p>1行目にタイトル行、2行目以降にメンバー情報を記載します。</p>
<p>タイトル行には以下の項目が記載できます。</p>

<table class="basicType2">
<?php if (@OPENPNE_AUTH_MODE == 'pneid'): ?>
<tr><th>login_id ※</th><td>ログインID</td></tr>
<?php endif; ?>
<tr><th>nickname ※</th><td>氏名</td></tr>
<tr><th>mail_address ※</th><td>メールアドレス（PCメールのみ）</td></tr>
<tr><th>password ※</th><td>パスワード</td></tr>
<tr><th>birth_year</th><td>生まれた年</td></tr>
<tr><th>birth_month</th><td>誕生月</td></tr>
<tr><th>birth_day</th><td>誕生日</td></tr>
<tr><th>public_flag_birth_year</th><td>生まれた年の公開設定（public, friend, private）</td></tr>
<tr><th>public_flag_birth_month_day</th><td>誕生月・誕生日の公開設定（public, friend, private）</td></tr>
<tr><th>profile[識別名]</th><td>プロフィール項目（[]内に<a href="?m=<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
&amp;a=page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('edit_c_profile','page')); ?>
">プロフィール項目設定</a>で設定した識別名を入れます）<br />
<br />
フォームタイプが「単一選択」もしくは「複数選択」の場合は、2行目以降にプロフィール選択肢のIDを入力します。<br />
「複数選択」の場合にはプロフィール選択肢のIDをカンマ(,)区切りで複数入力することができます。</td></tr>
</table>
<p>※<?php if (@OPENPNE_AUTH_MODE == 'pneid'): ?>「login_id」<?php endif; ?>「nickname」「mail_address」「password」は必須項目です。</p>

<h3 class="item">CSVファイル例</h3>
<textarea cols="120" rows="5" readonly="readonly">
nickname,mail_address,password,birth_year,birth_month,birth_day,profile[name_kana],profile[corporation_flag],profile[corporation],profile[busho],profile[pre_addr_pref],profile[address_zip],profile[address_city],profile[address_banchi],profile[address_build],profile[tel],profile[fax]
"テスト太郎","test3@test.com","karipass123","1970","1","1","テストタロウ","106","株式会社テスト","営業部","19","169-0072","新宿区","大久保０－０－０","テストビル３F","03-0000-0000","03-0000-0001"

</textarea>

<?php else: ?>
<br>
<center>
<span style="font-size: 16px; color: #FF0033;"><b>アクセス権がありません。</b></span>
</center>
<?php endif; ?>
<div>
<?php echo $this->_tpl_vars['inc_footer']; ?>

