<?php

namespace Tests\Browser\Pages;

use Laravel\Dusk\Page as BasePage;

abstract class Page extends BasePage
{
    /**
     * Get the global element shortcuts for the site.
     *
     * @return array
     */
    public static function siteElements()
    {
        return [
            '@sales'          => '#navbarVen',
            '@administration' => '#navbarAdm',
            '@reports'        => '#navbarRep',
            '@usermenu'       => '#navbarDropdown',
            '@help'           => 'a[href="/help"]',
            '@settings'       => 'a[href="/settings"]',
        ];
    }
}
