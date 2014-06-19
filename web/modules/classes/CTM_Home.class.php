<?php
$Page_Request = strtolower(basename($_SERVER['REQUEST_URI']));
$Page_File = strtolower(basename(__FILE__));
if ($Page_Request == $Page_File)
{
	die("<span style=\"border:1px dashed #c00; color:#c00; padding:6px; background-color:#ffebe8;\"><strong>MuWhite: N&atilde;o &eacute; permitido acessar o arquivo diretamente.</strong></span>");
}
class CTM_Home
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
		
		$CTM_Template->Set("Show_News", constant("Show_News") == TRUE ? $this->Show_News() : NULL);
		$CTM_Template->Set("Board_News", constant("Board_News") == TRUE ? $this->Board_News() : NULL);
		$CTM_Template->Set("Top_Home#Resets", $this->Top_Home("Resets"));
		$CTM_Template->Set("Top_Home#M_Resets", $this->Top_Home("M_Resets"));
		$CTM_Template->Set("Top_Home#Hero", $this->Top_Home("Hero"));
                $CTM_Template->Set("Top_Home#PK", $this->Top_Home("PK"));
                $CTM_Template->Set("Top_Home#Horas", $this->Top_Home("Horas"));
		$CTM_Template->Set("Top_Home#Guilds", constant("Top_Guilds") == TRUE ? $this->Top_Home("Guilds") : NULL);
	}
	private function Board_News()
	{
		global $_Home;
		
		$CTM_MySQL = new CTM_MySQL();
		$CTM_MySQL->MySQL_Host = $_Home["Board"]["MySQL"]["Host"];
		$CTM_MySQL->MySQL_User = $_Home["Board"]["MySQL"]["User"];
		$CTM_MySQL->MySQL_Pass = $_Home["Board"]["MySQL"]["Pass"];
		$CTM_MySQL->MySQL_Data = $_Home["Board"]["MySQL"]["DataBase"];
		$CTM_MySQL->Connect();
		
		/********************** Invision Power Board ***********************/
		if($_Home["Board"]["Mode"] == 1)
		{
			$Erick_Master .= "SELECT * FROM ".$_Home["Board"]["Prefix"]."topics WHERE ";
			for($WzAG = 0; $WzAG < count($_Home["Board"]["Forum_ID"]); $WzAG++)
			{
				$CTMT = $_Home["Board"]["Forum_ID"][$WzAG];
			
				if($WzAG < count($_Home["Board"]["Forum_ID"]) - 1)
				{
					$Erick_Master .= "forum_id='{$CTMT}' or ";
				}
				else
				{
					$Erick_Master .= "forum_id='{$CTMT}' ";
				}
			}
			$Query = $CTM_MySQL->Query($Erick_Master."ORDER BY tid DESC LIMIT ".$_Home["Board"]["Top_News"]);
			
			if($CTM_MySQL->NumRow($Query) < 1)
			{
				$Return = "<div class=\"info-box\"> N&atilde;o h&aacute; Noticias postada no Momento.</div>";
			}
			else
			{
				$Return .= "<ul style=\"list-style: none;\">\n";
				 
				 while($Load = $CTM_MySQL->FetchArray($Query))
				 {
                                         $data = date("d/m/Y", $Load["start_date"]);
                                         $data_ant = (date("d")-1)."/".date("m")."/".date("Y");
                                         $check_data = ($data == date("d/m/Y") || $data == $data_ant) ? "<img src='http://i.imgur.com/maB6r.gif'/>" : "";
					 $Title = $_Home["Board"]["Debug"] == TRUE ? utf8_encode($Load["title"]) : $Load["title"];
					 $Target = $_Home["Board"]["Target"] == TRUE ? "target=\"_blank\"" : NULL;
					 $Link = $_Home["Board"]["Link"]."/index.php?showtopic=".$Load["tid"];
					 $Return .= "<li>&raquo; ".$check_data." <a href=\"{$Link}\" {$Target}><b class=\"colr\">[".date("d/m/Y", $Load["start_date"])."] ".$Title."</b></a></li>\n";
				 }
				 $Return .= "</ul>";
			}
		}
		return $Return;
	}
	private function Top_Home($Top)
	{
		if($Top == "Resets")
		{
			$query = CTM_MSSQL::getInstance()->query("SELECT TOP 1 Name,ResetsDay,CTM_Image FROM ".MuGen_DB.".dbo.Character WHERE Ctlcode < 2 ORDER BY ResetsDay DESC");
                        $Check = CTM_MSSQL::getInstance()->NumRow($query);
			if($Check < 1)
			{
				$Return = "<ul class=\"tops\">
                                            <li class=\"box-top\">
                                             <div class=\"warning-box\"> Este ranking n&atilde;o possui Resultados</div>
                                            </li>
                                           </ul>";
			}
			$cont = NULL;
			while($topresets = mssql_fetch_array($query)){
			$cont++;
				if($topresets[2] == NULL OR empty($topresets[2]) OR !file_exists(Upload_Img."".$topresets[2]."")){
					$photo = Upload_Img."nophoto.gif";
				}else{
					$photo = Upload_Img."".$topresets[2]."";
				}
				$Return .='<ul class="tops">
				<li class="box-top">
					<span>Top <font color="#4ea4a5">(Resets)</font></span>
					<a href="javascript: void(EffectWeb);" onclick="CTM_Load(\'?pag=search&amp;char='.$topresets[0].'\', \'conteudo\',\'GET\');">
					<img src="'.$photo.'" width="108" height="110" alt="'.$topresets[0].'">
					<span>'.$topresets[0].'</span>
					</a>
				</li>
				</ul>';
				}
			return $Return;
		}
		if($Top == "M_Resets")
		{
			$query = CTM_MSSQL::getInstance()->query("SELECT TOP 1 Name,MResetsDay,CTM_Image FROM ".MuGen_DB.".dbo.Character WHERE Ctlcode < 2 ORDER BY MResetsDay DESC");
                        $Check = CTM_MSSQL::getInstance()->NumRow($query);
			if($Check < 1)
			{
				$Return = "<ul class=\"tops\">
                                            <li class=\"box-top\">
                                             <div class=\"warning-box\"> Este ranking n&atilde;o possui Resultados</div>
                                            </li>
                                           </ul>";
			}
			$cont = NULL;
			while($topresets = mssql_fetch_array($query)){
			$cont++;
				if($topresets[2] == NULL OR empty($topresets[2]) OR !file_exists(Upload_Img."".$topresets[2]."")){
					$photo = Upload_Img."nophoto.gif";
				}else{
					$photo = Upload_Img."".$topresets[2]."";
				}
				$Return .='<ul class="tops">
				<li class="box-top">
					<span>Top <font color="#4ea4a5">(M.Resets)</font></span>
					<a href="javascript: void(EffectWeb);" onclick="CTM_Load(\'?pag=search&amp;char='.$topresets[0].'\', \'conteudo\',\'GET\');">
					<img src="'.$photo.'" width="108" height="110" alt="'.$topresets[0].'">
					<span>'.$topresets[0].'</span>
					</a>
				</li>
				</ul>';
				}
			return $Return;
		}
		if($Top == "Hero")
		{
			$query = CTM_MSSQL::getInstance()->query("SELECT TOP 1 Name,HeroCountDay,CTM_Image FROM ".MuGen_DB.".dbo.Character WHERE Ctlcode < 2 ORDER BY HeroCountDay ASC");
                        $Check = CTM_MSSQL::getInstance()->NumRow($query);
			if($Check < 1)
			{
				$Return = "<ul class=\"tops\">
                                            <li class=\"box-top\">
                                             <div class=\"warning-box\"> Este ranking n&atilde;o possui Resultados</div>
                                            </li>
                                           </ul>";
			}
			$cont = NULL;
			while($topresets = mssql_fetch_array($query)){
			$cont++;
				if($topresets[2] == NULL OR empty($topresets[2]) OR !file_exists(Upload_Img."".$topresets[2]."")){
					$photo = Upload_Img."nophoto.gif";
				}else{
					$photo = Upload_Img."".$topresets[2]."";
				}
				$Return .='<ul class="tops">
				<li class="box-top">
					<span>Top <font color="#4ea4a5">(Her&oacute;i)</font></span>
					<a href="javascript: void(EffectWeb);" onclick="CTM_Load(\'?pag=search&amp;char='.$topresets[0].'\', \'conteudo\',\'GET\');">
					<img src="'.$photo.'" width="108" height="110" alt="'.$topresets[0].'">
					<span>'.$topresets[0].'</span>
					</a>
				</li>
				</ul>';
				}
			return $Return;
		}
		if($Top == "PK")
		{
			$query = CTM_MSSQL::getInstance()->query("SELECT TOP 1 Name,PKCountDay,CTM_Image FROM ".MuGen_DB.".dbo.Character WHERE Ctlcode < 2 ORDER BY PKCountDay DESC");
                        $Check = CTM_MSSQL::getInstance()->NumRow($query);
			if($Check < 1)
			{
				$Return = "<ul class=\"tops\">
                                            <li class=\"box-top\">
                                             <div class=\"warning-box\"> Este ranking n&atilde;o possui Resultados</div>
                                            </li>
                                           </ul>";
			}
			$cont = NULL;
			while($topresets = mssql_fetch_array($query)){
			$cont++;
				if($topresets[2] == NULL OR empty($topresets[2]) OR !file_exists(Upload_Img."".$topresets[2]."")){
					$photo = Upload_Img."nophoto.gif";
				}else{
					$photo = Upload_Img."".$topresets[2]."";
				}
				$Return .='<ul class="tops">
				<li class="box-top">
					<span>Top <font color="#4ea4a5">(Pk)</font></span>
					<a href="javascript: void(EffectWeb);" onclick="CTM_Load(\'?pag=search&amp;char='.$topresets[0].'\', \'conteudo\',\'GET\');">
					<img src="'.$photo.'" width="108" height="110" alt="'.$topresets[0].'">
					<span>'.$topresets[0].'</span>
					</a>
				</li>
				</ul>';
				}
			return $Return;
		}
		if($Top == "Horas")
		{
			$query = CTM_MSSQL::getInstance()->query("SELECT TOP 1 Name,HorasOnlineDay,CTM_Image FROM ".MuGen_DB.".dbo.Character WHERE Ctlcode < 2 ORDER BY HorasOnlineDay DESC");
                        $Check = CTM_MSSQL::getInstance()->NumRow($query);
			if($Check < 1)
			{
				$Return = "<ul class=\"tops\">
                                            <li class=\"box-top\">
                                             <div class=\"warning-box\"> Este ranking n&atilde;o possui Resultados</div>
                                            </li>
                                           </ul>";
			}
			$cont = NULL;
			while($topresets = mssql_fetch_array($query)){
			$cont++;
				if($topresets[2] == NULL OR empty($topresets[2]) OR !file_exists(Upload_Img."".$topresets[2]."")){
					$photo = Upload_Img."nophoto.gif";
				}else{
					$photo = Upload_Img."".$topresets[2]."";
				}
				$Return .='<ul class="tops">
				<li class="box-top">
					<span>Top <font color="#4ea4a5">(Horas Online)</font></span>
					<a href="javascript: void(EffectWeb);" onclick="CTM_Load(\'?pag=search&amp;char='.$topresets[0].'\', \'conteudo\',\'GET\');">
					<img src="'.$photo.'" width="108" height="110" alt="'.$topresets[0].'">
					<span>'.$topresets[0].'</span>
					</a>
				</li>
				</ul>';
				}
			return $Return;
		}
		if($Top == "Guilds")
		{
			$Query = CTM_MSSQL::getInstance()->Query("SELECT TOP 5 G_Name,G_Score,G_Mark FROM ".MuGen_DB.".dbo.Guild ORDER BY G_Score DESC");
			$Check = CTM_MSSQL::getInstance()->NumRow($Query);
			
			if($Check < 1)
			{
				$Return = "<div class=\"warning-box\"> Este ranking n&atilde;o possui Resultados</div>" ;
			}
			
			$Return .= "<table border=\"0\" cellpadding=\"0\" cellpadding=\"2\" cellspacing=\"2\">
					<tr>
					<td style=\"width: 110px;\"><table border=\"0\" cellpadding=\"2\" cellspacing=\"2\">
		<tr>";
			for($WzAG = 0; $WzAG < $this->NumRow($Query); $WzAG++)
			{
				$Rank = $WzAG+1;
				$Guild = $this->Fetch($Query);
				$Image = "?public=logoGuild&code=".urlencode(bin2hex($Guild[2]));
				$Return .= "
		<td style=\"width: 18px;\" align=\"center\"><a href=\"javascript: void(EffectWeb);\" onclick=\"CTM_Load('?pag=search&guild=".urlencode($Guild[0])."', 'conteudo','GET');\" style=\"color: #666666;\">".$Rank."&deg; - ".$Guild[0]." <img src=\"".$Image."\" width=\"120\" height=\"120\" style=\"border: 1px solid #B3B3B3;\" class=\"image\" /><br />(".$Guild[1]." Score)</a></td>";
			}
	    $Return .= "
		</tr>
		   </table>
		   </td>
		     </tr>
			</table>";
			return $Return;
		}
	}
}