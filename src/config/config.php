<?php
return array(

    'default_locale'   => 'en_US',
    'default_encoding' => 'utf8',
    'textdomain'       => 'xo',
    'path_to_mo'       => base_path().'/language/{locale}/LC_MESSAGES/{textdomain}.mo',
    'path_to_po'       => base_path().'/language/{locale}/LC_MESSAGES/{textdomain}.po',
    'path_to_pot'       => base_path().'/language/{locale}/LC_MESSAGES/{textdomain}.pot',
    'lang_type'        => 'pot', // po   mo

    /**
     * compiler settings
     */
    'compiler'         => array(

        'input_folder'  => 'views',
        'output_folder' => 'gettext',
        'levels'        => 10,
    ),

    /**
     * xgettext configuration
     */
    'xgettext'         => array(
        'additional_keywords'  => '',
        'binary'               => "xgettext",
        'binary_path'          => "",
        'comments'             => 'TRANSLATORS',
        'copyright_holder'     => '',
        'email_address'        => '',
        'force_po'             => false,
        'from_code'            => 'utf8',
        'input_folder'         => 'storage/gettext',
        'language'             => 'PHP',
        'output_folder'        => base_path().'/language/en_US/LC_MESSAGES/',
        'package_name'         => 'gettext',
        'package_version'      => 'v1.0.0',
        'views_folder        ' => '',
        'keywords'             => array(
            '__', // shorthand for gettext
            '___', // shorthand for gettext
            //'gettext', // the default php gettext function
            //'dgettext:2', // accepts plurals, uses the second argument passed to dgettext as a translation string
            //'dcgettext:2', // accepts plurals, uses the second argument passed to dcgettext as a translation string
            //'ngettext:1,2', // accepts plurals, uses the first and second argument passed to ngettext as a translation string
            //'dngettext:2,3', // accepts plurals, used the second and third argument passed to dngettext as a translation string
            //'dcngettext:2,3', // accepts plurals, used the second and third argument passed to dcngettext as a translation string
            //'_n:1,2', // a custom gettext shorthand for ngettext (supports plurals)
        ),
    ),
);

?>