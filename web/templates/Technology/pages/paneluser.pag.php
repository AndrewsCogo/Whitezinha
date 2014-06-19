<div class="box">
<div class="header">Painel de Controle</div>
<table width="100%" border="0" cellspacing="4" cellpadding="4">
  <tr>
    <td width="22%" valign="top">
<div id="paneluser_bar">
<div class="block">
                <h2 class="blockhead">Gerenciar Conta</h2>
                <div class="blockbody">
                        <ul class="blockrow">
				<li class="inactive"><a href="javascript: void(EffectWeb);" onclick="CTM_Load('?pag=paneluser&str=HOME','Panel_Nav','GET');">Minha Conta</a></li>
                <li class="inactive"><a rel="panel" title="{Account_Dates#1},{Account_Dates#2},{Account_Dates#3}" str="Alterar Dados" href="javascript: void(EffectWeb);" onclick="CTM_Load('?pag=paneluser&str=ACCOUNT','Panel_Nav','GET');">Alterar Dados</a></li>
                <li class="inactive"><a href="javascript: void(EffectWeb);" onclick="CTM_Load('?pag=paneluser&str=CHANGE_PID','Panel_Nav','GET');">Alterar Personal ID</a></li>
                <li class="inactive"><a rel="panel" title="{Account_Change_Mail#1},{Account_Change_Mail#2},{Account_Change_Mail#3}" str="Alterar E-Mail" href="javascript: void(EffectWeb);" onclick="CTM_Load('?pag=paneluser&str=CHANGE_MAIL','Panel_Nav','GET');">Alterar E-Mail</a></li>
				<li class="inactive"><a href="javascript: void(EffectWeb);" onclick="CTM_Load('?pag=paneluser&str=SELECT_CHAR','Panel_Nav','GET');">Gerenciar Personagem</a></li>
                <li class="inactive"><a rel="panel" title="{Account_Repair_Vault#1},{Account_Repair_Vault#2},{Account_Repair_Vault#3}" str="Reparar Ba&uacute;" href="javascript: void(EffectWeb);" onclick="CTM_Load('?pag=paneluser&str=REPAIR_VAULT','Panel_Nav','GET');">Reparar Ba&uacute;</a></li>
                <li class="inactive"><a rel="panel" title="{Account_Connects#1},{Account_Connects#2},{Account_Connects#3}" str="Conex&otilde;es Recentes" href="javascript: void(EffectWeb);" onclick="CTM_Load('?pag=paneluser&str=CONNECTS','Panel_Nav','GET');">Conex&otilde;es Recentes</a></li>
                        </ul>
                </div>
        </div>
		<div id="Char_Div">
        {Character_Manage}
        </div>
        <div class="block">
                <h2 class="blockhead">Divulga&ccedil;&atilde;o</h2>
                <div class="blockbody">
                        <ul class="blockrow">
				<li class="inactive"><a href="javascript: void(EffectWeb);" onclick="CTM_Load('?pag=paneluser&str=REFERENCE_LINK','Panel_Nav','GET');">Link de Refer&ecirc;ncia</a></li>
                        </ul>
                </div>
        </div>
		<div class="block">
                <h2 class="blockhead">Suporte</h2>
                <div class="blockbody">
                        <ul class="blockrow">
				<li class="inactive"><a rel="panel" title="{Suportt_Tickets#1},{Suportt_Tickets#2},{Suportt_Tickets#3}" str="Tickets de Suporte" href="javascript: void(EffectWeb);" onclick="CTM_Load('?pag=paneluser&str=TICKETS','Panel_Nav','GET');">Tickets</a></li>
                        </ul>
                </div>
        </div>
		<div class="block">
                <h2 class="blockhead">Financeiro</h2>
                <div class="blockbody">
                        <ul class="blockrow">
				<li class="inactive"><a href="javascript: void(EffectWeb);" onclick="CTM_Load('?pag=paneluser&str=PAYMENTS','Panel_Nav','GET');">Pagamentos</a></li>
                <li class="inactive"><a href="javascript: void(EffectWeb);" onclick="CTM_Load('?pag=paneluser&str=TRADE_AMOUNT','Panel_Nav','GET');">Trocar Moedas</a></li>
				<li class="inactive"><a href="javascript: void(EffectWeb);" onclick="CTM_Load('?pag=paneluser&str=BUY_VIP','Panel_Nav','GET');">Comprar VIP</a></li>
                        </ul>
                </div>
        </div>
      </div>
      </td>
       <td id="Panel_Nav" valign="top">
       {Panel_Navigator}
       </td>
  </tr>
</table>
</div>