({$inc_header|smarty:nodefaults})
({ext_include file="inc_subnavi_adminImageKakikomi.tpl"})

({assign var="page_name" value="運営状態変更"})


({ext_include file="inc_tree_adminImageKakikomi.tpl"})
</div>

({*ここまで:navi*})

({*権限チェック*})
({if $atoffice_auth_type==1 or $atoffice_auth_type==4})

<style type="text/css">
<!--
HR {
	border-style:dotted;color:#3399FF

}
-->
</style>


<h2 id="ttl01">運営状態変更【({$hall_data.hall_name})】</h2>

<br>
<center>
({if $msg})<p class="actionMsg">({$msg})</p>({/if})
<br><br>
※　以下の状態を満たしていないと、メンテナンス中・停止中から運営状態は変更できません。<br>
(運営中からは、メンテナンス中や停止中へ変更することはできます。)

<table border=1>
<tr>
<td align=left>
<span style="margin:5px">有効になっている部屋が1つ以上あるか</span>
</td>
<td>
({if $room_flag_check})
<span style="margin:5px">○</span>
({else})
<span style="margin:5px">×</span>
({/if})
</td>
</tr>
<tr>
<td align=left>
<span style="margin:5px">画像１（会場外観）が登録されているか</span>
</td>
<td>
({if $image1_check})
<span style="margin:5px">○</span>
({else})
<span style="margin:5px">×</span>
({/if})
</td>
</tr>
<tr>
<td align=left>
<span style="margin:5px">画像２（地図）が登録されているか</span>
</td>
<td>
({if $image2_check})
<span style="margin:5px">○</span>
({else})
<span style="margin:5px">×</span>
({/if})
</td>
</tr>
<tr>
<td align=left>
<span style="margin:5px">指定口座の場合、口座設定をしてあるか（バーチャルの場合は○）</span>
</td>
<td>
({if $bank_check})
<span style="margin:5px">○</span>
({else})
<span style="margin:5px">×</span>
({/if})
</td>
</tr>
<tr>
<td align=left>
<span style="margin:5px">会場の利用規約が入力されているか</span>
</td>
<td>
({if $hall_data.agreement})
<span style="margin:5px">○</span>
({else})
<span style="margin:5px">×</span>
({/if})
</td>
</tr>
</table>
<br><br>
({if !$error or $hall_data.flag==0})
<form name="add({$item.num})" action="./" method="post" enctype="multipart/form-data" >
<input type="hidden" name="m" value="({$module_name})" />
<input type="hidden" name="a" value="do_({$hash_tbl->hash('hall_status_change','do')})" />
<input type="hidden" name="sessid" value="({$PHPSESSID})" />
<input type="hidden" name="delete_flag" value="0">
<input type="hidden" name="hall_id" value="({$hall_id})">
<table>
<tr>
<td bgcolor=#FFDDCC width=400 height=30>
<input type="radio" name="flag" value="0" ({if $hall_data.flag==0})checked({/if})> 運営中　
<input type="radio" name="flag" value="1" ({if $hall_data.flag==1})checked({/if})> メンテナンス中　
<input type="radio" name="flag" value="2" ({if $hall_data.flag==2})checked({/if})> 停止中　
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

({else})
<span style="font-size: 16pt;color: #FF3300;"><b>条件を満たしていないため、運営状態を変更できません。</b></span>
({/if})
</center>

({else})
<br>
<center>
<span style="font-size: 16px; color: #FF0033;"><b>アクセス権がありません。</b></span>
</center>
({/if})
<div>
({$inc_footer|smarty:nodefaults})
