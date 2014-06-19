<div class="box">
<div class="header">Adicionar Eventos</div>
	   <blockquote>
	   <form name="Add_Eventos" id="Add_Eventos">
<table width="500" border="0" align="center">
  <tr>
    <td width="181">Conta/Char:</td>
    <td width="226"><input type="text" name="Account" id="Account" /></td>
  </tr>
  <tr>
    <td>Evento:</td>
    <td><select name="Evento" id="Evento">
    <option value="" disabled="disabled" selected="selected">Selecione</option>
    <option value="1">Mata-Mata</option>
    <option value="2">Pega-Pega</option>
    <option value="3">BBBWhite</option>
    <option value="4">Mata-Pato</option>
    <option disabled="disabled"></option>
    <option value="5">Quis</option>
    <option value="6">The Flash</option>
    <option value="7">Trade Wins</option>
    <option value="8">Esconde-Esconde</option>
    <option value="9">Pega MD/GM</option>
    <option value="10">Sobreviv&ecirc;ncia</option>
    <option value="11">O Corajoso</option>
    <option value="12">Ca&ccedil;a ao Tesouro</option>
    <option value="13">Moveu Achou</option>
    <option value="14">Castle</option>
    <option value="15">X1 Premiado</option>
    <option value="16">Time x Time</option>
    <option value="17">Quiz x4</option>
    <option value="18">Diversos</option>
    </select></td>
  </tr>
  <tr>
      <td><input type="button" value="Adicionar Ponto" onclick="CTM_Load('?pag=paneladmin&str=ADD_EVENTO&cmd=true','Command','POST',BuscaElementosForm('Add_Eventos'));" /></td>
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