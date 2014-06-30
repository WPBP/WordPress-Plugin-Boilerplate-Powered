<?php

// By Mte90 - www.mte90.net

/**
 * Return the language 2 letters code
 *
 * @since   1.0.0
 *
 * @var     string
 */
function get_language() {
	if ( defined( 'ICL_LANGUAGE_CODE' ) ) {
		return ICL_LANGUAGE_CODE;
	} elseif ( function_exists( 'cml_get_browser_lang' ) ) {
		return cml_get_browser_lang();
	} elseif ( function_exists( 'pll_current_language' ) ) {
		return pll_current_language();
	} else {
		//return a 4 letters code
		return get_locale();
	}
}

/**
 * Add registration for string (contain hook)
 *
 * @since   1.0.0
 *
 * @var     string
 */
function register_string( $plugin_name_human_format, $string_name, $value ) {
	if ( function_exists( 'icl_register_string' ) ) {
		icl_register_string( $plugin_name_human_format, $string_name, $value );
	} elseif ( has_filter( 'cml_my_translations' ) ) {
		add_filter( 'cml_my_translations', function($groups) {
			$plugin_name_human_format_replaced = str_replace( ' ', '-', $plugin_name_human_format );
			CMLTranslations:add( $string_name, $value, $plugin_name_human_format );
			$groups[ $plugin_name_human_format_replaced ] = $plugin_name_human_format;
			return $groups;
		} );
	} elseif ( function_exists( 'pll_register_string' ) ) {
		$plugin_name_human_format_replaced = str_replace( ' ', '-', $plugin_name_human_format );
		pll_register_string( $plugin_name_human_format_replaced, $string_name );
	}
}

/**
 * Unregister string, Polylang not have this feature
 *
 * @since   1.0.0
 *
 * @var     string
 */
function deregister_string( $plugin_name_human_format, $string_name ) {
	if ( function_exists( 'icl_unregister_string' ) ) {
		icl_unregister_string( $plugin_name_human_format, $string_name );
	} elseif ( has_filter( 'cml_my_translations' ) ) {
		$plugin_name_human_format_replaced = str_replace( ' ', '-', $plugin_name_human_format );
		CMLTranslations::delete( $plugin_name_human_format_replaced );
	}
}

/**
 * Get string
 *
 * @since   1.0.0
 *
 * @var     string
 */
function get_string( $plugin_name_human_format, $string_name, $value ) {
	if ( function_exists( 'icl_t' ) ) {
		return icl_t( $plugin_name_human_format, $string_name, $value );
	} elseif ( has_filter( 'cml_my_translations' ) ) {
		return CMLTranslations::get( CMLLanguage::get_current_id(), $string_name, str_replace( ' ', '-', $plugin_name_human_format ) );
	} elseif ( function_exists( 'pll__' ) ) {
		return pll__( $string_name );
	}
}
