<?php
global $CTM_MSSQL, $CTM, $_PanelAdmin, $_RaffleSystem;
$CTM_RaffleSystem = new CTM_RaffleSystem(false);

$Account = $CTM_MSSQL->FetchQuery("SELECT type FROM dbo.{$CTM[0]} WHERE account='".$_SESSION["Hash_Account"]."'");
?>
<div class="box">
<div class="header">Painel Administrativo</div>
<script type="text/javascript">
    function toggle_visibility(id) {
        var e = document.getElementById(id);
        if(e.style.display === 'block')
            e.style.display = 'none';
        else
            e.style.display = 'block';
        }
</script>
<table width="100%" border="0" cellspacing="3" cellpadding="3">
  <tr>
    <td width="30%" valign="top">
        <div id="paneluser_bar_staff">
<?php
if($Account[0] >= $_PanelAdmin["ManageX"])
{
?>
<?php
if($Account[0] >= $_PanelAdmin["Manage"]["Sitronize"])
{
?>
                <a href="#" onclick="toggle_visibility('menu1');"><div class="classname">Sicronizar</div></a>
                <div id="menu1" style="display:none;" align="center">
                <div class="resposta" style="background-color:#1A77A8; color: white; border-radius: 4px; text-shadow: 0 1px 1px rgba(0, 0, 0, 0.2); width:190px; text-align: center;"
                onmouseout="this.style.backgroundColor='#1A77A8';" onmouseup="javascript: void(EffectWeb);" onclick="CTM_Load('?pag=paneladmin&str=SYNCHRONIZE&syntax=VIP','Panel_Nav','GET');">Sincronizar VIP</div>
                <div class="resposta" style="background-color:#1A77A8; color: white; border-radius: 4px; text-shadow: 0 1px 1px rgba(0, 0, 0, 0.2); width:190px; text-align: center;"
                onmouseout="this.style.backgroundColor='#1A77A8';" onmouseup="javascript: void(EffectWeb);" onclick="CTM_Load('?pag=paneladmin&str=SYNCHRONIZE&syntax=CHAR','Panel_Nav','GET');">Sincronizar Chars Banidos</div>
                <div class="resposta" style="background-color:#1A77A8; color: white; border-radius: 4px; text-shadow: 0 1px 1px rgba(0, 0, 0, 0.2); width:190px; text-align: center;"
                onmouseout="this.style.backgroundColor='#1A77A8';" onmouseup="javascript: void(EffectWeb);" onclick="CTM_Load('?pag=paneladmin&str=SYNCHRONIZE&syntax=ACC','Panel_Nav','GET');">Sincronizar Conta Banidas</div>
                                </div>
				<? } ?>
<?php
}
if(in_array($_SESSION["Hash_Account"], $_PanelAdmin["CronbJob"]["Security"]) == true)
{
?>
                <a href="#" onclick="toggle_visibility('menu2');"><div class="classname">CronJob</div></a>
                <div id="menu2" style="display:none;" align="center">
                <div class="resposta" style="background-color:#1A77A8; color: white; border-radius: 4px; text-shadow: 0 1px 1px rgba(0, 0, 0, 0.2); width:190px; text-align: center;"
                onmouseout="this.style.backgroundColor='#1A77A8';" onmouseup="javascript: void(EffectWeb);" onclick="CTM_Load('?pag=paneladmin&str=ADD_CRONTAB','Panel_Nav','GET');">Adicionar CronTab</div>
                <div class="resposta" style="background-color:#1A77A8; color: white; border-radius: 4px; text-shadow: 0 1px 1px rgba(0, 0, 0, 0.2); width:190px; text-align: center;"
                onmouseout="this.style.backgroundColor='#1A77A8';" onmouseup="javascript: void(EffectWeb);" onclick="CTM_Load('?pag=paneladmin&str=MANAGE_CRONTAB','Panel_Nav','GET');">Gerenciar CronTabs</div>
                </div>
<?php
}
if($Account[0] >= $_PanelAdmin["Mail"])
{
?>
                <a href="#" onclick="toggle_visibility('menu3');"><div class="classname">Email's</div></a>
                <div id="menu3" style="display:none;" align="center">
                <div class="resposta" style="background-color:#1A77A8; color: white; border-radius: 4px; text-shadow: 0 1px 1px rgba(0, 0, 0, 0.2); width:190px; text-align: center;"
                onmouseout="this.style.backgroundColor='#1A77A8';" onmouseup="javascript: void(EffectWeb);" onclick="CTM_Load('?pag=paneladmin&str=SEND_MAIL','Panel_Nav','GET');">Enviar E-Mail ao Jogador</div>
                </div>
<?php
}
if(in_array($_SESSION["Hash_Account"], $_RaffleSystem["Accounts"]) == true && $_RaffleSystem["Enable"] == true)
{
?>
                <a href="#" onclick="toggle_visibility('menu4');"><div class="classname">Sorteio de Players</div></a>
                <div id="menu4" style="display:none;" align="center">
                <?php
				if($CTM_RaffleSystem->Raffle_Panel("Raffle") == true)
				{
				?>
                <div class="resposta" style="background-color:#1A77A8; color: white; border-radius: 4px; text-shadow: 0 1px 1px rgba(0, 0, 0, 0.2); width:190px; text-align: center;"
                onmouseout="this.style.backgroundColor='#1A77A8';" onmouseup="javascript: void(EffectWeb);" onclick="CTM_Load('?pag=paneladmin&str=RAFFLE_PLAYER','Panel_Nav','GET');">Sortear Jogador</div>
				<?php
				}
				if($CTM_RaffleSystem->Raffle_Panel("Clear") == true)
				{
				?>
                <div class="resposta" style="background-color:#1A77A8; color: white; border-radius: 4px; text-shadow: 0 1px 1px rgba(0, 0, 0, 0.2); width:190px; text-align: center;"
                onmouseout="this.style.backgroundColor='#1A77A8';" onmouseup="javascript: void(EffectWeb);" onclick="CTM_Load('?pag=paneladmin&str=CLEAR_RAFFLES','Panel_Nav','GET');">Limpar Lista de Sorteados</div>
                <? } ?>
                </div>
<?php
}
if($Account[0] >= $_PanelAdmin["Downloads"])
{
?>
                <a href="#" onclick="toggle_visibility('menu5');"><div class="classname">Downloads</div></a>
                <div id="menu5" style="display:none;" align="center">
                <div class="resposta" style="background-color:#1A77A8; color: white; border-radius: 4px; text-shadow: 0 1px 1px rgba(0, 0, 0, 0.2); width:190px; text-align: center;"
                onmouseout="this.style.backgroundColor='#1A77A8';" onmouseup="javascript: void(EffectWeb);" onclick="CTM_Load('?pag=paneladmin&str=ADD_FILE','Panel_Nav','GET');">Adicionar Arquivo</div>
                <div class="resposta" style="background-color:#1A77A8; color: white; border-radius: 4px; text-shadow: 0 1px 1px rgba(0, 0, 0, 0.2); width:190px; text-align: center;"
                onmouseout="this.style.backgroundColor='#1A77A8';" onmouseup="javascript: void(EffectWeb);" onclick="CTM_Load('?pag=paneladmin&str=MANAGE_FILES','Panel_Nav','GET');">Gerenciar Arquivos</div>
                </div>
<?php
}
if($Account[0] >= $_PanelAdmin["Poll"])
{
?>
                <a href="#" onclick="toggle_visibility('menu6');"><div class="classname">Enquetes</div></a>
                <div id="menu6" style="display:none;" align="center">
                <div class="resposta" style="background-color:#1A77A8; color: white; border-radius: 4px; text-shadow: 0 1px 1px rgba(0, 0, 0, 0.2); width:190px; text-align: center;"
                onmouseout="this.style.backgroundColor='#1A77A8';" onmouseup="javascript: void(EffectWeb);" onclick="CTM_Load('?pag=paneladmin&str=POLL_OPT','Panel_Nav','GET');">Adicionar Enquete</div>
                <div class="resposta" style="background-color:#1A77A8; color: white; border-radius: 4px; text-shadow: 0 1px 1px rgba(0, 0, 0, 0.2); width:190px; text-align: center;"
                onmouseout="this.style.backgroundColor='#1A77A8';" onmouseup="javascript: void(EffectWeb);" onclick="CTM_Load('?pag=paneladmin&str=MANAGE_POLL','Panel_Nav','GET');">Gerenciar Enquetes</div>
                </div>
<?php
}
if($Account[0] >= $_PanelAdmin["Account"])
{
?>
                <a href="#" onclick="toggle_visibility('menu7');"><div class="classname">Gerenciar Contas</div></a>
                <div id="menu7" style="display:none;" align="center">
                 <?php
				 if($Account[0] >= $_PanelAdmin["Accounts"]["Manage"])
				 {
				 ?>
                <div class="resposta" style="background-color:#1A77A8; color: white; border-radius: 4px; text-shadow: 0 1px 1px rgba(0, 0, 0, 0.2); width:190px; text-align: center;"
                onmouseout="this.style.backgroundColor='#1A77A8';" onmouseup="javascript: void(EffectWeb);" onclick="CTM_Load('?pag=paneladmin&str=MANAGE_ACC','Panel_Nav','GET');">Gerenciar Conta</div>
                 <? } ?>
                <div class="resposta" style="background-color:#1A77A8; color: white; border-radius: 4px; text-shadow: 0 1px 1px rgba(0, 0, 0, 0.2); width:190px; text-align: center;"
                onmouseout="this.style.backgroundColor='#1A77A8';" onmouseup="javascript: void(EffectWeb);" onclick="CTM_Load('?pag=paneladmin&str=BAN_ACC','Panel_Nav','GET');">Banir Conta</div>
                <div class="resposta" style="background-color:#1A77A8; color: white; border-radius: 4px; text-shadow: 0 1px 1px rgba(0, 0, 0, 0.2); width:190px; text-align: center;"
                onmouseout="this.style.backgroundColor='#1A77A8';" onmouseup="javascript: void(EffectWeb);" onclick="CTM_Load('?pag=paneladmin&str=UNBAN_ACC','Panel_Nav','GET');">Desbanir Conta</div>
                <?php
				if(in_array($_SESSION["Hash_Account"], $_PanelAdmin["General"]["Master"]) === true)
				{
				?>
                <div class="resposta" style="background-color:#1A77A8; color: white; border-radius: 4px; text-shadow: 0 1px 1px rgba(0, 0, 0, 0.2); width:190px; text-align: center;"
                onmouseout="this.style.backgroundColor='#1A77A8';" onmouseup="javascript: void(EffectWeb);" onclick="CTM_Load('?pag=paneladmin&str=DELETE_ACC','Panel_Nav','GET');">Gerenciar Enquetes</div>
               <? } ?>
                </div>
<?php
}
if($Account[0] >= $_PanelAdmin["Character"])
{
?>
                <a href="#" onclick="toggle_visibility('menu8');"><div class="classname">Gerenciar Personagens</div></a>
                <div id="menu8" style="display:none;" align="center">
                  <?php
				 if($Account[0] >= $_PanelAdmin["Characters"]["Create"])
				 {
				 ?>
                <div class="resposta" style="background-color:#1A77A8; color: white; border-radius: 4px; text-shadow: 0 1px 1px rgba(0, 0, 0, 0.2); width:190px; text-align: center;"
                onmouseout="this.style.backgroundColor='#1A77A8';" onmouseup="javascript: void(EffectWeb);" onclick="CTM_Load('?pag=paneladmin&str=CREATE_CHAR','Panel_Nav','GET');">Criar Personagem</div>
                 <?php
				 }
				 if($Account[0] >= $_PanelAdmin["Characters"]["Manage"])
				 {
				 ?>
                <div class="resposta" style="background-color:#1A77A8; color: white; border-radius: 4px; text-shadow: 0 1px 1px rgba(0, 0, 0, 0.2); width:190px; text-align: center;"
                onmouseout="this.style.backgroundColor='#1A77A8';" onmouseup="javascript: void(EffectWeb);" onclick="CTM_Load('?pag=paneladmin&str=MANAGE_CHAR','Panel_Nav','GET');">Editar Personagem</div>
                <div class="resposta" style="background-color:#1A77A8; color: white; border-radius: 4px; text-shadow: 0 1px 1px rgba(0, 0, 0, 0.2); width:190px; text-align: center;"
                onmouseout="this.style.backgroundColor='#1A77A8';" onmouseup="javascript: void(EffectWeb);" onclick="CTM_Load('?pag=paneladmin&str=UNBAN_CHAR','Panel_Nav','GET');">Desbanir Char</div>
                 <? } ?>
                <div class="resposta" style="background-color:#1A77A8; color: white; border-radius: 4px; text-shadow: 0 1px 1px rgba(0, 0, 0, 0.2); width:190px; text-align: center;"
                onmouseout="this.style.backgroundColor='#1A77A8';" onmouseup="javascript: void(EffectWeb);" onclick="CTM_Load('?pag=paneladmin&str=BAN_CHAR','Panel_Nav','GET');">Banir Char</div>
                <?php
				if(in_array($_SESSION["Hash_Account"], $_PanelAdmin["General"]["Master"]) === true)
				{
				?>
                <div class="resposta" style="background-color:#1A77A8; color: white; border-radius: 4px; text-shadow: 0 1px 1px rgba(0, 0, 0, 0.2); width:190px; text-align: center;"
                onmouseout="this.style.backgroundColor='#1A77A8';" onmouseup="javascript: void(EffectWeb);" onclick="CTM_Load('?pag=paneladmin&str=DELETE_CHAR','Panel_Nav','GET');">Deletar Personagem</div>
               <? } ?>
                </div>
<?php
}
if($Account[0] >= $_PanelAdmin["Reference"])
{
?>
                <a href="#" onclick="toggle_visibility('menu9');"><div class="classname">Referencias</div></a>
                <div id="menu9" style="display:none;" align="center">
                <div class="resposta" style="background-color:#1A77A8; color: white; border-radius: 4px; text-shadow: 0 1px 1px rgba(0, 0, 0, 0.2); width:190px; text-align: center;"
                onmouseout="this.style.backgroundColor='#1A77A8';" onmouseup="javascript: void(EffectWeb);" onclick="CTM_Load('?pag=paneladmin&str=SHOW_REFERENCE','Panel_Nav','GET');">Ranking</div>
                <div class="resposta" style="background-color:#1A77A8; color: white; border-radius: 4px; text-shadow: 0 1px 1px rgba(0, 0, 0, 0.2); width:190px; text-align: center;"
                onmouseout="this.style.backgroundColor='#1A77A8';" onmouseup="javascript: void(EffectWeb);" onclick="CTM_Load('?pag=paneladmin&str=RESET_REFERENCE','Panel_Nav','GET');">Resetar</div>
                </div>
<?php
}
if($Account[0] >= $_PanelAdmin["Tickets"])
{
?>
                <a href="#" onclick="toggle_visibility('menu10');"><div class="classname">Tickets</div></a>
                <div id="menu10" style="display:none;" align="center">
                <div class="resposta" style="background-color:#1A77A8; color: white; border-radius: 4px; text-shadow: 0 1px 1px rgba(0, 0, 0, 0.2); width:190px; text-align: center;"
                onmouseout="this.style.backgroundColor='#1A77A8';" onmouseup="javascript: void(EffectWeb);" onclick="CTM_Load('?pag=paneladmin&str=TICKETS','Panel_Nav','GET');">Tickets de Suporte</div>
                </div>
<?php
}
if($Account[0] >= $_PanelAdmin["Payments"])
{
?>
                <a href="#" onclick="toggle_visibility('menu11');"><div class="classname">Pagamentos</div></a>
                <div id="menu11" style="display:none;" align="center">
                <div class="resposta" style="background-color:#1A77A8; color: white; border-radius: 4px; text-shadow: 0 1px 1px rgba(0, 0, 0, 0.2); width:190px; text-align: center;"
                onmouseout="this.style.backgroundColor='#1A77A8';" onmouseup="javascript: void(EffectWeb);" onclick="CTM_Load('?pag=paneladmin&str=PAYMENTS','Panel_Nav','GET');">Gerenciar Pagamentos</div>
                </div>
<?php
}
if($Account[0] >= $_PanelAdmin["VIP"])
{
?>
                <a href="#" onclick="toggle_visibility('menu12');"><div class="classname">Gerenciar Vips</div></a>
                <div id="menu12" style="display:none;" align="center">
                <div class="resposta" style="background-color:#1A77A8; color: white; border-radius: 4px; text-shadow: 0 1px 1px rgba(0, 0, 0, 0.2); width:190px; text-align: center;"
                onmouseout="this.style.backgroundColor='#1A77A8';" onmouseup="javascript: void(EffectWeb);" onclick="CTM_Load('?pag=paneladmin&str=ADD_VIP','Panel_Nav','GET');">Adicionar VIP</div>
                <div class="resposta" style="background-color:#1A77A8; color: white; border-radius: 4px; text-shadow: 0 1px 1px rgba(0, 0, 0, 0.2); width:190px; text-align: center;"
                onmouseout="this.style.backgroundColor='#1A77A8';" onmouseup="javascript: void(EffectWeb);" onclick="CTM_Load('?pag=paneladmin&str=TRANSFORM_VIP','Panel_Nav','GET');">Transformar VIP</div>
                <div class="resposta" style="background-color:#1A77A8; color: white; border-radius: 4px; text-shadow: 0 1px 1px rgba(0, 0, 0, 0.2); width:190px; text-align: center;"
                onmouseout="this.style.backgroundColor='#1A77A8';" onmouseup="javascript: void(EffectWeb);" onclick="CTM_Load('?pag=paneladmin&str=DELETE_VIP','Panel_Nav','GET');">Remover VIP</div>
                <?php
                if($Account[0] >= $_PanelAdmin["VIP"])
				{
				?>
                <div class="resposta" style="background-color:#1A77A8; color: white; border-radius: 4px; text-shadow: 0 1px 1px rgba(0, 0, 0, 0.2); width:190px; text-align: center;"
                onmouseout="this.style.backgroundColor='#1A77A8';" onmouseup="javascript: void(EffectWeb);" onclick="CTM_Load('?pag=paneladmin&str=ADD_VIP_ALL','Panel_Nav','GET');">Adicionar todas as Conta</div>
                <? } ?>
                </div>
<?php
}
if($Account[0] >= $_PanelAdmin["Cash"])
{
?>
                <a href="#" onclick="toggle_visibility('menu13');"><div class="classname">Cashs</div></a>
                <div id="menu13" style="display:none;" align="center">
                <div class="resposta" style="background-color:#1A77A8; color: white; border-radius: 4px; text-shadow: 0 1px 1px rgba(0, 0, 0, 0.2); width:190px; text-align: center;"
                onmouseout="this.style.backgroundColor='#1A77A8';" onmouseup="javascript: void(EffectWeb);" onclick="CTM_Load('?pag=paneladmin&str=ADD_CASH','Panel_Nav','GET');">Adicionar Moeda</div>
                <div class="resposta" style="background-color:#1A77A8; color: white; border-radius: 4px; text-shadow: 0 1px 1px rgba(0, 0, 0, 0.2); width:190px; text-align: center;"
                onmouseout="this.style.backgroundColor='#1A77A8';" onmouseup="javascript: void(EffectWeb);" onclick="CTM_Load('?pag=paneladmin&str=DELETE_CASH','Panel_Nav','GET');">Remover Moeda</div>
                </div>
<?php
}
if($Account[0] >= $_PanelAdmin["AdicionarEventos"])
{
?>
                <a href="#" onclick="toggle_visibility('menu14');"><div class="classname">Pontos Eventos</div></a>
                <div id="menu14" style="display:none;" align="center">
                <div class="resposta" style="background-color:#1A77A8; color: white; border-radius: 4px; text-shadow: 0 1px 1px rgba(0, 0, 0, 0.2); width:190px; text-align: center;"
                onmouseout="this.style.backgroundColor='#1A77A8';" onmouseup="javascript: void(EffectWeb);" onclick="CTM_Load('?pag=paneladmin&str=ADD_EVENTO','Panel_Nav','GET');">Eventos</div>
                </div>
<?php
}
if($Account[0] >= $_PanelAdmin["GerenciarLogs"])
{
?>
                <a href="#" onclick="toggle_visibility('menu15');"><div class="classname">Gerenciar Logs</div></a>
                <div id="menu15" style="display:none;" align="center">
                <div class="resposta" style="background-color:#1A77A8; color: white; border-radius: 4px; text-shadow: 0 1px 1px rgba(0, 0, 0, 0.2); width:190px; text-align: center;"
                onmouseout="this.style.backgroundColor='#1A77A8';" onmouseup="javascript: void(EffectWeb);" onclick="CTM_Load('?pag=paneladmin&str=LOG_EVENTO','Panel_Nav','GET');">Log de Eventos</div>
                		<?php
				 if($Account[0] >= $_PanelAdmin["LogsAdministrativos"]["Administrativo"])
				 {
				 ?>
                <div class="resposta" style="background-color:#1A77A8; color: white; border-radius: 4px; text-shadow: 0 1px 1px rgba(0, 0, 0, 0.2); width:190px; text-align: center;"
                onmouseout="this.style.backgroundColor='#1A77A8';" onmouseup="javascript: void(EffectWeb);" onclick="CTM_Load('?pag=paneladmin&str=LOG_ADMIN','Panel_Nav','GET');">Logs Administrativos</div>
                    <? } ?>
                </div>
<?php
}
if($Account[0] >= $_PanelAdmin["VerificarContas"])
{
?>
                <a href="#" onclick="toggle_visibility('menu16');"><div class="classname">Verificar Contas</div></a>
                <div id="menu16" style="display:none;" align="center">
                <div class="resposta" style="background-color:#1A77A8; color: white; border-radius: 4px; text-shadow: 0 1px 1px rgba(0, 0, 0, 0.2); width:190px; text-align: center;"
                onmouseout="this.style.backgroundColor='#1A77A8';" onmouseup="javascript: void(EffectWeb);" onclick="CTM_Load('?pag=paneladmin&str=VERIF_CONT','Panel_Nav','GET');">Verificar</div>
                </div>
<?php
}
if($Account[0] >= $_PanelAdmin["GerenciarStaff"])
{
?>
                <a href="#" onclick="toggle_visibility('menu17');"><div class="classname">Gerenciar Equipe</div></a>
                <div id="menu17" style="display:none;" align="center">
                <div class="resposta" style="background-color:#1A77A8; color: white; border-radius: 4px; text-shadow: 0 1px 1px rgba(0, 0, 0, 0.2); width:190px; text-align: center;"
                onmouseout="this.style.backgroundColor='#1A77A8';" onmouseup="javascript: void(EffectWeb);" onclick="CTM_Load('?pag=paneladmin&str=GER_PAINEL','Panel_Nav','GET');">Adicionar Painel</div>
                <div class="resposta" style="background-color:#1A77A8; color: white; border-radius: 4px; text-shadow: 0 1px 1px rgba(0, 0, 0, 0.2); width:190px; text-align: center;"
                onmouseout="this.style.backgroundColor='#1A77A8';" onmouseup="javascript: void(EffectWeb);" onclick="CTM_Load('?pag=paneladmin&str=GER_PAINEL_R','Panel_Nav','GET');">Remover Painel</div>
                <div class="resposta" style="background-color:#1A77A8; color: white; border-radius: 4px; text-shadow: 0 1px 1px rgba(0, 0, 0, 0.2); width:190px; text-align: center;"
                onmouseout="this.style.backgroundColor='#1A77A8';" onmouseup="javascript: void(EffectWeb);" onclick="CTM_Load('?pag=paneladmin&str=GER_PAINEL_E','Panel_Nav','GET');">Editar Membro</div>
                </div>
                
<? } ?>
</td>
</div>
       <td id="Panel_Nav" valign="top">
	   {Panel_Navigator}
	   </td>
  </tr>
</table></div>