<?php
require __DIR__.'./../Repository/Conn/Conn.php';

class User{
    
    public $name;
    public $email;
    private $id;

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
    static function loadFromDb(int $id){
    
        $table = 'test';
        $conn = new Conn();
        $userData = $conn->findById($table,$id);

        if($userData != null){
            $id = $userData['id'];
            $name = $userData['nome'];
            $email = $userData['email'];

            $user = new User($name,$email);
            $user->id = $id;

            return $user;
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

        $table = 'test';
        $conn = new Conn();

        $table = $conn->findAll($table);
        $users = [];

        foreach($table as $row){
            $users[] = User::toObject($row);
        }

        return $users;
    }

    /**
     * Converte o objeto para um Array com seus atributos
     *
     * @return void
     */
    private function toArray(){
        $array = [
            'nome' => $this->name,
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
    private static function toObject(array $array){
        $user = new User(
            $array['nome'],
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
        
        
        $table = 'test';
        $conn = new Conn();

        if($this->id == null){
            $conn->insert($table,$this->toArray());
        }else{
            $conn->updateById($table,$this->id,$this->toArray());
        }        
    }

    
}