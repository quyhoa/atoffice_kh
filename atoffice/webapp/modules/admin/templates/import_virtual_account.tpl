({$inc_header|smarty:nodefaults})
({ext_include file="inc_subnavi_adminStatisticalInformation.tpl"})
({assign var="page_name" value="バーチャル口座CSVインポート"})
({ext_include file="inc_tree_adminStatisticalInformation.tpl"})
</div>

({*ここまで:navi*})
({*権限チェック*})
({if $atoffice_auth_type==4})

<h2>バーチャル口座CSVインポートCSVインポート</h2>
<div class="contents">

({if $requests.msg})
<p class="actionMsg">({$requests.msg})</p>
({/if})

<p>以下のフォームからバーチャル口座情報の記載されたCSVファイルをアップロードすると、バーチャル口座番号を登録することができます。</p>

<ul class="caution">
<li>※1ファイルで登録処理がおこなわれるのは1000行目までです。以降の行は無視されます。</li>
<li>※この処理には長時間かかる場合があります。</li>
<li>※既に登録されている <b>SEQ番号</b> は再登録され、固定顧客のデータは消えますので注意してください。</li>
<li>※口座を追加する場合は、現在登録されているSEQ番号の続きからになるように編集してから登録してください。</li>
</ul>

<form action="./" method="post" enctype="multipart/form-data">
<input type="hidden" name="m" value="({$module_name})" />
<input type="hidden" name="a" value="do_({$hash_tbl->hash('import_virtual_account','do')})" />
<input type="hidden" name="sessid" value="({$PHPSESSID})" />
<p><input type="file" name="virtual_file" /></p>
<p class="textBtn"><input type="submit" class="submit" value="　登　録　" /></p>
</form>

<h3 class="item">CSVファイル形式</h3>
<ul>
<li>文字コード： UTF-8</li>
<li>ファイルの拡張子： .csv</li>
</ul>
<p>以下の書式でデータ区分2（データレコード）のみ記載してください。</p>

<table class="basicType2">
<tr><th>データ区分</th><td>【2：データレコード】</td></tr>
<tr><th>店番号</th><td>３桁の取引店店番号（実際の入金先）</td></tr>
<tr><th>科目</th><td>【1：普通】【2：当座】</td></tr>
<tr><th>口座番号</th><td>７桁の仮想支店の振り込み専用口座番号</td></tr>
<tr><th>予備</th><td>スペース</td></tr>
<tr><th>口座数</th><td>SEQ番号（登録済みの最終SEQ番号+1からカウントアップ）</td></tr>
<tr><th>予備</th><td>スペース</td></tr>
</table>

<h3 class="item">CSVファイル例</h3>

<li>※ヘッダやトレーラ、エンドレコードは登録時無視されますが必須です。</li>

<textarea cols="120" rows="8" readonly="readonly">
1,769,1,1057377,アットオフィス,0000000, 
2,111,1,0000000, ,0000001, 
2,111,1,0000013, ,0000002, 
2,111,1,0000024, ,0000003, 
2,111,1.0000038, ,0000004, 
8, , ,30, ,31, 
9, , , , ,32, 

</textarea>

({else})
<br>
<center>
<span style="font-size: 16px; color: #FF0033;"><b>アクセス権がありません。</b></span>
</center>
({/if})
<div>
({$inc_footer|smarty:nodefaults})
