<?php

namespace Redmine\Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;
use Redmine;

class UserController extends Controller
{
    public function homeAction()
    {
        $client = new Redmine\Client('https://redmine.ekreative.com', '2fda745bb4cdd835fdf41ec1fab82a13ddc1a54c');

        $projects=$client->api('project')->all([
            'limit' => 1000
        ]);

        return $this->render('RedmineBundle:User:index.html.twig',array('client'=>$client,'projects'=>$projects{'projects'}));
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
