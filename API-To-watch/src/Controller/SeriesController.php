<?php

namespace App\Controller;

use App\Entity\Series;
use App\Utils\SeriesFactory;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SeriesController extends AbstractController
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;
    /**
     * @var SeriesFactory
     */
    private $seriesFactory;

    public function __construct(
        EntityManagerInterface $entityManager,
        SeriesFactory $seriesFactory
    )
    {

        $this->entityManager = $entityManager;
        $this->seriesFactory = $seriesFactory;
    }

    /**
     * @Route ("/series", methods={"POST"})
     */
    public function new(Request $request): Response
    {
        $bodyRequest = $request->getContent();
        $series = $this->seriesFactory->createSeries($bodyRequest);

        $this->entityManager->persist($series);
        $this->entityManager->flush();

        return new JsonResponse($series);
    }

    /**
     * @Route ("/series", methods={"GET"})
     */
    public function getAll(): Response
    {
        $repositorySeries = $this
            ->getDoctrine()
            ->getRepository(Series::class);
        $seriesList = $repositorySeries->findAll();

        return new JsonResponse($seriesList);

    }

    /**
     * @Route @Route ("/series/{id}", methods={"GET"})
     */
    public function getById(int $id): Response
    {
        $serie = $this->getSerie($id);
        $returnCode = is_null($serie) ? Response::HTTP_NO_CONTENT : 200;

        return new JsonResponse($serie, $returnCode);
    }

    /**
     * @Route ("/series/{id}", methods={"PUT"})
     */
    public function updateById(int $id, Request $request): Response
    {
        $bodyRequest = $request->getContent();
        $series = $this->seriesFactory->createSeries($bodyRequest);

        $existingSerie = $this->getSerie($id);

        if (is_null($existingSerie)){
            return new Response('', Response::HTTP_NOT_FOUND);
        }

        $existingSerie->status = $series->status;
        $existingSerie->name = $series->name;
        $existingSerie->season = $series->season;
        $existingSerie->episode = $series->episode;

        $this->entityManager->flush();

        return new JsonResponse($existingSerie);
    }

    /**
     * @Route ("/series/{id}", methods={"DELETE"})
     */
    public function deleteSerie(int $id): Response
    {
        $serie = $this->getSerie($id);
        $this->entityManager->remove($serie);
        $this->entityManager->flush();

        return new Response('', Response::HTTP_NO_CONTENT);
    }
    
    /**
     * @param int $id
     * @return mixed|object|null
     */
    public function getSerie(int $id)
    {
        $repositorySeries = $this
            ->getDoctrine()
            ->getRepository(Series::class);
        $serie = $repositorySeries->find($id);
        return $serie;
    }

}