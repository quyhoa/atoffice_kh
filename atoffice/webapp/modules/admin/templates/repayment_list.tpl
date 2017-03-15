({$inc_header|smarty:nodefaults})
({ext_include file="inc_subnavi_adminStatisticalInformation.tpl"})
({assign var="page_name" value="未返金処理リスト"})
({ext_include file="inc_tree_adminStatisticalInformation.tpl"})
</div>


({*ここまで:navi*})

({*権限チェック*})
({if $atoffice_auth_type==4})

<script type="text/javascript">
function repay_confirm(){

}

function showDialog(id)
{
    var mail_flagA=document.getElementById("mail_flagA"+id);
    if(mail_flagA.checked)
    {
        document.getElementById("dialog_id").value=id;
        var overlay = document.getElementById("overlay");
        overlay.style.display="block";
        var idDialog = "dialog_"+id;
        var dialog = document.getElementById(idDialog);
        dialog.style.display="block";
      
    }
    else
    {
        document.getElementById("dialog_id").value=id;
        var overlay = document.getElementById("overlay");
        overlay.style.display="block";
        var idDialog = "dialogA_"+id;
        var dialog = document.getElementById(idDialog);
        dialog.style.display="block";
    }
}

function closeDialog(id)
{
      
    var overlay = document.getElementById("overlay");
    overlay.style.display="none";
    var idDialog = "dialog_"+id;
    var dialog = document.getElementsByClassName("dialog");
    var diaogId= document.getElementById("dialog_id");
    var id = diaogId.innerHTML;
    var dialog = document.getElementById(idDialog);
    dialog.style.display="none";
   
   
}

function closeDialog1(id)
{
    var overlay = document.getElementById("overlay");
    overlay.style.display="none";
    var idDialog = "dialogA_"+id;
    var dialog = document.getElementsByClassName("dialog");
    var diaogId= document.getElementById("dialog_id");
    var id = diaogId.innerHTML;
    var dialog = document.getElementById(idDialog);
    dialog.style.display="none";
}
function closeAllDialog()
{
      
    var overlay = document.getElementById("overlay");
    overlay.style.display="none";
    var id =document.getElementById("dialog_id").value;
    var idDialog = "dialog_"+id;
    var dialog = document.getElementById(idDialog);
    dialog.style.display="none";
    var idDialogA= "dialogA_"+id;
    var dialogA = document.getElementById(idDialogA);
    dialogA.style.display="none";
    return false;
   
   
}
</script>

<h2 id="ttl01">未返金処理リスト　(
({if $repayment_list})
	({$num})件中　({$index+1})件～
	({if $index+10 > $num})
		({$num})
	({else})
		({$index+10})
	({/if})
	件を表示
({else})
	0件
({/if})

)</h2>
<br>
<center>

({if $msg})<p class="actionMsg">({$msg})</p><br><br>({/if})

<form name="search" method="POST" action="./">
<input type="hidden" name="m" value="({$module_name})" />
<input type="hidden" name="a" value="page_({$hash_tbl->hash('repayment_list','page')})" />

<table border="1" width="800">
<tr>
<td colspan=4 bgcolor=#CDCDCD>検索オプション</td>
</tr>
<tr>
<th bgcolor=#FFD9DC>返金額</th>
<th bgcolor=#FFD9DC>予約ID</th>
<th bgcolor=#FFD9DC>返金登録日時範囲指定(年-月-日)</th>
<td rowspan=2 bgcolor=#FFD9DC>
<input type="submit" value="検索する">
</td>
</tr>
<tr>
<td>
<input type="text" name="repayment_money" value="({$repayment_money})" size=5 style="text-align:right;padding-right:5px;">円以上
</td>
<td>
<input type="text" name="reserve_id" value="({$reserve_id})">
</td>
<td>
<input type="text" name="begin_date" value="({$begin_date})" size="8"> ～
<input type="text" name="finish_date" value="({$finish_date})" size="8">
</td>
</tr>
</table>

</form>
<br>
({foreach from=$page_list item=item})
({if $item.select})
	({$item.page})
({else})
	<a href="./?m=admin&a=page_repayment_list&repayment_money=({$repayment_money})&reserve_id=({$reserve_id})&begin_date=({$begin_date})&finish_date=({$finish_date})&index=({$item.index})" >({$item.page})</a>
({/if})
|
({/foreach})
<hr>

({foreach from=$repayment_list key=key item=item})
<table border="1" width="800" class="table_popup">
<tr>
<td colspan=4 bgcolor=#CCFFFF>
<center>
■ 予約ID ({$item.reserve_id}) ■　返金登録日時({$item.add_datetime})
</center>
</td>
</tr>
<tr>
<td bgcolor=#FFD9DC width=100><span style='margin:5px;'>返金額</span></td>
<td><span style='margin:5px;'>({$item.repayment_money}) 円</span></td>
<td bgcolor=#FFD9DC width=100><span style='margin:5px;'>E-mail</span></td>
<td><span style='margin:5px;'>
<a href="mailto:({$item.mail})">({$item.mail})</a>
</span></td>
</td>
</tr>

