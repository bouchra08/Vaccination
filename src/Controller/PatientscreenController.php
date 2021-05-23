<?php

namespace App\Controller;


use App\Entity\Patient;
use App\Entity\Vaccination;
use App\Controller\VaccinationController;
use App\Form\VaccinationType;

use App\Repository\VaccinationRepository;

use App\Form\PatientType;
use App\Repository\PatientRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PatientscreenController extends AbstractController
{
    
    /**
     * @Route("/", name="home")
     */
    public function home()
    {
        return $this->render('patientscreen/patientHome.html.twig');
    }
    /**
     * @Route("/info", name="info")
     */
    public function login(Request $request )
    {
        $patient = new Patient();

        $form = $this->createFormBuilder($patient)
            ->add('CNE')
            ->getForm();
        
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                
    
                return $this->redirectToRoute('patient_rdv', ['CNE' => $patient->getCNE()]);
            }    
        return $this->render('patientscreen/form.html.twig' , [
            'form' => $form->createView() 
        ]);
    }
   
    /**
     * @Route("/rdv", name="patient_rdv", methods={"GET"})
     */
    public function index(VaccinationRepository $vaccinationRepository): Response
    {
        return $this->render('patientscreen/vaccinationRDV.html.twig', [
            'vaccinations' => $vaccinationRepository->findOneByTitle(),
        ]);
    }
    





}
