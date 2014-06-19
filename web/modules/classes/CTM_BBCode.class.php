<?php
$Page_Request = strtolower(basename($_SERVER['REQUEST_URI']));
$Page_File = strtolower(basename(__FILE__));
if ($Page_Request == $Page_File)
{
	die("<span style=\"border:1px dashed #c00; color:#c00; padding:6px; background-color:#ffebe8;\"><strong>MuWhite: N&atilde;o &eacute; permitido acessar o arquivo diretamente.</strong></span>");
}
class CTM_BBCode
{
	private $Codes = 
	array(
		 "[b]" => "<strong>",
		 "[/b]" => "</strong>",
		 "[i]" => "<em>",
		 "[/i]" => "</em>",
		 "[u]" => "<u>",
		 "[/u]" => "</u>",
		 "[s]" => "<s>",
		 "[/s]" => "</s>",
		 "[h1]" => "<h1>",
		 "[/h1]" => "</h1>",
		 "[left]" => "<div align=\"left\">",
		 "[/left]" => "</div>",
		 "[center]" => "<div align=\"center\">",
		 "[/center]" => "</div>",
		 "[right]" => "<div align=\"right\">",
		 "[/right]" => "</div>",
		 "[red]" => "<font color=\"#FF0000\">",
		 "[/red]" => "</font>",
		 "[white]" => "<font color=\"#FFFFFF\">",
		 "[/white]" => "</font>",
		 "[blue]" => "<font color=\"#0000FF\">",
		 "[/blue]" => "</font>",
		 "[green]" => "<font color=\"green\">",
		 "[/green]" => "</font>",
		 "[yellow]" => "<font color=\"#FEFF00\">",
		 "[/yellow]" => "</font>",
		 "[violet]" => "<font color=\"#FF00FF\">",
		 "[/violet]" => "</font>",
		 "[gray]" => "<font color=\"#808080\">",
		 "[/gray]" => "</font>",
		 "[lime]" => "<font color=\"#00FF00\">",
		 "[/lime]" => "</font>",
		 "[silver]" => "<font color=\"#C0C0C0\">",
		 "[/silver]" => "</font>",
		 "[pink]" => "<font color=\"#FFC0CB\">",
		 "[/pink]" => "</font>",
		 "[navy]" => "<font color=\"#000080\">",
		 "[/navy]" => "</font>",
		 "[aqua]" => "<font color=\"#00FFFF\">",
		 "[/aqua]" => "</font>",
                    );
	public function Replace($String)
	{
		foreach ($this->Codes as $BBCode => $Value)
		{
			$String = eregi_replace(quotemeta($BBCode), quotemeta($Value), $String);
			$String = str_replace("\.", ".", $String);
		}
		return $String;
	}
}