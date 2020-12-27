<?php


namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class CategoryFixtures extends Fixture
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('en_UK');

        for ($i = 0; $i < 5; $i++) {
            $category = new Category();
            $category->setName($faker->word);

            $manager->persist($category);
            $this->addReference('category_' . $i, $category);
        }
        $manager->flush();
    }
}
