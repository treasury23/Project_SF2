<?php
/**
 * Created by JetBrains PhpStorm.
 * User: vitya
 * Date: 05.07.15
 * Time: 15:32
 * To change this template use File | Settings | File Templates.
 */

namespace Redmine\Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class LogController extends Controller
{
    public function addSpentAction(Request $request)
    {
        $issue_id = $request->query->get('id');
        return $this->render('RedmineBundle:Log:addSpent.html.twig',array('issue_id'=>$issue_id));
    }
}
