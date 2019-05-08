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
        $list = isset($parsedArgs[0]) ? $context->get($parsedArgs[0]) : [];
        $key = isset($parsedArgs[1]) ? $context->get($parsedArgs[1]) : -1;
        if (!empty($list) && $key !== -1 && $key !== null) {
            if (isset($list[$key])) {
                return $list[$key];
            }
        }
        return '';
    }
}
