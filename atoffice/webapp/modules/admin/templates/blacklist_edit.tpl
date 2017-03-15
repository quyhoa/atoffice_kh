({$inc_header|smarty:nodefaults})
({ext_include file="inc_subnavi_adminSiteMember.tpl"})
({assign var="page_name" value="ブラックリスト編集"})
({assign var="parent_page_name" value="ブラックリスト管理"})
({capture name=parent_page_url})?m=({$module_name})&amp;a=page_({$hash_tbl->hash('blacklist')})({/capture})

({ext_include file="inc_tree_adminSiteMember.tpl"})
</div>

({*ここまで:navi*})

({if $msg})<p class="actionMsg">({$msg})</p>({/if})
<h2>ブラックリスト編集</h2>
<div class="contents">

<p class="caution">※ブラックリストに追加された顧客のメールアドレスで、部屋の予約・ログインができなくなります。</p>

<form name="add_blacklist" method="POST" action="./">
<input type="hidden" name="m" value="({$module_name})" />
<input type="hidden" name="a" value="do_({$hash_tbl->hash('add_blacklist','do')})" />
<input type="hidden" name="sessid" value="({$PHPSESSID})" />
<input type="hidden" name="c_member_id" value="({$c_member.c_member_id})">

<table class="basicType2">
<tbody>
<tr>
<th>氏名</th>
<td>({$blacklist.nickname})</td>
</tr>
<tr>
<th>メールアドレス</th>
<td>({$blacklist.mail})</td>
</tr>
<tr>
<th>備考</th>
<td><textarea class="basic" name="info" cols="30" rows="3">({$blacklist.info})</textarea></td>
</tr>
</tbody>
</table>

<p class="textBtn"><input type="submit" class="submit" value="　決　定　" /></p>
</form>

({$inc_footer|smarty:nodefaults})
