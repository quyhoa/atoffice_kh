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
<div class="partsHeading"><h3>新規登録</h3></div>
<div class="partsInfo">
<p>
メールアドレス({if $smarty.const.OPENPNE_USE_CAPTCHA})と確認キーワード({/if})を入力してください。<br />
入力されたメールアドレス宛に アットビジネスセンター から招待状が送信されます。
</p>
<br>
<p>
<span style="color:#FF0000;">
※一度ゲストで登録されたメールアドレスで会員登録をするには、<br>
予約センター（03-5465-5506）へご連絡下さい。<br>
現状のゲスト情報にて会員IDの発行をいたします。
</span>
</p>
<br>
({t_form_block m=pc a=do_o_public_invite})
<table>
<tr>
<th>メールアドレス</th>
<td style='border: 1px #CDCDCD solid;'>
<input type="text" class="input_text" name="pc_address" value="" size="40" />
</td>
</tr>
<tr>
<th>メールアドレス(確認)</th>
<td style='border: 1px #CDCDCD solid;'>
<input type="text" class="input_text" name="pc_address2" value="" size="40" />
</td>
</tr>
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
