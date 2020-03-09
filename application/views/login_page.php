<style>

    .login-dialog {
        position:absolute;
        left:50%;
        top:55%;
        transform:translate(-50%, -50%);
    }

    .login-box {
        border-radius:5px;
        width:300px;
        padding:1em;
        border:solid 1px;
        margin-bottom:50px;
        background-color:rgba(255,255,255,0.8);
    }

    .login-box .head {
        text-align:center;
    }

    .second-container {
        height:100vh;   
    }

</style>
<body>
    <div class="wrapper" style="background: linear-gradient(90deg, rgba(4,0,79,1) 0%, rgba(15,188,217,1) 35%, rgba(166,240,255,1) 100%);">
        <div class="container-fluid">
            <div class="row second-container">
                <div class="col-lg-8" style="height:100%;text-align:center; display:table">
                    <div style="display:table-cell; vertical-align:middle; color:white;">
                        <h2>Selamat Datang Admin</h2>
                        <h4>Silahkan Login Untuk Menambah Jadwal</h4>
                    </div>
                </div>
                <div class="col-lg-2" style="width:100%; position:relative;">
                    <div class="login-dialog">
                        <div class="login-box">
                            <div class="head">
                                <h5>LOGIN</h5>
                                <hr>
                            </div>
                            <div class="body">
                                <form action="<?= base_url()?>auth/check_user" method="post">
                                    <div class="form-group">
                                        <small>Username : </small>
                                        <input type="text" name="username" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <small>Password : </small>
                                        <input type="password" name="password" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" class="btn btn-sm btn-primary w-100">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>    
        </div>
    </div>
</body>
</html>