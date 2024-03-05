<?php
// src/Form/FactureType.php

namespace App\Form;

use App\Entity\Facture;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FactureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // Calculer la date deux jours après la date actuelle
        $twoDaysLater = new \DateTime('+2 days');

        $builder
            ->add('montant', MoneyType::class)
            ->add('dateReservation', DateType::class, [
                'widget' => 'single_text',
                'html5' => true,
                'attr' => [
                    'min' => $twoDaysLater->format('Y-m-d'), // Restreindre aux jours à partir de deux jours après la date actuelle
                    'onchange' => 'checkDayOfWeek(this)', // Appel de la fonction JavaScript pour vérifier le jour de la semaine
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Facture::class,
        ]);
    }
}
