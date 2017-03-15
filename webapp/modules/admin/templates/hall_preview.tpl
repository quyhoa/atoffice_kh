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
background:url(./atoffice/img/h2.jpg) ;
padding:10px 20px 0px 10px;
height:36px;
overflow:hidden;
margin:0px;
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
<div id="contents_h2"><b>({$hall_data.hall_name})</b></div>
({*** 会場の特徴 ***})
<span style="font-size: 16pt;color: #FF0000;"><b>
({$hall_data.characteristic|nl2br|t_url2cmd:'diary':$member.c_member_id|t_cmd:'diary'|t_decoration})
</b></span>
<hr>
({*** 会場の画像と地図 ***})
<div class="bukken_bg">
<table class="main">
<tr>
<td class="bukken" rowspan="2">
({if $image_data.0.image_filename})
<img src='./img.php?filename=({$image_data.0.image_filename})' width='270' height='360' alt="({$image_data.0.title})">
({else})
<img src='./img.php?filename=skin_no_image.gif' width='270' height='360'>
({/if})
</td>
<td class="map">
({if $image_data.1.image_filename})
<img src='./img.php?filename=({$image_data.1.image_filename})' width='300' height='309' alt="({$image_data.1.title})">
({else})
<img src='./img.php?filename=skin_no_image.gif' width='300' height='309'>
({/if})
</td>
</tr>
<tr><td class="btn">
<a href="./?m=admin&a=page_hall_access_preview&h=({$hall_data.hall_id})" target="blank"><img src="./atoffice/img/btn_access.jpg" alt="詳細アクセスはコチラ" /></a></td>
</tr>
</table>
</div>
({*** 料金 ***})
<div id="price">
<a name="price"></a>
<div id="contents_h2"><b>ご利用料金</b></div>
<div class="catch"></div>
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#cccccc">
<tr>
<th scope="col">部屋名</th>
<th scope="col">定員数</th>
<th scope="col">ご利用時間</th>
<th scope="col">ご利用料金</th>
</tr>
({foreach from=$room_data key=key item=item})
<tr>
<td>
<a href="./({$hall_data.hall_id})_({$item.room_id})">({$item.room_name})</a></td>
<td>
スクール：({$item.num_school})人<br>
　口の字：({$item.num_mouth})人<br>
シアター：({$item.num_theater})人<br>
</td>
<td>
({$hall_data.begin}):00<br>～<br>({$hall_data.finish}):00
</td>
<td>
({if $item.type==1})
({*** 池袋タイプ ***})

<div align=left>
1コマ目：　({$item.begin_time1}):00 ～ ({$item.finish_time1}):00　({$item.price1})円<br>

({if $item.price2})
2コマ目：　({$item.begin_time2}):00 ～ ({$item.finish_time2}):00　({$item.price2})円<br>
({/if})

({if $item.price3})
3コマ目：　({$item.begin_time3}):00 ～ ({$item.finish_time3}):00　({$item.price3})円<br>
({/if})

({if $item.price4})
4コマ目：　({$item.begin_time4}):00 ～ ({$item.finish_time4}):00　({$item.price4})円<br>
({/if})

({if $item.price5})
5コマ目：　({$item.begin_time5}):00 ～ ({$item.finish_time5}):00　({$item.price5})円<br>
({/if})

({if $item.price6})
6コマ目：　({$item.begin_time6}):00 ～ ({$item.finish_time6}):00　({$item.price6})円<br>
({/if})

({if $item.price7})
7コマ目：　({$item.begin_time7}):00 ～ ({$item.finish_time7}):00　({$item.price7})円<br>
({/if})
</div>

({else})
({*** 神田タイプ ***})
<div align=left>
1コマあたりの時間は、
({if $item.koma<1})
({if $item.koma==0.25})
15分
({else})
30分
({/if})
({else})
({$item.koma})時間
({/if})
です。<br>
最低({$item.lowest_koma})コマから予約できます。<br><br>
1コマあたりのお値段は、<br>
({if $item.k_lowest_price})
({$item.k_capa_lowest})人まで　({$item.k_lowest_price})円<br>
({/if})

({if $item.k_price2})
({$item.k_capa_low2})人～({$item.k_capa_high2})　({$item.k_price2})円<br>
({/if})

({if $item.k_price3})
({$item.k_capa_low3})人～({$item.k_capa_high3})　({$item.k_price3})円<br>
({/if})

