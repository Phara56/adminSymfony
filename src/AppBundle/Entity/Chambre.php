<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="chambre")
 */
class Chambre
{
  /**
  * @ORM\Id
  * @ORM\Column(type="integer")
  * @ORM\GeneratedValue(strategy="AUTO")
  */
  protected $id;

 /**
 * @ORM\Column(type="string")
 * @Assert\NotBlank()
 */
  protected $nom;

  /**
  * @ORM\Column(type="integer")
  * @Assert\NotBlank()
  */
  protected $nbmcarre;

  /**
  * @ORM\Column(type="integer")
  * @Assert\NotBlank()
  */
  protected $nbpiece;

  /**
  * @ORM\Column(type="integer")
  * @Assert\NotBlank()
  */
  protected $nbsdb;

  /**
  * @ORM\Column(type="integer")
  * @Assert\NotBlank()
  */
  protected $nbchambre;

  /**
  * @ORM\Column(type="integer")
  * @Assert\NotBlank()
  */
  protected $nbpersonne;

  /**
  * @ORM\Column(type="integer")
  * @Assert\NotBlank()
  */
  protected $nblitsolo;

  /**
  * @ORM\Column(type="integer")
  * @Assert\NotBlank()
  */
  protected $nblitdouble;

  /**
  * @ORM\Column(type="boolean")
  */
  protected $animal;

  /**
  * @ORM\Column(type="boolean")
  */
  protected $douche;

  /**
  * @ORM\Column(type="boolean")
  */
  protected $baignoire;

  /**
  * @ORM\Column(type="boolean")
  */
  protected $tv;

  /**
  * @ORM\Column(type="boolean")
  */
  protected $wifi;

  /**
  * @ORM\Column(type="boolean")
  */
   protected $telephone;

    /**
     * @ORM\Column(type="string")
     * @Assert\File(mimeTypes={ "image/png", "image/jpeg" })
     */
    private $image1 = null;

    /**
     * @ORM\Column(type="string")
     * @Assert\File(mimeTypes={ "image/png", "image/jpeg" })
     */
    private $image2 = null;

    /**
     * @ORM\Column(type="string")
     * @Assert\File(mimeTypes={ "image/png", "image/jpeg" })
     */
    private $image3 = null;

    /**
     * @ORM\Column(type="string")
     * @Assert\File(mimeTypes={ "image/png", "image/jpeg" })
     */
    private $image4 = null;

    /**
     * @ORM\Column(type="string")
     * @Assert\File(mimeTypes={ "image/png", "image/jpeg" })
     */
    private $image5 = null;

    /**
     * @ORM\ManyToOne(targetEntity="Hotel", inversedBy="chambres")
     * @ORM\JoinColumn(name="hotel_id", referencedColumnName="id")
     */
    private $hotel;

    /**
     * @ORM\Column(type="integer")
     */
    private $prix;

    /**
     * @ORM\Column(type="datetime")
     */
    private $datepublication;

    /**
     * @return mixed
     */
    public function getHotel()
    {
        return $this->hotel;
    }

    /**
     * @param mixed $hotel
     */
    public function setHotel($hotel)
    {
        $this->hotel = $hotel;
    }

  /**
   * Get the value of Id
   *
   * @return mixed
   */
  public function getId()
  {
      return $this->id;
  }

  /**
   * Set the value of Id
   *
   * @param mixed id
   *
   * @return self
   */
  public function setId($id)
  {
      $this->id = $id;

      return $this;
  }

  /**
   * Get the value of Nom
   *
   * @return mixed
   */
  public function getNom()
  {
      return $this->nom;
  }

  /**
   * Set the value of Nom
   *
   * @param mixed nom
   *
   * @return self
   */
  public function setNom($nom)
  {
      $this->nom = $nom;

      return $this;
  }

  /**
   * Get the value of Nbmcarre
   *
   * @return mixed
   */
  public function getNbmcarre()
  {
      return $this->nbmcarre;
  }

  /**
   * Set the value of Nbmcarre
   *
   * @param mixed nbmcarre
   *
   * @return self
   */
  public function setNbmcarre($nbmcarre)
  {
      $this->nbmcarre = $nbmcarre;

      return $this;
  }

  /**
   * Get the value of Nbpiece
   *
   * @return mixed
   */
  public function getNbpiece()
  {
      return $this->nbpiece;
  }

  /**
   * Set the value of Nbpiece
   *
   * @param mixed nbpiece
   *
   * @return self
   */
  public function setNbpiece($nbpiece)
  {
      $this->nbpiece = $nbpiece;

      return $this;
  }

  /**
   * Get the value of Nbsdb
   *
   * @return mixed
   */
  public function getNbsdb()
  {
      return $this->nbsdb;
  }

  /**
   * Set the value of Nbsdb
   *
   * @param mixed nbsdb
   *
   * @return self
   */
  public function setNbsdb($nbsdb)
  {
      $this->nbsdb = $nbsdb;

      return $this;
  }

  /**
   * Get the value of Nbchambre
   *
   * @return mixed
   */
  public function getNbchambre()
  {
      return $this->nbchambre;
  }

  /**
   * Set the value of Nbchambre
   *
   * @param mixed nbchambre
   *
   * @return self
   */
  public function setNbchambre($nbchambre)
  {
      $this->nbchambre = $nbchambre;

      return $this;
  }

