<?php
/*
* @author: Nahid Bin Azhar
* @author_url: nahid.co 
* @company_name: codesum
* @company_url: codesum.com
* @licence: Paid
* @param array $errors: used for store all errors from validation
* @param array $inputs: store all inputs that will validate

*/

class Validx
{
	protected static $errors=array();
	protected static $inputs=array();
	protected static $messages=array();
	protected static $connection=null;

	protected static $_instance = null;

	function __construct($con=null)
	{
		self::$connection=$con;
	}

	protected static function _apInstance()
	{
		if (self::$_instance === null) {
			self::$_instance = new self;
		}

		return self::$_instance;
	}

	private static function setMessage($input, $rule, $message)
	{
		if(isset(self::$messages[$input][$rule])){
			self::$errors[$input][]=self::$messages[$input][$rule];
		}else{
			self::$errors[$input][]=$message;
		}
	}

	private static function isBlankField($input)
	{
		if(empty($input)){
			return true;
		}

		return false;
	}

	protected static function requiredValidation($input, $name)
	{
		if(empty($input)){
			self::setMessage($name, 'required', $name." is required field");
			return false;
		}else{
			return true;
		}
	}

	protected static function minValidation($input, $param, $name)
	{
		if(self::isBlankField($input)===false)
		{
			$length=strlen($input);
			$min=(int)$param;
			if($length<$min){
				self::setMessage($name, 'min', "The minimum length is for ".$name." is ".$param);
				return false;
			}else{
				return true;
			}
		}
	}

	protected static function maxValidation($input, $param, $name)
	{
		if(self::isBlankField($input)===false)
		{
			$length=strlen($input);
			$max=(int)$param;
			if($length>$max){
				self::setMessage($name, 'max', "The maximum length is for ".$name." is ".$param);
				return false;
			}else{
				return true;
			}
		}
	}

	protected static function fileValidation($input, $name)
	{
		if(self::isBlankField($input)===false)
		{
			if(!isset($_FILES[$name])){
				self::setMessage($name, 'file', $name." is contains no file");
				return false;
			}else{
				return true;
			}
		}
	}

	protected static function dateValidation($input, $name)
	{
		if(self::isBlankField($input)===false)
		{
			if(strtotime($input)===false){
				self::setMessage($name, 'date', $name." is not a valid date");
				return false;
			}else{
				return true;
			}
		}
	}

	protected static function date_maxValidation($input, $param, $name)
	{
		if(self::isBlankField($input)===false)
		{
			if(strtotime($input)<=strtotime($param)){
				self::setMessage($name, 'date_max', $name." is greater than date ".$param);
				return false;
			}else{
				return true;
			}
		}
	}

	protected static function date_minValidation($input, $param, $name)
	{
		if(self::isBlankField($input)===false)
		{
			if(strtotime($input)>=strtotime($param)){
				self::setMessage($name, 'date_min', $name." is smaller than date ".$param);
				return false;
			}else{
				return true;
			}
		}
	}

	protected static function inValidation($input, $param, $name)
	{
		if(self::isBlankField($input)===false)
		{
			$list=explode(',', $param);
			if(!in_array($input, $list)){
				self::setMessage($name, 'in', $name." is not allowed");
				return false;
			}else{
				return true;
			}
		}
	}

	protected static function not_inValidation($input, $param, $name)
	{
		if(self::isBlankField($input)===false)
		{
			$list=explode(',', $param);
			if(in_array($input, $list)){
				self::setMessage($name, 'not_in', $name.' is not allowed. Its contains '.$input);
				return false;
			}else{
				return true;
			}
		}
	}

	protected static function imageValidation($input, $name)
	{
		if(self::isBlankField($input)===false)
		{
			if(isset($_FILES[$name])){
				$supportedImage=array('jpg', 'jpeg', 'bmp', 'png', 'gif');
				$givenExt=pathinfo($input);
				$ext=@$givenExt['extension'];
				if(!in_array($ext, $supportedImage)){
					self::setMessage($name, 'image', $name." is contains no image");
					return false;
				}else{
					return true;
				}
			}else{
				self::setMessage($name, 'image', $name." is contains no image");
				return false;

			}
		}
	}

	protected static function file_typeValidation($input, $param, $name)
	{
		if(self::isBlankField($input)===false)
		{
			if(isset($_FILES[$name])){
				$supportedExt=explode(',', $param);
				$givenExt=pathinfo($input);
				$ext=@$givenExt['extension'];
				if(!in_array($ext, $supportedExt)){
					self::setMessage($name, 'file_type', $name." is contains no supported file type");
					return false;
				}else{
					return true;
				}
			}else{
				return false;

			}
		}
	}

