<?php 
class Usuario
{
    private $usu_login;
    private $usu_nome;
    private $Usu_email;
    private $usu_senha;
    private $gru_codigo;
    private $usu_data_atualizacao;
    private $usu_ativo;
    
    public function getUsu_login()
    {
        return $this->usu_login;
    }

    public function getUsu_nome()
    {
        return $this->usu_nome;
    }

    public function getUsu_email()
    {
        return $this->Usu_email;
    }

    public function getUsu_senha()
    {
        return $this->usu_senha;
    }

    public function getGru_codigo()
    {
        return $this->gru_codigo;
    }

    public function getUsu_ativo()
    {
        return $this->usu_ativo;
    }

    public function setUsu_login($usu_login)
    {
        $this->usu_login = $usu_login;
    }

    public function setUsu_nome($usu_nome)
    {
        $this->usu_nome = $usu_nome;
    }

    public function setUsu_email($Usu_email)
    {
        $this->Usu_email = $Usu_email;
    }

    public function setUsu_senha($usu_senha)
    {
        $this->usu_senha = $usu_senha;
    }

    public function setGru_codigo($gru_codigo)
    {
        $this->gru_codigo = $gru_codigo;
    }

    public function setUsu_ativo($usu_ativo)
    {
        $this->usu_ativo = $usu_ativo;
    }
    
    public function getUsu_data_atualizacao()
    {
        return $this->usu_data_atualizacao;
    }

    public function setUsu_data_atualizacao($usu_data_atualizacao)
    {
        $this->usu_data_atualizacao = $usu_data_atualizacao;
    }

    public function incluir()
    {
    	$conexao = Database::connect();
    	$stm = $conexao->prepare("INSERT INTO usuario (usu_login, usu_nome, usu_email, usu_senha, gru_codigo, usu_data_atualizacao, usu_ativo) ".
    						                 "VALUES (:usu_login,:usu_nome,:usu_email,:usu_senha,:gru_codigo,:usu_data_atualizacao,:usu_ativo) ");
    	$stm->bindValue(':usu_login', $this->getUsu_login());
		$stm->bindValue(':usu_nome', $this->getUsu_nome());
		$stm->bindValue(':usu_email', $this->getUsu_email());
		$stm->bindValue(':usu_senha', $this->getUsu_senha());
		$stm->bindValue(':gru_codigo', $this->getGru_codigo());
		$stm->bindValue(':usu_data_atualizacao', $this->getUsu_data_atualizacao());
		$stm->bindValue(':usu_ativo', $this->getusu_ativo());
		if (!$stm->execute())
			return $stm->errorInfo();
    }

    public function alterar()
    {
    	$conexao = Database::connect();
    	$stm = $conexao->prepare("UPDATE usuario SET ".
	                                    "usu_nome=:usu_nome, ". 
                                	    "usu_email=:usu_email, ".
                                	    "usu_senha=:usu_senha, ". 
    	                                "gru_codigo=:gru_codigo, ".
                                	    "usu_data_atualizacao=:usu_data_atualizacao, ".
                                	    "usu_ativo=:usu_ativo ".
	                              "WHERE usu_login=:usu_login");
        $stm->bindValue(':usu_nome', $this->getUsu_nome());
        $stm->bindValue(':usu_email', $this->getUsu_email());
        $stm->bindValue(':usu_senha', $this->getUsu_senha());
        $stm->bindValue(':gru_codigo', $this->getGru_codigo());
        $stm->bindValue(':usu_data_atualizacao', $this->getUsu_data_atualizacao());
        $stm->bindValue(':usu_ativo', $this->getUsu_ativo());
        $stm->bindValue(':usu_login', $this->getUsu_login());
        if (!$stm->execute())
            return $stm->errorInfo();

    }

    public static function listar($login=null, $nome=null, $ativo=null) {
        $conexao = Database::connect();
    	$sql = "SELECT usu_login, ".
    				  "usu_nome, ".                   
                      "usu_email, ".
                      "usu_data_atualizacao, ".
                      "U.gru_codigo, ".
                      "gru_descricao, ".
                      "usu_ativo ".
                 "FROM usuario as U, grupo as G ".
                "WHERE U.gru_codigo = G.gru_codigo ";
        if ($login)
            $sql.="AND usu_login=:usu_login ";
        if ($nome)
            $sql.="AND usu_nome LIKE :usu_nome ";
        if ($ativo)
            $sql.="AND usu_ativo=:usu_ativo ";

        $stm= $conexao->prepare($sql);
                    
        if ($login)
            $stm->bindValue(':usu_login', $login);
        if ($nome)
            $stm->bindValue(':usu_nome', '%'.$nome.'%');
        if ($ativo)
            $stm->bindValue(':usu_ativo', $ativo);

        if (!$stm->execute())
            return $stm->errorInfo();  

        $usuarios = array();
        while ($resultado= $stm->fetch(PDO::FETCH_ASSOC)){
            $usuarios[]= array("usu_login" => $resultado['usu_login'],
                                "usu_nome" => $resultado['usu_nome'],
                               "usu_email" => $resultado['usu_email'],
                              "gru_codigo" => $resultado['gru_codigo'],
                           "gru_descricao" => $resultado['gru_descricao'],
                    "usu_data_atualizacao" => $resultado['usu_data_atualizacao'],
                               "usu_ativo" => $resultado['usu_ativo']);
        }
        return $usuarios;
    }
    
}
