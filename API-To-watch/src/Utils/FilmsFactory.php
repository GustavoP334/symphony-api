<?php

namespace App\Utils;

use App\Entity\Films;

class FilmsFactory
{
    public function createFilms(string $json): Films
    {
        $dateJson = json_decode($json);

        $films = new Films();
        $films->status = $dateJson->status;
        $films->name = $dateJson->name;
        $films->director = $dateJson->director;

        return $films;
    }
}