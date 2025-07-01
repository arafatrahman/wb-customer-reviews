
<div class="wrap ctrw-setting-panel">
    <h1>Customer Review Settings</h1>
    
    <!-- Success message -->
    <div id="ctrw-success-msg" class="notice notice-success is-dismissible" style="display: none;">
        <p>Settings saved successfully.</p>
    </div>
    
    <!-- Navigation tabs -->
    <h2 class="nav-tab-wrapper">
        <a href="#general" class="nav-tab nav-tab-active">General</a>
        <a href="#form-fields" class="nav-tab">Form Fields</a>
        <a href="#display" class="nav-tab">Display</a>
        <a href="#woocommerce" class="nav-tab">WooCommerce</a>
        <a href="#schema" class="nav-tab">Schema</a>
        <a href="#shortcodes" class="nav-tab">Shortcodes</a>
        <a href="#advanced" class="nav-tab">Advanced</a>
    </h2>
    
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