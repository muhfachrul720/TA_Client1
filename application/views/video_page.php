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
        <a href="<?=base_url()?>schedule" class="sign-out"><i class="fa fa-arrow-left"></i></a>
        <div class="row" style="margin:30px">
            <div class="col-lg-12" style="text-align:center;">
                <h3>Video Tersimpan</h3>
                <p>Halaman Melihat Video Yang Telah Tersimpan</p>
            </div>
            <div class="col-lg-12 mt-3">
                <div class="row">
                    <div class="col-sm-2 pr-0">
                        <input type="text" class="form-control form-control-sm">
                    </div>
                    <div class="col-sm-1">
                        <input type="submit" class="btn btn-sm btn-primary w-100" value="Search">
                    </div>
                </div>
            </div>
            <div class="col-lg-12 mt-3">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="card" style="width: 18rem;">
                            <video width="100%" controls>
                                <source src="<?= base_url()?>upload/video/Default.mp4" type="video/mp4"> 
                            </video>
                            <div class="card-body">
                                <small>Senin 08.00</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="card" style="width: 18rem;">
                            <video width="100%" controls>
                                <source src="<?= base_url()?>upload/video/Default.mp4" type="video/mp4"> 
                            </video>
                            <div class="card-body">
                                <small>Senin 08.00</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>    

</body>
</html>