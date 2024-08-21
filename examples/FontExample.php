<?php

/**
 * This example demonstrates the usage of SVG font files.
 *
 * @author Stefanius <s.kientzler@online.de>
 * @copyright GPLv3 License - see the LICENSE file for details
 */

declare(strict_types=1);

include '../autoloader.php';

use SKien\SVGCreator\SVG;
use SKien\SVGCreator\SVGGroup;
use SKien\SVGCreator\Marker\SVGArrowMarker;
use SKien\SVGCreator\Marker\SVGMarker;
use SKien\SVGCreator\Shapes\SVGLine;
use SKien\SVGCreator\Text\SVGFont;
use SKien\SVGCreator\Text\SVGText;

$iSVGWidth = 1700;
$iSVGHeight = 750;
$iGrid = 50;

$oSVG = new SVG();
$oSVG->setPrettyOutput(true);
$oSVG->setSize(1000, 400);
$oSVG->setViewbox(0, 0, 2100, $iSVGHeight);

$oSVG->addStyleDef("text {fill: #070; text-anchor: middle; font-size: 48px; font-weight: 400; font-style: italic; font-family: 'Arial';}");
$oSVG->addStyleDef(".dimlines {stroke: #070; stroke-width: 4; stroke-dasharray: 4 8;}");
$oSVG->addStyleDef(".arrows {stroke: #070; stroke-width: 2;}");

if ($iGrid > 0) {
    $oGrid = new SVGGroup('grid');
    $oSVG->addStyleDef(".grid {stroke: #999; stroke-width: 1; stroke-dasharray: 1 2;}");
    for ($x = $iGrid; $x < $iSVGWidth; $x += $iGrid) {
        $oGrid->add(new SVGLine($x, 0, $x, $iSVGHeight, 'grid'));
    }
    for ($y = $iGrid; $y < $iSVGHeight; $y += $iGrid) {
        $oGrid->add(new SVGLine(0, $y, $iSVGWidth, $y, 'grid'));
    }
    $oSVG->add($oGrid);
}

$oMarker = $oSVG->addMarker(new SVGArrowMarker(15, 15));

