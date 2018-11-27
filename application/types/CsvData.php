<?php

/**
 * Stores data obtained from a csv file
 */
class CsvData
{
    /** @var array an array of arrays in which the subarray contains the data of a single csv string */
    private $data = [];

    /**
     * Adds a new data row
     * 
     * @param string $name field name
     * @param integer|float|string|boolean $value field value
     * 
     * @return bool success status
     */
    public function addRow($name, $value)
    {
        if ( is_string($name) === false || is_scalar($value) === false ) {
            return false;
        }

        $this->data[] = [ 
            'name' => $name, 
            'value' => $value 
        ];

        return true;
    }

    /**
     * Returns all data stored
     * 
     * @return array all data stored
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Allows you to check whether there is data
     * 
     * @return boolean returns true if there is no data, false if there is data
     */
    public function empty()
    {
        return empty($this->data);
    }
}