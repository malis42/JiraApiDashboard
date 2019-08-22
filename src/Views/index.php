<?php

if (isset($_SESSION['email'])) header('Location: Search');

?>
<div class="container" style="width: 100%; margin-top: 30px;">
    <span style="text-align: center;"><a href="https://www.salesmanago.pl" target="_blank"><img
                    src="http://support.salesmanago.com/external/jira/emred/assets/img/logo.png" style="height: 100px; width: auto; margin-left: 10px; margin-top: 10px;"></a></span>
    <div class="row justify-content-sm-center">
        <form class="col-md-6" action="http://support.salesmanago.com/external/jira/emred/public/index/Login" method="POST">
            <div class="form-group">
                <label for="email">Your JIRA e-mail address:</label>
                    <input type="email" class="form-control" placeholder="username@salesmanago.pl" name="email">
            </div>
            <div class="form-group">
                <label for="token">Your JIRA API token:</label>
                    <input type="password" class="form-control" placeholder="API token" name="token">
            </div>
            <div id="errorDiv">
                <?php

                if (isset($_SESSION['error'])) {
                    echo '<span style="color: red;">' . $_SESSION['error'] . '</span>';
                    unset($_SESSION['error']);
                }

                ?>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>
</div>
