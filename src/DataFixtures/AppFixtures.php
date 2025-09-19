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
        $faker = Factory::create('fr_FR');

        // Création de 25 Pains
        $pains = [];
        for ($i = 0; $i < 25; $i++) {
            $pain = new Pain();
            $pain->setName($faker->randomElement(['Bun', 'Brioche', 'Complet', 'Sésame', 'Céréales']) . ' Pain #' . ($i + 1));
            $manager->persist($pain);
            $pains[] = $pain;
        }

        // Création de 25 Oignons
        $oignons = [];
        for ($i = 0; $i < 25; $i++) {
            $oignon = new Oignon();
            $oignon->setName($faker->randomElement(['Rouge', 'Blanc', 'Caramélisé', 'Frit', 'Grillé']) . ' Oignon #' . ($i + 1));
            $manager->persist($oignon);
            $oignons[] = $oignon;
        }

        // Création de 25 Sauces
        $sauces = [];
        for ($i = 0; $i < 25; $i++) {
            $sauce = new Sauce();
            $sauce->setName($faker->randomElement(['Ketchup', 'Mayonnaise', 'Moutarde', 'BBQ', 'Algérienne', 'Harissa', 'Biggy']) . ' Sauce #' . ($i + 1));
            $manager->persist($sauce);
            $sauces[] = $sauce;
        }

        $images = [];
        $imageUrls = [
            "https://ffcuisine.fr/wp-content/uploads/2024/11/115370_recette-facile-dassiette-kebab-maison-savourez-le-gout-authentique.jpg",
            "https://api.cloudly.space/resize/cropratio/640/640/75/aHR0cHM6Ly9jZHQ0MC5tZWRpYS50b3VyaW5zb2Z0LmV1L3VwbG9hZC9idXJnZXIta2luZy0tMi5qcGc=/image.webp",
            "https://img.uniform.global/p/8SI7cDY5Qj2eFfEwrkueow/vO06hmdmTwaQBe7TdBvz5Q-480-x-388-px.png",
            "https://i-mom.unimedias.fr/2020/09/16/le-pate-de-crabe-de-bob-l-eponge.jpg?auto=format%2Ccompress&crop=faces&cs=tinysrgb&fit=crop&h=501&w=890"
        ];

        for ($i = 0; $i < 25; $i++) {
            $image = new Image();
            $image->setName($imageUrls[array_rand($imageUrls)]);
            $manager->persist($image);
            $images[] = $image;
        }

        $manager->flush();

        $burgers = [];
        for ($i = 0; $i < 25; $i++) {
            $burger = new Burger();
            $burger->setName($faker->randomElement(['Classic', 'Cheese', 'BBQ', 'Chicken', 'Veggie', 'Double', 'Deluxe']) . ' Burger #' . ($i + 1));
            $burger->setPrice($faker->randomFloat(2, 4.99, 15.99));

            $burger->setPain($pains[array_rand($pains)]);

            $numberOfOignons = $faker->numberBetween(1, 3);
            $selectedOignons = $faker->randomElements($oignons, $numberOfOignons);
            foreach ($selectedOignons as $oignon) {
                $burger->addOignon($oignon);
            }

            $numberOfSauces = $faker->numberBetween(1, 4);
            $selectedSauces = $faker->randomElements($sauces, $numberOfSauces);
            foreach ($selectedSauces as $sauce) {
                $burger->addSauce($sauce);
            }

            $burger->setImage($images[$i]);
            $manager->persist($burger);
            $burgers[] = $burger;
        }

        $manager->flush();

        for ($i = 0; $i < 50; $i++) {
            $commentaire = new Commentaire();
            $commentaire->setName($faker->sentence($faker->numberBetween(3, 8)));

            $selectedBurger = $burgers[array_rand($burgers)];
            $commentaire->setBurger($selectedBurger);

            $manager->persist($commentaire);
        }

        $manager->flush();
    }
}