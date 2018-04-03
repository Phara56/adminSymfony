<?php
/**
 * Created by PhpStorm.
 * User: Guillaume
 * Date: 16/03/2018
 * Time: 08:33
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Tag
 * @package AppBundle\Entity
 * @ORM\Entity
 */
class Tag
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", unique=true)
     * @Assert\NotBlank()
     */
    private $name;
    /**
     * @ORM\ManyToMany(targetEntity="Outil", inversedBy="tags")
     * @ORM\JoinTable(name="outil_tag")
     */
    private $outils;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->outils = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add outil
     *
     * @param \AppBundle\Entity\Outil $outil
     *
     * @return Tag
     */
    public function addOutil(\AppBundle\Entity\Outil $outil)
    {
        $this->outils[] = $outil;

        return $this;
    }

    /**
     * Remove outil
     *
     * @param \AppBundle\Entity\Outil $outil
     */
    public function removeOutil(\AppBundle\Entity\Outil $outil)
    {
        $this->outils->removeElement($outil);
    }

    /**
     * Get outils
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getOutils()
    {
        return $this->outils;
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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    public function __toString()
    {
        return $this->getName();
    }
}