({$inc_header|smarty:nodefaults})
({ext_include file="inc_subnavi_adminSiteMember.tpl"})
({assign var="page_name" value="請求金額設定"})
({ext_include file="inc_tree_adminSiteMember.tpl"})
</div>

({*ここまで:navi*})

({*権限チェック*})
({if $atoffice_auth_type==2 or $atoffice_auth_type==4})

<style type="text/css">
<!--
HR {
	border-style:dotted;color:#3399FF

}
-->
</style>

<script type="text/javascript">
function confirm1(){
	if(window.confirm('【最終確認】\nもう一度データをよく確認して、よろしければOKを押してください。')){
		return;
	}else{
		return false;
	}
}
</script>

　<a href="./?m=admin&a=page_reserve_revision&reserve_id=({$reserve_data.reserve_id})">予約修正</a>｜<br>
<br>
<h2 id="ttl01">請求金額設定</h2>
<br>

<center>
({if $msg})<p class="actionMsg">({$msg})</p>({/if})

<br><br>

<form onSubmit="return confirm1();" name="set_amount_billed" method="POST" action="./">
<input type="hidden" name="m" value="({$module_name})" />
<input type="hidden" name="a" value="do_({$hash_tbl->hash('set_amount_billed','do')})" />
<input type="hidden" name="sessid" value="({$PHPSESSID})" />
<input type="hidden" name="reserve_id" value="({$reserve_data.reserve_id})">
<input type="hidden" name="billed_id" value="({$ab_data.billed_id})">

<table border=1 width=800>
<tr>
<th colspan=4 bgcolor=#55FFFF>予約ID:({$reserve_data.reserve_id})</th>
</tr>
<tr>
<td width=100 bgcolor=#DEDEDE>請求金額</td>
<td>
<input type="text" name="total_billed_money" value="
({if $ab_data.total_billed_money})
({$ab_data.total_billed_money})
({else})
0
({/if})
" style="text-align:right;">円
</td>
<td width=100 bgcolor=#DEDEDE>入金期限</td>
<td>
<input type="text" name="pay_limitdate" value="
({if $ab_data.pay_limitdate})
({$ab_data.pay_limitdate})
({else})
0000-00-00 00:00:00
({/if})
">
</td>
</tr>

<tr>
<td width=100 bgcolor=#DEDEDE>入金済み金額</td>
<td>
<input type="text" name="pay_money" value="
({if $ab_data.pay_money})
({$ab_data.pay_money})
({else})
0
({/if})
" style="text-align:right;">円
</td>
<td width=100 bgcolor=#DEDEDE>入金日</td>
<td>
<input type="text" name="check_datetime" value="
({if $ab_data.check_datetime})
({$ab_data.check_datetime})
({else})
0000-00-00 00:00:00
({/if})
">
</td>
</tr>

<tr>
<td width=100 bgcolor=#DEDEDE>バーチャル口座</td>
<td>
({if $ab_data.virtual_code})
({$ab_data.virtual_code})
<input type="hidden" name="virtual_code" value="({$ab_data.virtual_code})">
({else})
-- --
({/if})
</td>
<td width=100 bgcolor=#DEDEDE>請求状態</td>
<td>
<input type="radio" name="flag" value="0" ({if $ab_data.flag==0})checked({/if})>未完了
<input type="radio" name="flag" value="1" ({if $ab_data.flag==1})checked({/if})>完了
<br>
({if $ab_data.flag==0 and $ab_data.pay_money==0})
【未入金】
({elseif $ab_data.flag==0 and $ab_data.pay_money>0})
【一部入金】
({elseif $ab_data.flag==1 and $ab_data.pay_money>$ab_data.total_billed_money})
【過剰入金】
({elseif $ab_data.flag==1 and $ab_data.pay_money==$ab_data.total_billed_money})
【入金済み】
({/if})
</td>
</tr>

<tr>
<td width=100 bgcolor=#DEDEDE>請求番号</td>
<td colspan=3>
<input type="text" name="bill_id" value="({$ab_data.bill_id})">　
<input type="radio" name="renew_bill_id" value="0" checked>テキスト入力　
<input type="radio" name="renew_bill_id" value="1">新規請求番号取得
</td>
</tr>

<tr>
<td width=100 bgcolor=#DEDEDE>理由</td>
<td colspan=3>
<textarea id="mce_editor_textarea" name="info" rows="({$_rows|default:'4'})" cols="({$_cols|default:'70'})">({$ab_data.info})</textarea>
</td>

</tr>

<tr>
<td colspan=4>
<input type="submit" value="　更　新　">

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
