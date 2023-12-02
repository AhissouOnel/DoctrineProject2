<?php
use App\Entity\User;
use App\Entity\Address;
use App\Entity\Article;
use App\Entity\Category;
use App\Entity\Comment;
require_once "bootstrap.php";


$faker = Faker\Factory::create();
$users = [];
for ($i=0; $i < 100; $i++) { 
    $address = (new Address())->setStreet($faker->streetAddress())
                              ->setCity($faker->city())
                              ->setCountry($faker->country());
    $user = (new User())->setFullName($faker->name())
                        ->setEmail($faker->email())
                        ->setAddress($address);
    $entityManager->persist($user);
    $users[] = $user;
}

$categories = [
    (new Category())->setName("Sport")->setDescription($faker->text())->setImageUrl($faker->imageUrl(360, 360, 'animals', true, 'cats')),
    (new Category())->setName("Actualité")->setDescription($faker->text())->setImageUrl($faker->imageUrl(360, 360, 'animals', true, 'cats')),
    (new Category())->setName("Politique")->setDescription($faker->text())->setImageUrl($faker->imageUrl(360, 360, 'animals', true, 'cats')),
    (new Category())->setName("Education")->setDescription($faker->text())->setImageUrl($faker->imageUrl(360, 360, 'animals', true, 'cats')),
    (new Category())->setName("Divers")->setDescription($faker->text())->setImageUrl($faker->imageUrl(360, 360, 'animals', true, 'cats')),
    (new Category())->setName("Opération spéciale")->setDescription($faker->text())->setImageUrl($faker->imageUrl(360, 360, 'animals', true, 'cats'))
];

foreach ($categories as $category) {
    $entityManager->persist($category);
}

$entityManager->flush();

for ($i=0; $i < 300; $i++) { 
    $article = (new Article())->setTitle($faker->text($maxNbChars = 60, $indexSize = 6))
                              ->setContent($faker->text( $minNbChars = 1000, $maxNbChars = 3000, $indexSize = 6))
                              ->setAuthor($users[rand(0,99)])
                              ->setImageUrl($faker->imageUrl(360, 360, 'animals', true, 'cats'))
                              ->addCategory($categories[rand(0,5)]);

    $entityManager->persist($article);
    $articles[] = $article;
}

for ($i=0; $i < 300; $i++) { 
    for ($j=0; $j < rand(2, 10); $j++) { 
        $comment = (new Comment())->setContent($faker->text($maxNbChars = 200, $indexSize = 6))
                                ->setAuthor($users[rand(0, 99)])
                                ->addArticle($articles[$i]);
        $entityManager->persist($comment);                          
    }
}

$entityManager->flush();