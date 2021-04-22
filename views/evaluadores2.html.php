<header class="main-header">
    <div class="container">
        <h1 class="page-title">Evaluadores</h1>

        <ol class="breadcrumb pull-right">
            <li><a href="#">Somos</a></li>
            <li class="active">Evaluadores</li>
        </ol>
    </div>
</header>

<div class="container">
    <div class="row">
        <?php foreach($paises as $p){ ?>
         <div class="col-md-12">
             <h2 class="right-line"><img src="<?php echo $p['bandera'] != '' ? $p['bandera'] : '../img/banderas/image001.jpg' ?>" style="width: 32px"><?php echo $p['pais'] ?></h2>        
        </div>
          <?php foreach($evaluadores[$p['pais']] as $ev){ ?>
          <div class="col-md-6">
              <h2 class=""><?php echo $ev['evaluador'] ?></h2>
              <img src="<?php echo $ev['foto'] != '' && false ? $ev['foto'] : '/img/evaluadores/profile.jpg' ?>" width="100" height="100" alt="" class="imageborder alignleft">
              <p>   
                  Participó en evaluación: <br/>
                  <?php echo $ev['descripcion'] ?>
              </p>
          </div>
          <?php } ?>
        <?php } ?>   
    </div> <!-- row -->
</div> <!-- container -->