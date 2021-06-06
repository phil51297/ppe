<?php
    require_once ("modele/modele.class.php");
    class Controleur {
        private $unModele;

        public function __construct($host, $username, $password, $database)
		{
			$this->unModele =new Modele ($host, $username, $password, $database);
		}

    	public function selectAllProduits (){

			//recuperer du modele les classes
			$lesProduits = $this->unModele->
				selectAllProduits();
			//je réalise des traitements sur les données
			//recupperer de la base avant leurs envoie à la vue

			return $lesProduits;
		}

		public function insert ($tab)
		{
			$this->unModele->insert($tab);
		}

		public function selectWhere ($tab, $where)
		{
			return $this->unModele->selectWhere ($tab, $where);
		}

		public function delete ( $where)
		{
			$this->unModele->delete ($where);
		}

		public function update ($tab, $where)
		{
			$this->unModele->update ($tab, $where);
		}

		public function getTable (){
			return $this->unModele->getTable();
		}

		public function setTable ($table){
			$this->unModele->setTable($table);
		}
}
?>