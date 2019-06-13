<?php


namespace AppBundle\DataFixtures;


use AppBundle\Entity\Dinosaur;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class DinosaurFixtures extends BaseFixtures
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i < 10; $i++ ){
            $dinosaur = new Dinosaur();
            $dinosaur->setName($this->faker->name);
            $dinosaur->setContent($this->faker->text);
            $manager->persist($dinosaur);
        }
        $manager->flush();
    }
}
