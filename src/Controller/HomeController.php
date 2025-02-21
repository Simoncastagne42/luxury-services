<?php

namespace App\Controller;

use App\Entity\JobOffers;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
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
  
        
        return $this->render('home/index.html.twig', [
            'jobOffers' => $jobOffers,
            'candidate' => $candidate,

        ]);
    }
}
