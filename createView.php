<?php
include 'functions.php';


// //memasukan data ke windows
// $pdo = pdo_connect_mysql();
// $msg = '';
// // Check if POST data is not empty
// if (!empty($_POST)) {
//     // Post data not empty insert a new record
//     // Set-up the variables that are going to be inserted, we must check if the POST variables exist if not we can default them to blank
//     $id = isset($_POST['id']) && !empty($_POST['id']) && $_POST['id'] != 'auto' ? $_POST['id'] : NULL;
//     // Check if POST variable "name" exists, if not default the value to blank, basically the same for all variables
//     $nama = isset($_POST['nama']) ? $_POST['nama'] : '';
//     $email = isset($_POST['email']) ? $_POST['email'] : '';
//     $notelp = isset($_POST['notelp']) ? $_POST['notelp'] : '';
//     $pekerjaan = isset($_POST['pekerjaan']) ? $_POST['pekerjaan'] : '';

//     // Insert new record into the contacts table
//     $stmt = $pdo->prepare('INSERT INTO kontak VALUES (?, ?, ?, ?, ?)');
//     $stmt->execute([$id, $nama, $email, $notelp, $pekerjaan]);
//     $msg = 'Created Successfully!';

//     //memasukan data ke ubuntu
//     $url = 'http://192.168.43.100/phpcrud/pegawai_api.php';
//     $ch = curl_init($url);

//     $jsonData = array(
//         'nama' =>  $nama,
//         'email' =>  $email,
//         'notelp' => $notelp,
//         'pekerjaan' => $pekerjaan,
//     );

//     $jsonDataEncoded = json_encode($jsonData);
//     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//     //pastikan mengirim dengan method POST
//     curl_setopt($ch, CURLOPT_POST, true);
//     //Attach our encoded JSON string to the POST fields.    
//     curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);
//     //Set the content type to application/json
//     curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json')); 
//     //Execute the request
//     $result = curl_exec($ch);
//     $result = json_decode($result, true);
//     curl_close($ch);

// }

// if(isset($_POST['submit']))
// {    
// $nama = $_POST['nama'];
// $email = $_POST['email'];
// $notelp = $_POST['notelp'];
// $pekerjaan = $_POST['pekerjaan'];

// //memasukkan data ke database local
//     $sql = "INSERT INTO kontak (nama,email,notelp,pekerjaan)
//     VALUES ('$nama','$email','$notelp','$pekerjaan')";
//     if (mysqli_query($mysqli, $sql)) {
//         echo "<center>New record has been added successfully to local database!<br>";
//     } else {
//         echo "Error: " . $sql . ":-" . mysqli_error($conn);
//     }
//     mysqli_close($mysqli);

// // memasukkan data ke server ubuntu, lewat API
// //Pastikan sesuai dengan alamat endpoint dari REST API di ubuntu
// $url='http://192.168.43.100/phpcrud/pegawai_api.php';
// $ch = curl_init($url);
// // data yang akan dikirim ke REST api, dengan format json
// $jsonData = array(
//     'nama' =>  $nama,
//     'email' =>  $email,
//     'notelp' =>  $notelp,
//     'pekerjaan' =>  $pekerjaan,
// );
// //Encode the array into JSON.
// $jsonDataEncoded = json_encode($jsonData);
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// //pastikan mengirim dengan method POST
// curl_setopt($ch, CURLOPT_POST, true);
// //Attach our encoded JSON string to the POST fields.
// curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);
// //Set the content type to application/json
// curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json')); 
// //Execute the request
// $result = curl_exec($ch);
// $result = json_decode($result, true);
// curl_close($ch);

// //var_dump($result);
// // tampilkan return statusnya, apakah sukses atau tidak
// }

// ?>



<?=template_header('Create')?>

<!-- <div class="content update">
    <h2>Create Contact</h2>
    <form action="create.php" method="post">
        <label for="id">ID</label>
        <input type="text" name="id" value="auto" id="id">
        <label for="nama">Nama</label>
        <input type="text" name="nama" id="nama">
        <label for="email">Email</label>
        <input type="text" name="email" id="email">
        <label for="notelp">No. Telp</label>
        <input type="text" name="notelp" id="notelp">
        <label for="pekerjaan">Pekerjaan</label>
        <input type="text" name="pekerjaan" id="pekerjaan">
        <input type="submit" name="submit" value="Create">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div> -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Add New Data</h2>
                    </div>
                    <p>Please fill this form and submit to add student record to the database.</p>
                    <form action="createDo.php" method="post">
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" name="nama" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="mobile" name="email" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>No.Telp</label>
                            <input type="mobile" name="notelp" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Pekerjaan</label>
                            <input type="mobile" name="pekerjaan" class="form-control">
                        </div>
                        <input type="submit" class="btn btn-primary" name="submit" value="Submit">
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>

<?=template_footer()?>