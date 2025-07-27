<?php $this->load->view('admin_header', ['title' => isset($about_me) ? 'Edit About Me Section' : 'Create About Me Section']); ?>

<div class="main-content">
    <h2 style="text-align: center; margin-bottom: 20px;">
        <?= isset($about_me) ? 'Edit About Me Section' : 'Create New About Me Section' ?>
    </h2>

    <form action="<?= site_url('admin/update_about_me/' .@$about_me['id']) ?>" method="post" enctype="multipart/form-data">
    <div style="margin-bottom: 20px;">
        <label style="font-weight: bold; display: block; margin-bottom: 8px;">Image</label>
        <div class="upload-wrapper">
            <img id="previewImage" 
                src="<?= !empty($about_me['background']) ? base_url('assets/uploads/' . $about_me['background']) : '' ?>" 
                class="upload-preview"
                alt="Preview Image"
                onerror="this.style.display='none'">

            <label for="background" class="custom-file-upload">📁 Choose Image</label>
            <input type="file" name="background" id="background" accept="image/*" onchange="previewFile()">
        </div>
    </div>
        
        <div style="margin-bottom: 15px;">
            <label for="content" style="display: block; font-weight: bold; margin-bottom: 5px;">Content</label>
            <textarea name="content" id="about_me_form" rows="6" required style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;"><?= @$about_me['content'] ?></textarea>

        </div>

        <div style="text-align: center; margin-top: 25px;">
            <button type="submit" style="padding: 10px 20px; background-color: #007bff; border: none; color: white; border-radius: 4px; cursor: pointer;">
                <?= isset($about_me) ? 'Update' : 'Create' ?>
            </button>
            <a href="<?= site_url('admin/about_me_index') ?>" style="margin-left: 15px; padding: 10px 20px; background-color: #6c757d; color: white; text-decoration: none; border-radius: 4px;">Cancel</a>
        </div>
    </form>
</div>

</body>
</html>
