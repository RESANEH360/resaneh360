<?php
namespace ThePackThemeBuilder\Modules\ThemeBuilder\Conditions;

use ThePackBuilder_Extension\Controls\Control_Query as QueryModule;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

class Author extends Condition_Base
{
    public static function get_type()
    {
        return 'archive';
    }

    public static function get_priority()
    {
        return 70;
    }

    public function get_name()
    {
        return 'author';
    }

    public function get_label()
    {
        return __('Author Archive', 'thepack');
    }

    public function check($args = null)
    {
        return is_author($args['id']);
    }

    protected function register_controls()
    {
        $this->add_control(
            'author_id',
            [
                'section' => 'settings',
                'type' => QueryModule::QUERY_CONTROL_ID,
                'select2options' => [
                    'dropdownCssClass' => 'elementor-conditions-select2-dropdown',
                ],
                'autocomplete' => [
                    'object' => QueryModule::QUERY_OBJECT_AUTHOR,
                ],
            ]
        );
    }
}
