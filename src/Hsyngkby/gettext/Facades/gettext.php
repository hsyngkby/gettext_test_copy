<?php namespace Hsyngkby\gettext\Facades;

use Illuminate\Support\Facades\Facade;

class gettext extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return 'gettext'; }
}