$oFont = new SVGFont('./fonts/Liberation.svg');
//$oFont = new SVGFont('./fonts/CloisterBlackBT.svg');
$iFontSize = 512;
$iBaseLine = 450;
$iUnitsPerEm = $oFont->getUnitsPerEm();
if ($iUnitsPerEm !== 0) {
    $fltFontUnits = $iFontSize / $oFont->getUnitsPerEm();
    $fltAscent = $oFont->getAscent() * $fltFontUnits;
    $fltDescent = $oFont->getDescent() * $fltFontUnits;
    $fltCapHeight = $oFont->getCapHeight() * $fltFontUnits;
    $fltXHeight = $oFont->getXHeight() * $fltFontUnits;

    $oSVG->add(new SVGLine(50, $iBaseLine - $fltAscent, 1500, $iBaseLine - $fltAscent, 'dimlines'));
    $oSVG->add(new SVGLine(150, $iBaseLine - $fltCapHeight, 450, $iBaseLine - $fltCapHeight, 'dimlines'));
    $oSVG->add(new SVGLine(650, $iBaseLine - $fltXHeight, 1400, $iBaseLine - $fltXHeight, 'dimlines'));
    $oLine = $oSVG->add(new SVGLine(0, $iBaseLine, $iSVGWidth, $iBaseLine, 'stroke: #00f; stroke-width: 3; stroke-dasharray: 5 10;'));
    $oSVG->add(new SVGLine(50, $iBaseLine - $fltDescent, 1500, $iBaseLine - $fltDescent, 'dimlines'));

    $fltCenter = $iBaseLine - $fltDescent - ($fltAscent - $fltDescent) / 2;
    $oText = $oSVG->add(new SVGText(60, $fltCenter, 'unitsPerEm'));
    $oText->rotate(-90, 60, $fltCenter);
    $oLine = new SVGLine(75, $iBaseLine - $fltAscent, 75, $iBaseLine - $fltDescent, 'arrows');
    $oLine->setMarker($oMarker, SVGMarker::MARKER_START | SVGMarker::MARKER_END);
    $oSVG->add($oLine);

    $oText = $oSVG->add(new SVGText(160, $iBaseLine - $fltCapHeight / 2, 'capHeight'));
    $oText->rotate(-90, 160, $iBaseLine - $fltCapHeight / 2);
    $oLine = new SVGLine(175, $iBaseLine - $fltCapHeight, 175, $iBaseLine, 'arrows');
    $oLine->setMarker($oMarker, SVGMarker::MARKER_START | SVGMarker::MARKER_END);
    $oSVG->add($oLine);

    $oText = $oSVG->add(new SVGText(1360, $iBaseLine - $fltXHeight / 2, 'XHeight'));
    $oText->rotate(-90, 1360, $iBaseLine - $fltXHeight / 2);
    $oLine = new SVGLine(1375, $iBaseLine - $fltXHeight, 1375, $iBaseLine, 'arrows');
    $oLine->setMarker($oMarker, SVGMarker::MARKER_START | SVGMarker::MARKER_END);
    $oSVG->add($oLine);

    $oText = $oSVG->add(new SVGText(1460, $iBaseLine - $fltAscent / 2, 'Ascent'));
    $oText->rotate(-90, 1460, $iBaseLine - $fltAscent / 2);
    $oLine = new SVGLine(1475, $iBaseLine - $fltAscent, 1475, $iBaseLine, 'arrows');
    $oLine->setMarker($oMarker, SVGMarker::MARKER_START | SVGMarker::MARKER_END);
    $oSVG->add($oLine);

    $oText = $oSVG->add(new SVGText(1500, $iBaseLine - $fltDescent / 2, 'Descent'));
    $oText->setStyle(SVGText::STYLE_ALIGN_START . SVGText::STYLE_VALIGN_MIDDLE);
    $oLine = new SVGLine(1475, $iBaseLine - $fltDescent, 1475, $iBaseLine, 'arrows');
    $oLine->setMarker($oMarker, SVGMarker::MARKER_START | SVGMarker::MARKER_END);
    $oSVG->add($oLine);

    $fltWidth = $oFont->textWidth('F', $iFontSize);
    $oSVG->add(new SVGLine(300, $iBaseLine - $fltCapHeight, 300, 700, 'dimlines'));
    $oSVG->add(new SVGLine(300 + $fltWidth, $iBaseLine - $fltCapHeight, 300 + $fltWidth, 700, 'dimlines'));

    $oText = $oSVG->add(new SVGText(300 + $fltWidth / 2, 660, 'horizAdvX'));
    $oLine = new SVGLine(300, 675, 300 + $fltWidth, 675, 'arrows');
    $oLine->setMarker($oMarker, SVGMarker::MARKER_START | SVGMarker::MARKER_END);
    $oSVG->add($oLine);

    $oSVG->add(new SVGLine(290, $iBaseLine - 10, 310, $iBaseLine + 10, 'stroke: #00f; stroke-width: 4;'));
    $oSVG->add(new SVGLine(290, $iBaseLine + 10, 310, $iBaseLine - 10, 'stroke: #00f; stroke-width: 4;'));
    $oText = $oSVG->add(new SVGText(90, $iBaseLine + 230, '(x, y)'));
    $oText->setStyle('fill: #00f');
    $oLine = new SVGLine(100, $iBaseLine + 200, 300, $iBaseLine, 'stroke: #00f; stroke-width: 2;');
    $oLine->setMarker($oMarker, SVGMarker::MARKER_END);
    $oSVG->add($oLine);

    $oText = $oFont->text("Fog", $iFontSize, 300, $iBaseLine);
    $oSVG->add($oText);
}
$oSVG->output();
// $oSVG->save('../wiki/SVGCreator.wiki/images/SVGFontMetrics.svg');
