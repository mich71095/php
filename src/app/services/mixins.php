<?php

const REQUIRED_ERROR = "Field is required!";
const MAX_SIZE_ERROR = "Maximum limit of";
const MIN_SIZE_ERROR = "Minimum limit of";

function checkRequired($field, $required) 
{
    return (empty($field) && ($required==True)) ? "<span>".REQUIRED_ERROR."</span>" : '';
}

function checkMaxSize($field, $max_size)
{
    return (strlen(strval($field)) <= $max_size ) ? '' :  "<span>".MAX_SIZE_ERROR." ".$max_size."</span>";
}

function checkMinSize($field, $min_size)
{
    return (strlen(strval($field)) >= $min_size ) ? '' :  "<span>".MIN_SIZE_ERROR." ".$min_size."</span>";
}

function cleanData($data) {
    return stripslashes(trim($data));
}