({if $item.k_highest_price})
({$item.k_capa_highest})人以上　({$item.k_highest_price})円<br>
({/if})
となっております。

</div>
({/if})
</td>
</tr>
({/foreach})
</table>
</div>
<br>
<p><span class="notice">※準備・入室・退室はご利用時間内にお願いいたします。</span><br />
※時間内に退室いただけず、他の利用者に損害が生じた場合、その損害賠償をいただく場合がございます。<br />
※１時間単位でのご予約はお受けできかねます。各部屋のお得なパックプランをご利用ください。<br />
※机や椅子を移動された場合は、退室前に必ず元の状態にお戻しください。<br />
※ご利用後、ご利用者自身にごみをお持ち帰りいただきます。</p><br />
<br>

<div id="photo" align=center>
({if $image_data.3.image_filename and $image_data.2.image_filename})
<a href="./img.php?filename=({$image_data.3.image_filename})" id="thumb1" class="highslide" onclick="return hs.expand(this)" title="({$image_data.3.image_filename})">
<img src="./img.php?filename=({$image_data.2.image_filename})" alt="({$image_data.2.image_filename})" width="181" height="136" border="0" /></a>
({/if})

({if $image_data.5.image_filename and $image_data.4.image_filename})
<a href="./img.php?filename=({$image_data.5.image_filename})" id="thumb1" class="highslide" onclick="return hs.expand(this)" title="({$image_data.5.image_filename})">
<img src="./img.php?filename=({$image_data.4.image_filename})" alt="({$image_data.4.image_filename})" width="181" height="136" border="0" /></a>
({/if})

({if $image_data.7.image_filename and $image_data.6.image_filename})
<a href="./img.php?filename=({$image_data.7.image_filename})" id="thumb1" class="highslide" onclick="return hs.expand(this)" title="({$image_data.7.image_filename})">
<img src="./img.php?filename=({$image_data.6.image_filename})" alt="({$image_data.6.image_filename})" width="181" height="136" border="0" /></a>
({/if})

<br>

({if $image_data.8.image_filename and $image_data.9.image_filename})
<a href="./img.php?filename=({$image_data.9.image_filename})" id="thumb1" class="highslide" onclick="return hs.expand(this)" title="({$image_data.9.image_filename})">
<img src="./img.php?filename=({$image_data.8.image_filename})" alt="({$image_data.8.image_filename})" width="88" height="66" border="0" /></a>
({/if})

({if $image_data.10.image_filename and $image_data.11.image_filename})
<a href="./img.php?filename=({$image_data.11.image_filename})" id="thumb1" class="highslide" onclick="return hs.expand(this)" title="({$image_data.11.image_filename})">
<img src="./img.php?filename=({$image_data.10.image_filename})" alt="({$image_data.10.image_filename})" width="88" height="66" border="0" /></a>
({/if})

({if $image_data.12.image_filename and $image_data.13.image_filename})
<a href="./img.php?filename=({$image_data.13.image_filename})" id="thumb1" class="highslide" onclick="return hs.expand(this)" title="({$image_data.13.image_filename})">
<img src="./img.php?filename=({$image_data.12.image_filename})" alt="({$image_data.12.image_filename})" width="88" height="66" border="0" /></a>
({/if})

({if $image_data.14.image_filename and $image_data.15.image_filename})
<a href="./img.php?filename=({$image_data.15.image_filename})" id="thumb1" class="highslide" onclick="return hs.expand(this)" title="({$image_data.15.image_filename})">
<img src="./img.php?filename=({$image_data.14.image_filename})" alt="({$image_data.14.image_filename})" width="88" height="66" border="0" /></a>
({/if})

({if $image_data.16.image_filename and $image_data.17.image_filename})
<a href="./img.php?filename=({$image_data.17.image_filename})" id="thumb1" class="highslide" onclick="return hs.expand(this)" title="({$image_data.17.image_filename})">
<img src="./img.php?filename=({$image_data.16.image_filename})" alt="({$image_data.16.image_filename})" width="88" height="66" border="0" /></a>
({/if})

({if $image_data.18.image_filename and $image_data.19.image_filename})
<a href="./img.php?filename=({$image_data.19.image_filename})" id="thumb1" class="highslide" onclick="return hs.expand(this)" title="({$image_data.19.image_filename})">
<img src="./img.php?filename=({$image_data.18.image_filename})" alt="({$image_data.18.image_filename})" width="88" height="66" border="0" /></a>
({/if})

