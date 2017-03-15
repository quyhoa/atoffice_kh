({$inc_header|smarty:nodefaults})
({ext_include file="inc_subnavi_adminStatisticalInformation.tpl"})

({assign var="page_name" value="メール文言変更"})
({ext_include file="inc_tree_adminStatisticalInformation.tpl"})
</div>
({*ここまで:navi*})

({*権限チェック*})
({if $atoffice_auth_type==4})

<h2>前日予約分の締切設定</h2>
<div class="contents">
<table class="contents" cellpadding="0" cellspacing="0" border="0">
<tr>
<td class="detail">
<form action="./" method="post">
<input type="hidden" name="m" value="({$module_name})" />
<input type="hidden" name="a" value="page_({$hash_tbl->hash('set_deadline_booking','page')})" />
<input type="hidden" name="sessid" value="({$PHPSESSID})" />
<input type="hidden" name="target" value="({$requests.target})" />

<dt>
    <strong class="item">前日予約締切時間</strong>
   
    <select name="hour">
        ({foreach from=$hours item=item})
            <option value="({$item})" ({if $hour==$item})selected({/if})>({$item }) ({'時'})</option>
        ({/foreach})
    </select>
    <select name="minute">
        ({foreach from=$minutes item=item})
             <option value="({$item})" ({if $minute==$item})selected({/if})>
                ({if $item<10 })({'0'})({$item }) ({'分'})
                ({else}) 
                    ({$item }) ({'分'})
                ({/if})
                
             </option>
        ({/foreach})
    </select>
</dt>
    <p class="textBtn">
        <input type="submit" value="設定" onclick="alert('締切時間を設定しました。')">
    </p>
</form>
</td>
</tr>
</table>

({else})
<br>
<center>
<span style="font-size: 16px; color: #FF0033;">
    <b>アクセス権がありません。</b>
</span>
</center>
({/if})
<div>
({$inc_footer|smarty:nodefaults})