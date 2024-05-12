<?php

declare(strict_types=1);

namespace SKien\SVGCreator;

/**
 * Class to group other elements.
 *
 * Grouping elements can be helpful to perform transformations or apply
 * filter to a logical group of elements inside of an image.
 *
 * Transformations applied to a group element are performed on its child elements, and
 * its attributes are inherited by its children. It can also group multiple elements to
 * be referenced later with the `use` element.
 *
 * @author Stefanius <s.kientzler@online.de>
 * @copyright MIT License - see the LICENSE file for details
 */
class SVGGroup extends SVGElement
{
    /**
     * Create a group.
     */
    public function __construct()
    {
        parent::__construct('g');
    }
}