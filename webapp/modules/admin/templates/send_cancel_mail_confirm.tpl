({$inc_header|smarty:nodefaults})
({ext_include file="inc_subnavi_adminSiteMember.tpl"})
({assign var="page_name" value="招待メール送信"})
({ext_include file="inc_tree_adminSiteMember.tpl"})
</div>

({*ここまで:navi*})
({*権限チェック*})
({if $atoffice_auth_type==2 or $atoffice_auth_type==4})

<h2>キャンセルメール送信確認</h2>
<div class="contents">



<p class="info">【キャンセルメール】</p>

<form action="./" method="post">
<input type="hidden" name="m" value="({$module_name})" />
<input type="hidden" name="a" value="do_({$hash_tbl->hash('send_cancel_mail','do')})" />
<input type="hidden" name="sessid" value="({$PHPSESSID})" />
<input type="hidden" name="resderveid" value="({$reserve_list.reserve_id})" />
<input type="hidden" name="page" value="({$page})" />
<input type="hidden" name="hall_list" value="({$hall_list})" />
<input type="hidden" name="u" value="({$c_member_id})" />
<input type="hidden" name="pay_flag" value="({$pay_flag})" />
<input type="hidden" name="index" value="({$index})" />
<input type="hidden" name="mails" value="({$mails})" />
<input type="hidden" name="subject" value="({$subject})" />
<input type="hidden" name="message" value="({$message})" />
<input type="hidden" name="reserveid" value="({$reserve_id})" />
<dl>
<dt class="mails"><strong>送信先</strong></dt>
({assign var="mail" value=";"|explode:$mails})
<dd class="mails">
({foreach from=$mail item=addr})
({$addr|trim})<br />
({/foreach})</dd>

<dt class="subject"><strong>表題</strong></dt>
<dd class="subject">({$subject})</dd>
<dt class="message"><strong>本文</strong></dt>
<dd class="message">({$message|nl2br})</dd>
</dl>
<table><tbody><tr><td>
<p class="textBtn">
<input type="submit" name="cancel2" value="内容を修正する">
</p>
</td><td width="32"></td><td>
<p class="textBtn">
<input type="submit" name="submit2" value="この内容で送信">
</p>
</td></tbody></table>
</form>

<br class="clear" />
({else})
<br>
<center>
<span style="font-size: 16px; color: #FF0033;"><b>アクセス権がありません。</b></span>
</center>
({/if})

({$inc_footer|smarty:nodefaults})
