<?php

namespace HandlebarsHelpers;

use Handlebars\Helper;
use Handlebars\Context;
use Handlebars\Template;
use WC\Utilities\CustomResponse;

class GetContentHelper implements Helper
{
    public function execute(Template $template, Context $context, $args, $source)
    {
        $parsedArgs = $template->parseArguments($args);
        $filePath = $context->get($parsedArgs[0]);
        if ($filePath && file_exists(JPATH_ROOT . DS . $filePath)) {
            $parsedArgs[1] = $context->get($parsedArgs[1]);
            if (isset($parsedArgs[1]) && (is_array($parsedArgs[1]) || is_object($parsedArgs[1]))) {
                $buffer = file_get_contents(JPATH_ROOT.DS.$filePath);
                $paramKeys = array_keys($parsedArgs[1]);
                foreach ($paramKeys as $i=>$key) {$paramKeys[$i]='{{'.$key.'}}';}
                $paramValues = array_values($parsedArgs[1]);
                return str_replace($paramKeys, $paramValues, $buffer);
            }
            else {
                return file_get_contents(JPATH_ROOT.DS.$filePath);
            }
        }
        CustomResponse::render(500, 'HBS Helper Error. File path does not exist: '.$filePath);
    }
}
