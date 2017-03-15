<style>
.spDate{
	margin-left:5px;
	display:block;		
}	
</style>
({$inc_header|smarty:nodefaults})
({ext_include file="inc_subnavi_adminImageKakikomi.tpl"})
({if $post_data.hall_id})
({assign var="page_name" value="会場編集(確認)"})
({else})
({assign var="page_name" value="新規会場追加(確認)"})
({/if})
({ext_include file="inc_tree_adminImageKakikomi.tpl"})
</div>
({*ここまで:navi*})
({*権限チェック*})
({if $atoffice_auth_type==1 or $atoffice_auth_type==4})

({if $post_data.hall_id})
<h2 id="ttl01">会場編集【({$post_data.hall_name})】(確認)</h2>
({else})
<h2 id="ttl01">新規会場追加(確認)</h2>
({/if})
<br>
<center>
({if $errors})
<table border=1 bgcolor=#000000 width=500>
<tr>
<td style="color:#FF0000">
<b>以下の入力項目にエラーがあります。修正してください。</b>
</td>
</tr>
({foreach from=$errors item=item})
	<tr><td style="color:#FFFF00">
	・ ({$item})
	</td></tr>
({/foreach})
</table>
({else})
<span style="font-size: 16pt;">
({if $post_data.hall_id})
会場データを以下の内容に更新します。よろしいですか？
({else})
以下の内容で会場を追加します。よろしいですか？
({/if})
</span>
({/if})
<br><br>
<table border=1 width=740 >
<tr>
<td colspan=2 bgcolor=#FFCCCC align=center height=30><b>
({if $post_data.hall_id})
会場編集
({else})
会場登録
({/if})
</tr>
<tr>
<td bgcolor=#FFE7D6><b>会場名称</b></td>
<td align=left>
　<span style="color: #FF0033;"><b>({$post_data.hall_name})</b></span>
</td>
</tr>
<tr>
<td bgcolor=#FFE7D6><b>会場属性</b></td>
<td align=left>
<span style="color: #FF0033;"><b>
({if $post_data.hall_attribute==0})
　AO管理会議室
({else})
　シェア会議室
({/if})
</b></span>
</td>
</tr>
<tr>
<td bgcolor=#FFE7D6><b>運営状態</b></td>
<td align=left>
　<span style="color: #FF0033;"><b>停止中（デフォルト）</b></span></td>
</tr>
<tr>
<td bgcolor=#FFE7D6><b>キャンセル有効期間</b></td>
<td align=left>
　<span style="color: #FF0033;"><b>({$post_data.cancel_days})</b></span>
 日前までキャンセル有効</td>
</tr>
<tr>
<td bgcolor=#FFE7D6><b>総部屋数</b></td>
<td align=left>
　<span style="color: #FF0033;"><b>({$post_data.rooms})</b></span>
 部屋</td>
</tr>
<tr>
<td bgcolor=#FFE7D6><b>利用可能時間</b></td>
<td align=left>
 <span class="spDate" >
	平日 	
　<span style="color: #FF0033;"><b>({$post_data.begin1})</b></span>
 時から 
<span style="color: #FF0033;"><b>({$post_data.finish1})</b></span>
 時まで
</span>
 <span class="spDate" >
	土曜日 	
　<span style="color: #FF0033;"><b>({$post_data.begin2})</b></span>
 時から 
<span style="color: #FF0033;"><b>({$post_data.finish2})</b></span>
 時まで
</span>
 <span class="spDate" >
	日曜日 	
　<span style="color: #FF0033;"><b>({$post_data.begin3})</b></span>
 時から 
<span style="color: #FF0033;"><b>({$post_data.finish3})</b></span>
 時まで
</span>
 <span class="spDate" >
	祝日 	
　<span style="color: #FF0033;"><b>({$post_data.begin4})</b></span>
 時から 
<span style="color: #FF0033;"><b>({$post_data.finish4})</b></span>
 時まで
