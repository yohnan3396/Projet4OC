<?php
namespace CoreBundle\Validator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Constraints\DateTime;

class CommandeCheckDayValidator extends ConstraintValidator
{
    protected $em;
    private $container;


    public function validate($value, Constraint $constraint)
    {
        $dateTodayMidnight = new \DateTime();
        $dateTodayMidnightTimestamp = $dateTodayMidnight->getTimestamp();

        $dateVisiteTimestamp = $value->getTimestamp();

         if($value->format('D') == "Tue" OR $value->format('d/m') == "01/05" OR $value->format('d/m') == "01/11" OR $value->format('d/m') == "25/12" OR $dateTodayMidnightTimestamp > $dateVisiteTimestamp) 
         {
              $this->context->buildViolation($constraint->message)
                ->addViolation();
         }
    }
}


