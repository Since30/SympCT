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
        // Crée une nouvelle instance de l'entité User
        $user = new User();

        // Crée un formulaire d'inscription en utilisant Symfony Forms
        $form = $this->createForm(RegistrationFormType::class, $user);

        // Gère la soumission du formulaire
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Encode le mot de passe de l'utilisateur
            $user->setPassword($passwordEncoder->encodePassword(
                $user,
                $user->getPassword()
            ));

            // Définit d'autres propriétés de l'utilisateur
            $user->setEnabled(true);
            $user->setRoles(['ROLE_USER']);
            $user->setRegistrationDate(new \DateTime());
            $user->setRegistrationType(RegistrationFormType::REGISTRATION);

            // Enregistre l'utilisateur dans la base de données
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            $this->addFlash('success', 'Votre compte a bien été créé. Vous pouvez maintenant vous connecter.');

            // Redirige l'utilisateur vers une autre page
            return $this->redirectToRoute('app_login');
        }

        return $this->render('user/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }

    #[Route('/login', name: 'app_login', methods: ['GET', 'POST'])]
    public function login(): Response
    {
        // Gestion de la connexion de l'utilisateur

        return $this->render('user/login.html.twig', [
            // Les données à passer à la vue Twig
        ]);
    }

    #[Route('/profile', name: 'app_profile', methods: ['GET'])]
    public function profile(): Response
    {
        // Affichage du profil de l'utilisateur connecté

        return $this->render('user/profile.html.twig', [
            // Les données à passer à la vue Twig
        ]);
    }
}
