<?php

declare(strict_types=1);

namespace SKien\SVGCreator\Filter\Effects;

use SKien\SVGCreator\SVGElement;

/**
 * Baseclass for any filter effects.
 *
 * @author Stefanius <s.kientzler@online.de>
 * @copyright GPLv3 License - see the LICENSE file for details
 */
class SVGEffect extends SVGElement
{
    public const IN_SOURCE_GRAPHIC  = 'SourceGraphic';
    public const IN_SOURCE_ALPHA    = 'SourceAlpha';
    public const IN_BCKGND_GRAPHIC  = 'BackgroundImage';
    public const IN_BCKGND_ALPHA    = 'BackgroundAlpha';
    public const IN_FILL_PAINT      = 'FillPaint';
    public const IN_STROKE_PAINT    = 'StrokePaint';

    public const BLEND_NORMAL       = 'normal';
    public const BLEND_MULTIPLY     = 'multiply';
    public const BLEND_SCREEN       = 'screen';
    public const BLEND_OVERLAY      = 'overlay';
    public const BLEND_DARKEN       = 'darken';
    public const BLEND_LIGHTEN      = 'lighten';
    public const BLEND_COLOR_DODGE  = 'color-dodge';
    public const BLEND_COLOR_BURN   = 'color-burn';
    public const BLEND_HARD_LIGHT   = 'hard-light';
    public const BLEND_SOFT_LIGHT   = 'soft-light';
    public const BLEND_DIFFERENCE   = 'difference';
    public const BLEND_EXCLUSION    = 'exclusion';
    public const BLEND_HUE          = 'hue';
    public const BLEND_SATURATION   = 'saturation';
    public const BLEND_COLOR        = 'color';
    public const BLEND_LUMINOSITY   = 'luminosity';

    public const EDGE_MODE_DUPLICATE    = 'duplicate';
    public const EDGE_MODE_WRAP         = 'wrap';

    /**
     * Creates a filter effect.
     * @param string $strName
     */
    public function __construct(string $strName)
    {
        parent::__construct($strName);
    }

    /**
     * Sets the input image to use.
     * @param string $strInput
     */
    public function setInput(string $strInput) : void
    {
        $this->setAttribute('in', $strInput);
    }

    /**
     * Sets the name of the effect result.
     * The name of a effect is needed, if a filter contains the combination
     * of multiple effects and one effect needs the computed result of an
     * preceeding filter.
     * @param string $strResult
     */
    public function setResult(string $strResult) : void
    {
        $this->setAttribute('result', $strResult);
    }
}