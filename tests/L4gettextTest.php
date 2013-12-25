<?php

use Mockery as m;

class gettextTest extends Orchestra\Testbench\TestCase {

    protected function getPackageProviders ()
    {
        return array(
            'Hsyngkby\gettext\gettextServiceProvider',
        );

    }

    protected function getPackageAliases ()
    {
        return array(
            'gettext' => 'Hsyngkby\gettext\Facades\gettext',
        );

    }

    public function testHasLocale ()
    {
        $this->assertTrue(gettext::hasLocale());

    }

    public function testHasEncoding ()
    {
        $this->assertTrue(gettext::hasEncoding());

    }

    public function testSetLocaleReturnsInstanceOfgettext ()
    {
        $default = Config::get('l4gettext::config.default_locale');
        $this->assertInstanceOf('Hsyngkby\gettext\gettext', gettext::setLocale($default));

    }

    public function testSessionHasLocale ()
    {
        $this->assertTrue(Session::has('l4gettext_locale'));

    }

    public function testSessionHasDefaultLocale ()
    {
        $default = Config::get('l4gettext::config.default_locale');
        $this->assertSame(Session::get('l4gettext_locale'), $default);

    }

    public function testSetEncodingReturnsInstanceOfgettext ()
    {
        $default = Config::get('l4gettext::config.default_encoding');
        $this->assertInstanceOf('Hsyngkby\gettext\gettext', gettext::setEncoding($default));

    }

    public function testSessionHasEncoding ()
    {
        $this->assertTrue(Session::has('l4gettext_encoding'));

    }

    public function testSessionHasDefaultEncoding ()
    {
        $default = Config::get('l4gettext::config.default_encoding');
        $this->assertSame(Session::get('l4gettext_encoding'), $default);

    }

    public function testGetLocaleAndEncodingReturnsString ()
    {
        $this->assertSame('string', gettype(gettext::getLocaleAndEncoding()));

    }

    public function testInvalidSetLocaleReturnsException ()
    {
        $this->setExpectedException('Hsyngkby\gettext\InvalidLocaleException');
        gettext::setLocale("invalid");

    }

    public function testInvalidSetEncodingReturnsException ()
    {
        $this->setExpectedException('Hsyngkby\gettext\InvalidEncodingException');
        gettext::setEncoding("invalid");

    }

    public function testGetLocaleReturnsDefaultLocale ()
    {
        $default = Config::get('l4gettext::config.default_locale');
        $this->assertSame(gettext::getLocale(), $default);

    }

    public function testGetEncodingReturnsDefaultEncoding ()
    {
        $default = Config::get('l4gettext::config.default_encoding');
        $this->assertSame(gettext::getEncoding(), $default);

    }

    public function testHasLocaleReturnBoolean ()
    {
        $this->assertInternalType('boolean', gettext::hasLocale());

    }

    public function testHasEncodingReturnBoolean ()
    {
        $this->assertInternalType('boolean', gettext::hasEncoding());

    }

    public function testCreateFolderFolderAlreadyExists ()
    {
        File::shouldReceive('isDirectory')->once()->andReturn(true)
                ->shouldReceive('makeDirectory')->never();

        new \Hsyngkby\gettext\gettext();

    }

    public function testCreateFolderFolderCreatedSuccessfully ()
    {
        File::shouldReceive('isDirectory')->twice()->andReturn(false) // init by constructor
                ->shouldReceive('makeDirectory')->once()->andReturn(true);

        new \Hsyngkby\gettext\gettext();

    }

    public function testCreateFolderFolderNotCreatedSuccessfully ()
    {
        $this->setExpectedException('Hsyngkby\gettext\LocaleFolderCreationException');
        File::shouldReceive('isDirectory')->twice()->andReturn(false) // init by constructor
                ->shouldReceive('makeDirectory')->once()->andReturn(false);

        new \Hsyngkby\gettext\gettext();

    }

    public function testToStringEqualsGetLocaleAndEncoding ()
    {
        $this->assertSame(gettext::__toString(), gettext::getLocaleAndEncoding());

    }

    public function testSetTextDomainShouldCallIsDirectory ()
    {
        File::shouldReceive('isDirectory')->once()->andReturn(true);

        new \Hsyngkby\gettext\gettext();

    }

    public function testSetTextDomainShouldReturnObject ()
    {
        File::shouldReceive('isDirectory')->twice()->andReturn(true) // init by constructor
                ->shouldReceive('makeDirectory')->never();

        $this->assertInstanceOf("Hsyngkby\gettext\gettext", gettext::createFolder('/test'));

    }

    public function testSetTextDomainReturnsgettextInstance ()
    {
        $textdomain = Config::get('l4gettext::config.textdomain');
        $path_to_mo = Config::get('l4gettext::config.path_to_mo');
        $this->assertInstanceOf('Hsyngkby\gettext\gettext', gettext::setTextDomain($textdomain, $path_to_mo));

    }

    public function tearDown ()
    {
        m::close();

    }

}

?>