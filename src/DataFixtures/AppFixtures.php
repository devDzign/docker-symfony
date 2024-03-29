<?php

namespace App\DataFixtures;

use App\Entity\Ad;
use App\Entity\Image;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        $faker = Factory::create('FR-fr');


        for ($i = 0; $i <= 300; $i++) {
            $ad           = new Ad();
            $title        = $faker->sentence();
            $coverImage   = $faker->imageUrl(1000, 350);
            $introduction = $faker->paragraph(2);
            $content      = '<p>'.implode('<p></p>', $faker->paragraphs(5)).'</p>';

            $ad->setTitle($title)
                ->setCoverImage($coverImage)
                ->setIntroduction($introduction)
                ->setContent($content)
                ->setPrice(mt_rand(40, 200))
                ->setRooms(mt_rand(1, 5));

            for ($j = 1, $jMax = mt_rand(2, 5); $j <= $jMax; $j++) {
                $image = new Image();
                $image->setUrl($faker->imageUrl())
                    ->setCaption($faker->sentence())
                    ->setAd($ad);

                $manager->persist($image);
            }

            $manager->persist($ad);
        }

        $manager->flush();
    }
}
