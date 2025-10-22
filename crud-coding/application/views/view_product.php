<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View_product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>


    <div class="container">
        <div class="row">
            <div class="col-12" style="margin-top:40px;">
                <h2>Products</h2>

                <?php if (isset($this->session) && $this->session->flashdata('inserted')): ?>
                    <div class="alert alert-success"><?php echo $this->session->flashdata('inserted'); ?></div>
                <?php elseif (isset($this->session) && $this->session->flashdata('error')): ?>
                    <div class="alert alert-danger"><?php echo $this->session->flashdata('error'); ?></div>
                <?php endif; ?>

                <?php if (empty($records)): ?>
                    <div class="alert alert-info">No products found.</div>
                <?php else: ?>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>price</th>
                                <th>Registered</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($records as $row): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['id']); ?></td>
                                <td><?php echo htmlspecialchars($row['product_name']); ?></td>
                                <td><?php echo htmlspecialchars($row['product_price']); ?></td>
                                <td><?php echo htmlspecialchars($row['time']); ?></td>
                                <td>
                                    <a href="<?php echo site_url('crud_controller/edit_product/'.$row['id']); ?>" class="btn btn-sm btn-primary">edit</a>
                                    <a href="<?php echo site_url('crud_controller/delete_product/'.$row['id']); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?');">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            </div>
        </div>
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>