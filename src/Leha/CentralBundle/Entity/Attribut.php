<?php

namespace Leha\CentralBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Leha\CentralBundle\Entity\AttributRepository")
 * @ORM\Table(name="t_attributs")
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 * @ORM\DiscriminatorMap({"choice" = "AttributChoice", "string" = "AttributString"})
 */
abstract class Attribut
{
    Const SCOPE_ECHANTILLON = 'echantillon';
    Const SCOPE_ATTRIBUT = 'attribut';

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="libelle", type="string", length=100)
     */
    private $libelle;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=500)
     */
    private $description;

    /**
     * @var array
     *
     * @ORM\Column(name="options", type="array")
     */
    private $options;

    /**
     * @var string
     * @ORM\Column(name="scope", columnDefinition="ENUM('echantillon', 'attribut')")
     */
    private $scope;

    /**
     * @var string
     * @ORM\Column(name="name", type="string", length=100)
     */
    private $name;

    /**
     * @var string
     * @ORM\Column(name="reference_solution", type="string", length=200)
     */
    private $reference_solution;

    /**
     * @ORM\OneToMany(targetEntity="Leha\HistoriqueBundle\Entity\AttributRequete", mappedBy="attribut")
     */
    private $attribut_requetes;

    /**
     * @ORM\ManyToMany(targetEntity="Leha\ClientBundle\Entity\Client", mappedBy="attributs")
     */
    private $clients;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->attribut_requetes = new \Doctrine\Common\Collections\ArrayCollection();
        $this->clients = new \Doctrine\Common\Collections\ArrayCollection();
        $this->options = array();
    }
    
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
     * @return Attribut
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

    /**
     * Set description
     *
     * @param string $description
     * @return Attribut
     */
    public function setDescription($description)
    {
        $this->description = $description;
    
        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set options
     *
     * @param array $options
     * @return Attribut
     */
    public function setOptions($options)
    {
        $this->options = $options;
    
        return $this;
    }

    /**
     * Get options
     *
     * @return array 
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * Set scope
     *
     * @param string $scope
     * @return Attribut
     */
    public function setScope($scope)
    {
        $this->scope = $scope;
    
        return $this;
    }

    /**
     * Get scope
     *
     * @return string 
     */
    public function getScope()
    {
        return $this->scope;
    }

    /**
     * Set reference_solution
     *
     * @param string $referenceSolution
     * @return Attribut
     */
    public function setReferenceSolution($referenceSolution)
    {
        $this->reference_solution = $referenceSolution;
    
        return $this;
    }

    /**
     * Get reference_solution
     *
     * @return string 
     */
    public function getReferenceSolution()
    {
        return $this->reference_solution;
    }

    /**
     * Add attribut_requetes
     *
     * @param \Leha\HistoriqueBundle\Entity\AttributRequete $attributRequetes
     * @return Attribut
     */
    public function addAttributRequete(\Leha\HistoriqueBundle\Entity\AttributRequete $attributRequetes)
    {
        $this->attribut_requetes[] = $attributRequetes;
    
        return $this;
    }

    /**
     * Remove attribut_requetes
     *
     * @param \Leha\HistoriqueBundle\Entity\AttributRequete $attributRequetes
     */
    public function removeAttributRequete(\Leha\HistoriqueBundle\Entity\AttributRequete $attributRequetes)
    {
        $this->attribut_requetes->removeElement($attributRequetes);
    }

    /**
     * Get attribut_requetes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAttributRequetes()
    {
        return $this->attribut_requetes;
    }

    public function getFieldId()
    {
        return 'ATTR_'.$this->getId();
    }

    public function getFieldOptions()
    {
        return array(
            'label' => $this->getLibelle(),
            'required' => false
        );
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Attribut
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
}