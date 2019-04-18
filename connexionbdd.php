<?php
function connexionbdd($nombd, $user, $password){
  $connect=pg_connect("host=localhost port=5432 dbname=$nombd user=$user password=$password") or die('Connection failed');
  return $connect;
}
?>
