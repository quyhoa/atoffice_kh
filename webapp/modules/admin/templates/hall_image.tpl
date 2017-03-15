({$inc_header|smarty:nodefaults})
({ext_include file="inc_subnavi_adminImageKakikomi.tpl"})
({assign var="page_name" value="会場画像登録"})
({ext_include file="inc_tree_adminImageKakikomi.tpl"})
</div>

({*ここまで:navi*})

({*権限チェック*})
({if $atoffice_auth_type==1 or $atoffice_auth_type==4})


<h2 id="ttl01">会場画像登録【({$hall_name})】</h2>
<br>
<center>
({if $msg})<p class="actionMsg">({$msg})</p><br><br>({/if})
<br>
({foreach from=$image_list key=key item=item})
※ 画像({$item.num})は({$item.x})ｘ({$item.y})ピクセルで登録してください。<br>

<br><br>
<table border=1>
<tr>
<th bgcolor=#CCCFFF height=30>画像ID</th>
<th bgcolor=#CCCFFF>登録画像プレビュー</th>
<th bgcolor=#CCCFFF>登録画像参照</th>
</tr>
<tr>
<td width=80 align=center bgcolor=#CCCCCC><b>画像({$item.num})</b><br>({$item.use})</td>
<td>
({if $image_data.$key.image_filename})
<img src='./img.php?filename=({$image_data.$key.image_filename})' width='({$item.x})' height='({$item.y})'>
({else})
<img src='./img.php?filename=skin_no_image.gif' width='({$item.x})' height='({$item.y})'>
({/if})
</td>
<td align=right>
<form name="add({$item.num})" action="./" method="post" enctype="multipart/form-data" >
<input type="hidden" name="m" value="({$module_name})" />
<input type="hidden" name="a" value="do_({$hash_tbl->hash('insert_a_image','do')})" />
<input type="hidden" name="sessid" value="({$PHPSESSID})" />
<input type="hidden" name="image_id" value="({$item.num})">
<input type="hidden" name="delete_flag" value="0">
<input type="hidden" name="hall_id" value="({$hall_id})">
<input type="hidden" class="basic" name="filename" value="({$hall_id})_({$item.num})" size="30" />
<div align=center>画像タイトル：<input type="text" name="title" value="({$image_data.$key.title})"><br></div>
<br>
<input type="file" class="basic" name="upfile" /><span>（GIF・JPG・PNG形式）</span>
<br>
<br>
画像({$item.num})を登録する：　<input type="submit" value="　登　録　" />
</form>
<br>
<br>
<form name="del({$item.num})" action="./" method="post" enctype="multipart/form-data" >
<input type="hidden" name="m" value="({$module_name})" />
<input type="hidden" name="a" value="do_({$hash_tbl->hash('insert_a_image','do')})" />
<input type="hidden" name="sessid" value="({$PHPSESSID})" />
<input type="hidden" name="image_id" value="({$item.num})">
<input type="hidden" name="delete_flag" value="({$item.num})">
<input type="hidden" name="hall_id" value="({$hall_id})">
画像({$item.num})を削除する：　<input type="submit" value="　削　除　" />
</form>

</td>
</tr>
</table>
<br>
<br>
({/foreach})


</center>

({else})
<br>
<center>
<span style="font-size: 16px; color: #FF0033;"><b>アクセス権がありません。</b></span>
</center>
({/if})
<div>
({$inc_footer|smarty:nodefaults})
