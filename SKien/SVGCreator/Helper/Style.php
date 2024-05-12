<?php

declare(strict_types=1);

namespace SKien\SVGCreator\Helper;

/**
 * Class to maintain a list of styles.
 *
 * @extends \ArrayObject<string,string|float>
 * @author Stefanius <s.kientzler@online.de>
 * @copyright MIT License - see the LICENSE file for details
 */
class Style extends \ArrayObject implements \Stringable
{
    /**
     * Maintains a list of styles.
     * @param string|array<string,string|float> $style
     */
    public function __construct(string|array $style = '')
    {
        if (is_array($style)) {
            parent::__construct($style);
        } else {
            parent::__construct();
            $this->parse($style);
        }
    }

    /**
     * Converts the object to a readable string to use in CSS or other style definitions.
     * An style property is represented by its name, which is assigned its value using the
     * ':' character. Multiple attributes are separated from each other by semicolon ';'.
     * @see \Stringable::__toString()
     */
    public function __toString() : string
    {
        $strStyle = '';
        foreach ($this as $strName => $strValue) {
            $strStyle .= $strName . ': ' . $strValue . '; ';
        }
        return trim($strStyle);
    }

    /**
     * Clears the ArrayObject data.
     */
    public function clear() : void
    {
        $this->exchangeArray([]);
    }

    /**
     * Parses the given style definitions into the internal list.
     * @param string $strStyleDef
     */
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

    /**
     * Adds the style definition to a DOM element.
     * The composed style string is set as 'style' attribute.
     * @param \DOMElement $oNode
     * @return \DOMElement
     */
    public function addToDOMNode(\DOMElement $oNode) : \DOMElement
    {
        if (count($this) > 0) {
            $oNode->setAttribute('style', (string) $this->__toString());
        }
        return $oNode;
    }
}