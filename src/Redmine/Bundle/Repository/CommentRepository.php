<?php
/**
 * Created by JetBrains PhpStorm.
 * User: vitya
 * Date: 02.07.15
 * Time: 23:13
 * To change this template use File | Settings | File Templates.
 */

namespace Redmine\Bundle\Repository;

use Redmine\Bundle\Entity\Comment;
use Doctrine\ORM\EntityRepository;

class CommentRepository extends EntityRepository
{
    public function getComment($project_id){
        $qb = $this->_em->createQueryBuilder();

        $qb->select('a')
            ->from('Redmine\Bundle\Entity\Comment', 'a')
            ->where('a.project = :project_id')
            ->setParameter('project_id', $project_id);

        return $qb->getQuery()->getResult();
    }
}
