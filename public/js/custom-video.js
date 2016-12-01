$(document).ready(function (){   

// Video upload using plupload.
var uploader = new plupload.Uploader({
    runtimes : 'html5,flash,silverlight,html4',
    browse_button : 'pickfiles', // you can pass an id...
    container: document.getElementById('container'), // ... or DOM Element itself
    url : 'upload',
    multi_selection: false,
    flash_swf_url : '../js/Moxie.swf',
    silverlight_xap_url : '../js/Moxie.xap',
    // add X-CSRF-TOKEN in headers attribute to fix this issue
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },    
    filters : {
        max_file_size : '1000mb',
        mime_types: [
            {title : "Video files", extensions : "mp3,mp4"},
        ]
    },
    init: {
        PostInit: function() {
            document.getElementById('filelist').innerHTML = '';

            document.getElementById('uploadfiles').onclick = function() {
                uploader.start();
                return false;
            };
        },
        FilesAdded: function(up, files) {
            plupload.each(files, function(file) {
                document.getElementById('filelist').innerHTML = '<div id="' + file.id + '">' + file.name + ' (' + plupload.formatSize(file.size) + ') <b></b></div>';
            });
        },
        UploadProgress: function(up, file) {
            document.getElementById(file.id).getElementsByTagName('b')[0].innerHTML = '</br><span class="progress-bar"role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:' + file.percent + '%">' + file.percent + '%</span></br>';
        },
        Error: function(up, err) {
            document.getElementById('console').appendChild(document.createTextNode("\nError #" + err.code + ": " + err.message));
        }
    }
});
uploader.init();
uploader.bind('FileUploaded', function(up, file, info) {
  var obj = JSON.parse(info.response);
    $('#file_name').val(obj.result);
 });


// Initialise datatables
var table = $('.dataTables').DataTable({       
  'columnDefs': [{
     'targets': 0,
     'searchable':false,
     'orderable':false,
     'className': 'dt-body-center',
     'render': function (data, type, full, meta){
         return '<input type="checkbox" name="id[]" value="' 
            + $('<div/>').text(data).html() + '">';
     }
  }],
  'order': [3, 'desc']
});


// Handle click on "Select all" control
$('#example-select-all').on('click', function(){
    // Check/uncheck all checkboxes in the table
    var rows = table.rows({ 'search': 'applied' }).nodes();
    $('input[type="checkbox"]', rows).prop('checked', this.checked);
});


// Handle click on checkbox to set state of "Select all" control
$('#example tbody').on('change', 'input[type="checkbox"]', function(){
  // If checkbox is not checked
    if(!this.checked){
        var el = $('#example-select-all').get(0);
        // If "Select all" control is checked and has 'indeterminate' property
        if(el && el.checked && ('indeterminate' in el)){
            // Set visual state of "Select all" control 
            // as 'indeterminate'
            el.indeterminate = true;
     }
  }
});


// 
$('#frm-example').on('submit', function(e){
    var form = this;
    // Iterate over all checkboxes in the table
    table.$('input[type="checkbox"]').each(function(){
        // If checkbox doesn't exist in DOM
        if(!$.contains(document, this)){
            // If checkbox is checked
            if(this.checked){
               // Create a hidden element 
               $(form).append(
                  $('<input>')
                    .attr('type', 'hidden')
                    .attr('name', this.name)
                    .val(this.value)
               );
            }
        } 
    });
      // Output form data to a console
      $('#example-console').text($(form).serialize()); 
      console.log("Form submission", $(form).serialize()); 
      // Prevent actual form submission
      e.preventDefault();
   });
});


// Inline edit in video detail.
$.fn.editable.defaults.mode = 'inline';
$('.inline_edit_text').editable({
    name: 'inline',
    title: 'inline',
    success: function(response, newValue) {
      var userid = $('#videoid').val();
      var field = this.id;
      var formData = {
          'videoid'   : userid,
          'field'    : field,
          'value'    : newValue
      };  
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      }); 
      $.ajax({
          type        : "POST", 
          data        : formData,
          url         : baseUrl+"/videos/update",
          success: function(data){
              //  retrun data.
          }
      });
    }
});


// 
$.fn.editable.defaults.mode = 'inline';
$('.inline_edit_textarea').editable({
  name: 'inline',
  title: 'inline',
  type:  'textarea',
  success: function(response, newValue) {
    var userid = $('#videoid').val();
    var field = this.id;
    var formData = {
        'videoid'   : userid,
        'field'    : field,
        'value'    : newValue
    };  
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    }); 
    $.ajax({
        type        : "POST", 
        data        : formData,
        url         : baseUrl+"/videos/update",
        success: function(data){
            //  retrun data.
        }
    });
  }
});
$('#channel_name').selectpicker({
    style: 'btn-primary'
});


// Copy embedded code.
$("#copy").click(function(){
  var code = document.querySelector('#embeded');
  // select the contents
  code.select();
  document.execCommand('copy'); // or 'cut'
});


// Delete video from video listing
$("#delete-lib").click(function(){
    bootbox.confirm({
            message: "Are you sure you want to delete videos?",
            buttons: {
                confirm: {
                    label: 'Yes',
                    className: 'btn-success'
                },
                cancel: {
                    label: 'No',
                    className: 'btn-danger'
                }
        },
        callback: function (result) {
            if(result){
                $("#videolib").submit();
            }
        }
    });
});


// Validate upload form.
$("#upload-form").validate();

// Check for the uploaded video before submit.
$("#video-upload").click(function() {
    if($("#file_name").val() == "") {
        bootbox.alert("Please Upload Video");
        return false;
    }
});


// Show delete button on on click checkbox
// in video listing page.
$("input[name='id[]']").each( function () {
    $(this).on('click', function(){

    });
});
