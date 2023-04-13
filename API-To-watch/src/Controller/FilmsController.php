<?php

namespace App\Controller;

use App\Entity\Films;
use App\Utils\FilmsFactory;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FilmsController extends AbstractController
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;
    /**
     * @var FilmsFactory
     */
    private $filmsFactory;

    public function __construct(
        EntityManagerInterface $entityManager,
        FilmsFactory $filmsFactory
    )
    {

        $this->entityManager = $entityManager;
        $this->filmsFactory = $filmsFactory;
    }

    /**
     * @Route ("/films", methods={"POST"})
     */
    public function new(Request $request): Response
    {
        $bodyRequest = $request->getContent();
        $films = $this->filmsFactory->createFilms($bodyRequest);

        $this->entityManager->persist($films);
        $this->entityManager->flush();

        return new JsonResponse($films);
    }

    /**
     * @Route ("/films", methods={"GET"})
     */
    public function getAll(): Response
    {
        $repositoryFilms = $this
            ->getDoctrine()
            ->getRepository(Films::class);
        $filmsList = $repositoryFilms->findAll();

        return new JsonResponse($filmsList);

    }

    /**
     * @Route @Route ("/films/{id}", methods={"GET"})
     */
    public function getById(int $id): Response
    {
        $film = $this->getFilm($id);
        $returnCode = is_null($film) ? Response::HTTP_NO_CONTENT : 200;

        return new JsonResponse($film, $returnCode);
    }

    /**
     * @Route ("/films/{id}", methods={"PUT"})
     */
    public function updateById(int $id, Request $request): Response
    {
        $bodyRequest = $request->getContent();
        $films = $this->filmsFactory->createFilms($bodyRequest);

        $existingFilm = $this->getFilm($id);

        if (is_null($existingFilm)){
            return new Response('', Response::HTTP_NOT_FOUND);
        }

        $existingFilm->status = $films->status;
        $existingFilm->name = $films->name;
        $existingFilm->director = $films->director;

        $this->entityManager->flush();

        return new JsonResponse($existingFilm);
    }

    /**
     * @Route ("/films/{id}", methods={"DELETE"})
     */
    public function deleteFilm(int $id): Response
    {
        $film = $this->getFilm($id);
        $this->entityManager->remove($film);
        $this->entityManager->flush();

        return new Response('', Response::HTTP_NO_CONTENT);
    }
    
    /**
     * @param int $id
     * @return mixed|object|null
     */
    public function getFilm(int $id)
    {
        $repositoryFilm = $this
            ->getDoctrine()
            ->getRepository(Films::class);
        $film = $repositoryFilm->find($id);
        return $film;
    }

}