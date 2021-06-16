<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $categories = ['Work', 'Home'];

        foreach ($categories as $name) {

            $category = new Category;
            $category->setName($name);

            $manager->persist($category);
        }

        $manager->flush();
    }
}
