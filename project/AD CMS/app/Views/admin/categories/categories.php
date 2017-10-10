<div class="table-responsive">
    <table class="table table-bordered table-striped table-hover dataTable categories">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Subcategories</th>
            <th>Created</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
            <?php if ($categories): ?>
                <?php foreach ($categories AS $key => $category): ?>
                    <tr class="<?php echo $category->status == 0 ? 'col-red' : null; ?>" title="<?php echo $category->description ?: null; ?>">
                        <th><?php echo ++$key; ?></th>
                        <td><?php echo ucfirst($category->name); ?></td>
                        <td>
                            <?php if ($subcategories): ?>
                                <ol class="p-l-20">
                                <?php foreach ($subcategories AS $cate): ?>
                                    <?php if ($cate->parent_id == $category->id): ?>
                                        <li class="<?php echo ($cate->status == 0) ? 'col-red' : null; ?>"><?php echo ucfirst($cate->name); ?></li>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                                </ol>
                            <?php endif; ?>
                        </td>
                        <td><?php echo date('d-m-Y', $category->created); ?></td>
                        <td><?php echo $category->status == 1 ? 'Enabled' : 'Disabled'; ?></td>
                        <td class="action">
                            <button type="button" class="btn btn-info waves-effect editButton" title="edit" data-target="<?php echo '/admin/categories/edit/category/'. $category->id; ?>">
                                <i class="material-icons">create</i>
                            </button>
                            <button type="button" class="btn btn-danger waves-effect deleteButton" title="delete" data-target="<?php echo '/admin/categories/remove/'. $category->id; ?>">
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
            <th>Name</th>
            <th>Subcategories</th>
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
        $('.categories').DataTable({
            dom: 'Bfrtilp',
            responsive: true,
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
            aLengthMenu: [[10, 20, 50, -1], [10, 20, 50, "All"]],
        });
    });
</script>