<?php
/**
 * Created by PhpStorm.
 * User: sylvain
 * Date: 16/01/19
 * Time: 11:33
 */

namespace App\Entity;


class Person extends Entity
{
    private $id;

    private $name;

    private $picture;

    private $description;

    private $movies;

    private $birthDay;

    private $deathDay;

    private $knownFor;

    private $images;


    /**
     * @return mixed
     */
    public function getId() :int
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return Person
     */
    public function setId(int $id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     * @return Person
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * @param mixed $picture
     * @return Person
     */
    public function setPicture($picture)
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     * @return Person
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getMovies()
    {
        return $this->movies;
    }

    /**
     * @param mixed $movies
     * @return Person
     */
    public function setMovies($movies)
    {
        $this->movies = $movies;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getBirthDay() : ?\DateTime
    {
        return $this->birthDay;
    }

    /**
     * @param mixed $birthDay
     * @return Person
     */
    public function setBirthDay(?\DateTime $birthDay)
    {
        $this->birthDay = $birthDay;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getKnownFor()
    {
        return $this->knownFor;
    }

    /**
     * @param mixed $knownFor
     * @return Person
     */
    public function setKnownFor($knownFor)
    {
        $this->knownFor = $knownFor;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDeathDay() : ?\DateTime
    {
        return $this->deathDay;
    }

    /**
     * @param mixed $deathDay
     * @return Person
     */
    public function setDeathDay(?\DateTime $deathDay)
    {
        $this->deathDay = $deathDay;

        return $this;
    }

    public function getAge()
    {
        $interval = $this->getBirthDay()->diff($this->getDeathDay() ?? (new \DateTime()));
        return $interval->format('%Y');
    }

    /**
     * @return mixed
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * @param mixed $images
     * @return Person
     */
    public function setImages($images)
    {
        $this->images = $images;

        return $this;
    }




}