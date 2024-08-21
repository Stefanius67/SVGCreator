<?php

declare(strict_types=1);

namespace SKien\SVGCreator\Text;

use SKien\SVGCreator\SVGElement;
use SKien\SVGCreator\SVGGroup;
use SKien\SVGCreator\SVGSymbol;
use SKien\SVGCreator\Shapes\SVGPath;
use XMLReader;
use stdClass;

/**
 * Loads a SVG definition from a font file.
 *
 * Although the font definition as an element of an SVG graphic is marked as deprecated,
 * it is still supported here because this class can be used to convert text or individual
 * letters into path elements that can be inserted into a graphic and designed (transform,
 * filter, gradient, ...) without further reference to the font originally used.
 *
 * In addition, this class allows the exact calculation and positioning of text or a single
 * chars since it contains methods that returns some metrics of the font and/or single
 * characters.
 *
 * SVG fonts uses various font metrics, such as advance values and baseline locations,
 * and the glyph outlines themselves, are expressed in units that are relative to an
 * abstract square whose height is the intended distance between lines of type in the
 * same type size. This square is called the em square and it is the design grid on
 * which the glyph outlines are defined.
 *
 * There are several services on the i-net to convert existing TTF/WOFF/... fonts to SVG fonts:
 * - https://www.fontconverter.io/en/ttf-to-svg
 * - https://convertio.co/ttf-svg
 * - ...
 *
 * > Inspired by https://stackoverflow.com/questions/7742148/how-to-convert-text-to-svg-paths
 * > Thanks to LukLed (https://stackoverflow.com/users/179482/lukled)
 *
 * @SKienImage SVGFontMetrics.svg
 *
 * @author Stefanius <s.kientzler@online.de>
 * @copyright GPLv3 License - see the LICENSE file for details
 */
class SVGFont extends SVGElement
{
    /** @var string     The id of the font     */
    protected string $id = '';
    /** @var int    The default horizontal advance after rendering a glyph in horizontal orientation.     */
    protected int $iHorizAdvX = 0;
    /** @var int    The number of coordinate units on the em square, the size of the design grid on which glyphs are laid out     */
    protected int $iUnitsPerEm = 0;
    /** @var int    The maximum unaccented height of the font     */
    protected int $iAscent = 0;
    /** @var int    The maximum unaccented depth of the font within the font     */
    protected int $iDescent = 0;
    /** @var int    The height of lowercase glyphs in the font     */
    protected int $iCapHeight = 0;
    /** @var int    The height of uppercase glyphs in the font     */
    protected int $iXHeight = 0;
    /** @var array<\stdClass>      The iHorizAdvX and path definition for each contained glyph    */
    protected $aGlyphs = [];

    /**
     * Creates an instance of a SVG font.
     * @param string $strFilename
     */
    public function __construct(string $strFilename = null)
    {
        if ($strFilename) {
            $this->load($strFilename);
        }
    }

    /**
     * Gets the units per em for the loaded font.
     * @return int
     */
    public function getUnitsPerEm() : int
    {
        return $this->iUnitsPerEm;
    }

    /**
     * Returns the maximum unaccented height of the current loaded font.
     * @return int
     */
    public function getAscent() : int
    {
        return $this->iAscent;
    }

    /**
     * Returns the maximum unaccented depth of the current loaded font.
     * @return int
     */
    public function getDescent() : int
    {
        return $this->iDescent;
    }

    /**
     * Returns the height of lowercase glyphs in the current loaded font.
     * @return int
     */
    public function getCapHeight() : int
    {
        return $this->iCapHeight;
    }

    /**
     * Returns the height of uppercase glyphs in the current loaded font.
     * @return int
     */
    public function getXHeight() : int
    {
        return $this->iXHeight;
    }

