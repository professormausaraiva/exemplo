<?php	
require_once '..\cabecalho_geral.php';
require_once 'cabecalho.php';

$gru_descricao= isset($_POST['gru_descricao'])?$_POST['gru_descricao']:null;
$gru_ativo= isset($_POST['gru_ativo'])?$_POST['gru_ativo']:null;
$resultado= Grupo::listar(null, $gru_descricao, $gru_ativo);
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
        			<label for="gru_descricao">Descrição&nbsp;</label>
        		</div>
        		<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-1">
        			<input type='text' name='gru_descricao' id='gru_descricao' value='<?= $gru_descricao ?>' class="form-control">
        		</div>
    		</div>		

    		<div class="row mb-2">
        		<div class="col-xl-1 col-lg-1 col-md-1 col-sm-1 col-xs-1">
	        		<label for="gru_ativo">Ativo</label>
	        	</div>	
    	    	<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-xs-1">
            		<select name='gru_ativo' id='gru_ativo' class="form-control">
            			<option value='' <?php if ($gru_ativo=='') echo 'SELECTED'; ?>></option>
            			<option value='S' <?php if ($gru_ativo=='S') echo 'SELECTED'; ?>>Sim</option>
            			<option value='N' <?php if ($gru_ativo=='N') echo 'SELECTED'; ?>>Não</option>
            		</select>
            	</div>	
        		<div class="col-2 mb-2">
        			<button  type='submit' name='Pesquisar' value='Pesquisar' class="btn btn-dark">Pesquisar</button>
        		</div>
    		</div>
			</form>
		</div>	

        <table class="table table-striped table-hover table-bordered">
        	<thead>
        	<tr class='thead-dark'>
        		<th>Descrição</th>
        		<th style="width:70px">Ativo</th>
        		<th style="width:60px">Ação</th>        		
        	</tr>
        	</thead>
        	
        	<tbody>
        	<?php foreach($resultado as $chave): ?>
        	<tr>
        		<td><?= $chave["gru_descricao"] ?></td>
        		<td><?= $chave["gru_ativo"] ?></td>
        		<td><a href='alterar.php?codigo=<?= $chave["gru_codigo"] ?>'><img src="../../img/editar.png" width="20" title="Alterar" /></a></td>
        	</tr>
        	<?php endforeach; ?>
        	</tbody>	
        </table>
	</div>
</div>

<?php require_once '..\rodape_geral.php'; 
