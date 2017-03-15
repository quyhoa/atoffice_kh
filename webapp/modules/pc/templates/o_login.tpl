({assign var=INC_HEADER_is_login value=true})
({assign var=INC_FOOTER_is_login value=true})


<style type="text/css">
	<!--
table#table-01 {
    width: 850px;
    border: 0px;
    border-collapse: collapse;
    border-spacing: 0;
}

table#table-01 td {
    border: 0px;
    border-width: 0px;
    padding-top: 10px;
    padding-left: 10px;
    vertical-align:top;
    text-align:left;
}
-->
</style>


<script type="text/javascript">
({********************************************************************})
({if $page=="reserve"})

var flg=true;
var count_flag = 15;

var now = new Date();
year = now.getYear();
month = now.getMonth() + 1;
day = now.getDate();
if(year < 2000) { year += 1900; }
if(month < 10) { month = "0" + month; }
if(day < 10) { day = "0" + day; }

window.onload=function(){
    setMsgTenmetu();
}

function setMsgTenmetu(cf, year1, month1, day1, week){

    if(cf){
        count_flag = cf;
    }
    if(year1){
        year = year1;
        if(year < 2000) { year += 1900; }
    }
    if(month1){
        month = month1;
        if(month < 10) { month = "0" + month; }
    }
    if(day1){
        day = day1;
        if(day < 10) { day = "0" + day; }
    }
    if(week){
        wweek = week;
    }

    if(count_flag > 0){
        if(flg && document.getElementById("msgid2") != null){
            document.getElementById("msgid2").innerHTML=year+"年"+month+"月"+day+"日("+wweek+")";
            setTimeout("setMsgTenmetu()",200);
        }else if(document.getElementById("msgid2") != null){
            document.getElementById("msgid2").innerHTML="";
            setTimeout("setMsgTenmetu()",200);
        }
        flg=!flg;
        count_flag--;
    }else{
        document.getElementById("msgid2").innerHTML=year+"年"+month+"月"+day+"日("+wweek+")";
    }
}

