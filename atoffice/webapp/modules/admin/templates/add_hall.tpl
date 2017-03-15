({$inc_header|smarty:nodefaults})
({ext_include file="inc_subnavi_adminImageKakikomi.tpl"})
({assign var="page_name" value="会場登録"})
({if $hall_id})
({assign var="page_name" value="会場編集"})
({else})
({assign var="page_name" value="会場登録"})
({/if})
({ext_include file="inc_tree_adminImageKakikomi.tpl"})
</div>

({*ここまで:navi*})

({*権限チェック*})
({if $atoffice_auth_type==1 or $atoffice_auth_type==4})

({if $hall_id})
<h2 id="ttl01">会場編集【({$post_data.hall_name})】</h2>
({else})
<h2 id="ttl01">会場登録</h2>
({/if})

<br>

<script type="text/javascript">

function Sel(){
	var obj=document.forms['add_hall'].elements['hall_attribute'];
	if(obj[0].checked){
	document.getElementById('d1').style.display='none';
	}
	if(obj[1].checked){
	document.getElementById('d1').style.display='block';
	}
}

function mycheck(obj) {
        if(obj.checked) {
                obj.style.border='solid 2px greenyellow';
                obj.style.outline='solid 2px greenyellow';
        } else {
                obj.style.border='none';
                obj.style.outline='none';
        }
}

function begin_Sub(SEL,LIST){
	while(SEL.options[1])SEL.remove(1);
	if(LIST) {
		for(var i=0;LIST[i];i++) {
			var OPT = document.createElement('option');
			OPT.value = LIST[i];
			OPT.appendChild(document.createTextNode(LIST[i]));
			SEL.appendChild(OPT);
		}
	}
	SEL.selectedIndex = 0;
	if(SEL.onchange)SEL.onchange(SEL,null);
}


function f_begin(SEL){
	var LIST = new Array();

	//LIST['0']=['01','02','03','04','05','06','07','08','09','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24'];
	LIST['1']=['02','03','04','05','06','07','08','09','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24'];
	LIST['2']=['03','04','05','06','07','08','09','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24'];
	LIST['3']=['04','05','06','07','08','09','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24'];
	LIST['4']=['05','06','07','08','09','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24'];
	LIST['5']=['06','07','08','09','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24'];
	LIST['6']=['07','08','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24'];
	LIST['7']=['08','09','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24'];
	LIST['8']=['09','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24'];
	LIST['9']=['10','11','12','13','14','15','16','17','18','19','20','21','22','23','24'];
	LIST['10']=['11','12','13','14','15','16','17','18','19','20','21','22','23','24'];
	LIST['11']=['12','13','14','15','16','17','18','19','20','21','22','23','24'];
	LIST['12']=['13','14','15','16','17','18','19','20','21','22','23','24'];
	LIST['13']=['14','15','16','17','18','19','20','21','22','23','24'];
	LIST['14']=['15','16','17','18','19','20','21','22','23','24'];
	LIST['15']=['16','17','18','19','20','21','22','23','24'];
	LIST['16']=['17','18','19','20','21','22','23','24'];
	LIST['17']=['18','19','20','21','22','23','24'];
	LIST['18']=['19','20','21','22','23','24'];
	LIST['19']=['20','21','22','23','24'];
	LIST['19']=['20','21','22','23','24'];
	LIST['20']=['21','22','23','24'];
	LIST['21']=['22','23','24'];
	LIST['22']=['23','24'];
	LIST['23']=['24'];

	begin_Sub(
		document.getElementsByName('finish')[0],
		LIST[SEL.options[SEL.selectedIndex].value]
	);

}

</script>


<center>

({if $msg})<p class="actionMsg">({$msg})</p>({/if})

<form name="add_hall" method="POST" action="./">
<input type="hidden" name="m" value="({$module_name})" />
<input type="hidden" name="a" value="page_({$hash_tbl->hash('add_hall_confirm','page')})" />

({if $post_data.hall_id})
<input type="hidden" name="hall_id" value="({$post_data.hall_id})" />
({/if})

