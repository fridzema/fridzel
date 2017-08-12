require('./bootstrap');

var uploadErrors = false;

new Dropzone("#dropzone", {
    params: {
      _token: window.Laravel.csrfToken,
    },
    url: '/admin/photos',
    autoProcessQueue: true,
    maxFilesize: 100,
    parallelUploads: 10,
    uploadMultiple: true,
    error: function() {
      uploadErrors = true;
  	},
    queuecomplete: function(){
    	if(!uploadErrors) location.reload();
    }
});
