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

({* {{{ infoButtonBox *})
<div class="dparts infoButtonBox"><div class="parts">
<div class="partsHeading"><h3>パスワードを忘れた方</h3></div>
<div class="block">
<p>以下のボタンをクリックし、パスワードの再設定手続きをおこなってください。</p>

({t_form_block _method=get m=pc a=page_o_password_query})
<ul class="moreInfo button">
<li><input type="submit" class="input_submit" value="パスワード再設定ページへ" /></li>
</ul>
({/t_form_block})
</div>
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
