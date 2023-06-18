<?php

	/**
	 * Modlise un membre
	 */
    class Member {

		/**
		 * @var int $id
		 */ 
		private $id;
        /**
		 * @var string $lastName
		 */ 
		private $lastName;
		/**
		 * @var string $firstName
		 */ 
		private $firstName;
		/**
		 * @var int $phone
		 */ 
		private $phone;
		/**
		 * @var string $email
		 */ 
		private $email;
		/**
		 * @var string $password
		 */ 
		private $password;
		/**
		 * @var string $secretQuestion
		 */ 
		private $secretQuestion;
		/**
		 * @var string $secretAnswer
		 */ 
		private $secretAnswer;

		/**
		 * @param string
		 * @param string
		 * @param string
		 * @param string
		 * @param string
		 * @param string
		 * @param string
		 * 
		 * @return Member
		 */ 
		public function __construct($pLastname, $pFirstName, $pPhone, $pEmail, $pPassword, $pSecretQuestion, $pSecretAnswer) {

			$this->lastName = $pLastname;
			$this->firstName = $pFirstName;
			$this->phone = $pPhone;
			$this->email = $pEmail;
			$this->password = $pPassword;
			$this->secretQuestion = $pSecretQuestion;
			$this->secretAnswer = $pSecretAnswer;

		}
		
		/**
		 * @param int
		 * @param string
		 * @param string
		 * @param string
		 * 
		 * @return Member
		 */
		public static function memberUpdated($pId, $pLastname, $pFirstName, $pPhone) {

			$member = new self($pLastname, $pFirstName, $pPhone, null, null, null, null);
			$member->id = $pId;

			return $member;

		}

		/**
		 * @param int
		 * @param string
		 * @param string
		 * @param string
		 * @param string
		 * @param string
		 * @param string
		 * @param string
		 * 
		 * @return Member
		 */
		public static function memberWithId($pId, $pLastname, $pFirstName, $pPhone, $pEmail, $pPassword, $pSecretQuestion, $pSecretAnswer) {

			$member = new self($pLastname, $pFirstName, $pPhone, $pEmail, $pPassword, $pSecretQuestion, $pSecretAnswer);
			$member->id = $pId;

			return $member;

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
		public function getLastName() {
			return $this->lastName;
		}

		/**
		 * @param string
		 * @return void
		 */ 
		public function setLastname($pLastName) {
			$this->lastName = $pLastName;
		}

		/**
		 * @return string
		 */ 
		public function getFirstName() {
			return $this->firstName;
		}

		/**
		 * @param string
		 * @return void
		 */ 
		public function setFirstName($pFirstName) {
			$this->firstName = $pFirstName;
		}

		/**
		 * @return string
		 */ 
		public function getPhone() {
			return $this->phone;
		}

		/**
		 * @param string
		 * @return void
		 */ 
		public function setPhone($pPhone) {
			$this->phone = $pPhone;
		}

		/**
		 * @return string
		 */ 
		public function getEmail() {
			return $this->email;
		}

		/**
		 * @param string
		 * @return void
		 */ 
		public function setEmail($pEmail) {
			$this->email = $pEmail;
		}

		/**
		 * @return string
		 */ 
		public function getPassword() {
			return $this->password;
		}

		/**
		 * @param string
		 * @return void
		 */ 
		public function setPassword($pPassword) {
			$this->password = $pPassword;
		}

		/**
		 * @return string
		 */ 
		public function getSecretQuestion() {
			return $this->secretQuestion;
		}

		/**
		 * @param string
		 * @return void
		 */ 
		public function setSecretQuestion($pSecretQuestion) {
			$this->secretQuestion = $pSecretQuestion;
		}

		/**
		 * @return string
		 */ 
		public function getSecretAnswer() {
			return $this->secretAnswer;
		}

		/**
		 * @param string
		 * @return void
		 */ 
		public function setSecretAnswer($pSecretAnswer) {
			$this->secretAnswer = $pSecretAnswer;
		}

    }

?>