<table border=1 width=740 >
<tr>
<td colspan=2 bgcolor=#FFCCCC align=center height=30><b>
({if $post_data.hall_id})
会場編集
({else})
会場登録
({/if})
</b></td>
</tr>
<tr>
<td bgcolor=#FFE7D6><b>会場名称</b></td>
<td align=left><input type="text" name="hall_name" size=80 value="({$post_data.hall_name})"></td>
</tr>
<tr>
<td bgcolor=#FFE7D6><b>会場属性</b></td>
<td align=left>
	<table width=300>
	<td>
	<input type="radio" name="hall_attribute" value="0" onclick="Sel()"
	({if $post_data.hall_attribute==0})checked({/if})>AO管理会議室
	</td>
	<td>
	<input type="radio" name="hall_attribute" value="1" onclick="Sel()"
	({if $post_data.hall_attribute==1})checked({/if})>シェア会議室
	</td>
	</table>
</td>
</tr>
<tr>
<td bgcolor=#FFE7D6><b>運営状態</b></td>
<td align=left><b>停止中（デフォルト）</b></td>
</tr>
<tr>
<td bgcolor=#FFE7D6><b>キャンセル有効期間</b></td>
<td align=left><input type="text" name="cancel_days" size=5 value="({$post_data.cancel_days})"> 日前までキャンセル有効</td>
</tr>
<tr>
<td bgcolor=#FFE7D6><b>総部屋数</b></td>
<td align=left><input type"text" name="rooms" size=5 value="({$post_data.rooms})"> 部屋</td>
</tr>
<tr>
<td bgcolor=#FFE7D6><b>利用可能時間</b></td>
<td align=left>
<select name="begin" onChange="f_begin(this)">
<option value="">開始時間</option>
({***
<option value="0" ({if $post_data.correction==100 and $post_data.begin==0})selected({/if})>00</option>
***})
<option value="1" ({if $post_data.begin==1})selected({/if})>01</option>
<option value="2" ({if $post_data.begin==2})selected({/if})>02</option>
<option value="3" ({if $post_data.begin==3})selected({/if})>03</option>
<option value="4" ({if $post_data.begin==4})selected({/if})>04</option>
<option value="5" ({if $post_data.begin==5})selected({/if})>05</option>
<option value="6" ({if $post_data.begin==6})selected({/if})>06</option>
<option value="7" ({if $post_data.begin==7})selected({/if})>07</option>
<option value="8" ({if $post_data.begin==8})selected({/if})>08</option>
<option value="9" ({if $post_data.begin==9})selected({/if})>09</option>
<option value="10" ({if $post_data.begin==10})selected({/if})>10</option>
<option value="11" ({if $post_data.begin==11})selected({/if})>11</option>
<option value="12" ({if $post_data.begin==12})selected({/if})>12</option>
<option value="13" ({if $post_data.begin==13})selected({/if})>13</option>
<option value="14" ({if $post_data.begin==14})selected({/if})>14</option>
<option value="15" ({if $post_data.begin==15})selected({/if})>15</option>
<option value="16" ({if $post_data.begin==16})selected({/if})>16</option>
<option value="17" ({if $post_data.begin==17})selected({/if})>17</option>
<option value="18" ({if $post_data.begin==18})selected({/if})>18</option>
<option value="19" ({if $post_data.begin==19})selected({/if})>19</option>
<option value="20" ({if $post_data.begin==20})selected({/if})>20</option>
<option value="21" ({if $post_data.begin==21})selected({/if})>21</option>
<option value="22" ({if $post_data.begin==22})selected({/if})>22</option>
</select>
 時から 
