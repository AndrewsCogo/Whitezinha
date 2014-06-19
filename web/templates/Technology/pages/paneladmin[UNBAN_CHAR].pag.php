<script language="javascript1.5">
function Unban_Character()
{
	var Check = confirm('Atencao\r\nTem certeza que deseja desbanir este Char?');
	if (Check == true)
	{
		CTM_Load('?pag=paneladmin&str=UNBAN_CHAR&cmd=true', 'Command','POST',BuscaElementosForm('Unban_Char'));
		return true;
	}
}
</script>
<div class="box">
<div class="header">Debanir Char</div>
	<blockquote>
<form name="Unban_Char" id="Unban_Char">
<table width="500" align="center" border="0">
  <tr>
    <td>Char:</td>
    <td><select name="Character" id="Character">
	<option value="" disabled="disabled" selected="selected">Selecione</option>
    {Characters_Banned}
	</select>&nbsp;<input type="button" value="Desbanir Char" onclick="Unban_Character();" /></td>
  </tr>
</table>
</form>
</blockquote>
<div id="Command"></div>
</div>