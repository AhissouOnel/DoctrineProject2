<?php

use App\Entity\User;
use App\Entity\Address;

require_once "bootstrap.php";

$full_name = $argv[1];
$email = $argv[2];
$role = $argv[3];

/*for ($i=1; $i < 30; $i++) { 
    $user = (new User())->setFullName("Full Name".$i)
                    ->setEmail("email".$i."@mudey.fr")
                    ->setRole("user");

    $entityManager->persist($user);                
}*/


$addresses = (new Address())->setStreet("25 rue de la marina")
                          ->setCity("Cotonou")
                          ->setCountry("Benin");
//$entityManager->persist($addresses); 
  
$user = (new User())->setFullName($full_name)
                    ->setEmail($email)
                    ->setRole($role)
                    ->setAddress($addresses);


$entityManager->persist($user);  

$entityManager->flush();

//echo "Create User with ID".$user->getId()."\n";