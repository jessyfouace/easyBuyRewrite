<?php
class DepartmentsManager
{
    private $_bdd;

    public function __construct(PDO $bdd)
    {
        $this->setBdd($bdd);
    }

    public function getDepartments()
    {
        $query = $this->getBdd()->prepare('SELECT * FROM departments');
        $query->execute();
        $allDepartments = $query->fetchAll(PDO::FETCH_ASSOC);

        $tableAllDepartments = [];
        foreach ($allDepartments as $department) {
            $tableAllDepartments[] = new Departments($department);            
        }
        return $tableAllDepartments;
    }

    public function getDepartmentByName(string $departmentsName)
    {
        $query = $this->getBdd()->prepare('SELECT id FROM departments WHERE departmentsName = :departmentsName');
        $query->bindValue(':departmentsName', $departmentsName, PDO::PARAM_STR);
        $query->execute();
        $id = $query->fetch();
        return $id;
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
