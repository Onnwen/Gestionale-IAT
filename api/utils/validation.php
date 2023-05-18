<?php

function any_are_null(...$variablesToCheck): bool
{
    foreach ($variablesToCheck as $variable) {
        if (is_null($variable))
            return true;
    }

    return false;
}

function validate_id($id)
{
    if (is_null($id)) {
        return_error(400, "No id was provided");
    }

    if (filter_var($id, FILTER_VALIDATE_INT) === false) {
        return_error(400, "Provided id is not an integer");
    }
}
