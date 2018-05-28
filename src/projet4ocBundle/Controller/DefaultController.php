<?php

namespace projet4ocBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
    	$bookingManager = $this->get("BookingManager");

        return $this->render('@projet4oc/Default/index.html.twig');

    }
}
