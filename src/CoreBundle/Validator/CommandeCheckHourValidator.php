<?php
namespace CoreBundle\Validator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class CommandeCheckHourValidator extends ConstraintValidator
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
  
          if ($value != "test") {

              $this->context->buildViolation($constraint->message)
                ->addViolation();

          }

    }
}


