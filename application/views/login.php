<!DOCTYPE html>

<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta name="author" content="Wonderlan">
        <meta name="viewport" content="width=device-width,initial-scale=1">

        <title><?php echo $project_title ?> - Login</title>

        <link rel="icon" href="<?php echo base_url() . 'favicon.png'?>" type="image/png">
        <link rel="shortcut icon" href="<?php echo base_url() . 'favicon.ico'?>" type="img/x-icon">
        <link href="<?php echo base_url(); ?>/favicon.png" rel="icon">

        <link href="<?php echo base_url() . 'assets/fonts/fontawesome/css/all.min.css'?>" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url() . 'assets/bootstrap/css/bootstrap.min.css'?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url() . 'assets/css/login.css'?>" rel="stylesheet" type="text/css" />

    </head>

    <body class="my-login-page">
        <section class="h-100">
            <div class="container h-100">
                <div class="row justify-content-md-center h-100">
                    <div class="card-wrapper">
                        <div class="brand">
                            <img src="<?php echo base_url() . 'images/logo-blue.png'?>" alt="logo">
                        </div>
                        <div class="card fat">
                            <div class="card-body">
                                <h4 class="card-title">Login</h4>
                                <form method="POST" class="my-login-validation" novalidate="">
                                    <div class="form-group">
                                        <label for="email">Email Address</label>
                                        <input id="email" type="email" placeholder="Enter a valid email address" class="form-control rounded-pill shadow-sm px-4" name="email" value="" required autofocus>
                                        <div class="invalid-feedback">
                                            Email is invalid
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="password">Password
                                            <a href="forgot.html" class="float-right">
                                                Forgot Password?
                                            </a>
                                        </label>
                                        <input id="password" type="password" placeholder="Enter Password" class="form-control rounded-pill shadow-sm px-4" name="password" required data-eye>
                                        <div class="invalid-feedback">
                                            Password is required
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="custom-checkbox custom-control">
                                            <input type="checkbox" name="remember" id="remember" class="custom-control-input">
                                            <label for="remember" class="custom-control-label">Remember Me</label>
                                        </div>
                                    </div>

                                    <div class="form-group m-0">
                                        <button type="submit" class="btn btn-primary btn-block mb-2 rounded-pill shadow-sm">Sign In</button>
                                    </div>
                                    <!-- <div class="mt-4 text-center">
                                        Don't have an account? <a href="register.html">Create One</a>
                                    </div> -->
                                </form>
                            </div>
                        </div>
                        <div class="footer">
                            Copyright &copy; <?php echo date("Y"); ?> &mdash; Wonderlan
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <script src="<?php echo base_url() . 'assets/jquery/jquery-3.5.1.min.js'?>"></script>
        <script src="<?php echo base_url() . 'assets/popper/popper.min.js'?>"></script>
        <script src="<?php echo base_url() . 'assets/bootstrap/js/bootstrap.min.js'?>"></script>
        <script src="<?php echo base_url() . 'assets/js/login.js'?>"></script>
    </body>
</html>