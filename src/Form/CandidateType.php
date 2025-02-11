<?php

namespace App\Form;

use App\Entity\Candidate;
use App\Entity\Category;
use App\Entity\Experience;
use App\Entity\Gender;
use App\Entity\User;
use DateTimeImmutable;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class CandidateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstName', TextType::class, [
                'required' => false,
                'attr' => [
                    'class' => 'form-control',
                    'id' => 'first_name',
                ],
                'label' => 'First name',
            ])
            ->add('lastName', TextType::class, [
                'required' => false,
                'attr' => [
                    'class' => 'form-control',
                    'id' => 'last_name',
                ],
                'label' => 'Last name',
            ])

            ->add('adress', TextType::class, [
                'required' => false,
                'attr' => [
                    'class' => 'form-control',
                    'id' => 'adress',
                ],
                'label' => 'Adress',
            ])

            ->add('country', TextType::class, [
                'required' => false,
                'attr' => [
                    'class' => 'form-control',
                    'id' => 'country',
                ],
                'label' => 'Country',
            ])

            ->add('nationality', TextType::class, [
                'required' => false,
                'attr' => [
                    'class' => 'form-control',
                    'id' => 'nationality',
                ],
                'label' => 'Nationality',
            ])

            ->add('currentLocation', TextType::class, [
                'required' => false,
                'label' => 'Current location',
                'attr' => [
                    'id' => 'current_location',
                ],
            ])

            ->add('birthDate', BirthdayType::class, [
                'required' => false,
                'label' => 'Birthdate',
                // 'widget' => 'single_text',
                'attr' => [
                    'class' => 'datepicker',
                    'id' => 'birth_date',
                ],
                'label_attr' => [
                    'class' => 'active',
                ],
                'format' => 'yyyy-MM-dd',

            ])

            ->add('birthPlace', TextType::class, [
                'required' => false,
                'attr' => [
                    'class' => 'form-control',
                    'id' => 'birthPlace',
                ],
                'label' => 'Birthplace',
            ])

            ->add('description', TextareaType::class, [
                'required' => false,
                'label' => 'Short description for your profile, as well as more personnal informations (e.g. your hobbies/interests ). You can also paste any link you want.',
                'attr' => [
                    'id' => 'description',
                    'class' => 'materialize-textarea',
                    'cols' => 50,
                    'rows' => 10,
                ],
            ])

            ->add('passportFile', FileType::class, [
                'mapped' => false,
                'required' => false,
                'attr' => [
                    'accept' => '.pdf,.jpg,.doc,.docx,.png,.jpeg',
                    'size' => 200000000,
                ],
                'constraints' => [
                    new File([
                        'maxSize' => '200M',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                            'image/gif',
                            'application/pdf',
                            'application/msword',
                            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                        ],
                        'mimeTypesMessage' => 'Please upload a valid PDF document',
                    ])
                ],
            ])
            ->add('cvFile', FileType::class, [
                'mapped' => false,
                'required' => false,
                'attr' => [
                    'accept' => '.pdf,.jpg,.doc,.docx,.png,.jpeg',
                    'size' => 200000000,
                ],
                'constraints' => [
                    new File([
                        'maxSize' => '200M',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                            'application/pdf',
                            'application/msword',
                            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                        ],
                        'mimeTypesMessage' => 'Please upload a valid document',
                    ])
                ],
            ])

            ->add('jobCategory', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'name',
                'required' => false,
                'placeholder' => 'Choose an option...',
                'label' => 'Interest in job sector',
                'attr' => [
                    'id' => 'job_sector',
                    'data-placeholder' => 'Type in or Select job sector you would be interested in.',
                ],
                'label_attr' => [
                    'class' => 'active',
                ],
            ])

            ->add('experience', EntityType::class, [
                'class' => Experience::class,
                'choice_label' => 'name',
                'required' => false,
                'placeholder' => 'Choose an option...',
                'label' => 'Experience',
                'attr' => [
                    'id' => 'experience',
                ],
                'label_attr' => [
                    'class' => 'active',
                ],
            ])

            ->add('gender', EntityType::class, [
                'class' => Gender::class,
                'choice_label' => 'name',
                'required' => false,
                'attr' => [
                    'id' => 'gender',
                ],
                'label' => 'Gender',
                'label_attr' => [
                    'class' => 'active',
                ],
                'placeholder' => 'Choose an option...',
            ])
            ->add('profilePictureFile', FileType::class, [
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '20M',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                            'image/gif',
                        ],
                        'mimeTypesMessage' => 'Please upload a valid Image document',
                    ])
                ],
                'attr' => [
                    'accept' => '.jpg,.jpeg,.png,.gif',
                    'id' => 'photo',
                ]
            ])
            ->addEventListener(FormEvents::POST_SUBMIT, $this->setUpdatedAt(...))


        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Candidate::class,
        ]);
    }


    private function setUpdatedAt(FormEvent $event): void
    {
        $candidate = $event->getData();
        $candidate->setUpdatedAt(new DateTimeImmutable());
    }
}
