({$inc_header|smarty:nodefaults})
({ext_include file="inc_subnavi_adminSiteMember.tpl"})
({assign var="page_name" value="ブラックリスト削除確認"})
({assign var="parent_page_name" value="ブラックリスト管理"})
({capture name=parent_page_url})?m=({$module_name})&amp;a=page_({$hash_tbl->hash('blacklist')})({/capture})
({ext_include file="inc_tree_adminSiteMember.tpl"})
</div>

({*ここまで:navi*})

({if $msg})<p class="actionMsg">({$msg})</p>({/if})
<h2>ブラックリスト削除確認</h2>
<div class="contents">

<p>以下の内容を削除します。よろしいですか？</p>
<p class="caution">※ブラックリストから削除されたメンバーは、部屋の予約とゲストでなければログインが可能となります。</p>

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
<td width="250">({$blacklist.info|nl2br})</td>
</tr>
</tbody>
</table>

<form action="./" method="post">
<input type="hidden" name="m" value="({$module_name})" />
<input type="hidden" name="a" value="do_({$hash_tbl->hash('delete_c_blacklist','do')})" />
<input type="hidden" name="sessid" value="({$PHPSESSID})" />
<input type="hidden" name="c_member_id" value="({$blacklist.c_member_id})" />
<input type="hidden" name="target_c_blacklist_id" value="({$blacklist.c_blacklist_id})" />
<p class="textBtn"><input type="submit" class="submit" value="　は　い　" /></p>
</form>

<form action="./" method="post">
<input type="hidden" name="m" value="({$module_name})" />
<input type="hidden" name="a" value="page_({$hash_tbl->hash('blacklist')})" />
<p class="textBtn"><input type="submit" class="submit" value="　いいえ　" /></p>
</form>

({$inc_footer|smarty:nodefaults})
