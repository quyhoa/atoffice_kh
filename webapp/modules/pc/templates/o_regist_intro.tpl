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

({* {{{ descriptionBox *})
<div class="dparts descriptionBox"><div class="parts">
<div class="partsHeading"><h3>会員登録</h3></div>
<div class="block">
<p>サービスを利用するには、以下の規約を遵守してください。<br />利用者ご本人により会員規約に同意のうえ、登録手続きを進めてください。</p>
</div>
</div></div>
({* }}} *})

({* {{{ descriptionBox *})
<div class="dparts descriptionBox"><div class="parts">
<div class="partsHeading"><h3>利用規約</h3></div>
<div class="block">
<p>
({if $c_siteadmin != ""})
({$c_siteadmin|t_url2a|nl2br})
({else})
<a href="http://abc-kaigishitsu.com/ikebukuro/kiyaku.html" target="_blank">利用規約はこちらをクリック</a>
({/if})
</p>
</div>
</div></div>
({* }}} *})

</td><td width=5></td><td>

</td>
</tr>
</table>


({* {{{ buttonLine *})
<div class="parts buttonLine">
({t_form_block m=pc a=page_o_regist_prof})
<input type="hidden" name="mode" value="input" />
<input type="hidden" name="sid" value="({$sid})" />
<input type="submit" class="input_submit" value="同意して登録手続きへ" />
({/t_form_block})
</div>
({* }}} *})


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


