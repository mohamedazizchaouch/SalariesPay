<?php

namespace App\Service;

use DateTime;

class CsvService
{
    public function generateCsv(array $data, $delimiter = ',', $enclosure = '"')
    {
        $filename = tempnam(sys_get_temp_dir(), 'csv_');
        $handle = fopen($filename, 'w');
        $firstField = ['Month,', 'Salary Payment Date,', 'Bonus Payment Date'];
        fputcsv($handle, $firstField, $delimiter, $enclosure);
        // Écriture des données dans le CSV
        foreach ($data as $key=>$row) {
            fputcsv($handle,[$row['month'],$row['salarie'],$row['bonnus']], $delimiter, $enclosure);
        }

        fclose($handle);

        return $filename;
    }
}
