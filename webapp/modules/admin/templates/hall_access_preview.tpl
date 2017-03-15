({$inc_header|smarty:nodefaults})
({ext_include file="inc_subnavi_adminImageKakikomi.tpl"})
({assign var="page_name" value="会場ページプレビュー"})

({ext_include file="inc_tree_adminImageKakikomi.tpl"})
</div>

({*ここまで:navi*})

({*権限チェック*})
({if $atoffice_auth_type==1 or $atoffice_auth_type==4})

<style type="text/css">
<!--
HR {
	border-style:dotted;color:#DCDCDC

}


#atoffice_main{
padding:15px 30px 0px 40px;
}

#atoffice_contents{
width:700px;
float:left;
}

#contents_h2{
font-size:14px;
background:url(./atoffice/img/h2.jpg);
padding:10px 20px 0px 10px;
height:36px;
overflow:hidden;
margin:0px;
}

.box{
padding:8px 15px 5px 15px;
border:1px solid #ccc;
}

dl {margin:0;padding:0;}
dl dt {
clear: left;
float: left;
width:50px;
font-size:12px;
font-weight:bold;
line-height: 150%;
margin-bottom:2px;
padding-top:2px;
}
dl dd {
font-size:12px;
line-height:150%;
margin-bottom:2px;
margin-left:55px;
padding:2px 0 0 15px;
}


/*-------------------------*/
/*   サイドバー           */
/*-------------------------*/
#side{
width:200px;
float:right;
border-top:solid 5px #009933;
border-bottom:solid 1px #CCCCCC;
border-right:solid 1px #CCCCCC;
border-left:solid 1px #CCCCCC;
background-color:#FFFFFF;
padding-bottom:20px;
}

.side_btn{
margin:4px 3px 0 3px;
padding:2px 5px 10px 5px;
border:1px solid #DCDCDC;
background-color:#F5F5F5;
text-align:center;
}

.side_btn_text{
font-size:12px;
text-align:left;
color:#696969;
padding:0 5px 8px 5px;
}

.side_btn_tell{
font-size:12px;
text-align:left;
color:#696969;
padding:8px 5px 5px 5px;
border-top:1px dotted #808080;
}

#side_title_option{
width:194px;
height:45px;
margin:20px auto 0 auto;
background:url(./atoffice/img/side_title_option.jpg) no-repeat;
text-indent:-3000px;
}

#side_title_list{
width:194px;
height:45px;
margin:20px auto 0 auto;
background:url(./atoffice/img/side_title_list.jpg) no-repeat;
text-indent:-3000px;
}


#side_title_party{
width:194px;
height:45px;
margin:20px auto 0 auto;
background:url(./atoffice/img/side_title_party.jpg) no-repeat;
text-indent:-3000px;
}

.side_banner{
width:194px;
margin:5px auto 0 auto;
text-align:center;
}

.side_menu_title{margin:15px 4px 0 4px;padding:3px 0;text-align:center;font-weight:bold;
font-size:12px;border-top:solid 3px #009933;border-bottom:solid 1px #999999;}

.side_menu{width:198px;margin:0 auto 0 auto;padding:0;}
#side .navi {width:180px;margin:0 0 0 8px;padding:0;}
#side .navi li {border-bottom:dotted 1px #D1D1D1;list-style: none;}
#side .navi li a {
display: block;
width: 160px;
padding:6px 5px 4px 17px;
background:url(./atoffice/img/side_arrow.gif) no-repeat left;
text-decoration:underline;
}
#side .navi li a:hover	{
background:url(./atoffice/img/side_arrow_on.gif) no-repeat left;
text-decoration:none;
}

