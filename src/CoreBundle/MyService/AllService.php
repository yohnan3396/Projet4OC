<?php
namespace CoreBundle\MyService;
use Doctrine\ORM\EntityManager;

class AllService
{
    protected $em;

    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }
   
    /**
     * Calcul du prix d'un billet
     *
     * @param $tableauBillets
     * @return float
     */

    public function getAge($dateNaissance) {

       $now = new \DateTime();
       $interval = $now->diff($dateNaissance);
       return $interval->y;

    }

    public function getTotalPrice($tableauBillets)
    {
        $totalPrice = 0;

        foreach ($tableauBillets as $billet) {

          $dateNaissance = $billet->getDateNaissance(); 
          $typeBillet = $billet->getTypeBillet();

          $ageBillet = $this->getAge($dateNaissance);


          if($ageBillet < 4) // Inférieur à 4 ans gratuit
          {
            $prixDuBillet = 0;
            $totalPrice += $prixDuBillet;
          }
          elseif($ageBillet >= 4 AND $ageBillet < 12) // Entre 4 et 12 ans : 8 euros
          {
            $prixDuBillet = 8;    
            $totalPrice += $prixDuBillet;
          }
          elseif($ageBillet >= 60) // + de 60 ans : 12 euros
          {
            $prixDuBillet = 12;  
            $totalPrice += $prixDuBillet;
          }
          else // Le reste
          {
            $prixDuBillet = 16;                  
            $totalPrice += $prixDuBillet;
          }

          if($typeBillet == 1 AND $prixDuBillet >= 10)
          {
            $ecartDePrix = $prixDuBillet-10;
            $totalPrice -= $ecartDePrix;
          }

        }

        return $totalPrice;    

    }

    /**
     * Vérifier la date
     *
     * @param \DateTime $dateVisite
     * @param $typeVisite
     * @return int
     */

    public function checkHourSameDay($dateVisite, $typeVisite)
    {
      $dateToday = new \DateTime();
      $dateToday = $dateToday->format('Y-m-d');
      $dateVisite = $dateVisite->format('Y-m-d');


      if($dateVisite == $dateToday)  // C'est la date du jour
      {
        if ($typeVisite == "Journée" AND date('H') > 14) 
        {
          $response = 0;
        }
        else
        {
          $response = 1;        
        }
      }
      else
      {
        $response = 1;
      }

        return $response;    

    }


}
