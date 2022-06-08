<?php
include_once 'functions.php';
$msg = '';
$msg_server = '';
if(isset($_POST['submit']))
{    
$nama = $_POST['nama'];
$email = $_POST['email'];
$notelp = $_POST['notelp'];
$pekerjaan = $_POST['pekerjaan'];


//memasukkan data ke database local
    $sql = "INSERT INTO kontak (nama,email,notelp,pekerjaan)
    VALUES ('$nama','$email','$notelp','$pekerjaan')";
    if (mysqli_query($mysqli, $sql)) {
        echo "<center>New record has been added successfully to local database!<br>";
    } else {
        echo "Error: " . $sql . ":-" . mysqli_error($conn);
    }
    mysqli_close($mysqli);
    $msg = 'Local';
    

// memasukkan data ke server ubuntu, lewat API
//Pastikan sesuai dengan alamat endpoint dari REST API di ubuntu
$url='http://192.168.43.100/phpcrud/pegawai_api.php';
$ch = curl_init($url);
// data yang akan dikirim ke REST api, dengan format json
$jsonData = array(
    'nama' =>  $nama,
    'email' =>  $email,
    'notelp' =>  $notelp,
    'pekerjaan' =>  $pekerjaan,
);
//Encode the array into JSON.
$jsonDataEncoded = json_encode($jsonData);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//pastikan mengirim dengan method POST
curl_setopt($ch, CURLOPT_POST, true);
//Attach our encoded JSON string to the POST fields.
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);
//Set the content type to application/json
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json')); 
//Execute the request
$result = curl_exec($ch);
$result = json_decode($result, true);
curl_close($ch);
$msg_server = 'Server';

//var_dump($result);
// tampilkan return statusnya, apakah sukses atau tidak
// print("<center><br>status :  {$result['status']} "); 
// print("<br>");
// print("message :  {$result['message']} "); 
// echo "<br>Sukses terkirim ke ubuntu server !";
// echo "<br><a class='btn btn-danger' href='read.php'> OK </a>";
}
?>

<?=template_header('Create')?>
    <div class="content add">
        <?php if ($msg && $msg_server): ?>
        <h5>Data Berhasil ditambahkan kedalam <?=$msg?> and <?=$msg_server?> !</h5>
        <a href="read.php" class="btn btn-danger">Kembali</a>
        <?php endif; ?>
    </div>
<?=template_footer()?>

