<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Article;

class ArticleFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        for($i = 1 ; $i<=10;$i++){

            $artc= new Article();
            $artc->setName("Article ".$i);
            $artc->setBody("Article Content for article number : ".$i);
            $manager->persist($artc);


        }

        $manager->flush();
    }
}
