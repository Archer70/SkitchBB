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
            '<pre>',
            '<blockquote>',
        ];
        $replacements = [
            '<pre class="pre-scrollable">',
            '<blockquote class="blockquote">'
        ];
        $text = str_replace($searches, $replacements, $text);

        // Quote citation
        preg_match_all('/%cite:(\d+)\|(.+)%/U', $text, $matches, \PREG_SET_ORDER);
        foreach ($matches as $match) {
            $html = '
                <footer class="blockquote-footer">
                    '. $match[2]. '
                    <cite title="#'. $match[1]. '">
                        <a href="'. route('posts.show', ['post' => $match[1]]). '">#'. $match[1]. '</a>
                    </cite>
                </footer>';
            $text = str_replace($match[0], $html, $text);
        }
        return $text;
    }
}