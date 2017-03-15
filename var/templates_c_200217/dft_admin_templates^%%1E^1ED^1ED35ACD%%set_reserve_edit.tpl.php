<?php /* Smarty version 2.6.18, created on 2016-10-27 11:22:50
         compiled from file:/var/www/atoffice/webapp/modules/admin/templates/set_reserve_edit.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'ext_include', 'file:/var/www/atoffice/webapp/modules/admin/templates/set_reserve_edit.tpl', 2, false),array('modifier', 't_escape', 'file:/var/www/atoffice/webapp/modules/admin/templates/set_reserve_edit.tpl', 13, false),array('modifier', 'substr', 'file:/var/www/atoffice/webapp/modules/admin/templates/set_reserve_edit.tpl', 400, false),)), $this); ?>
<?php echo $this->_tpl_vars['inc_header']; ?>

<?php echo smarty_function_ext_include(array('file' => "inc_subnavi_adminSiteMember.tpl"), $this);?>

<?php $this->assign('page_name', "予約入力"); ?>
<?php echo smarty_function_ext_include(array('file' => "inc_tree_adminSiteMember.tpl"), $this);?>

</div>


<?php if ($this->_tpl_vars['atoffice_auth_type'] == 2 || $this->_tpl_vars['atoffice_auth_type'] == 4): ?>

<script type="text/javascript">
    var pre_id="<?php echo smarty_modifier_t_escape($this->_tpl_vars['pre_id']); ?>
";
    var tryingToReload = true;
    window.onbeforeunload = function(e) //on before unload
    {
        if (!e) //Firefox and Safari gets argument directly.
        {
            e = window.event; // this is for IE
        }
    
        if (e.clientY != undefined && e.clientY < 0) // clicked on the close   button for IE
        {
             tryingToReload = true;
        }
        
        if (e.clientY != undefined && (e.clientY > 100 && e.clientY < 140)) //    select close from context menu from the right click on title bar on IE
        {
            tryingToReload = true;
        }
        console.log(tryingToReload);
        if (tryingToReload)
        {
            e = e || window.event;
            var url="?m=admin&a=page_clear_reserve&pid="+pre_id;
            var post=null;
            var xmlHttp = new XMLHttpRequest();
        	xmlHttp.open("POST", url, false);
        	xmlHttp.setRequestHeader("Content-Type" , "application/x-www-form-urlencoded;charset=UTF-8");
        	xmlHttp.send(post);
            
            return ;
        }
    }
    document.onkeydown = function(e) //attach to key down event to detect the F5 key
    {
        if (!e) //Firefox and Safari gets argument directly.
        {
            e = window.event;
        }
        tryingToReload=true;
        var key = e.keyCode ? e.keyCode : e.which;
        
        try //try
        {
               switch (key){
                  case 116 : //F5 button
                      tryingToReload=false;break;
                  case 82 : //R button
                          if (event.ctrlKey){ 
                             tryingToReload=false;break;
                          }
                    }
        }
        catch (ex) { }
        }

    document.oncontextmenu = function(e) //check for the right click
    {
        
        var srcElement = getEventSrc(e);
        tryingToReload=true;
        var tagName = '';
        if (srcElement.tagName != undefined) //Get the name of the tag
        {
            tagName = srcElement.tagName;
        }
        switch (tagName)
        {
            case "BODY":
            case "TD":
            case "DIV":
            case "CENTER":
            {
                tryingToReload = false;
                break;
            }
            default:
            break;
        }
    }

    function getEventSrc(e)
    {
        if (this.Event)
        {
        var targ = e.target;
        //nodeType of 1 means ELEMENT_NODE
          return targ.nodeType == 1 ? targ : targ.parentNode;
        }
        else //this is for IE
         return event.srcElement;
    }

    document.onclick = function(e) 
    {
        tryingToReload = false;
    }
        
    function linecheck(line) {
        var mode = (document.getElementById('sd' + line + '_0').checked) ? false : true;
        for (var i = 0; i < 100; i++) {
            var a = document.getElementById('sd' + line + '_' + i);
            if (a == null)
                break;
            a.checked = mode;
        }
    }

    function setRoomID(room_id) 
	{
        document.forms["reserve"].elements["room_id"].value = room_id;
        document.forms["reserve"].elements["a"].value = "page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('set_reserve_edit','page')); ?>
";
        return true;
    }
    function setYMD(y, m, d) {
        document.forms["reserve"].elements["year"].value = y;
        document.forms["reserve"].elements["month"].value = m;
        document.forms["reserve"].elements["day"].value = d;
        document.forms["reserve"].elements["a"].value = "page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('set_reserve_edit','page')); ?>
";
        return true;
    }

</script>

<style type="text/css">
    <!--
    HR {
        border-style:dotted;color:#3399FF

    }
    -->
</style>

<h2 id="ttl01">予約入力</h2>
<br>
<center>

    <?php if ($this->_tpl_vars['msg2']): ?><p class="actionMsg"><?php echo smarty_modifier_t_escape($this->_tpl_vars['msg2']); ?>
</p>
       <form name="change_date1" method="POST" action="./" id='frmBack'>
            <input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
            <input type="hidden" name="a" value="page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('set_reserve_edit','page')); ?>
" />
            <input type="hidden" name="hall_list" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['hall_id']); ?>
">
            <input type="hidden" name="year" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['year']); ?>
">
            <input type="hidden" name="month" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['month']); ?>
">
            <input type="hidden" name="day" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['day']); ?>
">
            <input type="hidden" name="pre_id" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['pre_id']); ?>
">
            <input type="hidden" name="pid" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['pid']); ?>
">
                        
           <INPUT TYPE=button VALUE="　戻る　" style="width:250px;font:20px;border:3px ridge;background:#090;color:#fff; padding:3px; font-weight:bold;" onClick="this.form.submit()">
   
        </form>
     </form>
    <?php else: ?>
    <?php if ($this->_tpl_vars['msg']): ?><p class="actionMsg"><?php echo smarty_modifier_t_escape($this->_tpl_vars['msg']); ?>
</p><?php endif; ?>
    <br><br>


    <table border=1>
        <tr>
        <form name="change_hall_id" method="POST" action="./">
            <input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
            <input type="hidden" name="a" value="page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('set_reserve_edit','page')); ?>
" />
            <input type="hidden" name="pre_id" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['pre_id']); ?>
">
            <input type="hidden" name="member" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['member']); ?>
">
            <input type="hidden" name="pid" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['pid']); ?>
">
            <td>会場選択</td>
            <td>

                <select name="hall_list">
                    <?php $_from = $this->_tpl_vars['hall_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
                    <option value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['hall_id']); ?>
" 
                            <?php if ($this->_tpl_vars['item']['hall_id'] == $this->_tpl_vars['hall_id']): ?>
                            selected="selected"
                            <?php endif; ?>
                            >
                        <?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['hall_name']); ?>
</option>
                    <?php endforeach; endif; unset($_from); ?>
                </select>
            </td><td rowspan=2 style="vertical-align:middle">
                <input type="submit" value="　変更　">
            </td>
            </tr>

            <tr>
                <td>日付変更</td>
                <td>
                    <select name="year">
                        <option value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['this_year']); ?>
" <?php if ($this->_tpl_vars['this_year'] == $this->_tpl_vars['year']): ?>selected<?php endif; ?>><?php echo smarty_modifier_t_escape($this->_tpl_vars['this_year']); ?>
</option>
                        <option value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['this_year']+1); ?>
" <?php if ($this->_tpl_vars['this_year'] + 1 == $this->_tpl_vars['year']): ?>selected<?php endif; ?>><?php echo smarty_modifier_t_escape($this->_tpl_vars['this_year']+1); ?>
</option>
                    </select> 年 
                    <select name="month">
                        <?php $_from = $this->_tpl_vars['month_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
                        <option value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']); ?>
" <?php if ($this->_tpl_vars['item'] == $this->_tpl_vars['month']): ?>selected<?php endif; ?>><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']); ?>
</option>
                        <?php endforeach; endif; unset($_from); ?>
                    </select> 月 
                    <select name="day">
                        <?php $_from = $this->_tpl_vars['day_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                        <option value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']); ?>
" <?php if ($this->_tpl_vars['item'] == $this->_tpl_vars['day']): ?>selected<?php endif; ?>><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']); ?>
(<?php echo smarty_modifier_t_escape($this->_tpl_vars['week_list'][$this->_tpl_vars['key']]); ?>
)</option>
                        <?php endforeach; endif; unset($_from); ?>
                    </select> 日 
                </td>
        </form>
        </tr>

        <tr>
            <td>
                <form name="change_date1" method="POST" action="./">
                    <input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
                    <input type="hidden" name="a" value="page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('set_reserve_edit','page')); ?>
" />
                    <input type="hidden" name="hall_list" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['hall_id']); ?>
">
                    <input type="hidden" name="year" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['year']); ?>
">
                    <input type="hidden" name="month" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['month']); ?>
">
                    <input type="hidden" name="day" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['day']-1); ?>
">
                    <input type="hidden" name="pre_id" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['pre_id']); ?>
">
                    <input type="hidden" name="member" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['member']); ?>
">
                    <input type="hidden" name="pid" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['pid']); ?>
">
                    <input type="submit" value="←前日">
                </form>
            </td>

            <td>
                <form name="change_date1" method="POST" action="./">
                    <input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
                    <input type="hidden" name="a" value="page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('set_reserve_edit','page')); ?>
" />
                    <input type="hidden" name="hall_list" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['hall_id']); ?>
">
                    <input type="hidden" name="pre_id" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['pre_id']); ?>
">
                    <input type="hidden" name="member" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['member']); ?>
">
                    <input type="hidden" name="pid" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['pid']); ?>
">
                    <input type="submit" value="今日">
                </form>
            </td>

            <td>
                <form name="change_date1" method="POST" action="./">
                    <input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
                    <input type="hidden" name="a" value="page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('set_reserve_edit','page')); ?>
" />
                    <input type="hidden" name="hall_list" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['hall_id']); ?>
">
                    <input type="hidden" name="year" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['year']); ?>
">
                    <input type="hidden" name="month" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['month']); ?>
">
                    <input type="hidden" name="day" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['day']+1); ?>
">
                    <input type="hidden" name="pre_id" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['pre_id']); ?>
"> 
                    <input type="hidden" name="member" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['member']); ?>
">
                    <input type="hidden" name="pid" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['pid']); ?>
">                   
                    <input type="submit" value="翌日→">
                </form>
            </td>
        </tr>

        <tr>
            <td>利用予定人数</td>
            <td colspan=2>
                <form name="reserve" method="POST" action="./">
                    <input type="hidden" name="pre_id" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['pre_id']); ?>
">
                    <input type="hidden" name="pid" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['pid']); ?>
">
                    <input type="hidden" name="edit" value="1">
                    <input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
                    <input type="hidden" name="set_reserve" value="1">
                    <input type="hidden" name="a" value="page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('set_reserve_vessel','page')); ?>
" />
                    <input type="hidden" name="hall_list" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['hall_id']); ?>
">
                    <input type="text" name="people" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['people']); ?>
"> 人 
                    </td>
                    </tr>
                    <tr>
                        <td>利用目的</td>
                        <td colspan=2>
                            <select name="purpose">
                                <option value="0" <?php if ($this->_tpl_vars['purpose'] == 0): ?>selected="selected"<?php endif; ?>>--未選択--</option>
                                <option value="1" <?php if ($this->_tpl_vars['purpose'] == 1): ?>selected="selected"<?php endif; ?>>会議</option>
                                <option value="2" <?php if ($this->_tpl_vars['purpose'] == 2): ?>selected="selected"<?php endif; ?>>セミナー</option>
                                <option value="3" <?php if ($this->_tpl_vars['purpose'] == 3): ?>selected="selected"<?php endif; ?>>研修</option>
                                <option value="4" <?php if ($this->_tpl_vars['purpose'] == 4): ?>selected="selected"<?php endif; ?>>面接・試験</option>
                                <option value="5" <?php if ($this->_tpl_vars['purpose'] == 5): ?>selected="selected"<?php endif; ?>>懇談会・パーティ</option>
                                <option value="6" <?php if ($this->_tpl_vars['purpose'] == 6): ?>selected="selected"<?php endif; ?>>その他</option>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td>顧客ID番号</td>
                        <td colspan=2>
                            <input type="text" name="c_member_id" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['member']); ?>
"><br>
                            ※ 新規の場合は未入力
                        </td>
                    </tr>
                    <?php if (! $this->_tpl_vars['periodmode']): ?>
                    <tr>
                        <td>表示日数</td>
                        <td colspan=2>
                            <select name="period">
                                <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['start'] = (int)1;
$this->_sections['i']['loop'] = is_array($_loop=32) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['i']['step'] = ((int)1) == 0 ? 1 : (int)1;
$this->_sections['i']['show'] = true;
$this->_sections['i']['max'] = $this->_sections['i']['loop'];
if ($this->_sections['i']['start'] < 0)
    $this->_sections['i']['start'] = max($this->_sections['i']['step'] > 0 ? 0 : -1, $this->_sections['i']['loop'] + $this->_sections['i']['start']);
else
    $this->_sections['i']['start'] = min($this->_sections['i']['start'], $this->_sections['i']['step'] > 0 ? $this->_sections['i']['loop'] : $this->_sections['i']['loop']-1);
if ($this->_sections['i']['show']) {
    $this->_sections['i']['total'] = min(ceil(($this->_sections['i']['step'] > 0 ? $this->_sections['i']['loop'] - $this->_sections['i']['start'] : $this->_sections['i']['start']+1)/abs($this->_sections['i']['step'])), $this->_sections['i']['max']);
    if ($this->_sections['i']['total'] == 0)
        $this->_sections['i']['show'] = false;
} else
    $this->_sections['i']['total'] = 0;
if ($this->_sections['i']['show']):

            for ($this->_sections['i']['index'] = $this->_sections['i']['start'], $this->_sections['i']['iteration'] = 1;
                 $this->_sections['i']['iteration'] <= $this->_sections['i']['total'];
                 $this->_sections['i']['index'] += $this->_sections['i']['step'], $this->_sections['i']['iteration']++):
$this->_sections['i']['rownum'] = $this->_sections['i']['iteration'];
$this->_sections['i']['index_prev'] = $this->_sections['i']['index'] - $this->_sections['i']['step'];
$this->_sections['i']['index_next'] = $this->_sections['i']['index'] + $this->_sections['i']['step'];
$this->_sections['i']['first']      = ($this->_sections['i']['iteration'] == 1);
$this->_sections['i']['last']       = ($this->_sections['i']['iteration'] == $this->_sections['i']['total']);
?>
                                <option value="<?php echo smarty_modifier_t_escape($this->_sections['i']['index']); ?>
"
                                        <?php if ($this->_sections['i']['index'] == $this->_tpl_vars['period']): ?> selected<?php endif; ?>
                                        ><?php echo smarty_modifier_t_escape($this->_sections['i']['index']); ?>
</option>
                                <?php endfor; endif; ?>
                            </select> ※部屋の「日付範囲表示」で表示される日数

                        </td>
                    </tr>
                    <?php endif; ?>

    </table>
    <br>



    <table width=100%>
        <tr>
            <td height=60px bgcolor=#CCCCFF style='border: 1px #000000 solid;text-align:center;vertical-align:middle;font-size:15px;'>
                <b><?php echo smarty_modifier_t_escape($this->_tpl_vars['hall_data']['hall_name']); ?>
 
                    <?php if ($this->_tpl_vars['periodmode']): ?>
                    <?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data']['room_name']); ?>
 (<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data']['max']); ?>
人)<br>
                    <?php if ($this->_tpl_vars['room_data']['type'] == 2): ?>最低<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data']['lowest_koma']); ?>
コマ以上<?php endif; ?>
                    <?php else: ?>
                    <?php echo smarty_modifier_t_escape($this->_tpl_vars['year']); ?>
年<?php echo smarty_modifier_t_escape($this->_tpl_vars['month']); ?>
月<?php echo smarty_modifier_t_escape($this->_tpl_vars['day']); ?>
日（<?php echo smarty_modifier_t_escape($this->_tpl_vars['week']); ?>
）</b>
                <?php endif; ?>
                <input type="submit" value="備品選択へ">
                <input type="hidden" name="year" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['year']); ?>
">
                <input type="hidden" name="month" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['month']); ?>
">
                <input type="hidden" name="day" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['day']); ?>
">
                <input type="hidden" name="hid" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['hall_id']); ?>
">
                <input type="hidden" name="pre_id" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['pre_id']); ?>
">
            </td>
        </tr>
    </table>
    <table width=100%>

        <?php $this->assign('line', 0); ?>

        <?php if ($this->_tpl_vars['periodmode']): ?>
                <input type="hidden" name="room_id" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_id']); ?>
">
        <?php $_from = $this->_tpl_vars['period_data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['value']):
?>
        <?php if (( $this->_tpl_vars['line'] % 5 ) == 0): ?>
        <tr>
            <th style='border: 1px #000000 solid;text-align: center;' width="150">
                日付

            </th>
            <th></th>

            <?php $_from = $this->_tpl_vars['open_time']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['time']):
?>

            <th bgcolor=#CDCDCD style='border: 1px #000000 solid;text-align: center;' colspan=4><b>
                    <?php echo smarty_modifier_t_escape($this->_tpl_vars['time']); ?>
:00 ～ <?php echo smarty_modifier_t_escape($this->_tpl_vars['time']+1); ?>
:00
                </b></th>
            <?php endforeach; endif; unset($_from); ?>
        </tr>
        <?php endif; ?>
        <?php $this->assign('cb', 0); ?>

        <tr>
            <td style='border: 1px #000000 solid;text-align: center;' >
                <b><?php echo smarty_modifier_t_escape($this->_tpl_vars['value']['year']); ?>
年<?php echo smarty_modifier_t_escape($this->_tpl_vars['value']['month']); ?>
月<?php echo smarty_modifier_t_escape($this->_tpl_vars['value']['day']); ?>
日（<?php echo smarty_modifier_t_escape($this->_tpl_vars['value']['week']); ?>
）</b><br />
                <?php if ($this->_tpl_vars['room_data']['type'] == 2): ?>最低<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data']['lowest_koma']); ?>
コマ以上<?php endif; ?><br />
                <input type="submit" value="この日を表示" onClick="setYMD(<?php echo smarty_modifier_t_escape($this->_tpl_vars['value']['year']); ?>
, <?php echo smarty_modifier_t_escape($this->_tpl_vars['value']['month']); ?>
, <?php echo smarty_modifier_t_escape($this->_tpl_vars['value']['day']); ?>
)">
            </td>
            <td><input type="button" value=">>" onClick="linecheck(<?php echo smarty_modifier_t_escape($this->_tpl_vars['line']); ?>
)"></td>
            <?php if ($this->_tpl_vars['value']['holiday']): ?>
            <td colspan=<?php echo smarty_modifier_t_escape($this->_tpl_vars['ct']*4); ?>
 style='border: 1px #000000 solid;text-align: center;' bgcolor=#FF6666><b>休室日</b></td>
        </tr>
        <?php else: ?>
       
        <?php if ($this->_tpl_vars['room_data']['type'] == 2): ?>
        <?php $_from = $this->_tpl_vars['value']['opentime']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
        
        <td style='border: 1px #000000 solid;text-align: center;vertical-align:middle;' colspan=<?php echo smarty_modifier_t_escape($this->_tpl_vars['v']['cs']); ?>
 
            <?php if ($this->_tpl_vars['v']['reserved']): ?>
            bgcolor=#FFDCDC><span style='color:#FF0000;'><b>
                    <a href="?m=<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
&amp;a=page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('reserve_view')); ?>
&amp;reserve_id=<?php echo smarty_modifier_t_escape($this->_tpl_vars['v']['reserved']); ?>
">
                        予約ID:<?php echo smarty_modifier_t_escape($this->_tpl_vars['v']['reserved']); ?>
</a><br>
                    代表名：<?php echo smarty_modifier_t_escape($this->_tpl_vars['v']['corp']); ?>
<br>
                    予約者：<?php echo smarty_modifier_t_escape($this->_tpl_vars['v']['c_member']['nickname']); ?>
 様<br>
                    状態：
                    <?php if ($this->_tpl_vars['v']['reserve_data']['tmp_flag'] == 1): ?>
                    仮予約
                    <?php elseif ($this->_tpl_vars['v']['reserve_data']['pay_flag'] == 0 && $this->_tpl_vars['v']['reserve_data']['pay_money'] == 0): ?>
                    未入金
                    <?php elseif ($this->_tpl_vars['v']['reserve_data']['pay_flag'] == 0 && $this->_tpl_vars['v']['reserve_data']['pay_money'] > 0): ?>
                    一部入金
                    <?php elseif ($this->_tpl_vars['v']['reserve_data']['pay_flag'] == 1): ?>
                    入金済み
                    <?php endif; ?>
                </b></span>
            <?php elseif ($this->_tpl_vars['v']['stoped']): ?>
            bgcolor=#FFCCFF>貸し止め中<br>
            有効期限：<?php echo smarty_modifier_t_escape($this->_tpl_vars['v']['stoped']['limit_datetime']); ?>
<br>
            担当者：<?php echo smarty_modifier_t_escape($this->_tpl_vars['v']['stoped']['admin_name']); ?>
<br>
            <?php echo smarty_modifier_t_escape($this->_tpl_vars['v']['stoped']['memo']); ?>
<br>
            <?php $this->assign('start', ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['v']['begin_time']))) ? $this->_run_mod_handler('substr', true, $_tmp, 0, 2) : substr($_tmp, 0, 2))); ?>
            <?php $this->assign('end', ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['v']['finish_time']))) ? $this->_run_mod_handler('substr', true, $_tmp, 0, 2) : substr($_tmp, 0, 2))); ?>
            予約：<input  <?php if (( $this->_tpl_vars['value']['room_id'] == $this->_tpl_vars['room_edit'] && $this->_tpl_vars['start'] >= $this->_tpl_vars['start_time'] && $this->_tpl_vars['end'] <= $this->_tpl_vars['end_time'] )): ?> checked="checked" <?php endif; ?> type='checkbox' name='reserve_data<?php echo smarty_modifier_t_escape($this->_tpl_vars['key']); ?>
_<?php echo smarty_modifier_t_escape($this->_tpl_vars['k']); ?>
' id='sd<?php echo smarty_modifier_t_escape($this->_tpl_vars['key']); ?>
_<?php echo smarty_modifier_t_escape($this->_tpl_vars['cb']); ?>
' value='<?php echo smarty_modifier_t_escape($this->_tpl_vars['hall_data']['hall_id']); ?>
,<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_id']); ?>
,<?php echo smarty_modifier_t_escape($this->_tpl_vars['value']['year']); ?>
-<?php echo smarty_modifier_t_escape($this->_tpl_vars['value']['month']); ?>
-<?php echo smarty_modifier_t_escape($this->_tpl_vars['value']['day']); ?>
 <?php echo smarty_modifier_t_escape($this->_tpl_vars['v']['begin_time']); ?>
,<?php echo smarty_modifier_t_escape($this->_tpl_vars['value']['year']); ?>
-<?php echo smarty_modifier_t_escape($this->_tpl_vars['value']['month']); ?>
-<?php echo smarty_modifier_t_escape($this->_tpl_vars['value']['day']); ?>
 <?php echo smarty_modifier_t_escape($this->_tpl_vars['v']['finish_time']); ?>
,<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data']['type']); ?>
'>
            <?php $this->assign('cb', smarty_modifier_t_escape($this->_tpl_vars['cb']+1)); ?>
            <?php elseif ($this->_tpl_vars['v']['checked']): ?>
            bgcolor=#FFCCFF>予約
            <?php else: ?>
            >
            <?php $this->assign('start', ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['v']['begin_time']))) ? $this->_run_mod_handler('substr', true, $_tmp, 0, 2) : substr($_tmp, 0, 2))); ?>
            <?php $this->assign('end', ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['v']['finish_time']))) ? $this->_run_mod_handler('substr', true, $_tmp, 0, 2) : substr($_tmp, 0, 2))); ?>
            <input <?php if (( $this->_tpl_vars['value']['room_id'] == $this->_tpl_vars['room_edit'] && $this->_tpl_vars['start'] >= $this->_tpl_vars['start_time'] && $this->_tpl_vars['end'] <= $this->_tpl_vars['end_time'] )): ?> checked="checked" <?php endif; ?> type='checkbox' name='reserve_data<?php echo smarty_modifier_t_escape($this->_tpl_vars['key']); ?>
_<?php echo smarty_modifier_t_escape($this->_tpl_vars['k']); ?>
' id='sd<?php echo smarty_modifier_t_escape($this->_tpl_vars['key']); ?>
_<?php echo smarty_modifier_t_escape($this->_tpl_vars['cb']); ?>
' value='<?php echo smarty_modifier_t_escape($this->_tpl_vars['hall_data']['hall_id']); ?>
,<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_id']); ?>
,<?php echo smarty_modifier_t_escape($this->_tpl_vars['value']['year']); ?>
-<?php echo smarty_modifier_t_escape($this->_tpl_vars['value']['month']); ?>
-<?php echo smarty_modifier_t_escape($this->_tpl_vars['value']['day']); ?>
 <?php echo smarty_modifier_t_escape($this->_tpl_vars['v']['begin_time']); ?>
,<?php echo smarty_modifier_t_escape($this->_tpl_vars['value']['year']); ?>
-<?php echo smarty_modifier_t_escape($this->_tpl_vars['value']['month']); ?>
-<?php echo smarty_modifier_t_escape($this->_tpl_vars['value']['day']); ?>
 <?php echo smarty_modifier_t_escape($this->_tpl_vars['v']['finish_time']); ?>
,<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data']['type']); ?>
'>
            <?php $this->assign('cb', smarty_modifier_t_escape($this->_tpl_vars['cb']+1)); ?>
            <?php endif; ?>
        </td>
        <?php endforeach; endif; unset($_from); ?>
        <?php else: ?>
        <?php $_from = $this->_tpl_vars['value']['komawari']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
        <td style='border: 1px #000000 solid;text-align: center;vertical-align:middle;' colspan=<?php echo smarty_modifier_t_escape($this->_tpl_vars['v']['cs']); ?>
 
            <?php if ($this->_tpl_vars['v']['reserved']): ?>
            bgcolor=#FFDCDC><span style='color:#FF0000;'><b>
                    <a href="?m=<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
&amp;a=page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('reserve_view')); ?>
&amp;reserve_id=<?php echo smarty_modifier_t_escape($this->_tpl_vars['v']['reserved']); ?>
">
                        予約ID:<?php echo smarty_modifier_t_escape($this->_tpl_vars['v']['reserved']); ?>
</a><br>
                    代表名：<?php echo smarty_modifier_t_escape($this->_tpl_vars['v']['corp']); ?>
<br>
                    予約者：<?php echo smarty_modifier_t_escape($this->_tpl_vars['v']['c_member']['nickname']); ?>
 様<br>
                    状態：
                    <?php if ($this->_tpl_vars['v']['reserve_data']['tmp_flag'] == 1): ?>
                    仮予約
                    <?php elseif ($this->_tpl_vars['v']['reserve_data']['pay_flag'] == 0 && $this->_tpl_vars['v']['reserve_data']['pay_money'] == 0): ?>
                    未入金
                    <?php elseif ($this->_tpl_vars['v']['reserve_data']['pay_flag'] == 0 && $this->_tpl_vars['v']['reserve_data']['pay_money'] > 0): ?>
                    一部入金
                    <?php elseif ($this->_tpl_vars['v']['reserve_data']['pay_flag'] == 1): ?>
                    入金済み
                    <?php endif; ?>
                    <br>


                </b></span>
            <?php elseif ($this->_tpl_vars['v']['stoped']): ?>
            bgcolor=#FFCCFF>貸し止め中<br>
            有効期限：<?php echo smarty_modifier_t_escape($this->_tpl_vars['v']['stoped']['limit_datetime']); ?>
<br>
            担当者：<?php echo smarty_modifier_t_escape($this->_tpl_vars['v']['stoped']['admin_name']); ?>
<br>
            <?php echo smarty_modifier_t_escape($this->_tpl_vars['v']['stoped']['memo']); ?>
<br>
            <?php $this->assign('start', ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['v']['begin_time']))) ? $this->_run_mod_handler('substr', true, $_tmp, 0, 2) : substr($_tmp, 0, 2))); ?>
            <?php $this->assign('end', ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['v']['finish_time']))) ? $this->_run_mod_handler('substr', true, $_tmp, 0, 2) : substr($_tmp, 0, 2))); ?>
            <input <?php if (( $this->_tpl_vars['year_edit'] == $this->_tpl_vars['value']['year'] && $this->_tpl_vars['month_edit'] == $this->_tpl_vars['value']['month'] && $this->_tpl_vars['day_edit'] == $this->_tpl_vars['value']['day'] && $this->_tpl_vars['room_id'] == $this->_tpl_vars['room_edit'] && $this->_tpl_vars['start'] >= $this->_tpl_vars['start_time'] && $this->_tpl_vars['end'] <= $this->_tpl_vars['end_time'] )): ?> checked="checked" <?php endif; ?> type='checkbox' name='reserve_data<?php echo smarty_modifier_t_escape($this->_tpl_vars['key']); ?>
_<?php echo smarty_modifier_t_escape($this->_tpl_vars['k']); ?>
' id='sd<?php echo smarty_modifier_t_escape($this->_tpl_vars['key']); ?>
_<?php echo smarty_modifier_t_escape($this->_tpl_vars['cb']); ?>
' value='<?php echo smarty_modifier_t_escape($this->_tpl_vars['hall_data']['hall_id']); ?>
,<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_id']); ?>
,<?php echo smarty_modifier_t_escape($this->_tpl_vars['value']['year']); ?>
-<?php echo smarty_modifier_t_escape($this->_tpl_vars['value']['month']); ?>
-<?php echo smarty_modifier_t_escape($this->_tpl_vars['value']['day']); ?>
 <?php echo smarty_modifier_t_escape($this->_tpl_vars['v']['begin_time']); ?>
,<?php echo smarty_modifier_t_escape($this->_tpl_vars['value']['year']); ?>
-<?php echo smarty_modifier_t_escape($this->_tpl_vars['value']['month']); ?>
-<?php echo smarty_modifier_t_escape($this->_tpl_vars['value']['day']); ?>
 <?php echo smarty_modifier_t_escape($this->_tpl_vars['v']['finish_time']); ?>
,<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data']['type']); ?>
'>
            <?php $this->assign('cb', smarty_modifier_t_escape($this->_tpl_vars['cb']+1)); ?>
            <?php elseif ($this->_tpl_vars['v']['rest']): ?>
            bgcolor=#CDCDCD>休憩
            <?php elseif ($this->_tpl_vars['v']['checked']): ?>
            bgcolor=#FFCCFF>予約
            <?php else: ?>
            >
                        
            <?php $this->assign('start', ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['v']['begin_time']))) ? $this->_run_mod_handler('substr', true, $_tmp, 0, 2) : substr($_tmp, 0, 2))); ?>
            <?php $this->assign('end', ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['v']['finish_time']))) ? $this->_run_mod_handler('substr', true, $_tmp, 0, 2) : substr($_tmp, 0, 2))); ?>
            
             <input <?php if (( $this->_tpl_vars['year_edit'] == $this->_tpl_vars['value']['year'] && $this->_tpl_vars['month_edit'] == $this->_tpl_vars['value']['month'] && $this->_tpl_vars['day_edit'] == $this->_tpl_vars['value']['day'] && $this->_tpl_vars['room_id'] == $this->_tpl_vars['room_edit'] && $this->_tpl_vars['start'] >= $this->_tpl_vars['start_time'] && $this->_tpl_vars['end'] <= $this->_tpl_vars['end_time'] )): ?> checked="checked" <?php endif; ?> type='checkbox' name='reserve_data<?php echo smarty_modifier_t_escape($this->_tpl_vars['key']); ?>
_<?php echo smarty_modifier_t_escape($this->_tpl_vars['k']); ?>
' id='sd<?php echo smarty_modifier_t_escape($this->_tpl_vars['key']); ?>
_<?php echo smarty_modifier_t_escape($this->_tpl_vars['cb']); ?>
' value='<?php echo smarty_modifier_t_escape($this->_tpl_vars['hall_data']['hall_id']); ?>
,<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_id']); ?>
,<?php echo smarty_modifier_t_escape($this->_tpl_vars['value']['year']); ?>
-<?php echo smarty_modifier_t_escape($this->_tpl_vars['value']['month']); ?>
-<?php echo smarty_modifier_t_escape($this->_tpl_vars['value']['day']); ?>
 <?php echo smarty_modifier_t_escape($this->_tpl_vars['v']['begin_time']); ?>
,<?php echo smarty_modifier_t_escape($this->_tpl_vars['value']['year']); ?>
-<?php echo smarty_modifier_t_escape($this->_tpl_vars['value']['month']); ?>
-<?php echo smarty_modifier_t_escape($this->_tpl_vars['value']['day']); ?>
 <?php echo smarty_modifier_t_escape($this->_tpl_vars['v']['finish_time']); ?>
,<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data']['type']); ?>
'>
            <?php $this->assign('cb', smarty_modifier_t_escape($this->_tpl_vars['cb']+1)); ?>
            <?php endif; ?>
        </td>
        <?php endforeach; endif; unset($_from); ?>
        <?php endif; ?>

        <?php endif; ?>
        </td>
        </tr>
        <?php $this->assign('line', smarty_modifier_t_escape($this->_tpl_vars['line']+1)); ?>
        <?php endforeach; endif; unset($_from); ?>

        <?php else: ?>
        	
        <input type="hidden" name="room_id" value="0">
        <?php $_from = $this->_tpl_vars['room_data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['value']):
?>
        <?php if (( $this->_tpl_vars['line'] % 5 ) == 0): ?>
        <tr>
            <th style='border: 1px #000000 solid;text-align: center;' width="150">
                部屋名

            </th>
            <th></th>

            <?php $_from = $this->_tpl_vars['open_time']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['time']):
?>

            <th bgcolor=#CDCDCD style='border: 1px #000000 solid;text-align: center;' colspan=4><b>
                    <?php echo smarty_modifier_t_escape($this->_tpl_vars['time']); ?>
:00 ～ <?php echo smarty_modifier_t_escape($this->_tpl_vars['time']+1); ?>
:00
                </b></th>
            <?php endforeach; endif; unset($_from); ?>
        </tr>
        <?php endif; ?>
        <?php $this->assign('cb', 0); ?>

        <tr>
            <td style='border: 1px #000000 solid;text-align: center;' >
                <?php echo smarty_modifier_t_escape($this->_tpl_vars['value']['room_name']); ?>
 (<?php echo smarty_modifier_t_escape($this->_tpl_vars['value']['max']); ?>
人)<br>
                <?php if ($this->_tpl_vars['value']['type'] == 2): ?>最低<?php echo smarty_modifier_t_escape($this->_tpl_vars['value']['lowest_koma']); ?>
コマ以上<?php endif; ?>
                <input type="submit" name="periodmode" value="日付範囲表示" onClick="setRoomID(<?php echo smarty_modifier_t_escape($this->_tpl_vars['value']['room_id']); ?>
)">
            </td>
            <td><input type="button" value=">>" onClick="linecheck(<?php echo smarty_modifier_t_escape($this->_tpl_vars['line']); ?>
)"></td>
            <?php if ($this->_tpl_vars['value']['holiday']): ?>
            <td colspan=<?php echo smarty_modifier_t_escape($this->_tpl_vars['ct']*4); ?>
 style='border: 1px #000000 solid;text-align: center;' bgcolor=#FF6666><b>休室日</b></td>
        </tr>
        <?php else: ?>

        <?php if ($this->_tpl_vars['value']['type'] == 2): ?>
        <?php $_from = $this->_tpl_vars['value']['opentime']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
        <td style='border: 1px #000000 solid;text-align: center;vertical-align:middle;' colspan=<?php echo smarty_modifier_t_escape($this->_tpl_vars['v']['cs']); ?>
 
            <?php if ($this->_tpl_vars['v']['reserved']): ?>
            bgcolor=#FFDCDC><span style='color:#FF0000;'><b>
                    <a href="?m=<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
&amp;a=page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('reserve_view')); ?>
&amp;reserve_id=<?php echo smarty_modifier_t_escape($this->_tpl_vars['v']['reserved']); ?>
">
                        予約ID:<?php echo smarty_modifier_t_escape($this->_tpl_vars['v']['reserved']); ?>
</a><br>
                    代表名：<?php echo smarty_modifier_t_escape($this->_tpl_vars['v']['corp']); ?>
<br>
                    予約者：<?php echo smarty_modifier_t_escape($this->_tpl_vars['v']['c_member']['nickname']); ?>
 様<br>
                    状態：
                    <?php if ($this->_tpl_vars['v']['reserve_data']['tmp_flag'] == 1): ?>
                    仮予約
                    <?php elseif ($this->_tpl_vars['v']['reserve_data']['pay_flag'] == 0 && $this->_tpl_vars['v']['reserve_data']['pay_money'] == 0): ?>
                    未入金
                    <?php elseif ($this->_tpl_vars['v']['reserve_data']['pay_flag'] == 0 && $this->_tpl_vars['v']['reserve_data']['pay_money'] > 0): ?>
                    一部入金
                    <?php elseif ($this->_tpl_vars['v']['reserve_data']['pay_flag'] == 1): ?>
                    入金済み
                    <?php endif; ?>
                </b></span>
            <?php elseif ($this->_tpl_vars['v']['stoped']): ?>
            bgcolor=#FFCCFF>貸し止め中<br>
            有効期限：<?php echo smarty_modifier_t_escape($this->_tpl_vars['v']['stoped']['limit_datetime']); ?>
<br>
            担当者：<?php echo smarty_modifier_t_escape($this->_tpl_vars['v']['stoped']['admin_name']); ?>
<br>
            <?php echo smarty_modifier_t_escape($this->_tpl_vars['v']['stoped']['memo']); ?>
<br>
            <?php $this->assign('start', ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['v']['begin_time']))) ? $this->_run_mod_handler('substr', true, $_tmp, 0, 2) : substr($_tmp, 0, 2))); ?>
            <?php $this->assign('end', ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['v']['finish_time']))) ? $this->_run_mod_handler('substr', true, $_tmp, 0, 2) : substr($_tmp, 0, 2))); ?>
            予約：<input <?php if (( $this->_tpl_vars['value']['room_id'] == $this->_tpl_vars['room_edit'] && $this->_tpl_vars['start'] >= $this->_tpl_vars['start_time'] && $this->_tpl_vars['end'] <= $this->_tpl_vars['end_time'] )): ?> checked="checked" <?php endif; ?> type='checkbox' name='reserve_data<?php echo smarty_modifier_t_escape($this->_tpl_vars['key']); ?>
_<?php echo smarty_modifier_t_escape($this->_tpl_vars['k']); ?>
' id='sd<?php echo smarty_modifier_t_escape($this->_tpl_vars['key']); ?>
_<?php echo smarty_modifier_t_escape($this->_tpl_vars['cb']); ?>
' value='<?php echo smarty_modifier_t_escape($this->_tpl_vars['hall_data']['hall_id']); ?>
,<?php echo smarty_modifier_t_escape($this->_tpl_vars['value']['room_id']); ?>
,<?php echo smarty_modifier_t_escape($this->_tpl_vars['year']); ?>
-<?php echo smarty_modifier_t_escape($this->_tpl_vars['month']); ?>
-<?php echo smarty_modifier_t_escape($this->_tpl_vars['day']); ?>
 <?php echo smarty_modifier_t_escape($this->_tpl_vars['v']['begin_time']); ?>
,<?php echo smarty_modifier_t_escape($this->_tpl_vars['year']); ?>
-<?php echo smarty_modifier_t_escape($this->_tpl_vars['month']); ?>
-<?php echo smarty_modifier_t_escape($this->_tpl_vars['day']); ?>
 <?php echo smarty_modifier_t_escape($this->_tpl_vars['v']['finish_time']); ?>
,<?php echo smarty_modifier_t_escape($this->_tpl_vars['value']['type']); ?>
'>
            <?php $this->assign('cb', smarty_modifier_t_escape($this->_tpl_vars['cb']+1)); ?>
            <?php elseif ($this->_tpl_vars['v']['checked']): ?>
            bgcolor=#FFCCFF>予約
            <?php else: ?>
            >
            <?php $this->assign('start', ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['v']['begin_time']))) ? $this->_run_mod_handler('substr', true, $_tmp, 0, 2) : substr($_tmp, 0, 2))); ?>
            <?php $this->assign('end', ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['v']['finish_time']))) ? $this->_run_mod_handler('substr', true, $_tmp, 0, 2) : substr($_tmp, 0, 2))); ?>
            <input <?php if (( $this->_tpl_vars['value']['room_id'] == $this->_tpl_vars['room_edit'] && $this->_tpl_vars['start'] >= $this->_tpl_vars['start_time'] && $this->_tpl_vars['end'] <= $this->_tpl_vars['end_time'] )): ?> checked="checked" <?php endif; ?> type='checkbox' name='reserve_data<?php echo smarty_modifier_t_escape($this->_tpl_vars['key']); ?>
_<?php echo smarty_modifier_t_escape($this->_tpl_vars['k']); ?>
' id='sd<?php echo smarty_modifier_t_escape($this->_tpl_vars['key']); ?>
_<?php echo smarty_modifier_t_escape($this->_tpl_vars['cb']); ?>
' value='<?php echo smarty_modifier_t_escape($this->_tpl_vars['hall_data']['hall_id']); ?>
,<?php echo smarty_modifier_t_escape($this->_tpl_vars['value']['room_id']); ?>
,<?php echo smarty_modifier_t_escape($this->_tpl_vars['year']); ?>
-<?php echo smarty_modifier_t_escape($this->_tpl_vars['month']); ?>
-<?php echo smarty_modifier_t_escape($this->_tpl_vars['day']); ?>
 <?php echo smarty_modifier_t_escape($this->_tpl_vars['v']['begin_time']); ?>
,<?php echo smarty_modifier_t_escape($this->_tpl_vars['year']); ?>
-<?php echo smarty_modifier_t_escape($this->_tpl_vars['month']); ?>
-<?php echo smarty_modifier_t_escape($this->_tpl_vars['day']); ?>
 <?php echo smarty_modifier_t_escape($this->_tpl_vars['v']['finish_time']); ?>
,<?php echo smarty_modifier_t_escape($this->_tpl_vars['value']['type']); ?>
'>
            <?php $this->assign('cb', smarty_modifier_t_escape($this->_tpl_vars['cb']+1)); ?>
            <?php endif; ?>
        </td>
        <?php endforeach; endif; unset($_from); ?>
        <?php else: ?>
        <?php $_from = $this->_tpl_vars['value']['komawari']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
        <td style='border: 1px #000000 solid;text-align: center;vertical-align:middle;' colspan=<?php echo smarty_modifier_t_escape($this->_tpl_vars['v']['cs']); ?>
 
            <?php if ($this->_tpl_vars['v']['reserved']): ?>
            bgcolor=#FFDCDC><span style='color:#FF0000;'><b>
                    <a href="?m=<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
&amp;a=page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('reserve_view')); ?>
&amp;reserve_id=<?php echo smarty_modifier_t_escape($this->_tpl_vars['v']['reserved']); ?>
">
                        予約ID:<?php echo smarty_modifier_t_escape($this->_tpl_vars['v']['reserved']); ?>
</a><br>
                    代表名：<?php echo smarty_modifier_t_escape($this->_tpl_vars['v']['corp']); ?>
<br>
                    予約者：<?php echo smarty_modifier_t_escape($this->_tpl_vars['v']['c_member']['nickname']); ?>
 様<br>
                    状態：
                    <?php if ($this->_tpl_vars['v']['reserve_data']['tmp_flag'] == 1): ?>
                    仮予約
                    <?php elseif ($this->_tpl_vars['v']['reserve_data']['pay_flag'] == 0 && $this->_tpl_vars['v']['reserve_data']['pay_money'] == 0): ?>
                    未入金
                    <?php elseif ($this->_tpl_vars['v']['reserve_data']['pay_flag'] == 0 && $this->_tpl_vars['v']['reserve_data']['pay_money'] > 0): ?>
                    一部入金
                    <?php elseif ($this->_tpl_vars['v']['reserve_data']['pay_flag'] == 1): ?>
                    入金済み
                    <?php endif; ?>
                    <br>


                </b></span>
            <?php elseif ($this->_tpl_vars['v']['stoped']): ?>
            bgcolor=#FFCCFF>貸し止め中<br>
            有効期限：<?php echo smarty_modifier_t_escape($this->_tpl_vars['v']['stoped']['limit_datetime']); ?>
<br>
            担当者：<?php echo smarty_modifier_t_escape($this->_tpl_vars['v']['stoped']['admin_name']); ?>
<br>
            <?php echo smarty_modifier_t_escape($this->_tpl_vars['v']['stoped']['memo']); ?>
<br>
            <?php $this->assign('start', ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['v']['begin_time']))) ? $this->_run_mod_handler('substr', true, $_tmp, 0, 2) : substr($_tmp, 0, 2))); ?>
            <?php $this->assign('end', ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['v']['finish_time']))) ? $this->_run_mod_handler('substr', true, $_tmp, 0, 2) : substr($_tmp, 0, 2))); ?>
            <input  <?php if (( $this->_tpl_vars['value']['room_id'] == $this->_tpl_vars['room_edit'] && $this->_tpl_vars['start'] >= $this->_tpl_vars['start_time'] && $this->_tpl_vars['end'] <= $this->_tpl_vars['end_time'] )): ?> checked="checked" <?php endif; ?>  type='checkbox' name='reserve_data<?php echo smarty_modifier_t_escape($this->_tpl_vars['key']); ?>
_<?php echo smarty_modifier_t_escape($this->_tpl_vars['k']); ?>
' id='sd<?php echo smarty_modifier_t_escape($this->_tpl_vars['key']); ?>
_<?php echo smarty_modifier_t_escape($this->_tpl_vars['cb']); ?>
' value='<?php echo smarty_modifier_t_escape($this->_tpl_vars['hall_data']['hall_id']); ?>
,<?php echo smarty_modifier_t_escape($this->_tpl_vars['value']['room_id']); ?>
,<?php echo smarty_modifier_t_escape($this->_tpl_vars['year']); ?>
-<?php echo smarty_modifier_t_escape($this->_tpl_vars['month']); ?>
-<?php echo smarty_modifier_t_escape($this->_tpl_vars['day']); ?>
 <?php echo smarty_modifier_t_escape($this->_tpl_vars['v']['begin_time']); ?>
,<?php echo smarty_modifier_t_escape($this->_tpl_vars['year']); ?>
-<?php echo smarty_modifier_t_escape($this->_tpl_vars['month']); ?>
-<?php echo smarty_modifier_t_escape($this->_tpl_vars['day']); ?>
 <?php echo smarty_modifier_t_escape($this->_tpl_vars['v']['finish_time']); ?>
,<?php echo smarty_modifier_t_escape($this->_tpl_vars['value']['type']); ?>
'>
            <?php $this->assign('cb', smarty_modifier_t_escape($this->_tpl_vars['cb']+1)); ?>
            <?php elseif ($this->_tpl_vars['v']['rest']): ?>
            bgcolor=#CDCDCD>休憩
            <?php elseif ($this->_tpl_vars['v']['checked']): ?>
            bgcolor=#FFCCFF>予約       
            <?php else: ?>
            >
            <?php $this->assign('start', ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['v']['begin_time']))) ? $this->_run_mod_handler('substr', true, $_tmp, 0, 2) : substr($_tmp, 0, 2))); ?>
            <?php $this->assign('end', ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['v']['finish_time']))) ? $this->_run_mod_handler('substr', true, $_tmp, 0, 2) : substr($_tmp, 0, 2))); ?>
             <input <?php if (( $this->_tpl_vars['value']['room_id'] == $this->_tpl_vars['room_edit'] && $this->_tpl_vars['start'] >= $this->_tpl_vars['start_time'] && $this->_tpl_vars['end'] <= $this->_tpl_vars['end_time'] )): ?> checked="checked" <?php endif; ?> type='checkbox' name='reserve_data<?php echo smarty_modifier_t_escape($this->_tpl_vars['key']); ?>
_<?php echo smarty_modifier_t_escape($this->_tpl_vars['k']); ?>
' id='sd<?php echo smarty_modifier_t_escape($this->_tpl_vars['key']); ?>
_<?php echo smarty_modifier_t_escape($this->_tpl_vars['cb']); ?>
' value='<?php echo smarty_modifier_t_escape($this->_tpl_vars['hall_data']['hall_id']); ?>
,<?php echo smarty_modifier_t_escape($this->_tpl_vars['value']['room_id']); ?>
,<?php echo smarty_modifier_t_escape($this->_tpl_vars['year']); ?>
-<?php echo smarty_modifier_t_escape($this->_tpl_vars['month']); ?>
-<?php echo smarty_modifier_t_escape($this->_tpl_vars['day']); ?>
 <?php echo smarty_modifier_t_escape($this->_tpl_vars['v']['begin_time']); ?>
,<?php echo smarty_modifier_t_escape($this->_tpl_vars['year']); ?>
-<?php echo smarty_modifier_t_escape($this->_tpl_vars['month']); ?>
-<?php echo smarty_modifier_t_escape($this->_tpl_vars['day']); ?>
 <?php echo smarty_modifier_t_escape($this->_tpl_vars['v']['finish_time']); ?>
,<?php echo smarty_modifier_t_escape($this->_tpl_vars['value']['type']); ?>
'>
            <?php $this->assign('cb', smarty_modifier_t_escape($this->_tpl_vars['cb']+1)); ?>
            <?php endif; ?>
        </td>
        <?php endforeach; endif; unset($_from); ?>
        <?php endif; ?>
        <?php endif; ?>        </td>
        </tr>
        <?php $this->assign('line', smarty_modifier_t_escape($this->_tpl_vars['line']+1)); ?>
        <?php endforeach; endif; unset($_from); ?>

        <?php endif; ?>


        <tr>
            <th style='border: 1px #000000 solid;text-align: center;' width="150">
                部屋名
            </th>
            <th></th>

            <?php $_from = $this->_tpl_vars['open_time']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['time']):
?>

            <th bgcolor=#CDCDCD style='border: 1px #000000 solid;text-align: center;' colspan=4><b>
                    <?php echo smarty_modifier_t_escape($this->_tpl_vars['time']); ?>
:00 ～ <?php echo smarty_modifier_t_escape($this->_tpl_vars['time']+1); ?>
:00
                </b></th>
            <?php endforeach; endif; unset($_from); ?>
        </tr>

    </table>
</form>

</center>
<?php endif; ?>
<?php else: ?>
<br>
<center>
    <span style="font-size: 16px; color: #FF0033;">
		<b>アクセス権がありません。</b>
	</span>
</center>
<?php endif; ?>

<?php echo $this->_tpl_vars['inc_footer']; ?>
