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
      $commande = new Commande();
      $totalPrice = 0;
      $formValid = 0;
   		$form = $this->createForm(CommandeType::class, $commande);

	    if ($request->isMethod('POST')) {

       if($form->handleRequest($request)->isValid())
       {

            $session = new Session(); 
            $em = $this->getDoctrine()->getManager();


            list($status, $totalPrice, $formValid) = $this->get('core.MyService')->checkAllParameters($commande);    

            if($formValid == 1)
            {

              $commande->setTotalPrice($totalPrice); 
              $commande->setDateCommande(new \DateTime('now'));

              $em->persist($commande);
              $em->flush();

              $session->set('commande', $commande);

              $status = 'ok';

              $formValid = 1;

            }

        }
        else
        {
          $status = $this->getErrorsAsArray($form);
        }

        return new Response(json_encode(array('status'=> $status, 'prix' => $totalPrice)));    

      }

      return $this->render('@Core/Default/index.html.twig', array(
        'form' => $form->createView(),
      ));


    }

    public function paymentAction(Request $request)
    {

      if($request->isMethod('GET') AND $request->get('stripeToken'))
      {

        $token = $request->get('stripeToken');
        $commande = $request->getSession()->get('commande');

    
        if($this->get('core.Payment')->launchPayment($commande, $request)){

          $commande->setIsPurchased(1);    
          $sendEmail = $this->get('core.Mailer')->sendTicket($commande);           
          $status = 'ok';
        }
        else
        {
           $status = 'Une erreur est survenue.';
        }
          
        return new Response(json_encode(array('status'=> 'ok')));  
        
        

      }


    }
 





}


