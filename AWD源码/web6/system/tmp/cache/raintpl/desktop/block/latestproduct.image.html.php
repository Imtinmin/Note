<?php if(!class_exists('raintpl')){exit;}?><?php if(!defined("RUN_MODE")){ ?>


<?php echo die(); ?>

<?php } ?>


<style>
.panel-body .cards-custom .card > .card-heading {min-height: 40px; height: 40px; padding: 10px; font-size: 13px; position: relative;}
.panel-body .cards-custom .card > .card-heading > strong {display: inline-block; vertical-align: middle; max-width: 150px; white-space: nowrap; overflow: hidden;}
.panel-body .cards-custom .card > .card-heading > .views {position: absolute; right: 0; top: 10px;}
.panel-body .cards-custom .card > .card-content {padding: 0 10px 10px 10px; margin-bottom: 10px;}


<?php if(empty($content->showPrice) and empty($conetnt->showViews)){ ?>


.panel-body .cards-custom .card > .card-heading{display: block; overflow: hidden; white-space: nowrap;}
.panel-body .cards-custom .card > .card-heading > strong{max-width:100%;}
<?php } ?>



</style>


<div class='panel-body'>
  <div class='cards cards-borderless cards-custom'>
    <?php foreach($products as $product): ?>


      <?php $url=$this->var['url'] = helper::createLink('product', 'view', "id=$product->id", "category={$product->category->alias}&name=$product->alias");?>


      <?php if(!empty($product->image)){ ?>


        <?php $recPerRow=$this->var['recPerRow'] = (isset($content->recPerRow) and !empty($content->recPerRow)) ? $content->recPerRow : '3';?>

        <div class='col-md-12' data-recperrow="<?php echo $recPerRow;?>">
          <a class='card' href="<?php echo $url;?>">
            <?php $product->image->primary->objectType = 'product';$this->var['product'] = $product;?>

            <div class='media' style='background-image: url(<?php echo $model->loadModel('file')->printFileURL($product->image->primary, 'middleURL');?>

);'>
              <?php $title=$this->var['title'] = $product->image->primary->title ? $product->image->primary->title : $product->name;?>

              <?php echo html::image($model->loadModel('file')->printFileURL($product->image->primary, 'middleURL'), "title='{$title}' alt='{$product->name}'"); ?>


            </div>

            <div class="card-heading <?php if(isset($content->alignTitle) && $content->alignTitle == 'middle'){ ?>


<?php echo 'text-center'; ?>

<?php } ?>">
              <strong title="<?php echo $product->name;?>">
                <?php if(zget($content, 'showCategory') == 1){ ?>


<?php echo '[' . ($content->categoryName == 'abbr' and $product->category->abbr) ? $product->category->abbr : $product->category->name . ']'; ?>

<?php } ?>

                <?php echo $product->name;?>

              </strong>
              <?php if(isset($content->showPrice) and $content->showPrice){ ?>


                <span>
                  <?php $currencySymbol=$this->var['currencySymbol'] = $model->config->product->currencySymbol;?>

                    <?php if(!$product->unsaleable){ ?>


                      <?php if($product->negotiate){ ?>


                        <?php $priceLabel=$this->var['priceLabel'] = $lang->product->negotiate;?>

                      <?php }else{ ?>

                        <?php if($product->promotion > 0){ ?>


<?php $priceLabel=$this->var['priceLabel'] = $currencySymbol . $product->promotion;?>

<?php } ?>

                        <?php if(($product->promotion <= 0)  and $product->price){ ?>


<?php $priceLabel=$this->var['priceLabel'] = $currencySymbol . $product->price;?>

<?php } ?>

                      <?php } ?>

<?php } ?>

                  <?php if(isset($priceLabel)){ ?>

 &nbsp;&nbsp;<span class='text-danger'><?php echo $priceLabel;?></span> <?php } ?>

                </span>
              <?php } ?>


              <?php if(isset($content->showViews) and $content->showViews){ ?>


                <div class='views'><i class="icon icon-eye-open"></i> <?php echo $product->views; ?></div>
              <?php } ?>

            </div>

            <?php if(isset($content->showInfo) and isset($content->infoAmount)){ ?>


              <?php $productInfo=$this->var['productInfo'] = empty($product->desc) ? $product->content : $product->desc;?>

              <?php $productInfo=$this->var['productInfo'] = strip_tags($productInfo);?>


              <?php $productInfo=$this->var['productInfo'] = helper::substr($productInfo, $content->infoAmount);?>


              <div class='card-content text-muted with-padding'><?php echo $productInfo; ?></div>
            <?php } ?>

          </a>
        </div>
      <?php } ?>

    <?php endforeach; ?>

  </div>
</div>
