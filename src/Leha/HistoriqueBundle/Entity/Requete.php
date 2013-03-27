<?php
namespace Leha\HistoriqueBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Requete
 * @package Leha\HistoriqueBundle\Entity
 * @ORM\Entity(repositoryClass="Leha\HistoriqueBundle\Entity\RequeteRepository")
 * @ORM\Table(name="t_requete")
 */
class Requete
{
    /**
     * @var
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var
     * @ORM\Column(type="string", length=50)
     * @Assert\NotBlank()
     */
    protected $libelle;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set libelle
     *
     * @param string $libelle
     * @return Requete
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;
    
        return $this;
    }

    /**
     * Get libelle
     *
     * @return string 
     */
    public function getLibelle()
    {
        return $this->libelle;
    }
}