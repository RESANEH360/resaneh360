<?php if (!defined('ABSPATH')) {
    die;
}

if (class_exists('CSF')) {
    //
    // Set a unique slug-like ID
    $prefix = '_tpmenu';

    //
    // Create profile options
    CSF::createNavMenuOptions($prefix, [
        'data_type' => 'unserialize', // The type of the database save options. `serialize` or `unserialize`
    ]);

    //
    // Create a section
    CSF::createSection($prefix, [
        'fields' => [

            [
                'id' => 'tpmega',
                'type' => 'switcher',
                'title' => 'Enable mega menu',
            ],

            [
                'id' => 'tpmegatemplate',
                'type' => 'select',
                'title' => 'Template',
                'chosen' => true,
                'multiple' => false,
                'options' => thepack_footer_select($type = '', $num = '', $tax = ''),
                'dependency' => ['tpmega', '==', 'true'],
            ],

        ]
    ]);
}
