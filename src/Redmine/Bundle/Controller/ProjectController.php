<?php

namespace Redmine\Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Redmine;

class ProjectController extends Controller
{
    public function showAction(Request $request)
    {
        $project_id = $request->query->get('id');
        $client = new Redmine\Client('https://redmine.ekreative.com', '2fda745bb4cdd835fdf41ec1fab82a13ddc1a54c');

        $issues=$client->api('issue')->showIssueProject($project_id);

        return $this->render('RedmineBundle:Project:showProject.html.twig',array('project'=>$project_id,'issues'=>$issues{'issues'}));
    }
}