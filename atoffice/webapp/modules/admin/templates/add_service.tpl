({$inc_header|smarty:nodefaults})
({ext_include file="inc_subnavi_adminImageKakikomi.tpl"})
({if $delete_flag==1})
({assign var="page_name" value="サービス編集"})
({elseif $delete_flag==2})
({assign var="page_name" value="サービス削除"})
({else})
({assign var="page_name" value="サービス登録"})
({/if})

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

({if $delete_flag==1})
<h2 id="ttl01">サービス編集【({$hall_name})】</h2>
({elseif $delete_flag==2})
<h2 id="ttl01">サービス削除【({$hall_name})】</h2>
({else})
<h2 id="ttl01">サービス登録【({$hall_name})】</h2>
({/if})
<br>
<div align=right>
<form name="add_room" method="POST" action="./">
<input type="hidden" name="m" value="({$module_name})" />
<input type="hidden" name="a" value="page_({$hash_tbl->hash('service_list','page')})" />
<input type="hidden" name="hall_id" value="({$hall_id})">
<input type="submit" value="　サービス一覧へ戻る　">
</form>
</div>
<br>
<center>
({if $msg})<p class="actionMsg">({$msg})</p>({/if})
({if $delete_flag==2})
<p class="actionMsg">以下のサービスを削除します。よろしいですか？</p>
※ このサービスが利用中の場合、部屋の利用リストからも削除されます。
({/if})
<br><br>

<form name="add_service" method="POST" action="./">
<input type="hidden" name="m" value="({$module_name})" />
<input type="hidden" name="a" value="do_({$hash_tbl->hash('add_service','do')})" />
<input type="hidden" name="sessid" value="({$PHPSESSID})" />
<input type="hidden" name="hall_id" value="({$hall_id})" >
({if $service_id})
<input type="hidden" name="service_id" value="({$service_id})" >
<input type="hidden" name="delete_flag" value="({$delete_flag})" >
({/if})

<table border=1 width=700>
<tr>
<td width="100" align="right" bgcolor="#FFD9DC" ><span style="margin:5px">
<b>サービス名称</b>：</span></td>
<td colspan="5" bgcolor="#FFD9DC" align=left><span style="margin:5px">
({if $delete_flag==2})
({$service_list.service_name})
<input type="hidden" name="service_name" value="({$service_list.service_name})" size=40 />
({else})
<input type="text" name="service_name" value="({$service_list.service_name})" size=40 />
({/if})
</span></td>
</tr>
<tr>
<td width="100" align="right" bgcolor="#FFFFCC" ><span style="margin:5px">
<b>使用料金</b>：</span></td>
<td colspan="5" bgcolor="#FFFFCC" align=left><span style="margin:5px">
({if $delete_flag==2})
({$service_list.price}) 円
({else})
<input type="text" name="price" value="({$service_list.price})" size=10 /> 円
({/if})
</span></td>
</tr>
<tr>
<td width="100" align="right" bgcolor="#FFD9DC" ><span style="margin:5px">
<b>最低予約数</b>：</span></td>
<td colspan="5" bgcolor="#FFD9DC" align=left><span style="margin:5px">
({if $delete_flag==2})
({$service_list.minimum_orders})
({else})
<input type="text" name="minimum_orders" value="({$service_list.minimum_orders})" size=10 />個以上の注文から予約を受け付けます。
({/if})
</span></td>
</tr>
<tr>
<td width="100" align="right" bgcolor="#FFFFCC" ><span style="margin:5px">
<b>キャンセル</b>：</span></td>
<td colspan="5" bgcolor="#FFFFCC" align=left><span style="margin:5px">
({if $delete_flag==2})
({if $service_list.cancel_mode==1})キャンセル料に含む({else})キャンセル料に含まない({/if})
({else})
<input type="radio" name="cancel_mode" value="1" ({if $service_list.cancel_mode==1})checked({/if})> キャンセル料に含む　
<input type="radio" name="cancel_mode" value="2" ({if $service_list.cancel_mode==2})checked({/if})> キャンセル料に含まない
({/if})
</span></td>
</tr>
<tr>
<td width="100" align="right" bgcolor="#FFD9DC" ><span style="margin:5px">
<b>状態</b>：</span></td>
<td colspan="5" bgcolor="#FFD9DC" align=left><span style="margin:5px">
({if $delete_flag==2})
({if $service_list.flag==1})公開({else})非公開({/if})
({else})
<input type="radio" name="flag" value="1" ({if $service_list.flag==1})checked({/if})> 公開　
<input type="radio" name="flag" value="2" ({if $service_list.flag==2})checked({/if})> 非公開
({/if})
</span></td>
</tr>
<tr>
<td width="100" align="right" bgcolor="#FFFFCC" ><span style="margin:5px">
<b>メモ１</b>：<br>（公開）</span></td>
<td colspan="5" bgcolor="#FFFFCC" align=left>
({if $delete_flag==2})
({$service_list.memo1|nl2br|t_url2cmd:'diary':$member.c_member_id|t_cmd:'diary'|t_decoration})
({else})
<textarea id="mce_editor_textarea" name="memo1" rows="({$_rows|default:'4'})" cols="({$_cols|default:'70'})">({$service_list.memo1})</textarea>
({/if})
</td>
</tr>
<tr>
<td width="100" align="right" bgcolor="#FFD9DC" ><span style="margin:5px">
<b>メモ２</b>：<br>（管理用）</span></td>
<td colspan="5" bgcolor="#FFD9DC" align=left>
({if $delete_flag==2})
({$service_list.memo2|nl2br|t_url2cmd:'diary':$member.c_member_id|t_cmd:'diary'|t_decoration})
({else})
<textarea id="mce_editor_textarea" name="memo2" rows="({$_rows|default:'4'})" cols="({$_cols|default:'70'})">({$service_list.memo2})</textarea>
({/if})
</td>
</tr>
<tr>
<td align=center colspan=6>

({if $delete_flag==1})
<input type="submit" value="　変　更　">
({elseif $delete_flag==2})
<input type="submit" value="　削　除　">
({else})
<input type="submit" value="　登　録　">
({/if})

</td>
</tr>
</table>
</form>

</center>

({else})
<br>
<center>
<span style="font-size: 16px; color: #FF0033;"><b>アクセス権がありません。</b></span>
</center>
({/if})
<div>
({$inc_footer|smarty:nodefaults})
