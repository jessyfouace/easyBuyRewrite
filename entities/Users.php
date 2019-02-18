<?php
class Users
{
    protected $idUser;
    protected $mail;
    protected $firstname;
    protected $lastname;
    protected $password;
    protected $role;

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
     * Get the value of idUser
     */ 
    public function getIdUser()
    {
        return $this->idUser;
    }

    /**
     * set value of idUser
     *
     * @param [int] $idUser
     * @return self
     */
    public function setIdUser($idUser)
    {
        $idUser = (int) $idUser;
        $this->idUser = $idUser;

        return $this;
    }

    /**
     * Get the value of firstname
     */ 
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * set value of firstname
     *
     * @param string $firstname
     * @return self
     */
    public function setFirstname(string $firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get the value of lastname
     */ 
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * set value of lastname
     *
     * @param string $lastname
     * @return self
     */
    public function setLastname(string $lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get the value of password
     */ 
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * set value of password
     *
     * @param string $password
     * @return self
     */
    public function setPassword(string $password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of role
     */ 
    public function getRole()
    {
        return $this->role;
    }

    /**
     * set value of role
     *
     * @param string $role
     * @return self
     */
    public function setRole(string $role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get the value of mail
     */ 
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * set value of mail
     *
     * @param string $mail
     * @return self
     */
    public function setMail(string $mail)
    {
        $this->mail = $mail;

        return $this;
    }
}
