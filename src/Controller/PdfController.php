<?php

namespace App\Controller;

use App\Entity\Patient;
use App\Entity\Visite;
use App\Repository\VisiteRepository;
use Dompdf\Dompdf;
use Dompdf\Options;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PdfController extends AbstractController
{
    /**
     * @Route("/pdf/{id}/{idV}", name="pdf")
     */
    public function index(Patient $patient, int $idV, VisiteRepository $visiteRepository): Response
    {

        $medecin = $this->getUser();
        $visite = $visiteRepository->find($idV);
        $options = new Options();
        $options->set('defaultFont', 'Roboto');

        $dompdf = new Dompdf($options);


        $html = $this->renderView('pdf/pdf.html.twig', [
            'patient' => $patient,
            'medecin' => $medecin,
            'note' => $visite->getNote(),
        ]);


        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream("testpdf.pdf", [
            "Attachment" => true
        ]);
        return $this->render('pdf/pdf.html.twig', [
            'patient' => $patient,
            'medecin' => $medecin,
            'note' => $visite->getNote(),

        ]);
    }

    /**
     * @Route("/ordenace/{id}", name="ordenace_pdf")
     */
    public function ordenacePdf(Visite $visite, VisiteRepository $visiteRepository): Response
    {
        $options = new Options(array('enable_remote' => true));
        $options->set('defaultFont', 'Roboto');
        $dompdf = new Dompdf($options);
        $html = $this->renderView('pdf/ordenance.html.twig', [
            'visite' => $visite,
        ]);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream("testpdf.pdf", [
            "Attachment" => true
        ]);
        return $this->render('pdf/ordenance.html.twig', [
            'visite' => $visite,
        ]);
    }

}
