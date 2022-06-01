<?php 
    // Calculate the rate and return a result in number of stars
    function getRateInStars($rate)
    {
        $rateResult = "";
        $count = 0;
        $maxRate = 5;
        if ($rate >= 1 && $rate <= 5){
            switch ($rate) {
                case $rate:
                    while ($count < $rate) {
                        $rateResult .= "<i class='fa-solid fa-star'></i>";
                        $count++;
                    }
                    while ($rate != $maxRate){
                        $rateResult .= "<i class='fa-solid fa-star unfilled-star'></i>";
                        $rate++;
                    }
                    return $rateResult;
                    break;

                default:
                    return "La note n'est pas défini pour ce film.";
                    break;
            }
        }else{
            return "La note inséré n'est pas entre 1 et 5.";
        }
    }

    //Switch birthdate to french date
    function dateToFrench($birthDate)
    {
        $date = new DateTime($birthDate);
        $fmt = datefmt_create(
            'fr_FR',
            IntlDateFormatter::LONG,
            IntlDateFormatter::NONE,
            'Europe/Paris',
            IntlDateFormatter::GREGORIAN
        ); 

        return datefmt_format($fmt, $date);
    }

    //Switch birthdate to age
    function getAge($birthDate)
    { 
        $personAge = new DateTime($birthDate);
        $dateNow = new DateTime();
        return $personAge->diff($dateNow)->y." ans";
    }