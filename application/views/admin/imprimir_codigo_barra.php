<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Smart ERP | Códigos de Barra</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.5 -->
        <link href="<?php echo base_url('assets/css/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css" />
        <!-- Font Awesome Icons -->
        <link href="<?php echo base_url('assets/css/font-awesome-4.4.0/css/font-awesome.min.css'); ?>" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="<?php echo base_url('assets/css/ionicons-2.0.1/css/ionicons.min.css'); ?>" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="<?php echo base_url('assets/css/AdminLTE.min.css'); ?>" rel="stylesheet" type="text/css" />
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body onload="window.print();">
        <div class="wrapper">

            <table class="table table-bordered table-striped" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th class="text-center">Produto</th>
                        <th class="text-center">Código de Barra</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    <?php
                    foreach ($codigos_barra as $row):
                        ?>
                        <tr>
                            <td class="text-left"><?php echo $row->nome; ?></td>
                            <td class="text-center">
                                <img src="<?php echo base_url(); ?>admin/codigobarra/criar/<?php echo $row->codigoproduto ?>" style="height: 60px;">
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

        </div>
        <script src="<?php echo base_url('assets/js/app.min.js'); ?>"></script>
    </body>
</html>