<select name="finish">
({if $post_data.correction==100})
<option value="({$post_data.finish})">({$post_data.finish})</option>
({else})
<option value="">終了時間</option>
({/if})
</select> 時まで</td>
</tr>
<tr>
<td bgcolor=#FFE7D6><b>予約可能日程範囲</b></td>
<td align=left>
<select name="reservation_month">
<option value="1" ({if $post_data.reservation_month==1})selected({/if})>1ヶ月</option>
<option value="2" ({if $post_data.reservation_month==2})selected({/if})>2ヶ月</option>
<option value="3" ({if $post_data.reservation_month==3})selected({/if})>3ヶ月</option>
<option value="4" ({if $post_data.reservation_month==4})selected({/if})>4ヶ月</option>
<option value="5" ({if $post_data.reservation_month==5})selected({/if})>5ヶ月</option>
<option value="6" ({if $post_data.reservation_month==6})selected({/if})>6ヶ月</option>
<option value="7" ({if $post_data.reservation_month==7})selected({/if})>7ヶ月</option>
<option value="8" ({if $post_data.reservation_month==8})selected({/if})>8ヶ月</option>
<option value="9" ({if $post_data.reservation_month==9})selected({/if})>9ヶ月</option>
<option value="10" ({if $post_data.reservation_month==10})selected({/if})>10ヶ月</option>
<option value="11" ({if $post_data.reservation_month==11})selected({/if})>11ヶ月</option>
<option value="12" ({if $post_data.reservation_month==12})selected({/if})>12ヶ月</option>
</select> 先まで予約可能<br>
</td>
</tr>
<tr>
<td bgcolor=#FFE7D6><b>振込方式</b></td>
<td align=left>
	<table width=350>
	<td>
	<input type="radio" name="bank_flag" value="0" onclick="Sel()" ({if $post_data.bank_flag==0})checked({/if})>バーチャル口座
	</td>
({******
	<td>
	<input type="radio" name="bank_flag" value="1" onclick="Sel()" ({if $post_data.bank_flag==1})checked({/if})>指定口座
	</td>
*******})
	</table>
</td>
</tr>
<tr>
<td bgcolor=#FFE7D6><b>看板出力</b></td>
<td align=left>
	<table width=350>
	<td>
	<input type="radio" name="kanban" value="0" onclick="Sel()" ({if $post_data.kanban==0})checked({/if})>準備担当が印刷
	</td>
	<td>
	<input type="radio" name="kanban" value="1" onclick="Sel()" ({if $post_data.kanban==1})checked({/if})>セルフサービス
	</td>
	</table>
</td>
</tr>
<tr>
<td bgcolor=#FFE7D6><b>予約形態</b></td>
<td align=left>
	<table width=350>
	<td>
	<input type="radio" name="web_reserve" value="0" onclick="Sel()" ({if $post_data.web_reserve==0})checked({/if})>電話でのみ予約受け付け
	</td>
	<td>
	<input type="radio" name="web_reserve" value="1" onclick="Sel()" ({if $post_data.web_reserve==1})checked({/if})>Webからも予約を受付する
	</td>
	</table>
</td>

</tr>
<tr>
<td bgcolor=#FFE7D6><b>オーナー収益配分</b></td>
<td align=left>
	<table>
	<td>
		部屋の収益配分：
		<input type="text" name="owner_room" value="({$post_data.owner_room})" size=8 style="text-align:right;padding-right:5px;">％
	</td>
	<td width=10>
	</td>
	<td>
		備品の収益配分：
		<input type="text" name="owner_vessel" value="({$post_data.owner_vessel})" size=8 style="text-align:right;padding-right:5px;">％
	</td>
	</table>
</td>
</tr>
<tr>
<td bgcolor=#FFE7D6><b>プルダウン順序設定</b></td>
<td align=left>
		<input type="text" name="pulldown" value="({$post_data.pulldown})" size=8 style="text-align:right;padding-right:5px;">※数値の大きい順に表示されます。（数値が同じ場合は会場を登録した順です）<br>
現在の設定:
<select>
<option style="font-weight:bold">(数値)[会場名]</option>
({foreach from=$pulldown item=item})
	({if $item.flag==0})
		<option style="color:green;">(({$item.pulldown}))({$item.hall_name})</option>
	({elseif $item.flag==1})
		<option style="color:blue;">(({$item.pulldown}))({$item.hall_name})</option>
	({else})
		<option style="color:red;">(({$item.pulldown}))({$item.hall_name})</option>
	({/if})
