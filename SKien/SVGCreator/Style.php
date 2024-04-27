<?php
declare(strict_types=1);

namespace SKien\SVGCreator;

/**
 * @author Stefanius <s.kientzler@online.de>
 * @copyright MIT License - see the LICENSE file for details
 */
class Style extends \ArrayObject implements \Stringable
{
    public function __construct(string|array $style = '')
    {
        if (is_array($style)) {
            parent::__construct($style);
        } else {
            parent::__construct();
            $this->parse($style);
        }
    }

    public function __toString() : string
    {
        $strStyle = '';
        foreach ($this as $strName => $strValue) {
            $strStyle .= $strName . ': ' . $strValue . '; ';
        }
        return trim($strStyle);
    }

    public function parse(string $strStyleDef) : void
    {
        $aStyles = explode(';', $strStyleDef);
        foreach ($aStyles as $strStyle) {
            $aStyle = explode(':', trim($strStyle));
            if (count($aStyle) == 2) {
                $this[trim($aStyle[0])] = trim($aStyle[1]);
            }
        }
    }

    public function addToDOMNode(\DOMNode $oNode) : void
    {
        if (count($this) > 0) {
            $oNode->setAttribute('style', (string) $this->__toString());
        }
    }
}