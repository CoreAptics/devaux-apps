<?php

namespace CoreBundle\DataFixtures\ORM;

use CoreBundle\Entity\Category;
use CoreBundle\Entity\Country;
use CoreBundle\Entity\Departement;
use CoreBundle\Entity\Reference;
use CoreBundle\Entity\Ville;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadReferenceData extends AbstractFixture implements OrderedFixtureInterface{

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager){
        $country = new Country();
        $country->setName('France');
        $manager->persist($country);

            $departement = new Departement();
            $departement->setName('Aube');
            $departement->setCountry($country);
            $manager->persist($departement);

                $ville = new Ville();
                $ville->setName('Bar-sur-seine');
                $ville->setDepartement($departement);
                $ville->setCountry($country);
                $manager->persist($ville);

            $category = new Category();
            $category->setName('Restaurants');
            $category->addVille($ville);
            $manager->persist($category);

                $reference = new Reference();
                $reference->setName('Restaurant à bar sur seine');
                $reference->setLatitude(0.55555);
                $reference->setLongitude(0.4444);
                $reference->setAddress('35 rue du Boucher');
                $reference->setZipcode('10110');
                $reference->setWebSite('www.example.com');
                $reference->setVille($ville);
                $reference->setCategory($category);
                $manager->persist($reference);
        $manager->flush();

        $country = new Country();
        $country->setName('Allemagne');
        $manager->persist($country);


            $ville = new Ville();
            $ville->setName('Frankfurt');
            $ville->setCountry($country);
            $manager->persist($ville);

        $category = new Category();
        $category->setName('Hôtels');
        $category->addVille($ville);
        $manager->persist($category);

            $reference = new Reference();
            $reference->setName('Hôtel à Frankfurt');
            $reference->setLatitude(0.55555);
            $reference->setLongitude(0.4444);
            $reference->setAddress('46 rue de la Paix');
            $reference->setWebSite('www.example.com');
            $reference->setVille($ville);
            $reference->setCategory($category);
            $manager->persist($reference);

        $manager->flush();

    }
    public function getOrder()
    {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 7;
    }
}