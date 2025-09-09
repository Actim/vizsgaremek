<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adminisztrációs Oldal</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        :root {
            --primary-color: #4e73df;
            --secondary-color: #f8f9fc;
            --text-color: #5a5c69;
            --hover-color: #3a56c4;
            --border-color: #e3e6f0;
        }

        body {
            background-color: #f8f9fc;
            color: var(--text-color);
            display: flex;
            min-height: 100vh;
        }

        /* Oldalsó menü */
        .sidebar {
            width: 250px;
            background: linear-gradient(to bottom, var(--primary-color), #224abe);
            color: white;
            transition: all 0.3s ease;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            position: relative;
            z-index: 100;
        }

        .sidebar-header {
            padding: 20px;
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar-header h3 {
            font-size: 1.5rem;
            margin: 0;
        }

        .sidebar-menu {
            padding: 10px 0;
        }

        .menu-item {
            padding: 12px 20px;
            display: flex;
            align-items: center;
            cursor: pointer;
            transition: all 0.2s;
            border-left: 3px solid transparent;
        }

        .menu-item:hover {
            background-color: rgba(255, 255, 255, 0.1);
            border-left: 3px solid white;
        }

        .menu-item i {
            margin-right: 10px;
            font-size: 18px;
        }

        .dropdown-menu {
            background-color: rgba(0, 0, 0, 0.1);
            overflow: hidden;
            max-height: 0;
            transition: max-height 0.3s ease;
        }

        .dropdown-menu.open {
            max-height: 500px;
        }

        .dropdown-item {
            padding: 12px 20px 12px 50px;
            display: block;
            transition: all 0.2s;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            position: relative;
        }

        .dropdown-item:hover {
            background-color: rgba(255, 255, 255, 0.15);
            color: white;
            padding-left: 55px;
        }

        .dropdown-item::before {
            content: "";
            position: absolute;
            left: 40px;
            top: 50%;
            transform: translateY(-50%);
            width: 6px;
            height: 6px;
            background-color: rgba(255, 255, 255, 0.5);
            border-radius: 50%;
            transition: all 0.2s;
        }

        .dropdown-item:hover::before {
            background-color: white;
            left: 45px;
        }

        /* Fő tartalom */
        .main-content {
            flex: 1;
            padding: 20px;
            transition: all 0.3s;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding-bottom: 15px;
            border-bottom: 1px solid var(--border-color);
        }

        .menu-toggle {
            display: none;
            font-size: 24px;
            cursor: pointer;
        }

        .user-info {
            display: flex;
            align-items: center;
        }

        .user-info img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
        }

        /* Statisztika kártyák */
        .stats-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .card {
            background: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card-primary {
            border-left: 4px solid var(--primary-color);
        }

        .card-success {
            border-left: 4px solid #1cc88a;
        }

        .card-info {
            border-left: 4px solid #36b9cc;
        }

        .card-warning {
            border-left: 4px solid #f6c23e;
        }

        .card-title {
            font-size: 0.9rem;
            text-transform: uppercase;
            font-weight: 700;
            color: var(--text-color);
            margin-bottom: 5px;
        }

        .card-value {
            font-size: 1.8rem;
            font-weight: 700;
            color: #5a5c69;
        }

        .card-icon {
            float: right;
            font-size: 2rem;
            opacity: 0.3;
            margin-top: -10px;
        }

        /* Diagramok */
        .charts {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 20px;
            margin-bottom: 30px;
        }

        .chart-container {
            background: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
        }

        .chart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .chart-title {
            font-size: 1rem;
            font-weight: 700;
        }

        /* Táblázat */
        .recent-table {
            background: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid var(--border-color);
        }

        th {
            font-weight: 700;
            color: var(--text-color);
        }

        tr:hover {
            background-color: #f6f9fc;
        }

        /* Reszponzív design */
        @media (max-width: 992px) {
            .charts {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 70px;
                overflow: hidden;
            }
            
            .sidebar-header h3, .menu-item span {
                display: none;
            }
            
            .menu-item i {
                margin-right: 0;
                font-size: 24px;
            }
            
            .dropdown-item {
                padding: 12px 20px;
            }
            
            .dropdown-item::before {
                left: 10px;
            }
            
            .dropdown-item:hover {
                padding-left: 25px;
            }
            
            .dropdown-item:hover::before {
                left: 15px;
            }
            
            .menu-toggle {
                display: block;
            }
            
            .stats-cards {
                grid-template-columns: 1fr 1fr;
            }
        }

        @media (max-width: 576px) {
            .stats-cards {
                grid-template-columns: 1fr;
            }
            
            .sidebar {
                position: fixed;
                left: -70px;
                height: 100%;
            }
            
            .sidebar.open {
                left: 0;
            }
            
            .main-content {
                margin-left: 0;
                padding: 15px;
            }
        }
    </style>
</head>
<body>
    <!-- Oldalsó menü -->
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
                <a href="#" class="dropdown-item">Összes felhasználó</a>
                <a href="#" class="dropdown-item">Új felhasználó</a>
                <a href="#" class="dropdown-item">Engedélyek</a>
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

    <!-- Fő tartalom -->
    <div class="main-content">
        <div class="header">
            <div class="menu-toggle" onclick="toggleSidebar()">
                <i class="fas fa-bars"></i>
            </div>
            <div class="user-info">
                <img src="https://ui-avatars.com/api/?name=Admin+User&background=random" alt="Profil kép">
                <span>Admin Felhasználó</span>
            </div>
        </div>

        <!-- Statisztika kártyák -->
        <div class="stats-cards">
            <div class="card card-primary">
                <div class="card-title">Felhasználók</div>
                <div class="card-value">2,548</div>
                <div class="card-icon"><i class="fas fa-users"></i></div>
            </div>
            
            <div class="card card-success">
                <div class="card-title">Bevétel</div>
                <div class="card-value">5,328M Ft</div>
                <div class="card-icon"><i class="fas fa-dollar-sign"></i></div>
            </div>
            
            <div class="card card-info">
                <div class="card-title">Termékek</div>
                <div class="card-value">1,258</div>
                <div class="card-icon"><i class="fas fa-box"></i></div>
            </div>
            
            <div class="card card-warning">
                <div class="card-title">Függőben lévő</div>
                <div class="card-value">18</div>
                <div class="card-icon"><i class="fas fa-comments"></i></div>
            </div>
        </div>

        <!-- Diagramok -->
        <div class="charts">
            <div class="chart-container">
                <div class="chart-header">
                    <div class="chart-title">Havi forgalom</div>
                    <div class="chart-options">
                        <select>
                            <option>2023</option>
                            <option>2022</option>
                        </select>
                    </div>
                </div>
                <div class="chart-placeholder" style="height: 300px; background-color: #f8f9fa; display: flex; align-items: center; justify-content: center;">
                    <p>Diagram helye (Canvas/Chart.js stb.)</p>
                </div>
            </div>
            
            <div class="chart-container">
                <div class="chart-header">
                    <div class="chart-title">Felhasználói eloszlás</div>
                </div>
                <div class="chart-placeholder" style="height: 300px; background-color: #f8f9fa; display: flex; align-items: center; justify-content: center;">
                    <p>Kördiagram helye</p>
                </div>
            </div>
        </div>

        <!-- Legutóbbi aktivitás -->
        <div class="recent-table">
            <div class="chart-header">
                <div class="chart-title">Legutóbbi tranzakciók</div>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Tranzakció ID</th>
                        <th>Vásárló</th>
                        <th>Dátum</th>
                        <th>Összeg</th>
                        <th>Státusz</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>#TR-1234</td>
                        <td>Kovács István</td>
                        <td>2023.10.22.</td>
                        <td>125,000 Ft</td>
                        <td><span style="color: #1cc88a;">Elfogadva</span></td>
                    </tr>
                    <tr>
                        <td>#TR-1233</td>
                        <td>Nagy Eszter</td>
                        <td>2023.10.21.</td>
                        <td>87,500 Ft</td>
                        <td><span style="color: #1cc88a;">Elfogadva</span></td>
                    </tr>
                    <tr>
                        <td>#TR-1232</td>
                        <td>Szabó Péter</td>
                        <td>2023.10.20.</td>
                        <td>215,800 Ft</td>
                        <td><span style="color: #f6c23e;">Függőben</span></td>
                    </tr>
                    <tr>
                        <td>#TR-1231</td>
                        <td>Horváth Anna</td>
                        <td>2023.10.19.</td>
                        <td>42,900 Ft</td>
                        <td><span style="color: #e74a3b;">Elutasítva</span></td>
                    </tr>
                    <tr>
                        <td>#TR-1230</td>
                        <td>Varga Gábor</td>
                        <td>2023.10.18.</td>
                        <td>63,750 Ft</td>
                        <td><span style="color: #1cc88a;">Elfogadva</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        // Lenyitható menük kezelése
        function toggleDropdown(id) {
            const dropdown = document.getElementById(`${id}-dropdown`);
            const allDropdowns = document.querySelectorAll('.dropdown-menu');
            const allArrows = document.querySelectorAll('.dropdown-arrow');
            
            // Bezárjuk az összes menüt, kivéve amire kattintottunk
            allDropdowns.forEach(item => {
                if (item !== dropdown) {
                    item.classList.remove('open');
                }
            });
            
            // Forgató nyilak kezelése
            allArrows.forEach(arrow => {
                if (arrow.parentElement !== document.querySelector(`[onclick="toggleDropdown('${id}')"]`)) {
                    arrow.classList.remove('fa-chevron-up');
                    arrow.classList.add('fa-chevron-down');
                }
            });
            
            // Megnyitjuk/bezárjuk a kiválasztott menüt
            dropdown.classList.toggle('open');
            
            // Nyíl forgatása
            const arrow = document.querySelector(`[onclick="toggleDropdown('${id}')"] .dropdown-arrow`);
            if (arrow) {
                arrow.classList.toggle('fa-chevron-up');
                arrow.classList.toggle('fa-chevron-down');
            }
        }
        
        // Oldalsó menü becsukása/kinyitása (reszponzív)
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('open');
        }
        
        // Az oldal betöltésekor bezárjuk a dropdown menüket
        document.addEventListener('DOMContentLoaded', function() {
            const dropdowns = document.querySelectorAll('.dropdown-menu');
            dropdowns.forEach(dropdown => {
                dropdown.classList.remove('open');
            });
        });
    </script>
</body>
</html>