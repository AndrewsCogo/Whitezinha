<?php
$Page_Request = strtolower(basename($_SERVER['REQUEST_URI']));
$Page_File = strtolower(basename(__FILE__));
if ($Page_Request == $Page_File)
{
	die("<span style=\"border:1px dashed #c00; color:#c00; padding:6px; background-color:#ffebe8;\"><strong>MuWhite: N&atilde;o &eacute; permitido acessar o arquivo diretamente.</strong></span>");
}
class CTM_ConnectServer
{
	private $CS_Socket = NULL;
        
        private static $_instance;

        public static function getInstance() {
            if(!isset($_instance)) {
                self::$_instance = new self();
            }
            return self::$_instance;
        }
	
	public function __construct($Enable)
	{
		if($Enable == TRUE)
		{
			new CTM_Cache();
			
			if(CTM_Cache::Check_Cache(2) == TRUE)
			{
				set_time_limit(0);
				$this->CS_Socket = @fsockopen(CS_Host, CS_Port, $error, $msg, 5);
				if($this->CS_Socket == FALSE)
				{
					@fclose($this->CS_Socket);
					exit("<div class=\"min-error\">Servidores Offline</div>\n");
				}
				else
				{
					@fclose($this->CS_Socket);
					CTM_Cache::Update_Cache("CS");
				}
			}
		}
	}
	public function ServerCount($GS_Count, $ServerName)
	{
		$Query = $GS_Count == TRUE ? "SELECT * FROM ".MuAcc_DB.".dbo.MEMB_STAT WHERE ConnectStat=1 and ServerName='{$ServerName}'" : "SELECT * FROM ".MuAcc_DB.".dbo.MEMB_STAT WHERE ConnectStat=1";
		return CTM_MSSQL::getInstance()->NumQuery($Query);
	}
}