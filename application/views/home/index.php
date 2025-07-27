<?php $this->load->view('admin_header', ['title' => 'Manage Home Section']); ?>
<div class="main-content">
    <h1>Manage Home Section</h1>

    <table id="table" class="display">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Content</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($homes as $value): ?>
                <tr>
                    <td><?= $value['id'] ?></td>
                    <td><?= $value['title'] ?></td>
                    <td><?= $value['content'] ?></td>
                    <td>
                        <?php if (!empty($value['background'])): ?>
                            <img src="<?= base_url('assets/uploads/' . $value['background']) ?>" style="height: 40px;">
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="<?= site_url('admin/home_form/' . $value['id']) ?>" 
                        style="display: inline-block; padding: 6px 12px; background-color: #007bff; color: white; text-decoration: none; border-radius: 4px; font-size: 14px;">
                        ✏️ Edit
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
