<?php

namespace Redmine\Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Redmine;

class ProjectController extends Controller
{
    public function showIssueAction(Request $request)
    {
        $project_id = $request->query->get('id');
        $client = new Redmine\Client('https://redmine.ekreative.com', '2fda745bb4cdd835fdf41ec1fab82a13ddc1a54c');

        $issues=$client->api('issue')->showIssueProject($project_id);

        return $this->render('RedmineBundle:Project:showProject.html.twig',array('issues'=>$issues{'issues'}));
    }

    public function showCommentAction(Request $request)
    {
        $project_id = $request->query->get('id');

        $comments = $this->getDoctrine()
            ->getRepository('RedmineBundle:Comment')
            ->getComment($project_id);

        if (!$comments) {
            throw $this->createNotFoundException('No comments found for id '.$project_id);
        }

        return $this->render('RedmineBundle:Project:showComment.html.twig',array('comments'=>$comments,'project_id'=>$project_id));
    }

    public function addCommentAction(Request $request)
    {
        $project_id = $request->query->get('id');

        return $this->render('RedmineBundle:Project:addComment.html.twig');
    }

}