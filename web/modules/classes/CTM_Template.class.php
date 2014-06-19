<?php
$Page_Request = strtolower(basename($_SERVER['REQUEST_URI']));
$Page_File = strtolower(basename(__FILE__));
if ($Page_Request == $Page_File)
{
	die("<span style=\"border:1px dashed #c00; color:#c00; padding:6px; background-color:#ffebe8;\"><strong>MuWhite: N&atilde;o &eacute; permitido acessar o arquivo diretamente.</strong></span>");
}
final class CTM_Template
{
	private $TPL_File = NULL;
	private $Read_File = NULL;
	private $Tags = array();
	private $Tags_Count = 0;
        
        private static $_instance;

        public static function getInstance() {
            if(!isset($_instance)) {
                self::$_instance = new self();
            }
            return self::$_instance;
        }
		
	public function Load($TPL_File)
	{
		$this->TPL_File = @fopen($TPL_File, "r");
		if($this->TPL_File == FALSE)
		{
			exit("<span style=\"border:1px dashed #c00; color:#c00; padding:6px; background-color:#ffebe8;\">CTM-Error: Arquivo <strong>".$TPL_File."</strong> n&atilde;o Encontrado.</span>");
		}
		$this->Read_File = @fread($this->TPL_File, @filesize($TPL_File));
		if($this->Read_File == FALSE)
		{
			exit("<span style=\"border:1px dashed #c00; color:#c00; padding:6px; background-color:#ffebe8;\">CTM-Error: Erro na leitura do Arquivo <strong>".$TPL_File."</strong></span>");
		}
	}
	public function Set($Tag, $Value)
	{
		$this->Tags[$this->Tags_Count++] = array(
					"Name" => $Tag,
					"Value" => $Value
					);
	}
	public function Show()
	{
		global $version;

		foreach($this->Tags as $TPL_Tags)
		{
			$this->Read_File = str_replace("{".$TPL_Tags["Name"]."}", $TPL_Tags["Value"], $this->Read_File);
		}
		
		eval("?>".$this->Read_File."<?");
		echo("\r\n"."<!-- Effect Web 2.0 | Powered by Erick-Master - CTM TEAM Softwares -->");
	}
	public function TPL_Modules()
	{
		if(isset($_COOKIE["Web_Template"]) == FALSE)
		{
			$Template = constant("Template_Default");
		}
		/*elseif(in_array(pack("H*", $_COOKIE["Web_Template"]), $_Templates) == FALSE)
		{
			$Template = constant("Template_Default");
			echo("<script>window.alert('Template Invalido, aguarde...'); window.location='?';</script>");
		}*/
		elseif(file_exists("templates/".pack("H*", $_COOKIE["Web_Template"])."/index.tpl.php") == FALSE)
		{
			setcookie("Web_Template", NULL);
			$Template = constant("Template_Default");
			echo("<script>window.alert('Template Invalido, aguarde...'); window.location='?';</script>");
		}
		else
		{
			$Template = pack("H*", $_COOKIE["Web_Template"]);
		}
		$this->Set("Template_Dir", $Template);
		$this->Load("templates/".$Template."/index.tpl.php");
		
		if($_GET["tpl"] == TRUE)
		{
			$Set_Template = pack("H*", $_GET["tpl"]);
			
			if($Set_Template == "TPL_Default")
			{
				setcookie("Web_Template", NULL);
				echo("<script>window.location='?';</script>");
			}
			/*elseif(in_array($Set_Template, $_Templates) == FALSE)
			{
				setcookie("Web_Template", NULL);
				echo("<script>window.alert('Template Invalido, aguarde...'); window.location='?';</script>");
			}*/
			elseif(file_exists("templates/".$Set_Template."/index.tpl.php") == FALSE)
			{
				setcookie("Web_Template", NULL);
				echo("<script>window.alert('Template Invalido, aguarde...'); window.location='?';</script>");
			}
			else
			{
				setcookie("Web_Template", bin2hex($Set_Template), time() + (1 * 24 * 60 * 60));
				exit("<script>window.location='?';</script>");
			}
		}
	}
	public function Open()
	{
		if(isset($_COOKIE["Web_Template"]) == FALSE)
		{
			return constant("Template_Default");
		}
		else
		{
			return pack("H*", $_COOKIE["Web_Template"]);
		}
	}
}
