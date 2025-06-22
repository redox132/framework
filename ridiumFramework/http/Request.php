<?php

declare(strict_types = 1);

namespace App\Http;

class Request
{
    static public function validate(array $data = [], array $rules = [])
    {
        $errors = [];

        foreach ($rules as $key => $value) {
            $field = $data[$key] ?? '';

            if (in_array('required', $value) && trim($field) === '') {
                $errors[] = "The {$key} field is required.";
                continue;
            }

            if (isset($value['min']) && strlen($field) < $value['min']) {
                $errors[] = "The {$key} field must be at least {$value['min']} characters.";
            }

            if (isset($value['max']) && strlen($field) > $value['max']) {
                $errors[] = "The {$key} field must not be longer than {$value['max']} characters.";
            }

            if (in_array('email', $value) && !filter_var($field, FILTER_VALIDATE_EMAIL)) {
                $errors[] = "The {$key} field must be a valid email address.";
            }
        }

        if (!empty($errors)) {
            http_response_code(422);
            $_SESSION['errors'] = $errors;
            $_SESSION['old'] = $data;
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        }
    }
}


