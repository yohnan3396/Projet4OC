<?php

namespace CoreBundle\Payment;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Config\Definition\Exception\Exception;
use CoreBundle\Entity\Commande;
use Doctrine\ORM\EntityManager;


class Payment
{
    protected $em;

    public function __construct(EntityManager $entityManager, $stripe_key)
    {
        $this->em   = $entityManager;
        \Stripe\Stripe::setApiKey($stripe_key);
    }

    /**
     * Paiement de la commande
     *
     * @param Commande $commande
     * @param Request $request
     * @return bool
     */
    public function launchPayment(Commande $commande, request $request){

        // On vérifie que la commande et l'adresse email est valide
        if(is_null($commande) || !filter_var($commande->getEmail(), FILTER_VALIDATE_EMAIL)){
            return false;
        }


        try {
            \Stripe\Charge::create(array(
                "amount"        => $commande->getTotalPrice() * 100 ,
                "currency"      => "eur",
                "description"   => "Musée du Louvre - Paiement des billets",
                "source"        => $request->get('stripeToken'),
            ));

        } catch(\Stripe\Error\Card $e) {
 
            return false;

        } catch (\Stripe\Error\InvalidRequest $e) {

            return false;

        } catch (\Stripe\Error\Authentication $e) {

            return false;

        } catch (\Stripe\Error\ApiConnection $e) {

            return false;

        } catch (\Stripe\Error\Base $e) {

            return false;

        } catch (Exception $e) {

            return false;
        }

        return true;

    }
}

