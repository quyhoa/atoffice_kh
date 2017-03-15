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
<p>新しいパスワードを入力してください</p>
</div>

({t_form_block m=pc a=do_o_password_reset})
<table>
<th>パスワード</th>
<td style='border: 1px #CDCDCD solid;'>
<input type="hidden" name="id" value="({$id})">
<input type="hidden" name="session" value="({$session})">
<input type="password" class="input_password" name="new_password" value="" size="20" />
<p class="caution">※パスワードは6～12文字の半角英数で入力してください。</p>
</td>
</tr><tr>
<th>パスワード確認</th>
<td style='border: 1px #CDCDCD solid;'>
<input type="password" class="input_password" name="new_password2" value="" size="20" />
</td>
</tr>
</table>

<div class="operation">
<ul class="moreInfo button">
<li><input type="submit" class="input_submit" value="　変　更　" /></li>
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

