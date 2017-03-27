({$inc_header|smarty:nodefaults})
({ext_include file="inc_subnavi_adminSiteMember.tpl"})
({assign var="page_name" value="メンバー詳細"})
({assign var="parent_page_name" value="メンバーリスト"})
({capture name=parent_page_url})?m=({$module_name})&amp;a=page_({$hash_tbl->hash('list_c_member')})({/capture})
({ext_include file="inc_tree_adminSiteMember.tpl"})
</div>

({*ここまで:navi*})
({if $msg})<p id="actionMsgId" class="actionMsg">({$msg})</p>({/if})
<p  id="actionMsgs" ></p>
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
    	width: 371px;
    	height: 19px;
	}
	.display_block{
		display: none;
	}
	.block-hall-list{
		width: 100%;
	}
	#display_block_id table td {
		border: none !important;
	}
</style>
<h2 id="ttl01">メンバー詳細</h2>
<div class="contents">
<p id="userImg">({if $c_member.image_filename_1})<a href="({t_img_url filename=$c_member.image_filename_1})" target="_blank"><img src="({t_img_url filename=$c_member.image_filename_1 w=120 h=120})"></a>({/if})({if $c_member.image_filename_2})<a href="({t_img_url filename=$c_member.image_filename_2})" target="_blank"><img src="({t_img_url filename=$c_member.image_filename_2 w=120 h=120})"></a>({/if})({if $c_member.image_filename_3})<a href="({t_img_url filename=$c_member.image_filename_3})" target="_blank"><img src="({t_img_url filename=$c_member.image_filename_3 w=120 h=120})"></a>({/if})</p>
<table class="userDetailTable">
	<tbody>
	<tr>
		<th>ID</th>
		<td style='border: 1px #CDCDCD solid;text-align: center;'>({$c_member.c_member_id})</td>
	</tr>
	<tr>
		<th>({$WORD_NICKNAME})</th>
		<td style='border: 1px #CDCDCD solid;text-align: center;'>({$c_member.nickname})</td>
	</tr>
	<tr>
		<th>最終ログイン</th>
		<td style='border: 1px #CDCDCD solid;text-align: center;'>({if $c_member.access_date != '0000-00-00 00:00:00'})({$c_member.access_date|date_format:"%y-%m-%d %H:%M"})({else})未ログイン({/if})</td>
	</tr>
	<tr>
		<th>登録日</th>
		<td style='border: 1px #CDCDCD solid;text-align: center;'>({$c_member.r_date|date_format:"%y-%m-%d"})</td>
	</tr>
	<tr>
		<th>生年月日</th>
		<td style='border: 1px #CDCDCD solid;text-align: center;'>({if $c_member.birth_year})({$c_member.birth_year})年({else})&nbsp;({/if})({if $c_member.birth_month})({$c_member.birth_month})月({else})&nbsp;({/if})({if $c_member.birth_day})({$c_member.birth_day})日({else})&nbsp;({/if})</td>
	</tr>
	({foreach from=$c_profile_list item=prof})
	<tr>
		<th>({$prof.caption})</th>
		<td style='border: 1px #CDCDCD solid;text-align: center;'>({if $prof.form_type == checkbox})({$c_member.profile[$prof.name].value|@t_implode:", "})({else})({$c_member.profile[$prof.name].value|t_truncate:60|nl2br})({/if})</td>
	</tr>
	({/foreach})
	<tr>
		<th>PCメールアドレス</th>
		<td style='border: 1px #CDCDCD solid;text-align: center;'>({if $c_member.secure.pc_address})<a href="mailto:({$c_member.secure.pc_address|escape:"hexentity"})">({$c_member.secure.pc_address|escape:"hexentity"})</a>({else})&nbsp;({/if})</td>
	</tr>

	<tr>
		<th>登録メールアドレス</th>
		<td style='border: 1px #CDCDCD solid;text-align: center;'>({if $c_member.secure.regist_address})({$c_member.secure.regist_address})({else})&nbsp;({/if})</td>
	</tr>

	<tr>
		<th style="background-color:#6666FF;"><b>代理店値引きを設定する</b></th>
		<td style='border: 1px #CDCDCD solid;text-align: center;'>
			<form name="add_agency" method="POST" action="./" id="add_agency_form">
			<input type="hidden" name="m" value="({$module_name})" />
			<input type="hidden" name="a" value="do_({$hash_tbl->hash('add_agency','do')})" />
			<input type="hidden" name="page" value="c_member_detail" />
			<input type="hidden" name="sessid" value="({$PHPSESSID})" />
			<input type="hidden" name="c_member_id" value="({$c_member.c_member_id})">
			<div class="block_content_detail">
				<div class="radio_left text_align_commom">
					<input id="nai" type="radio" name="flag" ({if $agency_data.type == 0}) checked ({/if}) value="0" onclick="checkAmari('nai')">会場指定なし
				</div>
				<div class="radio_right text_align_commom">
					値引き率：<input id="percentOld" type="text" name="percent" ({if $agency_data.percent != 0}) value="({$agency_data.percent})" ({/if}) size=10> ％引き
				</div>
			</div>
			<div class="block_content_detail">
				<div class="radio_left text_align_commom">
					<input id="amari" type="radio" name="flag" ({if $agency_data.type == 1}) checked ({/if}) value="1" onclick="checkAmari('amari')">会場指定あり<br>
				</div>
				<div id="display_block_id" class="radio_right text_align_commom ({if $agency_data.type == 0}) display_block ({/if})">
					({foreach from=$hall_list item=hall})
						<table style="border: none;">
							<tr class="block-hall-list">
								<td class="content_checkbox">
								<input type='checkbox' ({if ($hall.flagChecked != null && $hall.flagChecked)}) checked ({/if}) name='percents_({$hall.hall_id})' id="chx_discount_({$hall.hall_id})" value="({$hall.hall_id})" onclick="showDiscount('chx_discount_({$hall.hall_id})','discount_({$hall.hall_id})')">({$hall.hall_name})
								</td>
								<td>
								<p id="discount_({$hall.hall_id})" ({if $hall.flagChecked === null}) style="display: none" ({/if}) >値引き率：<input id="percent_({$hall.hall_id})" type="text" name="percent_({$hall.hall_id})" value="({$hall.pecentValue})" size=10> ％引き</p>
								</td>
							</tr>
						</table>
					({/foreach})
				</div>
			</div>

			<div class="block_content_detail">
				<div class="radio_left text_align_commom">
					&nbsp;&nbsp;&nbsp;&nbsp;
				</div>
				<div class="radio_right text_align_commom">
					備考：<input type="text" name="info" value="({$agency_data.info})" size=40>
				<input type="button" id="btn_submit" value="代理店値引きに登録" onClick="checkHallList(({$hallLists}))">
					
				</div>
			</div>		
			</form>
		</td>
	</tr>

	<tr>
		<th style="background-color:#AA7700;"><b>固定ﾊﾞｰﾁｬﾙ口座番号を設定する</b></th>
		<td style='border: 1px #CDCDCD solid;text-align: center;'>

			({if $vn})
				<form name="delete_virtual_account" method="POST" action="./">
				<input type="hidden" name="m" value="({$module_name})" />
				<input type="hidden" name="a" value="do_({$hash_tbl->hash('delete_virtual_account','do')})" />
				<input type="hidden" name="sessid" value="({$PHPSESSID})" />
				<input type="hidden" name="c_member_id" value="({$c_member.c_member_id})">
				<input type="hidden" name="vn" value="({$vn})">
				バーチャル口座番号：【({$vn})】　

				({if $vn_flag})
					※ 使用中のため削除できません。
				({else})
					<input type="submit" value="現在未使用のため削除できます">
				({/if})
				</form>

			({else})
			<form name="add_virtual_account" method="POST" action="./">
			<input type="hidden" name="m" value="({$module_name})" />
			<input type="hidden" name="a" value="do_({$hash_tbl->hash('add_virtual_account','do')})" />
			<input type="hidden" name="sessid" value="({$PHPSESSID})" />
			<input type="hidden" name="c_member_id" value="({$c_member.c_member_id})">
			

			<input type="submit" value="固定バーチャル口座番号を登録">
			</form>
			({/if})
		</td>
	</tr>

	<tr>
		<th style="background-color:#FF5555;"><b>ブラックリストに追加する</b></th>
		<td style='border: 1px #CDCDCD solid;text-align: center;'>
