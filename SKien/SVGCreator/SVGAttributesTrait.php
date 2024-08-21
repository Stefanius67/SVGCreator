<?php

declare(strict_types=1);

namespace SKien\SVGCreator;

use SKien\SVGCreator\Filter\SVGFilter;
use SKien\SVGCreator\Gradients\SVGGradient;
use SKien\SVGCreator\Helper\Attrib;

/**
 * Trait for the maintenance of the SVG core attributes and transformations.
 *
 * > **consideration** <br>
 * > It might make sense to split this trait out into
 * > - core attributes
 * > - presentation attributes
 * > - transformations
 * >
 * > To be able to use only the needed attributes in the extending classes
 *
 * @author Stefanius <s.kientzler@online.de>
 * @copyright GPLv3 License - see the LICENSE file for details
 */
trait SVGAttributesTrait
{
    /** @var Attrib   list of all attributes     */
    protected ?Attrib $oAttrib = null;

    /**
     * Sets any attribute.
     * In case of a '**null**' `$value`, the `$bUnset` controls the behaviour: <br>
     * `$bUnset == true`:   if the attribute already existst, it is removed <br>
     * `$bUnset == false`:  the attribute will not be set nor created
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
     * Checks, if the requested attribute exists.
     * @param string $strName
     */
    public function hasAttribute(string $strName) : bool
    {
        return isset($this->oAttrib[$strName]);
    }

    /**
     * Gets any attribute.
     * For not existing attributes, this method returns an empty string.
     * Use `self::hasAttribute()` to check, if an attribute has been set so far or not.
     * @param string $strName
     */
    public function getAttribute(string $strName) : string
    {
        return $this->oAttrib[$strName] ?? '';
    }

    /**
     * Returns the 'id' attribute.
     * @return string
     */
    public function getID() : string
    {
        return $this->getAttribute('id');
    }

    /**
     * Sets the 'id' attribute.
     * @param string $strID
     */
    public function setID(string $strID) : void
    {
        $this->setAttribute('id', $strID);
    }

    /**
     * Sets the size of the element.
     * @param float|string $x
     * @param float|string $y
     */
    public function setPos(float|string $x, float|string $y) : void
    {
        $this->setAttribute('x', $x);
        $this->setAttribute('y', $y);
    }

    /**
     * Sets the size of the element.
     * @param float|string $width
     * @param float|string $height
     */
    public function setSize(float|string $width, float|string $height) : void
    {
        $this->setAttribute('width', $width);
        $this->setAttribute('height', $height);
    }

    /**
     * Sets the viewbox for the image.
     * The viewBox defines the position and dimension, in user space.
     * `xMin` and `yMin` represent the top left coordinates of the viewport. `width`
     * and `height` represent its dimensions.
     * @param float $xMin
     * @param float $yMin
     * @param float $width
     * @param float $height
     * @link https://developer.mozilla.org/en-US/docs/Web/SVG/Attribute/viewBox
     */
    public function setViewbox(float $xMin, float $yMin, float $width, float $height) : void
    {
        $this->setAttribute('viewBox', implode(' ', [$xMin, $yMin, $width, $height]));
    }

    /**
     * Sets the 'fill' attribute.
     * @param string $strFillColor  Can be any valid CSS color def. ('#RGB' | '#RRGGBB' | '#RRGGBBAA', 'colorname')
     */
    public function setFillColor(?string $strFillColor) : void
    {
        $this->setAttribute('fill', $strFillColor);
    }

    /**
     * Sets the 'fill' attribute.
     * @param string $strStrokeColor  Can be any valid CSS color def. ('#RGB' | '#RRGGBB' | '#RRGGBBAA', 'colorname')
     */
    public function setStrokeColor(?string $strStrokeColor) : void
    {
        $this->setAttribute('stroke', $strStrokeColor);
    }

    /**
     * Sets the 'stroke-width' attribute.
     * @param float $fltStrokeWidth
     */
    public function setStrokeWidth(?float $fltStrokeWidth) : void
    {
        $this->setAttribute('stroke-width', $fltStrokeWidth);
    }

