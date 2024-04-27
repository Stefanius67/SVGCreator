<?php

declare(strict_types=1);

namespace SKien\SVGCreator;

/**
 *
 * @author Stefanius <s.kientzler@online.de>
 * @copyright MIT License - see the LICENSE file for details
 */
class SVGCData extends SVGElement
{
    protected string $strData = '';

    /**
     */
    public function __construct(string $strName, string $strData = '')
    {
        parent::__construct($strName);
        $this->strData = $strData;
    }

    public function setData(string $strData) : void
    {
        $this->strData = $strData;
    }

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
        if ($oDOMDoc !== false) {
            $oCData->appendChild($oDOMDoc->createCDATASection($this->strData));
        }
        return $oCData;
    }
}