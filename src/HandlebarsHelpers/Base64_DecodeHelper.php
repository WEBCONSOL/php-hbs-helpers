<?php

namespace HandlebarsHelpers;

use Handlebars\Helper;
use Handlebars\Context;
use Handlebars\Template;

class Base64_DecodeHelper implements Helper
{
    public function execute(Template $template, Context $context, $args, $source)
    {
        $parsedArgs = $template->parseArguments($args);
        $buffer = $context->get($parsedArgs[0]);
        if ($buffer) {
            if (StringUtil::isBase64Encoded($buffer)) {
                $buffer = base64_decode($buffer);
            }
        }
        return $buffer;
    }
}
