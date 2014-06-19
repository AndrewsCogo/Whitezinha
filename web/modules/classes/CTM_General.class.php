<?php
$Page_Request = strtolower(basename($_SERVER['REQUEST_URI']));
$Page_File = strtolower(basename(__FILE__));
if ($Page_Request == $Page_File)
{
	die("<span style=\"border:1px dashed #c00; color:#c00; padding:6px; background-color:#ffebe8;\"><strong>MuWhite: N&atilde;o &eacute; permitido acessar o arquivo diretamente.</strong></span>");
}
class CTM_General
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
		global $CTM_Template, $_Panel;
		
		$this->Logout_Command();
		
		$GLOBALS['Check_Logged'] = $this->Check_Logged(false);
		
		if($GLOBALS['Check_Logged'])
		{
			$_SESSION['Hash_Account'] = str_replace(array("'", ";", "--"), NULL, $_SESSION['Hash_Account']);
			$_SESSION['Web_ManageChar'] = str_replace(array("'", ";", "--"), NULL, $_SESSION['Web_ManageChar']);
		}
		
		/***************************************************
			@ General
		****************************************************/
		$CTM_Template->Set("Server_Name", Server_Name);
		$CTM_Template->Set("%TITLE_WEB%", Web_Title);
		$CTM_Template->Set("Web_Version", "2.0");
		$CTM_Template->Set("Footer", "Effect Web 2.0");
		$CTM_Template->Set("Div#Panel", "<script>CTM_Load('?ajax=panel','Panel','GET');</script>");
		$CTM_Template->Set("Server_List", "<script>CTM_Load('?ajax=servers','Servers','GET');</script>");
		$CTM_Template->Set("Web_Poll", "<script>CTM_Load('?ajax=poll','Web_Poll','GET');</script>");
		$CTM_Template->Set("%WEB_NAVIGATION%", CTM_Pages::getInstance()->Index());
		$CTM_Template->Set("Coin_1", Coin_1);
		$CTM_Template->Set("Coin_2", Coin_2);
		$CTM_Template->Set("Coin_3", Coin_3);
		$CTM_Template->Set("VIP_Name#1", VIP_1);
		$CTM_Template->Set("VIP_Name#2", VIP_2);
		$CTM_Template->Set("Year", date("Y"));
                
		
		/***************************************************
			@ Record
		****************************************************/
		$this->ServerRecord();
		$Record = CTM_MSSQL::getInstance()->FetchQuery("SELECT Record,Data FROM dbo.CTM_WebRecord WHERE Type=1 ORDER BY id DESC");
		$CTM_Template->Set("Record_Gen#Date", date("d/m/Y", $Record[1]));
		$CTM_Template->Set("Record_Gen#Time", date("H:i", $Record[1]));
		$CTM_Template->Set("Record_Gen#Players", $Record[0]);
		
		/**************** Record Day *****************/
		$this->ServerRecord();
		$Record_Day = CTM_MSSQL::getInstance()->FetchQuery("SELECT Record,Data FROM dbo.CTM_WebRecord WHERE Type=2");
		$CTM_Template->Set("Record_Day#Date", date("d/m/Y", $Record_Day[1]));
		$CTM_Template->Set("Record_Day#Time", date("H:i", $Record_Day[1]));
		$CTM_Template->Set("Record_Day#Players", $Record_Day[0]);
		
		/***************************************************
			@ Information
		****************************************************/
		switch(constant("Server_BB"))
		{
			case 0 : $_Info["BB"] = "<span style=\"color:red\">Offline</span>"; break;
			case 1 : $_Info["BB"] = "<span style=\"color:green;\">Online</span>"; break;
			case 2 : $_Info["BB"] = "<span style=\"color:blue;\">".constant("BB_Text")."</span>"; break;
		}
		switch($_Panel["Char"]["Reset"]["General"]["Mode"])
		{
			case 1 : $_Info["Reset_Type"] = "Acumulativo"; break;
			case 2 : $_Info["Reset_Type"] = "Pontuativo"; break;
			case 3 : $_Info["Reset_Type"] = "Tabelado"; break;
		}
		$_Info["Accounts"] = $this->ServerInfo(1, MuAcc_DB, "MEMB_INFO", FALSE, FALSE, FALSE);
		$_Info["Characters"] = $this->ServerInfo(1, MuGen_DB, "Character", FALSE, FALSE, FALSE);
		$_Info["Guilds"] = $this->ServerInfo(1, MuGen_DB, "Guild", FALSE, FALSE, FALSE);
		$_Info["VIP-1"] = $this->ServerInfo(2, VIP_DB, VIP_Table, VIP_Column, 1, FALSE);
		$_Info["VIP-2"] = $this->ServerInfo(2, VIP_DB, VIP_Table, VIP_Column, 2, FALSE);
		$_Info["Acc_Ban"] = $this->ServerInfo(2, MuAcc_DB, "MEMB_INFO", "bloc_code", 1, FALSE);
		$_Info["Char_Ban"] = $this->ServerInfo(2, MuGen_DB, "Character", "CtlCode", 1, FALSE);
		/************************** @ Set Template @ **************************/
		$CTM_Template->Set("@_Info#Version", Server_Version);
		$CTM_Template->Set("@_Info#Xp", Server_Xp);
		$CTM_Template->Set("@_Info#Drop", Server_Drop);
		$CTM_Template->Set("@_Info#Accounts", $_Info["Accounts"][0]);
		$CTM_Template->Set("@_Info#Characters", $_Info["Characters"][0]);
		$CTM_Template->Set("@_Info#Guilds", $_Info["Guilds"][0]);
		$CTM_Template->Set("@_Info#VIP-1", $_Info["VIP-1"][0]);
		$CTM_Template->Set("@_Info#VIP-2", $_Info["VIP-2"][0]);
		$CTM_Template->Set("@_Info#Acc_Ban", $_Info["Acc_Ban"][0]);
		$CTM_Template->Set("@_Info#Char_Ban", $_Info["Char_Ban"][0]);
		$CTM_Template->Set("@_Info#BugBless", $_Info["BB"]);
		$CTM_Template->Set("@_Info#ResetType", $_Info["Reset_Type"]);

		/***************************************************
			@ Check Web ManageChar
		****************************************************/
		if(connection_aborted() == TRUE)
		{
			@session_destroy();
			$_SESSION["Web_ManageChar"] = NULL;
		}
	}
	private function Logout_Command()
	{
		if($_GET["exec"] == "logout")
		{
			$_SESSION["Web_ManageChar"] = NULL;
			$_SESSION["Hash_Account"] = NULL;
			$_SESSION["Hash_Password"] = NULL;
		}
	}
	public function ServerInfo($Type, $DataBase, $Table, $Column, $Where, $Command)
	{
		if($Type == 1)
		{
			return CTM_MSSQL::getInstance()->FetchQuery("SELECT count(1) FROM {$DataBase}.dbo.{$Table}");
		}
		if($Type == 2)
		{
			return CTM_MSSQL::getInstance()->FetchQuery("SELECT count(1) FROM {$DataBase}.dbo.{$Table} WHERE {$Column}='{$Where}'");
		}
		if($Type == 3)
		{
			$Cmd = $Command == 1 ? ">" : "<";
			return CTM_MSSQL::getInstance()->FetchQuery("SELECT count(1) FROM {$DataBase}.dbo.{$Table} WHERE {$Column}{$Cmd}'{$Where}'");
		}
	}
	public function ServerRecord()
	{
		$Request = CTM_MSSQL::getInstance()->FetchQuery("SELECT count(*) FROM MuOnline.dbo.MEMB_STAT WHERE ConnectStat=1");
		$Query[0] = CTM_MSSQL::getInstance()->Query("SELECT Record FROM dbo.CTM_WebRecord WHERE Type=1 ORDER BY Id DESC");
		$Query[1] = CTM_MSSQL::getInstance()->Query("SELECT Record FROM dbo.CTM_WebRecord WHERE Type=2");
		$Check[0] = CTM_MSSQL::getInstance()->NumRow($Query[0]);
		$Check[1] = CTM_MSSQL::getInstance()->NumRow($Query[1]);
		
		if($Check[0] < 1)
		{
			$Date = strtotime("now");
			CTM_MSSQL::getInstance()->Query("INSERT INTO CTM_WebRecord (Record,Data,Type) VALUES ({$Request[0]},'{$Date}',1)");
		}
		else
		{
			$Record = CTM_MSSQL::getInstance()->Fetch($Query[0]);
			if($Request[0] > $Record[0])
			{
				$Date = strtotime("now");
				CTM_MSSQL::getInstance()->Query("INSERT INTO CTM_WebRecord (Record,Data,Type) VALUES ({$Request[0]},'{$Date}',1)");
			}
		}
		if($Check[1] < 1)
		{
			$Date = strtotime("now");
			CTM_MSSQL::getInstance()->Query("INSERT INTO CTM_WebRecord (Record,Data,Type) VALUES ({$Request[0]},'{$Date}',2)");
		}
		else
		{
			$Record_Day = CTM_MSSQL::getInstance()->Fetch($Query[1]);
			if($Request[0] > $Record_Day[0])
			{
				$Checking = CTM_MSSQL::getInstance()->NumQuery("SELECT * FROM dbo.CTM_WebRecord WHERE Type=2");
				$Date = strtotime("now");
				if($Checking < 1)
				{
					CTM_MSSQL::getInstance()->Query("INSERT INTO dbo.CTM_WebRecord (Record,Data,Type) VALUES ({$Request[0]},'{$Date}',2)");
				}
				else
				{
					CTM_MSSQL::getInstance()->Query("UPDATE dbo.CTM_WebRecord SET Record={$Request[0]},Data={$Date} WHERE Type=2");
				}
			}
		}
	}
	public function Check_Logged($Cheking = 1)
	{
		if($Cheking == 1)
		{
			if(isset($_SESSION["Hash_Account"]) == FALSE || isset($_SESSION["Hash_Password"]) == FALSE)
			{
				exit("<div class=\"info-box\"> Somente usuarios logados tem acesso a est&aacute; pagina.</div>");
			}
		}
		if($Cheking == 2)
		{
			if(
			(isset($_SESSION["Hash_Account"]) == FALSE && isset($_SESSION["Hash_Password"]) == FALSE) ||
			(isset($_SESSION["Hash_Account"]) == FALSE && isset($_SESSION["Hash_Password"]) == TRUE) ||
			(isset($_SESSION["Hash_Password"]) == FALSE && isset($_SESSION["Hash_Account"]) == TRUE))
			{
				return TRUE;
			}
			else
			{
				return FALSE;
			}
		}
		else
		{
			if(
			(isset($_SESSION["Hash_Account"]) == TRUE && isset($_SESSION["Hash_Password"]) == TRUE) ||
			(isset($_SESSION["Hash_Account"]) == TRUE && isset($_SESSION["Hash_Password"]) == FALSE) ||
			(isset($_SESSION["Hash_Password"]) == TRUE && isset($_SESSION["Hash_Account"]) == FALSE))
			{
				return TRUE;
			}
			else
			{
				return FALSE;
			}
		}
	}
	public function Check_Banned()
	{
		$Check = CTM_MSSQL::getInstance()->FetchQuery("SELECT bloc_code FROM MuOnline.dbo.MEMB_INFO WHERE memb___id='".$_SESSION["Hash_Account"]."'");
		if($Check[0] == 1)
		{
			exit("<div class=\"info-box\"> Sua conta est&aacute; banida</div>");
		}
	}
	public function Check_Staff()
	{
		$Check[0] = CTM_MSSQL::getInstance()->NumQuery("SELECT * FROM dbo.CTM_WebStaff WHERE account='".$_SESSION["Hash_Account"]."'");
		if($Check[0] > 0)
		{
			$Check[1] = CTM_MSSQL::getInstance()->FetchQuery("SELECT type FROM dbo.CTM_WebStaff WHERE account='".$_SESSION["Hash_Account"]."'");
		}
		if($Check[0] < 1 || $Check[1][0] < 1)
		{
			exit("<div class=\"info-box\"> Voc&ecirc; n&atilde;o contem privilegio para acessar esta pagina</div>");
		}
	}
	public function Check_Coin_Table($Account)
	{
		if(constant("GL_Table") != "MEMB_INFO")
		{
			$Check_Exists = CTM_MSSQL::getInstance()->NumQuery("SELECT * FROM ".GL_DB.".dbo.".GL_Table." WHERE ".GL_Login."='{$Account}'");
			
			if($Check_Exists < 1)
			{
				CTM_MSSQL::getInstance()->Query("INSERT INTO ".GL_DB.".dbo.".GL_Table." (".GL_Column_1.",".GL_Login.") VALUES (0,'{$Account}')");
				return TRUE;
			}
			else
			{
				return TRUE;
			}
		}
		else
		{
			return TRUE;
		}
	}
	public function Image($Char)
	{
		$Image = CTM_MSSQL::getInstance()->FetchQuery("SELECT CTM_Image FROM MuOnline.dbo.Character WHERE Name='{$Char}'");
		$Request = constant("Upload_Img");
		if($Image[0] == NULL)
		{
			$Image[0] = "nophoto.gif";
		}
		return file_exists($Request.$Image[0]) == TRUE ? $Request.$Image[0] : $Request."nophoto.gif";
	}
	public function ClassName($Char)
	{
		global $_ClassType;
		
		switch($Char)
		{
			case $_ClassType["DW"][0] : return $_ClassType["DW"][1];
			case $_ClassType["SM"][0] : return $_ClassType["SM"][1];
			case $_ClassType["GM"][0] : return $_ClassType["GM"][1];
			case $_ClassType["DK"][0] : return $_ClassType["DK"][1];
			case $_ClassType["BK"][0] : return $_ClassType["BK"][1];
			case $_ClassType["BM"][0] : return $_ClassType["BM"][1];
			case $_ClassType["FE"][0] : return $_ClassType["FE"][1];
			case $_ClassType["ME"][0] : return $_ClassType["ME"][1];
			case $_ClassType["HE"][0] : return $_ClassType["HE"][1];
			case $_ClassType["MG"][0] : return $_ClassType["MG"][1];
			case $_ClassType["DM"][0] : return $_ClassType["DM"][1];
			case $_ClassType["DM2"][0] : return $_ClassType["DM2"][1];
			case $_ClassType["DL"][0] : return $_ClassType["DL"][1];
			case $_ClassType["LE"][0] : return $_ClassType["LE"][1];
			case $_ClassType["LE2"][0] : return $_ClassType["LE2"][1];
			case $_ClassType["SU"][0] : return $_ClassType["SU"][1];
			case $_ClassType["BS"][0] : return $_ClassType["BS"][1];
			case $_ClassType["DIM"][0] : return $_ClassType["DIM"][1];
			case $_ClassType["RF"][0] : return $_ClassType["RF"][1];
			case $_ClassType["FM"][0] : return $_ClassType["FM"][1];
		}
	}
	public function Map($Char)
	{
		global $_MapInfo;
		
		for($MP = 0; $MP < count($_MapInfo); $MP++)
		{
			switch($Char)
			{
				case $_MapInfo[$MP][0] : return $_MapInfo[$MP][3];
			}
		}
	}
	public function Memb_Type($Acc)
	{
		switch($Acc)
		{
			case 0 : return "Free";
			case 1 : return VIP_1;
			case 2 : return VIP_2;
			default : return "Erro";
		}
	}
	public function VIP($Type, $Account)
	{
		$Send = $this->FetchQuery("SELECT ".VIP_Begin.",".VIP_Time.",".VIP_Column." FROM ".VIP_DB.".dbo.".VIP_Table." WHERE ".VIP_Login."='{$Account}'");
		switch($Type)
		{
			case 1 : return $Send[2] > 0 ? date("d/m/Y", $Send[0])." as ".date("H:i", $Send[0]) : "Nunca";
			case 2 : return $Send[2] > 0 ? date("d/m/Y", $Send[1])." as ".date("H:i", $Send[1]) : "Nunca";
		}
	}
	/**
	 *	1.7.16 : Get Hex Void
	 *
	 *	@param	string	Type
	 *	@return	string
	*/
	public function GetHexVoid($type)
	{
		switch($type)
		{
			case "vault" :
				return "0x".str_repeat("FF", (GS_Version >= 2 ? (GS_Version == 7 ? 3840 : 1920) : 1200));
			case "inventory" :
				return "0x".str_repeat("FF", (GS_Version >= 2 ? (GS_Version == 7 ? 2732 : 1728) : (GSVersion == 1 ? 1080 : 760)));
			case "skill" :
				return "0x".str_repeat("FF0000", (GS_Version >= 1 ? 180 : 60) / 6);
			case "quest" :
				return "0x".str_repeat("FF", 50);
		}
	}
	/**
	 *	1.7.16 : Get Hex Void
	 *
	 *	@param	string	Type
	 *	@return	string
	*/
	public function GetHexSize($type)
	{
		switch($type)
		{
			case "vault" :
				return GS_Version >= 2 ? (GS_Version == 7 ? 3840 : 1920) : 1200;
			case "inventory" :
				GS_Version >= 2 ? (GS_Version == 7 ? 2732 : 1728) : (GSVersion == 1 ? 1080 : 760);
			case "skill" :
				return GS_Version >= 1 ? 180 : 60;
			case "quest" :
				return 50;
		}
	}
}
