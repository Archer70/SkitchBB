<?php
namespace App\Utils;

use Michelf\Markdown as MarkdownLib;

class Markdown
{
    private static $transformer;

    private static function transformer()
    {
        if (self::$transformer) {
            return self::$transformer;
        }

        self::$transformer = new MarkdownLib();
        self::$transformer->no_markup = true;
        self::$transformer->no_entities = true;

        self::$transformer->url_filter_func = function($url) {
            return self::filterUrl($url);
        };

        return self::$transformer;
    }

    public static function filterUrl($url)
    {
        $validPrefixes = ['http', 'https']; // Maybe add more valid, but less common options later.
        foreach ($validPrefixes as $prefix) {
            if (stripos($url, $prefix) === 0) {
                return $url;
            }
        }
        return '';
    }

    public static function render($text, $bootstrapConvert=true)
    {
        $markdown = self::transformer()->transform($text);
        return $bootstrapConvert ? self::bootstrapConvert($markdown) : $markdown;
    }

    public static function bootstrapConvert($text)
    {
        $searches = [
            '<pre>'
        ];
        $replacements = [
            '<pre class="pre-scrollable">'
        ];
        return str_replace($searches, $replacements, $text);
    }
}