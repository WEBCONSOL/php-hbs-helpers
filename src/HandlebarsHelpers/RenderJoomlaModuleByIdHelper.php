<?php

namespace HandlebarsHelpers;

use Handlebars\Helper;
use Handlebars\Context;
use Handlebars\Template;
use WC\Joomla\JModule;

class RenderJoomlaModuleByIdHelper implements Helper
{
    public function execute(Template $template, Context $context, $args, $source)
    {
        $parsedArgs = $template->parseArguments($args);
        if (isset($parsedArgs[0])) {
            $id = $context->get($parsedArgs[0]);
            if (is_numeric($id)) {
                return JModule::renderModuleByID($id);;
            }
        }
        return '';
    }
}
