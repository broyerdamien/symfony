<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Collections\Expr\Value;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{
    public const PROGRAMS = [
        ['title' => 'La guerre des étoiles', 'synopsis' => 'Dans une galaxie lointaine très lointaine...', 'poster' => 'https://www.cinemaffiche.fr/4017-tm_large_default/star-wars-la-guerre-des-etoiles-episode-4-star-wars.jpg', 'references' => 'category_Fantastique'],
        ['title' => 'Le seigneur des anneaux', 'synopsis' => 'Il etait une fois dans une très loitaine contré...', 'poster' => 'https://www.ecranlarge.com/media/cache/1600x1200/uploads/image/001/192/5opg6m0yhr21ovs1fni2h1xpkuf-326.jpg', 'references' => 'category_Action'],
        ['title' => 'Avenger end game', 'synopsis' => 'La moitié de l univers à disparus ! Thanos a agner la guerre.', 'poster' => 'https://lumiere-a.akamaihd.net/v1/images/p_avengersendgame_19751_e14a0104.jpeg?region=0%2C0%2C540%2C810', 'references' => 'category_Aventure'],
        ['title' => 'Reputation stadium tour', 'synopsis' => 'Le plus gros concert de tous les temps', 'poster' => 'https://imgsrc.cineserie.com/2018/12/1587250.jpg?ver=1', 'references' => 'category_Animation'],
        ['title' => 'Dora l exploratrice', 'synopsis' => 'la débilté incarné', 'poster' => 'https://www.bebegavroche.com/media/catalog/product/cache/1/thumbnail/1200x/040ec09b1e35df139433887a97daa66f/s/t/sticker-geant-dora-exploratrice.jpg', 'references' => 'category_Horreur'],
    ];


    public function load(ObjectManager $manager): void
    {
        foreach (self::PROGRAMS as $keys => $values) {
            $program = new Program();
            $program->setTitle($values['title']);
            $program->setSynopsis($values['synopsis']);
            $program->setPoster($values['poster']);
            $program->setCategory($this->getReference($values['references']));
            $manager->persist($program);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        // Tu retournes ici toutes les classes de fixtures dont ProgramFixtures dépend
        return [
            CategoryFixtures::class,
        ];
    }
}
