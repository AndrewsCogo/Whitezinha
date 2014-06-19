<script language="javascript1.5">
function Delete_News()
{
	var Check = confirm('Atencao\r\nTem certeza que deseja deletar esta Noticia?');
	if (Check == true)
	{
		CTM_Load('?pag=paneladmin&str=EDIT_NEWS&cmd=true', 'While', 'POST',BuscaElementosForm('Manage_News'));
		return true;
	}
}
</script>
<div class="box">
<div class="header">Gerenciar Noticias</div>
	   <blockquote>
       <form name="Manage_News" id="Manage_News">
		   <strong>Noticia:</strong> <select name="Id" id="Id">
           {Notice_List}
           </select>
           <input type="button" value="Editar" onclick="CTM_Load('?pag=paneladmin&str=EDIT_NEWS','While','POST',BuscaElementosForm('Manage_News'));" />
           <input type="button" value="Deletar" onclick="Delete_News()" />
		   </form>
	</blockquote>
	<div id="While"></div>
</div>