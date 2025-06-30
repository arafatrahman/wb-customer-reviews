
    <div class="ctrw-review-settings">
        <div class="ctrw-settings-header">
            <h1>Customer Review Settings</h1>
            <div class="ctrw-settings-tabs">
                <button class="active">General</button>
                <button>Form Fields</button>
                <button>Display</button>
                <button>WooCommerce</button>
                <button>Schema</button>
                <button>Shortcodes</button>
                <button>Advanced</button>
            </div>
        </div>

        <div class="ctrw-settings-container">

            <!-- Display any messages -->
            <div id="ctrw-success-msg" class="notice notice-success is-dismissible" style="display: none;">
                  <p><?php esc_html_e( 'Settings saved successfully.', 'customer-reviews-wp' ); ?></p>
            </div>
            
            
            <!-- GENERAL SETTINGS -->
            <?php include __DIR__ . '/general-settings.php'; ?>     
            
            <!-- FORM FIELDS -->
            <?php include __DIR__ . '/form-fields-settings.php'; ?>

            <!-- DISPLAY SETTINGS -->
            <?php include __DIR__ . '/display-settings.php'; ?>

            <!-- WOOCOMMERCE SETTINGS -->
            <?php include __DIR__ . '/woocommerce-settings.php'; ?>

            <!-- SCHEMA SETTINGS -->
            <?php include __DIR__ . '/schema-settings.php'; ?>

            <!-- SHORTCODES -->
            <?php include __DIR__ . '/shortcodes-settings.php'; ?>

            <!-- ADVANCED SETTINGS -->
            <?php include __DIR__ . '/advanced-settings.php'; ?>
            
        </div>
    </div>