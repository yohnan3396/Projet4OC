<?php

namespace CoreBundle\Controller;
use CoreBundle\Entity\Commande;
use CoreBundle\Form\CommandeType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;



class DefaultController extends Controller
{
    protected function getErrorsAsArray($form)
    {
      $errors = array();
      foreach ($form->getErrors() as $error)
          $errors[] = $error->getMessage();

      foreach ($form->all() as $key => $child) {
          if ($err = $this->getErrorsAsArray($child))
              $errors[$key] = $err;
      }
      return $errors;
    }


    public function indexAction(Request $request)
    { 
      $nbBillets = 0;
      $commande = new Commande();
   		$form = $this->createForm(CommandeType::class, $commande);

	    if ($request->isMethod('POST')) {

       if($form->handleRequest($request)->isValid())
        {

            $session = new Session(); 
            $em = $this->getDoctrine()->getManager();

            foreach ($commande->getBillets() as $billet) {

              $nbBillets++;
              $commande->addBillet($billet);
            }

            // Appel des différents services

            $totalPrice = $this->get('core.MyService')->getTotalPrice($commande->getBillets());            
            $checkDateCommande = $this->get('core.MyService')->checkHourSameDay($commande->getDateVisite(), $commande->getTypeCmd()); 
            $nbBillets = $this->get('core.MyService')->checkNbBillets($commande->getDateVisite(), $nbBillets); 

            if($nbBillets == 0 OR $checkDateCommande == 0)
            {
              $formValid = 0;
            }
            else
            {

              $commande->setTotalPrice($totalPrice); 
              $commande->setDateCommande(new \DateTime('now'));

              $em->persist($commande);
              $em->flush();

              $idCommande = $commande->getId();
              $session->set('commande', $commande);

              $status = 'ok';

              $formValid = 1;

            }

        }
        else
        {
          $formValid = 0;
        }

        if($formValid == 0)
        {
            $status = $this->getErrorsAsArray($form);
        }



        return new Response(json_encode(array('status'=>$status, 'prix' => $totalPrice)));    

      }
      elseif($request->isMethod('GET') AND $request->get('stripeToken'))
      {


        $token = $request->get('stripeToken');
  
        if (!empty($token)) 
        {

          $commande = $request->getSession()->get('commande');

      
          if($this->get('core.Payment')->launchPayment($commande, $request)){

            $status = 'ok';
          }
          else
          {
             $status = 'Une erreur est survenue.';
          }
            
          return new Response(json_encode(array('status'=> 'ok')));  
          
      }

      }


   		return $this->render('@Core/Default/index.html.twig', array(
      	'form' => $form->createView(),
    	));




    }


}


