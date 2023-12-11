<?php
$url = $_SERVER['REQUEST_URI'];
$parts = explode('/', rtrim($url, '/'));
$lastPart = end($parts);
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<div class="nav-wrapper">
    <nav>
        <ul>
            <li class="logo">
                <a href="">
                    <img src="assets/images/wbctsLogo-white.png" alt="logo">
                </a>
            </li>
            <li class="<?= $lastPart == "dashboard" ? "active" : "" ?>">
                <a href="dashboard">
                    <i class="fa-solid fa-list-ul"></i>
                    Dashboard
                </a>
            </li>
            <li class="separator">
                <span>
                    Manage Records
                    <i class="fa-solid fa-chevron-down fa-lg"></i>
                </span>
                <div class="dropdown open dropdown-toggle">
                    <!-- <div class="drop-down-item <?= $lastPart == "settlements" ? "active" : "" ?>">
                        <a href="settlements">
                            <i class="fa-solid fa-check"></i>
                            Settlements
                        </a>
                    </div> -->
                    <div class="drop-down-item <?= $lastPart == "blotters" ? "active" : "" ?>">
                        <a href="blotters">
                            <i class="fa-sharp fa-regular fa-clipboard"></i>
                            Blotter Records
                        </a>
                    </div>
                    <div class="drop-down-item <?= $lastPart == "audit-trail" ? "active" : "" ?>">
                        <a href="audit-trail">
                            <i class="fas fa-file-alt"></i>
                            Audit Trail
                        </a>
                    </div>
                </div>
            </li>
            <?php
            $adminsIsActive = $lastPart == "admins" ? "active" : '';
            $rolesIsActive = $lastPart == "roles" ? "active" : '';
            $residentsIsActive = $lastPart == "users" ? "active" : '';
            $archivedBlottersIsActive = $lastPart == "archived-blotters" ? "active" : '';

            $archivedResidentsIsActive = $lastPart == "archived-users" ? "active" : '';

            echo $_SESSION["role"] == "1" ? <<<NAV
                <li class="separator">
                    <span>
                        Manage Users
                        <i class="fa-solid fa-chevron-down fa-lg"></i>
                    </span>
                    <div class="dropdown open dropdown-toggle">
                        <div class="drop-down-item {$adminsIsActive}">
                            <a href="admins">
                                <i class="fa-solid fa-user"></i>
                                System Users
                            </a>
                        </div>
                        
                        <div class="drop-down-item {$residentsIsActive}">
                            <a href="users">
                                <i class="fa-sharp fa-solid fa-users"></i>
                                Residents
                            </a>
                        </div>
                    </div>
                </li>
                <li class="separator">
                    <span>
                        Manage Archived Records
                        <i class="fa-solid fa-chevron-down fa-lg"></i>
                    </span>
                    <div class="dropdown open dropdown-toggle">
                        <div class="drop-down-item {$archivedBlottersIsActive}" ? "active" : "">
                            <a href="archived-blotters">
                                <i class="fa-solid fa-box-archive"></i>
                                Archived Blotter Records
                            </a>
                        </div>
                        <div class="drop-down-item {$archivedResidentsIsActive}">
                            <a href="archived-users">
                                <i class="fa-solid fa-user-xmark"></i>
                                Archived Residents
                            </a>
                        </div>
                    </div>
                </li>
                NAV : "" ?>
            <!-- <li class="separator">
                <span>
                    Your Account
                </span>
            </li> -->
            <li>
                <a href="auth/logout">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    Logout
                </a>
            </li>
        </ul>
    </nav>
</div>


<!-- <div class="drop-down-item {$rolesIsActive}">
                            <a href="roles">
                                <i class="fas fa-user-cog"></i>
                                Roles
                            </a>
                        </div> -->