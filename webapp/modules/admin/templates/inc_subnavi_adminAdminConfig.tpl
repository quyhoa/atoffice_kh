<div class="subNavi">
({strip})
<a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('edit_admin_password')})">パスワード変更</a>&nbsp;|&nbsp;

({*************
({if $auth_type == 'all'})
<a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('update_hash_table')})">ページ名ランダム生成</a>&nbsp;|&nbsp;
({/if})
************})


({/strip})
</div>