({if $blist})

	<a href="./?m=admin&a=page_blacklist">登録済みです</a>
({else})
			<form name="add_blacklist" method="POST" action="./">
			<input type="hidden" name="m" value="({$module_name})" />
			<input type="hidden" name="a" value="do_({$hash_tbl->hash('add_blacklist','do')})" />
			<input type="hidden" name="sessid" value="({$PHPSESSID})" />
			<input type="hidden" name="c_member_id" value="({$c_member.c_member_id})">
			登録理由：<input type="text" name="info" value="({$info})" size=80>
			<input type="submit" value="ブラックリストに登録">
			</form>
({/if})
		</td>
	</tr>
	<tr>
		<th style="background-color:#558855;"><b>ゲスト解除</b></th>
		<td style='border: 1px #CDCDCD solid;text-align: center;'>
		({if $c_member.guest_flag})
			<form name="guest" method="POST" action="./">
			<input type="hidden" name="m" value="({$module_name})" />
			<input type="hidden" name="a" value="do_({$hash_tbl->hash('change_guest_account','do')})" />
			<input type="hidden" name="sessid" value="({$PHPSESSID})" />
			<input type="hidden" name="c_member_id" value="({$c_member.c_member_id})">
			<input type="submit" value="ゲストを解除する">
			</form>
			※ ゲストは一度解除すると元に戻せません。
		({else})
			ゲストアカウントではありません。
		({/if})
		</td>
	</tr>

	</tbody>
</table>

<p class="groupLing"><a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('list_c_member')})" onClick="history.back(); return false;" onKeyPress="history.back(); return false;">メンバーリストに戻る</a></p>

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
		if(flag == 0){
			document.getElementById('btn_submit').type = 'submit';
		}else{
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
				}else{
					document.getElementById('percent_'+arr[i]).value = '';
				}
			}
			if(flagErr == 1){
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
