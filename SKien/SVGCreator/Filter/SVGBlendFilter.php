<?php

declare(strict_types=1);

namespace SKien\SVGCreator\Filter;

/**
 * This filter primitive composes two objects together ruled by a certain blending mode.
 *
 *
 * @author Stefanius <s.kientzler@online.de>
 * @copyright MIT License - see the LICENSE file for details
 */
class SVGBlendFilter extends SVGFilterEffect
{
    /**
     * This filter composes two objects together ruled by a certain blending mode.
     * @param string $strIn
     * @param string $strIn2
     * @param string $strMode
     * @link https://developer.mozilla.org/en-US/docs/Web/SVG/Element/feBlend
     * @link https://developer.mozilla.org/en-US/docs/Web/CSS/blend-mode
     */
    public function __construct(string $strIn, string $strIn2, string $strMode = SVGFilter::BLEND_NORMAL)
    {
        parent::__construct('feBlend');

        $this->setAttribute('in', $strIn);
        $this->setAttribute('in2', $strIn2);
        $this->setAttribute('mode', $strMode);
    }
}