<?php

namespace App\Controller;

use App\Repository\MovieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function index(MovieRepository $movieRepository, ParameterBagInterface $parameterBagInterface): Response
    {
        $limit = $parameterBagInterface->get('home_movies_limit');
        $movies = $movieRepository->findBy([], ['id' => 'DESC'], $limit);

        return $this->render('home/index.html.twig', [
            'movies' => $movies,
            'controller_name' => 'HomeController',
            'title' => 'Home Page'
        ]);
    }
}
