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

  //  public function __construct(EntityManagerInterface $em, $container)
   // {
      //  $this->em               = $em;
  //      $this->container        = $container;
//}

    public function validate($value, Constraint $constraint)
    {

      // Vérifier si la date n'est pas passé, si c'est pas le 1er mai, le 1er novembre ou 25 décembre ou si c'est pas un mardi.
      
         if($value->format('D') == "Tue") 
         {
              $this->context->buildViolation($constraint->message)
                ->addViolation();
         }
    }
}


