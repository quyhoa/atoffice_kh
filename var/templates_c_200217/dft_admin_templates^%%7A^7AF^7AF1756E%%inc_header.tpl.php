<?php /* Smarty version 2.6.18, created on 2016-12-08 08:51:28
         compiled from file:E:%5CA_project%5Catoffice/webapp/modules/admin/templates/inc_header.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 't_escape', 'file:E:\\A_project\\atoffice/webapp/modules/admin/templates/inc_header.tpl', 6, false),)), $this); ?>
<?php $this->assign('title', (@SNS_NAME)."管理画面 <レンタル会議室予約管理>"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo smarty_modifier_t_escape($this->_tpl_vars['title']); ?>
</title>
<meta content="text/css" http-equiv="content-style-type" />
<meta http-equiv="Content-Script-Type" content="text/javascript" />
<link href="modules/admin/default.css" rel="stylesheet" type="text/css" media="all" />
<script type="text/javascript" src="./js/prototype.js?r7140"></script>
<script type="text/javascript" src="./modules/admin/default.js?r11725"></script>
<?php if ($this->_tpl_vars['custom_header']): ?>
<?php echo $this->_tpl_vars['custom_header']; ?>

<?php endif; ?>
<script type="text/javascript" src="./js/pne.js"></script>
</head>
<body id="admin_page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['CURRENT_ACTION']); ?>
">

<div class="container">


<div class="header">
<div class="ttl">
    <h1>
        <a href="?m=<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
"><?php echo smarty_modifier_t_escape($this->_tpl_vars['title']); ?>
</a>
    </h1>
    <span>
        【<a href="./" target="_blank">サイト確認</a>】
    </span>
</div>
<div class="naviHelp"></div>
</div>



<?php if ($this->_tpl_vars['display_navi']): ?>
<div class="navi">
<div class="naviMain">



<?php if ($this->_tpl_vars['auth_type'] == 'all' || $this->_tpl_vars['auth_type'] == ''): ?>
<ul class="admin">


<?php if ($this->_tpl_vars['atoffice_auth_type'] != 3): ?>
<li id="adminImageKakikomi" onmouseover="menu('adminImageKakikomi','adminImageKakikomiCont')" onmouseout="menu('adminImageKakikomi','adminImageKakikomiCont')">
<a class="tab" href="?m=<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
&amp;a=page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('hall_list')); ?>
">初期設定担当メニュー</a>
<ul id="adminImageKakikomiCont" class="pull">
<li><a href="?m=<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
&amp;a=page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('hall_list')); ?>
">会場一覧表示</a></li>
<li><a href="?m=<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
&amp;a=page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('add_hall')); ?>
">新規会場追加</a></li>
</ul>
</li>
<?php endif; ?>

<?php if ($this->_tpl_vars['atoffice_auth_type'] != 3): ?>
	<li class="tab">
		<a href="?m=<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
&amp;a=page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('list_c_customer_stt')); ?>
">貸し止め一覧</a>
	</li>
<?php endif; ?>
<?php if ($this->_tpl_vars['atoffice_auth_type'] != 3): ?>
<li id="adminSiteMember" onmouseover="menu('adminSiteMember','adminSiteMemberCont')" onmouseout="menu('adminSiteMember','adminSiteMemberCont')"><a class="tab" href="<?php if ($this->_tpl_vars['auth_type'] == 'all'): ?>?m=<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
&amp;a=page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('tmp_reserve_list')); ?>
<?php elseif ($this->_tpl_vars['auth_type'] == 'all' || $this->_tpl_vars['auth_type'] == ''): ?>?m=<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
&amp;a=page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('send_invites')); ?>
<?php else: ?>?m=<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
&amp;a=page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('csv_download')); ?>
<?php endif; ?>">予約受付担当者メニュー</a>
<ul id="adminSiteMemberCont" class="pull">
<li><a href="?m=<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
&amp;a=page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('set_reserve')); ?>
" onclick="return deleteCurrentOrder()">予約入力</a></li>
<li><a href="?m=<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
&amp;a=page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('rental_stop')); ?>
">貸し止め</a></li>
<li><a href="?m=<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
&amp;a=page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('csv_download2')); ?>
">請求データDL</a></li>
<li><a href="?m=<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
&amp;a=page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('import_pay_money')); ?>
">eマッチング入金処理</a></li>
<li><a href="?m=<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
&amp;a=page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('tmp_reserve_list')); ?>
">仮予約一覧</a></li>
<li><a href="?m=<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
&amp;a=page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('reserve_list')); ?>
">入金待ち予約一覧</a></li>
<li><a href="?m=<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
&amp;a=page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('paid_reserve_list')); ?>
">入金済み予約一覧</a></li>
<li><a href="?m=<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
&amp;a=page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('complete_reserve_list')); ?>
">完了済み予約一覧</a></li>
<li><a href="?m=<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
&amp;a=page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('cancel_list')); ?>
">キャンセル一覧</a></li>
<li><a href="?m=<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
&amp;a=page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('reserve_view')); ?>
">予約確認</a></li>
<li><a href="?m=<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
&amp;a=page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('list_c_member')); ?>
">顧客リスト</a></li>
<li><a href="?m=<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
&amp;a=page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('send_invites')); ?>
">招待メール送信</a></li>
<li><a href="?m=<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
&amp;a=page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('customer_use_state')); ?>
">顧客利用状況</a></li>
<li><a href="?m=<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
&amp;a=page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('auto_estimate')); ?>
">自動見積書</a></li>
</ul>
</li>
<?php endif; ?>

<li id="adminDesign2" onmouseover="menu('adminDesign2','adminDesignCont2')" onmouseout="menu('adminDesign2','adminDesignCont2')"><a class="tab" href="?m=<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
&amp;a=page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('today_reservation')); ?>
">準備担当者メニュー</a>
<ul id="adminDesignCont2" class="pull">
<li><a href="?m=<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
&amp;a=page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('today_reservation')); ?>
">本日のご予約状況</a></li>
<li><a href="?m=<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
&amp;a=page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('tomorrow_reservation')); ?>
">予約状況検索</a></li>
<li><a href="?m=<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
&amp;a=page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('incomplete_list')); ?>
">未完了報告リスト</a></li>
<li><a href="?m=<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
&amp;a=page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('rental_stop2')); ?>
">貸し止め(準備担当)</a></li>
</ul>
</li>


<?php if ($this->_tpl_vars['atoffice_auth_type'] != 3): ?>

<li id="adminStatisticalInformation" onmouseover="menu('adminStatisticalInformation','adminStatisticalInformationCont')" onmouseout="menu('adminStatisticalInformation','adminStatisticalInformationCont')"><a class="tab" href="?m=<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
&amp;a=page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('list_c_admin_user')); ?>
">管理者メニュー</a>

<ul id="adminStatisticalInformationCont" class="pull">
<li><a href="?m=<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
&amp;a=page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('list_c_admin_user')); ?>
">アカウント管理</a></li>
<li><a href="?m=<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
&amp;a=page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('customer_edit')); ?>
">顧客情報管理</a></li>
<li><a href="?m=<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
&amp;a=page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('edit_c_admin_config')); ?>
">サイト設定</a></li>
<li><a href="?m=<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
&amp;a=page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('import_virtual_account')); ?>
">ﾊﾞｰﾁｬﾙ口座設定</a></li>
<li><a href="?m=<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
&amp;a=page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('virtual_account_setup')); ?>
">ﾊﾞｰﾁｬﾙ口座利用状況</a></li>
<li><a href="?m=<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
&amp;a=page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('edit_c_profile')); ?>
">顧客情報項目設定</a></li>
<li><a href="?m=<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
&amp;a=page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('edit_c_holiday')); ?>
">祝日設定</a></li>
<li><a href="?m=<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
&amp;a=page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('edit_c_admin_info')); ?>
">お知らせ・規約設定</a></li>
<li><a href="?m=<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
&amp;a=page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('consumption_tax_rate')); ?>
">消費税率設定</a></li>
<li><a href="?m=<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
&amp;a=page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('repayment_list')); ?>
">未返金処理リスト</a></li>
<li><a href="?m=<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
&amp;a=page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('repaid_list')); ?>
">返金処理済みリスト</a></li>
<li><a href="?m=<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
&amp;a=page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('amount_billed')); ?>
">キャンセル請求一覧</a></li>
<li><a href="?m=<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
&amp;a=page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('receipt_list')); ?>
">領収書印刷者リスト</a></li>
<li><a href="?m=<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
&amp;a=page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('import_reserve')); ?>
">予約インポート</a></li>
<li><a href="?m=<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
&amp;a=page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('delete_reserve')); ?>
">予約削除</a></li>
<li><a href="?m=<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
&amp;a=page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('karipass_list')); ?>
">仮パスリスト</a></li>
<li><a href="?m=<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
&amp;a=page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('slip_output')); ?>
">帳票出力</a></li>
<li><a href="?m=<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
&amp;a=page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('csv_download')); ?>
">CSVダウンロード</a></li>
<li><a href="?m=<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
&amp;a=page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('import_c_member')); ?>
">CSVインポート</a></li>
<li><a href="?m=<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
&amp;a=page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('blacklist')); ?>
">ブラックリスト管理</a></li>
<li><a href="?m=<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
&amp;a=page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('agency_list')); ?>
">代理店値引き管理</a></li>
<li><a href="?m=<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
&amp;a=page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('edit_mail')); ?>
">メール文言変更</a></li>
<li><a href="?m=<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
&amp;a=page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('set_deadline_booking')); ?>
">前日予約分の締切設定</a></li>
</ul>
</li>

<?php endif; ?>


</ul>
<?php endif; ?>



<ul class="adminadmin">

<li id="adminAdminConfig" onmouseover="menu('adminAdminConfig','adminAdminConfigCont')" onmouseout="menu('adminAdminConfig','adminAdminConfigCont')">
    <a class="tab" href="?m=<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
&amp;a=page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('edit_admin_password')); ?>
">パスワード変更</a>
<ul id="adminAdminConfigCont" class="pull">
<li><a href="?m=<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
&amp;a=page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('edit_admin_password')); ?>
">パスワード変更</a></li>
</ul>
</li>

</ul>


<p id="logout"><a href="?m=<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
&amp;a=do_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('logout','do')); ?>
&amp;sessid=<?php echo smarty_modifier_t_escape($this->_tpl_vars['PHPSESSID']); ?>
" onclick="return deleteOrder();">ログアウト</a></p>


</div>

<?php else: ?>
<div><?php endif; ?>

<script>
function deleteOrder()
{
	var url="?m=admin&a=page_clear_all_reserve";
	var post=null;
	var xmlHttp = new XMLHttpRequest();
	xmlHttp.open("POST", url, false);
	xmlHttp.setRequestHeader("Content-Type" , "application/x-www-form-urlencoded;charset=UTF-8");
	xmlHttp.send(post);
         
}
function deleteCurrentOrder()
{
    if(pre_id)
    {
        var url="?m=admin&a=page_clear_reserve&pid="+pre_id;
        var post=null;
        var xmlHttp = new XMLHttpRequest();
    	xmlHttp.open("POST", url, false);
    	xmlHttp.setRequestHeader("Content-Type" , "application/x-www-form-urlencoded;charset=UTF-8");
    	xmlHttp.send(post);
       
        return ;
    }
}
</script>