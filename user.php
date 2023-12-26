<?php

class Users
{
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "test_wb";
    private $conn; 

    public function __construct()
    {
    $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
    if ($this->conn->connect_error) {
        echo "Connection failed: " . $this->conn->connect_error;
    }
    session_start();
    }

    public function getData()
    {
        $sql = "SELECT * FROM users";
        $result = $this->conn->query($sql);
    
        if (!$result) {
            die("Error in query: " . $this->conn->error);
        }
    
        return $result;
    }

    public function createData($nama, $email, $phone, $password, $photo)
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Handle foto
            $targetDirectory = "image/"; // Direktori penyimpanan foto
            $type = $photo['type'];
            $formatFile = explode("/", $type);
            $name = rand() . "." . $formatFile[1];
            $targetFile = $targetDirectory . basename($name); // Path lengkap file yang akan diupload
            
            // Periksa apakah file gambar yang valid
            $uploadOk       = 1;
            $imageFileType  = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

            $check = getimagesize($_FILES["photo"]["tmp_name"]);
            if ($check !== false) {
                $_SESSION['pesan'] = 'File adalah gambar - " . $check["mime"] . ".';
                $uploadOk = 1;
            } else {
                $_SESSION['pesan'] = 'File bukanlah gambar';
                $uploadOk = 0;
            }

            // Periksa jika file sudah ada
            if (file_exists($targetFile)) {
                $_SESSION['pesan'] = 'Maaf, file sudah ada';
                $uploadOk = 0;
            }
        
            // Periksa ukuran file
            if ($_FILES["photo"]["size"] > 500000) {
                $_SESSION['pesan'] = 'Maaf, ukuran file terlalu besar';
                $uploadOk = 0;
            }
        
            // Izinkan format file tertentu
            if (
                $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif"
            ) {
                $_SESSION['pesan'] = 'Maaf, hanya file JPG, JPEG, PNG & GIF yang diperbolehkan.';
                $uploadOk = 0;
            }
        
            // Cek jika $uploadOk bernilai 0 oleh suatu error
            if ($uploadOk == 0) {
                return header('Location:create.php');
            } else {
                // Jika semuanya baik, coba upload file
                if (move_uploaded_file($_FILES["photo"]["tmp_name"], $targetFile)) {
        
                    $sql = "INSERT INTO users (`name`, `email`, `phone`, `password`, `photo`) VALUES ('$nama', '$email', '$phone', '$password', '$targetFile')";
                    if ($this->conn->query($sql) === TRUE) {
                        $_SESSION['pesan'] = 'Data berhasil disimpan ke Database';
                        return header('Location:create.php');
                        // Redirect atau tampilkan pesan sukses
                    } else {
                        echo "Error: " . $sql . "<br>" . $this->conn->error;
                    }
                } else {
                    $_SESSION['pesan'] = 'Maaf, terjadi error saat mengupload File';
                    return header('Location:index.php');
                }
            }
        }        
    }

        public function getDetail($id)
    {
        $query = "SELECT * FROM users WHERE id='$id' LIMIT 1";
        $exec = $this->conn->query($query);
        return mysqli_fetch_assoc($exec);
    }

        public function updateData($id, $nama, $email, $phone, $password)
    {
        $sql = "UPDATE `users` SET `name`='$nama',`email`='$email',`phone`='$phone',`password`='$password' WHERE id='$id' ";
        $result = $this->conn->query($sql);

        if ($result === false) {
            echo "Error: " . $this->conn->error;
        } else {
            $pesan = $_SESSION['pesan'] = 'Data Telah Diperbarui!';
        
        return header('Location:index.php');
        }
    }
        public function deleteData($id)
    {
        $query = "DELETE FROM users WHERE id=$id";
        $this->conn->query($query);
        $_SESSION['pesan'] = 'Hapus Data Berhasil!';
        return header('Location:index.php');
    }

        public function loginProcess($email, $password)
    {
        $sql = "SELECT * FROM users WHERE email='$email' and password='$password' ";
        $result = $this->conn->query($sql);
        $data = mysqli_fetch_assoc($result);

        if (isset($data)) {
            $pesan = $_SESSION['pesan'] = 'Login Berhasil!';
            $_SESSION['data'] = $data;
            return header('Location:index.php');
        } else {
            $_SESSION['pesan'] = 'Data Tidak Valid!';
            return header('Location: ' . $_SERVER['HTTP_REFERER']);
        }        
    }
    }