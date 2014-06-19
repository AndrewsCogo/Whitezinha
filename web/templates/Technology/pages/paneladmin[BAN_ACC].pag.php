<div class="box">
<div class="header">Banir Conta</div>
	<blockquote>
<form name="Ban_Acc" id="Ban_Acc">
<table width="500" border="0" align="center">
  <tr>
    <td>Conta:</td>
    <td><input type="text" name="Account" id="Account" /></td>
  </tr>
  <tr>
    <td>Tempo:</td>
    <td><input type="text" name="Time" id="Time" onKeyPress="return NumbersOnly(event)" /></td>
  </tr>
  <tr>
    <td>Motivo:</td>
    <td><input type="text" name="Reason" id="Reason" /></td>
  </tr>
</table>
<input type="button" value="Banir Conta" onclick="CTM_Load('?pag=paneladmin&str=BAN_ACC&cmd=true','Command','POST',BuscaElementosForm('Ban_Acc'));" />
</form>
</blockquote>
<div id="Command"></div>
</div>