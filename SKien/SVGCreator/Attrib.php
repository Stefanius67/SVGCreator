<?php
declare(strict_types=1);

namespace SKien\SVGCreator;

/**
 * @author Stefanius <s.kientzler@online.de>
 * @copyright MIT License - see the LICENSE file for details
 */
class Attrib extends \ArrayObject implements \Stringable
{
    public function __construct(string|array $attrib = '')
    {
        if (is_array($attrib)) {
            parent::__construct($attrib);
        } else {
            parent::__construct();
            $this->parse($attrib);
        }
    }

    public function __toString() : string
    {
        $strAttributes = '';
        foreach ($this as $strName => $strValue) {
            $strAttributes .= $strName . '="' . $strValue . '" ';
        }
        return trim($strAttributes);
    }

    public function parse(string $strAttributes) : void
    {
        $aMatches = [];
        if (preg_match_all('/\s*([^\s]*)\s*=\s*"([^"]*)"\s*/', $strAttributes, $aMatches)) {
            foreach ($aMatches as $aMatch) {
                $this[$aMatch[1]] = $aMatch[2];
            }
        }
    }

    public function addToDOMNode(\DOMNode $oNode) : void
    {
        foreach ($this as $strName => $strValue) {
            $oNode->setAttribute($strName, (string) $strValue);
        }
    }
}