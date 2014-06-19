<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="Description" content="Effect Web">
<meta name="Keywords" content="MuOnline, Private Servers, Mu, MuWhite, Mu White, MuServer, MuGlobal, MuChina, MuKorea, Mu Servers, Top Servers, Mu Online, Itens, Shop, MuShop, MuOnline Shop, Tech, New">
<meta name="Distribution" content="Global">
<meta name="Author" content="Technology Template: LucasHP, EffectWeb: Erick-Master">
<meta name="Robots" content="index, follow">
<title>{%TITLE_WEB%}</title>
<style type="text/css">
	@import url("templates/{Template_Dir}/media/styles/technology.css"); /* Menu Style */
	@import url("modules/header/css/sexyalertbox.css"); /* SexyAlert Style */
	@import url("modules/header/css/sexy-tooltips.css"); /* Sexy Tooltips Style */
	@import url("modules/header/css/jquery.lightbox.css"); /* jQuery Lightbox Evolution Style */
	@import url("modules/header/css/SpryTabbedPanels.css"); /* Spry Tabbed Panels */
</style>
<script type="text/javascript" src="templates/{Template_Dir}/media/scripts/jquery.js"></script>
<script type="text/javascript" src="templates/{Template_Dir}/media/scripts/coin-slider.min.js"></script>
<script type="text/javascript" src="templates/{Template_Dir}/media/scripts/aba.js"></script>
<script type="text/javascript" src="templates/{Template_Dir}/media/scripts/ddsmoothmenu.js"></script>
<script type="text/javascript" src="templates/{Template_Dir}/media/scripts/menu.js"></script>
<script type="text/javascript" src="modules/header/javascripts/ajax.js"></script>
<script type="text/javascript" src="modules/header/javascripts/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="modules/header/javascripts/sexyalertbox.v1.2.jquery.js"></script>
<script type="text/javascript" src="modules/header/javascripts/sexy-tooltips.v1.1.jquery.js"></script>
<script type="text/javascript" src="modules/header/javascripts/jquery.lightbox.js"></script>
<script type="text/javascript" src="modules/header/javascripts/SpryTabbedPanels.js"></script>
<script type="text/javascript" src="modules/header/javascripts/functions.js"></script>
<script type="text/javascript">
function Credits(){
	Sexy.info("<span class=\"h1\">Effect Web {Web_Version}</span><br /><br />Desenvolvido Por: <b>Erick-Master</b><br /> Corre&ccedil;&otilde;es Por: <b>Andrews Cogo</b>");
}
function Corre(){
	Sexy.info("<span class=\"h1\">Effect Web</span><br /> Todas corre&Atilde;§&Atilde;µes feitas por: <b>Andrews Cogo!</b>");
}
function CreditsTpl(){
	Sexy.info("<span class=\"h1\">Technology Premium Template</span><br />Desenvolvido Por: <b>LucasHP</b><br /><br /><a target=\"_black\" href=\"http://www.lhpdesigner.com.br\">www.lhpdesigner.com.br</a>");
}
function Record_Gen(){
	Sexy.info("No dia <b>{Record_Gen#Date}</b> as <b>{Record_Gen#Time}</b>.<br />Nosso Record teve o total de <b class=\"colr\">{Record_Gen#Players}</b> Player(s) Online");
}
function Record_Day(){
	Sexy.info("Hoje (<b>{Record_Day#Date}</b>) as <b>{Record_Day#Time}</b>.<br />Nosso Record teve o total de <b class=\"colr\">{Record_Day#Players}</b> Player(s) Online");
}
function SorteioOnline(){
        Sexy.info("SORTEIO DE 10 CASHS A CADA 2 HORAS!<br /> O SORTEADO DO MOMENTO FOI: <b>{SexyInfo}</b><br /> BASTA FICAR ONLINE PARA CONCORRER!!");
}
</script>
</head>
<body>
<div id="all">
<div id="banner">
			<table align="center"><tr>
                            <?php
			global $CTM_MSSQL;
			$query = $CTM_MSSQL->query("SELECT TOP 1 Name,ReidoWhite,CTM_Image FROM ".MuGen_DB.".dbo.Character WHERE CtlCode < 10 ORDER BY ReidoWhite DESC");
			$cont = NULL;
			while($topresets = mssql_fetch_array($query)){
			$cont++;
				if($topresets[2] == NULL OR empty($topresets[2]) OR !file_exists(Upload_Img."".$topresets[2]."")){
					$photo = Upload_Img."nophoto.gif";
				}else{
					$photo = Upload_Img."".$topresets[2]."";
				}
				echo '<td align="center">
					<p style="margin:91px 0 0 636px;">
					<a href="javascript: void(EffectWeb);" onclick="CTM_Load(\'?pag=search&amp;char='.$topresets[0].'\', \'conteudo\',\'GET\');" class="teste">
					<img src="'.$photo.'" width="116" height="125" alt="'.$topresets[0].'">
					<p style="margin:10px 0 0 632px;">
					<font size="+2" face="Times New Roman, Times, serif">'.$topresets[0].'</font>
					</a>
				</td>';
				}
			?></tr></table></div>
	<div id="menu">
        <div id="smoothmenu" class="ddsmoothmenu">
        	<ul>
                <li><a href="javascript: void(EffectWeb);" onclick="CTM_Load('?pag=home','conteudo','GET'); AutoLoad();">Home</a></li>
                <li><a href="javascript: void(EffectWeb);" onclick="CTM_Load('?pag=info','conteudo','GET');">Informa&ccedil;&otilde;es</a>
                    <ul>
              	   		<li><a href="javascript: void(EffectWeb);" onclick="CTM_Load('?pag=terms','conteudo','GET');">Regras / Termos</a></li>
                   	</ul>
                <li><a href="javascript: void(EffectWeb);" onclick="CTM_Load('?pag=equipe','conteudo','GET');">Equipe</a></li>
				</li>
				<li><a href="javascript: void(EffectWeb);" onclick="CTM_Load('?pag=terms&register=true','conteudo','GET');">Cadastro</a></li>
				<li><a href="javascript: void(EffectWeb);" onclick="CTM_Load('?pag=downloads','conteudo','GET');">Downloads</a></li>
				<li><a href="javascript: void(EffectWeb);" onclick="CTM_Load('?pag=ranking','conteudo','GET');">Rankings</a>
				</li>
                <li><a href="#" onclick="CTM_Load('?pag=contact','conteudo','GET');">Contato</a>
					<ul>
						<li><a href="javascript: void(EffectWeb);" onclick="CTM_Load('?pag=contact&type=mail','conteudo','GET');">E-Mail</a></li>
						<li><a href="javascript: void(EffectWeb);" onclick="CTM_Load('?pag=contact&type=tickets','conteudo','GET');">Tickets</a></li>
						<li><a target="_black" href="http://forum.muwhite.net/">F&oacute;rum</a></li>
					</ul>
				</li>
				<li><a href="javascript: void(EffectWeb);" onclick="CTM_Load('?pag=vip-cash','conteudo','GET');">VIPs / GoldsWhite's</a></li>
                                <li><a href="#">Shop</a>
					<ul>
						<li><a target="_black" href="http://goldswhites.shop.muwhite.net/">Shop GoldsWhite's</a></li>
						<li><a target="_black" href="http://www.cashs.shop.muwhite.net/">Shop Cash's</a></li>
						<li><a target="_black" href="http://golds.shop.muwhite.net/">F&oacute;rum</a></li>
					</ul>
		<li><a target="_black" href="http://forum.muwhite.net/">F&oacute;rum</a></li>
        	</ul>
        </div>
	</div>
