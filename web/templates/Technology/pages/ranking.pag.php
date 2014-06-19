<div class="box">
<div class="header">Ranking</div>
<h4>Ranking's</h2>
	<blockquote>
	<form name="Gerate_Ranking" id="Gerate_Ranking">
	<table width="95%" border="0" align="center">
  	<tr>
    <td width="150"><strong><label>Top:</label></strong> &nbsp;&nbsp;<select name="Top" id="Top">
    <option value="10">Top 10</option>
    <option value="10">Top 20</option>
    <option value="10">Top 30</option>
    <option value="10">Top 40</option>
    <option value="50">Top 50</option>
    <option value="100">Top 100</option>
    </select></td>
    <td width="180"><strong><label>Classe:</label></strong> &nbsp;&nbsp;<select name="Classe" id="Classe">
    <option value="1">Todas</option>
    <option value="2">Dark Wizard</option>
    <option value="3">Soul Master</option>
    <option value="4">Dark Knight</option>
    <option value="5">Blade Knight</option>
    <option value="6">Fary Elf</option>
    <option value="7">Muse Elf</option>
    <option value="8">Magic Gladiator</option>
    </select></td>
    <td width="210"><strong><label>Ranking:</label></strong> &nbsp;&nbsp;<select name="Ranking" id="Ranking">
    <option value="" disabled="disabled" selected="selected">Selecione</option>
    <optgroup label="Reset's">
    <option value="1">Di&aacute;rio</option>
    <option value="2">Semanal</option>
    <option value="3">Total</option>
    <!-- <option value="4">Medalha</option> -->
    </optgroup>
    <optgroup label="MR's">
    <option value="4">Di&aacute;rio</option>
    <option value="5">Semanal</option>
    <option value="6">Total</option>
    <!-- <option value="8">Medalhas</option>-->
    </optgroup>
    <optgroup label="PK's">
    <option value="7">Di&aacute;rio</option>
    <option value="8">Semanal</option>
    <option value="9">Total</option>
    <!-- <option value="12">Medalha</option>-->
    </optgroup>
    <optgroup label="Hero's">
    <option value="10">Di&aacute;rio</option>
    <option value="11">Semanal</option>
    <option value="12">Total</option>
    <!-- <option value="16">Medalha</option>-->
    </optgroup>
    <optgroup label="Hora's">
    <option value="13">Di&aacute;ria</option>
    <option value="14">Semanal</option>
    <option value="15">Total</option>
     <!-- <option value="20">Medalha</option>-->
    </optgroup>
    <optgroup label="Guild's">
    <option value="16">Total</option>
    </optgroup>
    <optgroup label="Evento's">
    <option value="19">Rei do White</option>
    <option value="20">Mata-Mata</option>
    <option value="21">Pega-Pega</option>
    <option value="22">BBB White</option>
    <option value="23">Mata-Pato</option>
    <option value="24">Quis</option>
    <option value="25">The-Flash</option>
    <option value="26">Trade Wins</option>
    <option value="27">Esconde-Esconde</option>
    <option value="28">Pega MD/GM</option>
    <option value="29">Sobrevivencia</option>
    <option value="30">O Corajoso</option>
    <option value="31">Ca&ccedil;a ao tesouro</option>
    <option value="32">Moveu Achou</option>
    <option value="33">Castle</option>
    <option value="34">x1 Premiado</option>
    <option value="35">Time x Time</option>
    <option value="36">Quis x4</option>
    <option value="37">Eventos Diversos</option>
    </optgroup>
    </select></td>
    <td width="122"><input type="button" value="Gerar Ranking" onclick="CTM_Load('?pag=ranking&cmd=true','Ranking_Result','POST',BuscaElementosForm('Gerate_Ranking'));"></td>
  </tr>
</table>
</form>
    </blockquote>
     <h4>Buscar</h2>
    <blockquote>
    <form name="Buscar" id="Buscar">
<table width="95%" border="0" align="center">
  <tbody><tr>
    <td><div align="right"><strong><label>Nome:</label></strong></div></td>
    <td>
      <div align="left">
        <input type="text" name="char" value="" maxlength="10" onkeypress="return espaco(event);">
      </div></td>
      <td><div align="right"><strong><label>Tipo:</label></strong></div></td>
    <td><div align="left">
      <select name="type" id="type"> 
        <option value="17" selected="selected">Personagem</option>
        <option value="18">Guild</option>
      </select>
    </div></td>
    <td><div align="left">
      <input type="button" value="Buscar" onclick="CTM_Load('?pag=ranking&gerar=true','Ranking_Result','POST',BuscaElementosForm('Buscar'));">
    </div></td>
  </tr>
</tbody></table>
</form>
	</blockquote>
<br>
	<div id="Ranking_Result"></div>
</div>