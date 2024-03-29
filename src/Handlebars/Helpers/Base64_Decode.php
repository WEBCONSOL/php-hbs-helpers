<?php

namespace Handlebars\Helpers;

use Handlebars\Context;
use Handlebars\Helper;
use Handlebars\Template;
use Handlebars\Utils\EncodingUtil;

class Base64_Decode implements Helper
{
    public function execute(Template $template, Context $context, $args, $source)
    {
        $parsedArgs = $template->parseArguments($args);
        $buffer = $context->get($parsedArgs[0]);
        if ($buffer) {
            if (EncodingUtil::isBase64Encoded($buffer)) {
                $buffer = base64_decode($buffer);
            }
        }
        return $buffer;
    }
}
