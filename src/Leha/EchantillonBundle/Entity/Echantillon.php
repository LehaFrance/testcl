<?php

namespace Leha\EchantillonBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Echantillon
 *
 * @ORM\Table(name="t_echantillons")
 * @ORM\Entity(repositoryClass="Leha\EchantillonBundle\Entity\EchantillonRepository")
 */
class Echantillon
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
     * @ORM\Column(name="prefixe_nom", type="string", length=3)
     */
    private $prefixeNom;

    /**
     * @var integer
     *
     * @ORM\Column(name="demande_numero", type="integer")
     */
    private $demandeNumero;

    /**
     * @var integer
     *
     * @ORM\Column(name="echant_numero", type="integer")
     */
    private $echantNumero;

    /**
     * @var string
     *
     * @ORM\Column(name="etat_reception", type="string", length=20)
     */
    private $etatReception;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_lot", type="integer")
     */
    private $idLot;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_ligne_pla", type="integer")
     */
    private $idLignePla;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_create", type="datetime")
     */
    private $dateCreate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_prevue_reception", type="datetime")
     */
    private $datePrevueReception;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_reelle_reception", type="datetime")
     */
    private $dateReelleReception;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_prevue_bulletin", type="datetime")
     */
    private $datePrevueBulletin;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_reelle_bulletin", type="datetime")
     */
    private $dateReelleBulletin;

    /**
     * @var string
     *
     * @ORM\Column(name="etat_validation_bulletin", type="string", length=20)
     */
    private $etatValidationBulletin;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_client_proprietaire_bulletin", type="integer")
     */
    private $idClientProprietaireBulletin;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_labo_responsable", type="integer")
     */
    private $idLaboResponsable;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_facture", type="integer")
     */
    private $idFacture;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_section", type="integer")
     */
    private $idSection;

    /**
     * @var float
     *
     * @ORM\Column(name="forfait_appro", type="float")
     */
    private $forfaitAppro;

    /**
     * @var string
     *
     * @ORM\Column(name="ceq_commentaire_conforme", type="string", length=255)
     */
    private $ceqCommentaireConforme;

    /**
     * @var string
     *
     * @ORM\Column(name="ceq_commentaire_libre", type="text")
     */
    private $ceqCommentaireLibre;

    /**
     * @ORM\OneToMany(targetEntity="Leha\EchantillonBundle\Entity\AttributEchantillon", mappedBy="echantillon")
     */
    protected $echantillon_attributs;

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
     * Set prefixeNom
     *
     * @param string $prefixeNom
     * @return Echantillon
     */
    public function setPrefixeNom($prefixeNom)
    {
        $this->prefixeNom = $prefixeNom;
    
        return $this;
    }

    /**
     * Get prefixeNom
     *
     * @return string 
     */
    public function getPrefixeNom()
    {
        return $this->prefixeNom;
    }

    /**
     * Set demandeNumero
     *
     * @param integer $demandeNumero
     * @return Echantillon
     */
    public function setDemandeNumero($demandeNumero)
    {
        $this->demandeNumero = $demandeNumero;
    
        return $this;
    }

    /**
     * Get demandeNumero
     *
     * @return integer 
     */
    public function getDemandeNumero()
    {
        return $this->demandeNumero;
    }

    /**
     * Set echantNumero
     *
     * @param integer $echantNumero
     * @return Echantillon
     */
    public function setEchantNumero($echantNumero)
    {
        $this->echantNumero = $echantNumero;
    
        return $this;
    }

    /**
     * Get echantNumero
     *
     * @return integer 
     */
    public function getEchantNumero()
    {
        return $this->echantNumero;
    }

    /**
     * Set etatReception
     *
     * @param string $etatReception
     * @return Echantillon
     */
    public function setEtatReception($etatReception)
    {
        $this->etatReception = $etatReception;
    
        return $this;
    }

    /**
     * Get etatReception
     *
     * @return string 
     */
    public function getEtatReception()
    {
        return $this->etatReception;
    }

    /**
     * Set idLot
     *
     * @param integer $idLot
     * @return Echantillon
     */
    public function setIdLot($idLot)
    {
        $this->idLot = $idLot;
    
        return $this;
    }

    /**
     * Get idLot
     *
     * @return integer 
     */
    public function getIdLot()
    {
        return $this->idLot;
    }

    /**
     * Set idLignePla
     *
     * @param integer $idLignePla
     * @return Echantillon
     */
    public function setIdLignePla($idLignePla)
    {
        $this->idLignePla = $idLignePla;
    
        return $this;
    }

    /**
     * Get idLignePla
     *
     * @return integer 
     */
    public function getIdLignePla()
    {
        return $this->idLignePla;
    }

    /**
     * Set dateCreate
     *
     * @param \DateTime $dateCreate
     * @return Echantillon
     */
    public function setDateCreate($dateCreate)
    {
        $this->dateCreate = $dateCreate;
    
        return $this;
    }

    /**
     * Get dateCreate
     *
     * @return \DateTime 
     */
    public function getDateCreate()
    {
        return $this->dateCreate;
    }

    /**
     * Set datePrevueReception
     *
     * @param \DateTime $datePrevueReception
     * @return Echantillon
     */
    public function setDatePrevueReception($datePrevueReception)
    {
        $this->datePrevueReception = $datePrevueReception;
    
        return $this;
    }

    /**
     * Get datePrevueReception
     *
     * @return \DateTime 
     */
    public function getDatePrevueReception()
    {
        return $this->datePrevueReception;
    }

    /**
     * Set dateReelleReception
     *
     * @param \DateTime $dateReelleReception
     * @return Echantillon
     */
    public function setDateReelleReception($dateReelleReception)
    {
        $this->dateReelleReception = $dateReelleReception;
    
        return $this;
    }

    /**
     * Get dateReelleReception
     *
     * @return \DateTime 
     */
    public function getDateReelleReception()
    {
        return $this->dateReelleReception;
    }

    /**
     * Set datePrevueBulletin
     *
     * @param \DateTime $datePrevueBulletin
     * @return Echantillon
     */
    public function setDatePrevueBulletin($datePrevueBulletin)
    {
        $this->datePrevueBulletin = $datePrevueBulletin;
    
        return $this;
    }

    /**
     * Get datePrevueBulletin
     *
     * @return \DateTime 
     */
    public function getDatePrevueBulletin()
    {
        return $this->datePrevueBulletin;
    }

    /**
     * Set dateReelleBulletin
     *
     * @param \DateTime $dateReelleBulletin
     * @return Echantillon
     */
    public function setDateReelleBulletin($dateReelleBulletin)
    {
        $this->dateReelleBulletin = $dateReelleBulletin;
    
        return $this;
    }

    /**
     * Get dateReelleBulletin
     *
     * @return \DateTime 
     */
    public function getDateReelleBulletin()
    {
        return $this->dateReelleBulletin;
    }

    /**
     * Set etatValidationBulletin
     *
     * @param string $etatValidationBulletin
     * @return Echantillon
     */
    public function setEtatValidationBulletin($etatValidationBulletin)
    {
        $this->etatValidationBulletin = $etatValidationBulletin;
    
        return $this;
    }

    /**
     * Get etatValidationBulletin
     *
     * @return string 
     */
    public function getEtatValidationBulletin()
    {
        return $this->etatValidationBulletin;
    }

    /**
     * Set idClientProprietaireBulletin
     *
     * @param integer $idClientProprietaireBulletin
     * @return Echantillon
     */
    public function setIdClientProprietaireBulletin($idClientProprietaireBulletin)
    {
        $this->idClientProprietaireBulletin = $idClientProprietaireBulletin;
    
        return $this;
    }

    /**
     * Get idClientProprietaireBulletin
     *
     * @return integer 
     */
    public function getIdClientProprietaireBulletin()
    {
        return $this->idClientProprietaireBulletin;
    }

    /**
     * Set idLaboResponsable
     *
     * @param integer $idLaboResponsable
     * @return Echantillon
     */
    public function setIdLaboResponsable($idLaboResponsable)
    {
        $this->idLaboResponsable = $idLaboResponsable;
    
        return $this;
    }

    /**
     * Get idLaboResponsable
     *
     * @return integer 
     */
    public function getIdLaboResponsable()
    {
        return $this->idLaboResponsable;
    }

    /**
     * Set idFacture
     *
     * @param integer $idFacture
     * @return Echantillon
     */
    public function setIdFacture($idFacture)
    {
        $this->idFacture = $idFacture;
    
        return $this;
    }

    /**
     * Get idFacture
     *
     * @return integer 
     */
    public function getIdFacture()
    {
        return $this->idFacture;
    }

    /**
     * Set idSection
     *
     * @param integer $idSection
     * @return Echantillon
     */
    public function setIdSection($idSection)
    {
        $this->idSection = $idSection;
    
        return $this;
    }

    /**
     * Get idSection
     *
     * @return integer 
     */
    public function getIdSection()
    {
        return $this->idSection;
    }

    /**
     * Set forfaitAppro
     *
     * @param float $forfaitAppro
     * @return Echantillon
     */
    public function setForfaitAppro($forfaitAppro)
    {
        $this->forfaitAppro = $forfaitAppro;
    
        return $this;
    }

    /**
     * Get forfaitAppro
     *
     * @return float 
     */
    public function getForfaitAppro()
    {
        return $this->forfaitAppro;
    }

    /**
     * Set ceqCommentaireConforme
     *
     * @param string $ceqCommentaireConforme
     * @return Echantillon
     */
    public function setCeqCommentaireConforme($ceqCommentaireConforme)
    {
        $this->ceqCommentaireConforme = $ceqCommentaireConforme;
    
        return $this;
    }

    /**
     * Get ceqCommentaireConforme
     *
     * @return string 
     */
    public function getCeqCommentaireConforme()
    {
        return $this->ceqCommentaireConforme;
    }

    /**
     * Set ceqCommentaireLibre
     *
     * @param string $ceqCommentaireLibre
     * @return Echantillon
     */
    public function setCeqCommentaireLibre($ceqCommentaireLibre)
    {
        $this->ceqCommentaireLibre = $ceqCommentaireLibre;
    
        return $this;
    }

    /**
     * Get ceqCommentaireLibre
     *
     * @return string 
     */
    public function getCeqCommentaireLibre()
    {
        return $this->ceqCommentaireLibre;
    }
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->echantillon_attributs = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add echantillon_attributs
     *
     * @param \Leha\EchantillonBundle\Entity\AttributEchantillon $echantillonAttributs
     * @return Echantillon
     */
    public function addEchantillonAttribut(\Leha\EchantillonBundle\Entity\AttributEchantillon $echantillonAttributs)
    {
        $this->echantillon_attributs[] = $echantillonAttributs;
    
        return $this;
    }

    /**
     * Remove echantillon_attributs
     *
     * @param \Leha\EchantillonBundle\Entity\AttributEchantillon $echantillonAttributs
     */
    public function removeEchantillonAttribut(\Leha\EchantillonBundle\Entity\AttributEchantillon $echantillonAttributs)
    {
        $this->echantillon_attributs->removeElement($echantillonAttributs);
    }

    /**
     * Get echantillon_attributs
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEchantillonAttributs()
    {
        return $this->echantillon_attributs;
    }
}