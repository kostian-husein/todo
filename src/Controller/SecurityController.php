<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

/**
 * Class SecurityController
 * @package App\Controller
 */
class SecurityController extends AbstractController
{
    /**
     * @param AuthenticationUtils $authenticationUtils
     * @param Request $request
     * @return Response
     * @Route("/login", name = "login")
     */
    public function index(AuthenticationUtils $authenticationUtils, Request $request): Response
    {
        $referer = $request->headers->get('referer');
        $redirectUrl = '/';
        if ($referer)
        {
            $url = parse_url($referer);
            if ($url['host'] === $_SERVER['HTTP_HOST'])
            {
                $redirectUrl = $url['path'];
            }
        }

        // получить ошибку входа, если она есть
        $error = $authenticationUtils->getLastAuthenticationError();

        // последнее имя пользователя, введенное пользователем
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('login/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
            'referer' => $redirectUrl
        ]);
    }
}
