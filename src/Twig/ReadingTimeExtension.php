<?php
namespace Showus\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

/**
 * Reading time class for displaying reading time of blog posts
 */
class ReadingTimeExtension extends AbstractExtension
{
    public function getFilters()
    {
        return [
            new TwigFilter('minutes', [$this, 'formatMinutes']),
        ];
    }

    /**
     * Format the reading time in whole minutes and pluralised "minutes"
     *
     * @param int $minutes
     * @return string the formatted reading time string
     */
    public function formatMinutes($minutes)
    {
        if ( $minutes <= 1 ) {
            $result = '1 minute';
        } else {
            $result = $minutes . ' minutes';
        }
        return $result;
    }
}
