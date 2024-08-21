<?php

declare(strict_types=1);

namespace SKien\SVGCreator\Helper;

/**
 * Class to maintain a list of attributes.
 *
 * @extends \ArrayObject<string,string|float>
 * @author Stefanius <s.kientzler@online.de>
 * @copyright GPLv3 License - see the LICENSE file for details
 */
class Attrib extends \ArrayObject implements \Stringable
{
    /**
     * Maintains a list of attributes.
     * @param string|array<string,string|float> $attrib initial attributes
     */
    public function __construct(string|array $attrib = '')
    {
        if (is_array($attrib)) {
            parent::__construct($attrib);
        } else {
            parent::__construct();
            $this->parse($attrib);
        }
    }

    /**
     * Converts the object to a readable string to use in HTML or other attribute
     * definitions.
     * An attribute is represented by its name, which is assigned its value in double
     * quotation marks using the '=' character. Multiple attributes are separated from
     * each other by spaces.
     * @see \Stringable::__toString()
     * @return string   the complete attribute list
     */
    public function __toString() : string
    {
        $strAttributes = '';
        foreach ($this as $strName => $strValue) {
            $strAttributes .= $strName . '="' . $strValue . '" ';
        }
        return trim($strAttributes);
    }

    /**
     * Clears the ArrayObject data.
     */
    public function clear() : void
    {
        $this->exchangeArray([]);
    }

    /**
     * Parses the given list of attributes into the internal list.
     * Attributes can only be recognized correctly, if the value is enclosed in double
     * quotation marks.
     * @param string $strAttributes list of attributes
     */
    public function parse(string $strAttributes) : void
    {
        $aMatches = [];
        if (preg_match_all('/\s*([^\s]*)\s*=\s*"([^"]*)"\s*/', $strAttributes, $aMatches)) {
            $aNames = $aMatches[1];
            $aValues = $aMatches[2];
            $iCnt = count($aNames);
            for ($i = 0; $i < $iCnt; $i++) {
                $this[$aNames[$i]] = $aValues[$i];
            }
        }
    }

    /**
     * Adds the attributes to a DOM element.
     * @param \DOMElement $oNode    node to add the attributes to
     * @return \DOMElement
     */
    public function addToDOMNode(\DOMElement $oNode) : \DOMElement
    {
        foreach ($this as $strName => $strValue) {
            $oNode->setAttribute($strName, (string) $strValue);
        }
        return $oNode;
    }
}