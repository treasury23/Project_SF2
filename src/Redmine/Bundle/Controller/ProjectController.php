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
        $issuesAll=$client->api('issue')->showIssueProject($project->getRedmineId());

        $em = $this->getDoctrine()->getManager();

        if(!empty($issuesAll)){

            foreach($issuesAll{'issues'} as $issueRm){

                $issue = $em->getRepository('RedmineBundle:Issue')->findOneByRedmineId($issueRm['id']);

                if($issue==null){
                    $issue = new Issue();
                }

                $issue->setRedmineId($issueRm['id']);
                $issue->setStatus($issueRm['status']['name']);
                $issue->setPriority($issueRm['priority']['name']);
                $issue->setAuthor($issueRm['author']['name']);
                $issue->setSubject($issueRm['subject']);
                $issue->setCreatedAt(new DateTime($issueRm['created_on']));
                $issue->setUpdatedAt(new DateTime($issueRm['updated_on']));
                $issue->setProject($project);

                $em->persist($issue);
            }
            $em->flush();
        }

        $issues = $this->getDoctrine()
            ->getRepository('RedmineBundle:Issue')
            ->getIssueProject($project->getId());

        return $this->render('RedmineBundle:Project:showIssue.html.twig',array('issues'=>$issues));
    }
}