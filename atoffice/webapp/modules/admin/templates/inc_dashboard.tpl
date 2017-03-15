    <div class="noticeTypeA">
        <div class="box" id="counter">
            <h2>SNS情報</h2>
            <div class="innerBox">
({t_assign_sns_info var=sns_info})
<dl>
    <dt>総メンバー数</dt>
    <dd>({$sns_info.info_member_count|number_format})人 (前日登録 ({$sns_info.info_member_count_yesterday|number_format})人)</dd>
    <dt>総({$WORD_COMMUNITY})数</dt>
    <dd>({$sns_info.info_commu_count|number_format})</dd>
    <dt>アクティブ率</dt>
    <dd>({$sns_info.info_member_rate_active|number_format:2})%</dd>
    <dt>今日の予約数</dt>
    <dd>({$sns_info.info_message_count_today|number_format})件 (前日({$sns_info.info_message_count_yesterday|number_format})件)</dd>
</dl>
            </div>
        </div>
({t_assign_sns_ranking var=sns_rank})
        <div class="box" id="ranking">
            <h2>ランキング</h2>
            ({if $sns_rank.rank_ashiato || $sns_rank.rank_friend || $sns_rank.rank_com_member || $sns_rank.rank_com_comment})
            <div class="innerBox">
<dl>
    ({if $sns_rank.rank_ashiato})
    <dt>アクセス数No.1</dt>
    <dd><a href="({t_url _absolute=1 m=pc a=page_f_home})&amp;target_c_member_id=({$sns_rank.rank_ashiato[1][0].c_member.c_member_id})" target="_blank">({$sns_rank.rank_ashiato[1][0].c_member.nickname})</a> (({$sns_rank.rank_ashiato[1][0].count|number_format})アクセス)</dd>({/if})
    ({if $sns_rank.rank_friend})
    <dt>({$WORD_MY_FRIEND})数No.1</dt>
    <dd><a href="({t_url _absolute=1 m=pc a=page_f_home})&amp;target_c_member_id=({$sns_rank.rank_friend[1][0].c_member.c_member_id})" target="_blank">({$sns_rank.rank_friend[1][0].c_member.nickname})</a> (({$sns_rank.rank_friend[1][0].count|number_format})人)</dd>({/if})
    ({if $sns_rank.rank_com_member})
    <dt>参加人数No.1({$WORD_COMMUNITY})</dt>
    <dd><a href="({t_url _absolute=1 m=pc a=page_c_home})&amp;target_c_commu_id=({$sns_rank.rank_com_member[1][0].c_commu_id})" target="_blank">({$sns_rank.rank_com_member[1][0].c_commu.name})</a> (({$sns_rank.rank_com_member[1][0].count|number_format})人)</dd>({/if})
    ({if $sns_rank.rank_com_comment})
    <dt>盛り上がり度No.1({$WORD_COMMUNITY})</dt>
    <dd><a href="({t_url _absolute=1 m=pc a=page_c_home})&amp;target_c_commu_id=({$sns_rank.rank_com_comment[1][0].c_commu_id})" target="_blank">({$sns_rank.rank_com_comment[1][0].c_commu.name})</a> (書き込み({$sns_rank.rank_com_comment[1][0].count|number_format})件)</dd>({/if})
</dl>
            </div>
            ({/if})
        </div>
({t_assign_sns_message var=sns_message})
        <div class="box" id="message">
            <h2>オーナー未読メッセージ <span class="unread">(<a href="({t_url _absolute=1 m=pc a=page_h_message_box})" target="_blank">({$sns_message.unread_messsage_count|number_format})</a>件)</span></h2>
            ({if $sns_message.unread_message_list})
            <div class="innerBox">
<dl>
({foreach from=$sns_message.unread_message_list item=item})
    <dt>({$item.r_datetime|date_format:"%m/%d %H:%M"})</dt>
    <dd><a href="({t_url _absolute=1 m=pc a=page_h_message})&amp;target_c_message_id=({$item.c_message_id})&amp;jyusin_c_message_id=({$item.c_message_id})" target="_blank">({$item.subject})</a> <span class="origin">(<a href="({t_url _absolute=1 m=pc a=page_f_home})&amp;target_c_member_id=({$item.c_member_id_from})" target="_blank">({$item.c_member.nickname})</a>)</span></dd>
({/foreach})
</dl>
            </div>
            ({/if})
        </div>


({t_assign_sns_new_member var=new_member_list})
        <div class="box" id="member">
            <h2>最近参加した会員</h2>
            ({if $new_member_list})
            <div class="innerBox">
<dl>
({foreach from=$new_member_list item=item})
    <dt>({$item.r_date|date_format:"%m/%d %H:%M"})</dt>
    <dd><a href="({t_url _absolute=1 m=pc a=page_f_home})&amp;target_c_member_id=({$item.c_member_id})" target="_blank">({$item.nickname})</a> <span class="origin">(招待者: <a href="({t_url _absolute=1 m=pc a=page_f_home})&amp;target_c_member_id=({$item.c_member_id_invite})" target="_blank">({$item.c_member_invite.nickname})</a>)</span></dd>
({/foreach})
</dl>
            </div>
            ({/if})
        </div>
    </div>

    <br class="clear" />
