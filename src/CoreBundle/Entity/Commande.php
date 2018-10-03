<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use CoreBundle\Validator\CommandeCheckDay as CheckDay;

/**
* Commande
*
* @ORM\Table(name="commande")
* @ORM\Entity(repositoryClass="CoreBundle\Repository\CommandeRepository")
*/
class Commande
{

/**
 * @ORM\OneToMany(targetEntity="CoreBundle\Entity\Billet", mappedBy="commande", cascade={"persist", "remove"})
*/
private $billets;


/**
 * @var int
 *
 * @ORM\Column(name="id", type="integer")
 * @ORM\Id
 * @ORM\GeneratedValue(strategy="AUTO")
 */
private $id;

/**
 * @var \DateTime
 *
 * @ORM\Column(name="dateCommande", type="date")
 */
private $dateCommande;

/**
 * @var string
 * @Assert\Email(
 *     message = "L'email '{{ value }}' est invalide.",
 *     checkMX = true
 * )
 * @ORM\Column(name="email", type="string", length=255)
 */

private $email;

/**
 * @var string
 * @ORM\Column(name="isPurchased", type="integer", nullable=true)
 */
private $isPurchased;

/**
 * @var string
 * @Assert\NotBlank(message="Durée de la visite obligatoire.")
 * @ORM\Column(name="typeCmd", type="string", length=255)
 */
private $typeCmd;

/**
 * @var int
 * 
 * @ORM\Column(name="totalPrice", type="integer")
 */
private $totalPrice;

/**
 * @var \DateTime
 * @CheckDay
 * @ORM\Column(name="dateVisite", type="date")
 */
private $dateVisite;


/**
 * Get id
 *
 * @return int
 */
public function getId()
{
    return $this->id;
}

/**
 * Set dateCommande
 *
 * @param \DateTime $dateCommande
 *
 * @return Commandes
 */
public function setDateCommande($dateCommande)
{
    $this->dateCommande = $dateCommande;

    return $this;
}

/**
 * Get dateCommande
 *
 * @return \DateTime
 */
public function getDateCommande()
{
    return $this->dateCommande;
}

/**
 * Set email
 *
 * @param string $email
 *
 * @return Commandes
 */
public function setEmail($email)
{
    $this->email = $email;

    return $this;
}

/**
 * Get email
 *
 * @return string
 */
public function getEmail()
{
    return $this->email;
}

/**
 * Set isPurchased
 *
 * @param string $isPurchased
 *
 * @return Commandes
 */
public function setIsPurchased($isPurchased)
{
    $this->isPurchased = $isPurchased;

    return $this;
}

/**
 * Get isPurchased
 *
 * @return string
 */
public function getIsPurchased()
{
    return $this->isPurchased;
}


/**
 * Set typeCmd
 *
 * @param string $typeCmd
 *
 * @return Commandes
 */
public function setTypeCmd($typeCmd)
{
    $this->typeCmd = $typeCmd;

    return $this;
}

/**
 * Get typeCmd
 *
 * @return string
 */
public function getTypeCmd()
{
    return $this->typeCmd;
}

/**
 * Set totalPrice
 *
 * @param integer $totalPrice
 *
 * @return Commandes
 */
public function setTotalPrice($totalPrice)
{
    $this->totalPrice = $totalPrice;

    return $this;
}

/**
 * Get totalPrice
 *
 * @return int
 */
public function getTotalPrice()
{
    return $this->totalPrice;
}

/**
 * Set dateVisite
 *
 * @param \DateTime $dateVisite
 *
 * @return Commandes
 */
public function setDateVisite($dateVisite)
{
    $this->dateVisite = $dateVisite;

    return $this;
}

/**
 * Get dateVisite
 *
 * @return \DateTime
 */
public function getDateVisite()
{
    return $this->dateVisite;

}
/**
 * Constructor
 */

public function __construct()
{
    $this->billets = new \Doctrine\Common\Collections\ArrayCollection();
}

/**
 * Add billet
 *
 * @param \CoreBundle\Entity\Billet $billet
 *
 * @return Commande
 */
public function addBillet(\CoreBundle\Entity\Billet $billet)
{

    $this->billets[] = $billet;
    $billet->setCommande($this);

    return $this;
}
/**
 * Remove billet
 *
 * @param \CoreBundle\Entity\Billet $billet
 */
public function removeBillet(\CoreBundle\Entity\Billet $billet)
{
    $this->billets->removeElement($billet);
}

/**
 * Get billets
 *
 * @return \Doctrine\Common\Collections\Collection
 */
public function getBillets()
{
    return $this->billets;
}
}
