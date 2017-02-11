<?php

use Domain\ValueObject\Email\Email;
use Domain\ValueObject\Password\Password;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints as Assert;

$app['sign_in_form'] = $app['form.factory']->createBuilder(FormType::class, [
    'password' => 'Your Password',
    'email' => 'Your email',
])
    ->add('email', TextType::class, [
        'constraints' => [
            new Assert\NotBlank(),
            new Assert\Email(),
            new Assert\Length(['min' => Email::MIN_LENGTH, 'max' => Email::MAX_LENGTH])]
    ])
    ->add('password', TextType::class, [
        'constraints' => [
            new Assert\NotBlank(),
        ]
    ])
    ->getForm();