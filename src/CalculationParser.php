<?php

	class CalculationParser {
	
		private $_equasion;
		
		
		public function __construct( $equasion ) {
		
			$this->_equasion = $equasion;
		
		}
	
		public function calculate() {
		
			// Step 1 -  multiply, divide and exponentials
			// while preg_match returns true,
			// swap out simple calculations with their result one by one
			// Feed new shorter equasion back in
			
			$new = $this->_replaceSimpleCalculation( '*/\^', $this->_equasion );
			
			// Step 2 - add and subtract
			// same as step 1

			$new = $this->_replaceSimpleCalculation( '+-', $new );

			
			return $new;
			
		
		}
		
		private function _replaceSimpleCalculation( $pattern, $equasion ) {
		
			$regex = "%(\d+)\s([{$pattern}])\s(\d+)%";
			
			return preg_replace_callback( $regex, 
			
				function ($matches) {
				
					$a = $matches[1];
					$b = $matches[3];
					$operator = $matches[2];

					return self::_calculateSimple( $a, $b, $operator );	
				
				}
			
			, $equasion );	
		
		}		
		
		private function _calculateSimple( $a, $b, $operator ) {
	
			$function = null;
	
			switch ($operator) {
				case "+":
					$function = "add";
					break;
				case "-":
					$function = "subtract";
					break;
				case "*":
					$function = "multiply";
					break;
				case "/":
					$function = "divide";
					break;
				
				case "^":
					$function = "power";
					break;
			}
				
				
			if ( ! is_null( $function ) ) {
			
				return Calculator::$function( $a, $b );
			
			}
			
			return false;	
	
		}
	
	}
?>