	protected static function sameValidation($input, $param, $name)
	{
		if(self::isBlankField($input)===false)
		{
			if($input!==self::$inputs[$param]){
				self::setMessage($name, 'same', $name." is not match to ". $param);
				return false;
			}else{
				return true;
			}
		}
	}

	protected static function differentValidation($input, $param, $name)
	{
		if(self::isBlankField($input)===false)
		{
			if($input===self::$inputs[$param] OR $input==self::$inputs[$param]){
				self::setMessage($name, 'different', $name." is match to ". $param);
				return false;
			}else{
				return true;
			}
		}
	}

	protected static function emailValidation($input, $name)
	{
		if(self::isBlankField($input)===false){
	    	$at = strrpos($input, '@');
	    	if (!$at || strlen($input) < 6){
	    		self::setMessage($name, 'email', $name." is not valid Email format!");
           		return false;
			}
			$left  = substr($input, 0, $at);
	        $right = substr($input, $at + 1);
	        $res1  = self::ValidateText($left,  1, 64,  "\w\.\+\-", "a");
	        $res2  = self::ValidateText($right, 1, 190, "\a-zA-Z0-9\.\-", "a");
	        $valid = checkdnsrr($right, "ANY");//check for valid domain
			if (!strpos($right, '.') || !$res1 || !$res2 || !$valid){
				self::setMessage($name, 'email', $name." is not valid Email format!");
          		return false;
        	}
        	if (filter_var($input, FILTER_VALIDATE_EMAIL)) {
	    		return true;
	    	}
			self::setMessage($name, 'email', $name." is not valid Email format!");
			return false;
		}

	}

	protected static function urlValidation($input, $name)
	{
		if(self::isBlankField($input)===false)
		{
			if(filter_var($input, FILTER_VALIDATE_URL)){
				return true;
			}else{
				self::setMessage($name, 'url', $name." is not valid URL format!");
				return false;
			}
		}
	}

	protected static function ipValidation($input, $name)
	{
		if(self::isBlankField($input)===false)
		{
			if(filter_var($input, FILTER_VALIDATE_ipL)){
				return true;
			}else{
				self::setMessage($name, 'url', $name." is not valid IP format!");
				return false;
			}
		}
	}

	protected static function numericValidation($input, $name)
	{
		if(self::isBlankField($input)===false)
		{
			if(is_numeric($input)){
				return true;
			}else{
				self::setMessage($name, 'numeric', $name." is not numeric value!");
				return false;	
			}
		}
	}

	protected static function integerValidation($input, $name)
	{
		if(self::isBlankField($input)===false)
		{
			if(is_numeric($input) AND strpos($input, '.')===false){
				if(is_integer((int)$input)){
					return true;
				}else{
					self::setMessage($name, 'integer', $name." is not interger value!");
					return false;		
				}
				
			}else{
				self::setMessage($name, 'integer', $name." is not interger value!");
				return false;	
			}
		}
	}

	protected static function rangeValidation($input, $param, $name)
	{
		if(self::isBlankField($input)===false)
		{
			$range=explode(",", $param);
			$length=strlen($input);
			if(($length>=$range[0]) && ($length<=$range[1])){
				return true;
			}else{
				self::setMessage($name, 'range', $name." must be between ".$range[0]." and ".$range[1]);
				return false;
			}
		}
	}

	protected static function patternValidation($input, $param, $name)
	{
		if(self::isBlankField($input)===false)
		{
			if(preg_match($param, $input)){
				return true;
			}else{
				self::setMessage($name, 'pattern', $name." is not valid");
				return false;
			}
		}
	}

	protected static function uniqueValidation($input, $param, $name)
	{
		if(self::isBlankField($input)===false)
		{
			if($input==''){
				return false;
			}

			$dbs=explode(",", $param);
			$query=mysqli_query(self::$connection, "select {$dbs[1]} FROM {$dbs[0]} WHERE {$dbs[1]}='{$input}'");			

			if($query->num_rows>0){
				self::setMessage($name, 'unique', $errors[$name][]=$input." is already exist");
				return false;
			}else{
				return true;
			}
		}
	}

	protected static function existValidation($input, $param, $name)
	{
		if(self::isBlankField($input)===false)
		{
			if($input==''){
				return false;
			}

			$dbs=explode(",", $param);

			$dbs=explode(",", $param);
			$query=mysqli_query(self::$connection, "select {$dbs[1]} FROM {$dbs[0]} WHERE {$dbs[1]}='{$input}'");
			
			if($query->num_rows>0){
				return true;
			}else{
				self::setMessage($name, 'exist', "Sorry! ".$input." was not found!");
				return false;
			}
		}
	}