function reserve_form(type, number, room_id, room_name, discount){

	if(document.getElementById("rid").value && document.getElementById("rid").value!=room_id){
		alert('2部屋以上を同時にご予約の場合は、1部屋1日毎に「予約追加」を押して登録してから次のご予約をお申し込みください。\n\n複数予約は予約担当が代行もいたします。\n\n《03-5465-5506》までお電話ください。');
		document.reserve.elements["box"+number].checked = false;
		return;
	}

	// 人数を入力してあるか
//	var people = Number(document.forms['reserve'].elements['people'].value);	if (!(people>0)){
//		alert('先に手順②　『ご利用予定人数』を入力してから選択してください');
//		document.reserve.elements["box"+number].checked = false;
//		return;
//利用予定人数	}

//	document.forms['reserve'].elements['people'].value = people;

	// 部屋ID登録
//	document.getElementById("room_name_top").innerHTML = room_name;
	document.getElementById("rid").value = room_id;

	var total_number = document.getElementById("total_number").innerHTML;
	var flag=0;
	check = 0;
	begin_time = "";
	var count=0;
	var checkdnumberlist = new Array();

	for(x=0;x<=total_number;x++){
		if(document.reserve.elements["box"+x].checked == true){
			flag++;
			count++;
			checkdnumberlist.push(x);

			if(begin_time==""){
				begin_time = document.getElementById("begin_time"+x).innerHTML;
				finish_time_check = document.getElementById("finish_time"+x).innerHTML;
			}else{
				if(document.getElementById("begin_time"+x).innerHTML != finish_time_check){
					if(type==2){
						alert("　　　　　　　連続した時間を指定してください。\n（連続しない時間指定は予約追加で分けて予約してください。）");
						if(document.reserve.elements["box"+number].checked == true){
							document.reserve.elements["box"+number].checked = false;
						}else{
							document.reserve.elements["box"+number].checked = true;
						}
						return;
					}else{
						if(document.getElementById("reserved"+(x))){
							alert("他の予約をまたいだ時間を指定できません。");
							if(document.reserve.elements["box"+number].checked == true){
								document.reserve.elements["box"+number].checked = false;
							}else{
								document.reserve.elements["box"+number].checked = true;
							}
							return;
						}
					}

				}else{
					finish_time_check = document.getElementById("finish_time"+x).innerHTML;
				}
			}
			finish_time = document.getElementById("finish_time"+x).innerHTML;

		}
	}

	if(count > 1){
		for(var i in checkdnumberlist){
			if(i > 0){
				if(checkdnumberlist[(i-1)]+1 != checkdnumberlist[i]){
					alert("　　　　　　　連続した時間を指定してください。\n（連続しない時間指定は予約追加で分けて予約してください。）");
					if(document.reserve.elements["box"+number].checked == true){
						document.reserve.elements["box"+number].checked = false;
					}else{
						document.reserve.elements["box"+number].checked = true;
					}
					return;
				}
			}
		}

	}


	if(flag==0){
		// 未選択へ戻す
		//document.getElementById("room_name_top").innerHTML = "未選択";
		document.forms['reserve'].elements['rid'].value = "";
		document.getElementById("begin_time_top").innerHTML = "00:00";
		document.getElementById("finish_time_top").innerHTML = "00:00";
		document.getElementById("koma").innerHTML = 0;
		document.getElementById("lowest_koma").innerHTML = "";
//	if(document.getElementById("room_info"+room_id)){
//		document.getElementById("room_info"+room_id).style.display = "none";
//	}
		// document.getElementById("price").innerHTML = 0;
		// document.getElementById("select_pack_name").innerHTML = "";
		document.forms['reserve'].elements['reserve_price'].value = "";
		document.forms['reserve'].elements['reserve_begin_time'].value = "";
		document.forms['reserve'].elements['reserve_finish_time'].value = "";
		document.forms['reserve'].elements['reserve_koma_num'].value = "";
		return;
	}

	// ### 時間セット ###

	document.getElementById("begin_time_top").innerHTML = begin_time;
	document.getElementById("finish_time_top").innerHTML = finish_time;
	document.getElementById("koma").innerHTML = flag;

	document.forms['reserve'].elements['reserve_begin_time'].value = begin_time;
	document.forms['reserve'].elements['reserve_finish_time'].value = finish_time;
	document.forms['reserve'].elements['reserve_koma_num'].value = flag;

	if(type==2){
		document.getElementById("lowest_koma").innerHTML = "("+document.getElementById("lowest_koma"+number).innerHTML+"コマ以上必須)"
	}
//	document.getElementById("room_info"+room_id).style.display = "block";

	price_form(room_id, flag, type, number, discount);

}

