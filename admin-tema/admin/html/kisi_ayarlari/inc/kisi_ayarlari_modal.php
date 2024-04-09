<div class="modal fade" id="duzenle_modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Giriş Bilgisi Düzenle </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col mb-3">
                        <label for="eski_sifre_box" class="form-label">Eski Şifre</label>
                        <input type="password" id="eski_sifre_box" class="form-control eski_sifre" placeholder="Eski Şifre">
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="yeni_sifre_box" class="form-label">Yeni Şifre</label>
                        <input type="password" id="yeni_sifre_box" class="form-control yeni_sifre" placeholder="Yeni Şifre">
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="yeni_sifre_tekrar_box" class="form-label">Yeni Şifre Tekrar</label>
                        <input type="password" id="yeni_sifre_tekrar_box" class="form-control yeni_sifre_tekrar"
                               placeholder="Yeni Şifre Tekrar">
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-label-secondary kapat" data-bs-dismiss="modal">Kapat</button>
                <button type="button" class="btn btn-primary kisi_duzenle">Güncelle</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="sil_modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Sil Modal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">Silme işlemini <strong>onaylıyor musunuz?</strong></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Kapat</button>
                <button type="button" class="btn btn-primary kisi_sil">Sil</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="ekle_modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Giriş Bilgisi Ekle </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col mb-3">
                        <label for="kisi_ad_box" class="form-label">Kişi Adı</label>
                        <input type="text" id="kisi_ad_box" class="form-control kisi_ad" placeholder="Ad">
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="kisi_soyad_box" class="form-label">Kişi Soyadı</label>
                        <input type="text" id="kisi_soyad_box" class="form-control kisi_soyad" placeholder="Soyad">
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-0">
                        <label for="emailWithTitle" class="form-label">Email</label>
                        <input
                                type="text"
                                id="emailWithTitle"
                                class="form-control kisi_email"
                                placeholder="xxxx@xxx.xx"
                        />
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="kisi_sifre_box" class="form-label">Şifre</label>
                        <input type="password" id="kisi_sifre_box" class="form-control kisi_sifre" placeholder="****">
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="kisi_sifre_tekrar_box" class="form-label">Şifre Tekrar</label>
                        <input type="password" id="kisi_sifre_tekrar_box" class="form-control kisi_sifre_tekrar" placeholder="****">
                    </div>
                </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Kapat</button>
                <button type="button" class="btn btn-primary kisi_ekle">Ekle</button>
            </div>
        </div>
    </div>
</div>