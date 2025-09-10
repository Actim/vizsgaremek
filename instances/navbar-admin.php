    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <h3><i class="fas fa-tachometer-alt"></i> <span>Admin Panel</span></h3>
        </div>
        <div class="sidebar-menu">
            <div class="menu-item" onclick="toggleDropdown('dashboard')">
                <i class="fas fa-home"></i> <span>Vezérlőpult</span>
            </div>
            
            <div class="menu-item" onclick="toggleDropdown('users')">
                <i class="fas fa-users"></i> <span>Felhasználók</span> <i class="fas fa-chevron-down dropdown-arrow"></i>
            </div>
            <div class="dropdown-menu" id="users-dropdown">
                <a href="<?=$tag?>allAccounts" class="dropdown-item">Összes felhasználó</a>
                <a href="<?=$tag?>newAccount" class="dropdown-item">Új felhasználó</a>
                <a href="<?=$tag?>roles" class="dropdown-item">Jogosultságok</a>
            </div>
            
            <div class="menu-item" onclick="toggleDropdown('dev')">
                <i class="fas fa-code"></i> <span>Fejlesztői nézet</span> <i class="fas fa-chevron-down dropdown-arrow"></i>
            </div>
            <div class="dropdown-menu" id="dev-dropdown">
                <a href="#" class="dropdown-item">API Kulcsok</a>
                <a href="#" class="dropdown-item">Naplók</a>
                <a href="#" class="dropdown-item">Hibakeresés</a>
            </div>
            
            <div class="menu-item" onclick="toggleDropdown('products')">
                <i class="fas fa-shopping-cart"></i> <span>Termékek</span> <i class="fas fa-chevron-down dropdown-arrow"></i>
            </div>
            <div class="dropdown-menu" id="products-dropdown">
                <a href="#" class="dropdown-item">Terméklista</a>
                <a href="#" class="dropdown-item">Kategóriák</a>
                <a href="#" class="dropdown-item">Készlet</a>
            </div>
            
            <div class="menu-item" onclick="toggleDropdown('settings')">
                <i class="fas fa-cog"></i> <span>Beállítások</span> <i class="fas fa-chevron-down dropdown-arrow"></i>
            </div>
            <div class="dropdown-menu" id="settings-dropdown">
                <a href="#" class="dropdown-item">Általános</a>
                <a href="#" class="dropdown-item">Biztonság</a>
                <a href="#" class="dropdown-item">Email</a>
            </div>
        </div>
    </div>
    
    <div class="main-content">
        <div class="header">
            <div class="menu-toggle" onclick="toggleSidebar()">
                <i class="fas fa-bars"></i>
            </div>
            <div class="header-right">
                <label class="theme-switch">
                    <input type="checkbox" id="theme-toggle">
                    <span class="slider">
                        <i class="fas fa-sun"></i>
                        <i class="fas fa-moon"></i>
                    </span>
                </label>
                <div class="user-info">
                    <img src="https://ui-avatars.com/api/?name=<?=$account_data["username"]?>&background=random" alt="Profil kép">
                    <span><?=$account_data["username"]?></span>
                </div>
            </div>
    </div>