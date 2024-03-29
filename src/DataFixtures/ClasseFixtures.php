<?php

namespace App\DataFixtures;

use App\Entity\Classe;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ClasseFixtures extends Fixture {
    public function load(ObjectManager $manager): void {
        $niveaux = ["L1", "L2", "L3", "M1", "M2", "Doctorat"];
        $filieres = ["Dev Web/Mobile", "MAI", "Robotique", "IA"];
        for ($i = 0; $i < 10; $i++) {
            $classe = new Classe();
            $niveau = rand(0, 3);
            $filiere = rand(0, 3);
            $classe->setNomClasse('Classe ' . $i);
            $classe->setNiveau($niveaux[$niveau]);
            $classe->setFiliere($filieres[$filiere]);
            $manager->persist($classe);
        }
        $manager->flush();
    }
}
