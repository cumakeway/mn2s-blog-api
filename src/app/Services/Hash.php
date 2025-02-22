<?php


namespace App\Services;

class Hash
{

    public static function factory(): Hash
    {
        return new self;
    }

    public function sha1(string $text, int $strip_tags = 1)
    {
        if($strip_tags) {
            $text = strip_tags($text);
        }

        return sha1($text);
    }
}
