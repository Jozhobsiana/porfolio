<?php $this->load->view('admin_header', [
    'title' => isset($tarpaulin) ? 'Edit Tarpaulin Section' : 'Create Tarpaulin Section'
]); ?>

<div class="main-content">
    <h2 style="text-align: center; margin-bottom: 20px;">
        <?= isset($tarpaulin) ? 'Edit Tarpaulin Section' : 'Create New Tarpaulin Section' ?>
    </h2>

    <form action="<?= site_url('admin/save_tarpaulin' . (isset($tarpaulin['id']) ? '/' . $tarpaulin['id'] : '')) ?>" method="post" enctype="multipart/form-data">
        <div style="margin-bottom: 20px;">
            <label style="font-weight: bold; display: block; margin-bottom: 8px;">Content File</label>
            <div class="upload-wrapper">
                <!-- Image Preview: Always exists -->
                <img 
                    id="previewImage"
                    src="<?= !empty($tarpaulin['filename']) ? base_url('assets/uploads/' . $tarpaulin['filename']) : '' ?>"
                    class="upload-preview"
                    alt="Preview Image"
                    style="max-width: 200px; <?= !empty($tarpaulin['filename']) ? 'display: block;' : 'display: none;' ?> margin-bottom: 10px;">

                <label for="background" class="custom-file-upload">📁 Choose File</label>
                <input 
                    type="file" 
                    name="media" 
                    id="background" 
                    accept="image/*" 
                    onchange="previewFile()">
            </div>
        </div>

        <div style="text-align: center; margin-top: 25px;">
            <button type="submit" style="padding: 10px 20px; background-color: #007bff; border: none; color: white; border-radius: 4px; cursor: pointer;">
                <?= isset($tarpaulin) ? 'Update' : 'Create' ?>
            </button>
            <a href="<?= site_url('admin/save_tarpaulin') ?>" style="margin-left: 15px; padding: 10px 20px; background-color: #6c757d; color: white; text-decoration: none; border-radius: 4px;">Cancel</a>
        </div>
    </form>
</div>
