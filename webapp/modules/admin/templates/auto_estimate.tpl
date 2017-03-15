<style>
    .web_dialog_overlay {
        background: none repeat scroll 0 0 #000000;
        bottom: 0;
        display: none;
        height: 100%;
        left: 0;
        margin: 0;
        opacity: 0.15;
        padding: 0;
        position: fixed;
        right: 0;
        top: 0;
        width: 100%;
        z-index: 101;
    }
    .dialog{
        position: absolute;
        width: 555px;
        z-index: 300;
        background:#FFFFFF;
        top:-40px;
        border: 2px solid #000;
        border-radius:5px;
    }
    table{
        font-size:inherit;
        line-height:inherit;
        font-family:inherit;
    }

</style>
({$inc_header|smarty:nodefaults})
({ext_include file="inc_subnavi_adminSiteMember.tpl"})
({assign var="page_name" value="予約確認"})
({ext_include file="inc_tree_adminSiteMember.tpl"})
</div>

({*ここまで:navi*})

({*権限チェック*})
({if $atoffice_auth_type==2 or $atoffice_auth_type==4})

<h2 id="ttl01">自動見積書 (
    ({if $data})
    ({$num})件中　({$index+1})件～
    ({if $index+10 > $num})
    ({$num})
    ({else})
    ({$index+10})
    ({/if})
    件を表示
    ({else})
    0件
    ({/if})

    )</h2>
