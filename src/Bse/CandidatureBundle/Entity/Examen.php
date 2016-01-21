<?php

namespace Bse\CandidatureBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Examen
 *
 * @ORM\Table(name="examen")
 * @ORM\Entity
 */
class Examen
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_exmen", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idExmen;

    /**
     * @var string
     *
     * @ORM\Column(name="cod_ind", type="string", length=40, nullable=true)
     */
    private $codInd;

    /**
     * @var string
     *
     * @ORM\Column(name="cod_etudiant", type="string", length=40, nullable=true)
     */
    private $codEtudiant;

    /**
     * @var string
     *
     * @ORM\Column(name="cod_annee", type="string", length=40, nullable=true)
     */
    private $codAnnee;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_deb", type="date", nullable=true)
     */
    private $dateDeb;

    /**
     * @var string
     *
     * @ORM\Column(name="dhh_deb", type="string", length=10, nullable=true)
     */
    private $dhhDeb;

    /**
     * @var integer
     *
     * @ORM\Column(name="dur_exa_epr", type="integer", nullable=true)
     */
    private $durExaEpr;

    /**
     * @var string
     *
     * @ORM\Column(name="lib_epr", type="string", length=250, nullable=true)
     */
    private $libEpr;

    /**
     * @var string
     *
     * @ORM\Column(name="cod_nel", type="string", length=40, nullable=true)
     */
    private $codNel;

    /**
     * @var string
     *
     * @ORM\Column(name="salle", type="string", length=250, nullable=true)
     */
    private $salle;

    /**
     * @var string
     *
     * @ORM\Column(name="cod_eprv", type="string", length=40, nullable=true)
     */
    private $codEprv;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datesync", type="datetime", nullable=false)
     */
    private $datesync;

   /**
     * @var integer
     *
     * @ORM\Column(name="etat", type="integer", nullable=true)
     */
    private $etat;

    /**
     * Get idExmen
     *
     * @return integer 
     */
    public function getIdExmen()
    {
        return $this->idExmen;
    }


    /**
     * Set codInd
     *
     * @param string $codInd
     * @return Examen
     */
    public function setCodInd($codInd)
    {
        $this->codInd = $codInd;

        return $this;
    }

    /**
     * Get codInd
     *
     * @return string 
     */
    public function getCodInd()
    {
        return $this->codInd;
    }

    /**
     * Set codEtudiant
     *
     * @param string $codEtudiant
     * @return Examen
     */
    public function setCodEtudiant($codEtudiant)
    {
        $this->codEtudiant = $codEtudiant;

        return $this;
    }

    /**
     * Get codEtudiant
     *
     * @return string 
     */
    public function getCodEtudiant()
    {
        return $this->codEtudiant;
    }

    /**
     * Set codAnnee
     *
     * @param string $codAnnee
     * @return Examen
     */
    public function setCodAnnee($codAnnee)
    {
        $this->codAnnee = $codAnnee;

        return $this;
    }

    /**
     * Get codAnnee
     *
     * @return string 
     */
    public function getCodAnnee()
    {
        return $this->codAnnee;
    }

    /**
     * Set dateDeb
     *
     * @param \DateTime $dateDeb
     * @return Examen
     */
    public function setDateDeb($dateDeb)
    {
        $this->dateDeb = $dateDeb;

        return $this;
    }

    /**
     * Get dateDeb
     *
     * @return \DateTime 
     */
    public function getDateDeb()
    {
        return $this->dateDeb;
    }

    /**
     * Set dhhDeb
     *
     * @param string $dhhDeb
     * @return Examen
     */
    public function setDhhDeb($dhhDeb)
    {
        $this->dhhDeb = $dhhDeb;

        return $this;
    }

    /**
     * Get dhhDeb
     *
     * @return string 
     */
    public function getDhhDeb()
    {
        return $this->dhhDeb;
    }

    /**
     * Set durExaEpr
     *
     * @param integer $durExaEpr
     * @return Examen
     */
    public function setDurExaEpr($durExaEpr)
    {
        $this->durExaEpr = $durExaEpr;

        return $this;
    }

    /**
     * Get durExaEpr
     *
     * @return integer 
     */
    public function getDurExaEpr()
    {
        return $this->durExaEpr;
    }

    /**
     * Set libEpr
     *
     * @param string $libEpr
     * @return Examen
     */
    public function setLibEpr($libEpr)
    {
        $this->libEpr = $libEpr;

        return $this;
    }

    /**
     * Get libEpr
     *
     * @return string 
     */
    public function getLibEpr()
    {
        return $this->libEpr;
    }

    /**
     * Set codNel
     *
     * @param string $codNel
     * @return Examen
     */
    public function setCodNel($codNel)
    {
        $this->codNel = $codNel;

        return $this;
    }

    /**
     * Get codNel
     *
     * @return string 
     */
    public function getCodNel()
    {
        return $this->codNel;
    }

    /**
     * Set salle
     *
     * @param string $salle
     * @return Examen
     */
    public function setSalle($salle)
    {
        $this->salle = $salle;

        return $this;
    }

    /**
     * Get salle
     *
     * @return string 
     */
    public function getSalle()
    {
        return $this->salle;
    }

    /**
     * Set codEprv
     *
     * @param string $codEprv
     * @return Examen
     */
    public function setCodEprv($codEprv)
    {
        $this->codEprv = $codEprv;

        return $this;
    }

    /**
     * Get codEprv
     *
     * @return string 
     */
    public function getCodEprv()
    {
        return $this->codEprv;
    }

    /**
     * Set datesync
     *
     * @param \DateTime $datesync
     * @return Examen
     */
    public function setDatesync($datesync)
    {
        $this->datesync = $datesync;

        return $this;
    }

    /**
     * Get datesync
     *
     * @return \DateTime 
     */
    public function getDatesync()
    {
        return $this->datesync;
    }

       /**
     * Set etat
     *
     * @param integer $etat
     * @return Examen
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;

        return $this;
    }

    /**
     * Get etat
     *
     * @return integer 
     */
    public function getEtat()
    {
        return $this->etat;
    }


    /*****************************************************************************
     **************************** CUSTOM CODE - EXAMEN ****************************
     *****************************************************************************/

    public function getTimeTableData(){
        $day = date('w', strtotime($this->dateDeb->getTimestamp()));
        $ddhDebExploded = explode(':',$this->dhhDeb);
        $start = ($ddhDebExploded[0] - 8);
        $duration = $this->durExaEpr / 60;
        return array('day' => $day, 'start' => $start , 'duration' => $duration);
    }
}
