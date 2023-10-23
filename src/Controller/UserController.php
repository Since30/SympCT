<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Form\RegistrationFormType;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserController extends AbstractController
{
    #[Route('/register', name: 'app_register', methods: ['GET', 'POST'])]
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        if ($request->isMethod('POST')) {
            $user = new User();
            $user->setEmail($request->request->get('email'));
            $user->setPassword($passwordEncoder->encodePassword($user, $request->request->get('password')));
            $user->setEnabled(true);
            $user->setRoles(['ROLE_USER']);
            $user->setRegistrationDate(new \DateTime());
            $user->setRegistrationType(RegistrationFormType::REGISTRATION);

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            $this->addFlash('success', 'Votre compte a bien été créé. Vous pouvez maintenant vous connecter.');

            return $this->redirectToRoute('app_login');
        }

        return $this->render('user/register.html.twig');
    }

    #[Route('/login', name: 'app_login', methods: ['GET', 'POST'])]
    public function login(): Response
    {
        return $this->render('user/login.html.twig');
    }

    #[Route('/profile', name: 'app_profile', methods: ['GET'])]
    public function profile(): Response
    {
        return $this->render('user/profile.html.twig');
    }
}
