<?php
if (file_exists('../library/Import.php'))
    include_once '../library/Import.php';
elseif (file_exists('../../library/Import.php'))
    include_once '../../library/Import.php';
else
    include_once 'library/Import.php';

class ControllerRelatorio extends Request
{

    /**
     *
     * @param int $mont
     * @return string
     */
    public function dateSubMonth($mont)
    {
        $mes = date('M', strtotime(date('Y-m-d', strtotime("-" . $mont . " month", strtotime(date('d-m-Y'))))));
        if ($mes == "Jan" || $mes == "Mar" || $mes == "Jun" || $mes == "Jul" || $mes == "Nov")
            return $mes;
        elseif ($mes == "Feb")
            return 'Fev';
        elseif ($mes == "Apr")
            return "Abr";
        elseif ($mes == "May")
            return "Mai";
        elseif ($mes == "Aug")
            return "Ago";
        elseif ($mes == "Sep")
            return "Set";
        elseif ($mes == "Oct")
            return "Out";
        elseif ($mes == "Dec")
            return "Dez";
    }

    /**
     *
     * @param int $mont
     * @return string MM/YYYY
     */
    public function monthAndYearSubMonth($mont = null)
    {
        if ($mont != null)
            return date('m/Y', strtotime(date('Y-m-d', strtotime("-" . $mont . " month", strtotime(date('d-m-Y'))))));
        else
            return date('m/Y');
    }
}