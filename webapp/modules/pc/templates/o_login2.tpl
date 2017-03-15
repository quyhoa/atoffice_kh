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
<td width=10></td>
<td width=610>

({* {{{ formTable *})
<div class="dparts formTable"><div class="parts">
<div class="partsHeading"><h3>PCメールアドレス登録</h3></div>

<div class="partsInfo">
<p>PCメールアドレスの登録をおこないます。<br />パスワードを入力してください。</p>
</div>

({t_form_block m=pc a=do_o_login2_change_mail})
<input type="hidden" name="sid" value="({$sid})" />
<input type="hidden" name="username" value="({$username})" />
<table>
<tr><th>メールアドレス</th>
<td style='border: 1px #CDCDCD solid;'>({$pc_address})<br />
<p class="caution">※ログインアカウントのメールアドレスもこちらに変わります。</p>
</td></tr>
<tr><th>パスワード</th>
<td style='border: 1px #CDCDCD solid;'><input type="password" name="password" class="text" />
</td></tr>
</table>

<div class="operation">
<ul class="moreInfo button">
<li><input type="submit" class="input_submit" value="　登　録　" /></li>
</ul>
</div>
({/t_form_block})

</div></div>
({* }}} *})

</td>
<td width=210></td>
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

