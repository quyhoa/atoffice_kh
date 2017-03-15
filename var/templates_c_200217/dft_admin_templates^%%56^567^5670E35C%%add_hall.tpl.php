<?php /* Smarty version 2.6.18, created on 2016-10-26 18:42:25
         compiled from file:/var/www/atoffice/webapp/modules/admin/templates/add_hall.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'ext_include', 'file:/var/www/atoffice/webapp/modules/admin/templates/add_hall.tpl', 15, false),array('modifier', 't_escape', 'file:/var/www/atoffice/webapp/modules/admin/templates/add_hall.tpl', 31, false),array('modifier', 'default', 'file:/var/www/atoffice/webapp/modules/admin/templates/add_hall.tpl', 1426, false),)), $this); ?>
<style>
.lbDate{
    width: 55px;
    display: inline-block;
    padding-left: 5px;
}
.spDate{
  display:block; 
  margin-top:5px;

		
}
</style>
<?php echo $this->_tpl_vars['inc_header']; ?>

<?php echo smarty_function_ext_include(array('file' => "inc_subnavi_adminImageKakikomi.tpl"), $this);?>

<?php $this->assign('page_name', "会場登録"); ?>
<?php if ($this->_tpl_vars['hall_id']): ?>
<?php $this->assign('page_name', "会場編集"); ?>
<?php else: ?>
<?php $this->assign('page_name', "会場登録"); ?>
<?php endif; ?>
<?php echo smarty_function_ext_include(array('file' => "inc_tree_adminImageKakikomi.tpl"), $this);?>

</div>


<?php if ($this->_tpl_vars['atoffice_auth_type'] == 1 || $this->_tpl_vars['atoffice_auth_type'] == 4): ?>

<?php if ($this->_tpl_vars['hall_id']): ?>
<h2 id="ttl01">会場編集【<?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['hall_name']); ?>
】</h2>
<?php else: ?>
<h2 id="ttl01">会場登録</h2>
<?php endif; ?>

<br>

<script type="text/javascript">

function Sel(){
	var obj=document.forms['add_hall'].elements['hall_attribute'];
	if(obj[0].checked){
	document.getElementById('d1').style.display='none';
	}
	if(obj[1].checked){
	document.getElementById('d1').style.display='block';
	}
}

function mycheck(obj) {
        if(obj.checked) {
                obj.style.border='solid 2px greenyellow';
                obj.style.outline='solid 2px greenyellow';
        } else {
                obj.style.border='none';
                obj.style.outline='none';
        }
}

function begin_Sub(SEL,LIST){
	while(SEL.options[1])SEL.remove(1);
	if(LIST) {
		for(var i=0;LIST[i];i++) {
			var OPT = document.createElement('option');
			OPT.value = LIST[i];
			OPT.appendChild(document.createTextNode(LIST[i]));
			SEL.appendChild(OPT);
		}
	}
	SEL.selectedIndex = 0;
	if(SEL.onchange)SEL.onchange(SEL,null);
}


function f_begin(SEL,i){
	var LIST = new Array();

	//LIST['0']=['01','02','03','04','05','06','07','08','09','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24'];
	LIST['1']=['02','03','04','05','06','07','08','09','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24'];
	LIST['2']=['03','04','05','06','07','08','09','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24'];
	LIST['3']=['04','05','06','07','08','09','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24'];
	LIST['4']=['05','06','07','08','09','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24'];
	LIST['5']=['06','07','08','09','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24'];
	LIST['6']=['07','08','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24'];
	LIST['7']=['08','09','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24'];
	LIST['8']=['09','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24'];
	LIST['9']=['10','11','12','13','14','15','16','17','18','19','20','21','22','23','24'];
	LIST['10']=['11','12','13','14','15','16','17','18','19','20','21','22','23','24'];
	LIST['11']=['12','13','14','15','16','17','18','19','20','21','22','23','24'];
	LIST['12']=['13','14','15','16','17','18','19','20','21','22','23','24'];
	LIST['13']=['14','15','16','17','18','19','20','21','22','23','24'];
	LIST['14']=['15','16','17','18','19','20','21','22','23','24'];
	LIST['15']=['16','17','18','19','20','21','22','23','24'];
	LIST['16']=['17','18','19','20','21','22','23','24'];
	LIST['17']=['18','19','20','21','22','23','24'];
	LIST['18']=['19','20','21','22','23','24'];
	LIST['19']=['20','21','22','23','24'];
	LIST['19']=['20','21','22','23','24'];
	LIST['20']=['21','22','23','24'];
	LIST['21']=['22','23','24'];
	LIST['22']=['23','24'];
	LIST['23']=['24'];
	begin_Sub(
		document.getElementsByName('finish'+i)[0],
		LIST[SEL.options[SEL.selectedIndex].value]
	);

}

</script>


<center>

<?php if ($this->_tpl_vars['msg']): ?><p class="actionMsg"><?php echo smarty_modifier_t_escape($this->_tpl_vars['msg']); ?>
</p><?php endif; ?>

<form name="add_hall" method="POST" action="./">
<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
<input type="hidden" name="a" value="page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('add_hall_confirm','page')); ?>
" />

<?php if ($this->_tpl_vars['post_data']['hall_id']): ?>
<input type="hidden" name="hall_id" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['hall_id']); ?>
" />
<?php endif; ?>

<table border=1 width=740 >
<tr>
<td colspan=2 bgcolor=#FFCCCC align=center height=30><b>
<?php if ($this->_tpl_vars['post_data']['hall_id']): ?>
会場編集
<?php else: ?>
会場登録
<?php endif; ?>
</b></td>
</tr>
<tr>
<td bgcolor=#FFE7D6><b>会場名称</b></td>
<td align=left><input type="text" name="hall_name" size=80 value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['hall_name']); ?>
"></td>
</tr>
<tr>
<td bgcolor=#FFE7D6><b>会場属性</b></td>
<td align=left>
	<table width=300>
	<td>
	<input type="radio" name="hall_attribute" value="0" onclick="Sel()"
	<?php if ($this->_tpl_vars['post_data']['hall_attribute'] == 0): ?>checked<?php endif; ?>>AO管理会議室
	</td>
	<td>
	<input type="radio" name="hall_attribute" value="1" onclick="Sel()"
	<?php if ($this->_tpl_vars['post_data']['hall_attribute'] == 1): ?>checked<?php endif; ?>>シェア会議室
	</td>
	</table>
</td>
</tr>
<tr>
<td bgcolor=#FFE7D6><b>運営状態</b></td>
<td align=left><b>停止中（デフォルト）</b></td>
</tr>
<tr>
<td bgcolor=#FFE7D6><b>キャンセル有効期間</b></td>
<td align=left><input type="text" name="cancel_days" size=5 value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['cancel_days']); ?>
"> 日前までキャンセル有効</td>
</tr>
<tr>
<td bgcolor=#FFE7D6><b>総部屋数</b></td>
<td align=left><input type"text" name="rooms" size=5 value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['rooms']); ?>
"> 部屋</td>
</tr>
<tr>
<td bgcolor=#FFE7D6><b>利用可能時間</b></td>
<td align=left>
	<span class="spDate">
		<label class="lbDate">平日</label>
		<select name="begin1" onChange="f_begin(this,1)">
			<option value="">開始時間</option>
						<option value="1" <?php if ($this->_tpl_vars['post_data']['begin1'] == 1): ?>selected<?php endif; ?>>01</option>
			<option value="2" <?php if ($this->_tpl_vars['post_data']['begin1'] == 2): ?>selected<?php endif; ?>>02</option>
			<option value="3" <?php if ($this->_tpl_vars['post_data']['begin1'] == 3): ?>selected<?php endif; ?>>03</option>
			<option value="4" <?php if ($this->_tpl_vars['post_data']['begin1'] == 4): ?>selected<?php endif; ?>>04</option>
			<option value="5" <?php if ($this->_tpl_vars['post_data']['begin1'] == 5): ?>selected<?php endif; ?>>05</option>
			<option value="6" <?php if ($this->_tpl_vars['post_data']['begin1'] == 6): ?>selected<?php endif; ?>>06</option>
			<option value="7" <?php if ($this->_tpl_vars['post_data']['begin1'] == 7): ?>selected<?php endif; ?>>07</option>
			<option value="8" <?php if ($this->_tpl_vars['post_data']['begin1'] == 8): ?>selected<?php endif; ?>>08</option>
			<option value="9" <?php if ($this->_tpl_vars['post_data']['begin1'] == 9): ?>selected<?php endif; ?>>09</option>
			<option value="10" <?php if ($this->_tpl_vars['post_data']['begin1'] == 10): ?>selected<?php endif; ?>>10</option>
			<option value="11" <?php if ($this->_tpl_vars['post_data']['begin1'] == 11): ?>selected<?php endif; ?>>11</option>
			<option value="12" <?php if ($this->_tpl_vars['post_data']['begin1'] == 12): ?>selected<?php endif; ?>>12</option>
			<option value="13" <?php if ($this->_tpl_vars['post_data']['begin1'] == 13): ?>selected<?php endif; ?>>13</option>
			<option value="14" <?php if ($this->_tpl_vars['post_data']['begin1'] == 14): ?>selected<?php endif; ?>>14</option>
			<option value="15" <?php if ($this->_tpl_vars['post_data']['begin1'] == 15): ?>selected<?php endif; ?>>15</option>
			<option value="16" <?php if ($this->_tpl_vars['post_data']['begin1'] == 16): ?>selected<?php endif; ?>>16</option>
			<option value="17" <?php if ($this->_tpl_vars['post_data']['begin1'] == 17): ?>selected<?php endif; ?>>17</option>
			<option value="18" <?php if ($this->_tpl_vars['post_data']['begin1'] == 18): ?>selected<?php endif; ?>>18</option>
			<option value="19" <?php if ($this->_tpl_vars['post_data']['begin1'] == 19): ?>selected<?php endif; ?>>19</option>
			<option value="20" <?php if ($this->_tpl_vars['post_data']['begin1'] == 20): ?>selected<?php endif; ?>>20</option>
			<option value="21" <?php if ($this->_tpl_vars['post_data']['begin1'] == 21): ?>selected<?php endif; ?>>21</option>
			<option value="22" <?php if ($this->_tpl_vars['post_data']['begin1'] == 22): ?>selected<?php endif; ?>>22</option>
			<option value="23" <?php if ($this->_tpl_vars['post_data']['begin1'] == 23): ?>selected<?php endif; ?>>23</option>
			<option value="24" <?php if ($this->_tpl_vars['post_data']['begin1'] == 24): ?>selected<?php endif; ?>>24</option>
		</select>
		 時から 
		<select name="finish1">
			<option value="">開始時間</option>
						<option value="1" <?php if ($this->_tpl_vars['post_data']['finish1'] == 1): ?>selected<?php endif; ?>>01</option>
			<option value="2" <?php if ($this->_tpl_vars['post_data']['finish1'] == 2): ?>selected<?php endif; ?>>02</option>
			<option value="3" <?php if ($this->_tpl_vars['post_data']['finish1'] == 3): ?>selected<?php endif; ?>>03</option>
			<option value="4" <?php if ($this->_tpl_vars['post_data']['finish1'] == 4): ?>selected<?php endif; ?>>04</option>
			<option value="5" <?php if ($this->_tpl_vars['post_data']['finish1'] == 5): ?>selected<?php endif; ?>>05</option>
			<option value="6" <?php if ($this->_tpl_vars['post_data']['finish1'] == 6): ?>selected<?php endif; ?>>06</option>
			<option value="7" <?php if ($this->_tpl_vars['post_data']['finish1'] == 7): ?>selected<?php endif; ?>>07</option>
			<option value="8" <?php if ($this->_tpl_vars['post_data']['finish1'] == 8): ?>selected<?php endif; ?>>08</option>
			<option value="9" <?php if ($this->_tpl_vars['post_data']['finish1'] == 9): ?>selected<?php endif; ?>>09</option>
			<option value="10" <?php if ($this->_tpl_vars['post_data']['finish1'] == 10): ?>selected<?php endif; ?>>10</option>
			<option value="11" <?php if ($this->_tpl_vars['post_data']['finish1'] == 11): ?>selected<?php endif; ?>>11</option>
			<option value="12" <?php if ($this->_tpl_vars['post_data']['finish1'] == 12): ?>selected<?php endif; ?>>12</option>
			<option value="13" <?php if ($this->_tpl_vars['post_data']['finish1'] == 13): ?>selected<?php endif; ?>>13</option>
			<option value="14" <?php if ($this->_tpl_vars['post_data']['finish1'] == 14): ?>selected<?php endif; ?>>14</option>
			<option value="15" <?php if ($this->_tpl_vars['post_data']['finish1'] == 15): ?>selected<?php endif; ?>>15</option>
			<option value="16" <?php if ($this->_tpl_vars['post_data']['finish1'] == 16): ?>selected<?php endif; ?>>16</option>
			<option value="17" <?php if ($this->_tpl_vars['post_data']['finish1'] == 17): ?>selected<?php endif; ?>>17</option>
			<option value="18" <?php if ($this->_tpl_vars['post_data']['finish1'] == 18): ?>selected<?php endif; ?>>18</option>
			<option value="19" <?php if ($this->_tpl_vars['post_data']['finish1'] == 19): ?>selected<?php endif; ?>>19</option>
			<option value="20" <?php if ($this->_tpl_vars['post_data']['finish1'] == 20): ?>selected<?php endif; ?>>20</option>
			<option value="21" <?php if ($this->_tpl_vars['post_data']['finish1'] == 21): ?>selected<?php endif; ?>>21</option>
			<option value="22" <?php if ($this->_tpl_vars['post_data']['finish1'] == 22): ?>selected<?php endif; ?>>22</option>
			<option value="23" <?php if ($this->_tpl_vars['post_data']['finish1'] == 23): ?>selected<?php endif; ?>>23</option>
			<option value="24" <?php if ($this->_tpl_vars['post_data']['finish1'] == 24): ?>selected<?php endif; ?>>24</option>
		</select> 時まで
	</span>
	<span class="spDate">
		<label class="lbDate">土曜日</label>
		<select name="begin2" onChange="f_begin(this,2)">
			<option value="">開始時間</option>
						<option value="1" <?php if ($this->_tpl_vars['post_data']['begin2'] == 1): ?>selected<?php endif; ?>>01</option>
			<option value="2" <?php if ($this->_tpl_vars['post_data']['begin2'] == 2): ?>selected<?php endif; ?>>02</option>
			<option value="3" <?php if ($this->_tpl_vars['post_data']['begin2'] == 3): ?>selected<?php endif; ?>>03</option>
			<option value="4" <?php if ($this->_tpl_vars['post_data']['begin2'] == 4): ?>selected<?php endif; ?>>04</option>
			<option value="5" <?php if ($this->_tpl_vars['post_data']['begin2'] == 5): ?>selected<?php endif; ?>>05</option>
			<option value="6" <?php if ($this->_tpl_vars['post_data']['begin2'] == 6): ?>selected<?php endif; ?>>06</option>
			<option value="7" <?php if ($this->_tpl_vars['post_data']['begin2'] == 7): ?>selected<?php endif; ?>>07</option>
			<option value="8" <?php if ($this->_tpl_vars['post_data']['begin2'] == 8): ?>selected<?php endif; ?>>08</option>
			<option value="9" <?php if ($this->_tpl_vars['post_data']['begin2'] == 9): ?>selected<?php endif; ?>>09</option>
			<option value="10" <?php if ($this->_tpl_vars['post_data']['begin2'] == 10): ?>selected<?php endif; ?>>10</option>
			<option value="11" <?php if ($this->_tpl_vars['post_data']['begin2'] == 11): ?>selected<?php endif; ?>>11</option>
			<option value="12" <?php if ($this->_tpl_vars['post_data']['begin2'] == 12): ?>selected<?php endif; ?>>12</option>
			<option value="13" <?php if ($this->_tpl_vars['post_data']['begin2'] == 13): ?>selected<?php endif; ?>>13</option>
			<option value="14" <?php if ($this->_tpl_vars['post_data']['begin2'] == 14): ?>selected<?php endif; ?>>14</option>
			<option value="15" <?php if ($this->_tpl_vars['post_data']['begin2'] == 15): ?>selected<?php endif; ?>>15</option>
			<option value="16" <?php if ($this->_tpl_vars['post_data']['begin2'] == 16): ?>selected<?php endif; ?>>16</option>
			<option value="17" <?php if ($this->_tpl_vars['post_data']['begin2'] == 17): ?>selected<?php endif; ?>>17</option>
			<option value="18" <?php if ($this->_tpl_vars['post_data']['begin2'] == 18): ?>selected<?php endif; ?>>18</option>
			<option value="19" <?php if ($this->_tpl_vars['post_data']['begin2'] == 19): ?>selected<?php endif; ?>>19</option>
			<option value="20" <?php if ($this->_tpl_vars['post_data']['begin2'] == 20): ?>selected<?php endif; ?>>20</option>
			<option value="21" <?php if ($this->_tpl_vars['post_data']['begin2'] == 21): ?>selected<?php endif; ?>>21</option>
			<option value="22" <?php if ($this->_tpl_vars['post_data']['begin2'] == 22): ?>selected<?php endif; ?>>22</option>
			<option value="23" <?php if ($this->_tpl_vars['post_data']['begin2'] == 23): ?>selected<?php endif; ?>>23</option>
			<option value="24" <?php if ($this->_tpl_vars['post_data']['begin2'] == 24): ?>selected<?php endif; ?>>24</option>
		</select>
		 時から 
		<select name="finish2">
			<option value="">開始時間</option>
						<option value="1" <?php if ($this->_tpl_vars['post_data']['finish2'] == 1): ?>selected<?php endif; ?>>01</option>
			<option value="2" <?php if ($this->_tpl_vars['post_data']['finish2'] == 2): ?>selected<?php endif; ?>>02</option>
			<option value="3" <?php if ($this->_tpl_vars['post_data']['finish2'] == 3): ?>selected<?php endif; ?>>03</option>
			<option value="4" <?php if ($this->_tpl_vars['post_data']['finish2'] == 4): ?>selected<?php endif; ?>>04</option>
			<option value="5" <?php if ($this->_tpl_vars['post_data']['finish2'] == 5): ?>selected<?php endif; ?>>05</option>
			<option value="6" <?php if ($this->_tpl_vars['post_data']['finish2'] == 6): ?>selected<?php endif; ?>>06</option>
			<option value="7" <?php if ($this->_tpl_vars['post_data']['finish2'] == 7): ?>selected<?php endif; ?>>07</option>
			<option value="8" <?php if ($this->_tpl_vars['post_data']['finish2'] == 8): ?>selected<?php endif; ?>>08</option>
			<option value="9" <?php if ($this->_tpl_vars['post_data']['finish2'] == 9): ?>selected<?php endif; ?>>09</option>
			<option value="10" <?php if ($this->_tpl_vars['post_data']['finish2'] == 10): ?>selected<?php endif; ?>>10</option>
			<option value="11" <?php if ($this->_tpl_vars['post_data']['finish2'] == 11): ?>selected<?php endif; ?>>11</option>
			<option value="12" <?php if ($this->_tpl_vars['post_data']['finish2'] == 12): ?>selected<?php endif; ?>>12</option>
			<option value="13" <?php if ($this->_tpl_vars['post_data']['finish2'] == 13): ?>selected<?php endif; ?>>13</option>
			<option value="14" <?php if ($this->_tpl_vars['post_data']['finish2'] == 14): ?>selected<?php endif; ?>>14</option>
			<option value="15" <?php if ($this->_tpl_vars['post_data']['finish2'] == 15): ?>selected<?php endif; ?>>15</option>
			<option value="16" <?php if ($this->_tpl_vars['post_data']['finish2'] == 16): ?>selected<?php endif; ?>>16</option>
			<option value="17" <?php if ($this->_tpl_vars['post_data']['finish2'] == 17): ?>selected<?php endif; ?>>17</option>
			<option value="18" <?php if ($this->_tpl_vars['post_data']['finish2'] == 18): ?>selected<?php endif; ?>>18</option>
			<option value="19" <?php if ($this->_tpl_vars['post_data']['finish2'] == 19): ?>selected<?php endif; ?>>19</option>
			<option value="20" <?php if ($this->_tpl_vars['post_data']['finish2'] == 20): ?>selected<?php endif; ?>>20</option>
			<option value="21" <?php if ($this->_tpl_vars['post_data']['finish2'] == 21): ?>selected<?php endif; ?>>21</option>
			<option value="22" <?php if ($this->_tpl_vars['post_data']['finish2'] == 22): ?>selected<?php endif; ?>>22</option>
			<option value="23" <?php if ($this->_tpl_vars['post_data']['finish2'] == 23): ?>selected<?php endif; ?>>23</option>
			<option value="24" <?php if ($this->_tpl_vars['post_data']['finish2'] == 24): ?>selected<?php endif; ?>>24</option>
		</select> 時まで
	</span>	<span class="spDate">
		<label class="lbDate">日曜日</label>
		<select name="begin3" onChange="f_begin(this,3)">
			<option value="">開始時間</option>
						<option value="1" <?php if ($this->_tpl_vars['post_data']['begin3'] == 1): ?>selected<?php endif; ?>>01</option>
			<option value="2" <?php if ($this->_tpl_vars['post_data']['begin3'] == 2): ?>selected<?php endif; ?>>02</option>
			<option value="3" <?php if ($this->_tpl_vars['post_data']['begin3'] == 3): ?>selected<?php endif; ?>>03</option>
			<option value="4" <?php if ($this->_tpl_vars['post_data']['begin3'] == 4): ?>selected<?php endif; ?>>04</option>
			<option value="5" <?php if ($this->_tpl_vars['post_data']['begin3'] == 5): ?>selected<?php endif; ?>>05</option>
			<option value="6" <?php if ($this->_tpl_vars['post_data']['begin3'] == 6): ?>selected<?php endif; ?>>06</option>
			<option value="7" <?php if ($this->_tpl_vars['post_data']['begin3'] == 7): ?>selected<?php endif; ?>>07</option>
			<option value="8" <?php if ($this->_tpl_vars['post_data']['begin3'] == 8): ?>selected<?php endif; ?>>08</option>
			<option value="9" <?php if ($this->_tpl_vars['post_data']['begin3'] == 9): ?>selected<?php endif; ?>>09</option>
			<option value="10" <?php if ($this->_tpl_vars['post_data']['begin3'] == 10): ?>selected<?php endif; ?>>10</option>
			<option value="11" <?php if ($this->_tpl_vars['post_data']['begin3'] == 11): ?>selected<?php endif; ?>>11</option>
			<option value="12" <?php if ($this->_tpl_vars['post_data']['begin3'] == 12): ?>selected<?php endif; ?>>12</option>
			<option value="13" <?php if ($this->_tpl_vars['post_data']['begin3'] == 13): ?>selected<?php endif; ?>>13</option>
			<option value="14" <?php if ($this->_tpl_vars['post_data']['begin3'] == 14): ?>selected<?php endif; ?>>14</option>
			<option value="15" <?php if ($this->_tpl_vars['post_data']['begin3'] == 15): ?>selected<?php endif; ?>>15</option>
			<option value="16" <?php if ($this->_tpl_vars['post_data']['begin3'] == 16): ?>selected<?php endif; ?>>16</option>
			<option value="17" <?php if ($this->_tpl_vars['post_data']['begin3'] == 17): ?>selected<?php endif; ?>>17</option>
			<option value="18" <?php if ($this->_tpl_vars['post_data']['begin3'] == 18): ?>selected<?php endif; ?>>18</option>
			<option value="19" <?php if ($this->_tpl_vars['post_data']['begin3'] == 19): ?>selected<?php endif; ?>>19</option>
			<option value="20" <?php if ($this->_tpl_vars['post_data']['begin3'] == 20): ?>selected<?php endif; ?>>20</option>
			<option value="21" <?php if ($this->_tpl_vars['post_data']['begin3'] == 21): ?>selected<?php endif; ?>>21</option>
			<option value="22" <?php if ($this->_tpl_vars['post_data']['begin3'] == 22): ?>selected<?php endif; ?>>22</option>
			<option value="23" <?php if ($this->_tpl_vars['post_data']['begin3'] == 23): ?>selected<?php endif; ?>>23</option>
			<option value="24" <?php if ($this->_tpl_vars['post_data']['begin3'] == 24): ?>selected<?php endif; ?>>24</option>
		</select>
		 時から 
		<select name="finish3">
			<option value="">開始時間</option>
						<option value="1" <?php if ($this->_tpl_vars['post_data']['finish3'] == 1): ?>selected<?php endif; ?>>01</option>
			<option value="2" <?php if ($this->_tpl_vars['post_data']['finish3'] == 2): ?>selected<?php endif; ?>>02</option>
			<option value="3" <?php if ($this->_tpl_vars['post_data']['finish3'] == 3): ?>selected<?php endif; ?>>03</option>
			<option value="4" <?php if ($this->_tpl_vars['post_data']['finish3'] == 4): ?>selected<?php endif; ?>>04</option>
			<option value="5" <?php if ($this->_tpl_vars['post_data']['finish3'] == 5): ?>selected<?php endif; ?>>05</option>
			<option value="6" <?php if ($this->_tpl_vars['post_data']['finish3'] == 6): ?>selected<?php endif; ?>>06</option>
			<option value="7" <?php if ($this->_tpl_vars['post_data']['finish3'] == 7): ?>selected<?php endif; ?>>07</option>
			<option value="8" <?php if ($this->_tpl_vars['post_data']['finish3'] == 8): ?>selected<?php endif; ?>>08</option>
			<option value="9" <?php if ($this->_tpl_vars['post_data']['finish3'] == 9): ?>selected<?php endif; ?>>09</option>
			<option value="10" <?php if ($this->_tpl_vars['post_data']['finish3'] == 10): ?>selected<?php endif; ?>>10</option>
			<option value="11" <?php if ($this->_tpl_vars['post_data']['finish3'] == 11): ?>selected<?php endif; ?>>11</option>
			<option value="12" <?php if ($this->_tpl_vars['post_data']['finish3'] == 12): ?>selected<?php endif; ?>>12</option>
			<option value="13" <?php if ($this->_tpl_vars['post_data']['finish3'] == 13): ?>selected<?php endif; ?>>13</option>
			<option value="14" <?php if ($this->_tpl_vars['post_data']['finish3'] == 14): ?>selected<?php endif; ?>>14</option>
			<option value="15" <?php if ($this->_tpl_vars['post_data']['finish3'] == 15): ?>selected<?php endif; ?>>15</option>
			<option value="16" <?php if ($this->_tpl_vars['post_data']['finish3'] == 16): ?>selected<?php endif; ?>>16</option>
			<option value="17" <?php if ($this->_tpl_vars['post_data']['finish3'] == 17): ?>selected<?php endif; ?>>17</option>
			<option value="18" <?php if ($this->_tpl_vars['post_data']['finish3'] == 18): ?>selected<?php endif; ?>>18</option>
			<option value="19" <?php if ($this->_tpl_vars['post_data']['finish3'] == 19): ?>selected<?php endif; ?>>19</option>
			<option value="20" <?php if ($this->_tpl_vars['post_data']['finish3'] == 20): ?>selected<?php endif; ?>>20</option>
			<option value="21" <?php if ($this->_tpl_vars['post_data']['finish3'] == 21): ?>selected<?php endif; ?>>21</option>
			<option value="22" <?php if ($this->_tpl_vars['post_data']['finish3'] == 22): ?>selected<?php endif; ?>>22</option>
			<option value="23" <?php if ($this->_tpl_vars['post_data']['finish3'] == 23): ?>selected<?php endif; ?>>23</option>
			<option value="24" <?php if ($this->_tpl_vars['post_data']['finish3'] == 24): ?>selected<?php endif; ?>>24</option>
		</select> 時まで
	</span>
	<span class="spDate">
		<label class="lbDate">祝日</label>		
		<select name="begin4" onChange="f_begin(this,4)">
			<option value="">開始時間</option>
						<option value="1" <?php if ($this->_tpl_vars['post_data']['begin4'] == 1): ?>selected<?php endif; ?>>01</option>
			<option value="2" <?php if ($this->_tpl_vars['post_data']['begin4'] == 2): ?>selected<?php endif; ?>>02</option>
			<option value="3" <?php if ($this->_tpl_vars['post_data']['begin4'] == 3): ?>selected<?php endif; ?>>03</option>
			<option value="4" <?php if ($this->_tpl_vars['post_data']['begin4'] == 4): ?>selected<?php endif; ?>>04</option>
			<option value="5" <?php if ($this->_tpl_vars['post_data']['begin4'] == 5): ?>selected<?php endif; ?>>05</option>
			<option value="6" <?php if ($this->_tpl_vars['post_data']['begin4'] == 6): ?>selected<?php endif; ?>>06</option>
			<option value="7" <?php if ($this->_tpl_vars['post_data']['begin4'] == 7): ?>selected<?php endif; ?>>07</option>
			<option value="8" <?php if ($this->_tpl_vars['post_data']['begin4'] == 8): ?>selected<?php endif; ?>>08</option>
			<option value="9" <?php if ($this->_tpl_vars['post_data']['begin4'] == 9): ?>selected<?php endif; ?>>09</option>
			<option value="10" <?php if ($this->_tpl_vars['post_data']['begin4'] == 10): ?>selected<?php endif; ?>>10</option>
			<option value="11" <?php if ($this->_tpl_vars['post_data']['begin4'] == 11): ?>selected<?php endif; ?>>11</option>
			<option value="12" <?php if ($this->_tpl_vars['post_data']['begin4'] == 12): ?>selected<?php endif; ?>>12</option>
			<option value="13" <?php if ($this->_tpl_vars['post_data']['begin4'] == 13): ?>selected<?php endif; ?>>13</option>
			<option value="14" <?php if ($this->_tpl_vars['post_data']['begin4'] == 14): ?>selected<?php endif; ?>>14</option>
			<option value="15" <?php if ($this->_tpl_vars['post_data']['begin4'] == 15): ?>selected<?php endif; ?>>15</option>
			<option value="16" <?php if ($this->_tpl_vars['post_data']['begin4'] == 16): ?>selected<?php endif; ?>>16</option>
			<option value="17" <?php if ($this->_tpl_vars['post_data']['begin4'] == 17): ?>selected<?php endif; ?>>17</option>
			<option value="18" <?php if ($this->_tpl_vars['post_data']['begin4'] == 18): ?>selected<?php endif; ?>>18</option>
			<option value="19" <?php if ($this->_tpl_vars['post_data']['begin4'] == 19): ?>selected<?php endif; ?>>19</option>
			<option value="20" <?php if ($this->_tpl_vars['post_data']['begin4'] == 20): ?>selected<?php endif; ?>>20</option>
			<option value="21" <?php if ($this->_tpl_vars['post_data']['begin4'] == 21): ?>selected<?php endif; ?>>21</option>
			<option value="22" <?php if ($this->_tpl_vars['post_data']['begin4'] == 22): ?>selected<?php endif; ?>>22</option>
			<option value="23" <?php if ($this->_tpl_vars['post_data']['begin4'] == 23): ?>selected<?php endif; ?>>23</option>
			<option value="24" <?php if ($this->_tpl_vars['post_data']['begin4'] == 24): ?>selected<?php endif; ?>>24</option>
		</select>
			 時から 
		<select name="finish4">
			<option value="">開始時間</option>
						<option value="1" <?php if ($this->_tpl_vars['post_data']['finish4'] == 1): ?>selected<?php endif; ?>>01</option>
			<option value="2" <?php if ($this->_tpl_vars['post_data']['finish4'] == 2): ?>selected<?php endif; ?>>02</option>
			<option value="3" <?php if ($this->_tpl_vars['post_data']['finish4'] == 3): ?>selected<?php endif; ?>>03</option>
			<option value="4" <?php if ($this->_tpl_vars['post_data']['finish4'] == 4): ?>selected<?php endif; ?>>04</option>
			<option value="5" <?php if ($this->_tpl_vars['post_data']['finish4'] == 5): ?>selected<?php endif; ?>>05</option>
			<option value="6" <?php if ($this->_tpl_vars['post_data']['finish4'] == 6): ?>selected<?php endif; ?>>06</option>
			<option value="7" <?php if ($this->_tpl_vars['post_data']['finish4'] == 7): ?>selected<?php endif; ?>>07</option>
			<option value="8" <?php if ($this->_tpl_vars['post_data']['finish4'] == 8): ?>selected<?php endif; ?>>08</option>
			<option value="9" <?php if ($this->_tpl_vars['post_data']['finish4'] == 9): ?>selected<?php endif; ?>>09</option>
			<option value="10" <?php if ($this->_tpl_vars['post_data']['finish4'] == 10): ?>selected<?php endif; ?>>10</option>
			<option value="11" <?php if ($this->_tpl_vars['post_data']['finish4'] == 11): ?>selected<?php endif; ?>>11</option>
			<option value="12" <?php if ($this->_tpl_vars['post_data']['finish4'] == 12): ?>selected<?php endif; ?>>12</option>
			<option value="13" <?php if ($this->_tpl_vars['post_data']['finish4'] == 13): ?>selected<?php endif; ?>>13</option>
			<option value="14" <?php if ($this->_tpl_vars['post_data']['finish4'] == 14): ?>selected<?php endif; ?>>14</option>
			<option value="15" <?php if ($this->_tpl_vars['post_data']['finish4'] == 15): ?>selected<?php endif; ?>>15</option>
			<option value="16" <?php if ($this->_tpl_vars['post_data']['finish4'] == 16): ?>selected<?php endif; ?>>16</option>
			<option value="17" <?php if ($this->_tpl_vars['post_data']['finish4'] == 17): ?>selected<?php endif; ?>>17</option>
			<option value="18" <?php if ($this->_tpl_vars['post_data']['finish4'] == 18): ?>selected<?php endif; ?>>18</option>
			<option value="19" <?php if ($this->_tpl_vars['post_data']['finish4'] == 19): ?>selected<?php endif; ?>>19</option>
			<option value="20" <?php if ($this->_tpl_vars['post_data']['finish4'] == 20): ?>selected<?php endif; ?>>20</option>
			<option value="21" <?php if ($this->_tpl_vars['post_data']['finish4'] == 21): ?>selected<?php endif; ?>>21</option>
			<option value="22" <?php if ($this->_tpl_vars['post_data']['finish4'] == 22): ?>selected<?php endif; ?>>22</option>
			<option value="23" <?php if ($this->_tpl_vars['post_data']['finish4'] == 23): ?>selected<?php endif; ?>>23</option>
			<option value="24" <?php if ($this->_tpl_vars['post_data']['finish4'] == 24): ?>selected<?php endif; ?>>24</option>
		</select> 時まで</td>
</tr>
<tr>
<td bgcolor=#FFE7D6><b>予約可能日程範囲</b></td>
<td align=left>
<select name="reservation_month">
<option value="1" <?php if ($this->_tpl_vars['post_data']['reservation_month'] == 1): ?>selected<?php endif; ?>>1ヶ月</option>
<option value="2" <?php if ($this->_tpl_vars['post_data']['reservation_month'] == 2): ?>selected<?php endif; ?>>2ヶ月</option>
<option value="3" <?php if ($this->_tpl_vars['post_data']['reservation_month'] == 3): ?>selected<?php endif; ?>>3ヶ月</option>
<option value="4" <?php if ($this->_tpl_vars['post_data']['reservation_month'] == 4): ?>selected<?php endif; ?>>4ヶ月</option>
<option value="5" <?php if ($this->_tpl_vars['post_data']['reservation_month'] == 5): ?>selected<?php endif; ?>>5ヶ月</option>
<option value="6" <?php if ($this->_tpl_vars['post_data']['reservation_month'] == 6): ?>selected<?php endif; ?>>6ヶ月</option>
<option value="7" <?php if ($this->_tpl_vars['post_data']['reservation_month'] == 7): ?>selected<?php endif; ?>>7ヶ月</option>
<option value="8" <?php if ($this->_tpl_vars['post_data']['reservation_month'] == 8): ?>selected<?php endif; ?>>8ヶ月</option>
<option value="9" <?php if ($this->_tpl_vars['post_data']['reservation_month'] == 9): ?>selected<?php endif; ?>>9ヶ月</option>
<option value="10" <?php if ($this->_tpl_vars['post_data']['reservation_month'] == 10): ?>selected<?php endif; ?>>10ヶ月</option>
<option value="11" <?php if ($this->_tpl_vars['post_data']['reservation_month'] == 11): ?>selected<?php endif; ?>>11ヶ月</option>
<option value="12" <?php if ($this->_tpl_vars['post_data']['reservation_month'] == 12): ?>selected<?php endif; ?>>12ヶ月</option>
</select> 先まで予約可能<br>
</td>
</tr>
<tr>
<td bgcolor=#FFE7D6><b>振込方式</b></td>
<td align=left>
	<table width=350>
	<td>
	<input type="radio" name="bank_flag" value="0" onclick="Sel()" <?php if ($this->_tpl_vars['post_data']['bank_flag'] == 0): ?>checked<?php endif; ?>>バーチャル口座
	</td>
	</table>
</td>
</tr>
<tr>
<td bgcolor=#FFE7D6><b>看板出力</b></td>
<td align=left>
	<table width=350>
	<td>
	<input type="radio" name="kanban" value="0" onclick="Sel()" <?php if ($this->_tpl_vars['post_data']['kanban'] == 0): ?>checked<?php endif; ?>>準備担当が印刷
	</td>
	<td>
	<input type="radio" name="kanban" value="1" onclick="Sel()" <?php if ($this->_tpl_vars['post_data']['kanban'] == 1): ?>checked<?php endif; ?>>セルフサービス
	</td>
	</table>
</td>
</tr>
<tr>
<td bgcolor=#FFE7D6><b>予約形態</b></td>
<td align=left>
	<table width=350>
	<td>
	<input type="radio" name="web_reserve" value="0" onclick="Sel()" <?php if ($this->_tpl_vars['post_data']['web_reserve'] == 0): ?>checked<?php endif; ?>>電話でのみ予約受け付け
	</td>
	<td>
	<input type="radio" name="web_reserve" value="1" onclick="Sel()" <?php if ($this->_tpl_vars['post_data']['web_reserve'] == 1): ?>checked<?php endif; ?>>Webからも予約を受付する
	</td>
	</table>
</td>

</tr>
<tr>
<td bgcolor=#FFE7D6><b>オーナー収益配分</b></td>
<td align=left>
	<table>
	<td>
		部屋の収益配分：
		<input type="text" name="owner_room" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['owner_room']); ?>
" size=8 style="text-align:right;padding-right:5px;">％
	</td>
	<td width=10>
	</td>
	<td>
		備品の収益配分：
		<input type="text" name="owner_vessel" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['owner_vessel']); ?>
" size=8 style="text-align:right;padding-right:5px;">％
	</td>
	</table>
</td>
</tr>
<tr>
<td bgcolor=#FFE7D6><b>プルダウン順序設定</b></td>
<td align=left>
		<input type="text" name="pulldown" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['pulldown']); ?>
" size=8 style="text-align:right;padding-right:5px;">※数値の大きい順に表示されます。（数値が同じ場合は会場を登録した順です）<br>
現在の設定:
<select>
<option style="font-weight:bold">(数値)[会場名]</option>
<?php $_from = $this->_tpl_vars['pulldown']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
	<?php if ($this->_tpl_vars['item']['flag'] == 0): ?>
		<option style="color:green;">(<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['pulldown']); ?>
)<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['hall_name']); ?>
</option>
	<?php elseif ($this->_tpl_vars['item']['flag'] == 1): ?>
		<option style="color:blue;">(<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['pulldown']); ?>
)<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['hall_name']); ?>
</option>
	<?php else: ?>
		<option style="color:red;">(<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['pulldown']); ?>
)<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['hall_name']); ?>
</option>
	<?php endif; ?>
<?php endforeach; endif; unset($_from); ?>
</select>
(緑：運営中　青：メンテ中　赤：停止中)
</td>
</tr>
<tr>
<td bgcolor=#FFE7D6><b>一般利用可能</b></td>
<td class="tdspec">		
	<?php if ($this->_tpl_vars['post_data']['hall_id']): ?>
		
		<div class="spDate">
			<input type="checkbox" <?php $_from = $this->_tpl_vars['result1']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?> <?php if ($this->_tpl_vars['item'] == '1'): ?> checked <?php endif; ?> <?php endforeach; endif; unset($_from); ?> name="usedate[]" value="1" class="listcheckUsesp"> 平日
				<?php $_from = $this->_tpl_vars['result2']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>	
				<select name="begin_often1">				
					<script>
						var a = '<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['begin_often1']); ?>
';
						for(var i = 1; i <= 24; i++){							
							if(a == i){
								if(i<10){
									document.write('<option selected value="'+i+'">0'+i+'</option>');	
								}
								else
								{
									document.write('<option selected value="'+i+'">'+i+'</option>');
								}
							}
							else{
								if(i<10)
									{document.write('<option value="'+i+'">0'+i+'</option>');
								}
								else
								{
									document.write('<option  value="'+i+'">'+i+'</option>');
								}
							}
						}						
					</script>	
				</select>
				時から
				<select name="finish_often1">				
					<script>
						var a = '<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['finish_often1']); ?>
';
						for(var i = 1; i <= 24; i++){							
							if(a == i){
								if(i<10){
									document.write('<option selected value="'+i+'">0'+i+'</option>');	
								}
								else
								{
									document.write('<option selected value="'+i+'">'+i+'</option>');
								}
							}
							else{
								if(i<10)
									{document.write('<option value="'+i+'">0'+i+'</option>');
								}
								else
								{
									document.write('<option  value="'+i+'">'+i+'</option>');
								}
							}
						}						
					</script>	
				</select>
				時まで
				<?php endforeach; endif; unset($_from); ?>
				<?php if ($this->_tpl_vars['result2'] == ''): ?>
						<select name="begin_often1">				
							<script>
								var a = '<?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['begin_often1']); ?>
';
								for(var i = 1; i <= 24; i++){							
									if(a == i){
										if(i<10){
											document.write('<option selected value="'+i+'">0'+i+'</option>');	
										}
										else
										{
											document.write('<option selected value="'+i+'">'+i+'</option>');
										}
									}
									else{
										if(i<10)
											{document.write('<option value="'+i+'">0'+i+'</option>');
										}
										else
										{
											document.write('<option  value="'+i+'">'+i+'</option>');
										}
									}
								}						
							</script>	
						</select>
						時から
						<select name="finish_often1">				
							<script>		
								var a = '<?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['finish_often1']); ?>
';
								for(var i = 1; i <= 24; i++){							
									if(a == i){
										if(i<10){
											document.write('<option selected value="'+i+'">0'+i+'</option>');	
										}
										else
										{
											document.write('<option selected value="'+i+'">'+i+'</option>');
										}
									}
									else{
										if(i<10)
											{document.write('<option value="'+i+'">0'+i+'</option>');
										}
										else
										{
											document.write('<option  value="'+i+'">'+i+'</option>');
										}
									}
								}						
							</script>	
						</select>
				
				<?php endif; ?>				
			</div>
		
		<div class="spDate">
			<input type="checkbox" <?php $_from = $this->_tpl_vars['result1']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?> <?php if ($this->_tpl_vars['item'] == '2'): ?> checked <?php endif; ?> <?php endforeach; endif; unset($_from); ?> name="usedate[]" value="2" class="listcheckUsesp"> 土曜日
			<?php $_from = $this->_tpl_vars['result2']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>	
				<select name="begin_often2">				
					<script>
						var a = '<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['begin_often2']); ?>
';
						for(var i = 1; i <= 24; i++){							
							if(a == i){
								if(i<10){
									document.write('<option selected value="'+i+'">0'+i+'</option>');	
								}
								else
								{
									document.write('<option selected value="'+i+'">'+i+'</option>');
								}
							}
							else{
								if(i<10)
									{document.write('<option value="'+i+'">0'+i+'</option>');
								}
								else
								{
									document.write('<option  value="'+i+'">'+i+'</option>');
								}
							}
						}						
					</script>	
				</select>
				時から
				<select name="finish_often2">				
					<script>
						var a = '<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['finish_often2']); ?>
';
						for(var i = 1; i <= 24; i++){							
							if(a == i){
								if(i<10){
									document.write('<option selected value="'+i+'">0'+i+'</option>');	
								}
								else
								{
									document.write('<option selected value="'+i+'">'+i+'</option>');
								}
							}
							else{
								if(i<10)
									{document.write('<option value="'+i+'">0'+i+'</option>');
								}
								else
								{
									document.write('<option  value="'+i+'">'+i+'</option>');
								}
							}
						}						
					</script>	
				</select>
				時まで
				<?php endforeach; endif; unset($_from); ?>
				<?php if ($this->_tpl_vars['result2'] == ''): ?>
					<select name="begin_often2">				
							<script>
								var a = '<?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['begin_often2']); ?>
';
								for(var i = 1; i <= 24; i++){							
									if(a == i){
										if(i<10){
											document.write('<option selected value="'+i+'">0'+i+'</option>');	
										}
										else
										{
											document.write('<option selected value="'+i+'">'+i+'</option>');
										}
									}
									else{
										if(i<10)
											{document.write('<option value="'+i+'">0'+i+'</option>');
										}
										else
										{
											document.write('<option  value="'+i+'">'+i+'</option>');
										}
									}
								}						
							</script>	
						</select>
						時から
						<select name="finish_often2">				
							<script>		
								var a = '<?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['finish_often2']); ?>
';
								for(var i = 1; i <= 24; i++){							
									if(a == i){
										if(i<10){
											document.write('<option selected value="'+i+'">0'+i+'</option>');	
										}
										else
										{
											document.write('<option selected value="'+i+'">'+i+'</option>');
										}
									}
									else{
										if(i<10)
											{document.write('<option value="'+i+'">0'+i+'</option>');
										}
										else
										{
											document.write('<option  value="'+i+'">'+i+'</option>');
										}
									}
								}						
							</script>	
						</select>
					
				<?php endif; ?>	
		</div>
		<div class="spDate">
			<input type="checkbox" <?php $_from = $this->_tpl_vars['result1']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?> <?php if ($this->_tpl_vars['item'] == '3'): ?> checked <?php endif; ?> <?php endforeach; endif; unset($_from); ?> name="usedate[]" value="3" class="listcheckUsesp"> 日曜日
		<?php $_from = $this->_tpl_vars['result2']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>	
				<select name="begin_often3">				
					<script>
						var a = '<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['begin_often3']); ?>
';
						for(var i = 1; i <= 24; i++){							
							if(a == i){
								if(i<10){
									document.write('<option selected value="'+i+'">0'+i+'</option>');	
								}
								else
								{
									document.write('<option selected value="'+i+'">'+i+'</option>');
								}
							}
							else{
								if(i<10)
									{document.write('<option value="'+i+'">0'+i+'</option>');
								}
								else
								{
									document.write('<option  value="'+i+'">'+i+'</option>');
								}
							}
						}						
					</script>	
				</select>
				時から
				<select name="finish_often3">				
					<script>
						var a = '<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['finish_often3']); ?>
';
						for(var i = 1; i <= 24; i++){							
							if(a == i){
								if(i<10){
									document.write('<option selected value="'+i+'">0'+i+'</option>');	
								}
								else
								{
									document.write('<option selected value="'+i+'">'+i+'</option>');
								}
							}
							else{
								if(i<10)
									{document.write('<option value="'+i+'">0'+i+'</option>');
								}
								else
								{
									document.write('<option  value="'+i+'">'+i+'</option>');
								}
							}
						}						
					</script>	
				</select>
				時まで
				<?php endforeach; endif; unset($_from); ?>
				<?php if ($this->_tpl_vars['result2'] == ''): ?>
						<select name="begin_often3">				
							<script>
								var a = '<?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['begin_often3']); ?>
';
								for(var i = 1; i <= 24; i++){							
									if(a == i){
										if(i<10){
											document.write('<option selected value="'+i+'">0'+i+'</option>');	
										}
										else
										{
											document.write('<option selected value="'+i+'">'+i+'</option>');
										}
									}
									else{
										if(i<10)
											{document.write('<option value="'+i+'">0'+i+'</option>');
										}
										else
										{
											document.write('<option  value="'+i+'">'+i+'</option>');
										}
									}
								}						
							</script>	
						</select>
						時から
						<select name="finish_often3">				
							<script>		
								var a = '<?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['finish_often3']); ?>
';
								for(var i = 1; i <= 24; i++){							
									if(a == i){
										if(i<10){
											document.write('<option selected value="'+i+'">0'+i+'</option>');	
										}
										else
										{
											document.write('<option selected value="'+i+'">'+i+'</option>');
										}
									}
									else{
										if(i<10)
											{document.write('<option value="'+i+'">0'+i+'</option>');
										}
										else
										{
											document.write('<option  value="'+i+'">'+i+'</option>');
										}
									}
								}						
							</script>	
						</select>
				
				<?php endif; ?>			
		</div>
		<div class="spDate">
			<input type="checkbox" <?php $_from = $this->_tpl_vars['result1']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?> <?php if ($this->_tpl_vars['item'] == '4'): ?> checked <?php endif; ?> <?php endforeach; endif; unset($_from); ?> name="usedate[]" value="4" class="listcheckUsesp"> 祝日
		<?php $_from = $this->_tpl_vars['result2']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>	
				<select name="begin_often4">				
					<script>
						var a = '<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['begin_often4']); ?>
';
						for(var i = 1; i <= 24; i++){							
							if(a == i){
								if(i<10){
									document.write('<option selected value="'+i+'">0'+i+'</option>');	
								}
								else
								{
									document.write('<option selected value="'+i+'">'+i+'</option>');
								}
							}
							else{
								if(i<10)
									{document.write('<option value="'+i+'">0'+i+'</option>');
								}
								else
								{
									document.write('<option  value="'+i+'">'+i+'</option>');
								}
							}
						}						
					</script>	
				</select>
				時から
				<select name="finish_often4">				
					<script>
						var a = '<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['finish_often4']); ?>
';
						for(var i = 1; i <= 24; i++){							
							if(a == i){
								if(i<10){
									document.write('<option selected value="'+i+'">0'+i+'</option>');	
								}
								else
								{
									document.write('<option selected value="'+i+'">'+i+'</option>');
								}
							}
							else{
								if(i<10)
									{document.write('<option value="'+i+'">0'+i+'</option>');
								}
								else
								{
									document.write('<option  value="'+i+'">'+i+'</option>');
								}
							}
						}						
					</script>	
				</select>
				時まで
				<?php endforeach; endif; unset($_from); ?>
				<?php if ($this->_tpl_vars['result2'] == ''): ?>
						<select name="begin_often4">				
							<script>
								var a = '<?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['begin_often4']); ?>
';
								for(var i = 1; i <= 24; i++){							
									if(a == i){
										if(i<10){
											document.write('<option selected value="'+i+'">0'+i+'</option>');	
										}
										else
										{
											document.write('<option selected value="'+i+'">'+i+'</option>');
										}
									}
									else{
										if(i<10)
											{document.write('<option value="'+i+'">0'+i+'</option>');
										}
										else
										{
											document.write('<option  value="'+i+'">'+i+'</option>');
										}
									}
								}						
							</script>	
						</select>
						時から
						<select name="finish_often4">				
							<script>		
								var a = '<?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['finish_often4']); ?>
';
								for(var i = 1; i <= 24; i++){							
									if(a == i){
										if(i<10){
											document.write('<option selected value="'+i+'">0'+i+'</option>');	
										}
										else
										{
											document.write('<option selected value="'+i+'">'+i+'</option>');
										}
									}
									else{
										if(i<10)
											{document.write('<option value="'+i+'">0'+i+'</option>');
										}
										else
										{
											document.write('<option  value="'+i+'">'+i+'</option>');
										}
									}
								}						
							</script>	
						</select>
				
				<?php endif; ?>			
		</div>		
		<?php else: ?>
		<div class="spDate">
			<input type="checkbox" name="usedate[]" value="1" class="listcheckUsesp"> 平日
			<select name="begin_often1">
				<option value="1" <?php if ($this->_tpl_vars['post_data']['begin_often1'] == 1): ?>selected<?php endif; ?>>01</option>
				<option value="2" <?php if ($this->_tpl_vars['post_data']['begin_often1'] == 2): ?>selected<?php endif; ?>>02</option>
				<option value="3" <?php if ($this->_tpl_vars['post_data']['begin_often1'] == 3): ?>selected<?php endif; ?>>03</option>
				<option value="4" <?php if ($this->_tpl_vars['post_data']['begin_often1'] == 4): ?>selected<?php endif; ?>>04</option>
				<option value="5" <?php if ($this->_tpl_vars['post_data']['begin_often1'] == 5): ?>selected<?php endif; ?>>05</option>
				<option value="6" <?php if ($this->_tpl_vars['post_data']['begin_often1'] == 6): ?>selected<?php endif; ?>>06</option>
				<option value="7" <?php if ($this->_tpl_vars['post_data']['begin_often1'] == 7): ?>selected<?php endif; ?>>07</option>
				<option value="8" <?php if ($this->_tpl_vars['post_data']['begin_often1'] == 8): ?>selected<?php endif; ?>>08</option>
				<option value="9" <?php if ($this->_tpl_vars['post_data']['begin_often1'] == 9): ?>selected<?php endif; ?>>09</option>
				<option value="10" <?php if ($this->_tpl_vars['post_data']['begin_often1'] == 10): ?>selected<?php endif; ?>>10</option>
				<option value="11" <?php if ($this->_tpl_vars['post_data']['begin_often1'] == 11): ?>selected<?php endif; ?>>11</option>
				<option value="12" <?php if ($this->_tpl_vars['post_data']['begin_often1'] == 12): ?>selected<?php endif; ?>>12</option>
				<option value="13" <?php if ($this->_tpl_vars['post_data']['begin_often1'] == 13): ?>selected<?php endif; ?>>13</option>
				<option value="14" <?php if ($this->_tpl_vars['post_data']['begin_often1'] == 14): ?>selected<?php endif; ?>>14</option>
				<option value="15" <?php if ($this->_tpl_vars['post_data']['begin_often1'] == 15): ?>selected<?php endif; ?>>15</option>
				<option value="16" <?php if ($this->_tpl_vars['post_data']['begin_often1'] == 16): ?>selected<?php endif; ?>>16</option>
				<option value="17" <?php if ($this->_tpl_vars['post_data']['begin_often1'] == 17): ?>selected<?php endif; ?>>17</option>
				<option value="18" <?php if ($this->_tpl_vars['post_data']['begin_often1'] == 18): ?>selected<?php endif; ?>>18</option>
				<option value="19" <?php if ($this->_tpl_vars['post_data']['begin_often1'] == 19): ?>selected<?php endif; ?>>19</option>
				<option value="20" <?php if ($this->_tpl_vars['post_data']['begin_often1'] == 20): ?>selected<?php endif; ?>>20</option>
				<option value="21" <?php if ($this->_tpl_vars['post_data']['begin_often1'] == 21): ?>selected<?php endif; ?>>21</option>
				<option value="22" <?php if ($this->_tpl_vars['post_data']['begin_often1'] == 22): ?>selected<?php endif; ?>>22</option>
				<option value="23" <?php if ($this->_tpl_vars['post_data']['begin_often1'] == 23): ?>selected<?php endif; ?>>23</option>
				<option value="24" <?php if ($this->_tpl_vars['post_data']['begin_often1'] == 24): ?>selected<?php endif; ?>>24</option>
			</select>
			時から
			<select name="finish_often1">	
				<option value="1" <?php if ($this->_tpl_vars['post_data']['finish_often1'] == 1): ?>selected<?php endif; ?>>01</option>
				<option value="2" <?php if ($this->_tpl_vars['post_data']['finish_often1'] == 2): ?>selected<?php endif; ?>>02</option>
				<option value="3" <?php if ($this->_tpl_vars['post_data']['finish_often1'] == 3): ?>selected<?php endif; ?>>03</option>
				<option value="4" <?php if ($this->_tpl_vars['post_data']['finish_often1'] == 4): ?>selected<?php endif; ?>>04</option>
				<option value="5" <?php if ($this->_tpl_vars['post_data']['finish_often1'] == 5): ?>selected<?php endif; ?>>05</option>
				<option value="6" <?php if ($this->_tpl_vars['post_data']['finish_often1'] == 6): ?>selected<?php endif; ?>>06</option>
				<option value="7" <?php if ($this->_tpl_vars['post_data']['finish_often1'] == 7): ?>selected<?php endif; ?>>07</option>
				<option value="8" <?php if ($this->_tpl_vars['post_data']['finish_often1'] == 8): ?>selected<?php endif; ?>>08</option>
				<option value="9" <?php if ($this->_tpl_vars['post_data']['finish_often1'] == 9): ?>selected<?php endif; ?>>09</option>
				<option value="10" <?php if ($this->_tpl_vars['post_data']['finish_often1'] == 10): ?>selected<?php endif; ?>>10</option>
				<option value="11" <?php if ($this->_tpl_vars['post_data']['finish_often1'] == 11): ?>selected<?php endif; ?>>11</option>
				<option value="12" <?php if ($this->_tpl_vars['post_data']['finish_often1'] == 12): ?>selected<?php endif; ?>>12</option>
				<option value="13" <?php if ($this->_tpl_vars['post_data']['finish_often1'] == 13): ?>selected<?php endif; ?>>13</option>
				<option value="14" <?php if ($this->_tpl_vars['post_data']['finish_often1'] == 14): ?>selected<?php endif; ?>>14</option>
				<option value="15" <?php if ($this->_tpl_vars['post_data']['finish_often1'] == 15): ?>selected<?php endif; ?>>15</option>
				<option value="16" <?php if ($this->_tpl_vars['post_data']['finish_often1'] == 16): ?>selected<?php endif; ?>>16</option>
				<option value="17" <?php if ($this->_tpl_vars['post_data']['finish_often1'] == 17): ?>selected<?php endif; ?>>17</option>
				<option value="18" <?php if ($this->_tpl_vars['post_data']['finish_often1'] == 18): ?>selected<?php endif; ?>>18</option>
				<option value="19" <?php if ($this->_tpl_vars['post_data']['finish_often1'] == 19): ?>selected<?php endif; ?>>19</option>
				<option value="20" <?php if ($this->_tpl_vars['post_data']['finish_often1'] == 20): ?>selected<?php endif; ?>>20</option>
				<option value="21" <?php if ($this->_tpl_vars['post_data']['finish_often1'] == 21): ?>selected<?php endif; ?>>21</option>
				<option value="22" <?php if ($this->_tpl_vars['post_data']['finish_often1'] == 22): ?>selected<?php endif; ?>>22</option>
				<option value="23" <?php if ($this->_tpl_vars['post_data']['finish_often1'] == 23): ?>selected<?php endif; ?>>23</option>
				<option value="24" <?php if ($this->_tpl_vars['post_data']['finish_often1'] == 24): ?>selected<?php endif; ?>>24</option>
			</select>
			時まで
		</div>
		<div class="spDate">
				<input type="checkbox" name="usedate[]" value="2" class="listcheckUsesp"> 土曜日
			<select name="begin_often2">
				<option value="1" <?php if ($this->_tpl_vars['post_data']['begin_often2'] == 1): ?>selected<?php endif; ?>>01</option>
				<option value="2" <?php if ($this->_tpl_vars['post_data']['begin_often2'] == 2): ?>selected<?php endif; ?>>02</option>
				<option value="3" <?php if ($this->_tpl_vars['post_data']['begin_often2'] == 3): ?>selected<?php endif; ?>>03</option>
				<option value="4" <?php if ($this->_tpl_vars['post_data']['begin_often2'] == 4): ?>selected<?php endif; ?>>04</option>
				<option value="5" <?php if ($this->_tpl_vars['post_data']['begin_often2'] == 5): ?>selected<?php endif; ?>>05</option>
				<option value="6" <?php if ($this->_tpl_vars['post_data']['begin_often2'] == 6): ?>selected<?php endif; ?>>06</option>
				<option value="7" <?php if ($this->_tpl_vars['post_data']['begin_often2'] == 7): ?>selected<?php endif; ?>>07</option>
				<option value="8" <?php if ($this->_tpl_vars['post_data']['begin_often2'] == 8): ?>selected<?php endif; ?>>08</option>
				<option value="9" <?php if ($this->_tpl_vars['post_data']['begin_often2'] == 9): ?>selected<?php endif; ?>>09</option>
				<option value="10" <?php if ($this->_tpl_vars['post_data']['begin_often2'] == 10): ?>selected<?php endif; ?>>10</option>
				<option value="11" <?php if ($this->_tpl_vars['post_data']['begin_often2'] == 11): ?>selected<?php endif; ?>>11</option>
				<option value="12" <?php if ($this->_tpl_vars['post_data']['begin_often2'] == 12): ?>selected<?php endif; ?>>12</option>
				<option value="13" <?php if ($this->_tpl_vars['post_data']['begin_often2'] == 13): ?>selected<?php endif; ?>>13</option>
				<option value="14" <?php if ($this->_tpl_vars['post_data']['begin_often2'] == 14): ?>selected<?php endif; ?>>14</option>
				<option value="15" <?php if ($this->_tpl_vars['post_data']['begin_often2'] == 15): ?>selected<?php endif; ?>>15</option>
				<option value="16" <?php if ($this->_tpl_vars['post_data']['begin_often2'] == 16): ?>selected<?php endif; ?>>16</option>
				<option value="17" <?php if ($this->_tpl_vars['post_data']['begin_often2'] == 17): ?>selected<?php endif; ?>>17</option>
				<option value="18" <?php if ($this->_tpl_vars['post_data']['begin_often2'] == 18): ?>selected<?php endif; ?>>18</option>
				<option value="19" <?php if ($this->_tpl_vars['post_data']['begin_often2'] == 19): ?>selected<?php endif; ?>>19</option>
				<option value="20" <?php if ($this->_tpl_vars['post_data']['begin_often2'] == 20): ?>selected<?php endif; ?>>20</option>
				<option value="21" <?php if ($this->_tpl_vars['post_data']['begin_often2'] == 21): ?>selected<?php endif; ?>>21</option>
				<option value="22" <?php if ($this->_tpl_vars['post_data']['begin_often2'] == 22): ?>selected<?php endif; ?>>22</option>
				<option value="23" <?php if ($this->_tpl_vars['post_data']['begin_often2'] == 23): ?>selected<?php endif; ?>>23</option>
				<option value="24" <?php if ($this->_tpl_vars['post_data']['begin_often2'] == 24): ?>selected<?php endif; ?>>24</option>
			</select>
			時から
			<select name="finish_often2">	
				<option value="1" <?php if ($this->_tpl_vars['post_data']['finish_often2'] == 1): ?>selected<?php endif; ?>>01</option>
				<option value="2" <?php if ($this->_tpl_vars['post_data']['finish_often2'] == 2): ?>selected<?php endif; ?>>02</option>
				<option value="3" <?php if ($this->_tpl_vars['post_data']['finish_often2'] == 3): ?>selected<?php endif; ?>>03</option>
				<option value="4" <?php if ($this->_tpl_vars['post_data']['finish_often2'] == 4): ?>selected<?php endif; ?>>04</option>
				<option value="5" <?php if ($this->_tpl_vars['post_data']['finish_often2'] == 5): ?>selected<?php endif; ?>>05</option>
				<option value="6" <?php if ($this->_tpl_vars['post_data']['finish_often2'] == 6): ?>selected<?php endif; ?>>06</option>
				<option value="7" <?php if ($this->_tpl_vars['post_data']['finish_often2'] == 7): ?>selected<?php endif; ?>>07</option>
				<option value="8" <?php if ($this->_tpl_vars['post_data']['finish_often2'] == 8): ?>selected<?php endif; ?>>08</option>
				<option value="9" <?php if ($this->_tpl_vars['post_data']['finish_often2'] == 9): ?>selected<?php endif; ?>>09</option>
				<option value="10" <?php if ($this->_tpl_vars['post_data']['finish_often2'] == 10): ?>selected<?php endif; ?>>10</option>
				<option value="11" <?php if ($this->_tpl_vars['post_data']['finish_often2'] == 11): ?>selected<?php endif; ?>>11</option>
				<option value="12" <?php if ($this->_tpl_vars['post_data']['finish_often2'] == 12): ?>selected<?php endif; ?>>12</option>
				<option value="13" <?php if ($this->_tpl_vars['post_data']['finish_often2'] == 13): ?>selected<?php endif; ?>>13</option>
				<option value="14" <?php if ($this->_tpl_vars['post_data']['finish_often2'] == 14): ?>selected<?php endif; ?>>14</option>
				<option value="15" <?php if ($this->_tpl_vars['post_data']['finish_often2'] == 15): ?>selected<?php endif; ?>>15</option>
				<option value="16" <?php if ($this->_tpl_vars['post_data']['finish_often2'] == 16): ?>selected<?php endif; ?>>16</option>
				<option value="17" <?php if ($this->_tpl_vars['post_data']['finish_often2'] == 17): ?>selected<?php endif; ?>>17</option>
				<option value="18" <?php if ($this->_tpl_vars['post_data']['finish_often2'] == 18): ?>selected<?php endif; ?>>18</option>
				<option value="19" <?php if ($this->_tpl_vars['post_data']['finish_often2'] == 19): ?>selected<?php endif; ?>>19</option>
				<option value="20" <?php if ($this->_tpl_vars['post_data']['finish_often2'] == 20): ?>selected<?php endif; ?>>20</option>
				<option value="21" <?php if ($this->_tpl_vars['post_data']['finish_often2'] == 21): ?>selected<?php endif; ?>>21</option>
				<option value="22" <?php if ($this->_tpl_vars['post_data']['finish_often2'] == 22): ?>selected<?php endif; ?>>22</option>
				<option value="23" <?php if ($this->_tpl_vars['post_data']['finish_often2'] == 23): ?>selected<?php endif; ?>>23</option>
				<option value="24" <?php if ($this->_tpl_vars['post_data']['finish_often2'] == 24): ?>selected<?php endif; ?>>24</option>
			</select>
			時まで
		</div>
		<div class="spDate">
			<input type="checkbox" name="usedate[]" value="3" class="listcheckUsesp"> 日曜日
			<select name="begin_often3">
				<option value="1" <?php if ($this->_tpl_vars['post_data']['begin_often3'] == 1): ?>selected<?php endif; ?>>01</option>
				<option value="2" <?php if ($this->_tpl_vars['post_data']['begin_often3'] == 2): ?>selected<?php endif; ?>>02</option>
				<option value="3" <?php if ($this->_tpl_vars['post_data']['begin_often3'] == 3): ?>selected<?php endif; ?>>03</option>
				<option value="4" <?php if ($this->_tpl_vars['post_data']['begin_often3'] == 4): ?>selected<?php endif; ?>>04</option>
				<option value="5" <?php if ($this->_tpl_vars['post_data']['begin_often3'] == 5): ?>selected<?php endif; ?>>05</option>
				<option value="6" <?php if ($this->_tpl_vars['post_data']['begin_often3'] == 6): ?>selected<?php endif; ?>>06</option>
				<option value="7" <?php if ($this->_tpl_vars['post_data']['begin_often3'] == 7): ?>selected<?php endif; ?>>07</option>
				<option value="8" <?php if ($this->_tpl_vars['post_data']['begin_often3'] == 8): ?>selected<?php endif; ?>>08</option>
				<option value="9" <?php if ($this->_tpl_vars['post_data']['begin_often3'] == 9): ?>selected<?php endif; ?>>09</option>
				<option value="10" <?php if ($this->_tpl_vars['post_data']['begin_often3'] == 10): ?>selected<?php endif; ?>>10</option>
				<option value="11" <?php if ($this->_tpl_vars['post_data']['begin_often3'] == 11): ?>selected<?php endif; ?>>11</option>
				<option value="12" <?php if ($this->_tpl_vars['post_data']['begin_often3'] == 12): ?>selected<?php endif; ?>>12</option>
				<option value="13" <?php if ($this->_tpl_vars['post_data']['begin_often3'] == 13): ?>selected<?php endif; ?>>13</option>
				<option value="14" <?php if ($this->_tpl_vars['post_data']['begin_often3'] == 14): ?>selected<?php endif; ?>>14</option>
				<option value="15" <?php if ($this->_tpl_vars['post_data']['begin_often3'] == 15): ?>selected<?php endif; ?>>15</option>
				<option value="16" <?php if ($this->_tpl_vars['post_data']['begin_often3'] == 16): ?>selected<?php endif; ?>>16</option>
				<option value="17" <?php if ($this->_tpl_vars['post_data']['begin_often3'] == 17): ?>selected<?php endif; ?>>17</option>
				<option value="18" <?php if ($this->_tpl_vars['post_data']['begin_often3'] == 18): ?>selected<?php endif; ?>>18</option>
				<option value="19" <?php if ($this->_tpl_vars['post_data']['begin_often3'] == 19): ?>selected<?php endif; ?>>19</option>
				<option value="20" <?php if ($this->_tpl_vars['post_data']['begin_often3'] == 20): ?>selected<?php endif; ?>>20</option>
				<option value="21" <?php if ($this->_tpl_vars['post_data']['begin_often3'] == 21): ?>selected<?php endif; ?>>21</option>
				<option value="22" <?php if ($this->_tpl_vars['post_data']['begin_often3'] == 22): ?>selected<?php endif; ?>>22</option>
				<option value="23" <?php if ($this->_tpl_vars['post_data']['begin_often3'] == 23): ?>selected<?php endif; ?>>23</option>
				<option value="24" <?php if ($this->_tpl_vars['post_data']['begin_often3'] == 24): ?>selected<?php endif; ?>>24</option>
			</select>
			時から
			<select name="finish_often3">	
				<option value="1" <?php if ($this->_tpl_vars['post_data']['finish_often3'] == 1): ?>selected<?php endif; ?>>01</option>
				<option value="2" <?php if ($this->_tpl_vars['post_data']['finish_often3'] == 2): ?>selected<?php endif; ?>>02</option>
				<option value="3" <?php if ($this->_tpl_vars['post_data']['finish_often3'] == 3): ?>selected<?php endif; ?>>03</option>
				<option value="4" <?php if ($this->_tpl_vars['post_data']['finish_often3'] == 4): ?>selected<?php endif; ?>>04</option>
				<option value="5" <?php if ($this->_tpl_vars['post_data']['finish_often3'] == 5): ?>selected<?php endif; ?>>05</option>
				<option value="6" <?php if ($this->_tpl_vars['post_data']['finish_often3'] == 6): ?>selected<?php endif; ?>>06</option>
				<option value="7" <?php if ($this->_tpl_vars['post_data']['finish_often3'] == 7): ?>selected<?php endif; ?>>07</option>
				<option value="8" <?php if ($this->_tpl_vars['post_data']['finish_often3'] == 8): ?>selected<?php endif; ?>>08</option>
				<option value="9" <?php if ($this->_tpl_vars['post_data']['finish_often3'] == 9): ?>selected<?php endif; ?>>09</option>
				<option value="10" <?php if ($this->_tpl_vars['post_data']['finish_often3'] == 10): ?>selected<?php endif; ?>>10</option>
				<option value="11" <?php if ($this->_tpl_vars['post_data']['finish_often3'] == 11): ?>selected<?php endif; ?>>11</option>
				<option value="12" <?php if ($this->_tpl_vars['post_data']['finish_often3'] == 12): ?>selected<?php endif; ?>>12</option>
				<option value="13" <?php if ($this->_tpl_vars['post_data']['finish_often3'] == 13): ?>selected<?php endif; ?>>13</option>
				<option value="14" <?php if ($this->_tpl_vars['post_data']['finish_often3'] == 14): ?>selected<?php endif; ?>>14</option>
				<option value="15" <?php if ($this->_tpl_vars['post_data']['finish_often3'] == 15): ?>selected<?php endif; ?>>15</option>
				<option value="16" <?php if ($this->_tpl_vars['post_data']['finish_often3'] == 16): ?>selected<?php endif; ?>>16</option>
				<option value="17" <?php if ($this->_tpl_vars['post_data']['finish_often3'] == 17): ?>selected<?php endif; ?>>17</option>
				<option value="18" <?php if ($this->_tpl_vars['post_data']['finish_often3'] == 18): ?>selected<?php endif; ?>>18</option>
				<option value="19" <?php if ($this->_tpl_vars['post_data']['finish_often3'] == 19): ?>selected<?php endif; ?>>19</option>
				<option value="20" <?php if ($this->_tpl_vars['post_data']['finish_often3'] == 20): ?>selected<?php endif; ?>>20</option>
				<option value="21" <?php if ($this->_tpl_vars['post_data']['finish_often3'] == 21): ?>selected<?php endif; ?>>21</option>
				<option value="22" <?php if ($this->_tpl_vars['post_data']['finish_often3'] == 22): ?>selected<?php endif; ?>>22</option>
				<option value="23" <?php if ($this->_tpl_vars['post_data']['finish_often3'] == 23): ?>selected<?php endif; ?>>23</option>
				<option value="24" <?php if ($this->_tpl_vars['post_data']['finish_often3'] == 24): ?>selected<?php endif; ?>>24</option>
			</select>
			時まで
		</div>
		<div class="spDate">
			<input type="checkbox" name="usedate[]" value="4" class="listcheckUsesp"> 祝日
			<select name="begin_often4">
				<option value="1" <?php if ($this->_tpl_vars['post_data']['begin_often4'] == 1): ?>selected<?php endif; ?>>01</option>
				<option value="2" <?php if ($this->_tpl_vars['post_data']['begin_often4'] == 2): ?>selected<?php endif; ?>>02</option>
				<option value="3" <?php if ($this->_tpl_vars['post_data']['begin_often4'] == 3): ?>selected<?php endif; ?>>03</option>
				<option value="4" <?php if ($this->_tpl_vars['post_data']['begin_often4'] == 4): ?>selected<?php endif; ?>>04</option>
				<option value="5" <?php if ($this->_tpl_vars['post_data']['begin_often4'] == 5): ?>selected<?php endif; ?>>05</option>
				<option value="6" <?php if ($this->_tpl_vars['post_data']['begin_often4'] == 6): ?>selected<?php endif; ?>>06</option>
				<option value="7" <?php if ($this->_tpl_vars['post_data']['begin_often4'] == 7): ?>selected<?php endif; ?>>07</option>
				<option value="8" <?php if ($this->_tpl_vars['post_data']['begin_often4'] == 8): ?>selected<?php endif; ?>>08</option>
				<option value="9" <?php if ($this->_tpl_vars['post_data']['begin_often4'] == 9): ?>selected<?php endif; ?>>09</option>
				<option value="10" <?php if ($this->_tpl_vars['post_data']['begin_often4'] == 10): ?>selected<?php endif; ?>>10</option>
				<option value="11" <?php if ($this->_tpl_vars['post_data']['begin_often4'] == 11): ?>selected<?php endif; ?>>11</option>
				<option value="12" <?php if ($this->_tpl_vars['post_data']['begin_often4'] == 12): ?>selected<?php endif; ?>>12</option>
				<option value="13" <?php if ($this->_tpl_vars['post_data']['begin_often4'] == 13): ?>selected<?php endif; ?>>13</option>
				<option value="14" <?php if ($this->_tpl_vars['post_data']['begin_often4'] == 14): ?>selected<?php endif; ?>>14</option>
				<option value="15" <?php if ($this->_tpl_vars['post_data']['begin_often4'] == 15): ?>selected<?php endif; ?>>15</option>
				<option value="16" <?php if ($this->_tpl_vars['post_data']['begin_often4'] == 16): ?>selected<?php endif; ?>>16</option>
				<option value="17" <?php if ($this->_tpl_vars['post_data']['begin_often4'] == 17): ?>selected<?php endif; ?>>17</option>
				<option value="18" <?php if ($this->_tpl_vars['post_data']['begin_often4'] == 18): ?>selected<?php endif; ?>>18</option>
				<option value="19" <?php if ($this->_tpl_vars['post_data']['begin_often4'] == 19): ?>selected<?php endif; ?>>19</option>
				<option value="20" <?php if ($this->_tpl_vars['post_data']['begin_often4'] == 20): ?>selected<?php endif; ?>>20</option>
				<option value="21" <?php if ($this->_tpl_vars['post_data']['begin_often4'] == 21): ?>selected<?php endif; ?>>21</option>
				<option value="22" <?php if ($this->_tpl_vars['post_data']['begin_often4'] == 22): ?>selected<?php endif; ?>>22</option>
				<option value="23" <?php if ($this->_tpl_vars['post_data']['begin_often4'] == 23): ?>selected<?php endif; ?>>23</option>
				<option value="24" <?php if ($this->_tpl_vars['post_data']['begin_often4'] == 24): ?>selected<?php endif; ?>>24</option>
			</select>
			時から
			<select name="finish_often4">	
				<option value="1" <?php if ($this->_tpl_vars['post_data']['finish_often4'] == 1): ?>selected<?php endif; ?>>01</option>
				<option value="2" <?php if ($this->_tpl_vars['post_data']['finish_often4'] == 2): ?>selected<?php endif; ?>>02</option>
				<option value="3" <?php if ($this->_tpl_vars['post_data']['finish_often4'] == 3): ?>selected<?php endif; ?>>03</option>
				<option value="4" <?php if ($this->_tpl_vars['post_data']['finish_often4'] == 4): ?>selected<?php endif; ?>>04</option>
				<option value="5" <?php if ($this->_tpl_vars['post_data']['finish_often4'] == 5): ?>selected<?php endif; ?>>05</option>
				<option value="6" <?php if ($this->_tpl_vars['post_data']['finish_often4'] == 6): ?>selected<?php endif; ?>>06</option>
				<option value="7" <?php if ($this->_tpl_vars['post_data']['finish_often4'] == 7): ?>selected<?php endif; ?>>07</option>
				<option value="8" <?php if ($this->_tpl_vars['post_data']['finish_often4'] == 8): ?>selected<?php endif; ?>>08</option>
				<option value="9" <?php if ($this->_tpl_vars['post_data']['finish_often4'] == 9): ?>selected<?php endif; ?>>09</option>
				<option value="10" <?php if ($this->_tpl_vars['post_data']['finish_often4'] == 10): ?>selected<?php endif; ?>>10</option>
				<option value="11" <?php if ($this->_tpl_vars['post_data']['finish_often4'] == 11): ?>selected<?php endif; ?>>11</option>
				<option value="12" <?php if ($this->_tpl_vars['post_data']['finish_often4'] == 12): ?>selected<?php endif; ?>>12</option>
				<option value="13" <?php if ($this->_tpl_vars['post_data']['finish_often4'] == 13): ?>selected<?php endif; ?>>13</option>
				<option value="14" <?php if ($this->_tpl_vars['post_data']['finish_often4'] == 14): ?>selected<?php endif; ?>>14</option>
				<option value="15" <?php if ($this->_tpl_vars['post_data']['finish_often4'] == 15): ?>selected<?php endif; ?>>15</option>
				<option value="16" <?php if ($this->_tpl_vars['post_data']['finish_often4'] == 16): ?>selected<?php endif; ?>>16</option>
				<option value="17" <?php if ($this->_tpl_vars['post_data']['finish_often4'] == 17): ?>selected<?php endif; ?>>17</option>
				<option value="18" <?php if ($this->_tpl_vars['post_data']['finish_often4'] == 18): ?>selected<?php endif; ?>>18</option>
				<option value="19" <?php if ($this->_tpl_vars['post_data']['finish_often4'] == 19): ?>selected<?php endif; ?>>19</option>
				<option value="20" <?php if ($this->_tpl_vars['post_data']['finish_often4'] == 20): ?>selected<?php endif; ?>>20</option>
				<option value="21" <?php if ($this->_tpl_vars['post_data']['finish_often4'] == 21): ?>selected<?php endif; ?>>21</option>
				<option value="22" <?php if ($this->_tpl_vars['post_data']['finish_often4'] == 22): ?>selected<?php endif; ?>>22</option>
				<option value="23" <?php if ($this->_tpl_vars['post_data']['finish_often4'] == 23): ?>selected<?php endif; ?>>23</option>
				<option value="24" <?php if ($this->_tpl_vars['post_data']['finish_often4'] == 24): ?>selected<?php endif; ?>>24</option>
			</select>
			時まで
		</label>					
	<?php endif; ?>
</td>
</tr>
<!--<tr>
<td bgcolor=#FFE7D6><b>一般利用可能時間</b></td>
<td class="tdspec" style="text-align:left">
	<?php if ($this->_tpl_vars['post_data']['hall_id']): ?>
				<?php $_from = $this->_tpl_vars['result2']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>	
				<select name="begin_often">				
					<script>
						var a = <?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['begin_often']); ?>
;
						for(var i = 1; i <= 24; i++){							
							if(a == i){
								if(i<10){
									document.write('<option selected value="'+i+'">0'+i+'</option>');	
								}
								else
								{
									document.write('<option selected value="'+i+'">'+i+'</option>');
								}
							}
							else{
								if(i<10)
									{document.write('<option value="'+i+'">0'+i+'</option>');
								}
								else
								{
									document.write('<option  value="'+i+'">'+i+'</option>');
								}
							}
						}						
					</script>	
				</select>
				時から
				<select name="finish_often">				
					<script>
						var a = <?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['finish_often']); ?>
;
						for(var i = 1; i <= 24; i++){							
							if(a == i){
								if(i<10){
									document.write('<option selected value="'+i+'">0'+i+'</option>');	
								}
								else
								{
									document.write('<option selected value="'+i+'">'+i+'</option>');
								}
							}
							else{
								if(i<10)
									{document.write('<option value="'+i+'">0'+i+'</option>');
								}
								else
								{
									document.write('<option  value="'+i+'">'+i+'</option>');
								}
							}
						}						
					</script>	
				</select>
				時まで
				<?php endforeach; endif; unset($_from); ?>
				<?php if ($this->_tpl_vars['result2'] == ''): ?>
						<select name="begin_often">				
							<script>
								var a = <?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['begin_often']); ?>
;
								for(var i = 1; i <= 24; i++){							
									if(a == i){
										if(i<10){
											document.write('<option selected value="'+i+'">0'+i+'</option>');	
										}
										else
										{
											document.write('<option selected value="'+i+'">'+i+'</option>');
										}
									}
									else{
										if(i<10)
											{document.write('<option value="'+i+'">0'+i+'</option>');
										}
										else
										{
											document.write('<option  value="'+i+'">'+i+'</option>');
										}
									}
								}						
							</script>	
						</select>
						時から
						<select name="finish_often">				
							<script>		
								var a = <?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['finish_often']); ?>
;
								for(var i = 1; i <= 24; i++){							
									if(a == i){
										if(i<10){
											document.write('<option selected value="'+i+'">0'+i+'</option>');	
										}
										else
										{
											document.write('<option selected value="'+i+'">'+i+'</option>');
										}
									}
									else{
										if(i<10)
											{document.write('<option value="'+i+'">0'+i+'</option>');
										}
										else
										{
											document.write('<option  value="'+i+'">'+i+'</option>');
										}
									}
								}						
							</script>	
						</select>
					
				<?php endif; ?>				
		
			
	<?php else: ?>
	<select name="begin_often">
		<option value="1" <?php if ($this->_tpl_vars['post_data']['begin_often'] == 1): ?>selected<?php endif; ?>>01</option>
		<option value="2" <?php if ($this->_tpl_vars['post_data']['begin_often'] == 2): ?>selected<?php endif; ?>>02</option>
		<option value="3" <?php if ($this->_tpl_vars['post_data']['begin_often'] == 3): ?>selected<?php endif; ?>>03</option>
		<option value="4" <?php if ($this->_tpl_vars['post_data']['begin_often'] == 4): ?>selected<?php endif; ?>>04</option>
		<option value="5" <?php if ($this->_tpl_vars['post_data']['begin_often'] == 5): ?>selected<?php endif; ?>>05</option>
		<option value="6" <?php if ($this->_tpl_vars['post_data']['begin_often'] == 6): ?>selected<?php endif; ?>>06</option>
		<option value="7" <?php if ($this->_tpl_vars['post_data']['begin_often'] == 7): ?>selected<?php endif; ?>>07</option>
		<option value="8" <?php if ($this->_tpl_vars['post_data']['begin_often'] == 8): ?>selected<?php endif; ?>>08</option>
		<option value="9" <?php if ($this->_tpl_vars['post_data']['begin_often'] == 9): ?>selected<?php endif; ?>>09</option>
		<option value="10" <?php if ($this->_tpl_vars['post_data']['begin_often'] == 10): ?>selected<?php endif; ?>>10</option>
		<option value="11" <?php if ($this->_tpl_vars['post_data']['begin_often'] == 11): ?>selected<?php endif; ?>>11</option>
		<option value="12" <?php if ($this->_tpl_vars['post_data']['begin_often'] == 12): ?>selected<?php endif; ?>>12</option>
		<option value="13" <?php if ($this->_tpl_vars['post_data']['begin_often'] == 13): ?>selected<?php endif; ?>>13</option>
		<option value="14" <?php if ($this->_tpl_vars['post_data']['begin_often'] == 14): ?>selected<?php endif; ?>>14</option>
		<option value="15" <?php if ($this->_tpl_vars['post_data']['begin_often'] == 15): ?>selected<?php endif; ?>>15</option>
		<option value="16" <?php if ($this->_tpl_vars['post_data']['begin_often'] == 16): ?>selected<?php endif; ?>>16</option>
		<option value="17" <?php if ($this->_tpl_vars['post_data']['begin_often'] == 17): ?>selected<?php endif; ?>>17</option>
		<option value="18" <?php if ($this->_tpl_vars['post_data']['begin_often'] == 18): ?>selected<?php endif; ?>>18</option>
		<option value="19" <?php if ($this->_tpl_vars['post_data']['begin_often'] == 19): ?>selected<?php endif; ?>>19</option>
		<option value="20" <?php if ($this->_tpl_vars['post_data']['begin_often'] == 20): ?>selected<?php endif; ?>>20</option>
		<option value="21" <?php if ($this->_tpl_vars['post_data']['begin_often'] == 21): ?>selected<?php endif; ?>>21</option>
		<option value="22" <?php if ($this->_tpl_vars['post_data']['begin_often'] == 22): ?>selected<?php endif; ?>>22</option>
		<option value="23" <?php if ($this->_tpl_vars['post_data']['begin_often'] == 23): ?>selected<?php endif; ?>>23</option>
		<option value="24" <?php if ($this->_tpl_vars['post_data']['begin_often'] == 24): ?>selected<?php endif; ?>>24</option>
	</select>
	時から
	<select name="finish_often">	
		<option value="1" <?php if ($this->_tpl_vars['post_data']['finish_often'] == 1): ?>selected<?php endif; ?>>01</option>
		<option value="2" <?php if ($this->_tpl_vars['post_data']['finish_often'] == 2): ?>selected<?php endif; ?>>02</option>
		<option value="3" <?php if ($this->_tpl_vars['post_data']['finish_often'] == 3): ?>selected<?php endif; ?>>03</option>
		<option value="4" <?php if ($this->_tpl_vars['post_data']['finish_often'] == 4): ?>selected<?php endif; ?>>04</option>
		<option value="5" <?php if ($this->_tpl_vars['post_data']['finish_often'] == 5): ?>selected<?php endif; ?>>05</option>
		<option value="6" <?php if ($this->_tpl_vars['post_data']['finish_often'] == 6): ?>selected<?php endif; ?>>06</option>
		<option value="7" <?php if ($this->_tpl_vars['post_data']['finish_often'] == 7): ?>selected<?php endif; ?>>07</option>
		<option value="8" <?php if ($this->_tpl_vars['post_data']['finish_often'] == 8): ?>selected<?php endif; ?>>08</option>
		<option value="9" <?php if ($this->_tpl_vars['post_data']['finish_often'] == 9): ?>selected<?php endif; ?>>09</option>
		<option value="10" <?php if ($this->_tpl_vars['post_data']['finish_often'] == 10): ?>selected<?php endif; ?>>10</option>
		<option value="11" <?php if ($this->_tpl_vars['post_data']['finish_often'] == 11): ?>selected<?php endif; ?>>11</option>
		<option value="12" <?php if ($this->_tpl_vars['post_data']['finish_often'] == 12): ?>selected<?php endif; ?>>12</option>
		<option value="13" <?php if ($this->_tpl_vars['post_data']['finish_often'] == 13): ?>selected<?php endif; ?>>13</option>
		<option value="14" <?php if ($this->_tpl_vars['post_data']['finish_often'] == 14): ?>selected<?php endif; ?>>14</option>
		<option value="15" <?php if ($this->_tpl_vars['post_data']['finish_often'] == 15): ?>selected<?php endif; ?>>15</option>
		<option value="16" <?php if ($this->_tpl_vars['post_data']['finish_often'] == 16): ?>selected<?php endif; ?>>16</option>
		<option value="17" <?php if ($this->_tpl_vars['post_data']['finish_often'] == 17): ?>selected<?php endif; ?>>17</option>
		<option value="18" <?php if ($this->_tpl_vars['post_data']['finish_often'] == 18): ?>selected<?php endif; ?>>18</option>
		<option value="19" <?php if ($this->_tpl_vars['post_data']['finish_often'] == 19): ?>selected<?php endif; ?>>19</option>
		<option value="20" <?php if ($this->_tpl_vars['post_data']['finish_often'] == 20): ?>selected<?php endif; ?>>20</option>
		<option value="21" <?php if ($this->_tpl_vars['post_data']['finish_often'] == 21): ?>selected<?php endif; ?>>21</option>
		<option value="22" <?php if ($this->_tpl_vars['post_data']['finish_often'] == 22): ?>selected<?php endif; ?>>22</option>
		<option value="23" <?php if ($this->_tpl_vars['post_data']['finish_often'] == 23): ?>selected<?php endif; ?>>23</option>
		<option value="24" <?php if ($this->_tpl_vars['post_data']['finish_often'] == 24): ?>selected<?php endif; ?>>24</option>
	</select>
	時まで
	<?php endif; ?>
</td>
</tr>-->
</table>
<div id="d1" <?php if ($this->_tpl_vars['post_data']['hall_attribute'] == 0): ?> style="display:none;"<?php endif; ?>>
<br>
<table border=1 width=740 >
<tr>
<td colspan=2 bgcolor=#FFFF99 align=center height=30>
<b>シェア会場追記項目</b></td>
</tr>
<tr>
<td bgcolor=#FFFFCC><b>入室導線</b></td>
<td align=left>
	<table width=350>
	<td>
	<input type="radio" name="share_option1" value="0" onclick="Sel()" <?php if ($this->_tpl_vars['post_data']['share_option1'] == 0): ?>checked<?php endif; ?>>直接入室できる
	</td>
	<td>
	<input type="radio" name="share_option1" value="1" onclick="Sel()" <?php if ($this->_tpl_vars['post_data']['share_option1'] == 1): ?>checked<?php endif; ?>>事務所内を通過して入室
	</td>
	</table>
</td>
</tr>
<tr>
<td bgcolor=#FFFFCC><b>トイレ導線</b></td>
<td align=left>
	<table width=350>
	<td>
	<input type="radio" name="share_option2" value="0" onclick="Sel()" <?php if ($this->_tpl_vars['post_data']['share_option2'] == 0): ?>checked<?php endif; ?>>直接入室できる
	</td>
	<td>
	<input type="radio" name="share_option2" value="1" onclick="Sel()" <?php if ($this->_tpl_vars['post_data']['share_option2'] == 1): ?>checked<?php endif; ?>>事務所内を通過して入室
	</td>
	</table>
</td>
</tr>
</table>
</div>
<br>
<table border=1 width=740 >
<tr>
<td colspan=2 bgcolor=#99FFCC align=center height=30>
<b>会場住所等</b></td>
</tr>
<tr>
<td bgcolor=#CCFFCC width=180><b>住所</b></td>
<td align=left>
郵便番号 <input type="text" name="address_zip" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['address_zip']); ?>
"> (半角) 例)153-0044<br>
都道府県 
	<select name="address_prefecture">
	<option value="">選択してください</option>
	<?php $_from = $this->_tpl_vars['profile_list']['options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
		<option value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['c_profile_option_id']); ?>
" <?php if ($this->_tpl_vars['item']['c_profile_option_id'] == $this->_tpl_vars['post_data']['address_prefecture']): ?>selected<?php endif; ?>><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['value']))) ? $this->_run_mod_handler('default', true, $_tmp, "--") : smarty_modifier_default($_tmp, "--")); ?>
</option>
	<?php endforeach; endif; unset($_from); ?>
	</select> 例)東京都<br>
市区町村 <input type="text" name="address_city" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['address_city']); ?>
"> 例)目黒区<br>
以下住所 <input type="text" name="address_other" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['address_other']); ?>
"> 例)大橋2-22-6<br>
電話番号 <input type="text" name="telephone" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['telephone']); ?>
"> (ハイフン有り) 例)03-5452-3711<br>
FAX 番号 <input type="text" name="fax" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['fax']); ?>
"> (ハイフン有り) 例)03-5452-3711<br>
</td>
</tr>
<tr>
<td bgcolor=#CCFFCC><b>交通</b></td>
<td align=left>
最寄り駅１ <input type="text" name="line1" size="10" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['line1']); ?>
"> 線 <input type="text" name="station1" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['station1']); ?>
"> 駅から
	<select name="transportation1">
	<option value="">選択してください</option>
	<?php $_from = $this->_tpl_vars['transportation_list']['options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
		<option value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['c_profile_option_id']); ?>
" <?php if ($this->_tpl_vars['item']['c_profile_option_id'] == $this->_tpl_vars['post_data']['transportation1']): ?>selected<?php endif; ?>><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['value']))) ? $this->_run_mod_handler('default', true, $_tmp, "--") : smarty_modifier_default($_tmp, "--")); ?>
</option>
	<?php endforeach; endif; unset($_from); ?>
	</select> <input type="text" name="time1" size="5" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['time1']); ?>
">分<br>

最寄り駅２ <input type="text" name="line2" size="10" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['line2']); ?>
"> 線 <input type="text" name="station2" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['station2']); ?>
"> 駅から
	<select name="transportation2">
	<option value="">選択してください</option>
	<?php $_from = $this->_tpl_vars['transportation_list']['options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
		<option value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['c_profile_option_id']); ?>
" <?php if ($this->_tpl_vars['item']['c_profile_option_id'] == $this->_tpl_vars['post_data']['transportation2']): ?>selected<?php endif; ?>><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['value']))) ? $this->_run_mod_handler('default', true, $_tmp, "--") : smarty_modifier_default($_tmp, "--")); ?>
</option>
	<?php endforeach; endif; unset($_from); ?>
	</select> <input type="text" name="time2" size="5" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['time2']); ?>
">分<br>

最寄り駅３ <input type="text" name="line3" size="10" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['line3']); ?>
"> 線 <input type="text" name="station3" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['station3']); ?>
"> 駅から
	<select name="transportation3">
	<option value="">選択してください</option>
	<?php $_from = $this->_tpl_vars['transportation_list']['options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
		<option value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['c_profile_option_id']); ?>
" <?php if ($this->_tpl_vars['item']['c_profile_option_id'] == $this->_tpl_vars['post_data']['transportation3']): ?>selected<?php endif; ?>><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['value']))) ? $this->_run_mod_handler('default', true, $_tmp, "--") : smarty_modifier_default($_tmp, "--")); ?>
</option>
	<?php endforeach; endif; unset($_from); ?>
	</select> <input type="text" name="time3" size="5" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['time3']); ?>
">分<br>
</td>
</tr>
<tr>
<td bgcolor=#CCFFCC><b>google maps URL</b></td>
<td align=left>
<input type="text" name="google_maps" size="90" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['google_maps']); ?>
">
</td>
</tr>
<tr>
<td bgcolor=#CCFFCC><b>規約 URL</b></td>
<td align=left>
<input type="text" name="kiyaku_url" size="90" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['kiyaku_url']); ?>
">
</td>
</tr>
<tr>
<td bgcolor=#CCFFCC><b>メーリングリスト</b></td>
<td align=left>
<input type="text" name="mailing_list" size="90" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['mailing_list']); ?>
">
</td>
</tr>
<tr>
<td bgcolor=#CCFFCC><b>会場へのアクセス</b></td>
<td align=left>
<textarea id="mce_editor_textarea" name="access" rows="<?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['_rows']))) ? $this->_run_mod_handler('default', true, $_tmp, '6') : smarty_modifier_default($_tmp, '6')); ?>
" cols="<?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['_cols']))) ? $this->_run_mod_handler('default', true, $_tmp, '70') : smarty_modifier_default($_tmp, '70')); ?>
"><?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['access']); ?>
</textarea>
</td>
</tr>
<tr>
<td bgcolor=#CCFFCC><b>会場の特徴</b></td>
<td align=left>
<textarea id="mce_editor_textarea" name="characteristic" rows="<?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['_rows']))) ? $this->_run_mod_handler('default', true, $_tmp, '4') : smarty_modifier_default($_tmp, '4')); ?>
" cols="<?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['_cols']))) ? $this->_run_mod_handler('default', true, $_tmp, '70') : smarty_modifier_default($_tmp, '70')); ?>
"><?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['characteristic']); ?>
</textarea>
</td>
</tr>
<tr>
<td bgcolor=#CCFFCC><b>基本設備</b></td>
<td align=left>
<textarea id="mce_editor_textarea" name="facilities" rows="<?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['_rows']))) ? $this->_run_mod_handler('default', true, $_tmp, '4') : smarty_modifier_default($_tmp, '4')); ?>
" cols="<?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['_cols']))) ? $this->_run_mod_handler('default', true, $_tmp, '70') : smarty_modifier_default($_tmp, '70')); ?>
"><?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['facilities']); ?>
</textarea>
</td>
</tr>
<tr>
<td bgcolor=#CCFFCC><b>ご案内</b></td>
<td align=left>
<textarea id="mce_editor_textarea" name="remarks" rows="<?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['_rows']))) ? $this->_run_mod_handler('default', true, $_tmp, '4') : smarty_modifier_default($_tmp, '4')); ?>
" cols="<?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['_cols']))) ? $this->_run_mod_handler('default', true, $_tmp, '70') : smarty_modifier_default($_tmp, '70')); ?>
"><?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['remarks']); ?>
</textarea>
</td>
</tr>
<tr>
<td bgcolor=#CCFFCC><b>会員登録規約</b></td>
<td align=left>
<textarea id="mce_editor_textarea" name="agreement" rows="<?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['_rows']))) ? $this->_run_mod_handler('default', true, $_tmp, '15') : smarty_modifier_default($_tmp, '15')); ?>
" cols="<?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['_cols']))) ? $this->_run_mod_handler('default', true, $_tmp, '70') : smarty_modifier_default($_tmp, '70')); ?>
"><?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['agreement']); ?>
</textarea>
</td>
</tr>
</table>
<br>

<input type="submit" value="確認画面へ">

</form>
</center>


<?php else: ?>
<br>
<center>
<span style="font-size: 16px; color: #FF0033;"><b>アクセス権がありません。</b></span>
</center>
<?php endif; ?>
<div>
<?php echo $this->_tpl_vars['inc_footer']; ?>

<style>
.listcheckUse{ float:left; margin-right: 15px; vertical-align: middle;}
.listcheckUsesp{
	margin-top:10px;
	display: inline;
}
td.tdspec{
	padding: 5px 7px;
}
</style>