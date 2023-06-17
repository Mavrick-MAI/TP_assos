<?php

	/**
	 * Modlise un livre
	 */
    class Book {

		/**
		 * @var int $id
		 */ 
		private $id;
        /**
		 * @var string $title
		 */ 
		private $title;
		/**
		 * @var string $author
		 */ 
		private $author;
		/**
		 * @var string $genre
		 */ 
		private $genre;
		/**
		 * @var boolean $available
		 */ 
		private $available;
		/**
		 * @var string $borrower
		 */ 
		private $borrower;
		/**
		 * @var date $dateEmprunt
		 */ 
		private $dateEmprunt;
		/**
		 * @var date $dateRetour
		 */ 
		private $dateRetour;

		/**
		 * @param string
		 * @param string
		 * @param string
		 * 
		 * @return Book
		 */ 
		public function __construct($pTitle, $pAuthor, $pGenre) {

			$this->title = $pTitle;
			$this->author = $pAuthor;
			$this->genre = $pGenre;

		}

		/**
		 * @param int
		 * @param string
		 * @param string
		 * @param string
		 * @param boolean
		 * @param string
		 * @param date
		 * @param date
		 * 
		 * @return Book
		 */ 
		public static function fullBook($pId, $pTitle, $pAuthor, $pGenre, $pAvailable, $pBorrower, $pDateEmprunt, $pDateRetour) {

			$book = new self($pTitle, $pAuthor, $pGenre);
			$book->id = $pId;
			$book->available = $pAvailable;
			$book->borrower = $pBorrower;
			$book->dateEmprunt = $pDateEmprunt;
			$book->dateRetour = $pDateRetour;
			return $book;

		}

		/**
		 * @return int
		 */ 
		public function getId() {
			return $this->id;
		}

		/**
		 * @param int
		 * @return void
		 */ 
		public function setId($pId) {
			$this->id = $pId;
		}

		/**
		 * @return string
		 */ 
		public function getTitle() {
			return $this->title;
		}

		/**
		 * @param string
		 * @return void
		 */ 
		public function setTitle($pTitle) {
			$this->title = $pTitle;
		}

		/**
		 * @return string
		 */ 
		public function getAuthor() {
			return $this->author;
		}

		/**
		 * @param string
		 * @return void
		 */ 
		public function setAuthor($pAuthor) {
			$this->author = $pAuthor;
		}

		/**
		 * @return string
		 */ 
		public function getGenre() {
			return $this->genre;
		}

		/**
		 * @param string
		 * @return void
		 */ 
		public function setGenre($pGenre) {
			$this->genre = $pGenre;
		}

		/**
		 * @return boolean
		 */ 
		public function isAvailable() {
			return $this->available;
		}

		/**
		 * @param boolean
		 * @return void
		 */ 
		public function setAvailable($pAvailable) {
			$this->available = $pAvailable;
		}

		/**
		 * @return string
		 */ 
		public function getBorrower() {
			return $this->borrower;
		}

		/**
		 * @param string
		 * @return void
		 */ 
		public function setBorrower($pBorrower) {
			$this->borrower = $pBorrower;
		}

		/**
		 * @return date
		 */ 
		public function getDateEmprunt() {
			return $this->dateEmprunt;
		}

		/**
		 * @param date
		 * @return void
		 */ 
		public function setDateEmprunt($pDateEmprunt) {
			$this->dateEmprunt = $pDateEmprunt;
		}

		/**
		 * @return date
		 */ 
		public function getDateRetour() {
			return $this->dateRetour;
		}

		/**
		 * @param date
		 * @return void
		 */ 
		public function setDateRetour($pDateRetour) {
			$this->dateRetour = $pDateRetour;
		}

    }

?>