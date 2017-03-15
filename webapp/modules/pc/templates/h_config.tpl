<div id="LayoutC">

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

<link href="./atoffice/css/style.css" rel="stylesheet" type="text/css" />
<link href="./atoffice/css/highslide.css" rel="stylesheet" type="text/css" />


<div id="container">
<div id="header">
<h1></h1>
</div><!--heaer_end-->

<div id="menu">
<ul>
<li class="home"><a href="http://abc-kaigishitsu.com/">他の会場を探す</a></li>
<li><a href="./?page=reserved_info">会員用予約確認</a></li>
<li>
<a href="({t_url m=pc a=do_inc_page_header_logout})&amp;sessid=({$PHPSESSID})">
ログアウト
</a></li>
<li><a href="./?page=search">　</a></li>
</ul>

</div><!-- menu end -->

<table id="table-01">
<tr>
<td width=20></td>
<td width=610>

({if !$no_use_alert && ($msg || $msg1 || $msg2 || $msg3 || $err_msg)})
({* {{{ alertBox *})
<div class="dparts alertBox"><div class="parts">
<table><tr>
<th><img src="({t_img_url_skin filename=icon_alert_l})" alt="警告" /></th>
<td style='text-align:left;vertical-align:middle;'>
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
<div class="partsHeading"><h3>PCメールアドレス変更</h3></div>
({t_form_block m=pc a=do_h_config_1})
<table><tr>
<th>メールアドレス</th>
<td style='border: 1px #CDCDCD solid;'>
<input type="text" class="input_text" name="pc_address" value="" size="40" />

</td>
</tr><tr>
<th>メールアドレス確認</th>
<td style='border: 1px #CDCDCD solid;'>
<input type="text" class="input_text" name="pc_address2" value="" size="40" />
</td>
</tr></table>
<div class="operation">
<ul class="moreInfo button">
<li><input type="submit" class="input_submit" value="メールアドレス変更" /></li>
</ul>
</div>
({/t_form_block})
</div></div>
({* }}} *})

({if $smarty.const.OPENPNE_AUTH_MODE != 'slavepne'})
({* {{{ formTable *})
<div class="dparts formTable"><div class="parts">
<div class="partsHeading"><h3>パスワード変更</h3></div>
({t_form_block m=pc a=do_h_config_2})
<table><tr>
<th>現在のパスワード</th>
<td style='border: 1px #CDCDCD solid;'>
<input type="password" class="input_password" name="old_password" value="" size="40" />
</td>
</tr><tr>
<th>新しいパスワード</th>
<td style='border: 1px #CDCDCD solid;'>
<input type="password" class="input_password" name="new_password" value="" size="40" />
<p class="caution">※パスワードは6～12文字の半角英数で入力してください。</p>
</td>
</tr><tr>
<th>新しいパスワード確認</th>
<td style='border: 1px #CDCDCD solid;'>
<input type="password" class="input_password" name="new_password2" value="" size="40" />
</td>
</tr></table>
<div class="operation">
<ul class="moreInfo button">
<li>
<input type="submit" class="input_submit" value="パスワード変更" /></li>
</ul>
</div>
({/t_form_block})
</div></div>

<div class="dparts formTable"><div class="parts">
<div class="partsHeading"><h3>秘密の質問変更</h3></div>
({t_form_block m=pc a=do_h_config_3})
<table>
<tr>
<th>秘密の質問</th>
<td style='border: 1px #CDCDCD solid;'>
<select name="c_password_query_id">
({foreach from=$password_query_list key=key item=item})
<option value="({$key})"({if $c_member.c_password_query_id==$key}) selected="selected"({/if})>({$item})</option>
({/foreach})
</select>
</td>
</tr>
<tr>
<th>秘密の質問の答え</th>
<td style='border: 1px #CDCDCD solid;'>
<input type="text" class="input_text" name="c_password_query_answer" value="" size="30" />
</td>
</tr>
</table>
<div class="operation">
<ul class="moreInfo button">
<li><input type="submit" class="input_submit" value="設定変更" /></li>
</ul>
</div>
({/t_form_block})
</div></div>


({* }}} *})
({/if})


</td><td width=5></td><td>
<div id="side">
<ul class="category">
<li><a href="./?m=pc&a=page_h_config_prof">アカウント情報変更</a></li>
</ul>
</div>
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




