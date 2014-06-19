<div class="box">
<div class="header">Adicionar Enquete</div>
	   <blockquote>
	   <form name="Poll_Options" id="Poll_Options">
<table width="500" border="0" align="center">
  <tr>
    <td width="181">Numero de Respostas:</td>
    <td width="226"><input type="text" name="Answer_Number" id="Answer_Number" onKeyPress="return NumbersOnly(event);" /></td>
  </tr>
</table>
<input type="button" value="Continuar..." onclick="CTM_Load('?pag=paneladmin&str=ADD_POLL','Show_Options','POST',BuscaElementosForm('Poll_Options'));" />
</form><br /><br />
	</blockquote>
	<div id="Show_Options"></div>
</div>