    /**
     * Loads font definition from SVG font file.
     * The method processes the xml content to get path representation of every character
     * and additional font parameters using XMLReader.
     * @param string $strFilename
     */
    public function load(string $strFilename) : void
    {
        $this->aGlyphs = [];
        $oXML = new XMLReader;
        $oXML->open($strFilename);

        while ($oXML->read()) {
            $strNodeName = $oXML->name;                         // @phpstan-ignore-line

            if ($oXML->nodeType == XMLReader::ELEMENT) {        // @phpstan-ignore-line
                switch ($strNodeName) {
                    case 'font':
                        $this->id = $oXML->getAttribute('id') ?? 'unnamed-font';
                        $this->iHorizAdvX = intval($oXML->getAttribute('horiz-adv-x') ?? 0);
                        break;
                    case 'font-face':
                        $this->iUnitsPerEm = intval($oXML->getAttribute('units-per-em') ?? 1000);
                        $this->iAscent = intval($oXML->getAttribute('ascent') ?? 0);
                        $this->iDescent = intval($oXML->getAttribute('descent') ?? 0);
                        $this->iCapHeight = intval($oXML->getAttribute('cap-height') ?? 0);
                        $this->iXHeight = intval($oXML->getAttribute('x-height') ?? 0);
                        break;
                    case 'missing-glyph':
                        $iHorizAdvX = $oXML->getAttribute('horiz-adv-x');
                        $this->aGlyphs['Missing'] = new stdClass();
                        $this->aGlyphs['Missing']->iHorizAdvX = intval($iHorizAdvX ?? $this->iHorizAdvX);
                        $this->aGlyphs['Missing']->d = $oXML->getAttribute('d');
                        break;
                    case 'glyph':
                        $chUnicode = $oXML->getAttribute('unicode');
                        if ($chUnicode !== null) {
                            $aUnicode = $this->utf8ToUnicode($chUnicode);
                            $iUnicode = $aUnicode[0];

                            $iHorizAdvX = $oXML->getAttribute('horiz-adv-x');
                            $this->aGlyphs[$iUnicode] = new stdClass();
                            $this->aGlyphs[$iUnicode]->iHorizAdvX = intval($iHorizAdvX ?? $this->iHorizAdvX);
                            $this->aGlyphs[$iUnicode]->d = $oXML->getAttribute('d');
                        }
                        break;
                }
            }
        }
    }

    /**
     * Builds a SVG Group element that contains one or more path elements each representing
     * one char of the given text.
     * The method takes an UTF-8 encoded string and the requested size.
     * A subgroup is created for each line the passed text contains.
     * @param string    $strText    UTF-8 encoded text
     * @param int|float $size       textsize
     * @param int|float $x          x position of the text (bottom left of the first char)
     * @param int|float $y          y position of the text (bottom left of the first char)
     * @return SVGGroup|null
     */
    public function text(string $strText, $size, $x, $y) : ?SVGGroup
    {
        if (count($this->aGlyphs) <= 0 || $this->iUnitsPerEm === 0) {
            trigger_error('no SVG fontfile loaded so far!', E_USER_WARNING);
            // Unreachable 'return' when PHPUnit detects trigger_error
            return null;    // @codeCoverageIgnore
        }
        $fltScale = ((float)$size) / $this->iUnitsPerEm;
        $oGrp = new SVGGroup();
        $oGrp->translate($x, $y);
        $aLines = explode("\n", $strText);
        $iVertAdvY = 0;

        foreach($aLines as $strLine) {
            $oLine = new SVGGroup();

            // since all distances (iHorizAdvX, iVertAdvY) are related to the dimensions
            // used by the path definitions, scaling must be the outermost transformation
            // after all translations in X and Y direction have been performed
            $oLine->scale($fltScale);
            $oLine->translate(0, $iVertAdvY);

            $aLine = $this->utf8ToUnicode($strLine);
            $iHorizAdvX = 0;
            foreach ($aLine as $iUnicode) {
                $oPath = new SVGPath();
                $oPath->translate($iHorizAdvX, 0);
                $oPath->flipVert();
                if (isset($this->aGlyphs[$iUnicode])) {
                    $oPath->setAttribute('d', $this->aGlyphs[$iUnicode]->d);
                    $iHorizAdvX += $this->aGlyphs[$iUnicode]->iHorizAdvX;
                } else if (isset($this->aGlyphs['Missing'])) {
                    // ... missing glyph
                    $oPath->setAttribute('d', $this->aGlyphs['Missing']->d);
                    $iHorizAdvX += $this->aGlyphs['Missing']->iHorizAdvX;
                } else {
                    // ... just move one 'empty' char to the right
                    $iHorizAdvX += $this->iHorizAdvX;
                }
                $oLine->add($oPath);
            }
            $oGrp->add($oLine);
            $iVertAdvY += $this->iUnitsPerEm; // $this->iAscent + $this->iDescent;
        }
        return $oGrp;
    }

