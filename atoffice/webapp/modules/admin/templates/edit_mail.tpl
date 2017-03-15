({$inc_header|smarty:nodefaults})
({ext_include file="inc_subnavi_adminStatisticalInformation.tpl"})

({assign var="page_name" value="メール文言変更"})
({ext_include file="inc_tree_adminStatisticalInformation.tpl"})
</div>

({*ここまで:navi*})

({*権限チェック*})
({if $atoffice_auth_type==4})

<h2>メール文言変更</h2>
<div class="contents">
<p class="caution" id="c01">※Smartyテンプレート形式で記述します。</p>
<p class="caution" id="c02">誤った形式で記述すると、メールを送信することができなくなってしまいます。<br />その場合は、「デフォルトに戻す」から元に戻してください。</p>

<table class="contents" cellpadding="0" cellspacing="0" border="0">
<tr>
<td class="menu">
<dl>
<dt><strong class="item">システムメール設定</strong></dt>
<dd>
<ul>
<li><a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('edit_mail')})&amp;target=inc_signature">署名</a></li>
({foreach from=$pc key=key item=item})
<li><a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('edit_mail')})&amp;target=({$key})">({$item})</a></li>
({/foreach})
</ul>
</dd>

<dt><strong class="item">会議室予約メール設定</strong></dt>
<dd>
<ul>
({foreach from=$atoffice key=key item=item})
<li><a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('edit_mail')})&amp;target=({$key})">({$item})</a></li>
({/foreach})
</ul>
</dd>

</dl>
</td>
<td class="detail">
<h3>({if $requests.target == "inc_signature"})
署名
({elseif $requests.target == "m_atoffice_syounin2"})
予約承認メール内追加説明文
（
({if $hall_name})
	({$hall_name})
({else})
	会場未選択
({/if})
）
({elseif $pc[$requests.target]})
({$pc[$requests.target]})
({elseif $ktai[$requests.target]})
({$ktai[$requests.target]})
({elseif $admin[$requests.target]})
({$admin[$requests.target]})
({/if})</h3>

({if $msg})<p class="actionMsg">({$msg})</p>({/if})

({if $requests.target == "m_atoffice_syounin2"})

<form action="./" method="post">
<input type="hidden" name="m" value="({$module_name})" />
<input type="hidden" name="a" value="page_({$hash_tbl->hash('edit_mail','page')})" />
<input type="hidden" name="target" value="m_atoffice_syounin2">
<p id="default">
会場選択
<select name="hall_id" valign=top>
({foreach from=$hall_list item=item})
<option value="({$item.hall_id})" ({if $item.hall_id == $hall_id})selected({/if})>({$item.hall_name})
({/foreach})
</select>

<input type="submit" value="選択"></p>


</form>
({else})
<p id="default"><a href="./?m=({$module_name})&amp;a=do_({$hash_tbl->hash('delete_mail','do')})&amp;target=({$requests.target})&amp;sessid=({$PHPSESSID})">デフォルトに戻す</a></p>
({/if})


<form action="./" method="post">
<input type="hidden" name="m" value="({$module_name})" />
<input type="hidden" name="a" value="do_({$hash_tbl->hash('update_mail','do')})" />
<input type="hidden" name="sessid" value="({$PHPSESSID})" />
<input type="hidden" name="target" value="({$requests.target})" />

({if $requests.target == "m_atoffice_syounin2"})
<input type="hidden" name="hall_id" value=({$hall_id})>
({/if})

<dl>
({if $requests.target != "inc_signature" and $requests.target != "m_atoffice_syounin2"})
<dt><strong class="item">件名</strong></dt>
<dd><input class="basic" type="text" name="subject" value="({$subject})" size="72" /></dd>
({/if})

({if $requests.target != "m_atoffice_syounin2" or $hall_id})
<dt><strong class="item">本文</strong></dt>
<dd><textarea name="body" cols="({$cols|default:72})" rows="({$rows|default:30})">({$body})</textarea></dd>
</dl>
<p class="textBtn"><input type="submit" value="変更する"></p>
({/if})
</form>
</td>
</tr>
</table>

({else})
<br>
<center>
<span style="font-size: 16px; color: #FF0033;"><b>アクセス権がありません。</b></span>
</center>
({/if})
<div>
({$inc_footer|smarty:nodefaults})