({/foreach})
</select>
(緑：運営中　青：メンテ中　赤：停止中)
</td>
</tr>
<tr>
<td bgcolor=#FFE7D6><b>一般利用可能</b></td>
<td class="tdspec">		
	({if $post_data.hall_id})	
		<label class="listcheckUse">
			<input type="checkbox" ({foreach from=$result1 item=item}) ({if $item == '1'}) checked ({/if}) ({/foreach}) name="usedate[]" value="1" class="listcheckUsesp"> 平日
		</label>
		<label class="listcheckUse">
			<input type="checkbox" ({foreach from=$result1 item=item}) ({if $item == '2'}) checked ({/if}) ({/foreach}) name="usedate[]" value="2" class="listcheckUsesp"> 土曜日
		</label>
		<label class="listcheckUse">
			<input type="checkbox" ({foreach from=$result1 item=item}) ({if $item == '3'}) checked ({/if}) ({/foreach}) name="usedate[]" value="3" class="listcheckUsesp"> 日曜日
		</label>
		<label class="listcheckUse">
			<input type="checkbox" ({foreach from=$result1 item=item}) ({if $item == '4'}) checked ({/if}) ({/foreach}) name="usedate[]" value="4" class="listcheckUsesp"> 祝日
		</label>		
	({else})
		<label class="listcheckUse">
				<input type="checkbox" name="usedate[]" value="1" class="listcheckUsesp"> 平日
		</label>
		<label class="listcheckUse">
				<input type="checkbox" name="usedate[]" value="2" class="listcheckUsesp"> 土曜日
		</label>
		<label class="listcheckUse">
			<input type="checkbox" name="usedate[]" value="3" class="listcheckUsesp"> 日曜日
		</label>
		<label class="listcheckUse">
			<input type="checkbox" name="usedate[]" value="4" class="listcheckUsesp"> 祝日
		</label>					
	({/if})
