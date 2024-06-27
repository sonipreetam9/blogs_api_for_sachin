<footer class="footer py-4  ">
    <div class="container-fluid">
        <div class="row align-items-center justify-content-lg-between">
            <div class="col-lg-6 mb-lg-0 mb-4">
                <div class="copyright text-center text-sm text-muted text-lg-start">
                    Copyright © <script>
                        document.write(new Date().getFullYear())
                    </script>
                    {{-- made with <i class="fa fa-heart"></i> by --}}


                </div>
            </div>

        </div>
    </div>
</footer>
</div>
</main>

<!--   Core JS Files   -->

<script src="{{ asset('/assets/js/core/popper.min.js') }}"></script>
<script src="{{ asset('/assets/js/core/bootstrap.min.js') }}"></script>
<script src="{{ asset('/assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('/assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
<script src="{{ asset('/assets/js/plugins/chartjs.min.js') }}"></script>

<script>
    var win = navigator.platform.indexOf('Win') > -1;
if (win && document.querySelector('#sidenav-scrollbar')) {
  var options = {
    damping: '0.5'
  }
  Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
}
</script>
<!-- Github buttons -->
<script async defer src="{{ asset('https://buttons.github.io/buttons.js') }}"></script>

<script src="{{ asset('/assets/js/material-dashboard.min.js?v=3.1.0') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var successfully = document.getElementById('successfully');
        var success = @json(session('success'));

        if (success) {
            successfully.click();
        }
    });
</script>
</body>

</html>
