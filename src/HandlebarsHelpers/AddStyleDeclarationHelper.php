<?php

namespace HandlebarsHelpers;

use Handlebars\Helper;
use Handlebars\Context;
use Handlebars\Template;

class AddStyleDeclarationHelper implements Helper
{
    public function execute(Template $template, Context $context, $args, $source)
    {
        $parsedArgs = $template->parseArguments($args);
        if (is_array($parsedArgs)) {
            foreach ($parsedArgs as $arg) {
                $src = $context->get($arg);
                return '<style type="text/css">'.$src.'</style>';
            }
        }
        return '';
    }
}
