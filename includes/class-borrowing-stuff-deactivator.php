<?php

/**
 * Fired during plugin deactivation
 *
 * @link       https://ibnumardini.id
 * @since      1.0.0
 *
 * @package    Borrowing_Stuff
 * @subpackage Borrowing_Stuff/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Borrowing_Stuff
 * @subpackage Borrowing_Stuff/includes
 * @author     Ibnu Mardini <qodr.ibnumardini@gmail.com>
 */

class Borrowing_Stuff_Deactivator
{

    /**
     * Short Description. (use period)
     *
     * Long Description.
     *
     * @since    1.0.0
     */

    protected $table;

    public function __construct($activator)
    {
        $this->table = $activator;
    }

    public function deactivate()
    {
        global $wpdb;

        $wpdb->query("DROP TABLE IF EXISTS " . $this->table->tbl_stuffs());
        $wpdb->query("DROP TABLE IF EXISTS " . $this->table->tbl_borrowing_transactions());
    }

}
