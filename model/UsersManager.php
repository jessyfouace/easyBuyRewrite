<?php
class UsersManager
{
    private $_bdd;

    public function __construct(PDO $bdd)
    {
        $this->setBdd($bdd);
    }

    public function getUserById($idUser)
    {
        $query = $this->getBdd()->prepare('SELECT * FROM users LEFT JOIN house ON users.idUser = house.userId WHERE users.idUser = :idUser GROUP BY house.idAppartments DESC LIMIT 5');
        $query->bindValue('idUser', $idUser, PDO::PARAM_INT);
        $query->execute();
        $infosUser = $query->fetchAll(PDO::FETCH_ASSOC);

        $arrayOfHouse = [];
        $arrayOfUsers = [];
        $arrayOfAll = [];
        foreach ($infosUser as $infoUser) {
            if (empty($arrayOfUsers)) {
                $arrayOfUsers[] = new Users($infoUser);
            }
            $arrayOfHouse[] = new House($infoUser);
        }
        $arrayOfAll[] = $arrayOfUsers;
        $arrayOfAll[] = $arrayOfHouse;
        
        return $arrayOfAll;
    }

    public function getFiveLastUser()
    {
        $query = $this->getBdd()->prepare('SELECT * FROM users ORDER BY idUser DESC LIMIT 5');
        $query->execute();
        $allUsers = $query->fetchAll(PDO::FETCH_ASSOC);

        $arrayOfUser = [];
        foreach ($allUsers as $user) {
            $arrayOfUser[] = new Users($user);
        }
        return $arrayOfUser;
    }

    public function getAllUsers()
    {
        $query = $this->getBdd()->prepare('SELECT * FROM users WHERE role != "is_admin" ORDER BY idUser DESC');
        $query->execute();
        $allUsers = $query->fetchAll(PDO::FETCH_ASSOC);

        $arrayOfUser = [];
        foreach ($allUsers as $user) {
            $arrayOfUser[] = new Users($user);
        }
        return $arrayOfUser;
    }

    public function countUsers()
    {
        $query = $this->getBdd()->prepare('SELECT COUNT(*) FROM users WHERE role != "is_admin" ');
        $query->execute();
        $allUsers = $query->fetchAll(PDO::FETCH_ASSOC);

        foreach ($allUsers as $user) {
            return $user;
        }
    }

    public function getUserByMail(string $mail)
    {
        $query = $this->getBdd()->prepare('SELECT * FROM users WHERE mail = :mail');
        $query->bindValue(':mail', $mail, PDO::PARAM_STR);
        $query->execute();
        $infosUser = $query->fetchAll(PDO::FETCH_ASSOC);

        foreach ($infosUser as $infoUser) {
            return new Users($infoUser);
        }

    }

    public function addUser(Users $user)
    {
        $query = $this->getBdd()->prepare('INSERT INTO users(mail, password, firstname, lastname) VALUES(:mail, :password, :firstname, :lastname)');
        $query->bindValue(':mail', $user->getMail(), PDO::PARAM_STR);
        $query->bindValue(':password', $user->getPassword(), PDO::PARAM_STR);
        $query->bindValue(':firstname', $user->getFirstname(), PDO::PARAM_STR);
        $query->bindValue(':lastname', $user->getLastname(), PDO::PARAM_STR);
        $query->execute();
    }

    public function updateUserPassword(Users $user)
    {
        $query = $this->getBdd()->prepare('UPDATE users SET mail = :mail, firstname = :firstname, lastname = :lastname, password = :password, role = :role WHERE idUser = :idUser');
        $query->bindValue('mail', $user->getMail(), PDO::PARAM_STR);
        $query->bindValue('firstname', $user->getFirstname(), PDO::PARAM_STR);
        $query->bindValue('lastname', $user->getLastname(), PDO::PARAM_STR);
        $query->bindValue('password', $user->getPassword(), PDO::PARAM_STR);
        $query->bindValue('role', $user->getRole(), PDO::PARAM_STR);
        $query->bindValue('idUser', $user->getIdUser(), PDO::PARAM_STR);
        $query->execute();
    }

    public function updateUser(Users $user)
    {
        $query = $this->getBdd()->prepare('UPDATE users SET mail = :mail, firstname = :firstname, lastname = :lastname, password = :password, role = :role WHERE idUser = :idUser');
        $query->bindValue('mail', $user->getMail(), PDO::PARAM_STR);
        $query->bindValue('firstname', $user->getFirstname(), PDO::PARAM_STR);
        $query->bindValue('lastname', $user->getLastname(), PDO::PARAM_STR);
        $query->bindValue('password', $user->getPassword(), PDO::PARAM_STR);
        $query->bindValue('role', $user->getRole(), PDO::PARAM_STR);
        $query->bindValue('idUser', $user->getIdUser(), PDO::PARAM_STR);
        $query->execute();
    }

    public function removeUser($id)
    {
        $id = (int) $id;
        $query = $this->getBdd()->prepare('DELETE FROM users WHERE idUser = :id');
        $query->bindValue('id', $id, PDO::PARAM_INT);
        $query->execute();
    }

    /**
     * Get the value of _bdd
     */
    public function getBdd()
    {
        return $this->_bdd;
    }

    /**
     * Set the value of _bdd
     *
     * @return  self
     */
    public function setBdd(PDO $bdd)
    {
        $this->_bdd = $bdd;

        return $this;
    }
}
