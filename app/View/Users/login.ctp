
<body class="login">
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="wrap">
                <p class="form-title">
                    Sign In</p>
                      <?php  echo "<center class='warn'><b>".$this->Flash->render('auth')."</center><b>";?>
                    <?php 
                        $options = array('label' => 'Sign in', 'class' => 'btn btn-success btn-sm');
                        echo $this->Form->create('User', array('class' => 'login'));
                        echo $this->Form->input('Username', array('placeholder' => "Username", 'label' =>''));
                        echo $this->Form->input('Password', array('placeholder' => "Password", 'label' =>'', 'type' => 'password'));
                        echo  $this->Form->end($options); 
                    ?>
                    <form class='login'>
                    <center><a>Sign Up for Free Click</a> <a href="http://localhost.com/cakeangular/users/register"><b>HERE</b></a></center>
                    </form>
            </div>
        </div>
    </div>
</div>
</body>
<script>
(function (global) { 

    if(typeof (global) === "undefined") {
        throw new Error("window is undefined");
    }

    var _hash = "!";
    var noBackPlease = function () {
        global.location.href += "#";

        // making sure we have the fruit available for juice (^__^)
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

