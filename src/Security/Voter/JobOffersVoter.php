<?php

namespace App\Security\Voter;


use App\Entity\JobOffers;
use App\Entity\Recruiter;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

class JobOffersVoter extends Voter
{
    protected function supports(string $attribute, $subject): bool
    {
        return in_array($attribute, ['VIEW', 'EDIT']) && $subject instanceof JobOffers;
    }

    protected function voteOnAttribute(string $attribute, $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();

        // Vérifie si l'utilisateur est bien un recruteur
        if (!$user instanceof Recruiter) {
            return false;
        }

        // Vérifie si l'offre appartient bien au recruteur connecté
        if ($subject->getRecruiter() === $user) {
            return true;
        }

        return false;
    }
}
