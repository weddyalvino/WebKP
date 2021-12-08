<?php 
include 'header-2.php'; 
?>
      <!-- Counts Section -->
     <br>
      <section class="statistics">
        <div class="container-fluid">
          <div class="row d-flex">
            <div class="col-lg-4">
              <!-- Monthly Usage-->
              <div class="card data-usage">
                <h2 class="display h4">
                  <?php
                    if ($_SESSION['my_session']==TRUE){ 
                      echo 'Welcome '.$_SESSION['nama'].' '.'<br>'.'Anda masuk sebagai seorang '.$_SESSION['role'];
					}
                  ?>
                </h2>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- Updates Section -->
<br>    
<?php 
include'footer-2.php'; 
?>