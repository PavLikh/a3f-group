<?php

if (! function_exists('array_swap')) {
	function array_swap (&$arr, $num)
	{
		$code = 0;
        if (isset($arr[$num])) {
            array_unshift($arr, $arr[$num]);
            $arr[$num + 1] = $arr[1];
            unset($arr[1]);
        } else {
        	$code = 1;
        }
		return $code;
	}
}
