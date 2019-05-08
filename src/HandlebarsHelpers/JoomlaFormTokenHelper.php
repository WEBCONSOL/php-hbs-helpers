<?php

namespace HandlebarsHelpers;

use Handlebars\Helper;
use Handlebars\Context;
use Handlebars\Template;
use Joomla\CMS\HTML\HTMLHelper;

class JoomlaFormTokenHelper implements Helper
{
    public function execute(Template $template, Context $context, $args, $source)
    {
        return HTMLHelper::_('form.token');
    }
}
