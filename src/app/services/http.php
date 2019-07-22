<?php

// http request
const GET = 'GET';
const POST = 'POST';

function redirect($url, $statusCode = 303)
{
   header('Location: ' . $url, true, $statusCode);
   die();
}

