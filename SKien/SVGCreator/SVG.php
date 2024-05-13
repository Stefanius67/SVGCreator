<?php

declare(strict_types=1);

namespace SKien\SVGCreator;

use SKien\SVGCreator\Filter\SVGFilter;
use SKien\SVGCreator\Gradients\SVGGradient;
use SKien\SVGCreator\Marker\SVGMarker;

/**
 * Class to maintain the root element of a SVG image.
 *
 * An instance of this class can be used to
 * - generate a '*.svg' image file using the `save()` method.
 * - for direct output including appropriate http header using the `output()` method.
 * - embedd it into another svg image using the `add()` method of the image where to embed.
 * - directly insert the resulting code in html code using the `getSVG()` method.
 *
 * To get a more readable output, the 'pretty output' can be enabled.
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

    /** lengthAdjust: only the spacing between the glyphs is adjusted    */
    public const LENGTH_ADJUST_SPACING              = 'spacing';
    /** lengthAdjust: spacing and the glyphs are adjusted    */
    public const LENGTH_ADJUST_SPACING_AND_GLYPHS   = 'spacingAndGlyphs';

    /** Renders the text at the left side of the path */
    public const RENDER_LEFT                        = 'left';
    /** Renders the text at the left right of the path */
    public const RENDER_RIGHT                       = 'right';
    /** Valid values for the method to use to render individual glyphs along a path  */
    public const METHOD_ALIGN                       = 'align';
    public const METHOD_STRETCH                     = 'stretch';
    /** Valid values how the space between glyphs should be handled  */
    public const GLYPH_SPACING_AUTO                 = 'auto';
    public const GLYPH_SPACING_EXACT                = 'exact';

    /** @var SVGElement the child to hold filters, gradients and textpaths     */
    protected SVGElement $oDefs;
    /** @var array<string,int>  last ID for the several elements     */
    protected array $aID = [];
    /** @var bool   if true, the DOM output is formated and includes comments    */
    protected bool $bPrettyOutput = false;

    /**
     * Creates a SVG root element.
     * The svg element is a container that defines a new coordinate system and viewport.
     * It is used as the outermost element of SVG documents (*-> the root*), but it can
     * also be used to embed an SVG fragment inside an SVG or HTML document.
     * @param bool $bIsRoot   element is the root element of an image.
     */
    public function __construct(bool $bIsRoot = true)
    {
        parent::__construct('svg');

        $this->oRoot = $this;
        if ($bIsRoot) {
            // **Note:** <br>
            // The xmlns attribute is only required on the svg root element of SVG documents,
            // or inside HTML documents with XML serialization.
            $this->setAttribute('xmlns', 'http://www.w3.org/2000/svg');
        }
        $this->oDefs = new SVGElement('defs');
        $this->add($this->oDefs);
    }

    /**
     * Sets or resets the 'pretty output' mode.
     * If the 'pretty output' mode is enabled, the resulting SVG image is formatted
     * for better human readability and comments are inserted. If the mode is
     * deactivate (default), white spaces are preserved and no comments are included.
     * @param bool $bPretty set or reset the 'pretty output' mode
     */
    public function setPrettyOutput(bool $bPretty) : void
    {
        $this->bPrettyOutput = $bPretty;
    }

    /**
     * Gets the 'pretty output' mode.
     * @return bool
     */
    public function isPrettyOutput() : bool
    {
        return $this->bPrettyOutput;
    }

    /**
     * Sets the size of the image.
     * > **Note:** <br>
     * > In an HTML document if both the viewBox and width attributes are omitted,
     * > the svg element will be rendered with a width of 300px.
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
     * @link https://developer.mozilla.org/en-US/docs/Web/SVG/Attribute/viewBox
     */
    public function setViewbox(float $xMin, float $yMin, float $width, float $height) : void
    {
        $this->setAttribute('viewBox', implode(' ', [$xMin, $yMin, $width, $height]));
    }

    /**
     * Adds a element to the imag definitions (`defs`).
     * If the element has no ID set so far, an unique id for the element type is
     * generated and set.
     * @param SVGElement $oElement  the element to add
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
     * Adds a filter to the SVG defs.
     * > This method directly calls `addDef()` and  only exist for typesafe returning
     * > of the added filter.
     * > It allows typesafe codesnipets like
     * <pre>
     *   $oFilter = $oSVG->addFilter(new SVGSaturationFilter(0.5));
     *   $oCircle = $oSVG->add(new Circle(100, 100, 50));
     *   $oCircle->setFilter($oFilter);
     * </pre>
     * @param SVGFilter $oFilter
     * @return SVGFilter
     */
    public function addFilter(SVGFilter $oFilter) : SVGFilter
    {
        $this->addDef($oFilter);
        return $oFilter;
    }

    /**
     * Adds a gradient to the SVG defs.
     * > This method directly calls `addDef()` and  only exist for typesafe returning
     * > of the added gradient. <br>
     * > It allows typesafe codesnipets like
     * <pre>
     *   $oGradient = $oSVG->addGradient(new SVGSimpleGradient('red', 'yellow', SVGSimpleGradient::LINEAR_HORZ));
     *   $oCircle = $oSVG->add(new Circle(100, 100, 50));
     *   $oCircle->setGradient($oGradient);
     * </pre>
     * @param SVGGradient $oGradient
     * @return SVGGradient
     */
    public function addGradient(SVGGradient $oGradient) : SVGGradient
    {
        $this->addDef($oGradient);
        return $oGradient;
    }

    /**
     * Adds a marker to the SVG defs.
     * @param SVGMarker $oMarker
     * @return SVGMarker
     */
    public function addMarker(SVGMarker $oMarker) : SVGMarker
    {
        $this->addDef($oMarker);
        return $oMarker;
    }

    /**
     * Adds global style to the image.
     * A style element allows style sheets to be embedded directly within SVG content. <br>
     * > **Note:** <br>
     * > SVG's style element has the same attributes as the corresponding element in HTML
     * @param string $strStyleDef   content of the stylesheet
     * @param string $strMedia      an optional media query
     * @link ht
     */
    public function addStyleDef(string $strStyleDef, string $strMedia = null) : void
    {
        $oStyle = new SVGCData('style', $strStyleDef);
        $oStyle->setAttribute('media', $strMedia);
        $this->add($oStyle);
    }

    /**
     * Creates a DOM document containing the svg definitions.
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
     * Builds an unique ID for the requested element.
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
     * If a filename is provided, the `Content-Disposition: attachment` header is
     * added that forcees the browser to display the 'file save' dialog to download
     * the generated image file.
     * @param string $strFilename   optional filename to force the browser to show the download dialog
     */
    public function output(string $strFilename = null) : void
    {
        $oDOM = $this->buildDOM();

        $strSVG = $oDOM->saveXML();

        header('Content-Type: image/svg+xml; charset=utf-8');
        header('Content-Length: ' . strlen($strSVG));
        if ($strFilename !== null) {
            header('Content-Disposition: attachment; filename=' . $strFilename);
        }
        echo $strSVG;
    }

    /**
     * Gets the SVG - source as string.
     * @return string
     */
    public function getSVG() : string
    {
        $oDOM = $this->buildDOM();

        $strXML = $oDOM->saveXML();
        $strSVG = preg_replace('/^<\?xml.*?>/', '', $strXML);

        return trim($strSVG);
    }

    /**
     * Saves the image to a file with the given filename on the server.
     * @param string $strFilename
     */
    public function save(string $strFilename) : void
    {
        $oDOM = $this->buildDOM();

        $oDOM->save($strFilename);
    }
}