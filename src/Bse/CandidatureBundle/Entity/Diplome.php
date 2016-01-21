<?php

namespace Bse\CandidatureBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Diplome
 *
 * @ORM\Table(name="diplome")
 * @ORM\Entity
 */
class Diplome
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_diplome", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idDiplome;

    /**
     * @var integer
     *
     * @ORM\Column(name="cod_ind", type="integer", nullable=true)
     */
    private $codInd;

    /**
     * @var string
     *
     * @ORM\Column(name="cod_dip", type="string", length=100, nullable=true)
     */
    private $codDip;

    /**
     * @var string
     *
     * @ORM\Column(name="lic_vdi", type="string", length=40, nullable=true)
     */
    private $licVdi;

    /**
     * @var string
     *
     * @ORM\Column(name="lib_dip", type="text", nullable=true)
     */
    private $libDip;

    /**
     * @var integer
     *
     * @ORM\Column(name="cod_annee", type="integer", nullable=true)
     */
    private $codAnnee;

    /**
     * @var integer
     *
     * @ORM\Column(name="cod_sesion", type="integer", nullable=true)
     */
    private $codSesion;

    /**
     * @var string
     *
     * @ORM\Column(name="not_vdi", type="string", length=10, nullable=true)
     */
    private $notVdi;

    /**
     * @var string
     *
     * @ORM\Column(name="cod_tre", type="string", length=10, nullable=true)
     */
    private $codTre;

    /**
     * @var string
     *
     * @ORM\Column(name="not_vdi_1", type="string", length=10, nullable=true)
     */
    private $notVdi1;

    /**
     * @var integer
     *
     * @ORM\Column(name="num_obt_vdi", type="integer", nullable=true)
     */
    private $numObtVdi;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datesync", type="datetime", nullable=false)
     */
    private $datesync;



    /**
     * Get idDiplome
     *
     * @return integer 
     */
    public function getIdDiplome()
    {
        return $this->idDiplome;
    }

    /**
     * Set codInd
     *
     * @param integer $codInd
     * @return Diplome
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
     * Set codDip
     *
     * @param string $codDip
     * @return Diplome
     */
    public function setCodDip($codDip)
    {
        $this->codDip = $codDip;

        return $this;
    }

    /**
     * Get codDip
     *
     * @return string 
     */
    public function getCodDip()
    {
        return $this->codDip;
    }

    /**
     * Set licVdi
     *
     * @param string $licVdi
     * @return Diplome
     */
    public function setLicVdi($licVdi)
    {
        $this->licVdi = $licVdi;

        return $this;
    }

    /**
     * Get licVdi
     *
     * @return string 
     */
    public function getLicVdi()
    {
        return $this->licVdi;
    }

    /**
     * Set libDip
     *
     * @param string $libDip
     * @return Diplome
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
     * Set codAnnee
     *
     * @param integer $codAnnee
     * @return Diplome
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
     * Set codSesion
     *
     * @param integer $codSesion
     * @return Diplome
     */
    public function setCodSesion($codSesion)
    {
        $this->codSesion = $codSesion;

        return $this;
    }

    /**
     * Get codSesion
     *
     * @return integer 
     */
    public function getCodSesion()
    {
        return $this->codSesion;
    }

    /**
     * Set notVdi
     *
     * @param string $notVdi
     * @return Diplome
     */
    public function setNotVdi($notVdi)
    {
        $this->notVdi = $notVdi;

        return $this;
    }

    /**
     * Get notVdi
     *
     * @return string 
     */
    public function getNotVdi()
    {
        return $this->notVdi;
    }

    /**
     * Set codTre
     *
     * @param string $codTre
     * @return Diplome
     */
    public function setCodTre($codTre)
    {
        $this->codTre = $codTre;

        return $this;
    }

    /**
     * Get codTre
     *
     * @return string 
     */
    public function getCodTre()
    {
        return $this->codTre;
    }

    /**
     * Set notVdi1
     *
     * @param string $notVdi1
     * @return Diplome
     */
    public function setNotVdi1($notVdi1)
    {
        $this->notVdi1 = $notVdi1;

        return $this;
    }

    /**
     * Get notVdi1
     *
     * @return string 
     */
    public function getNotVdi1()
    {
        return $this->notVdi1;
    }

    /**
     * Set numObtVdi
     *
     * @param integer $numObtVdi
     * @return Diplome
     */
    public function setNumObtVdi($numObtVdi)
    {
        $this->numObtVdi = $numObtVdi;

        return $this;
    }

    /**
     * Get numObtVdi
     *
     * @return integer 
     */
    public function getNumObtVdi()
    {
        return $this->numObtVdi;
    }

    /**
     * Set datesync
     *
     * @param \DateTime $datesync
     * @return Diplome
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
