<?php

/**
 * This example demonstrates the usage of gradients.
 *
 * @author Stefanius <s.kientzler@online.de>
 * @copyright MIT License - see the LICENSE file for details
 */

declare(strict_types=1);

include 'autoloader.php';

use SKien\SVGCreator\SVG;
use SKien\SVGCreator\Gradients\SVGSimpleGradient;
use SKien\SVGCreator\Shapes\SVGRect;
use SKien\SVGCreator\Text\SVGText;

$oSVG = new SVG();
$oSVG->setPrettyOutput(true);
$oSVG->setSize(500, 300);
$oSVG->setViewbox(0, 0, 1000, 600);

$oSVG->addStyleDef("text {font-size: 24px; font-weight: normal; font-family: 'Arial';}");
$oSVG->addStyleDef("rect {stroke: black; stroke-width: 2;}");

$strFilter = ['LINEAR_HORZ', 'LINEAR_VERT', 'LINEAR_TL2BR', 'LINEAR_BL2TR', 'RADIAL'];

$x = 20;
for ($i = 0; $i <5; $i++) {
    $oSVG->add(new SVGText($x + 80, 50, $strFilter[$i], SVGText::STYLE_ALIGN_MIDDLE));
    $oRect = $oSVG->add(new SVGRect($x, 60, 160, 80));
    $oGradient = $oSVG->addGradient(new SVGSimpleGradient('yellow', 'red', $i));
    $oRect->setGradient($oGradient);
    $x += 200;
}

$oSVG->output();