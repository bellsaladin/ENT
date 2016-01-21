<?php

namespace Bse\CandidatureBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Etape
 *
 * @ORM\Table(name="etape")
 * @ORM\Entity
 */
class Etape
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_etape", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idEtape;

    /**
     * @var string
     *
     * @ORM\Column(name="cod_etp", type="string", length=40, nullable=false)
     */
    private $codEtp;

    /**
     * @var integer
     *
     * @ORM\Column(name="cod_ind", type="integer", nullable=false)
     */
    private $codInd;

    /**
     * @var string
     *
     * @ORM\Column(name="lib_etp", type="string", length=200, nullable=true)
     */
    private $libEtp;

    /**
     * @var integer
     *
     * @ORM\Column(name="cod_annee", type="integer", nullable=false)
     */
    private $codAnnee;

    /**
     * @var string
     *
     * @ORM\Column(name="lib_dip", type="string", length=250, nullable=true)
     */
    private $libDip;

    /**
     * @var string
     *
     * @ORM\Column(name="lic_dip", type="string", length=250, nullable=true)
     */
    private $licDip;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datesync", type="datetime", nullable=false)
     */
    private $datesync;



    /**
     * Get idEtape
     *
     * @return integer 
     */
    public function getIdEtape()
    {
        return $this->idEtape;
    }

    /**
     * Set codEtp
     *
     * @param string $codEtp
     * @return Etape
     */
    public function setCodEtp($codEtp)
    {
        $this->codEtp = $codEtp;

        return $this;
    }

    /**
     * Get codEtp
     *
     * @return string 
     */
    public function getCodEtp()
    {
        return $this->codEtp;
    }

    /**
     * Set codInd
     *
     * @param integer $codInd
     * @return Etape
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
     * Set libEtp
     *
     * @param string $libEtp
     * @return Etape
     */
    public function setLibEtp($libEtp)
    {
        $this->libEtp = $libEtp;

        return $this;
    }

    /**
     * Get libEtp
     *
     * @return string 
     */
    public function getLibEtp()
    {
        return $this->libEtp;
    }

    /**
     * Set codAnnee
     *
     * @param integer $codAnnee
     * @return Etape
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
     * Set libDip
     *
     * @param string $libDip
     * @return Etape
     */
    public function setLibDip($libDip)
    {
        $this->libDip = $libDip;

        return $this;
    }

    /**
     * Get libDip
     *
     * @return string 
     */
    public function getLibDip()
    {
        return $this->libDip;
    }

    /**
     * Set licDip
     *
     * @param string $licDip
     * @return Etape
     */
    public function setLicDip($licDip)
    {
        $this->licDip = $licDip;

        return $this;
    }

    /**
     * Get licDip
     *
     * @return string 
     */
    public function getLicDip()
    {
        return $this->licDip;
    }

    /**
     * Set datesync
     *
     * @param \DateTime $datesync
     * @return Etape
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
