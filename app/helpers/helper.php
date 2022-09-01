<?php

if (! function_exists('array_swap')) {
	function array_swap (&$arr, $num)
	{
		$code = 0;
        $temp = 0;
        if (isset($arr[$num])) {
            $temp = $arr[0];
            $arr[0] = $arr[$num];
            $arr[$num] = $temp;
        } else {
         $code = 1;
        }
		return $code;
	}
}

if (! function_exists('ft_array_sort')) {
	function ft_array_sort (&$arr)
	{
        $n = count($arr) - 1;
        while($n)
        {
            $max = 0;
            $i = $n;
            while ($i) {
                if($max < $arr[$i]) {
                    $max = $arr[$i];
                    array_swap($arr, $i);
                    $i = $n;
                }
                $i--;
            }
            if ($max > $arr[$n]){
                array_swap($arr, $n);
            }
            $n--;
        }
	}
}
