<?php

declare(strict_types=1);

namespace SKien\SVGCreator;

use SKien\SVGCreator\Helper\Attrib;
use SKien\SVGCreator\Helper\Style;

/**
 * Base class for all SVG elements.
 *
 * Just as an SVG graphic is built in an XML structure, this package is based on
 * elements that are hierarchically linked to one another in a parent-child
 * relationship. This class represents the basis for all elements appearing in
 * the graphic.
 *
 * The maintenance of the SVG core attributes and transformations is
 * moved to the `SVGAttributesTrait` helper trait.
 *
 * @see \SKien\SVGCreator\SVGAttributesTrait
 *
 * @author Stefanius <s.kientzler@online.de>
 * @copyright GPLv3 License - see the LICENSE file for details
 */
class SVGElement
{
    use SVGAttributesTrait;

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

    /**
     * Initialization of the core element properties.
     * The `$strStyleOrClass` parameter can be used to assign either a class or a
     * style to the element at creation (in most cases only one of both is needed).
     * If some styles are needed in addition to a given class (or vice versa), simply
     * use the `setStyle(), addStyle()` or `setClass()` methods in addition.
     * @param string $strName           Name of the element (Tagname of the XML-Node)
     * @param string $strValue          Value of the element (Content of the XML-Node)
     * @param string $strStyleOrClass   Style(s) or classname
     */
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
     * Returns the current element name.
     * @return string
     */
    public function getName() : string
    {
        return $this->strName;
    }

    /**
     * Returns the current element value.
     * @return string
     */
    public function getValue() : string
    {
        return $this->strValue;
    }

    /**
     * Sets the element value.
     * @param string $strValue
     */
    public function setValue(string $strValue) : void
    {
        $this->strValue = $strValue;;
    }

    /**
     * Sets the root element of the image.
     * The root element represents the `[svg]` root node of the SVG defiition.
     * @param SVG $oRoot    the root of the SVG image
     */
    public function setRoot(SVG $oRoot) : void
    {
        $this->oRoot = $oRoot;
        foreach ($this->aChilds as $oChild) {
            $oChild->setRoot($oRoot);
        }
    }

    /**
     * Sets either the class or style of the element.
     * If the parameter contains at least one ":", it is seen as a style definition,
     * otherwise the value is treated as a class name.
     * @param string $strStyleOrClass   style definition or classname
     */
    public function setStyleOrClass(string $strStyleOrClass) : void
    {
        if (strpos($strStyleOrClass, ':') !== false) {
            $this->oStyle->parse($strStyleOrClass);
        } else {
            $this->setClass($strStyleOrClass);
        }
    }

    /**
     * Sets a style definition.
     * The definition can contain one or more style properties (separated by a semicolon ';')
     * in CSS notation:
     * <pre>
     * propertyName1: propertyValue1; propertyName2: propertyValue2;
     * </pre>
     * If a specified property already exists in the elements styles, the existing value is
     * overwritten. Other properties not included in this definition will not be touched!
     * @param string $strStyle  style definition
     */
    public function setStyle(string $strStyle) : void
    {
        $this->oStyle->parse($strStyle);
    }

    /**
     * Adds the specified style property.
     * Numeric values will be converted to strings.
     * @param string $strName       name of the property to set
     * @param float|string $value   value of the property to set
     */
    public function addStyle(string $strName, float|string $value) : void
    {
        $this->oStyle[$strName] = $value;
    }

    /**
     * Gets the requested style.
     * Gets the requested style. If a specific property is requested by name, the value
     * of this property is returned, otherwise, the whole style definition is returned.
     * @param string $strName   name of the property to get or `null` for whole style definition
     * @return string           value of the property or the whole style definition
     */
    public function getStyle(string $strName = null) : string
    {
        if ($strName === null) {
            return $this->oStyle->__toString();
        } else {
            return $this->oStyle[$strName] ?? '';
        }
    }

    /**
     * Adds any child element to this element.
     * If an own valid root is set, it is passed to the new child element.
     * @param SVGElement $oElement  element to add
     * @return SVGElement           added element
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
     * Inserts a child element by using (duplicating) the referenced element.
     * The referenced element can be either a symbol that is defined within the document
     * or any other shape that can be referenced by its id.
     * Any property of the referenced element can be changed.
     * @param string|SVGElement $id
     * @param float|int $x
     * @param float|int $y
     * @param string $strStyleOrClass
     * @return SVGElement
     */
    public function use(string|SVGElement $id, float|int $x, float|int $y, string $strStyleOrClass = null) : SVGElement
    {
        if (!is_string($id)) {
            $id = $id->getID();
        }
        $oUse = new SVGElement('use', '', $strStyleOrClass);
        $oUse->setAttribute('href', "#$id");
        $oUse->setPos($x, $y);

        return $this->add($oUse);
    }

    /**
     * Adds a comment to the image.
     * When building the DOM, comments are only added, if the `bPrettyOutput` for
     * the image is set to true.
     * @param string $strComment    comment to add
     */
    public function addComment(string $strComment) : void
    {
        $this->add(new SVGComment($strComment));
    }

    /**
     * Adds an optional title to the element.
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
     * Creates a DOM element and append it to the requested parent node.
     * @param \DOMNode $oParent the parent node to append the created node
     * @return \DOMNode|false   the created node
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
     * Creates a DOM node/element that represents this element.
     * @param \DOMDocument $oDOMDoc The parant document.
     * @return \DOMNode|false       The created node/element.
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
     * Gets the first child element having the requested name.
     * @param string $strName
     * @return SVGElement|false
     */
    public function getChildByName(string $strName) : SVGElement|false
    {
        foreach ($this->aChilds as $oChild) {
            if ($oChild->getName() == $strName) {
                return $oChild;
            }
        }
        return false;
    }

    /**
     * Conversion from a given point in polar coordinates into the cartesian coordinate system.
     * @param float $r
     * @param float $degrees
     * @return array<float>
     */
    public function fromPolar(float $r, float $degrees) : array
    {
        $rad = deg2rad($degrees);
        return [
            round($r * cos($rad), 3),
            round($r * sin($rad), 3)
        ];
    }
}