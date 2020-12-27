<?php

namespace App\DataFixtures;

use App\Entity\Tag;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class TagFixtures extends Fixture
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager) : void
    {
        $faker = Faker\Factory::create();

        for ($i = 0; $i < 5; $i++) {
            $tag = new Tag();
            $tag->setName($faker->word);

            $manager->persist($tag);
            $this->addReference('tag_' . $i, $tag);
        }

        $manager->flush();
    }
}
