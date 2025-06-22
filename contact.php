<?php
$page_title = "İletişim";
include 'includes/header.php';
?>

<section class="py-5 bg-light">
    <div class="container">
        
        <div class="row g-5">
            <!-- İletişim Bilgileri -->
            <div class="col-lg-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body p-4">
                        <h4 class="card-title mb-4">İletişim Bilgileri</h4>
                        
                        <div class="d-flex align-items-center mb-4">
                            <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div>
                                <h6 class="mb-1">E-posta</h6>
                                <p class="text-muted mb-0">info@example.com</p>
                            </div>
                        </div>
                        
                        <div class="d-flex align-items-center mb-4">
                            <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                                <i class="fas fa-phone"></i>
                            </div>
                            <div>
                                <h6 class="mb-1">Telefon</h6>
                                <p class="text-muted mb-0">+90 555 123 45 67</p>
                            </div>
                        </div>
                        
                        <div class="d-flex align-items-center mb-4">
                            <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div>
                                <h6 class="mb-1">Adres</h6>
                                <p class="text-muted mb-0">İstanbul, Türkiye</p>
                            </div>
                        </div>
                        
                        <div class="d-flex align-items-center">
                            <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div>
                                <h6 class="mb-1">Çalışma Saatleri</h6>
                                <p class="text-muted mb-0">Pazartesi - Cuma: 09:00 - 18:00</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- İletişim Formu -->
            <div class="col-lg-8">
                <div class="card shadow-sm">
                    <div class="card-body p-4">
                        <h4 class="card-title mb-4">Mesaj Gönderin</h4>
                        
                        <form>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="firstName" class="form-label">Ad *</label>
                                    <input type="text" class="form-control" id="firstName" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="lastName" class="form-label">Soyad *</label>
                                    <input type="text" class="form-control" id="lastName" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="email" class="form-label">E-posta *</label>
                                    <input type="email" class="form-control" id="email" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="phone" class="form-label">Telefon</label>
                                    <input type="tel" class="form-control" id="phone">
                                </div>
                                <div class="col-12">
                                    <label for="subject" class="form-label">Konu *</label>
                                    <select class="form-select" id="subject" required>
                                        <option value="">Konu seçiniz</option>
                                        <option value="proje">Proje Teklifi</option>
                                        <option value="isbirligi">İş Birliği</option>
                                        <option value="sorular">Genel Sorular</option>
                                        <option value="diger">Diğer</option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label for="message" class="form-label">Mesajınız *</label>
                                    <textarea class="form-control" id="message" rows="5" placeholder="Mesajınızı buraya yazın..." required></textarea>
                                </div>
                                <div class="col-12">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="privacy" required>
                                        <label class="form-check-label" for="privacy">
                                            <a href="#" class="text-decoration-none">Gizlilik Politikası</a>'nı okudum ve kabul ediyorum *
                                        </label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-outline-primary btn-md">
                                        <i class="fas fa-paper-plane me-2"></i>
                                        Mesaj Gönder
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Sosyal Medya -->
        <div class="row mt-5">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-body text-center p-4">
                        <h4 class="card-title mb-4">Sosyal Medyada Takip Edin</h4>
                        <div class="d-flex justify-content-center gap-3">
                            <a href="#" class="btn btn-outline-primary btn-lg">
                                <i class="fab fa-linkedin fa-2x"></i>
                            </a>
                            <a href="#" class="btn btn-outline-primary btn-lg">
                                <i class="fab fa-github fa-2x"></i>
                            </a>
                            <a href="#" class="btn btn-outline-primary btn-lg">
                                <i class="fab fa-twitter fa-2x"></i>
                            </a>
                            <a href="#" class="btn btn-outline-primary btn-lg">
                                <i class="fab fa-instagram fa-2x"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>