<br />
※画像クリックで拡大</div>
<br />

<div id="setsubi">
<a name="option"></a>
<div id="contents_h2"><b>設備・サービス</b></div>
({*** 会場の設備 ***})
<span style="font-size: 16pt;color: #FF0000;"><b>
({$hall_data.facilities|nl2br|t_url2cmd:'diary':$member.c_member_id|t_cmd:'diary'|t_decoration})
</b></span>

({if $vessel_list})
<hr>
<table class="facilities" border="1" cellpadding="0" cellspacing="0" bordercolor="#cccccc">
<caption class="top" align=left>■有料設備</caption>
<tr>
<th scope="col">設備名称</th>
<th scope="col">ご利用<br>価格</th>
<th scope="col">料金<br>区分</th>
<th scope="col">ご利用が<br>可能な部屋</th>
<th scope="col">説明</th>
</tr>
({foreach from=$vessel_list item=item})
<tr>
<td>({$item.vessel_name})</td>
<td>({$item.price})円</td>
<td>
({if $item.charge_devision==1})
予約毎
({else})
時間毎
({/if})
</td>
<td valign=top>
<div align=left>
({$item.used_room|nl2br|t_url2cmd:'diary':$member.c_member_id|t_cmd:'diary'|t_decoration})
</div>
</td>
<td valign=top>
<div align=left>
({$item.memo1|nl2br|t_url2cmd:'diary':$member.c_member_id|t_cmd:'diary'|t_decoration})
</div>
</td>
</tr>
({/foreach})
</table>
<br>
※　料金区分について<br>
予約毎＝１回の予約で同日に連続して何時間選択してもご利用価格は変わりません。<br>
時間毎＝連続して複数時間選択した場合、選択した数だけご利用価格をいただきます。<br>
<br>
({/if})

({if $service_list})
<hr>
<table class="facilities" border="1" cellpadding="0" cellspacing="0" bordercolor="#cccccc">
<caption class="top" align=left>■有料サービス</caption>
<tr>
<th scope="col">サービス名称</th>
<th scope="col">ご利用<br>価格</th>
<th scope="col">最低<br>注文数</th>
<th scope="col">ご利用が<br>可能な部屋</th>
<th scope="col">説明</th>
</tr>
({foreach from=$service_list item=item})
<tr>
<td>({$item.service_name})</td>
<td>({$item.price})円</td>
<td>
({$item.minimum_orders})
</td>
<td valign=top>
<div align=left>
({$item.used_room_service|nl2br|t_url2cmd:'diary':$member.c_member_id|t_cmd:'diary'|t_decoration})
</div>
</td>
<td valign=top>
<div align=left>
({$item.memo1|nl2br|t_url2cmd:'diary':$member.c_member_id|t_cmd:'diary'|t_decoration})
</div>
</td>
</tr>
({/foreach})
</table>
<br>
※　最低注文数について<br>
最低注文数以上の数量でご予約を承っております。<br>
最低注文数以下の数量ではご予約できませんのでご了承ください。<br>
<br>
({/if})
</div>({***設備***})


