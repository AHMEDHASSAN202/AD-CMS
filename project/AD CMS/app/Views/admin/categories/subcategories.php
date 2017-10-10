<div class="table-responsive">
    <table class="table table-bordered table-striped table-hover dataTable subcategories">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Category</th>
            <th>Created</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php if ($subcategories): ?>
            <?php foreach ($subcategories AS $key => $category): ?>
                <tr class="<?php echo $category->status == 0 ? 'col-red' : null; ?>" title="<?php echo $category->description ?: null; ?>">
                    <th><?php echo $key++; ?></th>
                    <td><?php echo ucfirst($category->name); ?></td>
                    <td>
                        <?php if ($categories): ?>
                            <?php foreach ($categories AS $cate): ?>
                                <?php if ($category->parent_id == $cate->id): ?>
                                    <normal class="<?php echo $cate->status == 0 ? 'col-red' : null;?>"><?php echo ucfirst($cate->name); ?><span class="font-11 m-l-5 m-t-5"><?php echo $cate->status == 0 ? ' [ is disabled ]' : null; ?></span></normal>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </td>
                    <td><?php echo date('d-m-Y', $category->created); ?></td>
                    <td><?php echo $category->status == 1 ? 'Enabled' : 'Disabled'; ?></td>
                    <td class="action">
                        <button type="button" class="btn btn-info waves-effect editButton" title="edit" data-target="<?php echo '/admin/categories/edit/subcategory/'. $category->id; ?>">
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
        $('.subcategories').DataTable({
            dom: 'Bfrtilp',
            responsive: true,
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
            aLengthMenu: [[10, 20, 50, -1], [10, 20, 50, "All"]],
        });
    });
</script>