<?php

declare(strict_types=1);

include 'autoloader.php';

use SKien\SVGCreator\SVG;
use SKien\SVGCreator\SVGElement;
use SKien\SVGCreator\SVGGroup;
use SKien\SVGCreator\Filter\SVGDropShadowFilter;
use SKien\SVGCreator\Shapes\SVGRect;
use SKien\SVGCreator\Text\SVGText;

$strCoverage = '???';
if (file_exists('coverage.txt')) {
    $aFile = file('coverage.txt');
    foreach ($aFile as $strLine) {
        $iPos = strpos($strLine, 'Lines:');
        if ($iPos !== false) {
            $strCoverage = trim(substr($strLine, $iPos + 6)); //
            $strCoverage = substr($strCoverage, 0, strpos($strCoverage, '%') + 1);
        }
    }
}

$oSVG = new SVG();
$oSVG->setPrettyOutput(true);
$oSVG->setSize(110, 20);
$oSVG->setViewbox(0, 0, 1100, 200);

$oSVG->addStyleDef("text {font-size: 104px; font-weight: normal; fill: white; font-family: Verdana,Geneva,DejaVu Sans,sans-serif;}");

$oTextShaddow1 = $oSVG->addFilter(new SVGDropShadowFilter(7, 7, null, 'black'));
$oTextShaddow2 = $oSVG->addFilter(new SVGDropShadowFilter(7, 7, null, '#073877'));

$oClipPath = new SVGElement('clipPath');
$oClipRect = $oClipPath->add(new SVGRect(0, 0, 1100, 200, 'fill: #fff;'));
$oClipRect->setCornerRadius(30);
$oSVG->addDef($oClipPath);

$oGroup = new SVGGroup();
$oGroup->setAttribute('clip-path', 'url(#' . $oClipPath->getID() . ')');
$oGroup->add(new SVGRect(0, 0, 550, 200, 'fill: #555; stroke: none;'));
$oGroup->add(new SVGRect(550, 0, 550, 200, 'fill: #0d6efd; stroke: none;'));

$oSVG->add($oGroup);

$oText = $oSVG->add(new SVGText(275, 110, 'coverage', SVGText::STYLE_ALIGN_MIDDLE . SVGText::STYLE_VALIGN_MIDDLE));
$oText->setFilter($oTextShaddow1);
$oText = $oSVG->add(new SVGText(1080, 110, $strCoverage, SVGText::STYLE_ALIGN_END . SVGText::STYLE_VALIGN_MIDDLE));
$oText->setFilter($oTextShaddow2);

$oSVG->save('./images/PhpUnitCoverageBadge.svg');
$oSVG->output();