<?php /* Smarty version 2.6.18, created on 2017-03-02 09:08:56
         compiled from file:/var/www/html/atoffice/webapp/templates/mail/m_admin_taikai.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 't_implode', 'file:/var/www/html/atoffice/webapp/templates/mail/m_admin_taikai.tpl', 21, false),)), $this); ?>
【<?php echo $this->_tpl_vars['SNS_NAME']; ?>
】<?php echo $this->_tpl_vars['c_member']['nickname']; ?>
さんが退会しました。

退会者データ

メンバーID : <?php echo $this->_tpl_vars['c_member']['c_member_id']; ?>

<?php if ($this->_tpl_vars['login_id']): ?>ログインID : <?php echo $this->_tpl_vars['login_id']; ?>

<?php endif; ?>
<?php echo $this->_tpl_vars['WORD_NICKNAME']; ?>
 : <?php echo $this->_tpl_vars['c_member']['nickname']; ?>

<?php if (@OPENPNE_USE_POINT_RANK): ?>
ランク : <?php echo $this->_tpl_vars['c_member']['rank']['name']; ?>

ポイント : <?php echo $this->_tpl_vars['c_member']['point']; ?>

<?php endif; ?>
最終ログイン : <?php echo $this->_tpl_vars['c_member']['access_date']; ?>

登録日 : <?php echo $this->_tpl_vars['c_member']['r_date']; ?>

招待者 : <?php echo $this->_tpl_vars['c_member']['c_member_id_invite']; ?>
 (<?php echo $this->_tpl_vars['c_member']['c_member_invite']['nickname']; ?>
)
生年月日 : <?php if ($this->_tpl_vars['c_member']['birth_year']): ?><?php echo $this->_tpl_vars['c_member']['birth_year']; ?>
年<?php endif; ?><?php if ($this->_tpl_vars['c_member']['birth_month']): ?><?php echo $this->_tpl_vars['c_member']['birth_month']; ?>
月<?php endif; ?><?php if ($this->_tpl_vars['c_member']['birth_day']): ?><?php echo $this->_tpl_vars['c_member']['birth_day']; ?>
日<?php endif; ?>

<?php $_from = $this->_tpl_vars['c_profile_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['prof']):
?>
<?php if ($this->_tpl_vars['prof']['name'] != 'PNE_POINT'): ?>
<?php if ($this->_tpl_vars['prof']['form_type'] == 'checkbox'): ?>
<?php echo $this->_tpl_vars['prof']['caption']; ?>
 : <?php echo smarty_modifier_t_implode($this->_tpl_vars['c_member']['profile'][$this->_tpl_vars['prof']['name']]['value'], ", "); ?>

<?php else: ?>
<?php echo $this->_tpl_vars['prof']['caption']; ?>
 : <?php echo $this->_tpl_vars['c_member']['profile'][$this->_tpl_vars['prof']['name']]['value']; ?>

<?php endif; ?>
<?php endif; ?>
<?php endforeach; endif; unset($_from); ?>

PCメールアドレス : <?php echo $this->_tpl_vars['c_member']['secure']['pc_address']; ?>

携帯メールアドレス : <?php echo $this->_tpl_vars['c_member']['secure']['ktai_address']; ?>

登録時メールアドレス : <?php echo $this->_tpl_vars['c_member']['secure']['regist_address']; ?>


<?php if ($this->_tpl_vars['reason']): ?>
退会理由
---------------------------------------------------
<?php echo $this->_tpl_vars['reason']; ?>

---------------------------------------------------
<?php else: ?>
管理人による強制退会
<?php endif; ?>


<?php echo $this->_tpl_vars['inc_signature']; ?>
