<?php

declare(strict_types=1);


/*
    dump - formatting the given arguments
        with HTML pre tag and killing the process
        after completion. 

    use - DEVELOPMENT ONLY
*/
function dumpnkill($arg):void
{
    echo "<pre>";
    var_dump($arg);
    echo "</pre>";

    die();
}

function dumpOnly($arg): void
{
    echo "<pre>";
    var_dump($arg);
    echo "</pre>";
}