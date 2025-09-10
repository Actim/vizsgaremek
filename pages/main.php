
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Horgásztavak Bérlése - Pihenés és horgászat</title>
    <style>
        /* Alap stílusok */
        :root {
            --primary-color: #0a3d62;
            --secondary-color: #079992;
            --accent-color: #ff9800;
            --light-color: #e8faf9ff;
            --dark-color: #091c29ff;
            --text-color: #333;
            --shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            color: var(--text-color);
            line-height: 1.6;
            background-color: #f8f9fa;
        }
        
        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        
        /* Navigáció */
        header {
            background-color: white;
            box-shadow: var(--shadow);
            position: sticky;
            top: 0;
            z-index: 100;
        }
        
        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 0;
        }
        
        .logo {
            font-size: 24px;
            font-weight: bold;
            color: var(--primary-color);
            display: flex;
            align-items: center;
        }
        
        .logo i {
            margin-right: 10px;
            font-size: 28px;
        }
        
        .nav-links {
            display: flex;
            list-style: none;
        }
        
        .nav-links li {
            margin-left: 30px;
        }
        
        .nav-links a {
            text-decoration: none;
            color: var(--text-color);
            font-weight: 500;
            transition: color 0.3s;
        }
        
        .nav-links a:hover {
            color: var(--primary-color);
        }
        
        .btn {
            display: inline-block;
            background-color: var(--primary-color);
            color: white;
            padding: 10px 20px;
            border-radius: 4px;
            text-decoration: none;
            font-weight: 500;
            transition: background-color 0.3s;
        }
        
        .btn:hover {
            background-color: var(--dark-color);
        }
        
        .btn-accent {
            background-color: var(--accent-color);
        }
        
        .btn-accent:hover {
            background-color: #ef6c00;
        }
        
        /* Hero rész */
        .hero {
            background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('https://placehold.co/1200x600/1b5e20/white?text=Horgásztavak') no-repeat center center/cover;
            color: white;
            padding: 100px 0;
            text-align: center;
        }
        
        .hero h1 {
            font-size: 48px;
            margin-bottom: 20px;
        }
        
        .hero p {
            font-size: 20px;
            max-width: 700px;
            margin: 0 auto 30px;
        }
        
        /* Kereső mező */
        .search-box {
            background-color: white;
            border-radius: 8px;
            padding: 25px;
            margin-top: -40px;
            box-shadow: var(--shadow);
            position: relative;
            z-index: 10;
        }
        
        .search-form {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
        }
        
        .form-group {
            margin-bottom: 15px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: 500;
        }
        
        .form-group input, .form-group select {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
        }
        
        .search-btn {
            grid-column: 1 / -1;
            background-color: var(--accent-color);
            color: white;
            border: none;
            padding: 12px;
            border-radius: 4px;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        
        .search-btn:hover {
            background-color: #ef6c00;
        }
        
        /* Szolgáltatások */
        .services {
            padding: 80px 0;
            text-align: center;
        }
        
        .section-title {
            font-size: 36px;
            margin-bottom: 50px;
            color: var(--primary-color);
            position: relative;
            display: inline-block;
        }
        
        .section-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 3px;
            background-color: var(--accent-color);
        }
        
        .services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
            margin-top: 50px;
        }
        
        .service-card {
            background-color: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: var(--shadow);
            transition: transform 0.3s;
        }
        
        .service-card:hover {
            transform: translateY(-10px);
        }
        
        .service-img {
            height: 200px;
            background-color: var(--secondary-color);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 48px;
        }
        
        .service-content {
            padding: 20px;
        }
        
        .service-content h3 {
            margin-bottom: 10px;
            color: var(--primary-color);
        }
        
        /* Népszerű tavak */
        .popular-lakes {
            padding: 80px 0;
            background-color: var(--light-color);
        }
        
        .lakes-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
        }
        
        .lake-card {
            background-color: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: var(--shadow);
        }
        
        .lake-img {
            height: 200px;
            background-color: var(--primary-color);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 20px;
            position: relative;
        }
        
        .lake-price {
            position: absolute;
            top: 15px;
            right: 15px;
            background-color: var(--accent-color);
            color: white;
            padding: 5px 10px;
            border-radius: 20px;
            font-weight: bold;
        }
        
        .lake-content {
            padding: 20px;
        }
        
        .lake-content h3 {
            margin-bottom: 10px;
            color: var(--primary-color);
        }
        
        .lake-features {
            display: flex;
            flex-wrap: wrap;
            margin: 15px 0;
        }
        
        .lake-feature {
            display: flex;
            align-items: center;
            margin-right: 15px;
            margin-bottom: 10px;
            font-size: 14px;
        }
        
        .lake-feature i {
            margin-right: 5px;
            color: var(--secondary-color);
        }
        
        .rating {
            color: #ffc107;
            margin-bottom: 15px;
        }
        
        /* Hogyan működik */
        .how-it-works {
            padding: 80px 0;
            text-align: center;
        }
        
        .steps {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
            margin-top: 50px;
        }
        
        .step {
            text-align: center;
            padding: 30px 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: var(--shadow);
        }
        
        .step-number {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 60px;
            height: 60px;
            background-color: var(--primary-color);
            color: white;
            font-size: 24px;
            font-weight: bold;
            border-radius: 50%;
            margin: 0 auto 20px;
        }
        
        /* Vélemények */
        .testimonials {
            padding: 80px 0;
            background-color: var(--light-color);
            text-align: center;
        }
        
        .testimonials-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            margin-top: 50px;
        }
        
        .testimonial {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: var(--shadow);
            text-align: left;
        }
        
        .testimonial-content {
            margin-bottom: 20px;
            font-style: italic;
        }
        
        .testimonial-author {
            display: flex;
            align-items: center;
        }
        
        .author-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background-color: var(--secondary-color);
            margin-right: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
        }
        
        /* Hírlevél */
        .newsletter {
            padding: 80px 0;
            text-align: center;
            background: linear-gradient(rgba(0,0,0,0.8), rgba(0,0,0,0.8)), url('') no-repeat center center/cover;
            color: white;
        }
        
        .newsletter-form {
            display: flex;
            max-width: 500px;
            margin: 30px auto 0;
        }
        
        .newsletter-form input {
            flex: 1;
            padding: 15px;
            border: none;
            border-radius: 4px 0 0 4px;
            font-size: 16px;
        }
        
        .newsletter-form button {
            background-color: var(--accent-color);
            color: white;
            border: none;
            padding: 0 20px;
            border-radius: 0 4px 4px 0;
            font-weight: bold;
            cursor: pointer;
        }
        
        /* Lábléc */
        footer {
            background-color: var(--dark-color);
            color: white;
            padding: 60px 0 30px;
        }
        
        .footer-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 30px;
            margin-bottom: 40px;
        }
        
        .footer-column h3 {
            margin-bottom: 20px;
            font-size: 18px;
            position: relative;
            padding-bottom: 10px;
        }
        
        .footer-column h3::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 40px;
            height: 2px;
            background-color: var(--accent-color);
        }
        
        .footer-links {
            list-style: none;
        }
        
        .footer-links li {
            margin-bottom: 10px;
        }
        
        .footer-links a {
            color: #ddd;
            text-decoration: none;
            transition: color 0.3s;
        }
        
        .footer-links a:hover {
            color: white;
        }
        
        .social-links {
            display: flex;
            margin-top: 20px;
        }
        
        .social-links a {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            background-color: rgba(255,255,255,0.1);
            border-radius: 50%;
            margin-right: 10px;
            color: white;
            text-decoration: none;
            transition: background-color 0.3s;
        }
        
        .social-links a:hover {
            background-color: var(--accent-color);
        }
        
        .copyright {
            text-align: center;
            padding-top: 30px;
            border-top: 1px solid rgba(255,255,255,0.1);
            font-size: 14px;
        }
        
        /* Reszponzív design */
        @media (max-width: 768px) {
            .nav-links {
                display: none;
            }
            
            .hero h1 {
                font-size: 36px;
            }
            
            .hero p {
                font-size: 18px;
            }
            
            .newsletter-form {
                flex-direction: column;
            }
            
            .newsletter-form input {
                border-radius: 4px;
                margin-bottom: 10px;
            }
            
            .newsletter-form button {
                border-radius: 4px;
                padding: 15px;
            }
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <!-- Fejléc -->
    <header>
        <div class="container">
            <nav>
                <a href="#" class="logo">
                    <i class="fas fa-fish"></i>
                    Horgásztavak
                </a>
                <a href="login" class="btn">Bejelentkezés</a>
            </nav>
        </div>
    </header>

    <!-- Hero rész -->
    <section class="hero">
        <div class="container">
            <h1>Pihenés és horgászat egy helyen</h1>
            <p>Fedezd fel legszebb horgásztavainkat, ahol nemcsak a halak, hanem a nyugalom is bőségesen van</p>
            <a href="#search" class="btn btn-accent">Foglalás most</a>
        </div>
    </section>

    <!-- Kereső mező -->
    <div class="container">
        <div class="search-box" id="search">
            <form class="search-form">
                <div class="form-group">
                    <label for="location">Helyszín</label>
                    <input type="text" id="location" placeholder="Hol szeretnél horgászni?">
                </div>
                <div class="form-group">
                    <label for="date">Dátum</label>
                    <input type="date" id="date">
                </div>
                <div class="form-group">
                    <label for="people">Vendégek száma</label>
                    <select id="people">
                        <option value="1">1 fő</option>
                        <option value="2">2 fő</option>
                        <option value="3">3 fő</option>
                        <option value="4+">4+ fő</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="fish-type">Hal típusa</label>
                    <select id="fish-type">
                        <option value="all">Minden hal</option>
                        <option value="carp">Ponty</option>
                        <option value="catfish">Harcsa</option>
                        <option value="pike">Süllő</option>
                    </select>
                </div>
                <button type="submit" class="search-btn">Szabad helyek keresése</button>
            </form>
        </div>
    </div>

    <!-- Szolgáltatások -->
    <section class="services">
        <div class="container">
            <h2 class="section-title">Miért válassz minket?</h2>
            <div class="services-grid">
                <div class="service-card">
                    <div class="service-img">
                        <i class="fas fa-water"></i>
                    </div>
                    <div class="service-content">
                        <h3>Kiváló minőségű tavak</h3>
                        <p>Mindegyik tó amit megtalálhatsz az oldalon ellenőrzött minőségü.</p>
                    </div>
                </div>
                <div class="service-card">
                    <div class="service-img">
                        <i class="fas fa-home"></i>
                    </div>
                    <div class="service-content">
                        <h3>Kényelmes foglalás</h3>
                        <p>Kényelmesen foglalhatsz le tavakat az egész ország területén, fej fájás nélkül.</p>
                    </div>
                </div>
                <div class="service-card">
                    <div class="service-img">
                        <i class="fas fa-tools"></i>
                    </div>
                    <div class="service-content">
                        <h3>Felszerelés bérlés</h3>
                        <p>Nincs saját felszerelésed? Nálunk bérelhetsz minőségi horgászeszközöket.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Népszerű tavak -->
    <section class="popular-lakes">
        <div class="container">
            <h2 class="section-title">Népszerű tavaink</h2>
            <div class="lakes-grid">
                <div class="lake-card">
                    <div class="lake-img">
                        <div class="lake-price">5.000 Ft/nap</div>
                        Aranyhal-tó
                    </div>
                    <div class="lake-content">
                        <h3>Aranyhal-tó</h3>
                        <p>Családias hangulatú horgásztó, rengeteg pontyhal és amurral.</p>
                        <div class="lake-features">
                            <div class="lake-feature">
                                <i class="fas fa-fish"></i> Ponty, Amur
                            </div>
                            <div class="lake-feature">
                                <i class="fas fa-car"></i> Parkoló
                            </div>
                            <div class="lake-feature">
                                <i class="fas fa-campground"></i> Kunyhó
                            </div>
                        </div>
                        <div class="rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                            <span>(128 értékelés)</span>
                        </div>
                        <a href="#" class="btn">Részletek</a>
                    </div>
                </div>
                <div class="lake-card">
                    <div class="lake-img">
                        <div class="lake-price">7.000 Ft/nap</div>
                        Zöld Öböl
                    </div>
                    <div class="lake-content">
                        <h3>Zöld Öböl</h3>
                        <p>Természetes tó süllővel és harcsával, csodás környezetben.</p>
                        <div class="lake-features">
                            <div class="lake-feature">
                                <i class="fas fa-fish"></i> Süllő, Harcsa
                            </div>
                            <div class="lake-feature">
                                <i class="fas fa-car"></i> Parkoló
                            </div>
                            <div class="lake-feature">
                                <i class="fas fa-fire"></i> Grillezés
                            </div>
                        </div>
                        <div class="rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <span>(95 értékelés)</span>
                        </div>
                        <a href="#" class="btn">Részletek</a>
                    </div>
                </div>
                <div class="lake-card">
                    <div class="lake-img">
                        <div class="lake-price">6.500 Ft/nap</div>
                        Nyugalom-öböl
                    </div>
                    <div class="lake-content">
                        <h3>Nyugalom-öböl</h3>
                        <p>Csendes, természetközeli tó, ideális a pihenésre és horgászatra.</p>
                        <div class="lake-features">
                            <div class="lake-feature">
                                <i class="fas fa-fish"></i> Ponty, Kárász
                            </div>
                            <div class="lake-feature">
                                <i class="fas fa-utensils"></i> Étterem
                            </div>
                            <div class="lake-feature">
                                <i class="fas fa-shower"></i> Zuhanyzó
                            </div>
                        </div>
                        <div class="rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="far fa-star"></i>
                            <span>(76 értékelés)</span>
                        </div>
                        <a href="#" class="btn">Részletek</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Hogyan működik -->
    <section class="how-it-works">
        <div class="container">
            <h2 class="section-title">Hogyan működik?</h2>
            <div class="steps">
                <div class="step">
                    <div class="step-number">1</div>
                    <h3>Válaszd ki a tavat</h3>
                    <p>Böngéssz tavaink között és válaszd ki a számodra legmegfelelőbbet.</p>
                </div>
                <div class="step">
                    <div class="step-number">2</div>
                    <h3>Foglalj időpontot</h3>
                    <p>Válaszd ki a dátumot és foglald le helyedet néhány kattintással.</p>
                </div>
                <div class="step">
                    <div class="step-number">3</div>
                    <h3>Élvezd a horgászatot</h3>
                    <p>Erkölj el a kiválasztott napon és éld át a horgászat örömét!</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Vélemények -->
    <section class="testimonials">
        <div class="container">
            <h2 class="section-title">Vendégeink véleménye</h2>
            <div class="testimonials-grid">
                <div class="testimonial">
                    <div class="testimonial-content">
                        "Csodálatos hely! Rengeteg hal, szép környezet és barátságos személyzet. Már következő alkalomra is lefoglaltuk a helyünket."
                    </div>
                    <div class="testimonial-author">
                        <div class="author-avatar">PK</div>
                        <div>
                            <h4>Kovács Péter</h4>
                            <p>Budapest</p>
                        </div>
                    </div>
                </div>
                <div class="testimonial">
                    <div class="testimonial-content">
                        "A családommal töltöttünk itt egy hétvégét. A gyerekek imádták, én pedig kifogtam egy 12 kilós pontyot! Mindenkinek csak ajánlani tudom."
                    </div>
                    <div class="testimonial-author">
                        <div class="author-avatar">EZ</div>
                        <div>
                            <h4>Nagy Eszter</h4>
                            <p>Debrecen</p>
                        </div>
                    </div>
                </div>
                <div class="testimonial">
                    <div class="testimonial-content">
                        "Évente többször is megfordulok itt. Mindig kiváló a kiszolgálás, tiszta a víz és egészségesek a halak. Egy igazi horgászparadicsom."
                    </div>
                    <div class="testimonial-author">
                        <div class="author-avatar">JT</div>
                        <div>
                            <h4>Tóth János</h4>
                            <p>Szeged</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Hírlevél -->
    <section class="newsletter">
        <div class="container">
            <h2>Iratkozz fel hírlevelünkre!</h2>
            <p>Értesülj elsőként akcióinkról és újdonságainkról</p>
            <form class="newsletter-form">
                <input type="email" placeholder="Email címed">
                <button>Feliratkozás</button>
            </form>
        </div>
    </section>

    <!-- Lábléc -->
    <footer>
        <div class="container">
            <div class="footer-content">
                <div class="footer-column">
                    <h3>Horgásztavak</h3>
                    <p>Célunk, hogy minden horgász számára felejthetetlen élményt nyújtsunk.</p>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
                <div class="footer-column">
                    <h3>Oldaltérkép</h3>
                    <ul class="footer-links">
                        <li><a href="#">Kezdőlap</a></li>
                        <li><a href="#">Tavaink</a></li>
                        <li><a href="#">Áraink</a></li>
                        <li><a href="#">Rólunk</a></li>
                        <li><a href="#">Kapcsolat</a></li>
                    </ul>
                </div>
                <div class="footer-column">
                    <h3>Hasznos linkek</h3>
                    <ul class="footer-links">
                        <li><a href="#">Horgászati szabályzat</a></li>
                        <li><a href="#">GYIK</a></li>
                        <li><a href="#">Ajánlások</a></li>
                        <li><a href="#">Események</a></li>
                    </ul>
                </div>
                <div class="footer-column">
                    <h3>Kapcsolat</h3>
                    <ul class="footer-links">
                        <li><i class="fas fa-map-marker-alt"></i> 1234 Halász utca, Budapest</li>
                        <li><i class="fas fa-phone"></i> +36 1 234 5678</li>
                        <li><i class="fas fa-envelope"></i> info@horgasztavak.hu</li>
                    </ul>
                </div>
            </div>
            <div class="copyright">
                <p>&copy; 2023 Horgásztavak Bérlése - Minden jog fenntartva</p>
            </div>
        </div>
    </footer>

    <script>
        // Egyszerű JavaScript a dátum mező beállításához
        document.addEventListener('DOMContentLoaded', function() {
            // Állítsuk be a dátum mezőt a holnapi napra
            const tomorrow = new Date();
            tomorrow.setDate(tomorrow.getDate() + 1);
            
            const formattedDate = tomorrow.toISOString().split('T')[0];
            document.getElementById('date').value = formattedDate;
            
            // Search form eseménykezelő
            const searchForm = document.querySelector('.search-form');
            searchForm.addEventListener('submit', function(e) {
                e.preventDefault();
                alert('Keresés indítása... (Ez egy demo, a keresés funkció nincs implementálva)');
            });
        });
    </script>
</body>
</html>