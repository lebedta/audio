<?php

namespace Acme\UserBundle\Controller;

use FOS\UserBundle\Controller\RegistrationController as BaseController;
use Acme\UserBundle\Entity\User;
use Acme\UserBundle\Form\RegistrationType;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class RegistrationController extends BaseController
{
    public function registerAction()
    {
        $user = new User();
        $form = $this->container->get('form.factory')->create(new RegistrationType(), $user);
        $formHandler = $this->container->get("acme_user.form.handler.registration");

        if ($formHandler->process($form))
        {
            $user = $form->getData();
            $url = $this->container->get('router')->generate('acme_user_registration_complete');
            $response = new RedirectResponse($url);
            $this->authenticateUser($user, $response);
            return $response;
        }

        return $this->container->get('templating')->renderResponse('AcmeUserBundle:RegistrationController:register.html.twig', array('form' => $form->createView()));
    }

    public function registerCompleteAction(){
        return $this->container->get('templating')->renderResponse('AcmeUserBundle:RegistrationController:registration_complete.html.twig');
    }

}
