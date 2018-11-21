<?php

namespace test\CoreBundle\Services;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class testFonctionnel extends WebTestCase
{

    // TEST UNITAIRE
    public function testHomePage()
    {

        $client = static::createClient();
        $client->request('GET', '/');

        $this->assertSame(200, $client->getResponse()->getStatusCode());
    }

}

class testUnitaires extends \PHPUnit_Framework_TestCase
{
 
    // TEST UNITAIRE
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

         $this->assertEquals(0, $boolean);  
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



   