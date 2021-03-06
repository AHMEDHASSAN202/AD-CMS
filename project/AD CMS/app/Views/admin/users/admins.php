<div class="table-responsive">
    <table class="table table-bordered table-striped table-hover dataTable admins">
        <thead>
        <tr>
            <th>ID</th>
            <th>Image</th>
            <th>Username</th>
            <th>Email</th>
            <th>Gender</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        </thead>
        <tfoot>
        <tr>
            <th>ID</th>
            <th>Image</th>
            <th>Username</th>
            <th>Email</th>
            <th>Gender</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        </tfoot>
        <tbody>
        <?php if (isset($admins)) : ?>
            <?php foreach ($admins AS $key => $admin): ?>
                <tr>
                    <th><?php echo ++$key; ?></th>
                    <td><img src="<?php echo url($admin->image); ?>" alt="image"></td>
                    <td>
                        <?php echo ucfirst($admin->first_name .' '.$admin->last_name); ?>
                        <?php if ($admin->users_group_id > 0) : ?>
                            <span class="pre"><?php echo $admin->permission; ?></span>
                        <?php endif; ?>
                    </td>
                    <td><?php echo $admin->email; ?></td>
                    <td><?php echo $admin->gender == 0 ? 'Female' : 'Male'; ?></td>
                    <td><?php echo $admin->status == 0 ? 'Disabled' : 'Enabled'; ?></td>
                    <td class="action">
                        <button type="button" class="btn btn-info waves-effect editButton" title="edit" data-target="<?php echo url('admin/users/edit/'.$admin->idUser); ?>">
                            <i class="material-icons">create</i>
                        </button>
                        <button type="button" class="btn btn-danger waves-effect deleteButton" title="remove" data-target="<?php echo url('admin/users/remove/'.$admin->idUser); ?>">
                            <i class="material-icons">delete</i>
                        </button>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
    </table>
</div>

<script>
    $(function () {

        //Exportable table
        $('.admins').DataTable({
            dom: 'Bfrtilp',
            responsive: true,
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
            aLengthMenu: [[10, 20, 50, -1], [10, 20, 50, "All"]],
        });
    });
</script>