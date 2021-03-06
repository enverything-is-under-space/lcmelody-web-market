    <?php
        session_start();
        include ('../includes/header.php');
        require "../includes/db-connection-without-session.php";

        $proId = $_GET['id'];
        if($proId=="")
        {
          show_result("error","لطفا مقادیر معتبر را وارد کنید","","","Lc Melody","current"); //mode , text , button lable , button target ,title , window (current)
        }

        //fetch info
        $fetch_product_info = "SELECT p_title,p_amount,p_discount,p_price,p_summary_desc,p_description FROM t_product WHERE `p_id`='$proId';";
        $result_pro_info = $conn->query($fetch_product_info);
        if ($result_pro_info->num_rows > 0)
        {
          while($row = $result_pro_info->fetch_assoc())
          {
                $pTitle = $row['p_title'];
                $pAmount = $row['p_amount'];
                $pPrice = $row['p_price'];
                $pTechinical = $row['p_summary_desc'];
                $pDescrip = $row['p_description'];
                $pDiscount = $row['p_discount'];

                $pAmount = (int)$pAmount;
          }
        }
        else
            show_result("error","اطلاعات محصول دریافت نشد","","","Lc Melody","current");



    ?>
        <title><?php echo $pTitle;?></title>
        <link rel="stylesheet" href="../assets/css/product.css">
    <?php
        include ('../includes/close-head.php');
        include ('../includes/banner.php');
        include ('../includes/menu.php');
    ?>

    <div id="base-product-section-one">
        <div id="product-picture-box" class="unselectable def-border">
          <div id="swipe-picture-to-right" class="cursor-pointer swipe-picture-style def-border" onclick="swipePicture('left')">
            <img src="../assets/img/icons/slider-right.png" alt="swiper-right" style="width:100%;height:100%;"/>
          </div>
          <div id="swipe-picture-to-left" class="cursor-pointer swipe-picture-style def-border" onclick="swipePicture('right')">
            <img src="../assets/img/icons/slider-left.png" alt="swiper-left" style="width:100%;height:100%;"/>
          </div>
          <center>
              <img id="main-picture-product" src="../assets/img/p-images/<?php echo $proId;?>-a.jpg" alt="some"/>
            <div id="small-preview-pictures-of-product-box">
              <br/> <br/> <br/>
              <?php

                check_product_image_exists($proId,'a');
                check_product_image_exists($proId,'b');
                check_product_image_exists($proId,'c');
                check_product_image_exists($proId,'d');

                function check_product_image_exists($id,$cha)
                {
                  if(file_exists("../assets/img/p-images/".$id."-a.jpg"))
                  {
                    ?>
                      <img class="small-picture-preview def-border cursor-pointer" src="../assets/img/p-images/<?php echo $id."-".$cha;?>.jpg" alt="product-<?php echo $id;?>-image" onclick="changePicture('<?php echo $id."-".$cha;?>.jpg')"/>
                    <?php
                  }
                  else
                  {
                    ?>
                      <img class="small-picture-preview def-border" src="../assets/img/p-images/default.jpg" alt="default-image"/>
                    <?php
                  }
                }




              ?>
            </div>
          </center>
        </div>
      <div id="product-details-box" class="def-border">
            <div id="section-a-product-details">
                <div id="inner-section-a-product-details">
                  <h1 id="product-title" class="set-two-font"><?php echo $pTitle;?></h1>
                  <!-- <h3 class="set-the-font">پیشنهاد شده توسط<span> ۹۹۹ </span>خریدار </h3> -->
                  <?php
                  if($pAmount==0)
                  {
                      ?>
                        <h1 id="unaviable-style" class="set-the-font">ناموجود</h1>
                      </div>
                  </div>

                      <?php
                  }
                  else
                  {
                    ?>
                      <h3 class="set-the-font">گارانتی اصالت و سلامت فیزیکی</h3>
                    <?php
                    if($pAmount<=9)
                    {
                      ?>
                      <h2 class="set-the-font"><span><?php echo $pAmount;?></span> عدد باقی مانده</h2>
                      <?php
                    }
                    if($pDiscount != 0 || $pDiscount != "0")
                    {
                      ?>
                      <center>
                        <div id="discount-parent">
                          <?php
                              //count pecent discount
                              $pPrice = str_replace(",","",$pPrice);
                              $pPrice = (int)$pPrice;
                              $pDiscount = str_replace(",","",$pDiscount);
                              $pDiscount = (int)$pDiscount;
                              $count_percent = $pDiscount/$pPrice;
                              $percent_friendly = number_format( $count_percent * 100);
                          ?>
                          <div id="discount-box-sub" class="def-border">
                            <h3 id="discount-number" class="set-the-font unselectable"><center><?php echo $percent_friendly;?><span id="percentage-symbol">٪</span></center></h3>
                          </div>
                          <h2 id="discounted-price" class="set-the-font"><del><?php echo number_format($pPrice);?></del> <span class="fontsize18">تومان</span></h2>
                        </div>
                      </center>
                      <h1 id="price-with-discount-pro" class="set-the-font" style="margin-top:80px;"><span><?php echo number_format($pPrice-$pDiscount);?></span> <span class="fontsize18">تومان</span></h1>
                      <?php
                    }
                    else
                    {
                        ?>
                            <h1 class="set-the-font"><span><?php echo number_format($pPrice);?></span> <span class="fontsize18">تومان</span></h1>
                        <?php
                    }
                    ?>

                  </div>
              </div>

                <div id="section-b-product-details">
                    <center>
                      <div id="base-button-add-to-my-cartlist" class="cursor-pointer unselectable" onclick="window.location=('./actions/a-add-product-to-cartlist.php?id=<?php echo $proId;?>')">
                        <h2 id="button-add-to-my-cartlist" class="set-the-font">افزودن به سبد خرید</h2>
                      </div>
                    </center>
                </div>
              <?php
            }
          ?>

        </div>
    </div>
    <br/> <br/>
    <div class="base-product-sections def-border">
      <div class="product-introduction-box">
        <h1 class="set-the-font">معرفی محصول</h1>
        <h2 id="product-intorduction-text" class="set-two-font"><?php echo $pDescrip;?></h2>
        <br/>
      </div>
    </div>
    <br/> <br/>
    <div class="base-product-sections def-border">
        <div class="product-introduction-box">
          <h1 class="set-the-font">مشخصات فنی محصول</h1>
          <div id="base-technical-boxes">

                <?php
                  //regex techincal description.
                  $turn = substr_count($pTechinical,";");
                  for($i=1;$i<=$turn;$i++)
                  {
                    //save rule is like 'title:attribute;' dividers are : and ;
                  	  $first_cut = strpos($pTechinical,";");
                  	  $bee = substr($pTechinical,0,$first_cut+1);
                      $pTechinical=str_replace($bee,"",$pTechinical);
                      $second_cut = strpos($bee,":");
                  	  $title = substr($bee,0,$second_cut);
                      $value = str_replace($title,"",$bee);
                      $value = str_replace([':',';'],"",$value);
                      ?>
                      <div class="tech-info-box def-border">
                        <p class="set-two-font tech-title"><?php echo $title;?>:</p>
                        <p class="set-two-font tech-sub"><?php echo $value;?></p>
                      </div>
                      <?php
                  }

                ?>
          </div>
          <br/>
        </div>
    </div>
    <br/> <br/>



              <?php
              //fetch verfied comments sorted by date;
              $fetch_verfied_comments = "SELECT cv_text,cv_date FROM t_comment_verified WHERE `cv_p_id`='$proId' ORDER BY cv_date DESC;";
              $result_v_comments = $conn->query($fetch_verfied_comments);
              if ($result_v_comments->num_rows > 0)
              {
                ?>
                <div class="base-product-sections def-border">
                <div id="product-comments-box" class="product-introduction-box">
                    <h1 class="set-the-font">نظر خریداران این محصول</h1>
                <?php
                while($row = $result_v_comments->fetch_assoc())
                {
                  ?>
                      <div class="set-two-font comment-text-style">
                          <h2><?php echo $row['cv_text'];?></h2>
                           <div class="set-the-font date-comment"><span><?php echo $row['cv_date'];?></span></div>
                      </div>
                      <br/>
                  <?php
                }
                ?>
                </div>

                <?php
              }
              ?>





              <?php
              //check customer login status
              if(isset($_SESSION["state_login"]) && $_SESSION["state_login"] === true)
              {
                if(isset($_SESSION["s_customer_id"]))
                {
                  ?>
                  <div id="write-your-comment" class="set-two-font def-border">
                       <h2>تجربه خرید این محصول را به اشتراک بزار</h2>
                       <form action="./actions/a-send-comment-for-product.php" method="post">
                         <input type="hidden" name="pid" value="<?php echo $proId;?>">
                         <center><textarea id="customer-comment-text" name="commentText" rows="8" cols="80" dir="rtl" maxlength="301"></textarea></center>
                         <div id="limited-chars-hint" class="set-the-font">
                          </div>
                          <center>
                         <!-- <div >
                           <h3 id="button-add-my-comment">
                         </div> -->
                         <input id="base-button-add-my-comment" class="cursor-pointer unselectable set-the-font" type="submit" value="ثبت نظر">
                       </form>
                       </center>
                   </div>
                  <?php
                }
              }

              ?>
              <br/>
    </div>


    <script>
          const product_id_js = <?php echo $proId;?>;
          function swipePicture(input)
          {
              var current_src = document.getElementById("main-picture-product").src;
              var last_char = current_src.slice(current_src.length-5,current_src.length-4);
              switch (last_char)
              {
                case 'a':
                {
                    if(input ===  "right")
                        document.getElementById("main-picture-product").src = "../assets/img/p-images/"+product_id_js+"-b.jpg";
                    else
                        document.getElementById("main-picture-product").src = "../assets/img/p-images/"+product_id_js+"-d.jpg";
                }break;

                case 'b':
                {
                  if(input ===  "right")
                      document.getElementById("main-picture-product").src = "../assets/img/p-images/"+product_id_js+"-c.jpg";
                  else
                      document.getElementById("main-picture-product").src = "../assets/img/p-images/"+product_id_js+"-a.jpg";
                }break;

                case 'c':
                {
                  if(input ===  "right")
                      document.getElementById("main-picture-product").src = "../assets/img/p-images/"+product_id_js+"-d.jpg";
                  else
                      document.getElementById("main-picture-product").src = "../assets/img/p-images/"+product_id_js+"-b.jpg";
                }break;

                default:
                {
                  if(input ===  "right")
                      document.getElementById("main-picture-product").src = "../assets/img/p-images/"+product_id_js+"-a.jpg";
                  else
                      document.getElementById("main-picture-product").src = "../assets/img/p-images/"+product_id_js+"-c.jpg";
                }break;
              }
          }


          function changePicture(input)
          {
              const def_path = "../assets/img/p-images/";
              document.getElementById("main-picture-product").src = def_path+input;

          }
    </script>


    <?php
    include "../includes/footer.php";
    require "./actions/includes/footer.php";

    ?>
