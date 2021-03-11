<?php	
require_once '..\cabecalho_geral.php';
require_once 'cabecalho.php';
    
$usu_nome= isset($_POST['usu_nome'])?$_POST['usu_nome']:null;
$usu_ativo= isset($_POST['usu_ativo'])?$_POST['usu_ativo']:null;
$resultado= Usuario::listar(null, $usu_nome, $usu_ativo);
?>

<div class="container-fluid">
	<div class="row">
		<div class="col-xl-10 col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<form method='POST'>

			<div class="mb-4">
				<div><h4>Listar</h4><hr /></div>
			</div>
			
			<div class="row mb-2">	
        		<div class="col-xl-1 col-lg-1 col-md-1 col-sm-1 col-xs-1">
        			<label for="usu_nome">Usuário</label>
        		</div>
        		<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-1">
        			<input type='text' name='usu_nome' id='usu_nome' value='<?= $usu_nome ?>' class="form-control">
        		</div>
    		</div>		

    		<div class="row mb-2">
        		<div class="col-xl-1 col-lg-1 col-md-1 col-sm-1 col-xs-1">
	        		<label for="usu_ativo" id='usu_ativo'>Ativo</label>
	        	</div>	
    	    	<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-xs-1">
            		<select name='usu_ativo' class="form-control">
            			<option value='' <?php if ($usu_ativo=='') echo 'SELECTED'; ?>></option>
            			<option value='S' <?php if ($usu_ativo=='S') echo 'SELECTED'; ?>>Sim</option>
            			<option value='N' <?php if ($usu_ativo=='N') echo 'SELECTED'; ?>>Não</option>
            		</select>
            	</div>	
        		<div class="col-2 mb-2">
        			<button  type='submit' name='Pesquisar' value='Pesquisar' class="btn btn-dark">Pesquisar</button>
        		</div>
    		</div>
			</form>
		</div>            
			
        <table class="table table-hover table-bordered">
        	<thead>
        	<tr class='thead-dark'>
        		<th>Login</th>
        		<th>Nome</th>        		
        		<th>E-mail</th>        		        		
        		<th>Grupo</th>        		        		
        		<th>Atualização</th>        		        		
        		<th style="width:60px">Ativo</th>        		
        		<th style="width:60px">Ação</th>        		
        	</tr>
        	</thead>
        	
        	<tbody>
        	<?php foreach($resultado as $chave): ?>
        	<tr>
        		<td><?= $chave["usu_login"] ?></td>
        		<td><?= $chave["usu_nome"] ?></td>
        		<td><?= $chave["usu_email"] ?></td>
        		<td><?= $chave["gru_descricao"] ?></td>
        		<td><?= date('d/m/Y', strtotime($chave["usu_data_atualizacao"])) ?></td>
        		<td><?= $chave["usu_ativo"] ?></td>
        		<td><a href='alterar.php?login=<?= $chave["usu_login"] ?>'><img src="../../img/editar.png" width="20" title="Alterar" /></a></td>
        	</tr>
        	<?php endforeach; ?>
        	</tbody>	
        </table>
	</div>
</div>

<?php require_once '..\rodape_geral.php'; 
