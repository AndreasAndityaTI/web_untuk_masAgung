<?php

session_start();
if (!empty($_SESSION['admin'])) {
    require '../../config.php';
    if (!empty(htmlentities($_GET['kategori']))) {
        $id= htmlentities($_GET['id']);
        $data[] = $id;
        $sql = 'DELETE FROM kategori WHERE id_kategori=?';
        $row = $config -> prepare($sql);
        $row -> execute($data);
        echo '<script>window.location="../../index.php?page=kategori&&remove=hapus-data"</script>';
    }

    if (!empty(htmlentities($_GET['barang']))) {
        $id= htmlentities($_GET['id']);
        $data[] = $id;
        $sql = 'DELETE FROM barang WHERE id_barang=?';
        $row = $config -> prepare($sql);
        $row -> execute($data);
        echo '<script>window.location="../../index.php?page=barang&&remove=hapus-data"</script>';
    }

    if (!empty(htmlentities($_GET['jual']))) {
        $dataI[] = htmlentities($_GET['brg']);
        $sqlI = 'select*from barang where id_barang=?';
        $rowI = $config -> prepare($sqlI);
        $rowI -> execute($dataI);
        $hasil = $rowI -> fetch();

        /*$jml = htmlentities($_GET['jml']) + $hasil['stok'];

        $dataU[] = $jml;
        $dataU[] = htmlentities($_GET['brg']);
        $sqlU = 'UPDATE barang SET stok =? where id_barang=?';
        $rowU = $config -> prepare($sqlU);
        $rowU -> execute($dataU);*/

        $id = htmlentities($_GET['id']);
        $data[] = $id;
        $sql = 'DELETE FROM penjualan WHERE id_penjualan=?';
        $row = $config -> prepare($sql);
        $row -> execute($data);
        echo '<script>window.location="../../index.php?page=jual"</script>';
    }

    if (!empty(htmlentities($_GET['penjualan']))) {


        $sql = 'DELETE FROM penjualan';
        $row = $config -> prepare($sql);
        $row -> execute();
        echo '<script>window.location="../../index.php?page=jual"</script>';
    }
    
    if (!empty(htmlentities($_GET['laporan']))) {
        $id = htmlentities($_GET['id_nota']);
        
        // Debugging: Log received parameters
        error_log("Received id_nota: $id");

        $data[] = $id;
        $sql = 'DELETE FROM nota WHERE id_nota=?';
        $row = $config->prepare($sql);
        
        if ($row->execute($data)) {
            // Debugging: Log successful execution
            error_log("Successfully deleted record with id_nota: $id");
            echo '<script>window.location="../../index.php?page=laporan&remove=hapus"</script>';
        } else {
            // Debugging: Log failure
            error_log("Failed to delete record with id_nota: $id");
        }
    }
}
