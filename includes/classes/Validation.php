<?php
	class Validation
	{
		/************************************************/
		/*	Function that Validates only for Characters */		
		/************************************************/		
		public static function validate_forOnlyCharacters ($value) {
			if (!preg_match("/^[a-zA-Z\s]+$/", $value)) {
				return false;
    		}
    		return true;
		} /* End of Function */
		
		
		
		/************************************************/
		/*	Function that Validates not Blank */		
		/************************************************/		
		public static function validate_notBlank ($value) {
			if ($value == "") {
				return false;
    		}
    		return true;
		} /* End of Function */		
	}
?>