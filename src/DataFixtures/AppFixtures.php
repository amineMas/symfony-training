<?php

namespace App\DataFixtures;

use App\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {


        for($i = 0; $i < 30; $i++){
            $cat = rand(1, 7);
            $article = new Article();
            $article
                ->setTitle('Article du jour ' . $i )
                ->setAddDate(new \DateTime('now'))
                ->setDescription('Article du jour' .  $i)
                ->setImage('article' . $i . '.png')
                ->setCategorie('categorie' . $cat);
            
                $manager->persist($article);
        }

        $manager->flush();
    }
}
