<div class="table-responsive">
    <table class="table table-bordered table-striped table-hover dataTable">
        <thead>
        <tr>
            <th>ID</th>
            <th>Author</th>
            <th>Category</th>
            <th>Title</th>
            <th>Image</th>
            <th>Created</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php if (isset($posts)) :?>
            <?php foreach ($posts AS $key => $post): ?>
                <tr>
                    <th><?php echo ++$key; ?></th>
                    <td><?php echo $post->username; ?></td>
                    <td><?php echo ucfirst($post->categoryName); ?></td>
                    <td><?php echo $post->title; ?></td>
                    <td><img src="<?php echo url($post->image); ?>" </td>
                    <td><?php echo date('d-m-Y', $post->created); ?></td>
                    <td><?php echo $post->status == 0 ? 'Disabled' : 'Enabled'; ?></td>
                    <td class="action">
                        <button type="button" class="btn bg-cyan waves-effect modal-button viewButton" title="view" data-target="<?php echo url('admin/posts/view/'.$post->id); ?>">
                            <i class="material-icons">remove_red_eye</i>
                        </button>
                        <button type="button" class="btn btn-info waves-effect modal-button editButton" title="edit" data-target="<?php echo url('admin/posts/edit/'.$post->id); ?>">
                            <i class="material-icons">create</i>
                        </button>
                        <button type="button" class="btn btn-danger waves-effect deleteButton" title="remove" data-target="<?php echo url('admin/posts/remove/'.$post->id); ?>">
                            <i class="material-icons">delete</i>
                        </button>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
        <tfoot>
        <tr>
            <th>ID</th>
            <th>Author</th>
            <th>Category</th>
            <th>Title</th>
            <th>Image</th>
            <th>Created</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        </tfoot>
    </table>
</div>

<script>
    $(function () {

        //Exportable table
        $('.dataTable').DataTable({
            dom: 'Bfrtilp',
            responsive: true,
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
            aLengthMenu: [[10, 20, 50, -1], [10, 20, 50, "All"]],
        });
    });
</script>