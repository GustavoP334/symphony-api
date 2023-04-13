<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */

class Series
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    public $id;
    /**
     * @ORM\Column(type="string")
     */
    public $status;
    /**
     * @ORM\Column(type="string")
     */
    public $name;
    /**
     * @ORM\Column(type="integer")
     */
    public $season;
    /**
     * @ORM\Column(type="integer")
     */
    public $episode;
}