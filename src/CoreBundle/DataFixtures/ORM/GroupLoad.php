<?php

namespace CoreBundle\DataFixtures\ORM;

use CoreBundle\Entity\Groups;
use CoreBundle\Entity\Role;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadGroupData extends AbstractFixture implements OrderedFixtureInterface {


    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $role = new Role('CAN_SUPERADMIN');
        $manager->persist($role);

        $role = new Role('CAN_ADMIN');
        $manager->persist($role);


        $manager->flush();

        $group = new Groups();
        $group->setName('SUPERADMIN');
        $group->addRole($manager->getRepository('CoreBundle:Role')->findOneBy(array('name'=>'CAN_SUPERADMIN')));
        $manager->persist($group);

        $group = new Groups();
        $group->setName('ADMIN');
        $group->addRole($manager->getRepository('CoreBundle:Role')->findOneBy(array('name'=>'CAN_ADMIN')));
        $manager->persist($group);


        $manager->flush();
    }
    public function getOrder()
    {
        return 1;
    }
}