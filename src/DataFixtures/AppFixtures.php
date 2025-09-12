<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Pain;
use App\Entity\Burger;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        // Création du pain
        $pain = new Pain();
        $pain->setName('Pain pour burger');
        $manager->persist($pain);

        // Création de 25 burgers
        for ($i = 0; $i < 25; $i++) {
            $burger = new Burger();
            $burger->setName($faker->word() . ' Burger');
            $burger->setPrice($faker->randomFloat(2, 4, 15));
            $burger->setPain($pain);

            $manager->persist($burger);
        }

        $manager->flush();
    }
}
