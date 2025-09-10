

    <!-- Fő tartalom -->


        <!-- Statisztika kártyák -->
        <div class="stats-cards">
            <div class="card card-primary">
                <div class="card-title">Felhasználók</div>
                <div class="card-value"><?=getAllUsers();?></div>
                <div class="card-icon"><i class="fas fa-users"></i></div>
            </div>
            
            <div class="card card-success">
                <div class="card-title">Oldal megtekintések (Az elmúlt 30 napban)</div>
                <div class="card-value"><?=getAllViewsByDay(30);?></div>
                <div class="card-icon"><i class="fa-solid fa-eye"></i></div>
            </div>
            
            <div class="card card-info">
                <div class="card-title">Bejelentkezések (Az elmúlt 30 napban)</div>
                <div class="card-value"><?=getAllLoginsByDay(30)?></div>
                <div class="card-icon"><i class="fa-solid fa-right-to-bracket"></i></div>
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