</span>
</td>
</tr>
<tr>
<td bgcolor=#FFE7D6 width="180"><b>予約可能日程範囲</b></td>
<td align=left>
　<span style="color: #FF0033;"><b>({$post_data.reservation_month})ヵ月</b></span> 先まで予約可能

</td>
</tr>
<tr>
<td bgcolor=#FFE7D6 width="180"><b>振込方式</b></td>
<td align=left>
({if $post_data.bank_flag==0})
　<span style="color: #FF0033;"><b>バーチャル口座</b></span>
({else})
　<span style="color: #FF0033;"><b>指定口座</b></span>
({/if})
</td>
</tr>
<tr>
<td bgcolor=#FFE7D6 width="180"><b>看板出力</b></td>
<td align=left>
({if $post_data.kanban==0})
　<span style="color: #FF0033;"><b>準備担当が印刷</b></span>
({else})
　<span style="color: #FF0033;"><b>セルフサービス</b></span>
({/if})
</td>
</tr>

<tr>
<td bgcolor=#FFE7D6 width="180"><b>利用形態</b></td>
<td align=left>
({if $post_data.web_reserve==0})
　<span style="color: #FF0033;"><b>電話でのみ予約受け付け</b></span>
({else})
　<span style="color: #FF0033;"><b>Webからも予約を受付する</b></span>
({/if})
</td>
</tr>

</tr>
<tr>
<td bgcolor=#FFE7D6><b>オーナー収益配分</b></td>
<td align=left>
	<table>
	<td>
		部屋の収益配分：
		<span style="color: #FF0033;"><b>({$post_data.owner_room})</b><//span>％
	</td>
	<td width=10>
	</td>
	<td>
		備品の収益配分：
		<span style="color: #FF0033;"><b>({$post_data.owner_vessel})</b></span>％
	</td>
	</table>
</td>

</tr>

<tr>
<td bgcolor=#FFE7D6><b>プルダウン順序設定</b></td>
<td align=left>
	<span style="color: #FF0033;"><b>({$post_data.pulldown})</b></span>
</td>

</tr>
<tr>
<td bgcolor=#FFE7D6><b>一般利用可能</b></td>
<td align=left>
	({if $date1==1})
	<span class="spDate">
		平日 <span style="color:red; font-weight: bold">({$post_data.begin_often1})</span> 時から  <span style="color:red; font-weight: bold">({$post_data.finish_often1})</span> 時まで

	</span>

	({/if})	
	({if $date2==1})
	
	<span class="spDate">
		土曜日 <span style="color:red; font-weight: bold">({$post_data.begin_often2})</span> 時から  <span style="color:red; font-weight: bold">({$post_data.finish_often2})</span> 時まで

	</span>
	({/if})	
	({if $date3==1})
	
	<span class="spDate">
		日曜日 <span style="color:red; font-weight: bold">({$post_data.begin_often3})</span> 時から  <span style="color:red; font-weight: bold">({$post_data.finish_often3})</span> 時まで

	</span>
	({/if})	
	({if $date4==1})
	
	<span class="spDate">
		祝日 <span style="color:red; font-weight: bold">({$post_data.begin_often4})</span> 時から  <span style="color:red; font-weight: bold">({$post_data.finish_often4})</span> 時まで

	</span>
	({/if})	
</td>
</tr>
<!--<tr>
<td bgcolor=#FFE7D6><b>一般利用可能時間</b></td>
<td align=left>
	<span style="color:red; font-weight: bold">({$post_data.begin_often})</span> 時から  <span style="color:red; font-weight: bold">({$post_data.finish_often})</span> 時まで
</td>
</tr>-->
</table>

({if $post_data.hall_attribute==1})
<br>
<table border=1 width=740 >
<tr>
<td colspan=2 bgcolor=#FFFF99 align=center height=30><b>シェア会場追記項目</b></td>
</tr>
<tr>
<td bgcolor=#FFFFCC width="180"><b>入室導線</b></td>
<td align=left>
　<span style="color: #FF0033;"><b>
({if $post_data.share_option1==0})
	直接入室できる
