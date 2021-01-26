<?php

namespace App\Controller;

use App\Entity\Constante;
use App\Form\ConstanteType;
use App\Repository\ConstanceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/constante")
 */
class ConstanteController extends AbstractController
{
    /**
     * @Route("/", name="constante_index", methods={"GET"})
     */
    public function index(ConstanceRepository $constanceRepository): Response
    {
        return $this->render('constante/index.html.twig', [
            'constantes' => $constanceRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="constante_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $constante = new Constante();
        $form = $this->createForm(ConstanteType::class, $constante);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($constante);
            $entityManager->flush();

            return $this->redirectToRoute('constante_index');
        }

        return $this->render('constante/new.html.twig', [
            'constante' => $constante,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="constante_show", methods={"GET"})
     */
    public function show(Constante $constante): Response
    {
        return $this->render('constante/show.html.twig', [
            'constante' => $constante,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="constante_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Constante $constante): Response
    {
        $form = $this->createForm(ConstanteType::class, $constante);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('constante_index');
        }

        return $this->render('constante/edit.html.twig', [
            'constante' => $constante,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="constante_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Constante $constante): Response
    {
        if ($this->isCsrfTokenValid('delete'.$constante->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($constante);
            $entityManager->flush();
        }

        return $this->redirectToRoute('constante_index');
    }
}
