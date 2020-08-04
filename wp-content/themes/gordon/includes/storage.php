<?php
/**
 * Theme storage manipulations
 *
 * @package WordPress
 * @subpackage GORDON
 * @since GORDON 1.0
 */

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }

// Get theme variable
if (!function_exists('gordon_storage_get')) {
	function gordon_storage_get($var_name, $default='') {
		global $GORDON_STORAGE;
		return isset($GORDON_STORAGE[$var_name]) ? $GORDON_STORAGE[$var_name] : $default;
	}
}

// Set theme variable
if (!function_exists('gordon_storage_set')) {
	function gordon_storage_set($var_name, $value) {
		global $GORDON_STORAGE;
		$GORDON_STORAGE[$var_name] = $value;
	}
}

// Check if theme variable is empty
if (!function_exists('gordon_storage_empty')) {
	function gordon_storage_empty($var_name, $key='', $key2='') {
		global $GORDON_STORAGE;
		if (!empty($key) && !empty($key2))
			return empty($GORDON_STORAGE[$var_name][$key][$key2]);
		else if (!empty($key))
			return empty($GORDON_STORAGE[$var_name][$key]);
		else
			return empty($GORDON_STORAGE[$var_name]);
	}
}

// Check if theme variable is set
if (!function_exists('gordon_storage_isset')) {
	function gordon_storage_isset($var_name, $key='', $key2='') {
		global $GORDON_STORAGE;
		if (!empty($key) && !empty($key2))
			return isset($GORDON_STORAGE[$var_name][$key][$key2]);
		else if (!empty($key))
			return isset($GORDON_STORAGE[$var_name][$key]);
		else
			return isset($GORDON_STORAGE[$var_name]);
	}
}

// Inc/Dec theme variable with specified value
if (!function_exists('gordon_storage_inc')) {
	function gordon_storage_inc($var_name, $value=1) {
		global $GORDON_STORAGE;
		if (empty($GORDON_STORAGE[$var_name])) $GORDON_STORAGE[$var_name] = 0;
		$GORDON_STORAGE[$var_name] += $value;
	}
}

// Concatenate theme variable with specified value
if (!function_exists('gordon_storage_concat')) {
	function gordon_storage_concat($var_name, $value) {
		global $GORDON_STORAGE;
		if (empty($GORDON_STORAGE[$var_name])) $GORDON_STORAGE[$var_name] = '';
		$GORDON_STORAGE[$var_name] .= $value;
	}
}

// Get array (one or two dim) element
if (!function_exists('gordon_storage_get_array')) {
	function gordon_storage_get_array($var_name, $key, $key2='', $default='') {
		global $GORDON_STORAGE;
		if (empty($key2))
			return !empty($var_name) && !empty($key) && isset($GORDON_STORAGE[$var_name][$key]) ? $GORDON_STORAGE[$var_name][$key] : $default;
		else
			return !empty($var_name) && !empty($key) && isset($GORDON_STORAGE[$var_name][$key][$key2]) ? $GORDON_STORAGE[$var_name][$key][$key2] : $default;
	}
}

// Set array element
if (!function_exists('gordon_storage_set_array')) {
	function gordon_storage_set_array($var_name, $key, $value) {
		global $GORDON_STORAGE;
		if (!isset($GORDON_STORAGE[$var_name])) $GORDON_STORAGE[$var_name] = array();
		if ($key==='')
			$GORDON_STORAGE[$var_name][] = $value;
		else
			$GORDON_STORAGE[$var_name][$key] = $value;
	}
}

// Set two-dim array element
if (!function_exists('gordon_storage_set_array2')) {
	function gordon_storage_set_array2($var_name, $key, $key2, $value) {
		global $GORDON_STORAGE;
		if (!isset($GORDON_STORAGE[$var_name])) $GORDON_STORAGE[$var_name] = array();
		if (!isset($GORDON_STORAGE[$var_name][$key])) $GORDON_STORAGE[$var_name][$key] = array();
		if ($key2==='')
			$GORDON_STORAGE[$var_name][$key][] = $value;
		else
			$GORDON_STORAGE[$var_name][$key][$key2] = $value;
	}
}

// Merge array elements
if (!function_exists('gordon_storage_merge_array')) {
	function gordon_storage_merge_array($var_name, $key, $value) {
		global $GORDON_STORAGE;
		if (!isset($GORDON_STORAGE[$var_name])) $GORDON_STORAGE[$var_name] = array();
		if ($key==='')
			$GORDON_STORAGE[$var_name] = array_merge($GORDON_STORAGE[$var_name], $value);
		else
			$GORDON_STORAGE[$var_name][$key] = array_merge($GORDON_STORAGE[$var_name][$key], $value);
	}
}

