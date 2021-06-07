<?php
    class Modele {

        protected $pdo, $table ; 

        public function __construct($host, $username, $password, $database)
        {
            $this->pdo = null; 
            try{
            $this->pdo = new PDO ("mysql:host=localhost;dbname=zoo", "root", "root");
            }
            catch (PDOException $exp){
            echo "Erreur de connexion à la bdd"; 
            }
        }
        public function getTable (){
            return $this->table;
        }
        public function setTable ($table){
            $this->table = $table;
        }
        public function selectAllProduits (){
            if ($this->pdo !=null){
                $requete =" select * from produit;";
                $select = $this->pdo->prepare ($requete);
                $select->execute ();
                $lesProduits = $select->fetchAll();
                return $lesProduits;
            } else {
                return null;
            }
        }

        public function insert ($tab)
        {
            if ($this->pdo !=null){
                $listeChamps= array(); 
                $listeValeurs = array(); 
                $donnees = array(); 
                foreach ($tab as $cle => $valeur) {
                     $listeChamps[ ] = $cle; 
                     $listeValeurs [ ] = ":".$cle;
                     $donnees[":".$cle] = $valeur; 
                }
                $chaineChamps = implode (", ", $listeChamps);
                $chaineValeurs = implode(", ", $listeValeurs); 

                $requete = " insert into  ".$this->table. "( ".$chaineChamps.") values (".$chaineValeurs.");"; 
                $insert = $this->pdo->prepare ($requete); 
                $insert->execute ($donnees); 
            }
        }
        public function selectWhere ($tab, $where)
        {
            if ($this->pdo !=null){
                $chaine = implode (", ", $tab); 
                $listeWhere = array (); 
                $donnees = array(); 

                foreach ($where as $cle => $valeur) {
                    $listeWhere [ ] = $cle."=".":".$cle ; 
                    $donnees[":".$cle] = $valeur; 
                }
                $chaineWhere = implode("  and " , $listeWhere);

                $requete ="select ".$chaine." from ".$this->table."   where ".$chaineWhere."; "; 
                 
                $select = $this->pdo->prepare ($requete); 
                $select->execute ($donnees);  
                 
                return $select->fetch(); //un seul résultat 

            }else {
                return null; 
            }
        }
        public function delete ($where)
        {
            if ($this->pdo !=null){

                $listeWhere = array (); 
                $donnees = array(); 

                foreach ($where as $cle => $valeur) {
                    $listeWhere [ ] = $cle."=".":".$cle ; 
                    $donnees[":".$cle] = $valeur; 
                }
                $chaineWhere = implode("  and " , $listeWhere);

                $requete ="delete from  ".$this->table."   where ".$chaineWhere."; "; 
                $delete = $this->pdo->prepare ($requete); 
                $delete->execute ($donnees);
            }
        }
        public function update ($tab, $where) {
            if ($this->pdo !=null){
                $listeValeurs = array();
                $listeWhere = array (); 
                $donnees = array(); 
                foreach ($tab as $cle => $valeur) {
                        $listeValeurs [ ] = $cle."=".":".$cle; 
                        $donnees[":".$cle] = $valeur; 
                    }
                $chaineValeurs = implode(", ", $listeValeurs);

                foreach ($where as $cle => $valeur) {
                    $listeWhere [ ] = $cle."=".":".$cle ; 
                    $donnees[":".$cle] = $valeur; 
                }
                $chaineWhere = implode(" and " , $listeWhere);

                $requete = "update ".$this->table. "  set ".$chaineValeurs."  where ".$chaineWhere;
                $update = $this->pdo->prepare ($requete); 
                $update->execute ($donnees);
            }
        }

    }
?>