({else})
	事務所内を通過して入室
({/if})
</b></span>
</td>
</tr>
<tr>
<td bgcolor=#FFFFCC><b>トイレ導線</b></td>
<td align=left>
　<span style="color: #FF0033;"><b>
({if $post_data.share_option2==0})
	直接入室できる
({else})
	事務所内を通過して入室
({/if})
</b></span>
</td>
</tr>
</table>
({/if})


<br>


<table border=1 width=100%>
<tr>
<td colspan=2 bgcolor=#99FFCC align=center height=30><b>会場住所等</b></td>
</tr>
<tr>
<td bgcolor="#CCFFCC" width=180><b>住所</b></td>
<td align=left>
　郵便番号：
　<span style="color: #FF0033;"><b>({$post_data.address_zip})</b></span>
<br>
　都道府県：
　<span style="color: #FF0033;"><b>({$prefecture})</b></span>
<br>
　市区町村：
　<span style="color: #FF0033;"><b>({$post_data.address_city})</b></span><br>
　以下住所：
　<span style="color: #FF0033;"><b>({$post_data.address_other})</b></span><br>
　電話番号：
　<span style="color: #FF0033;"><b>({$post_data.telephone})</b></span><br>
　FAX 番号：
　<span style="color: #FF0033;"><b>({$post_data.fax})</b></span><br>
</td>
</tr>
<tr>
<td bgcolor=#CCFFCC><b>交通</b></td>
<td align=left>
　最寄り駅１ <span style="color: #FF0033;"><b>({$post_data.line1})</b></span> 線 <span style="color: #FF0033;"><b>({$post_data.station1})</b></span> 駅から 
	({foreach from=$transportation_list.options item=item})
	({if $post_data.transportation1==$item.c_profile_option_id})
		<span style="color: #FF0033;"><b>({$item.value})</b></span>
	({/if})
	({/foreach})
<span style="color: #FF0033;"><b>({$post_data.time1})</b></span> 分<br>

({if $post_data.line2})
　最寄り駅２ <span style="color: #FF0033;"><b>({$post_data.line2})</b></span> 線 <span style="color: #FF0033;"><b>({$post_data.station2})</b></span> 駅から 
	({foreach from=$transportation_list.options item=item})
	({if $post_data.transportation2==$item.c_profile_option_id})
		<span style="color: #FF0033;"><b>({$item.value})</b></span>
	({/if})
	({/foreach})
<span style="color: #FF0033;"><b>({$post_data.time2})</b></span> 分<br>
({/if})

({if $post_data.line3})
　最寄り駅３ <span style="color: #FF0033;"><b>({$post_data.line3})</b></span> 線 <span style="color: #FF0033;"><b>({$post_data.station3})</b></span> 駅から 
	({foreach from=$transportation_list.options item=item})
	({if $post_data.transportation3==$item.c_profile_option_id})
		<span style="color: #FF0033;"><b>({$item.value})</b></span>
	({/if})
	({/foreach})
<span style="color: #FF0033;"><b>({$post_data.time3})</b></span> 分<br>
({/if})

</td>
</tr>
<tr>
<td bgcolor=#CCFFCC><b>google maps URL</b></td>
<td align=left>

URL: 
<span style="color: #FF0033;"><b>({$post_data.google_maps})</b></span>

</td>
</tr>

<tr>
<td bgcolor=#CCFFCC><b>規約 URL</b></td>
<td align=left>

URL: 
<span style="color: #FF0033;"><b>({$post_data.kiyaku_url})</b></span>

</td>
</tr>

<tr>
<td bgcolor=#CCFFCC><b>メーリングリスト</b></td>
<td align=left>

<span style="color: #FF0033;"><b>({$post_data.mailing_list})</b></span>

