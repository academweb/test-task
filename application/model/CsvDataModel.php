<?php

require_once Config::get('PATH_TYPES') . 'CsvData.php';

/**
 * Handles all manipulations with data obtained from csv
 */
class CsvDataModel
{
    /**
     * Data import to database
     * 
     * @param CsvData $data data to import
     * 
     * @return bool success status
     */
    public static function importCsvData($data)
    {
        if (($data instanceof CsvData) === false || $data->empty()) {
            return false;
        }

        $rawData = $data->getData();
        $insertData = '';
        $userId = Session::userIsLoggedIn() ? Session::get('user_id') : 0;

        foreach ($rawData as $row) {
            $row = [ $userId, $row['name'], $row['value'] ];
            $insertData .= sprintf('("%s"),', implode( '","', $row) );
        }
        $insertData = rtrim( $insertData, ',' );

        $database = DatabaseFactory::getFactory()->getConnection();
        $result = $database->exec('INSERT INTO csv_data (user_id, name, value) VALUES ' . $insertData);

        return $result !== false;
    }

    /**
     * Returns all data from a table
     * 
     * @return array data table
     */
    public static function getAllData()
    {
        $database = DatabaseFactory::getFactory()->getConnection();
        $data = [];
        $cursor = $database->query('SELECT user_id, name, value FROM csv_data');

        if ( $cursor !== false) {
            $data = $cursor->fetchAll( PDO::FETCH_ASSOC);
            $cursor->closeCursor();
        }

        return $data;
    }

    /**
     * Allows you to check if the table is empty
     * 
     * @return boolean returns true if the table is empty, false if there is data
     */
    public static function empty()
    {
        $database = DatabaseFactory::getFactory()->getConnection();
        $cursor = $database->query('SELECT COUNT(*) FROM csv_data');
        $isEmptyTable = true;

        if ($cursor !== false) {
            $isEmptyTable = intval($cursor->fetchColumn(0)) === 0;
            $cursor->closeCursor();
        }

        return $isEmptyTable;
    }
}
