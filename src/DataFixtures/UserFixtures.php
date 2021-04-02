<?php

namespace App\DataFixtures;
use  App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{

    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {

        $this->passwordEncoder = $passwordEncoder;
    }



    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');


        for($i = 0; $i < 2; $i++) {
            $user = new User();
            $user->setPrenom($faker->unique(true)->firstName);
            $user->setEmail($faker->unique(true)->email);
            $user->setPassword($this->passwordEncoder->encodePassword($user,"mdp123"));
            $manager->persist($user);

        }
        $admin = new User();
        $admin->setPrenom('Kayz');
        $admin->setEmail('kayz@email.com');
        $admin->setPassword($this->passwordEncoder->encodePassword($admin,"admin123"));
        $admin->setRoles(['ROLE_ADMIN']);
        $manager->persist($admin);

        $manager->flush();
    }
}
