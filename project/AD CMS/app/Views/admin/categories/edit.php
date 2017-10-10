<?php if ($category): ?>
    <?php extract($category); ?>

    <div class="modal fade add-user edit-user" id="edit-user" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-col-cyan">
                <div class="modal-header">
                    <h4 class="modal-title" id="defaultModalLabel"><?php echo $titleModal; ?></h4>
                </div>
                <div class="modal-body">
                    <form class="register-user editCategory" action="<?php echo $actionLink; ?>" method="post">
                        <img class="loading-form" src="<?php echo assets('admin/images/loader.gif'); ?>" alt="Loading..." id="loading-form">
                        <div class="form-body">
                            <div class="row clearfix">
                                <div class="col-sm-6">
                                    <div class="form-group col-sm-12">
                                        <label for="category-name" class="title-input">Category Name</label>
                                        <div class="form-line">
                                            <input required autocomplete="off" name="name" id="category-name" value="<?php echo $name; ?>" type="text" class="form-control" title="Allowed string, digits, whitespace, [#,@,!,*,/,\,+,.,&,^,-,_]">
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-12">
                                        <label for="status" class="title-input">Status</label>
                                        <div class="form-line">
                                            <select name="status" id="status" required>
                                                <option value=1>Enabled</option>
                                                <option value=0 <?php echo !$status ? 'selected' : null; ?>>Disabled</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <?php if ($categories) : ?>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="parentCategory" class="title-input"><?php echo $titleCategories; ?></label>
                                            <div class="form-line">
                                                <ul class="PC">
                                                    <!-- case edit subcategories -->
                                                    <li style="border-bottom: 1px solid rgba(0,0,0,.2)">
                                                        <input type="radio" name="categories" value="0" id="md_checkbox_m" class="with-gap radio-col-purple"/>
                                                        <label for="md_checkbox_m">Make a Parent Category</label>
                                                    </li>
                                                    <?php foreach ($categories AS $key => $cate): ?>
                                                        <li>
                                                            <input type="radio" name="categories" value="<?php echo $cate->id; ?>" id="md_checkbox_<?php echo $key; ?>" class="with-gap radio-col-purple" <?php echo $parent_id == $cate->id ? 'checked' : null; ?>/>
                                                            <label for="md_checkbox_<?php echo $key; ?>"><?php echo $cate->name; ?></label>
                                                        </li>
                                                    <?php endforeach; ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <?php if ($editCategory): ?>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="desc" class="title-input">Category description</label>
                                            <div class="form-line">
                                                <textarea name="description" id="desc" rows="8" class="form-control no-resize editCat"  placeholder="Please type description category..."><?php echo htmlspecialchars_decode($description) ?: null; ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <?php if (!$editCategory) : ?>
                                <div class="row clearfix">
                                    <div class="container-fluid">
                                        <div class="col-xs-12">
                                            <div class="form-group">
                                                <label for="desc" class="title-input">Category description</label>
                                                <div class="form-line">
                                                    <textarea name="description" id="desc" rows="8" class="form-control no-resize"  placeholder="Please type description category..."><?php echo htmlspecialchars_decode($description) ?: null; ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-link waves-effect saveEdit" data-target="editCategory">SAVE CHANGES</button>
                            <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php endif; ?>