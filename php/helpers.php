<?php

function println(...$vars): void
{

    $bt = debug_backtrace();
    $caller = array_shift($bt);

    echo basename($caller['file']);
    echo " ({$caller['line']}): ";

    // do your logging stuff here.
    foreach ($vars as $var) {
        if (is_bool($var))
            echo $var ? 'bool(true)' : 'bool(false)';
        else if (is_null($var))
            echo 'null';
        else if (is_array($var)) {
            // echo str_replace("    ", '', str_replace("\n", '', print_r($var, true)));
            $arr = var_export($var, true);
            $arr = str_replace(["\n", " "], '', $arr);
            $arr = str_replace(',)', ')', $arr);
            $arr = str_replace(',', ', ', $arr);
            $arr = str_replace('=>', ' => ', $arr);
            echo $arr;
        }
        else if (is_object($var)) {
            $obj = print_r($var, true);
            $obj = str_replace("    ", '', $obj);
            $obj = str_replace("\n", '', $obj);
            $obj = str_replace("[", ', [', $obj);
            $obj = str_replace("(, ", '(', $obj);
            echo $obj;
        }
        else
            echo gettype($var) . "($var)";
        echo " ";
    }
    echo PHP_SAPI === 'cli' ? PHP_EOL : "<br>" . PHP_EOL;
}