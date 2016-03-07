<?php
/**
 * Sort multidimensional Array by Value
 *
 * Sort this array by the value of the "order" key :
 * Array(
 * 	[0] => Array(
 * 		[title] => Flower
 * 		[order] => 3
 * 	)
 * 	[1] => Array(
 * 		[title] => Free
 * 		[order] => 2
 * 	)
 * 	[2] => Array(
 * 		[title] => Ready
 * 		[order] => 1
 * 	)
 * )
 *
 * Source: http://stackoverflow.com/questions/2699086/sort-multidimensional-array-by-value-2
 */
if ( ! function_exists( 'array_sort_by_column' ) ) {
	function array_sort_by_column( &$array, $col, $dir = SORT_ASC ) {
		$sort_col = array();
		foreach ( $array as $key => $row ) {
			$sort_col[$key] = $row[$col];
		}

		array_multisort( $sort_col, $dir, $array );
	}
}
