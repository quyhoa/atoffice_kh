({$inc_header|smarty:nodefaults})
({ext_include file="inc_subnavi_adminStatisticalInformation.tpl"})
({assign var="page_name" value="顧客情報修正画面"})
({assign var="parent_page_name" value="顧客情報管理"})
({capture name=parent_page_url})?m=({$module_name})&amp;a=page_({$hash_tbl->hash('customer_edit')})({/capture})
({ext_include file="inc_tree_adminStatisticalInformation.tpl"})
</div>

({*ここまで:navi*})
({if $msg})<p class="actionMsg">({$msg})</p>({/if})
<h2 id="ttl01">メンバー詳細(編集)</h2>
<div class="contents">

<p id="userImg">({if $c_member.image_filename_1})<a href="({t_img_url filename=$c_member.image_filename_1})" target="_blank"><img src="({t_img_url filename=$c_member.image_filename_1 w=120 h=120})"></a>({/if})({if $c_member.image_filename_2})<a href="({t_img_url filename=$c_member.image_filename_2})" target="_blank"><img src="({t_img_url filename=$c_member.image_filename_2 w=120 h=120})"></a>({/if})({if $c_member.image_filename_3})<a href="({t_img_url filename=$c_member.image_filename_3})" target="_blank"><img src="({t_img_url filename=$c_member.image_filename_3 w=120 h=120})"></a>({/if})</p>

<form name="edit_detail" method="POST" action="./">

<table class="userDetailTable">
	<tbody>
	<tr>
		<th>ID</th>
		<td style='border: 1px #CDCDCD solid;text-align: center;'>({$c_member.c_member_id})</td>
	</tr>
	<tr>
		<th>({$WORD_NICKNAME})</th>
		<td style='border: 1px #CDCDCD solid;text-align: center;'><INPUT size="60" type="text" maxlength="60" name="nickname" value="({$c_member.nickname})"></td>
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
		<td style='border: 1px #CDCDCD solid;text-align: center;'><INPUT size="4" type="text" maxlength="4" name="birth_year" value="({if $c_member.birth_year})({$c_member.birth_year})({else})&nbsp;({/if})">年<INPUT size="2" type="text" maxlength="2" name="birth_month" value="({if $c_member.birth_month})({$c_member.birth_month})({else})&nbsp;({/if})">月<INPUT size="2" type="text" maxlength="2" name="birth_day" value="({if $c_member.birth_day})({$c_member.birth_day})({else})&nbsp;({/if})">日</td>
	</tr>
	({foreach from=$c_profile_list item=prof})
	<tr>
		<th>({$prof.caption})</th>
({*		<td style='border: 1px #CDCDCD solid;text-align: center;'>({if $prof.form_type == checkbox})({$c_member.profile[$prof.name].value|@t_implode:", "})({else})({$c_member.profile[$prof.name].value|t_truncate:60|nl2br})({/if})</td>*})
		<td style='border: 1px #CDCDCD solid;text-align: center;'>
({if $prof.form_type == checkbox})
	<INPUT type="checkbox" ({if $c_member.profile[$prof.name].value})checked ({/if})name="({$prof.name})" value="1">
({else})
	<INPUT size="60" type="text" name="({$prof.name})" value="({$c_member.profile[$prof.name].value})">({/if})</td>
	</tr>
	({/foreach})
	<tr>
		<th>PCメールアドレス</th>
		<td style='border: 1px #CDCDCD solid;text-align: center;'><INPUT size="60" type="text" maxlength="60" name="pc_address" value="({if $c_member.secure.pc_address})({$c_member.secure.pc_address|escape:"hexentity"})({else})&nbsp;({/if})"></td>
	</tr>

	<tr>
		<th>登録メールアドレス</th>
		<td style='border: 1px #CDCDCD solid;text-align: center;'><INPUT size="60" type="text" maxlength="60" name="regist_address" value="({if $c_member.secure.regist_address})({$c_member.secure.regist_address})({else})&nbsp;({/if})"></td>
	</tr>
	<tr>
		<th></th>
		<td style='border: 0px solid;text-align: center;'><INPUT type="submit" value="以上の情報を更新する"></td>
	</tr>
	</tbody>
</table>

<input type="hidden" name="m" value="({$module_name})" />
<input type="hidden" name="a" value="do_({$hash_tbl->hash('customer_edit','do')})" />
<input type="hidden" name="sessid" value="({$PHPSESSID})" />
<input type="hidden" name="c_member_id" value="({$c_member.c_member_id})">
</form>

<br>

<table class="userDetailTable">
	<tbody>
	<tr>
		<th></th>
		<td style='border: 0px solid;text-align: center;'>以下の情報は予約受付担当 - 顧客リスト よりも設定できます。<br />設定すると 予約受付担当 - 顧客リスト のページに移動します。</td>
	</tr>

	<tr>
		<th style="background-color:#6666FF;"><b>代理店値引きを設定する</b></th>
		<td style='border: 1px #CDCDCD solid;text-align: center;'>
			<form name="add_agency" method="POST" action="./">
			<input type="hidden" name="m" value="({$module_name})" />
			<input type="hidden" name="a" value="do_({$hash_tbl->hash('add_agency','do')})" />
			<input type="hidden" name="page" value="c_member_detail" />
			<input type="hidden" name="sessid" value="({$PHPSESSID})" />
			<input type="hidden" name="c_member_id" value="({$c_member.c_member_id})">
			値引き率：<input type="text" name="percent" value="({$agency_data.percent})" size=10> ％引き　
			備考：<input type="text" name="info" value="({$agency_data.info})" size=40>
			<input type="submit" value="代理店値引きに登録">
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


<p class="groupLing"><a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('customer_edit')})">顧客情報管理のリストに戻る</a></p>

({$inc_footer|smarty:nodefaults})
