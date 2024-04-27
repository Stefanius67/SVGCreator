<?php

declare(strict_types=1);

namespace SKien\SVGCreator;

/**
 *
 * Supported transformations:
 * - translate()
 * - scale()
 * - rotate()
 * - skewX()
 * - skewY()
 * - TODO: matrix()
 *
 * @author Stefanius <s.kientzler@online.de>
 * @copyright MIT License - see the LICENSE file for details
 */
class SVGElement
{
    use AttributesTrait;

    /** @var SVG    the SVG image, this element belongs to     */
    protected ?SVG $oRoot = null;
    /** @var string tagname of the element     */
    protected string $strName = '';
    /** @var string value of the element     */
    protected string $strValue = '';
    /** @var Style  styles for this element     */
    protected Style $oStyle;
    /** @var array<SVGElement>  child elements     */
    protected array $aChilds = [];

    public function __construct(string $strName, string $strValue = '', string $strStyleOrClass = null)
    {
        $this->oAttrib = new Attrib();
        $this->oStyle = new Style();

        $this->strName = $strName;
        $this->strValue = $strValue;
        if ($strStyleOrClass !== null) {
            $this->setStyleOrClass($strStyleOrClass);
        }
    }

    /**
     * @return string
     */
    public function getName() : string
    {
        return $this->strName;
    }

    /**
     * @return string
     */
    public function getValue() : string
    {
        return $this->strValue;
    }

    /**
     * @param string $strValue
     */
    public function setValue(string $strValue) : void
    {
        $this->strValue = $strValue;;
    }

    public function setRoot(SVG $oRoot) : void
    {
        $this->oRoot = $oRoot;
        foreach ($this->aChilds as $oChild) {
            $oChild->setRoot($oRoot);
        }
    }

    public function setStyleOrClass(string $strStyleOrClass) : void
    {
        if (strpos($strStyleOrClass, ':') !== false) {
            $this->oStyle->parse($strStyleOrClass);
        } else {
            $this->setClass($strStyleOrClass);
        }
    }

    public function setStyle(string $strStyle) : void
    {
        $this->oStyle->parse($strStyle);
    }

    public function addStyle(string $strName, float|string $value) : void
    {
        $this->oStyle[$strName] = $value;
    }

    /**
     * @param SVGElement $oElement
     * @return SVGElement
     */
    public function add(SVGElement $oElement) : SVGElement
    {
        $this->aChilds[] = $oElement;
        if ($this->oRoot) {
            $oElement->setRoot($this->oRoot);
        }
        return $oElement;
    }

    /**
     * Adds a comment to the image.
     * When building the DOM, comments are only added, if the `bPrettyOutput` for
     * the image is set to true.
     * @param string $strComment
     */
    public function addComment(string $strComment) : void
    {
        $this->add(new SVGComment($strComment));
    }

    /**
     * Adds an optional title for the element.
     * The title will not be rendered as part of the image
     * @param string $strTitle
     * @link https://developer.mozilla.org/en-US/docs/Web/SVG/Element/title
     */
    public function setTitle(string $strTitle) : void
    {
        // overwrite, if title already exists
        if (($oTitle = $this->getChildByName('title')) !== false) {
            $oTitle->setValue($strTitle);
        } else {
            $this->add(new SVGElement('title', $strTitle));
        }
    }

    /**
     * Create DOM element and append it to the requested parent node.
     * @param \DOMNode $oParent
     * @return \DOMNode|false
     */
    public function appendToDOM(\DOMNode $oParent) : \DOMNode|false
    {
        $oDOMDoc = get_class($oParent) === 'DOMDocument' ? $oParent : $oParent->ownerDocument; //  ?? $oParent;
        $oDOMNode = $this->createDOMNode($oDOMDoc);
        if ($oDOMNode !== false) {
            $oParent->appendChild($oDOMNode);
            foreach ($this->aChilds as $oChild) {
                // recursively build the DOM
                $oChild->appendToDOM($oDOMNode);
            }
        }
        return $oDOMNode;
    }

    /**
     * @param \DOMDocument $oDOMDoc
     * @return \DOMNode|false
     */
    protected function createDOMNode(\DOMDocument $oDOMDoc) : \DOMNode|false
    {
        $oNode = $oDOMDoc->createElement($this->strName, $this->strValue);
        if ($oNode !== false) {
            $this->oAttrib->addToDOMNode($oNode);
            $this->oStyle->addToDOMNode($oNode);
        }
        return $oNode;
    }

    /**
     * Gets first child element having requested name.
     * @param string $strName
     * @return SVGElement|false
     */
    protected function getChildByName(string $strName) : SVGElement|false
    {
        foreach ($this->aChilds as $oChild) {
            if ($oChild->getName() == $strName) {
                return $oChild;
            }
        }
        return false;
    }
}