<br>
<center>

    ({if $msg})<p class="actionMsg">({$msg})</p><br><br>({/if})

    <form name="search" method="POST" action="./">
        <input type="hidden" name="m" value="({$module_name})" />
        <input type="hidden" name="a" value="page_({$hash_tbl->hash('auto_estimate','page')})" />

        <table border=1 width=800>
            <tr>
                <td colspan=4 bgcolor=#CDCDCD>検索オプション</td>
            </tr>
            <tr>
                <th bgcolor=#FFD9DC>予約ID</th>
                <th bgcolor=#FFD9DC>請求番号</th>
                <th bgcolor=#FFD9DC>バーチャル口座番号</th>
                <td rowspan=4 bgcolor=#FFD9DC>
                    <input type="submit" value="検索する">
                </td>
            </tr>
            <tr>
                <td>
                    <input type="text" name="reserve_id" value="({$reserve_id})">
                </td>
                <td>
                    <input type="text" name="bill_id" value="({$bill_id})">
                </td>
                <td>
                    <input type="text" name="virtual_number" value="({$virtual_number})">
                </td>
            </tr>

            <tr>
                <th bgcolor=#FFD9DC>会場</th>
                <th bgcolor=#FFD9DC>メールアドレス</th>
                <th bgcolor=#FFD9DC>予約時間</th>
            </tr>
            <tr>
                <td>
                    <select name="hall_list">
                        <option value="0">すべての会場</option>
                        ({foreach from=$hall_list item=item})
                        <option value="({$item.hall_id})" ({if $item.hall_id == $hall_id})selected({/if})>({$item.hall_name})</option>
                        ({/foreach})
                </td>
                <td>
                    <input type="text" name="mail" value="({$mail})">
                </td>
                <td>
                    <input type="text" name="begin_date" value="({$begin_date})">
                </td>
            </tr>

        </table>

    </form>

    <br>

    <FORM method='POST' action='./atoffice/pages/sub/estimate.php' target='blank' onSubmit="return false" id='frmEstimate'>
        <table border=1 width=800>
            <tr>
                <td colspan=4 bgcolor=#CDCDCD>見積書</td>
            </tr>
            <tr>
                <td rowspan="2" bgcolor=#FFD9DC>予約ID<br>(最大10件)</td>
                <td>
                    <INPUT size="10" type="text" name="res1"> 
                    <INPUT size="10" type="text" name="res2"> 
                    <INPUT size="10" type="text" name="res3"> 
                    <INPUT size="10" type="text" name="res4"> 
                    <INPUT size="10" type="text" name="res5"> 
                    <INPUT style="vertical-align: center" type="submit" name="estimate" value="見積書" onclick="return showEstimate()">
                    <BR>
                    <INPUT size="10" type="text" name="res6"> 
                    <INPUT size="10" type="text" name="res7"> 
                    <INPUT size="10" type="text" name="res8"> 
                    <INPUT size="10" type="text" name="res9"> 
                    <INPUT size="10" type="text" name="res10"> 
                    <div style="position:relative">
                        <div style="display: none;background:#fff;height:120px;padding:10px;" class="dialog" id="dialog_estimte">
                            <!--   <p style="text-align:center">宛名の変更</p>   
                                <br />  -->
                            <div style="margin:0 auto;text-align:center;" id="confirm_estimate">
                                <input type='text' width="200" name='reserve_name' id='reserve_name_estimate'>
                                <br /><br />
                                <button onclick="showExtent()">見積書</button>
                                <input type='reset' value='キャンセル' onclick="cancleEstimate();">
                            </div>

                        </div>        
                    </div>        

                </td>
            </tr>
        </table>
    </FORM>

    <br>

    ({foreach from=$page_list item=item})
    ({if $item.select})
    ({$item.page})
    ({else})
    <a href="./?m=admin&a=page_auto_estimate&hall_list=({$hall_id})&reserve_id=({$reserve_id})&bill_id=({$bill_id})&virtual_number=({$virtual_number})&mail=({$mail})&begin_date=({$begin_date})&index=({$item.index})" >({$item.page})</a>
    ({/if})
    |
    ({/foreach})
    <hr>
    ({assign var=val value=1})
    ({foreach from=$data key=k item=item})
    ({assign var=val value=$val+1})

    <table border=1 width=800 >
        <tr>
            <td colspan=4 bgcolor=#CC1111>
                <b><span style="color: #FFFFFF;">
                        □　予約ID : ({$item.reserve_id})　
                        ({if $item.long_term>0})
                        -長期予約-
                        ({/if})
                        □

                    </span></b>
            </td>
        </tr>

        <tr>
            <td bgcolor=#FFD9DC width=100><span style='margin:5px;'>予約日</span></td>
            <td><span style='margin:5px;'>({$item.tmp_reserve_datetime})</span></td>	<td bgcolor=#FFD9DC width=100><span style='margin:5px;'>承認日</span></td>
            <td><span style='margin:5px;'>({$item.reserve_datetime})</span></td>


        </tr>

        <tr>
            <td bgcolor=#FFD9DC width=100><span style='margin:5px;'>入金期日</span></td>
            <td><span style='margin:5px;'>({$item.pay_limitdate})</span></td>	<td bgcolor=#FFD9DC width=100><span style='margin:5px;'>入金状態</span></td>
            <td><span style='margin:5px;'>
                    ({if $item.pay_money==$item.total_price})
                    入金済み（({$item.pay_money})円）
                    ({elseif $item.pay_money > $item.total_price})
                    <span style="color:#FF0000;"><b>過剰入金(({$item.pay_money})円)</b></span>
                    ({elseif $item.pay_money})
                    一部入金済み（({$item.pay_money})円）
                    ({else})
                    未入金
                    ({/if})


                </span></td>
        </tr>

        <tr>
            <td bgcolor=#FFD9DC><span style='margin:5px;'>予約者</span></td>
            <td width=300><span style='margin:5px;'>
                    <a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('c_member_detail')})&amp;target_c_member_id=({$item.c_member.c_member_id})">({$item.c_member.nickname})</a>
                </span></td>
            <td bgcolor=#FFD9DC width=100><span style='margin:5px;'>企業・個人名</span></td>
            <td width=300><span style='margin:5px;'>({$item.corp})</span></td>
        </tr>

        <tr>
            <td bgcolor=#FFD9DC><span style='margin:5px;'>看板</span></td>
            <td colspan="3" width=700><span style='margin:5px;'>
                    ({$item.kanban})
                </span></td>
            </td>

        <tr>
            <td bgcolor=#FFD9DC><span style='margin:5px;'>施設名</span></td>
            <td width=300><span style='margin:5px;'>({$item.hall_data.hall_name})</span></td>
            <td bgcolor=#FFD9DC width=100><span style='margin:5px;'>部屋名</span></td>
            <td width=300><span style='margin:5px;'>({$item.room_data.room_name})</span></td>
        </tr>

        <tr>
            <td bgcolor=#FFD9DC rowspan=3><span style='margin:5px;'>予約時間</span></td>
            <td rowspan=3>({$item.datetime})<br>({$item.begin_datetime}) ～ ({$item.finish_datetime})</td>
            <td bgcolor=#FFD9DC><span style='margin:5px;'>利用人数/目的</span></td>
            <td><span style='margin:5px;'>({$item.people}) 人　/　

                    ({if $item.purpose==0})
                    未選択
                    ({elseif $item.purpose==1})
                    会議
                    ({elseif $item.purpose==2})
                    セミナー
                    ({elseif $item.purpose==3})
                    研修
                    ({elseif $item.purpose==4})
                    面接・試験
                    ({elseif $item.purpose==5})
                    懇談会・パーティ
                    ({elseif $item.purpose==6})
                    その他
                    ({/if})

                </span></td>
        </tr>

        <tr>
            <td bgcolor=#FFD9DC><span style='margin:5px;'>ﾊﾞｰﾁｬﾙ口座</span></td>
            <td><span style='margin:5px;'>
                    ({if $item.virtual_code})
                    ({$item.virtual_code})
                    ({else})
                    固定口座
                    ({/if})
                </span></td>
        </tr>
        <tr>
            <td bgcolor=#FFD9DC><span style='margin:5px;'>入金日</span></td>
            <td><span style='margin:5px;'>

                    ({if $item.pay_checkdate})
                    ({$item.pay_checkdate})
                    ({else})
                    -- --
                    ({/if})

                </span></td>
        </tr>

        <tr>
            <td bgcolor=#FFD9DC width=100><span style='margin:5px;'>利用料金</span></td>
            <td colspan=3><span style='margin:5px;'>【部屋利用料：({$item.room_price})円】＋【備品利用料：({$item.vessel_price})円】＋【サービス利用料：({$item.service_price})円】＝【合計請求額：({$item.room_price+$item.vessel_price+$item.service_price})円】</td>

            <!--
                    <td colspan=3><span style='margin:5px;'>【部屋利用料：({$item.room_price})円】＋【備品利用料：({$item.vessel_price})円】＋【サービス利用料：({$item.service_price})円】＝【合計請求額：({$item.total_price})円】
            ({if $item.room_price+$item.vessel_price+$item.service_price!=$item.total_price})
            <font color="red"><b>!合計額 ({$item.room_price+$item.vessel_price+$item.service_price})円</b></font>
            ({/if})
            
            </span></td> -->
        </tr>



        ({if $item.reserve_v_list})
        <tr>
            <td bgcolor=#FFD9DC width=100 style='vertical-align:middle;'><span style='margin:5px;'>予約備品一覧</span></td>
            <td colspan=3><span style='margin:5px;'>

                    <table style='border: 1px #000000 solid;' width=100%>
                        <tr>
                            <th style='border: 1px #000000 solid;' bgcolor=#EFEFEF>備品名</th>
                            <th style='border: 1px #000000 solid;' bgcolor=#EFEFEF>予約時単価</th>
                            <th style='border: 1px #000000 solid;' bgcolor=#EFEFEF>数量</th>
                            <th style='border: 1px #000000 solid;' bgcolor=#EFEFEF>備品管理メモ</th>
                        </tr>
                        ({foreach from=$item.reserve_v_list key=k item=i})
                        <tr>
                        <td style='border: 1px #000000 solid;'>({$i.vessel_name})</td>
                        <td style='border: 1px #000000 solid;'>({$i.price})</td>
                        <td style='border: 1px #000000 solid;'>({$i.num})</td>
                        <td style='border: 1px #000000 solid;'>
                            ({$i.memo|nl2br|t_url2cmd:'diary':$member.c_member_id|t_cmd:'diary'|t_decoration})
                        </td>
                        </tr>
                        ({/foreach})
                    </table>

                </span></td>
        </tr>
        ({/if})



        ({if $item.reserve_s_list})
        <tr>
            <td bgcolor=#FFD9DC width=100 style='vertical-align:middle;'>
                <span style='margin:5px;'>予約ｻｰﾋﾞｽ一覧</span>
            </td>
            <td colspan=3>
                <span style='margin:5px;'>

                    <table style='border: 1px #000000 solid;' width=100%>
                        <tr>
                            <th style='border: 1px #000000 solid;' bgcolor=#EFEFEF>サービス名</th>
                            <th style='border: 1px #000000 solid;' bgcolor=#EFEFEF>予約時単価</th>
                            <th style='border: 1px #000000 solid;' bgcolor=#EFEFEF>数量</th>
                            <th style='border: 1px #000000 solid;' bgcolor=#EFEFEF>サービス管理メモ</th>
                        </tr>
                        ({foreach from=$item.reserve_s_list key=k item=i})
                        <tr>
                        <td style='border: 1px #000000 solid;'>({$i.service_name})</td>
                        <td style='border: 1px #000000 solid;'>({$i.price})</td>
                        <td style='border: 1px #000000 solid;'>({$i.num})</td>
                        <td style='border: 1px #000000 solid;'>
                            ({$i.memo|nl2br|t_url2cmd:'diary':$member.c_member_id|t_cmd:'diary'|t_decoration})
                        </td>
                        </tr>
                        ({/foreach})
                    </table>

                </span></td>
        </tr>
        ({/if})




        <tr>
            <td bgcolor=#FFD9DC width=100><span style='margin:5px;'>キャンセル料</span></td>
            <td colspan=3>

                ({if $item.cancel_flag == 1})
                <br>
                <span style="font-size:16px;color:#FF0000;"><center><b>キャンセル済み</b></center></span>
                <br>
                ({elseif $item.complete_flag})
                <span style="color:#FF0000"><b>完了済み、キャンセル不可</b></span>
                ({else})
                ({if $item.cancel_list.before>0})
                ({$item.cancel_list.before})日前　({$item.cancel_list.percent})% 徴収<br>
                ({/if})
                【キャンセルに含む総額：({$item.room_price+$item.cancel_service_price})円】=【部屋利用料：({$item.room_price})円】＋【備品利用料：({$item.cancel_vessel_price})円】＋【キャンセル料金に含まれるサービス料：({$item.cancel_service_price})円】<br>
                【キャンセル料：({$item.cancel_price})円】=【キャンセルに含む総額：({$item.room_price+$item.cancel_vessel_price+$item.cancel_service_price})円】-【キャンセル料率：({$item.cancel_list.percent})x0.01】<br><br>

                ({if $item.pay_money > $item.cancel_price})
                【返金額：({$item.pay_money-$item.cancel_price})円】=【入金額】-【キャンセル料】
                ({else})
                【請求額：({$item.cancel_price-$item.pay_money})】=【キャンセル料】-【入金額】
                ({/if})
                ({/if})
            </td>
        </tr>

        <tr>
            <td bgcolor=#FFD9DC width=100 style='vertical-align:middle;'><span style='margin:5px;'>お客さま<br>メッセージ</span></td>
            <td colspan=3 align=left>
                ({if $item.message})
                ({$item.message|nl2br|t_url2cmd:'diary':$member.c_member_id|t_cmd:'diary'|t_decoration})
                ({else})
        <center>--</center>
        ({/if})
        </td>
        </tr>

        <tr>
            <td bgcolor=#FFD9DC width=100 style='vertical-align:middle;'><span style='margin:5px;'>社内メモ</span></td>
            <td colspan=3 align=left>
                ({if $item.memo})
                ({$item.memo|nl2br|t_url2cmd:'diary':$member.c_member_id|t_cmd:'diary'|t_decoration})
                ({else})
        <center>--</center>
        ({/if})
        </td>
        </tr>
        <!-- ADD 20140401-->
        <tr style="position:relative">
            <td bgcolor=#FFD9DC>請求書発行</td>
            <td align="center" style="position:relative" >
                <input type='submit' value='請求書印刷' onclick="showDialog(({$val}));"> 
                <div style="position:relative">
                    <div style="display: none;background:#fff;height:100px;padding:10px;" class="dialog" id="dialog_({$val})">
                        <form method='POST' action='./' target='blank' id="frm_({$val})" >
                            <input type='hidden' name='reserve_id' id='reserve_id' value='({$item.reserve_id})'>
                            <input type='hidden' name='admin' value='1'>

                            <div id="confirm_({$val})" >
                                <input type='text' width="200" name='reserve_name' id='reserve_name_({$val})' >
                                <br/>
                                <br />
                                <button onclick="showConfirmPdf(({$val}));">請求書印刷</button>
                                <input type="reset" onclick="canclePdf(({$val}))" value="キャンセル">
                            </div>
                        </form>
                    </div>
                </div>

            </td>

            <td bgcolor=#FFD9DC>領収書発行</td>
            <td align="center" style="position:relative" >
                <input type='submit' value='領収書印刷' onclick="showDialogRec(({$val}));">
                <div style="position:relative">
                    <div style="display: none;background:#fff;height:100px;padding:10px;" class="dialog" id="dialog_rec_({$val})">
                        <form method='POST' action='./' target='blank' id="frm_rec_({$val})">

                            <input type='hidden' name='reserve_id' id='reserve_id' value='({$item.reserve_id})'>
                            <input type='hidden' name='admin' value='1'>

                            <div id="confirm_rec_({$val})" >
                                <input width="200" type='text' name='reserve_name' id='reserve_name_rec_({$val})' >
                                <br /><br />
                                <button onclick="showConfirmRec(({$val}));">領収書印刷</button>
                                <input type="reset" onclick="cancleRec(({$val}))" value="キャンセル">
                            </div>
                    </div>
                </div>
            </td>
        </tr>

        <!--	<tr>
                <td bgcolor=#FFD9DC>請求書発行</td>
                <td align="center"><form method='POST' action='./atoffice/pages/sub/pdf.php' target='blank'><input type='hidden' name='reserve_id' id='reserve_id' value='({$item.reserve_id})'><input type='hidden' name='admin' value='1'><input type='submit' value='請求書印刷'></form></td>
        
                <td bgcolor=#FFD9DC>領収書発行</td>
                <td align="center"><form method='POST' action='./atoffice/pages/sub/receipt.php' target='blank'><input type='hidden' name='reserve_id' id='reserve_id' value='({$item.reserve_id})'><input type='hidden' name='admin' value='1'><input type='submit' value='領収書印刷'></form></td>
        
                </tr> -->

        <tr>
            <td bgcolor=#FFD9DC>予約修正</td>
            <td colspan=3>
        <center>
            <form name="reserve_revision({$key})" method="POST" action="./">
                <input type="hidden" name="m" value="({$module_name})" />
                <input type="hidden" name="a" value="page_({$hash_tbl->hash('reserve_revision','page')})" />
                <input type="hidden" name="reserve_id" value="({$item.reserve_id})" />
                <input type="submit" value="　修　正　"/>
            </form>
        </center>
        </td>
        </tr>


    </table>
    <br>
    ({foreachelse})
    該当するデータはありませんでした。
    ({/foreach})

    <hr>
    ({foreach from=$page_list item=item})
    ({if $item.select})
    ({$item.page})
    ({else})
    <a href="./?m=admin&a=page_auto_estimate&hall_list=({$hall_id})&reserve_id=({$reserve_id})&bill_id=({$bill_id})&virtual_number=({$virtual_number})&mail=({$mail})&begin_date=({$begin_date})&index=({$item.index})" >({$item.page})</a>
    ({/if})
    |

    ({/foreach})

