<?php

declare(strict_types=1);

namespace SKien\SVGCreator\Filter\Effects;

/**
 * This effect lights an image using the alpha channel as a bump map.
 *
 * The resulting image is an RGBA image based on the light color. The
 * lighting calculation follows the standard specular component of the
 * Phong lighting model {@link https://en.wikipedia.org/wiki/Phong_reflection_model}.
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/SVG/Element/feSpecularLighting
 *
 * @author Stefanius <s.kientzler@online.de>
 * @copyright GPLv3 License - see the LICENSE file for details
 */
class SVGSpecularLightingEffect extends SVGLightingEffect
{
    /**
     * This effect lights an image using the alpha channel as a bump map.
     * @see SVGSpecularLightingEffect
     * @param string $strIn
     * @param string $strLightingColor
     * @param float $surfaceScale
     * @param float $specularConstant
     * @param float $specularExponent
     * @param float $kernelUnitLength
     * @link https://developer.mozilla.org/en-US/docs/Web/SVG/Element/feSpecularLighting
     */
    public function __construct(
        string $strIn,
        string $strLightingColor,
        float  $surfaceScale,
        float  $specularConstant = null,
        float  $specularExponent = null,
        float  $kernelUnitLength = null
        )
    {
        parent::__construct('feSpecularLighting');

        $this->setAttribute('in', $strIn);
        $this->setAttribute('lighting-color', $strLightingColor);
        $this->setAttribute('surfaceScale', $surfaceScale);
        $this->setAttribute('specularConstant', $specularConstant);
        $this->setAttribute('specularExponent', $specularExponent);
        $this->setAttribute('kernelUnitLength', $kernelUnitLength);
    }
}