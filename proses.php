<?php
    include_once 'koneksi.php';

    if(isset($_POST['submit'])){
        $diagnosa = "SELECT id FROM tb_gejala WHERE ";

        array_pop($_POST);
        $rule_input = array();


        foreach ($_POST as $where) {
            $diagnosa .= $where. "=1 and ";

            array_push($rule_input, $where);
        }

        $diagnosa .= "G020=1";
        $id = '';
        $status = false;

        if (mysqli_query($kon, $diagnosa)) {
            $data = mysqli_query($kon, $diagnosa);

            while ($d = mysqli_fetch_array($data)) {
                $id = $d['id'];
                $status = true;
            }
        }
        
        if ($status == true) {
            $find_treatment = "SELECT * FROM tb_penyakit WHERE id=$id";

            if (mysqli_query($kon, $find_treatment)) {
                $treatment = mysqli_query($kon, $find_treatment);
    
                while ($d = mysqli_fetch_array($treatment)) {
                    $penyakit=$d['penyakit'];
                    $info=$d['info'];
                    $solusi=$d['solusi'];

                    include 'hasil.php';
                }
            }

        }else{
            include 'error.php';
            echo "<script>alert('Unidentified solution!');</script>";
        }

    }
?>