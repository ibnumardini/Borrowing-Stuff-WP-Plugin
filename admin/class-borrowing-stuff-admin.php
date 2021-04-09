<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://ibnumardini.id
 * @since      1.0.0
 *
 * @package    Borrowing_Stuff
 * @subpackage Borrowing_Stuff/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Borrowing_Stuff
 * @subpackage Borrowing_Stuff/admin
 * @author     Ibnu Mardini <qodr.ibnumardini@gmail.com>
 */
class Borrowing_Stuff_Admin
{

    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $plugin_name    The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $version    The current version of this plugin.
     */
    private $version;

    private $activator;

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     * @param      string    $plugin_name       The name of this plugin.
     * @param      string    $version    The version of this plugin.
     */
    public function __construct($plugin_name, $version)
    {

        $this->plugin_name = $plugin_name;
        $this->version = $version;

        require_once BORROWING_STUFF_PLUGIN_PATH . 'includes/class-borrowing-stuff-activator.php';

        $this->activator = new Borrowing_Stuff_Activator();

    }

    /**
     * Register the stylesheets for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_styles()
    {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Borrowing_Stuff_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Borrowing_Stuff_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        $valid_page = ["borrowing-stuff", "borrowing-stuff", "create-stuff", "list-stuff", "create-borrowing", "list-borrowing"];

        $page = (isset($_REQUEST['page'])) ? isset($_REQUEST['page']) : "";

        if (in_array($page, $valid_page)) {
            wp_enqueue_style($this->plugin_name . "-bootstrap", BORROWING_STUFF_PLUGIN_URL . 'assets/css/bootstrap.min.css', array(), $this->version, 'all');
            wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/borrowing-stuff-admin.css', array(), $this->version, false);
        }

    }

    /**
     * Register the JavaScript for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts()
    {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Borrowing_Stuff_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Borrowing_Stuff_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        $valid_page = ["borrowing-stuff", "borrowing-stuff", "create-stuff", "list-stuff", "create-borrowing", "list-borrowing"];

        $page = (isset($_REQUEST['page'])) ? isset($_REQUEST['page']) : "";

        if (in_array($page, $valid_page)) {
            wp_enqueue_script($this->plugin_name . "-bootstrap", BORROWING_STUFF_PLUGIN_URL . 'assets/js/bootstrap.min.js', array(), $this->version, 'all');
            wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/borrowing-stuff-admin.js', array('jquery'), $this->version, false);
        }

    }

    public function borrowing_stuff_admin_menu()
    {
        add_menu_page("Borrowing Stuff", "Borrowing Stuff", "manage_options", "borrowing-stuff", [$this, "borrowing_stuff_index"], 'dashicons-cart', 4);
        add_submenu_page("borrowing-stuff", "Stuff Dashboard", "Stuff Dashboard", "manage_options", "borrowing-stuff", [$this, "borrowing_stuff_index"]);
        add_submenu_page("borrowing-stuff", "Create Stuff", "Create Stuff", "manage_options", "create-stuff", [$this, "create_stuff"]);
        add_submenu_page("borrowing-stuff", "List Stuff", "List Stuff", "manage_options", "list-stuff", [$this, "list_stuff"]);
        add_submenu_page("borrowing-stuff", "Create Borrowing", "Create Borrowing", "manage_options", "create-borrowing", [$this, "create_borrowing"]);
        add_submenu_page("borrowing-stuff", "List Borrowing", "List Borrowing", "manage_options", "list-borrowing", [$this, "list_borrowing"]);
    }

    public function borrowing_stuff_index()
    {

        $greeting = "";

        date_default_timezone_set('Asia/Jakarta');

        $hour = date('G');

        if ($hour >= 5 && $hour <= 11) {
            $greeting = "Good Morning";
        } else if ($hour >= 12 && $hour <= 18) {
            $greeting = "Good Afternoon";
        } else if ($hour >= 19 || $hour <= 4) {
            $greeting = "Good Evening";
        }

        ob_start();

        include_once BORROWING_STUFF_PLUGIN_PATH . "/admin/partials/borrowing-stuff-admin-display.php";

        $template = ob_get_contents();
        ob_clean();

        echo $template;
    }

    public function create_stuff()
    {

        global $wpdb;

        $alert = [];

        if (isset($_POST['create_stuff'])) {

            $name = trim(htmlspecialchars($_POST['name']));
            $desc = trim(htmlspecialchars($_POST['desc']));
            $owner = trim(htmlspecialchars($_POST['owner']));

            if ($name != "" && $desc != "" && $owner != "") {

                $wpdb->insert($this->activator->tbl_stuffs(), [
                    'name' => $name,
                    'desc' => $desc,
                    'owner' => $owner,
                ]);

                if ($wpdb->insert_id) {
                    $alert = ['block', 'success', 'Stuff Created'];
                } else {
                    $alert = ['block', 'danger', 'Stuff Failed to Created'];
                }

            } else {

                $alert = ['block', 'danger', 'Stuff Failed to Created'];
            }
        };

        ob_start();

        include_once BORROWING_STUFF_PLUGIN_PATH . "/admin/partials/tmpl-create-stuff.php";

        $template = ob_get_contents();
        ob_clean();

        echo $template;
    }

    public function list_stuff()
    {

        global $wpdb;

        $stuffs = $wpdb->get_results("SELECT * FROM " . $this->activator->tbl_stuffs() . " ORDER BY created_at DESC");

        ob_start();

        include_once BORROWING_STUFF_PLUGIN_PATH . "/admin/partials/tmpl-list-stuff.php";

        $template = ob_get_contents();
        ob_clean();

        echo $template;
    }

    public function create_borrowing()
    {

        global $wpdb;

        $stuffs = $wpdb->get_results( "SELECT * FROM " . $this->activator->tbl_stuffs() . " ORDER BY created_at DESC");

        if (isset($_POST['create_borrowing'])) {

            $borrower = trim(htmlspecialchars($_POST['borrower']));
            $stuff_id = trim(htmlspecialchars($_POST['stuff_id']));

            if ($borrower != "" && $stuff_id != "Select Stuff") {

                $wpdb->insert($this->activator->tbl_borrowing_transactions(), [
                    'borrower' => $borrower,
                    'stuff_id' => $stuff_id,
                ]);

                if ($wpdb->insert_id) {
                    $alert = ['block', 'success', 'Borrowing Created'];
                } else {
                    $alert = ['block', 'danger', 'Borrowing Failed to Created'];
                }

            } else {

                $alert = ['block', 'danger', 'Borrowing Failed to Created'];
            }

        }

        ob_start();

        include_once BORROWING_STUFF_PLUGIN_PATH . "/admin/partials/tmpl-create-borrowing.php";

        $template = ob_get_contents();
        ob_clean();

        echo $template;
    }

    public function list_borrowing()
    {

        global $wpdb;

        if (isset($_GET['action'])) {
            if ($_GET['action'] == "edit-borrowing") {

                $stuffs = $wpdb->get_results( "SELECT * FROM " . $this->activator->tbl_stuffs() . " ORDER BY created_at DESC");

                $borrowed = $this->edit_borrowing();
            } else if ($_GET['action'] == "delete-borrowing") {

                $id = trim(htmlspecialchars($_GET['id']));

                $delete_borrowing = $wpdb->delete($this->activator->tbl_borrowing_transactions(), ["id" => $id]);

                if ($delete_borrowing > 0) {
                    $alert = ['block', 'success', 'Borrowing Deleted'];
                } else {
                    $alert = ['block', 'danger', 'Borrowing Failed to Deleted'];
                }

            }
        }

        $borrowing = $wpdb->get_results( "SELECT b.id, borrower, s.name as stuff FROM " . $this->activator->tbl_borrowing_transactions() . " as b LEFT JOIN " . $this->activator->tbl_stuffs() . " as s ON s.id = b.stuff_id ORDER BY b.created_at DESC");

        ob_start();

        include_once BORROWING_STUFF_PLUGIN_PATH . "/admin/partials/tmpl-list-borrowing.php";

        $template = ob_get_contents();
        ob_clean();

        echo $template;

    }

    public function edit_borrowing()
    {

        global $wpdb;

        $id = $_GET['id'];

        $borrowed = $wpdb->get_row("SELECT * FROM " . $this->activator->tbl_borrowing_transactions() . " WHERE id = " . $id);

        return $borrowed;
    }

    public function edit_stuff($id)
    {
        global $wpdb;

        $stuff = $wpdb->get_row("SELECT * FROM " . $this->activator->tbl_stuffs() . " WHERE id = " . $id);

        return $stuff;
    }

    public function handle_ajax_admin_requests()
    {
        global $wpdb;

        $param = (isset($_REQUEST['param']) ? $_REQUEST['param'] : "");

        if (!empty($param)) {
            if ($param == "store_borrowing") {

                $id = trim(htmlspecialchars($_POST['borrowing_id']));
                $borrower = trim(htmlspecialchars($_POST['borrower']));
                $stuff_id = trim(htmlspecialchars($_POST['stuff_id']));

                if ($id != "" && $borrower != "" && ($stuff_id != "" || $stuff_id != "Select Stuff")) {

                    $update_borrowing = $wpdb->update($this->activator->tbl_borrowing_transactions(), [
                        'borrower' => $borrower,
                        'stuff_id' => $stuff_id,
                    ], ['id' => $id]);

                    if ($update_borrowing > 0) {
                        echo json_encode(['status' => true]);
                    } else {
                        echo json_encode(['status' => false]);
                    }

                } else {
                    echo json_encode(['status' => false]);
                }

            } else if ($param == "edit_stuff") {

                $id = trim(htmlspecialchars($_POST['id']));

                $stuff = $this->edit_stuff($id);

                echo json_encode($stuff);

            } else if ($param == "store_edit_stuff") {

                $id = trim(htmlspecialchars($_POST['data'][0]));
                $name = trim(htmlspecialchars($_POST['data'][1]));
                $desc = trim(htmlspecialchars($_POST['data'][2]));
                $owner = trim(htmlspecialchars($_POST['data'][3]));

                $store_stuff = $wpdb->update($this->activator->tbl_stuffs(), [
                    "name" => $name,
                    "desc" => $desc,
                    "owner" => $owner,
                ], ["id" => $id]);

                if ($store_stuff > 0) {
                    echo json_encode(["status" => true]);
                } else {
                    echo json_encode(["status" => false]);
                }
            } else if ($param == "delete_stuff") {

                $id = trim(htmlspecialchars($_POST['id']));

                $delete_stuff = $wpdb->delete($this->activator->tbl_stuffs(), ["id" => $id]);

                if ($delete_stuff > 0) {
                    echo json_encode(["status" => true]);
                } else {
                    echo json_encode(["status" => false]);
                }
            } else if ($param == "get_borrowing") {

                $id = trim(htmlspecialchars($_POST['id']));

                $borrowing = $wpdb->get_results( "SELECT b.id, borrower, s.name as stuff, s.desc as stuff_desc FROM " . $this->activator->tbl_borrowing_transactions() . " as b LEFT JOIN " . $this->activator->tbl_stuffs() . " as s ON s.id = b.stuff_id WHERE b.id = $id");

                echo json_encode($borrowing[0]);
            } else if ($param == "get_stuff") {

                $id = trim(htmlspecialchars($_POST['id']));

                echo json_encode($this->edit_stuff($id));
            }
        }

        wp_die();
    }

}
