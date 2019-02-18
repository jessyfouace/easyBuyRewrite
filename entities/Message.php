<?php
class Message
{
    protected $idMessage;
    protected $text;
    protected $userIdSender;
    protected $userIdTaker;
    protected $object;

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
     * Get the value of idMessage
     */ 
    public function getIdMessage()
    {
        return $this->idMessage;
    }

    /**
     * set value of IdMessage
     *
     * @param [int] $idMessage
     * @return self
     */
    public function setIdMessage($idMessage)
    {
        $idMessage = (int) $idMessage;
        $this->idMessage = $idMessage;

        return $this;
    }

    /**
     * Get the value of text
     */ 
    public function getText()
    {
        return $this->text;
    }

    /**
     * set value of text
     *
     * @param string $text
     * @return self
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get the value of userIdSender
     */ 
    public function getUserIdSender()
    {
        return $this->userIdSender;
    }

    /**
     * set value of userIdSender
     *
     * @param [int] $userIdSender
     * @return self
     */
    public function setUserIdSender($userIdSender)
    {
        $userIdSender = (int) $userIdSender;
        $this->userIdSender = $userIdSender;

        return $this;
    }

    /**
     * Get the value of userIdTaker
     */ 
    public function getUserIdTaker()
    {
        return $this->userIdTaker;
    }

    /**
     * set value of userIdTaker
     *
     * @param [int] $userIdTaker
     * @return self
     */
    public function setUserIdTaker($userIdTaker)
    {
        $userIdTaker = (int) $userIdTaker;
        $this->userIdTaker = $userIdTaker;

        return $this;
    }

    /**
     * Get the value of object
     */ 
    public function getObject()
    {
        return $this->object;
    }

    /**
     * set value of object
     *
     * @param string $object
     * @return self
     */
    public function setObject($object)
    {
        $this->object = $object;

        return $this;
    }
}
