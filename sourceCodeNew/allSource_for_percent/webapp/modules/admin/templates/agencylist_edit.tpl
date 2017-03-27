({$inc_header|smarty:nodefaults})
({ext_include file="inc_subnavi_adminSiteMember.tpl"})
({assign var="page_name" value="代理店値引き編集"})
({assign var="parent_page_name" value="代理店値引き管理"})
({capture name=parent_page_url})?m=({$module_name})&amp;a=page_({$hash_tbl->hash('blacklist')})({/capture})

({ext_include file="inc_tree_adminSiteMember.tpl"})
</div>
<style type="text/css">
	.radio_left{
		width: 15%;
		float: left;
	}
	.radio_right{
		width: 82%;
		float: left;
	}
	.block_content_detail{
		width: 100%;
		padding-left: 3%;
		padding-bottom: 25px;
	}
	.text_align_commom{
		text-align: left;
	}
	.content_checkbox{
    	width: 380px;
    	height: 19px;
	}
	.display_block{
		display: none;
	}
	.block-hall-list{
		width: 100%;
	}
	.td_boder_none{
		border: none !important;
	}
	#display_block_id table td {
		border: none !important;
	}
	.th_min_width{
		min-width: 50px !important;
	}
</style>
({*ここまで:navi*})

({if $msg})<p id="actionMsgId" class="actionMsg">({$msg})</p>({/if})
<p  id="actionMsgs" ></p>
<h2>代理店値引き編集</h2>
<div class="contents">

<p class="caution">※部屋の値段から割引されます。（ログイン必須）。</p>

<form name="add_blacklist" method="POST" action="./">
<input type="hidden" name="m" value="({$module_name})" />
<input type="hidden" name="a" value="do_({$hash_tbl->hash('add_agency','do')})" />
<input type="hidden" name="page" value="agencylist_edit" />
<input type="hidden" name="sessid" value="({$PHPSESSID})" />
<input type="hidden" name="c_member_id" value="({$agencylist.c_member_id})">

<table class="basicType2" style="width: 910px !important;">
<tbody>
<tr>
<th class="th_min_width">氏名</th>
<td>({$agencylist.nickname})</td>
</tr>
<tr>
<th>値引き率</th>
<td>
	<div class="block_content_detail">
		<div class="radio_left text_align_commom">
			<input id="nai" type="radio" name="flag" value="0" ({if $agencylist.type == 0}) checked ({/if}) onclick="checkAmari('nai')">会場指定なし
		</div>
		<div class="radio_right text_align_commom">
			値引き率：<input id="percentOld" type="text" name="percent" ({if $agencylist.percent != 0}) value="({$agencylist.percent})" ({/if}) size=10> ％引き
		</div>
	</div>

	<div class="block_content_detail">
		<div class="radio_left text_align_commom">
			<input id="amari" type="radio" name="flag" value="1" ({if $agencylist.type == 1}) checked ({/if}) onclick="checkAmari('amari')">会場指定あり<br>
		</div>
		<div id="display_block_id" class="radio_right text_align_commom ({if $agencylist.type == 0}) display_block ({/if})">
			({foreach from=$hall_list item=hall})
				<table>
					<tr class="block-hall-list">
						<td class="content_checkbox td_boder_none">
						<input type='checkbox' ({if ($hall.flagChecked != null && $hall.flagChecked)}) checked ({/if}) name='percents_({$hall.hall_id})' id="chx_discount_({$hall.hall_id})" value="({$hall.hall_id})" onclick="showDiscount('chx_discount_({$hall.hall_id})','discount_({$hall.hall_id})')">({$hall.hall_name})
						</td>
						<td class="td_boder_none">
						<p id="discount_({$hall.hall_id})" ({if $hall.flagChecked === null}) class="display_block" ({/if}) >値引き率：<input id="percent_({$hall.hall_id})" type="text" name="percent_({$hall.hall_id})" value="({$hall.pecentValue})" size=10> ％引き</p>
						</td>
					</tr>
				</table>
			({/foreach})
		</div>
	</div>
</td>
</tr>

<tr>
<th>備考</th>
<td><textarea class="basic" name="info" cols="50" rows="4">({$agencylist.info})</textarea></td>
</tr>
</tbody>
</table>

<p class="textBtn">
<input type="button" id="btn_submit" class="submit"  value="　決　定　" onClick="checkHallList(({$hallLists}))">
</p>
</form>
<script type="text/javascript">	
	
	var flag = 0;
	var nai = document.getElementById('nai').checked;
	if(nai == false){
		flag = 1;
	}
	function checkAmari(id)
	{
		var val = document.getElementById(id).value;
		if(val == 1)
		{
			flag = 1;
			//rremove class display_block
			document.getElementById("display_block_id").style.display="block";			
		}else{
			flag = 0;
			document.getElementById("display_block_id").style.display="none";
		}
	}
	// show discount
	function showDiscount(chx_id,dis_id)
	{
		var val = document.getElementById(chx_id).checked;
		if(val === true)
		{
			document.getElementById(dis_id).style.display="block";
		}else{
			document.getElementById(dis_id).style.display="none";
		}
	}
	// checkHallList
	function checkHallList(arr){
		var count = 0;
		var reg = new RegExp('^\\d+$');
		if(flag == 0){
			percent = document.getElementById('percentOld').value;
			if(percent == ''|| reg.test(percent) === 'false' || percent < 1 || percent > 100 ||  isNaN(percent) == true){
				if(document.getElementById("actionMsgId") != null){
					document.getElementById("actionMsgId").remove();
				}
				document.getElementById('actionMsgs').className = " actionMsg";
				document.getElementById('actionMsgs').innerHTML = '値引き率には1以上100以下の半角数字を入力してください。';
				window.scrollTo(30, 50);
			}else{
				document.getElementById('btn_submit').type = 'submit';
			}
		}else{
			// console.log(flag);
			var flagErr = 1;
			document.getElementById('btn_submit').type = 'button';
			// check validate			
			var reg = new RegExp('^\\d+$');

			for (i = 0; i < arr.length; i++) {
			    percent = document.getElementById('percent_'+arr[i]).value;
			    if(document.getElementById('chx_discount_'+arr[i]).checked){
			    	if(percent == '' || reg.test(percent) === 'false' || percent < 1 || percent > 100 || isNaN(percent) == true){
						flagErr = 0;
					}
					count++;			
				}else{
					document.getElementById('percent_'+arr[i]).value = '';
				}
			}
			if(flagErr == 1 && count > 0){
				document.getElementById("percentOld").value = '';
				document.getElementById('btn_submit').type = 'submit';
			}else{
				if(document.getElementById("actionMsgId") != null){
					document.getElementById("actionMsgId").remove();
				}
				document.getElementById('actionMsgs').className = " actionMsg";
				document.getElementById('actionMsgs').innerHTML = '値引き率には1以上100以下の半角数字を入力してください。';
				window.scrollTo(30, 50);
			}
		}
	}
	
</script> 
({$inc_footer|smarty:nodefaults})
