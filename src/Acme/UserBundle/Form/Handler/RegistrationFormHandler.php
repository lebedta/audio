<?php
namespace Acme\UserBundle\Form\Handler;

use Doctrine\ORM\EntityManager;
use FOS\UserBundle\Model\UserManagerInterface;
use FOS\UserBundle\Model\UserInterface;
use FOS\UserBundle\Mailer\MailerInterface;
use FOS\UserBundle\Util\TokenGeneratorInterface;

use Acme\UserBundle\Entity\User;
use Acme\UserBundle\Entity\UserRepository;
use Acme\UserBundle\Form\RegistrationType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use FOS\UserBundle\Form\Handler\RegistrationFormHandler as BaseHandler;

class RegistrationFormHandler {

    protected $request;
    protected $em;

    public function __construct(Request $request, EntityManager $em)
    {

        $this->request = $request;
        $this->em = $em;
    }

    public function process(FormInterface $form)
    {

        if ('POST' === $this->request->getMethod()) {
            $form->bind($this->request);
            if ($form->isValid()) {
                $this->onSuccess($form);

                return true;
            }
        }

        return false;
    }

    protected function onSuccess(FormInterface $form)
    {
        /**
         * @var User $user
         */
        $user = $form->getData();

        $user->setEnabled(true);
        $user->setLastLogin(new \DateTime());
        $this->em->persist($user);

        $this->em->flush();


    }

}