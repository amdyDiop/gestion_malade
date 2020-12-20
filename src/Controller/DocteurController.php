<?php

namespace App\Controller;

use App\Entity\Docteur;
use App\Form\DocteurType;
use App\Repository\DocteurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/docteur")
 */
class DocteurController extends AbstractController
{
    /**
     * @Route("/", name="docteur_index", methods={"GET"})
     */
    public function index(DocteurRepository $docteurRepository): Response
    {
        return $this->render('docteur/index.html.twig', [
            'docteurs' => $docteurRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="docteur_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $docteur = new Docteur();
        $form = $this->createForm(DocteurType::class, $docteur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($docteur);
            $entityManager->flush();

            return $this->redirectToRoute('docteur_index');
        }

        return $this->render('docteur/new.html.twig', [
            'docteur' => $docteur,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="docteur_show", methods={"GET"})
     */
    public function show(Docteur $docteur): Response
    {
        return $this->render('docteur/show.html.twig', [
            'docteur' => $docteur,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="docteur_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Docteur $docteur): Response
    {
        $form = $this->createForm(DocteurType::class, $docteur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('docteur_index');
        }

        return $this->render('docteur/edit.html.twig', [
            'docteur' => $docteur,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="docteur_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Docteur $docteur): Response
    {
        if ($this->isCsrfTokenValid('delete'.$docteur->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($docteur);
            $entityManager->flush();
        }

        return $this->redirectToRoute('docteur_index');
    }
}
