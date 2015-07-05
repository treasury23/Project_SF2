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
use Redmine\Bundle\Entity\Log;
use Redmine\Bundle\Form\LogFormType;

class LogController extends Controller
{
    public function addSpentAction(Request $request)
    {
        $issue_id = $request->query->get('id');

        $log = new Log();
        $form = $this->createForm(new LogFormType(),$log);

        if ($request->isMethod('POST')) {

            $form->handleRequest($request);

            if ($form->isValid()) {

                $issue = $this->getDoctrine()
                    ->getRepository('RedmineBundle:Issue')
                    ->find($issue_id);

                if (!$issue) {
                    throw $this->createNotFoundException('Project not found for id '.$issue_id);
                }

                $data = $form->getData();
                $data->setUser($this->getUser());
                $data->setIssue($issue);

                $em = $this->getDoctrine()->getManager();
                $em->persist($data);
                $em->flush();

                return $this->redirect($this->generateUrl('schedule_issue').'?id='.$issue->getId());
            }
        }

        return $this->render('RedmineBundle:Log:addSpent.html.twig',array('form'=>$form->createView(), 'issue_id'=>$issue_id));
    }
}
