<div class="content-wrapper">
    <? $this->load->view('backend/templates/breadcrumbs');?>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <?= $this->session->flashdata('message') ?>
                    <div class="card card-primary card-outline">
                        <div class="card-header">

                            <div class="card-tools">
                                <div class="input-group input-group-sm">
                                    <input type="text" name="search" class="form-control float-right" value="<?= $this->input->cookie('fhalaman') ?>" placeholder="Search">

                                    <div class="input-group-append">
                                        <button fhalaman type="button" class="btn btn-default"><i class="fas fa-search"></i></button>
                                        <a href="<?= base_url('halaman/data/') ?>" class="btn btn-info"><i class="fas fa-plus"></i> Tambah</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="tableDiv" class="card-body p-0">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th width="5%">NO</th>
                                        <th>Judul</th>
                                        <th>Tanggal Buat</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = $this->uri->segment('3') + 1;
                                    if (empty($data)) {
                                        echo "<tr><td colspan='4' class='text-center'> Data Tidak Ditemukan!</td></tr>";
                                    } else {
                                        foreach ($data as $key => $value) {

                                            echo "<tr data-link='halaman/delete/' data-id='" . encode($value['id']) . "'>";
                                            echo "<td>" . $no++ . "</td>";
                                            echo "<td><b>" . character_limiter($value['judul'], 40) . "</b><br/></td>";
                                            echo "<td><b>" . tanggal($value['date_created']) . "</b><br/></td>";
                                            echo "<td class='text-center'>";
                                            echo "<a href='" . base_url('halaman/detail/' . $value['slug']) . "' class='btn btn-icon btn-xs btn-default ml-1' title='Lihat Halaman' target='_blank'><i class='fas fa-eye'></i></a>";
                                            echo "<button bChange class='btn btn-icon btn-xs btn-" . ($value['publish'] == 1 ? 'success' : 'warning') . " ml-1'><i class='fas fa-" . ($value['publish'] == 1 ? 'thumbs-up' : 'thumbs-down') . "'></i></button>";
                                            echo "<a href='" . base_url('halaman/data/') . encode($value['id']) . "' class='btn btn-icon btn-xs btn-info ml-1'><i class='fas fa-pencil-alt' title='edit'></i></a>";
                                            echo "<a removeData href='javascript:void(0);' class='btn btn-icon btn-xs btn-danger ml-1'><i class='fas fa-trash'></i></a>";
                                            echo "</td>";
                                            echo "</tr>";
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer float-right">
                            <?= $pagin; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .font10 {
        font-size: 14px;
    }
</style>
<script>
    $(document).ready(function() {
        $('[fhalaman]').click(function() {
            Cookies.set('fhalaman', $('[name="search"]').val());
            location.window.href = location.window.href;
        });
        $(document).on('click', '[bChange]', function() {
            var url = 'halaman/changepublish/';
            var id = $(this).closest('tr').data('id');
            var btn = $(this);
            changePublish(url, id, btn);
            return false;
        });
        $(document).on('submit', '#submitProduk', function(e) {
            e.preventDefault();
            var fileInput = $.trim($('[Fgambar]').val());

            <?php if (!isset($data['gambar'])) { ?>
                if (fileInput == '') {
                    Swal.fire(
                        'Terjadi Kesalahan!',
                        'Silahkan pilih gambar terlebih dahulu!',
                        'error'
                    );
                    return false;
                }
            <?php } ?>

            SimpanMaster(this, $(this).attr('action'), function(success) {
                // if (success.success) reload();
            }, function(error) {});
            return false;
        });
    });
</script>