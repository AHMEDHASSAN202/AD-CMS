<div class="table-responsive">
    <table class="table table-bordered table-striped table-hover dataTable users">
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
        <?php if (isset($users)) : ?>
            <?php foreach ($users AS $key => $user): ?>
                <tr>
                    <th><?php echo ++$key; ?></th>
                    <td><img src="<?php echo url($user->image); ?>" alt="image"></td>
                    <td>
                        <?php echo ucfirst($user->first_name .' '.$user->last_name); ?>
                        <?php if ($user->users_group_id > 0) : ?>
                            <span class="pre"><?php echo $user->permission; ?></span>
                        <?php endif; ?>
                    </td>
                    <td><?php echo $user->email; ?></td>
                    <td><?php echo $user->gender == 0 ? 'Female' : 'Male'; ?></td>
                    <td><?php echo $user->status == 0 ? 'Disabled' : 'Enabled'; ?></td>
                    <td class="action">
                        <button type="button" class="btn btn-info waves-effect editButton" title="edit" data-target="<?php echo url('admin/users/edit/'.$user->idUser); ?>">
                            <i class="material-icons">create</i>
                        </button>
                        <button type="button" class="btn btn-danger waves-effect deleteButton" title="remove" data-target="<?php echo url('admin/users/remove/'.$user->idUser); ?>">
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
        $('.users').DataTable({
            dom: 'Bfrtilp',
            responsive: true,
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
            aLengthMenu: [[10, 20, 50, -1], [10, 20, 50, "All"]],
        });
    });
</script>