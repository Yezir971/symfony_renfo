<?php

namespace App\Controller;

use App\Entity\Task;
use App\Form\TaskType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class TaskController extends AbstractController
{
    public function create(string $bodyId, Request $request, ManagerRegistry $doctrine): Response
    {
        $task = new Task();
        $task->setDueDate(new \DateTime('tomorrow'));
        $task->setCover($this->getParameter('default_cover_img'));
        $form = $this->createForm(TaskType::class, $task, ['method' => 'POST']);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            // traitement du formulaire 
            $task = $form->getData();
            $doctrine->getManager()->persist($task);
            $doctrine->getManager()->flush();

            // création de la notification 
            $this->addFlash('success', 'Nouvelle tache crée avec succes');
            return $this->redirectToRoute('app_home');

        }
        return $this->render('task/index.html.twig', [
            'bodyId' => $bodyId,
            'form' => $form,
            'img' => $task->getCover(),
        ]);
    }
}
