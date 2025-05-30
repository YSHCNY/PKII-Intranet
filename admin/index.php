<?php require('./login.htm'); ?>

<?php
session_start();
if (isset($_SESSION['Info'])): ?>
    <div id="alertBox" class="alert alert-primary text-center alert-dismissible fade show position-fixed top-0 start-50 translate-middle-x mt-3" role="alert">
        <?php echo $_SESSION['Info']; ?>
    </div>
    <script>
        setTimeout(function() {
            let alertBox = document.getElementById('alertBox');
            if (alertBox) {
                alertBox.classList.remove('show');
                alertBox.classList.add('fade');
                setTimeout(() => alertBox.remove(), 500);
            }
        }, 2000);
    </script>
<?php unset($_SESSION['Info']); endif; ?>