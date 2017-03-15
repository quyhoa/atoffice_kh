({$inc_header|smarty:nodefaults})
({ext_include file="inc_subnavi_adminSiteMember.tpl"})
({assign var="page_name" value="予約備品入力"})
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
var pre_id="({$pre_id})";
    var tryingToReload = true;
    window.onbeforeunload = function(e) //on before unload
    {
        if (!e) //Firefox and Safari gets argument directly.
        {
            e = window.event; // this is for IE
        }
    
        if (e.clientY != undefined && e.clientY < 0) // clicked on the close   button for IE
        {
             tryingToReload = true;
        }
        
        if (e.clientY != undefined && (e.clientY > 100 && e.clientY < 140)) //    select close from context menu from the right click on title bar on IE
        {
            tryingToReload = true;
        }
        console.log(tryingToReload);
        if (tryingToReload)
        {
            e = e || window.event;
            var url="?m=admin&a=page_clear_reserve&pid="+pre_id;
            var post=null;
            var xmlHttp = new XMLHttpRequest();
        	xmlHttp.open("POST", url, false);
        	xmlHttp.setRequestHeader("Content-Type" , "application/x-www-form-urlencoded;charset=UTF-8");
        	xmlHttp.send(post);
            
            return ;
        }
    }
    document.onkeydown = function(e) //attach to key down event to detect the F5 key
    {
        if (!e) //Firefox and Safari gets argument directly.
        {
            e = window.event;
        }
        tryingToReload=true;
        var key = e.keyCode ? e.keyCode : e.which;
        
        try //try
        {
               switch (key){
                  case 116 : //F5 button
                      tryingToReload=false;break;
                  case 82 : //R button
                          if (event.ctrlKey){ 
                             tryingToReload=false;break;
                          }
                    }
        }
        catch (ex) { }
        }

    document.oncontextmenu = function(e) //check for the right click
    {
        
        var srcElement = getEventSrc(e);
        tryingToReload=true;
        var tagName = '';
        if (srcElement.tagName != undefined) //Get the name of the tag
        {
            tagName = srcElement.tagName;
        }
        switch (tagName)
        {
            case "BODY":
            case "TD":
            case "DIV":
            case "CENTER":
            {
                tryingToReload = false;
                break;
            }
            default:
            break;
        }
    }

    function getEventSrc(e)
    {
        if (this.Event)
        {
        var targ = e.target;
        //nodeType of 1 means ELEMENT_NODE
          return targ.nodeType == 1 ? targ : targ.parentNode;
        }
        else //this is for IE
         return event.srcElement;
    }

    document.onclick = function(e) 
    {
        tryingToReload = false;
    }
	
	function pre_kanban(){
		kanban = encodeURI(document.getElementById("kanban").value);
		window.open('./atoffice/pages/sub/kanban.php?kanban='+kanban,'','scrollbars=yes,width=1050,height=750,');

	}
	function readCookie(name) {
		var i, c, ca, nameEQ = name + "=";
		ca = document.cookie.split(';');
		for(i=0;i < ca.length;i++) {
			c = ca[i];
			while (c.charAt(0)==' ') {
				c = c.substring(1,c.length);
			}
			if (c.indexOf(nameEQ) == 0) {
				return c.substring(nameEQ.length,c.length);
			}
		}
		return '';
	}
	function writeCookie(name,value,days) {
		var date, expires;
		if (days) {
			date = new Date();
			date.setTime(date.getTime()+(days*24*60*60*1000));
			expires = "; expires=" + date.toGMTString();
				}else{
			expires = "";
		}
		document.cookie = name + "=" + value + expires + "; path=/";
	}
	/*window.onload=function(){
		var pid='({$pid})';
		var objKaban = document.getElementById('kanban');
		if(pid !=""){
			var kanban=readCookie('kanban_'+pid);
			if(kanban && kanban !='undefined'){
				objKaban.value=kanban;
				
			}
			objKaban.onchange=function(){
				var dt = objKaban.value;
				writeCookie('kanban_'+pid, dt, 1);
			};
		}
		
	};*/
</script>

<h2 id="ttl01">予約備品入力</h2>
<br>
<center>
({if $msg})<p class="actionMsg">({$msg})</p><br><br>
<INPUT TYPE=button VALUE="　戻る　" style="width:250px;font:20px;border:3px ridge;background:#090;color:#fff; padding:3px; font-weight:bold;" onClick="self.history.back()">
({else})

<form name="do_set_reserve" method="POST" action="./">
<input type="hidden" name="m" value="({$module_name})" />
<input type="hidden" name="a" value="page_({$hash_tbl->hash('set_reserve_list','page')})" />
<input type="hidden" name="hall_id" value="({$hall_id})">
<input type="hidden" name="room_id" value="({$room_id})">
<input type="hidden" name="begin_datetime" value="({$begin_datetime})">
<input type="hidden" name="finish_datetime" value="({$finish_datetime})">
<input type="hidden" name="purpose" value="({$purpose})">
<input type="hidden" name="people" value="({$people})">
<input type="hidden" name="room_price" value="({$room_price})">
<input type="hidden" name="c_member_id" value="({$c_member_id})">
<input type="hidden" name="vessel_num" value="({$vessel_num})">
<input type="hidden" name="service_num" value="({$service_num})">
<input type="hidden" name="pre_id" value="({$pre_id})">
<input type="hidden" name="year" value="({$year})">
<input type="hidden" name="month" value="({$month})">
<input type="hidden" name="day" value="({$day})">
<input type="hidden" name="pid" value="({$pid})">
<input type="hidden" name="edit" value="({$edit})">
<table border=1 width=700>
<tr>
<td width=100 bgcolor=#AACCFF>利用施設名</td>
<td width=250>({$hall_name})</td>
<td width=100 bgcolor=#AACCFF>部屋名</td>
<td width=250>
({$room_name})
</td>
</tr>
<tr>
<td bgcolor=#AACCFF>利用日時</td>
<td colspan=3>({$begin}) ～ ({$finish})</td>
</tr>

