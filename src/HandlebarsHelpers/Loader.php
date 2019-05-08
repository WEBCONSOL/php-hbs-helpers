<?php

namespace HandlebarsHelpers;

class Loader
{
    private static $packagePfx = 'HandlebarsHelpers\\';

    public static function load(\Handlebars\Handlebars $hbs) {
        $list = glob(__DIR__ . '/*Helper.php');
        foreach ($list as $helper)
        {
            $className = pathinfo($helper, PATHINFO_FILENAME);
            $cls = self::$packagePfx . $className;
            $helperName = str_replace('helper', '', strtolower($className));
            if (!class_exists($cls, false)) {
                include $helper;
            }
            $hbs->addHelper($helperName, new $cls);
        }
    }
}