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
    public function setTitle($titles)
    {
        if (empty($titles)) throw new Exception('Le titre ne peut pas etre vide ');
        if (strlen($titles) > 255) throw new Exception(' le titre doit faire moins de 255 caractères');


        $this->title = htmlspecialchars($titles);
    }
    public function getType()
    {
        return $this->type;
    }
    public function setType($typess)
    {

        if ($typess !== 'film' && $typess !== 'serie') throw new Exception('la valeur de  typees doit etre  "film" ou  "serie"');


        $this->type = htmlspecialchars($typess);
    }
    public function getrating()
    {
        return $this->rating;
    }
    public function setrating($value)
    {

        if (strlen($value) < 1 && strlen($value) > 5 || $value !== null) throw new Exception('la valeur doit etre entre 1 et 5 ou null');


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
    public function register()
    {
        $queryExecute = $this->db->prepare("INSERT INTO `movies`(`title`, `type`, `genre`, `rating`,) 
			VALUES (:title,:type, :genre,:rating)");

        $queryExecute->bindValue(':title', $this->title, PDO::PARAM_STR);
        $queryExecute->bindValue(':type', $this->type, PDO::PARAM_STR);
        $queryExecute->bindValue(':genre', $this->genre, PDO::PARAM_STR);
        $queryExecute->bindValue(':rating', $this->rating, PDO::PARAM_STR);


        return $queryExecute->execute();
    }
}
