<?php

namespace App\Controller;

use App\Entity\Infirmier;
use App\Entity\Patient;
use App\Entity\User;
use App\Form\InfirmierType;
use App\Form\PatientType;
use App\Repository\InfirmierRepository;
use App\Repository\PatientRepository;
use App\Repository\ProfilRepository;
use Cassandra\Type\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/infirmier")
 */
class InfirmierController extends AbstractController
{

    private $patientRep;
    private $infirmierRep;

    function __construct(InfirmierRepository $infirmierRep, PatientRepository $patientRep)
    {
        $this->patientRep = $patientRep;
        $this->infirmierRep = $infirmierRep;
    }

    /**
     * @Route("/", name="infirmier_index", methods={"GET"})
     */
    public function index(): Response
    {
        return $this->render('infirmier/index.html.twig', [
            'patients' => $this->patientRep->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="infirmier_new", methods={"GET","POST"})
     * public function new(Request $request): Response
     * {
     * $infirmier = new Infirmier();
     * $form = $this->createForm(InfirmierType::class, $infirmier);
     * $form->handleRequest($request);
     *
     * if ($form->isSubmitted() && $form->isValid()) {
     * $entityManager = $this->getDoctrine()->getManager();
     * $entityManager->persist($infirmier);
     * $entityManager->flush();
     *
     * return $this->redirectToRoute('infirmier_index');
     * }
     *
     * return $this->render('infirmier/new.html.twig', [
     * 'infirmier' => $infirmier,
     * 'form' => $form->createView(),
     * ]);
     * }
     */
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
     * @Route("/patient/{id}/edit", name="edit_patient", methods={"GET","POST"})
     */
    public function editPatient(Request $request, User $patient): Response
    {
        $form = $this->createForm(\App\Form\UserType::class, $patient);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('infirmier_index');
        }

        return $this->render('patient/edit.html.twig', [
            'patient' => $patient,
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/{id}", name="infirmier_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Infirmier $infirmier): Response
    {
        if ($this->isCsrfTokenValid('delete' . $infirmier->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($infirmier);
            $entityManager->flush();
        }

        return $this->redirectToRoute('infirmier_index');
    }


    /**
     * @Route("/add/patient", name="infirmier_patient_new", methods={"GET","POST"})
     */
    public function addPatient( Request $request, ProfilRepository $profilRep): Response
    {
        $patient = new Patient();
        $user = new User();
        $form = $this->createForm('App\Form\UserType', $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $patient->setUser($user);
            $profil = $profilRep->findBy(['libelle' => 'ROLE_PATIENT']);
            if ($profil) {
                $user->setProfil($profil[0]);
            }
            $entityManager->persist($patient);
            $entityManager->flush();

            return $this->redirectToRoute('patient_liste');
        }

        return $this->render('patient/new.html.twig', [
            'patient' => $patient,
            'form' => $form->createView(),
        ]);
    }

}
