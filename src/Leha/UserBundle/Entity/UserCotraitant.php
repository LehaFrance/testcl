<?php
/**
 * @author oyacoubi <oyacoubi@leha-labo.com>
 */
namespace Leha\UserBundle\Entity;

use Leha\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Cotraitant
 * @ORM\Table(name="t_usercotraitant")
 * @ORM\Entity
 */
class UserCotraitant extends BaseUser
{
    /**
     * @var
     * @ORM\Column(name="laboratoire", type="string", length=100)
     */
    protected $labo;


    /**
     * @return string
     */
    public function getLabo()
    {
        return $this->labo;
    }

    /**
     * @param string
     */
    public function setlabo($labo)
    {
        $this->labo = $labo;
    }


}