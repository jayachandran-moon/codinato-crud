<?php defined('BASEPATH') OR exit('No direct script access allowed');



$action = isset($record['id']) ? site_url('crud/update_product/'.$record['id']) : site_url('crud/update_product');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-6" style="margin-top:100px;">
            <h2>Edit Product</h2>

            <?php if (isset($this->session) && $this->session->flashdata('error')): ?>
                <div class="alert alert-danger"><?php echo $this->session->flashdata('error'); ?></div>
            <?php endif; ?>

            <form method="post" action="<?php echo $action; ?>">
                <input type="hidden" name="id" value="<?php echo isset($record['id']) ? (int) $record['id'] : ''; ?>">

                <div class="mb-3">
                    <label for="name" class="form-label">Name:</label>
                    <input type="text" class="form-control" id="name" name="name" required
                           value="<?php echo isset($record['name']) ? html_escape($record['name']) : set_value('name'); ?>">
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" required
                           value="<?php echo isset($record['email']) ? html_escape($record['email']) : set_value('email'); ?>">
                </div>

                <button type="submit" class="btn btn-primary">Save</button>
                <a href="<?php echo site_url('crud/view_product'); ?>" class="btn btn-secondary">Back</a>
            </form>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
