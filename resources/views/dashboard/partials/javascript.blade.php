<!-- ✅ 1. jQuery depuis CDN (OBLIGATOIRE, en premier) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- ✅ 2. Bootstrap 4 JS depuis CDN -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>


<!-- ✅ 3. Scripts du template -->

   <!-- plugins:js -->
    <script src="{{ asset('build/assets/dashboard/vendors/js/vendor.bundle.base.js') }}"></script>
    <!-- endinject -->

    <!-- Plugin js for this page -->
    <script src="{{ asset('build/assets/dashboard/vendors/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('build/assets/dashboard/vendors/jquery-circle-progress/js/circle-progress.min.js') }}"></script>
    <!-- End plugin js for this page -->

    <!-- inject:js -->
    <script src="{{ asset('build/assets/dashboard/js/off-canvas.js') }}"></script>
    <script src="{{ asset('build/assets/dashboard/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('build/assets/dashboard/js/misc.js') }}"></script>
    <!-- endinject -->

    <!-- Custom js for this page -->
    <script src="{{ asset('build/assets/dashboard/js/dashboard.js') }}"></script>
    <!-- End custom js for this page -->

<!-- ✅ 4. Script pour activer dropdowns + sidebar -->
<script>
    $(document).ready(function() {
        // Dropdowns Bootstrap
        $('[data-toggle="dropdown"]').dropdown();

        // Bouton réduire/agrandir le sidebar
        $('[data-toggle="minimize"]').on('click', function() {
            $('body').toggleClass('sidebar-icon-only');
        });

        // Bouton mobile (offcanvas)
        $('[data-toggle="offcanvas"]').on('click', function() {
            $('body').toggleClass('sidebar-open');
        });
    });
</script>




