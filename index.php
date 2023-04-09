<?php 
  include 'layout/header.php';
  include 'config.php';
?>
<div class="container">
  <header>
    <div class="logo">
      <i class="fas fa-gamepad"></i>
      <p>The Game Zone</p>
    </div>
    <div class="navbar">
      <?php 
if (isset($_SESSION) && isset($_SESSION['loggedIn'])) {
  ?>

      <a onClick="logout()" class=" cursor-pointer h-10 w-10"><img title="logout" class ="rounded-full" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTCZiXqqCmDHi79ClIg2vo40a2gtsSfIXexd4-S_A4&s" alt="" srcset="">
      </a>
      <button type="button" data-collapse-toggle="mega-menu-icons"  class="p-2 font-normal ml-2  bg-green-600 text-center text-white  capitalize cursor-pointer h-10 w-10 rounded-full"><span> <?php  echo $_SESSION['user']['first_name'][0]?>
   </span>    </a>
  
      <?php
      }
       else {
        ?>
      ><a  class="text-white bg-gradient-to-r from-cyan-500 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2" href="signin.php">sign in</a></li>
      ><a  class="text-white bg-gradient-to-r from-cyan-500 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2" href="signup.php">sign up</a></li>
      <?php }?>
    </div>
  </header>

  <div class="content-wrapper">
    <div class="content-desc">
      <h1>THE GAME ZONE</h1>
      <p>
        Compete with <span>Rakuto</span> in this immense challenge and be the
        winner of all TIme.
      </p>
      <p>
        Our Top Players are waiting for your challenge, click the button below
        to get started.
      </p>

      <button id="btn2">Challenge Rakuto Now</button>
    </div>

    <div class="rakuto"></div>
  </div>
</div>

<div class="col-md-12 col-sm-12 col-xs-12 gameHeader p-4" id="games">
  <h3 style="text-align: center; color: white; font-size: 2rem; font-weight: bold">
    Our Games
  </h3>
  <p class="text-base text-center text-white font-normal">
    Cavalier Studios has been creating innovative games since 2003. We offer our
    clients professional development services.
  </p>
</div>

<section class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-5 p-10" id="games">
  <?php
  $html = $pdo->query("SELECT * FROM games.games ORDER BY games.game_id DESC ")->fetchAll();
  foreach ($html as $row) {
    
  ?>
  <div class="bg-white h-11/12">
    <img src=<?php echo $row['game_image'] ?> class="card-img-top h-32" alt="Fissure in Sandstone"/>
    <div class="card-body space-y-4 flex flex-col items-center">
      <div class=" text-2xl font-bold text-center ">
        <?php  echo  $row['game_name'] ?>
      </div>


      <a href="<?php echo $row['url'] ?>" type="button"
        class="text-white bg-gradient-to-r from-cyan-500 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
        play now </a>

    </div>
  </div>
  <?php
  }
?>
</section>
<div class="section-3">
  <h1>What People say About us</h1>
  <div class="section-3-wrapper">
    <div class="feedback"></div>
    <div class="feedback-desc">
      <p>
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Rerum delectus
        error, tempora laborum, voluptas magnam animi quo repudiandae asperiores
        totam dolore commodi perspiciatis sapiente accusamus alias non vitae
        incidunt nisi!
      </p>
      <br />
      <i class="far fa-grin-squint-tears"></i><br />
      <h4>OSCAR</h4>
    </div>
    <!-- =========================== -->
    <div class="feedback f-img-2"></div>
    <div class="feedback-desc">
      <p>
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Rerum delectus
        error, tempora laborum, voluptas magnam animi quo repudiandae asperiores
        totam dolore commodi perspiciatis sapiente accusamus alias non vitae
        incidunt nisi!
      </p>
      <br />
      <i class="far fa-grin-beam-sweat"></i><br />
      <h4>MARIO</h4>
    </div>
  </div>
</div>

<footer>
  <div class="footer-body">
    <div class="logo footer-logo">
      <i class="fas fa-gamepad"></i>
      <h1>The Game Zone</h1>
    </div>
    <ul>
      <h3>Short Links</h3>
      <li><a href="#">Arcade</a></li>
      <li><a href="#">War Zone</a></li>
      <li><a href="#">Fifa Game</a></li>
      <li><a href="#">Pes 2020</a></li>
      <li><a href="#">Xbox Game</a></li>
    </ul>

    <ul>
      <h3>Action Games</h3>
      <li><a href="#">Anpar</a></li>
      <li><a href="#">BattleField</a></li>
      <li><a href="#">The Ghost</a></li>
      <li><a href="#">Fortnite</a></li>
      <li><a href="#">Cold War</a></li>
    </ul>
    <ul>
      <h3>Get In Touch</h3>
      <li>
        <a href="#"><i class="fab fa-facebook"></i>Facebook</a>
      </li>
      <li>
        <a href="#"><i class="fab fa-instagram"></i>Instagram</a>
      </li>
      <li>
        <a href="#"><i class="fab fa-twitter"></i>Twitter</a>
      </li>
      <li>
        <a href="signin.php"><i class="fab fa-linkedin"></i>Linkedin</a>
      </li>
    </ul>
  </div>
</footer>
<div class="footer-bottom">
  <p>
    Copyright &copy; All Right Reserved | Designed <span>By Almarex</span> 2021
  </p>
</div>

<script type="text/javascript" src="js/script.js"></script>