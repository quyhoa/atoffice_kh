({$inc_header|smarty:nodefaults})
({ext_include file="inc_subnavi_adminStatisticalInformation.tpl"})
({assign var="page_name" value="CSVダウンロード"})
({ext_include file="inc_tree_adminStatisticalInformation.tpl"})
</div>

({*ここまで:navi*})
({*権限チェック*})
({if $atoffice_auth_type==4})

<h2>CSVダウンロード</h2>
<div class="contents">

({if $msg})
<p class="actionMsg">({$msg})</p>
({/if})

<p class="caution">※全件ダウンロードすると処理が重くなり、サーバーに負荷がかかる場合があります。</p>

<h3 class="item">全件ダウンロード</h3>
<p>全てのメンバーの情報をCSV形式でダウンロードします。</p>
<form  action="./" method="get">
<input type="hidden" name="m" value="({$module_name})" />
<input type="hidden" name="a" value="do_({$hash_tbl->hash('csv_member','do')})" />
<input type="hidden" name="sessid" value="({$PHPSESSID})" />
<input type="radio" name="mode" value="0" checked>ノーマル出力
<input type="radio" name="mode" value="1">CKRS仕様出力
<input type="radio" name="mode" value="2">取引先マスタ出力
<br>
<input type="hidden" name="start_id" value="0" />
<input type="hidden" name="end_id" value="0" />
<input type="hidden" name="allflag" value="1" />
<input type="hidden" name="timestamp" value="({$smarty.now})" />
<p class="textBtn"><input type="submit" value="ダウンロード" /></p>
</form>
<br>
<h3 class="item">メンバーIDを指定してダウンロード</h3>
<p>メンバーIDが指定された範囲内のメンバーの情報をCSV形式でダウンロードします。</p>
<form  action="./" method="get">
<input type="hidden" name="m" value="({$module_name})" />
<input type="hidden" name="a" value="do_({$hash_tbl->hash('csv_member','do')})" />
<input type="hidden" name="sessid" value="({$PHPSESSID})" />
<input type="radio" name="mode" value="0" checked>ノーマル出力
<input type="radio" name="mode" value="1">CKRS仕様出力
<input type="radio" name="mode" value="2">取引先マスタ出力
<br>
<input class="basic" type="text" name="start_id" value="" size="5" />　～　<input class="basic" type="text" name="end_id" value="" size="5" />
<input type="hidden" name="allflag" value="0" />
<input type="hidden" name="timestamp" value="({$smarty.now})" />
<p class="textBtn"><input type="submit" value="ダウンロード" /></p>
</form>

({else})
<br>
<center>
<span style="font-size: 16px; color: #FF0033;"><b>アクセス権がありません。</b></span>
</center>
({/if})
<div>
({$inc_footer|smarty:nodefaults})

