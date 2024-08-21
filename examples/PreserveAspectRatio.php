<?php

/**
 * This example demonstrates the different rendering when using the
 * 'preserveAspectRatio' property.
 *
 * @author Stefanius <s.kientzler@online.de>
 * @copyright GPLv3 License - see the LICENSE file for details
 */

declare(strict_types=1);

include '../autoloader.php';

use SKien\SVGCreator\SVG;
use SKien\SVGCreator\SVGImage;
use SKien\SVGCreator\Shapes\SVGLine;
use SKien\SVGCreator\Shapes\SVGRect;
use SKien\SVGCreator\Text\SVGText;

$oSVG = new SVG();
$oSVG->setSize(700, 1000);
$oSVG->setViewbox(0, 0, 2100, 2970);

$aPreserve = [
    'none',
    'xMinYMin',
    'xMinYMid',
    'xMinYMax',
    'xMidYMin',
    'xMidYMid',
    'xMidYMax',
    'xMaxYMin',
    'xMaxYMid',
    'xMaxYMax',
];

$oSVG->addStyleDef('text { font: 48px Verdana, Helvetica, Arial, sans-serif; }');
$oSVG->addStyleDef('rect {fill: none; stroke: #999; stroke-width: 4}');
$oSVG->addStyleDef('line {stroke: #777; stroke-width: 2}');

$oSVG->add(new SVGRect(90, 30, 200, 200));
$oImage = new SVGImage(90, 30, 200, 200, 'images/elephpant.png');
$oSVG->add($oImage);

$y = 300;
$x = 450;
foreach ($aPreserve as $strPreserve) {
    $oSVG->add(new SVGLine(0, $x + 950, $y - 25,  $y - 25));
    $oSVG->add(new SVGText(20, $y + 100, "'$strPreserve'", SVGText::STYLE_VALIGN_MIDDLE));

    $oSVG->add(new SVGRect($x, $y, 200, 100));
    $oImage = new SVGImage($x, $y, 200, 100, 'images/elephpant.png');
    // $oImage->setFilter($oFilter);
    $oImage->setPreserveAspectRatio($strPreserve);
    $oSVG->add($oImage);

    $oSVG->add(new SVGRect($x + 300, $y, 100, 200));
    $oImage = new SVGImage($x + 300, $y, 100, 200, 'images/elephpant.png');
    // $oImage->setFilter($oFilter);
    $oImage->setPreserveAspectRatio($strPreserve);
    $oSVG->add($oImage);

    $oSVG->add(new SVGRect($x + 500, $y, 200, 100));
    $oImage = new SVGImage($x + 500, $y, 200, 100, 'images/elephpant.png');
    // $oImage->setFilter($oFilter);
    $oImage->setPreserveAspectRatio($strPreserve . ' slice');
    $oSVG->add($oImage);

    $oSVG->add(new SVGRect($x + 800, $y, 100, 200));
    $oImage = new SVGImage($x + 800, $y, 100, 200, 'images/elephpant.png');
    // $oImage->setFilter($oFilter);
    $oImage->setPreserveAspectRatio($strPreserve . ' slice');
    $oSVG->add($oImage);

    $y += 250;
}
$oSVG->add(new SVGLine(0, $x + 950, $y - 25,  $y - 25));
$oSVG->add(new SVGLine($x - 50, $x - 50, 200, $y - 25));
$oSVG->add(new SVGText($x + 200, 250, "'meet'", SVGText::STYLE_ALIGN_MIDDLE . SVGText::STYLE_VALIGN_MIDDLE));
$oSVG->add(new SVGLine($x + 450, $x + 450, 200, $y - 25));
$oSVG->add(new SVGText($x + 700, 250, "'slice'", SVGText::STYLE_ALIGN_MIDDLE . SVGText::STYLE_VALIGN_MIDDLE));
$oSVG->add(new SVGLine($x + 950, $x + 950, 200, $y - 25));

$oSVG->output();