<div class="subNavi">
({strip})
<a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('edit_c_admin_config')})">サイト設定</a>&nbsp;|&nbsp;
<a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('edit_c_admin_config_word')})">サイト内名称設定</a>&nbsp;|&nbsp;
<a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('edit_c_profile')})">プロフィール項目設定</a>&nbsp;|&nbsp;
<a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('edit_category')})">({$WORD_COMMUNITY})カテゴリ設定</a>&nbsp;|&nbsp;
<a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('manage_c_commu')})">初期({$WORD_COMMUNITY})設定</a>&nbsp;|&nbsp;
<a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('edit_c_holiday')})">祝日設定</a>&nbsp;|&nbsp;
<a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('edit_mail_send')})">メール送信設定</a>&nbsp;|&nbsp;
<a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('edit_mail')})">メール文言変更</a>&nbsp;|&nbsp;
({if $smarty.const.OPENPNE_USE_POINT_RANK})
<a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('list_c_rank')})">ポイント・ランク設定</a>&nbsp;|&nbsp;
({/if})
<a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('limit_domain')})">招待メールドメイン制限</a>&nbsp;|&nbsp;
<a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('list_c_cmd')})">CMD設定</a>&nbsp;|&nbsp;
<a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('list_c_cmd_caster')})">CMDキャスト設定</a>&nbsp;|&nbsp;
({if $smarty.const.OPENPNE_USE_API})
<a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('list_c_api')})">API設定</a>&nbsp;|&nbsp;
({/if})
({if $smarty.const.OPENPNE_USE_DECORATION})
<a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('edit_deco')})">文字装飾設定</a>&nbsp;|&nbsp;
({/if})
({* ({if $smarty.const.OPENPNE_USE_ALBUM}) *})
({* <a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('edit_album_limit')})">アルバム容量制限設定</a>&nbsp;|&nbsp; *})
({* ({/if}) *})
<a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('edit_image_limit')})">画像容量制限設定</a>&nbsp;|&nbsp;
<a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('edit_skin_image')})">スキン画像変更</a>&nbsp;|&nbsp;
<a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('edit_c_sns_config')})">配色・CSS変更</a>&nbsp;|&nbsp;
<a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('edit_c_sns_config_ktai')})">携帯版配色変更</a>&nbsp;|&nbsp;
<a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('edit_c_navi')})">ナビゲーション変更</a>&nbsp;|&nbsp;
<a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('insert_html')})">HTML挿入</a>&nbsp;|&nbsp;
<a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('edit_entry_point')})">テンプレート挿入</a>&nbsp;|&nbsp;
<a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('edit_c_banner')})">バナー設定</a>&nbsp;|&nbsp;
<a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('edit_c_admin_info')})">お知らせ・規約設定</a>&nbsp;|&nbsp;
<a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('list_c_free_page')})">フリーページ管理</a>&nbsp;|&nbsp;
({/strip})
</div>
