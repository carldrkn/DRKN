<?php
/**
 * Created by PhpStorm.
 * User: vilhelm
 * Date: 08/05/15
 * Time: 03:24
 */

define( 'INDEX_OBJECTS_MULTIPLE', 0 );
define( 'INDEX_OBJECTS_SINGLE', 1 );

define( 'INDEX_OBJECTS_NORMAL', 1 );
define( 'INDEX_OBJECTS_CI', 2 );

function index_objects( $objects, $key, $single = true, $flag = INDEX_OBJECTS_NORMAL ) {

	$index = array();

	foreach ( $objects as $object ) {
		$v = $object->$key;

		if ( $flag == INDEX_OBJECTS_CI )
			$v = mb_strtolower($v, 'UTF-8');

		if ( $single ) {
			$index[$v] = $object;
		}
		else {
			if ( !isset($index[$v]) )
				$index[$v] = array( $object );
			else
				$index[$v][] = $object;

		}
	}

	return $index;
}

function objects_values( $objects, $key, $unique = true ) {

	$values = array();

	foreach ( $objects as $o ) if ( isset($o->$key) ) {
		$v = $o->$key;
		if ( !$unique || !in_array($v, $values))
			$values[] = $v;
	}

	return $values;
}