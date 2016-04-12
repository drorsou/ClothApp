<?php

/**
 * Created by PhpStorm.
 * User: niri
 * Date: 04/04/2016
 * Time: 20:35
 */
class ClothItem
{
    private $id;
    private $mainCategory;
    private $subCategory;
    private $name;
    private $description;
    private $webPage;
    private $images; //list of images urls
    private $colors; //list of colors
    private $price;

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
        $this->price = $price;
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
        $this->name = $name;
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


    public function updateInDb()
    {
        //$"INSERT IGNORE into Categories "
        $query = "INSERT INTO Clothes (MainCategory,SubCategory,Name,Price,Webpage,MainImage) VALUES
            ('$this->mainCategory','$this->subCategory','$this->name',$this->price, '$this->webPage', '$this->images' )";

        mysql_query($query);
        //exec query
    }

}

?>