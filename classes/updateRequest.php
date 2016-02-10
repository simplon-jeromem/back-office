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
            $connexion = new PDO('mysql:host=localhost; dbname=simplonsite; charset=utf8', 'root', ' ');
        } catch (Exeption $e) {
            die ('Erreur : ' . $e->getMessage());
        }

        $requete = $connexion->prepare("UPDATE `$this->tableToUpdate` SET `$this->columnToChange`=:newValue WHERE `id`=:idOfLineToChange");
        $requete->bindParam(':newValue',$this->newValue, PDO::PARAM_STR);
        $requete->bindParam(':idOfLineToChange',$this->idOfLineToChange, PDO::PARAM_STR);
        $requete->execute();
    }
}

?>
