<?php

namespace App\Controller;

use App\Entity\Medicament;
use App\Form\MedicamentType;
use App\Repository\MedicamentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * @Route("/medicament")
 */
class MedicamentController extends AbstractController
{
    /**
     * @Route("/", name="medicament_index", methods={"GET"})
     */
    public function index(Request  $request,SerializerInterface  $serializer,MedicamentRepository $medicamentRepository): Response
    {
        $data=$medicamentRepository->findAll();
        if ($request->isXmlHttpRequest() ){
            $patient= $serializer->serialize($data, 'json',['groups'=>'medicaments']);
            return $this->json($patient,200);
        }
        else {
            return $this->render('type_visite/index.html.twig', [
                'type_visites' => $data,
            ]);
        }

        return $this->render('medicament/index.html.twig', [
            'medicaments' => $data,
        ]);
    }

    /**
     * @Route("/new", name="medicament_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $medicament = new Medicament();
        $form = $this->createForm(MedicamentType::class, $medicament);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($medicament);
            $entityManager->flush();

            return $this->redirectToRoute('medicament_index');
        }

        return $this->render('medicament/new.html.twig', [
            'medicament' => $medicament,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="medicament_show", methods={"GET"})
     */
    public function show(Medicament $medicament): Response
    {
        return $this->render('medicament/show.html.twig', [
            'medicament' => $medicament,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="medicament_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Medicament $medicament): Response
    {
        $form = $this->createForm(MedicamentType::class, $medicament);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('medicament_index');
        }

        return $this->render('medicament/edit.html.twig', [
            'medicament' => $medicament,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="medicament_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Medicament $medicament): Response
    {
        if ($this->isCsrfTokenValid('delete'.$medicament->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($medicament);
            $entityManager->flush();
        }

        return $this->redirectToRoute('medicament_index');
    }
}
