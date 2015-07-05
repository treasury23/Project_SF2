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

    public function scheduleIssueAction(Request $request)
    {
        $issue_id = $request->query->get('id');
        $issue = $this->getDoctrine()
            ->getRepository('RedmineBundle:Issue')
            ->find($issue_id);

        if (!$issue) {
            throw $this->createNotFoundException('Project not found for id '.$issue_id);
        }

        $client = new Redmine\Client('https://redmine.ekreative.com', '2fda745bb4cdd835fdf41ec1fab82a13ddc1a54c');

        //get data redmine
        $issueSchedule=$client->api('issue')->show($issue->getRedmineId());
        $em = $this->getDoctrine()->getManager();

        if(!empty($issueSchedule)){

            if(!empty($issueSchedule['issue']['start_date'])){
                $issue->setStart(new DateTime($issueSchedule['issue']['start_date']));
            }

            if(!empty($issueSchedule['issue']['done_ratio'])){
                $issue->setDone($issueSchedule['issue']['done_ratio']);
            }

            if(!empty($issueSchedule['issue']['estimated_hours'])){
                $issue->setEstimated($issueSchedule['issue']['estimated_hours']);
            }

            //if($issue->getSpent()==null && !empty($issueSchedule['issue']['spent_hours'])){
            //    $issue->setSpent($issueSchedule['issue']['spent_hours']);
            //}

            $spent = $this->getDoctrine()
                ->getRepository('RedmineBundle:Log')
                ->getSpent($issue->getId());

            if(!empty($spent[0]['spent'])){
                $issue->setSpent($spent[0]['spent']);
            }

            $em->persist($issue);
                $em->flush();
        }

        return $this->render('RedmineBundle:Project:scheduleIssue.html.twig',array('issue'=>$issue, 'spent'=>$spent));
    }
}