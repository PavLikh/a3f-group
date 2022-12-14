<?php

namespace App\Services;

class ParseHtmlService
{
    public function start(string $html, string $method)
    {
        if(method_exists($this, $method)) {
            return $this->$method($html);
        }
    }

    /**
     * @param string $html
     * @return array
     */
    protected function getTegs(string $html)
    {
        $array = $this->countHtmlTegs($this->getAllTags($html));
        return $array;
    }

    /**
     * @param array $data
     * @return array
     */
    protected function countHtmlTegs(array $data)
    {
        $array = [];
        $i = 0;
        while($i < count($data)) {
            $j = 0;
            foreach($array as $key => $val) {
                if ($data[$i] == $key) {
                    $val++;
                    $array[$key]++;
                    break;
                }
                $j++;
            }
            if($j == count($array)) {
                $array[$data[$i]] = 1;
            }
            $i++;
        }
        return $array;
    }

    /**
     * @param string $html
     * @return array
     */
    protected function getAllTags(string $html)
    {
        $array = [];
        $i = 0;
        $teg_nb = 0;
        $k = 0;
        $start = -1;
        while($i < strlen($html)){
            if($html[$i] == '<' && ($html[$i+1] != ' ' && $html[$i+1] != '!' && $html[$i+1] != '/')){
                if ($start < 0) {
                    $i++;
                }
                $start = 1;
            }
            if($start == 1){
                if($html[$i] != '>' && $html[$i] != ' '){
                    $array[$teg_nb][$k++] = $html[$i];
                }
            }
            if($start > 0 && ($html[$i] == '>' || $html[$i] == ' ')){
                $start = -1;
                $teg_nb++;
                $k = 0;
            }
            $i++;
        }
        $data;
        foreach($array as $val) {
            $data[] = implode('', $val);
        }
        return $data;
    }
}
