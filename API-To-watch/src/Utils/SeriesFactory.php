<?php

namespace App\Utils;

use App\Entity\Series;

class SeriesFactory
{
    public function createSeries(string $json): Series
    {
        $dateJson = json_decode($json);

        $series = new Series();
        $series->status = $dateJson->status;
        $series->name = $dateJson->name;
        $series->season = $dateJson->season;
        $series->episode = $dateJson->episode;

        return $series;
    }
}