  /**
   * Get the value of Nbpersonne
   *
   * @return mixed
   */
  public function getNbpersonne()
  {
      return $this->nbpersonne;
  }

  /**
   * Set the value of Nbpersonne
   *
   * @param mixed nbpersonne
   *
   * @return self
   */
  public function setNbpersonne($nbpersonne)
  {
      $this->nbpersonne = $nbpersonne;

      return $this;
  }

  /**
   * Get the value of Nblitsolo
   *
   * @return mixed
   */
  public function getNblitsolo()
  {
      return $this->nblitsolo;
  }

  /**
   * Set the value of Nblitsolo
   *
   * @param mixed nblitsolo
   *
   * @return self
   */
  public function setNblitsolo($nblitsolo)
  {
      $this->nblitsolo = $nblitsolo;

      return $this;
  }

  /**
   * Get the value of Nblitdouble
   *
   * @return mixed
   */
  public function getNblitdouble()
  {
      return $this->nblitdouble;
  }

  /**
   * Set the value of Nblitdouble
   *
   * @param mixed nblitdouble
   *
   * @return self
   */
  public function setNblitdouble($nblitdouble)
  {
      $this->nblitdouble = $nblitdouble;

      return $this;
  }

  /**
   * Get the value of Animal
   *
   * @return mixed
   */
  public function getAnimal()
  {
      return $this->animal;
  }

  /**
   * Set the value of Animal
   *
   * @param mixed animal
   *
   * @return self
   */
  public function setAnimal($animal)
  {
      $this->animal = $animal;

      return $this;
  }

  /**
   * Get the value of Douche
   *
   * @return mixed
   */
  public function getDouche()
  {
      return $this->douche;
  }

  /**
   * Set the value of Douche
   *
   * @param mixed douche
   *
   * @return self
   */
  public function setDouche($douche)
  {
      $this->douche = $douche;

      return $this;
  }

  /**
   * Get the value of Baignoire
   *
   * @return mixed
   */
  public function getBaignoire()
  {
      return $this->baignoire;
  }

  /**
   * Set the value of Baignoire
   *
   * @param mixed baignoire
   *
   * @return self
   */
  public function setBaignoire($baignoire)
  {
      $this->baignoire = $baignoire;

      return $this;
  }

  /**
   * Get the value of Tv
   *
   * @return mixed
   */
  public function getTv()
  {
      return $this->tv;
  }

  /**
   * Set the value of Tv
   *
   * @param mixed tv
   *
   * @return self
   */
  public function setTv($tv)
  {
      $this->tv = $tv;

      return $this;
  }

  /**
   * Get the value of Wifi
   *
   * @return mixed
   */
  public function getWifi()
  {
      return $this->wifi;
  }

  /**
   * Set the value of Wifi
   *
   * @param mixed wifi
   *
   * @return self
   */
  public function setWifi($wifi)
  {
      $this->wifi = $wifi;

      return $this;
  }

  /**
   * Get the value of Telephone
   *
   * @return mixed
   */
  public function getTelephone()
  {
      return $this->telephone;
  }

  /**
   * Set the value of Telephone
   *
   * @param mixed telephone
   *
   * @return self
   */
  public function setTelephone($telephone)
  {
      $this->telephone = $telephone;

      return $this;
  }

    /**
     * @return mixed
     */
    public function getImage1()
    {
        return $this->image1;
    }

    /**
     * @param mixed $image1
     */
    public function setImage1($image1)
    {
        $this->image1 = $image1;
    }

    /**
     * @return mixed
     */
    public function getImage2()
    {
        return $this->image2;
    }

    /**
     * @param mixed $image2
     */
    public function setImage2($image2)
    {
        $this->image2 = $image2;
    }

    /**
     * @return mixed
     */
    public function getImage3()
    {
        return $this->image3;
    }

    /**
     * @param mixed $image3
     */
    public function setImage3($image3)
    {
        $this->image3 = $image3;
    }

    /**
     * @return mixed
     */
    public function getImage4()
    {
        return $this->image4;
    }

    /**
     * @param mixed $image4
     */
    public function setImage4($image4)
    {
        $this->image4 = $image4;
    }

    /**
     * @return mixed
     */
    public function getImage5()
    {
        return $this->image5;
    }

    /**
     * @param mixed $image5
     */
    public function setImage5($image5)
    {
        $this->image5 = $image5;
    }

  public function __toString() {
       return $this->nom;
  }

  /**
   * @return mixed
   */
  public function getPrix()
  {
      return $this->prix;
  }

  /**
   * @param mixed $prix
   */
  public function setPrix($prix)
  {
      $this->prix = $prix;
  }

    /**
     * @return mixed
     */
    public function getDatepublication()
    {
        return $this->datepublication;
    }

    /**
     * @param mixed $datepublication
     */
    public function setDatepublication($datepublication)
    {
        $this->datepublication = $datepublication;
    }

    public function __construct()
    {
        $this->datepublication = new \DateTime();
    }

    /**
     * @ORM\OneToOne(targetEntity="Reservation", mappedBy="chambre")
     */
    private $reservationChambre;

    /**
     * @return mixed
     */
    public function getReservationChambre()
    {
        return $this->reservationChambre;
    }

    /**
     * @param mixed $reservationChambre
     */
    public function setReservationChambre($reservationChambre)
    {
        $this->reservationChambre = $reservationChambre;
    }
}
