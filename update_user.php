<?php

use App\Entity\User;
use App\Entity\Address;

require_once "bootstrap.php";

$id = $argv[1];
//$new_full_name = $argv[2];
//$new_email = $argv[3];

$userRepo = $entityManager->getRepository(User::class);

// find => récupère une entité grâce à sa clé primaire
// findAll => récupère toutes les entités
// findBy => récupère une liste d'entités selon un ensemble de critères
// findOneBy => récupère une entité selon un ensemble de critères 

$user = $userRepo->find($id);

if (!$user) {
    echo "No user found.\n";
    exit(1);
}

$address = (new Address())->setStreet("05 rue de l'étoile")
                          ->setCity("Cotonou")
                          ->setCountry("Benin");
                       
$entityManager->persist($address);    
$user->setAddress($address);
$entityManager->persist($user);                        
//$user->setFullName($new_full_name);
//$user->setEmail($new_email);

$entityManager->flush();

echo sprintf("-%s\n", $user->getFullName());
