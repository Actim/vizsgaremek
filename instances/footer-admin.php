    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        // Téma váltó funkció
        const themeToggle = document.getElementById('theme-toggle');
        
        // Ellenőrizzük, hogy van-e mentett téma a localStorage-ban
        const savedTheme = localStorage.getItem('theme');
        if (savedTheme) {
            document.body.classList.toggle('dark-theme', savedTheme === 'dark');
            themeToggle.checked = savedTheme === 'dark';
        }
        
        // Téma váltás eseménykezelő
        themeToggle.addEventListener('change', function() {
            if (this.checked) {
                document.body.classList.add('dark-theme');
                localStorage.setItem('theme', 'dark');
            } else {
                document.body.classList.remove('dark-theme');
                localStorage.setItem('theme', 'light');
            }
        });
        
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
    <script src="https://cdn.datatables.net/2.3.4/js/dataTables.js"></script>
    <script>
        $('#allAccounts').DataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/hu.json'
            }
        });
    </script>
</body>
</html>