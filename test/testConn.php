<?php

require './app/Repository/Conn/Conn.php';

$conn = new Conn();

 $table = 'test';

//   $data = [
//       'nome'=>'Luana',
//       'email'=>'luana@aksdjhf.com'
//   ];

// $conn->insert($table,$data);

echo '<br>'.$conn->updateById($table,1,[
    'nome'=>'Gustavo',
    'email'=>'gbueno@seuJorge.com'
]);

$users = $conn->findAll($table);



 echo "<table><tr><th>id</th><th>nome</th><th>email</th></tr>";
 foreach($users as $line){
     echo '<tr>';
     foreach($line as $row){
         echo "<td>"."$row"."</td>";
     }
     echo '</tr>';
 }
 echo "</table>";