<?php

$error = false;
$hasilK = 'Kompeten || Tidak Kompeten';
$nilai = 0;
$nama = "Nama Kamu";

if(isset($_POST['kirim'])){
    $nama = $_POST['nama'];
    $nilaiPe = $_POST['nilaiPe'];
    $nilaiKet = $_POST['nilaiKet'];
    
    if(!empty($nama) && !empty($nilaiPe) && !empty($nilaiKet)){
        // mencari nilai rata-rata
        if($nilaiPe < 0 || $nilaiKet < 0){
            $hasilK = 0 ;
        }else{
            $nilai = ($nilaiPe + $nilaiKet) / 2;
        }
    
        // jika lebih dari 75 maka kompeten, jika dibawah 75 maka tidak kompeten
        if($nilai >= 75 && $nilai <= 100){
            $hasilK = "Kompeten";
        } elseif($nilai < 75 && $nilai >= 0) {
            $hasilK = "Tidak kompeten";
        }else{
            $hasilK = "Kedua Nilai harus dibawah 100";
        }
    }else{
        $error = true;
        $message = "<b>Data tidak boleh ada yang kosong!</b>";
    }
}

function NilaiPe(){
    global $nilaiPe;
    if(isset($_POST['kirim'])){
        if($nilaiPe > 100 || $nilaiPe < 0){
            return 0;
        }else{
            return $nilaiPe;
        }
    }
}

function NilaiKet(){
    global $nilaiKet;
    if(isset($_POST['kirim'])){
        if($nilaiKet > 100 || $nilaiKet < 0){
            return 0;
        }else{
            return $nilaiKet;
        }
    }
}

function bgKompeten(){
    global $nilai;
    if($nilai >= 75 && $nilai <= 100){
        echo "bg-primary";
    }else{
        echo "bg-danger";
    }
}

function emoticon(){
    global $nilai;
    if($nilai >= 75 && $nilai <= 100){
        echo "smile.svg";
    }else{
        echo "unsmile.svg";
    }
}
?>



<div class="container d-flex flex-wrap" style="margin-top: 100px;">
    <div class="kiri bg-dark" style="border-radius: 5px 0 0 5px;">
        <div class="kiri-utama m-4 <?= isset($_POST['kirim']) ? bgKompeten() : "bg-secondary" ;?> rounded">
            <div class="atas text-center pt-4">
                <span><img src="assets/svg/<?= isset($_POST['kirim']) ? emoticon() : "smile.svg" ;?>" width="50px" alt=""></span>
                <h2 class="text-light mb-4 mt-4"><?= $error === false ? $hasilK : "Kompeten || Tidak Kompeten" ;?></h2>
                <!-- <hr style="height: 10px;border:none;" class="bg-dark m-0"> -->
                <div class="namaSiswa btn btn-secondary btn-outline-dark w-75">
                    <h5 class="fw-bold text-light"><?= $error === false ? $nama : "<i>Nama kamu</i>" ;?></h5>
                </div>
                <!-- <hr style="height: 10px;border:none;" class="bg-dark m-0"> -->
            </div>
            <div class="bawah m-3 text-center">
                <div class="d-flex justify-content-between w-75 m-auto">
                    <div class="nilaiPe">
                        <h4 class="text-light">Pengetahuan</h4>
                        <h4 class="text-dark btn btn-light p-0 px-4 fw-bold fs-3"><?= isset($_POST['kirim']) ? NilaiPe() : '0';?></h4>
                    </div>
                    <div class="nilaiKet">
                        <h4 class="text-light">Keterampilan</h4>
                        <h4 class="text-dark btn btn-light p-0 px-4 fw-bold fs-3"><?= isset($_POST['kirim']) ? NilaiKet() : '0';?></h4>
                    </div>
                </div>
                <h3 class="fw-bold text-light">Rata-rata </h3>
                <h1 class="btn btn-success fw-bold fs-3 px-4">
                    <?php
                        global $nilai;
                        if($error === false){
                            echo $nilai > 100 ? "0" : $nilai;
                        }else{
                            echo "0";
                        }
                    ?>
                </h1>
            </div>
        </div>
    </div>

    <div class="kanan bg-light p-4 rounded">
        <?php if($error === true) :?>
            <div class="alert alert-danger" role="alert">
                <?= $error === true ? $message : '' ;?>
            </div>
        <?php endif;?>
        <h2 class="text-center">Masukan Data dibawah Ini</h2>
        <form method="POST">
            <div class="mb-3 mt-4">
                <label for="nama" class="form-label fw-bold">Masukan Nama Kamu :</label>
                <input type="text" id="nama" autocomplete="off" class="form-control" name="nama">
            </div>
            <div class="mb-3 d-flex justify-content-between">
                <div class="nilaiPengetahuan">
                    <label for="nilaiPe" class="form-label fw-bold">Nilai Pengetahuan</label>
                    <input type="number" id="nilaiPe" class="form-control" name="nilaiPe">
                </div>
                <div class="nilaiKeterampilan">
                    <label for="nilaiKet" class="form-label fw-bold">Nilai Keterampilan</label>
                    <input type="number" id="nilaiKet" class="form-control" name="nilaiKet">
                </div>
            </div>
            <center>
                <button type="submit" name="kirim" class="btn btn-dark text-light fw-bold">KIRIM</button>
            </center>
        </form>
    </div>
</div>
