<?php
    $user_id = $_SESSION['id'];
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <li class="nav-item dropdown">
                <a class="edit dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?php echo 'welcom' . ' ' . $_SESSION['name']?>
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item info" href="logout.php"><?php echo lang('log_out')?></a>
                </div>
            </li>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainnav" aria-controls="mainnav" aria-expanded="true" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
        <div class="collapse navbar-collapse" id="mainnav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="dashpord.php?user_id=<?php echo $user_id?>"><?php echo lang('dashpord_admin')?></a>
                    <hr class="hr hr1">
                </li>
                <li class="nav-item">
                    <a id="display" class="nav-link" href="complaint.php?user_id=<?php echo $user_id?>"><?php echo lang('complaint_admin')?></a>
                    <hr class="hr hr2">
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="personal.php?user_id=<?php echo $user_id?>"><?php echo lang('Member_admin')?></a>
                    <hr class="hr hr3">
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="saveing.php?user_id=<?php echo $user_id?>"><?php echo lang('save_admin')?></a>
                </li>
            </ul>
        </div>
        <form class="form-inline my-4 my-lg-0 form_search" method="GET" id="searchform" action="search.php">
            <input class="form-control mr-sm-4" placeholder="Search" type="text" value="" name="search" id="search" aria-label="Search">
            <input class="btn btn-outline-primary my-2 my-sm-0 click" type="submit" id="searchsubmit" value="بحث" class="submit">
            <input type="hidden" name="do" value="query">
        </form>
    </div>
</nav>


