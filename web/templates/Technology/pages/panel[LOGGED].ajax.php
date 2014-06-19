<ul class="list">
	<li>&raquo; Bem Vindo: <span>{Memb_Name}</span></li>
	<li>&raquo; Tipo de Conta: <span>{Memb_Type}</span></li>
	<li>&raquo; {Coin_1}: <span>{Memb_Amount[1]}</span></li>
    <?php if(Coin_Number >= 2) { ?>
    <li>&raquo; {Coin_2}: <span>{Memb_Amount[2]}</span></li>
    <?php } if(Coin_Number == 3) { ?>
    <li>&raquo; {Coin_3}: <span>{Memb_Amount[3]}</span></li>
    <?php } ?>
    <li><a href="javascript: void(EffectWeb);" onclick="CTM_Load('?pag=paneluser','conteudo','GET');">&raquo; Painel de Controle</a></li>
    {PanelAdmin_Link}
    <li><a href="?exec=logout">&raquo; Deslogar</a></li>
</ul>