<tr>
<td width=100 bgcolor=#AACCFF>利用目的</td>
<td>
({if $purpose==0})
	未選択
({elseif $purpose==1})
	会議
({elseif $purpose==2})
	セミナー
({elseif $purpose==3})
	研修
({elseif $purpose==4})
	面接・試験
({elseif $purpose==5})
	懇談会・パーティ
({elseif $purpose==6})
	その他
({/if})
</td>
<td width=100 bgcolor=#AACCFF>利用人数</td>
<td>
({$people}) 人
({if $over_flag})
    <span style="color:#FF0000;">　<b>【注意:定員オーバー】</b></span>
({/if})
</td>
</tr>

<tr>
<td bgcolor=#AACCFF>利用料金</td>
<td colspan=3>
({if $waribiki})({$waribiki})：({/if})
({$room_price}) 円
</td>
</tr>

<tr>
<td bgcolor=#AACCFF>看板入力</td>
<td colspan=3>
<textarea id=kanban name=kanban rows="3" cols="40">({$kanban})</textarea>
<input type="button" value="　プレビュー　" onClick="pre_kanban();"/>
</td>
</tr>

<tr>
<td bgcolor=#AACCFF>顧客ID</td>
<td>
({if $c_member_id})
	({$c_member_id})
({else})
	-- --
({/if})
</td>
<td bgcolor=#AACCFF>顧客氏名</td>
<td>
({if $c_member_id})
	<a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('c_member_detail')})&amp;target_c_member_id=({$c_member_id})">({$c_member.nickname})【({$guest})】</a>
({else})
	新規契約者
({/if})
</td>
</tr>

</table>
<br>

({if $vessel_list})
<table border=1 width=700>
<tr>
<th colspan=6 bgcolor=#EEFFCC>備品選択</th>
</tr>
<tr>
<th bgcolor=#DEDEDE>選択</th>
<th bgcolor=#DEDEDE>名称</th>
<th bgcolor=#DEDEDE>利用料金</th>
<th bgcolor=#DEDEDE>数量</th>
<th bgcolor=#DEDEDE>料金区分</th>
<th bgcolor=#DEDEDE>メモ</th>
</tr>
({foreach from=$vessel_list key=key item=value})
	<tr>
	<td>
    ({if $value.remainder})
		<input type="checkbox" ({if $value.check==1})checked="checked"({/if}) name="select_vessel({$key})" value="({$value.vessel_id})" >
	({else})
		--
	({/if})

	</td>
	<td>
	({$value.vessel_name})
	</td>
	<td>
	({$value.price}) 円
	</td>
	<td>
	({if $value.remainder})
       	<select name="remainder({$key})">
		({foreach from=$value.remainder item=item})
			<option value="({$item})" ({if $item==$value.number})selected="selected"({/if})>({$item})</option>
		({/foreach})
		</select>
	({else})
		在庫切れ
	({/if})
	</td>
	<td>
	({if $value.charge_devision==1})
		予約毎
	({else})
		時間毎
	({/if})
	</td>
	<td>
		({$value.memo1|nl2br|t_url2cmd:'diary':$member.c_member_id|t_cmd:'diary'|t_decoration})
	</td>
	</tr>
({/foreach})

</table>
<br>
({/if})

({if $service_list})
<table border=1 width=700>
<tr>
<th colspan=6 bgcolor=#EECCFF>サービス選択</th>
</tr>
<tr>
<th bgcolor=#DEDEDE>選択</th>
<th bgcolor=#DEDEDE>名称</th>
<th bgcolor=#DEDEDE>利用料金</th>
<th bgcolor=#DEDEDE>数量</th>
<th bgcolor=#DEDEDE>キャンセル料に<br>含まれるか</th>
<th bgcolor=#DEDEDE>メモ</th>
</tr>
({foreach from=$service_list key=key item=value})
	<tr>
	<td>
	<input type="checkbox" name="select_service({$key})" value="({$value.service_id})" ({if $value.check==1})checked="checkde"({/if}) >
	</td>
	<td>
	({$value.service_name})
	</td>
	<td>
	({$value.price}) 円
	</td>
	<td>
	<input type="text" name="service_remainder({$key})" value="({if $value.number >0})({$value.number})({else})({$value.minimum_orders})({/if})" style="text-align:right;padding-right:5px;"><br>
	最低予約数：({$value.minimum_orders})
	</td>
	<td>
	({if $value.cancel_mode==1})
		含む
	({else})
		含まない
	({/if})
	</td>
	<td>
		({$value.memo1|nl2br|t_url2cmd:'diary':$member.c_member_id|t_cmd:'diary'|t_decoration})
	</td>
	</tr>
({/foreach})

</table>
({/if})


<br>
<INPUT TYPE=button VALUE="　戻る　" style="width:250px;font:20px;border:3px ridge;background:#090;color:#fff; padding:3px; font-weight:bold;" onClick="self.history.back()">
<INPUT TYPE="submit" VALUE="　確認　" style="width:250px;font:20px;border:3px ridge;background:#090;color:#fff; padding:3px; font-weight:bold;">

</form>

</center>

({/if})({** if $mes ***})

({else})
<br>
<center>
<span style="font-size: 16px; color: #FF0033;"><b>アクセス権がありません。</b></span>
</center>
({/if})
<div>
({$inc_footer|smarty:nodefaults})
