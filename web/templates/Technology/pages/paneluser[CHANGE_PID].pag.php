<div class="box">
<div class="header">Alterar Personal ID</div>
			<blockquote>
<p>O Personal ID &eacute; usado para efetuar certos processos dentro do Jogo.</p>
<form name="Change_PID" id="Change_PID">
<table width="500" border="0" align="center">
  <tr>
    <td>Novo PID:</td>
    <td><input type="password" name="NEW_PID" id="NEW_PID" onkeypress="return NumbersOnly(event);" maxlength="7"/></td>
  </tr>
  <tr>
    <td>Sua Senha Atual:</td>
    <td><input type="password" name="PASSWORD" id="PASSWORD" /></td>
  </tr>
</table>
<input type="button" value="Alterar PID" onClick="CTM_Load('?pag=paneluser&str=CHANGE_PID&cmd=true', 'Command', 'POST', BuscaElementosForm('Change_PID'));">
</form>
</blockquote>
<div id="Command"></div>
</div>