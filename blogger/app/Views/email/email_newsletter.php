<?= view("email/_header"); ?>
<table role="presentation" border="0" cellpadding="0" cellspacing="0" class="body">
    <tr>
        <td>&nbsp;</td>
        <td class="container">
            <div class="content">
                <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="body">
                    <tr>
                        <td style="text-align: center;">
                            <div style="height: 70px;width:100%;text-align: center;margin-bottom: 10px;">
                                <a href="<?= base_url(); ?>">
                                    <img src="<?= getLogo($generalSettings); ?>" alt="" style="max-width: 180px;max-height: 70px;">
                                </a>
                            </div>
                        </td>
                    </tr>
                </table>
                <table role="presentation" class="main">
                    <tr>
                        <td class="wrapper">
                            <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td>
                                        <h1 style="text-decoration: none; font-size: 24px;line-height: 28px;font-weight: bold"><?= $subject; ?></h1>
                                        <div class="mailcontent" style="line-height: 26px;font-size: 14px;">
                                            <div class="mailcontent" style="line-height: 26px;font-size: 14px;">
                                                <?= $message; ?>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
                <table role="presentation" border="0" cellpadding="0" cellspacing="0" style="margin-top: 10px;">
                    <tr>
                        <td class="content-block" style="text-align: center;width: 100%;">
                            <?php if (!empty($settings->facebook_url)) : ?>
                                <a href="<?= esc($settings->facebook_url); ?>" target="_blank" style="color: transparent;margin-right: 5px;">
                                    <img src="<?= base_url('assets/img/social-icons/facebook.png'); ?>" alt="" style="width: 28px; height: 28px;"/>
                                </a>
                            <?php endif; ?>
                            <?php if (!empty($settings->twitter_url)) : ?>
                                <a href="<?= esc($settings->twitter_url); ?>" target="_blank" style="color: transparent;margin-right: 5px;">
                                    <img src="<?= base_url('assets/img/social-icons/twitter.png'); ?>" alt="" style="width: 28px; height: 28px;"/>
                                </a>
                            <?php endif; ?>
                            <?php if (!empty($settings->pinterest_url)) : ?>
                                <a href="<?= esc($settings->pinterest_url); ?>" target="_blank" style="color: transparent;margin-right: 5px;">
                                    <img src="<?= base_url('assets/img/social-icons/pinterest.png'); ?>" alt="" style="width: 28px; height: 28px;"/>
                                </a>
                            <?php endif; ?>
                            <?php if (!empty($settings->instagram_url)) : ?>
                                <a href="<?= esc($settings->instagram_url); ?>" target="_blank" style="color: transparent;margin-right: 5px;">
                                    <img src="<?= base_url('assets/img/social-icons/instagram.png'); ?>" alt="" style="width: 28px; height: 28px;"/>
                                </a>
                            <?php endif; ?>
                            <?php if (!empty($settings->linkedin_url)) : ?>
                                <a href="<?= esc($settings->linkedin_url); ?>" target="_blank" style="color: transparent;margin-right: 5px;">
                                    <img src="<?= base_url('assets/img/social-icons/linkedin.png'); ?>" alt="" style="width: 28px; height: 28px;"/>
                                </a>
                            <?php endif; ?>
                            <?php if (!empty($settings->vk_url)) : ?>
                                <a href="<?= esc($settings->vk_url); ?>" target="_blank" style="color: transparent;margin-right: 5px;">
                                    <img src="<?= base_url('assets/img/social-icons/vk.png'); ?>" alt="" style="width: 28px; height: 28px;"/>
                                </a>
                            <?php endif; ?>
                            <?php if (!empty($settings->youtube_url)) : ?>
                                <a href="<?= esc($settings->youtube_url); ?>" target="_blank" style="color: transparent;margin-right: 5px;">
                                    <img src="<?= base_url('assets/img/social-icons/youtube.png'); ?>" alt="" style="width: 28px; height: 28px;"/>
                                </a>
                            <?php endif; ?>
                        </td>
                    </tr>
                </table>
                <div class="footer">
                    <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td class="content-block powered-by">
                                <span class="apple-link"><?= esc($settings->contact_address); ?></span><br>
                                <?= esc($settings->copyright); ?>
                            </td>
                        </tr>
                        <?php if (empty($type)): ?>
                            <tr>
                                <td class="content-block">
                                    <?= trans("dont_want_receive_emails"); ?> <a href="<?= base_url(); ?>/unsubscribe?token=<?= !empty($subscriber->token) ? $subscriber->token : ''; ?>"><?= trans("unsubscribe"); ?></a>.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </table>
                </div>
            </div>
        </td>
        <td>&nbsp;</td>
    </tr>
</table>
<?= view("email/_footer"); ?>
