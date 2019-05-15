<?php

namespace HandlebarsHelpers;

use Handlebars\Helper;
use Handlebars\Context;
use Handlebars\Template;

class AddScriptHelper implements Helper
{
    public function execute(Template $template, Context $context, $args, $source)
    {
        $parsedArgs = $template->parseArguments($args);
        if (is_array($parsedArgs)) {
            foreach ($parsedArgs as $arg) {
                $src = $context->get($arg);
                try {
                    \WC\Joomla\Helper\AppContext::doc()->addScript($src);
                }
                catch (\Exception $e) {
                    return '<script src="'.$src.'"></script>';
                }
            }
        }
        return '';
    }
}
