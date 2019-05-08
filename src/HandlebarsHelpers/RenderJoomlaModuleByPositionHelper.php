<?php

namespace HandlebarsHelpers;

use Handlebars\Helper;
use Handlebars\Context;
use Handlebars\Template;

class RenderJoomlaModuleByPositionHelper implements Helper
{
    public function execute(Template $template, Context $context, $args, $source)
    {
        $parsedArgs = $template->parseArguments($args);
        $buffer = [];
        if (isset($parsedArgs[0])) {
            $pos = $context->get($parsedArgs[0]);
            $modules = \Joomla\CMS\Helper\ModuleHelper::getModules($pos);
            if (!empty($modules)) {
                foreach ($modules as $module) {
                    $buffer[] = \Joomla\CMS\Helper\ModuleHelper::renderModule($module, []);
                }
            }
        }
        return implode('', $buffer);
    }
}