<div id="flow">
<a name="flow"></a>
<div id="contents_h2"><b>ご利用の流れ</b></div>
<table class="flow">
<tr>
<td class="title">空室確認</td><td class="text"><p>まずご利用されたい物件をお探しいただき。日時や人数が決まりましたら、<br />
各物件ページにある以下のボタンをクリックし、空き室の状況をご確認ください。</p>
<image src="./atoffice/img/btn_reserve.jpg"alt="空室確認・ご予約" />
</td>
</tr>
<tr><td class="arrow" colspan="2"><img src="./atoffice/img/flow_arrow.gif" width="49" height="14" /></td>
</tr>
<tr>
<td class="title">仮予約</td>
<td class="text"><p>各物件ごとの<a href="./?m=admin&a=page_hall_kiyaku_preview&h=({$hall_data.hall_id})" target="blank">「利用規約」</a>に同意いただいたうえで、空室確認画面の中の日付部分をクリックいただき、ご希望の部屋/日時にチェックを入れ、仮予約を行っていただきます。</p>
<p class="caption">※仮予約後２営業日以内に弊社よりご連絡させていただきます。<br />
※弊社より「ご予約確認」のメールを送らせていただいた後のキャンセルは、既定のキャンセル料が発生いたします。ご注意ください。</p></td>
</tr>
<tr><td class="arrow" colspan="2"><img src="./atoffice/img/flow_arrow.gif" width="49" height="14" /></td>
<tr>
<td class="title">お支払い</td><td class="text"><p>弊社からの返信メールに記載されている入金先へご入金いただきます。</p>
<p class="caption">※料金は前払い制になっております。<br />※振込手数料はお客様のご負担となります。ご了承ください。<br />※振込名義はご予約の際の会社名・団体名でお願いいたします。<br />
（個人でお申込みのお客様はご予約の際のお名前にてお願いいたします）</p></td>
</tr>
<tr><td class="arrow" colspan="2"><img src="./atoffice/img/flow_arrow.gif" width="49" height="14" /></td>
<tr>
<td class="title">当　　日</td>
<td class="text"><p><span class="bold">ご利用時間内での入室、退室</span>をお願いいたします。</p>
<p class="caption">※ご利用時間に、お部屋の準備は完了しておりますので、そのまま入室いただけます。</p></td>
</tr>
</table>
<br>
<p><span class="bold">■仮予約後のキャンセルについて</span><br><br>
<center>各部屋ごとのキャンセル料は以下のようになっております。</center>

<table>
({foreach from=$room_data item=item})
<tr>
<td bgcolor=#FF9900 height=25>
<span style="margin:5px;color:#FFFFFF;">
<b>({$item.room_name})</b>
</span>
</td>
<td>
<span style="margin:2px">
({$item.cancel_list.day1})日前まで({$item.cancel_list.percent1})%
</span>
</td>
({if $item.cancel_list.day2})
<td>
<span style="margin:2px">
({$item.cancel_list.day2})日前まで({$item.cancel_list.percent2})%
</span>
</td>
({/if})
({if $item.cancel_list.day3})
<td>
<span style="margin:2px">
({$item.cancel_list.day3})日前まで({$item.cancel_list.percent3})%
</span>
</td>
({/if})
({if $item.cancel_list.day4})
<td>
<span style="margin:2px">
({$item.cancel_list.day4})日前まで({$item.cancel_list.percent4})%
</span>
</td>
({/if})
({if $item.cancel_list.day5})
<td>
<span style="margin:2px">
({$item.cancel_list.day5})日前まで({$item.cancel_list.percent5})%
</span>
</td>
({/if})
</tr>
({/foreach})
</table>
<br>
<span style="margin:5px;color:#FF0000;">
<table>
<tr>
<td>※</td>
<td>キャンセル料の割合は、弊社が回収する割合になります。</td>
</tr>
<tr><td></td>
<td>例として30%の場合、弊社が予約金の30%を回収し、70%をご返金いたします。</td>
</tr>
<tr>
<td>※</td>
<td>有料設備をご予約の場合、設備料金はキャンセル料の回収額に含まれません。</td>
</tr>
<tr>
<td>※</td>
<td>有料サービスには、キャンセル料に含まれるものと含まれないものがあります。</td>
<tr><td></td>
<td>サービスご予約の際に表示されますのでご確認の上、ご了承ください。</td>
</tr>
</tr>
</table>
</span>
<br>
<p>より詳細な内容については各会場の<a href="./?m=admin&a=page_hall_kiyaku_preview&h=({$hall_data.hall_id})" target="blank">「利用規約」</a>をご確認ください。</p>
<br>
</div>({***ご利用の流れ***})


<a name="contact"></a>
<div id="contents_h2"><b>({$hall_data.hall_name})についてのお問い合わせ</b></div>
<div id="index_btn">
<table border="0">
<tr>
<td><img src="./atoffice/img/contact_btn.gif" alt="お問い合わせ" border="0" /></a></td>
<td><image src="./atoffice/img/reserve_btn.gif" alt="空室確認・ご予約" />
</td>
</tr>
</table>
</div>
<div id="tel">
<p><img src="./atoffice/img/footer_tel.gif" alt="ご予約・ご質問・空室のご確認は03-5465-5506" width="394" height="88" /><br />
※「貸し会議室の件」とお申し付け下さいTEL受付時間：平日 9:00～18:00</p>
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
<li><a href="./({$hall_data.hall_id})_({$item.room_id})">({$item.room_name})／({$item.max_num})名</a></li>
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