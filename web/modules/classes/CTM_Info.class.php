<?php
$Page_Request = strtolower(basename($_SERVER['REQUEST_URI']));
$Page_File = strtolower(basename(__FILE__));
if ($Page_Request == $Page_File)
{
	die("<span style=\"border:1px dashed #c00; color:#c00; padding:6px; background-color:#ffebe8;\"><strong>MuWhite: N&atilde;o &eacute; permitido acessar o arquivo diretamente.</strong></span>");
}
class CTM_Info
{	
        private static $_instance;

        public static function getInstance() {
            if(!isset($_instance)) {
                self::$_instance = new self();
            }
            return self::$_instance;
        }
	public function __construct($Function)
	{
		switch($Function)
		{
			case "General" : $this->General(); break;
			case "Staff" : $this->Staff(); break;
			case "Terms" : $this->Terms(); break;
		}
	}
	private function General()
	{
		global $CTM_Template, $_Panel;
		
		if(constant("Status_Enable") == TRUE)
		{
			$Connect_GS = @fsockopen(GS_Host, GS_Port, $error, $msg, 1);
		}
		switch(constant("Server_BB"))
		{
			case 0 : $Info["BB"] = "<span style=\"color:red\">Offline</span>"; break;
			case 1 : $Info["BB"] = "<span style=\"color:green;\">Online</span>"; break;
			case 2 : $Info["BB"] = "<span style=\"color:blue;\">".constant("BB_Text")."</span>"; break;
		}
		switch($_Panel["Char"]["Reset"]["General"]["Mode"])
		{
			case 1 : $Info["Reset_Type"] = "Acumulativo"; break;
			case 2 : $Info["Reset_Type"] = "Pontuativo"; break;
			case 3 : $Info["Reset_Type"] = "Tabelado"; break;
		}
		$Info["Accounts"] = CTM_GENERAL::getInstance()->ServerInfo(1, MuAcc_DB, "MEMB_INFO", FALSE, FALSE, FALSE);
		$Info["Characters"] = CTM_GENERAL::getInstance()->ServerInfo(1, MuGen_DB, "Character", FALSE, FALSE, FALSE);
		$Info["Guilds"] = CTM_GENERAL::getInstance()->ServerInfo(1, MuGen_DB, "Guild", FALSE, FALSE, FALSE);
		$Info["VIP-1"] = CTM_GENERAL::getInstance()->ServerInfo(2, VIP_DB, VIP_Table, VIP_Column, 1, FALSE);
		$Info["VIP-2"] = CTM_GENERAL::getInstance()->ServerInfo(2, VIP_DB, VIP_Table, VIP_Column, 2, FALSE);
		$Info["Acc_Ban"] = CTM_GENERAL::getInstance()->ServerInfo(2, MuAcc_DB, "MEMB_INFO", "bloc_code", 1, FALSE);
		$Info["Char_Ban"] = CTM_GENERAL::getInstance()->ServerInfo(2, MuGen_DB, "Character", "CtlCode", 1, FALSE);
		$Info["Online"] = CTM_GENERAL::getInstance()->ServerInfo(2, MuAcc_DB, "MEMB_STAT", "ConnectStat", 1, FALSE);
		$Info["Record"] = CTM_MSSQL::getInstance()->FetchQuery("SELECT record FROM ".MSSQL_DB.".dbo.CTM_WebRecord ORDER BY id DESC");
		$Info["Char_PK"] = CTM_GENERAL::getInstance()->ServerInfo(3, MuGen_DB, "Character", "pklevel", 3, 1);
		$Info["Char_Hero"] = CTM_GENERAL::getInstance()->ServerInfo(3, MuGen_DB, "Character", "pklevel", 3, 2);
		$Info["Server"] = Server_Type == 1 ? "Semi-Dedicado" : "Dedicado";
			
		$CTM_Template->Set("Bug_Bless", $Info["BB"]);
		$CTM_Template->Set("Reset_Type", $Info["Reset_Type"]);
		$CTM_Template->Set("Accounts", $Info["Accounts"][0]);
		$CTM_Template->Set("Characters", $Info["Characters"][0]);
		$CTM_Template->Set("Guilds", $Info["Guilds"][0]);
		$CTM_Template->Set("VIP-1", $Info["VIP-1"][0]);
		$CTM_Template->Set("VIP-2", $Info["VIP-2"][0]);
		$CTM_Template->Set("Acc_Ban", $Info["Acc_Ban"][0]);
		$CTM_Template->Set("Char_Ban", $Info["Char_Ban"][0]);
		$CTM_Template->Set("Online", $Info["Online"][0]);
		$CTM_Template->Set("Record", $Info["Record"][0]);
		$CTM_Template->Set("Char_PK", $Info["Char_PK"][0]);
		$CTM_Template->Set("Char_Hero", $Info["Char_Hero"][0]);
		$CTM_Template->Set("Server", $Info["Server"]);
		$CTM_Template->Set("Server_Time", constant("Server_Time"));
	}
	private function Terms()
	{
		global $CTM_Template;
		
		if($_GET["register"] == TRUE)
		{
			$CTM_Register = new CTM_Register();
		}
		
		$Open = @fopen("modules/Terms.txt", "r");
		$Terms = $Open == FALSE ? "<div class=\"error-box\"> Erro ao abrir o arquivo <b>".'"'."Terms.txt".'"'."</b></div>" : fread($Open, filesize("modules/Terms.txt"));
		
		$CTM_Template->Set("Terms", $Terms);
	}
}