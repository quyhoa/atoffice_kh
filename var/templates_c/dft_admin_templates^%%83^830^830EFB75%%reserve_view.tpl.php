<?php /* Smarty version 2.6.18, created on 2017-03-02 19:21:23
         compiled from file:/var/www/html/atoffice/webapp/modules/admin/templates/reserve_view.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'ext_include', 'file:/var/www/html/atoffice/webapp/modules/admin/templates/reserve_view.tpl', 34, false),array('modifier', 't_escape', 'file:/var/www/html/atoffice/webapp/modules/admin/templates/reserve_view.tpl', 46, false),array('modifier', 'nl2br', 'file:/var/www/html/atoffice/webapp/modules/admin/templates/reserve_view.tpl', 335, false),array('modifier', 't_url2cmd', 'file:/var/www/html/atoffice/webapp/modules/admin/templates/reserve_view.tpl', 335, false),array('modifier', 't_cmd', 'file:/var/www/html/atoffice/webapp/modules/admin/templates/reserve_view.tpl', 335, false),array('modifier', 't_decoration', 'file:/var/www/html/atoffice/webapp/modules/admin/templates/reserve_view.tpl', 335, false),)), $this); ?>
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
        line-height: inherit;
        font-family:inherit;
    }

</style>
<?php echo $this->_tpl_vars['inc_header']; ?>

<?php echo smarty_function_ext_include(array('file' => "inc_subnavi_adminSiteMember.tpl"), $this);?>

<?php $this->assign('page_name', "予約確認"); ?>
<?php echo smarty_function_ext_include(array('file' => "inc_tree_adminSiteMember.tpl"), $this);?>

</div>


<?php if ($this->_tpl_vars['atoffice_auth_type'] == 2 || $this->_tpl_vars['atoffice_auth_type'] == 4): ?>

<h2 id="ttl01">予約確認 (
    <?php if ($this->_tpl_vars['data']): ?>
    <?php echo smarty_modifier_t_escape($this->_tpl_vars['num']); ?>
件中　<?php echo smarty_modifier_t_escape($this->_tpl_vars['index']+1); ?>
件～
    <?php if ($this->_tpl_vars['index'] + 10 > $this->_tpl_vars['num']): ?>
    <?php echo smarty_modifier_t_escape($this->_tpl_vars['num']); ?>

    <?php else: ?>
    <?php echo smarty_modifier_t_escape($this->_tpl_vars['index']+10); ?>

    <?php endif; ?>
    件を表示
    <?php else: ?>
    0件
    <?php endif; ?>

    )</h2>
<br>
<center>

    <?php if ($this->_tpl_vars['msg']): ?><p class="actionMsg"><?php echo smarty_modifier_t_escape($this->_tpl_vars['msg']); ?>
</p><br><br><?php endif; ?>
    <form  method="POST" action="./" id="frm_revision">
        <input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
        <input type="hidden" name="a" value="page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('reserve_revision','page')); ?>
" />
        <input type="hidden" name="reserve_id" value="" id="reserve_id" />

    </form>
    <form name="search" method="POST" action="./">
        <input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
        <input type="hidden" name="a" value="page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('reserve_view','page')); ?>
" />

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
                    <input type="text" name="reserve_id" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['reserve_id']); ?>
">
                </td>
                <td>
                    <input type="text" name="bill_id" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['bill_id']); ?>
">
                </td>
                <td>
                    <input type="text" name="virtual_number" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['virtual_number']); ?>
">
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
                        <?php $_from = $this->_tpl_vars['hall_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
                        <option value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['hall_id']); ?>
" <?php if ($this->_tpl_vars['item']['hall_id'] == $this->_tpl_vars['hall_id']): ?>selected<?php endif; ?>><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['hall_name']); ?>
</option>
                        <?php endforeach; endif; unset($_from); ?>
                </td>
                <td>
                    <input type="text" name="mail" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['mail']); ?>
">
                </td>
                <td>
                    <input type="text" name="begin_date" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['begin_date']); ?>
">
                </td>
            </tr>

        </table>

    </form>

    <br>

    <FORM method='POST' action='./atoffice/pages/sub/collectpdf.php' target='blank' onSubmit="return false" id='frmColect'>
        <table border=1 width=800>
            <tr>
                <td colspan=4 bgcolor=#CDCDCD>まとめて請求書/領収書</td>
            </tr>
            <tr>
                <td rowspan="2" bgcolor=#FFD9DC>予約ID<br>(最大15件)</td>
                <td>
                    <INPUT size="10" type="text" name="res1"> <INPUT size="10" type="text" name="res2"> <INPUT size="10" type="text" name="res3"> <INPUT size="10" type="text" name="res4"> <INPUT size="10" type="text" name="res5">
                    <button onclick="showCollect(1)">まとめて請求書</button>
                    <!-- < type="submit" name="bill" value="まとめて請求書">--><BR>

                    <INPUT size="10" type="text" name="res6"> <INPUT size="10" type="text" name="res7"> <INPUT size="10" type="text" name="res8"> <INPUT size="10" type="text" name="res9"> <INPUT size="10" type="text" name="res10">
                    <button onclick="showCollect(2)">まとめて領収書</button>
                    <!--     <INPUT type="submit" name="receipt" value="まとめて領収書"> -->
					<BR>
					<INPUT size="10" type="text" name="res11"> <INPUT size="10" type="text" name="res12"> <INPUT size="10" type="text" name="res13"> <INPUT size="10" type="text" name="res14"> <INPUT size="10" type="text" name="res15">	
                    <div style="position:relative">
                        <div style="display: none;background:#fff;height:100px;padding:10px;" class="dialog" id="dialog_collect">

                            <div style="margin:0 auto;text-align:center;" id="confirm_collect">
                                <input type='text' width="200" name='reserve_name' id='reserve_collect'>
                                <br /><br />
                                <button onclick="showConfirmEstimte()">見積書</button>
                                <input type='reset' value='キャンセル' onclick="cancleEstimate();">
                            </div>

                        </div>        
                    </div>  

                </td>
            </tr>
        </table>
    </FORM>

    <br>

    <?php $_from = $this->_tpl_vars['page_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
    <?php if ($this->_tpl_vars['item']['select']): ?>
    <?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['page']); ?>

    <?php else: ?>
    <a href="./?m=admin&a=page_reserve_view&hall_list=<?php echo smarty_modifier_t_escape($this->_tpl_vars['hall_id']); ?>
&reserve_id=<?php echo smarty_modifier_t_escape($this->_tpl_vars['reserve_id']); ?>
&bill_id=<?php echo smarty_modifier_t_escape($this->_tpl_vars['bill_id']); ?>
&virtual_number=<?php echo smarty_modifier_t_escape($this->_tpl_vars['virtual_number']); ?>
&mail=<?php echo smarty_modifier_t_escape($this->_tpl_vars['mail']); ?>
&begin_date=<?php echo smarty_modifier_t_escape($this->_tpl_vars['begin_date']); ?>
&index=<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['index']); ?>
" ><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['page']); ?>
</a>
    <?php endif; ?>
    |
    <?php endforeach; endif; unset($_from); ?>
    <hr>
    <?php $this->assign('val', 1); ?>
    <?php $_from = $this->_tpl_vars['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['item']):
?>
    <?php $this->assign('val', smarty_modifier_t_escape($this->_tpl_vars['val']+1)); ?>

    <table border=1 width=800 >
        <tr>
            <td colspan=4 bgcolor=#CC1111>
                <b><span style="color: #FFFFFF;">
                        □　予約ID : <?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['reserve_id']); ?>
　
                        <?php if ($this->_tpl_vars['item']['long_term'] > 0): ?>
                        -長期予約-
                        <?php endif; ?>
                        □

                    </span></b>
            </td>
        </tr>

        <tr>
            <td bgcolor=#FFD9DC width=100><span style='margin:5px;'>予約日</span></td>
            <td><span style='margin:5px;'><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['tmp_reserve_datetime']); ?>
</span></td>
            <td bgcolor=#FFD9DC width=100><span style='margin:5px;'>承認日</span></td>
            <td><span style='margin:5px;'><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['reserve_datetime']); ?>
</span></td>
        </tr>

        <tr>
            <td bgcolor=#FFD9DC width=100><span style='margin:5px;'>入金期日</span></td>
            <td><span style='margin:5px;'><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['pay_limitdate']); ?>
</span></td>
            <td bgcolor=#FFD9DC width=100><span style='margin:5px;'>入金状態</span></td>
            <td><span style='margin:5px;'>    
                  <?php if ($this->_tpl_vars['item']['tmp_flag'] == 1): ?>
				        <?php if ($this->_tpl_vars['item']['pay_money'] == $this->_tpl_vars['item']['total_price']): ?>
                            入金済み（<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['pay_money']); ?>
円）
                        <?php elseif ($this->_tpl_vars['item']['pay_money'] > $this->_tpl_vars['item']['total_price']): ?>
                            過剰入金(<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['pay_money']); ?>
円)
                        <?php elseif ($this->_tpl_vars['item']['pay_money']): ?>
                            入金済み（<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['pay_money']); ?>
円）
                        <?php else: ?>
                            未入金
                        <?php endif; ?>
                    
                     
                    
					<?php else: ?>
                       <?php if ($this->_tpl_vars['item']['pay_money'] == $this->_tpl_vars['item']['total_price']): ?>
                            入金済み（<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['pay_money']); ?>
円）
                        <?php elseif ($this->_tpl_vars['item']['pay_money'] > $this->_tpl_vars['item']['total_price']): ?>
                            <span style="color:#FF0000;"><b>過剰入金(<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['pay_money']); ?>
円)</b></span>
                        <?php elseif ($this->_tpl_vars['item']['pay_money']): ?>
                            一部入金済み（<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['pay_money']); ?>
円）
                        <?php else: ?>
                            未入金
                        <?php endif; ?>
                    
                      
					<?php endif; ?>
                </span>
            </td>
        </tr>

        <tr>
            <td bgcolor=#FFD9DC><span style='margin:5px;'>予約者</span></td>
            <td width=300><span style='margin:5px;'>
                    <a href="?m=<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
&amp;a=page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('c_member_detail')); ?>
&amp;target_c_member_id=<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['c_member']['c_member_id']); ?>
"><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['c_member']['nickname']); ?>
</a>
                </span>
            </td>
            <td bgcolor=#FFD9DC width=100><span style='margin:5px;'>企業・個人名</span></td>
            <td width=300><span style='margin:5px;'><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['corp']); ?>
</span></td>
        </tr>

        <tr>
            <td bgcolor=#FFD9DC><span style='margin:5px;'>看板</span></td>
            <td colspan="3" width=700><span style='margin:5px;'>
                    <?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['kanban']); ?>

                </span>
            </td>
        </tr>    
        <tr>
            <td bgcolor=#FFD9DC><span style='margin:5px;'>施設名</span></td>
            <td width=300><span style='margin:5px;'><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['hall_data']['hall_name']); ?>
</span></td>
            <td bgcolor=#FFD9DC width=100><span style='margin:5px;'>部屋名</span></td>
            <td width=300><span style='margin:5px;'><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['room_data']['room_name']); ?>
</span></td>
        </tr>

        <tr>
            <td bgcolor=#FFD9DC rowspan=3><span style='margin:5px;'>予約時間</span></td>
            <td rowspan=3><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['datetime']); ?>
<br><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['begin_datetime']); ?>
 ～ <?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['finish_datetime']); ?>
</td>
            <td bgcolor=#FFD9DC><span style='margin:5px;'>利用人数/目的</span></td>
            <td><span style='margin:5px;'><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['people']); ?>
 人　/　

                    <?php if ($this->_tpl_vars['item']['purpose'] == 0): ?>
                    未選択
                    <?php elseif ($this->_tpl_vars['item']['purpose'] == 1): ?>
                    会議
                    <?php elseif ($this->_tpl_vars['item']['purpose'] == 2): ?>
                    セミナー
                    <?php elseif ($this->_tpl_vars['item']['purpose'] == 3): ?>
                    研修
                    <?php elseif ($this->_tpl_vars['item']['purpose'] == 4): ?>
                    面接・試験
                    <?php elseif ($this->_tpl_vars['item']['purpose'] == 5): ?>
                    懇談会・パーティ
                    <?php elseif ($this->_tpl_vars['item']['purpose'] == 6): ?>
                    その他
                    <?php endif; ?>

                </span></td>
        </tr>

        <tr>
            <td bgcolor=#FFD9DC><span style='margin:5px;'>ﾊﾞｰﾁｬﾙ口座</span></td>
            <td><span style='margin:5px;'>
                    <?php if ($this->_tpl_vars['item']['virtual_code']): ?>
                    <?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['virtual_code']); ?>

                    <?php else: ?>
                    固定口座
                    <?php endif; ?>
                </span></td>
        </tr>
        <tr>
            <td bgcolor=#FFD9DC><span style='margin:5px;'>入金日</span></td>
            <td><span style='margin:5px;'>

                    <?php if ($this->_tpl_vars['item']['pay_checkdate']): ?>
                    <?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['pay_checkdate']); ?>

                    <?php else: ?>
                    -- --
                    <?php endif; ?>

                </span></td>
        </tr>

        <tr>
            <td bgcolor=#FFD9DC width=100><span style='margin:5px;'>利用料金</span></td>
            <td colspan=3><span style='margin:5px;'>【部屋利用料：<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['room_price1']); ?>
円】＋【備品利用料：<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['vessel_price1']); ?>
円】＋【サービス利用料：<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['service_price1']); ?>
円】＝【合計請求額：<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['room_price1']+$this->_tpl_vars['item']['vessel_price1']+$this->_tpl_vars['item']['service_price1']); ?>
円】</td>

            <!--
                    <td colspan=3><span style='margin:5px;'>【部屋利用料：<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['room_price']); ?>
円】＋【備品利用料：<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['vessel_price']); ?>
円】＋【サービス利用料：<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['service_price']); ?>
円】＝【合計請求額：<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['total_price']); ?>
円】
            <?php if ($this->_tpl_vars['item']['room_price'] + $this->_tpl_vars['item']['vessel_price'] + $this->_tpl_vars['item']['service_price'] != $this->_tpl_vars['item']['total_price']): ?>
            <font color="red"><b>!合計額 <?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['room_price']+$this->_tpl_vars['item']['vessel_price']+$this->_tpl_vars['item']['service_price']); ?>
円</b></font>
            <?php endif; ?>
            
            </span></td> -->
        </tr>



        <?php if ($this->_tpl_vars['item']['reserve_v_list']): ?>
        <tr>
            <td bgcolor=#FFD9DC width=100 style='vertical-align:middle;'><span style='margin:5px;'>予約備品一覧</span></td>
            <td colspan=3><span style='margin:5px;'>

                    <table style='border: 1px #000000 solid; ' width=100%>
                        <tr>
                            <th style='border: 1px #000000 solid;' bgcolor=#EFEFEF>備品名</th>
                            <th style='border: 1px #000000 solid;' bgcolor=#EFEFEF>予約時単価</th>
                            <th style='border: 1px #000000 solid;' bgcolor=#EFEFEF>数量</th>
                            <th style='border: 1px #000000 solid;' bgcolor=#EFEFEF>備品管理メモ</th>
                        </tr>

                        <?php $_from = $this->_tpl_vars['item']['reserve_v_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
?>
                        <tr>
                            <td style='border: 1px #000000 solid;'><?php echo smarty_modifier_t_escape($this->_tpl_vars['i']['vessel_name']); ?>
</td>
                            <td style='border: 1px #000000 solid;'><?php echo smarty_modifier_t_escape($this->_tpl_vars['i']['price']); ?>
</td>
                            <td style='border: 1px #000000 solid;'><?php echo smarty_modifier_t_escape($this->_tpl_vars['i']['num']); ?>
</td>
                            <td style='border: 1px #000000 solid;'>
                                <?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['i']['memo']))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)))) ? $this->_run_mod_handler('t_url2cmd', true, $_tmp, 'diary', smarty_modifier_t_escape($this->_tpl_vars['member']['c_member_id'])) : smarty_modifier_t_url2cmd($_tmp, 'diary', smarty_modifier_t_escape($this->_tpl_vars['member']['c_member_id']))))) ? $this->_run_mod_handler('t_cmd', true, $_tmp, 'diary') : smarty_modifier_t_cmd($_tmp, 'diary')))) ? $this->_run_mod_handler('t_decoration', true, $_tmp) : smarty_modifier_t_decoration($_tmp)); ?>

                            </td>
                        </tr>
                        <?php endforeach; endif; unset($_from); ?>
                    </table>

                </span></td>
        </tr>
        <?php endif; ?>



        <?php if ($this->_tpl_vars['item']['reserve_s_list']): ?>
        <tr>
            <td bgcolor=#FFD9DC width=100 style='vertical-align:middle;'><span style='margin:5px;'>予約ｻｰﾋﾞｽ一覧</span></td>
            <td colspan=3><span style='margin:5px;'>

                    <table style='border: 1px #000000 solid;' width=100%>
                        <tr>
                            <th style='border: 1px #000000 solid;' bgcolor=#EFEFEF>サービス名</th>
                            <th style='border: 1px #000000 solid;' bgcolor=#EFEFEF>予約時単価</th>
                            <th style='border: 1px #000000 solid;' bgcolor=#EFEFEF>数量</th>
                            <th style='border: 1px #000000 solid;' bgcolor=#EFEFEF>サービス管理メモ</th>
                        </tr>
                        <?php $_from = $this->_tpl_vars['item']['reserve_s_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
?>
                        <tr>
                            <td style='border: 1px #000000 solid;'><?php echo smarty_modifier_t_escape($this->_tpl_vars['i']['service_name']); ?>
</td>
                            <td style='border: 1px #000000 solid;'><?php echo smarty_modifier_t_escape($this->_tpl_vars['i']['price']); ?>
</td>
                            <td style='border: 1px #000000 solid;'><?php echo smarty_modifier_t_escape($this->_tpl_vars['i']['num']); ?>
</td>
                            <td style='border: 1px #000000 solid;'>
                                <?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['i']['memo']))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)))) ? $this->_run_mod_handler('t_url2cmd', true, $_tmp, 'diary', smarty_modifier_t_escape($this->_tpl_vars['member']['c_member_id'])) : smarty_modifier_t_url2cmd($_tmp, 'diary', smarty_modifier_t_escape($this->_tpl_vars['member']['c_member_id']))))) ? $this->_run_mod_handler('t_cmd', true, $_tmp, 'diary') : smarty_modifier_t_cmd($_tmp, 'diary')))) ? $this->_run_mod_handler('t_decoration', true, $_tmp) : smarty_modifier_t_decoration($_tmp)); ?>

                            </td>
                        </tr>
                        <?php endforeach; endif; unset($_from); ?>
                    </table>

                </span>

            </td>
        </tr>
        <?php endif; ?>




        <tr>
            <td bgcolor=#FFD9DC width=100><span style='margin:5px;'>キャンセル料</span></td>
            <td colspan=3>

                <?php if ($this->_tpl_vars['item']['cancel_flag'] == 1): ?>
                <br>
                <span style="font-size:16px;color:#FF0000;"><center><b>キャンセル済み</b></center></span>
                <br>
                <?php elseif ($this->_tpl_vars['item']['complete_flag']): ?>
                <span style="color:#FF0000"><b>完了済み、キャンセル不可</b></span>
                <?php else: ?>
                <?php if ($this->_tpl_vars['item']['cancel_list']['before'] > 0): ?>
                <?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['cancel_list']['before']); ?>
日前　<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['cancel_list']['percent']); ?>
% 徴収<br>
                <?php endif; ?>
                【キャンセルに含む総額：<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['cancel_price1']); ?>
円】=【部屋利用料：<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['room_price1']); ?>
円】＋【備品利用料：<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['vessel_price1']); ?>
円】＋【キャンセル料金に含まれるサービス料：<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['service_price1']); ?>
円】<br>
                
                【キャンセル料：<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['cancel_price']); ?>
円】=【キャンセルに含む総額：<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['room_price1']+$this->_tpl_vars['item']['vessel_price1']+$this->_tpl_vars['item']['service_price1']); ?>
円】-【キャンセル料率：<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['cancel_list']['percent']); ?>
x0.01】<br><br>

                <?php if ($this->_tpl_vars['item']['pay_money'] > $this->_tpl_vars['item']['cancel_price']): ?>
                【返金額：<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['pay_money']-$this->_tpl_vars['item']['cancel_price']); ?>
円】=【入金額】-【キャンセル料】
                <?php else: ?>
                【請求額：<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['cancel_price']-$this->_tpl_vars['item']['pay_money']); ?>
】=【キャンセル料】-【入金額】
                <?php endif; ?>
                <?php endif; ?>
            </td>
        </tr>

        <tr>
            <td bgcolor=#FFD9DC width=100 style='vertical-align:middle;'><span style='margin:5px;'>お客さま<br>メッセージ</span></td>
            <td colspan=3 align=left>
                <?php if ($this->_tpl_vars['item']['message']): ?>
                <?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['message']))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)))) ? $this->_run_mod_handler('t_url2cmd', true, $_tmp, 'diary', smarty_modifier_t_escape($this->_tpl_vars['member']['c_member_id'])) : smarty_modifier_t_url2cmd($_tmp, 'diary', smarty_modifier_t_escape($this->_tpl_vars['member']['c_member_id']))))) ? $this->_run_mod_handler('t_cmd', true, $_tmp, 'diary') : smarty_modifier_t_cmd($_tmp, 'diary')))) ? $this->_run_mod_handler('t_decoration', true, $_tmp) : smarty_modifier_t_decoration($_tmp)); ?>

                <?php else: ?>
        <center>--</center>
        <?php endif; ?>
        </td>
        </tr>

        <tr>
            <td bgcolor=#FFD9DC width=100 style='vertical-align:middle;'><span style='margin:5px;'>社内メモ</span></td>
            <td colspan=3 align=left>
                <?php if ($this->_tpl_vars['item']['memo']): ?>
                <?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['memo']))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)))) ? $this->_run_mod_handler('t_url2cmd', true, $_tmp, 'diary', smarty_modifier_t_escape($this->_tpl_vars['member']['c_member_id'])) : smarty_modifier_t_url2cmd($_tmp, 'diary', smarty_modifier_t_escape($this->_tpl_vars['member']['c_member_id']))))) ? $this->_run_mod_handler('t_cmd', true, $_tmp, 'diary') : smarty_modifier_t_cmd($_tmp, 'diary')))) ? $this->_run_mod_handler('t_decoration', true, $_tmp) : smarty_modifier_t_decoration($_tmp)); ?>

                <?php else: ?>
        <center>--</center>
        <?php endif; ?>
        </td>
        </tr>
        <!-- ADD 20140401-->
        <tr style="position:relative">
            <td bgcolor=#FFD9DC>請求書発行</td>
            <td align="center" style="position:relative" >
                <input type='submit' value='請求書印刷' onclick="showDialog(<?php echo smarty_modifier_t_escape($this->_tpl_vars['val']); ?>
);"> 
                <div style="position:relative">
                    <div style="display: none;background:#fff;height:100px;padding:10px;" class="dialog" id="dialog_<?php echo smarty_modifier_t_escape($this->_tpl_vars['val']); ?>
">
                        <form method='POST' action='./' target='blank' id="frm_<?php echo smarty_modifier_t_escape($this->_tpl_vars['val']); ?>
" >
                            <input type='hidden' name='reserve_id' id='reserve_id' value='<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['reserve_id']); ?>
'>
                            <input type='hidden' name='admin' value='1'>

                            <div id="confirm_<?php echo smarty_modifier_t_escape($this->_tpl_vars['val']); ?>
" >
                                <input type='text' width="200" name='reserve_name' id='reserve_name_<?php echo smarty_modifier_t_escape($this->_tpl_vars['val']); ?>
' >
                                <br /><br />
                                <button onclick="showConfirmPdf(<?php echo smarty_modifier_t_escape($this->_tpl_vars['val']); ?>
);">請求書印刷</button>
                                <input type="reset" onclick="canclePdf(<?php echo smarty_modifier_t_escape($this->_tpl_vars['val']); ?>
)" value="キャンセル">
                            </div>
                        </form>
                    </div>
                </div>

            </td>

            <td bgcolor=#FFD9DC>領収書発行</td>
            <td align="center" style="position:relative" >
                <input type='submit' value='領収書印刷' onclick="showDialogRec(<?php echo smarty_modifier_t_escape($this->_tpl_vars['val']); ?>
);">
                <div style="position:relative">
                    <div style="display: none;background:#fff;height:100px;padding:10px;" class="dialog" id="dialog_rec_<?php echo smarty_modifier_t_escape($this->_tpl_vars['val']); ?>
">
                        <form method='POST' action='./' target='blank' id="frm_rec_<?php echo smarty_modifier_t_escape($this->_tpl_vars['val']); ?>
">
                            <input type='hidden' name='reserve_id' id='reserve_id' value='<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['reserve_id']); ?>
'>
                            <input type='hidden' name='admin' value='1'>

                            <div id="confirm_rec_<?php echo smarty_modifier_t_escape($this->_tpl_vars['val']); ?>
" >
                                <input width="200" type='text' name='reserve_name' id='reserve_name_rec_<?php echo smarty_modifier_t_escape($this->_tpl_vars['val']); ?>
' >
                                <br /><br />
                                <button onclick="showConfirmRec(<?php echo smarty_modifier_t_escape($this->_tpl_vars['val']); ?>
);">領収書印刷</button>
                                <input type="reset" onclick="cancleRec(<?php echo smarty_modifier_t_escape($this->_tpl_vars['val']); ?>
)" value="キャンセル">
                            </div>
                        </form>
                    </div>
                </div>
            </td>
        </tr>


        <!--    <tr>
                <td bgcolor=#FFD9DC>請求書発行</td>
                <td align="center"><form method='POST' action='./atoffice/pages/sub/pdf.php' target='blank'><input type='hidden' name='reserve_id' id='reserve_id' value='<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['reserve_id']); ?>
'><input type='hidden' name='admin' value='1'><input type='submit' value='請求書印刷'></form></td>
        
                <td bgcolor=#FFD9DC>領収書発行</td>
                <td align="center"><form method='POST' action='./atoffice/pages/sub/receipt.php' target='blank'><input type='hidden' name='reserve_id' id='reserve_id' value='<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['reserve_id']); ?>
'><input type='hidden' name='admin' value='1'><input type='submit' value='領収書印刷'></form></td>
        
                </tr> -->

        <tr>
            <td bgcolor=#FFD9DC>予約修正</td>
            <td colspan=3>
        <center>
            <input type="reset" value="　修　正　" onclick="smRevision(<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['reserve_id']); ?>
)">


        </center>
        </td>
        </tr>


    </table>
    <br>
    <?php endforeach; else: ?>
    該当するデータはありませんでした。
    <?php endif; unset($_from); ?>

    <hr>
    <?php $_from = $this->_tpl_vars['page_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
    <?php if ($this->_tpl_vars['item']['select']): ?>
    <?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['page']); ?>

    <?php else: ?>
    <a href="./?m=admin&a=page_reserve_view&hall_list=<?php echo smarty_modifier_t_escape($this->_tpl_vars['hall_id']); ?>
&reserve_id=<?php echo smarty_modifier_t_escape($this->_tpl_vars['reserve_id']); ?>
&bill_id=<?php echo smarty_modifier_t_escape($this->_tpl_vars['bill_id']); ?>
&virtual_number=<?php echo smarty_modifier_t_escape($this->_tpl_vars['virtual_number']); ?>
&mail=<?php echo smarty_modifier_t_escape($this->_tpl_vars['mail']); ?>
&begin_date=<?php echo smarty_modifier_t_escape($this->_tpl_vars['begin_date']); ?>
&index=<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['index']); ?>
" ><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['page']); ?>
</a>
    <?php endif; ?>
    |

    <?php endforeach; endif; unset($_from); ?>

</center>
<?php else: ?>
<br>
<center>
    <span style="font-size: 16px; color: #FF0033;"><b>アクセス権がありません。</b></span>
</center>
<?php endif; ?>
<div id="overlay" class="web_dialog_overlay" onclick="return closeAll()">
    <input hidden="" value="" id="dialog_id">

<?php echo $this->_tpl_vars['inc_footer']; ?>




<script>
            function closeAll()
            {
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
    /*Hainhl change code*/
    function showConfirmPdf(id)
    {
    var txt = document.getElementById('reserve_name_' + id).value;
            var confirm = document.getElementById('confirm_' + id);
            var texts = '<p>' + txt + '</p><br>';
            texts += '<input type="hidden" width="200" name="reserve_name" id="reserve_name_rec_' + id + '" value="' + txt + '" >';
            texts += '<input type="submit" value="請求書印刷" onclick="closeAllPdf(' + id + ');">&nbsp;&nbsp;';
            texts += '<input type="reset" onclick="canclePdf(' + id + ')"value="キャンセル">';
            confirm.innerHTML = texts;
    }
    /*Hainhl change code*/
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
            texts += '<input type="submit" value="領収書印刷" onclick="closeAllPdf(' + id + ');">&nbsp;&nbsp;';
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
            var txt_2 = '';
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
            var texts = '<p>請求書印刷</p><br/><br/>';
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
    texts += '<p>請求書印刷<br/><br/>';
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
            texts += '<p>領収書印刷</p><br/>';
            texts += '<input type="hidden" style="padding:5px" width="200" name="reserve_name" id="reserve_name_rec_' + id + '" value="">';
    }

    texts += '<input type="submit" style="padding:5px" value="印刷" onclick="closeAllRec(' + id + ')">&nbsp;&nbsp;';
            texts += '<input type="reset" style="padding:5px" onclick="showFormRecExtent_2(' + id + ',\'' + txt_2 + '\')" value="戻る">';
            confirm.innerHTML = texts;
    }


    function showCollect(id)
    {
    showCollectExtent(id);
            var overlay = document.getElementById("overlay");
            overlay.style.display = "block";
            var dialog = document.getElementById('dialog_collect');
            dialog.style.display = "block";
    }
    function addFormCollect(id)
    {
    switch (id)
    {
    case 1:
            var confirm = document.getElementById('confirm_collect');
            var texts = '<p>宛名の変更</p><br/>';
            texts += '<input type="text" width="200" name="reserve_name" id="reserve_collect" value="" > <br /><br />';
            texts += '<button onclick="showCollectExtent(' + id + ')">まとめて請求書</button>&nbsp;&nbsp;';
            texts += '<input type="reset" onclick="cancleCollect()" value="キャンセル">';
            confirm.innerHTML = texts;
            break;
            case 2:
            var confirm = document.getElementById('confirm_collect');
            var texts = '<p>宛名の変更</p><br/>';
            texts += '<input type="text" width="200" name="reserve_name" id="reserve_collect" value="" > <br /><br />';
            texts += '<button onclick="showCollectExtent(' + id + ')">まとめて領収書</button>&nbsp;&nbsp;';
            texts += '<input type="reset" onclick="cancleCollect()" value="キャンセル">';
            confirm.innerHTML = texts;
            break;
    }
    return false;
    }
    function showConfirmCollect(id)
    {
    var txt = document.getElementById('reserve_collect').value;
            var confirm = document.getElementById('confirm_collect');
            switch (id)
    {
    case 1:
            var texts = '<p>' + txt + '</p><br>';
            texts += '<input type="hidden" width="200" name="reserve_name" id="reserve_collect" value="' + txt + '" >';
            texts += '<input type="submit" name="bill" value="まとめて請求書" onclick="smtCollect()">&nbsp;&nbsp;';
            texts += '<input type="reset" onclick="cancleCollect()" value="キャンセル">&nbsp;&nbsp;';
            texts += '<input type="hidden" name="bill" value="まとめて請求書"> ';
            confirm.innerHTML = texts;
            break;
            case 2:
            var texts = '<p>' + txt + '</p><br>';
            texts += '<input type="hidden" width="200" name="reserve_name" id="reserve_collect" value="' + txt + '" >';
            texts += '<INPUT type="submit" name="receipt" value="まとめて領収書" onclick="smtCollect()">&nbsp;&nbsp;';
            texts += '<input type="reset" onclick="cancleCollect()" value="キャンセル">';
            texts += '<INPUT type="hidden" name="receipt" value="まとめて領収書">';
            confirm.innerHTML = texts;
            break;
    }


    }
    function cancleConfirmCollect(id, txt)
    {
    var confirm = document.getElementById('confirm_collect');
            switch (id)
    {
    case 1:
            var texts = '<input type="text" width="200" name="reserve_name" id="reserve_collect" value="' + txt + '" > <br /><br />';
            texts += '<input type="submit" name="bill" value="まとめて請求書" onclick="smtCollect()"> ';
            texts += '<input type="reset" onclick="cancleCollect()" value="キャンセル">';
            texts += '<input type="hidden" name="bill" value="まとめて請求書"> ';
            confirm.innerHTML = texts;
            break;
            case 2:
            var texts = '<input type="text" width="200" name="reserve_name" id="reserve_collect" value="' + txt + '" > <br /><br />';
            texts += '<INPUT type="submit" name="receipt" value="まとめて領収書" onclick="smtCollect()">';
            texts += '<input type="reset" onclick="cancleCollect()" value="キャンセル">';
            texts += '<INPUT type="hidden" name="receipt" value="まとめて領収書">';
            confirm.innerHTML = texts;
            break;
    }
    }
    function smtCollect(){
    var frm = document.getElementById('frmColect').submit();
            closeCollect();
    }
    function closeCollect()
    {
    var overlay = document.getElementById("overlay");
            overlay.style.display = "none";
            var dialog = document.getElementById('dialog_collect');
            dialog.style.display = "none";
    }
    function cancleCollect()
    {
    closeCollect();
            return false;
    }
    function smRevision(reserve_id)
    {
    var frm = document.getElementById('frm_revision');
            document.getElementById('reserve_id').value = reserve_id;
            frm.submit();
    }

    function showCollectExtent(id)
    {
    var confirm = document.getElementById('confirm_collect');
            var dialog = document.getElementById('dialog_collect');
            dialog.style.height = "90px";
            var txt_2 = '';
            switch (id)
    {
    case 1:
            var texts = '<p>請求書印刷</p><br/>';
            texts += '<input type="submit" name="bill" style="padding:5px" value="印刷" onclick="smtCollect();">&nbsp;&nbsp;';
            texts += '<input type="reset" style="padding:5px" value="宛名を変えて印刷" onclick="showFormCollectExtent(' + id + ');">&nbsp;&nbsp;';
            texts += '<input type="reset" style="padding:5px" onclick="cancleCollect()" value="キャンセル">';
            texts += '<input type="hidden" name="bill" value="まとめて請求書"> ';
            confirm.innerHTML = texts;
            break;
            case 2:
            var texts = '<p>領収書印刷</p><br/>';
            texts += '<input type="submit" name="receipt" style="padding:5px" value="印刷" onclick="smtCollect();">&nbsp;&nbsp;';
            texts += '<input type="reset" style="padding:5px" value="宛名を変えて印刷" onclick="showFormCollectExtent(' + id + ');">&nbsp;&nbsp;';
            texts += '<input type="reset" style="padding:5px" onclick="cancleCollect()" value="キャンセル">';
            texts += '<INPUT type="hidden" name="receipt" value="まとめて領収書">';
            confirm.innerHTML = texts;
            break;
    }


    }
    function showFormCollectExtent(id)
    {
    var confirm = document.getElementById('confirm_collect');
            var dialog = document.getElementById('dialog_collect');
            dialog.style.height = "120px";
            switch (id)
    {
    case 1:
            var texts = '<p>請求書印刷</p><br/><br/>';
            texts += ' <input type="text" style="padding:5px" width="200" name="reserve_name" id="reserve_collect_2" value=""><br/><br/>';
            texts += '<input type="reset" style="padding:5px" value="印刷" onclick="showConfirmCollectExtent(' + id + ');">&nbsp;&nbsp;';
            texts += '<input type="reset" style="padding:5px" onclick="cancleCollect()" value="キャンセル">';
            texts += '<input type="hidden" name="bill" value="まとめて請求書"> ';
            confirm.innerHTML = texts;
            break;
            case 2:
            var texts = '<p>領収書印刷</p><br/><br/>';
            texts += ' <input type="text" style="padding:5px" width="200" name="reserve_name" id="reserve_collect_2" value=""><br/><br/>';
            texts += '<input type="reset" style="padding:5px" value="印刷" onclick="showConfirmCollectExtent(' + id + ');">&nbsp;&nbsp;';
            texts += '<input type="reset" style="padding:5px" onclick="cancleCollect()" value="キャンセル">';
            texts += '<INPUT type="hidden" name="receipt" value="まとめて領収書">';
            confirm.innerHTML = texts;
            break;
    }
    }
    function showFormCollectExtent_2(id, txt_2)
    {
    var confirm = document.getElementById('confirm_collect');
            var dialog = document.getElementById('dialog_collect');
            dialog.style.height = "120px";
            switch (id)
    {
    case 1:
            var texts = '<p>請求書印刷</p><br/><br/>';
            texts += ' <input type="text" style="padding:5px" width="200" name="reserve_name" id="reserve_collect_2" value="' + txt_2 + '"><br/><br/>';
            texts += '<input type="reset" style="padding:5px" value="印刷" onclick="showConfirmCollectExtent(' + id + ');">&nbsp;&nbsp;';
            texts += '<input type="reset" style="padding:5px" onclick="cancleCollect()" value="キャンセル">';
            texts += '<input type="hidden" name="bill" value="まとめて請求書"> ';
            confirm.innerHTML = texts;
            break;
            case 2:
            var texts = '<p>領収書印刷</p><br/><br/>';
            texts += ' <input type="text" style="padding:5px" width="200" name="reserve_name" id="reserve_collect_2" value="' + txt_2 + '"><br/><br/>';
            texts += '<input type="reset" style="padding:5px" value="印刷" onclick="showConfirmCollectExtent(' + id + ');">&nbsp;&nbsp;';
            texts += '<input type="reset" style="padding:5px" onclick="cancleCollect()" value="キャンセル">';
            texts += '<INPUT type="hidden" name="receipt" value="まとめて領収書">';
            confirm.innerHTML = texts;
            break;
    }
    }
    function showConfirmCollectExtent(id)
    {
    var confirm = document.getElementById('confirm_collect');
            var dialog = document.getElementById('dialog_collect');
            dialog.style.height = "120px";
            var txt_2 = document.getElementById('reserve_collect_2').value;
            var texts = '';
            switch (id)
    {
    case 1:
            if (txt_2){
    texts += '<p>請求書印刷<br/><br/>';
            texts += txt_2 + '<br/><br/>';
            texts += '上記でいいですか？';
            texts += '  </p><br>';
            texts += ' <input type="hidden" style="padding:5px" width="200" name="reserve_name" id="reserve_collect" value="' + txt_2 + '">';
    }
    else{
    dialog.style.height = "90px";
            texts += '<p>請求書印刷</p><br/>';
            texts += '<input type="hidden" style="padding:5px" width="200" name="reserve_name" id="reserve_collect" value="">';
    }
    texts += '<input style="padding:5px" type="submit" name="bill" value="印刷" onclick="smtCollect()">&nbsp;&nbsp;';
            texts += '<input style="padding:5px" type="reset" onclick="showFormCollectExtent_2(' + id + ',\'' + txt_2 + '\')" value="戻る">&nbsp;&nbsp;';
            texts += '<input type="hidden" name="bill" value="まとめて請求書"> ';
            confirm.innerHTML = texts;
            break;
            case 2:
            if (txt_2){
    texts += '<p>領収書印刷<br/><br/>';
            texts += txt_2 + '<br/><br/>';
            texts += '上記でいいですか？';
            texts += '  </p><br>';
            texts += ' <input type="hidden" style="padding:5px" width="200" name="reserve_name" id="reserve_collect" value="' + txt_2 + '">';
    }
    else{
    dialog.style.height = "90px";
            texts += '<p>領収書印刷</p><br/>';
            texts += '<input type="hidden" style="padding:5px" width="200" name="reserve_name" id="reserve_collect" value="">';
    }
    texts += '<INPUT style="padding:5px"  type="submit" name="receipt" value="印刷" onclick="smtCollect()">&nbsp;&nbsp;';
            texts += '<input style="padding:5px" type="reset" onclick="showFormCollectExtent_2(' + id + ',\'' + txt_2 + '\')" value="戻る">';
            texts += '<INPUT type="hidden" name="receipt" value="まとめて領収書">';
            confirm.innerHTML = texts;
            break;
    }


    }



</script>