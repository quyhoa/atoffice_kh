({$inc_header|smarty:nodefaults})
({ext_include file="inc_subnavi_adminSiteMember.tpl"})
({assign var="page_name" value="予約入力"})
({ext_include file="inc_tree_adminSiteMember.tpl"})
</div>

({*ここまで:navi*})

({*権限チェック*})
({if $atoffice_auth_type==2 or $atoffice_auth_type==4})
<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
<script type="text/javascript">
    var JQry = jQuery.noConflict();
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
        tryingToReload=true;
        if (!e) //Firefox and Safari gets argument directly.
        {
            e = window.event;
        }

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
    function linecheck(line) {
        var mode = (document.getElementById('sd' + line + '_0').checked) ? false : true;
        for (var i = 0; i < 100; i++) {
            var a = document.getElementById('sd' + line + '_' + i);
            if (a == null)
                break;
            a.checked = mode;
        }
    }

    function setRoomID(room_id) 
    {
        document.forms["reserve"].elements["room_id"].value = room_id;
        document.forms["reserve"].elements["a"].value = "page_({$hash_tbl->hash('set_reserve','page')})";
        return true;
    }
    function setYMD(y, m, d) {
        document.forms["reserve"].elements["year"].value = y;
        document.forms["reserve"].elements["month"].value = m;
        document.forms["reserve"].elements["day"].value = d;
        document.forms["reserve"].elements["a"].value = "page_({$hash_tbl->hash('set_reserve','page')})";
        return true;
    }

    
</script>

<style type="text/css">
    <!--
    HR {
        border-style:dotted;color:#3399FF

    }
    -->
</style>

