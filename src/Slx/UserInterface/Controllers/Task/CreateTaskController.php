<?php
/**
 * Created by PhpStorm.
 * User: dtome
 * Date: 11/03/17
 * Time: 23:10
 */

namespace Slx\UserInterface\Controllers\Task;

use Silex\Application;
use Silex\Controller;
use Slx\Application\Command\Task\CreateTaskCommand;
use Slx\Domain\Entity\User\User;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Form;
use Symfony\Component\Validator\Constraints as Assert;

class CreateTaskController extends Controller
{

    /**
     * @var Application
     */
    private $application;

    public function __construct(Application $application)
    {
        $this->application = $application;
    }

    public function indexAction()
    {
        /** @var Form $form */
        $form = $this->getForm($this->application['user_repository']->findAll());
        $form->handleRequest($this->application['request_stack']->getCurrentRequest());

        if ($form->isValid()) {
            $this->application['commandhandler.service']->execute(
              new CreateTaskCommand(
                  $form->get('title')->getData(),
                  $form->get('description')->getData(),
                  $form->get('users')->getData()
              )
            );
        }

        return $this->application['twig']->render('views/task/create.html.twig',
            [
                'form' => $form->createView(),
            ]
        );
    }

    private function getForm($users)
    {
        $formUsers = [];
        /** @var User $user */
        foreach ($users as $user) {
            $formUsers[$user->email()->email()] = $user->id()->id();
        }

        return $this->application['form.factory']->createBuilder(FormType::class, [])
            ->add('title', TextType::class, [
                'constraints' => [
                    new Assert\NotBlank(),
                ],
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('description', TextareaType::class, [
                'constraints' => [
                    new Assert\NotBlank()
                ],
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('users', ChoiceType::class, [
                'constraints' => [
                    new Assert\NotBlank()
                ],
                'attr' => [
                    'class' => 'form-control'
                ],
                'choices' => $formUsers
            ])
            ->getForm();
    }
}
