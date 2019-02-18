<?php

namespace AppBundle\Controller;
use AppBundle\Entity\IncidentType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class IncidentTypeController extends Controller
{
    
    public function index()
    {
        return $this->render('incidenttype/index.html.twig', [
            'controller_name' => 'IncidentTypeController',
        ]);
    }
    
    
    
}