function price_form(room_id, flag, type, number, discount){

	if(type==2){

        document.getElementById("select_pack_name").innerHTML = "";

		var people = Number(document.forms['reserve'].elements['people'].value);

		if(document.getElementById(room_id+"price1") && people <= document.getElementById(room_id+"low1").innerHTML){
			set_price = document.getElementById(room_id+"price1").innerHTML;
		}

        if(document.getElementById(room_id+"price2") && document.getElementById(room_id+"low2").innerHTML <= people){
			set_price = document.getElementById(room_id+"price2").innerHTML;

		}else{
			set_price = document.getElementById(room_id+"price1").innerHTML;
        }
        if(document.getElementById(room_id+"price3") && document.getElementById(room_id+"low3").innerHTML <= people){

			set_price = document.getElementById(room_id+"price3").innerHTML;

		}
        if(document.getElementById(room_id+"price4") && document.getElementById(room_id+"high4").innerHTML <= people){

			set_price = document.getElementById(room_id+"price4").innerHTML;

		}

        // パック料金
        pack_list_num = document.getElementById(room_id+"pack_num").innerHTML;
        for(x=0;x<pack_list_num;x++){
    		if(document.getElementById(room_id+"pack_percent"+x).innerHTML){
                if(document.getElementById(room_id+"koma1"+x).innerHTML <= flag && document.getElementById(room_id+"koma2"+x).innerHTML >= flag){

                    var pack_percent = document.getElementById(room_id+"pack_percent"+x).innerHTML;
        			set_price = set_price - (set_price*(pack_percent*0.01));
		        	set_price = Math.round(set_price);

                    document.getElementById("select_pack_name").innerHTML = document.getElementById(room_id+"pack_name"+x).innerHTML+"<br>";
                    document.getElementById("select_pack_name").innerHTML += pack_percent+"%引き<br>";
                }
            }
        }

		if(discount){
			set_price = set_price - (set_price*(discount*0.01));
			set_price = Math.round(set_price);
			document.getElementById("select_pack_name").innerHTML += "割引キャンペーン中!";
		}

        // コマ数を掛ける
        set_price = set_price * flag;

		var price = myFormatNumber(set_price);
		document.getElementById("price").innerHTML = price;
		document.forms['reserve'].elements['reserve_price'].value = set_price;

	}else{

		time = document.getElementById("begin_time_top").innerHTML+"～"+document.getElementById("finish_time_top").innerHTML;

		pack_list_num = document.getElementById(room_id+"pack_num").innerHTML;
		for(x=0;x<pack_list_num;x++){
			if(!!document.getElementById(room_id+"pack_time"+x)){

				if(document.getElementById(room_id+"pack_time"+x).innerHTML == time){


					// ## 池袋パック料金セット　##
					document.getElementById("select_pack_name").innerHTML = document.getElementById(room_id+"pack_name"+x).innerHTML;
					var pack_price = document.getElementById(room_id+"pack_price"+x).innerHTML;
					var price = myFormatNumber(pack_price);
					document.getElementById("price").innerHTML = price;
					document.forms['reserve'].elements['reserve_price'].value = pack_price;
					return;
				}
			}


		}


		var total_number = document.getElementById("total_number").innerHTML;
		set_price = 0;
		for(x=0;x<=total_number;x++){
			if(document.reserve.elements["box"+x].checked == true){
				set_price = set_price + Number(document.getElementById("i_price"+x).innerHTML);
			}
		}

		// 割引期間
		if(discount){
			document.getElementById("select_pack_name").innerHTML = "割引キャンペーン中!";
			set_price = set_price - (set_price*(discount*0.01));
			set_price = Math.round(set_price);
			var price = myFormatNumber(set_price);
			document.getElementById("price").innerHTML = price;
			document.forms['reserve'].elements['reserve_price'].value = set_price;
			return;
		}

		// ##　池袋タイプ料金セット　##
		document.getElementById("select_pack_name").innerHTML = "";
		var price = myFormatNumber(set_price);
		document.getElementById("price").innerHTML = price;
		document.forms['reserve'].elements['reserve_price'].value = set_price;


	}

}


function box_clear(){
	var total_number = document.getElementById("total_number").innerHTML;
	for(x=0;x<=total_number;x++){
		document.reserve.elements["box"+x].checked = false;
	}
	// 未選択へ戻す

	room_id = document.forms['reserve'].elements['rid'].value;

	document.getElementById("room_name_top").innerHTML = "未選択";
	document.forms['reserve'].elements['rid'].value = "";
	document.getElementById("begin_time_top").innerHTML = "00:00";
	document.getElementById("finish_time_top").innerHTML = "00:00";
	document.getElementById("koma").innerHTML = 0;
	document.getElementById("lowest_koma").innerHTML = "";
	if(document.getElementById("room_info"+room_id)){
		document.getElementById("room_info"+room_id).style.display = "none";
	}
	document.getElementById("price").innerHTML = 0;
	document.getElementById("select_pack_name").innerHTML = "";
	document.forms['reserve'].elements['reserve_price'].value = "";
	document.forms['reserve'].elements['reserve_begin_time'].value = "";
	document.forms['reserve'].elements['reserve_finish_time'].value = "";
	document.forms['reserve'].elements['reserve_koma_num'].value = "";

}

