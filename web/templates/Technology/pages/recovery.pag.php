<script type="text/javascript">
function Security_Captcha(div)
{
	document.getElementById(div).src = '{Captcha_Image}&' + Math.random();
}
Security_Captcha('captcha');
</script>
<div class="box">
<div class="header">Recuperar Senha</div>
<blockquote>
<form name="Recovery" id="Recovery">
<table width="500" border="0" align="center">
  <tr>
    <td width="213">Seu E-Mail:</td>
    <td width="191"><input type="text" name="Mail" id="Mail" /></td>
  </tr>
  <tr>
    <td>Codigo de Segurança:</td>
    <td><img src="{Captcha_Image}" style="border:none;" id="captcha" /> <a href="javascript: void(EffectWeb);" onclick="Security_Captcha('captcha');"><img src="images/icons/refresh.png" border="0" title="Atualizar Codigo de Seguran&ccedil;a" /></a></td>
  </tr>
  <tr>
    <td>Confirmar Codigo:</td>
    <td><input type="text" name="Captcha" id="Captcha" onKeyUp="this.value = this.value.toUpperCase();" maxlength="10" /><span id="CaptchaResult">&nbsp;</span></td>
  </tr>
</table>
<p class="colr right"><span class="padding">Deseja recuperar seus dados?</span>
<input type="button" value="Recuperar Dados" onclick="CTM_Load('?pag=recovery&cmd=true','Command','POST',BuscaElementosForm('Recovery'));" /></p>
	  </form>
	</blockquote>
	<div id="Command"></div>
</div>