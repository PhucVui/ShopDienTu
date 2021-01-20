<?php
class product
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }
    //Star admin page (back end)
    //Tao mới
    public function insert_product($data, $files)
    {
        $productName = mysqli_real_escape_string($this->db->link, $data['productName']);
        $brand = mysqli_real_escape_string($this->db->link, $data['brand']);
        $category = mysqli_real_escape_string($this->db->link, $data['category']);
        $price = mysqli_real_escape_string($this->db->link, $data['price']);
        $description = mysqli_real_escape_string($this->db->link, $data['description']);
        $type = mysqli_real_escape_string($this->db->link, $data['type']);

        //kiem tra hinh anh va gui hinh anh vao forder uploads
        $permited = array('jpg', 'jpeg', 'png', 'gif');
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_temp = $_FILES['image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
        $uploaded_image = "uploads/" . $unique_image;

        if ($productName == "" || $brand == "" || $category == "" || $price == "" ||
            $description == "" || $type == "" || $file_name == "") {
            $alert = "<span class='error'>Properties is not empty</span>";
            return $alert;
        } else {
            move_uploaded_file($file_temp, $uploaded_image);
            $query = "INSERT INTO tbl_product(productName, brandId, catId, price,description,type,image) VALUES('$productName',
                    '$brand','$category','$price','$description','$type','$unique_image')";
            $result = $this->db->insert($query);
            if ($result) {
                $alert = "<span class='success'>Insert Product successfully</span>";
                return $alert;
            } else {
                $alert = "<span class='error'>Insert Product not success</span>";
                return $alert;
            }
        }
    }

    //Show sản phẩm
    public function show_product()
    {
        $query = " SELECT tbl_product.*, tbl_category.catName, tbl_brand.brandName
        FROM tbl_product INNER JOIN  tbl_category ON tbl_product.catId = tbl_category.catId
        INNER JOIN tbl_brand ON tbl_product.brandId = tbl_brand.brandId
        order by tbl_product.productId desc";
        $result = $this->db->select($query);
        return $result;
    }

    // Lấy sản phẩm theo id
    public function getproductbyid($id)
    {
        $query = "SELECT * FROM tbl_product WHERE productId = '$id' ";
        $result = $this->db->select($query);
        return $result;
    }

    // chỉnh sửa sản phẩm
    public function update_product($data, $file, $id)
    {
        $productName = mysqli_real_escape_string($this->db->link, $data['productName']);
        $brand = mysqli_real_escape_string($this->db->link, $data['brand']);
        $category = mysqli_real_escape_string($this->db->link, $data['category']);
        $price = mysqli_real_escape_string($this->db->link, $data['price']);
        $description = mysqli_real_escape_string($this->db->link, $data['description']);
        $type = mysqli_real_escape_string($this->db->link, $data['type']);

        //kiem tra hinh anh va gui hinh anh vao forder uploads
        $permited = array('jpg', 'jpeg', 'png', 'gif');
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_temp = $_FILES['image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
        $uploaded_image = "uploads/" . $unique_image;

        if ($productName == "" || $brand == "" || $category == "" || $price == "" ||
            $description == "" || $type == "") {
            $alert = "<span class='error'>Properties is not empty</span>";
            return $alert;
        } else {
            if (!empty($file_name)) {
                // Nếu người dùng chọn ảnh
                if ($file_size > 2048) {
                    $alert = "<span class='error'>Image size should be less than 2MB !!! </span>";
                    return $alert;
                } elseif (in_array($file_ext, $permited) === false) {
                    $alert = "<span class='error'>You can upload only:-" . implode(', ', $permited) . " </span>";
                    return $alert;
                }
                move_uploaded_file($file_temp, $uploaded_image);
                $query = "UPDATE tbl_product SET
                productName = '$productName',
                brandId = '$brand',
                catId = '$category',
                price = '$price',
                description = '$description',
                type = '$type',
                image = '$unique_image'
                WHERE productId = '$id' ";

            } else {
                # nếu người dùng k chọn ảnh
                $query = "UPDATE tbl_product SET
                productName = '$productName',
                brandId = '$brand',
                catId = '$category',
                price = '$price',
                description = '$description',
                type = '$type'
                WHERE productId = '$id' ";

            }
            $result = $this->db->update($query);
            if ($result) {
                $alert = "<span class='success'>Product updated successfully</span>";
                return $alert;
            } else {
                $alert = "<span class='error'>Product updated not success</span>";
                return $alert;
            }
        }
    }

    //xóa sản phẩm
    public function delete_product($id)
    {
        $query = "DELETE FROM tbl_product WHERE productId = '$id' ";
        $result = $this->db->delete($query);
        if ($result) {
            $alert = "<span class='success'>Product deleted successfully</span>";
            return $alert;
        } else {
            $alert = "<span class='error'>Product deleted not success</span>";
            return $alert;
        }

    }
    // End BackEnd

    //Star front end
    //Lay san pham nổi bật
    public function getproduct_feathered()
    {
        $query = "SELECT * FROM tbl_product WHERE type = 0 Limit 4";
        $result = $this->db->select($query);
        return $result;
    }
    //Lay sp mới nhất
    public function getproduct_new()
    {
        $query = "SELECT * FROM tbl_product ORDER BY productId Desc Limit 4";
        $result = $this->db->select($query);
        return $result;
    }
    public function getproduct_details($id)
    {
        $query = " SELECT tbl_product.*, tbl_category.catName, tbl_brand.brandName
        FROM tbl_product INNER JOIN  tbl_category ON tbl_product.catId = tbl_category.catId
        INNER JOIN tbl_brand ON tbl_product.brandId = tbl_brand.brandId
        WHERE tbl_product.productId = '$id' ";
        $result = $this->db->select($query);
        return $result;
    }

    public function getLastestDell()
    {
        $query = "SELECT * FROM tbl_product WHERE brandId ='1' order by productId desc limit 1 ";
        $result = $this->db->select($query);
        return $result;
    }
    public function getLastestOppo()
    {
        $query = "SELECT * FROM tbl_product WHERE brandId ='2' order by productId desc limit 1 ";
        $result = $this->db->select($query);
        return $result;
    }
    public function getLastestHawei()
    {
        $query = "SELECT * FROM tbl_product WHERE brandId ='4' order by productId desc limit 1 ";
        $result = $this->db->select($query);
        return $result;
    }
    public function getLastestSamsung()
    {
        $query = "SELECT * FROM tbl_product WHERE brandId ='3' order by productId desc limit 1 ";
        $result = $this->db->select($query);
        return $result;
    }
    public function getLastestLG()
    {
        $query = "SELECT * FROM tbl_product WHERE brandId ='5' order by productId desc limit 1 ";
        $result = $this->db->select($query);
        return $result;
    }
}