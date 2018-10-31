<?php

namespace test\CoreBundle\Services;
use Doctrine\ORM\EntityManager;

class ServicesTest extends \PHPUnit_Framework_TestCase
{
 

    public function testMercredi()
    {

        $dateVisite = new \DateTime();
        $dateVisite->modify('next wednesday');
         if($dateVisite->format('D') == "Tue" OR $dateVisite->format('d/m') == "01/05" OR $dateVisite->format('d/m') == "01/11" OR $dateVisite->format('d/m') == "25/12") 
         {
            $boolean = 0;
         }
         else
         {
            $boolean = 1;
         }

         $this->assertEquals(1, $boolean);  
    }


    public function testMardi()
    {

        $dateVisite = new \DateTime();
        $dateVisite->modify('next tuesday');
         if($dateVisite->format('D') == "Tue" OR $dateVisite->format('d/m') == "01/05" OR $dateVisite->format('d/m') == "01/11" OR $dateVisite->format('d/m') == "25/12") 
         {
            $boolean = 0;
         }
         else
         {
            $boolean = 1;
         }

         $this->assertEquals(1, $boolean);  
    }

    public function testCheckHourSameDay()
    {
        $dateVisite = new \DateTime();
        $dateToday = new \DateTime();
        $typeVisite = "Journée";


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

      $this->assertEquals(1, $response);     


    }



}



   