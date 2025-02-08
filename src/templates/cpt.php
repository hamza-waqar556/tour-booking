<div class="wrap">
    <div class="tabs-parent-wrapper">
        <h1>This is the CPT Page</h1>
        <?php settings_errors(); ?>

        <ul class="nav nav-tabs">
            <li class="<?php echo ! isset( $_POST[ 'edit_post' ] ) ? 'active' : ''; ?>"><a href="#tab-1">Your Custom Post Types</a></li>
            <li class="<?php echo isset( $_POST[ 'edit_post' ] ) ? 'active' : ''; ?>">
                <a href="#tab-2">
                <?php echo isset( $_POST[ 'edit_post' ] ) ? 'Edit' : 'Add'; ?> Custom Post Type
                </a>
            </li>
            <li><a href="#tab-3">Export</a></li>
        </ul>

        <div class="tab-content">
            <!-- Your Custom Post Types -->
            <div id="tab-1" class="tab-pane <?php echo ! isset( $_POST[ 'edit_post' ] ) ? 'active' : ''; ?>">
                <h3>Manage Your Custom Post Types</h3>
                <?php $options = get_option( 'tour_booking_cpt' ) ?: [  ]; ?>
                <table class="cpt-table">
                <tr>
                    <th>ID</th>
                    <th>Singular Name</th>
                    <th>Plural Name</th>
                    <th class="text-center">Public</th>
                    <th class="text-center">Archive</th>
                    <th class="text-center">Actions</th>
                </tr>
                <?php foreach ( $options as $option ): ?>
                    <tr>
                        <td> <?php echo( htmlspecialchars( $option[ 'post_type' ] ) ); ?> </td>
                        <td> <?php echo( htmlspecialchars( $option[ 'singular_name' ] ) ); ?> </td>
                        <td> <?php echo( htmlspecialchars( $option[ 'plural_name' ] ) ); ?></td>
                        <td class="text-center"> <?php echo( htmlspecialchars( isset( $option[ 'public' ] ) ) ? '✔️' : '❌' ); ?> </td>
                        <td class="text-center"> <?php echo( htmlspecialchars( isset( $option[ 'has_archive' ] ) ) ? '✔️' : '❌' ); ?> </td>
                        <td class="text-center">
                            <!-- Edit -->
                            <form method="post" class="inline-block">
                                <input type="hidden" name="edit_post" value="<?php echo( htmlspecialchars( $option[ 'post_type' ] ) ); ?>">
                                <?php submit_button( 'Edit', 'primary small', 'submit', false ); ?>
                            </form>
                            <!-- Delete -->
                            <form action="options.php" method="post" class="inline-block">
                                <?php settings_fields( 'tour_booking_cpt_settings' ); ?>
                                <input type="hidden" name="remove" value="<?php echo( htmlspecialchars( $option[ 'post_type' ] ) ); ?>">
                                <?php submit_button( 'Delete', 'delete small', 'submit', false, [ 'onclick' => 'return confirm("You sure?")' ] ); ?>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </table>
            </div>

            <!-- Add Custom Post Type -->
            <div id="tab-2" class="tab-pane <?php echo isset( $_POST[ 'edit_post' ] ) ? 'active' : ''; ?>">
                <form action="options.php" method="post">
                    <?php settings_fields( 'tour_booking_cpt_settings' ); ?>
                    <?php do_settings_sections( 'tour_cpt' ); ?>
                    <?php submit_button(); ?>
                </form>
            </div>

            <!-- Export Your Custom Post Types -->
            <div id="tab-3" class="tab-pane">
                <h1>Export Your Custom Post Types</h1>
            </div>
        </div>
    </div>
</div>