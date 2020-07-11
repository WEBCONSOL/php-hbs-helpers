<?php

namespace HandlebarsHelpers;

use Handlebars\Helper;
use Handlebars\Context;
use Handlebars\Template;
use WC\Utilities\Minify;

class JSDeclarationHelper implements Helper
{
    public function execute(Template $template, Context $context, $args, $source)
    {
        $parsedArgs = $template->parseArguments($args);
        if ($parsedArgs[0]) {
            if (pathinfo($parsedArgs[0], PATHINFO_EXTENSION) === 'js') {
                return '<script type="text/javascript">'.Minify::js($template->getEngine()->getPartialsLoader()->load($parsedArgs[0])).'</script>';
            }
            return '<script>'.Minify::js($parsedArgs[0]).'</script>';
        }
        return '';
    }
}
