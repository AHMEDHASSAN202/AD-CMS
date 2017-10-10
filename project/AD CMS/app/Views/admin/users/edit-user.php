<?php if ($user): ?>
    <?php extract($user); ?>

    <div class="modal fade add-user edit-user" id="edit-user" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-col-cyan">
                <div class="modal-header">
                    <h4 class="modal-title" id="defaultModalLabel"><?php echo $titleModal; ?></h4>
                </div>
                <div class="modal-body">
                    <form class="register-user editUser" action="<?php echo $actionLink; ?>" method="post">
                        <img class="loading-form" src="<?php echo assets('admin/images/loader.gif'); ?>" alt="Loading..." id="loading-form">
                        <div class="form-body">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="clearfix">
                                        <div class="col-sm-6 col-xs-12">
                                            <label for="first_name">first name</label>
                                            <input value="<?php echo $first_name; ?>" type="text" id="first_name" name="first_name"  title="first name must are alphabetic" autocomplete="off" required>
                                        </div>
                                        <div class="col-sm-6 col-xs-12">
                                            <label for="last_name">last name</label>
                                            <input value="<?php echo $last_name; ?>" type="text" id="last_name" name="last_name"  title="last name must are alphabetic"  autocomplete="off" required>
                                        </div>
                                    </div>
                                    <div class="clearfix">
                                        <div class="col-sm-6 col-xs-12">
                                            <label for="email">email</label>
                                            <input value="<?php echo $email; ?>" type="text" id="email" name="email" autocomplete="off" required>
                                        </div>
                                        <div class="col-sm-6 col-xs-12">
                                            <label for="user_group">user group</label>
                                            <select id="user_group" name="user_group" >
                                                <?php foreach ($groups AS $key => $group): ?>
                                                    <option <?php echo ($group->id == $groupUser->id) ? 'selected' : null; ?> value="<?php echo $group->id ?>"><?php echo $group->permission; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="clearfix">
                                        <div class="col-sm-6 col-xs-12">
                                            <label for="password">password</label>
                                            <input type="password" id="password" name="password"  title="password must be 8-20 characters long & at least one lowercase char & at least one digit & at least one special sign of @#-_$%^&+=§!?" autocomplete="off">
                                        </div>
                                        <div class="col-sm-6 col-xs-12">
                                            <label for="confirm_password">confirm password</label>
                                            <input type="password" id="confirm_password" name="confirm_password" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="clearfix">
                                        <div class="col-sm-6 col-xs-12">
                                            <label for="gender">gender</label>
                                            <select id="gender" name="gender">
                                                <option value="1">male</option>
                                                <option <?php echo ($gender == 0) ? 'selected' : null; ?> value="0">female</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-6 col-xs-12">
                                            <label for="status">status</label>
                                            <select id="status" name="status">
                                                <option value="1">enable</option>
                                                <option <?php echo ($status == 0) ? 'selected' : null; ?> value="0">disable</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="clearfix">
                                        <div class="col-sm-6 col-xs-12">
                                            <label for="birthday">birthday</label>
                                            <input value="<?php echo date('d-m-Y' , $birthday); ?>" type="text" id="birthday" name="birthday" title="Enter a date in this formart DD-MM-YYYY" placeholder="dd-mm-yyyy" autocomplete="off" required>
                                        </div>
                                        <div class="col-sm-6 col-xs-12">
                                            <label for="image">image</label>
                                            <input type="file" id="image" name="image" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-link waves-effect saveEdit" data-target="editUser">SAVE CHANGES</button>
                            <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php endif; ?>



