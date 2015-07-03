<?php
/**
 * Created by JetBrains PhpStorm.
 * User: vitya
 * Date: 03.07.15
 * Time: 14:52
 * To change this template use File | Settings | File Templates.
 */

namespace Redmine\Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CommentController extends Controller
{
    public function showCommentAction(Request $request)
    {
        $project_id = $request->query->get('id');

        $comments = $this->getDoctrine()
            ->getRepository('RedmineBundle:Comment')
            ->getCommentProject($project_id);

        //if (!$comments) {
        //    throw $this->createNotFoundException('No comments found for id '.$project_id);
        //}

        return $this->render('RedmineBundle:Comment:showComment.html.twig',array('comments'=>$comments,'project_id'=>$project_id));
    }

    public function addCommentAction(Request $request)
    {
        $project_id = $request->query->get('id');

        return $this->render('RedmineBundle:Comment:addComment.html.twig');
    }

}