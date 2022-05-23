    <link rel="icon" type="image/ico" href="<?=DEP_IMG;?>favicon.ico">
    <link rel="stylesheet" href="<?=DEP_CSS;?>b5/bootstrap.css">
    <link rel="stylesheet" href="<?=DEP_CSS;?>main.css">
    <link rel="stylesheet" href="<?=DEP_CSS;?>style.css">
    <link rel="stylesheet" href="<?=DEP_CSS;?>dataTable/dataTables.bootstrap4.min.css">

    <script src="<?=DEP_SCRIPT;?>font_awesome/all.js"></script>
    <script src="<?=DEP_SCRIPT;?>swal/swal.js"></script>
    <script src="<?=DEP_SCRIPT;?>jquery/jquery.js"></script>
    <script src="<?=DEP_SCRIPT;?>poper/popper.js"></script>
    <script src="<?=DEP_SCRIPT;?>b5/bootstrap.js"></script>
    <script src="<?=DEP_SCRIPT;?>dataTable/jquery.dataTables.min.js"></script>
    <script src="<?=DEP_SCRIPT;?>dataTable/dataTables.bootstrap5.min.js"></script>
    <script src="<?=DEP_SCRIPT;?>dataTable/dataTables.buttons.min.js"></script>  
    <script src="<?=DEP_SCRIPT;?>dataTable/jszip.min.js"></script>    
    <script src="<?=DEP_SCRIPT;?>dataTable/pdfmake.min.js"></script>    
    <script src="<?=DEP_SCRIPT;?>dataTable/vfs_fonts.js"></script>
    <script src="<?=DEP_SCRIPT;?>dataTable/buttons.html5.min.js"></script>
    <script src="<?=DEP_SCRIPT;?>plotly/plotly.js"></script>
    <script src="<?=DEP_SCRIPT;?>main.js"></script>
    <?php if(isset($_SESSION['user']['correo_usuario'])):?>
    <script src="<?=CONTROLLER;?>sesion/sesion.controller.js"></script>
    <?php endif?>