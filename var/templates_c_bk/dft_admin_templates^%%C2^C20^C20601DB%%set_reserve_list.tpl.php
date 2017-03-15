<?php /* Smarty version 2.6.18, created on 2016-03-08 14:32:59
         compiled from file:/var/www/atoffice/webapp/modules/admin/templates/set_reserve_list.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'ext_include', 'file:/var/www/atoffice/webapp/modules/admin/templates/set_reserve_list.tpl', 29, false),array('modifier', 't_escape', 'file:/var/www/atoffice/webapp/modules/admin/templates/set_reserve_list.tpl', 47, false),array('modifier', 'date_format', 'file:/var/www/atoffice/webapp/modules/admin/templates/set_reserve_list.tpl', 212, false),array('modifier', 'number_format', 'file:/var/www/atoffice/webapp/modules/admin/templates/set_reserve_list.tpl', 272, false),)), $this); ?>
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

</style>
<?php echo $this->_tpl_vars['inc_header']; ?>

<?php echo smarty_function_ext_include(array('file' => "inc_subnavi_adminSiteMember.tpl"), $this);?>

<?php $this->assign('page_name', "予約入力"); ?>
<?php echo smarty_function_ext_include(array('file' => "inc_tree_adminSiteMember.tpl"), $this);?>




<style type="text/css">
<!--
HR {
	border-style:dotted;color:#3399FF

}
-->
</style>

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
    function pre_kanban(){
    	kanban = encodeURI(document.getElementById("kanban").value);
    	window.open('./atoffice/pages/sub/kanban.php?kanban='+kanban,'','scrollbars=yes,width=1050,height=750,');
    
    }
</script>

<h2 id="ttl01">予約備品入力</h2>
<br>
<center>
<?php if ($this->_tpl_vars['msg']): ?><p class="actionMsg"><?php echo smarty_modifier_t_escape($this->_tpl_vars['msg']); ?>
</p><br><br>
<INPUT TYPE=button VALUE="　戻る　" style="width:250px;font:20px;border:3px ridge;background:#090;color:#fff; padding:3px; font-weight:bold;" onClick="self.history.back()">
<?php else: ?>
<?php if ($this->_tpl_vars['num_pre_data'] == 0): ?>
<table width="500"><tr>
<td width="250" style="text-align: center; vertical-align:middle;">
<form name="add_reserve" method="POST" action="./">
<input type="hidden" name="page" value="set_reserve">
<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
<input type="hidden" name="a" value="page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('set_reserve','page')); ?>
" />
<input type="hidden" name="pre_id" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['pre_id']); ?>
">
<input type='hidden' name='uid' value='<?php echo smarty_modifier_t_escape($this->_tpl_vars['c_member_id']); ?>
'>
<input type='hidden' name='hall_list' value='<?php echo smarty_modifier_t_escape($this->_tpl_vars['hall_id']); ?>
'>
<input type='hidden' name='year' value='<?php echo smarty_modifier_t_escape($this->_tpl_vars['year']); ?>
'>
<input type='hidden' name='month' value='<?php echo smarty_modifier_t_escape($this->_tpl_vars['month']); ?>
'>
<input type='hidden' name='day' value='<?php echo smarty_modifier_t_escape($this->_tpl_vars['day']); ?>
'>
<INPUT TYPE="submit" VALUE="他の予約を追加する" style="width:250px;font:20px;border:3px ridge;background:#090;color:#fff; padding:3px; font-weight:bold;" >
</form>
</td>
</tr></table>
<?php else: ?> 

<?php $_from = $this->_tpl_vars['pre_data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>

<?php if (( $this->_tpl_vars['item']['purpose'] ) == 0): ?>
    <?php $this->assign('purpose', "未定"); ?>
<?php endif; ?>
<?php if (( $this->_tpl_vars['item']['purpose'] ) == 1): ?>
    <?php $this->assign('purpose', "会議"); ?>
<?php endif; ?>
<?php if (( $this->_tpl_vars['item']['purpose'] ) == 2): ?>
    <?php $this->assign('val', 1); ?>
<?php endif; ?>
<?php if (( $this->_tpl_vars['item']['purpose'] ) == 3): ?>
    <?php $this->assign('purpose', "研修"); ?>
<?php endif; ?>
<?php if (( $this->_tpl_vars['item']['purpose'] ) == 4): ?>
    <?php $this->assign('purpose', "面接・試験"); ?>
<?php endif; ?>
<?php if (( $this->_tpl_vars['item']['purpose'] ) == 5): ?>
    <?php $this->assign('purpose', "懇談会・パーティ"); ?>
<?php endif; ?>
<?php if (( $this->_tpl_vars['item']['purpose'] ) == 6): ?>
    <?php $this->assign('purpose', "その他"); ?>
<?php endif; ?>




<table width=600>
<tr>
<td colspan=4 bgcolor=#FFFF66 style='border: 1px #000000 solid;text-align: center;padding:2px;padding-left:35px;'><b> ◆　予約:<?php echo smarty_modifier_t_escape($this->_tpl_vars['key']+1); ?>
　◆</b>
<div style="float:right;width:80px">
    <form name="set_reserve" method="POST" action="./">
        <input type="hidden" name="page" value="set_reserve_edit">
        <input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
        <input type="hidden" name="a" value="page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('set_reserve_edit','page')); ?>
" />
        <input type="hidden" name="pre_id" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['pre_id']); ?>
">
        <input type='hidden' name='uid' value='<?php echo smarty_modifier_t_escape($this->_tpl_vars['c_member_id']); ?>
'>
        <input type='hidden' name='hall_list' value='<?php echo smarty_modifier_t_escape($this->_tpl_vars['hall_id']); ?>
'>
        <input type='hidden' name='year' value='<?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['begin_datetime']))) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y") : smarty_modifier_date_format($_tmp, "%Y")); ?>
'>
        <input type='hidden' name='month' value='<?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['begin_datetime']))) ? $this->_run_mod_handler('date_format', true, $_tmp, "%m") : smarty_modifier_date_format($_tmp, "%m")); ?>
'>
        <input type='hidden' name='day' value='<?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['begin_datetime']))) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d") : smarty_modifier_date_format($_tmp, "%d")); ?>
'>
        <input type='hidden' name='pid' value='<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['pid']); ?>
'>
        <INPUT TYPE="submit" VALUE="変更" style="float:left">
    </form>
    <form name="reserve_confirm" method="POST" action="./">
    <input type="hidden" name="page" value="reserve_list">
    <input type="hidden" name="pre_id" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['pre_id']); ?>
">
    <input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
    <input type='hidden' name='uid' value='<?php echo smarty_modifier_t_escape($this->_tpl_vars['c_member_id']); ?>
'>
    <input type='hidden' name='pid' value='<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['pid']); ?>
'>
    <input type='hidden' name='delete' value='1'>
    <input type='hidden' name='hall_list' value='<?php echo smarty_modifier_t_escape($this->_tpl_vars['hall_id']); ?>
'>
    <input type='hidden' name='year' value='<?php echo smarty_modifier_t_escape($this->_tpl_vars['year']); ?>
'>
    <input type='hidden' name='month' value='<?php echo smarty_modifier_t_escape($this->_tpl_vars['month']); ?>
'>
    <input type='hidden' name='day' value='<?php echo smarty_modifier_t_escape($this->_tpl_vars['day']); ?>
'>
    <input type="hidden" name="a" value="page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('set_reserve_list','page')); ?>
" />
    <input type="submit" value="取消"/>
    </form>

     
</div>

</td>
</tr>
<tr>
<td bgcolor=#CDCDCD style='border: 1px #000000 solid;text-align: center;'>施設名</td>
<td style='border: 1px #000000 solid;text-align: center;'><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['hall_data']['hall_name']); ?>
</td>

<td bgcolor=#CDCDCD style='border: 1px #000000 solid;text-align: center;'>部屋名称</td>
<td style='border: 1px #000000 solid;text-align: center;'><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['room_data']['room_name']); ?>
</td>

</tr>
<tr>
<td bgcolor=#CDCDCD style='border: 1px #000000 solid;text-align: center;'>利用日</td>
<td style='border: 1px #000000 solid;text-align: center;'>
<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['date']); ?>
(<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['week']); ?>
)
</td>

<td rowspan=2 bgcolor=#CDCDCD style='border: 1px #000000 solid;text-align: center;'>利用時間帯</td>
<td rowspan=2 style='border: 1px #000000 solid;text-align: center;'>
<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['begin']); ?>
～<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['finish']); ?>

</td>
</tr>

<tr>
<td bgcolor=#CDCDCD style='border: 1px #000000 solid;text-align: center;'>ご利用目的</td>
<td style='border: 1px #000000 solid;text-align: center;'>
<?php echo smarty_modifier_t_escape($this->_tpl_vars['purpose']); ?>

</td>
</tr>

<tr>
<td bgcolor=#CDCDCD style='border: 1px #000000 solid;text-align: center;'>ご利用予定人数</td>
<td style='border: 1px #000000 solid;text-align: center;'>
<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['people']); ?>
 人
</td>
<td bgcolor=#CDCDCD style='border: 1px #000000 solid;text-align: center;'>施設利用料金</td>
<td style='border: 1px #000000 solid;text-align: center;'>
<?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['room_price']))) ? $this->_run_mod_handler('number_format', true, $_tmp, 0) : number_format($_tmp, 0)); ?>
 円（税込）
</td>
</tr>

<tr>
<td bgcolor=#CDCDCD style='border: 1px #000000 solid;text-align: center;vertical-align:middle;'>備品</td>
<td colspan=3 style='border: 1px #000000 solid;text-align: left;'>
<?php if ($this->_tpl_vars['item']['vessel_list']): ?>
<table width=100%>
<tr>
<th bgcolor=#CDCDCD style='border: 1px #000000 solid;text-align: center;text-align:center;vertical-align:middle;'>備品名</th>
<th bgcolor=#CDCDCD style='border: 1px #000000 solid;text-align: center;text-align:center;vertical-align:middle;'>単価</th>
<th bgcolor=#CDCDCD style='border: 1px #000000 solid;text-align: center;text-align:center;vertical-align:middle;'>数量</th>
</tr>

<?php $_from = $this->_tpl_vars['item']['vessel_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['kversil'] => $this->_tpl_vars['valversel']):
?>
<tr>
<td style='border: 1px #000000 solid;text-align: center;text-align:center;vertical-align:middle;'><?php echo smarty_modifier_t_escape($this->_tpl_vars['valversel']['vessel_data']['vessel_name']); ?>
</td>
<td style='border: 1px #000000 solid;text-align: center;text-align:center;vertical-align:middle;'><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['valversel']['vessel_data']['price']))) ? $this->_run_mod_handler('number_format', true, $_tmp, 0) : number_format($_tmp, 0)); ?>
円</td>
<td style='border: 1px #000000 solid;text-align: center;text-align:center;vertical-align:middle;'><?php echo smarty_modifier_t_escape($this->_tpl_vars['valversel']['num']); ?>
</td>
</tr>
<?php endforeach; endif; unset($_from); ?>
<tr>
<td style='text-align: center;vertical-align:middle;'>
備品利用料金
</td>
<td>
<?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['vessel_price']))) ? $this->_run_mod_handler('number_format', true, $_tmp, 0) : number_format($_tmp, 0)); ?>


 円</td>
</table>
<?php else: ?>
-- --
<?php endif; ?>

</td>
</tr>

<tr>
<td bgcolor=#CDCDCD style='border: 1px #000000 solid;text-align: center;vertical-align:middle;'>サービス</td>
<td colspan=3 style='border: 1px #000000 solid;text-align: left;'>
<?php if ($this->_tpl_vars['item']['service_list']): ?>

<table width=100%>
<tr>
<th bgcolor=#CDCDCD style='border: 1px #000000 solid;text-align: center;text-align:center;vertical-align:middle;'>サービス名</th>
<th bgcolor=#CDCDCD style='border: 1px #000000 solid;text-align: center;text-align:center;vertical-align:middle;'>単価</th>
<th bgcolor=#CDCDCD style='border: 1px #000000 solid;text-align: center;text-align:center;vertical-align:middle;'>数量</th>
</tr>
<?php $_from = $this->_tpl_vars['item']['service_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ksevice'] => $this->_tpl_vars['vservice']):
?>
<tr>
<td style='border: 1px #000000 solid;text-align: center;text-align:center;vertical-align:middle;'><?php echo smarty_modifier_t_escape($this->_tpl_vars['vservice']['service_data']['service_name']); ?>
</td>
<td style='border: 1px #000000 solid;text-align: center;text-align:center;vertical-align:middle;'><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['vservice']['service_data']['price']))) ? $this->_run_mod_handler('number_format', true, $_tmp, 0) : number_format($_tmp, 0)); ?>
 円</td>
<td style='border: 1px #000000 solid;text-align: center;text-align:center;vertical-align:middle;'><?php echo smarty_modifier_t_escape($this->_tpl_vars['vservice']['num']); ?>
</td>
</tr>
<?php endforeach; endif; unset($_from); ?>
<tr>
<td style='text-align: center;vertical-align:middle;'>
サービス品利用料金
</td>
<td>
<?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['service_price']))) ? $this->_run_mod_handler('number_format', true, $_tmp, 0) : number_format($_tmp, 0)); ?>


 円</td>
</table>
<?php else: ?>
-- --
<?php endif; ?>
</td>
</tr>
<tr height="48">
<td width=100 style='border: 1px #646464 solid;text-align: center;' bgcolor=#CDCDCD>会議室入口<br>表示名</td>
<td colspan="3" style='border: 1px #646464 solid;text-align: center;'>
<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['kanban']); ?>

</td>
</tr>
</table>
<br>
<!--
<table width="500"><tr>
<td width="250" style="text-align: center; vertical-align:middle;">
<form name="reserve_v" method="POST" action="./">
<input type='hidden' name='pre_id' value='<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['pre_id']); ?>
'>
<input type='hidden' name='pid' value='<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['pid']); ?>
'>
<input type='hidden' name='uid' value='<?php echo smarty_modifier_t_escape($this->_tpl_vars['c_member_id']); ?>
'>
<input type='hidden' name='pno' value='<?php echo smarty_modifier_t_escape($this->_tpl_vars['key']); ?>
'>
<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
<input type="hidden" name="a" value="page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('set_vessel','page')); ?>
" />

<INPUT TYPE="image" src="./atoffice/img/equiporder.png" VALUE="">
</form>
</td>
<td width="250" style="text-align: center; vertical-align:middle;">
<form name="reserve_s" method="POST" action="./">
<input type="hidden" name="page" value="reserve_service">
<input type='hidden' name='pre_id' value='<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['pre_id']); ?>
'>
<input type='hidden' name='pid' value='<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['pid']); ?>
'>
<input type='hidden' name='uid' value='<?php echo smarty_modifier_t_escape($this->_tpl_vars['c_member_id']); ?>
'>
<input type='hidden' name='pno' value='<?php echo smarty_modifier_t_escape($this->_tpl_vars['key']); ?>
'>
<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
<input type="hidden" name="a" value="page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('set_service','page')); ?>
" />
<INPUT TYPE="image" src="./atoffice/img/serviceorder.png" >
</form>
</td>
</tr></table> -->
<br>
<br>
<?php endforeach; endif; unset($_from); ?>

<hr><br>
<table width=600>
<tr>
<td colspan=2 height=30 bgcolor=#FFCDCD style='border: 1px #000000 solid;text-align: center;'>
<span style="font:16px;"><b>請求予定総額</b></span>
</td>
</tr>
<tr>
<td colspan=2 style='border: 1px #000000 solid;text-align: center;'>
<span id="total_price" style="font-size:20px;color:#FF0000;"><b>
<?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['all_total']))) ? $this->_run_mod_handler('number_format', true, $_tmp, 0) : number_format($_tmp, 0)); ?>

</b></span> 円(税込)
</td>
</tr>
</table>
<br><br>
<table width="500" style="position:relative"><tr>
<td width="250" style="text-align: center; vertical-align:middle;">
<form name="add_reserve" method="POST" action="./" id="frmOrder">
<input type="hidden" name="page" value="set_reserve">
<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
<input type="hidden" name="a" value="page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('set_reserve','page')); ?>
" />
<input type="hidden" name="pre_id" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['pre_id']); ?>
">
<input type='hidden' name='uid' value='<?php echo smarty_modifier_t_escape($this->_tpl_vars['c_member_id']); ?>
'>
<input type='hidden' name='old_member' value='<?php echo smarty_modifier_t_escape($this->_tpl_vars['c_member_id']); ?>
'>
<input type='hidden' name='hall_list' value='<?php echo smarty_modifier_t_escape($this->_tpl_vars['hall_id']); ?>
'>
<input type='hidden' name='old_hall' value='<?php echo smarty_modifier_t_escape($this->_tpl_vars['hall_id']); ?>
'>
<input type='hidden' name='year' value='<?php echo smarty_modifier_t_escape($this->_tpl_vars['year']); ?>
'>
<input type='hidden' name='month' value='<?php echo smarty_modifier_t_escape($this->_tpl_vars['month']); ?>
'>
<input type='hidden' name='day' value='<?php echo smarty_modifier_t_escape($this->_tpl_vars['day']); ?>
'>
<INPUT TYPE="reset" VALUE="他の予約を追加する" style="width:250px;font:20px;border:3px ridge;background:#090;color:#fff; padding:3px; font-weight:bold;"  onclick="showDialog()">
    <div style="display: none;background:#fff;height:80px;padding:10px;padding-top:30px" class="dialog" id="dialog">
            <p style="text-align:center">他の予約を追加しますか。</p>   
             <br /> 
            <div style="margin:0 auto;text-align:center;" id="confirm_collect">
            
             <button onclick="smtOrderFrm()">追加する</button>&nbsp;
             <input type='reset' value='戻る' onclick="closeDialog();">
            
            </div>
            
    </div>   
</form>
</td>
<td width="250" style="text-align: center; vertical-align:middle;">
<form name="reserve_confirm" method="POST" action="./">
<input type="hidden" name="page" value="reserve_confirm">
<input type="hidden" name="pre_id" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['pre_id']); ?>
">
<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
<input type='hidden' name='uid' value='<?php echo smarty_modifier_t_escape($this->_tpl_vars['c_member_id']); ?>
'>
<input type='hidden' name='hall_list' value='<?php echo smarty_modifier_t_escape($this->_tpl_vars['hall_id']); ?>
'>
<input type='hidden' name='year' value='<?php echo smarty_modifier_t_escape($this->_tpl_vars['year']); ?>
'>
<input type='hidden' name='month' value='<?php echo smarty_modifier_t_escape($this->_tpl_vars['month']); ?>
'>
<input type='hidden' name='day' value='<?php echo smarty_modifier_t_escape($this->_tpl_vars['day']); ?>
'>
<input type="hidden" name="a" value="page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('set_reserve_confirm','page')); ?>
" />
<INPUT TYPE="submit" VALUE="　確認　" style="width:250px;font:20px;border:3px ridge;background:#090;color:#fff; padding:3px; font-weight:bold;">
</form>
</td>
</tr></table>

</center>

</div>
<br>
<?php endif; ?>
<?php endif; ?>
<?php echo $this->_tpl_vars['inc_footer']; ?>

<div id="overlay" class="web_dialog_overlay" onclick="return closeDialog()">
    
</div>
<script>
    function showDialog()
    {   ref= true;
        
        var overlay = document.getElementById("overlay");
        overlay.style.display="block";
        var idDialog = "dialog";
        var dialog = document.getElementById(idDialog);
        dialog.style.left='-30px';
        dialog.style.top='-80px';
        dialog.style.display="block";
    }
    function closeDialog()
    {
        var overlay = document.getElementById("overlay");
        overlay.style.display="none";
        var dialog = document.getElementById('dialog');
        dialog.style.display="none";
    }
    function sbmOrderFrm()
    {
        var frm = document.getElementById('frmOrder');
        frm.submit();
    }
</script>