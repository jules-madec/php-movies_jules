<?php

namespace Models;

use Exception;
use PDO;

class Movie extends Database
{
    private $id;
    private $title;
    private $type;
    private $genre;
    private $rating;
    private $is_watched;

    public function getTitle()
    {
        return $this->title;
    }
    public function setTitle($value)
    {
        if (empty($value)) throw new Exception('Le titre ne peut pas etre vide ');
        if (strlen($value) > 255) throw new Exception(' le titre doit faire moins de 255 caractères');


        $this->title = htmlspecialchars($value);
    }
    public function getType()
    {
        return $this->type;
    }
    public function setType($value)
    {

        if ($value !== 'film' && $value !== 'serie') throw new Exception('la valeur de  typees doit etre  "film" ou  "serie"');


        $this->type = htmlspecialchars($value);
    }
    public function getrating()
    {
        return $this->rating;
    }
    public function setrating($value)
    {

        if (!is_null($value) && ($value < 1 || $value > 5)) {
            throw new Exception('La valeur doit être entre 1 et 5 ou null');
        }


        $this->rating = htmlspecialchars($value);
    }
    public function getAll()
    {
        $movie = $this->db->prepare(
            "SELECT id, title, type, genre, rating, is_watched, created_at FROM movies ORDER BY created_at DESC",
        );
        $movie->execute();
        return $movie->fetchAll(\PDO::FETCH_ASSOC);
    }
    public function getIsWatched()
    {
        return $this->is_watched;
    }

    public function setIsWatched($value)
    {

        $this->is_watched = ($value) ? 1 : 0;
    }
    public function register()
    {
        $queryExecute = $this->db->prepare("INSERT INTO `movies`(`title`, `type`, `genre`, `rating`, `is_watched`) 
			VALUES (:title,:type, :genre,:rating,:is_watched)");

        $queryExecute->bindValue(':title', $this->title, PDO::PARAM_STR);
        $queryExecute->bindValue(':type', $this->type, PDO::PARAM_STR);
        $queryExecute->bindValue(':genre', $this->genre, PDO::PARAM_STR);
        $queryExecute->bindValue(':rating', $this->rating, PDO::PARAM_STR);
        $queryExecute->bindValue(':is_watched', $this->is_watched, PDO::PARAM_BOOL);


        return $queryExecute->execute();
    }
}
