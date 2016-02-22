<?php

/**
 * Function wrapper for register,unregister,get language and get string for WPML, Polylang and Ceceppa Multilingua
 * 
 * example use https://gist.github.com/Mte90/fe687ceed408ab743238
 * 
 * @package   Plugin_Name
 * @author    Mte90 <mte90net@gmail.com>
 * @license   GPL-2.0+
 * @copyright 2014-2015
 */
if ( !function_exists( 'get_language' ) ) {

    /**
     * Return the language 2-4 letters code
     *
     * @since   1.0.0
     *
     * @return     string 4 letters cod of the locale
     */
    function get_language() {
        if ( defined( 'ICL_LANGUAGE_CODE' ) ) {
            return ICL_LANGUAGE_CODE;
        } elseif ( function_exists( 'cml_get_browser_lang' ) ) {
            return cml_get_browser_lang();
        } elseif ( function_exists( 'pll_current_language' ) ) {
            return pll_current_language();
        } else {
            // Return a 2-4 letters code
            return get_locale();
        }
    }

}

if ( !function_exists( 'register_string' ) ) {

    /**
     * Add registration for multilanguage string (contain hook)
     *
     * @since   1.0.0
     *
     * @param string $plugin_name_human_format The Plugin name .
     * @param string $string_name The name of the string.
     * @param string $value The value.
     */
    function register_string( $plugin_name_human_format, $string_name, $value ) {
        if ( function_exists( 'icl_register_string' ) ) {
            icl_register_string( $plugin_name_human_format, $string_name, $value );
        } elseif ( has_filter( 'cml_my_translations' ) ) {
            CMLTranslations::add( $string_name, $value, str_replace( ' ', '-', $plugin_name_human_format ) );
        } elseif ( function_exists( 'pll_register_string' ) ) {
            $plugin_name_human_format_replaced = str_replace( ' ', '-', $plugin_name_human_format );
            pll_register_string( $plugin_name_human_format_replaced, $string_name );
        }
    }

}

if ( !function_exists( 'deregister_string' ) ) {

    /**
     * Unregister multilanguage string, Polylang missing support of this feature
     *
     * @since   1.0.0
     *
     * @param string $plugin_name_human_format The Plugin name.
     * @param string $string_name The name of the string.
     */
    function deregister_string( $plugin_name_human_format, $string_name ) {
        if ( function_exists( 'icl_unregister_string' ) ) {
            icl_unregister_string( $plugin_name_human_format, $string_name );
        } elseif ( has_filter( 'cml_my_translations' ) ) {
            $plugin_name_human_format_replaced = str_replace( ' ', '-', $plugin_name_human_format );
            CMLTranslations::delete( $plugin_name_human_format_replaced );
        }
    }

}

if ( !function_exists( 'get_string' ) ) {

    /**
     * Get multilanguage string
     *
     * @since   1.0.0
     *
     * @param string $plugin_name_human_format The Plugin name.
     * @param string $string_name The name of the string.
     * @param string $value	The value.
     * @return string The string
     */
    function get_string( $plugin_name_human_format, $string_name, $value ) {
        if ( function_exists( 'icl_t' ) ) {
            return icl_t( $plugin_name_human_format, $string_name, $value );
        } elseif ( has_filter( 'cml_my_translations' ) ) {
            return CMLTranslations::get( CMLLanguage::get_current_id(), strtolower( $string_name ), str_replace( ' ', '-', $plugin_name_human_format, $true ) );
        } elseif ( function_exists( 'pll__' ) ) {
            return pll__( $string_name );
        } else {
            return $value;
        }
    }

}