<h2 id="ttl01">予約入力</h2>
<br>
<center>
    ({if $msg2})<p class="actionMsg">({$msg2})</p>
       <form name="change_date1" method="POST" action="./" id='frmBack'>
            <input type="hidden" name="m" value="({$module_name})" />
            <input type="hidden" name="a" value="page_({$hash_tbl->hash('set_reserve','page')})" />
            <input type="hidden" name="hall_list" value="({$hall_id})">
            <input type="hidden" name="year" value="({$year})">
            <input type="hidden" name="month" value="({$month})">
            <input type="hidden" name="day" value="({$day})">
            <input type="hidden" name="pre_id" value="({$pre_id})">
            ({if $old_member != ''})
                <input type="hidden" name="old_member" value="({$old_member})">
            ({/if})
            ({if $old_hall != ''})
                <input type="hidden" name="old_hall" value="({$old_hall})">
            ({/if})
           <INPUT TYPE=button VALUE="　戻る　" style="width:250px;font:20px;border:3px ridge;background:#090;color:#fff; padding:3px; font-weight:bold;" onClick="this.form.submit()">
   
        </form>
     </form>
    ({else})
    ({if $msg})<p class="actionMsg">({$msg})</p>({/if})
    <br><br>


    <table border=1>
        <tr>
        <form name="change_hall_id" method="POST" action="./">
            <input type="hidden" name="m" value="({$module_name})" />
            <input type="hidden" name="a" value="page_({$hash_tbl->hash('set_reserve','page')})" />
            <input type="hidden" name="pre_id" value="({$pre_id})">
            ({if $old_member != ''})
                <input type="hidden" name="old_member" value="({$old_member})">
            ({/if})
            ({if $old_hall != ''})
                <input type="hidden" name="old_hall" value="({$old_hall})">
            ({/if})
            <td>会場選択</td>
            <td>
                <select name="hall_list">
                    ({foreach from=$hall_list item=item})
                    <option value="({$item.hall_id})" 
                            ({if $item.hall_id==$hall_id})
                            selected="selected"
                            ({/if})
                            >
                        ({$item.hall_name})
                    </option>
                    ({/foreach})
                </select>
            </td>
            <td rowspan=2 style="vertical-align:middle">
                <input type="submit" value="　変更　">
            </td>
            </tr>

            <tr>
                <td>日付変更</td>
                <td>
                    <select name="year">
                        <option value="({$this_year})" ({if $this_year==$year})selected({/if})>({$this_year})</option>
                        <option value="({$this_year+1})" ({if $this_year+1==$year})selected({/if})>({$this_year+1})</option>
                    </select> 年 
                    <select name="month">
                        ({foreach from=$month_list item=item})
                        <option value="({$item})" ({if $item==$month})selected({/if})>({$item})</option>
                        ({/foreach})
                    </select> 月 
                    <select name="day">
                        ({foreach from=$day_list key=key item=item})
                        <option value="({$item})" ({if $item==$day})selected({/if})>({$item})(({$week_list.$key}))</option>
                        ({/foreach})
                    </select> 日 
                </td>
        </form>
        </tr>

        <tr>
            <td>
                <form name="change_date1" method="POST" action="./">
                    <input type="hidden" name="m" value="({$module_name})" />
                    <input type="hidden" name="a" value="page_({$hash_tbl->hash('set_reserve','page')})" />
                    <input type="hidden" name="hall_list" value="({$hall_id})">
                    <input type="hidden" name="year" value="({$year})">
                    <input type="hidden" name="month" value="({$month})">
                    <input type="hidden" name="day" value="({$day-1})">
                    <input type="hidden" name="pre_id" value="({$pre_id})">
                    ({if $old_member != ''})
                        <input type="hidden" name="old_member" value="({$old_member})">
                    ({/if})
                    ({if $old_hall != ''})
                        <input type="hidden" name="old_hall" value="({$old_hall})">
                    ({/if})
                    <input type="submit" value="←前日">
                </form>
            </td>

            <td>
                <form name="change_date1" method="POST" action="./">
                    <input type="hidden" name="m" value="({$module_name})" />
                    <input type="hidden" name="a" value="page_({$hash_tbl->hash('set_reserve','page')})" />
                    <input type="hidden" name="hall_list" value="({$hall_id})">
                    <input type="hidden" name="pre_id" value="({$pre_id})">
                    ({if $old_member != ''})
                        <input type="hidden" name="old_member" value="({$old_member})">
                    ({/if})
                    ({if $old_hall != ''})
                        <input type="hidden" name="old_hall" value="({$old_hall})">
                    ({/if})
                    <input type="submit" value="今日">
                </form>
            </td>

            <td>
                <form name="change_date1" method="POST" action="./">
                    <input type="hidden" name="m" value="({$module_name})" />
                    <input type="hidden" name="a" value="page_({$hash_tbl->hash('set_reserve','page')})" />
                    <input type="hidden" name="hall_list" value="({$hall_id})">
                    <input type="hidden" name="year" value="({$year})">
                    <input type="hidden" name="month" value="({$month})">
                    <input type="hidden" name="day" value="({$day+1})">
                    <input type="hidden" name="pre_id" value="({$pre_id})">
                    ({if $old_member != ''})
                        <input type="hidden" name="old_member" value="({$old_member})">
                    ({/if})
                    ({if $old_hall != ''})
                        <input type="hidden" name="old_hall" value="({$old_hall})">
                    ({/if})
                    <input type="submit" value="翌日→">
                </form>
            </td>
        </tr>

        <tr>
            <td>利用予定人数</td>
            <td colspan=2>
                <form name="reserve" method="POST" action="./">
                    <input type="hidden" name="pre_id" value="({$pre_id})">
                    <input type="hidden" name="old_member" value="({$old_member})">
                    <input type="hidden" name="m" value="({$module_name})" />
                    <input type="hidden" name="set_reserve" value="1">
                    <input type="hidden" name="a" value="page_({$hash_tbl->hash('set_reserve_vessel','page')})" />
                    <input type="hidden" name="hall_list" value="({$hall_id})">
                    <input type="text" name="people" value=""> 人 
                    ({if $old_hall != ''})
                        <input type="hidden" name="old_hall" value="({$old_hall})">
                    ({/if})
                    </td>
                    </tr>
                    <tr>
                        <td>利用目的</td>
                        <td colspan=2>
                            <select name="purpose">
                                <option value="0">--未選択--</option>
                                <option value="1">会議</option>
                                <option value="2">セミナー</option>
                                <option value="3">研修</option>
                                <option value="4">面接・試験</option>
                                <option value="5">懇談会・パーティ</option>
                                <option value="6">その他</option>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td>顧客ID番号</td>
                        <td colspan=2>
                            <input type="text" name="c_member_id" value="({$old_member})"><br>
                            ※ 新規の場合は未入力
                        </td>
                    </tr>
                    ({if !$periodmode})
                    <tr>
                        <td>表示日数</td>
                        <td colspan=2>
                            <select name="period">
                                ({section name=i start=1 loop=32 step=1})
                                <option value="({$smarty.section.i.index})"
                                        ({if $smarty.section.i.index==$period}) selected({/if})
                                        >({$smarty.section.i.index})</option>
                                ({/section})
                            </select> ※部屋の「日付範囲表示」で表示される日数

                        </td>
                    </tr>
                    ({/if})

    </table>
    <br>



    <table width=100%>
        <tr>
            <td height=60px bgcolor=#CCCCFF style='border: 1px #000000 solid;text-align:center;vertical-align:middle;font-size:15px;'>
                <b>({$hall_data.hall_name}) 
                    ({if $periodmode})
                    ({$room_data.room_name}) (({$room_data.max})人)<br>
                    ({if $room_data.type==2})最低({$room_data.lowest_koma})コマ以上({/if})
                    ({else})
                    ({$year})年({$month})月({$day})日（({$week})）</b>
                ({/if})
                <input type="submit" value="備品選択へ">
                <input type="hidden" name="year" value="({$year})">
                <input type="hidden" name="month" value="({$month})">
                <input type="hidden" name="day" value="({$day})">
                <input type="hidden" name="hid" value="({$hall_id})">
                <input type="hidden" name="pre_id" value="({$pre_id})">
            </td>
        </tr>
    </table>
    <table width=100%>

        ({assign var=line value=0})

        ({if $periodmode})
        ({* ------------------ period mode ----------------------*})

        <input type="hidden" name="room_id" value="({$room_id})">
        ({foreach from=$period_data key=key item=value})
        ({if ($line%5)==0})
        <tr>
            <th style='border: 1px #000000 solid;text-align: center;' width="150">
                日付

            </th>
            <th></th>

            ({foreach from=$open_time item=time})

            <th bgcolor=#CDCDCD style='border: 1px #000000 solid;text-align: center;' colspan=4><b>
                    ({$time}):00 ～ ({$time+1}):00
                </b></th>
            ({/foreach})
        </tr>
        ({/if})
        ({assign var=cb value=0})

        <tr>
            <td style='border: 1px #000000 solid;text-align: center;' >
                <b>({$value.year})年({$value.month})月({$value.day})日（({$value.week})）</b><br />
                ({if $room_data.type==2})最低({$room_data.lowest_koma})コマ以上({/if})<br />
                <input type="submit" value="この日を表示" onClick="setYMD(({$value.year}), ({$value.month}), ({$value.day}))">
            </td>
            <td><input type="button" value=">>" onClick="linecheck(({$line}))"></td>
            ({if $value.holiday})
            <td colspan=({$ct*4}) style='border: 1px #000000 solid;text-align: center;' bgcolor=#FF6666><b>休室日</b></td>
        </tr>
        ({else})({*value.holiday*})

        ({if $room_data.type==2})
        ({foreach from=$value.opentime key=k item=v})
         <td style='border: 1px #000000 solid;text-align: center;vertical-align:middle;'
         ({if $value.usedate==1 && $v.style && !$v.reserved && !$v.checked && !$v.stoped})
            bgcolor= #FFE7D6
            ({elseif $value.usedate==0  && !$v.reserved && !$v.checked && !$v.stoped})
            bgcolor= #FFE7D6
            ({/if}) colspan=({$v.cs}) 
            ({if $v.reserved})            
            bgcolor=#FFDCDC>
            <span style='color:#FF0000;'><b>
                    <a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('reserve_view')})&amp;reserve_id=({$v.reserved})">
                        予約ID:({$v.reserved})</a><br>
                    代表名：({$v.corp})<br>
                    予約者：({$v.c_member.nickname}) 様<br>
                    状態：
                    ({if $v.reserve_data.tmp_flag==1})
                    仮予約
                    ({elseif $v.reserve_data.pay_flag==0 and $v.reserve_data.pay_money==0})
                    未入金
                    ({elseif $v.reserve_data.pay_flag==0 and $v.reserve_data.pay_money>0})
                    一部入金
                    ({elseif $v.reserve_data.pay_flag==1})
                    入金済み
                    ({elseif $v.reserve_data.pay_flag==2})
                    過剰入金
                    ({/if})
                </b></span>
            ({elseif $v.checked})
            bgcolor=#FFCCFF>予約
            ({elseif $v.stoped})

            bgcolor=#FFCCFF>貸し止め中<br>
            有効期限：({$v.stoped.limit_datetime})<br>
            担当者：({$v.stoped.admin_name})<br>
            ({$v.stoped.memo})<br>
            予約：<input type='checkbox' name='reserve_data({$key})_({$k})' id='sd({$key})_({$cb})' value='({$hall_data.hall_id}),({$room_id}),({$value.year})-({$value.month})-({$value.day}) ({$v.begin_time}),({$value.year})-({$value.month})-({$value.day}) ({$v.finish_time}),({$room_data.type})'>
            ({assign var=cb value=$cb+1})
            
            ({else})
            >
            <input type='checkbox' name='reserve_data({$key})_({$k})' id='sd({$key})_({$cb})' value='({$hall_data.hall_id}),({$room_id}),({$value.year})-({$value.month})-({$value.day}) ({$v.begin_time}),({$value.year})-({$value.month})-({$value.day}) ({$v.finish_time}),({$room_data.type})'>
            ({assign var=cb value=$cb+1})
            ({/if})
        </td>
        ({/foreach})
        ({else})({*type*})
        ({foreach from=$value.komawari key=k item=v})
        <td style='border: 1px #000000 solid;text-align: center;vertical-align:middle;' colspan=({$v.cs}) 
            ({if $v.reserved})
            bgcolor=#FFDCDC><span style='color:#FF0000;'><b>
                    <a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('reserve_view')})&amp;reserve_id=({$v.reserved})">
                        予約ID:({$v.reserved})</a><br>
                    代表名：({$v.corp})<br>
                    予約者：({$v.c_member.nickname}) 様<br>
                    状態：
                    ({if $v.reserve_data.tmp_flag==1})
                    仮予約
                    ({elseif $v.reserve_data.pay_flag==0 and $v.reserve_data.pay_money==0})
                    未入金
                    ({elseif $v.reserve_data.pay_flag==0 and $v.reserve_data.pay_money>0})
                    一部入金
                    ({elseif $v.reserve_data.pay_flag==1})
                    入金済み
                    ({elseif $v.reserve_data.pay_flag==2})
                    過剰入金
                    ({/if})
                    <br>


                </b></span>
            ({elseif $v.rest})
            bgcolor=#CDCDCD>休憩
            ({elseif $v.checked})
            bgcolor=#FFCCFF>予約
            ({elseif $v.stoped})
            bgcolor=#FFCCFF>貸し止め中<br>
            有効期限：({$v.stoped.limit_datetime})<br>
            担当者：({$v.stoped.admin_name})<br>
            ({$v.stoped.memo})<br>
            <input type='checkbox' name='reserve_data({$key})_({$k})' id='sd({$key})_({$cb})' value='({$hall_data.hall_id}),({$room_id}),({$value.year})-({$value.month})-({$value.day}) ({$v.begin_time}),({$value.year})-({$value.month})-({$value.day}) ({$v.finish_time}),({$room_data.type})'>
            ({assign var=cb value=$cb+1})
            
            ({else})
            >
            <input type='checkbox'  name='reserve_data({$key})_({$k})' id='sd({$key})_({$cb})' value='({$hall_data.hall_id}),({$room_id}),({$value.year})-({$value.month})-({$value.day}) ({$v.begin_time}),({$value.year})-({$value.month})-({$value.day}) ({$v.finish_time}),({$room_data.type})'>
            ({assign var=cb value=$cb+1})
            ({/if})
        </td>
        ({/foreach})
        ({/if})({*type*})

        ({/if})({*value.holiday*})
        </td>
        </tr>
        ({assign var=line value=$line+1})
        ({/foreach})

        ({else})    ({* ------------------ room mode ----------------------*})
        <input type="hidden" name="room_id" value="0">
        ({foreach from=$room_data key=key item=value})
        ({if ($line%5)==0})
        <tr>
            <th style='border: 1px #000000 solid;text-align: center;' width="150">
                部屋名

            </th>
            <th></th>

            ({foreach from=$open_time item=time})

            <th bgcolor=#CDCDCD style='border: 1px #000000 solid;text-align: center;' colspan=4><b>
                    ({$time}):00 ～ ({$time+1}):00
                </b></th>
            ({/foreach})
        </tr>
        ({/if})
        ({assign var=cb value=0})

        <tr>
            <td style='border: 1px #000000 solid;text-align: center;' >
                ({$value.room_name}) (({$value.max})人)<br>
                ({if $value.type==2})最低({$value.lowest_koma})コマ以上({/if})
                <input type="submit" name="periodmode" value="日付範囲表示" onClick="setRoomID(({$value.room_id}))">
            </td>
            <td><input type="button" value=">>" onClick="linecheck(({$line}))"></td>
            ({if $value.holiday})
            <td colspan=({$ct*4}) style='border: 1px #000000 solid;text-align: center;' bgcolor=#FF6666><b>休室日</b></td>
        </tr>
        ({else})({*value.holiday*})
        ({if $value.type==2})
         ({foreach from=$value.opentime key=k item=v})
        <td style='border: 1px #000000 solid;text-align: center;vertical-align:middle;'
         ({if $value.usedate==1 && $v.style && !$v.reserved && !$v.checked && !$v.stoped})
            bgcolor= #FFE7D6
            ({elseif $value.usedate==0  && !$v.reserved && !$v.checked && !$v.stoped})
            bgcolor= #FFE7D6
            ({/if}) colspan=({$v.cs}) 
            ({if $v.reserved})
            bgcolor=#FFDCDC><span style='color:#FF0000;'><b>
                    <a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('reserve_view')})&amp;reserve_id=({$v.reserved})">
                        予約ID:({$v.reserved})</a><br>
                    代表名：({$v.corp})<br>
                    予約者：({$v.c_member.nickname}) 様<br>
                    状態：
                    ({if $v.reserve_data.tmp_flag==1})
                    仮予約
                    ({elseif $v.reserve_data.pay_flag==0 and $v.reserve_data.pay_money==0})
                    未入金
                    ({elseif $v.reserve_data.pay_flag==0 and $v.reserve_data.pay_money>0})
                    一部入金
                    ({elseif $v.reserve_data.pay_flag==1})
                    入金済み
                    ({elseif $v.reserve_data.pay_flag==2})
                    過剰入金
                    ({/if})
                </b></span>
            ({elseif $v.checked})
            bgcolor=#FFCCFF>予約    
            ({elseif $v.stoped})
            bgcolor=#FFCCFF>貸し止め中<br>
            有効期限：({$v.stoped.limit_datetime})<br>
            担当者：({$v.stoped.admin_name})<br>
            ({$v.stoped.memo})<br>
            予約：<input type='checkbox' name='reserve_data({$key})_({$k})' id='sd({$key})_({$cb})' value='({$hall_data.hall_id}),({$value.room_id}),({$year})-({$month})-({$day}) ({$v.begin_time}),({$year})-({$month})-({$day}) ({$v.finish_time}),({$value.type})'>
            ({assign var=cb value=$cb+1})
            
            ({else})
            >
            <input type='checkbox' name='reserve_data({$key})_({$k})' id='sd({$key})_({$cb})' value='({$hall_data.hall_id}),({$value.room_id}),({$year})-({$month})-({$day}) ({$v.begin_time}),({$year})-({$month})-({$day}) ({$v.finish_time}),({$value.type})'>
            ({assign var=cb value=$cb+1})
            ({/if})
        </td>
        ({/foreach})
        ({else})({*type*})
        ({foreach from=$value.komawari key=k item=v})
        <td style='border: 1px #000000 solid;text-align: center;vertical-align:middle;'
        ({if $value.usedate==1 && $v.style && !$v.reserved && !$v.checked && !$v.stoped})
            bgcolor= #FFE7D6
            ({elseif $value.usedate==0  && !$v.reserved && !$v.checked && !$v.stoped})
            bgcolor= #FFE7D6
            ({/if}) colspan=({$v.cs}) 
            ({if $v.reserved})
            
            bgcolor=#FFDCDC>
                    <span style='color:#FF0000;'><b>
                    <a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('reserve_view')})&amp;reserve_id=({$v.reserved})">
                        予約ID:({$v.reserved})</a><br>
                    代表名：({$v.corp})<br>
                    予約者：({$v.c_member.nickname}) 様<br>
                    状態：
                    ({if $v.reserve_data.tmp_flag==1})
                    仮予約
                    ({elseif $v.reserve_data.pay_flag==0 and $v.reserve_data.pay_money==0})
                    未入金
                    ({elseif $v.reserve_data.pay_flag==0 and $v.reserve_data.pay_money>0})
                    一部入金
                    ({elseif $v.reserve_data.pay_flag==1})
                    入金済み
                    ({elseif $v.reserve_data.pay_flag==2})
                    過剰入金
                    ({/if})
                    <br>


                </b></span>
             ({elseif $v.checked})
            bgcolor=#FFCCFF>予約  
            ({elseif $v.rest})
            bgcolor=#CDCDCD>休憩  
            ({elseif $v.stoped})
            
            bgcolor=#FFCCFF>貸し止め中<br>
            有効期限：({$v.stoped.limit_datetime})<br>
            担当者：({$v.stoped.admin_name})<br>
            ({$v.stoped.memo})<br>
            <input type='checkbox' name='reserve_data({$key})_({$k})' id='sd({$key})_({$cb})' value='({$hall_data.hall_id}),({$value.room_id}),({$year})-({$month})-({$day}) ({$v.begin_time}),({$year})-({$month})-({$day}) ({$v.finish_time}),({$value.type})'>
            ({assign var=cb value=$cb+1})
                              
            ({else})
            >
            <input type='checkbox' name='reserve_data({$key})_({$k})' id='sd({$key})_({$cb})' value='({$hall_data.hall_id}),({$value.room_id}),({$year})-({$month})-({$day}) ({$v.begin_time}),({$year})-({$month})-({$day}) ({$v.finish_time}),({$value.type})'>
            ({assign var=cb value=$cb+1})
            ({/if})
        </td>
        ({/foreach})
        ({/if})({*type*})

        ({/if})({*value.holiday*})
        </td>
        </tr>
        ({assign var=line value=$line+1})
        ({/foreach})

        ({/if})


        <tr>
            <th style='border: 1px #000000 solid;text-align: center;' width="150">
                部屋名
            </th>
            <th></th>

            ({foreach from=$open_time item=time})

            <th bgcolor=#CDCDCD style='border: 1px #000000 solid;text-align: center;' colspan=4><b>
                    ({$time}):00 ～ ({$time+1}):00
                </b></th>
            ({/foreach})
        </tr>

    </table>
</form>

</center>
({/if})
({else})
<br>
<center>
    <span style="font-size: 16px; color: #FF0033;">
        <b>アクセス権がありません。</b>
    </span>
</center>
({/if})

({$inc_footer|smarty:nodefaults})
