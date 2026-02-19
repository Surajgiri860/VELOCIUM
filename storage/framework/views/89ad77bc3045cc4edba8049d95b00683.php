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
<?php /**PATH C:\xampp\htdocs\VELOCIUM\resources\views/layouts/footer.blade.php ENDPATH**/ ?>