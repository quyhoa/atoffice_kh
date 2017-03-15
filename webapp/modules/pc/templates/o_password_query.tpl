<link href="./atoffice/css/style.css" rel="stylesheet" type="text/css" />

<style type="text/css">
	<!--
table#table-01 {
    width: 880px;
    border: 0px;
    border-collapse: collapse;
    border-spacing: 0;
}

table#table-01 td {
    border: 0px;
    border-width: 0px;
    padding-top: 10px;
    padding-left: 10px;
    vertical-align:top;
    text-align:left;
}

-->
</style>

<div id="container">
<div id="header">
<h1></h1>
</div><!--heaer_end-->

<div id="menu">
<ul>
<li class="home"><a href="http://abc-kaigishitsu.com/">他の会場を探す</a></li>
<li><a href="./?page=reserved_info">会員用予約確認</a></li>
<li><a href="./?page=search">　</a></li>
</ul>

</div><!-- menu end -->

<div id="LayoutC">

<table id="table-01">
<tr>
<td width=20></td>
<td width=610>

({if !$no_use_alert && ($msg || $msg1 || $msg2 || $msg3 || $err_msg)})
({* {{{ alertBox *})
<div class="dparts alertBox"><div class="parts">
<table><tr>
<th><img src="({t_img_url_skin filename=icon_alert_l})" alt="警告" /></th>
<td style='text-align:center;vertical-align:middle;'>
({if $msg})({$msg})<br />({/if})
({if $msg1})({$msg1})<br />({/if})
({if $msg2})({$msg2})<br />({/if})
({if $msg3})({$msg3})<br />({/if})
({foreach from=$err_msg item=item})
({$item})<br />
({/foreach})
</td>
</tr></table>
</div></div>
({/if})

({* {{{ formTable *})
<div class="dparts formTable"><div class="parts">
<div class="partsHeading"><h3>パスワード再設定</h3></div>

<div class="partsInfo">
({if $smarty.const.IS_PASSWORD_QUERY_ANSWER})
<p>登録したメールアドレスと、秘密の質問・答えを入力してください。<br />パスワードを再設定するためのURLが登録メールアドレス宛に送信されます。</p>
({else})
<p>登録したメールアドレスを入力してください。<br />パスワードを再設定するためのURLが登録メールアドレス宛に送信されます。</p>
({/if})
</div>

({t_form_block m=pc a=do_o_password_query})
<table>
<tr><th>メールアドレス</th><td style='border: 1px #CDCDCD solid;'><input type="text" class="text" name="pc_address" value="" /></td></tr>
({if $smarty.const.IS_PASSWORD_QUERY_ANSWER})
<tr><th>秘密の質問</th><td style='border: 1px #CDCDCD solid;'>
<select name="c_password_query_id">
<option value="" selected="selected">選択してください</option>
({foreach from=$c_password_query_list key=key item=item})
<option value="({$key})">({$item})</option>
({/foreach})
</select>
</td></tr>
<tr><th>秘密の答え</th><td style='border: 1px #CDCDCD solid;'><input type="text" class="text" name="c_password_query_answer" value="" /></td></tr>
({/if})
({if $smarty.const.OPENPNE_USE_CAPTCHA})
<tr>
<th>確認キーワード</th>
<td style='border: 1px #CDCDCD solid;'>
<p><img src="./cap.php?rand=({math equation="rand(0,99999999)"})" alt="確認キーワード" /></p>
<p>※上に表示されているキーワードをご記入下さい。</p>
<input type="text" class="input_text" name="captcha" value="" size="30" />
</td>
</tr>
({/if})
</table>

<div class="operation">
<ul class="moreInfo button">
<li><input type="submit" class="input_submit" value="　送　信　" /></li>
</ul>
</div>
({/t_form_block})

</div></div>
({* }}} *})

</td><td width=5></td><td>

</td>
</tr>
</table>

</div><!-- LayoutC -->

</div>
<script type="text/javascript" src="./atoffice/js/ajax.js"></script>

<script type="text/javascript">
function PerformInputLink2(){
	LoadHTML('footer', 'sub/footer.html');
}
</script>
<div id="LoadingBar">
	<img border="0" src="./atoffice/img/loading.gif"/>
</div>
<div id="footer">
	<script type="text/javascript">PerformInputLink2();</script>
</div>
