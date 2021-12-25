<div class="row">
    <div class="col-lg-6 col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><?= trans("add_user"); ?></h3>
            </div>
            <form action="<?= base_url('AdminController/addUserPost'); ?>" method="post">
                <?= csrf_field(); ?>
                <div class="box-body">
                    <?= view('admin/includes/_messages'); ?>
                    <div class="form-group">
                        <label><?= trans("username"); ?></label>
                        <input type="text" name="username" class="form-control auth-form-input" placeholder="<?= trans("username"); ?>" value="<?= old("username"); ?>" required>
                    </div>
                    <div class="form-group">
                        <label><?= trans("email"); ?></label>
                        <input type="email" name="email" class="form-control auth-form-input" placeholder="<?= trans("email"); ?>" value="<?= old("email"); ?>" required>
                    </div>
                    <div class="form-group">
                        <label><?= trans("password"); ?></label>
                        <input type="password" name="password" class="form-control auth-form-input" placeholder="<?= trans("password"); ?>" value="<?= old("password"); ?>" required>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12 col-xs-12">
                                <label><?= trans('role'); ?></label>
                            </div>
                            <div class="col-md-3 col-sm-4 col-xs-12 col-option">
                                <input type="radio" id="role_1" name="role" value="admin" class="square-purple" checked>
                                <label for="role_1" class="cursor-pointer"><?= trans('admin'); ?></label>
                            </div>
                            <div class="col-md-3 col-sm-4 col-xs-12 col-option">
                                <input type="radio" id="role_2" name="role" value="author" class="square-purple">
                                <label for="role_2" class="cursor-pointer"><?= trans('author'); ?></label>
                            </div>
                            <div class="col-md-3 col-sm-4 col-xs-12 col-option">
                                <input type="radio" id="role_3" name="role" value="user" class="square-purple">
                                <label for="role_3" class="cursor-pointer"><?= trans('user'); ?></label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary pull-right"><?= trans('add_user'); ?></button>
                </div>
            </form>
        </div>
    </div>
</div>