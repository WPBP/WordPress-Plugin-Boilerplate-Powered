<?php
$closure = function ($data) {
    foreach ($data as $title => &$groups) {
        if (strpos($title, 'CompatibilityAnalyser') === false) {
            continue;
        }
        // looking into Compatibility Analyser metrics only
        foreach ($groups as $group => &$values) {
            if (!in_array($group, array('interfaces', 'traits', 'classes', 'functions', 'constants'))) {
                continue;
            }
            foreach ($values as $name => $metrics) {
                if (version_compare($metrics['php.min'], '5.2.0', 'lt')) {
                    unset($values[$name]);
                }
            }
        }
    }
    return $data;
};
return $closure; 
