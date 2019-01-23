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

class PersonRepository
{
    const KEY_STRING = 'api_key';
    const API_VERSION = 3;
    const BASE_URI = 'https://api.themoviedb.org/'. self::API_VERSION.'/';
    const IMAGE_URI = 'https://image.tmdb.org/t/p/';

    private $api;

    public function __construct(Api $api)
    {
        $this->api = $api;
        $this->api->setBaseUri(self::BASE_URI);
        $this->api->addQueryString(self::KEY_STRING, getenv('API_KEY'));
    }

    public function findByInput(string $search)
    {
        $this->api->addQueryString('query', $search);

        $response = $this->api->client->request(
            'GET',
            'search/person',
            $this->api->queryString()
        );
        $body = json_decode($response->getBody(), true);
        foreach($body['results'] as $personResult) {
            $persons[] = new Person($this->dataFormatter($personResult));
        }

        return $persons ?? [];
    }

    public function dataFormatter(array $jsonData) :array
    {
        $data['id'] = $jsonData['id'];
        $data['name'] = $jsonData['name'];
        $data['birthDay'] = isset($jsonData['birthday']) ? new \DateTime($jsonData['birthday']) : null;
        $data['deathDay'] = isset($jsonData['deathday']) ? new \DateTime($jsonData['deathday']) : null;
        $data['knownFor'] = $jsonData['known_for_department'] ?? null;
        $data['description'] = $jsonData['biography'] ?? '';
        $data['picture'] = self::IMAGE_URI . 'w500/'.$jsonData['profile_path'];

        return $data;
    }

    public function findOneByPerson(int $id): Person
    {

        $response = $this->api->client->request(
            'GET',
            'person/'.$id,
            $this->api->queryString()
        );

        $body = json_decode($response->getBody(), true);

        $person = new Person($this->dataFormatter($body));
        $person->setMovies($this->findMoviesByPerson($person->getId()));
        $person->setImages($this->findImagesByPerson($person->getId()));
        return $person;
    }


    private function findMoviesByPerson(int $id) :array
    {
        $response = $this->api->client->request(
            'GET',
            'person/'.$id.'/movie_credits',
            $this->api->queryString()
        );

        $body = json_decode($response->getBody(), true);

        foreach($body['cast'] as $movieData) {
            $movies[] = (new Movie())
                    ->setId($movieData['id'])
                    ->setTitle($movieData['original_title'])
                    ->setPoster(self::IMAGE_URI . 'w500'.$movieData['poster_path'])
            ;

        }

        return $movies;
    }

    private function findImagesByPerson(int $id) :array
    {
        $response = $this->api->client->request(
            'GET',
            'person/'.$id.'/images',
            $this->api->queryString()
        );
        $body = json_decode($response->getBody(), true);

        foreach($body['profiles'] as $image) {
            $images[] = self::IMAGE_URI . 'w500/'.$image['file_path'];
        }

        return $images ?? [];
    }

}
