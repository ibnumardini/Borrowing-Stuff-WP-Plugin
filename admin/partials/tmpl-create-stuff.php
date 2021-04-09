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

    <h3>Create Stuff</h3>

    <hr>

    <div class="row">
        <div class="col-6">

            <div class="alert alert-<?=(!empty($alert[1])) ? $alert[1] : ''?> mt-2" style="display: <?=(!empty($alert[0])) ? $alert[0] : "none"?>" role="alert">
                <?=(!empty($alert[2])) ? $alert[2] : ''?>
            </div>

            <form method="post">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter name">
                </div>
                <div class="form-group">
                    <label for="desc">Description</label>
                    <textarea name="desc" class="form-control" cols="30" rows="10" name="desc"></textarea>
                </div>
                <div class="form-group">
                    <label for="owner">Owner</label>
                    <input type="text" class="form-control" id="owner" name="owner" placeholder="Enter owner">
                </div>
                <button type="submit" name="create_stuff" class="btn btn-primary">Create</button>
            </form>
        </div>
    </div>

</div>
