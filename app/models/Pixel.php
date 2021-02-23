<?php
//Pixel class
//for getting and sending database values

class Pixel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }


    public function addPixels($data)
    {
        $this->db->query("INSERT INTO `pixels`(`userId`, `coordinateX`, `coordinateY`, `color`, `size`) VALUES (:userId,:coordinateX,:coordinateY,:color,:size)");
        $this->db->bind(':userId', $data['userId']);
        $this->db->bind(':coordinateX', $data['x']);
        $this->db->bind(':coordinateY', $data['y']);
        $this->db->bind(':color', $data['color']);
        $this->db->bind(':size', $data['size']);

        //make query
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getAllPixels()
    {
        $this->db->query("SELECT * FROM pixels");
        return $this->db->resultSet();

    }

    public function getUserPixels($userId)
    {
        $this->db->query("SELECT * FROM pixels WHERE userId = :userId");
        $this->db->bind(':userId', $userId);
        return $this->db->resultSet();
    }

    public function getPixelById($pixelId)
    {
        $this->db->query('SELECT * FROM pixels WHERE pixelId = :pixelId');
        $this->db->bind(':pixelId', $pixelId);
        return $this->db->single();
    }

    public function updatePixel($data)
    {
        $this->db->query('UPDATE pixels SET coordinateX = :coordinateX, coordinateY = :coordinateY, color = :color, size = :size WHERE pixelId = :pixelId');

        $this->db->bind(':pixelId', $data['pixelId']);
        $this->db->bind(':coordinateX', $data['x']);
        $this->db->bind(':coordinateY', $data['y']);
        $this->db->bind(':color', $data['color']);
        $this->db->bind(':size', $data['size']);

        //make query
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }

    }

    public function deletePixel($id)
    {
        $this->db->query("DELETE FROM pixels WHERE pixelId = :pixelId");
        $this->db->bind(':pixelId', $id);

        //make query
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

}
