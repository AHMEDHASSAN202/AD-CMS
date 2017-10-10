<form action="<?php echo $action; ?>" method="post" class="m-t-40 formAj category-form">
    <img class="loading-form" src="<?php echo assets('admin/images/loader.gif'); ?>" alt="Loading..." id="loading-form">
    <div class="row clearfix">
        <div class="col-sm-12">
            <div class="form-group">
                <label for="category-name" class="title-input">Category Name</label>
                <div class="form-line">
                    <input required autocomplete="off" name="name" id="category-name" type="text" class="form-control" title="Allowed string, digits, whitespace, [#,@,!,*,/,\,+,.,&,^,-,_]">
                </div>
            </div>
        </div>
    </div>
    <div class="row clearfix">
        <div class="col-sm-6">
            <div class="form-group">
                <label for="desc" class="title-input">Category description</label>
                <div class="form-line">
                    <textarea name="description" id="desc" rows="8" class="form-control no-resize"  placeholder="Please type description category..."></textarea>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="parentCategory" class="title-input">Parent Category</label>
                    <div class="form-line">
                        <select name="parentCategory" id="parentCategory" required>
                            <option value="0" selected>---- Main Category ----</option>
                            <?php if ($categories): ?>
                                <?php foreach ($categories AS $key => $category): ?>
                                    <option value=<?php echo $category->id; ?>><?php echo ucfirst($category->name); ?></option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="status" class="title-input">Status</label>
                    <div class="form-line">
                        <select name="status" id="status" required>
                            <option value=1>Enabled</option>
                            <option value=0>Disabled</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row clearfix">
        <div class="col-xs-12">
            <button type="submit" class="btn btn-primary m-t-15 waves-effect col-sm-2 col-xs-12 font-bold">ADD</button>
        </div>
    </div>
</form>


<script>
    $(document).ready(function() {

        //On focus event
        $('.form-control').focus(function () {
            $(this).parent().addClass('focused');
        });

        //On focusout event
        $('.form-control').focusout(function () {
            var $this = $(this);
            if ($this.parents('.form-group').hasClass('form-float')) {
                if ($this.val() == '') { $this.parents('.form-line').removeClass('focused'); }
            }
            else {
                $this.parents('.form-line').removeClass('focused');
            }
        });

        //On label click
        $('body').on('click', '.form-float .form-line .form-label', function () {
            $(this).parent().find('input').focus();
        });

        //Not blank form
        $('.form-control').each(function () {
            if ($(this).val() !== '') {
                $(this).parents('.form-line').addClass('focused');
            }
        });

    });
</script>