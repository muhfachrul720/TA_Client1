<style>
    .sign-out {
        background-color:#007bff;
        position:absolute;
        top:2%;
        color:white;
        border-radius:20px;
        right:4%;
        font-size:20px;
        z-index:99;
    }

    .sign-out i {
        padding:10px;
    }
</style>
<body style="background-color:#F5F5F5">
    <div class="container-fluid" style="position:relative">
        <a href="<?= base_url()?>schedule" class="sign-out"><i class="fa fa-arrow-left"></i></a>
        <div class="row" style="margin:30px">
            <div class="col-lg-12" style="text-align:center;">
                <h4>Data Daftar Pengajar</h3>
                <p>Dashboard Untuk Mengelola Data Pengajar</p>
            </div>
            <?php if($this->session->flashdata('Alert') != null) {?>
            <div class="col-lg-12" style="text-align:center;">
                 <div class="alert alert-info"><?php echo $this->session->flashdata('Alert'); ?></div>
            </div>
            <?php };?>
            <form action="<?= base_url()?>user/index" method="post" style="width:100%">
            <div class="col-lg-12 mt-3">
                <div class="row">
                    <div class="col-sm-9">
                        <button type="button" data-toggle="modal" data-target="#addModal" class='btn btn-sm btn-primary'>Tambah Pengajar</button>
                    </div>
                    <div class="col-sm-2 p-0">
                        <input type="text" name="search" class="form-control form-control-sm">
                    </div>
                    <div class="col-sm-1">
                        <input type="submit" class="btn btn-sm btn-primary w-100" value="Search">
                    </div>
                </div>
            </div>
            </form>
            <div class="col-lg-12 mt-3">
                <table class="table table-bordered" style="font-size:12px;background-color:white">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama Pengajar</th>
                            <th scope="col">Nomor Telefon</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $no = 1; 
                            foreach($result as $s) {?>
                        <tr>
                            <td><?= $no++?></td>
                            <td><?= $s->teacher_name?></td>
                            <td><?= $s->teacher_phone?></td>
                            <td><?= $s->teacher_address?></td>
                            <td>
                                <form action="<?=base_url()?>teacher/delete_teacher" method="post">
                                    <input type="hidden" name="id" value="<?= $s->id?>">
                                    <button type="button" data-toggle="modal" data-target="#editModal" class="btn btn-sm btn-primary toggleEdit" value="<?= $s->id?>">Edit</button>
                                    <input type="submit" class="btn btn-sm btn-danger" value="Hapus">
                                </form>
                            </td>
                        </tr>
                        <?php }?>
                    </tbody>
                </table>
            </div>
            <div class="col-lg-12 mt-3">
            <?= $this->pagination->create_links()?>
            </div>
        </div>
    </div>    

    <!-- Modal Add-->
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Tambah Tenaga Pengajar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url()?>teacher/add_teacher" method="post">
                <div class="row form-group">
                        <div class="col-lg-4 py-1">Nama : </div>
                        <div class="col-lg-8">
                            <input type="text" name="name" class="form-control form-control-sm" value="" required>
                        </div>
                </div>
                <div class="row form-group">
                        <div class="col-lg-4 py-1">No Telefon : </div>
                        <div class="col-lg-8">
                            <input type="text" name="phone" class="form-control form-control-sm" required>
                        </div>
                </div>
                <div class="row form-group">
                        <div class="col-lg-4 py-1">Alamat : </div>
                        <div class="col-lg-8">
                            <input type="text" name="address" class="form-control form-control-sm" required>
                        </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <input type="submit" class="btn btn-primary" value="Simpan Perubahan">
                </form>
            </div>
            </div>
        </div>
    </div>

     <!-- Modal Edit-->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Edit Jadwal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <script>
                $('.toggleEdit').on('click', function() {
                   var id = $(this).val();
                   $.ajax({
                        type: "POST", 
                        url: '<?= base_url()?>teacher/get_dataEdit',
                        data: {id:id},
                        dataType : 'JSON',
                        success: function(response){
                            $('#iptID').val(id);
                            $('#iptName').val(response['name']);
                            $('#iptPhone').val(response['phone']);
                            $('#iptAddress').val(response['address']);
                        }  
                   });
                });
            </script>
            <div class="modal-body">
                <?php echo validation_errors(); ?>
                <form action="<?= base_url()?>teacher/edit_teacher" method="post">
                <input type="hidden" name="id" id="iptID" value="">
                <div class="row form-group">
                        <div class="col-lg-4 py-1">Nama : </div>
                        <div class="col-lg-8">
                            <input type="text" id="iptName" name="name" class="form-control form-control-sm" value="" required>
                        </div>
                </div>
                <div class="row form-group">
                        <div class="col-lg-4 py-1">No HP : </div>
                        <div class="col-lg-8">
                            <input type="text" id="iptPhone" name="phone" class="form-control form-control-sm" required>
                        </div>
                </div>
                <div class="row form-group">
                        <div class="col-lg-4 py-1">Alamat : </div>
                        <div class="col-lg-8">
                            <input type="text" id="iptAddress" name="address" class="form-control form-control-sm" required>
                        </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <input type="submit" class="btn btn-primary" value="Simpan Perubahan">
                </form>
            </div>
            </div>
        </div>
    </div>

</body>
</html> 