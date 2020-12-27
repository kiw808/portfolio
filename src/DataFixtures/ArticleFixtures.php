<?php


namespace App\DataFixtures;

use App\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker;

class ArticleFixtures extends Fixture implements DependentFixtureInterface
{
    public function getDependencies(): array
    {
        return [
            CategoryFixtures::class,
            TagFixtures::class,
            UserFixtures::class
        ];
    }
    
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('en_UK');

        for ($i = 0; $i < 20; $i++) {
            $category = $this->getReference('category_' . $faker->numberBetween(0, 4));
            $tag = $this->getReference('tag_' . $faker->numberBetween(0, 4));
            $user = $this->getReference('user');

            $article = new Article();
            $article
                ->setTitle($faker->sentence(5, true))
                ->setContent('<p>' . $faker->text(800) . '</p>')
                ->setCategory($category)
                ->addTag($tag)
                ->setCreatedAt($faker->dateTimeThisYear())
                ->setAuthor($user);

            $manager->persist($article);
        }
        $manager->flush();
    }
}
