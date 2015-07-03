<?php
/**
 * Created by JetBrains PhpStorm.
 * User: vitya
 * Date: 02.07.15
 * Time: 17:33
 * To change this template use File | Settings | File Templates.
 */

namespace Redmine\Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="Project")
 * @ORM\Entity(repositoryClass="Redmine\Bundle\Repository\ProjectRepository")
 */
class Project {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var integer id
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @var string name
     */
    protected $name;

    /**
     * @ORM\Column(type="string", length=32)
     * @var string created_on
     */
    protected $createdAt;

    /**
     * @ORM\OneToMany(targetEntity="Comment", cascade={"persist"}, mappedBy="project")
     *
     * @var ArrayCollection $comments;
     **/
    private $comments;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->comments = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set name
     *
     * @param string $name
     * @return Project
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Add comments
     *
     * @param \Redmine\Bundle\Entity\Comment $comments
     * @return Project
     */
    public function addComment(\Redmine\Bundle\Entity\Comment $comments)
    {
        $this->comments[] = $comments;

        return $this;
    }

    /**
     * Remove comments
     *
     * @param \Redmine\Bundle\Entity\Comment $comments
     */
    public function removeComment(\Redmine\Bundle\Entity\Comment $comments)
    {
        $this->comments->removeElement($comments);
    }

    /**
     * Get comments
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * Set createdAt
     *
     * @param string $createdAt
     * @return Project
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return string 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }
}