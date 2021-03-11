<?php
require_once '..\cabecalho_geral.php';
require_once 'cabecalho.php';
$mensagem= "";

if (isset($_POST['Salvar'])) {
    $usu_login= isset($_POST['usu_login'])?$_POST['usu_login']:null;
    $usu_nome = isset($_POST['usu_nome']) ? $_POST['usu_nome'] : null;
    $usu_email = isset($_POST['usu_email']) ? $_POST['usu_email'] : null;
    $usu_senha = isset($_POST['usu_senha']) ? $_POST['usu_senha'] : null;
    $usu_senha_conf = isset($_POST['usu_senha_conf']) ? $_POST['usu_senha_conf'] : null;
    $usu_data_atualizacao = isset($_POST['usu_data_atualizacao']) ? $_POST['usu_data_atualizacao'] : null;
    $gru_codigo = isset($_POST['gru_codigo']) ? $_POST['gru_codigo'] : null;
    $usu_ativo = isset($_POST['usu_ativo']) ? $_POST['usu_ativo'] : null;
    
    if ($usu_senha != $usu_senha_conf) {
        $mensagem= "Erro: a senha não está igual a confirmação da senha.";
    } else {
        $usuario = new Usuario();
        $usuario->setUsu_login($usu_login);
        $usuario->setUsu_nome($usu_nome);
        $usuario->setUsu_email($usu_email);
        $usuario->setUsu_senha($usu_senha);
        $usuario->setUsu_data_atualizacao($usu_data_atualizacao);
        $usuario->setGru_codigo($gru_codigo);
        $usuario->setUsu_ativo($usu_ativo);
        $resultado= $usuario->alterar();
        
        if (is_array($resultado))
            $mensagem= "Erro: ".$resultado[0].$resultado[2];
            else
                header('location: listar.php');
    }
}

$login= isset($_GET['login'])?$_GET['login']:null;
$resultado= Usuario::listar($login);

$usu_login= isset($resultado[0]["usu_login"])?$resultado[0]["usu_login"]:null;
$usu_nome= isset($resultado[0]["usu_nome"])?$resultado[0]["usu_nome"]:null;
$usu_email= isset($resultado[0]["usu_email"])?$resultado[0]["usu_email"]:null;
$usu_data_atualizacao= isset($resultado[0]["usu_data_atualizacao"])?$resultado[0]["usu_data_atualizacao"]:null;
$gru_codigo= isset($resultado[0]["gru_codigo"])?$resultado[0]["gru_codigo"]:null;
$usu_ativo= isset($resultado[0]["usu_ativo"])?$resultado[0]["usu_ativo"]:null;
$usu_senha= "";
$usu_senha_conf= "";

$temp= new DateTime($usu_data_atualizacao);
$usu_data_atualizacao= $temp->format('Y-m-d');

$grupos= Grupo::listar(null, null, 'S');
?>

<div class="container-fluid">
	<div class="row">
		<div class="col-md-10 order-md-1">

    		<div class="mb-4">
    			<h4>Alterar</h4><hr />
    		</div>
    	
    		<form method='POST'>
    		            
           		<div class="row mb-2">
               		<div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-xs-1">
                    	<label for="usu_login">Login</label>
                    </div>
          	    	<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-xs-1">
        	            <input type='text' name='usu_login' id='usu_login' value='<?= $usu_login ?>' class="form-control" required='required' readonly>
        	        </div>            
                </div>
        
           		<div class="row mb-2">
               		<div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-xs-1">
        	            <label for="usu_nome">Nome</label>
                    </div>
          	    	<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-1">
        	            <input type='text' name='usu_nome' id='usu_nome' value='<?= $usu_nome ?>' class="form-control" required='required'>
        	        </div>    
                </div>
        
           		<div class="row mb-2">
               		<div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-xs-1">
        	            <label for="usu_email">E-mail</label>
                    </div>
          	    	<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-1">
        	            <input type='email' name='usu_email' id='usu_email' value='<?= $usu_email ?>' class="form-control" required='required'>
        	        </div>    
                </div>
        
           		<div class="row mb-2">
               		<div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-xs-1">
        				<label for="usu_senha">Senha</label>
                    </div>
          	    	<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-1">
        				<input type='password' name='usu_senha' value='<?= $usu_senha ?>' class="form-control" required='required'>
        			</div>
        		</div>
        
           		<div class="row mb-2">
               		<div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-xs-1">
        				<label for="usu_senha_conf">Confirme a senha</label>
                    </div>
          	    	<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-1">
        				<input type='password' name='usu_senha_conf' value='<?= $usu_senha ?>' class="form-control" required='required'>
        			</div>
        		</div>
        
        		<div class="row mb-2">
            		<div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-xs-1">
            			<label for="gru_codigo">Grupo</label>
            		</div>
        	    	<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-1">
                		<select name='gru_codigo' id='gru_codigo' class="form-control" required='required'>
                			<option value='' <?php if ($gru_codigo=='') echo 'SELECTED'; ?>></option>
            		      	<?php foreach($grupos as $chave): ?>
                			<option value='<?= $chave["gru_codigo"] ?>' <?php if ($gru_codigo==$chave["gru_codigo"]) echo 'SELECTED'; ?>><?= $chave["gru_descricao"]?></option>
            	        	<?php endforeach; ?>
                		</select>
        			</div>
        		</div>	
        
        		<div class="row mb-2">
            		<div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-xs-1">
        				<label for="usu_data_atualizacao">Data de atualização</label>
            		</div>
            		<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-xs-1">
        				<input type='date' name='usu_data_atualizacao' id='usu_data_atualizacao' value='<?= $usu_data_atualizacao ?>' min='<?= date("Y-m-d") ?>' class="form-control" required='required'>
        			</div>
        		</div>
        
                <div class="row mb-2">
                      <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-xs-1">
                      <label for="usu_ativo">Ativo</label>
                        </div>
                      <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-xs-1">
                        <select name='usu_ativo' id='usu_ativo' class="form-control">
                          <option value='S' <?php if ($usu_ativo=='S') echo 'SELECTED'; ?>>Sim</option>
                          <option value='N' <?php if ($usu_ativo=='N') echo 'SELECTED'; ?>>Não</option>
                        </select>
                  </div>
                </div>  
        
        		<div class='alert-danger' id='mensagem'>
        			<?= $mensagem ?>
        		</div>
        	
        		<div class="row">
            		<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-xs-4 mb-2">
            			<button  type='submit' name='Salvar' value='Salvar' class="btn btn-dark">Salvar</button>
        				<button class="btn btn-dark" type="button" onclick='javascript:location.href="listar.php";'>Cancelar</button>
        			</div>
        		</div>
    		
    		</form>
		</div>
	</div>
</div>

<?php require_once '..\rodape_geral.php'; 
