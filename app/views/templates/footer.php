        <div class="clearfix"></div>
        <footer class="site-footer">
            <div class="footer-inner bg-white">
                <div class="row">
                    <div class="col-sm-12 text-center">
                        &copy; 2020 Sistem Informasi Pengolahan Data Penduduk - RT/RW Kelurahan Sawah Baru
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <!-- /#right-panel -->

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
    <script src="http://localhost/sipdp-kelsaru/public/js/main.js"></script>

    <!-- datatables -->
    <script src="<?= BASEURL; ?>/public/js/lib/data-table/datatables.min.js"></script>
    <script src="<?= BASEURL; ?>/public/js/lib/data-table/dataTables.bootstrap.min.js"></script>
    <script src="<?= BASEURL; ?>/public/js/lib/data-table/dataTables.buttons.min.js"></script>
    <script src="<?= BASEURL; ?>/public/js/lib/data-table/buttons.bootstrap.min.js"></script>
    <script src="<?= BASEURL; ?>/public/js/lib/data-table/jszip.min.js"></script>
    <script src="<?= BASEURL; ?>/public/js/lib/data-table/vfs_fonts.js"></script>
    <script src="<?= BASEURL; ?>/public/js/lib/data-table/buttons.html5.min.js"></script>
    <script src="<?= BASEURL; ?>/public/js/lib/data-table/buttons.print.min.js"></script>
    <script src="<?= BASEURL; ?>/public/js/lib/data-table/buttons.colVis.min.js"></script>
    <script src="<?= BASEURL; ?>/public/js/init/datatables-init.js"></script>

    <!-- select  -->
    <script src="<?= BASEURL; ?>/public/js/lib/chosen/chosen.jquery.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#bootstrap-data-table-export').DataTable();
        } );
    </script>
    <script>
        jQuery(document).ready(function() {
            jQuery(".standardSelect").chosen({
                no_results_text: "Tidak ada data yang ditemukan!",
                width: "100%"
            });
        });
    </script>
</body>
</html>
