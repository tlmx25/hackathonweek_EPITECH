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
                "job" => strtolower(trim($elem->getJob())),
                "team" => strtolower(trim($elem->getTeam())),
                "agency" => strtolower(trim($elem->getAgency())),
                "proImage" => $elem->getProImage(),
                "funImage" => $elem->getFunImage(),
            ];
            if (trim($transformedElem[$field]) == strtolower($fieldToCompare))
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
                "job" => strtolower(trim($elem->getJob())),
                "team" => strtolower(trim($elem->getTeam())),
                "agency" => strtolower(trim($elem->getAgency())),
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
