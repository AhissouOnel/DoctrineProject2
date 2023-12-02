<?php
use App\Entity\User;
require_once "bootstrap.php";


$id = $argv[1];
$full_name = $argv[2];
$qb = $em->createQueryBuilder();


//Récupération d'une information de la base données
//$qb->select("u") //Select All (SELECT *)
//   ->from(User::class, "u")
//   ->where("u.full_name = :full_name")
//   ->setParameter(":full_name", "Ms. Vella Schmeler")
//;
//$qb->select("user") //Select All (SELECT *)
//   ->from(User::class, "user")
//   ->where("user.id = :id")
//   ->setParameter(":id", 3)
//;

//Suppression de données
//$qb->delete(User::class, "u")
//   ->where("u.id = :id")
//   ->setParameter(":id", $id)
//;

//Récupération de plusieurs données
//$qb->select("user") //Select All (SELECT *)
//   ->from(User::class, "user")
//   ->where("user.full_name = :full_name")
//   ->andwhere("user.email = :email")
//   ->setParameter(":full_name", "Lindsey Cartwright")
//   ->setParameter(":email", "gswift@hotmail.com")
//;
//$qb->select("user") //Select All (SELECT *)
//   ->from(User::class, "user")
//   ->where("user.id IN (:ids)")
//   ->setParameter(":ids", [3,8,9])
//;


//Modification de données
$qb->update(User::class, "user")
   ->set("user.full_name", "?1")
   ->where("user.id = ?2")
   ->setParameter(1, $full_name)
   ->setParameter(2, $id)
;



$query = $qb->getQuery(); 

//DQL : Doctrine Query Language
echo $query->getDQL()."\n";
echo $query->execute();

//$users = $query->getResult();
//foreach ($users as $user) {
//    $result[] = $user->getFullName();
//}
//var_dump($result);

//$users = $query->getOneOrNullResult();->récupération
//echo $users->getFullName();