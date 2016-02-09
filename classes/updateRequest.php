<?php

class UpdateRequest
{
    private  $tableToUpdate;
    private  $columnToChange;
    private  $idOfLineToChange;
    private  $newValue;

    public function __construct($tableToUpdate,$columnToChange,$idOfLineToChange,$newValue)
    {
        $this->tableToUpdate = $tableToUpdate;
        $this->columnToChange = $columnToChange;
        $this->idOfLineToChange = $idOfLineToChange;
        $this->newValue = $newValue;
    }
    public function update()
    {
        try {
            $connexion = new PDO('mysql:host=localhost; dbname=simplonsite; charset=utf8', 'root', 'root');
        } catch (Exeption $e) {
            die ('Erreur : ' . $e->getMessage());
        }

        $requete = "UPDATE `$this->tableToUpdate` SET `$this->columnToChange`='$this->newValue' WHERE `id`='$this->idOfLineToChange'";
        $connexion->query($requete);
    }
}

?>
