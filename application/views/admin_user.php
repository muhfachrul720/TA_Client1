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
                <h4>Data Daftar Pengguna</h3>
                <p>Dashboard Untuk Mengelola Data Pengguna</p>
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
                        <button type="button" data-toggle="modal" data-target="#addModal" class='btn btn-sm btn-primary'>Tambah User</button>
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
                            <th scope="col">Nama Pengguna</th>
                            <th scope="col">Email Pengguna</th>
                            <th scope="col">Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $no = 1; 
                            foreach($result as $s) {?>
                        <tr>
                            <td><?= $no++?></td>
                            <td><?= $s->name?></td>
                            <td><?= $s->email?></td>
                            <td>
                                <form action="<?=base_url()?>user/delete_user" method="post">
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
                <h5 class="modal-title" id="exampleModalLongTitle">Tambah Jadwal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url()?>user/add_user" method="post">
                <div class="row form-group">
                        <div class="col-lg-4 py-1">Nama : </div>
                        <div class="col-lg-8">
                            <input type="text" name="name" class="form-control form-control-sm" value="" required>
                        </div>
                </div>
                <div class="row form-group">
                        <div class="col-lg-4 py-1">Email : </div>
                        <div class="col-lg-8">
                            <input type="email" name="email" class="form-control form-control-sm" required>
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
                        url: '<?= base_url()?>user/get_dataEdit',
                        data: {id:id},
                        dataType : 'JSON',
                        success: function(response){
                            $('#iptID').val(id);
                            $('#iptName').val(response['name']);
                            $('#iptEmail').val(response['email']);
                        }  
                   });
                });
            </script>
            <div class="modal-body">
                <?php echo validation_errors(); ?>
                <form action="<?= base_url()?>user/edit_user" method="post">
                <input type="hidden" name="id" id="iptID" value="">
                <div class="row form-group">
                        <div class="col-lg-4 py-1">Nama : </div>
                        <div class="col-lg-8">
                            <input type="text" id="iptName" name="name" class="form-control form-control-sm" value="" required>
                        </div>
                </div>
                <div class="row form-group">
                        <div class="col-lg-4 py-1">Email : </div>
                        <div class="col-lg-8">
                            <input type="text" id="iptEmail" name="email" class="form-control form-control-sm" required>
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