<?php
$Page_Request = strtolower(basename($_SERVER['REQUEST_URI']));
$Page_File = strtolower(basename(__FILE__));
if ($Page_Request == $Page_File)
{
	die("<span style=\"border:1px dashed #c00; color:#c00; padding:6px; background-color:#ffebe8;\"><strong>MuWhite: N&atilde;o &eacute; permitido acessar o arquivo diretamente.</strong></span>");
}
class CTM_Search
{
        private static $_instance;

        public static function getInstance() {
            if(!isset($_instance)) {
                self::$_instance = new self();
            }
            return self::$_instance;
        }
	public function __construct()
	{
		global $CTM_Template;
		
		echo("<script src=\"modules/header/javascripts/functions.js\"></script>\n\r");

		if($_GET["char"]) { $Title = "Char [ ".$_GET["char"]." ]"; }
		if($_GET["guild"]) { $Title = "Guild [ ".$_GET["guild"]." ]"; }
		
		if($_GET["char"])
		{
			$Check = CTM_Mssql::getInstance()->NumQuery("SELECT * FROM ".MuGen_DB.".dbo.Character WHERE Name='".$_GET["char"]."'");
			if($Check < 1)
			{
				$Result = "<div class=\"error-box\"> Personagem n&atilde;o encontrada</div>";
			}
			else
			{
				$Result = $this->resultChar($_GET["char"]);
			}
		}
		if($_GET["guild"])
		{
			$Check = CTM_Mssql::getInstance()->NumQuery("SELECT * FROM ".MuGen_DB.".dbo.Guild WHERE G_Name='".$_GET["guild"]."'");
			if($Check < 1)
			{
				$Result = "<div class=\"error-box\"> Guild n&atilde;o encontrada</div>";
			}
			else
			{
				$Result = $this->resultGuild("Guild", array("G_Name", $_GET["guild"]));
			}
		}
		
		$CTM_Template->Set("Pag_Title", $Title);
		$CTM_Template->Set("Search_Result", $Result);
	}
	private function resultChar($Char)
	{
			if(ENABLE_INFO_CHAR == true)
			{
				$Check_Table = CTM_Mssql::getInstance()->NumQuery("SELECT * FROM MuOnline.dbo.CTM_WebProfile WHERE Character='{$Char}'");
				if($Check_Table < 1)
				{
					CTM_Mssql::getInstance()->Query("INSERT INTO MuOnline.dbo.CTM_WebProfile (Status,Character) VALUES (1,'{$Char}')");
				}
				$Check = CTM_Mssql::getInstance()->FetchQuery("SELECT Status FROM MuOnline.dbo.CTM_WebProfile WHERE Character='{$Char}'");
				if($Check[0] == 0)
				{
					$Return = "<div class=\"info-box\">Este Perfil se encontra desabilitado</div>";
				}
				else
				{
					$Query = CTM_Mssql::getInstance()->Query("SELECT * FROM MuOnline.dbo.Character WHERE Name='".$Char."'");
					$Load = CTM_Mssql::getInstance()->FetchArray($Query);
					$Server = CTM_Mssql::getInstance()->FetchQuery("SELECT ConnectStat,ServerName FROM ".MuAcc_DB.".dbo.MEMB_STAT WHERE memb___id='".$Load["AccountID"]."'");
					$Class = CTM_General::getInstance()->ClassName($Load["Class"]);
                                        $Map = CTM_General::getInstance()->Map($Load["MapNumber"]);
                                        $findAccount = CTM_Mssql::getInstance()->Query("SELECT vip as vip FROM MuOnline.dbo.MEMB_INFO WHERE memb___id='".$Load["AccountID"]."'");
                                        $findAccountQ = $this->FetchObject($findAccount);
					$Image = CTM_General::getInstance()->Image($Load["Name"]);
					$Request = CTM_Mssql::getInstance()->Query("SELECT G_Name FROM MuOnline.dbo.GuildMember WHERE Name='".$Load["Name"]."'");
					$Send = $this->Fetch($Request);
					$Logo = CTM_Mssql::getInstance()->FetchQuery("SELECT G_Mark FROM MuOnline.dbo.Guild WHERE G_Name='{$Send[0]}'");
					$Guild = $this->NumRow($Request) > 0 ? "<a href=\"javascript: void(EffectWeb)\" onclick=\"CTM_Load('?pag=search&guild=".urlencode($Send[0])."','conteudo','GET');\">".$Send[0]."</a>" : "Nenhuma";
					switch($Server[0])
					{
						case 0 : $Status = "<span style=\"color: red;\">Offline</span>"; break;
						case 1 : $Status = "<span style=\"color: green;\">Online</span>"; break;
					}
					switch($findAccountQ->vip)
					{
						case 0 : $Account = "<span style=\"color: red;\">Free</span>"; break;
						case 1 : $Account = "<span style=\"color: green;\">Vip Silver</span>"; break;
                                                case 2 : $Account = "<span style=\"color: Yellow;\">Vip Gold</span>"; break;
					}
                                        switch($Load["CtlCode"])
					{
						case 0 : $Staff = "<span style=\"color: green;\">Player</span>"; break;
						case 1 : $Staff = "<span style=\"color: red;\">Banido</span>"; break;
                                                case 8 : $Staff = "<span style=\"color: blue;\">STAFF</span>"; break;
					}
                                        switch($Load["PkCount"])
					{
                                                case -1 : $Pk = "<span style=\"color: red;\">Hero Level 2</span>"; break;
                                                case -1 : $Pk = "<span style=\"color: red;\">Hero Level 1</span>"; break;
						case 0 : $Pk = "<span style=\"color: white;\">Normal</span>"; break;
						case 1 : $Pk = "<span style=\"color: green;\">Pk Level 1</span>"; break;
                                                case 2 : $Pk = "<span style=\"color: Yellow;\">Pk Level 2</span>"; break;
                                                case 2 : $Pk = "<span style=\"color: red;\">Pk Extremo</span>"; break;
					}
                                                        $minutes = $Load["HorasOnline"];
                                        $hours = floor($minutes / 60);
                                        $minutes -= $hours * 60;
                                        $timeON = (''.$hours.'h'.':'.$minutes.'min'); 

                                        if ($Load["HorasOnlineDay"] > 1440)
                                         { $Load["HorasOnlineDay"] = '1439'; }
                                        $minutes = $Load["HorasOnlineDay"];
                                        $hours = floor($minutes / 60);
                                        $minutes -= $hours * 60;
                                        $timeON2 = (''.$hours.'h'.':'.$minutes.'min'); 

                                        $minutes = $Load["HorasOnlineWeek"];
                                        $hours = floor($minutes / 60);
                                        $minutes -= $hours * 60;
                                        $timeON3 = (''.$hours.'h'.':'.$minutes.'min'); 
					$Return .= "<table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">
                                          <tbody><tr>
                                            <td width=\"11%\" valign=\"top\">
                                            <table width=\"100%\" border=\"0\">
                                              <tbody><tr>
                                                <td bgcolor=\"#111111\">
                                                <img src=\"{$Image}\" height=\"125\" border=\"0\"></td>
                                              </tr>
                                            </tbody>
                                            </table>
                                            </td>
                                            <td width=\"89%\" valign=\"top\">
                                            <table width=\"100%\" border=\"0\" cellpadding=\"2\" cellspacing=\"2\" style=\"border-width: 1px; border-style: solid; border-color: #333333;\">
                                              <tbody>
                                              <tr>
                                                <td bgcolor=\"#111111\">Tipo de conta:</td>
                                                <td bgcolor=\"#111111\"><span class=\"colr\">{$Account}</span></td>
                                                <td width=\"32%\" bgcolor=\"#111111\">Master resets:</td>
                                                <td width=\"20%\" bgcolor=\"#111111\"><span class=\"colr\">{$Load["MResets"]}</span></td>
                                              </tr>
                                              <tr>
                                                <td bgcolor=\"#111111\">Nome:</td>
                                                <td bgcolor=\"#111111\"><span class=\"colr\">{$Load["Name"]}</span></td>
                                                <td width=\"32%\" bgcolor=\"#111111\">Master resets di&aacute;rio:</td>
                                                <td width=\"20%\" bgcolor=\"#111111\"><span class=\"colr\">{$Load["MResetsDay"]}</span></td>
                                              </tr>
                                              <tr>
                                                <td bgcolor=\"#111111\">Classe:</td>
                                                <td bgcolor=\"#111111\"><span class=\"colr\">{$Class}</span></td>
                                                <td width=\"32%\" bgcolor=\"#111111\">Master resets semanal:</td>
                                                <td width=\"20%\" bgcolor=\"#111111\"><span class=\"colr\">{$Load["MResetsWeek"]}</span></td>
                                              </tr>
                                              <tr>
                                                <td bgcolor=\"#111111\">Level:</td>
                                                <td bgcolor=\"#111111\"><span class=\"colr\">{$Load["cLevel"]}</span></td>
                                                <td width=\"32%\" bgcolor=\"#111111\">Resets:</td>
                                                <td width=\"20%\" bgcolor=\"#111111\"><span class=\"colr\">{$Load["Resets"]}</span></td>
                                              </tr>
                                              <tr>
                                                <td bgcolor=\"#111111\"></td>
                                                <td bgcolor=\"#111111\"></td>
                                                <td width=\"32%\" bgcolor=\"#111111\">Resets di&aacute;rio:</td>
                                                <td width=\"20%\" bgcolor=\"#111111\"><span class=\"colr\">{$Load["ResetsDay"]}</span></td>
                                              </tr>
                                              <tr>
                                                <td bgcolor=\"#111111\">Pontos &agrave; Distribuir:</td>
                                                <td bgcolor=\"#111111\"><span class=\"colr\">{$Load["LevelUpPoint"]}</span></td>
                                                <td width=\"32%\" bgcolor=\"#111111\">Resets Semanal:</td>
                                                <td width=\"20%\" bgcolor=\"#111111\"><span class=\"colr\">{$Load["ResetsWeek"]}</span></td>
                                              </tr>
                                              <tr>
                                                <td bgcolor=\"#111111\">For&ccedil;a:</td>
                                                <td bgcolor=\"#111111\"><span class=\"colr\">{$Load["Strength"]}</span></td>
                                                <td width=\"32%\" bgcolor=\"#111111\">Pk Total:</td>
                                                <td width=\"20%\" bgcolor=\"#111111\"><span class=\"colr\">{$Load["PkCountTotal"]}</span></td>
                                              </tr>
                                              <tr>
                                                <td bgcolor=\"#111111\">Agilidade:</td>
                                                <td bgcolor=\"#111111\"><span class=\"colr\">{$Load["Dexterity"]}</span></td>
                                                <td width=\"32%\" bgcolor=\"#111111\">Pk di&aacute;rio:</td>
                                                <td width=\"20%\" bgcolor=\"#111111\"><span class=\"colr\">{$Load["PKCountDay"]}</span></td>
                                              </tr>
                                              <tr>
                                                <td bgcolor=\"#111111\">Vitalidade:</td>
                                                <td bgcolor=\"#111111\"><span class=\"colr\">{$Load["Vitality"]}</span></td>
                                                <td width=\"32%\" bgcolor=\"#111111\">Pk Semanal:</td>
                                                <td width=\"20%\" bgcolor=\"#111111\"><span class=\"colr\">{$Load["PKCountWeek"]}</span></td>
                                              </tr>
                                              <tr>
                                                <td bgcolor=\"#111111\">Energia:</td>
                                                <td bgcolor=\"#111111\"><span class=\"colr\">{$Load["Energy"]}</span></td>
                                                <td width=\"32%\" bgcolor=\"#111111\">Her&oacute;i Total:</td>
                                                <td width=\"20%\" bgcolor=\"#111111\"><span class=\"colr\">{$Load["HeroCount"]}</span></td>
                                              </tr>
                                              <tr>
                                                <td bgcolor=\"#111111\">Modo:</td>
                                                <td bgcolor=\"#111111\"><span class=\"colr\">{$Pk}</span></td>
                                                <td width=\"32%\" bgcolor=\"#111111\">Her&oacute;i di&aacute;rio:</td>
                                                <td width=\"20%\" bgcolor=\"#111111\"><span class=\"colr\">{$Load["HeroCountDay"]}</span></td>
                                              </tr>
                                              <tr>
                                                <td bgcolor=\"#111111\">Condi&ccedil;&atilde;o:</td>
                                                <td bgcolor=\"#111111\"><span class=\"colr\">{$Staff}</span></td>
                                                <td width=\"32%\" bgcolor=\"#111111\">Her&oacute;i Semanal:</td>
                                                <td width=\"20%\" bgcolor=\"#111111\"><span class=\"colr\">{$Load["HeroCountWeek"]}</span></td>
                                              </tr>
                                              <tr>
                                                <td bgcolor=\"#111111\">Mapa:</td>
                                                <td bgcolor=\"#111111\"><span style=\"color: blue;\">{$Map}</span></td>
                                                <td width=\"32%\" bgcolor=\"#111111\">Horas Total:</td>
                                                <td width=\"20%\" bgcolor=\"#111111\"><span class=\"colr\">{$timeON}</span></td>
                                              </tr>
                                              <tr>
                                                <td bgcolor=\"#111111\">Guild:</td>
                                                <td bgcolor=\"#111111\"><span class=\"colr\">{$Guild}</span></td>
                                                <td width=\"32%\" bgcolor=\"#111111\">Horas di&aacute;rio:</td>
                                                <td width=\"20%\" bgcolor=\"#111111\"><span class=\"colr\">{$timeON2}</span></td>
                                              </tr>
                                              <tr>
                                                <td bgcolor=\"#111111\">Status:</td>
                                                <td bgcolor=\"#111111\"><span class=\"colr\">{$Status}</span></td>
                                                <td width=\"32%\" bgcolor=\"#111111\">Horas Semanal:</td>
                                                <td width=\"20%\" bgcolor=\"#111111\"><span class=\"colr\">{$timeON3}</span></td>
                                              </tr>
                                            </tbody></table></td>
                                          </tr>
                                        </tbody></table>";
				}
			}
			else
			{
				$Return = "<div class=\"info-box\"> Exibi&ccedil;&atilde;o de perfil desabilitada.</div>";
			}
		return $Return;
	}
        private function resultGuild($Table, $Column)
        {
			if(ENABLE_INFO_GUILD == true)
			{
				$Query = CTM_Mssql::getInstance()->Query("SELECT * FROM ".MuGen_DB.".dbo.{$Table} WHERE {$Column[0]}='".$Column[1]."'");
				$Load = CTM_Mssql::getInstance()->FetchArray($Query);
				$Request = CTM_Mssql::getInstance()->Query("SELECT Name,G_Level FROM ".MuGen_DB.".dbo.GuildMember WHERE G_Name='".$Column[1]."'");
				$Count = CTM_Mssql::getInstance()->FetchQuery("SELECT count(*) FROM ".MuGen_DB.".dbo.GuildMember WHERE G_Name='".$Column[1]."'");
				$Send = base64_encode($Load["G_Notice"]);
				$Notice = base64_decode($Send);
				$Image = "?public=logoGuild&code=".urlencode(bin2hex($Load["G_Mark"]));
				$Return .= "<table width=\"543\" border=\"0\">
							<tr>
							 <td width=\"144\"><div id=\"ctmt\"><img src=\"".$Image."\" width=\"120\" height=\"120\" style=\"border: 1px solid #B3B3B3;\" class=\"image\" /></div></td>
							 <td width=\"389\"><table width=\"386\" border=\"0\" id=\"ctmt\">
								 <tr>
								 <td width=\"181\">Nome:</td>
									<td width=\"195\"><span class=\"colr\">".$Load["G_Name"]."</span></td>
								 </tr>
								 <tr>
									<td>Guild Master:</td>
									<td><span class=\"colr\">".$Load["G_Master"]."</span></td>
								 </tr>
								 <tr>
								 <td>Scores:</td>
								 <td><span class=\"colr\">".$Load["G_Score"]."</span></td>
								 </tr>
								<tr>
									<td>Not&iacute;cias:</td>
									<td><span class=\"colr\">[ <a class=\"colr\" href=\"javascript: void(EffectWeb);\" rel=\"tooltip\" title=\"Not&iacute;cia: <b><span class='colr'>".$Notice."</span></b>\">Ver Not&iacute;cia</a> ]</span></td>
								 </tr>
								<tr>
								 <td>Total de Membros:</td>
								 <td><span class=\"colr\">".$Count[0]."</span></td>
								</tr>
							 </table></td>
							</tr>
							</table><br />
							<table width=\"474\" border=\"0\" id=\"ctmt\">
							  <tr>
							 <td><strong>Char:</strong></td>
							  <td><strong>Classe:</strong></td>
							 <td><strong>Level:</strong></td>
								<td><strong>Resets:</strong></td>
								<td><strong>Status:</strong></td>
							 </tr>";
							 for($WzAG = 0; $WzAG < $this->NumRow($Request); $WzAG++)
							 {
								 $Send_Char = $this->Fetch($Request);
								 $Member = CTM_Mssql::getInstance()->FetchQuery("SELECT Name,Class,cLevel,".Column_Reset.",AccountID FROM ".MuGen_DB.".dbo.Character WHERE Name='{$Send_Char[0]}'");
								 $Send_Status = CTM_Mssql::getInstance()->FetchQuery("SELECT ConnectStat FROM ".MuAcc_DB.".dbo.MEMB_STAT WHERE memb___id='{$Member[4]}'");
								 $Class = CTM_General::getInstance()->ClassName($Member[1]);
								 if($Send_Char[1] == 128) { $Guild = array("gold.gif", "Guild Master"); }
								 if($Send_Char[1] == 64) { $Guild = array("silver.gif", "Assistant"); }
								 if($Send_Char[1] == 32) { $Guild = array("bronze.gif", "Batte Master"); }
								 $G_Status = $Send_Char[1] == true ? "<img src=\"images/icons/".$Guild[0]."\" valign=\"middle\" title=\"".$Guild[1]."\">" : NULL;
								 switch($Send_Status[0])
								 {
									 case 0 : $Status = "<span style=\"color: red;\">Offline</span>"; break;
									 case 1 : $Status = "<span style=\"color: green\">Online</span>"; break;
								 }
								 $Return .= "
									<tr>
									 <td class=\"colr\"><a href=\"javascript: void(EffectWeb);\" onclick=\"CTM_Load('?pag=search&char=".urlencode($Member[0])."','conteudo','GET');\">".$Member[0]."</a> ".$G_Status."</td>
									 <td class=\"colr\">".$Class."</td>
									 <td class=\"colr\">".$Member[2]."</td>
									 <td class=\"colr\">".$Member[3]."</td>
									 <td class=\"colr\">".$Status."</td>
									</tr>";
							 }
				$Return .= "</table>";
			}
			else
			{
				$Return = "<div class=\"info-box\"> Exibi&ccedil;&atilde;o de perfil desabilitada.</div>";
			}
		return $Return;
        }
}