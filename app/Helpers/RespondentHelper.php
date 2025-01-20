<?php

namespace App\Helpers;

class RespondentHelper {

    static public function formatRespondents(array $respondents): array
    {
        return array_map(function ($respondent) {
            return implode(', ', [
                $respondent['name'] ?? '',
                $respondent['sex'] ?? '',
                $respondent['age'] ?? '',
                $respondent['address'] ?? '',
            ]);
        }, $respondents);
    }
    
}