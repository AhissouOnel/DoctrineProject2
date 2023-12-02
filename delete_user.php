<?php

use App\Entity\User;

require_once "bootstrap.php";

$id = $argv[1];

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

$entityManager->remove($user);
$entityManager->flush();

echo sprintf("-%s\n", $user->getFullName());
