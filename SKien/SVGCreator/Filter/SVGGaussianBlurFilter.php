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
class SVGGaussianBlurFilter extends SVGFilterEffect
{
    /**
     * @param string $strIn
     * @param float|string $deviation
     * @param string $strEdgeMode
     * @link https://developer.mozilla.org/en-US/docs/Web/SVG/Element/feGaussianBlur
     */
    public function __construct(string $strIn, float|string $deviation, string $strEdgeMode = null)
    {
        parent::__construct('feGaussianBlur');

        $this->setAttribute('in', $strIn);
        $this->setAttribute('stdDeviation', $deviation);
        $this->setAttribute('edgeMode', $strEdgeMode);
    }
}