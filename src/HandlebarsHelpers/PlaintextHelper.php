<?php

namespace HandlebarsHelpers;

use Handlebars\Helper;
use Handlebars\Context;
use Handlebars\Template;

class PlaintextHelper implements Helper
{
    public function execute(Template $template, Context $context, $args, $source)
    {
        $parsedArgs = $template->parseArguments($args);
        $buffer = $context->get($parsedArgs[0]);
        if ($buffer && is_string($buffer)) {
            $buffer = strip_tags($buffer);
            $parts = explode(' ', $buffer);
            $size = sizeof($parts);
            if ($size > 40) {
                $words1 = [];
                $words2 = [];
                for ($i = 0; $i < $size; $i++) {
                    if ($i < 40) {$words1[]=$parts[$i];}
                    else {$words2[]=$parts[$i];}
                }
                $html = [join(' ', $words1)];
                $html[] = '';
                $id = uniqid('ml-');
                $html[] = '<span class="hide">'.join(' ', $words2).'</span>';
                $html[] = '<a href="javascript:void(0)" id="'.$id.'">';
                $html[] = '<span class="show m">show_more</span><span class="show l hide">show_less</span>';
                $html[] = '</a>';
                $buffer = join('', $html);
            }
        }
        return $buffer;
    }
}
