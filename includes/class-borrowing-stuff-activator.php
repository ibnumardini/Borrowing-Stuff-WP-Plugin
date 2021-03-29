<?php

/**
 * Fired during plugin activation
 *
 * @link       https://ibnumardini.id
 * @since      1.0.0
 *
 * @package    Borrowing_Stuff
 * @subpackage Borrowing_Stuff/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Borrowing_Stuff
 * @subpackage Borrowing_Stuff/includes
 * @author     Ibnu Mardini <qodr.ibnumardini@gmail.com>
 */
class Borrowing_Stuff_Activator
{

    /**
     * Short Description. (use period)
     *
     * Long Description.
     *
     * @since    1.0.0
     */
    public function activate()
    {
        global $wpdb;

        require_once ABSPATH . 'wp-admin/includes/upgrade.php';

        $check_db_stuffs = "SHOW TABLES LIKE '%" . $this->tbl_stuffs() . "%'";

        if ($check_db_stuffs != $this->tbl_stuffs()) {

            $query_stuffs = "CREATE TABLE `" . $this->tbl_stuffs() . "` (
			`id` int(11) NOT NULL AUTO_INCREMENT,
			`name` varchar(255) NOT NULL,
			`desc` text NULL,
			`owner` varchar(255) NOT NULL,
			`created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
			PRIMARY KEY (`id`)
		   ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";

            dbDelta($query_stuffs);
        }

        $check_db_borrowing_transactions = "SHOW TABLES LIKE '%" . $this->tbl_borrowing_transactions() . "%'";

        if ($check_db_borrowing_transactions != $this->tbl_borrowing_transactions()) {

            $query_borrowing_transactions = "CREATE TABLE `" . $this->tbl_borrowing_transactions() . "` (
			`id` int(11) NOT NULL AUTO_INCREMENT,
			`borrower` varchar(255) NOT NULL,
			`stuff_id` int(11) NOT NULL,
			`created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
			PRIMARY KEY (`id`)
		   ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";

            dbDelta($query_borrowing_transactions);
        }
    }

    public function tbl_stuffs()
    {
        return $this->get_db_prefix() . "woowa_stuffs";
    }

    public function tbl_borrowing_transactions()
    {
        return $this->get_db_prefix() . "woowa_borrowing_transactions";
    }

    public function get_db_prefix()
    {
        global $wpdb;

        return $wpdb->prefix;
    }
}
