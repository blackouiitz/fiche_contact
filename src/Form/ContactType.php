<?php
/**
 * Created by PhpStorm.
 * User: Nico
 * Date: 25/03/2019
 * Time: 17:04
 */

namespace App\Form;

use App\Entity\Contact;
use App\Entity\Departement;
use App\Entity\Personne;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Email;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class, ['constraints'=> [new Length(['min'=>3])]])
            ->add('prenom', TextType::class,['constraints'=> [new Length(['min'=>3])]])
            ->add('mail', EmailType::class,['constraints'=> [new Email(['strict' => true])]])
            ->add('message', TextareaType::class)
            ->add('departement', EntityType::class, array('label'=>'destinaire',
                'class'=> Departement::Class,
                'choice_label' => 'nom'))
            ->add('envoyer', SubmitType::class, ['label' => 'Envoyer'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}