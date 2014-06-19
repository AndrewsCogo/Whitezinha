<div class="box">
<div class="header">Gerenciar Conta</div>
	   <blockquote>
	   <form name="Load_Account" id="Load_Account">
<table width="500" border="0" align="center">
  <tr>
    <td width="181">Referencia:</td>
    <td width="226"><input type="text" name="Account" id="Account" /></td>
  </tr>
  <tr>
    <td width="181">Buscar Por:</td>
    <td width="226"><select name="Search" id="Search">
    <option value="1">Login</option>
    <option value="2">E-Mail</option>
    <option value="3">IP Recente</option>
    <option value="4">Personagem</option>
    </select>
    </td>
  </tr>
</table>
<input type="button" value="Carregar Informa&ccedil;&otilde;es" onclick="CTM_Load('?pag=paneladmin&str=EDIT_ACC','Show_Options','POST',BuscaElementosForm('Load_Account'));" />
</form>
	</blockquote>
	<div id="Show_Options"></div>
</div>