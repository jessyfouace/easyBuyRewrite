<?php
class House
{
    protected $idAppartments;
    protected $tokenAppartments;
    protected $departmentsId;
    protected $city;
    protected $title;
    protected $description;
    protected $area;
    protected $bedroom;
    protected $bathroom;
    protected $rooms;
    protected $orientation;
    protected $price;
    protected $imagesId;
    protected $userId;

    public function __construct(array $array)
    {
        $this->hydrate($array);
    }

    public function hydrate(array $donnees)
    {
        foreach ($donnees as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

    

    /**
     * Get the value of idAppartments
     */ 
    public function getIdAppartments()
    {
        return $this->idAppartments;
    }

    /**
     * Set value of idAppartments
     *
     * @param [int] $idAppartments
     * @return self
     */
    public function setIdAppartments($idAppartments)
    {
        $idAppartments = (int) $idAppartments;
        $this->idAppartments = $idAppartments;

        return $this;
    }

    /**
     * Get the value of tokenAppartments
     */ 
    public function getTokenAppartments()
    {
        return $this->tokenAppartments;
    }

    /**
     * set value of tokenAppartments
     *
     * @param string $tokenAppartments
     * @return self
     */
    public function setTokenAppartments($tokenAppartments)
    {
        $this->tokenAppartments = $tokenAppartments;

        return $this;
    }

    /**
     * Get the value of departmentsId
     */ 
    public function getDepartmentsId()
    {
        return $this->departmentsId;
    }

    /**
     * set value of departmentsId
     *
     * @param [int] $departmentsId
     * @return self
     */
    public function setDepartmentsId($departmentsId)
    {
        $departmentsId = (int) $departmentsId;
        $this->departmentsId = $departmentsId;

        return $this;
    }

    /**
     * Get the value of city
     */ 
    public function getCity()
    {
        return $this->city;
    }

    /**
     * set value of City
     *
     * @param string $city
     * @return self
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get the value of title
     */ 
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * set value of title
     *
     * @param string $title
     * @return self
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the value of description
     */ 
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * set value of Description
     *
     * @param string $description
     * @return self
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of area
     */ 
    public function getArea()
    {
        return $this->area;
    }

    /**
     * set value of Area
     *
     * @param [int] $area
     * @return self
     */
    public function setArea($area)
    {
        $area = (int) $area;
        $this->area = $area;

        return $this;
    }

    /**
     * Get the value of bedroom
     */ 
    public function getBedroom()
    {
        return $this->bedroom;
    }

    /**
     * set value of bedroom
     *
     * @param [int] $bedroom
     * @return self
     */
    public function setBedroom($bedroom)
    {
        $bedroom = (int) $bedroom;
        $this->bedroom = $bedroom;

        return $this;
    }

    /**
     * Get the value of bathroom
     */ 
    public function getBathroom()
    {
        return $this->bathroom;
    }

    /**
     * set value of Bathroom
     *
     * @param [int] $bathroom
     * @return self
     */
    public function setBathroom($bathroom)
    {
        $bathroom = (int) $bathroom;
        $this->bathroom = $bathroom;

        return $this;
    }

    /**
     * Get the value of rooms
     */ 
    public function getRooms()
    {
        return $this->rooms;
    }

    /**
     * set value of rooms
     *
     * @param [int] $rooms
     * @return self
     */
    public function setRooms($rooms)
    {
        $rooms = (int) $rooms;
        $this->rooms = $rooms;

        return $this;
    }

    /**
     * Get the value of orientation
     */ 
    public function getOrientation()
    {
        return $this->orientation;
    }

    /**
     * set value of orientation
     *
     * @param string $orientation
     * @return self
     */
    public function setOrientation($orientation)
    {
        $this->orientation = $orientation;

        return $this;
    }

    /**
     * Get the value of price
     */ 
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * set value fo price
     *
     * @param [int] $price
     * @return self
     */
    public function setPrice($price)
    {
        $price = (int) $price;
        $this->price = $price;

        return $this;
    }

    /**
     * Get the value of imagesId
     */ 
    public function getImagesId()
    {
        return $this->imagesId;
    }

    /**
     * set value of imagesId
     *
     * @param [int] $imagesId
     * @return self
     */
    public function setImagesId($imagesId)
    {
        $imagesId = (int) $imagesId;
        $this->imagesId = $imagesId;

        return $this;
    }

    /**
     * Get the value of userId
     */ 
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * set value of userId
     *
     * @param [int] $userId
     * @return self
     */
    public function setUserId($userId)
    {
        $userId = (int) $userId;
        $this->userId = $userId;

        return $this;
    }
}
