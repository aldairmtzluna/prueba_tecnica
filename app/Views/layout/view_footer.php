


<footer class="pt-4 border-top container">
    <div class="row">
        <div class="col-12 col-md text-center">
            <img class="mb-2" src="<?php echo base_url('assets/img/logo.png'); ?>" alt="" width="40" height="40">
            <p class="mb-3 text-muted">Telat © 2024 Todos los derechos reservados.</p>
        </div>
    </div>
</footer>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.bundle.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/agregar.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/editar.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/reportes.js'); ?>"></script>
<script>
const BASE_URL = "<?= base_url() ?>";
toastr.options = {
    "closeButton": true,
    "progressBar": true,
    "positionClass": "toast-top-right",
    "timeOut": "3000"
};
</script>
</body>
</html>
