<?php
/**
 * Created by PhpStorm.
 * User: sylvain
 * Date: 16/01/19
 * Time: 12:27
 */

namespace App\Services;

use App\Entity\Movie;
use GuzzleHttp\Client;


class Api
{
    private $queryStrings;

    public function setBaseUri(string $baseUri)
    {
        $this->client = new Client([
                'base_uri' => $baseUri,
            ]
        );
    }
    public function addQueryString(string $key, string $value) :void
    {
        $this->queryStrings[$key] = $value;
    }

    public function queryString() :array
    {
        return ['query' => $this->queryStrings ];
    }


}