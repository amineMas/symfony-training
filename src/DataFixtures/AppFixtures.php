<?php

namespace App\DataFixtures;

use Faker;
use App\Entity\User;
use App\Entity\Article;
use App\Entity\Training;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        $faker = Faker\Factory::create('fr-FR');
        
        for($i = 0; $i < 10; $i++){

            $article = new Article();
            $article
                ->setTitle($faker->word )
                ->setAddDate($faker->dateTime)
                ->setDescription($faker->text)
                ->setImage($faker->imageUrl($widht=400, $height=200))
                ->setCategorie($faker->word);
            
                $manager->persist($article);
        }

        for($i = 0; $i < 5 ; $i++){

            $user = new User();
            $user
                ->setUserName($faker->userName)
                ->setPassword($faker->password)
                ->setPrenom($faker->userName)
                ->setNom($faker->lastName)
                ->setEmail($faker->email)
                ->setCity($faker->city)
                ->setZipCode($faker->randomDigit)
                ->setBirthDate(new \DateTime($faker->date($format = 'd-m-Y', $max='now')));
                
            
                $manager->persist($user);

        }

        for($i = 0; $i < 10; $i++){

            $training = new Training();
            $training
                ->setName($faker->word )
                ->setDescription($faker->text)
                ->setImage($faker->imageUrl($widht=800, $height=600))
                ->setAddDate(new \DateTime('now'));
                
                $manager->persist($training);
        }

        $manager->flush();


    }


}
