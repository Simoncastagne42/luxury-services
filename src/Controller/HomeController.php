<?php

namespace App\Controller;

use App\Entity\JobOffers;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
     public function index(EntityManagerInterface $entityManager): Response
        {   
            // Récupérer toutes les offres d'emploi
            $jobOffers = $entityManager->getRepository(JobOffers::class)->findAll();
            return $this->render('job/index.html.twig', [
             'jobOffers' => $jobOffers,
            ]);
        return $this->render('home/index.html.twig', [
          
        ]);
    }
}
