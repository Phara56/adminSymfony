<?php
/**
 * Created by PhpStorm.
 * User: Guillaume
 * Date: 13/03/2018
 * Time: 16:40
 */

namespace AppBundle\Entity;

use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="integer")
     */
    protected $nbPoint = 0;

    public function __construct()
    {
        parent::__construct();
        // your own logic
    }

    /**
     * @ORM\OneToOne(targetEntity="Reservation", mappedBy="user")
     */
    private $reservationUser;

    /**
     * @return mixed
     */
    public function getReservationUser()
    {
        return $this->reservationUser;
    }

    /**
     * @param mixed $reservationUser
     */
    public function setReservationUser($reservationUser)
    {
        $this->reservationUser = $reservationUser;
    }
}