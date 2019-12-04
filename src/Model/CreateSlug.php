<?php
namespace App\Model;

class CreateSlug
{

    function replace_char($theString, $limit = null) {
        if ($limit) {
            $theString = mb_substr($theString, 0, $limit, "utf-8");

        }
        $theString=strtolower($theString);
        $text = html_entity_decode($theString, ENT_QUOTES, 'UTF-8');
        // replace non letter or digits by -
        $text = preg_replace('~[^\\pL\d]+~u', '-', $text);
        // trim
        $text = trim($text, '-');
        return $text;
    }
}