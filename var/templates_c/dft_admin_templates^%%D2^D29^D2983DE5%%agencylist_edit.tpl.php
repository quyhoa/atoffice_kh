<?php /* Smarty version 2.6.18, created on 2017-03-23 11:52:21
         compiled from file:D:%5CA_project%5Catoffice_kh/webapp/modules/admin/templates/agencylist_edit.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'ext_include', 'file:D:\\A_project\\atoffice_kh/webapp/modules/admin/templates/agencylist_edit.tpl', 2, false),array('modifier', 't_escape', 'file:D:\\A_project\\atoffice_kh/webapp/modules/admin/templates/agencylist_edit.tpl', 5, false),)), $this); ?>
<?php echo $this->_tpl_vars['inc_header']; ?>

<?php echo smarty_function_ext_include(array('file' => "inc_subnavi_adminSiteMember.tpl"), $this);?>

<?php $this->assign('page_name', "代理店値引き編集"); ?>
<?php $this->assign('parent_page_name', "代理店値引き管理"); ?>
<?php ob_start(); ?>?m=<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
&amp;a=page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('blacklist')); ?>
<?php $this->_smarty_vars['capture']['parent_page_url'] = ob_get_contents(); ob_end_clean(); ?>

<?php echo smarty_function_ext_include(array('file' => "inc_tree_adminSiteMember.tpl"), $this);?>

</div>
<style type="text/css">
	.radio_left{
		width: 15%;
		float: left;
	}
	.radio_right{
		width: 82%;
		float: left;
	}
	.block_content_detail{
		width: 100%;
		padding-left: 3%;
		padding-bottom: 25px;
	}
	.text_align_commom{
		text-align: left;
	}
	.content_checkbox{
    	width: 380px;
    	height: 19px;
	}
	.display_block{
		display: none;
	}
	.block-hall-list{
		width: 100%;
	}
	.td_boder_none{
		border: none !important;
	}
	#display_block_id table td {
		border: none !important;
	}
	.th_min_width{
		min-width: 50px !important;
	}
</style>

<?php if ($this->_tpl_vars['msg']): ?><p id="actionMsgId" class="actionMsg"><?php echo smarty_modifier_t_escape($this->_tpl_vars['msg']); ?>
</p><?php endif; ?>
<p  id="actionMsgs" ></p>
<h2>代理店値引き編集</h2>
<div class="contents">

<p class="caution">※部屋の値段から割引されます。（ログイン必須）。</p>

<form name="add_blacklist" method="POST" action="./">
<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
<input type="hidden" name="a" value="do_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('add_agency','do')); ?>
" />
<input type="hidden" name="page" value="agencylist_edit" />
<input type="hidden" name="sessid" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['PHPSESSID']); ?>
" />
<input type="hidden" name="c_member_id" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['agencylist']['c_member_id']); ?>
">

<table class="basicType2" style="width: 50%;">
<tbody>
<tr>
<th class="th_min_width">氏名</th>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['agencylist']['nickname']); ?>
</td>
</tr>
<tr>
<th>値引き率</th>
<td>
	<div class="block_content_detail">
		<div class="radio_left text_align_commom">
			<input id="nai" type="radio" name="flag" value="0" <?php if ($this->_tpl_vars['agencylist']['type'] == 0): ?> checked <?php endif; ?> onclick="checkAmari('nai')">会場指定なし
		</div>
		<div class="radio_right text_align_commom">
			値引き率：<input id="percentOld" type="text" name="percent" <?php if ($this->_tpl_vars['agencylist']['percent'] != 0): ?> value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['agencylist']['percent']); ?>
" <?php endif; ?> size=10> ％引き
		</div>
	</div>

	<div class="block_content_detail">
		<div class="radio_left text_align_commom">
			<input id="amari" type="radio" name="flag" value="1" <?php if ($this->_tpl_vars['agencylist']['type'] == 1): ?> checked <?php endif; ?> onclick="checkAmari('amari')">会場指定あり<br>
		</div>
		<div id="display_block_id" class="radio_right text_align_commom <?php if ($this->_tpl_vars['agencylist']['type'] == 0): ?> display_block <?php endif; ?>">
			<?php $_from = $this->_tpl_vars['hall_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['hall']):
?>
				<table>
					<tr class="block-hall-list">
						<td class="content_checkbox td_boder_none">
						<input type='checkbox' <?php if (( $this->_tpl_vars['hall']['flagChecked'] != null && $this->_tpl_vars['hall']['flagChecked'] )): ?> checked <?php endif; ?> name='percents_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hall']['hall_id']); ?>
' id="chx_discount_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hall']['hall_id']); ?>
" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['hall']['hall_id']); ?>
" onclick="showDiscount('chx_discount_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hall']['hall_id']); ?>
','discount_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hall']['hall_id']); ?>
')"><?php echo smarty_modifier_t_escape($this->_tpl_vars['hall']['hall_name']); ?>

						</td>
						<td class="td_boder_none">
						<p id="discount_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hall']['hall_id']); ?>
" <?php if ($this->_tpl_vars['hall']['flagChecked'] === null): ?> class="display_block" <?php endif; ?> >値引き率：<input id="percent_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hall']['hall_id']); ?>
" type="text" name="percent_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hall']['hall_id']); ?>
" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['hall']['pecentValue']); ?>
" size=10> ％引き</p>
						</td>
					</tr>
				</table>
			<?php endforeach; endif; unset($_from); ?>
		</div>
	</div>
</td>
</tr>

<tr>
<th>備考</th>
<td><textarea class="basic" name="info" cols="50" rows="4"><?php echo smarty_modifier_t_escape($this->_tpl_vars['agencylist']['info']); ?>
</textarea></td>
</tr>
</tbody>
</table>

<p class="textBtn">
<input type="button" id="btn_submit" class="submit"  value="　決　定　" onClick="checkHallList(<?php echo smarty_modifier_t_escape($this->_tpl_vars['hallLists']); ?>
)">
</p>
</form>
<script type="text/javascript">	
	
	var flag = 0;
	var nai = document.getElementById('nai').checked;
	if(nai == false){
		flag = 1;
	}
	function checkAmari(id)
	{
		var val = document.getElementById(id).value;
		if(val == 1)
		{
			flag = 1;
			//rremove class display_block
			document.getElementById("display_block_id").style.display="block";			
		}else{
			flag = 0;
			document.getElementById("display_block_id").style.display="none";
		}
	}
	// show discount
	function showDiscount(chx_id,dis_id)
	{
		var val = document.getElementById(chx_id).checked;
		if(val === true)
		{
			document.getElementById(dis_id).style.display="block";
		}else{
			document.getElementById(dis_id).style.display="none";
		}
	}
	// checkHallList
	function checkHallList(arr){
		var reg = new RegExp('^\\d+$');
		if(flag == 0){
			percent = document.getElementById('percentOld').value;
			if(percent == ''|| reg.test(percent) === 'false' || percent < 1 || percent > 100 ||  isNaN(percent) == true){
				if(document.getElementById("actionMsgId") != null){
					document.getElementById("actionMsgId").remove();
				}
				document.getElementById('actionMsgs').className = " actionMsg";
				document.getElementById('actionMsgs').innerHTML = '値引き率には1以上100以下の半角数字を入力してください。';
				window.scrollTo(30, 50);
			}else{
				document.getElementById('btn_submit').type = 'submit';
			}
		}else{
			// console.log(flag);
			var flagErr = 1;
			document.getElementById('btn_submit').type = 'button';
			// check validate			
			var reg = new RegExp('^\\d+$');

			for (i = 0; i < arr.length; i++) {
			    percent = document.getElementById('percent_'+arr[i]).value;
			    if(document.getElementById('chx_discount_'+arr[i]).checked){
			    	if(percent == '' || reg.test(percent) === 'false' || percent < 1 || percent > 100 || isNaN(percent) == true){
						flagErr = 0;
					}				
				}else{
					document.getElementById('percent_'+arr[i]).value = '';
				}
			}
			if(flagErr == 1){
				document.getElementById("percentOld").value = '';
				document.getElementById('btn_submit').type = 'submit';
			}else{
				if(document.getElementById("actionMsgId") != null){
					document.getElementById("actionMsgId").remove();
				}
				document.getElementById('actionMsgs').className = " actionMsg";
				document.getElementById('actionMsgs').innerHTML = '値引き率には1以上100以下の半角数字を入力してください。';
				window.scrollTo(30, 50);
			}
		}
	}
</script>
<?php echo $this->_tpl_vars['inc_footer']; ?>
