<?php namespace Hsyngkby\gettext;

use Config;
use Session;
use File;

class gettext {

    /**
     * variable holds the current locale
     *
     * @var string
     */
    protected $locale = null;

    /**
     * variable holds the current encoding
     *
     * @var string
     */
    protected $encoding = null;

    /**
     * constructor method
     * accepts an optional $locale, otherwise the default will be used
     *
     * @param string $locale
     */
    public function __construct ()
    {
        // check if a locale is present in the session
        // otherwise use default
        /*
        if(Config::get('gettext::config.gettext_type') === 'gettext'):
            $session_locale = Session::get('gettext_locale', null);
            $locale = (is_null($session_locale)) ? Config::get("gettext::config.default_locale") : $session_locale;
            Session::forget('gettext_locale');

            // check if an encoding is present in the session
            $session_encoding = Session::get('gettext_encoding', null);
            $encoding = (is_null($session_encoding)) ? Config::get("gettext::config.default_encoding") : $session_encoding;
            Session::forget('gettext_encoding');

            // set the encoding and locale
            $this->setEncoding($encoding)->setLocale($locale);

            // determine and set textdomain
            $textdomain = Config::get("gettext::config.textdomain");
            $path = Config::get("gettext::config.path_to_mo");
            $this->setTextDomain($textdomain, $path);
        endif;
        */
        $session_locale = Session::get('user.lang', null);
        $locale = (is_null($session_locale)) ? Config::get("gettext::config.default_locale") : $session_locale;
        Session::put('user.lang', $locale);
        DEFINE('LOCALE',$locale);

        $this->loadGettextLib($locale);

    }


    public function loadGettextLib($locale)
    {
        require_once 'lib/Gettext.php';
        require_once 'lib/MO.php';
        require_once 'lib/PO.php';

        $textdomain = Config::get("gettext::config.textdomain");
        if (Config::get('gettext::config.lang_type') === 'mo')
            $file = Config::get('gettext::config.path_to_mo');
        if (Config::get('gettext::config.lang_type') === 'po')
            $file = Config::get('gettext::config.path_to_po');
        if (Config::get('gettext::config.lang_type') === 'pot')
            $file = Config::get('gettext::config.path_to_pot');
        $file = str_replace('{locale}', $locale, $file);
        $file = str_replace('{textdomain}', $textdomain , $file);
        $file = new \File_Gettext_PO($file);
        $q1 = $file->load();
        $q2 = $file->toArray();
        $GLOBALS['XO_LANG'] = $q2['strings'];
    }

    /**
     * method which auto creates the LC_MESSAGES folder for each set locale, if they do not exist yet
     *
     * @param string $path
     * @return \Hsyngkby\gettext\gettext
     * @throws LocaleNotSetException
     */
    public function createFolder ($path)
    {
        // set full path
        $full_path = app_path() . DIRECTORY_SEPARATOR . $path . DIRECTORY_SEPARATOR . $this->getLocale() . DIRECTORY_SEPARATOR . 'LC_MESSAGES';

        // check if the folder exists
        if (!File::isDirectory($full_path))
        {
            // folder does not exist, attempt to create it
            // throws an ErrorException when failed
            if (!File::makeDirectory($full_path, 0755, true))
                throw new LocaleFolderCreationException("The locale folder [$full_path] does not exist and could not be created automatically; please create the folder manually");
        }

        // allow object chaining
        return $this;

    }

    /**
     * method to dump the current locale/encoding settings to string
     *
     * @return string
     */
    public function __toString ()
    {
        return (string) $this->getLocaleAndEncoding();

    }

}

?>