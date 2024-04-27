<?php

declare(strict_types=1);

namespace SKien\SVGCreator;


use SKien\SVGCreator\Filter\SVGFilter;
use SKien\SVGCreator\Gradients\SVGGradient;

/**
 * @author Stefanius <s.kientzler@online.de>
 * @copyright MIT License - see the LICENSE file for details
 */
trait AttributesTrait
{
    /** @var Attrib   list of all attributes     */
    protected ?Attrib $oAttrib = null;

    /**
     * Sets any attribute.
     * @param string $strName
     * @param mixed $value
     * @param bool $bUnset
     */
    public function setAttribute(string $strName, $value, bool $bUnset = false) : void
    {
        if ($value !== null) {
            $this->oAttrib[$strName] = (string) $value;
        } else if ($bUnset) {
            unset($this->oAttrib[$strName]);
        }
    }

    /**
     * Gets any attribute.
     * @param string $strName
     */
    public function hasAttribute(string $strName) : bool
    {
        return isset($this->oAttrib[$strName]);;
    }

    /**
     * Gets any attribute.
     * @param string $strName
     */
    public function getAttribute(string $strName) : string
    {
        return $this->oAttrib[$strName] ?? '';
    }

    /**
     * @return string
     */
    public function getID() : string
    {
        return $this->getAttribute('id');
    }

    /**
     * @param string $strID
     */
    public function setID(string $strID) : void
    {
        $this->setAttribute('id', $strID);
    }

    /**
     * @param string $strFillColor
     */
    public function setFillColor(?string $strFillColor) : void
    {
        $this->setAttribute('fill', $strFillColor);
    }

    /**
     * @param string $strStrokeColor
     */
    public function setStrokeColor(?string $strStrokeColor) : void
    {
        $this->setAttribute('stroke', $strStrokeColor);
    }

    /**
     * @param float $fltStrokeWidth
     */
    public function setStrokeWidth(?float $fltStrokeWidth) : void
    {
        $this->setAttribute('stroke-width', $fltStrokeWidth);
    }

    /**
     * @param string|array $dashArray
     */
    public function setDashArray(string|array $dashArray) : void
    {
        if (is_array($dashArray)) {
            $this->setAttribute('stroke-dasharray', implode(',', $dashArray));
        } else {
            $this->setAttribute('stroke-dasharray', $dashArray);
        }
    }

    /**
     * @param string $strClass
     */
    public function setClass(string $strClass) : void
    {
        $this->setAttribute('class', $strClass);
    }

    /**
     * Sets the language(s), this element is intended for.
     * The property has only effact, if the element is a child of a `switch` element!
     * @param string $strLang
     * @link https://developer.mozilla.org/en-US/docs/Web/SVG/Attribute/systemLanguage
     */
    public function setLanguage(string $strLang) : void
    {
        $this->setAttribute('systemLanguage', $strLang);
    }

    /**
     * Moves the object by y and y.
     * If y is not provided, it is set to be equal to x.
     * @param float $x
     * @param float $y
     */
    public function translate(float $x, float $y = null) : void
    {
        $y = $y ?? $x;
        $this->addTransformation("translate($x, $y)");
    }

    /**
     * Scales then object by x and y.
     * If y is not provided, it is set to be equal to x.
     * @param float $x
     * @param float $y
     */
    public function scale(float $x, float $y = null) : void
    {
        $y = $y ?? $x;
        $this->addTransformation("scale($x, $y)");
    }

    /**
     * Rotates the element by degrees.
     * The origin around which the element is rotated by default is the top left
     * corner (x=0, y=0).
     * By specifying xOrg and yOrg, the element can be rotated around any other point.
     * @param float $degree
     * @param float|string $xOrg
     * @param float|string $yOrg
     */
    public function rotate(float $degree, float|string $xOrg = null, float|string $yOrg = null) : void
    {
        $this->addTransformation("rotate($degree)");
        if ($xOrg !== null) {
            $this->oAttrib['transform-origin'] = (string) $xOrg;
            if ($yOrg !== null) {
                $this->oAttrib['transform-origin'] .= ' ' . (string) $yOrg;
            }
        }
    }

    /**
     * Skews the element along the x axis by a degree.
     * @param float $degree
     */
    public function skewX(float $degree) : void
    {
        $this->addTransformation("skewX($degree)");
    }

    /**
     * Skews the element along the y axis by a degree.
     * @param float $degree
     */
    public function skewY(float $degree) : void
    {
        $this->addTransformation("skewY($degree)");
    }

    /**
     * @param string|SVGFilter $id
     */
    public function setFilter(string|SVGFilter $id) : void
    {
        if (!is_string($id)) {
            $id = $id->getID();
        }
        $this->setAttribute('filter', "url(#$id)");
    }

    /**
     * @param string|SVGGradient $id
     */
    public function setGradient(string|SVGGradient $id) : void
    {
        if (!is_string($id)) {
            $id = $id->getID();
        }
        $this->setAttribute('fill', "url(#$id)");
    }

    /**
     * Adds the requested transformation.
     * Multiple transformations can be combined just by concatenate them separated by
     * a blank.
     * @param string $strTransform
     */
    public function addTransformation(string $strTransform) : void
    {
        if (!$this->hasAttribute('transform')) {
            $this->oAttrib['transform'] = $strTransform;
        } else {
            $this->oAttrib['transform'] = implode(' ' , [$this->oAttrib['transform'], $strTransform]);
        }
    }
}