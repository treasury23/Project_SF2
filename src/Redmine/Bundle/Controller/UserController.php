<?php

namespace Redmine\Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;
use Redmine;
use Redmine\Bundle\Entity\Project;
use DateTime;

class UserController extends Controller
{
    public function homeAction()
    {
        $client = new Redmine\Client('https://redmine.ekreative.com', '2fda745bb4cdd835fdf41ec1fab82a13ddc1a54c');

            //Get data redmine
        $projectsAll=$client->api('project')->all([
            'limit' => 1000
        ]);

        $em = $this->getDoctrine()->getManager();

        if(!empty($projectsAll)){

            foreach($projectsAll{'projects'} as $projectRm){

                $project = $em->getRepository('RedmineBundle:Project')->findOneByRedmineId($projectRm['id']);

                if($project==null){
                    $project = new Project();
                }

                $project->setName($projectRm['name']);
                $project->setRedmineId($projectRm['id']);
                $project->setCreatedAt(new DateTime($projectRm['created_on']));
                $project->setUpdatedAt(new DateTime($projectRm['updated_on']));

                $em->persist($project);
                }

            $em->flush();
        }

        $projects = $this->getDoctrine()
            ->getRepository('RedmineBundle:Project')
            ->findAll();

        return $this->render('RedmineBundle:User:index.html.twig',array('projects'=>$projects));
    }

    public function loginAction(Request $request)
    {

        $authenticationUtils = $this->get('security.authentication_utils');

        $error = $authenticationUtils->getLastAuthenticationError();

        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render(
            'RedmineBundle:User:login.html.twig',
            array(

                'last_username' => $lastUsername,
                'error'         => $error,
            )
        );
    }
}
