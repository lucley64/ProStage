<?php

namespace App\DataFixtures;

use App\Entity\Entreprise;
use App\Entity\Formation;
use App\Entity\Stage;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = \Faker\Factory::create('fr_FR');


        for ($i = 0; $i < 20; $i++) {
            $nom = $faker->company;
            $entreprise = new Entreprise();
            $entreprise->setNom($nom);
            $entreprise->setActivite($faker->realText());
            $entreprise->setSite("https://www.$nom.com"); // $faker->url ne marchait pas, il y avait l'erreur "join(): Argument #2 ($array) must be of type ?array, string given"
            $entreprise->setAdresse($faker->address);

            $entreprises[] = $entreprise;
            $manager->persist($entreprise);
        }


        $modulesFormation = array(
            "DUT Info" => "Diplôme Universitaire de Technologique Informatique",
            "LP Multimédia" => "Licence Professionelle Multimédia",
            "DUT IC" => "Diplôme Universitaire de Technologique Information et Communication"
        );

        foreach ($modulesFormation as $nomC => $nomL) {
            $formation = new Formation();
            $formation->setNom($nomC);
            $formation->setNomComplet($nomL);

            for ($numStage = 0; $numStage < 10; $numStage++) {
                $stage = new Stage();
                $stage->setTitre($faker->realText(40));
                $stage->setContact($faker->email);
                $stage->setMissions($faker->realText());

                $stage->addFormation($formation);

                $numEntreprise = $faker->numberBetween($min = 0, $max = 19);

                $stage->setEntreprise($entreprises[$numEntreprise]);
                $entreprises[$numEntreprise]->addStage($stage);

                $manager->persist($stage);
                $manager->persist($entreprises[$numEntreprise]);
            }
            $manager->persist($formation);
        }


        $lleydert = new User();
        $lleydert->setNom("Leydert");
        $lleydert->setPrenom("Luc");
        $lleydert->setEmail("lleydert");
        $lleydert->setRoles(["ROLE_USER", "ROLE_ADMIN"]);
        $lleydert->setPassword("$2y$10$0BMZu8K1isI6MhJG6AXTb.AoG7rUOVzEAwsil8wPW8vWc./uwanX.");
        $manager->persist($lleydert);


        $dnunez = new User();
        $dnunez->setNom("Nunez");
        $dnunez->setPrenom("Dorian");
        $dnunez->setEmail("dnunez");
        $dnunez->setRoles(["ROLE_USER"]);
        $dnunez->setPassword('$2y$10$PJSSSi1AU9khRwBxJ/oVSuyXmXFS0/M3avHNnTO0R9iLwiLQfkArO');
        $manager->persist($dnunez);

        $manager->flush();
    }
}
