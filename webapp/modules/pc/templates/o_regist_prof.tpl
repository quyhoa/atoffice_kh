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
<div class="partsHeading"><h3>アカウント情報入力</h3><p>(<strong>※</strong>の項目は必須です)</p></div>
({t_form_block m=pc a=do_o_regist_prof})
<input type="hidden" name="sid" value="({$sid})" />

<input type="hidden" name="birth_year" value="2000" />
<input type="hidden" name="birth_month" value="1" />
<input type="hidden" name="birth_day" value="1" />
<input type="hidden" name="public_flag_birth_year" value="private">
<input type="hidden" name="public_flag_birth_month_day" value="private">

<table>
({capture name="nick"})
<tr>
<th>({$WORD_NICKNAME}) <strong>※</strong></th>
<td style='border: 1px #CDCDCD solid;'><input type="text" class="input_text" name="nickname" value="({$profs.nickname})" size="30" /></td>
</tr>
({/capture})
({capture name="birth"})
({****************
<tr>
<th>生まれた年 <strong>※</strong></th>
<td style='border: 1px #CDCDCD solid;'>
<table><tr><td>
<input type="text" class="input_text" name="birth_year" value="({$profs.birth_year})" size="10" maxlength="4" /> 年
</td><td class="publicSelector">
<input type="hidden" name="public_flag_birth_year" value="private">

<select name="public_flag_birth_year">
({html_options options=$public_flags selected=$profs.public_flag_birth_year})
</select>

</td></tr></table>
</td>
</tr>
<tr>
<th>誕生日 <strong>※</strong></th>
<td style='border: 1px #CDCDCD solid;'>
<table><tr><td>
<select name="birth_month">
<option value="0">--</option>
({foreach from=$month_list item=item})
<option value="({$item})"({if $profs.birth_month==$item}) selected="selected"({/if})>({$item})</option>
({/foreach})
</select> 月
<select name="birth_day">
<option value="0">--</option>
({foreach from=$day_list item=item})
<option value="({$item})"({if $profs.birth_day==$item}) selected="selected"({/if})>({$item})</option>
({/foreach})
</select> 日
</td>
<td class="publicSelector">
<input type="hidden" name="public_flag_birth_month_day" value="private">

<select name="public_flag_birth_month_day">
({html_options options=$public_flags selected=$profs.public_flag_birth_month_day})
</select>

</td></tr></table>
</td>

***********************})

</tr>
({/capture})
({foreach from=$c_profile_list item=profile})
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
({if $profile.disp_regist})
<tr>
<th>({$profile.caption})({if $profile.is_required}) <strong>※</strong>({/if})</th>
<td style='border: 1px #CDCDCD solid;'>
({if $profile.public_flag_edit})<table><tr><td>({/if})

({strip})
({if $profile.form_type == 'text'})
	<input type="text" class="input_text" name="profile[({$profile.name})]" value="({$profs.profile[$profile.name]})" size="30" />
({elseif $profile.form_type == 'textlong'})
	<input type="text" class="input_text input_text_long" name="profile[({$profile.name})]" value="({$profs.profile[$profile.name]})" size="60" />
({elseif $profile.form_type == 'textarea'})
	<textarea name="profile[({$profile.name})]" rows="6" cols="50">({$profs.profile[$profile.name]})</textarea>
({elseif $profile.form_type == 'select'})
	<select name="profile[({$profile.name})]">
	<option value="">選択してください</option>
	({foreach from=$profile.options item=item})
		<option value="({$item.c_profile_option_id})"({if $profs.profile[$profile.name] == $item.c_profile_option_id}) selected="selected"({/if})>({$item.value|default:"--"})</option>
	({/foreach})
	</select>
({elseif $profile.form_type == 'radio'})
	<div class="checkList">
	({foreach item=item from=$profile.options})
		({counter name=$profile.name assign=_cnt})
		({if $_cnt % 3 == 1})<ul>({/if})
			<li><div class="item"><input type="radio" class="input_radio" name="profile[({$profile.name})]" id="profile-({$profile.name})-({$item.c_profile_option_id})" value="({$item.c_profile_option_id})"({if $profs.profile[$profile.name] == $item.c_profile_option_id}) checked="checked"({/if}) /><label for="profile-({$profile.name})-({$item.c_profile_option_id})">({$item.value|default:"--"})</label></div></li>
		({if $_cnt % 3 == 0})</ul>({/if})
	({/foreach})
	({if $_cnt % 3 != 0})</ul>({/if})
	</div>
({elseif $profile.form_type == 'checkbox'})
	<div class="checkList">
	({foreach item=item from=$profile.options name=check})
		({counter name=$profile.name assign=_cnt})
		({if $_cnt % 3 == 1})<ul>({/if})
			<li><div class="item"><input type="checkbox" class="input_checkbox" name="profile[({$profile.name})][]" id="profile-({$profile.name})-({$item.c_profile_option_id})" value="({$item.c_profile_option_id})"({if $profs.profile[$profile.name] && in_array($item.c_profile_option_id|smarty:nodefaults, $profs.profile[$profile.name])}) checked="checked"({/if}) /><label for="profile-({$profile.name})-({$item.c_profile_option_id})">({$item.value|default:"--"})</label></div></li>
		({if $_cnt % 3 == 0})</ul>({/if})
	({/foreach})
	({if $_cnt % 3 != 0})</ul>({/if})
	</div>
({/if})
({/strip})

({if $profile.info})<p class="caution">({$profile.info})</p>({/if})

({if $profile.public_flag_edit})
</td><td class="publicSelector">
({if $profs.public_flag[$profile.name]})
({assign var=pflag value=$profs.public_flag[$profile.name]})
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

<tr>
<th>PCメールアドレス <strong>※</strong></th>
<td style='border: 1px #CDCDCD solid;'>
({$pc_address})
</td>
</tr>
<tr>
<th>パスワード <strong>※</strong></th>
<td style='border: 1px #CDCDCD solid;'>
<input type="password" class="input_password" name="password" value="" />
<p class="caution">※6～12文字の半角英数で入力してください</p>
</td>
</tr>
<tr>
<th>パスワード確認用 <strong>※</strong></th>
<td style='border: 1px #CDCDCD solid;'>
<input type="password" class="input_password" name="password2" value="" />
</td>
</tr>
({if $smarty.const.IS_PASSWORD_QUERY_ANSWER})
<tr>
<th>秘密の質問 <strong>※</strong></th>
<td style='border: 1px #CDCDCD solid;'>
<select name="c_password_query_id">
<option value="">選択してください</option>
({foreach from=$query_list key=key item=item})
<option value="({$key})"({if $profs.c_password_query_id == $key}) selected="selected"({/if})>({$item})</option>
({/foreach})
</select>
<p class="caution">※パスワードを忘れてしまったときの確認に使用します。</p>
</td>
</tr>
<tr>
<th>質問の答え <strong>※</strong></th>
<td style='border: 1px #CDCDCD solid;'>
<input type="text" class="input_text" name="c_password_query_answer" value="({$profs.c_password_query_answer})" size="30" />
</td>
</tr>
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

