<?php

namespace Bse\CandidatureBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Bac
 *
 * @ORM\Table(name="bac")
 * @ORM\Entity
 */
class Bac
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_bac", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idBac;

    /**
     * @var integer
     *
     * @ORM\Column(name="cod_ind", type="integer", nullable=true)
     */
    private $codInd;

    /**
     * @var string
     *
     * @ORM\Column(name="serie", type="string", length=40, nullable=true)
     */
    private $serie;

    /**
     * @var string
     *
     * @ORM\Column(name="mention", type="string", length=40, nullable=true)
     */
    private $mention;

    /**
     * @var string
     *
     * @ORM\Column(name="etablissmenet", type="string", length=40, nullable=true)
     */
    private $etablissmenet;

    /**
     * @var string
     *
     * @ORM\Column(name="province", type="string", length=40, nullable=true)
     */
    private $province;

    /**
     * @var string
     *
     * @ORM\Column(name="date", type="string", length=20, nullable=true)
     */
    private $date;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datesync", type="datetime", nullable=false)
     */
    private $datesync;



    /**
     * Get idBac
     *
     * @return integer 
     */
    public function getIdBac()
    {
        return $this->idBac;
    }

    /**
     * Set codInd
     *
     * @param integer $codInd
     * @return Bac
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
     * Set serie
     *
     * @param string $serie
     * @return Bac
     */
    public function setSerie($serie)
    {
        $this->serie = $serie;

        return $this;
    }

    /**
     * Get serie
     *
     * @return string 
     */
    public function getSerie()
    {
        return $this->serie;
    }

    /**
     * Set mention
     *
     * @param string $mention
     * @return Bac
     */
    public function setMention($mention)
    {
        $this->mention = $mention;

        return $this;
    }

    /**
     * Get mention
     *
     * @return string 
     */
    public function getMention()
    {
        return $this->mention;
    }

    /**
     * Set etablissmenet
     *
     * @param string $etablissmenet
     * @return Bac
     */
    public function setEtablissmenet($etablissmenet)
    {
        $this->etablissmenet = $etablissmenet;

        return $this;
    }

    /**
     * Get etablissmenet
     *
     * @return string 
     */
    public function getEtablissmenet()
    {
        return $this->etablissmenet;
    }

    /**
     * Set province
     *
     * @param string $province
     * @return Bac
     */
    public function setProvince($province)
    {
        $this->province = $province;

        return $this;
    }

    /**
     * Get province
     *
     * @return string 
     */
    public function getProvince()
    {
        return $this->province;
    }

    /**
     * Set date
     *
     * @param string $date
     * @return Bac
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return string 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set datesync
     *
     * @param \DateTime $datesync
     * @return Bac
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