</td>
</tr>
<tr>
<td bgcolor=#FFE7D6><b>一般利用可能時間</b></td>
<td class="tdspec" style="text-align:left">
	({if $post_data.hall_id})
			<p>
				({foreach from=$result2 item=item})	
				<select name="begin_often">				
					<script>
						var a = ({$item.begin_often});
						for(var i = 1; i <= 24; i++){							
							if(a == i){
								if(i<10){
									document.write('<option selected value="'+i+'">0'+i+'</option>');	
								}
								else
								{
									document.write('<option selected value="'+i+'">'+i+'</option>');
								}
							}
							else{
								if(i<10)
									{document.write('<option value="'+i+'">0'+i+'</option>');
								}
								else
								{
									document.write('<option  value="'+i+'">'+i+'</option>');
								}
							}
						}						
					</script>	
				</select>
				時から
				<select name="finish_often">				
					<script>
						var a = ({$item.finish_often});
						for(var i = 1; i <= 24; i++){							
							if(a == i){
								if(i<10){
									document.write('<option selected value="'+i+'">0'+i+'</option>');	
								}
								else
								{
									document.write('<option selected value="'+i+'">'+i+'</option>');
								}
							}
							else{
								if(i<10)
									{document.write('<option value="'+i+'">0'+i+'</option>');
								}
								else
								{
									document.write('<option  value="'+i+'">'+i+'</option>');
								}
							}
						}						
					</script>	
				</select>
				時まで
				({/foreach})
				({if $result2 == ''})
					<p>
						<select name="begin_often">				
							<script>
								var a = ({$post_data.begin_often});
								for(var i = 1; i <= 24; i++){							
									if(a == i){
										if(i<10){
											document.write('<option selected value="'+i+'">0'+i+'</option>');	
										}
										else
										{
											document.write('<option selected value="'+i+'">'+i+'</option>');
										}
									}
									else{
										if(i<10)
											{document.write('<option value="'+i+'">0'+i+'</option>');
										}
										else
										{
											document.write('<option  value="'+i+'">'+i+'</option>');
										}
									}
								}						
							</script>	
						</select>
						時から
						<select name="finish_often">				
							<script>		
								var a = ({$post_data.finish_often});
								for(var i = 1; i <= 24; i++){							
									if(a == i){
										if(i<10){
											document.write('<option selected value="'+i+'">0'+i+'</option>');	
										}
										else
										{
											document.write('<option selected value="'+i+'">'+i+'</option>');
										}
									}
									else{
										if(i<10)
											{document.write('<option value="'+i+'">0'+i+'</option>');
										}
										else
										{
											document.write('<option  value="'+i+'">'+i+'</option>');
										}
									}
								}						
							</script>	
						</select>
					</p>
				({/if})				
			</p>
			
	({else})
	<p>
	<select name="begin_often">
		<option value="1" ({if $post_data.begin_often==1})selected({/if})>01</option>
		<option value="2" ({if $post_data.begin_often==2})selected({/if})>02</option>
		<option value="3" ({if $post_data.begin_often==3})selected({/if})>03</option>
		<option value="4" ({if $post_data.begin_often==4})selected({/if})>04</option>
		<option value="5" ({if $post_data.begin_often==5})selected({/if})>05</option>
		<option value="6" ({if $post_data.begin_often==6})selected({/if})>06</option>
		<option value="7" ({if $post_data.begin_often==7})selected({/if})>07</option>
		<option value="8" ({if $post_data.begin_often==8})selected({/if})>08</option>
		<option value="9" ({if $post_data.begin_often==9})selected({/if})>09</option>
		<option value="10" ({if $post_data.begin_often==10})selected({/if})>10</option>
		<option value="11" ({if $post_data.begin_often==11})selected({/if})>11</option>
		<option value="12" ({if $post_data.begin_often==12})selected({/if})>12</option>
		<option value="13" ({if $post_data.begin_often==13})selected({/if})>13</option>
		<option value="14" ({if $post_data.begin_often==14})selected({/if})>14</option>
		<option value="15" ({if $post_data.begin_often==15})selected({/if})>15</option>
		<option value="16" ({if $post_data.begin_often==16})selected({/if})>16</option>
		<option value="17" ({if $post_data.begin_often==17})selected({/if})>17</option>
		<option value="18" ({if $post_data.begin_often==18})selected({/if})>18</option>
		<option value="19" ({if $post_data.begin_often==19})selected({/if})>19</option>
		<option value="20" ({if $post_data.begin_often==20})selected({/if})>20</option>
		<option value="21" ({if $post_data.begin_often==21})selected({/if})>21</option>
		<option value="22" ({if $post_data.begin_often==22})selected({/if})>22</option>
		<option value="23" ({if $post_data.begin_often==23})selected({/if})>23</option>
		<option value="24" ({if $post_data.begin_often==24})selected({/if})>24</option>
	</select>
	時から
	<select name="finish_often">	
		<option value="1" ({if $post_data.finish_often==1})selected({/if})>01</option>
		<option value="2" ({if $post_data.finish_often==2})selected({/if})>02</option>
		<option value="3" ({if $post_data.finish_often==3})selected({/if})>03</option>
		<option value="4" ({if $post_data.finish_often==4})selected({/if})>04</option>
		<option value="5" ({if $post_data.finish_often==5})selected({/if})>05</option>
		<option value="6" ({if $post_data.finish_often==6})selected({/if})>06</option>
		<option value="7" ({if $post_data.finish_often==7})selected({/if})>07</option>
		<option value="8" ({if $post_data.finish_often==8})selected({/if})>08</option>
		<option value="9" ({if $post_data.finish_often==9})selected({/if})>09</option>
		<option value="10" ({if $post_data.finish_often==10})selected({/if})>10</option>
		<option value="11" ({if $post_data.finish_often==11})selected({/if})>11</option>
		<option value="12" ({if $post_data.finish_often==12})selected({/if})>12</option>
		<option value="13" ({if $post_data.finish_often==13})selected({/if})>13</option>
		<option value="14" ({if $post_data.finish_often==14})selected({/if})>14</option>
		<option value="15" ({if $post_data.finish_often==15})selected({/if})>15</option>
		<option value="16" ({if $post_data.finish_often==16})selected({/if})>16</option>
		<option value="17" ({if $post_data.finish_often==17})selected({/if})>17</option>
		<option value="18" ({if $post_data.finish_often==18})selected({/if})>18</option>
		<option value="19" ({if $post_data.finish_often==19})selected({/if})>19</option>
		<option value="20" ({if $post_data.finish_often==20})selected({/if})>20</option>
		<option value="21" ({if $post_data.finish_often==21})selected({/if})>21</option>
		<option value="22" ({if $post_data.finish_often==22})selected({/if})>22</option>
		<option value="23" ({if $post_data.finish_often==23})selected({/if})>23</option>
		<option value="24" ({if $post_data.finish_often==24})selected({/if})>24</option>
	</select>
	時まで
	</p>
	({/if})
