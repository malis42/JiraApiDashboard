<?php if(isset($_SESSION['email'])){header('Location: Search');} ?>
<div style="width: 100%; margin-top: 30px;">
<span style="text-align: center;"><a href="https://www.salesmanago.pl" target="_blank"><img src="/assets/img/logo.png" style="height: 100px; width: auto; margin-left: 10px; margin-top: 10px;"></a></span>
    <div style="width: 50%; margin-left: auto; margin-right: auto; margin-top: 50px">
    <form action="Login" method="POST">
        <div class="form-group">
            <label>Email address</label>
            <input type="email" class="form-control" placeholder="Enter email" name="email">
        </div>
        <div class="form-group">
            <label>Your JIRA token</label>
            <input type="password" class="form-control" placeholder="JIRA Token" name="token">
        </div>
        <div id="errorDiv">
            <?php
            if(isset($_SESSION['error']))
            {
                echo '<span style="color: red;">'. $_SESSION['error'] . '</span>';
                unset($_SESSION['error']);
            }
            ?>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    </div>
</div>
