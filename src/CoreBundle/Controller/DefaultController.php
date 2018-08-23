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
      $myService =  $this->get('core.MyService');

      $commande = $myService->getCommande();
   
      $form = $this->createForm(CommandeType::class, $commande);

       if($request->isMethod('POST') && $form->handleRequest($request)->isValid())
       {
            $em = $this->getDoctrine()->getManager();
	      
	    $myService->updateCommande($commande);
	       
	    if($myService->isValide()) {
		    $em->persist($commande);
		    $status = 1;
	    } else {
		$status = $myService->getErrors();
	    }
    
	    return new Response(json_encode(array('status'=>$status, 'prix' => $totalPrice)));    

        } 
	       
       return $this->render('@Core/Default/index.html.twig', array('form' => $form->createView()));
    }
	
    public function paiementAction(Request $request)
    {
	    
	   $token = $request->get('stripeToken')
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


