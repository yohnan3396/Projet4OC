<?php
namespace CoreBundle\Validator;
use Symfony\Component\Validator\Constraint;
/**
 * @Annotation
 */
class CommandeCheckBillets extends Constraint
{
 public $message = 'Désolé il n\'y plus de places ce jour là.';
}