<?php

namespace App\DataFixtures;

use App\Entity\Burger;
use App\Entity\Pain;
use App\Entity\Oignon;
use App\Entity\Sauce;
use App\Entity\Commentaire;
use App\Entity\Image;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        // 25 Pains
        $pains = [];
        for ($i = 0; $i < 25; $i++) {
            $pain = new Pain();
            $pain->setName($faker->word() . ' Pain');
            $manager->persist($pain);
            $pains[] = $pain;
        }

        // 25 Oignons
        $oignons = [];
        for ($i = 0; $i < 25; $i++) {
            $oignon = new Oignon();
            $oignon->setName($faker->word() . ' Oignon');
            $manager->persist($oignon);
            $oignons[] = $oignon;
        }

        // 25 Sauces
        $sauces = [];
        for ($i = 0; $i < 25; $i++) {
            $sauce = new Sauce();
            $sauce->setName($faker->word() . ' Sauce');
            $manager->persist($sauce);
            $sauces[] = $sauce;
        }

        // 25 Commentaires
        $commentaires = [];
        for ($i = 0; $i < 25; $i++) {
            $commentaire = new Commentaire();
            $commentaire->setName($faker->sentence(3));
            $manager->persist($commentaire);
            $commentaires[] = $commentaire;
        }

        // 25 Images
        $images = [];
        for ($i = 0; $i < 25; $i++) {
            $image = new Image();
            $image->setName("https://ffcuisine.fr/wp-content/uploads/2024/11/115370_recette-facile-dassiette-kebab-maison-savourez-le-gout-authentique.jpg");
            $manager->persist($image);
            $images[] = $image;
        }

        // 25 Burgers
        for ($i = 0; $i < 25; $i++) {
            $burger = new Burger();
            $burger->setName($faker->word() . ' Burger');
            $burger->setPrice($faker->randomFloat(2, 4, 15));

            // On associe un pain, un oignon, une sauce, un commentaire et une image aléatoires
            $burger->setPain($pains[array_rand($pains)]);
            $burger->addOignon($oignons[array_rand($oignons)]);
            $burger->addSauce($sauces[array_rand($sauces)]);
            $burger->addCommentaire($commentaires[array_rand($commentaires)]);
            $burger->addImage($images[array_rand($images)]);

            $manager->persist($burger);
        }

        $manager->flush();
    }
}
