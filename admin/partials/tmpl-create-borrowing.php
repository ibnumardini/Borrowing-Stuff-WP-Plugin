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

    <h3>Create Borrowing</h3>

    <hr>

    <div class="row">
        <div class="col-6">

            <div class="alert alert-<?=(!empty($alert[1])) ? $alert[1] : ''?> mt-2" style="display: <?=(!empty($alert[0])) ? $alert[0] : "none"?>" role="alert">
                <?=(!empty($alert[2])) ? $alert[2] : ''?>
            </div>

            <form method="post">
                <div class="form-group">
                    <label for="name">Borrower</label>
                    <input type="text" class="form-control" id="name" name="borrower" placeholder="Enter borrower">
                </div>
                <div class="form-group">
                    <label for="stuff">Owner</label>
                    <select class="form-control" id="stuff" name="stuff_id">
                        <option>Select Stuff</option>
                        <?php

                        foreach ($stuffs as $key => $stuff) {
                            echo "<option value='$stuff->id'>$stuff->name</option>";
                        }

                        ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary" name="create_borrowing">Create</button>
            </form>
        </div>
    </div>

</div>