<?php

namespace CoreBundle\Controller;
use CoreBundle\Entity\Commande;
use CoreBundle\Form\CommandeType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;


class Stripe {

    private $api_key;

    /**
     * Créer une nouvelle instance de Stripe
     * @param string $api_key
     */
    public function __construct(string $api_key) {
        $this->api_key = $api_key;
    }

    /**
     * @param string $endpoint Point de l'API à appeller
     * @param array|null $data Données à envoyer à l'API
     * @return stdClass
     * @throws Exception
     */
    public function api(string $endpoint, array $data = null): stdClass {
        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL => "https://api.stripe.com/v1/$endpoint",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_USERPWD => $this->api_key,
            CURLOPT_HTTPAUTH => CURLAUTH_BASIC
        ]);
        if ($data != null) {
           curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        }
        $response = json_decode(curl_exec($ch));
        curl_close($ch);
        if (property_exists($response, 'error')) {
            throw new Exception($response->error->message);
        }
        return $response;
    }

}

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
      $commande = new Commande();
   		$form = $this->createForm(CommandeType::class, $commande);

	    if ($request->isMethod('POST')) {

        if($form->handleRequest($request)->isValid())
        {
            $session = new Session(); 

            if($this->container->get('session')->isStarted())
            {

            }
            else
            {

              $session->start();
            }

            $session->set('name', 'Commande');
            $session->set('id', 1);



    	      $em = $this->getDoctrine()->getManager();

            foreach ($commande->getBillets() as $billet) {
              $commande->addBillet($billet);

            }

            $commande->setTotalPrice('15'); 
            $commande->setDateCommande(new \DateTime('now'));
            $commande->setDateVisite(new \DateTime('now'));

    	      $em->persist($commande);
            $em->flush();

            $status = "ok";

      
	      }
        else
        {
          $status = "invalid";
        }

      return new Response(json_encode(array('status'=>$status)));        

      }
      elseif($request->isMethod('GET') AND $request->get('stripeToken'))
      {

        $token = $request->get('stripeToken');
  
          if (!empty($token)) 
          {
            $stripe = new Stripe('sk_test_wcvBBbp8nZqoRFfzGH3FFOw1');
            $customer = $stripe->api('customers', [
                'source' => $token,
                'description' => "test",
                'email' => "yohann-3396@hotmail.fr"
            ]);
            
            $charge = $stripe->api('charges', [
                'amount' => 100,
                'currency' => 'eur',
                'customer' => $customer->id
            ]);

            $status = "ok";
          }
          else
          {
            $status = "invalid";
          }


 
          return new Response(json_encode(array('status'=>$status)));    




      }



   		return $this->render('@Core/Default/index.html.twig', array(
      	'form' => $form->createView(),
    	));




    }


}


