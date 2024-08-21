<?php

declare(strict_types=1);

namespace SKien\SVGCreator\Filter\Effects;

/**
 * This effect creates an image using the Perlin turbulence function.
 * It allows the synthesis of artificial textures like clouds or marble.
 * The resulting image will fill the entire filter subregion.
 *
 * > **Important** <br>
 * > Since the filter subpane size is set by default to 120% of the input image,
 * > it is recommended to either explicitly set the size of the filter to 100%
 * > or use this effect in combination with another filter (merge, blend, ...).
 *
 * @link https://en.wikipedia.org/wiki/Perlin_noise
 * @link https://developer.mozilla.org/en-US/docs/Web/SVG/Element/feTurbulence
 *
 * @author Stefanius <s.kientzler@online.de>
 * @copyright GPLv3 License - see the LICENSE file for details
 */
class SVGTurbulenceEffect extends SVGEffect
{
    /**
     * This effect fills the filter subregion with the given color and opacity.
     * @see SVGTurbulenceEffect
     * @param float $baseFrequency
     * @param int   $numOctaves
     * @param float $seed           (default: 0)
     * @param string $strType       'turbulence' / 'fractalNoise' (default: 'turbulence')
     * @param bool $bStitchTiles    (default: 'noStitch')
     * @link https://developer.mozilla.org/en-US/docs/Web/SVG/Element/feTurbulence
     */
    public function __construct(
        float|string $baseFrequency,
        int $numOctaves,
        float $seed = null,
        string $strType = null,
        bool $bStitchTiles = null
        )
    {
        parent::__construct('feTurbulence');

        $this->setAttribute('baseFrequency', $baseFrequency);
        $this->setAttribute('numOctaves', $numOctaves);
        $this->setAttribute('seed', $seed);
        if ($bStitchTiles !== null) {
            $this->setAttribute('stitchTiles', $bStitchTiles ? 'stitch' : 'noStitch');
        }
        $this->setAttribute('type', $strType);
    }
}