</center>
({else})
<br>
<center>
    <span style="font-size: 16px; color: #FF0033;"><b>アクセス権がありません。</b></span>
</center>
({/if})
<div id="overlay" class="web_dialog_overlay" onclick="return closeAll()">
    <input hidden="" value="" id="dialog_id">
</div>
<div>
    ({$inc_footer|smarty:nodefaults})


    <script>
        function closeAll()
        {
        closeEsitmate();
                closeDialog();
                closeDialogRec();
        }
        function closeAllRec(id)
        {
        closeDialog();
                closeDialogRec();
                document.forms["frm_rec_" + id].action = './atoffice/pages/sub/receipt.php';
                document.forms["frm_rec_" + id].submit = true;
                return true;
        }
        function closeAllPdf(id)
        {
        closeDialog();
                closeDialogRec();
                document.forms["frm_" + id].action = './atoffice/pages/sub/pdf.php';
                document.forms["frm_" + id].submit = true;
                return true;
        }

        function showDialog(id)
        {
        showPdfExtent(id);
                document.getElementById("dialog_id").value = id;
                var overlay = document.getElementById("overlay");
                overlay.style.display = "block";
                var idDialog = "dialog_" + id;
                var dialog = document.getElementById(idDialog);
                dialog.style.display = "block";
        }

        function closeDialog()
        {
        var overlay = document.getElementById("overlay");
                overlay.style.display = "none";
                var dialog = document.getElementsByClassName("dialog");
                var diaogId = document.getElementById("dialog_id");
                var id = document.getElementById("dialog_id").value;
                var idDialog = "dialog_" + id;
                var dialog = document.getElementById(idDialog);
                dialog.style.display = "none";
                return false;
        }
        function changeName(id)
        {
        var change = document.getElementById('change_' + id).checked;
                var name = document.getElementById('reserve_name_' + id).value;
                if (change && !name)
        {
        return false;
        }
        else{
        closeDialog();
                return true;
        }

        }
        function showDialogRec(id)
        {
        showRecExtent(id);
                document.getElementById("dialog_id").value = id;
                var overlay = document.getElementById("overlay");
                overlay.style.display = "block";
                var idDialog = "dialog_rec_" + id;
                var dialog = document.getElementById(idDialog);
                dialog.style.left = '-390px';
                dialog.style.display = "block";
        }
        function closeDialogRec()
        {

        var overlay = document.getElementById("overlay");
                overlay.style.display = "none";
                var diaogId = document.getElementById("dialog_id");
                var id = document.getElementById("dialog_id").value;
                var idDialog = "dialog_rec_" + id;
                var dialog = document.getElementById(idDialog);
                dialog.style.display = "none";
        }
        function changeNameRec(id)
        {
        var change = document.getElementById('change_rec_' + id).checked;
                var name = document.getElementById('reserve_name_rec_' + id).value;
                if (change && !name)
        {
        return false;
        }
        else{
        closeDialogRec();
                return true;
        }

        }
        function canclePdf(id){
        var confirm = document.getElementById('confirm_' + id);
                confirm.innerHTML = "";
                closeDialog();
                return false;
        }
        function cancleRec(id){
        var confirm = document.getElementById('confirm_rec_' + id);
                confirm.innerHTML = "";
                closeDialogRec();
                return false;
        }

        function showConfirmPdf(id)
        {
        var txt = document.getElementById('reserve_name_' + id).value;
                var confirm = document.getElementById('confirm_' + id);
                var texts = '<p>' + txt + '</p><br>';
                texts += '<input type="hidden" width="200" name="reserve_name" id="reserve_name_' + id + '" value="' + txt + '" >';
                texts += '<input type="submit" value="請求書印刷" onclick="closeAllPdf(' + id + ');">&nbsp;&nbsp;';
                texts += '<input type="reset" onclick="canclePdf(' + id + ')" value="キャンセル">';
                confirm.innerHTML = texts;
        }

        function showConfirmRec(id)
        {
        var txt = document.getElementById('reserve_name_rec_' + id).value;
                var confirm = document.getElementById('confirm_rec_' + id);
                var texts = '<p>' + txt + '</p><br>';
                texts += '<input type="hidden" width="200" name="reserve_name" id="reserve_name_rec_' + id + '" value="' + txt + '" >';
                texts += '<input type="submit" value="領収書印刷" onclick="closeAllRec(' + id + ');">&nbsp;&nbsp;';
                texts += '<input type="reset" onclick="cancleRec(' + id + ')" value="キャンセル">';
                confirm.innerHTML = texts;
        }

        function cancleConfirm(id, txt)
        {
        var confirm = document.getElementById('confirm_' + id);
                var texts = '<input type="text" width="200" name="reserve_name" id="reserve_name_' + id + '" value="' + txt + '" > <br /><br />';
                texts += '<input type="submit" value="領収書印刷" onclick="closeAllPdf(' + id + ');">';
                texts += '<input type="reset" onclick="canclePdf(' + id + ')" value="キャンセル">';
                confirm.innerHTML = texts;
        }

        function cancleConfirmRec(id, txt)
        {
        var confirm = document.getElementById('confirm_rec_' + id);
                var texts = '<input type="text" width="200" name="reserve_name" id="reserve_name_rec_' + id + '" value="' + txt + '" > <br /><br />';
                texts += '<input type="submit" value="領収書印刷" onclick="closeAllRec(' + id + ');">';
                texts += '<input type="reset" onclick="cancleRec(' + id + ')" value="キャンセル">';
                confirm.innerHTML = texts;
        }
        function addPdfForm(id)
        {
        var confirm = document.getElementById('confirm_' + id);
                var texts = '<p>宛名の変更</p><br/>';
                texts += '<input type="text" width="200" name="reserve_name" id="reserve_name_' + id + '" value="" > <br /><br />';
                texts += '<button onclick="showPdfExtent(' + id + ');">請求書印刷</button>&nbsp;&nbsp;';
                texts += '<input type="reset" onclick="canclePdf(' + id + ')" value="キャンセル">';
                confirm.innerHTML = texts;
        }
        function addRecForm(id)
        {
        var confirm = document.getElementById('confirm_rec_' + id);
                var texts = '<p>宛名の変更</p><br/>';
                texts += '<input type="text" width="200" name="reserve_name" id="reserve_name_rec_' + id + '" value="" > <br /><br />';
                texts += '<button onclick="showRecExtent(' + id + ');">領収書印刷</button>&nbsp;&nbsp;';
                texts += '<input type="reset" onclick="cancleRec(' + id + ')" value="キャンセル">';
                confirm.innerHTML = texts;
        }
        function showPdfExtent(id)
        {
        var confirm = document.getElementById('confirm_' + id);
                var dialog = document.getElementById('dialog_' + id);
                dialog.style.height = "90px";
                var texts = '<p>請求書印刷</p><br/>';
                texts += '<input type="submit" style="padding:5px" value="印刷" onclick="closeAllPdf(' + id + ');">&nbsp;&nbsp;';
                texts += '<input type="reset" style="padding:5px" value="宛名を変えて印刷" onclick="showFormPdfExtent(' + id + ');">&nbsp;&nbsp;';
                texts += '<input type="reset" style="padding:5px" onclick="canclePdf(' + id + ')" value="キャンセル">';
                confirm.innerHTML = texts;
        }
        function showFormPdfExtent(id)
        {
        var confirm = document.getElementById('confirm_' + id);
                var dialog = document.getElementById('dialog_' + id);
                dialog.style.height = "120px";
                var texts = '<p>請求書印刷</p><br/>';
                texts += ' <input type="text" style="padding:5px" width="200" name="reserve_name" id="reserve_name_2_' + id + '" value=""><br/><br/>';
                texts += '<input type="reset" style="padding:5px" value="印刷" onclick="showConfirmPdfExtent(' + id + ');">&nbsp;&nbsp;';
                texts += '<input type="reset" style="padding:5px" onclick="canclePdf(' + id + ')" value="キャンセル">';
                confirm.innerHTML = texts;
        }
        function showFormPdfExtent_2(id, txt_2)
        {
        var confirm = document.getElementById('confirm_' + id);
                var dialog = document.getElementById('dialog_' + id);
                dialog.style.height = "120px";
                var texts = '<p>請求書印刷</p><br/>';
                texts += ' <input type="text" style="padding:5px" width="200" name="reserve_name" id="reserve_name_2_' + id + '" value="' + txt_2 + '"><br/><br/>';
                texts += '<input type="reset" style="padding:5px" value="印刷" onclick="showConfirmPdfExtent(' + id + ');">&nbsp;&nbsp;';
                texts += '<input type="reset" style="padding:5px" onclick="canclePdf(' + id + ')" value="キャンセル">';
                confirm.innerHTML = texts;
        }
        function showConfirmPdfExtent(id)
        {
        var confirm = document.getElementById('confirm_' + id);
                var dialog = document.getElementById('dialog_' + id);
                dialog.style.height = "120px";
                var txt_2 = document.getElementById('reserve_name_2_' + id).value;
                var texts = '';
                if (txt_2){
        texts += '<p>請求書印刷</p><br/>';
                texts += txt_2 + '<br/><br/>';
                texts += '上記でいいですか？';
                texts += '  </p><br>';
                texts += ' <input type="hidden" style="padding:5px" width="200" name="reserve_name" id="reserve_name_' + id + '" value="' + txt_2 + '">';
        }
        else{
        dialog.style.height = "90px";
                texts += '<p>請求書印刷</p><br/>';
                texts += '<input type="hidden" style="padding:5px" width="200" name="reserve_name" id="reserve_name_' + id + '" value="">';
        }

        texts += '<input type="submit" style="padding:5px" value="印刷" onclick="closeAllPdf(' + id + ')">&nbsp;&nbsp;';
                texts += '<input type="reset" style="padding:5px" onclick="showFormPdfExtent_2(' + id + ',\'' + txt_2 + '\')" value="戻る">';
                confirm.innerHTML = texts;
        }
        function showRecExtent(id)
        {


        var confirm = document.getElementById('confirm_rec_' + id);
                var dialog = document.getElementById('dialog_rec_' + id);
                dialog.style.height = "90px";
                var txt_2 = '';
                var texts = '<p>領収書印刷</p><br/>';
                texts += '<input type="submit" style="padding:5px" value="印刷" onclick="closeAllRec(' + id + ');">&nbsp;&nbsp;';
                texts += '<input type="reset" style="padding:5px" value="宛名を変えて印刷" onclick="showFormRecExtent(' + id + ');">&nbsp;&nbsp;';
                texts += '<input type="reset" style="padding:5px" onclick="cancleRec(' + id + ')" value="キャンセル">';
                confirm.innerHTML = texts;
        }
        function showFormRecExtent(id)
        {
        var confirm = document.getElementById('confirm_rec_' + id);
                var dialog = document.getElementById('dialog_rec_' + id);
                dialog.style.height = "120px";
                var texts = '<p>領収書印刷</p><br/>';
                texts += ' <input type="text" style="padding:5px" width="200" name="reserve_name" id="reserve_name_rec_2_' + id + '" value=""><br/><br/>';
                texts += '<input type="reset" style="padding:5px" value="印刷" onclick="showConfirmRecExtent(' + id + ');">&nbsp;&nbsp;';
                texts += '<input type="reset" style="padding:5px" onclick="cancleRec(' + id + ')" value="キャンセル">';
                confirm.innerHTML = texts;
        }
        function showFormRecExtent_2(id, txt_2)
        {
        var confirm = document.getElementById('confirm_rec_' + id);
                var dialog = document.getElementById('dialog_rec_' + id);
                dialog.style.height = "120px";
                var texts = '<p>領収書印刷</p><br/>';
                texts += ' <input type="text" style="padding:5px" width="200" name="reserve_name" id="reserve_name_rec_2_' + id + '" value="' + txt_2 + '"><br/><br/>';
                texts += '<input type="reset" style="padding:5px" value="印刷" onclick="showConfirmRecExtent(' + id + ');">&nbsp;&nbsp;';
                texts += '<input type="reset" style="padding:5px" onclick="cancleRec(' + id + ')" value="キャンセル">';
                confirm.innerHTML = texts;
        }
        function showConfirmRecExtent(id)
        {
        var confirm = document.getElementById('confirm_rec_' + id);
                var dialog = document.getElementById('dialog_rec_' + id);
                dialog.style.height = "120px";
                var txt_2 = document.getElementById('reserve_name_rec_2_' + id).value;
                var texts = '';
                if (txt_2){
        texts += '<p>領収書印刷<br/><br/>';
                texts += txt_2 + '<br/><br/>';
                texts += '上記でいいですか？';
                texts += '  </p><br>';
                texts += ' <input type="hidden" style="padding:5px" width="200" name="reserve_name" id="reserve_name_rec_' + id + '" value="' + txt_2 + '">';
        }
        else{
        dialog.style.height = "90px";
                texts += '<p>領収書印刷<br/><br/>';
                texts += '<input type="hidden" style="padding:5px" width="200" name="reserve_name" id="reserve_name_rec_' + id + '" value="">';
        }

        texts += '<input type="submit" style="padding:5px" value="印刷" onclick="closeAllRec(' + id + ')">&nbsp;&nbsp;';
                texts += '<input type="reset" style="padding:5px" onclick="showFormRecExtent_2(' + id + ',\'' + txt_2 + '\')" value="戻る">';
                confirm.innerHTML = texts;
        }


        function smtEstimaker(){
        var frm = document.getElementById('frmEstimate').submit();
                closeEsitmate();
        }
        function showEstimate()
        {
        //addFormEstimate();
        showExtent();
                var overlay = document.getElementById("overlay");
                overlay.style.display = "block";
                var idDialog = "dialog_estimte";
                var dialog = document.getElementById(idDialog);
                dialog.style.display = "block";
        }
        function closeEsitmate()
        {
        var overlay = document.getElementById("overlay");
                overlay.style.display = "none";
                var dialog = document.getElementById('dialog_estimte');
                dialog.style.display = "none";
        }
        function showConfirmEstimte()
        {
        var txt = document.getElementById('reserve_name_estimate').value;
                var confirm = document.getElementById('confirm_estimate');
                var texts = '<p>' + txt + '</p><br>';
                texts += '<input type="hidden" width="200" name="reserve_name" id="reserve_name_estimate" value="' + txt + '">';
                texts += '<input type="submit" value="印刷" onclick="smtEstimaker();">&nbsp;&nbsp;';
                texts += '<input type="reset" onclick="cancleEstimate()" value="キャンセル">';
                confirm.innerHTML = texts;
        }

        function cancleConfirmEstimate(txt)
        {
        var confirm = document.getElementById('confirm_estimate');
                var texts = '<input type="text" width="200" name="reserve_name" id="reserve_name_estimate" value="' + txt + '" >';
                texts += '<input type="submit" value="印刷" onclick="smtEstimaker();">';
                texts += '<input type="reset" onclick="cancleEstimate()" value="キャンセル">';
                confirm.innerHTML = texts;
        }
        function cancleEstimate()
        {
        closeEsitmate();
                return false;
        }
        function addFormEstimate()
        {
        var confirm = document.getElementById('confirm_estimate');
                var dialog_estimte = document.getElementById('dialog_estimte');
                dialog_estimte.style.height = "100px";
                var texts = '<p>見積書印刷</p><br/>';
                texts += '<input type="text" width="200" name="reserve_name" id="reserve_name_estimate" value="" > <br /><br />';
                texts += '<button onclick="showExtent()">見積書</button>&nbsp;&nbsp;';
                texts += '<input type="reset" onclick="cancleEstimate()" value="キャンセル">';
                confirm.innerHTML = texts;
        }
        function showExtent()
        {
        var confirm = document.getElementById('confirm_estimate');
                var dialog_estimte = document.getElementById('dialog_estimte');
                dialog_estimte.style.height = "100px";
                var txt_2 = '';
                var texts = '<p>見積書印刷</p><br/>';
                texts += '<input type="submit" style="padding:5px" value="印刷" onclick="smtEstimaker();">&nbsp;&nbsp;';
                texts += '<input type="reset" style="padding:5px" value="宛名を変えて印刷" onclick="showFormExtent(' + txt_2 + ');">&nbsp;&nbsp;';
                texts += '<input type="reset" style="padding:5px" onclick="cancleEstimate()" value="キャンセル">';
                confirm.innerHTML = texts;
        }
        function showFormExtent_2(txt_2)
        {
        var confirm = document.getElementById('confirm_estimate');
                var dialog_estimte = document.getElementById('dialog_estimte');
                dialog_estimte.style.height = "120px";
                var texts = '<p>見積書印刷</p><br/>';
                texts += '<input type="text" style="padding:3px" width="250" name="reserve_name_second" id="reserve_name_estimate_second" value="' + txt_2 + '" > <br /><br />';
                texts += '<input type="reset" style="padding:5px" value="印刷" onclick="showExtentConfirm();">&nbsp;&nbsp;';
                texts += '<input type="reset" style="padding:5px" onclick="cancleEstimate()" value="キャンセル">';
                confirm.innerHTML = texts;
        }
        function showFormExtent()
        {
        var confirm = document.getElementById('confirm_estimate');
                var dialog_estimte = document.getElementById('dialog_estimte');
                dialog_estimte.style.height = "120px";
                var texts = '<p>見積書印刷</p><br/>';
                texts += '<input type="text" style="padding:3px" width="250" name="reserve_name_second" id="reserve_name_estimate_second" value="" > <br /><br />';
                texts += '<input type="reset" style="padding:5px" value="印刷" onclick="showExtentConfirm();">&nbsp;&nbsp;';
                texts += '<input type="reset" style="padding:5px" onclick="cancleEstimate()" value="キャンセル">';
                confirm.innerHTML = texts;
        }
        function showExtentConfirm()
        {
        var txt_2 = document.getElementById('reserve_name_estimate_second').value;
                var confirm = document.getElementById('confirm_estimate');
                var texts = '';
                var dialog_estimte = document.getElementById('dialog_estimte');
                dialog_estimte.style.height = "120px";
                if (txt_2){
        texts += '<p>見積書印刷</p><br/>';
                texts += txt_2 + '<br/><br/>';
                texts += '上記でいいですか？';
                texts += '  </p><br>';
                texts += '<input type="hidden" style="padding:5px" width="200" name="reserve_name" id="reserve_name_estimate" value="' + txt_2 + '">';
        }
        else{
        dialog_estimte.style.height = "90px";
                texts += '<p>見積書印刷</p><br/>';
                texts += '<input type="hidden" style="padding:5px" width="200" name="reserve_name" id="reserve_name_estimate" value="">';
        }

        texts += '<input type="submit" style="padding:5px" value="印刷" onclick="smtEstimaker();">&nbsp;&nbsp;';
                texts += '<input type="reset" style="padding:5px" onclick="showFormExtent_2(\'' + txt_2 + '\')" value="戻る">';
                confirm.innerHTML = texts;
        }


    </script>