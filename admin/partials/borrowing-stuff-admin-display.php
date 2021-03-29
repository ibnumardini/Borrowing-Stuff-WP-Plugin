<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://ibnumardini.id
 * @since      1.0.0
 *
 * @package    Borrowing_Stuff
 * @subpackage Borrowing_Stuff/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="pt-4 pr-3">

    <div class="jumbotron">
        <h1 class="display-4">Hello, <?= $greeting ?> <strong><?=ucfirst(wp_get_current_user()->data->display_name)?></strong></h1>
        <p class="lead">Let's Explore Borrowing Stuff App.</p>
        <hr class="my-4">
        <p class="lead">
            <a class="btn btn-primary" href="<?=get_admin_url()?>admin.php?page=list-borrowing" role="button">Get started</a>
        </p>
    </div>

</div>
