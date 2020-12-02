    <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-xs-12">
                        <div class="widget clearfix">
                            <div class="widget-title">
                                <h3 style="font-family: sans-serif;">Follow me</h3>
                            <br/>
                            <div class="footer-right">
                                <ul class="footer-links-soi">
                                    <li><a href="" title="LinkedIn">
                                        <i class="fa fa-linkedin"></i></a></li>
                                    <li><a href="" title="Facebook"><i class="fa fa-facebook"></i></a></li>
                                </ul><!-- end links -->
                            </div>
                        </div><!-- end clearfix -->
                    </div><!-- end col -->
                    </div>
                    <div class="col-lg-4 col-md-4 col-xs-12">
                        <div class="widget clearfix">
                            <div class="widget-title">
                                <h3 style="font-family: sans-serif;">Information Link</h3>
                            </div>
                            <ul class="footer-links">
                                <li><a href ="" title="Contact Us">Contact Us</a></li>
                                <li><a href ="" title="Privacy Policy">Privacy Policy</a></li>
                                <li><a href ="">Refund and Cancellation</a></li>
                                <li> <a href ="">Terms and Conditions</a></li>
                            </ul><!-- end links -->
                        </div><!-- end clearfix -->
                    </div><!-- end col -->

                    <div class="col-lg-4 col-md-4 col-xs-12">
                        <div class="widget clearfix">
                            <div class="widget-title">
                                <h3 style="font-family: sans-serif;">Contact Details</h3>
                            </div>

                            <ul class="footer-links">
                                <li><a href="">www.pariksha.com</a></li>
                                <li>Address: Delhi</li>
                                <li>Contact: <a href="tel:+91 ">+91 435345345</a></li> 
                                <li>Email: <a href="">info@pariksha.com</a></li>
                            </ul><!-- end links -->
                        </div><!-- end clearfix -->
                    </div><!-- end col -->

                </div><!-- end row -->
            </div><!-- end container -->
    </footer><!-- end footer -->

     <div class="copyrights">
        <div class="container">
            <div class="footer-distributed">
                <div class="footer-center">
                    <p class="footer-company-name">Last Update: <?php echo date('m-Y');?>, <a href="">Pariksha</a> All Rights Reserved. &copy; 2020</p>
                </div>
            </div>
        </div><!-- end container -->
    </div><!-- end copyrights -->

    <a href="#" id="scroll-to-top" class="dmtop global-radius"><i class="fa fa-angle-up"></i></a>

    <!-- ALL JS FILES -->
    <script src="js/all.js"></script>
    <!-- ALL PLUGINS -->
    <script src="js/custom.js"></script>
    <script src="js/timeline.min.js"></script>
    <script>
        timeline(document.querySelectorAll('.timeline'), {
            forceVerticalMode: 700,
            mode: 'horizontal',
            verticalStartPosition: 'left',
            visibleItems: 4
        });

        function get_child_options(selected1,selected2,selected3,selected4,selected5)
            {
                if(typeof selected1 =='undefined')
                    {
                        var selected1='';
                    }
                if(typeof selected2 =='undefined')
                    {
                        var selected2='';
                    }
                if(typeof selected3 =='undefined')
                    {
                        var selected3='';
                    }
                if(typeof selected4 =='undefined')
                    {
                        var selected4='';
                    }
                if(typeof selected5 =='undefined')
                    {
                        var selected5='';
                    }    
                var streamcategory=jQuery('#streamcategory').val();
                var streamname=jQuery('#streamname').val();
                var subject=jQuery('#subject').val();
                var chapter=jQuery('#chapter').val();
                var section=jQuery('#section').val();
                jQuery.ajax({
                    url:'create_keyword.php',
                    type:'POST',
                    data:{streamcategory : streamcategory, streamname : streamname, subject : subject, chapter : chapter, section : section, selected1:selected1,selected2:selected2, selected3:selected3, selected4:selected4, selected5:selected5 },
                    success:function(data){
                        jQuery('#keyword').html(data);
                    },
                    error:function(){alert("wrong")},
                });
            }
            jQuery('select[name="streamcategory"]').change(function(){
                get_child_options();});
            jQuery('select[name="streamname"]').change(function(){
                get_child_options();});
            jQuery('select[name="subject"]').change(function(){
                get_child_options();});
            jQuery('select[name="chapter"]').change(function(){
                get_child_options();});
            jQuery('select[name="section"]').change(function(){
                get_child_options();});      
    </script>
    <script>
        function get_results(selected1,selected2,selected3,selected4,selected5)
            {
                if(typeof selected1 =='undefined')
                    {
                        var selected1='';
                    }
                if(typeof selected2 =='undefined')
                    {
                        var selected2='';
                    }
                if(typeof selected3 =='undefined')
                    {
                        var selected3='';
                    }
                if(typeof selected4 =='undefined')
                    {
                        var selected4='';
                    }
                if(typeof selected5 =='undefined')
                    {
                        var selected5='';
                    }    
                var streamcategory=jQuery('#streamcategory').val();
                var streamname=jQuery('#streamname').val();
                var subject=jQuery('#subject').val();
                var chapter=jQuery('#chapter').val();
                var section=jQuery('#section').val();
                jQuery.ajax({
                    url:'search_questions.php',
                    type:'POST',
                    data:{streamcategory : streamcategory, streamname : streamname, subject : subject, chapter : chapter, section : section, selected1:selected1,selected2:selected2, selected3:selected3, selected4:selected4, selected5:selected5 },
                    success:function(data){
                        jQuery('#results').html(data);
                    },
                    error:function(){alert("wrong")},
                });
            }
            jQuery('select[name="streamcategory"]').change(function(){
                get_results();});
            jQuery('select[name="streamname"]').change(function(){
                get_results();});
            jQuery('select[name="subject"]').change(function(){
                get_results();});
            jQuery('select[name="chapter"]').change(function(){
                get_results();});
            jQuery('select[name="section"]').change(function(){
                get_results();});
    </script>
    <script>
           function other(){
                location.href="view_questions.php";
                break;
           }
    </script>
</body>
</html>
