<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
$msg_server = '';
// Check if the contact id exists, for example update.php?id=1 will get the contact with the id of 1
if (isset($_GET['id'])) {
    if (!empty($_POST)) {
        // This part is similar to the create.php, but instead we update a record and not insert
        $id = isset($_POST['id']) ? $_POST['id'] : NULL;
        $nama = $_POST['nama'];
        $email = $_POST['email'];
        $notelp = $_POST['notelp'];
        $pekerjaan = $_POST['pekerjaan'];
        
        // Update the record
        $stmt = $pdo->prepare('UPDATE kontak SET id = ?, nama = ?, email = ?, notelp = ?, pekerjaan = ? WHERE id = ?');
        $stmt->execute([$id, $nama, $email, $notelp, $pekerjaan, $_GET['id']]);
        $msg = 'Updated Local Table';
    }

    if (isset($_POST['submit'])){

        $nama = $_POST['nama'];
        $email = $_POST['email'];
        $notelp = $_POST['notelp'];
        $pekerjaan = $_POST['pekerjaan'];

        $url='http://192.168.43.100/phpcrud/pegawai_api.php?id='.$id.'';
        $ch = curl_init($url);
        //kirimkan data yang akan di update
        $jsonData = array(
            'nama' =>  $nama,
            'email' =>  $email,
            'notelp' =>  $notelp,
            'pekerjaan' =>  $pekerjaan,
        );

        //Encode the array into JSON.
        $jsonDataEncoded = json_encode($jsonData);


        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //Tell cURL that we want to send a POST request.
        curl_setopt($ch, CURLOPT_POST, true);

        //Attach our encoded JSON string to the POST fields.
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);

        //Set the content type to application/json
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json')); 

        $result = curl_exec($ch);
        $result = json_decode($result, true);
        curl_close($ch);
        $msg_server = 'Server Data Successfully';
    }
    // Get the contact from the contacts table
    $stmt = $pdo->prepare('SELECT * FROM kontak WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $contact = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$contact) {
        exit('Contact doesn\'t exist with that ID!');
    }
} else {
    exit('No ID specified!');
}
?>



<?=template_header('Read')?>

<div class="content update">
	<h2>Update Contact #<?=$contact['id']?></h2>
    <form action="update.php?id=<?=$contact['id']?>" method="post">
        <label for="id">ID</label>
        <label for="nama">Nama</label>
        <input type="text" name="id" value="<?=$contact['id']?>" id="id">
        <input type="text" name="nama" value="<?=$contact['nama']?>" id="nama">
        <label for="email">Email</label>
        <label for="notelp">No. Telp</label>
        <input type="text" name="email" value="<?=$contact['email']?>" id="email">
        <input type="text" name="notelp" value="<?=$contact['notelp']?>" id="notelp">
        <label for="pekerjaan">Pekerjaan</label>
        <input type="text" name="pekerjaan" value="<?=$contact['pekerjaan']?>" id="title">
        <input type="submit" name="submit" value="Update">
    </form>
    <?php if ($msg && $msg_server): ?>
    <h5><?=$msg?> and <?=$msg_server?> !</h5>
    <a href="read.php" class="btn btn-danger">Kembali</a>
    <?php endif; ?>
</div>

<?=template_footer()?>