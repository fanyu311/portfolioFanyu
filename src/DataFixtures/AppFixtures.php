<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function __construct(
        private UserPasswordHasherInterface $hasher
    ) {
    }

    public function load(ObjectManager $manager): void
    {



        // User admin
        $user = new User();

        $user
            ->setEmail('admin@test.com')
            ->setFirstName('Fanyu')
            ->setLastName('Sun')
            ->setRoles(['ROLE_ADMIN'])
            ->setPassword(
                $this->hasher->hashPassword(new User(), 'Test1234')
            );

        $manager->persist($user);
        $manager->flush();
    }
}
