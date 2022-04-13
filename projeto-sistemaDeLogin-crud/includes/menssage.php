<?php
    if (isset($_SESSION['menssage'])) :
    ?>

        <div class="container">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="alert alert-info mt-3 alert-dismissible fade show" role="alert">
                        <span class="material-icons">info</span> <?php echo $_SESSION['menssage']; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            </div>
        </div>

    <?php
    endif;
    session_unset();
?>