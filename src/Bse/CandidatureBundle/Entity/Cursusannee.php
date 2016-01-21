<?php

namespace Bse\CandidatureBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cursusannee
 *
 * @ORM\Table(name="cursusannee")
 * @ORM\Entity
 */
class Cursusannee
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
     * @var string
     *
     * @ORM\Column(name="lib_lse", type="string", length=40, nullable=true)
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
     * @ORM\Column(name="lib_elp", type="string", length=400, nullable=true)
     */
    private $libElp;

    /**
     * @var integer
     *
     * @ORM\Column(name="cod_ind", type="integer", nullable=true)
     */
    private $codInd;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datesync", type="datetime", nullable=true)
     */
    private $datesync;



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
     * Set codAnnee
     *
     * @param integer $codAnnee
     * @return Cursusannee
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
     * Set libLse
     *
     * @param string $libLse
     * @return Cursusannee
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
     * Set codElp
     *
     * @param string $codElp
     * @return Cursusannee
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
     * Set libElp
     *
     * @param string $libElp
     * @return Cursusannee
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
     * Set codInd
     *
     * @param integer $codInd
     * @return Cursusannee
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
     * Set datesync
     *
     * @param \DateTime $datesync
     * @return Cursusannee
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
