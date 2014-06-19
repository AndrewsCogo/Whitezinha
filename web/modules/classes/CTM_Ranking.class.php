<?php
$Page_Request = strtolower(basename($_SERVER['REQUEST_URI']));
$Page_File = strtolower(basename(__FILE__));
if ($Page_Request == $Page_File)
{
	die("<span style=\"border:1px dashed #c00; color:#c00; padding:6px; background-color:#ffebe8;\"><strong>MuWhite: N&atilde;o &eacute; permitido acessar o arquivo diretamente.</strong></span>");
}
class CTM_Ranking
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
		$CTM_Ranking = null;
		
		if(isset($_GET["cmd"]) == TRUE)
		{
			$Top = (int) $_POST["Top"];
			$Classe = (int) $_POST["Classe"];
                        $Ranking = (int) $_POST["Ranking"];
			if(empty($Top)){die("<div class=\"warning-box\">Selecione um Top Ranking</div>");}
			elseif(empty($Ranking)){die("<div class=\"warning-box\">Selecione um Ranking</div>");}
                        if($Top > 200 or $Top < 1) {
                                die("<div class=\"warning-box\">A quantidade especificada est&aacute; acima do permitido!");
                        }
			else{
				switch($Ranking)
				{
                                        case '16' :
                                        $Return = $this->getRankingGuild($Top);
                                        break;
                                        case '15' :
                                        $Return = $this->getRankingsHoras($Ranking, $Classe, $Top);
                                        break;
                                        case '14' :
                                        $Return = $this->getRankingsHoras($Ranking, $Classe, $Top);
                                        break;
                                        case '13' :
                                        $Return = $this->getRankingsHoras($Ranking, $Classe, $Top);
                                        break;
					default :
					$Return = $this->getRanking($Ranking, $Classe, $Top);
					break;
				}
				$CTM_Ranking .= "<div align=\"center\">";
				$CTM_Ranking .= $Return;
                                $CTM_Ranking .= "</div>";
				die($CTM_Ranking);
			}
		}
                if(isset($_GET["gerar"]) == TRUE)
                {
                    $nome = $_POST["char"];
                    $selecionar = $_POST["type"];
                    
                    if(empty($nome)){die("<div class=\"warning-box\">Escreva um Nome</div>");}
                    if(empty($selecionar)){die("<div class=\"warning-box\">Selecione o Tipo de Busca!</div>");}
                    
                    switch($selecionar)
                    {
                    case '17' :
                    $Return = $this->generateCharGuild(1, $nome);
                    break;
                    case '18' :
                    $Return = $this->generateCharGuild(2, $nome);
                    break;
                    }
                    $CTM_Ranking .= "<div align=\"center\">";
                    $CTM_Ranking .= $Return;
                    $CTM_Ranking .= "</div>";
                    die($CTM_Ranking);
                }
	}
   private function getRanking($Ranking, $Classe, $Top) {
            if(empty($Classe)){
                die("<div class=\"warning-box\">Selecione uma Classe</div>");
            }
            switch($Classe) {
                    case '1' : $where = "WHERE CtlCode < 8"; break;
                    case '2' : $where = "WHERE Class = 0  and CtlCode < 8"; break;
                    case '3' : $where = "WHERE Class = 1  and CtlCode < 8"; break;
                    case '4' : $where = "WHERE Class = 16  and CtlCode < 8"; break;
                    case '5' : $where = "WHERE Class = 17  and CtlCode < 8"; break;
                    case '6' : $where = "WHERE Class = 32  and CtlCode < 8"; break;
                    case '7' : $where = "WHERE Class = 33  and CtlCode < 8"; break;
                    case '8' : $where = "WHERE Class = 48  and CtlCode < 8"; break;
                    default : $where = null; break;
            }
            switch($Ranking) {
                case '1' : 
                        $ranking = 'TOP '.$Top.' RANKING RESETS DI&Aacute;RIO';
                        $Table = 'ResetsDay';
                        $orderby = 'desc';
                        break;
                case '2' : 
                        $ranking = 'TOP '.$Top.' RANKING RESETS SEMANAL';
                        $Table = 'resetsWeek';
                        $orderby = 'desc';
                    break;
                case '3' : 
                        $ranking = 'TOP '.$Top.' RANKING RESETS TOTAL';
                        $Table = 'resets';
                        $orderby = 'desc';
                    break;
                case '4' : 
                        $ranking = 'TOP '.$Top.' RANKING M.RESETS DI&Aacute;RIO';
                        $Table = 'MResetsDay';
                        $orderby = 'desc';
                    break;
                case '5' : 
                        $ranking = 'TOP '.$Top.' RANKING M.RESETS SEMANAL';
                        $Table = 'MResetsWeek';
                        $orderby = 'desc';
                    break;
                case '6' : 
                        $ranking = 'TOP '.$Top.' RANKING M.RESETS TOTAL';
                        $Table = 'MResets';
                        $orderby = 'desc';
                    break;
                case '7' : 
                        $ranking = 'TOP '.$Top.' RANKING PKS DI&Aacute;RIO';
                        $Table = 'PKCountDay';
                        $orderby = 'desc';
                    break;
                case '8' : 
                        $ranking = 'TOP '.$Top.' RANKING PKS SEMANAL';
                        $Table = 'PKCountWeek';
                        $orderby = 'desc';
                    break;
                case '9' : 
                        $ranking = 'TOP '.$Top.' RANKING PKS TOTAL';
                        $Table = 'PkCountTotal';
                        $orderby = 'desc';
                    break;
                case '10' : 
                        $ranking = 'TOP '.$Top.' RANKING HER&Oacute;I DI&Aacute;RIO';
                        $Table = 'HeroCountDay';
                        $orderby = 'asc';
                    break;
                case '11' : 
                        $ranking = 'TOP '.$Top.' RANKING HER&Oacute;I SEMANAL';
                        $Table = 'HeroCountWeek';
                        $orderby = 'asc';
                    break;
                case '12' : 
                        $ranking = 'TOP '.$Top.' RANKING HER&Oacute;I TOTAL';
                        $Table = 'HeroCount';
                        $orderby = 'asc';
                    break;
                case '19' : 
                        $ranking = 'TOP '.$Top.' EVENTO - REI DO WHITE';
                        $Table = 'ReiDoWhite';
                        $orderby = 'desc';
                    break;
                case '20' : 
                        $ranking = 'TOP '.$Top.' EVENTO - MATA-MATA';
                        $Table = 'matamata';
                        $orderby = 'desc';
                    break;
                case '21' : 
                        $ranking = 'TOP '.$Top.' EVENTO - PEGA-PEGA';
                        $Table = 'pegapega';
                        $orderby = 'desc';
                    break;
                case '22' : 
                        $ranking = 'TOP '.$Top.' EVENTO - BBB WHITE';
                        $Table = 'bbbwhite';
                        $orderby = 'desc';
                    break;
                case '23' : 
                        $ranking = 'TOP '.$Top.' EVENTO - MATA-PATO';
                        $Table = 'matapato';
                        $orderby = 'desc';
                    break;
                case '24' : 
                        $ranking = 'TOP '.$Top.' EVENTO - QUIS';
                        $Table = 'quis';
                        $orderby = 'desc';
                    break;
                case '25' : 
                        $ranking = 'TOP '.$Top.' EVENTO - THE-FLASH';
                        $Table = 'theflash';
                        $orderby = 'desc';
                    break;
                case '26' : 
                        $ranking = 'TOP '.$Top.' EVENTO - TRADE WINS';
                        $Table = 'tradewins';
                        $orderby = 'desc';
                    break;
                case '27' : 
                        $ranking = 'TOP '.$Top.' EVENTO - ESCONDE-ESCONDE';
                        $Table = 'escondeesconde';
                        $orderby = 'desc';
                    break;
                case '28' : 
                        $ranking = 'TOP '.$Top.' EVENTO - PEGA MD/GM';
                        $Table = 'pegamd';
                        $orderby = 'desc';
                    break;
                case '29' : 
                        $ranking = 'TOP '.$Top.' EVENTO - SOBREVIVENCIA';
                        $Table = 'sobrevivencia';
                        $orderby = 'desc';
                    break;
                case '30' : 
                        $ranking = 'TOP '.$Top.' EVENTO - O CORAJOSO';
                        $Table = 'ocorajoso';
                        $orderby = 'desc';
                    break;
                case '31' : 
                        $ranking = 'TOP '.$Top.' EVENTO - CA&Ccedil;A AO TESOURO';
                        $Table = 'cacatesouro';
                        $orderby = 'desc';
                    break;
                case '32' : 
                        $ranking = 'TOP '.$Top.' EVENTO - MOVEU ACHOU';
                        $Table = 'moveuachou';
                        $orderby = 'desc';
                    break;
                case '33' : 
                        $ranking = 'TOP '.$Top.' EVENTO - CASTLE';
                        $Table = 'castle';
                        $orderby = 'desc';
                    break;
                case '34' : 
                        $ranking = 'TOP '.$Top.' EVENTO - X1 PREMIADO';
                        $Table = 'x1remiado';
                        $orderby = 'desc';
                    break;
                case '35' : 
                        $ranking = 'TOP '.$Top.' EVENTO - TIME X TIME';
                        $Table = 'timextime';
                        $orderby = 'desc';
                    break;
                case '36' : 
                        $ranking = 'TOP '.$Top.' EVENTO - QUIS X4';
                        $Table = 'quisx4';
                        $orderby = 'desc';
                    break;
                case '37' : 
                        $ranking = 'TOP '.$Top.' EVENTO - EVENTOS DIVERSOS';
                        $Table = 'diversos';
                        $orderby = 'desc';
                    break;
                default :
                        $ranking = 'TOP '.$Top.' RANKING RESETS TOTAL';
                        $Table = 'resets';
                        $orderby = 'desc';
                    break;
            }
            $query = CTM_MSSQL::getInstance()->Query('SELECT top '.$Top.' name as charName, '.$Table.' as charRanking 
            FROM MuOnline.[dbo].[Character] '.$where.' order by '.$Table.' '.$orderby.', cLevel desc');
            $count = CTM_MSSQL::getInstance()->NumRow($query);
            if($count < 1) {
                    $return = die('<div class="warning-box">Nenhum personagem foi encontrado!</div>');
                    return  $return;
            }
                        $Return .= "<b><center>{$ranking}</center></b><br />
                                       <table align='center' border='1' cellspacing='0' style='border:2px solid #101010; border-radius:8px; -moz-border-radius:8px; -webkit-border-radius:8px;'>
                                            <tr>
                                                <td>";
	
			$Rank = 1;
			while($Character = CTM_MSSQL::getInstance()->FetchObject($query))
			{
                                if($Character->charName == NULL OR empty($Character->charName) OR !file_exists(Upload_Img."".$Character->charName."")){
					$Image = Upload_Img."nophoto.gif";
				}else{
					$Image = Upload_Img."".$Character->charName."";
				}
				if($GS == 0)
				{
					$Return .= "<table border='1' cellspacing='0' align='center' style='border:2px solid #101010; border-radius:8px; -moz-border-radius:8px; -webkit-border-radius:8px;'>
							<tr align='center'>";
				}
					
				$Return .= "<td style='width: 115px;' align='center'>
                                    <table border='0' cellspacing='0'  width=\"100%\">
			<tr>
			<td style=\"width: 18px;\" align=\"center\">
                        <a href=\"javascript: void(EffectWeb);\" onclick=\"CTM_Load('?pag=search&char=".urlencode($Character->charName)."', 'conteudo','GET');\" style=\"color: #666666;\">
                                {$Rank}&deg; - <strong>{$Character->charName}</strong>({$Character->charRanking})<img src='".$Image."' width='120' height='120'/></a></td>
			</tr>
				<tr>	
				</tr>
				<tr>
				<td>&nbsp;</td>
				</tr>
			</table></td>";
				$GS++;
				if($GS > 4)
				{
					$Return .= "</tr>
					</table>";
					$GS = 0;
				}
				$Rank = $Rank + 1;
			}
			$Return .= "</tr>
							</table>
							</td>
						</tr>
					</table></blockquote>";
		return $Return;
    }
    private function getRankingGuild($Top)
    {
                $Query = CTM_MSSQL::getInstance()->Query("SELECT TOP {$Top} G_Name,G_Score,G_Mark FROM MuOnline.dbo.Guild ORDER BY G_Score DESC");
		$Check = CTM_MSSQL::getInstance()->NumRow($Query);
			
		if($Check < 1)
		{
			$Return = "<div class=\"warning-box\"> Este ranking n&atilde;o possui Resultados</div>";
		}
		else
		{
			$Return .= "<table width=\"100%\" border=\"0\" cellspacing=\"2\" cellpadding=\"2\" align=\"center\">
				<tr>
    				<td colspan=\"2\">";
	
			$Rank = 1;
			while($Guild = CTM_MSSQL::getInstance()->Fetch($Query))
			{
				$Image = "?public=logoGuild&code=".urlencode(bin2hex($Guild[2]));
				
				if($GS == 0)
				{
					$Return .= "<table border=\"0\" cellpadding=\"0\" cellpadding=\"2\" cellspacing=\"2\" align=\"center\">
							<tr>";
				}
				
				$Return .= "
						<td style=\"width: 110px;\" align=\"center\"><table border=\"0\" cellpadding=\"2\" cellspacing=\"2\" align=\"center\">
				<tr>
					<td style=\"width: 18px;\" align=\"center\"><a href=\"javascript: void(EffectWeb);\" onclick=\"CTM_Load('?pag=search&guild=".urlencode($Guild[0])."', 'conteudo','GET');\" style=\"color: #666666;\">".$Rank."&deg; - ".$Guild[0]." <img src=\"".$Image."\" width=\"120\" height=\"120\" style=\"border: 1px solid #B3B3B3;\" class=\"image\" /><br />(".$Guild[1]." Score)</a></td>
				</tr>
				<tr>	
				</tr>
				<tr>
					<td>&nbsp;</td>
				</tr>
			</table>";
				$GS++;
				if($GS > 4)
				{
					$Return .= "</tr>
					</table>";
					$GS = 0;
				}
				$Rank = $Rank + 1;
			}
			$Return .= "</tr>
						</table>
						</td>
					</tr>
				</table>";
		}
		return $Return;
    }
    private function getRankingsHoras($Ranking, $Classe, $Top)
    {
            if(empty($Classe)){
                die("<div class=\"warning-box\">Selecione uma Classe</div>");
            }
            switch($Classe) {
                    case '1' : $where = "WHERE CtlCode < 8"; break;
                    case '2' : $where = "WHERE Class = 0  and CtlCode < 8"; break;
                    case '3' : $where = "WHERE Class = 1  and CtlCode < 8"; break;
                    case '4' : $where = "WHERE Class = 16  and CtlCode < 8"; break;
                    case '5' : $where = "WHERE Class = 17  and CtlCode < 8"; break;
                    case '6' : $where = "WHERE Class = 32  and CtlCode < 8"; break;
                    case '7' : $where = "WHERE Class = 33  and CtlCode < 8"; break;
                    case '8' : $where = "WHERE Class = 48  and CtlCode < 8"; break;
                    default : $where = null; break;
            }
            switch($Ranking)
            {
                    case '13' : 
                            $ranking = 'TOP '.$Top.' RANKING HORAS DI&Aacute;RIA';
                            $Table = 'HorasOnlineDay';
                            $Tipo = 'charHorasDiarias';
                        break;
                    case '14' : 
                            $ranking = 'TOP '.$Top.' RANKING HORAS SEMANAL';
                            $Table = 'HorasOnlineWeek';
                            $Tipo = 'charHoras';
                        break;
                    case '15' : 
                            $ranking = 'TOP '.$Top.' RANKING HORAS TOTAL';
                            $Table = 'HorasOnline';
                            $Tipo = 'charHoras';
                        break;
            }
                    $query = CTM_MSSQL::getInstance()->Query('SELECT top '.$Top.' name as charName, '.$Table.' as '.$Tipo.', CTM_Image FROM MuOnline.[dbo].[Character] 
                    '.$where.' order by '.$Table.' desc, cLevel desc'); 
                    $count = CTM_MSSQL::getInstance()->NumRow($query);
                    if($count < 1) {
                    $return = die('<div class="warning-box">Nenhum personagem foi encontrado!</div>');
                    return  $return;
                    }
                    else
                        {
                        $Return .= "<b><center>{$ranking}</center></b><br />
                                       <table align='center' border='1' cellspacing='0' style='border:2px solid #101010; border-radius:8px; -moz-border-radius:8px; -webkit-border-radius:8px;'>
                                            <tr>
                                                <td>";
	
			$Rank = 1;
			while($Character = CTM_MSSQL::getInstance()->FetchObject($query))
			{
                        if($Character->charHorasDiarias > 1440)
                        { $Character->charHorasDiarias = '1439'; }
                        $minutes = $Character->$Tipo;
                        $hours = floor($minutes / 60);
                        $minutes -= $hours * 60;
                        $timeON = (''.$hours.'h'.':'.$minutes.'min');
                         if($Character->charName == NULL OR empty($Character->charName) OR !file_exists(Upload_Img."".$Character->charName."")){
			 $Image = Upload_Img."nophoto.gif";
                        }else{
                                $Image = Upload_Img."".$Character->charName."";
                        }
				
				if($GS == 0)
				{
					$Return .= "<table border='1' cellspacing='0' align='center' style='border:2px solid #101010; border-radius:8px; -moz-border-radius:8px; -webkit-border-radius:8px;'>
							<tr align='center'>";
				}
					
				$Return .= "<td style='width: 115px;' align='center'>
                                    <table border='0' cellspacing='0'  width=\"100%\">
			<tr>
			<td style=\"width: 18px;\" align=\"center\">
                        <a href=\"javascript: void(EffectWeb);\" onclick=\"CTM_Load('?pag=search&char=".urlencode($Character->charName)."', 'conteudo','GET');\" style=\"color: #666666;\">
                                {$Rank}&deg; - <strong>{$Character->charName}<br></strong>($timeON)<img src=\"".$Image."\" width=\"120\" height=\"120\" style=\"border: 1px solid #B3B3B3;\" class=\"image\" /></a></td>
			</tr>
				<tr>	
				</tr>
				<tr>
				<td>&nbsp;</td>
				</tr>
			</table></td>";
				$GS++;
				if($GS > 4)
				{
					$Return .= "</tr>
					</table>";
					$GS = 0;
				}
				$Rank = $Rank + 1;
			}
			$Return .= "</tr>
							</table>
							</td>
						</tr>
					</table></blockquote>";
                        }
		return $Return;
    }
    private function generateCharGuild($Type, $nome)
    {
		global $CTM_General;
		
		if($Type == 1)
		{
                    $Query = CTM_MSSQL::getInstance()->Query("SELECT * FROM MuOnline.dbo.Character WHERE Name='{$nome}'");
                    $Load = CTM_MSSQL::getInstance()->FetchArray($Query);
                    if(CTM_MSSQL::getInstance()->NumRow($Query) < 1)
                    {
                        die("<div class=\"warning-box\">Nenhum personagem encontrado!</div>");
                    }
                    if($Load["Name"] == NULL OR empty($Load["Name"]) OR !file_exists(Upload_Img."".$Load["Name"]."")){
                            $Image = Upload_Img."nophoto.gif";
                    }else{
                            $Image = Upload_Img."".$Load["Name"]."";
                    }
                    $Rank = 1;
                    $Return .= "<table class=\"staffborder\">  
                                    <tbody>
                                        <tr>      
                                            <td class=\"coluna1\">
                                            <strong>Busca de personagens</strong>
                                            </td>  
                                        </tr>
                                    </tbody>
                                </table>
                           <table class=\"staffborder\">
                                <tr>
                                <td style=\"width: 18px;\" align=\"center\" class=\"coluna2\">
                                <a href=\"javascript: void(EffectWeb);\" onclick=\"CTM_Load('?pag=search&char=".urlencode($Load["Name"])."', 'conteudo','GET');\" style=\"color: #666666;\">
                                {$Rank}&deg; - <strong>{$Load["Name"]}<br></strong>
                                <img src=\"".$Image."\" width=\"120\" height=\"120\" style=\"border: 1px solid #B3B3B3;\" class=\"image\" /></a></td>
                                </tr>
                                </table>";
		}
		if($Type == 2)
		{
                    $Query = CTM_MSSQL::getInstance()->Query("SELECT * FROM MuOnline.dbo.Guild WHERE G_Name='{$nome}'");
                    $Load = CTM_MSSQL::getInstance()->FetchArray($Query);
                    if(CTM_MSSQL::getInstance()->NumRow($Query) < 1)
                    {
                        die("<div class=\"warning-box\">Nenhuma Guild encontrada!</div>");
                    }
                    $Rank = 1;
                    $Image = "?public=logoGuild&code=".urlencode(bin2hex($Load["G_Mark"]));
                    $Return .= "<table class=\"staffborder\">  
                                    <tbody>
                                        <tr>      
                                            <td class=\"coluna1\">
                                            <strong>Busca de Guilds</strong>
                                            </td>  
                                        </tr>
                                    </tbody>
                                </table>
                        <table class=\"staffborder\">
                            <tr>
                                <td style=\"width: 18px;\" align=\"center\" class=\"coluna2\">
                                <a href=\"javascript: void(EffectWeb);\" onclick=\"CTM_Load('?pag=search&guild=".urlencode($Load["G_Name"])."', 'conteudo','GET');\" style=\"color: #666666;\">
                                {$Rank}&deg; - <strong>{$Load["G_Name"]}({$Load["G_Score"]})<br></strong>
                                <img src=\"".$Image."\" width=\"120\" height=\"120\" style=\"border: 1px solid #B3B3B3;\" class=\"image\" /></div>
                                </td>
                            </tr>
                        </table>";
		}
		return $Return;
    }
}