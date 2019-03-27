<?php

namespace App\DataFixtures;

use App\Entity\Departement;
use App\Entity\Personne;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $direction = new Departement();
        $direction->setNom('direction');

        $rh = new Departement();
        $rh->setNom('rh');

        $com =new Departement();
        $com->setNom('com');

        $dev = new Departement();
        $dev->setNom('dev');

        $personne = new Personne();
        $personne->setNom('Dupont');
        $personne->setPrenom('Henry');
        $personne->setMail('testsymphony123456@gmail.com');
        $personne->setDepartement($direction);
        $personne->setFonction('responsable');
        $direction->addEmploye($personne);
        $manager->persist($personne);

        $personne = new Personne();
        $personne->setNom('Pudont');
        $personne->setPrenom('Ryhen');
        $personne->setMail('PudontRyhen@gmail.com');
        $personne->setDepartement($direction);
        $personne->setFonction('employe');
        $direction->addEmploye($personne);
        $manager->persist($personne);

        $personne = new Personne();
        $personne->setNom('Muller');
        $personne->setPrenom('Thomas');
        $personne->setMail('MullerThomas@gmail.com');
        $personne->setDepartement($rh);
        $personne->setFonction('responsable');
        $rh->addEmploye($personne);
        $manager->persist($personne);

        $personne = new Personne();
        $personne->setNom('Lermu');
        $personne->setPrenom('Pauline');
        $personne->setMail('LermuPauline@gmail.com');
        $personne->setDepartement($com);
        $personne->setFonction('responsable');
        $com->addEmploye($personne);
        $manager->persist($personne);

        $personne = new Personne();
        $personne->setNom('Legrand');
        $personne->setPrenom('Alexandre');
        $personne->setMail('LegrandAlexandre@gmail.com');
        $personne->setDepartement($com);
        $personne->setFonction('employe');
        $com->addEmploye($personne);
        $manager->persist($personne);

        $personne = new Personne();
        $personne->setNom('Super');
        $personne->setPrenom('Developpeur');
        $personne->setMail('SuperDeveloppeur@gmail.com');
        $personne->setDepartement($dev);
        $personne->setFonction('responsable');
        $dev->addEmploye($personne);
        $manager->persist($personne);

        $personne = new Personne();
        $personne->setNom('Trump');
        $personne->setPrenom('Donald');
        $personne->setMail('TrumpDonald@gmail.com');
        $personne->setDepartement($dev);
        $personne->setFonction('employe');
        $dev->addEmploye($personne);
        $manager->persist($personne);

        $manager->persist($direction);
        $manager->persist($rh);
        $manager->persist($com);
        $manager->persist($dev);
        $manager->flush();
    }
}
