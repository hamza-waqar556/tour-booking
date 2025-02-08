<div class="wrap">
    <div class="tabs-parent-wrapper">
        <h1>Dynamic Dashboard</h1>
        <?php settings_errors(); ?>

        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab-1">Manage Settings</a></li>
            <li><a href="#tab-2">Update Your Information</a></li>
            <li><a href="#tab-3">About</a></li>
        </ul>

        <div class="tab-content">
            <div id="tab-1" class="tab-pane active">
                <form action="options.php" method="post">
                    <?php settings_fields( 'aiob_settings' ); ?>
                    <?php do_settings_sections( 'aiob_settings' ); ?>
                    <?php submit_button(); ?>
                </form>
            </div>

            <div id="tab-2" class="tab-pane">
                <h1>Update your information</h1>
            </div>
            <div id="tab-3" class="tab-pane">
                <h1>About Us</h1>
            </div>
        </div>
    </div>
</div>