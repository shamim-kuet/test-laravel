<!-- Essential javascripts for application to work-->
<script src="{{ asset('admin/js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('admin/js/popper.min.js') }}"></script>
<script src="{{ asset('admin/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('admin/js/main.js') }}"></script>
<!-- The javascript plugin to display page loading on top-->
<script src="{{ asset('admin/js/plugins/pace.min.js') }}"></script>
<script type="text/javascript">
  // Login Page Flipbox control
  $('.login-content [data-toggle="flip"]').click(function() {
      $('.login-box').toggleClass('flipped');
      return false;
  });
</script>