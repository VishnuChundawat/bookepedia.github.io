<?php 
  $term = $_SESSION['findbo'];
$page1= $_GET['page'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
  <title>Book-e-pedia</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.0/css/materialize.min.css">

  <!-- Compiled and minified JavaScript -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.0/js/materialize.min.js"></script>
  
  <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    <link href="css/style1.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    <style>
.zoom{
    -webkit-transition: all 0.3s ease-in-out;
    -moz-transition: all 0.3s ease-in-out;
    -o-transition: all 0.3s ease-in-out;
    -ms-transition: all 0.3s ease-in-out;
    transition: all 0.3s ease-in-out;
}
.zoom:hover{
  -webkit-transform: scale(1.1);
    -moz-transform: scale(1.1);
    -o-transform: scale(1.1);
    transform: scale(1.1);
}
   body

    {



      font-family: 'Segoe' !important;

    }

    @font-face

    {

      font-family: 'Segoe';

      src: url('include/Roboto-Thin.ttf');

    }
</style>
<script language="javascript">
<!--
window.onbeforeunload = domystuff;

function domystuff(){
   //...
   session_destroy();
}
//-->
</script>
</head>
<body class="grey lighten-3">

  <nav class="black darken-4 z-depth-3 navbar-fixed" role="navigation">
    <div class="nav-wrapper container "><a id="logo-container" href="#" class="white-text brand-logo">Book-<span class="green-text">e</span>-pedia<small class="grey-text"> v0.3</small></a>
      <ul class="right hide-on-med-and-down">
        <li class="white-text"><a href="#" class="white-text light">Monday,21 June 2015</a></li>
      </ul>

      <ul id="nav-mobile" class="side-nav">
        <li class="white-text"><a href="#">About</a></li>
      </ul>
      <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="mdi-navigation-menu green-text"></i></a>
    </div>
  </nav>
   <div id="index-banner" class="parallax-container">
    <div class="section no-pad-bot">
      <div class="container">
       <h1 class="header center black-text light">Dive into Largest Tech Books DB</h1>

                    <form class="form-horizontal" action="index.php" method="POST" name="form1">

         <div class="row">
      <div class="col s12 m12">
             <div class="input-field">
                    <input id="icon_prefix" autofocus type="text" style="font-size:35px;" class="z-depth-3 flow-text validate black-text center white" auto-focus="true" name="findbook" placeholder="Search Here..."  value="<?php echo htmlspecialchars($_POST['findbook']);?>">
      
         <div style="margin:5% 0% 0% 50% ;"> <p class="btn-circle " ><a href="#bookslist"><i  class=" white-text mdi-hardware-keyboard-arrow-down medium"></i></a></p></div>

        </div>
      </div>
    </div>
     
      </form>

   <?php
   session_start();
  
if(isset($_POST['findbook']))
{
  $_SESSION['findbo'] = $_POST['findbook'];
}

    ?>
              </div>
    </div>
      <div class="parallax z-depth-3 "><img src="05.jpg" alt="title" class="z-depth-3" ></img></div>
  </div>
 


    <div class="section">
  <div class="container">
  
   
  <?php  
  //$find = $term;
  $we = preg_replace('/ /', '+', $_SESSION['findbo']);
  //$str=file_get_contents('db.json');
  if(strlen($page1<1))
    { 
      $str = file_get_contents('http://it-ebooks-api.info/v1/search/'.$we.'/page/1');
    }
  else
  {
  $str = file_get_contents('http://it-ebooks-api.info/v1/search/'.$we.'/page/'.$page1.'');
    
  }
//Now decode the JSON using json_decode():
$json_a=json_decode($str,true);

$json_o=json_decode($str);
// array method
/*foreach($json_a[person] as $p)
{
echo '

Name: '.$p[name][first].' '.$p[name][last].'

Age: '.$p[age].'

';

}*/
// object method
?>


 <div class="section no-pad-bot" id="index-banner">

    
      <div class="row center">
       <h5 class="header col s12 light"> <span class="green-text">Results for <?php echo $_SESSION['findbo'];?></h5>
        <h5 class="header col s12 light grey-text">( About <?php echo $json_o->Total; ?> Results in </span><?php echo "".(($json_o->Time)*100)." seconds )";?></h5>
        <h6><?php if(strlen($page1<1)){echo "Page 1";} else { echo "Page ".$page1; }?></h6>
        </div>
        <?php if($json_o->Total<1){ ?>
      <div class="row center">
        <h4 class="grey">Ooops!!! Didn't find it 😣 We are still working on it..😉</h4>
         </div>
   <?php }?>
 <div class="container">
    </div>
  </div>

<div class="row ">
<?php
foreach($json_o->Books as $p)
{?>
    
        <div class="col s12 m4 scrollspy " id="bookslist">
          <div class="card z-depth-1" >
            <div class="card-image">
              <a href="book.php?id=<?php echo $p->ID;?>"><img src="<?php echo $p->Image; ?>" height="300px" class="z-depth-1 zoom"></a>
               </div>
            <div class="card-content">
              
             <p style="height:90px; overflow:hidden; text-overflow:ellipsis; " class="card-title green-text " ><?php echo $p->Title; ?></p>
            
              <p style="height:160px; overflow:hidden; text-overflow:&#x00025; "><?php echo $p->Description; ?></p>
            </div>
            <div class="card-action">
              <a href="book.php?id=<?php echo $p->ID;?>" class="green-text">View</a>
                 </div>
          </div>
        </div>
     

    
<?} ?>
</div>


   <div class="row">
  <ul class=" col pagination green-text">
   <?php $page = $json_o->Total / 10;
 $page=ceil($page);
for ($i=1;$i<=$page;$i++)
 {?>
 <li class="waves-effect"><a href="index.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
  <?php } ?>
</ul>
</div>
 </div>
 

    
 
  </div>

  <footer class="page-footer black darken-4">
    <div class="container">
      <div class="row">
        <div class="col l6 s12">
          <h5 class="white-text">Wonderweb Developers IND.</h5>
          <p class="grey-text text-lighten-4">We are a team of college students working on this project like it's our full time job. Any amount would help support and continue development on this project and is greatly appreciated.</p>


        </div>
        <div class="col l3 s12">
          <h5 class="white-text">Settings</h5>
          <ul>
            <li><a class="white-text" href="#!">About </a></li>
            <li><a class="white-text" href="#!">Contact</a></li>
            <li><a class="white-text" href="#!">Privacy Policy</a></li>
            <li><a class="white-text" href="#!">Terms & Conditions</a></li>
          </ul>
        </div>
        <div class="col l3 s12">
          <h5 class="white-text">Connect</h5>
          <ul>
            <li><a class="white-text" href="#!">Facebook</a></li>
            <li><a class="white-text" href="#!">Twitter</a></li>
            <li><a class="white-text" href="#!">Github</a></li>
            <li><a class="white-text" href="#!">Linkedin</a></li>
          </ul>
        </div>
      </div>
    </div>
    <div class="footer-copyright">
      <div class="container">
      Developed & Designed by <a class="green-text text-accent-3">Wonderweb Developers IND.</a>
      </div>
    </div>
  </footer>


  <!--  Scripts-->
  <script src="js/jquery-2.1.1.min.js"></script>
  <script src="js/materialize.js"></script>
  <script src="js/init.js"></script>

  </body>
</html>