<div id="content">
	<div id="aside">
        <div class="box">
        <div class="header">Painel de Controle</div>
			<div id="Panel">{Div#Panel}</div>
        </div>
        <div class="box">
        <div class="header">Configura&ccedil;&otilde;es</div>
			<ul class="list">
                <li>&raquo; Nome: <span>{Server_Name}</span></li>
                <li>&raquo; Vers&atilde;o: <span>{@_Info#Version}</span></li>
                <li>&raquo; Experi&ecirc;ncia: <span>{@_Info#Xp}</span></li>
                <li>&raquo; Drop: <span>{@_Info#Drop}</span></li>
                <li>&raquo; Bug Bless: <span>{@_Info#BugBless}</span></li>
                <li>&raquo; Tipo de Reset: <span>{@_Info#ResetType}</span></li>
            </ul>
        </div>
        <div class="box">
        <div class="header">Informa&ccedil;&otilde;es</div>
			<ul class="list">
                <li>&raquo; Total de Contas: <span>{@_Info#Accounts}</span></li>
                <li>&raquo; Total de Personagens: <span>{@_Info#Characters}</span></li>
                <li>&raquo; Total de Guilds: <span>{@_Info#Guilds}</span></li>
                <li>&raquo; Contas {VIP_Name#1}: <span>{@_Info#VIP-1}</span></li>
                <li>&raquo; Contas {VIP_Name#2}: <span>{@_Info#VIP-2}</span></li>
                <?php if(VIP_Number >= 3) { ?>
                <li>&raquo; Contas {VIP_Name#3}: <span>{@_Info#VIP-3}</span></li>
                <?php } if(VIP_Number >= 4) { ?>
                <li>&raquo; Contas {VIP_Name#4}: <span>{@_Info#VIP-4}</span></li>
                <?php } if(VIP_Number == 5) { ?>
                <li>&raquo; Contas {VIP_Name#5}: <span>{@_Info#VIP-5}</span></li>
                <?php } ?>
                <li>&raquo; Contas Banidas: <a href="javascript: void(EffectWeb);" onclick="CTM_Load('?pag=banneds&type=accounts','conteudo','GET');"><span>{@_Info#Acc_Ban}</span></a></li>
                <li>&raquo; Personagens Banidos: <a href="javascript: void(EffectWeb);" onclick="CTM_Load('?pag=banneds&type=characters','conteudo','GET');"><span>{@_Info#Char_Ban}</span></a></li>
                <li>&raquo; Record Online: <a href="javascript: void(EffectWeb);" onclick="Record_Gen(); return false;"><b>{Record_Gen#Players}</b></a></li>
                <li>&raquo; Record Hoje: <a href="javascript: void(EffectWeb);" onclick="Record_Day(); return false;"><b>{Record_Day#Players}</b></a></li>
            </ul>
        </div>
        <div class="box">
            <div class="header">Servidores</div>
                <div id="ServerRefresh" style="display:none;"></div>
                <div id="Servers">{Server_List}</div>
        </div>
        <div class="box">
        <div class="header">Enquete</div>
			<div id="Web_Poll">{Web_Poll}</div>
        </div>
        <div class="box">
        <div class="header">Top Colaborador</div>
<table width="100%" align="center">
  <tbody>
      <tr>
    <td>
        <div align="center"><strong>{topName}</strong></div>
    </td>
    </tr>
  <tr>	
    <td>
      <div align="center">{topColaborador}</div>
    </td>
  </tr>
    <tr>
    <td><div align="center">Deposito: R$ <strong>{topValor}</strong></div>
      <div align="left"></div></td>
    </tr>
  <tr>
    <td><div align="center"><a href="javascript:void(0);" onclick="javascript:Sexy.info('REMIA&Ccedil;&Atilde;O DO M&Ecirc;S DE JUNHO:<br><br> 1&#186; Lugar: Set Titanium + Sword of Titanium<br>2&#186; Lugar: Sword of Titanium + Shield of Titanium <br><br>* A contagem dos dep&oacute;sitos come&ccedil;ou no dia 11/06/2014.<br> O ganhador ser&aacute; o que depositar mais dinheiro at&eacute; o dia 05/07/2014.<br><br> OBS: Pode depositar quantas vezes quiser, mas s&oacute; ir&aacute; ganhar aquele que no fim do m&ecirc;s tiver depositado mais dinheiro.');"><strong>Premia&ccedil;&atilde;o de Junho</strong></a></div></td>
    </tr>
  </tbody></table>
        </div>
        <div class="box">
        <div class="header">Sorteio Online</div>
<table width="100%" align="center">
  <tbody>
      <tr>
    <td>
        <div align="center"><strong>{sorteioName}</strong></div>
    </td>
    </tr>
  <tr>	
    <td>
      <div align="center">{sorteioOnline}</div>
    </td>
  </tr>
  <tr>
    <td><div align="center"><a href="javascript: void(EffectWeb)" onclick="SorteioOnline(); return false;"><strong>Saiba mais!</strong></a></div></td>
    </tr>
  </tbody></table>
        </div>
        <div class="box">
			<ul id="social">
                <li id="facebook"><a href="<?php echo L_Facebook; ?>"><!-- Facebook Link --></a></li>
            </ul>
        </div>
    </div>
	<div id="section">
		<div id="conteudo">{%WEB_NAVIGATION%}</div>
	</div>
</div>
<div id="footer">
    <p>Copyright &copy; {Year} {Server_Name} - Todos os Direitos Reservados</p>
    <p>Effect Web {Web_Version}</p>
    <p>Desenvolvido por: <a href="javascript: void(EffectWeb)" onclick="Credits(); return false;">Erick-Master</a> | Corre&Atilde;§&Atilde;µes por: <a href="javascript: void(EffectWeb)" onclick="Corre(); return false;">Andrews Cogo</a> | Template by: <a href="javascript: void(EffectWeb)" onclick="CreditsTpl(); return false;">LucasHP</a></p>
</div>
</div>
</body>
</html>