<?php
	require 'bootstrap.php';

	use DaybreakStudios\Enum\Enum;

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

  	assert(Planet::EARTH() === Planet::EARTH(), 'two retrievals of the same enum yield the same object');
  	assert(Planet::EARTH()->name() === 'EARTH', 'all enums have a #name method, which should return the enums name');
  	assert(Planet::EARTH()->ordinal() === 2, 'the #ordinal method returns the enums position in the list (zero based)');
  	assert(Planet::EARTH()->getDiameter() === 12756.3, 'enums can store their own variables');

  	echo 'All assertions passed!';
?>