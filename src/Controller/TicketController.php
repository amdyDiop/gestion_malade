<?php

namespace App\Controller;

use App\Entity\Patient;
use App\Entity\Ticket;
use App\Entity\TypeVisite;
use App\Entity\User;
use App\Form\TicketType;
use App\Form\UserType;
use App\Repository\CaissierRepository;
use App\Repository\ProfilRepository;
use App\Repository\TicketRepository;
use App\Repository\TypeVisiteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use MercurySeries\FlashyBundle\FlashyNotifier;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * @Route("/caissier/ticket")
 */
class TicketController extends AbstractController
{
    private $ticketRep;
    private $caissierRep;
    private $notifier;

    function __construct(FlashyNotifier $notifier, CaissierRepository $caissierRep, TicketRepository $ticketRep)
    {
        $this->ticketRep = $ticketRep;
        $this->caissierRep = $caissierRep;
        $this->notifier = $notifier;
    }

    /**
     * @Route("/", name="ticket_index", methods={"GET"})
     */
    public function index(Request $request, PaginatorInterface $paginator): Response
    {
        $tickets = $paginator->paginate(
            $this->ticketRep->findByToDay(), /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            4 /*limit per page*/
        );
        return $this->render('ticket/index.html.twig', [
            'tickets' => $tickets,
        ]);
    }


    /**
     * @Route("/patient/new", name="patient_new_ticket", methods={"POST"})
     */
    public function newTicketPatient(PaginatorInterface $paginator, EntityManagerInterface $manager, Request $request, CaissierRepository $caissierRepository, ProfilRepository $profilRepository, TypeVisiteRepository $visiteRepository): Response
    {
        $ticket = new Ticket();
        $patient = new Patient();
        $user = new User();

        $data = $request->request->all();
        foreach ($data as $key => $value) {
            if ($value != '') {
                if ($key != "Montant" && $key != "TypeVisite" && $key != "typeVisiteNew") {
                    $set = "set" . $key;
                    if ($key == "DateNaiss") {
                        $dateNaiss = new \DateTime($value);
                        $user->$set($dateNaiss);
                    } else {
                        $user->$set($value);
                    }
                }
                else {
                    if ($key == 'TypeVisite' && $value != "") {
                        $tVisite = $visiteRepository->find($value);
                        $ticket->setTypeVisite($tVisite);
                    } else if ($key == 'typeVisiteNew' && $value != "") {
                        $typevisite = new TypeVisite();
                        $typevisite->setLibelle($value);
                        $ticket->setTypeVisite($typevisite);
                    } else if ($key == 'Montant') {
                        $set = "set" . ucfirst($key);
                        $ticket->$set($value);
                    }
                }
            } elseif($key != 'typeVisiteNew' && $key != 'TypeVisite') {
                $this->notifier->error($key . ' est obligatoire ');
                $tickets = $paginator->paginate(
                    $this->ticketRep->findByToDay(), /* query NOT result */
                    $request->query->getInt('page', 1), /*page number*/
                    4 /*limit per page*/
                );
                return $this->render('ticket/index.html.twig', [
                    'tickets' => $tickets,
                ]);
            }
        }
        $profil = $profilRepository->findBy(['libelle' => "ROLE_PATIENT"]);
        $caissier = $caissierRepository->findByUserEmail($this->getUser()->getUsername());
        $user->setProfil($profil[0]);
        $patient->setUser($user);
        $ticket->setPatient($patient);
        $ticket->setCaissier($caissier[0]);
        $manager->persist($ticket);
        $manager->flush();
        $this->notifier->message('le ticket a été crée');
        $pagination = $paginator->paginate(
            $this->ticketRep->findByToDay(), /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            5 /*limit per page*/
        );
        return $this->render('ticket/index.html.twig', [
            'tickets' => $pagination,

        ]);
    }


    /**
     * @Route("/patient/{id}", name="ticket_patient", methods={"GET","POST"})
     */
    public function ExistedPatient(ValidatorInterface $validator, Patient $patient, Request $request, FlashyNotifier $flashy): Response
    {
        $ticket = new Ticket();

        $form = $this->createForm(TicketType::class, $ticket);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $typeVisite = $request->request->get('ticket')['typeVisite'];
            $newTypeVisite = $request->request->get('typeVisite');
            if ((!$typeVisite && !$newTypeVisite) || ($typeVisite && $newTypeVisite)) {
                $flashy->error("le type de visite est obligatoir et l'ajout du nouveau de viste doit etre remplie si le type de visite n'existe pas");
                return $this->render('ticket/new.html.twig', [
                    'ticket' => $ticket,
                    'form' => $form->createView(),
                ]);
            }
            if ($newTypeVisite) {
                $typeVisite = new  TypeVisite();
                $typeVisite->setLibelle($newTypeVisite);
                $ticket->setTypeVisite($typeVisite);
            }
            $ticket->setPatient($patient);
            $email = $this->getUser()->getUsername();
            $caissier = $this->caissierRep->findByUserEmail($email);
            $ticket->setCaissier($caissier[0]);
            $validator->validate($ticket);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ticket);
            $entityManager->flush();
            $flashy->success("le ticket a été ajouté");
            return $this->redirectToRoute('ticket_index');
        }
        return $this->render('ticket/new.html.twig', [
            'ticket' => $ticket,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ticket_show", methods={"GET"})
     */
    public function show(Ticket $ticket): Response
    {
        return $this->render('ticket/show.html.twig', [
            'ticket' => $ticket,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="ticket_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Ticket $ticket): Response
    {
        $form = $this->createForm(TicketType::class, $ticket);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ticket_index');
        }

        return $this->render('ticket/edit.html.twig', [
            'ticket' => $ticket,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ticket_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Ticket $ticket): Response
    {
        if ($this->isCsrfTokenValid('delete' . $ticket->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($ticket);
            $entityManager->flush();
        }

        return $this->redirectToRoute('ticket_index');
    }
}
