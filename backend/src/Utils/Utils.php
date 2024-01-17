<?php

namespace App\Utils;

class Utils {
    public function filterMembers(array $data, string $field, string $fieldToCompare): array
    {
        return array_filter($data, function ($element) use ($field, $fieldToCompare) {
            return trim($element[$field]) == trim($fieldToCompare);
        });
    }

    public function getUniqueData(array $data, $field): array
    {
        $equipes = array();

        foreach ($data as $item) {
            if (isset($item[$field])) {
                $equipes[$item[$field]] = true;
            }
        }
        return array_keys($equipes);
    }
}
