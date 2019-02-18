<?php
class AddImages
{
    protected $target_dir;
    protected $target_file;
    protected $uploadOk;
    protected $imageFileType;
    protected $tmpname;
    protected $error;
    protected $fileName;

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
     * Start the image verification
     *
     * @return self
     */
    public function checkImage()
    {
        $this->checkIfImage();
    }

    /**
     * Check if it's an image
     *
     * @return self
     */
    public function checkIfImage()
    {
        $check = getimagesize($this->tmpname);
        if ($check !== false) {
            $this->checkIfExist();
        } else {
            $uploadOk = 0;
            $this->uploadOk = $uploadOk;
            $this->error = 'Ceci n\' est pas une image';
            return $this->error;
        }
    }

    /**
     * Check if the image already exist
     *
     * @return self
     */
    public function checkIfExist()
    {
        if (file_exists($this->target_file)) {
            $fileName = $this->fileName;
            $uploadOk = 0;
            $this->uploadOk = $uploadOk;
            $this->error = $this->fileName . ' existe déjà. ';
            return $this->error;
        } else {
            $this->checkFormat();
        }
    }

    /**
     * Check the format
     *
     * @return self
     */
    public function checkFormat()
    {
        $imageFileType = $this->imageFileType;
        if ($imageFileType == "png" || $imageFileType == "jpg" || $imageFileType == "jpeg") {
            $this->uploadImage();
        } else {
            $uploadOk = 0;
            $this->uploadOk = $uploadOk;
            $this->error = 'Mauvais format d\'image';
            return $this->error;
        }
    }

    /**
     * Upload image
     *
     * @return self
     */
    public function uploadImage()
    {
        if (move_uploaded_file($this->tmpname, $this->target_file)) {
            $uploadOk = 1;
            $this->uploadOk = $uploadOk;
            return $this->uploadOk;
        } else {
            $uploadOk = 0;
            $this->uploadOk = $uploadOk;
            $this->error = 'Erreur lors de l\'envois de l\'image';
            return $this->error;
        }
    }

    /**
     * Get the value of target_dir
     */
    public function getTarget_dir()
    {
        return $this->target_dir;
    }

    /**
     * Get the value of target_file
     */
    public function getTarget_file()
    {
        return $this->target_file;
    }

    /**
     * Get the value of uploadOk
     */
    public function getUploadOk()
    {
        return $this->uploadOk;
    }

    /**
     * Get the value of imageFileType
     */
    public function getImageFileType()
    {
        return $this->imageFileType;
    }

    /**
     * Get the value of tmpname
     */
    public function getTmpname()
    {
        return $this->tmpname;
    }

    /**
     * Set the value of target_dir
     *
     * @return  self
     */
    public function setTarget_dir($target_dir)
    {
        $this->target_dir = $target_dir;

        return $this;
    }

    /**
     * Set the value of target_file
     *
     * @return  self
     */
    public function setTarget_file($target_file)
    {
        $this->target_file = $target_file;

        return $this;
    }

    /**
     * Set the value of uploadOk
     *
     * @return  self
     */
    public function setUploadOk($uploadOk)
    {
        $this->uploadOk = $uploadOk;

        return $this;
    }

    /**
     * Set the value of imageFileType
     *
     * @return  self
     */
    public function setImageFileType($imageFileType)
    {
        $this->imageFileType = $imageFileType;

        return $this;
    }

    /**
     * Set the value of tmpname
     *
     * @return  self
     */
    public function setTmpname($tmpname)
    {
        $this->tmpname = $tmpname;

        return $this;
    }

    /**
     * Get the value of error
     */
    public function getError()
    {
        return $this->error;
    }

    /**
     * Set the value of error
     *
     * @return  self
     */
    public function setError($error)
    {
        $this->error = $error;

        return $this;
    }

    /**
     * Get the value of fileName
     */ 
    public function getFileName()
    {
        return $this->fileName;
    }

    /**
     * Set the value of fileName
     *
     * @return  self
     */ 
    public function setFileName($fileName)
    {
        $this->fileName = $fileName;

        return $this;
    }
}
