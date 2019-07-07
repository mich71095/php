<!DOCTYPE html>
<html>
	<head>
		<title>PHP</title>
	</head>
	<body>
		<?php echo "<p>But this code is interpreted by PHP and turned into HTML</p>";
			// $_SERVER -> Built-in super global variable

			// print_r($_SERVER);
			/* print_r(expression) -> displays information about a variable in a way that's readable by humans. array values will be presented in a format that shows keys and elements */

			// var_dump($_SERVER);
			/* var_dump(expression) -> function displays structured information about variables/expressions including its type and value. Arrays are explored recursively with values indented to show structure. */

			// phpinfo();

		?>

		<!-- start form -->
		<h1> FORM </h1>
		<form action="index.php" method="post">
			<p> Name: <input type="text" name="name"/> </p>
			<p> Age: <input type="text" name="age"/> </p>
			<p> <input type="submit"/> </p>
		</form>

		<!-- end form -->

		<?php 
			echo var_dump($_POST);
			echo "Hi"." ".htmlspecialchars($_POST['name']).".";
			echo "\nAge of"." ".htmlspecialchars($_POST['age'].".")

		?>

		<?= "\n\nShort echo tag" ?>


		<!-- Advanced escaping using conditions -->
		<h1> ESCAPE </h1>
		<?php $temp = false ?>
		<?php if ($temp == true): ?>
			<p> Escaping IF TRUE </p>
		<?php else: ?>
			<p> Escaping ELSE FALSE </p>
		<?php endif; ?> 


		<?php for($count=0; $count<5; $count++): ?>
			<p> printing using for loop <?= $count ?> </p>
		<?php endfor; ?>

		<!-- Heredocs -->
		<?php
			// $name = 'JACK';
			// echo <<<EOT
			// My name is "$name". I am printing some $foo->foo.
			// EOT;
		?>

		<!-- Array Start -->
		<h1> ARRAY </h1>
		<?php 
			// simple array
			$array = array(
				'1' => 'one',
				'2' => 'two'
			);

			var_dump($array);

			// as of PHP 5.4
			$array = [
				'3' => 'three',
				'4' => 'four'
			];

			var_dump($array);


			$array = array(
			    "foo" => "bar",
			    42    => 24,
			    "multi" => array(
			         "dimensional" => array(
			             "array" => "foo"
			         )
			    )
			);

			var_dump($array["foo"]);
			var_dump($array[42]);
			var_dump($array["multi"]["dimensional"]["array"]);

			// unset($arr) -> delete array but will not be reindexed
			// array_values($array) -> re-index

			$error_descriptions[E_ERROR]   = "A fatal error has occurred"; // constant
			// int($age) or (int) $age
			// array_diff() -> compare array
			$switching = array(         
				10, // key = 0
	            5    =>  6,
	            3    =>  7, 
	            'a'  =>  4,
	                    11, // key = 6 (maximum of integer-indices was 5)
	            '8'  =>  2, // key = 8 (integer!)
	            '02' => 77, // key = '02'
	            0    => 12  // the value 10 will be overwritten by 12
	        );

			$colors = array('red', 'blue', 'green', 'yellow');

			foreach ($colors as $color) {
			    echo "\nDo you like $color?\n";
			}


			// One-based index
			$firstquarter  = array(1 => 'January', 'February', 'March');
			var_dump($firstquarter);


			// reference
			$foo = 'Bob';              // Assign the value 'Bob' to $foo
			$bar = &$foo;              // Reference $foo via $bar.
			$bar = "My name is $bar";  // Alter $bar...
			echo "<p> $bar </p>";
			echo "<p> $foo </p>"; // same output in #bar

			// Variable varirable
			$variable = "Temp";
			$$variable = "Okay";
			echo "<p> $variable $Temp </p>";



		?>

		<!-- Array End-->


		<!-- Constant -->
		<?php
			define("CONSTANT", "Hello world.");
			const CONSTANT2 = 'Hello World'; 
		?>

		<!-- Operators -->
		<?php 
			// Null Coalescing Operator 

			$action  = $_POST['action'] ?? 'deafult';

			// The above is identical to this if/else statement
			if (isset($_POST['action'])) {
				$action = $_POST['action'];
			} else {
				$action = 'default';
			}

		?>

		<!-- Control structure -->
		<?php
			$value = 'VALUE';
			isset( $value ) AND print( $value ); // if else alternative


			// foreach
			// The foreach construct provides an easy way to iterate over arrays. foreach works only on arrays and objects

			$arr = array(1, 2, 3, 4);
			foreach ($arr as $value) {
			    $value = $value * 2;
			}
			unset($value); // Reference of a $value and the last array element remain even after the foreach loop. It is recommended to destroy it by unset()


			foreach ($arr as $key => $value) {
			    echo "{$key} => {$value} ";
			    print_r($arr);
			}

			// Unpacking nested array
			//ability to iterate over an array of arrays and unpack the nested array into loop variables by providing a list() as the value.
			$array = [
			    [1, 2],
			    [3, 4],
			];

			foreach ($array as list($a, $b)) {
			    // $a contains the first element of the nested array,
			    // and $b contains the second element.
			    echo "A: $a; B: $b\n";
			}


			// goto
			for($i=0,$j=50; $i<100; $i++) {
			  while($j--) {
			    if($j==17) goto end; 
			  }  
			}
			echo "i = $i";
			end:
			echo 'j hit 17';

		?>



		<!-- Functions -->
		<?php 
			// Functionof function
			function foo() 
			{
			  function bar() 
			  {
			    echo "<p> I don't exist until foo() is called. <p>";
			  }
			}

			/* We can't call bar() yet
			   since it doesn't exist. */

			foo();

			/* Now we can call bar(),
			   foo()'s processing has
			   made it accessible. */

			bar();



			// To have an argument to a function always passed by reference, prepend an ampersand (&) to the argument name in the function definition
			function add_some_extra(&$string)
			{
			    $string .= 'and something extra.';
			}
			$str = 'This is a string, ';
			add_some_extra($str);
			echo $str;    // outputs 'This is a string, and something extra.'


			// Variable function
			function echoit($string)
			{
			    echo $string;
			}

			$func = 'echoit';
			$func('string');

			?>

			<!-- Class -->
			<?php 
				class SimpleClass {
					// property declaration
					public $var = 'a default value';

					// method declaration
					public function displayVar () {
						echo $this->var;
					}
				}

				$a = new SimpleClass();
				$a->displayVar();

				SimpleClass::displayVar();


				$instance = new SimpleClass();
				// This can also be done with a variable:
				$className = 'SimpleClass';
				$instance = new $className(); // new SimpleClass()


				// Class properties and methods live in separate "namespaces", so it is possible to have a property and a method with the same name.
				class Foo
				{
				    public $bar = 'property';
				    
				    public function bar() {
				        return 'method';
				    }
				}

				$obj = new Foo();
				echo $obj->bar, PHP_EOL, $obj->bar(), PHP_EOL;


				// $this can be cast to array
				class test
				{
				    public $var1 = 1;
				    protected $var2 = 2;
				    private $var3 = 3;
				    static $var4 = 4;
				   
				    public function toArray()
				    {
				        return (array) $this;
				    }
				}
				$t = new test;
				print_r($t->toArray());


				// The special ::class is useful for namespaced classes 
				namespace foo {
				    class bar {
				    }

				    echo bar::class; // foo\bar
				}
				class foo {
				    // As of PHP 5.6.0
				    const TWO = ONE * 2;
				    const THREE = ONE + self::TWO;
				    const SENTENCE = 'The value of THREE is '.self::THREE;
				}


				// SELF vs THIS -> self is for the parent or base class, this is for current class
				// const INIT=0, NAME_SEEN=1, ADDR_SEEN=2;



				// Inheritance
				class ExtendClass extends SimpleClass
				{
				    // Redefine the parent method
				    function displayVar()
				    {
				        echo "Extending class\n";
				        parent::displayVar();
				    }
				}

				// Inside the classes definition
				// Three special keywords self, parent and static are used to access properties or methods from inside the class definition. 
				class MyClass {
				    const CONST_VALUE = 'A constant value';
				}

				class OtherClass extends MyClass
				{
				    public static $my_static = 'static var';

				    public static function doubleColon() {
				        echo parent::CONST_VALUE . "\n";
				        echo self::$my_static . "\n";
				    }
				}

				$classname = 'OtherClass';
				$classname::doubleColon(); // As of PHP 5.3.0

				OtherClass::doubleColon();



				// Calling a parent's method
				class MyClass2
				{
				    protected function myFunc() {
				        echo "MyClass2::myFunc()\n";
				    }
				}

				class OtherClass2 extends MyClass2
				{
				    // Override parent's definition
				    public function myFunc()
				    {
				        // But still call the parent function
				        parent::myFunc();
				        echo "OtherClass2::myFunc()\n";
				    }
				}

				$class = new OtherClass2();
				$class->myFunc();



				// A class constant, class property (static), and class function (static) can all share the same name and be accessed using the double-colon.
				class A {

				    public static $B = '1'; # Static class variable.

				    const B = '2'; # Class constant.
				   
				    public static function B() { # Static class function.
				        return '3';
				    }
				   
				}

				echo A::$B . A::B . A::B(); # Outputs: 123


				// In PHP, you use the self keyword to access static properties and methods.

				// The problem is that you can replace $this->method() with self::method() anywhere, regardless if method() is declared static or not. So which one should you use?
				



			?>


		

	</body>
</html>

<?php
	$name = 'Jack';
	echo "<h1> PHP without closing tag </h1>";
	// <'> -> string
	// <"> -> can output $variable and special character
	echo "<p>We omitted the last closing tag {$name}</p>"; //advisable for complex
	echo "<p>We omitted the last closing tag $name</p>";
	echo "<p>We omitted the last closing tag ${name}</p>";