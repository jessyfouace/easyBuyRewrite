<?php
class TicketManager
{
    protected $_bdd;

    public function __construct(PDO $bdd)
    {
    	$this->setBdd($bdd);
    }

    /**
    * get value of Bdd
    *
    * @return self
    */
    public function getBdd()
    {
    	return $this->_bdd;
    }

    /**
    * set value of Bdd
    *
    * @param [PDO] $bdd
    * @return self
    */
    public function setBdd(PDO $bdd)
    {
    	$this->_bdd = $bdd;
    	return $this;
    }

    /**
    * create ticket
    *
    * @param [ticket] $ticket
    * @return self
    */
    public function createTicket(Ticket $ticket)
    {
    	$query = $this->getBdd()->prepare('INSERT INTO ticket(idCreatorTicket, idUserTicket, idAppartmentsTicket) VALUES(:idCreatorTicket, :idUserTicket, :idAppartmentsTicket)');
    	$query->bindValue('idCreatorTicket', $ticket->getIdCreatorTicket(), PDO::PARAM_INT);
        $query->bindValue('idUserTicket', $ticket->getIdUserTicket(), PDO::PARAM_INT);
        $query->bindValue('idAppartmentsTicket', $ticket->getIdAppartmentsTicket(), PDO::PARAM_INT);
        $query->execute();
    }

    /**
    * get ticket
    *
    * @return self
    */
    public function getTicket()
    {
    	$query = $this->getBdd()->prepare('SELECT * FROM ticket LEFT JOIN users ON ticket.idCreatorTicket = users.idUser LEFT JOIN house ON ticket.idAppartmentsTicket = house.idAppartments');
    	$query->execute();
    	$allTickets = $query->fetchAll(PDO::FETCH_ASSOC);

        $arrayOfUsersCreator = [];
        $arrayOfHouse = [];
        $arrayOfTicket = [];
        $arrayOfAll = [];
    	foreach ($allTickets as $ticket)
    	{
            $arrayOfUsersCreator[] = new Users($ticket);
            $arrayOfTicket[] = new Ticket($ticket);
            $arrayOfHouse[] = new House($ticket);
        }
        $arrayOfAll[] = $arrayOfTicket;
        $arrayOfAll[] = $arrayOfUsersCreator;
        $arrayOfAll[] = $arrayOfHouse;
    	return $arrayOfAll;
    }

    /**
    * delete ticket by id
    *
    * @param [int] $id
    * @return self
    */
    public function deleteTicketById($id)
    {
    	$id = (int) $id;
    	$query = $this->getBdd()->prepare('DELETE FROM ticket WHERE idTicket = :idTicket');
    	$query->bindValue('idTicket', $id, PDO::PARAM_INT);
    	$query->execute();
    }
}