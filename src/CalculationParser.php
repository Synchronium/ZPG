<?php

	class CalculationParser {
		
		public function calculate( $equation ) {
		

			// Operators grouped by precedence
			// Escaped for use in regex
			$operator_patterns = array(
				0 => '*/\^', // Highest priority
				1 => '+-' // Lowest priority
			);
			
			$prev_equation = $equation;
			$new_equation = null;
			
			// Loop through operator priority levels
			foreach ( $operator_patterns as $operator_pattern ) {
			
				// While loop to substitute out simple calculations with their answers
			
				while(
					// Get substitution result and check it against previous string
					( $new_equation = self::_replaceSimpleCalculation( $operator_pattern, $prev_equation ) ) != $prev_equation
			
				) {
			
					// Not a match, so assign results to prev variable
					// and iterate once more...
					$prev_equation = $new_equation;
				
				} // end while
			
			} // end foreach
			
			return $new_equation;
			
		}
		
		private function _replaceSimpleCalculation( $pattern, $equation ) {
		
			$number_pattern = '-?[0-9.]+';
			$regex = "%($number_pattern)\s?([{$pattern}])\s?($number_pattern)%";
			
			// returns a substituted string, swapping one simple calculation
			// with its result
			// eg "3 * 4 + 2" --> "12 + 2"
			return preg_replace_callback( $regex, function ($matches) {
					// This function calls _calculateSimple with both values
					// and operator pulled from the first match of the pattern
					// on the equation string
					$a = $matches[1];
					$b = $matches[3];
					$operator = $matches[2];
					return self::_calculateSimple( $a, $b, $operator );	
				}, $equation, 1 );	// LIMIT = 1
		
		}		
		
		// Gets the result of a simple calculation by mapping the
		// operator symbol to the appropriate method of the Calculator class
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