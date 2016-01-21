<?php

namespace Bse\CandidatureBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cursusresultat
 *
 * @ORM\Table(name="cursusresultat", indexes={@ORM\Index(name="fk_cursusresultat_etape_idx", columns={"cod_etp"}), @ORM\Index(name="fk_cursusresultat_etape_idx1", columns={"cod_etp", "cod_annee", "cod_ind"})})
 * @ORM\Entity
 */
class Cursusresultat
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_cursus", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idCursus;

    /**
     * @var integer
     *
     * @ORM\Column(name="cod_annee", type="integer", nullable=true)
     */
    private $codAnnee;


    /**
     * @var integer
     *
     * @ORM\Column(name="cod_annee2", type="integer", nullable=true)
     */
    private $codAnnee2;

     /**
     * @var string
     *
     * @ORM\Column(name="lib_lse", type="text", nullable=true)
     */
    private $libLse;

     /**
     * @var string
     *
     * @ORM\Column(name="cod_elp", type="string", length=20, nullable=true)
     */
    private $codElp;

    /**
     * @var string
     *
     * @ORM\Column(name="lib_elp", type="text", nullable=true)
     */
    private $libElp;

    /**
     * @var integer
     *
     * @ORM\Column(name="cod_ind", type="integer", nullable=true)
     */
    private $codInd;

     /**
     * @var string
     *
     * @ORM\Column(name="note", type="string", length=40, nullable=true)
     */
    private $note;

    /**
     * @var string
     *
     * @ORM\Column(name="resultat", type="string", length=40, nullable=true)
     */
    private $resultat;

        /**
     * @var \DateTime
     *
     * @ORM\Column(name="datesync", type="datetime", nullable=false)
     */
    private $datesync;

        /**
     * @var integer
     *
     * @ORM\Column(name="cod_session", type="integer", nullable=true)
     */
    private $codSession;

        /**
     * @var integer
     *
     * @ORM\Column(name="etat", type="integer", nullable=true)
     */
    private $etat;

    

    /**
     * Get idCursus
     *
     * @return integer 
     */
    public function getIdCursus()
    {
        return $this->idCursus;
    }

    /**
     * Set codInd
     *
     * @param integer $codInd
     * @return Cursusresultat
     */
    public function setCodInd($codInd)
    {
        $this->codInd = $codInd;

        return $this;
    }


    /**
     * Get codInd
     *
     * @return integer 
     */
    public function getCodInd()
    {
        return $this->codInd;
    }



    /**
     * Set codElp
     *
     * @param string $codElp
     * @return Cursusresultat
     */
    public function setCodElp($codElp)
    {
        $this->codElp = $codElp;

        return $this;
    }

    /**
     * Get codElp
     *
     * @return string 
     */
    public function getCodElp()
    {
        return $this->codElp;
    }


    /**
     * Set codAnnee
     *
     * @param integer $codAnnee
     * @return Cursusresultat
     */
    public function setCodAnnee($codAnnee)
    {
        $this->codAnnee = $codAnnee;

        return $this;
    }

    /**
     * Get codAnnee
     *
     * @return integer 
     */
    public function getCodAnnee()
    {
        return $this->codAnnee;
    }


       /**
     * Set codAnnee
     *
     * @param integer $codAnnee2
     * @return Cursusresultat
     */
    public function setCodAnnee2($codAnnee2)
    {
        $this->codAnnee2 = $codAnnee2;

        return $this;
    }

    /**
     * Get codAnnee2
     *
     * @return integer 
     */
    public function getCodAnnee2()
    {
        return $this->codAnnee2;
    }



    /**
     * Set note
     *
     * @param string $note
     * @return Cursusresultat
     */
    public function setNote($note)
    {
        $this->note = $note;

        return $this;
    }

    /**
     * Get note
     *
     * @return string 
     */
    public function getNote()
    {
        return $this->note;
    }



    /**
     * Set libElp
     *
     * @param string $libElp
     * @return Cursusresultat
     */
    public function setLibElp($libElp)
    {
        $this->libElp = $libElp;

        return $this;
    }

    /**
     * Get libElp
     *
     * @return string 
     */
    public function getLibElp()
    {
        return $this->libElp;
    }

    /**
     * Set codSession
     *
     * @param integer $codSession
     * @return Cursusresultat
     */
    public function setCodSession($codSession)
    {
        $this->codSession = $codSession;

        return $this;
    }

    /**
     * Get codSession
     *
     * @return integer 
     */
    public function getCodSession()
    {
        return $this->codSession;
    }


      /**
     * Set etat
     *
     * @param integer $etat
     * @return Cursusresultat
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


    /**
     * Set resultat
     *
     * @param string $resultat
     * @return Cursusresultat
     */
    public function setResultat($resultat)
    {
        $this->resultat = $resultat;

        return $this;
    }

    /**
     * Get resultat
     *
     * @return string 
     */
    public function getResultat()
    {
        return $this->resultat;
    }

    /**
     * Set libLse
     *
     * @param string $libLse
     * @return Cursusresultat
     */
    public function setLibLse($libLse)
    {
        $this->libLse = $libLse;

        return $this;
    }

    /**
     * Get libLse
     *
     * @return string 
     */
    public function getLibLse()
    {
        return $this->libLse;
    }


    /**
     * Set datesync
     *
     * @param \DateTime $datesync
     * @return Cursusresultat
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
    
}
