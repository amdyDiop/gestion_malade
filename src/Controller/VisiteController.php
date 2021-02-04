<?php

namespace App\Controller;

use App\Entity\Medicament;
use App\Entity\Ordenance;
use App\Entity\Patient;
use App\Entity\Visite;
use App\Form\VisiteType;
use App\Repository\DocteurRepository;
use App\Repository\MedicamentRepository;
use App\Repository\PatientRepository;
use App\Repository\VisiteRepository;
use MercurySeries\FlashyBundle\FlashyNotifier;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * @Route("/docteur/visite")
 */
class VisiteController extends AbstractController
{
    private $patientRep;
    private $docteurRep;
    private $medicamentRep;

    public function __construct(PatientRepository $patientRep, DocteurRepository $docteurRep, MedicamentRepository $medicamentRep)
    {
        $this->patientRep = $patientRep;
        $this->docteurRep = $docteurRep;
        $this->medicamentRep = $medicamentRep;
    }

    /**
     * @Route("/", name="visite_index", methods={"GET"})
     */
    public function index(VisiteRepository $visiteRepository): Response
    {
        return $this->render('visite/index.html.twig', [
            'visites' => $visiteRepository->findAll(),
        ]);
    }

    /**
     * @Route("/patient/{id}", name="visite_new", methods={"GET","POST"})
     */
    public function new(FlashyNotifier $notifier, ValidatorInterface $validator, Patient $patient, Request $request): Response
    {
        $visite = new Visite();
        $ordenance = new Ordenance();
        $medicament = new Medicament();
        $form = $this->createForm(VisiteType::class, $visite);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $request->request->all();
            foreach ($data['medicament'] as $value) {
                if ($value != '' && strlen($value) < 6) {
                    $ordenance->addMedicament($this->medicamentRep->find($value));
                }
            }
            if ($data['newMedicament'] != '') {
                $medicament->setLibelle($data['newMedicament']);
                $ordenance->addMedicament($medicament);
            }
            $docteur = $this->docteurRep->findByEmail($this->getUser()->getUsername());
            $visite->setDocteur($docteur[0]);
            $visite->setPatient($patient);
            $visite->setOrdenance($ordenance);
            $validator->validate($visite);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($visite);
            $entityManager->flush();
            $notifier->success('le patient a été visité ');
            return $this->redirectToRoute('docteur_index');
        }

        return $this->render('visite/new.html.twig', [
            'visite' => $visite,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="visite_show", methods={"GET"})
     */
    public function show(Visite $visite): Response
    {
        return $this->render('visite/show.html.twig', [
            'visite' => $visite,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="visite_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Visite $visite): Response
    {
        $form = $this->createForm(VisiteType::class, $visite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('visite_index');
        }

        return $this->render('visite/edit.html.twig', [
            'visite' => $visite,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="visite_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Visite $visite): Response
    {
        if ($this->isCsrfTokenValid('delete' . $visite->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($visite);
            $entityManager->flush();
        }

        return $this->redirectToRoute('visite_index');
    }
}
