<?php
$Page_Request = strtolower(basename($_SERVER['REQUEST_URI']));
$Page_File = strtolower(basename(__FILE__));
if ($Page_Request == $Page_File)
{
	die("<span style=\"border:1px dashed #c00; color:#c00; padding:6px; background-color:#ffebe8;\"><strong>MuWhite: N&atilde;o &eacute; permitido acessar o arquivo diretamente.</strong></span>");
}
class CTM_Header
{
        private static $_instance;

        public static function getInstance() {
            if(!isset($_instance)) {
                self::$_instance = new self();
            }
            return self::$_instance;
        }
	public function Show_Poll()
	{
		if($_GET["cmd"] == "results")
		{
			$this->Poll_Result();
			exit(false);
		}
		if($_GET["cmd"] == "vote")
		{
			$this->Vote_Poll();
			exit(false);
		}
		if($_GET["cmd"] == "all_poll")
		{
			$this->All_Poll();
			exit(false);
		}
		$Get_Id = isset($_GET["show"]) == TRUE ? "WHERE Id='".$_GET["show"]."'" : NULL;
		
		$Check = CTM_MSSQL::getInstance()->NumQuery("SELECT * FROM dbo.CTM_WebPoll");
		
		if($Check < 1)
		{
			exit("<div class=\"min-info\"> Nenhuma enquete cadastrada.</div>");
		}
		else
		{
			$Query = CTM_MSSQL::getInstance()->Query("SELECT * FROM dbo.CTM_WebPoll {$Get_Id} ORDER BY Id DESC");
			$Load = CTM_MSSQL::getInstance()->FetchArray($Query);
			
			$Return .= "<form name=\"Poll_Form\" id=\"Poll_Form\">
				<ul class=\"ul\">
        		<li><strong>&raquo; ".base64_decode($Load["Question"])."</strong></li>
				<li style=\"border-bottom: 1px solid #333333;\"></li>\n";
				
			$Query_Answers = CTM_MSSQL::getInstance()->Query("SELECT * FROM dbo.CTM_WebPollAnswers WHERE Poll_ID='".$Load["Id"]."'");
			
			while($Answers = CTM_MSSQL::getInstance()->FetchArray($Query_Answers))
			{
				$Return .= "<li><input name=\"Answer\" type=\"radio\" id=\"Answer\" value=\"".$Answers["Id"]."\" class=\"radio\"> ".base64_decode($Answers["Answer"])."</li>\n";
			}
			
			$Return .= "<li><input type=\"button\" value=\"Votar\" onclick=\"CTM_Load('?ajax=poll&cmd=vote&id=".$Load["Id"]."', 'Result', 'POST', BuscaElementosForm('Poll_Form'));\" /> <input type=\"button\" value=\"Resultado\" onclick=\"CTM_Load('?ajax=poll&cmd=results&id=".$Load["Id"]."', 'Result', 'GET');\" /></li>
			<li><a href=\"javascript: void(EffectWeb);\" onclick=\"CTM_Load('?ajax=poll&cmd=all_poll', 'Web_Poll', 'GET');\">&raquo; Todas as Enquetes</a></li>
			</ul>
        </form>
		<div style=\"clear: both;\"></div>
         <div id=\"Result\"></div>";
		
			exit($Return);
			unset($Return);
			
		}
	}
	private function Poll_Result()
	{
		$Id = (int)$_GET["id"];
		$Query = CTM_MSSQL::getInstance()->Query("SELECT Answer,Votes,Id FROM dbo.CTM_WebPollAnswers WHERE Poll_ID={$Id}");
		$Question = CTM_MSSQL::getInstance()->FetchQuery("SELECT Question,Status,Expiration FROM dbo.CTM_WebPoll WHERE Id={$Id}");
		$Check = CTM_MSSQL::getInstance()->NumQuery("SELECT * FROM dbo.CTM_WebPoll WHERE Id={$Id}");
		
		if($Check < 1)
		{
			$Return = "<div class=\"min-error\"> Esta enquete n&atilde;o existe.</div>";
		}
		else
		{
			if(time() >= $Question[2])
			{
				CTM_MSSQL::getInstance()->Query("UPDATE dbo.CTM_WebPoll SET Status=0x01E2 WHERE Id={$Id}");
			}
			
			switch(strtoupper(bin2hex($Question[1])))
			{
				case "FFFF" : $Status = "<span style=\"color: green\">Aberto</span>"; break;
				case "01E2" : $Status = "<span style=\"color: red\">Fechado</span>"; break;
			}
			
			$Total_Query = CTM_MSSQL::getInstance()->Query("SELECT sum(Votes) as Result FROM dbo.CTM_WebPollAnswers WHERE Poll_ID={$Id}");
			$Total[0] = CTM_MSSQL::getInstance()->FetchArray($Total_Query);
			$Total[1] = number_format($Total[0]["Result"], 0, false, ".");
			
			$Return .= "<ul class=\"ul\">
			<li style=\"border-bottom: 1px solid #333333;\"></li>
	<li>Status: ".$Status."</li>
	<li>Total de votos: <strong>".$Total[1]."</strong></li>
	<li style=\"border-bottom: 1px solid #333333;\"></li>\n";
			while($Answers = CTM_MSSQL::getInstance()->Fetch($Query))
			{
				$Votes = number_format($Answers[1], 0, false, ".");
				$Result = @ceil($Answers[1] * 100 / $Total[0]["Result"]);
				
				$Return .= "<li><strong>&raquo; ".base64_decode($Answers[0])."</strong> - Votos: <strong>{$Votes}</strong> (<strong>{$Result}%</strong>)<br /><div class=\"VotesCount\"><div class=\"PollCount\" style=\"width: {$Result}%\"></div></div></li>\n";
			}
			exit($Return);
			unset($Return);
		}
	}
	private function Vote_Poll()
	{
		$Id = (int)$_GET["id"];
		$Account = $_SESSION["Hash_Account"];
		$Answer = $_POST["Answer"];
		$Check[0] = CTM_MSSQL::getInstance()->NumQuery("SELECT * FROM dbo.CTM_WebPoll WHERE Id={$Id}");
		$Check[1] = CTM_MSSQL::getInstance()->NumQuery("SELECT * FROM dbo.CTM_WebPollAnswers WHERE Poll_ID={$Id}");
		
		if($Check[0] < 1)
		{
			$Return = "<div class=\"min-error\"> Esta enquete n&atilde;o existe.</div>";
		}
		else
		{
			$Status = CTM_MSSQL::getInstance()->FetchQuery("SELECT Status,Expiration FROM dbo.CTM_WebPoll WHERE Id={$Id}");
			$Check_Vote = CTM_MSSQL::getInstance()->NumQuery("SELECT * FROM dbo.CTM_WebPollVotes WHERE Poll_ID={$Id} and Account='".$Account."'");
			$Expiration = CTM_MSSQL::getInstance()->FetchQuery("SELECT Expiration FROM dbo.CTM_WebPollVotes WHERE Poll_ID={$Id} and Account='{$Account}'");
			
			if(empty($Answer) || empty($Id))
			{
				$Return = "<div class=\"min-warning\"> Selecione uma op&ccedil;&atilde;o.</div>";
			}
			elseif(CTM_General::getInstance()->Check_Logged(2) == TRUE)
			{
				$Return = "<div class=\"min-error\"> Para votar &eacute; preciso estar logado.</div>";
			}
			elseif(strtoupper(bin2hex($Status[0])) == "01E2" || time() >= $Status[1])
			{
				CTM_MSSQL::getInstance()->Query("UPDATE dbo.CTM_WebPoll SET Status=0x01E2 WHERE Id={$Id}");
				$Return = "<div class=\"min-error\"> Esta enquete esta fechada</div>";
			}
			elseif($Check[1] < 1)
			{
				$Return = "<div class=\"min-error\"> Esta pergunta n&atilde;o existe.</div>";
			}
			elseif(time() >= $Expiration[0])
			{
				$Time = time()+86400;
				CTM_MSSQL::getInstance()->Query("DELETE dbo.CTM_WebPollVotes WHERE Poll_ID={$Id} and Account='{$Account}'");
				CTM_MSSQL::getInstance()->Query("UPDATE dbo.CTM_WebPollAnswers SET Votes=Votes+1 WHERE Poll_ID={$Id} and Id={$Answer}");
				CTM_MSSQL::getInstance()->Query("INSERT INTO dbo.CTM_WebPollVotes (Account,Poll_ID,Expiration) VALUES ('{$Account}',{$Id},{$Time})");
				
				$Ajax = "<script>CTM_Load('?ajax=poll&cmd=results&id={$Id}', 'Vote_Computed', 'GET');</script>";
				$Return .= "<div class=\"min-success\"> Voto computado.</div>";
				$Return .= "<span id=\"Vote_Computed\">{$Ajax}</span>";
			}
			elseif($Check_Vote > 0)
			{
				$Return = "<div class=\"min-info\"> Voc&ecirc; j&aacute; votou nessa enquete.</div>";
			}
			else
			{
				$Time = time()+86400;
				CTM_MSSQL::getInstance()->Query("DELETE dbo.CTM_WebPollVotes WHERE Poll_ID={$Id} and Account='{$Account}'");
				CTM_MSSQL::getInstance()->Query("UPDATE dbo.CTM_WebPollAnswers SET Votes=Votes+1 WHERE Poll_ID={$Id} and Id={$Answer}");
				CTM_MSSQL::getInstance()->Query("INSERT INTO dbo.CTM_WebPollVotes (Account,Poll_ID,Expiration) VALUES ('{$Account}',{$Id},{$Time})");
				
				$Ajax = "<script>CTM_Load('?ajax=poll&cmd=results&id={$Id}', 'Vote_Computed', 'GET');</script>";
				$Return .= "<div class=\"min-success\"> Voto computado.</div>";
				$Return .= "<span id=\"Vote_Computed\">{$Ajax}</span>";
			}
			
			exit($Return);
			unset($Return);
		}
	}
	private function All_Poll()
	{
		$Query = CTM_MSSQL::getInstance()->Query("SELECT Question,Id FROM dbo.CTM_WebPoll ORDER BY Id DESC");
		
		$Return .= "<ul class=\"ul\">\n";
		while($Find_Poll = CTM_MSSQL::getInstance()->Fetch($Query))
		{
			$Return .= "<li><a href=\"javascript: void(EffectWeb);\" onclick=\"CTM_Load('?ajax=poll&show=".$Find_Poll[1]."','Web_Poll','GET');\">&raquo; ".base64_decode($Find_Poll[0])."</a></li>\n";
		}
		$Return .= "</ul>";
		
		exit($Return);
		unset($Return);
	}
}