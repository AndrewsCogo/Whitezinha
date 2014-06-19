<div class="box">
<div class="header">Informa&ccedil;&otilde;es</div>
	   <blockquote>
	   <div id="TabbedPanels1" class="TabbedPanels">
  <ul class="TabbedPanelsTabGroup" style="font-size: 13px;">
    <li class="TabbedPanelsTab" tabindex="0">Suas Informa&ccedil;&otilde;es</li>
    <li class="TabbedPanelsTab" tabindex="0">Informa&ccedil;&otilde;es do Servidor</li>
    <li class="TabbedPanelsTab" tabindex="0">Staff Eventos Diarios</li>
  </ul>
  <div class="TabbedPanelsContentGroup">
    <div class="TabbedPanelsContent">
	<table width="362" border="0">
  <tr>
    <td>&raquo; Seu Nick:</td>
    <td><strong>{NickStaff}</strong></td>
  </tr>
  <tr>
    <td>&raquo; Eventos Hoje:</td>
    <td><strong>{EventosHojeStaff}</strong></td>
  </tr>
  <tr>
    <td>&raquo; Eventos Totais:</td>
    <td><strong>{EventosTotal}</strong></td>
  </tr>
  <tr>
    <td>&raquo; Ingressou:</td>
    <td><strong>{Ingresso}</strong></td>
  </tr>
  <tr>
    <td>&raquo; Cargo:</td>
    <td><strong>{Cargo}</strong></td>
  </tr>
  </table>
  </div>
    <div class="TabbedPanelsContent">
	<table width="362" border="0">
  <tr>
    <td>&raquo; Total de Contas:</td>
    <td><strong>{Info_Accounts}</strong></td>
  </tr>
  <tr>
    <td>&raquo; Total de contas {VIP_Name#1}:</td>
    <td><strong>{Info_VIP-1}</strong></td>
  </tr>
  <tr>
    <td>&raquo; Total de contas {VIP_Name#2}:</td>
    <td><strong>{Info_VIP-2}</strong></td>
  </tr>
  <tr>
    <td>&raquo; Total de Personagens:</td>
    <td><strong>{Info_Characters}</strong></td>
  </tr>
  <tr>
    <td>&raquo; Personagens Banidos:</td>
    <td><strong>{Info_Char-Ban}</strong></td>
  </tr>
  <tr>
    <td>&raquo; Contas Banidas:</td>
    <td><strong>{Info_Acc-Ban}</strong></td>
  </tr>
  <?php
  if(constant("Status_Enable") == true)
  {
  ?>
  <tr>
    <td>&raquo; Status do Servidor:</td>
    <td><strong>{Info_Status}</strong></td>
  </tr>
  <? } ?>
  </table>
  </div>
   <div class="TabbedPanelsContent">
	<table width="362" border="0">
  <tr>
    <td><strong>{Info_Eventos}</strong></td>
  </tr>
  </table>
  </div>
<script type="text/javascript">
var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");
</script>
	</blockquote>
</div>