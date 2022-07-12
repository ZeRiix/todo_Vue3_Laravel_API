<template>
    <footer class="bg-dark text-center text-white fixed-bottom">
    <!-- Grid container -->
        <div class="container p-4">
            <!-- Section: Social media -->
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <div class="nav" id="center">
                        <!-- Twitter -->
                        <router-link to="/Home" class="nav-link active" >
                            <button class="btn btn-outline-light btn-floating m-1" role="button">
                                <i class="fab fa-twitter"></i></button></router-link>

                        <!-- Google -->
                        <router-link to="/Home" class="nav-link active" >
                            <button class="btn btn-outline-light btn-floating m-1" role="button">
                                <i class="fab fa-google"></i></button></router-link>
                                
                        <!-- Instagram -->
                        <router-link to="/Home" class="nav-link active" >
                            <button class="btn btn-outline-light btn-floating m-1" role="button">
                                <i class="fab fa-instagram"></i></button></router-link>

                        <!-- Linkedin -->
                        <router-link to="/Home" class="nav-link active" >
                            <button class="btn btn-outline-light btn-floating m-1" role="button">
                                <i class="fab fa-linkedin-in"></i></button></router-link>

                        <!-- Github -->
                        <router-link to="/Home" class="nav-link active" >
                            <button class="btn btn-outline-light btn-floating m-1" role="button">
                                <i class="fab fa-github"></i></button></router-link>
                    </div>
                    <p>Design by ZeRiix 2022</p>
                </div>
            </div>
            <!-- Section: Social media -->
            
        </div>
        <!-- Grid container -->
    </footer>
</template>

<script>

export default {
  name: 'FooterBar',
  props: {
    
  }
}

</script>

<style>
    #center {
        
        margin-left: auto;
        margin-right: auto;
        
    }
</style>