</td>
</tr>
</table>
<div id="d1" ({if $post_data.hall_attribute==0}) style="display:none;"({/if})>
<br>
<table border=1 width=740 >
<tr>
<td colspan=2 bgcolor=#FFFF99 align=center height=30>
<b>シェア会場追記項目</b></td>
</tr>
<tr>
<td bgcolor=#FFFFCC><b>入室導線</b></td>
<td align=left>
	<table width=350>
	<td>
	<input type="radio" name="share_option1" value="0" onclick="Sel()" ({if $post_data.share_option1==0})checked({/if})>直接入室できる
	</td>
	<td>
	<input type="radio" name="share_option1" value="1" onclick="Sel()" ({if $post_data.share_option1==1})checked({/if})>事務所内を通過して入室
	</td>
	</table>
</td>
</tr>
<tr>
<td bgcolor=#FFFFCC><b>トイレ導線</b></td>
<td align=left>
	<table width=350>
	<td>
	<input type="radio" name="share_option2" value="0" onclick="Sel()" ({if $post_data.share_option2==0})checked({/if})>直接入室できる
	</td>
	<td>
	<input type="radio" name="share_option2" value="1" onclick="Sel()" ({if $post_data.share_option2==1})checked({/if})>事務所内を通過して入室
	</td>
	</table>
</td>
</tr>
</table>
</div>
<br>
<table border=1 width=740 >
<tr>
<td colspan=2 bgcolor=#99FFCC align=center height=30>
<b>会場住所等</b></td>
</tr>
<tr>
<td bgcolor=#CCFFCC width=180><b>住所</b></td>
<td align=left>
郵便番号 <input type="text" name="address_zip" value="({$post_data.address_zip})"> (半角) 例)153-0044<br>
都道府県 
	<select name="address_prefecture">
	<option value="">選択してください</option>
	({foreach from=$profile_list.options item=item})
		<option value="({$item.c_profile_option_id})" ({if $item.c_profile_option_id==$post_data.address_prefecture})selected({/if})>({$item.value|default:"--"})</option>
	({/foreach})
	</select> 例)東京都<br>
市区町村 <input type="text" name="address_city" value="({$post_data.address_city})"> 例)目黒区<br>
以下住所 <input type="text" name="address_other" value="({$post_data.address_other})"> 例)大橋2-22-6<br>
電話番号 <input type="text" name="telephone" value="({$post_data.telephone})"> (ハイフン有り) 例)03-5452-3711<br>
FAX 番号 <input type="text" name="fax" value="({$post_data.fax})"> (ハイフン有り) 例)03-5452-3711<br>
</td>
</tr>
<tr>
<td bgcolor=#CCFFCC><b>交通</b></td>
<td align=left>
最寄り駅１ <input type="text" name="line1" size="10" value="({$post_data.line1})"> 線 <input type="text" name="station1" value="({$post_data.station1})"> 駅から
	<select name="transportation1">
	<option value="">選択してください</option>
	({foreach from=$transportation_list.options item=item})
		<option value="({$item.c_profile_option_id})" ({if $item.c_profile_option_id==$post_data.transportation1})selected({/if})>({$item.value|default:"--"})</option>
	({/foreach})
	</select> <input type="text" name="time1" size="5" value="({$post_data.time1})">分<br>

