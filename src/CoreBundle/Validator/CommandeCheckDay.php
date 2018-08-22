<?php
namespace CoreBundle\Validator;
use Symfony\Component\Validator\Constraint;
/**
 * @Annotation
 */
class CommandeCheckDay extends Constraint
{
	public $message = 'Le musée est fermé ce jour-là.';
}