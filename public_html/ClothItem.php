<?php

class ClothItem
{
    private $id;
    private $mainCategory;
    private $subCategory;
    private $name;
    private $description;
    private $webPage;
    private $images; //list of images urls
    private $colors = array(); //list of colors
    private $price;
    private $storeName; //e.g. Castro
    private $sizes;
    private $colorsWithImage = array();

    /**
     * @return mixed
     */
    public function getSizes()
    {
        return $this->sizes;
    }

    /**
     * @param mixed $sizes
     */
    public function setSizes($sizes)
    {
        $this->sizes = $sizes;
    }

    /**
     * @return mixed
     */
    public function getStoreName()
    {
        return $this->storeName;
    }

    /**
     * @param mixed $storeName
     */
    public function setStoreName($storeName)
    {
        $this->storeName = $storeName;
    } //e.g Castro

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price)
    {
        $this->price = (float) $price;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getMainCategory()
    {
        return $this->mainCategory;
    }

    /**
     * @param mixed $mainCategory
     */
    public function setMainCategory($mainCategory)
    {
        $this->mainCategory = $mainCategory;
    }

    /**
     * @return mixed
     */
    public function getSubCategory()
    {
        return $this->subCategory;
    }

    /**
     * @param mixed $subCategory
     */
    public function setSubCategory($subCategory)
    {
        $this->subCategory = $subCategory;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = mysql_real_escape_string($name);
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getWebPage()
    {
        return $this->webPage;
    }

    /**
     * @param mixed $webPage
     */
    public function setWebPage($webPage)
    {
        $this->webPage = $webPage;
    }

    /**
     * @return mixed
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * @param mixed $images
     */
    public function setImages($images)
    {
        $this->images = $images;
    }

    /**
     * @return mixed
     */
    public function getColors()
    {
        return $this->colors;
    }

    /**
     * @param mixed $colors
     */
    public function setColors($colors)
    {
        $this->colors = $colors;
    }

    public function setColorsWithImages($colorsWithImage){
        $this->colorsWithImages = $colorsWithImage;
    }


    public function updateInDb()
    {
        $colorsIds= array();
        $images = array();
        foreach ($this->colors as $color){
            $colorImage = null;
            if (gettype($color) == "array"){
                $colorImage = $color[1];
                $color = $color[0];
            }
            $colorToInsert = mysql_real_escape_string($color);
            $colorQuery = "INSERT IGNORE INTO Colors SET Name = '$colorToInsert'";
            if (!mysql_query($colorQuery)){
                die(mysql_error()." Your Query Was: ".$colorQuery);
            }
            $getColorIdQuery = "SELECT Id FROM Colors WHERE Name = '$colorToInsert'";
            $getColorIdResult = mysql_query($getColorIdQuery);
            if (!$getColorIdResult){
                die(mysql_error()." Your Query Was: ".$getColorIdQuery);
            }
            $colorRow = mysql_fetch_assoc($getColorIdResult);
            $colorsIds[] = $colorRow["Id"];
            if ($colorImage != null)
                $images[$colorRow["Id"]] = $colorImage;
        }

        $sizesIds= array();
        foreach ($this->sizes as $size){
            $sizeQuery = "INSERT IGNORE INTO Sizes SET Name = '$size'";
            if (!mysql_query($sizeQuery)){
                die(mysql_error()." Your Query Was: ".$sizeQuery);
            }

            $getSizeIdQuery = "SELECT Id FROM Sizes WHERE Name = '$size'";
            $getSizeIdResult = mysql_query($getSizeIdQuery);
            if (!$getSizeIdResult){
                die(mysql_error()." Your Query Was: ".$getSizeIdQuery);
            }
            $sizeRow = mysql_fetch_assoc($getSizeIdResult);
            $sizesIds[] = $sizeRow["Id"];

        }

        //$"INSERT IGNORE into Categories "
        $query = "INSERT INTO ClothesTemp (MainCategory,SubCategory,Name,Price,Webpage,MainImage,StoreName) VALUES
            ('$this->mainCategory','$this->subCategory','$this->name',$this->price, '$this->webPage', '$this->images','$this->storeName')";


        $result = mysql_query($query);
        if (!$result)
            die(mysql_error()." Your Query Was: ".$query);

        $rowId =  mysql_insert_id();

        foreach ($colorsIds as $colorId){
            $image = '';
            if (isset($images[$colorId]))
                $image = $images[$colorId];

            $clothesToColorQuery = "INSERT INTO ClothToColorTemp SET ClothId = $rowId, ColorId = $colorId, Image = '$image' ";
            if (!mysql_query($clothesToColorQuery)){
                die(mysql_error()." Your Query Was: ".$clothesToColorQuery);
            }
        }

        foreach ($sizesIds as $sizeId){
            $clothesToSizeQuery = "INSERT INTO ClothToSizeTemp SET ClothId = $rowId, SizeId = $sizeId";
            if (!mysql_query($clothesToSizeQuery)){
                die(mysql_error()." Your Query Was: ".$clothesToSizeQuery);
            }
        }


        //exec query
    }

}

function flushBuffers()
{
    ob_end_flush();
    ob_flush();
    flush();
    ob_start();
}

?>