<?php

if(isset($_POST['kirim'])){
    $nama = $_POST['nama'];
    $nilai = $_POST['nilai'];

    if($nilai >= 75 && $nilai <= 100){
        $hasilK = "Kompeten";
    } elseif($nilai < 75 && $nilai >= 0) {
        $hasilK = "Tidak kompeten";
    } elseif($nilai > 100){
        $hasilK = "Nilai tidak boleh lebih dari 100";
    } else{
        $hasilK = "Nilai tidak boleh dibawah 0";
    }
}

function bgKompeten(){
    global $nilai;
    if($nilai >= 75){
        echo "bg-primary";
    }else{
        echo "bg-danger";
    }
}

function emoticon(){
    global $nilai;
    if($nilai >= 75){
        echo "smile.svg";
    }else{
        echo "unsmile.svg";
    }
}
?>



<div class="container d-flex flex-wrap" style="margin-top: 100px;">
    <div class="kiri <?= isset($_POST['kirim']) ? bgKompeten() : "bg-primary" ;?>" style="border-radius: 5px 0 0 5px;">
        <h1 class="text-center text-warning pt-4">Cek Keterangan Nilai</h1>
        <div class="atas text-center pt-4">
            <span><img src="assets/svg/<?= isset($_POST['kirim']) ? emoticon() : "smile.svg" ;?>" width="50px" alt=""></span>
            <h2 class="text-light mb-4 mt-4"><?= isset($_POST['kirim']) ? $hasilK : "Kompeten || Tidak Kompeten" ;?></h2>
            <!-- <hr style="height: 10px;border:none;" class="bg-dark m-0"> -->
            <div class="namaSiswa btn btn-secondary">
                <h5 class="fw-bold text-light"><?= isset($_POST['kirim']) ? $nama : "Nama Kamu" ;?></h5>
            </div>
            <!-- <hr style="height: 10px;border:none;" class="bg-dark m-0"> -->
        </div>
        <div class="bawah m-3 text-center">
            <h3 class="fw-bold text-light">Nilai Kamu </h3>
            <h1 class="btn btn-success fw-bold fs-1" style="width: 100px;">
                <?php
                    global $nilai;
                    if(isset($_POST['kirim'])){
                        echo $nilai > 100 ? "0" : $nilai;
                    }else{
                        echo "0";
                    }
                ?>
            </h1>
        </div>
    </div>

    <div class="kanan bg-light p-4" style="border-radius: 0 5px 5px 0;">
        <h2 class="text-center">Masukan Data dibawah Ini</h2>
        <form method="POST">
            <div class="mb-3 mt-4">
                <label for="nama" class="form-label fw-bold">Masukan Nama Kamu :</label>
                <input type="text" id="nama" class="form-control" name="nama" required>
            </div>
            <div class="mb-3">
                <label for="nilai" class="form-label fw-bold">Masukan Nilai Kamu :</label>
                <input type="number" id="nilai" class="form-control" name="nilai" required>
            </div>
                <button type="submit" name="kirim" class="btn btn-primary fw-bold">KIRIM</button>
        </form>
    </div>
</div>
