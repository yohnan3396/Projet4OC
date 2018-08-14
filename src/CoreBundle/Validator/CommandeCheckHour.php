<?php
namespace CoreBundle\Validator;
use Symfony\Component\Validator\Constraint;
/**
 * @Annotation
 */
class CommandeCheckHour extends Constraint
{
 public $message = 'Le billet "journée" ne peut pas être commandé après 14h.';
}