<?php

namespace App\Form;

use App\Entity\Task;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
// use Webmozart\Assert\Assert;

class TaskType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('dueDate', DateTimeType::class, [
                'required' => true,
                'label' => 'Date d\'échéance',
                'empty_data' => (new \DateTime('tomorrow')) ->format('Y-m-d H:i:s'),
                'constraints' => [
                    new Assert\Type([
                        'type' => 'datetime',
                        'message' => "Ta date n'est pas une date valide !"
                    ])
                ]
                    
            ])
            ->add('name', TextType::class, [
                'required' => true,
                'label' => 'Titre de la tâche',
                'label_attr' => [
                    "class" => "blue-help"
                ],
                'help' => 'donnez un titre à votre tâche',
                'help_attr' => [
                    "class" => "blue-help"
                ],
                "row_attr" => [
                    "id" => "taskTitle"
                ],
                // 'constraints' => [
                //     new Assert\NotBlank([message => "le type n'est pas bon"])
                // ]
            ])
            ->add('description', TextareaType::class, [
                'required' => false, // par défaut = false, on est pas obligé de le mettre
                'label' => 'Description',
                'attr' => [
                    'rows' => 4
                ],
                'help' => '1500 caractères max',
                'help_attr' => [
                    "class" => "blue-help"
                ],
                'constraints' => [
                    new Assert\Length([
                        'max' => 1500,
                        'maxMessage' => 'Le titre doit contenir au plus {{ limit }} caractères.'
                    ])
                ]
            ])
            ->add('cover', FileType::class, [
                'required' => false,
                'label' => 'Image de couverture',
                'help' => 'charger une image pour la tâche',
                'help_attr' => [
                    "class" => "blue-help"
                ],
                'row_attr' => [
                    "id" => "taskCover"
                ],
                'mapped' => false, // deconnecter ce qu'il y a dans le formulaire de ce qu'il y a dans la bdd
                'constraints' => [
                    new Assert\File([
                        'maxSize' => '5M',
                        'maxSizeMessage' => "L'image ne doit pas dépasser {{ limit }} Mo",
                        'mimeTypes' => [
                            'image/jpg',
                            'image/png',
                            'image/webp',
                            'image/gif'
                        ],
                        'mimeTypesMessage' => 'Formats acceptés : jpg, png, webp, gif'
                    ])
                ]
            ])
            ->add('Enregistrer', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-primary'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Task::class,
        ]);
    }
}
