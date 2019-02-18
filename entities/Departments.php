<?php
class Departments
{
    protected $id;
    protected $departmentsCode;
    protected $departmentsName;

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
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * set value of id
     *
     * @param [int] $id
     * @return self
     */
    public function setId($id)
    {
        $id = (int) $id;
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of departmentsCode
     */ 
    public function getDepartmentsCode()
    {
        return $this->departmentsCode;
    }

    /**
     * set value of departmentsCode
     *
     * @param [int] $departmentsCode
     * @return self
     */
    public function setDepartmentsCode($departmentsCode)
    {
        $departmentsCode = (int) $departmentsCode;
        $this->departmentsCode = $departmentsCode;

        return $this;
    }

    /**
     * Get the value of departmentsName
     */ 
    public function getDepartmentsName()
    {
        return $this->departmentsName;
    }
    
    /**
     * set value of DepartmentsName
     *
     * @param string $departmentsName
     * @return self
     */
    public function setDepartmentsName(string $departmentsName)
    {
        $this->departmentsName = $departmentsName;

        return $this;
    }
}
