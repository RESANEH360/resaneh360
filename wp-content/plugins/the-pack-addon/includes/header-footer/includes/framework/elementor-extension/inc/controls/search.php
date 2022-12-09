<?php
namespace ThePackBuilder_Extension\Controls;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class Control_Search extends \Elementor\Base_Data_Control
{
    /**
     * Retrieve select2 control type.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Control type.
     */
    public function get_type()
    {
        return 'lakit_search';
    }

    public static function get_control_type()
    {
        return 'lakit_search';
    }

    /**
     * Retrieve select2 control default settings.
     *
     * Get the default settings of the select2 control. Used to return the
     * default settings while initializing the select2 control.
     *
     * @since 1.0.0
     * @access protected
     *
     * @return array Control default settings.
     */
    protected function get_default_settings()
    {
        return [
            'multiple' => false,
            'query_params' => [],
        ];
    }

    /**
     * Render select2 control output in the editor.
     *
     * Used to generate the control HTML in the editor using Underscore JS
     * template. The variables for the class are available using `data` JS
     * object.
     *
     * @since 1.0.0
     * @access public
     */
    public function content_template()
    {
        $control_uid = $this->get_control_uid(); ?>
		<div class="elementor-control-field">
			<label for="<?php echo $control_uid; ?>" class="elementor-control-title">{{{ data.label }}}</label>
			<div class="elementor-control-input-wrapper">
				<# var multiple = ( data.multiple ) ? 'multiple' : ''; #>
				<select id="<?php echo $control_uid; ?>" class="elementor-select2" type="select2" {{ multiple }} data-setting="{{ data.name }}">
					<# if ( multiple ) { #>
						<# _.each( data.controlValue, function( value ) {
							#>
						<option value="{{ value }}" selected>{{ data.saved[ value ] }}</option>
						<# } ); #>
					<# } else { #>
						<option value="{{ data.controlValue }}" selected>{{ data.saved[ data.controlValue ] }}</option>
					<# } #>
				</select>
			</div>
		</div>
		<# if ( data.description ) { #>
			<div class="elementor-control-field-description">{{{ data.description }}}</div>
		<# } #>
		<?php
    }
}
