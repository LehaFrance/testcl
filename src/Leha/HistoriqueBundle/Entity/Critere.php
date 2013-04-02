<?php

namespace Leha\HistoriqueBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Critere
 *
 * @ORM\Table(name="t_criteres")
 * @ORM\Entity
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="type_critere", type="string")
 * @ORM\DiscriminatorMap({"choice" = "CritereChoixMultiple", "text" = "CritereString", "date" = "CritereDate"})
 */
class Critere
{
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
     * @ORM\Column(name="libelle", type="string", length=255)
     */
    private $libelle;

    /**
     * @var string
     *
     * @ORM\Column(name="field_name", type="string", length=50)
     */
    protected $field_name;
    
    /**
     * @var type 
     * @ORM\Column(name="perimetre_recherche", type="string", length=20)
     */
    protected $perimetre_recherche;
    
    /**
     * @var type 
     * @ORM\Column(name="options", type="string", length=255)
     */
    protected $options;
	
    /**
     * @ORM\OneToMany(targetEntity="Leha\HistoriqueBundle\Entity\CritereRequete", mappedBy="critere")
     */
    protected $criteres_requete;

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
     * @return Critere
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
     * Constructor
     */
    public function __construct()
    {
        $this->criteres_requete = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add criteres_requete
     *
     * @param \Leha\HistoriqueBundle\Entity\CritereRequete $criteresRequete
     * @return Critere
     */
    public function addCriteresRequete(\Leha\HistoriqueBundle\Entity\CritereRequete $criteresRequete)
    {
        $this->criteres_requete[] = $criteresRequete;
    
        return $this;
    }

    /**
     * Remove criteres_requete
     *
     * @param \Leha\HistoriqueBundle\Entity\CritereRequete $criteresRequete
     */
    public function removeCriteresRequete(\Leha\HistoriqueBundle\Entity\CritereRequete $criteresRequete)
    {
        $this->criteres_requete->removeElement($criteresRequete);
    }

    /**
     * Get criteres_requete
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCriteresRequete()
    {
        return $this->criteres_requete;
    }

    /**
     * Set perimetre_recherche
     *
     * @param string $perimetreRecherche
     * @return Critere
     */
    public function setPerimetreRecherche($perimetreRecherche)
    {
        $this->perimetre_recherche = $perimetreRecherche;
    
        return $this;
    }

    /**
     * Get perimetre_recherche
     *
     * @return string 
     */
    public function getPerimetreRecherche()
    {
        return $this->perimetre_recherche;
    }

    /**
     * Set options
     *
     * @param string $options
     * @return Critere
     */
    public function setOptions($options)
    {
        $this->options = $options;
    
        return $this;
    }

    /**
     * Get options
     *
     * @return string 
     */
    public function getOptions()
    {
        return $this->options;
    }
    
    public function getFieldOptions()
    {
        return array(
            'label' => $this->getLibelle()
        );
    }

    public function getFieldId()
    {
        return 'CRIT_'.$this->getId();
    }

    /**
     * Set field_name
     *
     * @param string $fieldName
     * @return Critere
     */
    public function setFieldName($fieldName)
    {
        $this->field_name = $fieldName;
    
        return $this;
    }

    /**
     * Get field_name
     *
     * @return string 
     */
    public function getFieldName()
    {
        return $this->field_name;
    }
}