    /**
     * Sets the 'stroke-dasharray' attribute to define the stroke pattern.
     * The stroke array consists of any number of values. The dash and gap are drawn
     * alternately, each using the next value from the array. After the last value
     * it starts again from the beginning. <br>
     * If only one value is specified, line and gap have the same length.
     * @param string|array<float|string> $dashArray
     * @link https://developer.mozilla.org/en-US/docs/Web/SVG/Attribute/stroke-dasharray
     */
    public function setDashArray(string|array $dashArray) : void
    {
        if (is_array($dashArray)) {
            $this->setAttribute('stroke-dasharray', implode(' ', $dashArray));
        } else {
            $this->setAttribute('stroke-dasharray', $dashArray);
        }
    }

    /**
     * Sets the 'class' attribute.
     * The class have to be defined inside of a style definition using the
     * `SVG::addStyleDef()` method.
     * @see SVG::addStyleDef()
     * @param string $strClass
     */
    public function setClass(string $strClass) : void
    {
        $this->setAttribute('class', $strClass);
    }

    /**
     * Sets the way, how the element is scaled.
     * By default the aspect-ratio of the source is kept and is fit and centered
     * inside the given rect. <br>
     * The position inside the given rect can be set:
     * - 'xMinYMin': top-left
     * - 'xMinYMid': center-left
     * - 'xMinYMax': bottom-left
     * - 'xMidYMin': top-center
     * - 'xMidYMid': center-center
     * - 'xMidYMax': bottom-center
     * - 'xMaxYMin': top-right
     * - 'xMaxYMid': center-right
     * - 'xMaxYMax': bottom-right
     * or the width and height of the source is stretched to the given rect, if
     * the `preserveAspectRatio`value is set to 'none'
     *
     * @param string|float $preserve
     */
    public function setPreserveAspectRatio(string|float $preserve) : void
    {
        $this->setAttribute('preserveAspectRatio', $preserve);
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
     * Moves the object by x and y.
     * If `y` is not provided, it is set to be equal to `x`.
     * @param float $x
     * @param float $y
     * @link https://developer.mozilla.org/en-US/docs/Web/SVG/Attribute/transform#translate
     */
    public function translate(float $x, float $y = null) : void
    {
        $y = $y ?? $x;
        if ($x != 0 || $y != 0) {
            $this->addTransformation("translate($x, $y)");
        }
    }

    /**
     * Scales the object by x and y.
     * If `y` is not provided, it is set to be equal to `x`.
     * Be aware that scaling will additionally move the element if the top left
     * corner (in the element context - SVG or group) is different from 0, 0.
     * <pre>
     * rect(100, 100, 200, 50);
     * scale(2, 0);
     * // results in
     * rect(200, 200, 400, 100);
     * </pre>
     * @see setTransformOrigin()
     * @param float $x
     * @param float $y
     * @param float|string $xOrg    x-position of the transformation origin
     * @param float|string $yOrg    y-position of the transformation origin
     * @link https://developer.mozilla.org/en-US/docs/Web/SVG/Attribute/transform#scale
     */
    public function scale(float $x, float $y = null, float|string $xOrg = null, float|string $yOrg = null) : void
    {
        $y = $y ?? $x;
        if ($x != 1 || $y != 1) {
            $this->addTransformation("scale($x, $y)");
        }
        $this->setTransformOrigin($xOrg, $yOrg);
    }

    /**
     * Flips the element horizontal.
     * Note that the element is also moved by the horizontal flipping. Therefore it
     * is recommended  to set the X-origin of the transformation to the center of the
     * element to be mirrored.
     * @see setTransformOrigin()
     * @param float|string $xOrg    x-position of the transformation origin
     * @param float|string $yOrg    y-position of the transformation origin
     * @link https://developer.mozilla.org/en-US/docs/Web/SVG/Attribute/transform#scale
     */
    public function flipHorz(float|string $xOrg = null, float|string $yOrg = null) : void
    {
        $this->addTransformation("scale(-1, 1)");
        $this->setTransformOrigin($xOrg, $yOrg);
    }

    /**
     * Flips the element vertical.
     * Note that the element is also moved by the horizontal flipping. Therefore it
     * is recommended  to set the Y-origin of the transformation to the center of the
     * element to be mirrored.
     * @see SVGAttributesTrait::setTransformOrigin()
     * @param float|string $xOrg    x-position of the transformation origin
     * @param float|string $yOrg    y-position of the transformation origin
     * @link https://developer.mozilla.org/en-US/docs/Web/SVG/Attribute/transform#scale
     */
    public function flipVert(float|string $xOrg = null, float|string $yOrg = null) : void
    {
        $this->addTransformation("scale(1, -1)");
        $this->setTransformOrigin($xOrg, $yOrg);
    }

    /**
     * Rotates the element by degrees.
     * The origin around which the element is rotated by default is the top left
     * corner (x=0, y=0).
     * By specifying xOrg and yOrg, the element can be rotated around any other point.
     * @see SVGAttributesTrait::setTransformOrigin()
     * @param float $degree
     * @param float|string $xOrg    x-position of the transformation origin
     * @param float|string $yOrg    y-position of the transformation origin
     */
    public function rotate(float $degree, float|string $xOrg = null, float|string $yOrg = null) : void
    {
        $this->addTransformation("rotate($degree)");
        $this->setTransformOrigin($xOrg, $yOrg);
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
     * Specifies a transformation in the form of a transformation matrix of six values.
     * The matrix(a,b,c,d,e,f) is equivalent to applying the transformation matrix:
     * <pre>
     *     [a, c, e]
     *     [b, d, f]
     *     [0, 0, 1]
     * </pre>
     * @param array<float|string>|string $matrix
     * @param float|string $xOrg
     * @param float|string $yOrg
     * @link https://developer.mozilla.org/en-US/docs/Web/SVG/Attribute/transform#matrix
     */
    public function matrix(array|string $matrix, float|string $xOrg = null, float|string $yOrg = null) : void
    {
        $strMatrix = is_array($matrix) ? implode(' ', $matrix) : $matrix;
        $this->addTransformation("matrix($strMatrix)");
        $this->setTransformOrigin($xOrg, $yOrg);
    }

    /**
     * Sets the origin for an item's transformations.
     * By default, the origin from which the element is transformed is the upper
     * left corner of the context to which the element belongs (SVG, group). <br>
     * > Exception ist the root &lt;svg&gt; element and &lt;svg&gt; elements that are a direct
     *   child of a `foreignObject` whose transform-origin is 50% 50%. <br>
     * By specifying xOrg and yOrg, the element can be transformed relative to any
     * other point. <br>
     * @param float|string $xOrg    x-position of the transformation origin
     * @param float|string $yOrg    y-position of the transformation origin
     * @link https://developer.mozilla.org/en-US/docs/Web/SVG/Attribute/transform-origin
     */
    public function setTransformOrigin(float|string $xOrg = null, float|string $yOrg = null) : void
    {
        if ($xOrg !== null) {
            $this->oAttrib['transform-origin'] = (string) $xOrg;
            if ($yOrg !== null) {
                $this->oAttrib['transform-origin'] .= ' ' . (string) $yOrg;
            }
        }
    }

    /**
     * Sets a filter.
     * The Filter ahve to be set to the SVG using the `SVG::addFilter` method.
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
     * Sets a gradient.
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
     * Sets a clipppath to the element.
     * To define a clippath, just create a `SVGElement('clipPath')` and add
     * the elements/shapes that defines the path.
     * @param string|SVGElement $id
     * @link https://developer.mozilla.org/en-US/docs/Web/SVG/Element/clipPath
     */
    public function setClipPath(string|SVGElement $id) : void
    {
        if (!is_string($id)) {
            $id = $id->getID();
        }
        $this->setAttribute('clip-path', "url(#$id)");
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