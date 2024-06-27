<?php
require_once '../classes/Divisi.php';
require_once '../classes/Posisi.php';
?>
<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Form Loker</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form class="row g-3" id="form-loker">
                <div class="col-md-6">
                    <label for="posisi" class="form-label">Posisi</label>
                    <select id="posisi" name="posisi" class="form-select">
                        <option value="">-- pilih posisi --</option>
                        <?php foreach ($posisi->getAllPosisi() as $pos) : ?>
                            <option value="<?= $pos['id_posisi'] ?>"><?= ucwords($pos['nama_posisi']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="divisi" class="form-label">Divisi</label>
                    <select id="divisi" name="divisi" class="form-select">
                        <option value="">-- pilih divisi --</option>
                        <?php foreach ($divisi->getAllDivisi() as $div) : ?>
                            <option value="<?= $div['id_divisi'] ?>"><?= ucwords($div['nama_divisi']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-8">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <textarea class="form-control" id="deskripsi" name="deskripsi" placeholder="Deskripsi ..." rows="3"></textarea>
                </div>
                <div class="col-md-4">
                    <label for="jumlah_kebutuhan" class="form-label">Jumlah Kebutuhan</label>
                    <input type="number" class="form-control" id="jumlah_kebutuhan" name="jumlah_kebutuhan">
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" onclick="saveLoker()">Simpan</button>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#posisi').select2({
            theme: "bootstrap-5",
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            dropdownParent: $('#posisi').closest('.modal-content')
        });
        $('#divisi').select2({
            theme: "bootstrap-5",
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            dropdownParent: $('#divisi').closest('.modal-content')
        });
    });

    function saveLoker() {
        let form = $('#form-loker').serializeArray();
        let send = {};
        let data = [];
        form.forEach((item) => {
            if (item.value == '') {
                data.push(item.name);
            } else {
                send[item.name] = item.value;
            }
        });
        send['action'] = 'addLoker';

        if (data.length > 0) {
            Lobibox.notify('error', {
                size: 'mini',
                rounded: true,
                sound: false,
                delay: 2000,
                delayIndicator: true,
                position: 'top right',
                icon: 'bx bx-error',
                msg: 'Data ' + data.join(', ') + ' tidak boleh kosong!'
            });
            return;
        }

        $.ajax({
            url: 'classes/Loker.php',
            type: 'POST',
            data: send,
            success: function(response) {
                let res = JSON.parse(response);
                Lobibox.notify(`${res.status}`, {
                    size: 'mini',
                    rounded: true,
                    sound: false,
                    delay: 2000,
                    delayIndicator: true,
                    position: 'top right',
                    icon: `${res.icon}`,
                    msg: `${res.message}`
                });
                if (res.status == 'success') {
                    setTimeout(() => {
                        window.location.href = 'dashboard.php?page=lowongan_kerja';
                    }, 2000);
                }
            }
        });
    }
</script>