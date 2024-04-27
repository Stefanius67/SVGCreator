<?php
declare(strict_types=1);

namespace SKien\SVGCreator;

/**
 *
 * Another package: {@link https://github.com/meyfa/php-svg/tree/main}
 *
 * @author Stefanius <s.kientzler@online.de>
 * @copyright MIT License - see the LICENSE file for details
 */
class SVG extends SVGElement
{
    /** valid values for Text align    */
    public const ALIGN_START     = 'start';
    public const ALIGN_MIDDLE    = 'middle';
    public const ALIGN_END       = 'end';

    /** valid values for Text vertical align    */
    public const VALIGN_AUTO     = 'auto';
    public const VALIGN_MIDDLE   = 'middle';
    public const VALIGN_HANGING  = 'hangin';

    /** valid values for Text/TextPath length adjustment    */
    public const LENGTH_ADJUST_SPACING              = 'spacingAndGlyphs';
    public const LENGTH_ADJUST_SPACING_AND_GLYPHS   = 'spacingAndGlyphs';

    /** valid values for TextPath rendering    */
    public const RENDER_LEFT                        = 'left';
    public const RENDER_RICGHT                      = 'right';
    public const METHOD_ALIGN                       = 'align';
    public const METHOD_STRETCH                     = 'stretch';
    public const GLYPH_SPACING_AUTO                 = 'auto';
    public const GLYPH_SPACING_EXACT                = 'exact';

    /** @var SVGElement the child to hold filters, gradients and textpaths     */
    protected SVGElement $oDefs;
    /** @var array<string,int>  last ID for the several elements     */
    protected array $aID = [];
    /** @var bool   if true, the DOM output is formated and includes comments    */
    protected bool $bPrettyOutput = false;

    public function __construct()
    {
        parent::__construct('svg');

        $this->oRoot = $this;
        $this->setAttribute('xmlns', 'http://www.w3.org/2000/svg');
        $this->oDefs = new SVGElement('defs');
        $this->add($this->oDefs);
    }

    public function setPrettyOutput(bool $bPretty) : void
    {
        $this->bPrettyOutput = $bPretty;
    }

    public function isPrettyOutput() : bool
    {
        return $this->bPrettyOutput;
    }

    /**
     * Sets the size of the image.
     * @param string|float $width
     * @param string|float $height
     */
    public function setSize($width, $height) : void
    {
        $this->setAttribute('width', (string) $width);
        $this->setAttribute('height', (string) $height);
    }

    /**
     * Sets the viewbox for the image.
     * The viewBox defines the position and dimension, in user space.
     * `xMin` and `yMin` represent the top left coordinates of the viewport. `width`
     * and `height` represent its dimensions.
     * @param float $xMin
     * @param float $yMin
     * @param float $width
     * @param float $height
     */
    public function setViewbox(float $xMin, float $yMin, float $width, float $height) : void
    {
        $this->setAttribute('viewBox', implode(' ', [$xMin, $yMin, $width, $height]));
    }

    /**
     * @param SVGElement $oElement
     * @return SVGElement
     */
    public function addDef(SVGElement $oElement) : SVGElement
    {
        if (empty($oElement->getID()) && $this->oRoot !== null) {
            $oElement->setID($this->oRoot->buildID($oElement->getName()));
        }
        return $this->oDefs->add($oElement);
    }

    /**
     * Adds global style to the image.
     * @param string $strStyle
     */
    public function addStyleDef(string $strStyleDef) : void
    {
        $this->add(new SVGCData('style', $strStyleDef));
    }

    /**
     * Create DOM element and append it to the requested parent node.
     * @return \DOMDocument
     */
    public function buildDOM() : \DOMDocument
    {
        $oDOM = new \DOMDocument("1.0", "UTF-8");

        $oDOM->formatOutput = $this->bPrettyOutput;
        $oDOM->preserveWhiteSpace = !$this->bPrettyOutput;

        $this->appendToDOM($oDOM);

        return $oDOM;
    }

    /**
     * Build an unique ID for the requested element.
     * @param string $strElement
     * @return string
     */
    public function buildID(string $strElement) : string
    {
        $id = $this->aID[$strElement] ?? 0;
        $strID = $strElement . ++$id;
        $this->aID[$strElement] = $id;

        return $strID;
    }

    /**
     * Outputs the image preceeded by the HTTP header.
     */
    public function output() : void
    {
        $oDOM = $this->buildDOM();

        $strSVG = $oDOM->saveXML();

        header('Content-Type: image/svg+xml; charset=utf-8');
        header('Content-Length: ' . strlen($strSVG));
        echo $strSVG;
    }

    /**
     * @param string $strFilename
     */
    public function save(string $strFilename) : void
    {
        $oDOM = $this->buildDOM();

        $oDOM->save($strFilename);
    }
}