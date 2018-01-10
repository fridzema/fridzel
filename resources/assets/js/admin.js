require('./bootstrap');

var photoContainer = document.getElementById('photos');
var template = document.getElementById('uploaded-photos');

new Dropzone("#dropzone", {
    params: {
      _token: window.Laravel.csrfToken,
    },
    url: '/admin/photos',
    autoProcessQueue: true,
    maxFilesize: 100,
    parallelUploads: 10,
    uploadMultiple: true,
    init: function(){
      this.on("success", function(data) {
          var response = JSON.parse(data.xhr.response);
          console.log(response)
          var img = document.createElement('img');
					img.src = ''+response.url+'';
					document.getElementById('photos').appendChild(img)
      });
    }
});

var sortable = Sortable.create(photoContainer, {
  dataIdAttr: 'data-model-id',
  handle: '.drag-handle',
  sort: true,
  animation: 150,
  scrollSensitivity: 150,
  scrollSpeed: 100,
  onEnd: function (evt) {
	  axios.post('/admin/photos/reorder', {sort_order: sortable.toArray()})
	  .then(function (response) {
	    console.log(response);
	  })
	  .catch(function (error) {
	    console.log(error);
	  });
	},
});