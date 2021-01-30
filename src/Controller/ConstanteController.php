<?php

namespace App\Controller;

use App\Entity\Constante;
use App\Form\ConstanteType;
use App\Repository\ConstanceRepository;
use App\Repository\InfirmierRepository;
use App\Repository\PatientRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * @Route("/infirmier/constante")
 */
class ConstanteController extends AbstractController
{
    private $constanteRep;

    function __construct(ConstanceRepository $constanteRep)
    {
        $this->constanteRep = $constanteRep;
    }

    /**
     * @Route("/", name="constante_index", methods={"GET"})
     */
    public function index(Request $request, PaginatorInterface $paginator): Response
    {
        $constantes = $paginator->paginate(
            $this->constanteRep->findAll(), /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            2 /*limit per page*/
        );
        return $this->render('constante/index.html.twig', [
            'constantes' => $constantes,
        ]);
    }

    /**
     * @Route("/patient/{id}", name="constante_new", methods={"GET","POST"})
     */
    public function addConstante(int $id, Request $request, PatientRepository $constanteRep, InfirmierRepository $infirmierRep): Response
    {
        $constante = new Constante();
        $form = $this->createForm(ConstanteType::class, $constante);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $email = $this->getUser()->getUsername();
            $infirmier = $infirmierRep->findByUserId($email);
            $patient = $constanteRep->find($id);
            $constante->setPatient($patient);
            $constante->setInfirmier($infirmier[0]);
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
        if ($this->isCsrfTokenValid('delete' . $constante->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($constante);
            $entityManager->flush();
        }

        return $this->redirectToRoute('constante_index');
    }


    /**
     * @Route("/search", name="constante_search",methods={"GET","POST"})
     */
    public function search(Request $request, SerializerInterface $serializer, ConstanceRepository $constanceRepository)
    {
        if ($request->isXmlHttpRequest()) {
            $value = $request->get('search');
            if ($value == null) {
                $data = $this->constanteRep->findAll();
                $constante = $serializer->serialize($data, 'json', ['groups' => 'constante']);
                return $this->json($constante, 200);
            } else {
                $data = $this->constanteRep->constanteSearch($value);
                $constante = $serializer->serialize($data, 'json', ['groups' => 'constante']);
                return $this->json($constante, 200);


            }
        }
    }

}
