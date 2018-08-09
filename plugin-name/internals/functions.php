<?php

function pn_get_settings() {
    return apply_filters( 'pn_get_settings', get_option( PN_TEXTDOMAIN . '-settings' ) );
}
