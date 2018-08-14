<?php
namespace CoreBundle\Validator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Constraints\DateTime;

class CommandeCheckBilletsValidator extends ConstraintValidator
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

      // Compter nb billets en fonction de la date

         if($value != "test") 
         {
              $this->context->buildViolation($constraint->message)
                ->addViolation();
         }
    }
}


