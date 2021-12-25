<div class="row">
    <div class="col-sm-12">
        <?= view('admin/includes/_messages'); ?>
    </div>
    <div class="col-sm-8">
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="left">
                    <h3 class="box-title"><?= esc($title); ?></h3>
                </div>
            </div>
            <form action="<?= base_url('AdminController/editUserPost'); ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <input type="hidden" name="id" value="<?= $user->id; ?>">
                <div class="box-body">
                    <div class="form-group">
                        <?php if ($user->role == "admin"): ?>
                            <label class="label bg-olive"><?= $user->role; ?></label>
                        <?php elseif ($user->role == "author"): ?>
                            <label class="label label-warning"><?= $user->role; ?></label>
                        <?php elseif ($user->role == "user"): ?>
                            <label class="label label-default"><?= $user->role; ?></label>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12 col-profile">
                                <img src="<?= getUserAvatar($user); ?>" alt="" class="thumbnail img-responsive img-update" style="max-width: 210px;">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-profile">
                                <p>
                                    <a class="btn btn-success btn-sm btn-file-upload">
                                        <?= trans('change_avatar'); ?>
                                        <input name="file" size="40" accept=".png, .jpg, .jpeg" onchange="$('#upload-file-info').html($(this).val().replace(/.*[\/\\]/, ''));" type="file">
                                    </a>
                                </p>
                                <p class='label label-info' id="upload-file-info"></p>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label><?= trans('email'); ?></label>
                        <input type="email" class="form-control form-input" name="email" placeholder="<?= trans('email'); ?>" value="<?= esc($user->email); ?>">
                    </div>

                    <div class="form-group">
                        <label><?= trans('username'); ?></label>
                        <input type="text" class="form-control form-input" name="username" placeholder="<?= trans('username'); ?>" value="<?= esc($user->username); ?>">
                    </div>

                    <div class="form-group">
                        <label><?= trans('slug'); ?></label>
                        <input type="text" class="form-control form-input" name="slug" placeholder="<?= trans('slug'); ?>" value="<?= esc($user->slug); ?>">
                    </div>

                    <div class="form-group">
                        <label class="control-label"><?= trans('about_me'); ?></label>
                        <textarea class="form-control text-area" name="about_me" placeholder="<?= trans('about_me'); ?>"><?= esc($user->about_me); ?></textarea>
                    </div>

                    <div class="form-group">
                        <label><?= trans('social_accounts'); ?></label>
                        <input type="text" class="form-control form-input" name="facebook_url" placeholder="Facebook <?= trans('url'); ?>" value="<?= esc($user->facebook_url); ?>">
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control form-input" name="twitter_url" placeholder="Twitter <?= trans('url'); ?>" value="<?= esc($user->twitter_url); ?>">
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control form-input" name="instagram_url" placeholder="Instagram <?= trans('url'); ?>" value="<?= esc($user->instagram_url); ?>">
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control form-input" name="pinterest_url" placeholder="Pinterest <?= trans('url'); ?>" value="<?= esc($user->pinterest_url); ?>">
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control form-input" name="linkedin_url" placeholder="LinkedIn <?= trans('url'); ?>" value="<?= esc($user->linkedin_url); ?>">
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control form-input" name="vk_url" placeholder="VK <?= trans('url'); ?>" value="<?= esc($user->vk_url); ?>">
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control form-input" name="telegram_url" placeholder="Telegram <?= trans('url'); ?>" value="<?= esc($user->telegram_url); ?>">
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control form-input" name="youtube_url" placeholder="Youtube <?= trans('url'); ?>" value="<?= esc($user->youtube_url); ?>">
                    </div>

                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary pull-right"><?= trans('save_changes'); ?></button>
                </div>
            </form>
        </div>
    </div>
</div>