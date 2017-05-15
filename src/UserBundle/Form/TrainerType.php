<?php

namespace UserBundle\Form;

use UserBundle\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class TrainerType extends AbstractType
{
    const EMAIL_LABEL = 'Email';
    const USERNAME_LABEL = 'Username';
    const LOCATION_LABEL = 'Location';
    const PASSWORD_LABEL = 'Password';
    const REPEAT_PASSWORD_LABEL = 'Repeat Password';

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('user_type', HiddenType::class, array(
                'data' => '2',
            ))
            ->add('email', EmailType::class, array (
                'label_attr' => array('class' => 'label_generic', 'style' => 'width:150px; display: inline-block; padding:10px 0'),
                'label' => static::EMAIL_LABEL
            ))
            ->add('username', TextType::class, array (
                'label_attr' => array('class' => 'label_generic', 'style' => 'width:150px; display: inline-block; padding:10px 0'),
                'label' => static::USERNAME_LABEL
            ))
            ->add('location', TextType::class, array (
                'label_attr' => array('class' => 'label_generic', 'style' => 'width:150px; display: inline-block; padding:10px 0'),
                'label' => static::LOCATION_LABEL
            ))
            ->add('plainPassword', RepeatedType::class, array(
                'type' => PasswordType::class,
                'first_options'  => array(
                    'label_attr' => array('class' => 'label_generic', 'style' => 'width:150px; display: inline-block; padding:10px 0'),
                    'label' => static::PASSWORD_LABEL
                ),
                'second_options' => array(
                    'label_attr' => array('class' => 'label_generic', 'style' => 'width:150px; display: inline-block; padding:10px 0'),
                    'label' => static::REPEAT_PASSWORD_LABEL
                ),
            ))
            ->add('save', SubmitType::class, array(
                'attr' => array('class' => 'save'),
                'label' => 'Register Trainer!'
            ));
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => User::class,
        ));
    }
}

