<?php
include 'functions.php';
// // Connect to MySQL database
// $pdo = pdo_connect_mysql();
// // Get the page via GET request (URL param: page), if non exists default the page to 1
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
// Number of records to show on each page
$records_per_page = 5;


// // Prepare the SQL statement and get records from our contacts table, LIMIT will determine the page
// $stmt = $pdo->prepare('SELECT * FROM kontak ORDER BY id LIMIT :current_page, :record_per_page');
// $stmt->bindValue(':current_page', ($page-1)*$records_per_page, PDO::PARAM_INT);
// $stmt->bindValue(':record_per_page', $records_per_page, PDO::PARAM_INT);
// $stmt->execute();
// // Fetch the records so we can display them in our template.
// $contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);


// // Get the total number of contacts, this is so we can determine whether there should be a next and previous button
global $mysqli;
function query(){
    $query = "SELECT COUNT(*) FROM kontak";
} 
$num_contacts = query();
// $num_contacts = $pdo->query('SELECT COUNT(*) FROM kontak')->fetchColumn();

$data = file_get_contents('http://localhost:8080/phpcrud/pegawai_api.php');
$contacts = json_decode($data, true);

$contacts = $contacts["data"];
?>


<?=template_header('Read')?>

<div class="content read">
	<h2>Data Pegawai di Windows</h2>
	<a href="createView.php" class="create-contact">Tambah Data</a>
	<table>
        <thead>
            <tr>
                <td>#</td>
                <td>Nama</td>
                <td>Email</td>
                <td>No. Telp</td>
                <td>Pekerjaan</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($contacts as $contact): ?>
            <tr>
                <td><?=$contact['id']?></td>
                <td><?=$contact['nama']?></td>
                <td><?=$contact['email']?></td>
                <td><?=$contact['notelp']?></td>
                <td><?=$contact['pekerjaan']?></td>
                <td class="actions">
                    <a href="update.php?id=<?=$contact['id']?>" class="edit"><i class="fas fa-pen fa-xs"></i></a>
                    <a href="delete.php?id=<?=$contact['id']?>" class="trash"><i class="fas fa-trash fa-xs"></i></a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
	<div class="pagination">
		<?php if ($page > 1): ?>
		<a href="read.php?page=<?=$page-1?>"><i class="fas fa-angle-double-left fa-sm"></i></a>
		<?php endif; ?>
		<?php if ($page*$records_per_page < $num_contacts): ?>
		<a href="read.php?page=<?=$page+1?>"><i class="fas fa-angle-double-right fa-sm"></i></a>
		<?php endif; ?>
	</div>
</div>

<hr>

<?php
$curl = curl_init();
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

curl_setopt($curl, CURLOPT_URL, 'http://192.168.43.100/phpcrud/pegawai_api.php');
$res = curl_exec($curl);
$json = json_decode($res, true);

$json = $json["data"];

?>

<div class="content read">
	<h2>Data Pegawai di Server</h2>
	<a href="createView.php" class="create-contact">Tambah Data</a>
	<table>
        <thead>
            <tr>
                <td>#</td>
                <td>Nama</td>
                <td>Email</td>
                <td>No. Telp</td>
                <td>Pekerjaan</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($json as $data): ?>
            <tr>
                <td><?=$data['id']?></td>
                <td><?=$data['nama']?></td>
                <td><?=$data['email']?></td>
                <td><?=$data['notelp']?></td>
                <td><?=$data['pekerjaan']?></td>
                <td class="actions">
                    <a href="update.php?id=<?=$contact['id']?>" class="edit"><i class="fas fa-pen fa-xs"></i></a>
                    <a href="delete.php?id=<?=$contact['id']?>" class="trash"><i class="fas fa-trash fa-xs"></i></a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
	<div class="pagination">
		<?php if ($page > 1): ?>
		<a href="read.php?page=<?=$page-1?>"><i class="fas fa-angle-double-left fa-sm"></i></a>
		<?php endif; ?>
		<?php if ($page*$records_per_page < $num_contacts): ?>
		<a href="read.php?page=<?=$page+1?>"><i class="fas fa-angle-double-right fa-sm"></i></a>
		<?php endif; ?>
	</div>
</div>
<?=template_footer()?>