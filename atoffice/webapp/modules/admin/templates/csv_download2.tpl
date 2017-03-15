({$inc_header|smarty:nodefaults})
({ext_include file="inc_subnavi_adminSiteMember.tpl"})
({assign var="page_name" value="請求データCSVダウンロード"})
({ext_include file="inc_tree_adminSiteMember.tpl"})
</div>

({*ここまで:navi*})
({*権限チェック*})
({if $atoffice_auth_type==2 or $atoffice_auth_type==4})

<h2>請求データCSVダウンロード</h2>
<div class="contents">

({if $msg})
<p class="actionMsg">({$msg})</p>
({/if})

<p class="caution">※ 請求件数が多いと処理が重くなり、サーバーに負荷がかかる場合があります。</p>
<br>
★　現在の請求件数　★<br>
予約による請求中件数：({$reserve_bill})件<br>
キャンセル料金などそれ以外の請求中件数：({$etc_bill})件<br>
合計請求中件数：({$total_bill})件<br>
<br>
<h3 class="item">全件ダウンロード</h3>
({if $total_bill>0})
<form  action="./" method="get">
<input type="hidden" name="m" value="({$module_name})" />
<input type="hidden" name="a" value="do_({$hash_tbl->hash('csv_bill_list','do')})" />
<input type="hidden" name="sessid" value="({$PHPSESSID})" />

<input type="hidden" name="start_id" value="0" />
<input type="hidden" name="end_id" value="0" />
<input type="hidden" name="allflag" value="1" />
<input type="hidden" name="timestamp" value="({$smarty.now})" />
<p class="textBtn"><input type="submit" value="ダウンロード" /></p>
</form>
({else})
現在請求中のデータはありません。<br>
({/if})

({else})
<br>
<center>
<span style="font-size: 16px; color: #FF0033;"><b>アクセス権がありません。</b></span>
</center>
({/if})
<div>
({$inc_footer|smarty:nodefaults})

