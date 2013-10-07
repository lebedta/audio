<?php
// src/Acme/UserBundle/Entity/User.php

namespace Acme\UserBundle\Entity;

use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="first_name", type="string", nullable=false, length=255)
     * @Assert\NotBlank(groups={"SimpleUser"})
     * @JMS\Groups({"detailed", "icard_full", "icard"})
     */
    protected $first_name;

    /**
     * @var string
     *
     * @ORM\Column(name="last_name", type="string", nullable=false, length=255)
     * @Assert\NotBlank(groups={"SimpleUser"})
     * @JMS\Groups({"detailed", "icard_full", "icard"})
     */
    protected $last_name;

    public function __construct()
    {
        parent::__construct();
        // your own logic
    }
}