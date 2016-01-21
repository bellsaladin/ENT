<?php

namespace Bse\CandidatureBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AnneeUni
 *
 * @ORM\Table(name="annee_uni")
 * @ORM\Entity
 */
class AnneeUni
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_annee_uni", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idAnneeUni;

    /**
     * @var integer
     *
     * @ORM\Column(name="cod_anu", type="integer", nullable=false)
     */
    private $codAnu = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="eta_anu_iae", type="string", length=1, nullable=true)
     */
    private $etaAnuIae;

    /**
     * @var string
     *
     * @ORM\Column(name="lib_anu", type="string", length=120, nullable=true)
     */
    private $libAnu;

    /**
     * @var string
     *
     * @ORM\Column(name="lic_anu", type="string", length=20, nullable=true)
     */
    private $licAnu;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dat_ouv_opi", type="date", nullable=true)
     */
    private $datOuvOpi;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dat_frm_opi", type="date", nullable=true)
     */
    private $datFrmOpi;

    /**
     * @var string
     *
     * @ORM\Column(name="eta_anu_ipe", type="string", length=1, nullable=true)
     */
    private $etaAnuIpe;

    /**
     * @var string
     *
     * @ORM\Column(name="eta_anu_res", type="string", length=1, nullable=true)
     */
    private $etaAnuRes;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datesync", type="datetime", nullable=false)
     */
    private $datesync;



    /**
     * Get idAnneeUni
     *
     * @return integer 
     */
    public function getIdAnneeUni()
    {
        return $this->idAnneeUni;
    }

    /**
     * Set codAnu
     *
     * @param integer $codAnu
     * @return AnneeUni
     */
    public function setCodAnu($codAnu)
    {
        $this->codAnu = $codAnu;

        return $this;
    }

    /**
     * Get codAnu
     *
     * @return integer 
     */
    public function getCodAnu()
    {
        return $this->codAnu;
    }

    /**
     * Set etaAnuIae
     *
     * @param string $etaAnuIae
     * @return AnneeUni
     */
    public function setEtaAnuIae($etaAnuIae)
    {
        $this->etaAnuIae = $etaAnuIae;

        return $this;
    }

    /**
     * Get etaAnuIae
     *
     * @return string 
     */
    public function getEtaAnuIae()
    {
        return $this->etaAnuIae;
    }

    /**
     * Set libAnu
     *
     * @param string $libAnu
     * @return AnneeUni
     */
    public function setLibAnu($libAnu)
    {
        $this->libAnu = $libAnu;

        return $this;
    }

    /**
     * Get libAnu
     *
     * @return string 
     */
    public function getLibAnu()
    {
        return $this->libAnu;
    }

    /**
     * Set licAnu
     *
     * @param string $licAnu
     * @return AnneeUni
     */
    public function setLicAnu($licAnu)
    {
        $this->licAnu = $licAnu;

        return $this;
    }

    /**
     * Get licAnu
     *
     * @return string 
     */
    public function getLicAnu()
    {
        return $this->licAnu;
    }

    /**
     * Set datOuvOpi
     *
     * @param \DateTime $datOuvOpi
     * @return AnneeUni
     */
    public function setDatOuvOpi($datOuvOpi)
    {
        $this->datOuvOpi = $datOuvOpi;

        return $this;
    }

    /**
     * Get datOuvOpi
     *
     * @return \DateTime 
     */
    public function getDatOuvOpi()
    {
        return $this->datOuvOpi;
    }

    /**
     * Set datFrmOpi
     *
     * @param \DateTime $datFrmOpi
     * @return AnneeUni
     */
    public function setDatFrmOpi($datFrmOpi)
    {
        $this->datFrmOpi = $datFrmOpi;

        return $this;
    }

    /**
     * Get datFrmOpi
     *
     * @return \DateTime 
     */
    public function getDatFrmOpi()
    {
        return $this->datFrmOpi;
    }

    /**
     * Set etaAnuIpe
     *
     * @param string $etaAnuIpe
     * @return AnneeUni
     */
    public function setEtaAnuIpe($etaAnuIpe)
    {
        $this->etaAnuIpe = $etaAnuIpe;

        return $this;
    }

    /**
     * Get etaAnuIpe
     *
     * @return string 
     */
    public function getEtaAnuIpe()
    {
        return $this->etaAnuIpe;
    }

    /**
     * Set etaAnuRes
     *
     * @param string $etaAnuRes
     * @return AnneeUni
     */
    public function setEtaAnuRes($etaAnuRes)
    {
        $this->etaAnuRes = $etaAnuRes;

        return $this;
    }

    /**
     * Get etaAnuRes
     *
     * @return string 
     */
    public function getEtaAnuRes()
    {
        return $this->etaAnuRes;
    }

    /**
     * Set datesync
     *
     * @param \DateTime $datesync
     * @return AnneeUni
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
