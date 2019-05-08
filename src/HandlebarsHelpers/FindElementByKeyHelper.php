<?php

namespace HandlebarsHelpers;

use Handlebars\Helper;
use Handlebars\Context;
use Handlebars\Template;

class FindElementByKeyHelper implements Helper
{
    public function execute(Template $template, Context $context, $args, $source)
    {
        $parsedArgs = $template->parseArguments($args);
        $list = $context->get($parsedArgs[0]);
        $key = $context->get($parsedArgs[1]);
        $buffer = '';

        if ((is_array($list) || is_object($list)) && isset($list[$key])) {
            $buffer = $list[$key];
        }

        return $buffer;
    }
}
