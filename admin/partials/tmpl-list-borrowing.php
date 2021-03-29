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

<div id="card-edit-borrowing">
    <?php if(isset($_GET['action']) && $_GET['action'] == "edit-borrowing") { ?>
        
        <h3>Edit <?= $borrowed->borrower ?></h3>

        <hr>

        <div class="row">
            <div class="col-6 mb-4">

                <div class="alert alert-success mt-2 alert-borrowing-success" style="display: none" role="alert">Borrowing Updated</div>
                <div class="alert alert-danger mt-2 alert-borrowing-danger" style="display: none" role="alert">Borrowing Failed to Updated</div>

                <form method="post" id="edit_borrowing">
                    <div class="form-group">
                        <label for="name">Borrower</label>
                        <input type="text" class="form-control" id="name" name="borrower" placeholder="Enter borrower" value="<?= $borrowed->borrower ?>">
                    </div>
                    <div class="form-group">
                        <label for="stuff">Owner</label>
                        <select class="form-control" id="stuff" name="stuff_id">
                            <option>Select Stuff</option>
                            <?php

                                foreach ($stuffs as $key => $stuff) {

                                    $active = ($stuff->id == $borrowed->stuff_id) ? "selected" : "";

                                    echo "<option value='$stuff->id' $active >$stuff->name</option>";
                                }

                            ?>
                        </select>
                    </div>
                    <input type="hidden" name="borrowing_id" value="<?= $borrowed->id ?>">
                    <button type="submit" class="btn btn-primary btn-edit-borrowing" name="store_edit_borrowing">Save</button>
                </form>
            </div>
        </div>

    <?php } ?>
</div>

    <div class="row">
        <div class="col-12">


            <h3>All Borrowing</h3>

            <hr>
            <div class="alert alert-<?=$alert[1]?> mt-2" style="display: <?= ($alert[0]) ? $alert[0] : "none" ?>" role="alert">
                <?=$alert[2]?>
            </div>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                    <th scope="col" style="width: 1%; text-align: center;">No</th>
                    <th scope="col" style="width: 20%">Name Borrower</th>
                    <th scope="col" style="width: 20%">Stuff</th>
                    <th scope="col" style="width: 7%; text-align: center;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    if (count($borrowing) <= 0) {
                        echo '<tr>
                                <td colspan="5" class="text-center">Borrowing is Empty!</td>
                            </tr>';
                    }

                    $no = 1; foreach ($borrowing as $key => $borrow) {
                            ?>
                            
                            <tr>
                                <th scope="row" class="text-center"><?= $no ?></th>
                                <td><?= $borrow->borrower ?></td>
                                <td><?= $borrow->stuff ?></td>
                                <td class="text-center">
                                    <button data-id="<?= $borrow->id ?>" class="btn btn-info btn-borrowing-detail" data-toggle="modal" data-target="#detail-borrowing">Detail</button>
                                    <a href="admin.php?page=list-borrowing&action=edit-borrowing&&id=<?= $borrow->id ?>" class="btn btn-warning">Edit</a>
                                    <a href="admin.php?page=list-borrowing&action=delete-borrowing&&id=<?= $borrow->id ?>" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>

                            <?php
                    $no++; } ?>
                </tbody>
            </table>
        </div>
    </div>

</div>

<div class="modal fade mt-3" id="detail-borrowing" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="detail-borrowing-title"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <table class="table table-bordered">
      <thead>
        <tr>
            <th>Borrower</th>
            <th>Stuff</th>
            <th>Desc Stuff</th>
        </tr>
      </thead>
        <tbody>
            <tr>
                <td id="detail-borrower"></td>
                <td id="detail-stuff"></td>
                <td id="detail-stuff-desc"></td>
            </tr>
        </tbody>
        </table>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