/* -- メイン写真・地図・ボタン -- */
.bukken_bg{padding:3px 5px 5px 3px;background-color:#F5F5F5;border:1px solid #DCDCDC;margin-bottom:25px;}
table.main {margin:0 auto 0 auto;border-collapse:collapse;}
table.main td {padding-top:5px;padding-bottom:5px;}
table.main td.bukken {text-align:left;padding-right:8px;vertical-align:top;}
table.main td.map {vertical-align:bottom;vertical-align:top;}
table.main td.btn {text-align:center;vertical-align:middle;padding:5px 0 0 0;}

table.sub {margin:0 auto 0 auto;border-collapse:collapse;width:100%;}
table.sub td {text-align:left;vertical-align:middle;padding:10px 10px 10px 22px;}
table.sub_detail {margin:0 auto 0 auto;border-collapse:collapse;width:100%;}
table.sub_detail td {text-align:left;vertical-align:middle;padding:10px 10px 10px 20px;}

.bukken_photo{border:solid 1px #CCCCCC;}

.layout_title{
border-top:1px dotted #cfcfcf;
padding:5px;
font-weight:bold;
background:#f5f3f3;
line-height:150%;
height:14px;
}
.layout_plan{padding:2px 0 15px 0;}

/*-------------------------*/
/*   料金                */
/*-------------------------*/
#price {margin-left:0;}
	
.price{
float:left;
width:700px;
margin-right:10px;
margin-bottom:20px;
}

#price table{width:700px;text-align:center;border-collapse:collapse;}
#price table th{background:#dddddd;padding:3px 20px;}
#price table tr{border:1px solid #999999;}
#price table td{margin:0px;padding:3px 20px;text-align:center;font-family:Arial;}
#price table td.cap{font-weight:bold;}
#price table td.rate{color:#FF0000;font-weight:bold;}
#price table.setsubi th{background:#efefef;}
#price table tr.off{background:#ffebe4;}

.notice{color:#FF0000;font-weight:bold;}
#price p{margin-bottom:10px;}

/*-------------------------*/
/*   設備                */
/*-------------------------*/
#setsubi {margin-bottom:30px;}

table.facilities {width:700px;border-collapse:collapse;text-align:center;}
table.facilities caption.top{caption-side: top; text-align:left;font-size:14px;font-weight:bold;padding-bottom:5px;} 
table.facilities caption{caption-side: top; text-align:left;font-size:14px;font-weight:bold;padding-bottom:5px;padding-top:10px;} 
table.facilities th {background:#dddddd;padding:3px 10px;}
table.facilities tr {border:1px solid #999999;}
table.facilities td{margin:0px;padding:3px 10px;text-align:center;font-family:Arial;background:#fff;}
table.facilities td.on{margin:0px;padding:3px 10px;text-align:center;font-family:Arial;background:#ffebe4;}

.kigo{font-size:21px;_font-size:12px;}

/*-------------------------*/
/*   ご利用の流れ         */
/*-------------------------*/
#flow {margin-bottom:30px;}

table.flow {width:700px;border-collapse:collapse;text-align:center;}
table.flow td.title{padding:3px 10px;text-align:center;border:1px solid #FF9900;
background-color:#FF9900;color:#FFFFFF;font-size:14px;font-weight:bold;width:15%;}
table.flow td.text{padding:0px 10px;_padding:10px 10px;text-align:left;border:1px solid #FF9900;}
table.flow td.arrow{padding:3px 10px;text-align:center;}

.caption{color:#666666;}

/*-------------------------*/
/*   お問い合わせ　      */
/*-------------------------*/
#index_btn{text-align:center;}
#tel{text-align:center;}

.page_link{text-align:center;padding:3px 0 3px 0;border-top:1px solid #CCCCCC;border-bottom:1px solid #CCCCCC;}
table.link {width:700px;border-collapse:collapse;text-align:center;}
table.link th {background:#dddddd;padding:3px 10px;}
table.link tr {border:1px solid #999999;}
table.link td{margin:0px;padding:3px 10px;text-align:center;font-family:Arial;background:#fff;}


-->
</style>


<script type="text/javascript" src="./atoffice/js/prototype.js"></script>
<script type="text/javascript" src="./atoffice/js/smartRollover.js"></script>
<script type="text/javascript" src="./atoffice/js/scriptaculous.js?load=effects,builder"></script>
<script type="text/javascript" src="./atoffice/js/highslide.js"></script>
<script type="text/javascript">
  hs.graphicsDir = 'http://www.at-office.co.jp/highslide/graphics/';
  hs.outlineType = 'rounded-white';
  window.onload = function() {
  hs.preloadImages(5);
      }
</script>




({***********************************************************************})

<h2 id="ttl01">会場ページプレビュー【({$hall_data.hall_name})】</h2>
<br>

({if $msg})<p class="actionMsg">({$msg})</p>({/if})
<br><br>
<center>
<table align=center>
<tr>
<td align=left>

<div id="atoffice_main">
<div id="atoffice_contents">
({*** 会場名 ***})
<div id="contents_h2"><b>({$hall_data.hall_name})へのアクセス案内</b></div>

<span style="font-size: 16pt;color: #FF0000;"><b>
<table>
<tr>
<td align=left>
<span style="margin:5px">・({$hall_data.line1})線</span>
</td>
<td align=left>
<span style="margin:5px">({$hall_data.station1})駅</span>
</td>
<td align=left>
<span style="margin:5px">から</span>
</td>
<td align=left>
({if $hall_data.transportation1==103})
<span style="margin:5px">徒歩</span>
({else})
<span style="margin:5px">バス</span>
({/if})
</td>
<td align=left>
<span style="margin:5px">({$hall_data.time1})分</span>
</td>
</tr>

({if $hall_data.line2})
<tr>
<td align=left>
<span style="font-size: 16pt;color: #FF0000;"><b>
<span style="margin:5px">・({$hall_data.line2})線</span>
</td>
<td align=left>
<span style="margin:5px">({$hall_data.station2})駅</span>
</td>
<td align=left>
<span style="margin:5px">から</span>
</td>
<td align=left>
({if $hall_data.transportation2==103})
<span style="margin:5px">徒歩</span>
({else})
<span style="margin:5px">バス</span>
({/if})
</td>
<td align=left>
<span style="margin:5px">({$hall_data.time2})分</span>
</td>
</tr>
({/if})

({if $hall_data.line3})
<tr>
<td align=left>
<span style="font-size: 16pt;color: #FF0000;"><b>
<span style="margin:5px">・({$hall_data.line3})線</span>
</td>
<td align=left>
<span style="margin:5px">({$hall_data.station3})駅</span>
</td>
<td align=left>
<span style="margin:5px">から</span>
</td>
<td align=left>
({if $hall_data.transportation3==103})
<span style="margin:5px">徒歩</span>
({else})
<span style="margin:5px">バス</span>
({/if})
</td>
<td align=left>
<span style="margin:5px">({$hall_data.time3})分</span>
</td>
</tr>
({/if})
</table>
</b></span>


<div class="bukken_bg">
<table class="main">
<tr>
<td class="map">
({if $image_data.image_filename})
<img src='./img.php?filename=({$image_data.image_filename})' alt="({$image_data.title})">
({else})
<img src='./img.php?filename=skin_no_image.gif'>
({/if})
</td>
</tr>
</table>
</div>


<div class="box">
<dl>
<dt>住　　所</dt>
<dd>({$ken})({$hall_data.address_city})({$hall_data.address_other})　

({if $hall_data.google_maps})
［<a href="({$hall_data.google_maps})" style="color:#0000FF;text-align:left">google mapsで地図を表示</a>］
({/if})
</dd>
({if $hall_data.access})
<dt>アクセス</dt>
<dd>

({$hall_data.access|nl2br|t_url2cmd:'diary':$member.c_member_id|t_cmd:'diary'|t_decoration})

</dd>
({/if})
</dl>


</div>

<br>
会場での実施内容及びアクセスの詳細につきましては、各主催者様へお問い合わせください。<br>
現地会場へのお問い合わせにつきましては、ご対応しておりませんので、予めご了承ください。

</div>

</div>
({*** サイドメニュー ***})

<div id="side">
	<div class="side_btn">
        <image src="./atoffice/img/btn_reserve.jpg"alt="空室確認・ご予約" />
        <img src="./atoffice/img/btn_contact.jpg" alt="お問い合わせ"/>
        	<div class="side_btn_tell">空室確認・ご予約・お問い合わせのお電話は、こちら。</div>
        <img src="./atoffice/img/side_tell.jpg" alt="お問い合わせ電話番号" /></div>
      		<div class="side_menu_title">({$hall_data.hall_name})　部屋一覧</div>

<div class="side_menu">
<ul class="navi">
({foreach from=$room_data item=item})
<li><a href="./({$hall_data.hall_id})_({$item.room_id})">({$item.room_name})／({$item.num_school})名</a></li>
({/foreach})
</ul>
</div>
({if $vicinity})
<div id="side_title_list">貸会議室 会場一覧</div>
<div class="iframe_box" align=center>
<table width=180>
({foreach from=$vicinity item=item})
<tr>
<td width=45 height=60>
<img src='./img.php?filename=({$item.image_filename})' width='45' height='60'">
</td>
<td align=left valign=top>
<span style="margin:5px">
({$item.address_city})<br>
({$item.characteristic|nl2br|t_url2cmd:'diary':$member.c_member_id|t_cmd:'diary'|t_decoration})
</slpan>
</td>
</tr>
<tr>
<td colspan=2>
<hr>
</td>
</tr>
({/foreach})
</table>
</div>
({/if})

({*********************************************************})

	</div>

</div>


</div>({*** main ***})

</td>
</tr>
</table>
</center>
<br><br>


({else})
<br>
<center>
<span style="font-size: 16px; color: #FF0033;"><b>アクセス権がありません。</b></span>
</center>
({/if})

<div>
({$inc_footer|smarty:nodefaults})