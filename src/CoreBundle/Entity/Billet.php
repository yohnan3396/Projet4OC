<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
* Billet
*
* @ORM\Table(name="billet")
* @ORM\Entity(repositoryClass="CoreBundle\Repository\BilletRepository")
*/
class Billet
{



/**
* @ORM\ManyToOne(targetEntity="CoreBundle\Entity\Commande", inversedBy="billets", cascade={"persist", "remove"})
* @ORM\JoinColumn(name="commande_id", referencedColumnName="id")
*/
private $commande;

/**
 * @var int
 *
 * @ORM\Column(name="id", type="integer")
 * @ORM\Id
 * @ORM\GeneratedValue(strategy="AUTO")
 */
private $id;

/**
 * @var int
 *
 * @ORM\Column(name="commande_id", type="integer")
 */
private $commande_id;

/**
 * @var string
 *
 * @ORM\Column(name="nom", type="string", length=255)
 */
private $nom;


/**
 * @var string
 * @Assert\NotBlank(message="Trop long")
 * @ORM\Column(name="prenom", type="string", length=255)
 */
private $prenom;

/**
 * @var string
 *
 * @ORM\Column(name="country", type="string", length=255)
 */
private $country;

/**
 * @var \DateTime
 *
 * @ORM\Column(name="dateNaissance", type="date")
 */
private $dateNaissance;

/**
 * @var int
 *
 * @ORM\Column(name="typeBillet", type="integer")
 */
private $typeBillet;


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
 * Set nom
 *
 * @param string $nom
 *
 * @return Billets
 */
public function setNom($nom)
{
    $this->nom = $nom;

    return $this;
}

/**
 * Get nom
 *
 * @return string
 */
public function getNom()
{
    return $this->nom;
}

/**
 * Set prenom
 *
 * @param string $prenom
 *
 * @return Billets
 */
public function setPrenom($prenom)
{
    $this->prenom = $prenom;

    return $this;
}

/**
 * Get prenom
 *
 * @return string
 */
public function getPrenom()
{
    return $this->prenom;
}

/**
 * Set country
 *
 * @param string $country
 *
 * @return Billets
 */
public function setCountry($country)
{
    $this->country = $country;

    return $this;
}

/**
 * Get country
 *
 * @return string
 */
public function getCountry()
{
    return $this->country;
}

/**
 * Set dateNaissance
 *
 * @param \DateTime $dateNaissance
 *
 * @return Billets
 */
public function setDateNaissance($dateNaissance)
{
    $this->dateNaissance = $dateNaissance;

    return $this;
}

/**
 * Get dateNaissance
 *
 * @return \DateTime
 */
public function getDateNaissance()
{
    return $this->dateNaissance;
}

/**
 * Set typeBillet
 *
 * @param integer $typeBillet
 *
 * @return Billets
 */
public function setTypeBillet($typeBillet)
{
    $this->typeBillet = $typeBillet;

    return $this;
}

/**
 * Get typeBillet
 *
 * @return int
 */
public function getTypeBillet()
{
    return $this->typeBillet;
}

/**
 * Set commande
 *
 * @param \CoreBundle\Entity\Commande $commande
 *
 * @return Billets
 */
public function setCommande(\CoreBundle\Entity\Commande $commande)
{
    $this->commande = $commande;

    return $this;
}

/**
 * Get commandes
 *
 * @return \CoreBundle\Entity\Commande
 */
public function getCommande()
{
    return $this->commande;
}
}
