<?php
namespace CoreBundle\Mailer;
use Symfony\Component\Templating\EngineInterface;
use CoreBundle\Entity\Commande;
class Mailer
{
    protected $mailer;
    private $templating;
    private $from;
    private $reply;
    private $name;
    public function __construct(\Swift_Mailer $mailer, EngineInterface $templating, $from, $reply, $name)
    {
        $this->mailer       = $mailer;
        $this->templating   = $templating;
        $this->from         = $from;
        $this->reply        = $reply;
        $this->name         = $name;
    }

    /**
     * Envoi d'un email
     *
     * @param $to
     * @param $subject
     * @param $body
     */
    public function sendMail($to, $subject, $body)
    {
        $mail = \Swift_Message::newInstance();
        $mail
            ->setFrom(array($this->from => $this->name))
            ->setTo($to)
            ->setSubject($subject)
            ->setBody($body)
            ->setReplyTo(array($this->reply => $this->name))
            ->setContentType('text/html')
        ;
        $this->mailer->send($mail);
    }


    /**
     * Construction d'un email pour l'envoi des tickets
     *
     * @param Commande $commande
     */
    public function sendTicket(Commande $commande)
    {
        $to         = $commande->getEmail();
        $subject    = "Votre commande musée du louvre";
        $body       = $this->templating->render('CoreBundle:Email:sendTicket.html.twig', array('commande' => $commande));
        $this->sendMail($to, $subject, $body);
    }

}