<?php
class Images
{
    protected $idImages;
    protected $link;
    protected $alt;

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
     * Get the value of idImages
     */ 
    public function getIdImages()
    {
        return $this->idImages;
    }

    /**
     * set value of idImages
     *
     * @param [int] $idImages
     * @return self
     */
    public function setIdImages($idImages)
    {
        $idImages = (int) $idImages;
        $this->idImages = $idImages;

        return $this;
    }

    /**
     * Get the value of link
     */ 
    public function getLink()
    {
        return $this->link;
    }

    /**
     * set value of Link
     *
     * @param string $link
     * @return self
     */
    public function setLink(string $link)
    {
        $this->link = $link;

        return $this;
    }

    /**
     * Get the value of alt
     */ 
    public function getAlt()
    {
        return $this->alt;
    }

    /**
     * set value of Alt
     *
     * @param string $alt
     * @return self
     */
    public function setAlt(string $alt)
    {
        $this->alt = $alt;

        return $this;
    }
}
