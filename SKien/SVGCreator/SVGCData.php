<?php

declare(strict_types=1);

namespace SKien\SVGCreator;

/**
 * Class to create CData elements inside of the SVG image.
 *
 * This class can be used to add style definitions or script
 * elements to the SVG image.
 *
 * @author Stefanius <s.kientzler@online.de>
 * @copyright GPLv3 License - see the LICENSE file for details
 */
class SVGCData extends SVGElement
{
    protected string $strData = '';

    /**
     * Creates a CData element containing the given data.
     * @param string $strName   name of the element
     * @param string $strData   data to set
     */
    public function __construct(string $strName, string $strData = '')
    {
        parent::__construct($strName);
        $this->strData = $strData;
    }

    /**
     * Sets/changes the elements data.
     * @param string $strData
     */
    public function setData(string $strData) : void
    {
        $this->strData = $strData;
    }

    /**
     * Returns the current data.
     * @return string
     */
    public function getData() : string
    {
        return $this->strData;
    }

    /**
     * @param \DOMDocument $oDOMDoc
     * @return \DOMNode|false
     */
    protected function createDOMNode(\DOMDocument $oDOMDoc) : \DOMNode|false
    {
        if (empty($this->strData)) {
            return false;
        }
        $oCData = $oDOMDoc->createElement($this->strName);
        if ($oCData !== false) {
            $this->oAttrib->addToDOMNode($oCData);
            $oCData->appendChild($oDOMDoc->createCDATASection($this->strData));
        }
        return $oCData;
    }
}