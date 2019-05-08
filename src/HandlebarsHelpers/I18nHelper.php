<?php

namespace HandlebarsHelpers;

use Handlebars\Helper;
use Handlebars\Context;
use Handlebars\Template;
use Joomla\CMS\Language\Text;

class I18nHelper implements Helper
{
    public function execute(Template $template, Context $context, $args, $source)
    {
        $parsedArgs = $template->parseArguments($args);
        $key = isset($parsedArgs[0]) ? $context->get($parsedArgs[0]) : '';
        return Text::_(strtoupper($key));
    }
}
