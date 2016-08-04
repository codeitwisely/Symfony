<?php

namespace TestBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('TestBundle:Default:index.html.twig');
    }

    /**
     * @Route("/genus")
     */
    public function showAction($genusName) {
      $funFact = 'Je ne sais pas encore ce que je veux ecrire mais je *pense que ca vaut vraiment* le coup';

      $funFact = $this->get('markdown.parser')
        ->transform($funFact);

      return $this->render('genus/show.html.twig',
        array(
          'name' => $genusName,
          'funFact' => $funFact,
        )
      );
    }

    /**
     * @Route("/genus/{genusname}/notes", name="test_homepage")
     * @Method("GET")
     */
    public function getNotesAction()
    {
        $notes = [
          ['id' => 1, 'username' => 'AquaPelham', 'avatarUri' => '/images/leanna.jpeg', 'note' => 'Octopus asked me a riddle, outsmarted me', 'date' => 'Dec. 10, 2015'],
          ['id' => 2, 'username' => 'AquaWeaver', 'avatarUri' => '/images/ryan.jpeg', 'note' => 'I counted 8 legs... as they wrapped around me', 'date' => 'Dec. 1, 2015'],
          ['id' => 3, 'username' => 'AquaPelham', 'avatarUri' => '/images/leanna.jpeg', 'note' => 'Inked!', 'date' => 'Aug. 20, 2015'],
        ];

        $datas = array(
          'notes' => $notes,
        );

        return new JsonResponse($datas);
    }
}
