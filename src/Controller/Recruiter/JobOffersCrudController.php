<?php

namespace App\Controller\Recruiter;
use App\Entity\JobOffers;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FieldCollection;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FilterCollection;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Dto\EntityDto;
use EasyCorp\Bundle\EasyAdminBundle\Dto\SearchDto;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Orm\EntityRepository;
use Symfony\Component\String\Slugger\SluggerInterface;

class JobOffersCrudController extends AbstractCrudController
{

    public function __construct(private EntityRepository $entityRepository, private SluggerInterface $slugger) {}

    public static function getEntityFqcn(): string
    {
        return JobOffers::class;
    }

    // All jobs created must be linked to the recruiter
    public function createIndexQueryBuilder(SearchDto $searchDto, EntityDto $entityDto, FieldCollection $fields, FilterCollection $filters): QueryBuilder
    {
        /** @var User */
        $user = $this->getUser();
        $recruiter= $user->getRecruiter();

        $response = $this->entityRepository->createQueryBuilder($searchDto, $entityDto, $fields, $filters);
        $response->andWhere('entity.recruiter = :recruiter')->setParameter('recruiter', $recruiter);

        return $response;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('jobTittle'),
            TextField::new('location'),
            TextField::new('description'),
            IntegerField::new('salary'),

            AssociationField::new('jobCategory')->setRequired(true)->autocomplete(), 
         

            TextField::new('slug')->hideOnForm(),
            DateTimeField::new('dateCreated')->hideOnForm(),

        ];
    }

    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        if (!$entityInstance instanceof JobOffers) {
            return;
        }

        /** @var User */
        $user = $this->getUser();
        $recruiter = $user->getRecruiter();
        $entityInstance->setRecruiter($recruiter);
        parent::persistEntity($entityManager, $entityInstance);
    }

    public function updateEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        if (!$entityInstance instanceof JobOffers) {
            return;
        }


        parent::updateEntity($entityManager, $entityInstance);
    }

   
}