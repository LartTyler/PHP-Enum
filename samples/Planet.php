<?php
	require_once('../Enum.php');

	use dbstudios\util\Enum;

	class Planet extends Enum {
		private $diameter;

		public function __construct($diameter) {
			$this->diameter = $diameter;
		}

		public function getDiameter() {
			return $this->diameter;
		}

		public static function init() {
			parent::register('MERCURY', 4880.0);
			parent::register('VENUS', 12103.6);
			parent::register('EARTH', 12756.3);
			parent::register('MARS', 6794.0);
			parent::register('JUPITER', 142984.0);
			parent::register('SATURN', 120536.0);
			parent::register('URANUS', 51118.0);
			parent::register('NEPTUNE', 49532.0);
			parent::register('PLUTO', 2274.0);

			parent::stopRegistration();
		}
	}

	Planet::init();
?>