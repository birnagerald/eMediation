<?php

namespace App\Controller;

use App\Entity\Conflict;
use App\Form\Conflict1Type;
use App\Repository\ConflictRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/conflict")
 */
class ConflictController extends AbstractController
{
    /**
     * @Route("/", name="conflict_index", methods={"GET"})
     */
    public function index(ConflictRepository $conflictRepository): Response
    {
        return $this->render('conflict/index.html.twig', [
            'conflicts' => $conflictRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="conflict_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $conflict = new Conflict();
        $form = $this->createForm(Conflict1Type::class, $conflict);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($conflict);
            $entityManager->flush();

            return $this->redirectToRoute('conflict_index');
        }

        return $this->render('conflict/new.html.twig', [
            'conflict' => $conflict,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="conflict_show", methods={"GET"})
     */
    public function show(Conflict $conflict): Response
    {
        return $this->render('conflict/show.html.twig', [
            'conflict' => $conflict,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="conflict_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Conflict $conflict): Response
    {
        $form = $this->createForm(Conflict1Type::class, $conflict);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('conflict_index');
        }

        return $this->render('conflict/edit.html.twig', [
            'conflict' => $conflict,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="conflict_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Conflict $conflict): Response
    {
        if ($this->isCsrfTokenValid('delete'.$conflict->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($conflict);
            $entityManager->flush();
        }

        return $this->redirectToRoute('conflict_index');
    }
}
