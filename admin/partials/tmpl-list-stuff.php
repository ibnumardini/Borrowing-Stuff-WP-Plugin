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

    <div class="row">
        <div class="col-12">

            <h3>All Stuff</h3>

            <hr>

            <div class="alert alert-success alert-stuff-deleted-success" style="display: none ">Stuff Deleted</div>
            <div class="alert alert-danger alert-stuff-deleted-failed" style="display: none ">Stuff Failed to Deleted</div>

            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                    <th scope="col" style="width: 2%" class="text-center">No</th>
                    <th scope="col" style="width: 10%">Name Stuff</th>
                    <th scope="col" style="width: 20%">Description</th>
                    <th scope="col" style="width: 10%">Owner</th>
                    <th scope="col" style="width: 7%" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    
                    <?php
                    
                    if (count($stuffs) <= 0) {
                        echo '<tr>
                                <td colspan="5" class="text-center">Stuff is Empty!</td>
                            </tr>';
                    }

                    $no = 1;foreach ($stuffs as $key => $stuff): ?>
                            <tr>
                                <th scope="row" class="text-center"><?=$no?></th>
                                <td><?=$stuff->name?></td>
                                <td><?= substr($stuff->desc, 0, 200) ?></td>
                                <td><?=$stuff->owner?></td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-info btn-detail-stuff" data-toggle="modal" data-target="#detail-stuff-modal" data-id="<?= $stuff->id ?>">Detail</button>
                                    <button type="button" class="btn btn-warning btn-edit-stuff" data-toggle="modal" data-target="#edit-stuff" data-id="<?= $stuff->id ?>">Edit</button>
                                    <button type="button" class="btn btn-danger btn-delete-stuff" data-id="<?= $stuff->id ?>">Delete</button>
                                </td>
                            </tr>
                        <?php $no++;endforeach;?>
                </tbody>
            </table>
        </div>
    </div>

</div>

<div class="modal fade mt-3" id="edit-stuff" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="edit-stuff-title"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="alert alert-success alert-stuff-success" style="display: none">Stuff Edited</div>
      <div class="alert alert-danger alert-stuff-failed" style="display: none">Stuff Failed to Edited</div>
        <form method="post" id="edit-stuff-form">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="edit-stuff-name" name="name" placeholder="Enter name">
            </div>
            <div class="form-group">
                <label for="desc">Description</label>
                <textarea name="desc" class="form-control" cols="30" rows="10" id="edit-stuff-desc" name="desc" spellcheck="false"></textarea>
            </div>
            <div class="form-group">
                <label for="owner">Owner</label>
                <input type="text" class="form-control" id="edit-stuff-owner" name="owner" placeholder="Enter owner">
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="edit-stuff-store">Save</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade mt-3" id="detail-stuff-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="detail-stuff-title"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <table class="table table-bordered">
      <thead>
        <tr>
            <th>Stuff</th>
            <th>Desc Stuff</th>
            <th>Owner</th>
        </tr>
      </thead>
        <tbody>
            <tr>
                <td id="detail-stuff-list"></td>
                <td id="detail-stuff-desc-list"></td>
                <td id="detail-stuff-owner"></td>
            </tr>
        </tbody>
        </table>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