	public static function validate(array $inputs, array $rules, array $messages=null)
	{
		//chech the param are exactly array
		if(is_array($inputs) && is_array($rules)){
			self::$inputs=$inputs;
			self::$messages=$messages;

			//contact the all elements of rules array
			foreach ($rules as $key => $val) {

			//split the variable $val to find out all rules 
				//and store all rules in $getRule variable

				$rule=explode("||", $val);
				foreach ($rule as $getRule) {

					//split the variable $getRules to find out its additional paramenter
					$param=explode(':', $getRule);

					$input=isset($inputs[$key])?$inputs[$key]:$_FILES[$key]['name'];
					
					if(count($param)>1){
						
						$method=$param[0]."Validation";
						self::$method($input,$param[1], $key);
					}else{
						$method=$getRule."Validation";
						self::$method($input, $key);
					}
				}
			}

			if(isset(self::$errors)){
				$_SESSION['_ap']['_validation']=self::$errors;
			}

			return self::_apInstance();
		}
	}

/*
*this function return is Error is occurd or not
*/
	public static function hasErrors()
	{
		if(!empty(self::$errors)){
			if(is_array(self::$errors)){
			if(count(self::$errors)>=1){
				return true;
			}else{
				return false;
			}
		}
		}elseif(isset($_SESSION['_ap']['_validation'])){
			if(count($_SESSION['_ap']['_validation'])>=1){
				return true;
			}else{
				return false;
			}
		}
}
/*
* this function is gather all errors in given field 
* if the error are occurd
*/
	public static function getErrors($fieldName)
	{
		$errors=array();

		if(!empty(self::$errors)){
			if(array_key_exists($fieldName, self::$errors)){
			foreach(self::$errors[$fieldName] as $error){
			$errors[]=$error;
				}
			}
		}elseif(isset($_SESSION['_ap']['_validation'])){
			if(array_key_exists($fieldName, $_SESSION['_ap']['_validation'])){
				foreach ($_SESSION['_ap']['_validation'][$fieldName] as $err) {
					$errors[]=$err;
				}
			}
		}
		
	return $errors;
	}

/*
* this function is gather all errors in the validation
* if the error are occurd
*/

	public static function allErrors()
	{
		$errors=array();
		if(!empty(self::$errors)){
			if(is_array(self::$errors)){
			foreach(self::$errors as $key=>$val){
				foreach (self::$errors[$key] as $err) {
					$errors[]=$err;
				}
			}
			}
		}elseif(isset($_SESSION['_ap']['_validation'])){
			foreach ($_SESSION['_ap']['_validation'] as $key => $val) {
				foreach ($_SESSION['_ap']['_validation'][$key] as $err) {
					$errors[]=$err;
				}
			}

			
		}
		return $errors;
	}

	public static function clearMessages()
	{
		if(isset($_SESSION['_ap'])){
			unset($_SESSION['_ap']);
		}
	}

	private static function ValidateText($text, $minlength, $maxlength, $allowed, $required)
	{
   
       $len   = strlen($text);
       $error = [];

       if ($len < $minlength)
          $error[] = "The string length is too short (min $minlength characters)";
       elseif ($len > $maxlength)
          $error[] = "The string length is too long (max $maxlength characters)";

       $result = preg_match_all("/([^$allowed])/", $text, $matches);
       $caught = implode(array_unique($matches[1]), ', ');
       $plural = strlen($caught) > 1 ? $plural = "s are" : " is";

       if ($result) $error[] = "The following character$plural not allowed: " . $caught;

       for ($j = 0 ; $j < strlen($required) ; ++$j){
          switch(substr(strtolower($required), $j, 1)){
             case "a": $regex = "a-zA-Z"; $str = "letter";
                       break;
             case "l": $regex = "a-z";    $str = "lower case";
                       break;
             case "u": $regex = "A-Z";    $str = "upper case";
                       break;
             case "d": $regex = "0-9";    $str = "digit";
                       break;
             case "w": $regex = "\w";     $str = "letter, number or _";
                       break;
             case "p": $regex = "\W";     $str = "punctuation";
                       break;
          }

          if (!preg_match("/[$regex]/", $text))
                $error[] = "The string must include at least one $str character";
        }

       if (count($error)) {
            for ($j = 0; $j < count($error); ++$j) {
                return false;
                //[FALSE, $error];
            }
        } else {
            return TRUE;
        }
    }
}