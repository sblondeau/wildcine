<?php
/**
 * Created by PhpStorm.
 * User: sylvain
 * Date: 16/01/19
 * Time: 11:33
 */

namespace App\Entity;


use App\Repository\MovieRepository;

class Movie extends Entity
{
    private $id;

    private $title;

    private $date;

    private $poster;

    private $casts;

    private $director;

    private $description;

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
     * @return Movie
     */
    public function setId(int $id)
    {
        $this->id = $id;

        return $this;
    }



    /**
     * @return mixed
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }



    /**
     * @return mixed
     */
    public function getDate(): ?\DateTime
    {
        return $this->date;
    }

    /**
     * @param mixed $title
     * @return Movie
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @param mixed $date
     * @return Movie
     */
    public function setDate(\DateTime $date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPoster() :string
    {
        return $this->poster;
    }

    /**
     * @param mixed $poster
     * @return Movie
     */
    public function setPoster(string $poster)
    {
        $this->poster = $poster;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCasts() :?array
    {
        return $this->casts;
    }

    /**
     * @param mixed $casts
     * @return Movie
     */
    public function setCasts($casts)
    {
        $this->casts = $casts;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDirector() :Person
    {
        return $this->director;
    }

    /**
     * @param mixed $director
     * @return Movie
     */
    public function setDirector(Person $director)
    {
        $this->director = $director;

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
     * @return Movie
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
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
     * @return Movie
     */
    public function setImages($images)
    {
        $this->images = $images;

        return $this;
    }




}