</td>
</tr>

<tr>
<td bgcolor=#CCFFCC><b>会場へのアクセス</b></td>
<td align=left>

<span style="color: #FF0033;"><b>
({$post_data.access|nl2br|t_url2cmd:'diary':$member.c_member_id|t_cmd:'diary'|t_decoration})
</b></span>

</td>
</tr>
<tr>
<td bgcolor=#CCFFCC><b>会場の特徴</b></td>
<td align=left>
<span style="color: #FF0033;"><b>
({$post_data.characteristic|nl2br|t_url2cmd:'diary':$member.c_member_id|t_cmd:'diary'|t_decoration})
</b></span>
</td>
</tr>
<tr>
<td bgcolor=#CCFFCC><b>基本設備</b></td>
<td align=left>
<span style="color: #FF0033;"><b>
({$post_data.facilities|nl2br|t_url2cmd:'diary':$member.c_member_id|t_cmd:'diary'|t_decoration})
</b></span>
</td>
</tr>
<tr>
<td bgcolor=#CCFFCC><b>ご案内</b></td>
<td align=left>
<span style="color: #FF0033;"><b>
({$post_data.remarks|nl2br|t_url2cmd:'diary':$member.c_member_id|t_cmd:'diary'|t_decoration})
</b></span>
</td>
</tr>
<tr>
<td bgcolor=#CCFFCC><b>会員登録規約</b></td>
<td align=left>
<span style="color: #FF0033;"><b>
({$post_data.agreement|nl2br|t_url2cmd:'diary':$member.c_member_id|t_cmd:'diary'|t_decoration})
</b></span>
</td>
</tr>
</table>

<br>

<table>
<tr>
<td>


({***作成***})

