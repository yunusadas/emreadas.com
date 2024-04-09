<div class="modal fade" id="marka_ekle_modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Marka Bilgisi Ekle </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col mb-3">
                        <label for="marka_ad_box" class="form-label">Marka Adı</label>
                        <input type="text" id="marka_ad_box" class="form-control marka_ekle_ad"
                               placeholder="Kategroi Adı">
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3">
                        <label for="ekle_durum" class="form-label">Marka Durumu</label>
                        <select class="form-select marka_ekle_durum" id="ekle_durum"
                                aria-label="Default select example">
                            <option selected>Seçiniz</option>
                            <option value="1">Aktif</option>
                            <option value="2">Pasif</option>
                        </select>
                    </div>
                </div>
                <!--todo buraya 1. div-->
                <div class="row">
                    <div class="mb-3">
                        <form id="marka_ekle_resim_form" method="post" enctype="multipart/form-data">
                            <label for="marka_ekle_resim_id" class="form-label">Marka Görseli</label>
                            <div class="input-group">
                                <input id="marka_ekle_resim_id" accept="image/png, image/jpeg, image/jpg"
                                       name="marka_ekle_resim" type="file" class="form-control"
                                       aria-describedby="inputGroupFileAddon03" aria-label="Upload"/>
                            </div>
                            <div id="marka_ekle_resim_uyari" class="form-text">
                                Lütfen resim giriniz ve boyutları 120x87 ayarlayınız.
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary marka_ekle">Ekle</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="marka_duzenle_modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="marka_duzenle_modal_baslik">Marka Bilgisi Düzenle </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col mb-3">
                        <label for="marka_ad_box_2" class="form-label">Marka Adı</label>
                        <input type="text" id="marka_ad_box_2" class="form-control marka_guncelle_ad" placeholder="Kategroi Adı">
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3">
                        <label for="exampleFormControlSelect1" class="form-label">Marka Durumu</label>
                        <select class="form-select marka_guncelle_durum" id="exampleFormControlSelect1"
                                aria-label="Default select example">
                            <option selected>Seçiniz</option>
                            <option value="1">Aktif</option>
                            <option value="2">Pasif</option>
                        </select>
                    </div>
                </div>
                <!--todo 2. div-->
                <div class="row">
                    <div class="mb-3">
                        <form id="marka_resim_form_duzenle" method="post" enctype="multipart/form-data">
                            <label for="marka_resim_duzenle_id" class="form-label">Marka Görseli</label>
                            <div class="input-group">
                                <input id="marka_resim_duzenle_id" accept="image/png, image/jpeg, image/jpg"
                                       name="marka_duzenle_resim" type="file" class="form-control"
                                       aria-describedby="inputGroupFileAddon03" aria-label="Upload"/>
                            </div>
                            <div id="marka_duzenle_uyari" class="form-text">
                                Lütfen resim giriniz ve boyutları 120x87 ayarlayınız.
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-label-secondary kapat" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary marka_duzenle">Güncelle</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="marka_sil_modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Marka Sil</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">Silme işlemini <strong>onaylıyor musunuz?</strong></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Kapat</button>
                <button type="button" class="btn btn-primary marka_sil">Sil</button>
            </div>
        </div>
    </div>
</div>
