<?php

namespace HandlebarsHelpers;

use Handlebars\Helper;
use Handlebars\Context;
use Handlebars\Template;
use Joomla\CMS\Language\Text;
use WC\Joomla\ContentModel;

class I18nHelper implements Helper
{
    public function execute(Template $template, Context $context, $args, $source)
    {
        $parsedArgs = $template->parseArguments($args);
        if (isset($parsedArgs[0]) && $parsedArgs[0]) {
            $key = $context->get($parsedArgs[0]);
            $ret = ContentModel::getI18N($key ? $key : $parsedArgs[0]);
            if (($key && $ret === $key) || $ret === $parsedArgs[0]) {
                $ret = Text::_(strtoupper($key ? $key : $parsedArgs[0]));
            }
            return $ret;
        }
        return '';
    }
}
