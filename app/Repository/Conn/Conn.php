<?php

/**
 * Interface de conexao com o banco de dados
 * 
 * Padrões Factory e Active Record
 * 
 * @author Gustavo Bueno <gbueno360@gmail.com>
 */
class Conn{

    private $servername;
    private $dbName;
    private $username;
    private $password;

    /**
     * Inicializa o objeto com as Configurações de conexão padrão
     */
    public function __construct()
    {
        $this->setDefaultConfig();
    }

    /**
     * Define configurações padrão de configuração do banco
     *
     * @return void
     */
    private function setDefaultConfig(){
        $this->servername = 'localhost';
        $this->dbName = 'interagir';
        $this->username = 'root';
        $this->password = '';
    }

    /**
     * Configura atributos da string de conexao com o banco de dados MySql
     *
     * @param String $servername
     * @param String $dbName
     * @param String $username
     * @param String $password
     * @return void
     */
    public function setConnectionConfig($servername,$dbName,$username,$password){
        $this->servername = $servername;
        $this->dbName = $dbName;
        $this->username = $username;
        $this->password = $password;
    }
    
    /**
     * Retorna um objeto de conexao PDO com os dados atribuidos a Conexao
     *  
     * #Factory
     * 
     * @return void
     */
    private function getConnection(){
        
        try {
            $conn = new PDO("mysql:host=$this->servername;dbname=$this->dbName", $this->username, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
        catch(PDOException $e)
            {
            echo "Connection failed: " . $e->getMessage();
            }
        finally{
            return $conn;
        }
    }

    /**
     * Insere um conjunto de dados na tabela especificada
     * a partir de um Array $data['coluna'=>'valor']
     *
     * @param string $table
     * @param array $data
     * @return boolean
     */
    public function insert(string $table,array $data){
        $conn = $this->getConnection();
        
        $fields = implode(",",array_keys($data));
        $values = ":" . implode(",:",array_keys($data));
        //$values = "'" . implode("', '",$data)."'";

        $sql = "INSERT INTO  $table ($fields) values($values)";
    
        echo $sql;

        try{
            $stmt = $conn->prepare($sql);
            $stmt->execute($data);
        }catch(PDOException $e){
            echo "Insert Failed! <br>" . $e->getMessage();
            return false;
        }finally{
            $conn = null;
            return true;
        }
    }
 
    /**
     * Atualiza um registro de determinado id
     * pelos valores informados
     *
     * @param string $table
     * @param int $id
     * @param array $data
     * @return boolean
     */
    public function updateById($table,$id,$data){
        $conn = $this->getConnection();
        
        $set = [];
        foreach($data as $key => $value){
            $set[] = $key . ' = :' . $key;
        }
        $set = implode(', ', $set);

        $sql = "UPDATE $table
                SET $set
                WHERE id = $id";
                
        try{
            $stmt = $conn->prepare($sql);
            $stmt->execute($data);    
        }catch(PDOException $e){
            echo "Error Updating Record: " . $e->getMessage();
            return false;
        }finally{
            return true;
        }
    }
    /**
     * Encontra em determinada tabela os dados de uma entidade 
     * a partir de um id
     *
     * @param string $table
     * @param integer $id
     * @return array
     */
    public function findById(string $table,int $id){

        $sql = "SELECT * FROM $table WHERE id = $id";

        try {
            $conn = $this->getConnection();
            $stmt = $conn->prepare($sql); 
            $stmt->execute();
            // set the resulting array to associative
             $stmt->setFetchMode(PDO::FETCH_ASSOC);  
            
        }catch(PDOException $e){
            echo "Find Error <br>" . $e->getMessage();
        }finally{
            return $stmt;
        }
    }

    /**
     * Lista todos os dados de uma determinada tabela
     *
     * @param string $table
     * @return array
     */
    public function findAll(string $table){
        $sql = "SELECT * FROM $table";

        try {
            $conn = $this->getConnection();
            $stmt = $conn->prepare($sql); 
            $stmt->execute();
            // set the resulting array to associative
            $stmt->setFetchMode(PDO::FETCH_ASSOC);  
            
        }catch(PDOException $e){
            echo "Find Error <br>" . $e->getMessage();
        }finally{
            return $stmt;
        }
    }


    /**
     * Deleta um registro na tabela com determinado id
     *
     * @param string $table
     * @param integer $id
     * @return boolean
     */
    public function deleteById(string $table, int $id){
        $sql = "DELETE FROM $table WHERE id = $id";

        try{
            $conn = $this->getConnection();
            $conn->exec($sql);
        }catch(PDOException $e){
            echo"DELETE Error".$e->getMessage();
            return false;
        }finally{
            return true;
        }
    }
}