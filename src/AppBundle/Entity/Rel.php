<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Rel
 *
 * @ORM\Table(name="rel")
 * @ORM\Entity
 */
class Rel
{
    /**
     * @var integer
     *
     * @ORM\Column(name="ID", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="cat_id", type="integer", nullable=false)
     */
    private $catId;

    /**
     * @var integer
     *
     * @ORM\Column(name="gd_id", type="integer", nullable=false)
     */
    private $gdId;



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
     * Set catId
     *
     * @param integer $catId
     *
     * @return Rel
     */
    public function setCatId($catId)
    {
        $this->catId = $catId;

        return $this;
    }

    /**
     * Get catId
     *
     * @return integer
     */
    public function getCatId()
    {
        return $this->catId;
    }

    /**
     * Set gdId
     *
     * @param integer $gdId
     *
     * @return Rel
     */
    public function setGdId($gdId)
    {
        $this->gdId = $gdId;

        return $this;
    }

    /**
     * Get gdId
     *
     * @return integer
     */
    public function getGdId()
    {
        return $this->gdId;
    }
}
