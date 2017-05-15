<?php


namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\UserBundle\Controller\SecurityController as BaseController;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class SecurityController extends BaseController
{
    /**
     * @param Request $request
     *
     * @Route("/login", name="fos_user_security_login")
     * @return Response
     */
    public function loginAction(Request $request)
    {
        /** @var $session \Symfony\Component\HttpFoundation\Session\Session */
        $session = $request->getSession();

        $authenticationUtils = $this->get('security.authentication_utils');

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

//        $authErrorKey = Security::AUTHENTICATION_ERROR;
//        $lastUsernameKey = Security::LAST_USERNAME;
//
//        // get the error if any (works with forward and redirect -- see below)
//        if ($request->attributes->has($authErrorKey)) {
//            $error = $request->attributes->get($authErrorKey);
//        } elseif (null !== $session && $session->has($authErrorKey)) {
//            $error = $session->get($authErrorKey);
//            $session->remove($authErrorKey);
//        } else {
//            $error = null;
//        }
//
//        if (!$error instanceof AuthenticationException) {
//            $error = null; // The value does not come from the security component.
//        }
//
//        // last username entered by the user
//        $lastUsername = (null === $session) ? '' : $session->get($lastUsernameKey);
//
        $csrfToken = $this->has('security.csrf.token_manager')
            ? $this->get('security.csrf.token_manager')->getToken('authenticate')->getValue()
            : null;

        return $this->renderLogin(array(
            'last_username' => $lastUsername,
            'error' => $error,
            'csrf_token' => $csrfToken
        ));
    }

    /**
     * Renders the login template with the given parameters. Overwrite this function in
     * an extended controller to provide additional data for the login template.
     *
     * @param array $data
     *
     * @return Response
     */
    protected function renderLogin(array $data)
    {
        return $this->render('@User/Security/login.html.twig', $data);
    }

    public function checkAction()
    {
        throw new \RuntimeException('You must configure the check path to be handled by the firewall using form_login in your security firewall configuration.');
    }

    /**
     * @param Request $request
     *
     * @Route("/logout", name="fos_user_security_logout")
     * @return Response
     */

    public function logoutAction()
    {
        throw new \RuntimeException('You must activate the logout in your security firewall configuration.');
    }
}
