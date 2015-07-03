<?php
/**
 * Created by JetBrains PhpStorm.
 * User: vitya
 * Date: 03.07.15
 * Time: 12:54
 * To change this template use File | Settings | File Templates.
 */

namespace Redmine\Bundle\Repository;

use Redmine\Bundle\Entity\Issue;
use Doctrine\ORM\EntityRepository;

class IssueRepository extends EntityRepository
{
    public function getIssueProject($project_id)
    {
        $qb = $this->_em->createQueryBuilder();

        $qb->select('a')
            ->from('Redmine\Bundle\Entity\Issue', 'a')
            ->where('a.project = :project_id')
            ->setParameter('project_id', $project_id);

        return $qb->getQuery()->getResult();
    }
}
