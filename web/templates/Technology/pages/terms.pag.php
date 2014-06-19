<div class="box">
<div class="header">Termos / Regras do {Server_Name}</div>
	<blockquote>
	{Terms}
	<?php
	if($_GET["register"] == true){
	?>
	<br />
    <input type="button" value="Aceito" onclick="CTM_Load('?pag=register','conteudo','GET');" />
    <input type="button" value="N&atilde;o Aceito" onclick="javascript: window.location='http://www.pollypocket.com.br/';" />
	<? } ?>
	</blockquote>
</div>