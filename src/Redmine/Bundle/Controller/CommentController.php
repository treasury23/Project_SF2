<?php
/**
 * Created by JetBrains PhpStorm.
 * User: vitya
 * Date: 03.07.15
 * Time: 14:52
 * To change this template use File | Settings | File Templates.
 */

namespace Redmine\Bundle\Controller;

use Redmine\Bundle\Entity\Comment;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Redmine\Bundle\Form\CommentFormType;

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

        return $this->render('RedmineBundle:Comment:showComment.html.twig',array('comments'=>$comments, 'project_id'=>$project_id));
    }

    public function addCommentAction(Request $request)
    {
        $project_id = $request->query->get('id');

        $comment = new Comment();
        $form = $this->createForm(new CommentFormType(),$comment);

        if ($request->isMethod('POST')) {

            $form->handleRequest($request);

            if ($form->isValid()) {

                $project_id = $request->query->get('id');

                $project = $this->getDoctrine()
                    ->getRepository('RedmineBundle:Project')
                    ->find($project_id);

                if (!$project) {
                    throw $this->createNotFoundException('Project not found for id '.$project_id);
                }

                $data = $form->getData();
                $data->setUser($this->getUser());
                $data->setProject($project);

                $em = $this->getDoctrine()->getManager();
                $em->persist($data);
                $em->flush();

                return $this->redirect($this->generateUrl('show_comment').'?id='.$project_id);
            }
        }

        return $this->render('RedmineBundle:Comment:addComment.html.twig', array('form'=>$form->createView(),'project_id'=>$project_id));
    }

}