<?php

namespace HandlebarsHelpers;

final class Hbs
{
    private function __construct(){}

    public static function render(string $tmpl, array $context, string $layoutDir = ''): string {
        if (is_file($tmpl)) {
            $hbsTmpl = file_get_contents($tmpl);
            if (!$layoutDir) {
                $layoutDir = dirname($tmpl);
            }
        }
        else {
            $hbsTmpl = $tmpl;
        }
        $hbsEngine = new \Handlebars\Handlebars([
            'partials_loader' => new \Handlebars\Loader\FilesystemLoader($layoutDir, ['extension' => '.hbs'])
        ]);
        \HandlebarsHelpers\Loader::load($hbsEngine);
        return $hbsEngine->render($hbsTmpl, $context);
    }
}