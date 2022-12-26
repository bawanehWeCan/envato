$( document ).ready(function() {

    new ClipboardJS('.copy');

    $('[data-toggle="tooltip"]').tooltip();

    $('.alert').alert()


    $( ".login-tab-link" ).on('click', function() {
        $(this).addClass('tab-active')
        $(".reg-tab-link").removeClass('tab-active')
        $('.login-tab').show()
        $('.reg-tab').hide()
    });
    $( ".reg-tab-link" ).on('click', function() {
        $(this).addClass('tab-active')
        $(".login-tab-link").removeClass('tab-active')
        $('.reg-tab').show()
        $('.login-tab').hide()
    });


    $( ".mobilemenu-trigger" ).on('click', function() {
        $("body").addClass('off-active')
        $(".tak-off").css('right',0)

    });
    $( ".tak-close" ).on('click', function() {
        $("body").removeClass('off-active')
        $(".tak-off").css('right',-260)

    });

    $( ".off-over" ).on('click', function() {
        $("body").removeClass('off-active')
        $(".tak-off").css('right',-260)

    });


    $( ".form-tak" ).focusin(function() {
        //alert( "Handler for .focus() called." );
        $(this).addClass('tak-active')
    });

    $( ".form-tak" ).focusout(function() {
        //alert( "Handler for .focus() called." );
        //$(this).removeClass('tak-active')
        if ($(this).find('input','textarea').val().length) {
            $(this).addClass("tak-active");
        } else {
            $(this).removeClass("tak-active");
        }
    });

    $(".form-tak").each(function(){
        if ($(this).find('input','textarea').val().length) {
            $(this).addClass("tak-active");
        } else {
            $(this).removeClass("tak-active");
        }
      });

    
    uploadImage()
    
});

function uploadImage() {
    var button = $('.images .pic')
    var uploader = $('#userimage')
    var images = $('.images')
    
    button.on('click', function () {
      uploader.click()
      
    })
    
    uploader.on('change', function () {
        var reader = new FileReader()
        reader.onload = function(event) {
          images.prepend('<div class="img" style="background-image: url(\'' + event.target.result + '\');" rel="'+ event.target.result  +'"><span class="remover-image"><!-- ICON DELETE --><svg class="icon-delete"><use xlink:href="#svg-delete"></use></svg><!-- /ICON DELETE --></span></div>')
        }
        reader.readAsDataURL(uploader[0].files[0])
        button.hide()
     })
    
    images.on('click', '.img', function () {
      $(this).remove()
      button.show()
    })
  
  }
  


