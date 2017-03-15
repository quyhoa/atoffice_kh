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
<li>
<a href="({t_url m=pc a=do_inc_page_header_logout})&amp;sessid=({$PHPSESSID})">
ログアウト
</a></li>
<li><a href="./?page=search">　</a></li>
</ul>
</div><!-- menu end -->


<div id="LayoutC">


<table id="table-01">
<tr>
<td width=20></td>
<td width=610>

({* {{{ formTable *})
<div class="dparts formTable"><div class="parts">
<div class="partsHeading"><h3>登録情報の確認</h3><p>(<strong>※</strong>の項目は必須です)</p></div>
<table>

({capture name="nick"})
<tr>
<th>({$WORD_NICKNAME}) <strong>※</strong></th>
<td style='border: 1px #CDCDCD solid;'>({$prof.nickname})</td>
</tr>
({/capture})
({capture name="birth"})
({**************
<tr>
<th>生まれた年 <strong>※</strong></th>
<td style='border: 1px #CDCDCD solid;'>({$prof.birth_year})年
</td>
</tr>
<tr>
<th>誕生日 <strong>※</strong></th>
<td style='border: 1px #CDCDCD solid;'>({$prof.birth_month})月({$prof.birth_day})日
</td>
</tr>
******************})
({/capture})
({foreach from=$profile_list item=profile})
({strip})

({if !$_cnt_nick && $profile.sort_order >= $smarty.const.SORT_ORDER_NICK
  && !$_cnt_birth && $profile.sort_order >= $smarty.const.SORT_ORDER_BIRTH})
({counter assign="_cnt_nick"})
({counter assign="_cnt_birth"})
({if $smarty.const.SORT_ORDER_NICK > $smarty.const.SORT_ORDER_BIRTH})
({$smarty.capture.birth|smarty:nodefaults})
({$smarty.capture.nick|smarty:nodefaults})
({else})
({$smarty.capture.nick|smarty:nodefaults})
({$smarty.capture.birth|smarty:nodefaults})
({/if})
({/if})

({if !$_cnt_nick && $profile.sort_order >= $smarty.const.SORT_ORDER_NICK})
({counter assign="_cnt_nick"})
({$smarty.capture.nick|smarty:nodefaults})
({/if})

({if !$_cnt_birth && $profile.sort_order >= $smarty.const.SORT_ORDER_BIRTH})
({counter assign="_cnt_birth"})
({$smarty.capture.birth|smarty:nodefaults})
({/if})

({/strip})
({if $profile.disp_config})
<tr>
<th>({$profile.caption})({if $profile.is_required}) <strong>※</strong>({/if})</th>
<td style='border: 1px #CDCDCD solid;'>
({if $prof.profile[$profile.name].value})

({if $profile.form_type == 'textarea'})
    ({$prof.profile[$profile.name].value|nl2br|t_url2cmd:'profile':$u|t_cmd:'profile'})
({elseif $profile.form_type == 'checkbox'})
    ({$prof.profile[$profile.name].value|@t_implode:", "})
({else})
    ({$prof.profile[$profile.name].value})
({/if})



({/if})
</td>
</tr>
({/if})
({/foreach})

({if !$_cnt_nick && !$_cnt_birth})
({if $smarty.const.SORT_ORDER_NICK > $smarty.const.SORT_ORDER_BIRTH})
({$smarty.capture.birth|smarty:nodefaults})
({$smarty.capture.nick|smarty:nodefaults})
({else})
({$smarty.capture.nick|smarty:nodefaults})
({$smarty.capture.birth|smarty:nodefaults})
({/if})
({else})
({if !$_cnt_nick})({$smarty.capture.nick|smarty:nodefaults})({/if})
({if !$_cnt_birth})({$smarty.capture.birth|smarty:nodefaults})({/if})
({/if})
</table>
<div class="operation">
<ul class="moreInfo button">
<li>
({t_form_block m=pc a=do_h_config_prof})
<input type="hidden" name="mode" value="register" />
<input type="hidden" name="is_search_result" value="({$prof.is_search_result})" />
<input type="hidden" name="nickname" value="({$prof.nickname})" />
<input type="hidden" name="birth_year" value="({$prof.birth_year})" />
<input type="hidden" name="birth_month" value="({$prof.birth_month})" />
<input type="hidden" name="birth_day" value="({$prof.birth_day})" />
<input type="hidden" name="public_flag_birth_year" value="({$prof.public_flag_birth_year})" />
<input type="hidden" name="public_flag_birth_month_day" value="({$prof.public_flag_birth_month_day})" />
({strip})
({foreach from=$prof.profile key=key item=item})
({if is_array($item.c_profile_option_id)})
    ({foreach from=$item.c_profile_option_id item=i})
    ({if $i})
    <input type="hidden" name="profile[({$key})][]" value="({$i})" />
    ({/if})
    ({/foreach})
({elseif $item.c_profile_option_id})
    <input type="hidden" name="profile[({$key})]" value="({$item.c_profile_option_id})" />
({else})
    <input type="hidden" name="profile[({$key})]" value="({$item.value})" />
({/if})
<input type="hidden" name="public_flag[({$key})]" value="({$item.public_flag})" />
({/foreach})
({/strip})
<input type="submit" class="input_submit" value="　確　定　" />
({/t_form_block})
</li>
<li>
({t_form_block m=pc a=do_h_config_prof})
<input type="hidden" name="mode" value="input" />
<input type="hidden" name="is_search_result" value="({$prof.is_search_result})" />
<input type="hidden" name="nickname" value="({$prof.nickname})" />
<input type="hidden" name="birth_year" value="({$prof.birth_year})" />
<input type="hidden" name="birth_month" value="({$prof.birth_month})" />
<input type="hidden" name="birth_day" value="({$prof.birth_day})" />
<input type="hidden" name="public_flag_birth_year" value="({$prof.public_flag_birth_year})" />
<input type="hidden" name="public_flag_birth_month_day" value="({$prof.public_flag_birth_month_day})" />
({strip})
({foreach from=$prof.profile key=key item=item})
({if is_array($item.c_profile_option_id)})
    ({foreach from=$item.c_profile_option_id item=i})
    ({if $i})
    <input type="hidden" name="profile[({$key})][]" value="({$i})" />
    ({/if})
    ({/foreach})
({elseif $item.c_profile_option_id})
    <input type="hidden" name="profile[({$key})]" value="({$item.c_profile_option_id})" />
({else})
    <input type="hidden" name="profile[({$key})]" value="({$item.value})" />
({/if})
<input type="hidden" name="public_flag[({$key})]" value="({$item.public_flag})" />
({/foreach})
({/strip})
<input type="submit" class="input_submit" value="　修　正　" />
({/t_form_block})
</li>
</ul>
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