<tr>
<td bgcolor=#FFD9DC width=100><span style='margin:5px;'>氏名</span></td>
<td><span style='margin:5px;'>
<a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('c_member_detail')})&amp;target_c_member_id=({$item.c_member.c_member_id})">({$item.c_member.nickname})</a>
</span></td>
<td bgcolor=#FFD9DC width=100><span style='margin:5px;'>法人・個人名</span></td>
<td><span style='margin:5px;'>({$item.corp})</span></td>
</td>
</tr>

<tr>
<td bgcolor=#FFD9DC width=100><span style='margin:5px;'>利用施設</span></td>
<td><span style='margin:5px;'>({$item.hall_name})</span></td>
<td bgcolor=#FFD9DC width=100><span style='margin:5px;'>部屋名</span></td>
<td><span style='margin:5px;'>({$item.room_name})</span></td>
</td>
</tr>

<tr>
<td bgcolor=#FFD9DC width=100><span style='margin:5px;'>仮予約申込日</span></td>
<td><span style='margin:5px;'>({$item.reserve_data.tmp_reserve_datetime})</span></td>
<td bgcolor=#FFD9DC width=100><span style='margin:5px;'>予約承認日</span></td>
<td><span style='margin:5px;'>({$item.reserve_data.reserve_datetime})</span></td>
</td>
</tr>

<tr>
<td bgcolor=#FFD9DC width=100><span style='margin:5px;'>利用開始時間</span></td>
<td><span style='margin:5px;'>({$item.reserve_data.begin_datetime})</span></td>
<td bgcolor=#FFD9DC width=100><span style='margin:5px;'>利用終了時間</span></td>
<td><span style='margin:5px;'>({$item.reserve_data.finish_datetime})</span></td>
</td>
</tr>

<tr>
<td bgcolor=#FFD9DC width=100><span style='margin:5px;'>入金締切日</span></td>
<td><span style='margin:5px;'>({$item.reserve_data.pay_limitdate})</span></td>
<td bgcolor=#FFD9DC width=100><span style='margin:5px;'>キャンセル日</span></td>
<td><span style='margin:5px;'>({$item.reserve_data.cancel_datetime})</span></td>
</td>
</tr>

<tr>
<td bgcolor=#FFD9DC width=100><span style='margin:5px;'>利用金額</span></td>
<td><span style='margin:5px;'>({$item.reserve_data.total_price}) 円</span></td>
<td bgcolor=#FFD9DC width=100><span style='margin:5px;'>入金済み金額</span></td>
<td><span style='margin:5px; float: left'>({$item.reserve_data.pay_money}) 円</span>
    <!-- <table style="border-collapse:collapse; height: 26px;">
        <tr>
            <td style="border-right:1px solid; border-left:1px solid" bgcolor=#FFD9DC width=100><span style='margin:5px;'>過剰入金</span></td>
            <td><span style='margin:5px;'>({$item.reserve_data.total}) 円</span></td>
        </tr>
    </table> -->
</td>
</td>
</tr>

<tr>
<td bgcolor=#FFD9DC width=100><span style='margin:5px;'>理由</span></td>
<td colspan=3 align=left><span style='margin:5px;'>
({$item.info|nl2br|t_url2cmd:'diary':$member.c_member_id|t_cmd:'diary'|t_decoration})
</span></td>
</tr>

<tr>
<td colspan=4>

