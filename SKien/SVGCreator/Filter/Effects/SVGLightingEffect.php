<?php

declare(strict_types=1);

namespace SKien\SVGCreator\Filter\Effects;

use SKien\SVGCreator\SVGElement;

/**
 * Base class for ligting effects.
 *
 * @author Stefanius <s.kientzler@online.de>
 * @copyright MIT License - see the LICENSE file for details
 */
abstract class SVGLightingEffect extends SVGEffect
{
    /**
     * Defines a distant light source.
     * @param float $azimuth
     * @param float $elevation
     * @link https://developer.mozilla.org/en-US/docs/Web/SVG/Element/feDistantLight
     */
    public function setDistantLight(float $azimuth, float $elevation) : void
    {
        $oLight = new SVGElement('feDistantLight');
        $oLight->setAttribute('azimuth', $azimuth);
        $oLight->setAttribute('elevation', $elevation);
        $this->add($oLight);
    }

    /**
     * Defines a light source which allows to create a point light effect.
     * @param float $x
     * @param float $y
     * @param float $z
     * @link https://developer.mozilla.org/en-US/docs/Web/SVG/Element/fePointLight
     */
    public function setPointLight(float $x, float $y, float $z) : void
    {
        $oLight = new SVGElement('fePointLight');
        $oLight->setAttribute('x', $x);
        $oLight->setAttribute('y', $y);
        $oLight->setAttribute('z', $z);
        $this->add($oLight);
    }

    /**
     * Defines a light source that can be used to create a spotlight effect.
     * @param float $x
     * @param float $y
     * @param float $z
     * @param float $pointsAtX
     * @param float $pointsAtY
     * @param float $pointsAtZ
     * @param float $specularExponent
     * @param float $limitingConeAngle
     * @link https://developer.mozilla.org/en-US/docs/Web/SVG/Element/feSpotLight
     */
    public function setSpotLight(
        float $x,
        float $y,
        float $z,
        float $pointsAtX = null,
        float $pointsAtY = null,
        float $pointsAtZ = null,
        float $specularExponent = null,
        float $limitingConeAngle = null
        ) : void
    {
        $oLight = new SVGElement('feSpotLight');
        $oLight->setAttribute('x', $x);
        $oLight->setAttribute('y', $y);
        $oLight->setAttribute('z', $z);
        $oLight->setAttribute('pointsAtX', $pointsAtX);
        $oLight->setAttribute('pointsAtY', $pointsAtY);
        $oLight->setAttribute('pointsAtZ', $pointsAtZ);
        $oLight->setAttribute('specularExponent', $specularExponent);
        $oLight->setAttribute('limitingConeAngle', $limitingConeAngle);
        $this->add($oLight);
    }
}