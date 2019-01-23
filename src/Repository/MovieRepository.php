<?php
/**
 * Created by PhpStorm.
 * User: sylvain
 * Date: 16/01/19
 * Time: 17:34
 */

namespace App\Repository;


use App\Entity\Movie;
use App\Entity\Person;
use App\Services\Api;

class MovieRepository
{
    const KEY_STRING = 'api_key';
    const API_VERSION = 3;
    const BASE_URI = 'https://api.themoviedb.org/'. self::API_VERSION.'/';
    const IMAGE_URI = 'https://image.tmdb.org/t/p/';

    private $api;
    private $personRepository;

    public function __construct(Api $api, PersonRepository $personRepository)
    {
        $this->api = $api;
        $this->personRepository = $personRepository;
        $this->api->setBaseUri(self::BASE_URI);
        $this->api->addQueryString(self::KEY_STRING, getenv('API_KEY'));
    }

    public function findByInput(string $search)
    {
        $this->api->addQueryString('query', $search);

        $response = $this->api->client->request(
            'GET',
            'search/movie',
            $this->api->queryString()
        );
        $body = json_decode($response->getBody(), true);
        foreach($body['results'] as $movieResult) {
            $movies[] = new Movie($this->dataFormatter($movieResult));
        }

        return $movies ?? [];
    }

    public function dataFormatter(array $jsonData) :array
    {
        $data['id'] = $jsonData['id'];
        $data['title'] = $jsonData['original_title'];
        $data['date'] = new \DateTime($jsonData['release_date']);
        $data['description'] = $jsonData['overview'];
        $data['poster'] = self::IMAGE_URI . 'w500/'. $jsonData['poster_path'];

        return $data;
    }

    public function findOneByMovie(int $id): Movie
    {

        $response = $this->api->client->request(
            'GET',
            'movie/'.$id,
            $this->api->queryString()
        );

        $body = json_decode($response->getBody(), true);

        $movie = new Movie($this->dataFormatter($body));
        $movie->setImages($this->findImagesByMovie($movie->getId()));
        $credit = $this->findCreditsByMovie($movie->getId());
        $movie->setCasts($credit['cast']);
        $movie->setDirector($credit['director']);
        return $movie;
    }


    private function findCreditsByMovie(int $id) :array
    {
        $response = $this->api->client->request(
            'GET',
            'movie/'.$id.'/credits',
            $this->api->queryString()
        );

        $body = json_decode($response->getBody(), true);

        foreach($body['cast'] as $personData) {
            $persons[] = new Person($this->personRepository->dataFormatter($personData));
        }

        foreach($body['crew'] as $personData) {
            if ($personData['job'] === 'Director') {
                $director = new Person($this->personRepository->dataFormatter($personData));
            }
        }

        return ['cast' => $persons, 'director' => $director];
    }

    private function findImagesByMovie(int $id) :array
    {
        $response = $this->api->client->request(
            'GET',
            'movie/'.$id.'/images',
            $this->api->queryString()
        );
        $body = json_decode($response->getBody(), true);

        foreach($body['backdrops'] as $image) {
            $images[] = self::IMAGE_URI . 'w500/'.$image['file_path'];
        }

        return $images ?? [];
    }

}
