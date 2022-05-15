<?php

namespace App\DataFixtures;

use App\Entity\Entreprise;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class EntrepriseFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $data = ["google", "facebook", "instagram","jumia",];
        for ($i = 0; $i < count($data); $i++) {
             $en=new Entreprise();
             $en->setName($data[$i]);
             $manager->persist($en);
        }
        $manager->flush();
    }
}