<footer class="footer footer-black footer-white ">
    <div class="container-fluid">
       <div class="row">
          <div class="credits ml-auto">
             <span class="copyright">
                ©....
                , Powered By VELOCIUM SYSTEM 
             </span>
          </div>
       </div>
    </div>
 </footer>
</div>
</div>
{{-- <script src="{{ asset('assets/js/plugins/bootstrap-notify.js')}}"></> --}}
{{-- // <script src="{{ asset('assets/js/paper-dashboard.min.js?v=2.0.0')}}" type="text/javascript"></script> --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const alert = document.getElementById('success-alert');
        
        if (alert) {
            setTimeout(() => {
                alert.style.display = 'none'; // Hide the alert
            }, 1000); // 60000 milliseconds = 1 minute
        }
    });
</script>

</body>
</html>
<script>
    $(document).ready(function() {
        $('#sidebarToggle').click(function() {
            $('#sidebar').toggleClass('active'); // Add or remove 'active' class
        });
    });
</script>
