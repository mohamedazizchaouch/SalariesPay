<?php

class PaySalesDepartmentDate {

    /**
     *
     * @param integer $year
     * @return array
     */
    public static function salaryDates(int $year)
    {   
        for ($month = 1; $month <= 12; $month++) {
            $lastDayOfMonth = date('Y-m-t', strtotime("$year-$month-01"));
            $baseSalaryDate = new DateTime($lastDayOfMonth);
            // Adjust base salary date if it falls on a weekend
            if ($baseSalaryDate->format('N') >= 6) {
                $baseSalaryDate->modify('last Friday');
            }
            $salaryDates[$month] = $baseSalaryDate->format('Y-m-d');
        }
        return $salaryDates;
    }
    /**
     *
     * @param integer $year
     * @return array
     */
    public static function bonnusDates(int $year)
    {
        for ($month = 1; $month <= 12; $month++) {
            $bonnusSalaryDate =new DateTime("$year-$month-15");

            // Adjust base salary date if it falls on a weekend
            if ($bonnusSalaryDate->format('N') >= 6) {
                $bonnusSalaryDate->modify('next Wednesday');
            }
            $bonnusDates[$month] = $bonnusSalaryDate->format('Y-m-d');
        }
        return $bonnusDates;
    }
}

?>
