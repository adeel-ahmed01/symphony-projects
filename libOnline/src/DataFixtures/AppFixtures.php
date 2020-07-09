<?php

namespace App\DataFixtures;

use App\Entity\Users;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
       /* $user = new Users();
        $user->setEmail('paul@email.com');

        $password = $this->encoder->encodePassword($user, 'paul000');
        $user->setPassword($password);
        $manager->persist($user);*/
        $manager->flush();
    }
}
