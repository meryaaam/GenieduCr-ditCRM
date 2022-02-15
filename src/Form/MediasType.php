<?php

namespace App\Form;

use App\Entity\Medias;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\Image;
use Symfony\Component\Validator\Constraints\NotNull;


class MediasType extends AbstractType
{
    
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $imageConstraints = [
            // new Image([
            //     'maxSize' => '5M'
            // ]) ,
            new NotNull([
                'message' => 'Veuillez inserer une image'])
        ] ;

        /** @var Medias   $media ; */


        // if (! $media->getNom() ) {
        //     $imageConstraints[] = new NotNull([
        //         'message' => 'Please upload an image',
        //     ]);
        // }

        $builder
            ->add('ImageFile',FileType::class,[
                'required' => true,
                'label'=>false ,
                'constraints' => $imageConstraints
                
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Medias::class,
        ]);
    }
}