({if !$errors})
	<form name="add_hall_data" method="POST" action="./">
		<input type="hidden" name="m" value="({$module_name})" />
		<input type="hidden" name="a" value="do_({$hash_tbl->hash('add_hall_data','do')})" />
		<input type="hidden" name="sessid" value="({$PHPSESSID})" />
		<input type="hidden" name="hall_name" value="({$post_data.hall_name})">
		<input type="hidden" name="hall_attribute" value="({$post_data.hall_attribute})">
		<input type="hidden" name="flag" value="2">
		<input type="hidden" name="cancel_days" value="({$post_data.cancel_days})" >
		<input type="hidden" name="rooms" value="({$post_data.rooms})" >
		<input type="hidden" name="begin_often" value="({$post_data.begin_often})">
		<input type="hidden" name="finish_often" value="({$post_data.finish_often})">
		<input type="hidden" name="begin" value="({$post_data.begin})">
		<input type="hidden" name="finish" value="({$post_data.finish})">
		<!-- add 2016-06-21-->
		<input type="hidden" name="begin1" value="({$post_data.begin1})">
		<input type="hidden" name="finish1" value="({$post_data.finish1})">
		<input type="hidden" name="begin2" value="({$post_data.begin2})">
		<input type="hidden" name="finish2" value="({$post_data.finish2})">
		<input type="hidden" name="begin3" value="({$post_data.begin3})">
		<input type="hidden" name="finish3" value="({$post_data.finish3})">
		<input type="hidden" name="begin4" value="({$post_data.begin4})">
		<input type="hidden" name="finish4" value="({$post_data.finish4})">

		<input type="hidden" name="begin_often1" value="({$post_data.begin_often1})">
		<input type="hidden" name="finish_often1" value="({$post_data.finish_often1})">
		<input type="hidden" name="begin_often2" value="({$post_data.begin_often2})">
		<input type="hidden" name="finish_often2" value="({$post_data.finish_often2})">
		<input type="hidden" name="begin_often3" value="({$post_data.begin_often3})">
		<input type="hidden" name="finish_often3" value="({$post_data.finish_often3})">
		<input type="hidden" name="begin_often4" value="({$post_data.begin_often4})">
		<input type="hidden" name="finish_often4" value="({$post_data.finish_often4})">
		<!-- end -->
		<input type="hidden" name="reservation_month" value="({$post_data.reservation_month})">
		({if $post_data.hall_attribute==1})
		<input type="hidden" name="share_option1" value="({$post_data.share_option1})">
		<input type="hidden" name="share_option2" value="({$post_data.share_option2})">
		({/if})
		<input type="hidden" name="address_zip" value="({$post_data.address_zip})">
		<input type="hidden" name="address_prefecture" value="({$post_data.address_prefecture})">
		<input type="hidden" name="address_city" value="({$post_data.address_city})">
		<input type="hidden" name="address_other" value="({$post_data.address_other})">
		<input type="hidden" name="telephone" value="({$post_data.telephone})">
		<input type="hidden" name="fax" value="({$post_data.fax})">
		<input type="hidden" name="line1" value="({$post_data.line1})">
		<input type="hidden" name="station1" value="({$post_data.station1})">
		<input type="hidden" name="transportation1" value="({$post_data.transportation1})">
		<input type="hidden" name="time1" value="({$post_data.time1})">
		({if $post_data.line2 or $post_data.station2 or $post_data.transportation2 or $post_data.time2})
		<input type="hidden" name="line2" value="({$post_data.line2})">
		<input type="hidden" name="station2" value="({$post_data.station2})">
		<input type="hidden" name="transportation2" value="({$post_data.transportation2})">
		<input type="hidden" name="time2" value="({$post_data.time2})">
		({/if})
		({if $post_data.line3 or $post_data.station3 or $post_data.transportation3 or $post_data.time3})
		<input type="hidden" name="line3" value="({$post_data.line3})">
		<input type="hidden" name="station3" value="({$post_data.station3})">
		<input type="hidden" name="transportation3" value="({$post_data.transportation3})">
		<input type="hidden" name="time3" value="({$post_data.time3})">
		({/if})
		<input type="hidden" name="characteristic" value="({$post_data.characteristic})">
		<input type="hidden" name="facilities" value="({$post_data.facilities})">
		<input type="hidden" name="remarks" value="({$post_data.remarks})">
		<input type="hidden" name="agreement" value="({$post_data.agreement})">
		<input type="hidden" name="bank_flag" value="({$post_data.bank_flag})">
		<input type="hidden" name="kanban" value="({$post_data.kanban})">
		<input type="hidden" name="web_reserve" value="({$post_data.web_reserve})">
		<input type="hidden" name="owner_room" value="({$post_data.owner_room})">
		<input type="hidden" name="owner_vessel" value="({$post_data.owner_vessel})">
		<input type="hidden" name="google_maps" value="({$post_data.google_maps})">
		<input type="hidden" name="access" value="({$post_data.access})">
		<input type="hidden" name="kiyaku_url" value="({$post_data.kiyaku_url})">
		<input type="hidden" name="mailing_list" value="({$post_data.mailing_list})">
		<input type="hidden" name="pulldown" value="({$post_data.pulldown})">
		({if $post_data.hall_id})
		<input type="hidden" name="hall_id" value="({$post_data.hall_id})" />
		({/if})
		<input type="hidden" name="usedate" value="({$usedate_data})" />
		<input type="submit" class="input_submit" value="　登　録　" />
	</form>
