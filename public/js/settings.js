    views = ['member', 'schedule', 'availability', 'record', 'media', 'message', 'asset', 'setting'];

    // start script to load on page load
      $(document).ready(function(){
        $("#alert").fadeTo(2000, 500).slideUp(500, function(){
          $("#success-alert").slideUp(500);
        });
      });
    // end script to load on page load

    // start show public access setting tab
      $('#a-access').click(function(){
        toggleClasses($(this), $('#a-manager'), $('#access-detail'), $('#managers-detail'));
      });
    // end show public access setting tab

    // start show manager access setting tab
      $('#a-manager').click(function(){
        toggleClasses($(this), $('#a-access'), $('#managers-detail'), $('#access-detail'));
      });
    // end show manager access setting tab

    // start show desired tab and hide others
      function toggleClasses(active, deactive, showdiv, hidediv)
      {
        deactive.removeClass('a-active');
        active.addClass('a-active');
        showdiv.show();
        hidediv.hide();
      }
    // end show desired tab and hide others

    // start edit access settings
      $('#access-tabs').on('click', '#edit', function(){
        key = $(this).attr('key');
        div = (key == 'public') ? $('#public-div') : $('#manager-div');
        div.find('#submit').show();
        div.find('#cancel').show();
        $(this).hide();

        div.find('#dropdown-li').removeClass('open');
        div.find('#menu-dots').attr('aria-expanded', false);

        for( i = 0; i < views.length; i++ )
        {
          data = div.find('#'+views[i]);
            ch = (data.find('span').html() == 'Granted') ? 1 : 0;

          content = '<div class=" radio radio-inline">';
          if( ch == 1 )
            content += '<label class="m-r-20 p-r-5"><input type="radio" value="1" name="'+views[i]+'" class="optradio" checked><i class="input-helper"></i>Yes</label><label><input type="radio"  value="0" name="'+views[i]+'" class="optradio"><i class="input-helper"></i>No</label></div>';
          else
            content += '<label class="m-r-20 p-r-5"><input type="radio" value="1" name="'+views[i]+'" class="optradio"><i class="input-helper"></i>Yes</label><label><input type="radio"  value="0" name="'+views[i]+'" class="optradio" checked><i class="input-helper"></i>No</label></div>';

          data.html(content);
        }
      });
    // end edit access settings

    // start remove edit view from access setting
      function cancelEdit(div, data, self)
      {
        div.find('#dropdown-li').removeClass('open');
        div.find('#menu-dots').attr('aria-expanded', false);
        div.find('#submit').hide();
        div.find('#edit').show();
        self.hide();

        for( i = 0; i < views.length; i++ )
        {
          color  = ( data[i] == 0 ) ? 'red' : 'green';
          access = ( data[i] == 0 ) ? 'Not Granted' : 'Granted';

          div.find('#'+views[i]).html('<span style="color: '+ color +'">'+ access +'</span>');
        }
      }
    // end remove edit view from access setting


      function showDeleteDialog(url)
      {
        swal({
          title: "Are you sure?",
          text: "Selected team member will be deleted permanently!!!",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "Yes, delete it!",
          closeOnConfirm: true
        }, function(){
          window.location.href = url;
        });
      }
