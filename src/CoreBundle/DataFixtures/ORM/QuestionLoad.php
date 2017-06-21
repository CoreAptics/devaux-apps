<?php

namespace CoreBundle\DataFixtures\ORM;

use CoreBundle\Entity\Question;
use CoreBundle\Entity\QuestionAttribute;
use CoreBundle\Entity\QuestionType;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadQuestionData extends AbstractFixture implements OrderedFixtureInterface{

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager){
        $questionType = new QuestionType();
        $questionType->setType('Multiple');
        $manager->persist($questionType);

        $questionType = new QuestionType();
        $questionType->setType('Unique');
        $manager->persist($questionType);

        $questionType = new QuestionType();
        $questionType->setType('Texte');
        $manager->persist($questionType);
        $manager->flush();

        $question = new Question();
        $question->setName('Vous êtes :');
        $question->setType($manager->getRepository('CoreBundle:QuestionType')->findOneBy(array('type'=>'Unique')));
        $question->setHorizontal(true);
        $manager->persist($question);

            $attribute = new QuestionAttribute();
            $attribute->setName('Un Homme');
            $attribute->setQuestion($question);
            $attribute->setOptional(false);
            $manager->persist($attribute);

            $attribute = new QuestionAttribute();
            $attribute->setName('Une Femme');
            $attribute->setQuestion($question);
            $attribute->setOptional(false);
            $manager->persist($attribute);


        $question = new Question();
        $question->setName('Originaire de :');
        $question->setType($manager->getRepository('CoreBundle:QuestionType')->findOneBy(array('type'=>'Unique')));
        $question->setHorizontal(true);
        $manager->persist($question);

            $attribute = new QuestionAttribute();
            $attribute->setName('La région Grand Est');
            $attribute->setQuestion($question);
            $attribute->setOptional(false);
            $manager->persist($attribute);

            $attribute = new QuestionAttribute();
            $attribute->setName('Une autre région française ');
            $attribute->setQuestion($question);
            $attribute->setOptional(false);
            $manager->persist($attribute);

            $attribute = new QuestionAttribute();
            $attribute->setName('Etranger ');
            $attribute->setQuestion($question);
            $attribute->setOptional(true);
            $manager->persist($attribute);

        $question = new Question();
        $question->setName('8.Que pourrions-nous faire pour améliorer vos prochaines expériences de dégustation et/ou d’achat ?');
        $question->setType($manager->getRepository('CoreBundle:QuestionType')->findOneBy(array('type'=>'Texte')));
        $question->setHorizontal(true);
        $manager->persist($question);

            $attribute = new QuestionAttribute();
            $attribute->setName('texte');
            $attribute->setQuestion($question);
            $attribute->setOptional(false);
            $manager->persist($attribute);

        $manager->flush();

    }
    public function getOrder()
    {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 6;
    }
}