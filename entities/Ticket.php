<?php
class Ticket
{
    protected $idTicket;
    protected $idCreatorTicket;
    protected $idUserTicket;
    protected $idAppartmentsTicket;

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
     * Get the value of idTicket
     */ 
    public function getIdTicket()
    {
        return $this->idTicket;
    }

    /**
     * set value of idTicket
     *
     * @param [int] $idTicket
     * @return self
     */
    public function setIdTicket($idTicket)
    {
        $idTicket = (int) $idTicket;
        $this->idTicket = $idTicket;

        return $this;
    }

    /**
     * Get the value of idCreatorTicket
     */ 
    public function getIdCreatorTicket()
    {
        return $this->idCreatorTicket;
    }

    /**
     * set value of idCreatorTicket
     *
     * @param [int] $idCreatorTicket
     * @return self
     */
    public function setIdCreatorTicket($idCreatorTicket)
    {
        $idCreatorTicket = (int) $idCreatorTicket;
        $this->idCreatorTicket = $idCreatorTicket;

        return $this;
    }

    /**
     * Get the value of idUserTicket
     */ 
    public function getIdUserTicket()
    {
        return $this->idUserTicket;
    }

    /**
     * set value of idUserTicket
     *
     * @param [int] $idUserTicket
     * @return self
     */
    public function setIdUserTicket($idUserTicket)
    {
        $idUserTicket = (int) $idUserTicket;
        $this->idUserTicket = $idUserTicket;

        return $this;
    }

    /**
     * Get the value of idAppartmentsTicket
     */ 
    public function getIdAppartmentsTicket()
    {
        return $this->idAppartmentsTicket;
    }

    /**
     * set value of idAppartmentsTicket
     *
     * @param [int] $idAppartmentsTicket
     * @return self
     */
    public function setIdAppartmentsTicket($idAppartmentsTicket)
    {
        $idAppartmentsTicket = (int) $idAppartmentsTicket;
        $this->idAppartmentsTicket = $idAppartmentsTicket;

        return $this;
    }
}