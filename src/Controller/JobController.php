<?php

namespace App\Controller;

use App\Entity\JobOffers;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class JobController extends AbstractController
{
    #[Route('/job', name: 'app_job')]
    public function index(EntityManagerInterface $entityManager): Response
    {
         /** 
         * @var User $user
         */
        $user = $this->getUser();
  
        $candidate = null;
        if ($user instanceof User) {
            $candidate = $user->getCandidate(); 
        }
        // Récupérer toutes les offres d'emploi
        $jobOffers = $entityManager->getRepository(JobOffers::class)->findAll();
  
        
        return $this->render('job/index.html.twig', [
            'jobOffers' => $jobOffers,
            'candidate' => $candidate,

        ]);
    }

    #[Route('/job/{slug}', name: 'app_job_show')]
    public function show(): Response
    {
        return $this->render('job/show.html.twig', []);
    }
}