最寄り駅２ <input type="text" name="line2" size="10" value="({$post_data.line2})"> 線 <input type="text" name="station2" value="({$post_data.station2})"> 駅から
	<select name="transportation2">
	<option value="">選択してください</option>
	({foreach from=$transportation_list.options item=item})
		<option value="({$item.c_profile_option_id})" ({if $item.c_profile_option_id==$post_data.transportation2})selected({/if})>({$item.value|default:"--"})</option>
	({/foreach})
	</select> <input type="text" name="time2" size="5" value="({$post_data.time2})">分<br>

最寄り駅３ <input type="text" name="line3" size="10" value="({$post_data.line3})"> 線 <input type="text" name="station3" value="({$post_data.station3})"> 駅から
	<select name="transportation3">
	<option value="">選択してください</option>
	({foreach from=$transportation_list.options item=item})
		<option value="({$item.c_profile_option_id})" ({if $item.c_profile_option_id==$post_data.transportation3})selected({/if})>({$item.value|default:"--"})</option>
	({/foreach})
	</select> <input type="text" name="time3" size="5" value="({$post_data.time3})">分<br>
</td>
</tr>
<tr>
<td bgcolor=#CCFFCC><b>google maps URL</b></td>
<td align=left>
<input type="text" name="google_maps" size="90" value="({$post_data.google_maps})">
</td>
</tr>
<tr>
<td bgcolor=#CCFFCC><b>規約 URL</b></td>
<td align=left>
<input type="text" name="kiyaku_url" size="90" value="({$post_data.kiyaku_url})">
</td>
</tr>
<tr>
<td bgcolor=#CCFFCC><b>メーリングリスト</b></td>
<td align=left>
<input type="text" name="mailing_list" size="90" value="({$post_data.mailing_list})">
</td>
</tr>
<tr>
<td bgcolor=#CCFFCC><b>会場へのアクセス</b></td>
<td align=left>
<textarea id="mce_editor_textarea" name="access" rows="({$_rows|default:'6'})" cols="({$_cols|default:'70'})">({$post_data.access})</textarea>
</td>
</tr>
<tr>
<td bgcolor=#CCFFCC><b>会場の特徴</b></td>
<td align=left>
<textarea id="mce_editor_textarea" name="characteristic" rows="({$_rows|default:'4'})" cols="({$_cols|default:'70'})">({$post_data.characteristic})</textarea>
</td>
</tr>
<tr>
<td bgcolor=#CCFFCC><b>基本設備</b></td>
<td align=left>
<textarea id="mce_editor_textarea" name="facilities" rows="({$_rows|default:'4'})" cols="({$_cols|default:'70'})">({$post_data.facilities})</textarea>
</td>
</tr>
<tr>
<td bgcolor=#CCFFCC><b>ご案内</b></td>
<td align=left>
<textarea id="mce_editor_textarea" name="remarks" rows="({$_rows|default:'4'})" cols="({$_cols|default:'70'})">({$post_data.remarks})</textarea>
</td>
</tr>
<tr>
<td bgcolor=#CCFFCC><b>会員登録規約</b></td>
<td align=left>
<textarea id="mce_editor_textarea" name="agreement" rows="({$_rows|default:'15'})" cols="({$_cols|default:'70'})">({$post_data.agreement})</textarea>
</td>
</tr>
</table>
<br>

<input type="submit" value="確認画面へ">

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
<style>
.listcheckUse{ float:left; margin-right: 15px; vertical-align: middle;}
.listcheckUsesp{
	margin-top:10px;
	display: inline;
}
td.tdspec{
	padding: 5px 7px;
}
</style>