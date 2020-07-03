<?php

namespace HandlebarsHelpers;

use Handlebars\Helper;
use Handlebars\Context;
use Handlebars\Template;

class AddHandlebarsJSTemplateHelper implements Helper
{
    public function execute(Template $template, Context $context, $args, $source)
    {
        $parsedArgs = $template->parseArguments($args);
        $paths = isset($parsedArgs[0]) ? $context->get($parsedArgs[0]) : $parsedArgs[0];
        $html = [];
        if (!empty($paths)) {
            if (is_array($paths)) {
                foreach ($paths as $key=>$path) {
                    if (file_exists($path)) {
                        $html[] = '<script type="text/x-handlebars-template" data-hbstmpl="'.$key.'">';
                        $html[] = file_get_contents($path);
                        $html[] = '</'.'script>';
                    }
                }
            }
            else if (is_string($paths) && file_exists($paths)) {
                $html[] = '<script type="text/x-handlebars-template" data-hbstmpl="'.pathinfo($paths, PATHINFO_FILENAME).'">';
                $html[] = file_get_contents($paths);
                $html[] = '</'.'script>';
            }
        }
        return implode('', $html);
    }
}
