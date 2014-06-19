<div class="box">
<div class="header">Alterar Classe</div>
	   <blockquote>
	  <p>Sua classe atual &eacute; <b>{Character_Class}</b>.</p>
	  <p class="colr">Selecione a Classe que deseja alterar:</p>
	  <form name="New_Class" id="New_Class">
	  <select name="Class" id="Class">
	  {Class_Select}
	  </select><br /><br />
	  <input type="button" value="Alterar Classe" onclick="CTM_Load('?pag=paneluser&str=CHANGE_CLASS&cmd=true','Command','POST',BuscaElementosForm('New_Class'));" />
	  </form>
	</blockquote>
	<div id="Command"></div>
</div>