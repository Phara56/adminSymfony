<?php
/**
 * Created by PhpStorm.
 * User: PC-Guillaume
 * Date: 03/04/2018
 * Time: 17:02
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="hotel")
 */
class Hotel
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
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     */
    protected $adresse;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank()
     */
    protected $nbchambre;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     */
    protected $tel;

    /**
     * @ORM\Column(type="date")
     * @Assert\NotBlank()
     */
    protected $anneconstruction;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank()
     */
    protected $nbetoile;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     */
    protected $emailcontact;

    /**
     * @ORM\ManyToOne(targetEntity="Ville", inversedBy="hotels")
     * @ORM\JoinColumn(name="ville_id", referencedColumnName="id")
     */
    private $ville;

    /**
     * @ORM\OneToMany(targetEntity="Chambre", mappedBy="hotel")
     */
    private $chambres;

    /**
     * @return mixed
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * @param mixed $ville
     */
    public function setVille($ville)
    {
        $this->ville = $ville;
    }

    /**
     * @param mixed $chambres
     */
    public function setChambres($chambres)
    {
        $this->chambres = $chambres;
    }

    public function __construct()
    {
        $this->chambres = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return mixed
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * @param mixed $adresse
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;
    }

    /**
     * @return mixed
     */
    public function getNbchambre()
    {
        return $this->nbchambre;
    }

    /**
     * @param mixed $nbchambre
     */
    public function setNbchambre($nbchambre)
    {
        $this->nbchambre = $nbchambre;
    }

    /**
     * @return mixed
     */
    public function getTel()
    {
        return $this->tel;
    }

    /**
     * @param mixed $tel
     */
    public function setTel($tel)
    {
        $this->tel = $tel;
    }

    /**
     * @return mixed
     */
    public function getAnneconstruction()
    {
        return $this->anneconstruction;
    }

    /**
     * @param mixed $anneconstruction
     */
    public function setAnneconstruction($anneconstruction)
    {
        $this->anneconstruction = $anneconstruction;
    }

    /**
     * @return mixed
     */
    public function getNbetoile()
    {
        return $this->nbetoile;
    }

    /**
     * @param mixed $nbetoile
     */
    public function setNbetoile($nbetoile)
    {
        $this->nbetoile = $nbetoile;
    }

    /**
     * @return mixed
     */
    public function getEmailcontact()
    {
        return $this->emailcontact;
    }

    /**
     * @param mixed $emailcontact
     */
    public function setEmailcontact($emailcontact)
    {
        $this->emailcontact = $emailcontact;
    }

    public function __toString() {
        return $this->nom.' - '.$this->adresse;
    }
}