<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class ACA_ACF_Editing_Textarea extends ACA_ACF_Editing {

	public function get_view_settings() {
		$data = parent::get_view_settings();

		$data['type'] = 'textarea';

		return $data;
	}

}
//3640778428