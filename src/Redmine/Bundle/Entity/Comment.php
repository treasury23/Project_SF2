<?php
/**
 * Created by JetBrains PhpStorm.
 * User: vitya
 * Date: 02.07.15
 * Time: 15:47
 * To change this template use File | Settings | File Templates.
 */

namespace Redmine\Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="Comment")
 * @ORM\Entity(repositoryClass="Redmine\Bundle\Repository\CommentRepository")
 */
class Comment {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var integer id
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=1024)
     * @var string text
     */
    protected $text;

    /**
     * @ORM\ManyToOne(targetEntity="Project", inversedBy="comments")
     * @ORM\JoinColumn(name="project_id", referencedColumnName="id")
     *
     **/
    private $project;

    /**
     * @ORM\Column(type="string", length=255)
     * @var string user
     */
    protected $user;

    /**
     * @ORM\Column(type="datetime", name="created_at")
     *
     * @var DateTime $createdAt
     */
    protected $createdAt;

    public function __construct() {
        $this->createdAt = new \DateTime();

    }

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
     * Set text
     *
     * @param string $text
     * @return Comment
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get text
     *
     * @return string 
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set project
     *
     * @param \Redmine\Bundle\Entity\Project $project
     * @return Comment
     */
    public function setProject(\Redmine\Bundle\Entity\Project $project = null)
    {
        $this->project = $project;

        return $this;
    }

    /**
     * Get project
     *
     * @return \Redmine\Bundle\Entity\Project 
     */
    public function getProject()
    {
        return $this->project;
    }

    /**
     * Set user
     *
     * @param string $user
     * @return Comment
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

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Comment
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }
}
