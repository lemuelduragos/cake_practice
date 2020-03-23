

<div class="container">

  <!-- Outer Row -->
  <div class="row justify-content-center">

    <div class="col-xl-10 col-lg-12 col-md-9">

      <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
          <!-- Nested Row within Card Body -->
          <div class="row">
            <div class="col-lg-6 login-intro">
                <center>
                  <h2 class="font-weight-bold text-primary mt-5">
                    <i class="fas fa-cog"></i>
                    E-TESDA Information System
                  </h2>
                  <p class=" font-weight-bold">in partnership with</p>
                <center>
                <img src="https://www.treston.edu.ph/images/content/page-content/tesdalogo.png" class="brand-image">
            </div>
            <div class="col-lg-6">
              <div class="p-5">
                <div class="text-center">
                  <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                </div>
                <?php  echo "<center class='warn'><b>".$this->Flash->render('auth')."</center><b>";?>
                <?php 
                  $options = array('label' => 'Login', 'class' => 'btn btn-primary btn-user btn-block');
                  echo $this->Form->create('User', array('class' => 'user'));
                  echo $this->Form->input('Username', array('placeholder' => "Username", 'label' =>'', 'class'=>'form-control form-control-user'));
                  echo $this->Form->input('Password', array('placeholder' => "Password", 'label' =>'', 'type' => 'password', 'class'=>'form-control form-control-user'));
                  echo "<br>";
                  echo  $this->Form->end($options); 
                ?>
                <hr>
                <div class="text-center">
                  <a class="small" href="forgot-password.html">Forgot Password?</a>
                </div>
                <div class="text-center">
                  <a class="small" href="register.html">Please contact system administrator <br> if you don't have an account</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>

  </div>

</div>

<script>
(function (global) { 

    if(typeof (global) === "undefined") {
        throw new Error("window is undefined");
    }

    var _hash = "!";
    var noBackPlease = function () {
        global.location.href += "#";

        global.setTimeout(function () {
            global.location.href += "!";
        }, 50);
    };

    global.onhashchange = function () {
        if (global.location.hash !== _hash) {
            global.location.hash = _hash;
        }
    };

    global.onload = function () {            
        noBackPlease();

        // disables backspace on page except on input fields and textarea..
        document.body.onkeydown = function (e) {
            var elm = e.target.nodeName.toLowerCase();
            if (e.which === 8 && (elm !== 'input' && elm  !== 'textarea')) {
                e.preventDefault();
            }
            // stopping event bubbling up the DOM tree..
            e.stopPropagation();
        };          
    }

})(window);
</script>

