<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private UserPasswordEncoderInterface $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager) : void
    {
        $user = new User();
        $user->setUsername('admin');
        $user->setEmail('admin@domain.com');
        $user->setPassword($this->encoder->encodePassword($user, 'admin'));
        $user->setRoles(['ROLE_ADMIN']);

        $manager->persist($user);
        $this->addReference('user', $user);
        $manager->flush();
    }
}
