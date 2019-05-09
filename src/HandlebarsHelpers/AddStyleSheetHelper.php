<?php

namespace HandlebarsHelpers;

use Handlebars\Helper;
use Handlebars\Context;
use Handlebars\Template;

class AddStyleSheetHelper implements Helper
{
    public function execute(Template $template, Context $context, $args, $source)
    {
        $parsedArgs = $template->parseArguments($args);
        if (is_array($parsedArgs)) {
            foreach ($parsedArgs as $arg) {
                $src = $context->get($arg);
                try {
                    \WC\Joomla\Helper\AppContext::doc()->addStyleSheet($src);
                }
                catch (\Exception $e) {
                    return '<link href="'.$src.'" rel="stylesheet" type="text/css" />';
                }
            }
        }
        return '';
    }
}
