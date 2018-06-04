<?php
require_once __DIR__.'./../Repository/Conn/Conn.php';
require_once __DIR__.'./../Repository/Conn/Config.php';
require_once __DIR__.'/Model.php';

/**
 * Modelo de usuário 
 * 
 * @property string $name
 * @property string $email
 * @property int $id
 *  
 */

class User implements Model{
    
    
    /**
     * Tabela no BD referente ao objeto User
     */
    private const table = 'user';

    public $name;
    public $email;
    public $id;

    public function __construct(string $name,string $email)
    {   
        $this->name = $name;
        $this->email = $email;
        $this->id = null;
    }
    
    public function getId(){
        return $this->id;
    }
    /**
     * Carrega dados do objeto a partir de um banco de dados
     *
     * @param integer $id
     * @return User
     */
    public static function load(int $id){
    
        $table = self::table;
        $conn = new Conn();
        $userData = $conn->findById($table,$id);

        if($userData != null){
            return User::toObject($userData);
        }else{
            echo 'Esse objeto nao existe';
            return null;
        }
    }

    /**
     * Carrega todos os usuarios do banco para uma lista de users
     *
     * @return array[User]
     */
    public static function loadAll(){

        $table = self::table;
        $conn = new Conn();

        $data = $conn->findAll($table);
        $users = [];

        foreach($data as $row){
            $users[] = User::toObject($row);
        }
        
        return $users;
    }
    
    /**
     * Converte o objeto para um Array com seus atributos
     *
     * @return void
     */
    public function toArray(){
        $array = [
            'name' => $this->name,
            'email' => $this->email,
            'id' => $this->id
        ];
        return $array;
    }
    /**
     * Converte um Array para um objeto User
     *
     * @param array $array
     * @return User
     */
    public static function toObject(array $array){
        $user = new User(
            $array['name'],
            $array['email']
        );
        $user->id = $array['id'];
        return $user;
    }
    
    /**
     * Salva o objeto no banco de dados
     * ou atualiza se o mesmo id ja existir
     *
     * @return void
     */
    public function save(){
        
        $table = self::table;
        $conn = new Conn();

        if($this->id == null){
            $conn->insert($table,$this->toArray());
        }else{
            $conn->updateById($table,$this->id,$this->toArray());
        }        
    }

    /**
     * Deleta usuário
     *
     * @return boolean
     */
    public function delete(){
        $table = self::table;
        $conn = new Conn();

        return $conn->deleteById($table,$this->id);
    }
    
}