<div id="modal1" class="modal">
	<div class="modal-content">
		<h4>Deletar Arquivo</h4>
		<p>Deseja realmente excluir?</p>
	</div>
	<div class="modal-footer">
		<form method="post">
			<a href="../../editSolucaoControversia/<?php echo $_GET['id'];?>"
				class="modal-action modal-close waves-effect btn-flat red">Não</a>
			<button name="del" class="modal-action waves-effect btn-flat green">Sim</button>
		</form>
	</div>
</div>