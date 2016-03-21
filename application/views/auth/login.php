 
<div class="container-fluid main-content">
        
    <div class="auto-margin col-330-max">

        <div class="text-center">
            <img src="<?php echo base_url('images/im-logo-text-gold.png')?>" alt="Intelligent Money"/>
        </div>


        <div class="login bg-gray">

        <h2 class="form-signin-heading">Please sign in</h2>
        <?php echo form_open('',array())?>  
            <?php echo validation_errors() ?>
        <?php if(isset($login_error)):?>
            <p class="alert alert-danger"><?php echo $login_error?></p>
        <?php endif;?>

            <div>
                 <label for="inputEmail" class="sr-only">Email address</label>
                 <input type="email" id="inputEmail" class="form-control" name="email"  placeholder="Email address" required autofocus>
            </div>
           <br/>
            <div>
                <label for="inputPassword" class="sr-only">Password</label>
                <input type="password" id="inputPassword" class="form-control" placeholder="Password" required name="password">
            </div>
            <br/>


            <div>
                <input type="submit" name="login" value="Sign in" class="btn btn-lg btn-primary-2 btn-block" />
            </div>


        <?php echo form_close()?>
        </div>


    </div>
    
    <br/>

</div>

