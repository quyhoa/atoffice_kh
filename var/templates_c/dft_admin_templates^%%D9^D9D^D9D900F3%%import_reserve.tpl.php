<?php /* Smarty version 2.6.18, created on 2017-03-02 19:29:33
         compiled from file:/var/www/html/atoffice/webapp/modules/admin/templates/import_reserve.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'ext_include', 'file:/var/www/html/atoffice/webapp/modules/admin/templates/import_reserve.tpl', 2, false),array('modifier', 't_escape', 'file:/var/www/html/atoffice/webapp/modules/admin/templates/import_reserve.tpl', 16, false),)), $this); ?>
<?php echo $this->_tpl_vars['inc_header']; ?>

<?php echo smarty_function_ext_include(array('file' => "inc_subnavi_adminStatisticalInformation.tpl"), $this);?>

<?php $this->assign('page_name', "予約データCSVインポート"); ?>
<?php echo smarty_function_ext_include(array('file' => "inc_tree_adminStatisticalInformation.tpl"), $this);?>

</div>


<?php if ($this->_tpl_vars['atoffice_auth_type'] == 4): ?>

<h2>予約データCSVインポート(ASPベース)</h2>
<div class="contents">

<?php if ($this->_tpl_vars['requests']['msg']): ?>
<p class="actionMsg"><?php echo smarty_modifier_t_escape($this->_tpl_vars['requests']['msg']); ?>
</p>
<?php endif; ?>

<p>以下のフォームから予約情報が記載されたCSVファイルをアップロードすると、予約データを登録することができます。</p>

<ul class="caution">
<li>※1ファイルで登録処理がおこなわれるのは1000行目までです。以降の行は無視されます。</li>
<li>※この処理には長時間かかる場合があります。</li>
</ul>

<form action="./" method="post" enctype="multipart/form-data">
<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
<input type="hidden" name="a" value="do_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('import_reserve','do')); ?>
" />
<input type="hidden" name="sessid" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['PHPSESSID']); ?>
" />
<p><input type="file" name="member_file" /></p>
<p class="textBtn"><input type="submit" class="submit" value="　登　録　" /></p>
</form>
<br>
<h3 class="item">CSVファイル形式</h3>
<ul>
<li>文字コード： UTF-8</li>
<li>ファイルの拡張子： .csv</li>
<li>書式： 各項目を必ずダブルクォート""で囲ってください。</li>
</ul>
<p>1行目にタイトル行、2行目以降に予約情報を記載します。</p>
<ul class="caution">
<li>※新規の顧客はゲストとして登録されます。</li>
</ul>
<br>
<br>
<h3 class="item">制限事項</h3>
<ul class="caution">
<li>※ASPとシステムの会場名が異なっていると、会場IDが取得できなくなります。</li>
<li>※システムの部屋名とASPの部屋名が異なっていて、インポートを利用できるのは初期の会場（ID26）までです。</li>
<li>※ID26までの会場で、部屋名を納品時かASPの名称以外に変更すると部屋IDが取得できなくなります</li>
</ul>
<br>
<h3 class="item">CSV作成例（ASPからダウンロードしたデータに住所・入金情報を追記して、ダブルクォートで囲ってからUTF-8形式で保存します。）</h3>

"登録日","利用日","曜日","変更日","施設名","名称","予約時間","予約番号","登録番号","利用者","ひらがな","法人／団体名","性別","郵便番号","住所","E-Mail","電話番号","看板表示","ご利用目的","予約状況","受付者","人数","利用料金","施設特記事項","備品料金","備品内容","備品特記事項","都道府県","市区町村","番地","建物","仮予約フラグ","予約承認日","入金期日","入金額","入金日","入金済みフラグ"<br>
"2010/3/18","2010/4/1","木","","アットビジネスセンター池袋駅前","本館601号室（50人）","13:00～17:00","100034994","100027689","鶴野　愼一","ツルノ　シンイチ","株式会社トータスホーム","　","176-0002","東京都練馬区桜台４－１０－９　","honbu@totashome.co.jp","03-5999-2221","株式会社トータスホーム","仮：会議","仮予約","OnLine","25","58590","","13650","スクリーン(1台)　マイクセット(1セット)　追加用有線マイク(1本)　","3/30備品（ﾏｲｸｾｯﾄ、ｽｸﾘｰﾝ）追加承りました。4/01当日備品（ﾏｲｸ","東京都","練馬区","桜台４－１０－９　","","0","2010-4-1 00:00:00","2010-4-30 23:59:59","0","","0"<br>
"2010/3/10","2010/4/1","木","","アットビジネスセンター池袋駅前","本館701号室（50人）","18:00～22:00","100034841","100026926","園田　茂雄","ソノダ　シゲオ","レインフォレスト株式会社","男","108-0073","東京都港区三田２－２０－２１パークハビオ三田綱町２０５","sonoda@me.com","090-1790-3300","ＬＬＰ（ライフラーニングプログラム）　ベーシックコース","仮：企業研修","仮予約","OnLine","24","29400","","0","","","東京都","港区","三田２－２０－２１","パークハビオ三田綱町２０５","1","","","","",""

<?php else: ?>
<br>
<center>
<span style="font-size: 16px; color: #FF0033;"><b>アクセス権がありません。</b></span>
</center>
<?php endif; ?>
<div>
<?php echo $this->_tpl_vars['inc_footer']; ?>

