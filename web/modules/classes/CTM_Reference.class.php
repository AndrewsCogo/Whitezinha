<?php
$Page_Request = strtolower(basename($_SERVER['REQUEST_URI']));
$Page_File = strtolower(basename(__FILE__));
if ($Page_Request == $Page_File)
{
	die("<span style=\"border:1px dashed #c00; color:#c00; padding:6px; background-color:#ffebe8;\"><strong>MuWhite: N&atilde;o &eacute; permitido acessar o arquivo diretamente.</strong></span>");
}
class CTM_Reference extends CTM_MSSQL
{
	public function ReferenceLink($id)
	{
			$query = $this->Query("SELECT Id FROM dbo.CTM_WebReference WHERE Id = ".$id);
			$check = $this->NumRow($query);
                        $Ip = $this->Query("SELECT IPAddress FROM dbo.CTM_WebReferenceData WHERE IPAddress='".$_SERVER['REMOTE_ADDR']."'");
                        $IpCheck = $this->NumRow($Ip);
                        $Redirect   = "http://muwhite.net/";       // Página de redirect
                        if($IpCheck > 0)
                        {
                            exit("<script>alert ('Voce ja clicou neste link!');window.location='$Redirect';</script>");   
                        }
			elseif($check > 0)
			{
				$this->Query("UPDATE dbo.CTM_WebReference SET AccessCount = AccessCount + 1,Points = Points + ".NEWFINAL_REF_ACCESSPOINTS." WHERE Id = ".$id);
                                $this->Query("INSERT INTO MuOnline.dbo.CTM_WebReferenceData (Reference, RefLogin, Account, IPAddress) VALUES (1, 2, 0, '".$_SERVER['REMOTE_ADDR']."')");
                                exit("<script>location = '?do=register'</script>");
			}
	}
}