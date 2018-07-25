<?php

namespace CoreBundle\Controller;
use CoreBundle\Entity\Commande;
use CoreBundle\Form\CommandeType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
      $commande = new Commande();
   		$form = $this->createForm(CommandeType::class, $commande);

	    if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
	      $em = $this->getDoctrine()->getManager();





        foreach ($commande->getBillets() as $billet) {
          $commande->addBillet($billet);

        }

        $commande->setTotalPrice('15'); 
        $commande->setDateCommande(new \DateTime('now'));
        $commande->setDateVisite(new \DateTime('now'));

	      $em->persist($commande);
        $em->flush();

	    }



   		return $this->render('@Core/Default/index.html.twig', array(
      	'form' => $form->createView(),
    	));




    }
}


