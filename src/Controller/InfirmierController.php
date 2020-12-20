<?php

namespace App\Controller;

use App\Entity\Infirmier;
use App\Form\InfirmierType;
use App\Repository\InfirmierRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/infirmier")
 */
class InfirmierController extends AbstractController
{
    /**
     * @Route("/", name="infirmier_index", methods={"GET"})
     */
    public function index(InfirmierRepository $infirmierRepository): Response
    {
        return $this->render('infirmier/index.html.twig', [
            'infirmiers' => $infirmierRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="infirmier_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $infirmier = new Infirmier();
        $form = $this->createForm(InfirmierType::class, $infirmier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($infirmier);
            $entityManager->flush();

            return $this->redirectToRoute('infirmier_index');
        }

        return $this->render('infirmier/new.html.twig', [
            'infirmier' => $infirmier,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="infirmier_show", methods={"GET"})
     */
    public function show(Infirmier $infirmier): Response
    {
        return $this->render('infirmier/show.html.twig', [
            'infirmier' => $infirmier,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="infirmier_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Infirmier $infirmier): Response
    {
        $form = $this->createForm(InfirmierType::class, $infirmier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('infirmier_index');
        }

        return $this->render('infirmier/edit.html.twig', [
            'infirmier' => $infirmier,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="infirmier_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Infirmier $infirmier): Response
    {
        if ($this->isCsrfTokenValid('delete'.$infirmier->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($infirmier);
            $entityManager->flush();
        }

        return $this->redirectToRoute('infirmier_index');
    }
}
