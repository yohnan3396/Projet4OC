<?php

namespace projet4ocBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * orders
 *
 * @ORM\Table(name="booking")
 * @ORM\Entity(repositoryClass="projet4ocBundle\Repository\BookingRepository")
 */
class Booking
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
     * @var \DateTime
     *
     * @ORM\Column(name="order_date", type="datetime")
     */
    private $orderDate;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="type_ticket", type="string", length=255)
     */
    private $typeTicket;

    /**
     * @var string
     *
     * @ORM\Column(name="total_price", type="string", length=255)
     */
    private $totalPrice;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="visit_date", type="datetime")
     */
    private $visitDate;

    /**
     * @ORM\OneToMany(targetEntity="Ticket", mappedBy="Booking")
     */
    private $ticket;


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
     * Set orderDate
     *
     * @param \DateTime $orderDate
     *
     * @return orders
     */
    public function setOrderDate($orderDate)
    {
        $this->orderDate = $orderDate;

        return $this;
    }

    /**
     * Get orderDate
     *
     * @return \DateTime
     */
    public function getOrderDate()
    {
        return $this->orderDate;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return orders
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
     * Set typeTicket
     *
     * @param string $typeTicket
     *
     * @return orders
     */
    public function setTypeTicket($typeTicket)
    {
        $this->typeTicket = $typeTicket;

        return $this;
    }

    /**
     * Get typeTicket
     *
     * @return string
     */
    public function getTypeTicket()
    {
        return $this->typeTicket;
    }

    /**
     * Set totalPrice
     *
     * @param string $totalPrice
     *
     * @return orders
     */
    public function setTotalPrice($totalPrice)
    {
        $this->totalPrice = $totalPrice;

        return $this;
    }

    /**
     * Get totalPrice
     *
     * @return string
     */
    public function getTotalPrice()
    {
        return $this->totalPrice;
    }

    /**
     * Set visitDate
     *
     * @param \DateTime $visitDate
     *
     * @return orders
     */
    public function setVisitDate($visitDate)
    {
        $this->visitDate = $visitDate;

        return $this;
    }

    /**
     * Get visitDate
     *
     * @return \DateTime
     */
    public function getVisitDate()
    {
        return $this->visitDate;
    }


    public function setTicket(Ticket $ticket)
    {
        $this->tickets[] = $ticket;
        return $this;
    }

    public function getTicket()
    {
        return $this->ticket;
    }

}

