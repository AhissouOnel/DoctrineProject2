<?php

use App\Entity\User;
use App\Entity\Address;

require_once "bootstrap.php";

$id = $argv[1];

$addRepo = $entityManager->getRepository(Address::class);

// find => récupère une entité grâce à sa clé primaire
// findAll => récupère toutes les entités
// findBy => récupère une liste d'entités selon un ensemble de critères
// findOneBy => récupère une entité selon un ensemble de critères 

$add = $addRepo->find($id);

if (!$add) {
    echo "No address found.\n";
    exit(1);
}

var_dump($add);
//echo sprintf("-%s\n", $add->getStreet());
