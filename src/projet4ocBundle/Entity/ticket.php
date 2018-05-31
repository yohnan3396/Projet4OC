<?php

namespace projet4ocBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ticket
 *
 * @ORM\Table(name="ticket")
 * @ORM\Entity(repositoryClass="projet4ocBundle\Repository\ticketRepository")
 */
class Ticket
{

    
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;


    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="surname", type="string", length=255)
     */
    private $surname;

    /**
     * @var string
     *
     * @ORM\Column(name="country", type="string", length=255)
     */
    private $country;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_birth", type="datetime")
     */
    private $dateBirth;

    /**
     * @var string
     *
     * @ORM\Column(name="low_price", type="string", length=255)
     */
    private $lowPrice;

    /**
     * @ORM\ManyToOne(targetEntity="Booking", inversedBy="Ticket")
     * @ORM\JoinColumn(name="booking_id", referencedColumnName="id")
     */
    private $booking;



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
     * Set name
     *
     * @param string $name
     *
     * @return ticket
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set surname
     *
     * @param string $surname
     *
     * @return ticket
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * Get surname
     *
     * @return string
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * Set country
     *
     * @param string $country
     *
     * @return ticket
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
     * Set dateBirth
     *
     * @param \DateTime $dateBirth
     *
     * @return ticket
     */
    public function setDateBirth($dateBirth)
    {
        $this->dateBirth = $dateBirth;

        return $this;
    }

    /**
     * Get dateBirth
     *
     * @return \DateTime
     */
    public function getDateBirth()
    {
        return $this->dateBirth;
    }

    /**
     * Set lowPrice
     *
     * @param string $lowPrice
     *
     * @return ticket
     */
    public function setLowPrice($lowPrice)
    {
        $this->lowPrice = $lowPrice;

        return $this;
    }

    /**
     * Get lowPrice
     *
     * @return string
     */
    public function getLowPrice()
    {
        return $this->lowPrice;
    }

    public function setBooking(Booking $booking)
    {
        $this->booking = $booking;
        return $this;
    }

    public function getBooking()
    {
        return $this->booking;
    }

}