({/if})
</td><td width=50></td><td>
({***修正***})
	<form name="add_hall" method="POST" action="./">
		<input type="hidden" name="m" value="({$module_name})" />
		<input type="hidden" name="a" value="page_({$hash_tbl->hash('add_hall','page')})" />
		<input type="hidden" name="correction" value="100">
		<input type="hidden" name="hall_name" value="({$post_data.hall_name})">
		<input type="hidden" name="hall_attribute" value="({$post_data.hall_attribute})">
		<input type="hidden" name="flag" value="2">
		<input type="hidden" name="cancel_days" value="({$post_data.cancel_days})" >
		<input type="hidden" name="rooms" value="({$post_data.rooms})" >
		<input type="hidden" name="begin" value="({$post_data.begin})">
		<input type="hidden" name="finish" value="({$post_data.finish})">
		<input type="hidden" name="reservation_month" value="({$post_data.reservation_month})">
		({if $post_data.hall_attribute==1})
		<input type="hidden" name="share_option1" value="({$post_data.share_option1})">
		<input type="hidden" name="share_option2" value="({$post_data.share_option2})">
		({/if})
		<input type="hidden" name="begin_often" value="({$post_data.begin_often})">
		<input type="hidden" name="finish_often" value="({$post_data.finish_often})">
		<input type="hidden" name="usedate" value="({$usedate_data})"/>
		<input type="hidden" name="address_zip" value="({$post_data.address_zip})">
		<input type="hidden" name="address_prefecture" value="({$post_data.address_prefecture})">
		<input type="hidden" name="address_city" value="({$post_data.address_city})">
		<input type="hidden" name="address_other" value="({$post_data.address_other})">
		<input type="hidden" name="telephone" value="({$post_data.telephone})">
		<input type="hidden" name="fax" value="({$post_data.fax})">
		<input type="hidden" name="line1" value="({$post_data.line1})">
		<input type="hidden" name="station1" value="({$post_data.station1})">
		<input type="hidden" name="transportation1" value="({$post_data.transportation1})">
		<input type="hidden" name="time1" value="({$post_data.time1})">
		({if $post_data.line2 or $post_data.station2 or $post_data.transportation2 or $post_data.time2})
		<input type="hidden" name="line2" value="({$post_data.line2})">
		<input type="hidden" name="station2" value="({$post_data.station2})">
		<input type="hidden" name="transportation2" value="({$post_data.transportation2})">
		<input type="hidden" name="time2" value="({$post_data.time2})">
		({/if})
		({if $post_data.line3 or $post_data.station3 or $post_data.transportation3 or $post_data.time3})
		<input type="hidden" name="line3" value="({$post_data.line3})">
		<input type="hidden" name="station3" value="({$post_data.station3})">
		<input type="hidden" name="transportation3" value="({$post_data.transportation3})">
		<input type="hidden" name="time3" value="({$post_data.time3})">
		({/if})
		<input type="hidden" name="characteristic" value="({$post_data.characteristic})">
		<input type="hidden" name="facilities" value="({$post_data.facilities})">
		<input type="hidden" name="remarks" value="({$post_data.remarks})">
		<input type="hidden" name="agreement" value="({$post_data.agreement})">
		<input type="hidden" name="bank_flag" value="({$post_data.bank_flag})">
		<input type="hidden" name="kanban" value="({$post_data.kanban})">
		<input type="hidden" name="web_reserve" value="({$post_data.web_reserve})">
		<input type="hidden" name="owner_room" value="({$post_data.owner_room})">
		<input type="hidden" name="owner_vessel" value="({$post_data.owner_vessel})">
		<input type="hidden" name="google_maps" value="({$post_data.google_maps})">
		<input type="hidden" name="access" value="({$post_data.access})">
		<input type="hidden" name="kiyaku_url" value="({$post_data.kiyaku_url})">
		<input type="hidden" name="mailing_list" value="({$post_data.mailing_list})">
		<input type="hidden" name="pulldown" value="({$post_data.pulldown})">
		({if $post_data.hall_id})
		<input type="hidden" name="hall_id" value="({$post_data.hall_id})" />
		({/if})
		<input type="submit" class="input_submit" value="　修　正　" />
	</form>

</td></tr>
</table>

</center>


({else})
<br>
<center>
<span style="font-size: 16px; color: #FF0033;"><b>アクセス権がありません。</b></span>
</center>
({/if})

<div>
({$inc_footer|smarty:nodefaults})
