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
     * @ORM\Column(type="integer")
     * @var integer project
     */
    protected $project;


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
     * @param integer $project
     * @return Comment
     */
    public function setProject($project)
    {
        $this->project = $project;

        return $this;
    }

    /**
     * Get project
     *
     * @return integer 
     */
    public function getProject()
    {
        return $this->project;
    }
}
