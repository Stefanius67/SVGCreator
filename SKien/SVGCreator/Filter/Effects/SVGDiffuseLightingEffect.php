<?php

declare(strict_types=1);

namespace SKien\SVGCreator\Filter\Effects;

/**
 * This effect lights an image using the alpha channel as a bump map.
 *
 * The resulting image, which is an RGBA opaque image, depends on the light color,
 * light position and surface geometry of the input bump map.
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/SVG/Element/feDiffuseLighting
 *
 * @author Stefanius <s.kientzler@online.de>
 * @copyright GPLv3 License - see the LICENSE file for details
 */
class SVGDiffuseLightingEffect extends SVGLightingEffect
{
    /**
     * This effect lights an image using the alpha channel as a bump map.
     * @see SVGDiffuseLightingEffect
     * @param string $strIn
     * @param string $strLightingColor
     * @param float $surfaceScale
     * @param float $diffuseConstant
     * @param float $kernelUnitLength
     * @link https://developer.mozilla.org/en-US/docs/Web/SVG/Element/feDiffuseLighting
     */
    public function __construct(
        string $strIn,
        string $strLightingColor,
        float  $surfaceScale,
        float  $diffuseConstant = null,
        float  $kernelUnitLength = null
        )
    {
        parent::__construct('feDiffuseLighting');

        $this->setAttribute('in', $strIn);
        $this->setAttribute('lighting-color', $strLightingColor);
        $this->setAttribute('surfaceScale', $surfaceScale);
        $this->setAttribute('diffuseConstant', $diffuseConstant);
        $this->setAttribute('kernelUnitLength', $kernelUnitLength);
    }
}