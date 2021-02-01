<?php

namespace App\Controller;

use App\Entity\TypeVisite;
use App\Form\TypeVisiteType;
use App\Repository\TypeVisiteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * @Route("/type/visite")
 */
class TypeVisiteController extends AbstractController
{
    /**
     * @Route("/", name="type_visite_index", methods={"GET"})
     */
    public function index(SerializerInterface  $serializer,Request $request,TypeVisiteRepository $typeVisiteRepository): Response
    {
       $data = $typeVisiteRepository->findAll();
        if ($request->isXmlHttpRequest() ){
            $patient= $serializer->serialize($data, 'json',['groups'=>'visite']);
            return $this->json($patient,200);
        }
        else {
            return $this->render('type_visite/index.html.twig', [
                'type_visites' => $data,
            ]);
        }
    }

    /**
     * @Route("/new", name="type_visite_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $typeVisite = new TypeVisite();
        $form = $this->createForm(TypeVisiteType::class, $typeVisite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($typeVisite);
            $entityManager->flush();

            return $this->redirectToRoute('type_visite_index');
        }

        return $this->render('type_visite/new.html.twig', [
            'type_visite' => $typeVisite,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="type_visite_show", methods={"GET"})
     */
    public function show(TypeVisite $typeVisite): Response
    {
        return $this->render('type_visite/show.html.twig', [
            'type_visite' => $typeVisite,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="type_visite_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, TypeVisite $typeVisite): Response
    {
        $form = $this->createForm(TypeVisiteType::class, $typeVisite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('type_visite_index');
        }

        return $this->render('type_visite/edit.html.twig', [
            'type_visite' => $typeVisite,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="type_visite_delete", methods={"DELETE"})
     */
    public function delete(Request $request, TypeVisite $typeVisite): Response
    {
        if ($this->isCsrfTokenValid('delete'.$typeVisite->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($typeVisite);
            $entityManager->flush();
        }

        return $this->redirectToRoute('type_visite_index');
    }
}