function reserve_check(){
	// チェックボックスをチェックしてあるか
	var total_number = document.getElementById("total_number").innerHTML;
	var flag=0;
	for(x=0;x<=total_number;x++){
		if(document.reserve.elements["box"+x].checked == true){
			flag++;
		}
	}
	if(flag==0){
		alert("　　　　　　　連続した時間を指定してください。\n（連続しない時間指定は予約追加で分けて予約してください。）");
		return false;
	}

	// コマ数不足チェック
	if(document.getElementById("lowest_koma")){
		var lowest_koma = document.getElementById("lowest_koma").innerHTML.match(/\d+/g);
		if (flag < lowest_koma){
			alert(lowest_koma+"コマ以上選択してください。");
			return false;
		}
	}

	// 人数を入力してあるか
	if (document.forms['reserve'].elements['people'].value.match(/\d+/g)){
		//alert('数字');
		if(document.forms['reserve'].elements['people'].value<=0){
			alert('人数を入力してください。');
			return false;
		}
	}else{
		alert('人数は半角数字で入力してください。');
		return false;
	}

	// 座席数以上警告
	var rid = document.forms['reserve'].elements['rid'].value;
	if(Number(document.forms['reserve'].elements['people'].value) > Number(document.getElementById(rid+"max").innerHTML)){

		if(window.confirm('ご利用予定人数が会場の座席数より多いですがよろしいですか？')){
			return;
		}else{
			return false;
		}
	}

}

function change_room(room_id){
	document.forms['change_room'].elements['rid_c'].value = room_id;
	document.forms['change_room'].submit();
}


({elseif $page=="reserve_service" ||  $page=="reserve_vessel"})
({***************************************************************************})

function vessel_price_change(key){
	var price = 0;
	for(x=0;x<key;x++){
		if(document.forms['reserve_vs'].elements['select_vessel'+x].checked){
			var tanka = document.getElementById("tanka"+x).innerHTML;
			var amount = document.forms['reserve_vs'].elements['remainder'+x].value;

			price += tanka * amount;

			//alert(x+"checked "+tanka+"円 ");
		}
		
	}

	price = myFormatNumber(price);
	document.getElementById("reserve_vessel_price").innerHTML = price;

}


function minus(key, min, count){
	//alert(key+" "+min);
	if (document.forms['reserve_vs'].elements['service_remainder'+key].value > min){
		document.forms['reserve_vs'].elements['service_remainder'+key].value--;
		service_price_change(count);
	}

}
function plus(key, count){
	document.forms['reserve_vs'].elements['service_remainder'+key].value++;
	service_price_change(key);
	service_price_change(count);
}


function check_val(key, min, count){
	if(document.forms['reserve_vs'].elements['service_remainder'+key].value.match(/[^0-9]+/)){
		document.forms['reserve_vs'].elements['service_remainder'+key].value = min;
	}else if(document.forms['reserve_vs'].elements['service_remainder'+key].value < min){
		document.forms['reserve_vs'].elements['service_remainder'+key].value = min;
	}
	service_price_change(count);
}


function service_price_change(key){

	var price = 0;
	for(x=0;x<key;x++){
		if(document.forms['reserve_vs'].elements['select_service'+x].checked){
			var tanka = document.getElementById("service_tanka"+x).innerHTML;
			var amount = document.forms['reserve_vs'].elements['service_remainder'+x].value;

			price += tanka * amount;

		}
		
	}
	price = myFormatNumber(price);
	document.getElementById("reserve_service_price").innerHTML = price;

}

function pre_kanban(hall_id, room_id){
//	kanban = encodeURI(document.getElementById("kanban").value);
	kanban = escape(document.getElementById("kanban").value);
	window.open('./atoffice/pages/sub/kanban.php?kanban='+kanban+'&hid='+hall_id+'&rid='+room_id,'','scrollbars=yes,width=1050,height=750,');

}

function limitChars(target,maxlength) {
    if ( target.value.length > maxlength ) {
        alert("入力文字が多すぎます。\nこれ以上入力できません。");
        target.value = target.value.substr(0,maxlength);
    }

    target.focus();
}

