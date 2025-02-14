<?php

namespace App\Controller\Recruiter;

use App\Entity\JobOffers;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;


class JobOffersCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return JobOffers::class;  
    }

    private AuthorizationCheckerInterface $authorizationChecker;

    public function __construct(AuthorizationCheckerInterface $authorizationChecker)
    {
        $this->authorizationChecker = $authorizationChecker;
    }

    public function someAction(JobOffers $jobOffers)
    {
        // Vérifie si l'utilisateur peut voir l'offre
        if ($this->authorizationChecker->isGranted('view', $jobOffers)) {
            // Afficher l'offre
        } else {
            // Accès interdit
        }
    }
}
