<?php

namespace App\Utils;

class Utils {
    public function filterMembers(array $data, string $field, string $fieldToCompare): array
    {
        $filteredData = [];
        $index = 0;

        foreach ($data as $elem) {
            $transformedElem = [
                "id" => $elem->getId(),
                "name" => $elem->getName(),
                "lastName" => $elem->getLastName(),
                "job" => trim($elem->getJob()),
                "team" => trim($elem->getTeam()),
                "agency" => trim($elem->getAgency()),
                "proImage" => $elem->getProImage(),
                "funImage" => $elem->getFunImage(),
            ];
            if (strtolower(trim($transformedElem[$field])) == strtolower(trim($fieldToCompare)))
                $filteredData[] = $transformedElem;
            $index++;
        }
        return $filteredData;
    }

    public function getUniqueData(array $data, $field): array
    {
        $uniqueElement = [];
        $finalData = [];
        $counter = 0;

        foreach ($data as $elem) {
            $finalData[] = [
                "id" => $elem->getId(),
                "name" => $elem->getName(),
                "lastName" => $elem->getLastName(),
                "job" => trim($elem->getJob()),
                "team" => trim($elem->getTeam()),
                "agency" => trim($elem->getAgency()),
                "proImage" => $elem->getProImage(),
                "funImage" => $elem->getFunImage(),
            ];
            if (isset($finalData[$counter][$field]))
                $uniqueElement[$finalData[$counter][$field]] = true;
            $counter++;
        }
        return array_keys($uniqueElement);
    }
}
