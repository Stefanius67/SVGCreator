<?php

declare(strict_types=1);

namespace SKien\SVGCreator\Filter\Effects;

/**
 * This effect composes two objects together ruled by a certain blending mode.
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/SVG/Element/feBlend
 * @link https://developer.mozilla.org/en-US/docs/Web/CSS/blend-mode
 *
 * @author Stefanius <s.kientzler@online.de>
 * @copyright MIT License - see the LICENSE file for details
 */
class SVGBlendEffect extends SVGEffect
{
    /**
     * This effect composes two objects together ruled by a certain blending mode.
     * @see SVGBlendEffect
     * @param string $strIn
     * @param string $strIn2
     * @param string $strMode   one of the SVGEffect::BLEND_xxx const
     * @link https://developer.mozilla.org/en-US/docs/Web/SVG/Element/feBlend
     */
    public function __construct(string $strIn, string $strIn2, string $strMode = SVGEffect::BLEND_NORMAL)
    {
        parent::__construct('feBlend');

        $this->setAttribute('in', $strIn);
        $this->setAttribute('in2', $strIn2);
        $this->setAttribute('mode', $strMode);
    }
}