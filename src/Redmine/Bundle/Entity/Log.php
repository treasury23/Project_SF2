<?php
/**
 * Created by JetBrains PhpStorm.
 * User: vitya
 * Date: 05.07.15
 * Time: 15:47
 * To change this template use File | Settings | File Templates.
 */

namespace Redmine\Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="Log")
 * @ORM\Entity(repositoryClass="Redmine\Bundle\Repository\LogRepository")
 */
class Log {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var integer id
     */
    protected $id;

    /**
     * @ORM\Column(type="decimal", scale=2)
     * @Assert\NotBlank()
     * @var decimal hours
     */
    protected $hours;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @var string comment
     */
    protected $comment;

    /**
     * @ORM\Column(type="string", length=255)
     * @var string user
     */
    protected $user;

    /**
     * @ORM\ManyToOne(targetEntity="Issue", inversedBy="logs")
     * @ORM\JoinColumn(name="issue_id", referencedColumnName="id")
     *
     **/
    private $issue;

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
     * Set hours
     *
     * @param string $hours
     * @return Log
     */
    public function setHours($hours)
    {
        $this->hours = $hours;

        return $this;
    }

    /**
     * Get hours
     *
     * @return string 
     */
    public function getHours()
    {
        return $this->hours;
    }

    /**
     * Set comment
     *
     * @param string $comment
     * @return Log
     */
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get comment
     *
     * @return string 
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set issue
     *
     * @param \Redmine\Bundle\Entity\Issue $issue
     * @return Log
     */
    public function setIssue(\Redmine\Bundle\Entity\Issue $issue = null)
    {
        $this->issue = $issue;

        return $this;
    }

    /**
     * Get issue
     *
     * @return \Redmine\Bundle\Entity\Issue 
     */
    public function getIssue()
    {
        return $this->issue;
    }

    /**
     * Set user
     *
     * @param string $user
     * @return Log
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return string 
     */
    public function getUser()
    {
        return $this->user;
    }
}
