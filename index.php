<?php
require ("./Fields.php");
// $field = new Field();
$fieldArray = fieldServices();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
   <section class="services">
    <div class="container">
      <?php for($i = 0; $i<count($fieldArray); $i++){
        if(!empty($fieldArray[$i]->getFieldTitle())){
        if($i % 2 == 0){
          ?>
      <div class="serviceContainer d-flex justify-content-center align-item-center">
        <div class="itemLinks">
          <h2>
            <?php echo $fieldArray[$i]->getFieldTitle();?>
          </h2>
          <div class="links">
            <?php echo $fieldArray[$i]->getFieldService();?>
          </div>
          <a class="btn"  href="<?php echo $fieldArray[$i]->getAlias()?>">Explore More</a>
        </div>
        <div class="itemImg">
          <img src="<?php echo $fieldArray[$i] -> getFieldImage()?>" alt="">
        </div>
      </div>
      <?php }
      else {?>
      <div class="serviceContainer d-flex justify-content-center align-item-center">
      <div class="itemImg">
      <img src="<?php echo $fieldArray[$i] -> getFieldImage()?>" alt="">
        </div>
        <div class="itemLinks">
        <h2>
            <?php echo $fieldArray[$i]->getFieldTitle();?>
          </h2>
          <div class="links">
            <?php echo $fieldArray[$i]->getFieldService();?>
          </div>
          <a class="btn" href="<?php echo $fieldArray[$i]->getAlias()?>">Explore More</a>
        </div>
        
      </div>
     <?php }
    }}?>
    </div>
   </section>
</body>
</html>