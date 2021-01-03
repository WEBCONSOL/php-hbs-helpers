<?php

namespace HandlebarsHelpers\Utils;

final class HBS
{
    private static $tmplDir = '';

    private function __construct(){}

    public static function setTmplDir(string $d): void {self::$tmplDir=$d;}

    public static function render(string $tmpl, array $context, array $options = array(), string $tmplDir=''): string
    {
        if (empty($options)) {
            $options = [
                'partials_loader' => new PartialLoader(
                    ($tmplDir?$tmplDir:self::$tmplDir).DIRECTORY_SEPARATOR.'hbs',
                    ['extension' => '.hbs']
                )
            ];
        }
        $engine = new Engine($options);
        $responseContent = $engine->render($tmpl, $context);
        unset($engine);
        return $responseContent;
    }
}