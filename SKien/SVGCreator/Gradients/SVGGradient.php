<?php

declare(strict_types=1);

namespace SKien\SVGCreator\Gradients;

use SKien\SVGCreator\SVGElement;


/**
 * Baseclass for linear and radial gradients.
 *
 * @author Stefanius <s.kientzler@online.de>
 * @copyright MIT License - see the LICENSE file for details
 */
class SVGGradient extends SVGElement
{
    /** Valid values for the `setGradientUnits()` method     */
    public const UNITS_USER_SPACE_ON_USE    = 'userSpaceOnUse';
    public const UNITS_OBJECT_BOUNDING_BOX  = 'objectBoundingBox';
    /** Valid values for the `setSpreadMethod()` method     */
    public const SPREAD_METHOD_PAD      = 'pad';
    public const SPREAD_METHOD_REFLECT  = 'reflect';
    public const SPREAD_METHOD_REPEAT   = 'repeat';

    /**
     * Adds a color and its position and opacity
     * @param SVGGradientStop|float|string $stopOrOffset
     * @param string $strColor
     * @param float|string $opacity
     * @return SVGGradientStop
     */
    public function addStop(SVGGradientStop|float|string $stopOrOffset, string $strColor = null, float|string $opacity = null) : SVGGradientStop
    {
        $oStop = $stopOrOffset;
        if (!is_object($stopOrOffset)) {
            $oStop = new SVGGradientStop($stopOrOffset, $strColor, $opacity);
        }
        $this->add($oStop);
        return $oStop;
    }

    /**
     * Defines the coordinate system for the gradient.
     * @param string $strUnits   `userSpaceOnUse` | `objectBoundingBox` (default)
     */
    public function setGradientUnits(string $strUnits) : void
    {
        $this->setAttribute('gradientUnits', $strUnits);
    }

    /**
     * Provides additional transformation to the gradient coordinate system.
     * @param string $strTransform
     * @link https://developer.mozilla.org/en-US/docs/Web/SVG/Content_type#transform-list
     */
    public function setGradientTransform(string $strTransform) : void
    {
        $this->setAttribute('gradientTransform', $strTransform);
    }

    /**
     * Sets how the gradient behaves if it starts or ends inside the bounds of the shape
     * containing the gradient.
     * @param string $strMethod     `pad` (default) | `reflect` | `repeat`
     */
    public function setSpreadMethod(string $strMethod) : void
    {
        $this->setAttribute('spreadMethod', $strMethod);
    }
}