({elseif $page=="search"})
({*************************************************************************})

function set_index(index){
	//alert(index);
	document.forms['search'].elements['index'].value = index;
	document.forms['search'].submit();
}

function limitChars(target,maxlength) {
    if ( target.value.length > maxlength ) {
        alert("入力文字が多すぎます。\nこれ以上入力できません。");
        target.value = target.value.substr(0,maxlength);
    }

    target.focus();
}

({/if})

({if $Calendar})
function submit_calendar(day){
	//alert(day);
	document.forms["date"+day].submit();
}
({/if})

function myFormatNumber(x) {
    var s = "" + x;
    var p = s.indexOf(".");
    if (p < 0) {
        p = s.length;
    }
    var r = s.substring(p, s.length);
    for (var i = 0; i < p; i++) {
        var c = s.substring(p - 1 - i, p - 1 - i + 1);
        if (c < "0" || c > "9") {
            r = s.substring(0, p - i) + r;
            break;
        }
        if (i > 0 && i % 3 == 0) {
            r = "," + r;
        }
        r = c + r;
    }
    return r;
}

</script>

<script type="text/javascript" src="./atoffice/js/prototype.js"></script>
<script type="text/javascript" src="./atoffice/js/smartRollover.js"></script>
<script type="text/javascript" src="./atoffice/js/scriptaculous.js?load=effects,builder"></script>
<script type="text/javascript" src="./atoffice/js/highslide.js"></script>
<script type="text/javascript" src="./atoffice/js/ajax.js"></script>
<link href="./atoffice/css/style.css" rel="stylesheet" type="text/css" />
<STYLE type="text/css">
<!--
#btn_yoyaku {
    border: 0px;
    width: 250px;
    height: 50px;
    background: url("./atoffice/img/btn_yoyaku.png") left top no-repeat;
    cursor: pointer;
}
-->
</STYLE>
<div id="header">
<h1>
<img src="./atoffice/img/abclogo.png" style="position: absolute; top: 34px;">
</h1>
</div><!--heaer_end-->



<table width="950"><tr><td width="700" style="vertical-align: top">

({if $mes})
<table width=700>
<tr>
<td style='border: 5px #FF0000 solid;text-align: center;background-color:#FFCCCC;'>
({$mes|nl2br|t_url2cmd:'diary':$member.c_member_id|t_cmd:'diary'|t_decoration})
</td>
</tr>
</table>
({/if})

({*({$page})<br>*})
({*({$url})*})
	<!-- ################################################################################ -->
	<!-- ### ajax ################################################################ -->
	<!-- ################################################################################ -->
	<script type="text/javascript">
		function PerformInputLink()
		{
		({if $page})
       
			LoadHTML('AppContentInput', '({$page}).php({$url})');

		({elseif $hall_id and !$room_id})
        alert("2");
			LoadHTML('AppContentInput', 'hall.php?hid=({$hall_id})');
		({elseif $hall_id and $room_id})
        alert("3");
			LoadHTML('AppContentInput', 'room.php?hid=({$hall_id})&rid=({$room_id})');
		({else})
        alert("4");
			LoadHTML('AppContentInput', 'index.php');
		({/if})

		}
	</script>

	<div id="LoadingBar">
		<img border="0" src="./atoffice/img/loading.gif"/>
	</div>
	<div id="AppContentInput">
	
		<script type="text/javascript">PerformInputLink();</script>
	</div>
	<!-- AppContentInput -->


	<!-- ################################################################################ -->
	<!-- ################################################################################ -->
	<!-- ################################################################################ -->

</td><td width="250" style="vertical-align: top">

({if $page=="vacant"})({* 空室確認 *})
<table>
<tr><td>
<IMG src="./atoffice/img/resflow.png" width="250" height="223">
</td></tr><tr height="16"></tr>
<tr><td>
<IMG src="./atoffice/img/merit.png" width="250" height="136">
</td></tr>
</table>
({else})({* 空室確認以外 *})
<table>
	({if $page=="customerdata"}) 
