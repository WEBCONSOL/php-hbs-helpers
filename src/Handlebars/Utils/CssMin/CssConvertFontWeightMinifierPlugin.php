<?php

namespace Handlebars\Utils\CssMin;

/**
 * This {@link aCssMinifierPlugin} will convert the font-weight values normal and bold to their numeric notation.
 *
 * Example:
 * <code>
 * font-weight: normal;
 * font: bold 11px monospace;
 * </code>
 *
 * Will get converted to:
 * <code>
 * font-weight:400;
 * font:700 11px monospace;
 * </code>
 *
 * @package		CssMin/Minifier/Pluginsn
 * @link		http://code.google.com/p/cssmin/
 * @author		Joe Scylla <joe.scylla@gmail.com>
 * @copyright	2008 - 2011 Joe Scylla <joe.scylla@gmail.com>
 * @license		http://opensource.org/licenses/mit-license.php MIT License
 * @version		3.0.1
 */
class CssConvertFontWeightMinifierPlugin extends aCssMinifierPlugin
{
    /**
     * Array of included declaration properties this plugin will process; others declaration properties will get
     * ignored.
     *
     * @var array
     */
    private $include = array
    (
        "font",
        "font-weight"
    );
    /**
     * Regular expression matching the value.
     *
     * @var string
     */
    private $reMatch = null;
    /**
     * Transformation table used by the {@link CssConvertFontWeightMinifierPlugin::reReplace() replacement method}.
     *
     * @var array
     */
    private $transformation = array
    (
        "normal"	=> "400",
        "bold"		=> "700"
    );
    /**
     * Overwrites {@link aCssMinifierPlugin::__construct()}.
     *
     * The constructor will create the {@link CssConvertFontWeightMinifierPlugin::$reMatch replace regular expression}
     * based on the {@link CssConvertFontWeightMinifierPlugin::$transformation transformation table}.
     *
     * @param CssMinifier $minifier The CssMinifier object of this plugin.
     * @return void
     */
    public function __construct(CssMinifier $minifier)
    {
        $this->reMatch = "/(^|\s)+(" . implode("|", array_keys($this->transformation)). ")(\s|$)+/iS";
        parent::__construct($minifier);
    }
    /**
     * Implements {@link aCssMinifierPlugin::minify()}.
     *
     * @param aCssToken $token Token to process
     * @return boolean Return TRUE to break the processing of this token; FALSE to continue
     */
    public function apply(aCssToken &$token)
    {
        if (in_array($token->Property, $this->include) && preg_match($this->reMatch, $token->Value, $m))
        {
            $token->Value = preg_replace_callback($this->reMatch, array($this, 'reReplace'), $token->Value);
        }
        return false;
    }
    /**
     * Callback for replacement value.
     *
     * @param array $match
     * @return string
     */
    private function reReplace($match)
    {
        return $match[1] . $this->transformation[strtolower($match[2])] . $match[3];
    }
    /**
     * Implements {@link aMinifierPlugin::getTriggerTokens()}
     *
     * @return array
     */
    public function getTriggerTokens()
    {
        return array
        (
            "CssAtFontFaceDeclarationToken",
            "CssAtPageDeclarationToken",
            "CssRulesetDeclarationToken"
        );
    }
}
