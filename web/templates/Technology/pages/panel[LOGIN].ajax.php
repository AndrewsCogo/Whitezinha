<form name="frm-login" id="frm-login" method="post" action="">
	<input type="text" name="Log_Account" id="Log_Account" value="Usu&aacute;rio" onFocus="if(this.value=='Usu&aacute;rio')this.value=''" onBlur="if(this.value=='')this.value='Usu&aacute;rio'" onKeyUp="this.value = this.value.toLowerCase();">
	<input type="password" name="Log_Password" id="Log_Password" value="********" onFocus="if(this.value=='********')this.value=''" onBlur="if(this.value=='')this.value='********'">
	<input type="button" name="btnlogin" id="btnlogin" class="btnform" onClick="CTM_Load('?ajax=panel&cmd=login','Panel','POST',BuscaElementosForm('frm-login'));" value="Logar">
	<a href="javascript: void(EffectWeb);" onclick="CTM_Load('?pag=recovery','conteudo','GET');">Recuperar Senha</a>
</form>
<p style="margin:-8px 0;">{Message}</p>