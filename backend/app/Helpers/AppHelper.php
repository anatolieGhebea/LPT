<?php 
namespace App\Helpers;


// HELPER CLASS 
// Add helper functions that can be used in every poiny of the application
class AppHelper {


	/**
	 * This method will unset all the kesy that don't match the list of keys passe int the variable $keysToMatch
	 * @param Array $arr the origial array
	 * @param Array $keysToMatch the list of the keys to keep
	 * @return Array the resulting array 
	 */
	public static function arrayUnsetUnmachingKeys($arr, $keysToMatch = []){

		if(empty($arr) || empty($keysToMatch) )
			return $arr;

		$keysToUnset = [];
		foreach( $arr as $k => $v ){
			if(!in_array( $k, $keysToMatch ))
				$keysToUnset[] = $k;
		}

		if(!empty($keysToUnset)){
			foreach( $keysToUnset as $kk => $id ){
				if( isset($arr[$id]) )
					unset($arr[$id]);
			}
		}

		return $arr;
	}


	/**
	 * This method will unset all the kesy that have been passed via the $keysToUnset variable.
	 * @param Array $arr the origial array
	 * @param Array $keysToUnset the list of the keys to keep
	 * @return Array the resulting array 
	 */
	public static function arrayUnsetKeyList($arr, $keysToUnset = []){

		if(empty($arr) || empty($keysToUnset) )
			return $arr;

		if(!empty($keysToUnset)){
			foreach( $keysToUnset as $kk => $id ){
				if( isset($arr[$id]) )
					unset($arr[$id]);
			}
		}

		return $arr;
	}


}
?>