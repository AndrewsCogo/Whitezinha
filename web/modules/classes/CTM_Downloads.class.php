<?php
$Page_Request = strtolower(basename($_SERVER['REQUEST_URI']));
$Page_File = strtolower(basename(__FILE__));
if ($Page_Request == $Page_File)
{
	die("<span style=\"border:1px dashed #c00; color:#c00; padding:6px; background-color:#ffebe8;\"><strong>MuWhite: N&atilde;o &eacute; permitido acessar o arquivo diretamente.</strong></span>");
}
class CTM_Downloads
{
        public static function getInstance() {
            if(!isset($_instance)) {
                self::$_instance = new self();
            }
            return self::$_instance;
        }
	public function __construct()
	{
		global $CTM_Template;
		
		$Query = CTM_MSSQL::getInstance()->Query("SELECT * FROM CTM_WebFiles ORDER BY id");
		$Check = CTM_MSSQL::getInstance()->NumRow($Query);
		
		if($Check < 1)
		{
			exit("<div class=\"info-box\"> Nenhum arquivo para Downloads no Momento</div>");
		}
		else
		{
			$CTM_Template->Set("Check_Files", NULL);
			while($File = CTM_MSSQL::getInstance()->FetchArray($Query))
			{
				$Return .= "<tr>
   		 				<td>".$File["name"]."</td>
    					<td>".base64_decode($File["description"])."</td>
    					<td>".$File["file_size"]."</td>
    					<td>[ <a target=\"_black\" href=\"".$File["link"]."\">Download</a> ]</td>
  					</tr>";
			}
		}
		$CTM_Template->Set("Driver#ATI", "http://support.amd.com/us/gpudownload/Pages/index.aspx");
		$CTM_Template->Set("Driver#Intel", "http://downloadcenter.intel.com/?lang=por");
		$CTM_Template->Set("Driver#Matrox", "http://www.matrox.com/mga/support/drivers/");
		$CTM_Template->Set("Driver#NVidia", "http://www.nvidia.com.br/Download/index.aspx?lang=br");
		$CTM_Template->Set("Downloads", $Return);
		unset($Return);
	}
}