    /**
     * Calculates the with of the given text.
     * @param string $strText
     * @param int|float $size       textsize (set to -1 to get widht in font units)
     * @return float
     */
    public function textWidth(string $strText, $size = -1) : float
    {
        if (count($this->aGlyphs) <= 0 || $this->iUnitsPerEm === 0) {
            trigger_error('no SVG fontfile loaded so far!', E_USER_WARNING);
            // Unreachable 'return' when PHPUnit detects trigger_error
            return 0;    // @codeCoverageIgnore
        }
        // $fltScale = ((float)$size) / $this->iUnitsPerEm;
        $width = 0;
        $aText = $this->utf8ToUnicode($strText);
        foreach ($aText as $iUnicode) {
            if (isset($this->aGlyphs[$iUnicode])) {
                $width += $this->aGlyphs[$iUnicode]->iHorizAdvX;
            } else if (isset($this->aGlyphs['Missing'])) {
                // ... missing glyph
                $width += $this->aGlyphs['Missing']->iHorizAdvX;
            } else {
                // ... just move one 'empty' char to the right
                $width += $this->iHorizAdvX;
            }
        }
        if ($size !== -1) {
            $width *= $size / $this->iUnitsPerEm;
        }
        return $width;
    }

    /**
     * Builds a SVG Symbol that represents the given text.
     * The method takes an UTF-8 encoded string and the requested size.
     * A subgroup is created for each line the passed text contains.
     * @param string    $strText    UTF-8 encoded text
     * @param int|float $size       textsize
     * @return SVGSymbol|null
     */
    public function symbol(string $strText, $size = -1) : ?SVGSymbol
    {
        if (count($this->aGlyphs) <= 0 || $this->iUnitsPerEm === 0) {
            trigger_error('no SVG fontfile loaded so far!', E_USER_WARNING);
            // Unreachable 'return' when PHPUnit detects trigger_error
            return null;    // @codeCoverageIgnore
        }
        $oSymbol = new SVGSymbol(0, 0);
        $aText = $this->utf8ToUnicode($strText);
        $iHorizAdvX = 0;
        foreach ($aText as $iUnicode) {
            $oPath = new SVGPath();
            $oPath->translate($iHorizAdvX, 0);
            $oPath->flipVert();
            if (isset($this->aGlyphs[$iUnicode])) {
                $oPath->setAttribute('d', $this->aGlyphs[$iUnicode]->d);
                $iHorizAdvX += $this->aGlyphs[$iUnicode]->iHorizAdvX;
            } else if (isset($this->aGlyphs['Missing'])) {
                // ... missing glyph
                $oPath->setAttribute('d', $this->aGlyphs['Missing']->d);
                $iHorizAdvX += $this->aGlyphs['Missing']->iHorizAdvX;
            } else {
                // ... just move one 'empty' char to the right
                $iHorizAdvX += $this->iHorizAdvX;
            }
            $oSymbol->add($oPath);
        }
        if ($size !== -1) {
            $oSymbol->setSize($iHorizAdvX * $size / $this->iUnitsPerEm, $size);
        } else {
            $oSymbol->setSize($iHorizAdvX, $this->iUnitsPerEm);
        }
        $oSymbol->setViewbox(0, -$this->iAscent, $iHorizAdvX, $this->iUnitsPerEm);

        return $oSymbol;
    }

    /**
     * Function converts UTF-8 encoded string to unicode array.
     * @param string $strUTF8
     * @return array<int>
     */
    private function utf8ToUnicode(string $strUTF8) : array
    {
        $aUnicode = array();
        $aValues = array();
        $iLookingFor = 1;

        for ($i = 0; $i < strlen($strUTF8); $i++) {
            $iValue = ord($strUTF8[$i]);
            if ( $iValue < 128 ) {
                $aUnicode[] = $iValue;
            } else {
                if (count($aValues) == 0) {
                    $iLookingFor = ($iValue < 224) ? 2 : 3;
                }
                $aValues[] = $iValue;
                if (count($aValues) == $iLookingFor) {
                    if ( $iLookingFor == 3 ) {
                        $aUnicode[] = (($aValues[0] % 16) * 4096) + (($aValues[1] % 64) * 64) + ($aValues[2] % 64);
                    } else {
                        $aUnicode[] = (($aValues[0] % 32) * 64) + ($aValues[1] % 64);
                    }
                    $aValues = [];
                    $iLookingFor = 1;
                }
            }
        }
        return $aUnicode;
    }
}