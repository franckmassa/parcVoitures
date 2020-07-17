<?php

namespace App\DataFixtures;

use App\Entity\Marque;
use App\Entity\Modele;
use App\Entity\Voiture;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        $marque1 = new Marque();
        $marque1->setLibelle("Yotota");
        $manager->persist($marque1);

        $marque2 = new Marque();
        $marque2->setLibelle("Jeupo");
        $manager->persist($marque2);

        $modele1 = new Modele();
        $modele1->setLibelle("Rayis")
            ->setPrixMoyen(15000)
            ->setImage("modele1.jpg")
            ->setMarque($marque1);
        $manager->persist($modele1);

        $modele2 = new Modele();
        $modele2->setLibelle("Yraus")
            ->setPrixMoyen(20000)
            ->setImage("modele2.jpg")
            ->setMarque($marque1);
        $manager->persist($modele2);

        $modele3 = new Modele();
        $modele3->setLibelle("007")
            ->setPrixMoyen(30000)
            ->setImage("modele3.jpg")
            ->setMarque($marque1);
        $manager->persist($modele3);

        $modele4 = new Modele();
        $modele4->setLibelle("008")
            ->setPrixMoyen(10000)
            ->setImage("modele4.jpg")
            ->setMarque($marque1);
        $manager->persist($modele4);

        $modele5 = new Modele();
        $modele5->setLibelle("009")
            ->setPrixMoyen(17000)
            ->setImage("modele5.jpg")
            ->setMarque($marque1);
        $manager->persist($modele5);

        // déclaration d'un tableau pour tous les modèles 
        $modeles = [$modele1, $modele2, $modele3, $modele4, $modele5];

        // Toutes les fonctions de Faker sont sur https://github.com/fzaninotto/Faker 
        $faker = \Faker\Factory::create('fr_FR');

        // Pour chaque modele on va randomiser 3 à 5 voitures
        foreach ($modeles as $m) {
            $rand = rand(3, 5);
            // on génère les voitures une à une 
            for ($i = 1; $i <= $rand; $i++) {
                $voiture = new Voiture();
                // regex de forme XX1234XX
                $voiture->setImmatriculation($faker->regexify("[A-Z]{2}[0-9]{3,4}[A-Z]{2}"))
                    //  Le nombre de portes de 3 à 5 en random
                    ->setNbPortes($faker->randomElement($array = array(3,5)))
                    // année entre 1990 et 2019
                    ->setAnnee($faker->numberBetween($min = 1990, $max = 2019))
                    ->setModele($m);
                $manager->persist($voiture);
            }
        }
        $manager->flush();
    }
}
