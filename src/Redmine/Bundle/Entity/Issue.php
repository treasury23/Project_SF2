<?php
/**
 * Created by JetBrains PhpStorm.
 * User: vitya
 * Date: 03.07.15
 * Time: 12:52
 * To change this template use File | Settings | File Templates.
 */

namespace Redmine\Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="Issue")
 * @ORM\Entity(repositoryClass="Redmine\Bundle\Repository\IssueRepository")
 */
class Issue {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var integer id
     */
    protected $id;

    /**
     * @ORM\Column(type="integer", name="redmine_id")
     * @var integer redmineId
     */
    protected $redmineId;

    /**
     * @ORM\Column(type="string", length=255)
     * @var string status
     */
    protected $status;

    /**
     * @ORM\Column(type="string", length=255)
     * @var string priority
     */
    protected $priority;

    /**
     * @ORM\Column(type="string", length=1024)
     * @var string subject
     */
    protected $subject;

    /**
     * @ORM\Column(type="string", length=255)
     * @var string author
     */
    protected $author;

    /**
     * @ORM\Column(type="datetime", name="created_at")
     *
     * @var DateTime createdAt
     */
    protected $createdAt;

    /**
     * @ORM\Column(type="datetime", name="updated_at")
     *
     * @var DateTime updatedAt
     */
    protected $updatedAt;

    /**
     * @ORM\Column(type="date", nullable=true)
     *
     * @var Date start
     */
    protected $start;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @var integer done
     */
    protected $done;

    /**
     * @ORM\Column(type="decimal", scale=2, nullable=true)
     * @var decimal estimated
     */
    protected $estimated;

    /**
     * @ORM\Column(type="decimal", scale=2, nullable=true)
     * @var decimal spent
     */
    protected $spent;


    /**
     * @ORM\ManyToOne(targetEntity="Project", inversedBy="issues")
     * @ORM\JoinColumn(name="project_id", referencedColumnName="id")
     *
     **/
    private $project;

    /**
     * @ORM\OneToMany(targetEntity="Log", cascade={"persist"}, mappedBy="issue")
     *
     * @var ArrayCollection $logs;
     **/
    private $logs;


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
     * Set status
     *
     * @param string $status
     * @return Issue
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set priority
     *
     * @param string $priority
     * @return Issue
     */
    public function setPriority($priority)
    {
        $this->priority = $priority;

        return $this;
    }

    /**
     * Get priority
     *
     * @return string 
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * Set subject
     *
     * @param string $subject
     * @return Issue
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * Get subject
     *
     * @return string 
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Set author
     *
     * @param string $author
     * @return Issue
     */
    public function setAuthor($author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return string 
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Issue
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

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return Issue
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set project
     *
     * @param \Redmine\Bundle\Entity\Project $project
     * @return Issue
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
     * Set redmineId
     *
     * @param integer $redmineId
     * @return Issue
     */
    public function setRedmineId($redmineId)
    {
        $this->redmineId = $redmineId;

        return $this;
    }

    /**
     * Get redmineId
     *
     * @return integer 
     */
    public function getRedmineId()
    {
        return $this->redmineId;
    }

    /**
     * Set done
     *
     * @param integer $done
     * @return Issue
     */
    public function setDone($done)
    {
        $this->done = $done;

        return $this;
    }

    /**
     * Get done
     *
     * @return integer 
     */
    public function getDone()
    {
        return $this->done;
    }

    /**
     * Set start
     *
     * @param \DateTime $start
     * @return Issue
     */
    public function setStart($start)
    {
        $this->start = $start;

        return $this;
    }

    /**
     * Get start
     *
     * @return \DateTime 
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * Set estimated
     *
     * @param string $estimated
     * @return Issue
     */
    public function setEstimated($estimated)
    {
        $this->estimated = $estimated;

        return $this;
    }

    /**
     * Get estimated
     *
     * @return string 
     */
    public function getEstimated()
    {
        return $this->estimated;
    }

    /**
     * Set spent
     *
     * @param string $spent
     * @return Issue
     */
    public function setSpent($spent)
    {
        $this->spent = $spent;

        return $this;
    }

    /**
     * Get spent
     *
     * @return string 
     */
    public function getSpent()
    {
        return $this->spent;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->logs = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add logs
     *
     * @param \Redmine\Bundle\Entity\Log $logs
     * @return Issue
     */
    public function addLog(\Redmine\Bundle\Entity\Log $logs)
    {
        $this->logs[] = $logs;

        return $this;
    }

    /**
     * Remove logs
     *
     * @param \Redmine\Bundle\Entity\Log $logs
     */
    public function removeLog(\Redmine\Bundle\Entity\Log $logs)
    {
        $this->logs->removeElement($logs);
    }

    /**
     * Get logs
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getLogs()
    {
        return $this->logs;
    }
}
