<?php
$Page_Request = strtolower(basename(filter_input(INPUT_SERVER, 'REQUEST_URI', FILTER_UNSAFE_RAW, FILTER_VALIDATE_BOOLEAN)));
$Page_File = strtolower(basename(__FILE__));
if($Page_Request == $Page_File)
{
	die("<span style=\"border:1px dashed #c00; color:#c00; padding:6px; background-color:#ffebe8;\"><strong>MuWhite: N&atilde;o &eacute; permitido acessar o arquivo diretamente.</strong></span>");
}

# Open Class File
function __autoload($class_name)
{
            require_once("modules/classes/".$class_name.".class.php"); 
}

# Web Info
$CTM = array("CTM_WebStaff", "CTM_WebRecord", "CTM_WebFiles", "CTM_WebTickets", "CTM_WebProfile", "CTM_WebWarning", "CTM_WebNews", "CTM_WebAccBan", "CTM_WebCharBan", "CTM_WebTicketRes", "CTM_WebPayments", "CTM_WebPaymentRes","CTM_WebRaffles", "CTM_WebCronJob", "CTM_WebRecovery", "CTM_WebPoll", "CTM_WebPollAnswers", "CTM_WebPollVotes", "CTM_WebRegister", "CTM_WebChangeMail","CTM_WebScreenShots", "CTM_WebScreenVotes", "CTM_WebScreenComments","CTM_WebNewsComments");
$CTM[C] = array(CHAR_IMAGE_COLUMN, EXTRA_VAULT_COLUMN);
define("Product", "Effect Web");

# Login
if(!empty($_SESSION['Hash_Account']))
{
	$_SESSION["Hash_Account"] = str_replace(array("'", ";", "--"), NULL, $_SESSION["Hash_Account"]);
	$Login = str_replace(array("'", ";", "--"), NULL, $_SESSION["Hash_Account"]);
}

# Class Load
$CTM_Security = new CTM_Security();
$CTM_Template = new CTM_Template();
$CTM_Pages = new CTM_Pages();
$CTM_Crypt = new CTM_Crypt();
	
$CTM_MSSQL = new CTM_MSSQL();

# Reference
if(strlen($_GET['ref']) > 0)
{
	$CTM_Reference = new CTM_Reference();
	$CTM_Reference->ReferenceLink($_GET['ref']);
}

$CTM_Ajax = new CTM_Ajax();