// Add array element after the key
if (!function_exists('gordon_storage_set_array_after')) {
	function gordon_storage_set_array_after($var_name, $after, $key, $value='') {
		global $GORDON_STORAGE;
		if (!isset($GORDON_STORAGE[$var_name])) $GORDON_STORAGE[$var_name] = array();
		if (is_array($key))
			gordon_array_insert_after($GORDON_STORAGE[$var_name], $after, $key);
		else
			gordon_array_insert_after($GORDON_STORAGE[$var_name], $after, array($key=>$value));
	}
}

// Add array element before the key
if (!function_exists('gordon_storage_set_array_before')) {
	function gordon_storage_set_array_before($var_name, $before, $key, $value='') {
		global $GORDON_STORAGE;
		if (!isset($GORDON_STORAGE[$var_name])) $GORDON_STORAGE[$var_name] = array();
		if (is_array($key))
			gordon_array_insert_before($GORDON_STORAGE[$var_name], $before, $key);
		else
			gordon_array_insert_before($GORDON_STORAGE[$var_name], $before, array($key=>$value));
	}
}

// Push element into array
if (!function_exists('gordon_storage_push_array')) {
	function gordon_storage_push_array($var_name, $key, $value) {
		global $GORDON_STORAGE;
		if (!isset($GORDON_STORAGE[$var_name])) $GORDON_STORAGE[$var_name] = array();
		if ($key==='')
			array_push($GORDON_STORAGE[$var_name], $value);
		else {
			if (!isset($GORDON_STORAGE[$var_name][$key])) $GORDON_STORAGE[$var_name][$key] = array();
			array_push($GORDON_STORAGE[$var_name][$key], $value);
		}
	}
}

// Pop element from array
if (!function_exists('gordon_storage_pop_array')) {
	function gordon_storage_pop_array($var_name, $key='', $defa='') {
		global $GORDON_STORAGE;
		$rez = $defa;
		if ($key==='') {
			if (isset($GORDON_STORAGE[$var_name]) && is_array($GORDON_STORAGE[$var_name]) && count($GORDON_STORAGE[$var_name]) > 0) 
				$rez = array_pop($GORDON_STORAGE[$var_name]);
		} else {
			if (isset($GORDON_STORAGE[$var_name][$key]) && is_array($GORDON_STORAGE[$var_name][$key]) && count($GORDON_STORAGE[$var_name][$key]) > 0) 
				$rez = array_pop($GORDON_STORAGE[$var_name][$key]);
		}
		return $rez;
	}
}

// Inc/Dec array element with specified value
if (!function_exists('gordon_storage_inc_array')) {
	function gordon_storage_inc_array($var_name, $key, $value=1) {
		global $GORDON_STORAGE;
		if (!isset($GORDON_STORAGE[$var_name])) $GORDON_STORAGE[$var_name] = array();
		if (empty($GORDON_STORAGE[$var_name][$key])) $GORDON_STORAGE[$var_name][$key] = 0;
		$GORDON_STORAGE[$var_name][$key] += $value;
	}
}

// Concatenate array element with specified value
if (!function_exists('gordon_storage_concat_array')) {
	function gordon_storage_concat_array($var_name, $key, $value) {
		global $GORDON_STORAGE;
		if (!isset($GORDON_STORAGE[$var_name])) $GORDON_STORAGE[$var_name] = array();
		if (empty($GORDON_STORAGE[$var_name][$key])) $GORDON_STORAGE[$var_name][$key] = '';
		$GORDON_STORAGE[$var_name][$key] .= $value;
	}
}

// Call object's method
if (!function_exists('gordon_storage_call_obj_method')) {
	function gordon_storage_call_obj_method($var_name, $method, $param=null) {
		global $GORDON_STORAGE;
		if ($param===null)
			return !empty($var_name) && !empty($method) && isset($GORDON_STORAGE[$var_name]) ? $GORDON_STORAGE[$var_name]->$method(): '';
		else
			return !empty($var_name) && !empty($method) && isset($GORDON_STORAGE[$var_name]) ? $GORDON_STORAGE[$var_name]->$method($param): '';
	}
}

// Get object's property
if (!function_exists('gordon_storage_get_obj_property')) {
	function gordon_storage_get_obj_property($var_name, $prop, $default='') {
		global $GORDON_STORAGE;
		return !empty($var_name) && !empty($prop) && isset($GORDON_STORAGE[$var_name]->$prop) ? $GORDON_STORAGE[$var_name]->$prop : $default;
	}
}
?>