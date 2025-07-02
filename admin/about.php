<?php
$page_title = "Hakkımda";
include 'includes/header.php';
?>
    <body class="layout-fixed sidebar-expand-lg sidebar-open bg-body-tertiary">
        <div class="app-wrapper">
            <?php
            include 'includes/sidebar.php';
            ?>
      
            <main class="app-main">
            
            <div class="container mt-2 d-flex justify-content-center gap-5">
                <div class="card shadow-lg w-50">
                    <div class="card-header bg-secondary text-white">   
                        <h5 class="mb-0">Profil Kartı</h5>
                    </div>
                    <div class="card-body">
                        <form action="/upload" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="photo" class="form-label">Bir fotoğraf seçin</label>
                            <input class="form-control" type="file" id="photo" name="photo" accept="image/*" required>
                        </div>

                        <!-- Metin Alanı 1 -->
                        <div class="mb-3">
                            <label for="title" class="form-label">Adınız Soyadınız</label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="Bünyamin YUSUFOĞLU" required>
                        </div>

                        <!-- Metin Alanı 2 -->
                        <div class="mb-3">
                            <label for="description" class="form-label">Ünvan Giriniz</label>
                            <input type="text" class="form-control" id="description" name="description" placeholder="Full Stack Developer" required>
                        </div>

                        <button type="submit" class="btn btn-success">Güncelle</button>
                        </form>
                    </div>
                </div>
                <div class="card shadow-lg w-50">
                    <div class="card-header bg-secondary text-white">
                        <h5 class="mb-0">İstatistik Kartı</h5>
                    </div>
                    <div class="card-body">
                        <form action="/upload" method="POST" enctype="multipart/form-data">
                        <!-- Metin Alanı 1 -->
                        <div class="mb-3 d-flex flex-column gap-2">
                            <label for="title" class="form-label">Başlık ve Değer</label>
                            <div class="d-flex gap-2">
                                <input type="text" class="form-control w-75" id="title" name="title" placeholder="İstatistik Başlığı" required>
                                <input type="text" class="form-control w-25" id="description" name="description" placeholder="İstatistik Değeri" required>
                            </div>
                            <div class="d-flex gap-2">
                                <input type="text" class="form-control w-75" id="title" name="title" placeholder="İstatistik Başlığı" required>
                                <input type="text" class="form-control w-25" id="description" name="description" placeholder="İstatistik Değeri" required>
                            </div>
                            <div class="d-flex gap-2">
                                <input type="text" class="form-control w-75" id="title" name="title" placeholder="İstatistik Başlığı" required>
                                <input type="text" class="form-control w-25" id="description" name="description" placeholder="İstatistik Değeri" required>
                            </div>
                            <div class="d-flex gap-2">
                                <input type="text" class="form-control w-75" id="title" name="title" placeholder="İstatistik Başlığı" required>
                                <input type="text" class="form-control w-25" id="description" name="description" placeholder="İstatistik Değeri" required>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-success">Güncelle</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="container mt-2 d-flex justify-content-center gap-5 w-100">
                <div class="card shadow-lg w-100">
                    <div class="card-header bg-secondary text-white w-100">
                        <h5 class="mb-0">Bölüm 3</h5>
                    </div>
                    <div class="card-body w-100">
                        <form action="/upload" method="POST" enctype="multipart/form-data">
                        <div class="mb-3 d-flex gap-2 w-100">
                            <div class="w-100">
                                <label for="title" class="form-label">Başlık</label>                                
                                <input type="text" class="form-control" id="title" name="title" placeholder="Ben Kimim?" required>
                                <label for="title" class="form-label mt-2">Açıklama</label>                                
                                <textarea class="form-control" id="title" name="title" placeholder="Merhaba! Ben Bünyamin YUSUFOĞLU, tutkulu bir Full Stack Developer'ım. Web teknolojileri konusunda 5+ yıllık deneyime sahibim ve sürekli kendimi geliştirmeye odaklanıyorum." rows="5" required></textarea>
                            </div>
                            <div class="w-100">
                                <label for="title" class="form-label">Başlık</label>                                
                                <input type="text" class="form-control" id="title" name="title" placeholder="Deneyimim" required>
                                <label for="title" class="form-label mt-2">Açıklama</label>                                
                                <textarea class="form-control" id="title" name="title" placeholder="Çeşitli sektörlerde web uygulamaları geliştirdim. E-ticaret platformları, kurumsal web siteleri, mobil uygulamalar ve API geliştirme konularında deneyimliyim." rows="5" required></textarea>
                            </div>
                            <div class="w-100">
                                <label for="title" class="form-label">Başlık</label>                                
                                <input type="text" class="form-control" id="title" name="title" placeholder="Yaklaşımım" required>
                                <label for="title" class="form-label mt-2">Açıklama</label>                                
                                <textarea class="form-control" id="title" name="title" placeholder="Kullanıcı deneyimini ön planda tutarak, modern ve sürdürülebilir kod yazmaya odaklanırım. Her projede en güncel teknolojileri kullanmaya özen gösteririm." rows="5" required></textarea>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-success">Güncelle</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="container mt-2 d-flex justify-content-center gap-5 w-100">
                <div class="card shadow-lg w-100">
                    <div class="card-header bg-secondary text-white w-100">
                        <h5 class="mb-0">Bölüm 4</h5>
                    </div>
                    <div class="card-body w-100">
                        <form action="/upload" method="POST" enctype="multipart/form-data">
                            <label for="title" class="form-label">Başlık</label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="Çalışma Felsefem" required>
                        <div class="mb-3 mt-2 d-flex gap-2 w-100">
                            <div class="w-100">
                                <label for="title" class="form-label">Başlık</label>                                
                                <input type="text" class="form-control" id="title" name="title" placeholder="Yaratıcılık" required>
                                <label for="title" class="form-label mt-2">Açıklama</label>                                
                                <textarea class="form-control" id="title" name="title" placeholder="Her projeye özgün çözümler üretirim" rows="2" required></textarea>
                            </div>
                            <div class="w-100">
                                <label for="title" class="form-label">Başlık</label>                                
                                <input type="text" class="form-control" id="title" name="title" placeholder="Teknik Mükemmellik" required>
                                <label for="title" class="form-label mt-2">Açıklama</label>                                
                                <textarea class="form-control" id="title" name="title" placeholder="Kod kalitesi ve performans odaklı çalışırım." rows="3" required></textarea>
                            </div>
                            <div class="w-100">
                                <label for="title" class="form-label">Başlık</label>                                
                                <input type="text" class="form-control" id="title" name="title" placeholder="İşbirliği" required>
                                <label for="title" class="form-label mt-2">Açıklama</label>                                
                                <textarea class="form-control" id="title" name="title" placeholder="Müşteri ihtiyaçlarını anlayarak çalışırım." rows="3" required></textarea>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-success">Güncelle</button>
                        </form>
                    </div>
                </div>
            </div>


            </main>   

        </div>
    </body>
</html>