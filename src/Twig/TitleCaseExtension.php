<?php
namespace Anticus\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

/**
 * Convert a string to title case. 
 * Useful for tags which are alphanumeric.
 * Preserves uppercase tags like CSS or HTML, which are 
 * converted to Css and Html by the Twig title filter.
 */
class TitleCaseExtension extends AbstractExtension
{
    public function getFilters()
    {
        return array(
            new TwigFilter('titlecase', [$this, 'titleCase'])
        );
    }

    /**
     * Use ucwords() to convert the string to title case
     *
     * @param string $title
     * @return string
     */
    public function titleCase($title)
    {
        return ucwords($title);
    }
}
