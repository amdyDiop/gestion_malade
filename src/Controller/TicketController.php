<?php

namespace App\Controller;

use App\Entity\Patient;
use App\Entity\Ticket;
use App\Entity\TypeVisite;
use App\Form\TicketType;
use App\Repository\CaissierRepository;
use App\Repository\TicketRepository;
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

    function __construct( CaissierRepository  $caissierRep,TicketRepository $ticketRep)
    {
        $this->ticketRep = $ticketRep;
        $this->caissierRep = $caissierRep;

    }

    /**
     * @Route("/", name="ticket_index", methods={"GET"})
     */
    public function index(): Response
    {
        return $this->render('ticket/index.html.twig', [
            'tickets' => $this->ticketRep->findAll(),
        ]);
    }

    /**
     * @Route("/patient/{id}", name="ticket_patient", methods={"GET","POST"})
     */
    public function ExistedPatient(ValidatorInterface  $validator,Patient $patient, Request $request,  FlashyNotifier $flashy): Response
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
            if ($newTypeVisite){
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