<center>
   
    <form id="form({$item.reserve_id})">
        <input type='button' value='返金済みにする' onclick="showDialog(({$item.reserve_id}));"> 
      	<input type="radio" name="mail_flag({$item.reserve_id})" id="mail_flagA({$item.reserve_id})" value="1" checked>メールする
    	<input type="radio" name="mail_flag({$item.reserve_id})" id="mail_flagB({$item.reserve_id})" value="0">メールしない
    </form>  
   ({foreach from=$arrayBody item=mail_item})
   
   ({if $item.reserve_id==$mail_item.reserve_id})
    <form id="formA({$item.reserve_id})" name="add_payment" method="POST" action="./">
        <div style="display: none;background:#fff;height:550px;width:700px;padding:10px;" class="dialog" id="dialog_({$item.reserve_id})">
             <table align="center" border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
    			<tbody>
    				<tr>
    					<td>
                            <input type="hidden" name="m" value="({$module_name})" />
            	            <input type="hidden" name="a" value="do_({$hash_tbl->hash('repayment','do')})" />
            	            <input type="hidden" name="repayment_id" value="({$item.repayment_id})">	
                            <input type="hidden" name="reserve_id" value="({$item.reserve_id})">
                            <input type="hidden" name="repayment_money" value="({$item.repayment_money})" />
                        	<input type="hidden" name="sessid" value="({$PHPSESSID})" />
                           	<input id="txtEmail" type="hidden" name="txtEmail" value="1"/>
                        </td>
    				</tr>
    				<tr>
    					<td style="text-align: center;">&nbsp</td>
    				</tr>
    				<tr>
    					<td style="text-align: center;">
                           <dt>
                                 <strong class="item">本文</strong>
                           </dt>
                           <dd>
                                <textarea name="body" cols="({$cols|default:72})" rows="({$rows|default:30})">({$mail_item.body})</textarea>
                           </dd>
                        </td>
    				</tr>
                    <tr>
    					<td style="text-align: center;">&nbsp</td>
    				</tr>
    				<tr>
    					<td style="text-align: center;">
    						<input name="OK" type="submit" value="送信"  onclick="return closeDialog(({$item.reserve_id}));"/>&nbsp;
                            <input name="Cancel" type="button" value="戻る" onclick="return closeDialog(({$item.reserve_id}));"/>
                        </td>
    				</tr>
    			</tbody>
    		</table>
        </div>
        </form>  
        <form id="formB({$item.reserve_id})" name="add_payment" method="POST" action="./">
        <div style="display: none;background:#fff;height:100px;width:200px;padding:10px;" class="dialog1" id="dialogA_({$item.reserve_id})">
             <table align="center" border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
    			<tbody>
    				<tr>
    					<td>
                            <input type="hidden" name="m" value="({$module_name})" />
            	            <input type="hidden" name="a" value="do_({$hash_tbl->hash('repayment','do')})" />
            	            <input type="hidden" name="repayment_id" value="({$item.repayment_id})">	
                            <input type="hidden" name="reserve_id" value="({$item.reserve_id})">
                            <input type="hidden" name="repayment_money" value="({$item.repayment_money})" />
                        	<input type="hidden" name="sessid" value="({$PHPSESSID})" />
                           	<input id="txtEmail" type="hidden" name="txtEmail" value="0" />
                        </td>
    				</tr>
    				<tr>
    					<td style="text-align: center;">&nbsp</td>
    				</tr>
    				<tr>
    					<td style="text-align: center;">
                        返金済みにしますか？
                        </td>
    				</tr>
                    <tr>
    					<td style="text-align: center;">&nbsp</td>
    				</tr>
    				<tr>
    					<td style="text-align: center;">
    						<input name="OK" type="submit" value="OK" onclick="return closeDialog1(({$item.reserve_id}));"/>&nbsp;
                            <input name="Cancel" type="button" value="キャンセル" onclick="return closeDialog1(({$item.reserve_id}));"/>
                        </td>
    				</tr>
    			</tbody>
    		</table>
        </div>
        </form> 
         ({/if})
   
     ({/foreach})
     
</center>
</td>
</tr>
</table>
<br>
({foreachelse})
未返金データはありませんでした。
({/foreach})
<hr>
({foreach from=$page_list item=item})
({if $item.select})
	({$item.page})
({else})
	<a href="./?m=admin&a=page_repayment_list&repayment_money=({$repayment_money})&reserve_id=({$reserve_id})&begin_date=({$begin_date})&finish_date=({$finish_date})&index=({$item.index})" >({$item.page})</a>
({/if})
|
({/foreach})


</center>
({else})
<br>
<center>
<span style="font-size: 16px; color: #FF0033;">
    <b>アクセス権がありません。</b>
</span>
</center>
({/if})
<div>
({$inc_footer|smarty:nodefaults})
<div id="overlay" class="web_dialog_overlay" onclick="return closeAllDialog()">
    <input hidden="" value="" id="dialog_id">
</div>
<style>
table.table_popup{
    margin:0;
    position:relative;
}
 .web_dialog_overlay {
    background: none repeat scroll 0 0 #000000;
    bottom: 0;
    display: none;
    height: 100%;
    left: 0;
    margin: 0;
    opacity: 0.15;
    padding: 0;
    position: fixed;
    right: 100;
    top: 0;
    width: 100%;
    z-index: 101;
}
.dialog{
    position: absolute;
    width: 200px;
    z-index: 300;
    background:#FFFFFF;
    left:10%;
    top:0%;
    border: 2px solid #000;
    border-radius:5px;
}

.dialog1{
    position: absolute;
    width: 200px;
    z-index: 300;
    background:#FFFFFF;
    left:35%;
    top:60%;
    border: 2px solid #000;
    border-radius:5px;
}
</style>
