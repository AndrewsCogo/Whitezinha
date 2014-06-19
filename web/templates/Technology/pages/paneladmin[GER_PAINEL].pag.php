<div class="box">
<div class="header">Adicionar Painel</div>
	   <blockquote>
	   <form name="Gerenciar_Painel" id="Gerenciar_Painel">
<table width="500" border="0" align="center">
  <tr>
    <td width="181">Loguim:</td>
    <td width="226"><input type="text" name="Account" id="Account" /></td>
  </tr>
  <tr>
    <td width="181">Nome:</td>
    <td width="226"><input type="text" name="Nome" id="Nome" /></td>
  </tr>
  <tr>
    <td>Cargo:</td>
    <td><select name="Cargo" id="Cargo">
    <option value="" disabled="disabled" selected="selected">Selecione</option>
    <option value="1">Moderador</option>
    <option value="2">GameMaster</option>
    <option value="3">Sub-Administrador</option>
    </select></td>
  </tr>
  <tr>
      <td><input type="button" value="Adicionar Ponto" onclick="CTM_Load('?pag=paneladmin&str=GER_PAINEL&cmd=true','Command','POST',BuscaElementosForm('Gerenciar_Painel'));" /></td>
  </tr>
</form>
</table>
           </blockquote>
<table width="100%">
    <tr>
        <td>
	<div id="Command"></div>
        </td>
    </tr>
</table>
</div>