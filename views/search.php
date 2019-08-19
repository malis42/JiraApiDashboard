<?php if(!isset($_SESSION['email'])){header('Location: index');} ?>
<div class="jumbotron sticky-top">
    <div class="row">
        <div class="col-lg-4">
            <a href="https://www.salesmanago.pl" target="_blank"><img src="/assets/img/logo.png" style="height: 100px; width: auto; margin-left: 10px; margin-top: 10px;"></a>
            <br/>
        </div>
        <div class="col-lg-4">
            <span style="text-align: center;">
                <br/>
                <h5>Timestamp of last data refresh: <br/> <?php  use controllers\frontInit;
                    $frontController = new frontInit();
                    $frontController->loadTimestamp(); ?>
                </h5>
                <input type="submit" class="btn btn-success" value="Refresh data" name="refreshBtn" onclick="OnActionClick()"/>
            </span>
        </div>
        <div class="col-lg-4">
            <br/>
            <h5>You're logged in as: <br/>
            <?php echo $_SESSION['email'] ?></h5>
            <form action="logout" method="post">
                <input type="submit" class="btn btn-danger" value="Logout" name="logout"/>
            </form>
        </div>
    </div>
    <br/>
</div>
<div id="preloader">
    <div id="status">&nbsp;</div>
</div>
<div class="row">
    <div class="col-xs-12 col-lg-10 offset-lg-1">
        <table class="table table-bordered table-hover" id="myDataTable">
            <thead class="thead thead-dark">
            <tr>
                <th scope="col" style="width: 5%">#</th>
                <th scope="col" style="width: 10%">Task ID</th>
                <th scope="col" style="width: 27%">Task status</th>
                <th scope="col" style="width: 23%">Reporter</th>
                <th scope="col" style="width: 21%">Assignee</th>
                <th scope="col" style="width: 14%">Due date</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $frontController->loadData();
            ?>
            </tbody>
        </table>
    </div>
</div>
<script src="../assets/js/OnActionClick.js"></script>
