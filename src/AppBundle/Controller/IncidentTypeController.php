<?php

namespace App\Controller;
use App\Entity\IncidentType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class IncidentTypeController extends Controller
{
    /**
     * @Route("/incident/types", name="incidenttype")
     */
    public function index()
    {
        return $this->render('incidenttype/index.html.twig', [
            'controller_name' => 'IncidentTypeController',
        ]);
    }
    
    
    
}
