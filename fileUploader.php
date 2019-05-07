<?php 

include_once "DBConnector.php";
class fileUploader
{
  
    private $myFile;
    private $db;

    function __construct($myFile="")
    {
        $this->myFile = $myFile;
    }
    //methods
    public function uploadFile()
    {
        $mf = $this->myFile;
        $fileSource = "uploads/".basename($mf);
        

       //first is db connection and the variable to be uploaded
        $this->db = (new DBConnector())->DBConnect();

        //sql query
        $query = "INSERT INTO user(myFile) VALUES (?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("b",$uploadFile);
        $sql = $stmt->execute();

        if(move_uploaded_file($_FILES['fileToUpload'], $fileSource))
        {
            echo "Upload success";

        }
        else
        {
            echo "No upload";
        }
        return $sql;

    }

    public function fileAlreadyExixts()
    {
        return null;
    }
    public function saveFilePathTo()
    {
        return null;
    }
    public function moveFile()
    {
        return null;
    }
    public function fileTypeIsCorrect()
    {
        return null;
    }
    public function fileSizeIsCorrect()
    {
        return null;
    }
    public function fileWasSelected()
    {
        return null;
    }
}

?>