    <?php
    require_once "functions.php";
    $request_method=$_SERVER["REQUEST_METHOD"];
    switch ($request_method) {
    case 'GET':
            if(!empty($_GET["id"]))
            {
                $id=intval($_GET["id"]);
                get_pekerjaById($id);
            }
            else
            {
                get_pekerja();
            }
            break;
    case 'POST':
            if(!empty($_GET["id"]))
            {
                $id=intval($_GET["id"]);
                update_pekerjaById($id);
            }
            else
            {
                insert_pekerja();
            }     
            break; 
    case 'DELETE':
            $id=intval($_GET["id"]);
                delete_pekerja($id);
                break;
    default:
        // Invalid Request Method
            header("HTTP/1.0 405 Method Not Allowed");
            break;
        break;
    }



    function get_pekerja()
    {
        global $mysqli;
        $query="SELECT * FROM kontak";
        $data=array();
        $result=$mysqli->query($query);
        while($row=mysqli_fetch_object($result))
        {
            $data[]=$row;
        }
        $response=array(
                        'status' => 1,
                        'message' =>'Get List Mahasiswa Successfully.',
                        'data' => $data
                    );
        header('Content-Type: application/json');
        echo json_encode($response);
    }
    
    function get_pekerjaById($id=0)
    {
        global $mysqli;
        $query="SELECT * FROM kontak";
        if($id != 0)
        {
            $query.=" WHERE id=".$id." LIMIT 1";
        }
        $data=array();
        $result=$mysqli->query($query);
        while($row=mysqli_fetch_object($result))
        {
            $data[]=$row;
        }
        $response=array(
                        'status' => 1,
                        'message' =>'Get Mahasiswa Successfully.',
                        'data' => $data
                    );
        header('Content-Type: application/json');
        echo json_encode($response);
            
    }
    
    function insert_pekerja()
        {
            global $mysqli;
            if(!empty($_POST["nama"])){
                $data=$_POST;
            }else{
                $data = json_decode(file_get_contents('php://input'), true);
            }

            $arrcheckpost = array('nama' => '','email' => '','notelp' => '','pekerjaan' => '');
            $hitung = count(array_intersect_key($data, $arrcheckpost));
            if($hitung == count($arrcheckpost)){
            
                $result = mysqli_query($mysqli, "INSERT INTO kontak SET
                nama = '$data[nama]',
                email = '$data[email]',
                pekerjaan = '$data[pekerjaan]',
                notelp = '$data[notelp]'");                
                if($result)
                {
                    $response=array(
                        'status' => 1,
                        'message' =>'Mahasiswa Added Successfully.'
                    );
                }
                else
                {
                    $response=array(
                        'status' => 0,
                        'message' =>'Mahasiswa Addition Failed.'
                    );
                }
            }else{
                $response=array(
                        'status' => 0,
                        'message' =>'Parameter Do Not Match'
                    );
            }
            header('Content-Type: application/json');
            echo json_encode($response);
        }
    
    function update_pekerjaById($id)
        {
            global $mysqli;
            if(!empty($_POST["nama"])){
                $data=$_POST;
            }else{
                $data = json_decode(file_get_contents('php://input'), true);
            }

            $arrcheckpost = array('nama' => '','email' => '','notelp' => '','pekerjaan' => '');
            $hitung = count(array_intersect_key($data, $arrcheckpost));
            if($hitung == count($arrcheckpost)){
            
                $result = mysqli_query($mysqli, "UPDATE kontak SET
                nama = '$data[nama]',
                email = '$data[email]',
                notelp = '$data[notelp]',
                pekerjaan = '$data[pekerjaan]'
                WHERE id='$id'");
            
                if($result)
                {
                $response=array(
                    'status' => 1,
                    'message' =>'Mahasiswa Updated Successfully.'
                );
                }
                else
                {
                $response=array(
                    'status' => 0,
                    'message' =>'Mahasiswa Updation Failed.'
                );
                }
            }else{
                $response=array(
                        'status' => 0,
                        'message' =>'Parameter Do Not Match'
                    );
            }
            header('Content-Type: application/json');
            echo json_encode($response);
        }
    
    function delete_pekerja($id)
    {
        global $mysqli;
        $query="DELETE FROM kontak WHERE id=".$id;
        if(mysqli_query($mysqli, $query))
        {
            $response=array(
                'status' => 1,
                'message' =>'Mahasiswa Deleted Successfully.'
            );
        }
        else
        {
            $response=array(
                'status' => 0,
                'message' =>'Mahasiswa Deletion Failed.'
            );
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    
    ?>