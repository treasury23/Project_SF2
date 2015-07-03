<?php

namespace Redmine\Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Redmine;
use Redmine\Bundle\Entity\Issue;
use DateTime;

class ProjectController extends Controller
{
    public function showIssueAction(Request $request)
    {
        $project_id = $request->query->get('id');
        $project = $this->getDoctrine()
            ->getRepository('RedmineBundle:Project')
            ->find($project_id);

        if (!$project) {
            throw $this->createNotFoundException('Project not found for id '.$project_id);
        }

        $client = new Redmine\Client('https://redmine.ekreative.com', '2fda745bb4cdd835fdf41ec1fab82a13ddc1a54c');

        //get data redmine
        //$issuesAll=$client->api('issue')->showIssueProject($project->getRedmineId());

        $em = $this->getDoctrine()->getEntityManager();

        if(!empty($issuesAll)){

            foreach($issuesAll{'issues'} as $issue){
                $issues = new Issue();
                $issues->setRedmineId($issue['id']);
                $issues->setStatus($issue['status']['name']);
                $issues->setPriority($issue['priority']['name']);
                $issues->setAuthor($issue['author']['name']);
                $issues->setSubject($issue['subject']);
                $issues->setCreatedAt(new DateTime($issue['created_on']));
                $issues->setUpdatedAt(new DateTime($issue['updated_on']));
                $issues->setProject($project);

                $em->persist($issues);
            }
            $em->flush();
        }

        $issues = $this->getDoctrine()
            ->getRepository('RedmineBundle:Issue')
            ->getIssueProject($project->getId());

        return $this->render('RedmineBundle:Project:showIssue.html.twig',array('issues'=>$issues));
    }

    public function showCommentAction(Request $request)
    {
        $project_id = $request->query->get('id');

        $comments = $this->getDoctrine()
            ->getRepository('RedmineBundle:Comment')
            ->getCommentProject($project_id);

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