<!-- default Size -->
<div class="modal fade" id="modal-section" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="defaultModalLabel"><?php echo 'Edit '.html_entity_decode($post->title) . ' Post'; ?></h4>
            </div>
            <div class="modal-body">
                <form action="<?php echo $action; ?>" method="post" class="m-t-40 formAj posts" enctype="multipart/form-data">
                    <img class="loading-form" src="<?php echo assets('admin/images/loader.gif'); ?>" alt="Loading..." id="loading-form">
                    <div class="row clearfix">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="title" class="title-input">Post Title</label>
                                <div class="form-line">
                                    <input value="<?php echo html_entity_decode($post->title); ?>" required autocomplete="off" name="title" id="title" type="text" class="form-control" title="Allowed string, digits, whitespace, [#,@,!,*,/,\,+,.,&,^,-,_]">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="category" class="title-input">Category</label>
                                <div class="form-line">
                                    <select name="category" id="category" required>
                                        <?php if ($categories): ?>
                                            <?php foreach ($categories AS $key => $category): ?>
                                                <!--<option value=<?php //echo $category->id; ?>><?php// echo ucfirst($category->name); ?></option>-->
                                                <?php if (!is_null($category->parent_id)) : ?>
                                                    <optgroup label="<?php echo ucwords($category->name); ?>">
                                                        <?php if ($subcategories): ?>
                                                            <?php foreach ($subcategories AS $key => $subcategory): ?>
                                                                <?php if ($subcategory->parent_id == $category->id): ?>
                                                                    <option value="<?php echo $subcategory->id; ?>"><?php echo ucwords($subcategory->name); ?></option>
                                                                <?php endif; ?>
                                                            <?php endforeach; ?>
                                                        <?php endif; ?>
                                                    </optgroup>
                                                <?php else : ?>
                                                    <option style="font-weight: bold" value="<?php echo $category->id; ?>"><?php echo ucwords($category->name); ?></option>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="status" class="title-input">Status</label>
                                <div class="form-line">
                                    <select name="status" id="status" required>
                                        <option value=1>Enabled</option>
                                        <option value=0 <?php echo $post->status == 0 ? 'selected' : null; ?>>Disabled</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-sm-6">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="main-image" class="title-input">Image</label>
                                        <div class="form-line">
                                            <input type="file" id="main-image" name="main_image" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="tags" class="title-input">Tags</label>
                                        <div class="form-line">
                                            <input value="<?php echo $post->tags; ?>" type="text" name="tags" id="tags" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="title-input">Related Posts</label>
                                    <div class="form-line">
                                        <ul class="RP">
                                            <?php if ($posts) : ?>
                                                <?php foreach ($posts AS $key => $post): ?>
                                                    <li>
                                                        <input type="checkbox" name="relatedPosts[]" value="<?php echo $post->id; ?>" class="chk-col-green" id="md_checkbox_<?php echo $key; ?>">
                                                        <label for="md_checkbox_<?php echo $key; ?>"><?php echo $post->title; ?></label>
                                                    </li>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="post" class="title-input">Details</label>
                                <div class="form-line">
                                    <textarea id="edit-post" name="post" value="<?php echo html_entity_decode($post->details); ?>"></textarea>
                                    <input name="image" type="file" id="upload" class="hidden" onchange="">
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


                <!-- Tinymce editor -->
                <script src="<?php echo assets('plugins/tinymce/tinymce.min.js'); ?>"></script>

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

                        //TinyMCE
                        tinymce.init({
                            selector: "textarea#edit-post",
                            theme: "modern",
                            height: 300,
                            paste_data_images: true,
                            plugins: [
                                "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                                "searchreplace wordcount visualblocks visualchars code fullscreen",
                                "insertdatetime media nonbreaking save table contextmenu directionality",
                                "emoticons template paste textcolor colorpicker textpattern"
                            ],
                            toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
                            toolbar2: "print preview media | forecolor backcolor emoticons",
                            image_advtab: true,
                            file_picker_callback: function(callback, value, meta) {
                                if (meta.filetype == 'image') {
                                    $('#upload').trigger('click');
                                    $('#upload').on('change', function() {
                                        var file = this.files[0];
                                        var reader = new FileReader();
                                        reader.onload = function(e) {
                                            callback(e.target.result, {
                                                alt: ''
                                            });
                                        };
                                        reader.readAsDataURL(file);
                                    });
                                }
                            },
                            templates: [{
                                title: 'Test template 1',
                                content: 'Test 1'
                            }, {
                                title: 'Test template 2',
                                content: 'Test 2'
                            }]
                        });

                    });
                </script>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">SAVE CHANGE</button>
                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
            </div>
        </div>
    </div>
</div>