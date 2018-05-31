<?php

namespace projet4ocBundle\Controller;


use projet4ocBundle\Entity\Booking;
use projet4ocBundle\Entity\Ticket;
use projet4ocBundle\Form\BookingType;
use projet4ocBundle\Form\TicketType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;



class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('@projet4oc/Default/index.html.twig');

    }


	  public function addAction(Request $request)
	  {
	    $booking = new Booking();
	    $form = $this->createForm(BookingType::class, $booking);
	    $form->handleRequest($request);

	    if ($form->isValid() AND $form->isSubmitted()) {
	      $em = $this->getDoctrine()->getManager();
	      $em->persist($booking);
	      $em->flush();
	    }

	    // On passe la méthode createView() du formulaire à la vue
	    // afin qu'elle puisse afficher le formulaire toute seule
	    return $this->render('@projet4oc/Default/add.html.twig', array(
	      'form' => $form->createView(),
	    ));
	  }

}



