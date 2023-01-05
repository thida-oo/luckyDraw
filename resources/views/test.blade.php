<?php 
$id = 183598; // id to search for
$distributors = array_column($superiors, 'distributor_name', 'id'); // create an array with id as keys and distributor_name as values

if (array_key_exists($id, $distributors)) {
  // id was found
  $distributor_name = $distributors[$id];
  echo "Distributor name for id $id is: $distributor_name";
} else {
  // id was not found
  echo "No distributor found for id $id";
}
 ?>