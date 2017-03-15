({$inc_header|smarty:nodefaults})
({ext_include file="inc_subnavi_adminSiteMember.tpl"})
({assign var="page_name" value="代理店値引き編集"})
({assign var="parent_page_name" value="代理店値引き管理"})
({capture name=parent_page_url})?m=({$module_name})&amp;a=page_({$hash_tbl->hash('blacklist')})({/capture})

({ext_include file="inc_tree_adminSiteMember.tpl"})
</div>

({*ここまで:navi*})

({if $msg})<p class="actionMsg">({$msg})</p>({/if})
<h2>代理店値引き編集</h2>
<div class="contents">

<p class="caution">※部屋の値段から割引されます。（ログイン必須）。</p>

<form name="add_blacklist" method="POST" action="./">
<input type="hidden" name="m" value="({$module_name})" />
<input type="hidden" name="a" value="do_({$hash_tbl->hash('add_agency','do')})" />
<input type="hidden" name="page" value="agencylist_edit" />
<input type="hidden" name="sessid" value="({$PHPSESSID})" />
<input type="hidden" name="c_member_id" value="({$agencylist.c_member_id})">

<table class="basicType2">
<tbody>
<tr>
<th>氏名</th>
<td>({$agencylist.nickname})</td>
</tr>
<tr>
<th>値引き率</th>
<td><input type="text" name="percent" value="({$agencylist.percent})" size=10> ％引き</td>
</tr>
<tr>
<th>備考</th>
<td><textarea class="basic" name="info" cols="30" rows="3">({$agencylist.info})</textarea></td>
</tr>
</tbody>
</table>

<p class="textBtn"><input type="submit" class="submit" value="　決　定　" /></p>
</form>

({$inc_footer|smarty:nodefaults})
