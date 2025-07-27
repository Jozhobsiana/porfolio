<?php $this->load->view('admin_header', ['title' => 'Manage About Me Section']); ?>
<div class="main-content">
    <h1>Manage About Me Section</h1>

    <table id="table" class="display">
        <thead>
            <tr>
                <th>ID</th>
                <th>Content</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($about_me as $value): ?>
                <tr>
                    <td><?= $value['id'] ?></td>
                    <td><?= $value['content'] ?></td>
                    <td>
                        <?php if (!empty($value['background'])): ?>
                            <img src="<?= base_url('assets/uploads/' . $value['background']) ?>" style="height: 40px;">
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="<?= site_url('admin/about_me_form/' . $value['id']) ?>" 
                        style="display: inline-block; padding: 6px 12px; background-color: #007bff; color: white; text-decoration: none; border-radius: 4px; font-size: 14px;">
                        ✏️ Edit
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
