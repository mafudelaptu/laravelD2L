<?php

class General {
	public static function recursive_array_search($needle,$haystack) {
        foreach($haystack as $key=>$value) {
                $current_key=$key;
                if($needle===$value OR (is_array($value) && recursive_array_search($needle,$value) !== false)) {
                        return $current_key;
                }
        }
        return false;
    }
}
