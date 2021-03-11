<?php
class Grupo
{
    private $gru_codigo;
    private $gru_descricao;
    private $gru_ativo;
    
    public function getGru_codigo()
    {
        return $this->gru_codigo;
    }
    
    public function getGru_descricao()
    {
        return $this->gru_descricao;
    }
    
    public function getGru_ativo()
    {
        return $this->gru_ativo;
    }
    
    public function setGru_codigo($gru_codigo)
    {
        $this->gru_codigo = $gru_codigo;
    }
    
    public function setGru_descricao($gru_descricao)
    {
        $this->gru_descricao = $gru_descricao;
    }
    
    public function setGru_ativo($gru_ativo)
    {
        $this->gru_ativo = $gru_ativo;
    }
    
    public function incluir()
    {
        $conexao= Database::connect();
        $stm= $conexao->prepare("INSERT INTO grupo (gru_descricao, gru_ativo) ".
                                          "VALUES (:gru_descricao,:gru_ativo)");
        $stm->bindValue(':gru_descricao', $this->getGru_descricao());
        $stm->bindValue(':gru_ativo', $this->getGru_ativo());
        if (!$stm->execute())
            return $stm->errorInfo();
    }
    
    public function alterar()
    {
        $conexao= Database::connect();
        $stm= $conexao->prepare("UPDATE grupo SET ".
                                       "gru_descricao=:gru_descricao, ".
                                       "gru_ativo=:gru_ativo ".
                                 "WHERE gru_codigo=:gru_codigo");
        $stm->bindValue(':gru_codigo', $this->getGru_codigo());
        $stm->bindValue(':gru_descricao', $this->getGru_descricao());
        $stm->bindValue(':gru_ativo', $this->getGru_ativo());
        if (!$stm->execute())
            return $stm->errorInfo();
    }
    
    public static function listar($gru_codigo=null, $gru_descricao=null, $gru_ativo=null)
    {
        $conexao= Database::connect();
        $sql="SELECT gru_codigo, ".
                    "gru_descricao, ".
                    "gru_ativo ".
               "FROM grupo ".
              "WHERE 1 ";
        if ($gru_codigo)
            $sql.="AND gru_codigo=:gru_codigo ";
        if ($gru_descricao)
            $sql.="AND gru_descricao LIKE :gru_descricao ";
            if ($gru_ativo)
            $sql.="AND gru_ativo=:gru_ativo ";
                
        $stm= $conexao->prepare($sql);
        
        if ($gru_codigo)
            $stm->bindValue(':gru_codigo', $gru_codigo);
        if ($gru_descricao)
            $stm->bindValue(':gru_descricao', '%'.$gru_descricao.'%');
        if ($gru_ativo)
            $stm->bindValue(':gru_ativo', $gru_ativo);
                    
        if (!$stm->execute())
            return $stm->errorInfo();
            
        $grupos= array();
        while ($resultado= $stm->fetch(PDO::FETCH_ASSOC))
        {
            $grupos[]= array("gru_codigo" => $resultado['gru_codigo'],
                          "gru_descricao" => $resultado['gru_descricao'],
                              "gru_ativo" => $resultado['gru_ativo'],);
        }
        return $grupos;
    }
    
}
