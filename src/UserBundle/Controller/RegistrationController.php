<?php

namespace UserBundle\Controller;

use Symfony\Component\HttpFoundation\RedirectResponse;
use FOS\UserBundle\Controller\RegistrationController as BaseController;
use Symfony\Component\HttpFoundation\Request;
use FOS\UserBundle\Event\GetResponseUserEvent;
use FOS\UserBundle\FOSUserEvents;

use UserBundle\Form\UserType;
use UserBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use UserBundle\Form\TrainerType;

class RegistrationController extends Controller
{
    /**
     * @Route("/user-register", name="user_registration")
     */
    public function registerAction(Request $request)
    {
        // 1) build the form
        $user = new User();
        $form = $this->createForm(UserType::class, $user);

        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            // 3) Encode the password (you could also do this via Doctrine listener)
            $password = $this->get('security.password_encoder')->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);

            // 4) save the User!
            $em = $this->getDoctrine()->getManager();


            try{
                $em->persist($user);
                $em->flush();
                return $this->redirectToRoute('homepage');
            } catch (Exception $e) {
                echo 'Caught exception: ', $e->getMessage(), "\n";
            }

            // ... do any other work - like sending them an email, etc
            // maybe set a "flash" success message for the user


        }

        return $this->render(
            '@UserBundle/Resources/views/registration/register.html.twig',
            array('form' => $form->createView())
        );
    }

    /**
     * @Route("/trainer-register", name="trainer_registration")
     */
    public function registerTrainerAction(Request $request)
    {
        // 1) build the form
        $user = new User();
        $form = $this->createForm(TrainerType::class, $user);

        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            // 3) Encode the password (you could also do this via Doctrine listener)
            $password = $this->get('security.password_encoder')
                ->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);

            // 4) save the User!
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            // ... do any other work - like sending them an email, etc
            // maybe set a "flash" success message for the user

            return $this->redirectToRoute('homepage');
        }

        return $this->render(
            '@UserBundle/Resources/views/registration/register_trainer.html.twig',
            array('form' => $form->createView())
        );
    }
}