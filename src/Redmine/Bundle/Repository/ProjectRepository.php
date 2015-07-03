<?php
/**
 * Created by JetBrains PhpStorm.
 * User: vitya
 * Date: 02.07.15
 * Time: 18:31
 * To change this template use File | Settings | File Templates.
 */

namespace Redmine\Bundle\Repository;

use Redmine\Bundle\Entity\Project;
use Doctrine\ORM\EntityRepository;

class ProjectRepository extends EntityRepository
{
    public function addProject(Project $project)
    {
        $em = $this->getEntityManager();
        $em->persist($project);
        $em->flush();
    }
}
