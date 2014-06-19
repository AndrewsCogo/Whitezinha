<?php
$Page_Request = strtolower(basename($_SERVER['REQUEST_URI']));
$Page_File = strtolower(basename(__FILE__));
if ($Page_Request == $Page_File)
{
	die("<span style=\"border:1px dashed #c00; color:#c00; padding:6px; background-color:#ffebe8;\"><strong>MuWhite: N&atilde;o &eacute; permitido acessar o arquivo diretamente.</strong></span>");
}
class CTM_Banneds
{
	/**
	 *	Class Constructor
	 *
	 *	@return	void
	*/
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
		
		switch($_GET['type'])
		{
			case "accounts" :
				$this->Accounts();
				$CTM_Template->Load("templates/".$CTM_Template->Open()."/pages/banneds[ACCOUNTS].pag.php");
			break;
			case "characters" :
				$this->Characters();
				$CTM_Template->Load("templates/".$CTM_Template->Open()."/pages/banneds[CHARACTERS].pag.php");
			break;
			default :
				exit("<div class=\"error-box\"> Selecione uma op&ccedil;&atilde;o v&aacute;lida.</div>");
			break;
		}
	}
	/**
	 *	Private: Accounts Banneds
	 *
	 *	@return	void
	*/
	private function Accounts()
	{
		global $CTM_Template;
		
		$accounts_query = CTM_MSSQL::getInstance()->Query("SELECT MuOnline.dbo.MEMB_INFO.memb___id, MuOnline.dbo.CTM_WebAccBan.Responsible, MuOnline.dbo.CTM_WebAccBan.Reason, MuOnline.dbo.CTM_WebAccBan.[Time] FROM MuOnline.dbo.MEMB_INFO LEFT JOIN MuOnline.dbo.CTM_WebAccBan ON (MuOnline.dbo.CTM_WebAccBan.Account = MuOnline.dbo.MEMB_INFO.memb___id) WHERE MuOnline.dbo.MEMB_INFO.bloc_code = 1");
		
		if(CTM_MSSQL::getInstance()->NumRow($accounts_query) < 1)
		{
			$return = "<div class=\"info-box\"> N&atilde;o h&aacute; contas banidas no momento.</div>";
		}
		else
		{
			$return = "<table width=\"100%\" border=\"0\">
  <tr>
    <td><strong>Conta:</strong></td>
	<td><strong>Respon&aacute;vel:</strong></td>
    <td><strong>Motivo:</strong></td>
    <td><strong>Vencimento:</strong></td>
  </tr>";
			while($accounts = CTM_MSSQL::getInstance()->FetchObject($accounts_query))
			{
				$return .= "  <tr>
    <td>".$accounts->memb___id."</td>
	<td>".(strlen($accounts->Responsible) < 1 ? "Administra&ccedil;&atilde;o" : $accounts->Responsible)."</td>
    <td>".(strlen($accounts->Reason) < 1 ? "Sem Informa&ccedil;&atilde;o" : base64_decode($accounts->Reason))."</td>
    <td>".(strlen($accounts->Time) <> 10 ? "Nunca" : date("d/m/Y - h:i a", $accounts->Time))."</td>
  </tr>";
			}
			
			$return .= "</table>";
		}
		
		$CTM_Template->Set("AccountsBanned", $return);
	}
	/**
	 *	Private: Characters Banneds
	 *
	 *	@return	void
	*/
	private function Characters()
	{
		global $CTM_Template;
		
		$characters_query = CTM_MSSQL::getInstance()->Query("SELECT MuOnline.dbo.Character.Name, MuOnline.dbo.CTM_WebCharBan.Responsible, MuOnline.dbo.CTM_WebCharBan.Reason, MuOnline.dbo.CTM_WebCharBan.[Time] FROM MuOnline.dbo.Character LEFT JOIN MuOnline.dbo.CTM_WebCharBan ON (MuOnline.dbo.CTM_WebCharBan.[Character] = MuOnline.dbo.Character.Name) WHERE MuOnline.dbo.Character.CtlCode = 1");
		
		if(CTM_MSSQL::getInstance()->NumRow($characters_query) < 1)
		{
			$return = "<div class=\"info-box\"> N&atilde;o h&aacute; personagens banidos no momento.</div>";
		}
		else
		{
			$return = "<table width=\"100%\" border=\"0\">
  <tr>
    <td><strong>Personagem:</strong></td>
    <td><strong>Respon&aacute;vel:</strong></td>
	<td><strong>Motivo:</strong></td>
    <td><strong>Vencimento:</strong></td>
  </tr>";
			while($characters = CTM_MSSQL::getInstance()->FetchObject($characters_query))
			{
				$return .= "  <tr>
    <td>".$characters->Name."</td>
	<td>".(strlen($characters->Responsible) < 1 ? "Administra&ccedil;&atilde;o" : $characters->Responsible)."</td>
    <td>".(strlen($characters->Reason) < 1 ? "Sem Informa&ccedil;&atilde;o" : base64_decode($characters->Reason))."</td>
    <td>".(strlen($characters->Time) <> 10 ? "Nunca" : date("d/m/Y - h:i a", $characters->Time))."</td>
  </tr>";
			}
			
			$return .= "</table>";
		}
		
		$CTM_Template->Set("CharactersBanned", $return);
	}
}