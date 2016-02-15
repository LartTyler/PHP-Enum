**Please note:** This repository has been deprecated in favor of the Enum package implemented in [PHP-DaybreakCommons](https://github.com/LartTyler/PHP-DaybreakCommons).

## PHP Enum - What is it?

PHP Enum is an as-close-as-possible "port" of Java-esque enums. PHP does not have native support for enums, and using class constants or static variables is often not enough for a particular project. I wrote PHP Enum for two primary reasons:

1. Class constants can only be a simple value, not something complex like an object instance.
2. Public static properties expose more privilege than necessary to the "outside world".

## But Why??? PHP blah blah blah...

If you see this code and immediately think "Why would this be necessary?? PHP has XYZ and isn't supposed to work like ABC!!!" then this repo wasn't meant for you, and you should probably move along.

I've seen plenty of people asking "Can I do Java-like enums in PHP", and all the solutions I have seen to date leave much to be desired. Either the recommendation is to use constants (which prevent non-scalar values) or to use public static variables, which (in my opinion) blows the [Principle of Least Privilege](http://en.wikipedia.org/wiki/Principle_of_least_privilege) clean out of the water. PHP Enum seeks to address both of those issues.

## Requirements

PHP Enum requires PHP 5 >= 5.3.0, as it utilizes the `get_called_class` function which was not introduced until v5.3.0.

## Usage

Using PHP enum is very simple. Below, you can find a simple `Planet` enum created by extending PHP Enum's base class.

```
<?php
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
?>
```

There are a few important things to note in the above example.

First, the Enum class (the base class that all enums should extend) is namespaced to prevent any potential conflicts. The recommended way to access the class is to add `use dbstudios\util\Enum` at the top of your PHP file, below the include for the class file. Alternatively, if you feel like namespacing the class is unnecessary, or if it causes conflicts, you can simply open up `Enum.php` and remove the first line after the opening PHP tag.

Next, any enum should have, at the minimum, one defined method, `init`. This is where we'll register our elements and provide any arguments needed to construct them.

Inside of the `init` method, we use `parent::register` to register new elements. The `register` function uses PHP's `get_called_class` function to determine the class that called the function, so you don't need to worry about specifying which enum the elements should belong to. The first argument to `register` is _always_ the name of the element. **Keep in mind:** the element name is case sensitive, which means that if you register an element as `PLUTO`, you'll have to make sure you access it as `PLUTO`. Any subsequent arguments are considered arguments to your enum's, which I'll discuss in a moment. If your constructor does not take any arguments, just pass the name and you're good to go.

In the example above, I've added a constructor to my enum that takes a single argument; the planet's diameter. I can specify this by including additional arguments during my call to `register`. **Caveat:** Unlike Java's enums, which require you to set the class's constructor to private, PHP Enum requires it to be public. The reason for this is that PHP does not offer any way to access private constructors via reflection, which PHP Enum uses to create instances of your enum's elements.

Next, we call `parent::stopRegistration`. This tells PHP Enum that we've now registered all the elements we need to, and that it should prevent any other elements from being added. Since we use `get_called_class` to determine the source of the `register` call, the chance of an element being put into the wrong enum is very low. However, it's always good to call `stopRegistration` so there's an indicator that your enum is fully initialized.

Finally, outside of our class, we add a line to call `Planet::init()`. PHP does not provide any way to evaluate code within a class automatically when it's loaded, so we need to tell PHP what to do in order to begin initialization of our enum.

Now that we have our enum, we can access any of it's values like so:

```
<?php
  $planet = Planet::EARTH();

  printf('%s has a diameter of %d.', $planet->name(), $planet->getDiameter());
?>
```

The above code will yield output similar to "EARTH has a diameter of 12756.3.".

Additionally, we can iterate over defined elements in an enum.

```
<?php
  foreach (Planet::values() as $planet)
    printf('%s has a diameter of %d.<br>', $planet->name(), $planet->getDiameter());
?>
```

Which will yield output identical to the first example for each planet defined in the `Planet` enum.
