<?php
/**
 * Created by JetBrains PhpStorm.
 * User: vitya
 * Date: 05.07.15
 * Time: 15:48
 * To change this template use File | Settings | File Templates.
 */

namespace Redmine\Bundle\Repository;

use Redmine\Bundle\Entity\Log;
use Doctrine\ORM\EntityRepository;

class LogRepository extends EntityRepository
{
    public function getSpent($issue_id)
    {
        $qb = $this->_em->createQueryBuilder();

        $qb->select('sum(a.hours) as spent')
            ->from('Redmine\Bundle\Entity\Log', 'a')
            ->where('a.issue = :issue_id')
            ->groupBy('a.issue')
            ->setParameter('issue_id', $issue_id);

        return $qb->getQuery()->getResult();
    }
}