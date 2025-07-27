<?php $this->load->view('admin_header', [
    'title' => isset($ecommerce) ? 'Edit Ecommerce Section' : 'Create Ecommerce Section'
]); ?>

<div class="main-content">
    <h2 style="text-align: center; margin-bottom: 20px;">
        <?= isset($ecommerce) ? 'Edit Ecommerce Section' : 'Create New Ecommerce Section' ?>
    </h2>

    <form action="<?= site_url('admin/save_ecommerce' . (isset($ecommerce['id']) ? '/' . $ecommerce['id'] : '')) ?>" method="post" enctype="multipart/form-data">
        <div style="margin-bottom: 20px;">
            <label style="font-weight: bold; display: block; margin-bottom: 8px;">Content File</label>
            <div class="upload-wrapper">
                <!-- Image Preview: Always exists -->
                <img 
                    id="previewImage"
                    src="<?= !empty($ecommerce['filename']) ? base_url('assets/uploads/' . $ecommerce['filename']) : '' ?>"
                    class="upload-preview"
                    alt="Preview Image"
                    style="max-width: 200px; <?= !empty($ecommerce['filename']) ? 'display: block;' : 'display: none;' ?> margin-bottom: 10px;">

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
                <?= isset($ecommerce) ? 'Update' : 'Create' ?>
            </button>
            <a href="<?= site_url('admin/save_ecommerce') ?>" style="margin-left: 15px; padding: 10px 20px; background-color: #6c757d; color: white; text-decoration: none; border-radius: 4px;">Cancel</a>
        </div>
    </form>
</div>