<tr><td>
<img src="./atoffice/img/memberbunner.png" width="250" height="43">
</td></tr>
<tr><td>
<table width="250" bgcolor="#FDFDFD" style="border: 1px solid #CDCDCD; border-collapse: collapse; empty-cells: show;">
<tr height="38"><td>
<div class="login_name">
ようこそゲストさん
</div>
</td></tr>
<tr><td height="200">

<!--ログインボタン-->
<div class="side_btn">
({t_form_block _attr='name="login" id="login"' m=pc a=do_o_login})
<input type="hidden" name="login_params" value="({$requests.login_params})" />
<center>
<span style="font-size: 8pt;">ID(ﾒｰﾙｱﾄﾞﾚｽ)：</span><br>
<input type="text" class="input_text" name="username" id="username" tabindex="1" size=15 style="font:8pt;" />
<br>
<span style="font-size: 8pt;">パスワード：</span><br>
<input type="password" class="input_text" name="password" id="password" tabindex="2" size=32 style="height:14px;font-size:6pt;" />
<br>
<input type="checkbox" class="input_checkbox" name="is_save" id="is_save" value="1" tabindex="3" /><label for="is_save">次回から自動的にログイン</label><br>

<input type="submit" name="submit" value="ログイン" /><br>

<span class="password_query"><a href="({t_url m=pc a=page_o_help_login_error})">&gt;<span style="color: #0033FF;">"ログインできない方はこちら</span></a></span>
({if !$IS_CLOSED_SNS && (($smarty.const.OPENPNE_REGIST_FROM) & ($smarty.const.OPENPNE_REGIST_FROM_PC))})<br>
★アカウントをお持ちでない方★<br><a href="({t_url m=pc a=page_o_public_invite})" id="button_new_regist"><span style="color: #FF0000;">新規会員登録</span></a>
({/if})
({/t_form_block})
</div>
</td></tr>
</table>
</td></tr><tr height="16"></tr>
<tr><td>
<IMG src="./atoffice/img/merit.png" width="250" height="136">
</td></tr><tr height="16"></tr>

({elseif $page!="reserve_complete"})
<tr><td>
<IMG src="./atoffice/img/selectedres.png" width="250" height="43">
</td></tr>
<tr bgcolor="#F0F0F0"><td style="text-align: center; vertical-align: top;">
<br>

	<script type="text/javascript">
		function PerformInputLink3()
		{
		LoadHTML('schedule', 'side/schedule.php({$url})');
		}
	</script>

	<div id="schedule">
	
		<script type="text/javascript">PerformInputLink3();</script>
	</div>

</td></tr>
({/if})
</table>

({/if}) ({* 空室確認など *})

</td></tr></table>


<div class="main_bottom"></div>


<div id="footer">
<script type="text/javascript">LoadHTML('footer', './sub/footer.html');</script>
</div>

	<!-- ################################################################################ -->
	<!-- ### ajax ################################################################ -->
	<!-- ################################################################################ -->

	<script type="text/javascript">
    
		function PerformInputLink2()
		{
		({*if $Calendar*})
		LoadHTML('Calendar', 'side/calendar.php({$url})');
		({*/if*})
		}
	</script>

<script type="text/javascript">
<!--
function toggleCalendar(){
   	var a=document.getElementById("Calendar").style
	a.display=(a.display=="inline")?"none":"inline";
}
function setValue(year, month, day)
    {
        document.getElementById('select_month').value=month;
        document.getElementById('month').value=month;
        document.getElementById('day').value=day;
        document.getElementById('select_day').value=day;
    }
//-->
</script>

<style type="text/css">
<!--
#Calendar {
 position: absolute;
({if $page=="vacant"})
 top: 50px;
({else})
 top: 166px;
({/if})
 left: 250px;
 width: 580px;
 background: #FFFFFF;
 border: solid 1px #000000;
 display: none;
}

-->
</style>

	<div id="Calendar">
		<script type="text/javascript">PerformInputLink2();</script>
	</div>
