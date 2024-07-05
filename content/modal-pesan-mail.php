<?php
require_once '../classes/Setting.php';
$setting = $setting->getSetting();
?>
<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Pesan Email</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form id="form-pesan-email">
                <div class="mb-3">
                    <label for="pesan-email" class="form-label">Pesan</label>
                    <textarea class="form-control" name="pesan-email" rows="10"><?= $setting['pesan_email_lolos'] ?></textarea>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" onclick="sendMessage('<?= $_POST['id_lamaran'] ?>')">Kirim</button>
        </div>
    </div>
</div>
<script>
    function sendMessage(id_lamaran) {
        let form = $('#form-pesan-email').serializeArray();
        let data = {};
        form.map(item => {
            data[item.name] = item.value;
        });
        data['id_lamaran'] = id_lamaran;
        data['action'] = 'sendMailOrientasi';
        $.ajax({
            url: 'classes/Lamaran.php',
            type: 'POST',
            data: data,
            beforeSend: function() {
                Swal.fire({
                    title: 'Loading...',
                    html: 'Mohon tunggu sebentar',
                    didOpen: () => {
                        Swal.showLoading()
                    },
                    showConfirmButton: false,
                    allowOutsideClick: false
                });
            },
            success: function(data) {
                var response = JSON.parse(data);
                Swal.fire({
                    icon: response.status,
                    title: response.title,
                    text: response.msg,
                    showConfirmButton: false,
                    allowOutsideClick: false,
                    timer: 2000
                }).then((e) => {
                    if (e.dismiss === Swal.DismissReason.timer) {
                        location.reload();
                    }
                });
            }
        });
    }
</script>