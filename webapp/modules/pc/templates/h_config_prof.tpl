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
<div class="partsHeading"><div class="text"><h3>登録情報の変更</h3><p>(<strong>※</strong>の項目は必須です)</p></div>({if $SSL_SELECT_URL})<p class="link"><a href="({$SSL_SELECT_URL})">({if $HTTPS})標準(http)({else})SSL(https)({/if})はこちら</a></p>({/if})</div>

({t_form_block m=pc a=do_h_config_prof})

<table>

<input type="hidden" id="is_search_result_1" class="input_radio" name="is_search_result" value="0">

({capture name="nick"})
<tr>
<th>({$WORD_NICKNAME}) <strong>※</strong></th>
<td style='border: 1px #CDCDCD solid;'><input type="text" class="input_text" name="nickname" value="({$c_member.nickname})" size="30" /></td>
</tr>
({/capture})
({capture name="birth"})
<input type="hidden" name="birth_year" value="2000">
<input type="hidden" name="birth_month" value="1">
<input type="hidden" name="birth_day" value="1">
<input type="hidden" name="public_flag_birth_year" value="private">
<input type="hidden" name="public_flag_birth_month_day" value="private">
({**************
<tr>
<th>生まれた年 <strong>※</strong></th>
<td style='border: 1px #CDCDCD solid;'>
<table><tr><td>
<input type="text" class="input_text" name="birth_year" value="({if $c_member.birth_year})({$c_member.birth_year})({/if})" size="10" maxlength="4" /> 年
</td><td class="publicSelector">

</td></tr></table>
</td>
</tr>
<tr>
<th>誕生日 <strong>※</strong></th>
<td style='border: 1px #CDCDCD solid;'>
<table><tr><td>
<select name="birth_month">
<option value="0">--</option>
({foreach from=$month item=item})
<option value="({$item})"({if $c_member.birth_month==$item}) selected="selected"({/if})>({$item})</option>
({/foreach})
</select> 月
<select name="birth_day">
<option value="0">--</option>
({foreach from=$day item=item})
<option value="({$item})"({if $c_member.birth_day==$item}) selected="selected"({/if})>({$item})</option>
({/foreach})
</select> 日
</td><td class="publicSelector">

</td></tr></table>
</td>
</tr>
*******************})
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
({if $profile.public_flag_edit})<table><tr><td>({/if})

({strip})
({if $profile.form_type == 'text'})
	<input type="text" class="input_text" name="profile[({$profile.name})]" value="({$c_member.profile[$profile.name].value})" size="30" />
({elseif $profile.form_type == 'textlong'})
	<input type="text" class="input_text input_text_long" name="profile[({$profile.name})]" value="({$c_member.profile[$profile.name].value})" size="60" />
({elseif $profile.form_type == 'textarea'})
	<textarea name="profile[({$profile.name})]" rows="6" cols="50">({$c_member.profile[$profile.name].value})</textarea>
({elseif $profile.form_type == 'select'})
	<select name="profile[({$profile.name})]">
	<option value="">選択してください</option>
	({foreach from=$profile.options item=item})
		<option value="({$item.c_profile_option_id})"({if $c_member.profile[$profile.name].value == $item.value}) selected="selected"({/if})>({$item.value|default:"--"})</option>
	({/foreach})
	</select>
({elseif $profile.form_type == 'radio'})
	<div class="checkList">
	({foreach item=item from=$profile.options})
		({counter name=$profile.name assign=_cnt})
		({if $_cnt % 3 == 1})<ul>({/if})
			<li><div class="item"><input type="radio" class="input_radio" name="profile[({$profile.name})]" id="profile-({$profile.name})-({$item.c_profile_option_id})" value="({$item.c_profile_option_id})"({if $c_member.profile[$profile.name].value == $item.value}) checked="checked"({/if}) /><label for="profile-({$profile.name})-({$item.c_profile_option_id})">({$item.value|default:"--"})</label></div></li>
		({if $_cnt % 3 == 0})</ul>({/if})
	({/foreach})
	({if $_cnt % 3 != 0})</ul>({/if})
	</div>
({elseif $profile.form_type == 'checkbox'})
	<div class="checkList">
	({foreach item=item from=$profile.options name=check})
		({counter name=$profile.name assign=_cnt})
		({if $_cnt % 3 == 1})<ul>({/if})
			<li><div class="item"><input type="checkbox" class="input_checkbox" name="profile[({$profile.name})][]" id="profile-({$profile.name})-({$item.c_profile_option_id})" value="({$item.c_profile_option_id})"({if $c_member.profile[$profile.name].value && in_array($item.value|smarty:nodefaults, $c_member.profile[$profile.name].value)}) checked="checked"({/if}) /><label for="profile-({$profile.name})-({$item.c_profile_option_id})">({$item.value|default:"--"})</label></div></li>
		({if $_cnt % 3 == 0})</ul>({/if})
	({/foreach})
	({if $_cnt % 3 != 0})</ul>({/if})
	</div>
({/if})
({/strip})

({if $profile.info})<p class="caution">({$profile.info})</p>({/if})

({if $profile.public_flag_edit})
</td><td class="publicSelector">
({if $c_member.profile[$profile.name].public_flag})
({assign var=pflag value=$c_member.profile[$profile.name].public_flag})
({else})
({assign var=pflag value=$profile.public_flag_default})
({/if})
<select name="public_flag[({$profile.name})]">
({foreach from=$public_flags key=key item=item})
<option value="({$key})"({if $pflag==$key}) selected="selected"({/if})>({$item})</option>
({/foreach})
</select>
</td></tr></table>
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
<li><input type="submit" class="input_submit" value="確認画面" /></li>
</ul>
</div>
({/t_form_block})
</div></div>
({* }}} *})


</td><td width=5></td><td>
<div id="side">
<ul class="category">
<li><a href="./?m=pc&a=page_h_config">メールアドレス・パスワード変更</a></li>
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


